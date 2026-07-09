<?php
/**
 * BMS Hub – Admin Configuration
 * BMS Projekte
 *
 * ⚠️  Change the credentials below before deploying!
 * Generate a new password hash with: php -r "echo password_hash('YourPassword', PASSWORD_BCRYPT);"
 */

// Admin credentials
define('BMS_ADMIN_USER',     'admin');
define('BMS_ADMIN_HASH',     getenv('BMS_ADMIN_HASH') ?: '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uXhHJC0OS'); // Default password hash for 'flexfit2024'
// Default password: "flexfit2024" — CHANGE THIS IMMEDIATELY!

// Session config
define('BMS_SESSION_NAME',   'bms_session');
define('BMS_SESSION_LIFE',   3600 * 8); // 8 hours

// Paths
define('BMS_ROOT',    dirname(__DIR__));
define('BMS_DATA',    BMS_ROOT . '/data');
define('BMS_CONTENT', BMS_DATA . '/content.json');

// Site name (for admin panel)
define('BMS_SITE_NAME', 'FlexFit Personal Training');
define('BMS_VERSION',   '1.0.0');
