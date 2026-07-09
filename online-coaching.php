<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'home';
$content['seo']['home']['title']       = 'Fitness Online Coaching – Marcus Muster | FlexFit';
$content['seo']['home']['description'] = 'Online Fitness Coaching mit Sportwissenschaftler Marcus Muster. Individueller Trainings- & Ernährungsplan. Flexibel, ortsunabhängig, nachhaltig.';
$site = $content['site'] ?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px">Online Coaching</span>
    <h1>Fitness Online Coaching</h1>
    <p style="max-width:700px;margin:20px auto 0;color:rgba(255,255,255,.75);font-size:1.1rem;line-height:1.7">
      Sportwissenschaftler Marcus Muster – Ihr Fitness Online Coach
    </p>
    <p style="max-width:640px;margin:12px auto 0;color:rgba(255,255,255,.6);font-size:.95rem;line-height:1.7">
      Erreichen Sie mit individuell gestaltetem Online Coaching Ihre Gesundheitsziele und profitieren Sie von über 15 Jahren Erfahrung als Personal Trainer.
    </p>
    <div style="margin-top:28px">
      <a href="/probetraining.php" class="btn btn-primary btn-lg">
        zum gratis Kennenlerngespräch <?= icon('arrow-right') ?>
      </a>
    </div>
  </div>
</section>

