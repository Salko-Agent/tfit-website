<?php
header('Content-Type: application/xml; charset=UTF-8');
require_once __DIR__ . '/includes/functions.php';
$base = rtrim(getenv('SITE_URL') ?: 'https://flexfit-demo.at', '/');
$now  = date('Y-m-d');

$pages = [
    ['/', '1.0', 'weekly'],
    ['/personal-training', '0.9', 'monthly'],
    ['/firmenfitness', '0.9', 'monthly'],
    ['/physiotherapie', '0.9', 'monthly'],
    ['/studio', '0.8', 'monthly'],
    ['/team', '0.8', 'monthly'],
    ['/blog', '0.8', 'weekly'],
];

// Dynamically add all blog articles
foreach (load_articles() as $slug => $art) {
    $pages[] = ['/blog/' . $slug, '0.7', 'yearly'];
}

$pages = array_merge($pages, [
    ['/kontakt', '0.7', 'monthly'],
    ['/probetraining', '0.7', 'monthly'],
    ['/impressum', '0.3', 'yearly'],
    ['/datenschutz', '0.3', 'yearly'],
    ['/agb', '0.3', 'yearly'],
]);

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as [$path, $priority, $freq]): ?>
  <url>
    <loc><?= $base . $path ?></loc>
    <lastmod><?= $now ?></lastmod>
    <changefreq><?= $freq ?></changefreq>
    <priority><?= $priority ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
