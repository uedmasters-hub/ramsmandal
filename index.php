<?php
/* =========================================
   INDEX.PHP — Homepage
   ========================================= */

require_once __DIR__ . "/includes/config.php";

$currentKey  = "home";
$pageTitle   = "Ramesh Mandal — UX Design Agency in Gurgaon | UX Leader & Product Strategist";
$pageDesc    = "UX Design Agency based in Gurgaon, led by Ramesh Mandal — 17+ years driving AI-enabled product strategy at scale across aviation, SaaS, and enterprise platforms. Serving clients across India and globally.";
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>" />
  <meta name="keywords" content="UX Design Agency Gurgaon, UX Designer Gurgaon, UX Agency India, Ramesh Mandal, UX Leader, Product Strategist, Design Systems, AI Workflows, Enterprise UX, Aviation UX, SaaS UX, User Experience Design, UX Strategy, UX Portfolio, UX Consultant Gurgaon, Product Design India"/>

  <title><?= htmlspecialchars($pageTitle) ?></title>
  <!-- OG / TWITTER META -->
  <meta property="og:site_name"    content="Ramesh Mandal"/>
  <meta property="og:type"         content="website"/>
  <meta property="og:url"          content="https://6epixels.com/"/>
  <meta property="og:title"        content="Ramesh Mandal — UX Design Agency in Gurgaon"/>
  <meta property="og:description"  content="UX Design Agency in Gurgaon led by Ramesh Mandal. 17+ years designing enterprise products at scale — UX Strategy, Design Systems, AI workflows for 50M+ users."/>
  <meta property="og:image"        content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="Ramesh Mandal — UX Design Agency in Gurgaon"/>
  <meta name="twitter:description" content="UX Design Agency in Gurgaon. 17+ years designing enterprise products at scale. UX Strategy, Design Systems, AI workflows for 50M+ users."/>
  <meta name="twitter:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <link rel="canonical"            href="https://6epixels.com/"/>

  <!-- JSON-LD STRUCTURED DATA -->
  <?php
    require_once __DIR__ . "/includes/schema.php";
    echo schema_person();
    echo schema_website();
    echo schema_local_business();
    echo schema_breadcrumb([['Home', 'https://6epixels.com/']]);
  ?>

  <!-- FAVICON -->
  <link rel="icon" type="image/x-icon"     href="/assets/icons/favicon.ico"/>
  <link rel="icon" type="image/svg+xml"    href="/assets/icons/favicon.svg"/>
  <link rel="icon" type="image/png" sizes="32x32"  href="/assets/icons/favicon-32x32.png"/>
  <link rel="apple-touch-icon" sizes="180x180"     href="/assets/icons/favicon-180x180.png"/>
  <meta name="theme-color" content="#0f0f0f"/>

  <!-- PRECONNECT -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <!-- FONTS -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700&display=swap"
    rel="stylesheet"
  />

  <!-- ── CSS ── -->
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/preloader.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/variables.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/animations.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/wip-modal.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/reset.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/main.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/global.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/navigation.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/background.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/hero.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/stats.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/transformations.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/components/popover.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/experience.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/philosophy.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/bento.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/testimonials.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/footer.css" />

</head>

<body>

  <!-- ── PRELOADER ── -->
  <div class="preloader" id="preloader" aria-hidden="true" role="progressbar" aria-label="Loading">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">Ramesh Mandal</span>
        <span class="preloader__name-role">UX Leader · Product Strategist</span>
      </div>
      <div class="preloader__bar-wrap">
        <div class="preloader__bar" id="preloader-bar"></div>
      </div>
      <span class="preloader__counter" id="preloader-counter">0%</span>
    </div>
  </div>

  <!-- ── LIVE BACKGROUND ── -->
  <div class="bg-canvas" aria-hidden="true">
    <div class="bg-grid"></div>
    <div class="bg-orb-1"></div>
    <div class="bg-orb-2"></div>
    <div class="bg-mouse-glow"></div>
  </div>

  <!-- ── PAGE ── -->
  <?php
    $currentKey = "home"; // change per-page (see table below)
    require_once __DIR__ . "/partials/navigation.php";
  ?>
  <div class="page-wrapper">

    <!-- HEADER -->

    <!-- HERO + STATS -->
    <main id="main-content">

      <?php require_once __DIR__ . "/sections/hero.php"; ?>

      <!-- TRANSFORMATIONS -->
      <?php require_once __DIR__ . "/sections/transformations.php"; ?>

      <!-- EXPERIENCE TIMELINE -->
      <?php require_once __DIR__ . "/sections/experience.php"; ?>

      <!-- PHILOSOPHY -->
      <?php require_once __DIR__ . "/sections/philosophy.php"; ?>

      <!-- COMPONENTS BENTO GRID -->
      <?php require_once __DIR__ . "/sections/components-grid.php"; ?>

      <!-- TESTIMONIALS + LOGOS + MARQUEE -->
      <?php require_once __DIR__ . "/sections/testimonials.php"; ?>

    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . "/partials/footer.php"; ?>

  </div>

  <!-- ── JS ── -->
  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js"  defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/typewriter.js"  defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/animations.js"  defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js"         defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/popover.js"      defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>
  <!-- GSAP — loaded after all existing scripts, never blocks render -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/gsap-effects.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/wip-modal.js" defer></script>

</body>
</html>