<?php
/* =========================================
   BLOG / POST.PHP — Universal blog post template
   ========================================= */

require_once __DIR__ . "/../includes/config.php";
require_once __DIR__ . "/../data/blog.php";

$currentKey = "field-notes"; /* nav active state */

/* ── slug ────────────────────────────────── */
$slug = isset($_GET['slug'])
  ? preg_replace('/[^a-z0-9\-]/', '', strtolower(trim($_GET['slug'])))
  : '';

/* ── find post ───────────────────────────── */
$post      = null;
$postIndex = null;
foreach ($posts as $i => $p) {
  if ($p['slug'] === $slug) { $post = $p; $postIndex = $i; break; }
}

/* ── 404 ─────────────────────────────────── */
if (!$post) {
  http_response_code(404);
  require __DIR__ . "/../partials/navigation.php";
  echo '<div style="padding:120px 48px;max-width:600px">';
  echo '<h1 style="font-size:3rem;font-weight:300;margin-bottom:16px">Post not found</h1>';
  echo '<p style="color:var(--text-muted);margin-bottom:32px">That note doesn\'t exist or may have moved.</p>';
  echo '<a href="<?= BASE_PATH ?>/blog/" style="color:var(--blue)">← Back to Field Notes</a>';
  echo '</div>';
  require __DIR__ . "/../partials/footer.php";
  exit;
}

/* ── prev / next ─────────────────────────── */
$prev = $postIndex > 0                  ? $posts[$postIndex - 1] : null;
$next = $postIndex < count($posts) - 1 ? $posts[$postIndex + 1] : null;

/* ── reading time ────────────────────────── */
$wordCount = array_sum(array_map('str_word_count', $post['body']));
$readTime  = max(1, round($wordCount / 200)) . ' min read';

