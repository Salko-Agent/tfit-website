<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'personal_training';
$site    = $content['site'] ?? [];
$_pt     = $content['_pt'] ?? [];
$pt_hero = $_pt['hero']['data']              ?? [];
$pt_kft  = $_pt['krafttraining']['data']     ?? [];
$pt_vor  = $_pt['vorteile']['data']          ?? [];
$pt_spez = $_pt['spezialisierungen']['data'] ?? [];
$pt_prei = $_pt['preise']['data']            ?? [];
$pt_grup = $_pt['gruppentraining']['data']   ?? [];
$pt_ablauf = $_pt['ablauf']['data']           ?? [];
$pt_mob  = $_pt['mobiles_training']['data']  ?? [];
$pt_err  = $_pt['erreichbarkeit']['data']    ?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO – Bild Background -->
<section class="hero hero-top" id="hero">
  <div class="hero-bg" id="heroBg" style="background-image:url('<?= e($pt_hero['bg_image'] ?? '/assets/img/training/sumo-squat.jpg') ?>');background-size:cover;background-position:center top;"></div>

  <div class="hero-overlay" style="background:linear-gradient(180deg,rgba(0,0,0,.88) 0%,rgba(0,0,0,.72) 60%,rgba(0,0,0,.55) 100%);"></div>

  <div class="container">
    <div class="hero-content">

      <div class="hero-badge">
        <div class="hero-badge-dot"></div>
        <span class="hero-badge-text"><?= e($pt_hero['badge'] ?? '📍 Personal Training Wien · 1080') ?></span>
      </div>

      <h1 class="hero-headline">Personal Trainer Wien</h1>

      <p class="hero-sub">
        <?= e($pt_hero['subheadline'] ?? 'Endlich fit und schmerzfrei das Leben genießen') ?><br>
        <span class="hero-price"><?= e($pt_hero['price_note'] ?? 'Personal Training bereits ab 69 € / Einheit') ?></span>
      </p>

      <div style="display:flex;align-items:center;gap:8px;margin-bottom:var(--space-6);font-size:.85rem;color:rgba(255,255,255,.65)">
        <span>📍</span>
        <span><?= e($pt_hero['address'] ?? 'Privates Studio: Mustergasse 12, 1080 Wien') ?></span>
      </div>

      <div class="hero-ctas">
        <a href="<?= e($pt_hero['cta_primary_url'] ?? '/probetraining.php') ?>" class="btn btn-primary btn-lg">
          <?= e($pt_hero['cta_primary'] ?? 'Gratis Probetraining buchen') ?> <?= icon('arrow-right') ?>
        </a>
        <a href="<?= e($pt_hero['cta_secondary_url'] ?? '#preise') ?>" class="btn btn-outline btn-lg"><?= e($pt_hero['cta_secondary'] ?? 'Preise ansehen') ?></a>
      </div>

      <div class="hero-trust">
        <div class="hero-stars">
          <span class="star">★</span><span class="star">★</span><span class="star">★</span>
          <span class="star">★</span><span class="star">★</span>
        </div>
        <p class="hero-trust-text"><strong><?= e($pt_hero['trust_rating'] ?? '4.9') ?>/5</strong> – <?= e($pt_hero['trust_count'] ?? '65') ?> Google-Bewertungen</p>
        <span style="color:rgba(255,255,255,.3)">·</span>
        <div style="display:flex;align-items:center;gap:6px;color:rgba(255,255,255,.5);font-size:.78rem;">
          <?= icon('google') ?>
          <span>Google Reviews</span>
        </div>
      </div>

    </div>
  </div>

  <div class="hero-scroll" id="heroScroll" role="button" tabindex="0" aria-label="Nach unten scrollen">
    <div class="scroll-line"></div>
    <span>Scroll</span>
  </div>
</section>

