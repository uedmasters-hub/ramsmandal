<?php
require_once __DIR__ . "/../includes/config.php";
require_once __DIR__ . "/../data/blog.php";

$currentKey = "field-notes";
$pageTitle = "Field Notes — UX Design Insights by Ramesh Mandal | Gurgaon";
$pageDesc  = "UX design essays, war stories, and frameworks from Ramesh Mandal — 17 years shipping enterprise products. Real lessons from aviation, SaaS, and marketplace UX.";

// Separate featured posts
$featured = array_filter($posts, fn($p) => $p['featured']);
$featured = array_values($featured);
$regular  = array_values($posts);

// Category counts
$counts = [];
foreach ($categories as $cat) {
  if ($cat['id'] === 'all') continue;
  $counts[$cat['id']] = count(array_filter($posts, fn($p) => $p['category'] === $cat['id']));
}
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
  <meta property="og:url"          content="https://6epixels.com/blog/"/>
  <meta property="og:title"        content="Field Notes — Ramesh Mandal"/>
  <meta property="og:description"  content="War stories, quiet wins, unpopular opinions, and research from the field of enterprise UX."/>
  <meta property="og:image"        content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="Field Notes — Ramesh Mandal"/>
  <meta name="twitter:description" content="War stories, quiet wins, unpopular opinions, and research from the field of enterprise UX."/>
  <meta name="twitter:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <link rel="canonical"            href="https://6epixels.com/blog/"/>
  
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
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/blog.css"/>

  <?php
    require_once __DIR__ . "/../includes/schema.php";
    echo schema_breadcrumb([
        ["Home", "https://6epixels.com/"],
        ["Field Notes", "https://6epixels.com/blog/"],
    ]);
  ?>
