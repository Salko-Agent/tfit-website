<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key  = 'home';

require_once __DIR__ . '/includes/header.php';

$hero         = $content['hero']         ?? [];
$stats        = $content['stats']        ?? [];
$partners     = $content['partners']     ?? [];
$why          = $content['why']          ?? [];
$services     = $content['services']     ?? [];
$trainer      = $content['trainer']      ?? [];
$benefits     = $content['benefits']     ?? [];
$testimonials = $content['testimonials'] ?? [];
$contact_data = $content['contact']      ?? [];
$site         = $content['site']         ?? [];
?>

<!-- ════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════ -->
<section class="hero" id="hero">
  <!-- Hero Hintergrundbild -->
  <div class="hero-bg" id="heroBg" style="background-image:url('<?= e($hero['bg_image'] ?? '/assets/img/training/sumo-squat.jpg') ?>');background-size:cover;background-position:center center;"></div>

  <!-- Overlay -->
  <div class="hero-overlay" style="background:linear-gradient(110deg,rgba(10,7,2,.85) 0%,rgba(10,7,2,.70) 50%,rgba(10,7,2,.50) 100%);"></div>

  <div class="container">
    <div class="hero-split">

      <!-- Left: Text Content -->
      <div class="hero-content">

        <!-- Badge mit Adresse -->
        <div class="hero-badge">
          <div class="hero-badge-dot"></div>
          <span class="hero-badge-text"><?= e($hero['badge'] ?? '📍 Mustergasse 12, 1080 Wien') ?></span>
        </div>

        <!-- H1 -->
        <h1 class="hero-headline">Training bei Smart<span class="accent">Fit</span></h1>

        <!-- H2 -->
        <h2 class="hero-sub">
          <?= e($hero['subheadline'] ?? 'Wissenschaftlich fundiertes Personal Training mit Sportwissenschafter Marcus Muster & Team') ?>
          <br><span class="hero-price">bereits ab 69 € / Einheit</span>
        </h2>

        <!-- Ziel-Tags -->
        <?php if (!empty($hero['goals'])): ?>
        <div class="hero-goals">
          <?php foreach ($hero['goals'] as $goal): ?>
          <span class="badge badge-gold">✓ <?= e($goal) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Trust -->
        <div class="hero-trust">
          <div class="hero-stars">
            <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
          </div>
          <div class="hero-trust-text">
            <strong><?= e($hero['trust_rating'] ?? '4.9') ?></strong> / 5 &mdash; <?= e($hero['trust_count'] ?? '65') ?> Google-Bewertungen
          </div>
        </div>
      </div>

      <!-- Right: Vimeo Video -->
      <?php if (!empty($hero['vimeo_url'])): ?>
      <div class="hero-video">
        <div class="hero-video-wrap">
          <iframe
            src="<?= e($hero['vimeo_url']) ?>&background=1&quality=auto"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            title="FlexFit Personal Training Wien"
            loading="lazy"
          ></iframe>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>

  <!-- Scroll indicator -->
  <div class="hero-scroll" id="heroScroll" role="button" tabindex="0" aria-label="Nach unten scrollen">
    <div class="scroll-line"></div>
    <span>Scroll</span>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     STATS STRIP
════════════════════════════════════════════════ -->
<section class="stats-strip" id="stats">
  <div class="container">
    <div class="stats-grid">
      <?php foreach ($stats as $i => $stat): ?>
      <div class="stat-item reveal reveal-delay-<?= $i + 1 ?>">
        <div class="stat-number"><?= e($stat['number'] ?? '') ?></div>
        <div class="stat-label"><?= e($stat['label'] ?? '') ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     PARTNER LOGOS
════════════════════════════════════════════════ -->
<?php if (!empty($partners)): ?>
<section class="partners-section">
  <div class="container">
    <?php $partners_label = $content['_pages']['home']['sections']['partners']['data']['label'] ?? 'Bisherige Zusammenarbeit mit'; ?>
    <p class="partners-label"><?= e($partners_label) ?></p>
    <div class="partners-logos">
      <?php foreach ($partners as $p): ?>
      <img
        src="<?= e($p['logo']) ?>"
        alt="<?= e($p['name']) ?>"
        class="partner-logo"
        width="120"
        height="40"
        loading="lazy"
      >
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ════════════════════════════════════════════════
     WHY FLEXFIT