<!-- DESHALB KRAFTTRAINING -->
<section class="benefits-section section-pad">
  <div class="container">
    <div class="benefits-header reveal">
      <span class="section-label" style="justify-content:center"><?= e($pt_kft['label'] ?? 'Deshalb Krafttraining') ?></span>
      <h2><?= e($pt_kft['headline'] ?? 'Krafttraining grenzt an ein Wundermittel') ?></h2>
      <p style="color:rgba(255,255,255,.65);max-width:600px;margin:16px auto 0"><?= e($pt_kft['subtext'] ?? 'Wie aktuelle Studien bestätigen – Krafttraining ist das wichtigste Training für Ihre Gesundheit') ?></p>
    </div>
    <div class="benefits-grid">
      <?php
      $kft_items = $pt_kft['items'] ?? [
        ['icon'=>'💪','title'=>'Muskeln aufbauen & stärker werden','text'=>'Baut Muskeln auf & macht stärker'],
        ['icon'=>'❤️','title'=>'Herz, Gelenke & Gehirn','text'=>'Wirkt positiv auf Immunsystem, Herz-Kreislauf-System, Gelenke, Knochen & Gehirn'],
        ['icon'=>'🦴','title'=>'Rücken- & Nackenschmerzen','text'=>'Lindert oder eliminiert Rücken- & Nackenschmerzen'],
        ['icon'=>'🛡️','title'=>'Prävention von Zivisarahtionskrankheiten','text'=>'Prävention gegen Adipositas, Bluthochdruck, Diabetes, Demenz und viele weitere Erkrankungen'],
        ['icon'=>'⏳','title'=>'Beste Altersvorsorge','text'=>'Insgesamt die beste Vorsorge für Ihre Gesundheit'],
        ['icon'=>'🌟','title'=>'Gesteigerte Lebensqualität','text'=>'Insgesamt erfahren Sie durch individuelles Krafttraining einen deutlichen Anstieg an Lebensqualität.'],
      ];
      foreach($kft_items as $i => $b): ?>
      <div class="benefit-card reveal reveal-delay-<?= ($i%3)+1 ?>">
        <div class="benefit-icon"><?= $b['icon'] ?></div>
        <h4 class="benefit-title"><?= $b['title'] ?></h4>
        <p class="benefit-text"><?= $b['text'] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- VORTEILE PERSONAL TRAINING -->
<section class="section-pad" style="background:var(--white)">
  <div class="container">
    <div class="sg2-center">
      <div class="reveal-left">
        <span class="section-label"><?= e($pt_vor['label'] ?? 'Warum Personal Training bei FlexFit?') ?></span>
        <h2 style="margin-bottom:16px"><?= e($pt_vor['headline'] ?? 'Vorteile von Personal Training bei FlexFit') ?></h2>

        <?php foreach(($pt_vor['items'] ?? []) as $i => $v): ?>
        <div class="why-feature reveal reveal-delay-<?= min($i+1,5) ?>">
          <div class="why-feature-icon"><?= e($v['icon'] ?? '✓') ?></div>
          <div>
            <div class="why-feature-title"><?= e($v['title'] ?? '') ?></div>
            <?php if (!empty($v['text'])): ?>
            <div class="why-feature-text"><?= e($v['text']) ?></div>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>

        <?php if (!empty($pt_vor['quote'])): ?>
        <blockquote style="margin:32px 0;padding:20px 24px;border-left:4px solid var(--gold);background:var(--off-white);border-radius:0 var(--r-md) var(--r-md) 0;font-style:italic;color:var(--text-secondary);font-size:.95rem">
          <?= e($pt_vor['quote']) ?>
          <?php if (!empty($pt_vor['quote_author'])): ?>
          <cite style="display:block;margin-top:8px;font-style:normal;font-weight:700;color:var(--text-primary);font-size:.85rem">— <?= e($pt_vor['quote_author']) ?></cite>
          <?php endif; ?>
        </blockquote>
        <?php endif; ?>
      </div>
      <div class="reveal-right">
        <img src="/assets/img/training/collage.jpeg" alt="Personal Training FlexFit Wien" style="border-radius:var(--r-lg);width:100%" loading="lazy">
      </div>
    </div>
  </div>
</section>

