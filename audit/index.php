<?php
require_once __DIR__ . "/../includes/config.php";
require_once __DIR__ . "/../data/audits.php";

$currentKey = "audit";
$pageTitle = "UX Audits — Heuristic Analysis of Real Products | Ramesh Mandal";
$pageDesc  = "Public UX audits by Ramesh Mandal, UX Consultant Gurgaon. Friction mapping, heuristic analysis, psychology breakdowns, and redesign suggestions for Zomato, Swiggy, and more.";
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
  <meta property="og:url"          content="https://6epixels.com/audit/"/>
  <meta property="og:title"        content="UX Audits — Ramesh Mandal"/>
  <meta property="og:description"  content="Public heuristic audits of India's most-used apps. No NDAs."/>
  <meta property="og:image"        content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="UX Audits — Ramesh Mandal"/>
  <meta name="twitter:description" content="Public heuristic audits of India's most-used apps. No NDAs."/>
  <meta name="twitter:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <link rel="canonical"            href="https://6epixels.com/audit/"/>

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
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/audit.css"/>

  <?php
    require_once __DIR__ . "/../includes/schema.php";
    echo schema_breadcrumb([
        ["Home", "https://6epixels.com/"],
        ["UX Audits", "https://6epixels.com/audit/"],
    ]);
  ?>
