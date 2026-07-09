<?php
/**
 * BMS Hub – Auth helpers
 */
require_once __DIR__ . '/config.php';

function bms_start_session(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_name(BMS_SESSION_NAME);
        session_set_cookie_params([
            'lifetime' => BMS_SESSION_LIFE,
            'path'     => '/',
            'secure'   => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict',
        ]);
        session_start();
    }
}

function bms_is_logged_in(): bool {
    bms_start_session();
    return !empty($_SESSION['bms_auth'])
        && $_SESSION['bms_auth'] === true
        && !empty($_SESSION['bms_user']);
}

function bms_require_auth(): void {
    if (!bms_is_logged_in()) {
        header('Location: /bms-hub/index.php?redirect=' . urlencode($_SERVER['REQUEST_URI'] ?? ''));
        exit;
    }
}

function bms_login(string $user, string $pass): bool {
    if ($user !== BMS_ADMIN_USER) return false;
    if (!password_verify($pass, BMS_ADMIN_HASH)) return false;

    bms_start_session();
    session_regenerate_id(true);
    $_SESSION['bms_auth']    = true;
    $_SESSION['bms_user']    = $user;
    $_SESSION['bms_login_at'] = time();
    return true;
}

function bms_logout(): void {
    bms_start_session();
    $_SESSION = [];
    session_destroy();
}

function bms_csrf_token(): string {
    bms_start_session();
    if (empty($_SESSION['bms_csrf'])) {
        $_SESSION['bms_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['bms_csrf'];
}

function bms_csrf_valid(): bool {
    return isset($_POST['_csrf'])
        && hash_equals(bms_csrf_token(), $_POST['_csrf']);
}
