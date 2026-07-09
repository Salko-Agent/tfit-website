<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'home';
$content['seo']['home']['title']       = 'Rückenschmerzen – Personal Training Wien | FlexFit';
$content['seo']['home']['description'] = 'Rückenschmerzen smart wegtrainieren mit Personal Trainer Marcus Muster in Wien 1080. Individuelles Kraft- & Beweglichkeitstraining.';
$site = $content['site'] ?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px">Rückentraining Wien</span>
    <h1>Rückentraining – Rückenschmerzen smart wegtrainieren</h1>
    <p style="max-width:700px;margin:20px auto 0;color:rgba(255,255,255,.75);font-size:1.1rem;line-height:1.7">
      Sie leiden auch ständig unter Rückenschmerzen? Wollen endlich wieder schmerzfrei durchs Leben gehen?
      Wir haben die Lösung: Angepasstes Kraft- und Beweglichkeitstraining
    </p>
  </div>
</section>

<!-- INTRO SECTION -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:860px">
    <div class="card reveal">
      <div class="card-body" style="padding:40px">
        <p style="font-size:1.05rem;color:var(--text-secondary);line-height:1.8;margin-bottom:0">
          Seit einigen Jahren sind Rückenschmerzen ein großes Leid unserer Bevölkerung.
          Die Gründe dafür sind vor allem das viele Sitzen und zu wenige Bewegen.
          Dies führt natürlich zu schlechter Haltung, Rücken- und Nackenschmerzen.
          Was Sie benötigen ist ein individuell auf Sie abgestimmtes Kraft- &amp; Beweglichkeitstraining.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- MEHR LEBENSQUALITÄT -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:860px">
    <div class="reveal" style="margin-bottom:32px">
      <span class="section-label">Spezialisierung Rücken</span>
      <h2>Mehr Lebensqualität durch Rückentraining</h2>
    </div>

    <div class="sg2" style="gap:var(--space-8);align-items:flex-start">
      <div class="reveal-left">
        <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:24px">
          Wir haben uns auf das Thema Rückenschmerzen spezialisiert und bieten Ihnen genau das was Sie benötigen,
          um wieder schmerzfrei und fit durchs Leben zu gehen.
        </p>
        <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:32px">
          <div style="display:flex;align-items:flex-start;gap:12px">
            <span style="color:var(--gold);flex-shrink:0;margin-top:2px"><?= icon('check') ?></span>
            <span style="color:var(--text-secondary)">Individuell auf Sie abgestimmtes Training</span>
          </div>
          <div style="display:flex;align-items:flex-start;gap:12px">
            <span style="color:var(--gold);flex-shrink:0;margin-top:2px"><?= icon('check') ?></span>
            <span style="color:var(--text-secondary)">Gezieltes Kraft- &amp; Beweglichkeitstraining</span>
          </div>
          <div style="display:flex;align-items:flex-start;gap:12px">
            <span style="color:var(--gold);flex-shrink:0;margin-top:2px"><?= icon('check') ?></span>
            <span style="color:var(--text-secondary)">Verbesserung der Körperhaltung</span>
          </div>
          <div style="display:flex;align-items:flex-start;gap:12px">
            <span style="color:var(--gold);flex-shrink:0;margin-top:2px"><?= icon('check') ?></span>
            <span style="color:var(--text-secondary)">Oft eindeutige Besserung schon nach wenigen Einheiten</span>
          </div>
        </div>
        <p style="color:var(--text-secondary);font-size:.95rem;line-height:1.7">
          Mehr zum Thema erfahren Sie auch in unserem
          <a href="/blog.php" style="color:var(--gold);font-weight:600">Blog-Artikel über Rückenschmerzen</a>.
        </p>
      </div>
      <div class="reveal-right">
        <img src="/assets/img/training/sumo-squat.jpg" alt="Rückentraining Wien FlexFit"
             style="border-radius:var(--r-lg);width:100%;object-fit:cover" loading="lazy">
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Endlich wieder schmerzfrei leben</h2>
    <p>Wagneren Sie jetzt Ihr kostenloses Probetraining und starten Sie Ihren Weg zu einem schmerzfreien Rücken.</p>
    <div class="cta-banner-actions">
      <a href="/probetraining.php" class="btn btn-primary btn-lg">Probetraining buchen <?= icon('arrow-right') ?></a>
      <a href="/kontakt.php" class="btn btn-outline btn-lg">Kontakt aufnehmen</a>
    </div>
    <p class="cta-note">&#10003; Kostenlos &nbsp;&middot;&nbsp; &#10003; Unverbindlich &nbsp;&middot;&nbsp; &#10003; Kein Vertrag</p>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
