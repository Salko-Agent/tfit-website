<?php
/**
 * FlexFit – Webhook Receiver
 * Called by Zentra CMS after content save
 * Fetches latest content from API and writes to data/content.json
 */

// ── CONFIG ─────────────────────────────────────────────────
$ZENTRA_API  = getenv('ZENTRA_API_URL') ?: 'https://api.your-cms-service.com/content.php';
$PROJECT_KEY = 'flexfit';
$API_KEY     = getenv('ZENTRA_API_KEY') ?: 'sf_demo_api_key_placeholder'; // Must match DB
$HMAC_SECRET = $API_KEY; // Zentra signs with the same api_key

header('Content-Type: application/json; charset=utf-8');

// ── VERIFY REQUEST ────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'POST only']);
    exit;
}

// Verify HMAC signature from Zentra
$raw_body  = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_ZENTRA_SIG'] ?? '';

if ($signature !== '' && $HMAC_SECRET !== '') {
    $expected = hash_hmac('sha256', $raw_body, $HMAC_SECRET);
    if (!hash_equals($expected, $signature)) {
        http_response_code(403);
        echo json_encode(['ok' => false, 'error' => 'Invalid signature']);
        exit;
    }
}

// ── FETCH CONTENT FROM ZENTRA API ──────────────────────────
$url = $ZENTRA_API . '?' . http_build_query([
    'project' => $PROJECT_KEY,
    'key'     => $API_KEY,
]);

$ctx = stream_context_create([
    'http' => [
        'method'  => 'GET',
        'timeout' => 10,
        'header'  => 'Accept: application/json',
    ],
    'ssl' => [
        'verify_peer' => true,
    ],
]);

$response = @file_get_contents($url, false, $ctx);

if ($response === false) {
    http_response_code(502);
    echo json_encode(['ok' => false, 'error' => 'Failed to fetch from Zentra API']);
    exit;
}

$content = json_decode($response, true);
if (!is_array($content) || empty($content['pages'])) {
    http_response_code(502);
    echo json_encode(['ok' => false, 'error' => 'Invalid API response']);
    exit;
}

// ── WRITE content.json ────────────────────────────────────
$target = __DIR__ . '/data/content.json';
$json   = json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

// Atomic write: write to temp file first, then rename
$tmp = $target . '.tmp';
if (file_put_contents($tmp, $json) === false) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Failed to write temp file']);
    exit;
}

if (!rename($tmp, $target)) {
    @unlink($tmp);
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Failed to rename']);
    exit;
}

// ── SUCCESS ────────────────────────────────────────────────
$page_count   = count($content['pages'] ?? []);
$section_count = 0;
foreach ($content['pages'] as $p) {
    $section_count += count($p['sections'] ?? []);
}

echo json_encode([
    'ok'       => true,
    'pages'    => $page_count,
    'sections' => $section_count,
    'bytes'    => strlen($json),
    'ts'       => date('c'),
]);
