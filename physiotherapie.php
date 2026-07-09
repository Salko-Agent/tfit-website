<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'physiotherapie';
$site    = $content['site'] ?? [];
$physio    = $content['_physio'] ?? [];
$ph_hero   = $physio['hero']['data']       ?? [];
$ph_team   = $physio['team']['data']       ?? [];
$ph_leist  = $physio['leistungen']['data'] ?? [];
$ph_ansatz = $physio['ansatz']['data']    ?? [];
$ph_betr   = $physio['betreuung']['data']  ?? [];
$ph_was    = $physio['was_ist_physio']['data'] ?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px"><?= e($ph_hero['label'] ?? 'Physiotherapie 1080 Wien') ?></span>
    <h1><?= he($ph_hero['headline'] ?? 'Physiotherapie 1080 Wien –<br>Ihre Gesundheit im Fokus') ?></h1>
    <p style="max-width:640px;margin:16px auto 24px;color:rgba(255,255,255,.8)"><?= e($ph_hero['subtext'] ?? 'Ihre PhysiotherapeutInnen in der Mustergasse 12, 1080 Wien') ?></p>
    <div style="display:flex;justify-content:center;gap:12px;flex-wrap:wrap">
      <a href="tel:+4312345678" class="btn btn-primary btn-lg">Jetzt Termin vereinbaren <?= icon('arrow-right') ?></a>
    </div>
  </div>
</section>

<!-- TEAM SCHNELLKONTAKT -->
<section style="background:var(--dark-surface);padding:24px 0">
  <div class="container">
    <div class="physio-contact-bar sg4" style="gap:var(--space-4)">
      <?php
      $physios = $ph_team['members'] ?? [
        ['name'=>'Paul Huber','phone'=>'+43 1 2345678'],
        ['name'=>'Sarah Meier','phone'=>'+43 677 617 365 10'],
        ['name'=>'Thomas Schmid','phone'=>'+43 1 2345678'],
        ['name'=>'Jona Beck','phone'=>'+43 660 745 41 98'],
      ];
      foreach($physios as $ph): ?>
      <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 16px;background:var(--dark-card);border-radius:var(--r-md);flex-wrap:wrap">
        <span style="font-weight:600;color:var(--white);font-size:.9rem"><?= e($ph['name'] ?? '') ?></span>
        <a href="tel:<?= e(preg_replace('/[^+\d]/','',$ph['phone']??'')) ?>" class="btn btn-outline" style="font-size:.82rem;padding:6px 14px;color:var(--gold);border-color:var(--gold)"><?= e($ph['phone'] ?? '') ?></a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- INTRO SECTION -->
<section class="section-pad" style="background:var(--white)">
  <div class="container">
    <div class="sg2-center">
      <div class="reveal-left">
        <span class="section-label">Unser Ansatz</span>
        <h2 style="margin-bottom:20px"><?= e($ph_ansatz['headline'] ?? 'Wir verbinden passive und aktive Physiotherapie. Damit Sie Ihren Alltag bald wieder meistern können') ?></h2>
        <?php foreach(($ph_leist['intro_paragraphs'] ?? []) as $p): ?>
        <p style="color:var(--text-secondary);margin-bottom:16px;line-height:1.7"><?= e($p) ?></p>
        <?php endforeach; ?>

        <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:24px">
          <?php foreach(($ph_leist['leistungen_items'] ?? []) as $l): ?>
          <div style="display:flex;align-items:center;gap:10px;font-size:.9rem;color:var(--text-secondary)">
            <span style="color:var(--gold);font-weight:700"><?= icon('check') ?></span> <?= e($l) ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="reveal-right" style="display:flex;flex-direction:column;gap:12px">
        <img src="/assets/img/physio/physio-hero.jpg" alt="Physiotherapie Wien 1080 FlexFit" style="border-radius:var(--r-lg);width:100%" loading="lazy">
      </div>
    </div>
  </div>
</section>

<!-- WAS IST PHYSIOTHERAPIE — SEO Content Block -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:820px">
    <div class="reveal" style="margin-bottom:32px">
      <span class="section-label">Wissen &amp; Hintergrund</span>
      <h2 style="margin-bottom:20px">Was ist Physiotherapie?</h2>
      <p style="color:var(--text-secondary);line-height:1.75;margin-bottom:24px"><?= e($ph_was['text'] ?? '') ?></p>
    </div>
    <div class="sg3" style="gap:16px">
      <?php foreach(($ph_was['categories'] ?? []) as $i => $cat): ?>
      <div style="padding:20px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light)" class="reveal reveal-delay-<?= $i+1 ?>">
        <div style="font-size:1.8rem;margin-bottom:10px"><?= e($cat['icon'] ?? '') ?></div>
        <h3 style="font-size:.95rem;margin-bottom:8px"><?= e($cat['title'] ?? '') ?></h3>
        <p style="font-size:.85rem;color:var(--text-secondary);line-height:1.6"><?= e($cat['text'] ?? '') ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SPEZIALISIERUNGEN -->