════════════════════════════════════════════════ -->
<section class="why-section section-pad" id="warum">
  <div class="container">
    <div class="why-grid">
      <!-- Image -->
      <div class="why-image-wrap reveal-left">
        <img
          src="<?= e($why['image'] ?? '') ?>"
          alt="FlexFit Training Wien"
          loading="lazy"
          width="800"
          height="1000"
        >
        <div class="why-image-badge">
          <strong>100%</strong>
          <span>Individuelle Betreuung</span>
        </div>
      </div>

      <!-- Content -->
      <div class="why-content reveal-right">
        <span class="section-label"><?= e($why['label'] ?? 'Warum Personal Training bei FlexFit?') ?></span>

        <h2 class="section-title"><?php
          $hl = $why['headline'] ?? "Individuelles Personal Training Wien –\nEndlich fit und schmerzfrei das Leben genießen";
          echo nl2br(e($hl));
        ?></h2>

        <p class="section-subtitle"><?= e($why['subtext'] ?? 'Sie haben überlaufene Fitness Studios satt und möchten endlich mit individueller Betreuung Ihre Fitness-Ziele erreichen? Dann sind Sie bei FlexFit genau richtig.') ?></p>

        <!-- Goal tags -->
        <?php if (!empty($why['goals'])): ?>
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin:20px 0 8px;">
          <?php foreach ($why['goals'] as $goal): ?>
          <span class="badge badge-gold">✓ <?= e($goal) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Features -->
        <?php if (!empty($why['features'])): ?>
        <div class="why-features">
          <?php foreach ($why['features'] as $i => $feat): ?>
          <div class="why-feature reveal reveal-delay-<?= min($i + 1, 5) ?>">
            <div class="why-feature-icon"><?= e($feat['icon'] ?? '✓') ?></div>
            <div>
              <div class="why-feature-title"><?= e($feat['title'] ?? '') ?></div>
              <div class="why-feature-text"><?= e($feat['text'] ?? '') ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     SERVICES / ANGEBOTE
════════════════════════════════════════════════ -->
<section class="services-section section-pad" id="leistungen">
  <div class="container">
    <div class="text-center reveal">
      <span class="section-label">Unsere Angebote</span>
      <h2 class="section-title">Training, das zu dir passt</h2>
      <p class="section-subtitle" style="margin:0 auto">Von 1:1 Personal Training bis Firmenfitness – wir bieten das richtige Format für jedes Ziel.</p>
    </div>

    <!-- Services Slider -->
    <div class="services-slider" id="servicesSlider">
      <div class="services-track">
        <?php foreach ($services as $i => $service): ?>
        <article class="service-card service-slide">
          <div class="service-card-image">
            <img
              src="<?= e($service['image'] ?? '') ?>"
              alt="<?= e($service['title'] ?? '') ?>"
              loading="lazy"
              width="600"
              height="450"
            >
            <div class="service-card-overlay"></div>
            <div class="service-card-badge">
              <span class="badge badge-dark"><?= e($service['short'] ?? '') ?></span>
            </div>
          </div>
          <div class="service-card-body">
            <div style="display:flex;align-items:baseline;justify-content:space-between;margin-bottom:8px;gap:8px">
              <h3 class="service-card-title"><?= e($service['title'] ?? '') ?></h3>
              <?php if (!empty($service['price'])): ?>
              <span style="color:var(--gold);font-size:.85rem;font-weight:700;white-space:nowrap">
                <?= e($service['price']) ?> <?= e($service['price_unit'] ?? '') ?>
              </span>
              <?php endif; ?>
            </div>
            <p class="service-card-text"><?= e($service['description'] ?? '') ?></p>
            <a href="<?= e($service['url'] ?? '#') ?>" class="service-card-link">
              Mehr erfahren <?= icon('arrow-right') ?>
            </a>
          </div>
        </article>
        <?php endforeach; ?>
      </div><!-- /.services-track -->
    </div><!-- /.services-slider -->
    <div class="slider-controls services-slider-controls">
      <button class="slider-btn slider-prev" id="servicesPrev" aria-label="Vorherige Leistung">&#8592;</button>
      <div class="slider-dots" id="servicesDots"></div>
      <button class="slider-btn slider-next" id="servicesNext" aria-label="Nächste Leistung">&#8594;</button>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     TRAINER
════════════════════════════════════════════════ -->
<section class="trainer-section section-pad" id="trainer">
  <div class="container">
    <div class="trainer-grid">
      <!-- Image -->
      <div class="trainer-image-wrap reveal-left">
        <img
          src="<?= e($trainer['photo'] ?? '') ?>"
          alt="<?= e($trainer['name'] ?? 'Marcus Muster') ?>"
          loading="lazy"
          width="600"
          height="800"
        >
      </div>

      <!-- Content -->
      <div class="trainer-content reveal-right">
        <span class="section-label">Ihr Personal Trainer in Wien</span>
        <h2 class="trainer-name"><?= e($trainer['name'] ?? 'Marcus Muster') ?></h2>
        <p class="trainer-title"><?= e($trainer['title'] ?? '') ?></p>
        <p class="trainer-bio"><?= e($trainer['bio'] ?? '') ?></p>
        <?php if (!empty($trainer['bio2'])): ?>
        <p class="trainer-bio"><?= e($trainer['bio2']) ?></p>
        <?php endif; ?>

        <?php if (!empty($trainer['specs'])): ?>
        <div class="trainer-specs">
          <?php foreach ($trainer['specs'] as $spec): ?>
          <div class="trainer-spec">
            <span class="trainer-spec-icon"><?= e($spec['icon'] ?? '') ?></span>
            <div>
              <div class="trainer-spec-label"><?= e($spec['label'] ?? '') ?></div>
              <div class="trainer-spec-value"><?= e($spec['value'] ?? '') ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($trainer['specializations'])): ?>
        <div style="margin-bottom:32px">
          <p style="color:rgba(255,255,255,.5);font-size:.78rem;text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:12px">Spezialisierungen</p>
          <div style="display:flex;flex-direction:column;gap:8px">
            <?php foreach ($trainer['specializations'] as $spec): ?>
            <div style="display:flex;align-items:center;gap:10px;font-size:.88rem;color:rgba(255,255,255,.75)">
              <span style="color:var(--gold)"><?= icon('check') ?></span>
              <?= e($spec) ?>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     BENEFITS / KRAFTTRAINING
