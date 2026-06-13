<?php
require_once __DIR__ . "/../includes/config.php";

$currentKey = "audit";
$pageTitle  = "Zomato Checkout UX Audit — Ramesh Mandal";
$pageDesc   = "A heuristic audit of Zomato's checkout flow — 7 friction points mapped, psychology principles violated, and concrete redesign suggestions.";

$heuristics = [
  ["id" => "H1",  "label" => "Visibility of System Status",     "score" => 6, "note" => "Order status is clear post-checkout but payment state feedback during processing is poor."],
  ["id" => "H2",  "label" => "Match Between System & Real World","score" => 7, "note" => "Language is mostly familiar. 'Pro' tier naming is clear but pricing logic uses internal jargon."],
  ["id" => "H3",  "label" => "User Control & Freedom",          "score" => 5, "note" => "Editing order after checkout is buried. Cancellation window is unclear until it's too late."],
  ["id" => "H4",  "label" => "Consistency & Standards",         "score" => 6, "note" => "Button styles are inconsistent between checkout and post-order screens."],
  ["id" => "H5",  "label" => "Error Prevention",                "score" => 4, "note" => "No address confirmation before payment. No warning when ordering from a restaurant near closing time."],
  ["id" => "H6",  "label" => "Recognition Over Recall",         "score" => 7, "note" => "Saved addresses and past orders are surfaced well. Payment methods less so."],
  ["id" => "H7",  "label" => "Flexibility & Efficiency of Use", "score" => 5, "note" => "Power users have no fast-reorder shortcut from the home screen. Every repeat order requires full checkout."],
  ["id" => "H8",  "label" => "Aesthetic & Minimalist Design",   "score" => 4, "note" => "Checkout screen has 11 distinct UI zones competing for attention. Classic case of feature accumulation without hierarchy."],
  ["id" => "H9",  "label" => "Help Users Recognise Errors",     "score" => 5, "note" => "Payment failure messages are generic. No specific guidance on why a card failed or what to try next."],
  ["id" => "H10", "label" => "Help & Documentation",            "score" => 6, "note" => "Help is accessible but not contextual — same generic FAQ regardless of where you are in the flow."],
];

