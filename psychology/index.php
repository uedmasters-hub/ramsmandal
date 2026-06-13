<?php
require_once __DIR__ . "/../includes/config.php";
require_once __DIR__ . "/../data/psychology.php";

$currentKey = "psychology";
$pageTitle = "UX Psychology — Principles Behind Every Design Decision | Ramesh Mandal";
$pageDesc  = "24 psychological principles that shape every design decision — explained by Ramesh Mandal, UX Design Agency Gurgaon. From attention to motivation, with real product examples.";
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
  <meta property="og:url"          content="https://6epixels.com/psychology/"/>
  <meta property="og:title"        content="UX Psychology — Ramesh Mandal"/>
  <meta property="og:description"  content="24 psychological principles applied to product design."/>
  <meta property="og:image"        content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="UX Psychology — Ramesh Mandal"/>
  <meta name="twitter:description" content="24 psychological principles applied to product design."/>
  <meta name="twitter:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <link rel="canonical"            href="https://6epixels.com/psychology/"/>
  
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
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/components/popover.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/footer.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/psychology.css"/>

  <?php
    require_once __DIR__ . "/../includes/schema.php";
    echo schema_breadcrumb([
        ["Home", "https://6epixels.com/"],
        ["UX Psychology", "https://6epixels.com/psychology/"],
    ]);
  ?>
