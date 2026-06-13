<?php
/* =========================================
   404.PHP — Page Not Found
   Wired via .htaccess: ErrorDocument 404
   ========================================= */

require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/data/case-studies.php";
require_once __DIR__ . "/data/blog.php";

/* HTTP status */
header("HTTP/1.1 404 Not Found");

$currentKey = "";
$pageTitle  = "Page Not Found — Ramesh Mandal";
$pageDesc   = "The page you were looking for doesn't exist. Explore UX case studies, audits, essays, and psychology articles by Ramesh Mandal.";

/* Pick 3 featured case studies */
$featured = array_filter($caseStudies, function($cs) {
    return ($cs['status'] ?? '') === 'published';
});
$featured = array_slice(array_values($featured), 0, 3);

/* Pick 3 blog posts */
$featuredPosts = array_slice($posts, 0, 3);

/* The URL that 404'd */
$badUrl = htmlspecialchars($_SERVER['REQUEST_URI'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>"/>
  <meta name="robots" content="noindex, follow"/>

  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>

  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/preloader.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/variables.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/reset.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/main.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/global.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/navigation.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/background.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/footer.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/animations.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/404.css"/>

  <link rel="icon" href="<?= BASE_PATH ?>/assets/icons/favicon.ico"/>
</head>
<body>

<!-- PRELOADER -->
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

<?php $currentKey = ""; require __DIR__ . "/partials/navigation.php"; ?>

<div class="page-wrapper">
<main class="e404" id="main-content">

  <!-- ══════════════════════════════════
       HERO — the 404 moment
       ══════════════════════════════════ -->
  <section class="e404-hero">

    <!-- Animated background grid lines -->
    <div class="e404-grid" aria-hidden="true">
      <?php for ($i = 0; $i < 6; $i++): ?>
        <div class="e404-grid__line" style="--i:<?= $i ?>"></div>
      <?php endfor; ?>
    </div>

    <!-- Large 404 backdrop number -->
    <div class="e404-backdrop" aria-hidden="true">404</div>

    <div class="e404-hero__content fade-in">

      <!-- Status pill -->
      <div class="e404-status">
        <span class="e404-status__dot" aria-hidden="true"></span>
        <span class="e404-status__text">Error 404 — Page not found</span>
      </div>

      <h1 class="e404-title">
        This page<br>
        <span>doesn't exist.</span>
      </h1>

      <p class="e404-desc">
        The URL
        <?php if ($badUrl && $badUrl !== '/'): ?>
          <code class="e404-url"><?= $badUrl ?></code>
        <?php endif; ?>
        leads nowhere. But the work below is very much real.
      </p>

      <!-- Quick navigation actions -->
      <div class="e404-actions">
        <a href="<?= BASE_PATH ?>/" class="btn btn--primary">
          ← Back to homepage
        </a>
        <a href="<?= BASE_PATH ?>/case-study/" class="btn btn--ghost">
          View case studies
        </a>
        <a href="<?= BASE_PATH ?>/contact" class="btn btn--ghost">
          Get in touch
        </a>
      </div>

    </div>
  </section>

  <!-- ══════════════════════════════════
       USEFUL CONTENT — don't just show 404
       ══════════════════════════════════ -->

  <!-- Case Studies -->
  <section class="e404-section fade-in" style="--delay: 0.15s">
    <div class="e404-section__inner">

      <div class="e404-section__header">
        <div class="e404-kicker">
          <span class="e404-kicker__line" aria-hidden="true"></span>
          FEATURED WORK
        </div>
        <a href="<?= BASE_PATH ?>/case-study/" class="e404-see-all">
          All case studies →
        </a>
      </div>

      <div class="e404-cards">
        <?php foreach ($featured as $cs): ?>
        <a href="<?= BASE_PATH ?>/case-study/<?= htmlspecialchars($cs['slug']) ?>"
           class="e404-card hover-lift">

          <div class="e404-card__img-wrap">
            <img
              src="<?= htmlspecialchars($cs['image'] ?? '') ?>"
              alt="<?= htmlspecialchars($cs['title']) ?>"
              loading="lazy"
              class="e404-card__img"
            />
          </div>

          <div class="e404-card__body">
            <p class="e404-card__cat"><?= htmlspecialchars($cs['category'] ?? '') ?></p>
            <h3 class="e404-card__title"><?= htmlspecialchars($cs['title']) ?></h3>
            <?php if (!empty($cs['tagline'])): ?>
            <p class="e404-card__tagline"><?= htmlspecialchars($cs['tagline']) ?></p>
            <?php endif; ?>
            <?php if (!empty($cs['metrics'])): ?>
            <div class="e404-card__metrics">
              <?php foreach (array_slice($cs['metrics'], 0, 2) as $m): ?>
              <span class="e404-metric">
                <strong><?= htmlspecialchars($m['value']) ?></strong>
                <?= htmlspecialchars($m['label']) ?>
              </span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>

          <span class="e404-card__arrow" aria-hidden="true">↗</span>
        </a>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- Field Notes -->
  <section class="e404-section e404-section--alt fade-in" style="--delay: 0.25s">
    <div class="e404-section__inner">

      <div class="e404-section__header">
        <div class="e404-kicker">
          <span class="e404-kicker__line" aria-hidden="true"></span>
          FIELD NOTES
        </div>
        <a href="<?= BASE_PATH ?>/blog/" class="e404-see-all">All writing →</a>
      </div>

      <div class="e404-posts">
        <?php foreach ($featuredPosts as $post): ?>
        <a href="<?= BASE_PATH ?>/blog/<?= htmlspecialchars($post['slug']) ?>"
           class="e404-post hover-lift">
          <div class="e404-post__meta">
            <span class="e404-post__tag"><?= htmlspecialchars($post['tag'] ?? '') ?></span>
            <span class="e404-post__time"><?= htmlspecialchars($post['read_time'] ?? '') ?></span>
          </div>
          <h3 class="e404-post__title"><?= htmlspecialchars($post['title']) ?></h3>
          <p class="e404-post__excerpt"><?= htmlspecialchars($post['excerpt'] ?? '') ?></p>
          <span class="e404-post__arrow" aria-hidden="true">→</span>
        </a>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- Quick links — the real useful part -->
  <section class="e404-section fade-in" style="--delay: 0.35s">
    <div class="e404-section__inner">

      <div class="e404-section__header">
        <div class="e404-kicker">
          <span class="e404-kicker__line" aria-hidden="true"></span>
          EVERYTHING ON THIS SITE
        </div>
      </div>

      <div class="e404-nav-grid">
        <?php
        $navLinks = [
          [
            'href'   => '/',
            'icon'   => '⌂',
            'title'  => 'Homepage',
            'desc'   => 'Overview, stats, philosophy, and featured work',
          ],
          [
            'href'   => '/about',
            'icon'   => '◉',
            'title'  => 'About',
            'desc'   => '17 years. Career arc, principles, and leadership philosophy',
          ],
          [
            'href'   => '/case-study/',
            'icon'   => '◈',
            'title'  => 'Case Studies',
            'desc'   => 'IndiGo, CrewPal, Design System, Quikr — with real metrics',
          ],
          [
            'href'   => '/audit/',
            'icon'   => '◎',
            'title'  => 'UX Audits',
            'desc'   => 'Heuristic teardowns of Zomato and Swiggy — no NDAs',
          ],
          [
            'href'   => '/blog/',
            'icon'   => '⚡',
            'title'  => 'Field Notes',
            'desc'   => 'War stories, quiet wins, unpopular opinions from the field',
          ],
          [
            'href'   => '/psychology/',
            'icon'   => '◑',
            'title'  => 'UX Psychology',
            'desc'   => '24 principles that shape every design decision',
          ],
          [
            'href'   => '/resources',
            'icon'   => '◧',
            'title'  => 'Resources',
            'desc'   => 'Free templates, frameworks, and honest tool reviews',
          ],
          [
            'href'   => '/contact',
            'icon'   => '→',
            'title'  => 'Contact',
            'desc'   => 'Open for leadership roles, consulting, collaboration',
          ],
        ];
        foreach ($navLinks as $link):
        ?>
        <a href="<?= BASE_PATH . $link['href'] ?>" class="e404-nav-item hover-lift">
          <span class="e404-nav-item__icon" aria-hidden="true"><?= $link['icon'] ?></span>
          <span class="e404-nav-item__title"><?= htmlspecialchars($link['title']) ?></span>
          <span class="e404-nav-item__desc"><?= htmlspecialchars($link['desc']) ?></span>
        </a>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

</main>

<?php require __DIR__ . "/partials/footer.php"; ?>
</div><!-- /.page-wrapper -->

<script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
<script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
<script src="<?= BASE_PATH ?>/assets/js/animations.js" defer></script>
<script src="<?= BASE_PATH ?>/assets/js/app.js" defer></script>
<script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>
<script src="<?= BASE_PATH ?>/assets/js/transitions.js" defer></script>
<script src="<?= BASE_PATH ?>/assets/js/cursor.js" defer></script>

</body>
</html>