/* ── page meta ───────────────────────────── */
$pageTitle  = htmlspecialchars($post['title']) . " — Field Notes";
$pageDesc   = htmlspecialchars($post['excerpt']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description"  content="<?= $pageDesc ?>"/>
  <meta name="author"       content="Ramesh Mandal"/>
  <title><?= $pageTitle ?></title>

  <link rel="canonical" href="https://6epixels.com/blog/<?= urlencode($post['slug']) ?>"/>

  <meta property="og:site_name"   content="Ramesh Mandal — Field Notes"/>
  <meta property="og:type"        content="article"/>
  <meta property="og:url"         content="https://6epixels.com/blog/<?= urlencode($post['slug']) ?>"/>
  <meta property="og:title"       content="<?= htmlspecialchars($post['title']) ?>"/>
  <meta property="og:description" content="<?= htmlspecialchars($post['excerpt'] ?? $post['subtitle'] ?? '') ?>"/>
  <meta property="og:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width" content="1200"/>
  <meta property="og:image:height"content="630"/>
  <meta property="og:locale"      content="en_IN"/>
  <meta property="article:author"  content="Ramesh Mandal"/>
  <meta property="article:section" content="<?= htmlspecialchars($post['tag'] ?? 'UX Design') ?>"/>
  <meta name="twitter:card"       content="summary_large_image"/>
  <meta name="twitter:site"       content="@ramsmandal"/>
  <meta name="twitter:title"      content="<?= htmlspecialchars($post['title']) ?>"/>
  <meta name="twitter:description"content="<?= htmlspecialchars($post['excerpt'] ?? $post['subtitle'] ?? '') ?>"/>
  <meta name="twitter:image"      content="https://6epixels.com/assets/og/og-default.jpg"/>

  <link rel="icon" type="image/x-icon"    href="/assets/icons/favicon.ico"/>
  <link rel="icon" type="image/svg+xml"   href="/assets/icons/favicon.svg"/>
  <link rel="icon" type="image/png" sizes="32x32"  href="/assets/icons/favicon-32x32.png"/>
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
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/gallery.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/background.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/footer.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/article.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/post.css"/>

  <?php
    require_once __DIR__ . "/../includes/schema.php";
    echo schema_article($post);
    echo schema_breadcrumb([
      ['Home',        'https://6epixels.com/'],
      ['Field Notes', 'https://6epixels.com/blog/'],
      [$post['title'], 'https://6epixels.com/blog/' . urlencode($post['slug'])],
    ]);
  ?>
</head>
<body data-header="dark">

  <div class="art-progress" id="art-progress" role="progressbar" aria-label="Reading progress"></div>

  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">Field Notes</span>
        <span class="preloader__name-role"><?= htmlspecialchars($post['tag']) ?></span>
      </div>
      <div class="preloader__bar-wrap"><div class="preloader__bar" id="preloader-bar"></div></div>
      <span class="preloader__counter" id="preloader-counter">0%</span>
    </div>
  </div>

  <div class="bg-canvas" aria-hidden="true">
    <div class="bg-grid"></div>
    <div class="bg-orb-1"></div>
    <div class="bg-orb-2"></div>
  </div>

  <?php
    $currentKey = "field-notes"; // this is header section
    require __DIR__ . "/../partials/navigation.php";
  ?>

  <div class="page-wrapper">
    <main id="main-content">

      <!-- HERO -->
      <div class="art-hero fade-in">
        <?php
          $heroImages = [
            'War Story'         => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2400&auto=format&fit=crop',
            'Quiet Win'         => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2400&auto=format&fit=crop',
            'Unpopular Opinion' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=2400&auto=format&fit=crop',
            'From the Field'    => 'https://images.unsplash.com/photo-1523800503107-5bc3ba2a6f81?q=80&w=2400&auto=format&fit=crop',
          ];
          $heroImg = $post['image'] ?? $heroImages[$post['tag']] ?? 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2400&auto=format&fit=crop';
        ?>
        <img class="art-hero__img" src="<?= htmlspecialchars($heroImg) ?>" alt="" loading="eager"/>
        <div class="art-hero__overlay"></div>
        <div class="art-hero__content">
          <div class="art-hero__kicker"><?= htmlspecialchars($post['tag']) ?></div>
          <h1 class="art-hero__title"><?= htmlspecialchars($post['title']) ?></h1>
          <?php if (!empty($post['subtitle'])): ?>
            <p class="art-hero__subtitle"><?= htmlspecialchars($post['subtitle']) ?></p>
          <?php endif; ?>
        </div>
      </div>

      <!-- META BAR -->
      <div class="art-meta-bar">
        <div class="art-meta-item">
          <span class="art-meta-item__label">Date</span>
          <span class="art-meta-item__value"><?= htmlspecialchars($post['date']) ?></span>
        </div>
        <div class="art-meta-item">
          <span class="art-meta-item__label">Time</span>
          <span class="art-meta-item__value"><?= $readTime ?></span>
        </div>
        <div class="art-meta-item">
          <span class="art-meta-item__label">Author</span>
          <span class="art-meta-item__value">Ramesh Mandal</span>
        </div>
        <div class="art-meta-item">
          <span class="art-meta-item__label">Role</span>
          <span class="art-meta-item__value">Sr. Manager UI/UX</span>
        </div>
      </div>

      <!-- BODY: sidebar TOC + article -->
      <div class="art-body">

        <!-- DESKTOP: sticky sidebar -->
        <aside class="art-sidebar" aria-label="Article contents">
          <nav class="art-nav">
            <span class="art-nav__label">In this note</span>
            <?php foreach ($post['body'] as $i => $para): ?>
              <a href="#para-<?= $i ?>" class="art-nav__item" data-toc="para-<?= $i ?>">
                <?= mb_strimwidth(strip_tags($para), 0, 44, '…') ?>
              </a>
            <?php endforeach; ?>
            <a href="#takeaway" class="art-nav__item" data-toc="takeaway">↳ Takeaway</a>
          </nav>

          <div class="art-share">
            <span class="art-nav__label">Share</span>
            <div class="art-share__btns">
              <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode('https://6epixels.com/blog/'.$post['slug']) ?>"
                 class="art-share__btn" target="_blank" rel="noopener noreferrer">LinkedIn ↗</a>
              <a href="https://twitter.com/intent/tweet?text=<?= urlencode($post['title']) ?>&url=<?= urlencode('https://6epixels.com/blog/'.$post['slug']) ?>"
                 class="art-share__btn" target="_blank" rel="noopener noreferrer">Twitter ↗</a>
            </div>
          </div>
        </aside>

        <article class="art-article" id="art-article">
          <?php foreach ($post['body'] as $i => $para): ?>
            <p id="para-<?= $i ?>"
               class="art-para<?= $i === 0 ? ' art-para--lead' : '' ?>"
               style="scroll-margin-top:96px"><?= htmlspecialchars($para) ?></p>
          <?php endforeach; ?>

          <div class="art-takeaway" id="takeaway" style="scroll-margin-top:96px">
            <span class="art-takeaway__label">The Takeaway</span>
            <p class="art-takeaway__text"><?= htmlspecialchars($post['takeaway']) ?></p>
          </div>
        </article>

      </div><!-- /.art-body -->

      <!-- MOBILE: FAB + drawer TOC -->
      <div class="art-fab-backdrop" id="fabBackdrop" aria-hidden="true"></div>

      <button class="art-fab" id="fabBtn" aria-label="Table of contents" aria-expanded="false" aria-controls="fabDrawer">
        <span class="art-fab__icon" aria-hidden="true">
          <span></span><span></span><span></span>
        </span>
      </button>

      <div class="art-fab-drawer" id="fabDrawer" role="dialog" aria-label="Table of contents" aria-modal="true">
        <div class="art-fab-drawer__handle"></div>
        <div class="art-fab-drawer__header">
          <span class="art-fab-drawer__title">In this note</span>
        </div>
        <nav class="art-fab-drawer__nav">
          <?php foreach ($post['body'] as $i => $para): ?>
            <a href="#para-<?= $i ?>"
               class="art-fab-drawer__item"
               data-fab-toc="para-<?= $i ?>">
              <span class="art-fab-drawer__num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
              <?= mb_strimwidth(strip_tags($para), 0, 52, '…') ?>
            </a>
          <?php endforeach; ?>
          <a href="#takeaway" class="art-fab-drawer__item" data-fab-toc="takeaway">
            <span class="art-fab-drawer__num">↳</span>Takeaway
          </a>
        </nav>
      </div>

    </main>

    <!-- ① PREV / NEXT BLOG POST -->
    <?php if ($prev || $next): ?>
    <div class="art-next-wrap">
      <section class="art-next" aria-label="More field notes">
        <?php if ($prev): ?>
          <a href="<?= BASE_PATH ?>/blog/<?= urlencode($prev['slug']) ?>" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">PREVIOUS NOTE</p>
            <p class="art-next__category"><?= htmlspecialchars($prev['tag']) ?></p>
            <h3 class="art-next__title"><?= htmlspecialchars($prev['title']) ?></h3>
            <p class="art-next__tagline"><?= htmlspecialchars($prev['excerpt']) ?></p>
          </a>
        <?php else: ?>
          <div class="art-next__card art-next__card--empty"></div>
        <?php endif; ?>
        <?php if ($next): ?>
          <a href="<?= BASE_PATH ?>/blog/<?= urlencode($next['slug']) ?>" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">NEXT NOTE</p>
            <p class="art-next__category"><?= htmlspecialchars($next['tag']) ?></p>
            <h3 class="art-next__title"><?= htmlspecialchars($next['title']) ?></h3>
            <p class="art-next__tagline"><?= htmlspecialchars($next['excerpt']) ?></p>
          </a>
        <?php else: ?>
          <div class="art-next__card art-next__card--empty"></div>
        <?php endif; ?>
      </section>
    </div>
    <?php endif; ?>

    <!-- ② MORE FROM THE PLATFORM — cross-content grid -->
    <?php
      require __DIR__ . "/../partials/related-content.php";
      render_related_content('blog', $post['slug']);
    ?>


    <?php require __DIR__ . "/../partials/footer.php"; ?>

  </div>

  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/animations.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js" defer></script>
  <script>
  /* ── READING PROGRESS ── */
  (function(){
    var bar  = document.getElementById("art-progress");
    var main = document.getElementById("main-content");
    if (!bar || !main) return;
    window.addEventListener("scroll", function(){
      var h   = main.scrollHeight - window.innerHeight;
      var pct = h > 0 ? Math.min(100, (window.scrollY / h) * 100) : 0;
      bar.style.width = pct + "%";
    }, { passive: true });
  })();

  /* ── DESKTOP SIDEBAR ACTIVE TOC ── */
  (function(){
    var items = document.querySelectorAll(".art-nav__item[data-toc]");
    if (!items.length) return;
    var obs = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if (!e.isIntersecting) return;
        items.forEach(function(n){ n.classList.remove("is-active"); });
        var a = document.querySelector('.art-nav__item[data-toc="' + e.target.id + '"]');
        if (a) a.classList.add("is-active");
      });
    }, { rootMargin: "-15% 0px -70% 0px" });
    document.querySelectorAll("[id]").forEach(function(el){ obs.observe(el); });
  })();

  /* ── MOBILE FAB — scroll hide/show + footer avoidance ── */
  (function(){
    var fab      = document.getElementById("fabBtn");
    var drawer   = document.getElementById("fabDrawer");
    var backdrop = document.getElementById("fabBackdrop");
    if (!fab || !drawer) return;

    function openDrawer() {
      fab.classList.add("is-open");
      fab.setAttribute("aria-expanded", "true");
      backdrop.classList.add("is-open");
      requestAnimationFrame(function(){
        drawer.classList.add("is-open");
        backdrop.classList.add("is-visible");
      });
      document.body.style.overflow = "hidden";
    }
    function closeDrawer() {
      fab.classList.remove("is-open");
      fab.setAttribute("aria-expanded", "false");
      drawer.classList.remove("is-open");
      backdrop.classList.remove("is-visible");
      setTimeout(function(){ backdrop.classList.remove("is-open"); }, 240);
      document.body.style.overflow = "";
    }

    fab.addEventListener("click", function(){
      fab.classList.contains("is-open") ? closeDrawer() : openDrawer();
    });
    backdrop.addEventListener("click", closeDrawer);
    document.addEventListener("keydown", function(e){ if (e.key === "Escape") closeDrawer(); });
    drawer.querySelectorAll(".art-fab-drawer__item").forEach(function(l){
      l.addEventListener("click", function(){ closeDrawer(); });
    });

    var lastY = 0, scrollTimer = null;
    function checkFabVisibility() {
      var y = window.scrollY, winH = window.innerHeight, docH = document.documentElement.scrollHeight;
      if ((y + winH) > (docH - 200)) { fab.classList.add("is-hidden"); return; }
      if (y > lastY + 4)      { fab.classList.add("is-hidden"); }
      else if (y < lastY - 4) { fab.classList.remove("is-hidden"); }
      lastY = y;
      clearTimeout(scrollTimer);
      scrollTimer = setTimeout(function(){ fab.classList.remove("is-hidden"); }, 800);
    }
    window.addEventListener("scroll", checkFabVisibility, { passive: true });

    var fi = drawer.querySelectorAll(".art-fab-drawer__item[data-fab-toc]");
    if (fi.length) {
      var obs = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
          if (!e.isIntersecting) return;
          fi.forEach(function(n){ n.classList.remove("is-active"); });
          var a = drawer.querySelector('.art-fab-drawer__item[data-fab-toc="' + e.target.id + '"]');
          if (a) a.classList.add("is-active");
        });
      }, { rootMargin: "-15% 0px -70% 0px" });
      document.querySelectorAll("[id]").forEach(function(el){ obs.observe(el); });
    }
  })();
  </script>

  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>


  <?php
  /* ── GALLERY: build from post data ─────── */
  $galleryImages = array();
  if (!empty($post['gallery']) && is_array($post['gallery'])) {
      $galleryImages = $post['gallery'];
  } elseif (!empty($post['image'])) {
      /* Fallback: use hero image if no gallery defined */
      $galleryImages = array(
          array('src' => $post['image'], 'caption' => $post['title'] . ' — reference image'),
      );
  }
  if (!empty($galleryImages)) {
      require __DIR__ . "/../partials/gallery.php";
  }
  ?>
  <script src="<?= BASE_PATH ?>/assets/js/gallery.js" defer></script>
</body>
</html>