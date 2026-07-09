<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();
$seo_key = 'blog';
$blog_hero  = $content['_blog']['hero']['data'] ?? [];

// Load articles from individual JSON files
$articles = load_articles();

require_once __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="container">
    <span class="section-label" style="justify-content:center;margin-bottom:16px"><?= e($blog_hero['label'] ?? 'Blog & Wissen') ?></span>
    <h1><?= $blog_hero['headline'] ?? 'Training. Ern&auml;hrung.<br>Gesundheit.' ?></h1>
    <p><?= e($blog_hero['subtext'] ?? 'Wissenschaftlich fundierte Artikel von Sportwissenschaftler Marcus Muster.') ?></p>
  </div>
</section>
<section class="section-pad" style="background:var(--off-white)">
  <div class="container">
    <div class="sg3">
<?php $i = 0; foreach ($articles as $slug => $art):
    $delay = ($i % 3) + 1;
?>
      <a href="/blog/<?= e($slug) ?>" class="card card-link reveal reveal-delay-<?= $delay ?>" style="display:block;text-decoration:none;color:inherit">
        <?php if (!empty($art['image'])): ?>
        <div class="card-img" style="aspect-ratio:16/10;overflow:hidden">
          <img src="<?= e($art['image']) ?>" alt="<?= e($art['title']) ?>" loading="lazy" style="width:100%;height:100%;object-fit:cover">
        </div>
        <?php endif; ?>
        <div class="card-body" style="padding:28px">
          <div style="font-size:.78rem;color:var(--text-muted);margin-bottom:8px"><?= e($art['date']) ?></div>
          <h3 style="font-size:1.05rem;margin-bottom:8px;color:var(--text-primary)"><?= e($art['title']) ?></h3>
          <p style="font-size:.88rem;color:var(--text-secondary);margin-bottom:16px"><?= e($art['excerpt']) ?></p>
          <span style="color:var(--gold);font-size:.85rem;font-weight:600">Weiterlesen &rarr;</span>
        </div>
      </a>
<?php $i++; endforeach; ?>
    </div>
  </div>
</section>
<section class="cta-banner">
  <div class="container"><div class="reveal">
    <h2>Dein Weg zu mehr Gesundheit</h2>
    <p>Theorie alleine reicht nicht. Wagnere dein kostenloses Probetraining und starte durch.</p>
    <div class="cta-banner-actions">
      <a href="/probetraining.php" class="btn btn-primary btn-lg">Probetraining buchen <?= icon('arrow-right') ?></a>
    </div>
  </div></div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