<!-- SPEZIALISIERUNGEN -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container">
    <div class="text-center reveal" style="margin-bottom:48px">
      <span class="section-label"><?= e($pt_spez['label'] ?? 'Spezialisierungen') ?></span>
      <h2><?= e($pt_spez['headline'] ?? 'Für jeden das richtige Training') ?></h2>
    </div>
    <div class="sg2" style="gap:var(--space-6)">
      <?php foreach(($pt_spez['items'] ?? []) as $i => $sp): ?>
      <div class="card reveal reveal-delay-<?= ($i%3)+1 ?>">
        <div class="card-body" style="padding:28px">
          <div style="font-size:2rem;margin-bottom:12px"><?= e($sp['icon'] ?? '') ?></div>
          <h3 style="font-size:1.1rem;margin-bottom:8px"><?= e($sp['title'] ?? '') ?></h3>
          <p style="font-size:.9rem;color:var(--text-secondary);line-height:1.7"><?= e($sp['text'] ?? '') ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ABLAUF -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:780px">
    <div class="text-center reveal" style="margin-bottom:40px">
      <span class="section-label">Ablauf</span>
      <h2>So starten Sie bei FlexFit</h2>
    </div>
    <?php foreach(($pt_ablauf['steps'] ?? []) as $s): ?>
    <div style="display:flex;gap:20px;padding:20px;background:var(--off-white);border-radius:var(--r-md);margin-bottom:12px;align-items:flex-start" class="reveal">
      <div style="font-family:var(--font-display);font-size:2rem;font-weight:700;color:var(--gold);line-height:1;min-width:44px"><?= $s['num'] ?></div>
      <div>
        <div style="font-weight:700;font-size:1rem;margin-bottom:4px;color:var(--text-primary)"><?= $s['title'] ?></div>
        <div style="font-size:.9rem;color:var(--text-secondary);line-height:1.6"><?= $s['text'] ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- PREISE: UNSER TRAINERTEAM -->
