<?php
require_once __DIR__ . "/../includes/config.php";

$currentKey = "audit";
$pageTitle  = "Swiggy Onboarding & Home Screen UX Audit — Ramesh Mandal";
$pageDesc   = "A heuristic audit of Swiggy's onboarding and home screen — 9 friction points, information architecture breakdown, psychology violations, and redesign suggestions.";

$heuristics = [
  ["id" => "H1",  "label" => "Visibility of System Status",      "score" => 5, "note" => "Location detection feedback is slow with no visible progress indicator. Users are left staring at a blank screen for 3–5 seconds with no explanation."],
  ["id" => "H2",  "label" => "Match Between System & Real World", "score" => 6, "note" => "Food category labels are mostly clear, but 'Swiggy Genie' and 'Swiggy Instamart' introduce brand names where functional descriptions ('Courier' and 'Groceries') would reduce cognitive load."],
  ["id" => "H3",  "label" => "User Control & Freedom",           "score" => 5, "note" => "Skipping onboarding is possible but not obvious. Users who skip cannot set dietary preferences later without navigating to a buried settings screen."],
  ["id" => "H4",  "label" => "Consistency & Standards",          "score" => 4, "note" => "Three distinct card styles on the home screen with no consistent logic for which restaurants get which treatment. Visual hierarchy communicates priority that has no user-relevant meaning."],
  ["id" => "H5",  "label" => "Error Prevention",                 "score" => 4, "note" => "No dietary preference capture during onboarding means vegetarian users are shown non-veg restaurants until they manually filter. The most common customisation need is not addressed at the most appropriate moment."],
  ["id" => "H6",  "label" => "Recognition Over Recall",          "score" => 5, "note" => "Past orders are accessible but require 2 taps from home. Frequently ordered restaurants have no persistent shortcut. Users must remember and search rather than recognise and tap."],
  ["id" => "H7",  "label" => "Flexibility & Efficiency of Use",  "score" => 4, "note" => "No power-user shortcuts. Repeat orders require the same 4-tap flow regardless of how frequently you order. Expert users get no acceleration over first-time users."],
  ["id" => "H8",  "label" => "Aesthetic & Minimalist Design",    "score" => 3, "note" => "The home screen contains: search bar, location selector, promotional carousel (5 cards), category row (12 icons), \"What's on your mind\" row (8 food type chips), a second promotional banner, restaurant listings, and a floating nav. That is 8 competing attention zones above the fold."],
  ["id" => "H9",  "label" => "Help Users Recognise Errors",      "score" => 6, "note" => "Location errors are handled reasonably well. Other error states (restaurant unavailable, item out of stock) have clear messages."],
  ["id" => "H10", "label" => "Help & Documentation",             "score" => 6, "note" => "In-app support is accessible. Swiggy's chat support is notably better than competitors. Loses points for no onboarding guidance after signup."],
];

$overallScore = 58;

$nav = [
  ["id" => "overview",    "label" => "Overview"],
  ["id" => "heuristics",  "label" => "Scorecard"],
  ["id" => "friction",    "label" => "Friction Map"],
  ["id" => "psychology",  "label" => "Psychology"],
  ["id" => "redesign",    "label" => "Redesign"],
  ["id" => "impact",      "label" => "Business Impact"],
];
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
  <meta property="og:type"         content="article"/>
  <meta property="og:url"          content="https://6epixels.com/audit/swiggy-onboarding"/>
  <meta property="og:title"        content="Swiggy Onboarding UX Audit"/>
  <meta property="og:description"  content="9 friction points. UX score 58/100. Swiggy's home screen tries to do everything."/>
  <meta property="og:image"        content="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1200&auto=format&fit=crop"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="Swiggy Onboarding UX Audit"/>
  <meta name="twitter:description" content="9 friction points. UX score 58/100. Swiggy's home screen tries to do everything."/>
  <meta name="twitter:image"       content="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1200&auto=format&fit=crop"/>
  <link rel="canonical"            href="https://6epixels.com/audit/swiggy-onboarding"/>

  <link rel="icon" type="image/x-icon"    href="/assets/icons/favicon.ico"/>
  <link rel="icon" type="image/svg+xml"   href="/assets/icons/favicon.svg"/>
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
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/gallery.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/background.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/footer.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/case-study.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/audit.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/article.css"/>

  <!-- JSON-LD STRUCTURED DATA -->
  <?php
    require_once __DIR__ . '/../includes/schema.php';
    $_thisAudit = null;
    foreach ($audits as $_a) { if ($_a['slug'] === 'swiggy-onboarding') { $_thisAudit = $_a; break; } }
    if ($_thisAudit) {
      echo schema_audit($_thisAudit, $overallScore ?? 0);
    }
  ?>
