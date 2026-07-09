<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'impressum';
require_once __DIR__ . '/includes/header.php';
$imp  = $content['_pages']['impressum']['sections']['content']['data'] ?? [];
$site = $content['site'] ?? [];
?>
<section class="page-hero">
  <div class="container"><h1>Impressum</h1></div>
</section>
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:780px">
    <div class="card"><div class="card-body" style="padding:40px">
      <h2 style="font-size:1.3rem;margin-bottom:24px">Angaben gem&auml;&szlig; &sect; 5 ECG</h2>
      <table style="width:100%;border-collapse:collapse;font-size:.95rem;margin-bottom:32px">
        <tr style="border-bottom:1px solid var(--border-light)">
          <td style="padding:10px 0;color:var(--text-muted);width:140px">Unternehmen</td>
          <td style="padding:10px 0;font-weight:600"><?= e($imp['company'] ?? '') ?></td>
        </tr>
        <tr style="border-bottom:1px solid var(--border-light)">
          <td style="padding:10px 0;color:var(--text-muted)">Inhaber</td>
          <td style="padding:10px 0"><?= e($imp['person'] ?? '') ?>, <?= e($imp['person_role'] ?? '') ?></td>
        </tr>
        <tr style="border-bottom:1px solid var(--border-light)">
          <td style="padding:10px 0;color:var(--text-muted)">Adresse</td>
          <td style="padding:10px 0"><?= nl2br(e($imp['address'] ?? '')) ?></td>
        </tr>
        <tr style="border-bottom:1px solid var(--border-light)">
          <td style="padding:10px 0;color:var(--text-muted)">Telefon</td>
          <td style="padding:10px 0"><a href="tel:+4312345678"><?= e($imp['phone'] ?? '') ?></a></td>
        </tr>
        <tr>
          <td style="padding:10px 0;color:var(--text-muted)">E-Mail</td>
          <td style="padding:10px 0"><a href="mailto:<?= e($imp['email'] ?? '') ?>"><?= e($imp['email'] ?? '') ?></a></td>
        </tr>
      </table>
      <h3 style="font-size:1.05rem;margin-bottom:12px">Haftungsausschluss</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.7;margin-bottom:24px"><?= e($imp['nutzungsbedingungen'] ?? '') ?></p>
      <h3 style="font-size:1.05rem;margin-bottom:12px">Datenschutz &amp; Analytics</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.7;margin-bottom:24px"><?= e($imp['analytics_text'] ?? '') ?> Weitere Informationen findest du in unserer <a href="/datenschutz.php" style="color:var(--gold)">Datenschutzerkl&auml;rung</a>.</p>
      <h3 style="font-size:1.05rem;margin-bottom:12px">Urheberrecht</h3>
      <p style="color:var(--text-secondary);font-size:.92rem;line-height:1.7">Die auf dieser Website ver&ouml;ffentlichten Inhalte sind durch das &ouml;sterreichische Urheberrecht gesch&uuml;tzt.</p>
    </div></div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
