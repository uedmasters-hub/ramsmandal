<?php
/* =========================================================================
   views/partials/seo.php — all SEO head tags + JSON-LD, in one place.
   Included from base.php (so $title, $desc, $site, $page, $current and any
   per-view vars like $project are already in scope).
   ========================================================================= */

$canonical = $page['canonical'] ?? seo_canonical();
$ogType    = $page['og_type']   ?? (!empty($project) ? 'article' : 'website');
$ogImage   = seo_asset($site['meta']['og_image'] ?? 'og/og-default.jpg');
$robots    = $page['robots']    ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
$siteName  = $site['meta']['default_title'] ?? ($site['name'] ?? 'Ramesh Mandal');
$current   = $current ?? '';
?>
  <meta name="description" content="<?= e($desc) ?>">
  <meta name="author" content="<?= e($site['name'] ?? 'Ramesh Mandal') ?>">
  <meta name="robots" content="<?= e($robots) ?>">
  <link rel="canonical" href="<?= e($canonical) ?>">

  <!-- Open Graph -->
  <meta property="og:type" content="<?= e($ogType) ?>">
  <meta property="og:site_name" content="<?= e($site['name'] ?? 'Ramesh Mandal') ?>">
  <meta property="og:title" content="<?= e($title) ?>">
  <meta property="og:description" content="<?= e($desc) ?>">
  <meta property="og:url" content="<?= e($canonical) ?>">
  <meta property="og:image" content="<?= e($ogImage) ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="<?= e($site['name'] . ' — ' . ($site['role'] ?? '')) ?>">
  <meta property="og:locale" content="en_US">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($title) ?>">
  <meta name="twitter:description" content="<?= e($desc) ?>">
  <meta name="twitter:image" content="<?= e($ogImage) ?>">

  <!-- Structured data -->
<?php
$graph = [schema_website($site), schema_person($site)];

if (!empty($project)) {
    // a single project page
    $graph[] = schema_creativework($project, $site);
    $graph[] = schema_breadcrumb([
        ['Home',  seo_url('/')],
        ['Work',  seo_url('/work')],
        [$project['title'] ?? 'Project', seo_canonical()],
    ]);
} elseif ($current === 'work') {
    $graph[] = ['@type' => 'CollectionPage', 'name' => 'Work', 'url' => seo_canonical(),
                'isPartOf' => ['@id' => seo_origin() . '/#website']];
    $graph[] = schema_breadcrumb([['Home', seo_url('/')], ['Work', seo_url('/work')]]);
} elseif ($current === 'about') {
    $graph[] = ['@type' => 'AboutPage', 'name' => 'About', 'url' => seo_canonical(),
                'mainEntity' => ['@id' => seo_origin() . '/#person']];
    $graph[] = schema_breadcrumb([['Home', seo_url('/')], ['About', seo_url('/about')]]);
} elseif ($current === 'contact') {
    $graph[] = ['@type' => 'ContactPage', 'name' => 'Contact', 'url' => seo_canonical()];
    $graph[] = schema_breadcrumb([['Home', seo_url('/')], ['Contact', seo_url('/contact')]]);
}

echo '  ' . json_ld(['@context' => 'https://schema.org', '@graph' => $graph]) . "\n";
