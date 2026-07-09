<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BMS Hub – <?= htmlspecialchars(BMS_SITE_NAME) ?></title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  <link rel="stylesheet" href="/bms-hub/assets/css/admin.css">
</head>
<body>
<div class="admin-layout">

  <!-- SIDEBAR -->
  <aside class="admin-sidebar">
    <div class="admin-sidebar-top">
      <div class="admin-brand">
        <div class="admin-brand-icon">⚡</div>
        <div>
          <div class="admin-brand-name">BMS Hub</div>
          <div class="admin-brand-site"><?= htmlspecialchars(BMS_SITE_NAME) ?></div>
        </div>
      </div>
    </div>

    <nav class="admin-nav">
      <div class="admin-nav-group">
        <div class="admin-nav-label">Übersicht</div>
        <a href="/bms-hub/dashboard.php" class="admin-nav-link <?= ($page ?? '') === 'dashboard' ? 'active' : '' ?>">
          <span>📊</span> Dashboard
        </a>
      </div>

      <div class="admin-nav-group">
        <div class="admin-nav-label">Inhalte</div>
        <a href="/bms-hub/content-editor.php?section=hero" class="admin-nav-link <?= (($page ?? '') === 'content' && ($_GET['section'] ?? '') === 'hero') ? 'active' : '' ?>">
          <span>🖼️</span> Hero-Bereich
        </a>
        <a href="/bms-hub/content-editor.php?section=site" class="admin-nav-link">
          <span>⚙️</span> Allgemeine Infos
        </a>
        <a href="/bms-hub/content-editor.php?section=services" class="admin-nav-link">
          <span>💪</span> Leistungen
        </a>
        <a href="/bms-hub/content-editor.php?section=trainer" class="admin-nav-link">
          <span>👤</span> Trainer / Team
        </a>
        <a href="/bms-hub/content-editor.php?section=testimonials" class="admin-nav-link">
          <span>⭐</span> Testimonials
        </a>
        <a href="/bms-hub/content-editor.php?section=stats" class="admin-nav-link">
          <span>📈</span> Statistiken
        </a>
        <a href="/bms-hub/content-editor.php?section=seo" class="admin-nav-link">
          <span>🔍</span> SEO & Meta
        </a>
      </div>

      <div class="admin-nav-group">
        <div class="admin-nav-label">Anfragen</div>
        <a href="/bms-hub/submissions.php" class="admin-nav-link">
          <span>📬</span> Kontaktanfragen
        </a>
      </div>

      <div class="admin-nav-group">
        <div class="admin-nav-label">System</div>
        <a href="/bms-hub/change-password.php" class="admin-nav-link">
          <span>🔒</span> Passwort ändern
        </a>
        <a href="/bms-hub/index.php?action=logout" class="admin-nav-link">
          <span>🚪</span> Abmelden
        </a>
      </div>
    </nav>

    <div class="admin-sidebar-footer">
      <div class="admin-sidebar-user">
        <div class="admin-user-avatar"><?= strtoupper(substr($_SESSION['bms_user'] ?? 'A', 0, 1)) ?></div>
        <div>
          <div class="admin-user-name"><?= htmlspecialchars($_SESSION['bms_user'] ?? 'Admin') ?></div>
          <div class="admin-user-role">Administrator</div>
        </div>
      </div>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="admin-main">
    <?php if (!empty($_GET['saved'])): ?>
    <div class="admin-alert admin-alert-success">✅ Änderungen wurden erfolgreich gespeichert.</div>
    <?php endif; ?>
    <?php if (!empty($_GET['error'])): ?>
    <div class="admin-alert admin-alert-error">❌ <?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
