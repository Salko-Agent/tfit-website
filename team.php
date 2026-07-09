<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content  = load_flat_content();
$seo_key  = 'team';
$site     = $content['site'] ?? [];
$_team    = $content['_team'] ?? [];
$tm_hero  = $_team['hero']['data']          ?? [];
$tm_train = $_team['trainers']['data']      ?? [];
$tm_physio= $_team['physiotherapie']['data']?? [];
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px"><?= e($tm_hero['label'] ?? 'Unser Team') ?></span>
    <h1><?= e($tm_hero['headline'] ?? 'Unser Team') ?></h1>
    <p><?= e($tm_hero['subtext'] ?? 'Wir sind stets bemüht, Ihnen durch enge Zusammenarbeit unseres Teams eine optimale Betreuung zu gewähren.') ?></p>
  </div>
</section>

<!-- TRAINER -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container">
    <div class="text-center reveal" style="margin-bottom:48px">
      <span class="section-label">Personal Training</span>
      <h2><?= e($tm_train['label'] ?? 'Unser Trainerteam') ?></h2>
    </div>

    <?php
    // Load trainer profiles from JSON files
    $all_trainers = load_trainers();
    $pt_slugs = ['marcus-kohler', 'eric-weber', 'hannah-meyer'];
    foreach ($pt_slugs as $i => $tr_slug):
      $tr = $all_trainers[$tr_slug] ?? null;
      if (!$tr) continue;
    ?>
    <div class="team-trainer-card reveal">

      <!-- Photo column -->
      <div class="team-trainer-photo">
        <img src="<?= e($tr['image'] ?? '') ?>" alt="<?= e($tr['name'] ?? '') ?>">
        <div class="team-trainer-photo-fade"></div>
      </div>

      <!-- Content column -->
      <div class="team-trainer-body">
        <div class="team-trainer-header">
          <div>
            <div class="team-trainer-name"><?= e($tr['name'] ?? '') ?></div>
            <div class="team-trainer-role"><?= e($tr['role'] ?? '') ?></div>
            <?php if (!empty($tr['experience'])): ?>
            <div class="team-trainer-exp"><?= e($tr['experience']) ?></div>
            <?php endif; ?>
          </div>
          <a href="/trainer/<?= e($tr_slug) ?>" class="team-trainer-link">Profil &rarr;</a>
        </div>

        <div class="team-trainer-line"></div>

        <?php if (!empty($tr['bio'])): ?>
        <p class="team-trainer-bio"><?= e(substr($tr['bio'], 0, 220)) ?>...</p>
        <?php endif; ?>

        <?php if (!empty($tr['specializations'])): ?>
        <div class="team-trainer-spez-label">Spezialisierungen</div>
        <div class="team-trainer-tags">
          <?php foreach(array_slice($tr['specializations'], 0, 4) as $s): ?>
          <span class="team-trainer-tag"><?= e($s) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

    </div>
    <?php endforeach; ?>

  </div>
</section>

<!-- PHYSIO-TEAM -->
<section class="section-pad" style="background:var(--white)">
  <div class="container" style="max-width:640px">
    <div class="text-center reveal" style="margin-bottom:32px">
      <span class="section-label"><?= e($tm_physio['label'] ?? 'Physiotherapie') ?></span>
      <h2>Unser Physio-Team</h2>
      <p style="color:var(--text-secondary)">Kontaktieren Sie den Therapeuten Ihrer Wahl direkt für einen Termin.</p>
    </div>
    <div class="card">
      <div class="card-body" style="padding:24px 32px">
        <?php
        $physio_slugs = [
          ['slug'=>'paul-huber', 'phone'=>'+43 1 2345678'],
          ['slug'=>'sarah-meier',   'phone'=>'+43 677 617 365 10'],
          ['slug'=>'thomas-schmid',      'phone'=>'+43 1 2345678'],
          ['slug'=>'jona-beck',         'phone'=>'+43 660 745 41 98'],
          ['slug'=>'elena-fischer',      'phone'=>'+43 660 13 08 165'],
          ['slug'=>'sophie-wagner',        'phone'=>'+43 660 526 62 45'],
        ];
        foreach($physio_slugs as $ph):
          $ph_data = $all_trainers[$ph['slug']] ?? null;
          $name = $ph_data ? $ph_data['name'] : $ph['slug'];
          $in_k = !empty($ph_data['in_karenz']);
        ?>
        <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid var(--border-light);gap:12px;flex-wrap:wrap">
          <div style="display:flex;align-items:center;gap:10px">
            <?php if (!empty($ph_data['image'])): ?>
            <img src="<?= e($ph_data['image']) ?>" alt="<?= e($name) ?>" style="width:40px;height:40px;border-radius:50%;object-fit:cover;object-position:top;border:2px solid var(--border-light)">
            <?php endif; ?>
            <div>
              <a href="/trainer/<?= e($ph['slug']) ?>" style="font-weight:600;color:var(--text-primary);text-decoration:none"><?= e($name) ?></a>
              <?php if ($in_k): ?><span style="font-size:.72rem;color:var(--text-muted);margin-left:6px">(in Karenz)</span><?php endif; ?>
              <?php if ($ph_data): ?><div style="font-size:.78rem;color:var(--text-muted)"><?= e($ph_data['role'] ?? '') ?></div><?php endif; ?>
            </div>
          </div>
          <a href="tel:<?= e(preg_replace('/[^+\d]/','',$ph['phone'])) ?>" class="btn btn-outline-dark" style="font-size:.82rem"><?= e($ph['phone']) ?></a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div style="text-align:center;margin-top:24px">
      <a href="/physiotherapie.php" style="color:var(--gold);font-weight:600">&rarr; Mehr zur Physiotherapie bei FlexFit</a>
    </div>
  </div>
</section>

<!-- ERREICHBARKEIT -->
<section class="section-pad" style="background:var(--off-white)">
  <div class="container" style="max-width:640px">
    <div class="text-center reveal">
      <span class="section-label">Standort</span>
      <h2 style="margin-bottom:16px">So finden Sie uns</h2>
      <p style="color:var(--text-secondary);line-height:1.7">Zu Fu&szlig;, &ouml;ffentlich, mit dem Rad oder dem Auto ist unser Studio aus den angrenzenden Bezirken 1070, 1090, 1160, 1170 sowie 1180 sehr gut erreichbar.</p>
      <div style="margin-top:24px;padding:20px;background:var(--white);border-radius:var(--r-md);border:1px solid var(--border-light)">
        <div style="font-weight:700;margin-bottom:4px">FlexFit Personal Training e.U.</div>
        <div style="font-weight:700;margin-bottom:4px">K&ouml;hler Fitness KG</div>
        <div style="color:var(--text-secondary)">Mustergasse 12, 1080 Wien</div>
        <div style="color:var(--text-muted);font-size:.88rem;margin-top:4px">marcus@flexfit-demo.at</div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Lerne unser Team kennen</h2>
    <p>Wagnere dein kostenloses Probetraining und triff unser Team pers&ouml;nlich.</p>
    <div class="cta-banner-actions">
      <a href="/probetraining" class="btn btn-primary btn-lg">Probetraining buchen <?= icon('arrow-right') ?></a>
      <a href="/kontakt" class="btn btn-outline btn-lg">Kontakt aufnehmen</a>
    </div>
  </div></div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