</head>
<body data-header="dark">

  <!-- READING PROGRESS -->
  <div class="cs-progress-bar" id="cs-progress" role="progressbar" aria-label="Reading progress"></div>

  <!-- PRELOADER -->
  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">Swiggy Onboarding</span>
        <span class="preloader__name-role">UX Audit · Food Delivery</span>
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

<?php require __DIR__ . "/../partials/navigation.php"; ?>

  <div class="page-wrapper">

    <main id="main-content">

      <!-- AUDIT HERO -->
      <div class="audit-detail-hero fade-in">
        <img
          class="audit-detail-hero__img"
          src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2400&auto=format&fit=crop"
          alt="Food spread representing the Swiggy onboarding and home screen audit"
          loading="eager"
        />
        <div class="audit-detail-hero__overlay"></div>
        <div class="audit-detail-hero__content">
          <p class="audit-detail-hero__category">FOOD DELIVERY · UX AUDIT</p>
          <h1 class="audit-detail-hero__title">Swiggy Onboarding<br>& Home Screen</h1>
          <p class="audit-detail-hero__tagline">
            Swiggy's home screen tries to do everything and succeeds at nothing.
          </p>
          <!-- SCORE RING -->
          <div class="audit-score-ring" aria-label="UX Score <?= $overallScore ?> out of 100">
            <svg viewBox="0 0 120 120" class="audit-score-ring__svg" aria-hidden="true">
              <circle cx="60" cy="60" r="50" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="8"/>
              <circle
                cx="60" cy="60" r="50"
                fill="none"
                stroke="<?= $overallScore >= 70 ? '#22c55e' : ($overallScore >= 50 ? '#f59e0b' : '#ef4444') ?>"
                stroke-width="8"
                stroke-linecap="round"
                stroke-dasharray="<?= round(314 * $overallScore / 100) ?> 314"
                transform="rotate(-90 60 60)"
              />
            </svg>
            <div class="audit-score-ring__inner">
              <span class="audit-score-ring__value"><?= $overallScore ?></span>
              <span class="audit-score-ring__label">UX Score</span>
            </div>
          </div>
        </div>
      </div>

      <!-- META BAR -->
      <div class="cs-meta-bar">
        <div class="cs-meta-item">
          <span class="cs-meta-item__label">Product</span>
          <span class="cs-meta-item__value">Swiggy</span>
        </div>
        <div class="cs-meta-item">
          <span class="cs-meta-item__label">Scope</span>
          <span class="cs-meta-item__value">Onboarding & Home Screen</span>
        </div>
        <div class="cs-meta-item">
          <span class="cs-meta-item__label">Audited</span>
          <span class="cs-meta-item__value">2024</span>
        </div>
        <div class="cs-meta-item">
          <span class="cs-meta-item__label">Severity</span>
          <span class="cs-meta-item__value" style="color:#f59e0b">HIGH</span>
        </div>
        <div class="cs-meta-item">
          <span class="cs-meta-item__label">Friction Points</span>
          <span class="cs-meta-item__value">9 Identified</span>
        </div>
      </div>

      <!-- CONTENT -->
      <div class="cs-content">

        <!-- STICKY NAV -->
        <nav class="cs-nav" aria-label="Audit sections">
          <?php foreach ($nav as $n): ?>
            <a href="#<?= $n['id'] ?>" class="cs-nav__item" data-nav="<?= $n['id'] ?>">
              <?= htmlspecialchars($n['label']) ?>
            </a>
          <?php endforeach; ?>
        </nav>

        <!-- ARTICLE -->
        <article class="cs-article">

          <!-- OVERVIEW -->
          <section class="cs-section" id="overview">
            <span class="cs-section__label">01 — Overview</span>
            <h2 class="cs-section__title">The first 60 seconds that shape everything</h2>
            <div class="cs-section__body">
              <p>Swiggy is one of India's two dominant food delivery platforms — a duopoly with Zomato where the battle is fought less on inventory (both have the same restaurants) and more on experience. The first 60 seconds — from app open to first restaurant listing — is where that battle is won or lost.</p>
              <p>This audit covers two related but distinct experiences: the first-run onboarding flow (from install to home screen) and the home screen information architecture. These are inseparable — what you ask during onboarding determines how relevant the home screen feels. Swiggy's problem is that they've invested heavily in the home screen's surface area while underinvesting in the data that would make it genuinely useful.</p>
              <p>I audited the Android app (v4.x) across 3 devices in November 2024. Two first-run sessions (fresh installs) and multiple returning-user sessions across different times of day and locations.</p>
              <p><strong>Disclaimer:</strong> Independent audit. No affiliation with Swiggy. All observations based on publicly available app behaviour.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">58/100</div>
                <div class="cs-metric-card__label">Overall UX score — lower than Zomato on the same heuristics</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">9</div>
                <div class="cs-metric-card__label">Distinct friction points across onboarding and home screen</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">8</div>
                <div class="cs-metric-card__label">Competing attention zones above the fold on home screen</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">0</div>
                <div class="cs-metric-card__label">Dietary preference questions asked during onboarding</div>
              </div>
            </div>
          </section>

          <!-- HEURISTIC SCORECARD -->
          <section class="cs-section" id="heuristics">
            <span class="cs-section__label">02 — Heuristic Scorecard</span>
            <h2 class="cs-section__title">10 heuristics. One honest score.</h2>
            <div class="cs-section__body">
              <p>Each heuristic scored 1–10. Scores below 5 indicate significant usability issues. Swiggy scores notably lower than Zomato on H4 (Consistency) and H8 (Minimalist Design) — both directly traceable to home screen information architecture decisions.</p>
            </div>
            <div class="audit-scorecard">
              <?php foreach ($heuristics as $h): ?>
                <div class="audit-scorecard__row tl-reveal">
                  <div class="audit-scorecard__id"><?= $h['id'] ?></div>
                  <div class="audit-scorecard__content">
                    <div class="audit-scorecard__header">
                      <span class="audit-scorecard__label"><?= htmlspecialchars($h['label']) ?></span>
                      <span class="audit-scorecard__score audit-scorecard__score--<?= $h['score'] <= 4 ? 'critical' : ($h['score'] <= 6 ? 'warning' : 'good') ?>">
                        <?= $h['score'] ?>/10
                      </span>
                    </div>
                    <div class="audit-scorecard__bar-wrap">
                      <div
                        class="audit-scorecard__bar"
                        style="width:<?= ($h['score'] / 10) * 100 ?>%;
                               background:<?= $h['score'] <= 4 ? '#ef4444' : ($h['score'] <= 6 ? '#f59e0b' : '#22c55e') ?>"
                        role="img"
                        aria-label="Score <?= $h['score'] ?> out of 10"
                      ></div>
                    </div>
                    <p class="audit-scorecard__note"><?= htmlspecialchars($h['note']) ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </section>

          <!-- FRICTION MAP -->
          <section class="cs-section" id="friction">
            <span class="cs-section__label">03 — Friction Map</span>
            <h2 class="cs-section__title">Nine points where Swiggy loses users</h2>
            <div class="cs-section__body">
              <p>Ranked by conversion impact. Onboarding friction is listed first because it determines every subsequent home screen interaction — a broken first impression compounds throughout the session.</p>
            </div>
            <div class="cs-steps">

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--critical">!</div>
                <div>
                  <p class="cs-step__title">F1 — Onboarding skips dietary preferences entirely <span class="audit-badge audit-badge--critical">CRITICAL</span></p>
                  <p class="cs-step__desc">India has one of the world's highest rates of vegetarianism — approximately 30% of the population. Swiggy's onboarding asks for your name and phone number. It does not ask whether you're vegetarian, Jain, or have any dietary restrictions. The result: a home screen showing meat dishes to users who will never order them, requiring manual filter application on every single session. This is the single highest-impact missing feature in the entire flow — one question at onboarding would make every subsequent session more relevant.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--critical">!</div>
                <div>
                  <p class="cs-step__title">F2 — Home screen has 8 competing attention zones above the fold <span class="audit-badge audit-badge--critical">CRITICAL</span></p>
                  <p class="cs-step__desc">Counting every distinct visual element above the restaurant listings: (1) location selector + search bar, (2) promotional carousel (auto-scrolling, 5 cards), (3) service category icons row (Swiggy Food / Instamart / Genie / Dineout), (4) "What's on your mind" food type chips, (5) a second static promotional banner, (6) "Top picks for you" section header, (7) restaurant card row. That's 7 distinct UI zones before a user sees the restaurant listings they actually opened the app for. Each zone competes for attention. None of them yields — they all shout simultaneously.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--critical">!</div>
                <div>
                  <p class="cs-step__title">F3 — Auto-scrolling carousel interrupts reading <span class="audit-badge audit-badge--critical">CRITICAL</span></p>
                  <p class="cs-step__desc">The promotional carousel at the top of the home screen auto-scrolls every 3 seconds. When a user is trying to read a restaurant name or delivery time below the carousel, the automatic movement triggers peripheral motion detection — involuntarily pulling attention upward. This is a well-documented accessibility violation (WCAG 2.1 criterion 2.2.2) and a usability anti-pattern. Auto-scrolling content that the user did not initiate interrupts every cognitive task on the screen.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--critical">!</div>
                <div>
                  <p class="cs-step__title">F4 — Location detection blank screen: no feedback for 3–5 seconds <span class="audit-badge audit-badge--critical">CRITICAL</span></p>
                  <p class="cs-step__desc">On first run and on location change, the app displays a blank or near-blank screen while detecting location. No spinner, no message, no progress indicator. Users don't know if the app is working, crashed, or waiting for them to do something. This violates H1 (Visibility of System Status) completely — and at the worst possible moment: the very first impression. Competitive benchmark: Zomato shows a pulsing location pin animation during the same process. Same wait time, radically better perception.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--warning">~</div>
                <div>
                  <p class="cs-step__title">F5 — "Swiggy Genie" and "Instamart" require brand literacy <span class="audit-badge audit-badge--warning">MODERATE</span></p>
                  <p class="cs-step__desc">The service switcher row uses brand names (Swiggy Genie, Instamart) instead of functional descriptors (Send a Package, Groceries). New users have no way to know what these services do without tapping them — adding an unnecessary discovery step. Returning users eventually learn, but the cognitive cost is real on every first-run session. A simple sub-label ("Genie · Send anything") would eliminate this entirely.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--warning">~</div>
                <div>
                  <p class="cs-step__title">F6 — Inconsistent restaurant card styles with no clear logic <span class="audit-badge audit-badge--warning">MODERATE</span></p>
                  <p class="cs-step__desc">Three distinct restaurant card treatments appear on the home screen: large hero cards, standard grid cards, and compact list cards. The visual treatment communicates hierarchy — users assume larger cards are better restaurants or better matches for them. In reality, card size is determined by promotional placement, not relevance. This creates false information — the interface implies a ranking that doesn't exist — and erodes trust when users notice promoted content that doesn't match their preferences.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--warning">~</div>
                <div>
                  <p class="cs-step__title">F7 — No persistent "Reorder" shortcut for frequent orders <span class="audit-badge audit-badge--warning">MODERATE</span></p>
                  <p class="cs-step__desc">The most efficient path for a user who orders the same thing every Tuesday is still 4+ taps: home → search or scroll → restaurant → menu → add items → cart. There is no "order again" shortcut on the home screen for frequently ordered items. This is the power-user efficiency gap — Swiggy's most valuable customers (high-frequency repeat orderers) get no UX reward for their loyalty.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--warning">~</div>
                <div>
                  <p class="cs-step__title">F8 — Filter preferences reset between sessions <span class="audit-badge audit-badge--warning">MODERATE</span></p>
                  <p class="cs-step__desc">If a vegetarian user applies the "Pure Veg" filter, it applies for that session only. On the next session, it resets — requiring reapplication. For a user who will never deviate from this filter, it is friction on every single session. Persistent filter preferences (stored to user profile, not just session) would eliminate this friction permanently for the 30%+ of users with consistent dietary requirements.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--low">·</div>
                <div>
                  <p class="cs-step__title">F9 — Past orders require 2 taps from home <span class="audit-badge audit-badge--low">LOW</span></p>
                  <p class="cs-step__desc">Order history — a primary navigation destination for repeat users — requires Profile → Orders. There's no home screen shortcut. On a platform where repeat ordering is the highest-frequency behaviour, the reorder path should be a first-class navigation element, not a Profile submenu. A dedicated "Reorder" tab in the bottom nav would serve repeat customers significantly better.</p>
                </div>
              </div>

            </div>
          </section>

          <!-- PSYCHOLOGY -->
          <section class="cs-section" id="psychology">
            <span class="cs-section__label">04 — Psychology Breakdown</span>
            <h2 class="cs-section__title">The cognitive principles being violated</h2>
            <div class="cs-section__body">
              <p>Swiggy's home screen problems aren't primarily visual — they're cognitive. The information architecture creates mental load that exhausts users before they've made a single choice.</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Paradox of Choice — too many zones, no clear start</p>
                  <p class="cs-step__desc">Barry Schwartz's paradox: more options reduce satisfaction and increase paralysis. Swiggy's home screen presents 8 distinct zones before any food choice — each demanding a decision about whether to engage with it. The user's cognitive goal is "find something to eat" — but the interface demands they first navigate a promotional carousel, assess a service selector, engage with food type chips, and read two promotional banners before they reach restaurant listings. Decision fatigue sets in before the actual decision.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Attentional capture — auto-scroll exploits involuntary attention</p>
                  <p class="cs-step__desc">The visual system is hardwired to detect motion — it's a survival mechanism. Auto-scrolling content hijacks this reflex, pulling attention to the carousel regardless of the user's intent. This is not a UX dark pattern in the traditional sense — it doesn't deceive — but it is an attention tax paid on every home screen visit. Multiply by daily sessions across millions of users and the aggregate cognitive cost is enormous.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">False hierarchy — visual weight implies relevance that doesn't exist</p>
                  <p class="cs-step__desc">Users are trained — by every well-designed interface — to interpret visual size as importance or relevance. Large card = most relevant. Swiggy's card sizes are determined by paid promotion, not relevance. This creates a silent trust violation: users who select a large-card restaurant and have a poor experience begin to mistrust the interface's implied hierarchy. Over time this erodes confidence in Swiggy's recommendations entirely — a long-term retention risk masquerading as a UI inconsistency.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Peak-End Rule — the blank location screen sets the wrong peak</p>
                  <p class="cs-step__desc">The very first experience of Swiggy — the moment of highest anticipation — is a blank screen with no feedback. This 3–5 second silence is the first "peak" moment of the onboarding experience. Per Kahneman's Peak-End Rule, this negative peak anchors the user's overall memory of onboarding disproportionately. A product that signals "something is happening" during this wait changes what new users remember about their first session.</p>
                </div>
              </div>
            </div>
            <div style="margin-top:16px">
              <span class="cs-insight">🧠 Paradox of Choice</span>
              <span class="cs-insight">🧠 Attentional Capture</span>
              <span class="cs-insight">🧠 False Hierarchy</span>
              <span class="cs-insight">🧠 Peak-End Rule</span>
              <span class="cs-insight">🧠 Cognitive Load Theory</span>
              <span class="cs-insight">🧠 Status Quo Bias</span>
            </div>
          </section>

          <!-- REDESIGN -->
          <section class="cs-section" id="redesign">
            <span class="cs-section__label">05 — Redesign Suggestions</span>
            <h2 class="cs-section__title">Six fixes. Sequenced by impact.</h2>
            <div class="cs-section__body">
              <p>All six fixes below are implementable without redesigning the home screen from scratch. They are surgical improvements that remove friction at specific points — ordered by impact-to-effort ratio.</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">1</div>
                <div>
                  <p class="cs-step__title">Add dietary preference to onboarding (1 question)</p>
                  <p class="cs-step__desc"><strong>Impact: Very High. Effort: Low.</strong> A single screen after phone verification: "Do you have any dietary preferences?" with options for Pure Veg, Jain, No Preference. Store to user profile. Apply as a persistent default filter on the home screen. This single addition makes every subsequent session more relevant for 30%+ of users. Implementation: 1 sprint for the screen, filter persistence logic, and profile storage. The ROI — in reduced filter friction across millions of daily sessions — is immediate.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">2</div>
                <div>
                  <p class="cs-step__title">Stop the auto-scrolling carousel</p>
                  <p class="cs-step__desc"><strong>Impact: High. Effort: Trivial.</strong> Make the promotional carousel manual-only. Users swipe when they want to see the next card. The carousel doesn't scroll without user input. This is a one-line CSS/config change that eliminates attentional hijacking on every home screen visit. The business concern — that promotions get less visibility — is addressable: a dot indicator shows users there are more cards, inviting exploration without forcing it.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">3</div>
                <div>
                  <p class="cs-step__title">Add location detection loading state</p>
                  <p class="cs-step__desc"><strong>Impact: High. Effort: Low.</strong> Show a pulsing pin animation and "Finding restaurants near you" text during the 3–5 second location detection wait. This is purely a perception change — the wait time is identical, but the experience of waiting is transformed. Users who see visible progress assume the app is working; users who see a blank screen assume it has crashed. One animation changes the first impression of every new install.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">4</div>
                <div>
                  <p class="cs-step__title">Reduce home screen zones from 8 to 4</p>
                  <p class="cs-step__desc"><strong>Impact: High. Effort: Medium.</strong> Ruthless prioritisation: keep the search bar, the service selector (with functional labels), the restaurant listings. Remove or collapse the second promotional banner (merge with carousel), remove the food-type chips (replace with a persistent filter bar above listings). The result is a home screen where the user's first viewport is dominated by actual restaurant choices — the thing they opened the app for.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">5</div>
                <div>
                  <p class="cs-step__title">Persist dietary filters across sessions</p>
                  <p class="cs-step__desc"><strong>Impact: Medium. Effort: Low.</strong> If a user applies "Pure Veg" filter, store it to their profile and apply it by default on subsequent sessions. Show a persistent "Filtered: Pure Veg ✕" chip at the top of listings so the filter is visible and dismissible. This eliminates per-session reapplication for users with consistent dietary preferences — a meaningful quality-of-life improvement for a large user segment.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">6</div>
                <div>
                  <p class="cs-step__title">Add "Order Again" shortcut for top 3 repeat orders</p>
                  <p class="cs-step__desc"><strong>Impact: Medium. Effort: Medium.</strong> Below the service selector, show a "Your Usuals" row with the 3 most frequently ordered items — restaurant name, item name, last price — with a one-tap reorder button. Users who order the same thing regularly get a dramatically faster path. This feature rewards high-frequency users and increases repeat order velocity — both directly valuable to Swiggy's unit economics.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- BUSINESS IMPACT -->
          <section class="cs-section" id="impact">
            <span class="cs-section__label">06 — Business Impact</span>
            <h2 class="cs-section__title">What fixing this is worth</h2>
            <div class="cs-section__body">
              <p>Swiggy's most acute UX problem is not any single friction point — it's the compounding effect of friction on every session. Each of the 9 friction points identified costs a small amount of conversion, attention, or trust. Together, they create a first-run experience significantly worse than it needs to be, and a returning-user experience that never gets faster or more relevant.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">30%+</div>
                <div class="cs-metric-card__label">Of users who would benefit immediately from dietary preference onboarding</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">8→4</div>
                <div class="cs-metric-card__label">Home screen attention zones — halving cognitive load above the fold</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">3–5s</div>
                <div class="cs-metric-card__label">Blank screen duration on first run — transformable to a positive moment</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">~2</div>
                <div class="cs-metric-card__label">Sprints to implement fixes 1, 2, 3, and 5 — the highest-leverage changes</div>
              </div>
            </div>
            <div class="cs-section__body" style="margin-top:48px">
              <p>The most important structural observation about Swiggy's UX problems: they are almost entirely self-inflicted. Zomato and Swiggy have essentially identical restaurant inventory in most Indian cities. The product differentiation battle is fought entirely on experience. Swiggy's home screen currently cedes ground on the first impression (blank location screen), the first engagement (8-zone cognitive overload), and the first personalisation moment (no dietary preference capture). All three are fixable without touching the core product.</p>
              <p>Swiggy has demonstrably better in-app support than Zomato, and the underlying checkout experience is solid. The gap is entirely in the first 60 seconds and the home screen architecture. Fix those, and Swiggy's retention story changes substantially.</p>
            </div>

            <blockquote class="cs-callout" style="margin-top:48px">
              This is an independent audit conducted without access to Swiggy's analytics, user research, or internal data. All impact estimates are directional, based on published industry benchmarks. The intent is constructive — the same analysis a senior UX leader would present in an internal product review.
            </blockquote>
          </section>

        </article>
      </div>

    </main>

    <!-- PREV / CTA -->
    <div class="art-next-wrap">
      <section class="art-next" aria-label="More audits">

        <a href="<?= BASE_PATH ?>/audit/zomato-checkout.php" class="art-next__card">
          <span class="art-next__arrow">↗</span>
          <p class="art-next__label">PREVIOUS AUDIT</p>
          <p class="art-next__category">UX Audit · Food Delivery</p>
          <h3 class="art-next__title">Zomato Checkout Flow</h3>
          <p class="art-next__tagline">7 friction points. 61/100 UX score. Payment flow breakdown.</p>
        </a>

        <a href="<?= BASE_PATH ?>/contact.php?type=Consulting" class="art-next__card">
          <span class="art-next__arrow">↗</span>
          <p class="art-next__label">WANT YOUR PRODUCT AUDITED?</p>
          <p class="art-next__category">Consulting · UX Audit</p>
          <h3 class="art-next__title">Request a UX Audit</h3>
          <p class="art-next__tagline">A structured audit with prioritised fixes and business impact estimates.</p>
        </a>

      </section>
    </div>

    <div style="display:none"><!-- placeholder closing main --></div>


    <!-- CROSS-CONTENT INTERNAL LINKS — outside main, full width -->
    <?php
      require __DIR__ . "/../partials/related-content.php";
      render_related_content("audit", "swiggy-onboarding");
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
    var bar  = document.getElementById("cs-progress");
    var main = document.getElementById("main-content");
    if (!bar || !main) return;
    window.addEventListener("scroll", function(){
      var h   = main.scrollHeight - window.innerHeight;
      var pct = Math.min(100, (window.scrollY / h) * 100);
      bar.style.width = pct + "%";
    }, { passive: true });
  })();
  /* ── ACTIVE NAV ── */
  (function(){
    var navItems = document.querySelectorAll(".cs-nav__item[data-nav]");
    var sections = document.querySelectorAll(".cs-section[id]");
    if (!navItems.length) return;
    var obs = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if (e.isIntersecting){
          navItems.forEach(function(n){ n.classList.remove("is-active"); });
          var a = document.querySelector('.cs-nav__item[data-nav="'+e.target.id+'"]');
          if (a) a.classList.add("is-active");
        }
      });
    }, { rootMargin: "-20% 0px -70% 0px" });
    sections.forEach(function(s){ obs.observe(s); });
  })();
  /* ── ANIMATE SCORE BARS ── */
  (function(){
    var bars = document.querySelectorAll(".audit-scorecard__bar");
    if (!bars.length) return;
    var obs = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if (e.isIntersecting){
          e.target.style.transition = "width 0.8s cubic-bezier(0.16,1,0.3,1)";
          obs.unobserve(e.target);
        }
      });
    }, { threshold: 0.5 });
    bars.forEach(function(b){
      var fw = b.style.width;
      b.style.width = "0%";
      obs.observe(b);
      setTimeout(function(){ b.style.width = fw; }, 200);
    });
  })();
  </script>

  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>

  <?php
  $galleryImages = array(
    array('src' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Swiggy splash — onboarding entry point'),
    array('src' => 'https://images.unsplash.com/photo-1551782450-a2132b4ba21d?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Location permission — trust barrier analysis'),
    array('src' => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Home screen — information architecture audit'),
    array('src' => 'https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Restaurant discovery — scroll depth study'),
  );

  $carouselImages = array(
    'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?w=120&h=120&fit=crop&auto=format',
  );
  require __DIR__ . "/../partials/gallery.php";
  ?>
  <script src="<?= BASE_PATH ?>/assets/js/gallery.js" defer></script>
</body>
</html>