<?php
/* =========================================================================
   views/home.php — composition only. Every section is a partial fed from
   content/home.php (narrative) and content/projects.php (the work registry).
   No section content is hardcoded here.
   ========================================================================= */
$site     = content('site');
$home     = content('home');
$projects = $projects ?? content('projects');

$page = [
  'title'      => $site['meta']['default_title'],
  'desc'       => $site['meta']['default_desc'],
  'body_class' => 'page-home',
  'styles'     => ['home', 'home-experience', 'home-marquee', 'work-journey', 'perspectives', 'philosophy'],
  'scripts'    => ['core/reveal', 'work-journey'],
  'modules'    => ['preloader', 'home-experience', 'core/text-ink', 'logo-marquee'],
  'importmap'  => json_encode([
    'imports' => [
      'lenis'              => 'https://unpkg.com/lenis@1.1.20/dist/lenis.mjs',
      'gsap'               => 'https://unpkg.com/gsap@3.12.5/index.js',
      'gsap/ScrollTrigger' => 'https://unpkg.com/gsap@3.12.5/ScrollTrigger.js',
    ],
  ], JSON_UNESCAPED_SLASHES),
];

/* top three featured projects feed the hero "previews" stage */
$featured = array_values(array_filter($projects, fn($p) => !empty($p['featured'])));
$prev     = array_slice($featured, 0, 3);

$P = VIEW_DIR . '/partials';
?>

<?php require $P . '/home/hero.php'; ?>
<?php require $P . '/home/preloader.php'; ?>
<?php require $P . '/home/disciplines.php'; ?>

<div class="site-container">
  <?php require $P . '/home/intro.php'; ?>
  <?php require $P . '/home/logos.php'; ?>
  <?php require $P . '/home/work.php'; ?>
  <?php require $P . '/perspectives.php'; ?>
  <?php require $P . '/philosophy.php'; ?>
  <?php require $P . '/home/scale.php'; ?>
</div>
