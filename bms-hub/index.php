<?php
/**
 * BMS Hub – Login Page
 * Admin URL: /bms-hub/
 */
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/config.php';

bms_start_session();

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    bms_logout();
    header('Location: /bms-hub/index.php?msg=logout');
    exit;
}

// Redirect if already logged in
if (bms_is_logged_in()) {
    header('Location: /bms-hub/dashboard.php');
    exit;
}

// Handle login attempt
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!bms_csrf_valid()) {
        $error = 'Ungültiger Token. Bitte Seite neu laden.';
    } else {
        $user = trim($_POST['username'] ?? '');
        $pass = $_POST['password'] ?? '';
        if (bms_login($user, $pass)) {
            $redirect = urldecode($_GET['redirect'] ?? '/bms-hub/dashboard.php');
            // Security: only allow relative redirects
            if (!str_starts_with($redirect, '/')) $redirect = '/bms-hub/dashboard.php';
            header("Location: $redirect");
            exit;
        } else {
            sleep(1); // Slow down brute force
            $error = 'Ungültiger Benutzername oder Passwort.';
        }
    }
}

$msg = $_GET['msg'] ?? '';
$csrf = bms_csrf_token();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BMS Hub – <?= htmlspecialchars(BMS_SITE_NAME) ?></title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --gold: #C8963C;
      --dark: #111;
      --border: #2E2E2E;
      --surface: rgba(20,20,20,.85);
    }
    body {
      font-family: 'Inter', system-ui, sans-serif;
      background: #050505;
      color: #E8E8E8;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      overflow: hidden;
      position: relative;
    }

    /* ─── Lava Lamp Background ─────────────────────────────── */
    .lava-bg {
      position: fixed;
      inset: 0;
      z-index: 0;
      overflow: hidden;
      background: #050505;
    }
    .lava-blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.55;
      will-change: transform;
    }
    .lava-blob-1 {
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, #C8963C 0%, #8B5E1A 40%, transparent 70%);
      top: -10%;
      left: -5%;
      animation: lava-drift-1 18s ease-in-out infinite;
    }
    .lava-blob-2 {
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, #E8B050 0%, #C8963C 35%, transparent 70%);
      bottom: -8%;
      right: -5%;
      animation: lava-drift-2 22s ease-in-out infinite;
    }
    .lava-blob-3 {
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, #D4A04A 0%, #7A4E15 40%, transparent 70%);
      top: 50%;
      left: 55%;
      transform: translate(-50%, -50%);
      animation: lava-drift-3 25s ease-in-out infinite;
    }
    .lava-blob-4 {
      width: 280px;
      height: 280px;
      background: radial-gradient(circle, #F0C66E 0%, #A0701E 35%, transparent 70%);
      top: 15%;
      right: 15%;
      animation: lava-drift-4 20s ease-in-out infinite;
    }
    .lava-blob-5 {
      width: 320px;
      height: 320px;
      background: radial-gradient(circle, #B8862C 0%, #6B4510 40%, transparent 70%);
      bottom: 20%;
      left: 10%;
      animation: lava-drift-5 23s ease-in-out infinite;
    }

    @keyframes lava-drift-1 {
      0%, 100% { transform: translate(0, 0) scale(1); }
      25% { transform: translate(120px, 80px) scale(1.15); }
      50% { transform: translate(60px, 180px) scale(0.9); }
      75% { transform: translate(-40px, 100px) scale(1.1); }
    }
    @keyframes lava-drift-2 {
      0%, 100% { transform: translate(0, 0) scale(1); }
      25% { transform: translate(-100px, -60px) scale(1.1); }
      50% { transform: translate(-160px, -120px) scale(0.85); }
      75% { transform: translate(-60px, -180px) scale(1.05); }
    }
    @keyframes lava-drift-3 {
      0%, 100% { transform: translate(-50%, -50%) scale(1); }
      20% { transform: translate(-40%, -60%) scale(1.2); }
      40% { transform: translate(-60%, -40%) scale(0.8); }
      60% { transform: translate(-55%, -55%) scale(1.15); }
      80% { transform: translate(-45%, -45%) scale(0.9); }
    }
    @keyframes lava-drift-4 {
      0%, 100% { transform: translate(0, 0) scale(1); }
      30% { transform: translate(-80px, 100px) scale(1.2); }
      60% { transform: translate(-120px, 40px) scale(0.85); }
      80% { transform: translate(-30px, 60px) scale(1.1); }
    }
    @keyframes lava-drift-5 {
      0%, 100% { transform: translate(0, 0) scale(1); }
      25% { transform: translate(100px, -60px) scale(1.1); }
      50% { transform: translate(50px, -120px) scale(0.9); }
      75% { transform: translate(140px, -40px) scale(1.15); }
    }

    /* ─── Login Card ───────────────────────────────────────── */
    .login-card {
      width: 100%;
      max-width: 400px;
      background: var(--surface);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 16px;
      padding: 48px 40px;
      position: relative;
      z-index: 1;
      box-shadow: 0 25px 60px rgba(0,0,0,.5);
    }
    .login-logo {
      text-align: center;
      margin-bottom: 32px;
    }
    .login-logo-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 56px;
      height: 56px;
      background: rgba(200,150,60,.15);
      border: 1px solid rgba(200,150,60,.3);
      border-radius: 12px;
      font-size: 1.6rem;
      margin-bottom: 16px;
    }
    .login-title {
      font-size: 1.4rem;
      font-weight: 700;
      color: #FFF;
      margin-bottom: 4px;
    }
    .login-subtitle {
      font-size: 0.8rem;
      color: rgba(255,255,255,.4);
      letter-spacing: 0.06em;
    }
    .form-group { margin-bottom: 20px; }
    .form-label {
      display: block;
      font-size: 0.78rem;
      font-weight: 600;
      color: rgba(255,255,255,.5);
      text-transform: uppercase;
      letter-spacing: 0.06em;
      margin-bottom: 8px;
    }
    .form-input {
      width: 100%;
      padding: 12px 16px;
      background: rgba(255,255,255,.05);
      border: 1.5px solid rgba(255,255,255,.1);
      border-radius: 8px;
      font-size: 0.95rem;
      color: #FFF;
      font-family: inherit;
      outline: none;
      transition: border-color .2s, background .2s;
    }
    .form-input:focus { border-color: var(--gold); background: rgba(255,255,255,.08); }
    .form-input::placeholder { color: rgba(255,255,255,.25); }
    .btn-login {
      width: 100%;
      padding: 14px;
      background: var(--gold);
      color: #FFF;
      border: none;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 700;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      cursor: pointer;
      font-family: inherit;
      transition: background .2s, transform .15s;
      margin-top: 8px;
    }
    .btn-login:hover { background: #E8B050; transform: translateY(-1px); }
    .btn-login:active { transform: translateY(0); }
    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      font-size: 0.85rem;
      margin-bottom: 20px;
      backdrop-filter: blur(8px);
    }
    .alert-error { background: rgba(239,68,68,.15); border: 1px solid rgba(239,68,68,.3); color: #FCA5A5; }
    .alert-success { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.3); color: #86EFAC; }
    .login-footer {
      text-align: center;
      margin-top: 32px;
      font-size: 0.72rem;
      color: rgba(255,255,255,.2);
    }
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.8rem;
      color: rgba(255,255,255,.35);
      margin-bottom: 32px;
      transition: color .2s;
      text-decoration: none;
    }
    .back-link:hover { color: var(--gold); }

    /* ─── Responsive ───────────────────────────────────────── */
    @media (max-width: 480px) {
      .login-card { padding: 36px 24px; }
      .lava-blob { filter: blur(60px); opacity: 0.4; }
    }
  </style>
</head>
<body>
  <!-- Lava Lamp Background -->
  <div class="lava-bg">
    <div class="lava-blob lava-blob-1"></div>
    <div class="lava-blob lava-blob-2"></div>
    <div class="lava-blob lava-blob-3"></div>
    <div class="lava-blob lava-blob-4"></div>
    <div class="lava-blob lava-blob-5"></div>
  </div>

  <div class="login-card">
    <a href="/" class="back-link">← Zurück zur Website</a>

    <div class="login-logo">
      <div class="login-logo-icon">⚡</div>
      <div class="login-title">BMS Hub</div>
      <div class="login-subtitle"><?= htmlspecialchars(BMS_SITE_NAME) ?></div>
    </div>

    <?php if ($error): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($msg === 'logout'): ?>
    <div class="alert alert-success">Du wurdest erfolgreich abgemeldet.</div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

      <div class="form-group">
        <label class="form-label" for="username">Benutzername</label>
        <input
          class="form-input"
          id="username"
          name="username"
          type="text"
          autocomplete="username"
          required
          autofocus
        >
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Passwort</label>
        <input
          class="form-input"
          id="password"
          name="password"
          type="password"
          autocomplete="current-password"
          required
        >
      </div>

      <button type="submit" class="btn-login">Anmelden</button>
    </form>

    <div class="login-footer">
      BMS Hub v<?= BMS_VERSION ?> · BMS Projekte<br>
      Standard-Login: admin / flexfit2024 (bitte ändern!)
    </div>
  </div>
</body>
</html>
