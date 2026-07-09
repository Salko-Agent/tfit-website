<?php
if (!isset($content)) $content = load_content();
$site = $content['site'] ?? [];
$seo_key = $seo_key ?? 'home';
$seo = $content['seo'][$seo_key] ?? [];
$page_title = $seo['title'] ?? ($content['seo']['home']['title'] ?? 'FlexFit Personal Training Wien');
$page_desc  = $seo['description'] ?? ($content['seo']['home']['description'] ?? '');
$og_title   = $seo['og_title'] ?? $page_title;
$og_desc    = $seo['og_description'] ?? $page_desc;
$og_image   = $seo['og_image'] ?? ($site['logo'] ?? '');
$noindex    = !empty($seo['noindex']);
$cur_page   = current_page();
$base_url   = rtrim(getenv('SITE_URL') ?: 'https://demo.bmsdigitalsolutions.com', '/');
$canonical  = $base_url . ($_SERVER['REQUEST_URI'] ?? '/');
$canonical  = strtok($canonical, '?'); // strip query params
$canonical  = rtrim($canonical, '/');  // no trailing slash
if ($canonical === $base_url) $canonical = $base_url . '/';
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($page_title) ?></title>
  <meta name="description" content="<?= e($page_desc) ?>">
<?php if ($noindex): ?>
  <meta name="robots" content="noindex, nofollow">
<?php else: ?>
  <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<?php endif; ?>
  <meta name="theme-color" content="#090909">
  <link rel="canonical" href="<?= e($canonical) ?>">

  <!-- Open Graph -->
  <meta property="og:title" content="<?= e($og_title) ?>">
  <meta property="og:description" content="<?= e($og_desc) ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= e($canonical) ?>">
  <meta property="og:image" content="<?= e($og_image) ?>">
  <meta property="og:locale" content="de_AT">
  <meta property="og:site_name" content="FlexFit Personal Training Wien">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($og_title) ?>">
  <meta name="twitter:description" content="<?= e($og_desc) ?>">
  <meta name="twitter:image" content="<?= e($og_image) ?>">

  <!-- Favicon -->
  <link rel="icon" href="/assets/img/logo.jpg" type="image/jpeg">
  <link rel="apple-touch-icon" href="/assets/img/logo.jpg">

  <!-- Preconnect for performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="dns-prefetch" href="https://fonts.googleapis.com">

  <!-- CSS -->
  <link rel="stylesheet" href="/assets/css/main.css">

  <!-- Structured Data: LocalBusiness -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "HealthAndBeautyBusiness",
    "name": "FlexFit Personal Training",
    "description": "Personal Training in Wien – individuell, wissenschaftlich fundiert, mit echten Ergebnissen.",
    "url": "https://flexfit-demo.at",
    "email": "marcus@flexfit-demo.at",
    "telephone": "+4312345678",
    "image": "<?= e($site['logo'] ?? '') ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Mustergasse 12",
      "addressLocality": "Wien",
      "postalCode": "1080",
      "addressCountry": "AT"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "48.2105",
      "longitude": "16.3508"
    },
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.9",
      "bestRating": "5",
      "reviewCount": "65"
    },
    "priceRange": "ab €69",
    "openingHoursSpecification": [
      {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"], "opens": "07:00", "closes": "21:00"},
      {"@type": "OpeningHoursSpecification", "dayOfWeek": "Saturday", "opens": "09:00", "closes": "16:00"}
    ],
    "sameAs": [
      "<?= e($site['instagram'] ?? '') ?>",
      "<?= e($site['facebook'] ?? '') ?>"
    ],
    "hasOfferCatalog": {
      "@type": "OfferCatalog",
      "name": "Personal Training",
      "itemListElement": [
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Personal Training 1:1"}, "price": "69", "priceCurrency": "EUR"},
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Kleingruppentraining"}, "price": "40", "priceCurrency": "EUR"},
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Firmenfitness"}, "price": "130", "priceCurrency": "EUR"}
      ]
    }
  }
  </script>

  <!-- Structured Data: BreadcrumbList -->
