<?php
/* =========================================
   PSYCHOLOGY / PRINCIPLE.PHP — Individual principle article
   Mirrors blog/post.php. Reads ?id=, renders the entry's
   ['article'] sub-array. The index (psychology/index.php) is
   untouched and ignores the additive ['article'] key.
   ========================================= */

require_once __DIR__ . "/../includes/config.php";
require_once __DIR__ . "/../data/psychology.php"; /* defines $principles */

$currentKey = "psychology"; /* nav active → Field Notes group */

/* ── id ──────────────────────────────────── */
$id = isset($_GET['id'])
  ? preg_replace('/[^a-z0-9\-]/', '', strtolower(trim($_GET['id'])))
  : '';

/* ── find principle (must have a published article body) ── */
$principle = null;
foreach ($principles as $p) {
  if ($p['id'] === $id) { $principle = $p; break; }
}

/* ── 404: missing, or no article body yet ── */
if (!$principle || empty($principle['article']) || empty($principle['article']['published'])) {
  http_response_code(404);
  require __DIR__ . "/../partials/navigation.php";
  echo '<div style="padding:120px 48px;max-width:600px">';
  echo '<h1 style="font-size:3rem;font-weight:300;margin-bottom:16px">Principle not found</h1>';
  echo '<p style="color:var(--text-muted);margin-bottom:32px">That principle doesn\'t have a full write-up yet, or may have moved.</p>';
  echo '<a href="' . BASE_PATH . '/psychology/" style="color:var(--blue)">&larr; Back to UX Psychology</a>';
  echo '</div>';
  require __DIR__ . "/../partials/footer.php";
  exit;
}

$art      = $principle['article'];
$canonical = "https://6epixels.com/psychology/" . urlencode($principle['id']);
$pageTitle = htmlspecialchars($principle['name']) . " — UX Psychology";
$pageDesc  = htmlspecialchars($art['deck'] ?? $principle['tagline'] ?? '');

require_once __DIR__ . "/../includes/schema.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="<?= $pageDesc ?>"/>
  <meta name="author" content="Ramesh Mandal"/>
  <title><?= $pageTitle ?></title>

  <link rel="canonical" href="<?= $canonical ?>"/>

  <meta property="og:site_name"   content="Ramesh Mandal — UX Psychology"/>
  <meta property="og:type"        content="article"/>
  <meta property="og:url"         content="<?= $canonical ?>"/>
  <meta property="og:title"       content="<?= htmlspecialchars($principle['name']) ?>"/>
  <meta property="og:description" content="<?= $pageDesc ?>"/>
  <meta property="og:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width" content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"      content="en_IN"/>
  <meta name="twitter:card"       content="summary_large_image"/>
  <meta name="twitter:site"       content="@ramsmandal"/>
  <meta name="twitter:title"      content="<?= htmlspecialchars($principle['name']) ?>"/>
  <meta name="twitter:description" content="<?= $pageDesc ?>"/>
  <meta name="twitter:image"      content="https://6epixels.com/assets/og/og-default.jpg"/>

  <link rel="icon" type="image/x-icon"  href="/assets/icons/favicon.ico"/>
  <link rel="icon" type="image/svg+xml" href="/assets/icons/favicon.svg"/>
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/icons/favicon-32x32.png"/>
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/icons/favicon-180x180.png"/>
  <meta name="theme-color" content="#f5f5f3"/>

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
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/article.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/principle.css"/>

  <?php
    echo schema_article_generic(array(
      'title'   => $principle['name'],
      'desc'    => $art['deck'] ?? $principle['tagline'] ?? '',
      'date'    => $art['date'] ?? date('Y-m-d'),
      'url'     => $canonical,
      'tags'    => $art['tags'] ?? array(),
      'section' => 'UX Psychology',
    ));
    echo schema_breadcrumb(array(
      array('Home',           'https://6epixels.com/'),
      array('UX Psychology',  'https://6epixels.com/psychology/'),
      array($principle['name'], $canonical),
    ));
  ?>
