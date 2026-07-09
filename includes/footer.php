<?php
$site = $content['site'] ?? [];
?>
<!-- FLOATING CTA -->
<div class="floating-cta" id="floatingCta">
  <span class="floating-cta-text">Bereit loszulegen?</span>
  <a href="/probetraining.php" class="btn btn-primary">
    Gratis Probetraining <?= icon('arrow-right') ?>
  </a>
</div>

<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <!-- Brand -->
      <div class="footer-brand">
        <div class="footer-logo">
          <img src="<?= e($site['logo'] ?? '') ?>" alt="FlexFit" width="36" height="36">
          <span class="footer-logo-name">FlexFit</span>
        </div>
        <p class="footer-tagline">Personal Training in Wien – individuell, wissenschaftlich fundiert, mit echten Ergebnissen.<br>Mustergasse 12, 1080 Wien</p>
        <div class="footer-socials">
          <?php if (!empty($site['instagram'])): ?>
          <a href="<?= e($site['instagram']) ?>" target="_blank" rel="noopener" class="social-btn" aria-label="Instagram">
            <?= icon('instagram') ?>
          </a>
          <?php endif; ?>
          <?php if (!empty($site['facebook'])): ?>
          <a href="<?= e($site['facebook']) ?>" target="_blank" rel="noopener" class="social-btn" aria-label="Facebook">
            <?= icon('facebook') ?>
          </a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Links -->
      <div>
        <p class="footer-nav-title">Leistungen</p>
        <div class="footer-nav-links">
          <a href="/personal-training.php" class="footer-nav-link">Personal Training</a>
          <a href="/personal-training.php#kleingruppe" class="footer-nav-link">Kleingruppentraining</a>
          <a href="/firmenfitness.php" class="footer-nav-link">Firmenfitness</a>
          <a href="/physiotherapie.php" class="footer-nav-link">Physiotherapie</a>
        </div>
      </div>

      <div>
        <p class="footer-nav-title">Studio</p>
        <div class="footer-nav-links">
          <a href="/studio.php" class="footer-nav-link">Unser Studio</a>
          <a href="/team.php" class="footer-nav-link">Das Team</a>
          <a href="/blog.php" class="footer-nav-link">Blog & Insights</a>
          <a href="/probetraining.php" class="footer-nav-link">Gratis Probetraining</a>
        </div>
      </div>

      <div>
        <p class="footer-nav-title">Kontakt</p>
        <div class="footer-nav-links">
          <a href="<?= e($site['maps_url'] ?? '#') ?>" target="_blank" rel="noopener" class="footer-nav-link">
            Mustergasse 12, 1080 Wien
          </a>
          <a href="mailto:<?= e($site['email'] ?? '') ?>" class="footer-nav-link">
            <?= e($site['email'] ?? '') ?>
          </a>
          <a href="/kontakt.php" class="footer-nav-link">Kontaktformular</a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p class="footer-copy">© <?= date('Y') ?> FlexFit Personal Training e.U. · Marcus Muster · Alle Rechte vorbehalten.</p>
      <div class="footer-legal">
        <a href="/impressum.php">Impressum</a>
        <a href="/datenschutz.php">Datenschutz</a>
        <a href="/agb.php">AGB</a>
      </div>
    </div>
  </div>
</footer>

</div><!-- /.site-wrapper -->

<!-- JS -->
<script src="/assets/js/main.js" defer></script>
</body>
</html>
