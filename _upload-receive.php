<?php
/**
 * FlexFit – Upload Receiver
 * Called by Zentra CMS after converting an image to WebP.
 * Stores the file in assets/uploads/ and returns the public URL.
 */

// ── CONFIG ─────────────────────────────────────────────────
$API_KEY    = getenv('ZENTRA_API_KEY') ?: 'sf_demo_api_key_placeholder'; // Must match DB api_key
$UPLOAD_DIR = __DIR__ . '/assets/uploads/';
$UPLOAD_URL = getenv('UPLOAD_URL') ?: '/assets/uploads/';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'POST only']);
    exit;
}

// Verify API key
$provided_key = $_POST['key'] ?? '';
if ($API_KEY === '' || !hash_equals($API_KEY, $provided_key)) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Invalid key']);
    exit;
}

// Check uploaded file
if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'No file']);
    exit;
}

$file = $_FILES['file'];

// Validate MIME — only WebP accepted from Zentra
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime  = $finfo->file($file['tmp_name']);
if ($mime !== 'image/webp') {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Only WebP images accepted']);
    exit;
}

// Max 10 MB
if ($file['size'] > 10 * 1024 * 1024) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'File too large']);
    exit;
}

// Sanitize filename
$filename = preg_replace('/[^a-zA-Z0-9_\-.]/', '_', basename($file['name']));
if (!str_ends_with($filename, '.webp')) {
    $filename .= '.webp';
}

// Create upload dir
if (!is_dir($UPLOAD_DIR)) {
    mkdir($UPLOAD_DIR, 0755, true);
    // Protect from PHP execution
    file_put_contents($UPLOAD_DIR . '.htaccess',
        "Options -ExecCGI\nAddHandler cgi-script .php .php3 .php4 .phtml .pl .py .jsp .asp\n");
}

$dest = $UPLOAD_DIR . $filename;
if (!move_uploaded_file($file['tmp_name'], $dest)) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Write failed']);
    exit;
}

echo json_encode(['ok' => true, 'url' => $UPLOAD_URL . $filename]);