<section class="section-pad" style="background:var(--white)">
  <div class="container">
    <div class="text-center reveal" style="margin-bottom:40px">
      <span class="section-label">Spezialisierungen</span>
      <h2>Behandlungsschwerpunkte</h2>
    </div>
    <div class="sg3">
      <?php foreach(($ph_leist['spezialisierungen_cards'] ?? []) as $i => $sp): ?>
      <div class="card reveal reveal-delay-<?= ($i%3)+1 ?>">
        <div class="card-body" style="padding:24px">
          <div style="font-size:2rem;margin-bottom:12px"><?= e($sp['icon'] ?? '') ?></div>
          <h3 style="font-size:1rem;margin-bottom:12px"><?= e($sp['title'] ?? '') ?></h3>
          <ul style="list-style:none;padding:0;margin:0">
            <?php foreach(($sp['items'] ?? []) as $it): ?>
            <li style="font-size:.85rem;padding:4px 0;border-bottom:1px solid var(--border-light);color:var(--text-secondary)"><?= e($it) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ABLAUF & PREISE -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container">
    <div class="sg2-center" style="align-items:flex-start">

      <div class="reveal-left">
        <span class="section-label">Ablauf &amp; Organisatorisches</span>
        <h2 style="margin-bottom:16px">So funktioniert die Abrechnung</h2>

        <!-- Pipeline summary -->
        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin-bottom:24px;padding:12px 16px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light);font-size:.82rem;color:var(--text-muted)">
          <span>Verordnung</span><span style="color:var(--gold)">›</span>
          <span>Bewilligung</span><span style="color:var(--gold)">›</span>
          <span>Behandlung</span><span style="color:var(--gold)">›</span>
          <span>Honorarnote</span><span style="color:var(--gold)">›</span>
          <span>KK-R&uuml;ckerstattung</span>
        </div>

        <?php foreach(($ph_leist['ablauf_steps'] ?? []) as $i => $step): ?>
        <div style="display:flex;gap:16px;padding:16px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light);margin-bottom:10px">
          <div style="font-family:var(--font-display);font-size:1.6rem;font-weight:700;color:var(--gold);min-width:36px;line-height:1">0<?= $i+1 ?></div>
          <div style="font-size:.9rem;line-height:1.6;color:var(--text-secondary)"><?= e($step) ?></div>
        </div>
        <?php endforeach; ?>

        <div style="margin-top:10px;padding:12px 16px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light);font-size:.85rem;color:var(--text-secondary);line-height:1.6">
          💡 <strong>Tipp:</strong> Eventuelle Restkosten k&ouml;nnen &uuml;ber eine Zusatz- oder Unfallversicherung &uuml;bernommen werden. Fragen Sie Ihre Versicherung.
        </div>
        <div style="margin-top:10px;padding:12px 16px;background:var(--off-white);border-radius:var(--r-md);font-size:.82rem;color:var(--text-muted)">
          <?= e($ph_leist['mitbringen'] ?? '') ?>
        </div>
      </div>

      <div class="reveal-right">
        <span class="section-label">Preise</span>
        <h2 style="margin-bottom:24px">Physiotherapie Wien 1080</h2>
        <div style="display:flex;flex-direction:column;gap:12px;margin-bottom:32px">
          <?php foreach(($ph_leist['preise_items'] ?? []) as $pr): ?>
          <div style="padding:20px 24px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light);display:flex;justify-content:space-between;align-items:center">
            <span style="font-weight:600"><?= e($pr['label'] ?? '') ?></span>
            <span style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--gold)"><?= e($pr['price'] ?? '') ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <p style="font-size:.82rem;color:var(--text-muted);margin-bottom:24px">Krankenkassen-R&uuml;ckerstattung m&ouml;glich. F&uuml;r die Behandlung ben&ouml;tigen Sie eine &auml;rztliche Verordnung.</p>

        <h3 style="margin-bottom:16px;font-size:1rem">Unser Therapeuten-Team</h3>
        <div class="card">
          <div class="card-body" style="padding:16px 20px">
            <?php foreach($physios as $ph): ?>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--border-light)">
              <span style="font-weight:600;font-size:.9rem"><?= $ph['name'] ?></span>
              <a href="tel:<?= e($ph['tel']) ?>" class="btn btn-outline-dark" style="font-size:.82rem;padding:6px 12px"><?= e($ph['phone']) ?></a>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- GANZHEITLICH -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:860px">
    <div class="text-center reveal" style="margin-bottom:32px">
      <span class="section-label">Ganzheitlicher Ansatz</span>
      <h2>Von der Wundheilung bis zur sportlichen Belastbarkeit</h2>
    </div>
    <div class="sg4" style="gap:20px">
      <?php foreach(($ph_betr['items'] ?? []) as $i => $w): ?>
      <div class="card reveal reveal-delay-<?= $i+1 ?>">
        <div class="card-body" style="padding:24px;text-align:center">
          <div style="font-size:2rem;margin-bottom:12px"><?= e($w['icon'] ?? '') ?></div>
          <h3 style="font-size:1rem;margin-bottom:8px"><?= e($w['title'] ?? '') ?></h3>
          <p style="font-size:.88rem;color:var(--text-secondary);line-height:1.6"><?= e($w['text'] ?? '') ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Physiotherapie in 1080 Wien – Vertrauen Sie auf Experten</h2>
    <p>Verbessern Sie Ihre Gesundheit und Lebensqualit&auml;t. Klicken Sie auf den Therapeuten Ihrer Wahl, um Kontakt aufzunehmen.</p>
    <div class="cta-banner-actions" style="flex-wrap:wrap">
      <?php foreach($physios as $i => $ph): ?>
      <a href="tel:<?= e(preg_replace('/[^+\d]/','',$ph['phone']??'')) ?>" class="btn <?= $i===0?'btn-primary':'btn-outline' ?>"><?= e($ph['name'] ?? '') ?>: <?= e($ph['phone'] ?? '') ?></a>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:16px;font-size:.85rem;color:rgba(255,255,255,.5)">Mustergasse 12, 1080 Wien &nbsp;&middot;&nbsp; Auch erreichbar aus 1070, 1090, 1160, 1170 &amp; 1180</p>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