<?php if ($cur_page !== 'home'): ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://flexfit-demo.at/"},
      {"@type": "ListItem", "position": 2, "name": "<?= e($page_title) ?>", "item": "<?= e($canonical) ?>"}
    ]
  }
  </script>
<?php endif; ?>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
  <div class="container">
    <div class="navbar-inner">
      <!-- Logo -->
      <a href="/index.php" class="navbar-logo">
        <img src="<?= e($site['logo'] ?? '') ?>" alt="<?= e($site['name'] ?? 'FlexFit') ?>" width="60" height="60">
        <span class="navbar-logo-text">
          <span class="navbar-logo-name">Smart<span class="gold">Fit</span></span>
          <span class="navbar-logo-sub">Personal Training Wien</span>
        </span>
      </a>

      <!-- Desktop Nav -->
      <nav class="navbar-nav" aria-label="Hauptnavigation">
        <a href="/personal-training.php" class="nav-link<?= nav_active('personal-training') ?>">Personal Training</a>
        <a href="/firmenfitness.php"      class="nav-link<?= nav_active('firmenfitness') ?>">Firmenfitness</a>
        <a href="/physiotherapie.php"     class="nav-link<?= nav_active('physiotherapie') ?>">Physiotherapie</a>
        <a href="/studio.php"             class="nav-link<?= nav_active('studio') ?>">Studio</a>
        <a href="/team.php"               class="nav-link<?= nav_active('team') ?>">Team</a>
        <a href="/blog.php"               class="nav-link<?= nav_active('blog') ?>">Blog</a>
        <a href="/kontakt.php"            class="nav-link<?= nav_active('kontakt') ?>">Kontakt</a>
      </nav>

      <!-- Actions -->
      <div class="navbar-actions">
        <a href="/probetraining.php" class="btn btn-primary btn-sm">Gratis Probetraining</a>
        <button class="nav-toggle" id="navToggle" aria-label="Menü öffnen" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </div>
</nav>

<!-- MOBILE NAV -->
<div class="mobile-nav" id="mobileNav" role="dialog" aria-modal="true" aria-label="Mobilnavigation">
  <div class="mobile-nav-header">
    <a href="/index.php" class="mobile-nav-logo">
      <img src="<?= e($site['logo'] ?? '') ?>" alt="<?= e($site['name'] ?? 'FlexFit') ?>" width="44" height="44">
      <span class="navbar-logo-text">
        <span class="navbar-logo-name">Smart<span class="gold">Fit</span></span>
        <span class="navbar-logo-sub">Personal Training Wien</span>
      </span>
    </a>
    <button class="mobile-nav-close" id="mobileNavClose" aria-label="Menü schließen"><?= icon('close') ?></button>
  </div>
  <div class="mobile-nav-links">
    <a href="/personal-training.php" class="nav-link<?= nav_active('personal-training') ?>">Personal Training</a>
    <a href="/firmenfitness.php"      class="nav-link<?= nav_active('firmenfitness') ?>">Firmenfitness</a>
    <a href="/physiotherapie.php"     class="nav-link<?= nav_active('physiotherapie') ?>">Physiotherapie</a>
    <a href="/studio.php"             class="nav-link<?= nav_active('studio') ?>">Studio</a>
    <a href="/team.php"               class="nav-link<?= nav_active('team') ?>">Team</a>
    <a href="/blog.php"               class="nav-link<?= nav_active('blog') ?>">Blog</a>
    <a href="/kontakt.php"            class="nav-link<?= nav_active('kontakt') ?>">Kontakt</a>
  </div>
  <div class="mobile-nav-bottom">
    <a href="/probetraining.php" class="btn btn-primary btn-lg">Gratis Probetraining buchen</a>
  </div>
</div>

<div class="site-wrapper">