</head>
<body>

  <!-- PRELOADER -->
  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">UX Audits</span>
        <span class="preloader__name-role">Dissecting real products publicly</span>
      </div>
      <div class="preloader__bar-wrap"><div class="preloader__bar" id="preloader-bar"></div></div>
      <span class="preloader__counter" id="preloader-counter">0%</span>
    </div>
  </div>

  <!-- BACKGROUND -->
  <div class="bg-canvas" aria-hidden="true">
    <div class="bg-grid"></div>
    <div class="bg-orb-1"></div>
    <div class="bg-orb-2"></div>
  </div>

  <?php
    $currentKey = "audit";
    require __DIR__ . "/../partials/navigation.php";
  ?>

  <div class="page-wrapper">

    <main id="main-content">

      <!-- HERO -->
      <section class="audit-hero">
        <div class="audit-hero__inner">

          <div class="audit-hero__kicker">
            <span class="audit-hero__kicker-line"></span>
            UX_AUTOPSIES
          </div>

          <h1 class="audit-hero__title">
            Real products.<br>
            <span>Honest critique.</span>
          </h1>

          <p class="audit-hero__desc">
            Public heuristic audits of India's most-used apps — friction maps,
            psychology breakdowns, and concrete redesign suggestions.
            No NDAs. No filters.
          </p>

          <div class="audit-hero__meta">
            <div class="audit-hero__meta-item">
              <span class="audit-hero__meta-value"><?= count(array_filter($audits, fn($a) => $a['status'] === 'published')) ?></span>
              <span class="audit-hero__meta-label">Audits Published</span>
            </div>
            <div class="audit-hero__meta-item">
              <span class="audit-hero__meta-value"><?= array_sum(array_column(array_filter($audits, fn($a) => $a['status'] === 'published'), 'friction_count')) ?>+</span>
              <span class="audit-hero__meta-label">Friction Points Mapped</span>
            </div>
            <div class="audit-hero__meta-item">
              <span class="audit-hero__meta-value">10</span>
              <span class="audit-hero__meta-label">Nielsen Heuristics Applied</span>
            </div>
          </div>

        </div>
      </section>

      <!-- METHODOLOGY STRIP -->
      <div class="audit-method-strip">
        <div class="audit-method-strip__inner">
          <span class="audit-method__label">METHODOLOGY</span>
          <div class="audit-method__pills">
            <span class="audit-method__pill">Heuristic Analysis</span>
            <span class="audit-method__sep">·</span>
            <span class="audit-method__pill">Friction Mapping</span>
            <span class="audit-method__sep">·</span>
            <span class="audit-method__pill">Cognitive Walkthrough</span>
            <span class="audit-method__sep">·</span>
            <span class="audit-method__pill">Psychology Principles</span>
            <span class="audit-method__sep">·</span>
            <span class="audit-method__pill">Redesign Recommendations</span>
          </div>
        </div>
      </div>

      <!-- AUDIT GRID -->
      <section class="audit-listing">
        <div class="audit-listing__inner">

          <?php foreach ($audits as $i => $audit): ?>

            <?php if ($audit['status'] === 'published'): ?>

              <a
                href="<?= htmlspecialchars($audit['slug']) ?>.php"
                class="audit-card fade-in"
                aria-label="Read <?= htmlspecialchars($audit['title']) ?> audit"
              >

                <!-- THUMBNAIL -->
                <div class="audit-card__thumb">
                  <img
                    src="<?= htmlspecialchars($audit['image']) ?>"
                    alt="<?= htmlspecialchars($audit['product']) ?>"
                    loading="lazy"
                  />
                  <div class="audit-card__thumb-overlay"></div>

                  <!-- SCORE BADGE -->
                  <div class="audit-card__score" aria-label="UX Score <?= $audit['score'] ?> out of 100">
                    <span class="audit-card__score-value"><?= $audit['score'] ?></span>
                    <span class="audit-card__score-label">/100</span>
                  </div>

                  <!-- SEVERITY -->
                  <div class="audit-card__severity audit-card__severity--<?= strtolower($audit['severity']) ?>">
                    <?= $audit['severity'] ?> SEVERITY
                  </div>
                </div>

                <!-- BODY -->
                <div class="audit-card__body">

                  <div class="audit-card__meta">
                    <span class="audit-card__category"><?= htmlspecialchars($audit['category']) ?></span>
                    <span class="audit-card__year"><?= htmlspecialchars($audit['year']) ?></span>
                  </div>

                  <h2 class="audit-card__title"><?= htmlspecialchars($audit['title']) ?></h2>

                  <p class="audit-card__tagline"><?= htmlspecialchars($audit['tagline']) ?></p>

                  <p class="audit-card__summary"><?= htmlspecialchars($audit['summary']) ?></p>

                  <div class="audit-card__footer">
                    <div class="audit-card__tags">
                      <?php foreach (array_slice($audit['tags'], 0, 3) as $tag): ?>
                        <span class="audit-card__tag"><?= htmlspecialchars($tag) ?></span>
                      <?php endforeach; ?>
                    </div>
                    <span class="audit-card__friction">
                      <?= $audit['friction_count'] ?> friction points ↗
                    </span>
                  </div>

                </div>

              </a>

            <?php else: ?>

              <!-- COMING SOON CARD -->
              <div class="audit-card audit-card--soon fade-in" aria-label="Coming soon: <?= htmlspecialchars($audit['title']) ?>">

                <div class="audit-card__thumb audit-card__thumb--soon">
                  <img
                    src="<?= htmlspecialchars($audit['image']) ?>"
                    alt="<?= htmlspecialchars($audit['product']) ?> — UX Audit coming soon"
                    loading="lazy"
                  />
                  <div class="audit-card__thumb-overlay"></div>
                  <div class="audit-card__soon-badge">COMING SOON</div>
                </div>

                <div class="audit-card__body">
                  <div class="audit-card__meta">
                    <span class="audit-card__category"><?= htmlspecialchars($audit['category']) ?></span>
                    <span class="audit-card__year"><?= htmlspecialchars($audit['year']) ?></span>
                  </div>
                  <h2 class="audit-card__title"><?= htmlspecialchars($audit['title']) ?></h2>
                  <p class="audit-card__tagline"><?= htmlspecialchars($audit['tagline']) ?></p>
                </div>

              </div>

            <?php endif; ?>

          <?php endforeach; ?>

        </div>
      </section>

      <!-- CTA -->
      <section class="audit-cta">
        <div class="audit-cta__inner">
          <p class="audit-cta__kicker">WANT YOUR PRODUCT AUDITED?</p>
          <h2 class="audit-cta__title">I audit products.<br><span>Yours could be next.</span></h2>
          <p class="audit-cta__desc">
            A structured UX audit identifies friction, maps cognitive load, and gives you
            a prioritised list of fixes — ranked by impact, not opinion.
          </p>
          <div class="audit-cta__actions">
            <a href="/contact.php?type=Consulting" class="audit-cta__btn audit-cta__btn--primary">
              Request an Audit ↗
            </a>
            <a href="/case-study/" class="audit-cta__btn audit-cta__btn--ghost">
              See Case Studies
            </a>
          </div>
        </div>
      </section>

    </main>

    <?php require __DIR__ . "/../partials/footer.php"; ?>

  </div>

  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/animations.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>

</body>
</html>