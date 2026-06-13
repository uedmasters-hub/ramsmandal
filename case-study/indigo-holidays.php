<?php
require_once __DIR__ . "/../includes/config.php";

$currentKey = "work";
$pageTitle  = "IndiGo Holidays Marketplace — Case Study";
$pageDesc   = "How I redesigned the IndiGo Holidays marketplace with personalised hotel bundles, driving 22% ancillary revenue growth in 6 weeks.";

$meta = [
  ["label" => "Role",     "value" => "Sr. Manager UI/UX"],
  ["label" => "Company",  "value" => "IndiGo Airlines"],
  ["label" => "Duration", "value" => "6 months"],
  ["label" => "Year",     "value" => "2023"],
];

$nav = [
  ["id" => "overview",   "label" => "Overview"],
  ["id" => "problem",    "label" => "Problem"],
  ["id" => "research",   "label" => "Research"],
  ["id" => "psychology", "label" => "Psychology"],
  ["id" => "process",    "label" => "Process"],
  ["id" => "solution",   "label" => "Solution"],
  ["id" => "outcomes",   "label" => "Outcomes"],
  ["id" => "learnings",  "label" => "Learnings"],
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
  <meta property="og:url"          content="https://6epixels.com/case-study/indigo-holidays"/>
  <meta property="og:title"        content="IndiGo Holidays Marketplace — Case Study"/>
  <meta property="og:description"  content="Personalised hotel bundles driving 22% ancillary revenue growth in 6 weeks."/>
  <meta property="og:image"        content="https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=1200&auto=format&fit=crop"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="IndiGo Holidays Marketplace — Case Study"/>
  <meta name="twitter:description" content="Personalised hotel bundles driving 22% ancillary revenue growth in 6 weeks."/>
  <meta name="twitter:image"       content="https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=1200&auto=format&fit=crop"/>
  <link rel="canonical"            href="https://6epixels.com/case-study/indigo-holidays"/>

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
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/article.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/case-study.css"/>

  <?php
    require_once __DIR__ . "/../includes/schema.php";
    // Find this study in data
    $studyForSchema = null;
    foreach ($caseStudies as $cs) {
        if ($cs["slug"] === "indigo-holidays") { $studyForSchema = $cs; break; }
    }
    if ($studyForSchema) {
        echo schema_case_study($studyForSchema, "https://6epixels.com/case-study/indigo-holidays");
    }
  ?>
</head>
<body data-header="dark">

  <!-- READING PROGRESS -->
  <div class="art-progress" id="art-progress" role="progressbar" aria-label="Reading progress"></div>

  <!-- PRELOADER -->
  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">IndiGo Holidays</span>
        <span class="preloader__name-role">Case Study · Marketplace & Revenue Design</span>
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

<?php require_once __DIR__ . "/../partials/header.php"; ?>

  <div class="page-wrapper">

    <main id="main-content">

      <!-- HERO IMAGE -->
      <div class="cs-detail-hero fade-in">
        <img
          class="cs-detail-hero__img"
          src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=2400&auto=format&fit=crop"
          alt="Resort pool representing the IndiGo Holidays marketplace redesign"
          loading="eager"
        />
        <div class="cs-detail-hero__overlay"></div>
        <div class="cs-detail-hero__content">
          <p class="cs-detail-hero__category">MARKETPLACE & REVENUE DESIGN</p>
          <h1 class="cs-detail-hero__title">IndiGo Holidays<br>Marketplace</h1>
          <p class="cs-detail-hero__tagline">
            Personalised hotel bundles that turned a broken ancillary into a 22% revenue engine.
          </p>
        </div>
      </div>

      <!-- META BAR -->
      <div class="cs-meta-bar">
        <?php foreach ($meta as $m): ?>
          <div class="cs-meta-item">
            <span class="cs-meta-item__label"><?= htmlspecialchars($m['label']) ?></span>
            <span class="cs-meta-item__value"><?= htmlspecialchars($m['value']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- CONTENT -->
      <div class="cs-content">

        <!-- STICKY NAV -->
        <nav class="cs-nav" aria-label="Case study sections">
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
            <h2 class="cs-section__title">A marketplace no one was using</h2>
            <div class="cs-section__body">
              <p>IndiGo Holidays existed. It had inventory — hotels, transfers, packages — but it existed quietly, almost invisibly, buried three taps deep in the booking confirmation flow. Attachment rates were under 4%. The revenue team knew the opportunity was enormous: a passenger who books a hotel through IndiGo is worth 3× more than one who only books a flight. The problem was entirely on the UX side.</p>
              <p>I was assigned to lead the redesign with a hard constraint: 6 weeks to launch. The revenue team had committed to a Q3 target. There was no time for a ground-up rethink — this needed surgical precision. Find the biggest friction points, fix them, ship, measure.</p>
              <p>What I found was a marketplace that treated every traveller identically regardless of their route, travel party, or booking behaviour — and presented hotel options with no logic, no hierarchy, and no reason to trust the recommendations.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">22%</div>
                <div class="cs-metric-card__label">Ancillary revenue growth within 8 weeks of launch</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">34%</div>
                <div class="cs-metric-card__label">Listing abandonment reduced</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">3.1×</div>
                <div class="cs-metric-card__label">Revenue per user vs flight-only bookings</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">6</div>
                <div class="cs-metric-card__label">Weeks from kickoff to live on production</div>
              </div>
            </div>
          </section>

          <!-- PROBLEM -->
          <section class="cs-section" id="problem">
            <span class="cs-section__label">02 — Problem</span>
            <h2 class="cs-section__title">Four reasons the marketplace was invisible</h2>
            <div class="cs-section__body">
              <p>I began with a full heuristic audit of the existing IndiGo Holidays flow — every screen from entry point to booking confirmation. The problems were not subtle.</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">1</div>
                <div>
                  <p class="cs-step__title">Entry point buried post-confirmation</p>
                  <p class="cs-step__desc">The marketplace was only surfaced after a flight was booked — on the confirmation page, below the fold, competing with seat selection, meal upsell, and insurance. By that point, users were cognitively done. They'd made their decision and mentally closed the transaction.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">2</div>
                <div>
                  <p class="cs-step__title">Zero personalisation in listings</p>
                  <p class="cs-step__desc">A solo business traveller flying Delhi to Mumbai for two nights was shown the same honeymoon resorts and family beach packages as a couple flying Goa for a week. The listing order was price-ascending with no relevance signal — the cheapest, least relevant hotel always appeared first.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">3</div>
                <div>
                  <p class="cs-step__title">No bundle logic — flight and hotel felt disconnected</p>
                  <p class="cs-step__desc">The flight and hotel were purchased through separate, visually distinct flows with different design languages. There was no sense of a "package" — no combined pricing, no shared confirmation, no single itinerary view. Users had no reason to feel they were getting something they couldn't get from MakeMyTrip.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">4</div>
                <div>
                  <p class="cs-step__title">Trust gap — why IndiGo hotels?</p>
                  <p class="cs-step__desc">IndiGo is an airline. Users trusted it for flights. They didn't trust it for hotel curation — and the UI gave them no reason to. No editorial voice, no "IndiGo recommends" signal, no social proof. The inventory looked copy-pasted from a generic OTA API with no differentiation.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- RESEARCH -->
          <section class="cs-section" id="research">
            <span class="cs-section__label">03 — Research</span>
            <h2 class="cs-section__title">Six weeks, two methods, one clear direction</h2>
            <div class="cs-section__body">
              <p>With a 6-week deadline, research had to be fast and focused. I ran two parallel tracks simultaneously rather than sequentially.</p>
              <p><strong>Track 1 — Funnel data (Week 1):</strong> Mixpanel analysis of the existing Holidays flow. The data told a clear story: 71% of users who reached the hotel listing page left within 90 seconds without interacting with a single listing. The scroll depth showed most users never got past the third listing. This wasn't a discovery or pricing problem — it was a relevance and trust problem visible within the first viewport.</p>
              <p><strong>Track 2 — Competitive UX audit (Weeks 1–2):</strong> I audited 6 travel marketplaces — MakeMyTrip, Booking.com, Airbnb, Emirates Holidays, Qantas Hotels, and EaseMyTrip — specifically looking at how each handled the flight-to-hotel transition, personalisation signals, and bundle value communication. Airbnb's editorial voice and Booking.com's urgency mechanics were the clearest reference points.</p>
              <p><strong>User interviews (Weeks 2–3):</strong> 24 interviews with users who had booked IndiGo flights in the last 3 months but not booked through IndiGo Holidays. Key finding: 18 of 24 participants hadn't known IndiGo Holidays existed. Of the 6 who had, 5 said they left because "it felt like an afterthought."</p>
            </div>
            <blockquote class="cs-callout">
              "I saw the hotels section but it looked like they'd just pulled random results. There was nothing that said 'this is right for your trip.' So I went to MakeMyTrip."<br>
              <small>— Interview participant, leisure traveller, Bengaluru</small>
            </blockquote>
            <div class="cs-section__body">
              <p>The quote crystallised the design brief: the marketplace needed to feel <em>curated for this trip</em>, not generic inventory. Every design decision flowed from that principle.</p>
            </div>
          </section>

          <!-- PSYCHOLOGY -->
          <section class="cs-section" id="psychology">
            <span class="cs-section__label">04 — Psychology</span>
            <h2 class="cs-section__title">The decision triggers that drive hotel booking</h2>
            <div class="cs-section__body">
              <p>Hotel selection is one of the most psychologically complex purchase decisions in travel. Unlike flight booking — where price and time are the dominant variables — hotel booking is governed by identity, social proof, and fear of a bad experience. Three principles shaped the redesign:</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Social proof at the moment of uncertainty</p>
                  <p class="cs-step__desc">Users don't trust their own hotel judgment — they trust other people's. The redesign front-loaded review counts, rating scores, and "X IndiGo passengers stayed here" signals above the fold on every listing card. Peer validation replaced editorial trust the brand hadn't yet earned.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Decoy effect in bundle pricing</p>
                  <p class="cs-step__desc">Presenting three bundle tiers (Essential, Comfort, Premium) with the middle tier anchored at a price point designed to make it feel like the obvious rational choice. The "Comfort" bundle was priced to make "Essential" feel insufficient and "Premium" feel extravagant. Middle tier attachment rate: 58%.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Scarcity and urgency — used honestly</p>
                  <p class="cs-step__desc">"Only 2 rooms left at this price" is a dark pattern when fabricated. We implemented real-time inventory signals from the hotel API — only showing scarcity when genuinely true. This maintained trust while still triggering the urgency effect. Conversion on listings showing real scarcity signals was 2.4× higher than those without.</p>
                </div>
              </div>
            </div>
            <div style="margin-top:16px">
              <span class="cs-insight">🧠 Social Proof</span>
              <span class="cs-insight">🧠 Decoy Effect</span>
              <span class="cs-insight">🧠 Scarcity (honest)</span>
              <span class="cs-insight">🧠 Paradox of Choice</span>
              <span class="cs-insight">🧠 Anchoring</span>
            </div>
          </section>

          <!-- PROCESS -->
          <section class="cs-section" id="process">
            <span class="cs-section__label">05 — Process</span>
            <h2 class="cs-section__title">Designing at speed without cutting corners</h2>
            <div class="cs-section__body">
              <p>Six weeks is not long enough to redesign a marketplace from scratch. The process was ruthlessly prioritised — identify the highest-leverage changes, design and test those, leave everything else for iteration post-launch.</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">1</div>
                <div>
                  <p class="cs-step__title">Week 1–2 — Audit, data, and prioritisation</p>
                  <p class="cs-step__desc">Full funnel analysis, competitive audit, and 24 user interviews run in parallel. Output: a prioritised list of 9 changes ranked by impact × implementation speed. Top 4 selected for this sprint. The remaining 5 became the post-launch backlog.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">2</div>
                <div>
                  <p class="cs-step__title">Week 3 — Entry point and personalisation logic</p>
                  <p class="cs-step__desc">Moved the Holidays entry point to the flight search results page — shown contextually when a leisure route was detected (based on destination type and travel party size). Designed the personalisation filter logic with the engineering team: route type, passenger count, booking history, and date range drove listing sort order.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">3</div>
                <div>
                  <p class="cs-step__title">Week 4–5 — Bundle design and listing cards</p>
                  <p class="cs-step__desc">Designed the 3-tier bundle system (Essential / Comfort / Premium), the new listing card format with social proof signals, and the combined flight + hotel itinerary view. 3 rounds of rapid usability testing with 18 participants each. Major finding: the itinerary view was the single biggest trust builder — seeing flight and hotel in one confirmed view made the package feel real.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">4</div>
                <div>
                  <p class="cs-step__title">Week 6 — QA, edge cases, and launch</p>
                  <p class="cs-step__desc">Full QA pass across 12 device/browser combinations. Edge case handling for no-inventory routes, single-traveller bookings, and same-day searches. Launched to 100% of traffic with Mixpanel event tracking on every interaction for immediate post-launch measurement.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- SOLUTION -->
          <section class="cs-section" id="solution">
            <span class="cs-section__label">06 — Solution</span>
            <h2 class="cs-section__title">Four changes. One coherent marketplace.</h2>
            <div class="cs-section__body">
              <p><strong>1. Contextual entry point.</strong> Holidays surfaced on the search results page for leisure routes — not buried post-confirmation. A persistent "Add hotel" card appeared alongside flight results, positioned as completing the trip rather than an upsell. For business routes, it was suppressed entirely — no irrelevant offers, no noise.</p>
              <p><strong>2. Personalised listing sort.</strong> Listing order was driven by a relevance score combining route type, passenger count, price range of the flight booked, and (for returning users) booking history. A family of four flying Goa saw family resorts with kid-friendly amenities first. A solo traveller on a business route saw city-centre hotels with workspace amenities. Same inventory, completely different experience.</p>
              <p><strong>3. Three-tier bundle architecture.</strong> Essential (room only + airport transfer), Comfort (room + breakfast + transfer), Premium (room + full board + transfer + travel insurance). Pricing displayed as "per person per night" to make premium options feel accessible. Combined flight + hotel checkout in a single flow — one payment, one confirmation email, one itinerary.</p>
              <p><strong>4. Editorial trust layer.</strong> "IndiGo Recommends" badge on a curated set of 40 hotels per city — hand-selected by the travel team based on consistent guest ratings and IndiGo passenger satisfaction scores. This gave the brand a curatorial voice it hadn't had before and created a quality signal users could orient around.</p>
            </div>
            <blockquote class="cs-callout">
              The combined itinerary view — showing the IndiGo flight and hotel side by side in a single confirmed booking — was described by test participants as "the thing that made it feel like a real package, not just two separate purchases."
            </blockquote>
          </section>

          <!-- OUTCOMES -->
          <section class="cs-section" id="outcomes">
            <span class="cs-section__label">07 — Outcomes</span>
            <h2 class="cs-section__title">Revenue moved. Fast.</h2>
            <div class="cs-section__body">
              <p>All metrics measured 8 weeks post-launch vs the equivalent 8-week period pre-redesign. Baseline excluded COVID-recovery anomaly months.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">22%</div>
                <div class="cs-metric-card__label">Ancillary revenue growth — Holidays contribution to total revenue</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">34%</div>
                <div class="cs-metric-card__label">Listing abandonment reduced — users now engaging with listings before leaving</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">58%</div>
                <div class="cs-metric-card__label">Comfort tier attachment — middle bundle chosen most frequently</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">2.4×</div>
                <div class="cs-metric-card__label">Conversion lift on listings with real scarcity signals vs those without</div>
              </div>
            </div>
            <div class="cs-section__body" style="margin-top:48px">
              <p>The "IndiGo Recommends" editorial layer — which I'd proposed and the team had been sceptical about ("we're not a travel magazine") — became the most clicked element on the listing page. Users used it as a starting point rather than filtering from scratch. It was retained and expanded to 60 cities in the Q4 iteration.</p>
              <p>The project was cited in the 2023 IndiGo annual report as a contributing factor to ancillary revenue growth — rare for a UX project to receive that level of business attribution.</p>
            </div>
          </section>

          <!-- LEARNINGS -->
          <section class="cs-section" id="learnings">
            <span class="cs-section__label">08 — Learnings</span>
            <h2 class="cs-section__title">What six weeks teaches you about design under pressure</h2>
            <div class="cs-section__body">
              <p><strong>Constraints accelerate good decisions.</strong> Six weeks sounds impossible. It's actually clarifying. When you can't do everything, you focus on the one or two changes that will move the most. The prioritisation work in week one — ranking 9 potential changes by impact × speed — was the most valuable design work of the entire project. Everything else flowed from it.</p>
              <p><strong>Entry point is everything in an ancillary product.</strong> The existing Holidays flow was not bad UX — it was invisible UX. Moving the entry point from post-confirmation to in-results was responsible for a disproportionate share of the revenue lift. Users can't buy what they don't see. Placement is design.</p>
              <p><strong>Personalisation doesn't require AI.</strong> The relevance sorting was built on 4 simple signals: route type, passenger count, flight price range, and booking history. No machine learning, no complex recommendation engine. Just logical rules applied consistently. The result felt personalised to users who had never experienced personalisation from IndiGo before. Sometimes smart logic beats sophisticated algorithms.</p>
              <p><strong>Trust is the real conversion problem in new product categories.</strong> IndiGo had never curated hotels before. Users' default assumption was that the inventory was generic and the recommendations were paid placements. The "IndiGo Recommends" badge, backed by real guest satisfaction data, was the fastest way to earn curatorial trust without years of brand building. Transparency about the selection criteria was the feature that made it credible.</p>
            </div>
          </section>

        </article>

      </div>

      <!-- NEXT CASE STUDIES -->
            <div class="art-next-wrap">
        <div class="art-next">
          <a href="indigo-loyalty.php" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">PREVIOUS CASE STUDY</p>
            <p class="art-next__category">LOYALTY</p>
            <h3 class="art-next__title">Gamified Loyalty Program</h3>
            <p class="art-next__tagline">40% retention increase.</p>
          </a>
          <a href="design-system.php" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">NEXT CASE STUDY</p>
            <p class="art-next__category">DESIGN INFRASTRUCTURE</p>
            <h3 class="art-next__title">Enterprise Design System</h3>
            <p class="art-next__tagline">One system. Ten products. 40% faster delivery.</p>
          </a>
        </div>
      </div>


      <!-- MOBILE FAB TOC -->
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
          <?php foreach ($nav as $i => $n): ?>
            <a href="#<?= $n['id'] ?>" class="art-fab-drawer__item" data-fab-toc="<?= $n['id'] ?>">
              <span class="art-fab-drawer__num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
              <?= htmlspecialchars($n['label']) ?>
            </a>
          <?php endforeach; ?>
        </nav>
      </div>
</main>

    <!-- CROSS-CONTENT INTERNAL LINKS — outside main, full width -->
    <?php
      require_once __DIR__ . "/../partials/related-content.php";
      render_related_content("case-study", "indigo-holidays");
    ?>

    <?php require_once __DIR__ . "/../partials/footer.php"; ?>

  </div>

  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/animations.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js" defer></script>
  <script>
  /* ── READING PROGRESS ── */
  (function(){
    const bar  = document.getElementById("art-progress");
    const main = document.getElementById("main-content");
    if (!bar || !main) return;
    window.addEventListener("scroll", function(){
      const h   = main.scrollHeight - window.innerHeight;
      const pct = Math.min(100, (window.scrollY / h) * 100);
      bar.style.width = pct + "%";
    }, { passive: true });
  })();
  /* ── ACTIVE NAV HIGHLIGHT ── */
  (function(){
    const navItems = document.querySelectorAll(".cs-nav__item[data-nav]");
    const sections = document.querySelectorAll(".cs-section[id]");
    if (!navItems.length) return;
    const obs = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if (e.isIntersecting){
          navItems.forEach(function(n){ n.classList.remove("is-active"); });
          const active = document.querySelector('.cs-nav__item[data-nav="'+e.target.id+'"]');
          if (active) active.classList.add("is-active");
        }
      });
    }, { rootMargin: "-20% 0px -70% 0px" });
    sections.forEach(function(s){ obs.observe(s); });
  })();
  </script>

  <script>
  /* ── MOBILE FAB — scroll hide/show + footer avoidance ── */
  (function(){
    var fab=document.getElementById("fabBtn"),drawer=document.getElementById("fabDrawer"),backdrop=document.getElementById("fabBackdrop");
    if(!fab||!drawer)return;
    function openDrawer(){fab.classList.add("is-open");fab.setAttribute("aria-expanded","true");backdrop.classList.add("is-open");requestAnimationFrame(function(){drawer.classList.add("is-open");backdrop.classList.add("is-visible");});document.body.style.overflow="hidden";}
    function closeDrawer(){fab.classList.remove("is-open");fab.setAttribute("aria-expanded","false");drawer.classList.remove("is-open");backdrop.classList.remove("is-visible");setTimeout(function(){backdrop.classList.remove("is-open");},240);document.body.style.overflow="";}
    fab.addEventListener("click",function(){fab.classList.contains("is-open")?closeDrawer():openDrawer();});
    backdrop.addEventListener("click",closeDrawer);
    document.addEventListener("keydown",function(e){if(e.key==="Escape")closeDrawer();});
    drawer.querySelectorAll(".art-fab-drawer__item").forEach(function(l){l.addEventListener("click",function(){closeDrawer();});});
    var lastY=0,timer=null;
    function checkVis(){var y=window.scrollY,h=window.innerHeight,dh=document.documentElement.scrollHeight;
      if((y+h)>(dh-200)){fab.classList.add("is-hidden");return;}
      if(y>lastY+4){fab.classList.add("is-hidden");}else if(y<lastY-4){fab.classList.remove("is-hidden");}
      lastY=y;clearTimeout(timer);timer=setTimeout(function(){fab.classList.remove("is-hidden");},800);}
    window.addEventListener("scroll",checkVis,{passive:true});
    var fi=drawer.querySelectorAll(".art-fab-drawer__item[data-fab-toc]");
    if(fi.length){var o=new IntersectionObserver(function(en){en.forEach(function(e){if(!e.isIntersecting)return;fi.forEach(function(n){n.classList.remove("is-active");});var a=drawer.querySelector('.art-fab-drawer__item[data-fab-toc="'+e.target.id+'"]');if(a)a.classList.add("is-active");});},{rootMargin:"-15% 0px -70% 0px"});document.querySelectorAll("[id]").forEach(function(el){o.observe(el);});}
  })();
  </script>
  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>

  <?php
  /* ── GALLERY DATA ──────────────────────── */
  $galleryImages = array(
    array('src' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Holiday packages — bundled offers discovery'),
    array('src' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Hotel selection — personalised recommendations'),
    array('src' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Bundle builder — flight + hotel configuration'),
    array('src' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Ancillary upsell — activity add-ons'),
  );

  $carouselImages = array(
    'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=120&h=120&fit=crop&auto=format',
  );
  require __DIR__ . "/../partials/gallery.php";
  ?>
  <script src="<?= BASE_PATH ?>/assets/js/gallery.js" defer></script>
</body>
</html>