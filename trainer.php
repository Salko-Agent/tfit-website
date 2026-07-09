<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();

// Get slug from query string
$slug = $_GET['slug'] ?? '';
$slug = preg_replace('/[^a-z0-9\-]/', '', $slug);

// Load trainer data
$trainer = load_trainer($slug);

if (!$slug || !$trainer) {
    header('Location: /team.php');
    exit;
}

$seo_key = 'team';

// Override SEO for this profile
$content['seo']['team']['title']       = $trainer['seo_title']       ?? ($trainer['name'] . ' | FlexFit');
$content['seo']['team']['description'] = $trainer['seo_description'] ?? '';

require_once __DIR__ . '/includes/header.php';

$type       = $trainer['type']       ?? 'trainer';
$is_physio  = in_array($type, ['physio', 'cranio']);
$in_karenz  = !empty($trainer['in_karenz']);
$contact    = $trainer['contact']    ?? [];
?>

<!-- Hero -->
<div class="trainer-hero" style="background:var(--dark);padding:100px 0 0;position:relative;overflow:hidden">
  <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 60% 50%, rgba(192,148,43,.15) 0%, transparent 70%)"></div>
  <div class="container" style="position:relative;z-index:1">
    <div class="trainer-hero-inner">

      <!-- Photo -->
      <div class="trainer-hero-photo-wrap">
        <?php if (!empty($trainer['image'])): ?>
        <div class="trainer-hero-photo-frame">
          <img src="<?= e($trainer['image']) ?>" alt="<?= e($trainer['name']) ?>">
        </div>
        <?php endif; ?>
      </div>

      <!-- Info -->
      <div class="trainer-hero-info">
        <a href="/team.php" style="display:inline-flex;align-items:center;gap:6px;color:var(--gold);font-size:.85rem;font-weight:600;text-decoration:none;margin-bottom:24px;opacity:.8">&larr; Zurück zum Team</a>

        <?php if ($in_karenz): ?>
        <div style="display:inline-block;background:rgba(255,200,0,.15);border:1px solid rgba(255,200,0,.3);color:#ffd700;font-size:.75rem;font-weight:600;padding:4px 12px;border-radius:99px;margin-bottom:12px;letter-spacing:.05em">AKTUELL IN KARENZ</div>
        <?php endif; ?>

        <div style="font-size:.85rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:var(--gold);margin-bottom:8px"><?= e($trainer['role'] ?? '') ?></div>
        <h1 style="color:var(--white);font-size:clamp(1.8rem,4vw,2.8rem);margin-bottom:8px;line-height:1.15"><?= e($trainer['title'] ?? $trainer['name']) ?></h1>
        <p style="color:rgba(255,255,255,.6);font-size:1rem;margin-bottom:20px"><?= e($trainer['subtitle'] ?? '') ?></p>

        <?php if (!empty($trainer['experience'])): ?>
        <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(192,148,43,.15);border:1px solid rgba(192,148,43,.3);border-radius:99px;padding:6px 16px;margin-bottom:24px">
          <span style="color:var(--gold);font-size:.8rem;font-weight:600"><?= e($trainer['experience']) ?></span>
        </div>
        <?php endif; ?>

        <?php if (!empty($contact['phone']) || !empty($contact['email'])): ?>
        <div style="display:flex;gap:12px;flex-wrap:wrap">
          <?php if (!empty($contact['phone'])): ?>
          <a href="tel:<?= e(preg_replace('/[^+\d]/','',$contact['phone'])) ?>" class="btn btn-primary"><?= icon('phone') ?> <?= e($contact['phone']) ?></a>
          <?php endif; ?>
          <?php if (!empty($contact['email'])): ?>
          <a href="mailto:<?= e($contact['email']) ?>" class="btn btn-outline"><?= icon('mail') ?> <?= e($contact['email']) ?></a>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>

    </div><!-- /.trainer-hero-inner -->
  </div>
</div>