</head>
<body>

  <div class="art-progress" id="art-progress" role="progressbar" aria-label="Reading progress"></div>

  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">UX Psychology</span>
        <span class="preloader__name-role"><?= htmlspecialchars($principle['name']) ?></span>
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

  <?php require __DIR__ . "/../partials/navigation.php"; ?>

  <div class="page-wrapper">
    <main id="main-content">

      <!-- ── HERO ── -->
      <header class="pr-hero">
        <p class="pr-hero__kicker"><?= htmlspecialchars($art['kicker'] ?? ('Psychology · ' . $principle['name'])) ?></p>
        <h1 class="pr-hero__title"><?= $art['title_html'] ?? htmlspecialchars($principle['name']) ?></h1>
        <p class="pr-hero__deck"><?= htmlspecialchars($art['deck'] ?? $principle['tagline']) ?></p>
        <div class="pr-hero__meta">
          <?php foreach (($art['tags'] ?? array()) as $t): ?>
            <span class="pr-tag"><?= htmlspecialchars($t) ?></span>
          <?php endforeach; ?>
          <?php if (!empty($art['read_time'])): ?><span><?= htmlspecialchars($art['read_time']) ?></span><?php endif; ?>
          <?php if (!empty($art['date_label'])): ?><span><?= htmlspecialchars($art['date_label']) ?></span><?php endif; ?>
        </div>
      </header>

      <!-- ── 1 · BEHAVIOURAL TRIGGER: reflection demo ── -->
      <?php if (($art['demo'] ?? '') === 'reflection'): ?>
      <section class="pr-section pr-reveal" id="feel-it" style="scroll-margin-top:96px">
        <p class="pr-kicker">Feel it first</p>
        <h2 class="pr-title"><?= $art['demo_title_html'] ?? 'Two choices, <span>same math</span>' ?></h2>
        <p class="pr-lede"><?= htmlspecialchars($art['demo_lede'] ?? '') ?></p>

        <div class="pr-demo" data-pr-demo="reflection">
          <p class="pr-demo__step" data-pr-step>Choice 1 of 2 · A gain</p>
          <p class="pr-demo__prompt" data-pr-prompt>You're handed a decision. Which do you take?</p>
          <p class="pr-demo__sub" data-pr-sub>Both options are worth ₹500 on average.</p>
          <div class="pr-demo__choices" data-pr-choices>
            <button class="pr-choice" type="button" data-pick="sure">
              <span class="pr-choice__tag">Sure thing</span>
              <span class="pr-choice__main">Take <b>₹500</b></span>
              <span class="pr-choice__detail">Guaranteed. No risk.</span>
            </button>
            <button class="pr-choice" type="button" data-pick="gamble">
              <span class="pr-choice__tag">Coin flip</span>
              <span class="pr-choice__main">Flip for <b>₹1,000</b></span>
              <span class="pr-choice__detail">50% win ₹1,000, 50% nothing.</span>
            </button>
          </div>
          <p class="pr-demo__progress" data-pr-progress>Pick one to continue.</p>

          <div class="pr-demo__reveal" data-pr-reveal>
            <p class="pr-kicker" style="margin-bottom:16px">What you just did</p>
            <div class="pr-rc">
              <div class="pr-rc__half"><p class="pr-rc__frame">When it was a gain</p><p class="pr-rc__pick" data-pr-gain>—</p></div>
              <div class="pr-rc__half"><p class="pr-rc__frame">When it was a loss</p><p class="pr-rc__pick" data-pr-loss>—</p></div>
            </div>
            <p class="pr-demo__verdict" data-pr-verdict></p>
            <button class="pr-demo__restart" type="button" data-pr-restart>Run it again</button>
          </div>
        </div>
      </section>
      <?php endif; ?>

      <!-- ── 2 · IN THE WILD ── -->
      <?php if (!empty($art['wild'])): ?>
      <section class="pr-section pr-reveal" id="in-the-wild" style="scroll-margin-top:96px">
        <p class="pr-kicker">In the wild</p>
        <h2 class="pr-title"><?= $art['wild_title_html'] ?? 'Products that get it <span>and don\'t</span>' ?></h2>
        <div class="pr-wild">
          <?php foreach ($art['wild'] as $i => $w): ?>
          <article class="pr-wild__card">
            <span class="pr-wild__num"><?= htmlspecialchars($w['num'] ?? ($i + 1)) ?></span>
            <h3><?= htmlspecialchars($w['title']) ?></h3>
            <p><?= $w['body_html'] ?? htmlspecialchars($w['body']) ?></p>
            <p class="pr-wild__verdict <?= ($w['type'] ?? 'good') === 'good' ? 'is-good' : 'is-bad' ?>">
              <?= ($w['type'] ?? 'good') === 'good' ? '✓' : '✗' ?> <?= htmlspecialchars($w['verdict']) ?>
            </p>
          </article>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- ── 3 · DIAGRAM: value-function curve ── -->
      <?php if (($art['diagram'] ?? '') === 'value-function'): ?>
      <section class="pr-section pr-reveal" id="the-curve" style="scroll-margin-top:96px">
        <p class="pr-kicker">The shape of the feeling</p>
        <h2 class="pr-title"><?= $art['diagram_title_html'] ?? 'The curve bends harder <span>below zero</span>' ?></h2>
        <div class="pr-curve">
          <svg viewBox="0 0 720 380" role="img" aria-label="Prospect theory value function: an S-curve through the origin where the loss limb is about twice as steep as the gain limb">
            <line x1="60" y1="190" x2="680" y2="190" stroke="rgba(0,0,0,0.18)" stroke-width="1"/>
            <line x1="370" y1="30" x2="370" y2="350" stroke="rgba(0,0,0,0.18)" stroke-width="1"/>
            <path d="M 370 190 C 450 150, 560 120, 670 108" fill="none" stroke="var(--blue,#1a46c9)" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M 370 190 C 300 250, 200 300, 80 332" fill="none" stroke="var(--blue,#1a46c9)" stroke-width="2.5" stroke-linecap="round"/>
            <line x1="520" y1="190" x2="520" y2="132" stroke="rgba(0,0,0,0.18)" stroke-width="1" stroke-dasharray="3 3"/>
            <line x1="220" y1="190" x2="220" y2="296" stroke="rgba(0,0,0,0.18)" stroke-width="1" stroke-dasharray="3 3"/>
            <circle cx="520" cy="132" r="5" fill="var(--blue,#1a46c9)"/>
            <circle cx="220" cy="296" r="5" fill="var(--blue,#1a46c9)"/>
            <text x="534" y="128" font-family="Inter, sans-serif" font-size="13" fill="#444">+₹500 feels like this much pleasure</text>
            <text x="206" y="316" font-family="Inter, sans-serif" font-size="13" fill="#444" text-anchor="end">−₹500 feels like</text>
            <text x="206" y="332" font-family="Inter, sans-serif" font-size="13" fill="#444" font-weight="500" text-anchor="end">~2× this much pain</text>
            <text x="660" y="182" font-family="Inter, sans-serif" font-size="12" fill="#888" text-anchor="end">Objective gains →</text>
            <text x="80" y="208" font-family="Inter, sans-serif" font-size="12" fill="#888">← Objective losses</text>
            <text x="382" y="44" font-family="Inter, sans-serif" font-size="12" fill="#888">Subjective value</text>
          </svg>
          <p class="pr-curve__caption"><?= htmlspecialchars($art['diagram_caption'] ?? '') ?></p>
        </div>
      </section>
      <?php endif; ?>

      <!-- ── 4 · THE SCIENCE ── -->
      <?php if (!empty($art['science'])): ?>
      <section class="pr-prose pr-reveal" id="the-science" style="scroll-margin-top:96px">
        <p class="pr-kicker" style="margin-bottom:16px">The science</p>
        <h2><?= htmlspecialchars($art['science']['heading'] ?? 'Where the law comes from') ?></h2>
        <?php foreach (($art['science']['paragraphs'] ?? array()) as $para): ?>
          <p><?= $para /* trusted author HTML (em/strong) */ ?></p>
        <?php endforeach; ?>
        <?php if (!empty($art['science']['quote'])): ?>
          <blockquote><?= htmlspecialchars($art['science']['quote']) ?></blockquote>
        <?php endif; ?>
        <?php if (!empty($art['science']['sources'])): ?>
          <p class="pr-src"><?= $art['science']['sources'] /* citations w/ em */ ?></p>
        <?php endif; ?>
      </section>
      <?php endif; ?>

      <!-- ── 5 · PRODUCT ANALYSIS + METRIC ── -->
      <?php if (!empty($art['analysis'])): ?>
      <section class="pr-prose pr-reveal" id="analysis" style="scroll-margin-top:96px">
        <p class="pr-kicker" style="margin-bottom:16px">Product psychology</p>
        <h2><?= htmlspecialchars($art['analysis']['heading'] ?? '') ?></h2>
        <?php foreach (($art['analysis']['before'] ?? array()) as $para): ?>
          <p><?= $para ?></p>
        <?php endforeach; ?>
        <?php if (!empty($art['analysis']['metric'])): $m = $art['analysis']['metric']; ?>
          <div class="pr-metric">
            <div class="pr-metric__num"><?= htmlspecialchars($m['num']) ?></div>
            <p class="pr-metric__ctx"><?= htmlspecialchars($m['context']) ?></p>
          </div>
        <?php endif; ?>
        <?php foreach (($art['analysis']['after'] ?? array()) as $para): ?>
          <p><?= $para ?></p>
        <?php endforeach; ?>
      </section>
      <?php endif; ?>

      <!-- ── 6 · CHECKLIST ── -->
      <?php if (!empty($art['checklist'])): ?>
      <section class="pr-prose pr-reveal" id="checklist" style="scroll-margin-top:96px">
        <p class="pr-kicker">Take it with you</p>
        <h2 class="pr-title" style="margin-top:16px"><?= $art['checklist_title_html'] ?? 'The checklist' ?></h2>
        <div class="pr-checklist">
          <?php foreach ($art['checklist'] as $i => $c): ?>
          <div class="pr-check">
            <span class="pr-check__mark"><?= $i + 1 ?></span>
            <div>
              <h3><?= htmlspecialchars($c['title']) ?></h3>
              <p><?= htmlspecialchars($c['body']) ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- ── 7 · SEE THIS IN ACTION (hand-edited cross-links) ── -->
      <?php if (!empty($art['action'])): ?>
      <section class="pr-section pr-reveal" id="see-in-action" style="scroll-margin-top:96px">
        <p class="pr-kicker">See this in action</p>
        <h2 class="pr-title">Where this principle <span>shipped</span></h2>
        <div class="pr-action">
          <?php foreach ($art['action'] as $a): ?>
          <a class="pr-action__card" href="<?= BASE_PATH . htmlspecialchars($a['href']) ?>">
            <span class="pr-action__type"><?= htmlspecialchars($a['type']) ?></span>
            <h3><?= htmlspecialchars($a['title']) ?></h3>
            <p><?= htmlspecialchars($a['body']) ?></p>
            <span class="pr-action__link"><?= htmlspecialchars($a['link']) ?> →</span>
          </a>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

    </main>

    <!-- ── Platform-wide cross-content grid ── -->
    <?php
      require __DIR__ . "/../partials/related-content.php";
      render_related_content('psychology', $principle['id']);
    ?>

    <?php require __DIR__ . "/../partials/footer.php"; ?>
  </div>

  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/principle.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>
</body>
</html>