<?php
require_once __DIR__ . '/auth.php';
bms_require_auth();
require_once __DIR__ . '/config.php';
$page = 'settings';
$msg = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && bms_csrf_valid()) {
    $old  = $_POST['old_password']  ?? '';
    $new1 = $_POST['new_password']  ?? '';
    $new2 = $_POST['new_password2'] ?? '';

    if (!password_verify($old, BMS_ADMIN_HASH)) {
        $error = 'Aktuelles Passwort ist falsch.';
    } elseif (strlen($new1) < 8) {
        $error = 'Neues Passwort muss mindestens 8 Zeichen lang sein.';
    } elseif ($new1 !== $new2) {
        $error = 'Die neuen Passwörter stimmen nicht überein.';
    } else {
        $hash = password_hash($new1, PASSWORD_BCRYPT, ['cost' => 12]);
        // Update config file
        $cfgPath = __DIR__ . '/config.php';
        $cfg = file_get_contents($cfgPath);
        $cfg = preg_replace(
            "/define\('BMS_ADMIN_HASH',\s*'[^']*'\)/",
            "define('BMS_ADMIN_HASH', '$hash')",
            $cfg
        );
        if (file_put_contents($cfgPath, $cfg)) {
            $msg = 'Passwort wurde erfolgreich geändert!';
        } else {
            $error = 'Konnte config.php nicht schreiben. Bitte manuell ändern.';
        }
    }
}

include __DIR__ . '/partials/admin-header.php';
?>
<div class="admin-page-header">
  <div><h1>🔒 Passwort ändern</h1><p>Ändere hier das Admin-Passwort.</p></div>
</div>
<?php if ($msg): ?><div class="admin-alert admin-alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
<?php if ($error): ?><div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<div class="admin-card" style="max-width:480px">
  <form method="POST">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars(bms_csrf_token()) ?>">
    <div class="admin-form-group">
      <label class="admin-label">Aktuelles Passwort</label>
      <input class="admin-input" type="password" name="old_password" required autocomplete="current-password">
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Neues Passwort</label>
      <input class="admin-input" type="password" name="new_password" required autocomplete="new-password" minlength="8">
      <span class="admin-hint">Mindestens 8 Zeichen</span>
    </div>
    <div class="admin-form-group">
      <label class="admin-label">Neues Passwort wiederholen</label>
      <input class="admin-input" type="password" name="new_password2" required autocomplete="new-password">
    </div>
    <button type="submit" class="admin-btn admin-btn-primary">Passwort speichern</button>
  </form>
</div>
<?php include __DIR__ . '/partials/admin-footer.php'; ?>