<section class="section-pad" style="background:var(--off-white)" id="preise">
  <div class="container">
    <div class="text-center reveal" style="margin-bottom:48px">
      <span class="section-label"><?= e($pt_prei['label'] ?? 'Unser Trainerteam') ?></span>
      <h2><?= e($pt_prei['headline'] ?? 'Preise: Unser Training bereits ab 69€/Einheit*') ?></h2>
      <p style="color:var(--text-secondary);max-width:520px;margin:12px auto 0;font-size:.9rem"><?= e($pt_prei['subtext'] ?? '*Ab-Preise verstehen sich pro Einheit bei Kauf eines 45 min. 10er-Blocks.') ?></p>
    </div>

    <div class="sg3">
      <?php
      $trainers = $pt_prei['trainers'] ?? [
        ['name'=>'Marcus Muster','focus'=>'Gesundheit, Fitness & Lebensqualität','price'=>'ab 86€','img'=>'/assets/img/team/marcus-kohler.jpg','specs'=>['Sportwissenschaftler','15+ Jahre Erfahrung']],
        ['name'=>'Eric Weber','focus'=>'Muskel- & Kraftaufbau','price'=>'ab 76€','img'=>'/assets/img/team/eric-weber.jpeg','specs'=>['Staatl. gepr. Fitnesstrainer','Masterclass Personal Training']],
        ['name'=>'Oliver Kraft','focus'=>'Gesundheit & Körperformung','price'=>'ab 69€','img'=>'/assets/img/team/oliver-kraft.jpeg','specs'=>['Staatl. gepr. Fitnesstrainer','Gesundheitstraining']],
      ];
      foreach($trainers as $i => $tr): ?>
      <div class="card reveal reveal-delay-<?= $i+1 ?>">
        <div class="card-body" style="padding:28px;text-align:center">
          <img src="<?= e($tr['img'] ?? '') ?>" alt="<?= e($tr['name'] ?? '') ?>" style="width:90px;height:90px;border-radius:50%;object-fit:cover;object-position:top;margin:0 auto 16px;display:block;border:3px solid var(--gold)">
          <h3 style="margin-bottom:4px;font-size:1.15rem"><?= e($tr['name'] ?? '') ?></h3>
          <div style="font-size:.85rem;color:var(--text-secondary);margin-bottom:12px"><?= e($tr['focus'] ?? '') ?></div>
          <div style="font-family:var(--font-display);font-size:2.2rem;font-weight:700;color:var(--gold);line-height:1;margin-bottom:4px"><?= e($tr['price'] ?? '') ?></div>
          <div style="font-size:.8rem;color:var(--text-muted);margin-bottom:20px">/ Training*</div>
          <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:24px;text-align:left">
            <?php foreach($tr['specs'] as $s): ?>
            <div style="display:flex;align-items:center;gap:8px;font-size:.85rem;color:var(--text-secondary)">
              <span style="color:var(--gold)"><?= icon('check') ?></span> <?= $s ?>
            </div>
            <?php endforeach; ?>
          </div>
          <a href="/probetraining" class="btn btn-outline-dark" style="width:100%;justify-content:center">Probetraining buchen</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Gruppentraining -->
    <div style="margin-top:48px;padding:32px;background:var(--white);border-radius:var(--r-lg);border:1px solid var(--border-light)" class="reveal">
      <div class="sg2-md" style="align-items:flex-start;gap:32px">
        <div>
          <h3 style="margin-bottom:12px"><?= e($pt_grup['label'] ?? 'Gruppentraining – ab 40€/h') ?></h3>
          <p style="color:var(--text-secondary);margin-bottom:16px"><?= e($pt_grup['text'] ?? '') ?></p>
          <div style="display:flex;flex-wrap:wrap;gap:12px">
            <?php foreach(($pt_grup['prices'] ?? []) as $g): ?>
            <span style="padding:8px 16px;background:var(--off-white);border-radius:var(--r-md);font-weight:600;font-size:.9rem;color:var(--text-primary)"><?= e($g) ?></span>
            <?php endforeach; ?>
          </div>
        </div>
        <div style="text-align:center;flex-shrink:0">
          <h3 style="margin-bottom:12px"><?= e($pt_mob['headline'] ?? 'Mobiles Personal Training') ?></h3>
          <p style="color:var(--text-secondary);font-size:.9rem;margin-bottom:8px"><?= e($pt_mob['text'] ?? '') ?></p>
          <p style="color:var(--text-muted);font-size:.82rem"><?= e($pt_mob['bezirke'] ?? '') ?><br><?= e($pt_mob['anfahrt'] ?? '') ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ERREICHBARKEIT -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:780px">
    <div class="text-center reveal" style="margin-bottom:28px">
      <span class="section-label">Erreichbarkeit</span>
      <h2>Personal Training Wien &ndash; zentral in 1080</h2>
      <p style="color:var(--text-secondary);margin-top:12px">Unser Studio in der Mustergasse 12 ist aus den umliegenden Bezirken bequem erreichbar &ndash; &ouml;ffentlich, zu Fu&szlig; oder mit dem Auto.</p>
    </div>
    <div class="sg3" style="gap:16px;margin-bottom:24px">
      <div style="padding:20px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light);text-align:center">
        <div style="font-size:1.8rem;margin-bottom:8px">🚇</div>
        <div style="font-weight:700;margin-bottom:6px;font-size:.9rem">&Ouml;ffentlich</div>
        <div style="font-size:.85rem;color:var(--text-secondary)">U6, Stra&szlig;enbahn 9, 42 &amp; 43</div>
      </div>
      <div style="padding:20px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light);text-align:center">
        <div style="font-size:1.8rem;margin-bottom:8px">🚶</div>
        <div style="font-weight:700;margin-bottom:6px;font-size:.9rem">Zu Fu&szlig; &amp; Rad</div>
        <div style="font-size:.85rem;color:var(--text-secondary)">Aus 1070, 1080, 1090, 1160, 1170, 1180 &amp; 1190</div>
      </div>
      <div style="padding:20px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light);text-align:center">
        <div style="font-size:1.8rem;margin-bottom:8px">🚗</div>
        <div style="font-weight:700;margin-bottom:6px;font-size:.9rem">Auto</div>
        <div style="font-size:.85rem;color:var(--text-secondary)">Parkpl&auml;tze in der N&auml;he vorhanden</div>
      </div>
    </div>
    <div style="text-align:center">
      <a href="https://www.google.com/maps/place/FlexFit+Personal+Training+Wien/@48.2145136,16.339603,17z" target="_blank" rel="noopener" class="btn btn-outline-dark">In Google Maps &ouml;ffnen <?= icon('arrow-right') ?></a>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Starten Sie heute – kostenlos &amp; unverbindlich</h2>
    <p>Wagneren Sie Ihr gratis Probetraining und erleben Sie selbst, wie FlexFit Sie zu Ihren Zielen bringt.</p>
    <div class="cta-banner-actions">
      <a href="/probetraining" class="btn btn-primary btn-lg">Gratis Probetraining buchen <?= icon('arrow-right') ?></a>
      <a href="mailto:<?= e($site['email'] ?? 'marcus@flexfit-demo.at') ?>" class="btn btn-outline btn-lg">Per E-Mail anfragen</a>
    </div>
    <p class="cta-note">&#10003; Kostenlos &nbsp;&middot;&nbsp; &#10003; Unverbindlich &nbsp;&middot;&nbsp; &#10003; Kein Vertrag</p>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