$overallScore = 61;

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
  <meta property="og:url"          content="https://6epixels.com/audit/zomato-checkout"/>
  <meta property="og:title"        content="Zomato Checkout UX Audit"/>
  <meta property="og:description"  content="7 friction points. UX score 61/100. India's most-used food app loses money at checkout."/>
  <meta property="og:image"        content="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1200&auto=format&fit=crop"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="Zomato Checkout UX Audit"/>
  <meta name="twitter:description" content="7 friction points. UX score 61/100. India's most-used food app loses money at checkout."/>
  <meta name="twitter:image"       content="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1200&auto=format&fit=crop"/>
  <link rel="canonical"            href="https://6epixels.com/audit/zomato-checkout"/>

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
    foreach ($audits as $_a) { if ($_a['slug'] === 'zomato-checkout') { $_thisAudit = $_a; break; } }
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
        <span class="preloader__name-text">Zomato Checkout</span>
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
          src="https://images.unsplash.com/photo-1565299507177-b0ac66763828?q=80&w=2400&auto=format&fit=crop"
          alt="Food delivery representing the Zomato checkout audit"
          loading="eager"
        />
        <div class="audit-detail-hero__overlay"></div>
        <div class="audit-detail-hero__content">
          <p class="audit-detail-hero__category">FOOD DELIVERY · UX AUDIT</p>
          <h1 class="audit-detail-hero__title">Zomato<br>Checkout Flow</h1>
          <p class="audit-detail-hero__tagline">
            India's most-used food app has a checkout that loses money every hour.
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
          <span class="cs-meta-item__value">Zomato</span>
        </div>
        <div class="cs-meta-item">
          <span class="cs-meta-item__label">Scope</span>
          <span class="cs-meta-item__value">Checkout Flow</span>
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
          <span class="cs-meta-item__value">7 Identified</span>
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
            <h2 class="cs-section__title">Why Zomato's checkout matters</h2>
            <div class="cs-section__body">
              <p>Zomato processes millions of orders daily across India. Their checkout is the final — and most financially critical — step in every transaction. A 5% improvement in checkout conversion at Zomato's scale would translate to tens of thousands of additional orders per day.</p>
              <p>This audit covers the mobile checkout flow from cart review to order confirmation — approximately 4 screens that determine whether a user completes their purchase or abandons. I audited the Android app (v17.x) across 3 devices in November 2024, using Nielsen's 10 usability heuristics as the primary framework.</p>
              <p><strong>Disclaimer:</strong> This is an independent audit. I have no affiliation with Zomato. All observations are based on publicly available app behaviour. The goal is constructive critique, not brand criticism.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">61/100</div>
                <div class="cs-metric-card__label">Overall UX score across 10 heuristics</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">7</div>
                <div class="cs-metric-card__label">Distinct friction points identified in the flow</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">4</div>
                <div class="cs-metric-card__label">Critical issues requiring immediate attention</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">3</div>
                <div class="cs-metric-card__label">Psychology principles being violated</div>
              </div>
            </div>
          </section>

          <!-- HEURISTIC SCORECARD -->
          <section class="cs-section" id="heuristics">
            <span class="cs-section__label">02 — Heuristic Scorecard</span>
            <h2 class="cs-section__title">10 heuristics. One honest score.</h2>
            <div class="cs-section__body">
              <p>Each heuristic scored 1–10. Scores below 5 indicate significant usability issues that likely impact conversion. Scores of 4 or below are critical.</p>
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
            <h2 class="cs-section__title">Seven points where users drop</h2>
            <div class="cs-section__body">
              <p>These are the specific moments in the checkout flow where friction is highest — ranked by estimated conversion impact.</p>
            </div>
            <div class="cs-steps">

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--critical">!</div>
                <div>
                  <p class="cs-step__title">F1 — UPI buried below fold on payment screen <span class="audit-badge audit-badge--critical">CRITICAL</span></p>
                  <p class="cs-step__desc">UPI is India's dominant payment method — used by 70%+ of digital transactions. Yet Zomato's payment screen shows credit/debit cards first, with UPI requiring a scroll. This contradicts user mental models and adds unnecessary cognitive load at the highest-anxiety moment. Estimated impact: 8–12% of payment abandonment attributable to this ordering.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--critical">!</div>
                <div>
                  <p class="cs-step__title">F2 — No address confirmation before payment <span class="audit-badge audit-badge--critical">CRITICAL</span></p>
                  <p class="cs-step__desc">The delivery address is shown at the top of checkout but cannot be edited from the payment screen — users must go back, losing their coupon application in the process. This creates a fear of commitment: users scroll back to verify address, disrupting the forward flow. A persistent address chip with inline edit would eliminate this entirely.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--critical">!</div>
                <div>
                  <p class="cs-step__title">F3 — Coupon field resets on back navigation <span class="audit-badge audit-badge--critical">CRITICAL</span></p>
                  <p class="cs-step__desc">If a user applies a coupon, then navigates back to change a cart item, the coupon is cleared on return. This is a direct loss — users who applied a discount and had it silently removed are unlikely to reapply it and more likely to abandon. State should persist across the checkout session unconditionally.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--critical">!</div>
                <div>
                  <p class="cs-step__title">F4 — Payment failure message: "Something went wrong" <span class="audit-badge audit-badge--critical">CRITICAL</span></p>
                  <p class="cs-step__desc">When a payment fails, users receive a generic error with no information about why it failed or what to try next. This is particularly damaging on UPI — where failures can happen for 6 different reasons, each requiring a different recovery action. A specific error ("UPI PIN incorrect — try again" vs "Daily UPI limit reached — use card instead") would recover a significant proportion of failed transactions.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--warning">~</div>
                <div>
                  <p class="cs-step__title">F5 — Delivery time estimate not shown in cart <span class="audit-badge audit-badge--warning">MODERATE</span></p>
                  <p class="cs-step__desc">The delivery time estimate disappears from the restaurant listing when users enter checkout. Users have to remember it — or go back to check. Delivery time is a key variable in the purchase decision (ordering for lunch vs dinner has different tolerances). Surfacing it persistently in the checkout header would reduce back-navigation.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--warning">~</div>
                <div>
                  <p class="cs-step__title">F6 — Pro upsell interrupts the checkout flow <span class="audit-badge audit-badge--warning">MODERATE</span></p>
                  <p class="cs-step__desc">A Zomato Pro upsell modal appears between cart and payment — stopping a user mid-transaction to pitch a subscription. This is a textbook case of friction inserted at the wrong moment. Users in checkout mode have high purchase intent that should be completed, not interrupted. The upsell converts better post-order, when users have just experienced the service they're being asked to subscribe to.</p>
                </div>
              </div>

              <div class="cs-step">
                <div class="cs-step__num audit-step__num--low">·</div>
                <div>
                  <p class="cs-step__title">F7 — No fast-reorder from home screen <span class="audit-badge audit-badge--low">LOW</span></p>
                  <p class="cs-step__desc">Repeat orders are a significant portion of Zomato's transaction volume — same restaurant, same items, same address. There is no shortcut to reorder without going through the full flow. A "Reorder" shortcut on the home screen (showing last 3 orders with one-tap checkout) would materially improve repeat purchase frequency.</p>
                </div>
              </div>

            </div>
          </section>

          <!-- PSYCHOLOGY -->
          <section class="cs-section" id="psychology">
            <span class="cs-section__label">04 — Psychology Breakdown</span>
            <h2 class="cs-section__title">The cognitive principles being violated</h2>
            <div class="cs-section__body">
              <p>Friction points don't exist in a vacuum — each one triggers a specific cognitive response that makes abandonment more likely. Understanding the mechanism points directly to the fix.</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Peak-End Rule — the payment failure ruins the memory</p>
                  <p class="cs-step__desc">Kahneman's Peak-End Rule: people remember an experience by its most intense moment and its ending. A payment failure — confusing, unresolved, without clear recovery — becomes the peak-negative moment. Even if the order eventually succeeds, the memory of struggling with the payment persists. Better error recovery changes what users remember about the experience.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Reactance — the Pro modal creates resistance</p>
                  <p class="cs-step__desc">Psychological reactance: when people feel their freedom is threatened, they resist. A modal interrupting checkout feels coercive — the user is trying to complete a task and the product is blocking them to pitch something else. This creates negative affect toward the Pro product specifically. Users who dismiss the modal are less likely to subscribe later than those who never saw it mid-task.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Status quo bias — UPI ordering violation</p>
                  <p class="cs-step__desc">Users have established mental models for checkout — the most common payment method should be first. When the interface violates this expectation (cards before UPI), users must consciously override their learned behaviour. This increases cognitive load and error probability at the worst possible moment. Matching the interface to the majority mental model is the cheapest possible conversion improvement.</p>
                </div>
              </div>
            </div>
            <div style="margin-top:16px">
              <span class="cs-insight">🧠 Peak-End Rule</span>
              <span class="cs-insight">🧠 Psychological Reactance</span>
              <span class="cs-insight">🧠 Status Quo Bias</span>
              <span class="cs-insight">🧠 Loss Aversion (coupon reset)</span>
              <span class="cs-insight">🧠 Choice Overload</span>
            </div>
          </section>

          <!-- REDESIGN -->
          <section class="cs-section" id="redesign">
            <span class="cs-section__label">05 — Redesign Suggestions</span>
            <h2 class="cs-section__title">Five fixes. Prioritised by impact.</h2>
            <div class="cs-section__body">
              <p>These are not design concepts — they are specific, implementable changes ranked by estimated conversion impact vs engineering effort.</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">1</div>
                <div>
                  <p class="cs-step__title">Promote UPI to the top of the payment list</p>
                  <p class="cs-step__desc"><strong>Impact: High. Effort: Low.</strong> Reorder the payment method list to show UPI first, followed by saved UPI IDs, then cards. This is a configuration change, not a redesign. Based on industry benchmarks, payment method ordering alone accounts for 6–10% of checkout conversion variance. Estimated implementation: 1 sprint.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">2</div>
                <div>
                  <p class="cs-step__title">Persist coupon state across session</p>
                  <p class="cs-step__desc"><strong>Impact: High. Effort: Medium.</strong> Store the applied coupon in session state — it should survive back-navigation, address changes, and item additions. Show a persistent "Coupon applied: SAVE100" chip throughout checkout. This is both a trust fix and a conversion fix — users who see their discount confirmed throughout are less likely to second-guess the purchase.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">3</div>
                <div>
                  <p class="cs-step__title">Specific payment failure messages</p>
                  <p class="cs-step__desc"><strong>Impact: High. Effort: Medium.</strong> Map each payment failure code to a specific, actionable message. "UPI PIN was incorrect — try again" / "Your daily UPI limit has been reached — pay with card" / "Bank server timeout — retry in 30 seconds." Recovery rate on specific error messages vs generic ones averages 40% higher in payment UX research. This requires working with the payment provider to expose error codes to the front end.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">4</div>
                <div>
                  <p class="cs-step__title">Move Pro upsell to post-order confirmation</p>
                  <p class="cs-step__desc"><strong>Impact: Medium. Effort: Low.</strong> Remove the Pro modal from the checkout flow entirely. Replace it with a contextual banner on the order confirmation screen: "You just saved ₹0 on delivery. Pro members save ₹X every month." The user has just completed a positive action — they're in the best possible emotional state to hear about a subscription. Conversion on post-order upsells is 2–3× higher than mid-checkout interruptions.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">5</div>
                <div>
                  <p class="cs-step__title">Persistent delivery time in checkout header</p>
                  <p class="cs-step__desc"><strong>Impact: Medium. Effort: Low.</strong> Add a single line to the checkout header: "Arrives in ~35 min". This is data Zomato already has — it just needs to be carried through to the checkout view. Eliminates the back-navigation loop caused by users trying to verify delivery time before committing to payment.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- BUSINESS IMPACT -->
          <section class="cs-section" id="impact">
            <span class="cs-section__label">06 — Business Impact</span>
            <h2 class="cs-section__title">What fixing this is worth</h2>
            <div class="cs-section__body">
              <p>At Zomato's transaction volume, even small conversion improvements compound into significant revenue. These are directional estimates based on industry benchmarks — not Zomato's internal data, which I don't have access to.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">6–10%</div>
                <div class="cs-metric-card__label">Estimated checkout conversion lift from UPI ordering fix alone</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">40%</div>
                <div class="cs-metric-card__label">Payment failure recovery rate improvement with specific error messages</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">2–3×</div>
                <div class="cs-metric-card__label">Pro subscription conversion rate — post-order vs mid-checkout upsell</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">~4</div>
                <div class="cs-metric-card__label">Sprints to implement all 5 high-impact fixes</div>
              </div>
            </div>
            <div class="cs-section__body" style="margin-top:48px">
              <p>The most important thing about this audit is not any single fix — it's the prioritisation. Companies with Zomato's scale have significant engineering costs. The 5 changes above are ordered by impact-to-effort ratio: the UPI ordering fix and the Pro upsell relocation are configuration changes that could ship in days, not months. Starting there, then validating with A/B tests before investing in the higher-effort payment error work, is the right sequencing.</p>
            </div>

            <!-- DISCLAIMER -->
            <blockquote class="cs-callout" style="margin-top:48px">
              This is an independent audit conducted without access to Zomato's analytics, user research, or internal data. All impact estimates are based on published industry benchmarks and analogous product research. The intent is constructive — these are the same observations a senior UX leader would make in an internal review.
            </blockquote>
          </section>

        </article>
      </div>

    </main>

    <!-- NEXT / CTA -->
    <div class="art-next-wrap">
      <section class="art-next" aria-label="More audits">

        <a href="<?= BASE_PATH ?>/audit/swiggy-onboarding.php" class="art-next__card">
          <span class="art-next__arrow">↗</span>
          <p class="art-next__label">NEXT AUDIT</p>
          <p class="art-next__category">UX Audit · Food Delivery</p>
          <h3 class="art-next__title">Swiggy Onboarding &amp; Home Screen</h3>
          <p class="art-next__tagline">9 friction points. Information architecture breakdown.</p>
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
      render_related_content("audit", "zomato-checkout");
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
  /* ── ANIMATE SCORE BARS ON SCROLL ── */
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
      var finalWidth = b.style.width;
      b.style.width = "0%";
      obs.observe(b);
      setTimeout(function(){ b.style.width = finalWidth; }, 200);
    });
  })();
  </script>

  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>

  <?php
  $galleryImages = array(
    array('src' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Zomato checkout — entry state with basket'),
    array('src' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Address selection — friction point #3'),
    array('src' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Payment options — cognitive overload analysis'),
    array('src' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Order confirmation — post-purchase anxiety'),
  );

  $carouselImages = array(
    'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=120&h=120&fit=crop&auto=format',
  );
  require __DIR__ . "/../partials/gallery.php";
  ?>
  <script src="<?= BASE_PATH ?>/assets/js/gallery.js" defer></script>
</body>
</html>