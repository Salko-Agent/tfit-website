<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'home';
$content['seo']['home']['title']       = 'Personal Trainer Salzburg – Marcus Muster | FlexFit';
$content['seo']['home']['description'] = 'Personal Training in Salzburg 5020 mit Sportwissenschaftler Marcus Muster. Flexibel bei Ihnen zuhause, im Park oder Office. Jetzt Probetraining buchen.';
$site = $content['site'] ?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px">📍 Personal Training Salzburg 5020</span>
    <h1>FlexFit Personal Training Salzburg</h1>
    <p style="max-width:700px;margin:20px auto 0;color:rgba(255,255,255,.75);font-size:1.05rem;line-height:1.7">
      Mit Marcus Muster – Sportwissenschaftler &amp; Personal Trainer in Salzburg 5020 und Umgebung
    </p>
    <div style="margin-top:28px">
      <a href="/probetraining.php" class="btn btn-primary btn-lg">
        zum Probetraining <?= icon('arrow-right') ?>
      </a>
    </div>
  </div>
</section>

<!-- INTRO / LEAD -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:860px">
    <div class="card reveal">
      <div class="card-body" style="padding:40px">
        <p style="font-size:1.05rem;color:var(--text-secondary);line-height:1.8">
          Sie haben überlaufene Fitness Studios satt und möchten endlich mit individueller Betreuung Ihre Ziele erreichen?
          Sie möchten endlich wieder fit sein und sich besser fühlen?
          Dann sind Sie bei Personal Coach Marcus Muster genau richtig.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- KRAFTTRAINING VORTEILE -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:860px">
    <div class="sg2" style="gap:var(--space-8);align-items:flex-start">
      <div class="reveal-left">
        <span class="section-label">Warum Krafttraining?</span>
        <h2 style="margin-bottom:20px">Was Krafttraining für Sie bewirkt</h2>
        <div style="display:flex;flex-direction:column;gap:12px">
          <?php
          $benefits = [
            'Baut Muskeln auf &amp; macht stärker',
            'Wirkt positiv auf Immunsystem, Herz-Kreislauf-System, Gelenke, Knochen &amp; Gehirn',
            'Lindert oder eliminiert Rücken- &amp; Nackenschmerzen',
            'Prävention gegen Adipositas, Bluthochdruck, Diabetes, Demenz und viele weitere Erkrankungen',
            'und vieles mehr',
          ];
          foreach ($benefits as $b): ?>
          <div style="display:flex;align-items:flex-start;gap:12px">
            <span style="color:var(--gold);flex-shrink:0;margin-top:3px;font-weight:700">✓</span>
            <span style="color:var(--text-secondary)"><?= $b ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="reveal-right">
        <div class="card">
          <div class="card-body" style="padding:28px">
            <h3 style="margin-bottom:16px">Vorteile von Personal Training</h3>
            <div style="display:flex;flex-direction:column;gap:10px">
              <?php
              $pt_adv = [
                'Effektiveres Training',
                'Zeitersparnis',
                'Sie zahlen nur das was Sie auch nutzen',
                'Keine laufenden Kosten',
                'Professionelle Anleitung',
                'Korrekte Übungsausführung',
                'Individuelle Trainingsgestaltung',
                'Abwechslungsreiches Training',
                'Gesteigerte Lebensqualität',
              ];
              foreach ($pt_adv as $a): ?>
              <div style="display:flex;align-items:flex-start;gap:10px">
                <span style="color:var(--gold);flex-shrink:0;margin-top:3px;font-weight:700">✓</span>
                <span style="color:var(--text-secondary);font-size:.95rem"><?= e($a) ?></span>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ABLAUF PROBETRAINING -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:780px">
    <div class="text-center reveal" style="margin-bottom:36px">
      <span class="section-label">Ablauf</span>
      <h2>So starten Sie beim Personal Training</h2>
    </div>
    <div class="card reveal">
      <div class="card-body" style="padding:36px">
        <p style="color:var(--text-secondary);line-height:1.8;margin:0">
          In einem unverbindlichen Probetraining fokussieren wir uns auf die Ausarbeitung Ihrer Wünsche und Bedürfnisse.
          Hier findet eine Anamnese statt in der wir Ziele, Trainingszustand, Verletzungen etc. klären.
          Mit den hier generierten Informationen kann der Personal Trainer das individuell auf Sie zugeschnittene
          Trainingsprogramm erstellen.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- LOCATION & VIDEO -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:860px">
    <div class="sg2" style="gap:var(--space-8);align-items:flex-start">
      <div class="reveal-left">
        <span class="section-label">Trainingsort</span>
        <h2 style="margin-bottom:16px">Flexibel – dort wo Sie möchten</h2>
        <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:16px">
          Das Personal Training findet dort statt wo Sie es möchten:
        </p>
        <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:24px">
          <?php
          $locations = ['Bei Ihnen Zuhause', 'Im Park', 'Im Office'];
          foreach ($locations as $l): ?>
          <div style="display:flex;align-items:center;gap:12px">
            <span style="color:var(--gold)"><?= icon('check') ?></span>
            <span style="font-weight:600;color:var(--text-primary)"><?= e($l) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <p style="color:var(--text-secondary);line-height:1.7;font-size:.95rem;margin-bottom:16px">
          Selbst mit minimalem Equipment (z.B. Matte und Kurzhanteln) ist ein hochqualitatives Fitnesstraining möglich.
        </p>
        <div style="padding:16px 20px;background:var(--off-white);border-radius:var(--r-md);border-left:4px solid var(--gold)">
          <p style="color:var(--text-secondary);font-size:.9rem;line-height:1.7;margin:0">
            Das Personal Training wird in 5020 Salzburg, sowie Umgebung (Hallein, Anif, Gneis, Morzg,
            Parsch, Aigen, Elsbethen, Nonntal, Maxglan, Lehen, ...) angeboten
          </p>
        </div>
      </div>
      <div class="reveal-right">
        <iframe src="https://www.youtube.com/embed/r8XrmI81yv4"
                width="100%" height="340"
                style="border-radius:var(--r-md);display:block"
                frameborder="0" allowfullscreen
                title="Personal Training Salzburg Marcus Muster FlexFit"></iframe>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Starten Sie jetzt in Salzburg</h2>
    <p>Wagneren Sie Ihr kostenloses, unverbindliches Probetraining mit Personal Trainer Marcus Muster.</p>
    <div class="cta-banner-actions">
      <a href="/probetraining.php" class="btn btn-primary btn-lg">zum Probetraining <?= icon('arrow-right') ?></a>
      <a href="mailto:<?= e($site['email'] ?? 'marcus@flexfit-demo.at') ?>" class="btn btn-outline btn-lg">
        <?= icon('mail') ?> Anfrage schreiben
      </a>
    </div>
    <p class="cta-note">&#10003; Kostenlos &nbsp;&middot;&nbsp; &#10003; Unverbindlich &nbsp;&middot;&nbsp; &#10003; Kein Vertrag</p>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