<!-- Main Content -->
<div style="background:var(--off-white);padding:64px 0">
  <div class="container-narrow">

    <?php if (!empty($trainer['quote'])): ?>
    <!-- Quote -->
    <blockquote style="background:var(--white);border-left:4px solid var(--gold);border-radius:0 var(--r-md) var(--r-md) 0;padding:24px 32px;margin:0 0 40px;box-shadow:0 2px 12px rgba(0,0,0,.06)">
      <p style="font-size:1.05rem;color:var(--text-primary);line-height:1.7;margin:0 0 8px;font-style:italic">"<?= e($trainer['quote']) ?>"</p>
      <cite style="font-size:.85rem;color:var(--gold);font-weight:600;font-style:normal">– <?= e($trainer['name']) ?></cite>
    </blockquote>
    <?php endif; ?>

    <!-- Bio -->
    <?php if (!empty($trainer['bio'])): ?>
    <div class="card" style="margin-bottom:32px">
      <div class="card-body" style="padding:32px">
        <h2 style="font-size:1.15rem;margin-bottom:16px">Über mich</h2>
        <p style="color:var(--text-secondary);line-height:1.75"><?= e($trainer['bio']) ?></p>
        <?php if (!empty($trainer['hours'])): ?>
        <div style="margin-top:16px;padding:12px 16px;background:var(--off-white);border-radius:var(--r-sm);display:flex;align-items:center;gap:8px">
          <?= icon('clock') ?>
          <span style="font-size:.9rem;font-weight:600"><?= e($trainer['hours']) ?></span>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;margin-bottom:32px">

      <!-- Specializations -->
      <?php if (!empty($trainer['specializations'])): ?>
      <div class="card">
        <div class="card-body" style="padding:28px">
          <h2 style="font-size:1.05rem;margin-bottom:16px"><?= $is_physio ? 'Behandlungsschwerpunkte' : 'Meine Schwerpunkte' ?></h2>
          <ul style="list-style:none;padding:0;margin:0">
            <?php foreach($trainer['specializations'] as $spec): ?>
            <li style="display:flex;align-items:flex-start;gap:10px;padding:8px 0;border-bottom:1px solid var(--border-light);font-size:.9rem;color:var(--text-secondary)">
              <span style="color:var(--gold);font-size:.8rem;margin-top:3px;flex-shrink:0"><?= icon('check') ?></span>
              <?= e($spec) ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <?php endif; ?>

      <!-- Education -->
      <?php if (!empty($trainer['education'])): ?>
      <div class="card">
        <div class="card-body" style="padding:28px">
          <h2 style="font-size:1.05rem;margin-bottom:16px"><?= $is_physio ? 'Ausbildung & Fortbildungen' : 'Ausbildung & Erfahrungen' ?></h2>
          <ul style="list-style:none;padding:0;margin:0">
            <?php foreach($trainer['education'] as $edu): ?>
            <li style="display:flex;align-items:flex-start;gap:10px;padding:8px 0;border-bottom:1px solid var(--border-light);font-size:.88rem;color:var(--text-secondary)">
              <span style="width:6px;height:6px;border-radius:50%;background:var(--gold);flex-shrink:0;margin-top:6px"></span>
              <?= e($edu) ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <?php endif; ?>

    </div>

    <?php if (!empty($trainer['press'])): ?>
    <!-- Press mentions (Marcus only) -->
    <div class="card" style="margin-bottom:32px">
      <div class="card-body" style="padding:28px">
        <h2 style="font-size:1.05rem;margin-bottom:16px">Presse</h2>
        <p style="color:var(--text-secondary);font-size:.9rem;margin-bottom:16px">Es freut mich sehr, mein Fachwissen in diversen Medien und Artikeln der breiten Bevölkerung zugänglich zu machen.</p>
        <div style="display:flex;flex-wrap:wrap;gap:8px">
          <?php foreach($trainer['press'] as $p): ?>
          <span style="font-size:.82rem;padding:5px 12px;background:var(--off-white);border-radius:99px;color:var(--text-secondary);border:1px solid var(--border-light)">
            <strong style="color:var(--text-primary)"><?= e($p['name']) ?></strong>
            <span style="color:var(--text-muted);margin-left:4px"><?= e($p['date']) ?></span>
          </span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($trainer['prices'])): ?>
    <!-- Prices -->
    <div class="card" style="margin-bottom:32px">
      <div class="card-body" style="padding:28px">
        <h2 style="font-size:1.05rem;margin-bottom:4px">Preise</h2>
        <p style="font-size:.85rem;color:var(--text-muted);margin-bottom:20px">Ihre Investition in ein fitteres Leben</p>
        <div style="overflow:hidden;border-radius:var(--r-sm);border:1px solid var(--border-light)">
          <?php foreach($trainer['prices'] as $i => $pr):
            $bg = $i % 2 === 0 ? 'var(--off-white)' : 'var(--white)';
          ?>
          <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 16px;background:<?= $bg ?>;gap:16px">
            <span style="font-size:.9rem;color:var(--text-secondary)"><?= e($pr['label']) ?></span>
            <span style="font-size:.9rem;font-weight:700;color:var(--text-primary);white-space:nowrap"><?= e($pr['price']) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Contact block -->
    <div class="card" style="background:var(--dark);border-color:transparent">
      <div class="card-body" style="padding:32px">
        <h2 style="color:var(--white);font-size:1.05rem;margin-bottom:20px">Termin vereinbaren</h2>
        <div style="display:flex;flex-wrap:wrap;gap:12px;margin-bottom:20px">
          <?php if (!empty($contact['phone'])): ?>
          <a href="tel:<?= e(preg_replace('/[^+\d]/','',$contact['phone'])) ?>" class="btn btn-primary"><?= icon('phone') ?> <?= e($contact['phone']) ?></a>
          <?php endif; ?>
          <?php if (!empty($contact['email'])): ?>
          <a href="mailto:<?= e($contact['email']) ?>" class="btn btn-outline"><?= icon('mail') ?> <?= e($contact['email']) ?></a>
          <?php endif; ?>
          <?php if (!empty($contact['website'])): ?>
          <a href="<?= e($contact['website']) ?>" target="_blank" rel="noopener" class="btn btn-outline" style="color:var(--gold);border-color:var(--gold)">&rarr; Website</a>
          <?php endif; ?>
        </div>
        <?php if (!empty($contact['address'])): ?>
        <div style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.5);font-size:.85rem">
          <?= icon('location') ?>
          <?= e($contact['address']) ?>
        </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>

<?php if (!$is_physio): ?>
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Bereit für dein Probetraining?</h2>
    <p>Lerne <?= e($trainer['name']) ?> persönlich kennen – kostenlos & unverbindlich.</p>
    <div class="cta-banner-actions">
      <a href="/probetraining.php" class="btn btn-primary btn-lg">Probetraining buchen <?= icon('arrow-right') ?></a>
      <a href="/team.php" class="btn btn-outline btn-lg">Zurück zum Team</a>
    </div>
  </div></div>
</section>
<?php else: ?>
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Unser Physiotherapie-Team</h2>
    <p>Lernen Sie alle unsere Therapeutinnen und Therapeuten kennen.</p>
    <div class="cta-banner-actions">
      <a href="/physiotherapie.php" class="btn btn-primary btn-lg">Zur Physiotherapie <?= icon('arrow-right') ?></a>
      <a href="/team.php" class="btn btn-outline btn-lg">Zurück zum Team</a>
    </div>
  </div></div>
</section>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
