<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'home';
$content['seo']['home']['title']       = 'Presse – Marcus Muster | FlexFit Personal Training Wien';
$content['seo']['home']['description'] = 'Marcus Muster in Medien: Zukunft der Medizin, Heute Tageszeitung, Gesundheitstrends, Netdoktor Magazin, Medizin Populär.';
$site = $content['site'] ?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px">Medien &amp; Presse</span>
    <h1>Presse</h1>
    <p style="max-width:700px;margin:20px auto 0;color:rgba(255,255,255,.75);font-size:1rem;line-height:1.7">
      Marcus Muster – Sportwissenschafter, staatl. gepr. Fitness Trainer &amp; Gründer von FlexFit
    </p>
  </div>
</section>

<!-- INTRO -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:780px">
    <div class="card reveal">
      <div class="card-body" style="padding:40px">
        <p style="font-size:1.05rem;color:var(--text-secondary);line-height:1.8">
          Es freut mich sehr, mein Fachwissen in diversen Medien und Artikeln der breiten Bevölkerung zugänglich zu machen.
          Damit das Wissen um die lebenswichtigen Auswirkungen eines gesunden Lebensstils, insbesondere von Sport und Bewegung,
          auch wirklich jeden erreichen können. Hier ein kleiner Auszug, viel Spaß:
        </p>
      </div>
    </div>
  </div>
</section>

<!-- PRESS ITEMS -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:780px">
    <div class="reveal" style="margin-bottom:40px">
      <span class="section-label">Veröffentlichungen</span>
      <h2>Marcus Muster in den Medien</h2>
    </div>

    <?php
    $press_items = [
      ['date' => '11/2019',      'outlet' => 'Zukunft der Medizin'],
      ['date' => '26.11.2019',   'outlet' => 'Heute Tageszeitung'],
      ['date' => '3/2020',       'outlet' => 'Gesundheitstrends'],
      ['date' => '5/2020',       'outlet' => 'Netdoktor Magazin'],
      ['date' => '2/2024',       'outlet' => 'Medizin Populär'],
    ];
    foreach ($press_items as $i => $item): ?>
    <div class="card reveal" style="margin-bottom:16px">
      <div class="card-body" style="padding:24px 28px;display:flex;align-items:center;gap:24px">
        <div style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--gold);min-width:90px;flex-shrink:0">
          <?= e($item['date']) ?>
        </div>
        <div style="height:40px;width:1px;background:var(--border-light);flex-shrink:0"></div>
        <div style="font-size:1.1rem;font-weight:600;color:var(--text-primary)"><?= e($item['outlet']) ?></div>
      </div>
    </div>
    <?php endforeach; ?>

    <div class="reveal" style="margin-top:48px;padding:28px;background:var(--off-white);border-radius:var(--r-md);border-left:4px solid var(--gold)">
      <p style="font-style:italic;color:var(--text-secondary);margin:0;font-size:.95rem;line-height:1.7">
        Marcus Muster – Sportwissenschafter, staatl. gepr. Fitness Trainer &amp; Gründer von FlexFit
      </p>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Sprechen Sie uns an</h2>
    <p>Für Presseanfragen und Medienkooperationen stehen wir Ihnen gerne zur Verfügung.</p>
    <div class="cta-banner-actions">
      <a href="mailto:<?= e($site['email'] ?? 'marcus@flexfit-demo.at') ?>" class="btn btn-primary btn-lg">
        <?= icon('mail') ?> E-Mail schreiben
      </a>
      <a href="/kontakt.php" class="btn btn-outline btn-lg">Kontaktformular</a>
    </div>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
