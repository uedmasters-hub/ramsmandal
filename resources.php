<?php
require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/data/resources.php";

$currentKey = "toolkit";
$pageTitle = "UX Resources — Free Templates, Frameworks & Reading List | Ramesh Mandal";
$pageDesc  = "Free UX resources curated by Ramesh Mandal — UX Design Agency, Gurgaon. Templates, annotated reading list, tool reviews, and proprietary frameworks from 17 years of enterprise product design.";
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
  <meta property="og:url"          content="https://6epixels.com/resources"/>
  <meta property="og:title"        content="UX Resources — Ramesh Mandal"/>
  <meta property="og:description"  content="Frameworks, templates, and curated references from 17 years of enterprise UX practice."/>
  <meta property="og:image"        content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="UX Resources — Ramesh Mandal"/>
  <meta name="twitter:description" content="Frameworks, templates, and curated references from 17 years of enterprise UX practice."/>
  <meta name="twitter:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <link rel="canonical"            href="https://6epixels.com/resources"/>
  
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
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/resources.css"/>

  <?php
    require_once __DIR__ . "/includes/schema.php";
    echo schema_breadcrumb([
        ["Home", "https://6epixels.com/"],
        ["Resources", "https://6epixels.com/resources"],
    ]);
  ?>
</head>
<body>

  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">Resources</span>
        <span class="preloader__name-role">Tools · Books · Frameworks · References</span>
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
    $currentKey = "toolkit"; // change per-page (see table below)
    require_once __DIR__ . "/partials/navigation.php";
  ?>
  <div class="page-wrapper">


    <main id="main-content">

      <!-- ═══════════════ HERO ═══════════════ -->
      <section class="res-hero">
        <div class="fade-in">
          <p class="res-kicker">THE UX LEADER'S TOOLKIT</p>
          <h1 class="res-hero__title">
            <?= htmlspecialchars($resourcesMeta['title']) ?><br>
            <span>No fluff included.</span>
          </h1>
          <p class="res-hero__tagline"><?= htmlspecialchars($resourcesMeta['tagline']) ?></p>
        </div>
        <div class="res-hero__right fade-in">
          <p class="res-hero__desc"><?= htmlspecialchars($resourcesMeta['desc']) ?></p>
          <div class="res-hero__pills">
            <div class="res-pill">
              <span class="res-pill__icon">📥</span>
              <span class="res-pill__num"><?= count($downloads) ?></span>
              <span class="res-pill__lbl">Free templates</span>
            </div>
            <div class="res-pill">
              <span class="res-pill__icon">📚</span>
              <span class="res-pill__num"><?= count($books) ?></span>
              <span class="res-pill__lbl">Annotated books</span>
            </div>
            <div class="res-pill">
              <span class="res-pill__icon">🛠</span>
              <span class="res-pill__num"><?= count($tools) ?></span>
              <span class="res-pill__lbl">Honest tool reviews</span>
            </div>
            <div class="res-pill">
              <span class="res-pill__icon">⚡</span>
              <span class="res-pill__num"><?= count($quickRefs) ?></span>
              <span class="res-pill__lbl">Quick references</span>
            </div>
          </div>
        </div>
      </section>

      <!-- ═══════════════ DOWNLOADS ═══════════════ -->
      <section class="res-section" id="downloads" aria-label="Free downloads">
        <div class="res-section-header">
          <div class="res-section-left">
            <span class="res-section-eyebrow">Free Downloads</span>
            <h2 class="res-section-title">Templates that <span>actually work</span></h2>
          </div>
          <p class="res-section-desc">Built from real projects. Not made for this page.</p>
        </div>

        <div class="res-downloads">
          <?php foreach ($downloads as $i => $dl): ?>
            <div class="res-download-card tl-reveal" style="--delay: <?= ($i % 2) * 80 ?>ms">
              <div class="res-download-card__header">
                <div class="res-download-card__icon"><?= $dl['icon'] ?></div>
                <span class="res-download-card__label"><?= htmlspecialchars($dl['label']) ?></span>
              </div>
              <h3 class="res-download-card__title"><?= htmlspecialchars($dl['title']) ?></h3>
              <p class="res-download-card__desc"><?= htmlspecialchars($dl['desc']) ?></p>
              <div class="res-download-card__meta">
                <span class="res-download-card__meta-item">📄 <?= htmlspecialchars($dl['format']) ?></span>
                <span class="res-download-card__meta-item">· <?= htmlspecialchars($dl['pages']) ?></span>
              </div>
              <a href="<?= htmlspecialchars($dl['href']) ?>" class="res-download-card__cta">
                <?= htmlspecialchars($dl['cta']) ?> ↗
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- ═══════════════ READING STACK ═══════════════ -->
      <section class="res-section" id="reading" aria-label="Recommended reading">
        <div class="res-section-header">
          <div class="res-section-left">
            <span class="res-section-eyebrow">Reading Stack</span>
            <h2 class="res-section-title">Books worth <span>your time</span></h2>
          </div>
          <p class="res-section-desc">Honest annotations. Not just cover images.</p>
        </div>

        <div class="res-books">
          <?php foreach ($books as $i => $book): ?>
            <div class="res-book tl-reveal" style="--delay: <?= ($i % 3) * 60 ?>ms">
              <div class="res-book__emoji"><?= $book['emoji'] ?></div>
              <div class="res-book__body">
                <p class="res-book__title"><?= htmlspecialchars($book['title']) ?></p>
                <p class="res-book__author"><?= htmlspecialchars($book['author']) ?> · <?= htmlspecialchars($book['year']) ?></p>
                <p class="res-book__take"><?= htmlspecialchars($book['take']) ?></p>
                <p class="res-book__quote">"<?= htmlspecialchars($book['quote']) ?>"</p>
                <span class="res-book__for">For: <?= htmlspecialchars($book['for']) ?></span>
              </div>
              <div class="res-book__stars">
                <?= str_repeat('★', $book['rating']) ?><?= str_repeat('☆', 5 - $book['rating']) ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- ═══════════════ TOOLBOX ═══════════════ -->
      <section class="res-section" id="toolbox" aria-label="Tools I use">
        <div class="res-section-header">
          <div class="res-section-left">
            <span class="res-section-eyebrow">The Toolbox</span>
            <h2 class="res-section-title">Tools I actually <span>use and trust</span></h2>
          </div>
          <p class="res-section-desc">Honest about what each tool is good and bad at.</p>
        </div>

        <div class="res-tools">
          <?php foreach ($tools as $i => $tool): ?>
            <div class="res-tool tl-reveal" style="--delay: <?= ($i % 4) * 50 ?>ms">
              <div class="res-tool__header">
                <span class="res-tool__emoji"><?= $tool['emoji'] ?></span>
                <span class="res-tool__level res-tool__level--<?= strtolower($tool['level']) ?>">
                  <?= htmlspecialchars($tool['level']) ?>
                </span>
              </div>
              <p class="res-tool__name"><?= htmlspecialchars($tool['name']) ?></p>
              <p class="res-tool__cat"><?= htmlspecialchars($tool['cat']) ?></p>
              <p class="res-tool__use"><?= htmlspecialchars($tool['use']) ?></p>
              <p class="res-tool__honest"><?= htmlspecialchars($tool['honest']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- ═══════════════ FRAMEWORKS ═══════════════ -->
      <section class="res-section" id="frameworks" aria-label="Design frameworks">
        <div class="res-section-header">
          <div class="res-section-left">
            <span class="res-section-eyebrow">Frameworks</span>
            <h2 class="res-section-title">How I <span>think about design</span></h2>
          </div>
          <p class="res-section-desc">Models I've developed over 17 years. Click to expand.</p>
        </div>

        <div class="res-frameworks" role="list">
          <?php foreach ($frameworks as $fw): ?>
            <div class="res-framework tl-reveal" role="listitem">
              <div class="res-framework__header" onclick="toggleFramework(this)" aria-expanded="false">
                <span class="res-framework__num"><?= $fw['num'] ?></span>
                <span class="res-framework__title"><?= htmlspecialchars($fw['title']) ?></span>
                <span class="res-framework__badge">Used in: <?= htmlspecialchars($fw['used']) ?></span>
                <span class="res-framework__chevron" aria-hidden="true">›</span>
              </div>
              <div class="res-framework__body" aria-hidden="true">
                <div class="res-framework__inner">
                  <div>
                    <p class="res-framework__desc"><?= htmlspecialchars($fw['desc']) ?></p>
                    <div class="res-framework__steps">
                      <?php foreach ($fw['steps'] as $j => $step): ?>
                        <div class="res-framework__step">
                          <span class="res-framework__step-num"><?= $j + 1 ?></span>
                          <span><?= htmlspecialchars($step) ?></span>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <div class="res-framework__used">
                    <strong>Used in</strong>
                    <?= htmlspecialchars($fw['used']) ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- ═══════════════ QUICK REFS ═══════════════ -->
      <section class="res-section" id="quickref" aria-label="Quick references">
        <div class="res-section-header">
          <div class="res-section-left">
            <span class="res-section-eyebrow">Quick Reference</span>
            <h2 class="res-section-title">Questions with <span>direct answers</span></h2>
          </div>
          <p class="res-section-desc">No "it depends." Specific numbers. Real answers.</p>
        </div>

        <div class="res-quickrefs" role="list">
          <?php foreach ($quickRefs as $i => $qr): ?>
            <div class="res-qr tl-reveal" role="listitem" style="--delay: <?= ($i % 2) * 50 ?>ms">
              <p class="res-qr__q"><?= htmlspecialchars($qr['q']) ?></p>
              <span class="res-qr__tag">Answer</span>
              <p class="res-qr__a"><?= htmlspecialchars($qr['a']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- ═══════════════ CTA BAND ═══════════════ -->
      <div class="res-section" style="padding-bottom:0">
        <div class="res-cta fade-in" aria-label="Work together">
          <div>
            <p class="res-cta__eyebrow">Want more than a toolkit?</p>
            <h2 class="res-cta__title">Let's apply these frameworks<br>to your actual product.</h2>
            <p class="res-cta__sub">
              Frameworks are only useful when applied to real problems with real constraints.
              That's what working together looks like.
            </p>
          </div>
          <div class="res-cta__actions">
            <a href="/contact.php?type=audit" class="res-cta__btn res-cta__btn--primary">Request a UX Audit ↗</a>
            <a href="/case-study/" class="res-cta__btn res-cta__btn--ghost">See the outcomes</a>
          </div>
        </div>
      </div>

    </main>

    <?php require_once __DIR__ . "/partials/footer.php"; ?>

  </div>

  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/animations.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js" defer></script>
  <script>
  /* ── FRAMEWORK ACCORDION ── */
  function toggleFramework(header) {
    const card   = header.parentElement;
    const body   = card.querySelector(".res-framework__body");
    const isOpen = card.classList.contains("is-open");

    /* close all */
    document.querySelectorAll(".res-framework.is-open").forEach(function(f){
      f.classList.remove("is-open");
      f.querySelector(".res-framework__header").setAttribute("aria-expanded","false");
      f.querySelector(".res-framework__body").setAttribute("aria-hidden","true");
    });

    /* open clicked if it was closed */
    if (!isOpen) {
      card.classList.add("is-open");
      header.setAttribute("aria-expanded","true");
      body.setAttribute("aria-hidden","false");
    }
  }

  /* ── KEYBOARD SUPPORT ── */
  document.querySelectorAll(".res-framework__header").forEach(function(h){
    h.setAttribute("tabindex","0");
    h.setAttribute("role","button");
    h.addEventListener("keydown", function(e){
      if(e.key==="Enter"||e.key===" "){ e.preventDefault(); toggleFramework(this); }
    });
  });
  </script>

  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>

</body>
</html>