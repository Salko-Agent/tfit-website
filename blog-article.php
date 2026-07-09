<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
$content = load_flat_content();

// Get slug from query string
$slug = $_GET['slug'] ?? '';
$slug = preg_replace('/[^a-z0-9\-]/', '', $slug);

// Load single article
$article = load_article($slug);

if (!$slug || !$article) {
    header('Location: /blog.php');
    exit;
}

// Load all articles for prev/next navigation
$articles = load_articles();
$seo_key = 'blog';

// Override SEO for this article
$content['seo']['blog']['title'] = $article['title'] . ' | FlexFit Blog';
$content['seo']['blog']['description'] = $article['excerpt'];

require_once __DIR__ . '/includes/header.php';

// Get previous/next articles for navigation
$slugs = array_keys($articles);
$idx   = array_search($slug, $slugs);
$prev  = $idx > 0 ? $slugs[$idx - 1] : null;
$next  = $idx < count($slugs) - 1 ? $slugs[$idx + 1] : null;
?>

<article class="blog-article">
  <!-- Hero -->
  <div class="article-hero" <?php if ($article['image']): ?>style="background-image:linear-gradient(to bottom, rgba(0,0,0,.65), rgba(0,0,0,.85)), url('<?= e($article['image']) ?>')"<?php endif; ?>>
    <div class="container">
      <a href="/blog.php" class="article-back"><?= icon('arrow-right') ?> Zurück zum Blog</a>
      <div class="article-meta">
        <span class="article-date"><?= e($article['date']) ?></span>
      </div>
      <h1><?= e($article['title']) ?></h1>
    </div>
  </div>

  <!-- Content -->
  <div class="article-content">
    <div class="container-narrow">
      <?= $article['body'] ?>

      <!-- Author -->
      <div class="article-author">
        <img src="/assets/img/blog/marcus-author.jpeg" alt="<?= e($article['author']) ?>" class="article-author-img">
        <div>
          <strong><?= e($article['author']) ?></strong>
          <span><?= e($article['role']) ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="article-nav">
    <div class="container-narrow">
      <div class="article-nav-inner">
        <?php if ($prev): ?>
        <a href="/blog/<?= e($prev) ?>" class="article-nav-link article-nav-prev">
          <span class="article-nav-label">&larr; Vorheriger Artikel</span>
          <span class="article-nav-title"><?= e($articles[$prev]['title']) ?></span>
        </a>
        <?php else: ?><div></div><?php endif; ?>

        <?php if ($next): ?>
        <a href="/blog/<?= e($next) ?>" class="article-nav-link article-nav-next">
          <span class="article-nav-label">Nächster Artikel &rarr;</span>
          <span class="article-nav-title"><?= e($articles[$next]['title']) ?></span>
        </a>
        <?php else: ?><div></div><?php endif; ?>
      </div>
    </div>
  </div>
</article>

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
