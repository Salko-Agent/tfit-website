<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content  = load_flat_content();
$seo_key  = 'kontakt';
require_once __DIR__ . '/includes/header.php';
$site     = $content['site'] ?? [];
$_kontakt = $content['_kontakt'] ?? [];
$k_hero   = $_kontakt['hero']['data'] ?? [];
?>

<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px"><?= e($k_hero['label'] ?? 'Kontakt') ?></span>
    <h1><?= e($k_hero['headline'] ?? 'Kontakt') ?></h1>
    <p style="max-width:640px;margin:0 auto"><?= e($k_hero['subtext'] ?? 'Der Weg zu mehr Lebensqualität & Fitness: Sichern Sie sich jetzt Ihr kostenloses, unverbindliches Probetraining bei FlexFit Personal Training Wien.') ?></p>
  </div>
</section>

<section class="contact-section section-pad">
  <div class="container">
    <div class="contact-grid">
      <div>
        <span class="section-label">Infos & Standort</span>
        <h2 class="section-title">Besuch uns in<br>Wien 1080</h2>
        <p class="section-subtitle" style="margin-bottom:32px">Unser privates Studio liegt zentral in der Josefstadt – stressfrei erreichbar, exklusiv für dich.</p>

        <div class="contact-info">
          <div class="contact-item reveal">
            <div class="contact-item-icon"><?= icon('location') ?></div>
            <div>
              <div class="contact-item-label">Adresse</div>
              <div class="contact-item-value">
                <a href="<?= e($site['maps_url'] ?? '#') ?>" target="_blank" rel="noopener">
                  Mustergasse 12, 1080 Wien
                </a>
              </div>
            </div>
          </div>
          <div class="contact-item reveal reveal-delay-1">
            <div class="contact-item-icon"><?= icon('mail') ?></div>
            <div>
              <div class="contact-item-label">E-Mail</div>
              <div class="contact-item-value">
                <a href="mailto:<?= e($site['email'] ?? '') ?>"><?= e($site['email'] ?? '') ?></a>
              </div>
            </div>
          </div>
          <div class="contact-item reveal reveal-delay-2">
            <div class="contact-item-icon"><?= icon('clock') ?></div>
            <div>
              <div class="contact-item-label">Öffnungszeiten</div>
              <div class="contact-item-value">
                Mo–Fr: 7:00–21:00 Uhr<br>
                <span style="color:var(--text-secondary)">Sa: 9:00–16:00 Uhr</span>
              </div>
            </div>
          </div>
        </div>

        <div style="margin-top:24px;border-radius:var(--r-md);overflow:hidden;border:1px solid var(--border-light)">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2658.3!2d16.3508!3d48.2105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d07c2e74cdca3%3A0x8f4ae0e76e4c4!2sMustergasse+50%2C+1080+Wien!5e0!3m2!1sde!2sat!4v1"
            width="100%" height="250" style="border:0;display:block" allowfullscreen loading="lazy"
            title="FlexFit Wien Standort">
          </iframe>
        </div>

        <div style="margin-top:24px;display:flex;gap:12px;flex-wrap:wrap">
          <a href="<?= e($site['instagram'] ?? '#') ?>" target="_blank" rel="noopener" class="btn btn-outline-dark">
            <?= icon('instagram') ?> &nbsp;Instagram
          </a>
          <a href="<?= e($site['facebook'] ?? '#') ?>" target="_blank" rel="noopener" class="btn btn-outline-dark">
            <?= icon('facebook') ?> &nbsp;Facebook
          </a>
        </div>
      </div>

      <div class="contact-form-wrap reveal-right">
        <h3 class="contact-form-title">Schreib uns</h3>
        <p class="contact-form-sub">Oder buche direkt ein <a href="/probetraining.php" style="color:var(--gold);font-weight:600">gratis Probetraining</a>.</p>

        <form id="contactForm" novalidate>
          <?= csrf_field() ?>
          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="fname">Vorname *</label>
              <input class="form-input" id="fname" name="firstname" type="text" placeholder="Max" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="lname">Nachname *</label>
              <input class="form-input" id="lname" name="lastname" type="text" placeholder="Mustermann" required>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="email">E-Mail *</label>
            <input class="form-input" id="email" name="email" type="email" placeholder="max@beispiel.at" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="interest">Ich interessiere mich für</label>
            <select class="form-select" id="interest" name="interest">
              <option value="">Bitte wählen…</option>
              <option value="personal-training">Personal Training (1:1)</option>
              <option value="kleingruppe">Kleingruppentraining</option>
              <option value="firmenfitness">Firmenfitness</option>
              <option value="probetraining">Gratis Probetraining</option>
              <option value="sonstiges">Sonstiges</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="message">Nachricht *</label>
            <textarea class="form-textarea" id="message" name="message" placeholder="Deine Nachricht…" required></textarea>
          </div>
          <div class="form-submit-row">
            <p class="form-privacy"><a href="/datenschutz.php" style="color:var(--gold)">Datenschutzerklärung</a></p>
            <button type="submit" class="btn btn-primary">Absenden <?= icon('arrow-right') ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
