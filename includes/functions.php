<?php
/**
 * FlexFit - Core Functions
 * BMS Projekte
 */

// ── Zentra Live Preview ───────────────────────────────────────
if (!defined('SF_ZENTRA_API'))     define('SF_ZENTRA_API',     getenv('ZENTRA_API_URL') ?: 'https://api.your-cms-service.com/content.php');
if (!defined('SF_ZENTRA_PROJECT')) define('SF_ZENTRA_PROJECT', 'flexfit');
if (!defined('SF_ZENTRA_API_KEY')) define('SF_ZENTRA_API_KEY', getenv('ZENTRA_API_KEY') ?: 'sf_demo_api_key_placeholder');

/**
 * Validate a Zentra preview token (HMAC-SHA256 signed with api_key, 1-h buckets).
 * Accepts tokens for the current hour and the previous hour (clock-drift tolerance).
 */
function sf_validate_preview_token(string $token): bool {
    if (strlen($token) !== 64) return false;
    for ($i = 0; $i <= 1; $i++) {
        $bucket   = (string)(floor(time() / 3600) - $i);
        $expected = hash_hmac('sha256', 'zentra-preview:' . $bucket, SF_ZENTRA_API_KEY);
        if (hash_equals($expected, $token)) return true;
    }
    return false;
}

/**
 * Fetch latest content directly from the Zentra API (bypasses content.json cache).
 * Falls back to local content.json if the API is unreachable.
 */
function sf_fetch_from_zentra(): array {
    $url = SF_ZENTRA_API . '?' . http_build_query([
        'project' => SF_ZENTRA_PROJECT,
        'key'     => SF_ZENTRA_API_KEY,
    ]);
    $ctx = stream_context_create([
        'http' => [
            'method'  => 'GET',
            'timeout' => 8,
            'header'  => "Accept: application/json\r\n",
        ],
        'ssl' => ['verify_peer' => true],
    ]);
    $response = @file_get_contents($url, false, $ctx);
    if ($response === false) {
        $path = __DIR__ . '/../data/content.json';
        if (!file_exists($path)) return [];
        return json_decode(file_get_contents($path), true) ?? [];
    }
    return json_decode($response, true) ?? [];
}

// Load content from JSON (raw structure - used by CMS)
// In preview mode (?_preview=TOKEN): fetches fresh from Zentra API instead of file.
function load_content(): array {
    $token = $_GET['_preview'] ?? '';
    if ($token !== '' && sf_validate_preview_token($token)) {
        return sf_fetch_from_zentra();
    }
    $path = __DIR__ . '/../data/content.json';
    if (!file_exists($path)) return [];
    $json = file_get_contents($path);
    return json_decode($json, true) ?? [];
}

// Load content flattened for frontend pages (mirrors server.py load())
function load_flat_content(): array {
    $raw   = load_content();
    $pages = $raw['pages'] ?? [];
    $h     = $pages['home']['sections'] ?? [];

    $sd = function(string $k) use ($h): array { return $h[$k]['data'] ?? []; };
    $si = function(string $k) use ($sd): array { return $sd($k)['items'] ?? []; };

    // Build seo map keyed by page slug
    $seo = [];
    foreach ($pages as $slug => $page) {
        $seo[$slug] = $page['seo'] ?? [];
    }

    return [
        'site'           => $raw['site'] ?? [],
        'seo'            => $seo,
        'hero'           => $sd('hero'),
        'stats'          => $si('stats'),
        'partners'       => $si('partners'),
        'why'            => $sd('why'),
        'services'       => $si('services'),
        'trainer'        => $sd('trainer'),
        'benefits'       => $sd('benefits'),
        'testimonials'   => $si('testimonials'),
        '_pt'            => $pages['personal_training']['sections'] ?? [],
        '_ff'            => $pages['firmenfitness']['sections']    ?? [],
        '_physio'        => $pages['physiotherapie']['sections']   ?? [],
        '_studio'        => $pages['studio']['sections']           ?? [],
        '_team'          => $pages['team']['sections']             ?? [],
        '_blog'          => $pages['blog']['sections']             ?? [],
        '_kontakt'       => $pages['kontakt']['sections']          ?? [],
        '_probetraining' => $pages['probetraining']['sections']    ?? [],
        '_pages'         => $pages,
    ];
}

// Save content to JSON
function save_content(array $data): bool {
    $path = __DIR__ . '/../data/content.json';
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return file_put_contents($path, $json) !== false;
}

// Get nested content value safely
function content_get(array $data, string $path, mixed $default = ''): mixed {
    $keys = explode('.', $path);
    $current = $data;
    foreach ($keys as $key) {
        if (!isset($current[$key])) return $default;
        $current = $current[$key];
    }
    return $current;
}