</head>
<body>

  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">Field Notes</span>
        <span class="preloader__name-role">Real stories from real work</span>
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
    $currentKey = "field-notes"; // change per-page (see table below)
    require_once __DIR__ . "/../partials/navigation.php";
  ?>

  <div class="page-wrapper">

    <main id="main-content">

      <!-- ══════════════ HERO ══════════════ -->
      <div class="blog-hero">
        <div class="fade-in">
          <p class="blog-kicker">FIELD NOTES</p>
          <h1 class="blog-hero__title"><?= htmlspecialchars($blogMeta['title']) ?></h1>
        </div>
        <div class="fade-in">
          <p class="blog-hero__tagline"><?= htmlspecialchars($blogMeta['tagline']) ?></p>
          <div class="blog-hero__counts">
            <?php foreach ($categories as $cat):
              if ($cat['id'] === 'all') continue; ?>
              <span class="blog-count-pill">
                <span class="blog-count-pill__icon"><?= $cat['icon'] ?></span>
                <span class="blog-count-pill__num"><?= $counts[$cat['id']] ?></span>
                <?= htmlspecialchars($cat['label']) ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- ══════════════ FEATURED PAIR ══════════════ -->
      <?php if (count($featured) >= 2): ?>
      <div class="blog-featured fade-in">
        <a href="<?= BASE_PATH ?>/blog/post.php?slug=<?= urlencode($featured[0]['slug']) ?>" class="blog-featured__link" aria-label="<?= htmlspecialchars($featured[0]['title']) ?>">

          <!-- LEFT: DARK CARD -->
          <div class="blog-featured__card">
            <div>
              <div class="blog-featured__emoji"><?= $featured[0]['emoji'] ?></div>
              <p class="blog-featured__tag"><?= htmlspecialchars($featured[0]['tag']) ?></p>
              <h2 class="blog-featured__title"><?= htmlspecialchars($featured[0]['title']) ?></h2>
              <p class="blog-featured__subtitle"><?= htmlspecialchars($featured[0]['subtitle']) ?></p>
            </div>
            <div class="blog-featured__meta">
              <span class="blog-featured__meta-item"><?= htmlspecialchars($featured[0]['date']) ?></span>
              <span class="blog-featured__meta-dot"></span>
              <span class="blog-featured__meta-item"><?= htmlspecialchars($featured[0]['read_time']) ?></span>
            </div>
          </div>

          <!-- RIGHT: LIGHT CARD -->
          <div class="blog-featured__second">
            <div>
              <div class="blog-featured__second-emoji"><?= $featured[1]['emoji'] ?></div>
              <p class="blog-featured__second-tag"><?= htmlspecialchars($featured[1]['tag']) ?></p>
              <h2 class="blog-featured__second-title"><?= htmlspecialchars($featured[1]['title']) ?></h2>
              <p class="blog-featured__second-excerpt"><?= htmlspecialchars($featured[1]['excerpt']) ?></p>
            </div>
            <div class="blog-featured__second-meta">
              <span class="blog-featured__second-meta-item"><?= htmlspecialchars($featured[1]['date']) ?></span>
              <span class="blog-featured__meta-dot" style="background:var(--border-hover)"></span>
              <span class="blog-featured__second-meta-item"><?= htmlspecialchars($featured[1]['read_time']) ?></span>
            </div>
          </div>

        </a>
      </div>
      <?php endif; ?>

      <!-- ══════════════ FILTER BAR ══════════════ -->
      <div class="blog-filter" role="group" aria-label="Filter posts by category">
        <span class="blog-filter__label">Filter</span>
        <button class="blog-filter__btn is-active" data-filter="all">
          All <span style="opacity:.5;font-weight:400"><?= count($posts) ?></span>
        </button>
        <?php foreach ($categories as $cat):
          if ($cat['id'] === 'all') continue; ?>
          <button class="blog-filter__btn" data-filter="<?= $cat['id'] ?>">
            <?= $cat['icon'] ?> <?= htmlspecialchars($cat['label']) ?>
            <span style="opacity:.5;font-weight:400;margin-left:2px"><?= $counts[$cat['id']] ?></span>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- ══════════════ POST GRID ══════════════ -->
      <div class="blog-grid" id="blog-grid" role="list">

        <?php foreach ($regular as $i => $post): ?>

          <a
            href="<?= BASE_PATH ?>/blog/post.php?slug=<?= urlencode($post['slug']) ?>"
            class="blog-card<?= $post['color'] === 'dark' ? ' blog-card--dark' : '' ?> tl-reveal"
            role="listitem"
            data-category="<?= htmlspecialchars($post['category']) ?>"
            style="--delay: <?= ($i % 3) * 70 ?>ms"
            aria-label="<?= htmlspecialchars($post['title']) ?>"
          >

            <div class="blog-card__emoji-wrap"><?= $post['emoji'] ?></div>

            <div class="blog-card__body">
              <span class="blog-card__tag"><?= htmlspecialchars($post['tag']) ?></span>
              <h2 class="blog-card__title"><?= htmlspecialchars($post['title']) ?></h2>
              <p class="blog-card__excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>
              <div class="blog-card__takeaway"><?= htmlspecialchars($post['takeaway']) ?></div>
            </div>

            <div class="blog-card__footer">
              <span class="blog-card__meta"><?= htmlspecialchars($post['date']) ?> · <?= htmlspecialchars($post['read_time']) ?></span>
              <span class="blog-card__read-more">Read ↗</span>
            </div>

          </a>

        <?php endforeach; ?>

      </div>

      <!-- ══════════════ NEWSLETTER ══════════════ -->
      <div class="blog-newsletter fade-in" aria-label="Newsletter signup">
        <div>
          <h3 class="blog-newsletter__title">Get new Field Notes when they drop</h3>
          <p class="blog-newsletter__sub">One email when something new is worth writing. No sequences. No nurture flows. Just the note.</p>
        </div>
        <form class="blog-newsletter__form" onsubmit="handleNewsletterSubmit(event)" novalidate>
          <input class="blog-newsletter__input" type="email" placeholder="your@email.com" required aria-label="Email address"/>
          <button class="blog-newsletter__btn" type="submit">Subscribe</button>
        </form>
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
    document.querySelectorAll(".blog-filter__btn").forEach(function(btn){
      btn.addEventListener("click", function(){
        document.querySelectorAll(".blog-filter__btn").forEach(function(b){ b.classList.remove("is-active"); });
        this.classList.add("is-active");
        const filter = this.dataset.filter;
        document.querySelectorAll(".blog-card").forEach(function(card){
          card.style.display = (filter === "all" || card.dataset.category === filter) ? "" : "none";
        });
      });
    });
  })();

  /* ── NEWSLETTER ── */
  function handleNewsletterSubmit(e) {
    e.preventDefault();
    const btn   = e.target.querySelector("button");
    const input = e.target.querySelector("input");
    btn.textContent  = "✓ Subscribed";
    btn.style.background = "#1D9E75";
    input.disabled   = true;
    btn.disabled     = true;
  }
  </script>

  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>

</body>
</html>