════════════════════════════════════════════════ -->
<section class="benefits-section section-pad" id="krafttraining">
  <div class="container">
    <div class="benefits-header reveal">
      <span class="section-label" style="justify-content:center"><?= e($benefits['label'] ?? 'Warum Krafttraining') ?></span>
      <h2><?= e($benefits['headline'] ?? 'Krafttraining grenzt an ein Wundermittel') ?></h2>
      <p style="color:rgba(255,255,255,.55);max-width:560px;margin:16px auto 0;font-size:1.05rem"><?= e($benefits['subtext'] ?? '') ?></p>
    </div>

    <?php if (!empty($benefits['items'])): ?>
    <div class="benefits-grid">
      <?php foreach ($benefits['items'] as $i => $b): ?>
      <div class="benefit-card reveal reveal-delay-<?= ($i % 3) + 1 ?>">
        <div class="benefit-icon"><?= e($b['icon'] ?? '✓') ?></div>
        <h4 class="benefit-title"><?= e($b['title'] ?? '') ?></h4>
        <p class="benefit-text"><?= e($b['text'] ?? '') ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     TESTIMONIALS
════════════════════════════════════════════════ -->
<section class="testimonials-section section-pad" id="bewertungen">
  <div class="container">
    <div class="reviews-header reveal">
      <div>
        <span class="section-label">Was Kunden sagen</span>
        <h2>Echte Erfolge,<br>echte Menschen</h2>
      </div>
      <div class="reviews-score">
        <div class="reviews-meta">
          <div class="reviews-stars">
            <span class="star">★</span><span class="star">★</span><span class="star">★</span>
            <span class="star">★</span><span class="star">★</span>
          </div>
          <div class="reviews-count">65 Google-Bewertungen</div>
          <div style="display:flex;align-items:center;gap:4px;margin-top:4px">
            <?= icon('google') ?>
            <span style="font-size:.72rem;color:var(--text-muted)">Google</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Testimonials Slider (max. 2) -->
    <div class="testimonials-slider" id="testimonialsSlider">
      <div class="testimonials-track">
      <?php foreach ($testimonials as $i => $t): ?>
      <div class="testimonial-card testimonial-slide">
        <!-- Stars -->
        <div class="testimonial-stars">
          <?php for ($s = 0; $s < ($t['rating'] ?? 5); $s++): ?>
          <span class="star">★</span>
          <?php endfor; ?>
        </div>

        <!-- Text -->
        <p class="testimonial-text">"<?= e($t['text'] ?? '') ?>"</p>

        <!-- Author -->
        <div class="testimonial-author">
          <div class="testimonial-avatar"><?= e(substr($t['name'] ?? 'A', 0, 1)) ?></div>
          <div>
            <div class="testimonial-name"><?= e($t['name'] ?? '') ?></div>
            <div class="testimonial-date"><?= e($t['date'] ?? '') ?></div>
          </div>
          <div class="google-badge" style="margin-left:auto">
            <?= icon('google') ?> Google
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      </div><!-- /.testimonials-track -->
    </div><!-- /.testimonials-slider -->

    <!-- Slider Controls -->
    <div class="slider-controls">
      <button class="slider-btn slider-prev" id="testimonialPrev" aria-label="Vorherige Bewertung">&#8592;</button>
      <div class="slider-dots" id="testimonialDots"></div>
      <button class="slider-btn slider-next" id="testimonialNext" aria-label="Nächste Bewertung">&#8594;</button>
    </div>

    <div style="text-align:center;margin-top:32px">
      <a
        href="<?= e($site['google_reviews_url'] ?? '#') ?>"
        target="_blank" rel="noopener"
        class="btn btn-outline-dark"
      >
        Alle Bewertungen auf Google ansehen <?= icon('arrow-right') ?>
      </a>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     CTA BANNER
════════════════════════════════════════════════ -->
<section class="cta-banner">
  <div class="container">
    <div class="reveal">
      <span class="section-label" style="justify-content:center;margin-bottom:16px">Kostenlos & unverbindlich</span>
      <h2>Starte heute mit deinem<br>gratis Probetraining</h2>
      <p>Lerne Marcus und das Studio kennen – ohne Verpflichtung, ohne Risiko. Einfach testen, ob FlexFit zu dir passt.</p>
      <div class="cta-banner-actions">
        <a href="/probetraining.php" class="btn btn-primary btn-lg">
          Jetzt Probetraining buchen <?= icon('arrow-right') ?>
        </a>
        <a href="/kontakt.php" class="btn btn-outline btn-lg">Kontakt aufnehmen</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