<!-- HIGHLIGHTS -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container">
    <div class="sg3" style="gap:20px">
      <div class="card reveal reveal-delay-1">
        <div class="card-body" style="padding:28px;text-align:center">
          <div style="font-size:2rem;margin-bottom:12px">💪</div>
          <p style="font-weight:600;color:var(--text-primary);line-height:1.5;margin:0">
            Krafttraining ist nachweislich das wichtigste Training für Ihre Gesundheit
          </p>
        </div>
      </div>
      <div class="card reveal reveal-delay-2">
        <div class="card-body" style="padding:28px;text-align:center">
          <div style="font-size:2rem;margin-bottom:12px">📱</div>
          <p style="font-weight:600;color:var(--text-primary);line-height:1.5;margin:0">
            Die Betreuung ist zu 100% online möglich
          </p>
        </div>
      </div>
      <div class="card reveal reveal-delay-3">
        <div class="card-body" style="padding:28px;text-align:center">
          <div style="font-size:2rem;margin-bottom:12px">💰</div>
          <p style="font-weight:600;color:var(--text-primary);line-height:1.5;margin:0">
            Preise Marcus Muster
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHAT IS ONLINE COACHING -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:860px">
    <div class="sg2" style="gap:var(--space-8);align-items:flex-start">
      <div class="reveal-left">
        <span class="section-label">Was ist Online Coaching?</span>
        <h2 style="margin-bottom:20px">Individuell. Flexibel. Ortsunabhängig.</h2>
        <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:20px">
          Online Fitness Coaching ist die moderne Form des Personal Trainings – ganzheitlich, flexibel,
          ortsunabhängig und individuell auf dich abgestimmt. Beim Online Coaching erhältst du einen
          maßgeschneiderten Trainings- und Ernährungsplan, der sich optimal in deinen Alltag integrieren lässt.
        </p>
        <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:20px">
          Über unsere App, sowie über Telefon, Videos und Videocalls bleibst du mit mir in Kontakt
          und bekommst regelmäßig:
        </p>
        <div style="display:flex;flex-direction:column;gap:10px">
          <?php
          $includes = [
            'individuelle Trainingspläne (für Zuhause oder Fitnessstudio)',
            'Ernährungsberatung &amp; Rezeptideen',
            'Feedback, Korrekturen und Motivation',
            'Fortschrittskontrolle &amp; Zielanpassung',
          ];
          foreach ($includes as $item): ?>
          <div style="display:flex;align-items:flex-start;gap:12px">
            <span style="color:var(--gold);flex-shrink:0;margin-top:2px"><?= icon('check') ?></span>
            <span style="color:var(--text-secondary)"><?= $item ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="reveal-right">
        <div style="border-radius:var(--r-lg);overflow:hidden">
          <iframe src="https://www.youtube.com/embed/XHOmBV4js_E"
                  width="100%" height="340"
                  style="border-radius:var(--r-md);display:block"
                  frameborder="0" allowfullscreen
                  title="Fitness Online Coaching Marcus Muster FlexFit"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- THEMEN & IDEAL FÜR -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:860px">
    <div class="sg2" style="gap:var(--space-8)">
      <div class="card reveal">
        <div class="card-body" style="padding:32px">
          <h3 style="margin-bottom:20px">Themen im Online Coaching</h3>
          <div style="display:flex;flex-direction:column;gap:10px">
            <?php
            $topics = ['Krafttraining', 'Ausdauertraining', 'Alltagsbewegung', 'Ernährung', 'Schlaf', 'Stressmanagement'];
            foreach ($topics as $t): ?>
            <div style="display:flex;align-items:center;gap:12px">
              <span style="color:var(--gold)"><?= icon('check') ?></span>
              <span style="color:var(--text-secondary)"><?= e($t) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="card reveal reveal-delay-2">
        <div class="card-body" style="padding:32px">
          <h3 style="margin-bottom:20px">Ideal für</h3>
          <div style="display:flex;flex-direction:column;gap:10px">
            <?php
            $ideal = [
              'Berufstätige mit wenig Zeit',
              'Eltern mit Familienalltag',
              'Sporteinsteiger oder Wiedereinsteiger',
              'Fortgeschrittene mit klaren Zielen',
              'Menschen, die unabhängig und flexibel trainieren möchten',
            ];
            foreach ($ideal as $i): ?>
            <div style="display:flex;align-items:flex-start;gap:12px">
              <span style="color:var(--gold);flex-shrink:0;margin-top:2px"><?= icon('check') ?></span>
              <span style="color:var(--text-secondary)"><?= e($i) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- VORTEILE -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:780px">
    <div class="reveal" style="margin-bottom:36px">
      <span class="section-label">Warum Online Coaching?</span>
      <h2>Ihre Vorteile auf einen Blick</h2>
    </div>
    <?php
    $advantages = [
      ['title' => 'Flexibilität',         'text' => 'Trainiere wann und wo du willst'],
      ['title' => 'Individualität',       'text' => 'Dein Plan wird an dich angepasst – nicht umgekehrt'],
      ['title' => 'Motivation',           'text' => 'Regelmäßiger Kontakt mit deinem Coach hält dich auf Kurs'],
      ['title' => 'Kostenersparnis',      'text' => 'Günstiger als 1:1 Personal Training im Studio'],
      ['title' => 'Nachhaltige Erfolge',  'text' => 'Kein Standardplan, sondern ein Konzept, das funktioniert'],
    ];
    foreach ($advantages as $i => $adv): ?>
    <div class="reveal" style="display:flex;gap:20px;padding:20px;background:var(--off-white);border-radius:var(--r-md);margin-bottom:12px;align-items:flex-start">
      <div style="font-family:var(--font-display);font-size:2rem;font-weight:700;color:var(--gold);line-height:1;min-width:44px;text-align:center">
        <?= $i + 1 ?>
      </div>
      <div>
        <div style="font-weight:700;font-size:1rem;margin-bottom:4px;color:var(--text-primary)"><?= e($adv['title']) ?></div>
        <div style="font-size:.9rem;color:var(--text-secondary);line-height:1.6"><?= e($adv['text']) ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Starten Sie jetzt mit Online Coaching</h2>
    <p>Vereinbaren Sie Ihr kostenloses Kennenlerngespräch – und wir erarbeiten gemeinsam Ihren individuellen Plan.</p>
    <div class="cta-banner-actions">
      <a href="/probetraining.php" class="btn btn-primary btn-lg">
        zum gratis Kennenlerngespräch <?= icon('arrow-right') ?>
      </a>
      <a href="mailto:<?= e($site['email'] ?? 'marcus@flexfit-demo.at') ?>" class="btn btn-outline btn-lg">
        <?= icon('mail') ?> E-Mail schreiben
      </a>
    </div>
    <p class="cta-note">&#10003; Kostenlos &nbsp;&middot;&nbsp; &#10003; Unverbindlich &nbsp;&middot;&nbsp; &#10003; Kein Vertrag</p>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
