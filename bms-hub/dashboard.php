<?php
require_once __DIR__ . '/auth.php';
bms_require_auth();
require_once __DIR__ . '/config.php';
require_once BMS_ROOT . '/includes/functions.php';

$content = load_content();
$page = 'dashboard';
include __DIR__ . '/partials/admin-header.php';
?>

<div class="admin-page-header">
  <div>
    <h1>Dashboard</h1>
    <p>Willkommen zurück! Verwalte hier alle Inhalte von <?= htmlspecialchars(BMS_SITE_NAME) ?>.</p>
  </div>
  <a href="/probetraining.php" target="_blank" class="admin-btn admin-btn-outline">🌐 Website ansehen</a>
</div>

<!-- QUICK STATS -->
<div class="admin-grid admin-grid-4">
  <div class="admin-card admin-stat-card">
    <div class="admin-stat-icon">📝</div>
    <div class="admin-stat-val"><?= count($content['services'] ?? []) ?></div>
    <div class="admin-stat-label">Leistungen</div>
  </div>
  <div class="admin-card admin-stat-card">
    <div class="admin-stat-icon">💬</div>
    <div class="admin-stat-val"><?= count($content['testimonials'] ?? []) ?></div>
    <div class="admin-stat-label">Testimonials</div>
  </div>
  <div class="admin-card admin-stat-card">
    <div class="admin-stat-icon">⭐</div>
    <div class="admin-stat-val"><?= htmlspecialchars($content['hero']['rating'] ?? '4.9') ?></div>
    <div class="admin-stat-label">Google Rating</div>
  </div>
  <div class="admin-card admin-stat-card">
    <div class="admin-stat-icon">📅</div>
    <div class="admin-stat-val"><?= htmlspecialchars($content['meta']['last_updated'] ?? date('Y-m-d')) ?></div>
    <div class="admin-stat-label">Zuletzt aktualisiert</div>
  </div>
</div>

<!-- QUICK ACTIONS -->
<div class="admin-section">
  <h2 class="admin-section-title">Schnellzugriff</h2>
  <div class="admin-grid admin-grid-3">
    <?php
    $sections = [
      ['url'=>'content-editor.php?section=hero',         'icon'=>'🖼️', 'title'=>'Hero-Bereich',      'desc'=>'Headline, Subheadline, CTAs, Preishinweis'],
      ['url'=>'content-editor.php?section=services',     'icon'=>'💪', 'title'=>'Leistungen',         'desc'=>'Personal Training, Kleingruppe, Firmenfitness'],
      ['url'=>'content-editor.php?section=trainer',      'icon'=>'👤', 'title'=>'Trainer / Team',     'desc'=>'Profilbild, Bio, Spezialisierungen'],
      ['url'=>'content-editor.php?section=testimonials', 'icon'=>'⭐', 'title'=>'Testimonials',       'desc'=>'Google-Bewertungen verwalten'],
      ['url'=>'content-editor.php?section=site',         'icon'=>'⚙️', 'title'=>'Allgemeine Infos',   'desc'=>'Kontakt, Adresse, Öffnungszeiten'],
      ['url'=>'content-editor.php?section=seo',          'icon'=>'🔍', 'title'=>'SEO & Meta',         'desc'=>'Titles, Descriptions, Keywords'],
    ];
    foreach ($sections as $s): ?>
    <a href="<?= htmlspecialchars($s['url']) ?>" class="admin-card admin-action-card">
      <div class="admin-action-icon"><?= $s['icon'] ?></div>
      <div>
        <div class="admin-action-title"><?= htmlspecialchars($s['title']) ?></div>
        <div class="admin-action-desc"><?= htmlspecialchars($s['desc']) ?></div>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
</div>

<!-- RECENT SUBMISSIONS -->
<?php
$subFile = BMS_DATA . '/submissions/submissions.jsonl';
$submissions = [];
if (file_exists($subFile)) {
    $lines = array_filter(explode("\n", file_get_contents($subFile)));
    $submissions = array_map('json_decode', array_slice(array_reverse($lines), 0, 5));
}
?>
<?php if (!empty($submissions)): ?>
<div class="admin-section">
  <h2 class="admin-section-title">Letzte Kontaktanfragen</h2>
  <div class="admin-card">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Datum</th>
          <th>Name</th>
          <th>E-Mail</th>
          <th>Typ</th>
          <th>Interesse</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($submissions as $sub): if (!$sub) continue; ?>
        <tr>
          <td><?= htmlspecialchars(date('d.m.Y H:i', strtotime($sub->timestamp ?? ''))) ?></td>
          <td><?= htmlspecialchars($sub->name ?? '') ?></td>
          <td><a href="mailto:<?= htmlspecialchars($sub->email ?? '') ?>"><?= htmlspecialchars($sub->email ?? '') ?></a></td>
          <td><span class="admin-badge"><?= htmlspecialchars($sub->type ?? '') ?></span></td>
          <td><?= htmlspecialchars($sub->interest ?? $sub->goal ?? '–') ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/partials/admin-footer.php'; ?>
