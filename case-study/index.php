<?php
require_once __DIR__ . "/../includes/config.php";
require_once __DIR__ . "/../data/case-studies.php";

$currentKey = "work";
$pageTitle = "UX Case Studies — Enterprise Product Design by Ramesh Mandal, Gurgaon";
$pageDesc  = "Real UX case studies from Ramesh Mandal, UX Design Agency Gurgaon. IndiGo booking flow, CrewPal operations, design systems — measurable outcomes at enterprise scale.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>"/>
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <!-- OG / TWITTER META -->
  <meta property="og:site_name"    content="Ramesh Mandal"/>
  <meta property="og:type"         content="website"/>
  <meta property="og:url"          content="https://6epixels.com/case-study/"/>
  <meta property="og:title"        content="Case Studies — Ramesh Mandal"/>
  <meta property="og:description"  content="Five enterprise UX case studies with measurable business impact."/>
  <meta property="og:image"        content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="Case Studies — Ramesh Mandal"/>
  <meta name="twitter:description" content="Five enterprise UX case studies with measurable business impact."/>
  <meta name="twitter:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <link rel="canonical"            href="https://6epixels.com/case-study/"/>
  
  <!-- FAVICON -->
  <link rel="icon" type="image/x-icon"     href="/assets/icons/favicon.ico"/>
  <link rel="icon" type="image/svg+xml"    href="/assets/icons/favicon.svg"/>
  <link rel="icon" type="image/png" sizes="32x32"  href="/assets/icons/favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16"  href="/assets/icons/favicon-16x16.png"/>
  <link rel="apple-touch-icon" sizes="180x180"     href="/assets/icons/favicon-180x180.png"/>
  <meta name="theme-color" content="#0f0f0f"/>
  
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/preloader.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/variables.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/animations.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/reset.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/main.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/global.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/navigation.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/background.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/footer.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/case-study.css"/>

  <?php
    require_once __DIR__ . "/../includes/schema.php";
    echo schema_breadcrumb([
        ["Home", "https://6epixels.com/"],
        ["Case Studies", "https://6epixels.com/case-study/"],
    ]);
    echo _schema_tag([
        "@context"    => "https://schema.org",
        "@type"       => "CollectionPage",
        "name"        => "UX Case Studies — Ramesh Mandal",
        "description" => "Enterprise UX case studies by Ramesh Mandal, Gurgaon.",
        "url"         => "https://6epixels.com/case-study/",
        "author"      => ["@type"=>"Person","name"=>"Ramesh Mandal","url"=>"https://6epixels.com"],
    ]);
  ?>
</head>
<body>

  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">Case Studies</span>
        <span class="preloader__name-role">Selected Work · Real Outcomes</span>
      </div>
      <div class="preloader__bar-wrap"><div class="preloader__bar" id="preloader-bar"></div></div>
      <span class="preloader__counter" id="preloader-counter">0%</span>
    </div>
  </div>

  <div class="bg-canvas" aria-hidden="true">
    <div class="bg-grid"></div>
    <div class="bg-orb-1"></div>
    <div class="bg-orb-2"></div>
    <div class="bg-mouse-glow"></div>
  </div>

  <?php
    $currentKey = "work"; // change per-page (see table below)
    require_once __DIR__ . "/../partials/navigation.php";
  ?>

  <div class="page-wrapper">

    <main id="main-content">

      <!-- HERO -->
      <div class="cs-index-hero fade-in">
        <p class="cs-kicker">SELECTED WORK</p>
        <h1 class="cs-index-title">
          Real work.<br><span>Real outcomes.</span>
        </h1>
        <p class="cs-index-desc">
          Every case study here is grounded in a real problem, shaped by real research,
          and measured against real business outcomes. No hypotheticals.
        </p>
      </div>

      <!-- FILTER BAR -->
      <div class="cs-filter-bar" role="group" aria-label="Filter case studies">
        <button class="cs-filter-btn is-active" data-filter="all">All Work</button>
        <button class="cs-filter-btn" data-filter="AIRLINE COMMERCE">Airline</button>
        <button class="cs-filter-btn" data-filter="ENTERPRISE APP">Enterprise</button>
        <button class="cs-filter-btn" data-filter="DESIGN INFRASTRUCTURE">Design Systems</button>
        <button class="cs-filter-btn" data-filter="MARKETPLACE">Marketplace</button>
      </div>

      <!-- GRID -->
      <div class="cs-grid" id="cs-grid" role="list">

        <?php foreach ($caseStudies as $i => $cs): ?>

          <a
            href="<?= htmlspecialchars($cs['slug']) ?>.php"
            class="cs-card<?= $cs['featured'] ? ' cs-card--featured' : '' ?> tl-reveal"
            role="listitem"
            data-category="<?= htmlspecialchars($cs['category']) ?>"
            style="--delay: <?= ($i % 3) * 80 ?>ms"
            aria-label="<?= htmlspecialchars($cs['title']) ?>"
          >

            <div class="cs-card__image-wrap">
              <img
                class="cs-card__image"
                src="<?= htmlspecialchars($cs['image']) ?>"
                alt="<?= htmlspecialchars($cs['title']) ?>"
                loading="<?= $i < 2 ? 'eager' : 'lazy' ?>"
              />
              <div class="cs-card__overlay"></div>
              <span class="cs-card__year"><?= htmlspecialchars($cs['year']) ?></span>
            </div>

            <div class="cs-card__body">
              <span class="cs-card__category"><?= htmlspecialchars($cs['category']) ?></span>
              <h2 class="cs-card__title"><?= htmlspecialchars($cs['title']) ?></h2>
              <p class="cs-card__tagline"><?= htmlspecialchars($cs['tagline']) ?></p>
              <div class="cs-card__tags">
                <?php foreach (array_slice($cs['tags'], 0, 3) as $tag): ?>
                  <span class="cs-card__tag"><?= htmlspecialchars($tag) ?></span>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="cs-card__metrics">
              <?php foreach ($cs['metrics'] as $m): ?>
                <div class="cs-card__metric">
                  <span class="cs-card__metric-value"><?= htmlspecialchars($m['value']) ?></span>
                  <span class="cs-card__metric-label"><?= htmlspecialchars($m['label']) ?></span>
                </div>
              <?php endforeach; ?>
            </div>

          </a>

        <?php endforeach; ?>

      </div>

    </main>

    <?php require_once __DIR__ . "/../partials/footer.php"; ?>

  </div>

  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/animations.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js" defer></script>
  <script>
  /* ── FILTER ── */
  (function(){
    document.querySelectorAll(".cs-filter-btn").forEach(function(btn){
      btn.addEventListener("click", function(){
        document.querySelectorAll(".cs-filter-btn").forEach(function(b){ b.classList.remove("is-active"); });
        this.classList.add("is-active");
        const filter = this.dataset.filter;
        document.querySelectorAll(".cs-card").forEach(function(card){
          const show = filter === "all" || card.dataset.category === filter;
          card.style.display    = show ? "" : "none";
          card.style.gridColumn = show && card.classList.contains("cs-card--featured") ? "span 2" : "";
        });
      });
    });
  })();
  </script>
  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>

</body>
</html>