</head>
<body>

  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">UX Psychology</span>
        <span class="preloader__name-role">The science behind design decisions</span>
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

  <!-- POPOVER -->
  <div class="chip-overlay" aria-hidden="true"></div>
  <aside class="chip-panel psych-popover" role="dialog" aria-modal="true" aria-label="Psychology principle detail" aria-hidden="true">
    <div class="chip-panel__header">
      <span class="chip-panel__label"></span>
      <button class="chip-panel__close" aria-label="Close panel">✕</button>
    </div>
    <div class="chip-panel__body"></div>
  </aside>

  <?php
    $currentKey = "psychology";
    require_once __DIR__ . "/../partials/navigation.php";
  ?>

  <div class="page-wrapper">

    <main id="main-content">

      <!-- ═══════════════════ HERO ═══════════════════ -->
      <section class="psych-hero">
        <div class="psych-hero__inner">

          <div class="fade-in">
            <p class="psych-kicker">UX PSYCHOLOGY</p>
            <h1 class="psych-hero__title">
              The invisible<br>forces behind<br><span>every click.</span>
            </h1>
            <p class="psych-hero__tagline">
              <?= htmlspecialchars($psychologyMeta['tagline']) ?>
            </p>
          </div>

          <div class="psych-hero__right fade-in">
            <p class="psych-hero__desc"><?= htmlspecialchars($psychologyMeta['desc']) ?></p>
            <div class="psych-hero__stats">
              <?php foreach ($psychologyMeta['stats'] as $stat): ?>
                <div class="psych-stat">
                  <span class="psych-stat__value"><?= htmlspecialchars($stat['value']) ?></span>
                  <span class="psych-stat__label"><?= htmlspecialchars($stat['label']) ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

        </div>
      </section>

      <!-- ═══════════════ CATEGORY FILTER ═══════════════ -->
      <div class="psych-filter" role="group" aria-label="Filter by category">
        <span class="psych-filter__label">Filter</span>
        <button class="psych-filter__btn is-active" data-filter="all">
          All <span style="opacity:.5;font-weight:400"><?= count($principles) ?></span>
        </button>
        <?php foreach ($categories as $cat): ?>
          <button class="psych-filter__btn" data-filter="<?= $cat['id'] ?>">
            <span class="psych-filter__icon"><?= $cat['icon'] ?></span>
            <?= htmlspecialchars($cat['label']) ?>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- ═══════════════ PRINCIPLES GRID ═══════════════ -->
      <div class="psych-grid" id="psych-grid" role="list">

        <?php foreach ($principles as $i => $p): ?>
        <?php if ($i === 6): ?>
          </div><!-- /psych-grid -->

          <!-- ═══════════════ INTERRUPT BAND ═══════════════ -->
          <div class="psych-interrupt tl-reveal" aria-label="UX Audit offer">
            <div class="psych-interrupt__inner">
              <div>
                <p class="psych-interrupt__eyebrow">Sound familiar?</p>
                <h2 class="psych-interrupt__title">
                  If you recognised these patterns<br>in <strong>your own product</strong> — good.
                </h2>
                <p class="psych-interrupt__body">
                  Recognition is the first step. Most product teams know something feels wrong.
                  They just don't know which of these 24 principles they're violating, or where the highest-impact fix is.
                  That's exactly what a UX audit uncovers.
                </p>
                <div class="psych-interrupt__checks">
                  <div class="psych-interrupt__check">
                    <span class="psych-interrupt__check-icon">✓</span>
                    <span>Identify the 3–5 psychological friction points costing you conversion</span>
                  </div>
                  <div class="psych-interrupt__check">
                    <span class="psych-interrupt__check-icon">✓</span>
                    <span>Prioritised fix list by impact × effort — not just a list of problems</span>
                  </div>
                  <div class="psych-interrupt__check">
                    <span class="psych-interrupt__check-icon">✓</span>
                    <span>Delivered in 5 working days. No fluff. No 80-slide deck.</span>
                  </div>
                </div>
              </div>
              <div class="psych-interrupt__cta">
                <a href="/contact.php?type=audit" class="psych-interrupt__btn-primary">
                  Request a UX Audit ↗
                </a>
                <a href="/case-study/" class="psych-interrupt__btn-ghost">
                  See audit outcomes
                </a>
                <p class="psych-interrupt__note">Free 30-min discovery call · No commitment</p>
              </div>
            </div>
          </div>

          <div class="psych-grid" id="psych-grid-2" role="list">
        <?php endif; ?>
          <article
            class="psych-card psych-card--<?= $p['color'] ?> tl-reveal"
            role="listitem"
            tabindex="0"
            data-psych="<?= $p['id'] ?>"
            data-category="<?= $p['category'] ?>"
            style="--delay: <?= ($i % 3) * 60 ?>ms"
            aria-label="<?= htmlspecialchars($p['name']) ?> — click to learn more"
          >

            <div class="psych-card__header">
              <span class="psych-card__category-badge">
                <?php
                  $catLabel = array_filter($categories, fn($c) => $c['id'] === $p['category']);
                  echo htmlspecialchars(array_values($catLabel)[0]['label'] ?? $p['category']);
                ?>
              </span>
              <span class="psych-card__impact psych-card__impact--<?= strtolower($p['impact']) ?>">
                <?= $p['impact'] ?> Impact
              </span>
            </div>

            <div class="psych-card__body">
              <h2 class="psych-card__name"><?= htmlspecialchars($p['name']) ?></h2>
              <?php if ($p['latin']): ?>
                <p class="psych-card__latin"><?= htmlspecialchars($p['latin']) ?></p>
              <?php endif; ?>
              <p class="psych-card__tagline"><?= htmlspecialchars($p['tagline']) ?></p>
              <p class="psych-card__definition"><?= htmlspecialchars($p['definition']) ?></p>
            </div>

            <div class="psych-card__footer">
              <span class="psych-card__effort">Effort: <?= $p['effort'] ?></span>
              <span class="psych-card__cta">Explore principle →</span>
            </div>

          </article>
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
  /* ── PSYCHOLOGY PRINCIPLES DATA ─────────── */
  const psychData = <?php
    $out = [];
    foreach ($principles as $p) {
      $out[$p['id']] = [
        'name'        => $p['name'],
        'latin'       => $p['latin'],
        'category'    => $p['category'],
        'tagline'     => $p['tagline'],
        'definition'  => $p['definition'],
        'why'         => $p['why'],
        'ux_use'      => $p['ux_use'],
        'example'     => $p['example'],
        'do'          => $p['do'],
        'dont'        => $p['dont'],
        'real_world'  => $p['real_world'],
        'impact'      => $p['impact'],
        'effort'      => $p['effort'],
        'color'       => $p['color'],
      ];
    }
    echo json_encode($out, JSON_HEX_TAG | JSON_HEX_APOS);
  ?>;

  /* ── FILTER ── */
  (function(){
    document.querySelectorAll(".psych-filter__btn").forEach(function(btn){
      btn.addEventListener("click", function(){
        document.querySelectorAll(".psych-filter__btn").forEach(function(b){ b.classList.remove("is-active"); });
        this.classList.add("is-active");
        const filter = this.dataset.filter;
        document.querySelectorAll(".psych-card").forEach(function(card){
          card.style.display = (filter === "all" || card.dataset.category === filter) ? "" : "none";
        });
      });
    });
  })();

  /* ── POPOVER OPEN/CLOSE ── */
  (function(){
    const overlay  = document.querySelector(".chip-overlay");
    const panel    = document.querySelector(".chip-panel");
    const closeBtn = document.querySelector(".chip-panel__close");
    const labelEl  = document.querySelector(".chip-panel__label");
    const bodyEl   = document.querySelector(".chip-panel__body");
    if (!overlay || !panel) return;

    function open(id) {
      const d = psychData[id];
      if (!d) return;
      labelEl.textContent = d.name.toUpperCase();

      const doItems  = d.do.map(function(t){ return '<li class="psych-do__item">'  + t + '</li>'; }).join('');
      const dontItems= d.dont.map(function(t){ return '<li class="psych-dont__item">' + t + '</li>'; }).join('');

      bodyEl.innerHTML = `
        <div class="cp-hero">
          ${d.latin ? '<p style="font-size:12px;letter-spacing:.1em;text-transform:uppercase;color:var(--text-muted);margin-bottom:8px">' + d.latin + '</p>' : ''}
          <p class="cp-hero__tagline">${d.tagline}</p>
          <div class="psych-impact-row">
            <span class="psych-impact-badge psych-impact-badge--impact">⚡ ${d.impact} Impact</span>
            <span class="psych-impact-badge psych-impact-badge--effort">⚙ ${d.effort} Effort</span>
            <span class="psych-impact-badge psych-impact-badge--effort" style="text-transform:capitalize">◉ ${d.category}</span>
          </div>
        </div>

        <div class="cp-section">
          <p class="cp-section-label">What it is</p>
          <p class="cp-what__text">${d.definition}</p>
        </div>

        <div class="cp-section">
          <p class="cp-section-label">Why the brain does this</p>
          <p class="cp-what__text">${d.why}</p>
        </div>

        <div class="cp-section">
          <p class="cp-section-label">How I've used it</p>
          <blockquote class="cp-example__quote">${d.ux_use}</blockquote>
        </div>

        <div class="cp-section">
          <p class="cp-section-label">Do this / Not that</p>
          <div class="psych-dodont">
            <div class="psych-do">
              <div class="psych-do__header">Do</div>
              <ul class="psych-do__list">${doItems}</ul>
            </div>
            <div class="psych-dont">
              <div class="psych-dont__header">Don't</div>
              <ul class="psych-dont__list">${dontItems}</ul>
            </div>
          </div>
        </div>

        <div class="cp-section">
          <p class="cp-section-label">Real world example</p>
          <div class="psych-real-world">${d.real_world}</div>
        </div>

        <div class="cp-cta">
          <a href="/contact.php" class="cp-cta__btn cp-cta__btn--primary">Work with me ↗</a>
          <a href="/case-study/" class="cp-cta__btn cp-cta__btn--ghost">See case studies</a>
        </div>`;

      panel.scrollTop = 0;
      overlay.classList.add("is-open");
      panel.classList.add("is-open");
      document.body.classList.add("panel-open");
      closeBtn.focus();
    }

    function close() {
      overlay.classList.remove("is-open");
      panel.classList.remove("is-open");
      document.body.classList.remove("panel-open");
    }

    document.querySelectorAll(".psych-card[data-psych]").forEach(function(card){
      card.addEventListener("click", function(){ open(this.dataset.psych); });
      card.addEventListener("keydown", function(e){ if(e.key==="Enter"||e.key===" "){ e.preventDefault(); open(this.dataset.psych); }});
    });

    closeBtn.addEventListener("click", close);
    overlay.addEventListener("click", close);
    document.addEventListener("keydown", function(e){ if(e.key==="Escape") close(); });
  })();
  </script>

  <!-- ── AUDIT DRAWER ── -->
  <div class="audit-drawer" id="audit-drawer" role="complementary" aria-label="UX Audit offer">
    <button class="audit-drawer__close" id="audit-drawer-close" aria-label="Dismiss">✕</button>
    <div class="audit-drawer__icon" aria-hidden="true">🔍</div>
    <div class="audit-drawer__text">
      <p class="audit-drawer__heading">Stuck with conversion? Your UX might be the problem.</p>
      <p class="audit-drawer__sub">Free 30-min audit call · Results in 5 days · No deck, just decisions</p>
    </div>
    <div class="audit-drawer__actions">
      <a href="/contact.php?type=audit" class="audit-drawer__btn audit-drawer__btn--primary">Book Free Call</a>
      <button class="audit-drawer__btn audit-drawer__btn--dismiss" id="audit-drawer-dismiss">Maybe later</button>
    </div>
  </div>

  <script>
  /* ── AUDIT DRAWER ── */
  (function(){
    const drawer  = document.getElementById("audit-drawer");
    const close   = document.getElementById("audit-drawer-close");
    const dismiss = document.getElementById("audit-drawer-dismiss");
    if (!drawer) return;

    /* Don't show if already dismissed this session */
    if (sessionStorage.getItem("audit-drawer-dismissed")) return;

    let shown = false;

    function show() {
      if (shown) return;
      shown = true;
      drawer.classList.add("is-visible");
    }

    function hide() {
      drawer.classList.remove("is-visible");
      sessionStorage.setItem("audit-drawer-dismissed", "1");
    }

    /* Appear after 60% scroll */
    window.addEventListener("scroll", function(){
      const pct = window.scrollY / (document.body.scrollHeight - window.innerHeight);
      if (pct > 0.60) show();
    }, { passive: true });

    /* Also appear after 25s idle on page */
    setTimeout(show, 25000);

    if (close)   close.addEventListener("click", hide);
    if (dismiss) dismiss.addEventListener("click", hide);
  })();
  </script>
  
  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>

</body>
</html>