// Escape for HTML output
function e(mixed $str): string {
    return htmlspecialchars((string)$str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Escape for HTML but allow <br> tags (for CMS headlines with line breaks)
function he(mixed $str): string {
    return str_replace(['&lt;br&gt;', '&lt;br /&gt;', '&lt;br/&gt;'], '<br>', e($str));
}

// Generate star HTML
function stars(int $count = 5): string {
    return str_repeat('<span class="star">&#9733;</span>', $count);
}

// Get base URL (works locally and on server)
function base_url(): string {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script = dirname($_SERVER['SCRIPT_NAME'] ?? '');
    return rtrim($protocol . '://' . $host . $script, '/');
}

// Current page slug
function current_page(): string {
    $script = basename($_SERVER['SCRIPT_NAME'] ?? '', '.php');
    return $script === 'index' ? 'home' : $script;
}

// Active nav class
function nav_active(string $page): string {
    return current_page() === $page ? ' active' : '';
}

// Format phone for tel link
function tel(string $phone): string {
    return 'tel:' . preg_replace('/[^+\d]/', '', $phone);
}

// SVG icons
function icon(string $name): string {
    $icons = [
        'arrow-right' => '<svg class="btn-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8h10M8 3l5 5-5 5"/></svg>',
        'check'       => '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 8l4 4 6-7"/></svg>',
        'star'        => '<svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1l2.1 4.3 4.7.7-3.4 3.3.8 4.7L8 11.7l-4.2 2.3.8-4.7L1.2 6l4.7-.7L8 1z"/></svg>',
        'location'    => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/></svg>',
        'mail'        => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4V4zm0 0l8 8 8-8"/></svg>',
        'clock'       => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
        'phone'       => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2C6.7 21 3 17.3 3 6a2 2 0 012-2z"/></svg>',
        'instagram'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>',
        'facebook'    => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z"/></svg>',
        'menu'        => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>',
        'close'       => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',
        'google'      => '<svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>',
    ];
    return $icons[$name] ?? '';
}

// Simple CSRF token
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_valid(): bool {
    return isset($_POST['csrf_token']) && hash_equals(csrf_token(), $_POST['csrf_token']);
}

// ─── Blog Articles ──────────────────────────────────────────

/**
 * Load all blog articles from individual JSON files.
 * Returns array keyed by slug, sorted by date descending.
 */
function load_articles(): array {
    $dir = __DIR__ . '/../data/articles';
    if (!is_dir($dir)) return [];

    $articles = [];
    foreach (glob($dir . '/*.json') as $file) {
        $slug = basename($file, '.json');
        $data = json_decode(file_get_contents($file), true);
        if ($data) {
            $articles[$slug] = $data;
        }
    }

    // Sort by date descending (DD.MM.YYYY format)
    uasort($articles, function ($a, $b) {
        $da = DateTime::createFromFormat('d.m.Y', $a['date'] ?? '01.01.2000');
        $db = DateTime::createFromFormat('d.m.Y', $b['date'] ?? '01.01.2000');
        return $db <=> $da;
    });

    return $articles;
}

/**
 * Load a single blog article by slug.
 * Returns article array or null if not found.
 */
function load_article(string $slug): ?array {
    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
    $file = __DIR__ . '/../data/articles/' . $slug . '.json';
    if (!file_exists($file)) return null;
    return json_decode(file_get_contents($file), true);
}

/**
 * Save a blog article (create or update).
 */
function save_article(string $slug, array $data): bool {
    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
    $dir  = __DIR__ . '/../data/articles';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return file_put_contents($dir . '/' . $slug . '.json', $json) !== false;
}

/**
 * Delete a blog article.
 */
function delete_article(string $slug): bool {
    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
    $file = __DIR__ . '/../data/articles/' . $slug . '.json';
    if (file_exists($file)) return unlink($file);
    return false;
}

// ─── Trainer Profiles ──────────────────────────────────────────

/**
 * Load all trainer profiles from individual JSON files.
 */
function load_trainers(): array {
    $dir = __DIR__ . '/../data/trainers';
    if (!is_dir($dir)) return [];
    $trainers = [];
    foreach (glob($dir . '/*.json') as $file) {
        $slug = basename($file, '.json');
        $data = json_decode(file_get_contents($file), true);
        if ($data) $trainers[$slug] = $data;
    }
    return $trainers;
}

/**
 * Load a single trainer profile by slug.
 */
function load_trainer(string $slug): ?array {
    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
    $file = __DIR__ . '/../data/trainers/' . $slug . '.json';
    if (!file_exists($file)) return null;
    return json_decode(file_get_contents($file), true);
}
