<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'home';
$content['seo']['home']['title']       = 'PureRelax Massage Wien 1080 – Christian & Christina Wagner | FlexFit';
$content['seo']['home']['description'] = 'PureRelax Massage in Wien 1080, Mustergasse 12. Klassische Massage, Sportmassage, Entspannungsmassage, Nuad Thai. Jetzt Termin vereinbaren.';
$site = $content['site'] ?? [];
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px">📍 Massage Wien 1080</span>
    <h1>PureRelax Massage 1080 Wien</h1>
    <p style="max-width:600px;margin:16px auto 0;color:rgba(255,255,255,.75);font-size:1.05rem;line-height:1.7">
      Christian &amp; Christina Wagner
    </p>
    <div style="margin-top:20px;display:flex;flex-wrap:wrap;gap:12px;justify-content:center;font-size:.9rem;color:rgba(255,255,255,.55)">
      <span>Hauptadresse: Musterstraße 45/2, 1180 Wien</span>
      <span style="color:rgba(255,255,255,.3)">·</span>
      <span>Nebenadresse: Mustergasse 12, 1080 Wien</span>
    </div>
    <div style="margin-top:10px;display:flex;flex-wrap:wrap;gap:16px;justify-content:center">
      <a href="tel:+4312345678" class="btn btn-primary btn-lg" style="margin-top:16px">
        <?= icon('phone') ?> +43 1 2345678
      </a>
    </div>
  </div>
</section>

<!-- INFO BANNER -->
<section style="background:var(--gold);padding:14px 0">
  <div class="container" style="text-align:center">
    <p style="color:var(--dark);font-weight:600;margin:0;font-size:.95rem">
      Bitte teilen Sie uns mit, wenn Sie eine Massage am Standort 1080 wünschen.
    </p>
  </div>
</section>

<!-- INTRO -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:860px">
    <div class="text-center reveal" style="margin-bottom:36px">
      <span class="section-label">Massage Wien Josefstadt</span>
      <h2>Ihre erfahrenen Masseure in der Josefstadt, 1080 Wien</h2>
    </div>
    <div class="card reveal">
      <div class="card-body" style="padding:40px">
        <p style="font-size:1.05rem;color:var(--text-secondary);line-height:1.8;margin:0">
          Willkommen in der Welt der Entspannung und des Wohlbefindens. Unsere Massage in 1080 Wien bietet Ihnen
          eine Auszeit vom hektischen Alltag, um Körper und Geist zu regenerieren. Erfahrene Masseure und eine
          ruhige Atmosphäre erwarten Sie, um Ihre Sinne zu verwöhnen und Verspannungen zu lösen.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:860px">
    <div class="reveal" style="margin-bottom:36px">
      <span class="section-label">Angebote</span>
      <h2>Unsere Massageangebote</h2>
    </div>
    <div class="sg3" style="gap:16px">
      <?php
      $services = [
        ['icon' => '🙌', 'title' => 'Klassische Massage',       'desc' => 'Die bewährte Ganzkörper- oder Teilkörpermassage zur Entspannung und Durchblutungsförderung.'],
        ['icon' => '🏃', 'title' => 'Sportmassage',             'desc' => 'Gezielte Behandlung für Sportler – vor oder nach dem Training, zur Regeneration und Verletzungsprävention.'],
        ['icon' => '🌿', 'title' => 'Entspannungsmassage',      'desc' => 'Sanfte Massagetechniken für tiefe Entspannung und Stressabbau.'],
        ['icon' => '🧘', 'title' => 'Nuad Thai Massage',        'desc' => 'Traditionelle Thai-Massage für mehr Beweglichkeit, Energie und ganzheitliches Wohlbefinden.'],
        ['icon' => '🔔', 'title' => 'Klangtherapie',            'desc' => 'Klangschalen-Behandlung zur Harmonisierung von Körper und Geist.'],
        ['icon' => '🫙', 'title' => 'Schröpfen',                'desc' => 'Traditionelle Schröpftherapie zur Förderung der Durchblutung und Lösung von Verspannungen.'],
      ];
      foreach ($services as $i => $svc): ?>
      <div class="card reveal reveal-delay-<?= ($i % 3) + 1 ?>">
        <div class="card-body" style="padding:24px">
          <div style="font-size:2rem;margin-bottom:10px"><?= $svc['icon'] ?></div>
          <h3 style="font-size:1rem;margin-bottom:8px"><?= e($svc['title']) ?></h3>
          <p style="font-size:.88rem;color:var(--text-secondary);line-height:1.65;margin:0"><?= e($svc['desc']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- GESUNDHEITLICHE AUSWIRKUNGEN -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:780px">
    <div class="reveal" style="margin-bottom:32px">
      <span class="section-label">Gesundheit</span>
      <h2>Gesundheitliche Auswirkungen von Massage</h2>
    </div>
    <div class="card reveal">
      <div class="card-body" style="padding:36px">
        <p style="color:var(--text-secondary);line-height:1.8;margin-bottom:20px">
          Eine Massage ist nicht nur ein Vergnügen &amp; Entspannung, sondern kann auch eine Reihe von
          gesundheitlichen Vorteilen bieten.
        </p>
        <div style="display:flex;align-items:flex-start;gap:16px;padding:16px 20px;background:var(--off-white);border-radius:var(--r-md);border-left:4px solid var(--gold)">
          <div style="font-size:1.5rem;flex-shrink:0">🧘</div>
          <div>
            <div style="font-weight:700;margin-bottom:6px;color:var(--text-primary)">Stressabbau</div>
            <div style="color:var(--text-secondary);font-size:.95rem;line-height:1.7">
              Eine Massage kann Stresshormone reduzieren und ein Gefühl der Entspannung herbeiführen.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- KONTAKT / STANDORTE -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:780px">
    <div class="text-center reveal" style="margin-bottom:36px">
      <span class="section-label">Standorte &amp; Kontakt</span>
      <h2>PureRelax Massage – Wir sind für Sie da</h2>
    </div>
    <div class="sg2" style="gap:20px">
      <div class="card reveal">
        <div class="card-body" style="padding:28px">
          <h3 style="font-size:1rem;margin-bottom:16px;color:var(--gold)">Hauptadresse</h3>
          <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:8px">
            Musterstraße 45/2<br>1180 Wien
          </p>
          <a href="tel:+4312345678" style="display:flex;align-items:center;gap:8px;color:var(--text-primary);font-weight:600;text-decoration:none">
            <?= icon('phone') ?> +43 1 2345678
          </a>
        </div>
      </div>
      <div class="card reveal reveal-delay-2">
        <div class="card-body" style="padding:28px">
          <h3 style="font-size:1rem;margin-bottom:16px;color:var(--gold)">Nebenadresse – 1080 Wien</h3>
          <p style="color:var(--text-secondary);line-height:1.7;margin-bottom:8px">
            Mustergasse 12<br>1080 Wien
          </p>
          <p style="color:var(--text-muted);font-size:.88rem;margin:0">
            Bitte bei Terminbuchung angeben, wenn gewünscht.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Termin vereinbaren</h2>
    <p>Rufen Sie uns an oder schreiben Sie uns – wir freuen uns auf Ihren Besuch.</p>
    <div class="cta-banner-actions">
      <a href="tel:+4312345678" class="btn btn-primary btn-lg">
        <?= icon('phone') ?> +43 1 2345678
      </a>
      <a href="mailto:<?= e($site['email'] ?? 'marcus@flexfit-demo.at') ?>" class="btn btn-outline btn-lg">
        <?= icon('mail') ?> E-Mail schreiben
      </a>
    </div>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
