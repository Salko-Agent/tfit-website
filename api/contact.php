<?php
/**
 * FlexFit – Contact Form API
 * BMS Projekte
 */
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/../includes/functions.php';
session_start();

// CSRF check
if (!csrf_valid()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Ungültiger Token. Bitte Seite neu laden.']);
    exit;
}

// Sanitize inputs
function clean(string $input): string {
    return trim(strip_tags($input));
}

$firstname = clean($_POST['firstname'] ?? '');
$lastname  = clean($_POST['lastname']  ?? '');
$email     = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone     = clean($_POST['phone']     ?? '');
$message   = clean($_POST['message']  ?? '');
$interest  = clean($_POST['interest'] ?? '');
$goal      = clean($_POST['goal']     ?? '');
$pref_date = clean($_POST['preferred_date'] ?? '');
$form_type = clean($_POST['form_type'] ?? 'contact');

// Validation
if (empty($firstname) || strlen($firstname) < 2) {
    echo json_encode(['success' => false, 'message' => 'Bitte gib deinen Vornamen ein.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Bitte gib eine gültige E-Mail-Adresse ein.']);
    exit;
}
if (empty($message) && $form_type === 'contact') {
    echo json_encode(['success' => false, 'message' => 'Bitte schreib uns eine kurze Nachricht.']);
    exit;
}

// Spam honeypot (add field "website" hidden in form)
if (!empty($_POST['website'])) {
    // Silently succeed (spam bot)
    echo json_encode(['success' => true]);
    exit;
}

// Rate limiting — session + IP-based (IP limit survives cookie deletion)
$_SESSION['contact_count'] = ($_SESSION['contact_count'] ?? 0) + 1;
$_SESSION['contact_last']  = time();
if ($_SESSION['contact_count'] > 5) {
    http_response_code(429);
    echo json_encode(['success' => false, 'message' => 'Zu viele Anfragen. Bitte versuche es später erneut.']);
    exit;
}

// IP-based rate limit: max 10 submissions per IP per hour
$clientIp   = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$clientIp   = preg_replace('/[^a-fA-F0-9.:,]/', '', $clientIp);
$clientIp   = explode(',', $clientIp)[0]; // take first IP if forwarded list
$ipHash     = hash('sha256', $clientIp);  // never store raw IPs
$rateFile   = sys_get_temp_dir() . '/sf_rl_' . $ipHash . '.json';
$rateWindow = 3600;
$rateMax    = 10;
$rateData   = ['count' => 0, 'since' => time()];
if (file_exists($rateFile)) {
    $stored = json_decode(file_get_contents($rateFile), true);
    if (is_array($stored) && (time() - ($stored['since'] ?? 0)) < $rateWindow) {
        $rateData = $stored;
    }
}
$rateData['count']++;
file_put_contents($rateFile, json_encode($rateData), LOCK_EX);
if ($rateData['count'] > $rateMax) {
    http_response_code(429);
    echo json_encode(['success' => false, 'message' => 'Zu viele Anfragen. Bitte versuche es in einer Stunde erneut.']);
    exit;
}

// Load config
$content = load_content();
$site    = $content['site'] ?? [];
$to      = $site['email'] ?? 'marcus@flexfit-demo.at';
$siteUrl = 'FlexFit Personal Training';

// Build email
$subject = $form_type === 'probetraining'
    ? "Neue Probetraining-Anfrage von $firstname $lastname"
    : "Neue Kontaktanfrage von $firstname $lastname";

$body = "
Neue Anfrage über die FlexFit-Website
=======================================
Typ: $form_type
Name: $firstname $lastname
E-Mail: $email
Telefon: $phone
" . (!empty($interest) ? "Interesse: $interest\n" : '')
  . (!empty($goal)     ? "Ziel: $goal\n" : '')
  . (!empty($pref_date)? "Wunschtermin: $pref_date\n" : '')
  . "
Nachricht:
-----------
$message

---------------------------------------
Gesendet am: " . date('d.m.Y H:i') . "
";

$headers = [
    'From'         => "FlexFit Website <$to>",
    'Reply-To'     => "$firstname $lastname <$email>",
    'X-Mailer'     => 'FlexFit-BMS/1.0',
    'MIME-Version' => '1.0',
    'Content-Type' => 'text/plain; charset=UTF-8',
];
$headerStr = implode("\r\n", array_map(fn($k, $v) => "$k: $v", array_keys($headers), $headers));

// Save to log as backup
$logDir = __DIR__ . '/../data/submissions/';
if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
    // Protect directory
    file_put_contents($logDir . '.htaccess', "Deny from all\n");
}
$logEntry = [
    'timestamp' => date('c'),
    'type'      => $form_type,
    'name'      => "$firstname $lastname",
    'email'     => $email,
    'phone'     => $phone,
    'interest'  => $interest,
    'goal'      => $goal,
    'preferred_date' => $pref_date,
    'message'   => $message,
];
file_put_contents(
    $logDir . 'submissions.jsonl',
    json_encode($logEntry, JSON_UNESCAPED_UNICODE) . "\n",
    FILE_APPEND | LOCK_EX
);

// Send email
$sent = mail($to, $subject, $body, $headerStr);

if (!$sent) {
    // Mail delivery failed — submission is still logged, inform user to try again
    error_log('FlexFit contact.php: mail() failed for submission from ' . $ipHash);
    echo json_encode([
        'success' => false,
        'message' => 'Deine Anfrage wurde gespeichert, aber die E-Mail konnte nicht gesendet werden. Bitte kontaktiere uns direkt unter ' . htmlspecialchars($to, ENT_QUOTES, 'UTF-8') . '.',
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Danke! Wir melden uns innerhalb von 24 Stunden bei dir.',
]);
