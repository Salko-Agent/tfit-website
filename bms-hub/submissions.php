<?php
require_once __DIR__ . '/auth.php';
bms_require_auth();
require_once __DIR__ . '/config.php';
require_once BMS_ROOT . '/includes/functions.php';
$page = 'submissions';
include __DIR__ . '/partials/admin-header.php';

$subFile = BMS_DATA . '/submissions/submissions.jsonl';
$submissions = [];
if (file_exists($subFile)) {
    $lines = array_filter(array_map('trim', explode("\n", file_get_contents($subFile))));
    foreach (array_reverse($lines) as $line) {
        $obj = json_decode($line);
        if ($obj) $submissions[] = $obj;
    }
}
?>
<div class="admin-page-header">
  <div>
    <h1>📬 Kontaktanfragen</h1>
    <p><?= count($submissions) ?> Anfragen gesamt</p>
  </div>
</div>

<?php if (empty($submissions)): ?>
<div class="admin-alert admin-alert-info">Noch keine Anfragen eingegangen.</div>
<?php else: ?>
<div class="admin-card">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Datum</th>
        <th>Name</th>
        <th>E-Mail</th>
        <th>Telefon</th>
        <th>Typ</th>
        <th>Ziel / Interesse</th>
        <th>Nachricht</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($submissions as $sub): ?>
      <tr>
        <td style="white-space:nowrap"><?= htmlspecialchars(date('d.m.Y H:i', strtotime($sub->timestamp ?? ''))) ?></td>
        <td><?= htmlspecialchars($sub->name ?? '') ?></td>
        <td><a href="mailto:<?= htmlspecialchars($sub->email ?? '') ?>"><?= htmlspecialchars($sub->email ?? '') ?></a></td>
        <td><?= htmlspecialchars($sub->phone ?? '–') ?></td>
        <td><span class="admin-badge"><?= htmlspecialchars($sub->type ?? '') ?></span></td>
        <td><?= htmlspecialchars($sub->interest ?? $sub->goal ?? '–') ?></td>
        <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="<?= htmlspecialchars($sub->message ?? '') ?>">
          <?= htmlspecialchars(substr($sub->message ?? '', 0, 80)) ?><?= strlen($sub->message ?? '') > 80 ? '…' : '' ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endif; ?>

<?php include __DIR__ . '/partials/admin-footer.php'; ?>
