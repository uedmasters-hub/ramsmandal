<?php
require_once __DIR__ . "/../includes/config.php";
$currentKey = "work";
$pageTitle  = "IndiGo Booking Flow & CX Transformation — Case Study";
$pageDesc   = "How redesigning the decision architecture — not the interface — produced a 6× uplift in Super 6E fare selection and moved NPS by 22 points across 6M monthly passengers.";
$meta = [
  ["label" => "Role",     "value" => "Sr. Manager UI/UX"],
  ["label" => "Company",  "value" => "IndiGo Airlines"],
  ["label" => "Duration", "value" => "3 years"],
  ["label" => "Year",     "value" => "2022 – 2025"],
];
$nav = [
  ["id" => "overview",   "label" => "Overview"],
  ["id" => "problem",    "label" => "Problem"],
  ["id" => "research",   "label" => "Research"],
  ["id" => "process",    "label" => "Process"],
  ["id" => "prototype",  "label" => "Prototype"],
  ["id" => "outcomes",   "label" => "Outcomes"],
  ["id" => "learnings",  "label" => "Learnings"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/><meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>"/>
  <title><?= htmlspecialchars($pageTitle) ?></title>

  <!-- OG / TWITTER META -->
  <meta property="og:site_name"    content="Ramesh Mandal"/>
  <meta property="og:type"         content="article"/>
  <meta property="og:url"          content="https://6epixels.com/case-study/indigo-booking"/>
  <meta property="og:title"        content="IndiGo Booking Flow & CX Transformation — Case Study"/>
  <meta property="og:description"  content="6× fare selection uplift. NPS +22 pts. 30% fewer support queries. How decision architecture — not UI polish — changed everything."/>
  <meta property="og:image"        content="https://images.unsplash.com/photo-1529074963764-98f45c47344b?q=80&w=1200&auto=format&fit=crop"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="IndiGo Booking Flow & CX Transformation — Case Study"/>
  <meta name="twitter:description" content="6× fare selection uplift. NPS +22 pts. 30% fewer support queries."/>
  <meta name="twitter:image"       content="https://images.unsplash.com/photo-1529074963764-98f45c47344b?q=80&w=1200&auto=format&fit=crop"/>
  <link rel="canonical"            href="https://6epixels.com/case-study/indigo-booking"/>

  <!-- FAVICON -->
  <link rel="icon" type="image/x-icon"    href="/assets/icons/favicon.ico"/>
  <link rel="icon" type="image/svg+xml"   href="/assets/icons/favicon.svg"/>
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/icons/favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/icons/favicon-16x16.png"/>
  <link rel="apple-touch-icon" sizes="180x180"    href="/assets/icons/favicon-180x180.png"/>
  <meta name="theme-color" content="#0f0f0f"/>

  <link rel="preconnect" href="https://fonts.googleapis.com"/><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
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
        if ($cs["slug"] === "indigo-booking") { $studyForSchema = $cs; break; }
    }
    if ($studyForSchema) {
        echo schema_case_study($studyForSchema, "https://6epixels.com/case-study/indigo-booking");
    }
  ?>
</head>
<body data-header="dark">

  <div class="art-progress" id="art-progress" role="progressbar" aria-label="Reading progress"></div>

  <!-- PRELOADER -->
  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">IndiGo Booking</span>
        <span class="preloader__name-role">Case Study · Consumer Aviation</span>
      </div>
      <div class="preloader__bar-wrap"><div class="preloader__bar" id="preloader-bar"></div></div>
      <span class="preloader__counter" id="preloader-counter">0%</span>
    </div>
  </div>

  <div class="bg-canvas" aria-hidden="true"><div class="bg-grid"></div><div class="bg-orb-1"></div><div class="bg-orb-2"></div></div>

  <?php
    $currentKey = "work";
    require_once __DIR__ . "/../partials/navigation.php";
  ?>

  <div class="page-wrapper">
    <main id="main-content">

      <!-- ═══════════════════════════════════════
           HERO
      ════════════════════════════════════════ -->
      <div class="cs-detail-hero fade-in">
        <img
          class="cs-detail-hero__img"
          src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=2400&auto=format&fit=crop"
          alt="IndiGo aircraft representing the booking flow redesign"
          loading="eager"
        />
        <div class="cs-detail-hero__overlay"></div>
        <div class="cs-detail-hero__content">
          <p class="cs-detail-hero__category">CONSUMER BOOKING · CX TRANSFORMATION</p>
          <h1 class="cs-detail-hero__title">IndiGo Booking Flow<br>&amp; CX Transformation</h1>
          <p class="cs-detail-hero__tagline">How redesigning the decision architecture — not the interface — moved NPS by 22 points.</p>
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

      <!-- CONTENT SHELL -->
      <div class="cs-content">

        <!-- STICKY SECTION NAV -->
        <nav class="cs-nav" aria-label="Case study sections">
          <?php foreach ($nav as $n): ?>
            <a href="#<?= $n['id'] ?>" class="cs-nav__item" data-nav="<?= $n['id'] ?>">
              <?= htmlspecialchars($n['label']) ?>
            </a>
          <?php endforeach; ?>
        </nav>

        <article class="cs-article">

          <!-- ═══════════════════════════════════════
               01 — OVERVIEW
          ════════════════════════════════════════ -->
          <section class="cs-section" id="overview">
            <span class="cs-section__label">01 — Overview</span>
            <h2 class="cs-section__title">6 million passengers a month. One booking flow built for the wrong person.</h2>
            <div class="cs-section__body">
              <p>IndiGo is India's largest low-cost carrier. At the time of this project, it was running hundreds of daily sectors across a passenger base growing rapidly beyond its original metro core. The product I inherited was not broken in the conventional sense — it worked. It just worked for the wrong user.</p>
              <p>The booking flow had been designed for a digital-native frequent flyer. That segment was a minority. The majority — first-time flyers, non-tech users, travellers from tier-2 and tier-3 cities — were failing at the homepage, abandoning inside the Search Results Page, and defaulting to the cheapest fare because nothing in the design communicated why any other option was worth more.</p>
              <p>I held <strong>sole UX ownership across 10+ customer-facing applications simultaneously</strong> — booking flow, holiday marketplace, staff travel portal, loyalty programme, check-in, ancillary products, flight status — with no shared design language, no component library, and no system connecting decisions across any of them.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">+22 pts</div>
                <div class="cs-metric-card__label">NPS improvement</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">−30%</div>
                <div class="cs-metric-card__label">Support query volume</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">6×</div>
                <div class="cs-metric-card__label">Super 6E fare selection</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">2023</div>
                <div class="cs-metric-card__label">IndiGo Innovation Award</div>
              </div>
            </div>
          </section>

          <!-- ═══════════════════════════════════════
               02 — PROBLEM
          ════════════════════════════════════════ -->
          <section class="cs-section" id="problem">
            <span class="cs-section__label">02 — Problem</span>
            <h2 class="cs-section__title">The brief said "optimise the flow." Research said the flow was built for the wrong person.</h2>
            <div class="cs-section__body">
              <p>The team's hypothesis going in: a general optimisation problem. Reduce friction, tighten the UI, address support volume. The assumption underneath it — the flow works for most users, needs refinement for the rest.</p>
              <p>Research dismantled that assumption entirely.</p>

              <p><strong>Failure 1 — Homepage widget.</strong> Seven special fare categories — Armed Forces, Senior Citizen, Family &amp; Friends, Students, Minor, Doctors &amp; Nurses, LTC — displayed upfront with no progressive disclosure. Non-tech users read them as required fields. Many abandoned before entering a destination. The gate was at the entrance.</p>

              <p><strong>Failure 2 — Search Results Page.</strong> All flight options open simultaneously. For round trips, both outbound and return legs fully expanded at once. Users entered comparison loops — scrolling, re-evaluating, abandoning. The SRP was the highest drop-off point in the funnel. 62% of drop-offs happened inside this loop.</p>

              <p><strong>Failure 3 — Fare cards.</strong> Lite, Saver, Super 6E, Flexi — equal visual weight, equal card size, identical CTA. Price-sensitive users defaulted to Lite. Not because Super 6E lacked value — 15kg baggage, meal, seat selection, free date change for ~₹1,000 more than Lite is a strong case. The design made that case invisible.</p>
            </div>
            <blockquote class="cs-callout">"The booking flow wasn't confusing. It was designed for the wrong person. And no amount of copy optimisation would fix a structural modelling failure."</blockquote>
          </section>

          <!-- ═══════════════════════════════════════
               03 — RESEARCH
          ════════════════════════════════════════ -->
          <section class="cs-section" id="research">
            <span class="cs-section__label">03 — Research</span>
            <h2 class="cs-section__title">Research that changed the brief, not just the design.</h2>
            <div class="cs-section__body">
              <p>I sequenced research to answer the segment question first — before validating any design direction — because a solution built for the wrong user would compound the failure, not fix it.</p>

              <p><strong>User interviews &amp; contextual research.</strong> Metro and tier-2 travellers, first-time and frequent flyers. Key finding: non-tech users treated the 7 fare categories as required fields, abandoning before entering a destination. This was a structural misread of the UI — not a literacy problem.</p>

              <p><strong>Analytics review.</strong> Full funnel, fare selection distribution, support query categorisation. The SRP was the highest drop-off point. Super 6E consistently underperformed despite strong value positioning. The data confirmed what interviews were showing: the design was suppressing demand, not reflecting it.</p>

              <p><strong>Usability testing — 3 rounds.</strong> 8–12 participants per round, mixed digital literacy cohorts. Round 1 confirmed the comparison loop. Round 2 validated the collapse model with non-tech users. Round 3 approved the fare card hierarchy — and caught a near-mistake before it shipped.</p>

              <p><strong>Competitive benchmarking.</strong> Indian and international airline booking flows. No competitor had solved round-trip decision overload. The collapse model I was designing was a genuine departure from the industry.</p>
            </div>

            <blockquote class="cs-callout">"How do we design a booking experience for India's actual air travel demographic — not the digital-native minority who can navigate anything?"</blockquote>

            <div class="cs-section__body">
              <p><strong>The blind spot — stated honestly.</strong> Testing in early rounds was predominantly with digital-native users — easier to recruit, faster to test, cleaner feedback. This created a systematic gap: some flows that validated well internally failed in the field for tier-2 and non-tech users. We caught it mid-project. The cohort should have been stratified by digital literacy from round one — not added as a corrective measure.</p>
            </div>
          </section>

          <!-- ═══════════════════════════════════════
               04 — PROCESS
          ════════════════════════════════════════ -->
          <section class="cs-section" id="process">
            <span class="cs-section__label">04 — Process</span>
            <h2 class="cs-section__title">Three decisions. One compounding architecture.</h2>
            <div class="cs-section__body">

              <p><strong>Design principle: one decision at a time.</strong> Users fail not because they can't decide — but because we ask them to decide too many things simultaneously. Every screen was redesigned to present exactly one decision and remove everything competing with it.</p>

              <!-- DECISION 1 -->
              <h3>Decision 1 — Homepage: progressive disclosure of special fares</h3>
              <p><strong>Context:</strong> 7 fare categories displayed upfront, no progressive disclosure. Non-tech users treating them as required form fields, abandoning before entering a destination.</p>
              <p><strong>Options considered:</strong> Keep all 7 visible. Remove special fares entirely and surface in a later step. Collapse to a single 'Special Fares' dropdown, expand only if selected.</p>
              <p><strong>Chosen:</strong> Progressive disclosure dropdown. Frequent flyers retain one-tap access. Non-tech users stop encountering what reads as a 7-field gate before they've entered a single journey detail. The inline search bar that replaced the card widget became the founding component of the new design system — one UX decision became infrastructure.</p>

              <!-- DECISION 2 -->
              <h3>Decision 2 — SRP: journey-wise collapse model</h3>
              <p><strong>Context:</strong> All options open simultaneously. 62% of drop-offs inside the comparison loop. SRP was the highest-drop-off point in the entire funnel.</p>
              <p><strong>Options considered:</strong> Highlight selected row, keep all open. Grey out unselected options. Full collapse — selected flight becomes locked compact card, others disappear, 'Change flight' CTA as escape hatch. Paginate one flight at a time.</p>
              <p><strong>Chosen:</strong> Full collapse on selection. For round trips: return leg appears only after outbound is locked. After both legs selected, a summary card shows both flights — clearly labelled, priced, no competing options — as the trust moment before payment. Data showed fewer than 8% of users meaningfully compared options after an initial selection. The collapse eliminates the loop for the 92%.</p>
              <p><strong>Trade-off:</strong> Users who wanted simultaneous comparison lost that ability. The data showed this was the minority whose behaviour was causing the majority to fail. The C-Suite sign-off happened in a single session — I presented the data, the prototype, and the trade-off explicitly. Approved on my recommendation alone.</p>

              <!-- DECISION 3 -->
              <h3>Decision 3 — Fare cards: value hierarchy</h3>
              <p><strong>Context:</strong> Lite, Saver, Super 6E, Flexi — undifferentiated list, equal weight, identical CTA. Price-sensitive users defaulted to Lite. Super 6E value was real and invisible simultaneously.</p>
              <p><strong>Options considered:</strong> Add descriptive copy to each card. Colour coding to differentiate tiers. Featured card treatment — visual prominence, full perk breakdown, primary CTA, 'Best value' badge. Default-select Super 6E and let users downgrade.</p>
              <p><strong>Chosen:</strong> Featured card hierarchy. Value visible before price. Option D — default-select — was tested in Round 3 and pulled before build. Users who noticed the pre-selection felt manipulated. Trust dropped measurably. The featured card without a default produced a comparable selection rate with none of the trust cost.</p>

            </div>
          </section>

          <!-- ═══════════════════════════════════════
               05 — PROTOTYPE & VALIDATION
          ════════════════════════════════════════ -->
          <section class="cs-section" id="prototype">
            <span class="cs-section__label">05 — Prototype &amp; Validation</span>
            <h2 class="cs-section__title">Three rounds. One near-mistake. A lot of watching data refresh.</h2>
            <div class="cs-section__body">
              <p><strong>Round 1 — Lo-fi, frequent flyers.</strong> Collapse model validated for speed. Comparison loop behaviour confirmed in the control condition. Blind spot identified: non-tech users were not yet in the cohort.</p>

              <p><strong>Round 2 — Mid-fi, corrected cohort.</strong> Non-tech and tier-2 users added. Confusion reduction validated. The round-trip summary card — entirely absent in the old flow — was cited as the "first moment of confidence" in the booking journey. Round-trip model validated end-to-end.</p>

              <p><strong>Round 3 — Hi-fi, mixed cohort.</strong> Super 6E selection rate measurably up with featured treatment. Default-selection version tested alongside — trust drop observed immediately. Pulled before build. Final prototype approved for engineering handoff.</p>

              <p><strong>What nearly shipped and was caught.</strong> A version with Super 6E pre-selected. The selection data looked strong in isolation. In the room, the first thing participants said when they noticed the default was "why was this already selected?" Trust dropped. Featured treatment without a default produced comparable selection with no trust cost. Pulled. No debate.</p>
            </div>
          </section>

          <!-- ═══════════════════════════════════════
               06 — OUTCOMES
          ════════════════════════════════════════ -->
          <section class="cs-section" id="outcomes">
            <span class="cs-section__label">06 — Outcomes</span>
            <h2 class="cs-section__title">6× by day four. The data locked and it stayed there.</h2>
            <div class="cs-section__body">
              <p>The SRP collapse model and fare card hierarchy went live the same day. By midnight, Super 6E selection had doubled — 2× the baseline. I stayed with the analytics team for three consecutive days watching engagement data refresh in real time. The team called it at 2× on day one. I wanted to see where it locked before declaring anything.</p>
              <p>By day four, it locked at 6×.</p>
              <p><strong>The compounding architecture.</strong> The 6× result was not produced by either decision alone. The SRP collapse retained users who would have abandoned in the comparison loop. The fare card hierarchy redirected those retained users toward Super 6E once they reached fare selection. Neither screen alone produces 6×. The architecture of the two together did.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">+22 pts</div>
                <div class="cs-metric-card__label">NPS — detractor to promoter majority</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">−30%</div>
                <div class="cs-metric-card__label">Support query volume</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">6×</div>
                <div class="cs-metric-card__label">Super 6E selection vs. baseline</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">10+</div>
                <div class="cs-metric-card__label">Apps unified under one design system</div>
              </div>
            </div>
            <div class="cs-section__body">
              <p><strong>Secondary impact.</strong> The design system became the shared language across all 10 applications — reducing design-to-dev friction on every subsequent product decision at IndiGo. Research findings on tier-2 user failure changed how the product team recruited test participants in all subsequent projects: from convenience sampling to cohort-stratified recruitment. The SRP collapse model set the precedent for how IndiGo approached all major interaction changes: prototype-first, data-supported, single accountable decision-maker.</p>
            </div>
          </section>

          <!-- ═══════════════════════════════════════
               07 — LEARNINGS
          ════════════════════════════════════════ -->
          <section class="cs-section" id="learnings">
            <span class="cs-section__label">07 — Learnings</span>
            <h2 class="cs-section__title">What I'd do differently. Honest, not safe.</h2>
            <div class="cs-section__body">
              <p><strong>Stratify the research cohort from round one.</strong> I over-indexed on digital-native users in early testing — easier to recruit, faster sessions, cleaner feedback. The tier-2 and non-tech users who needed the most from this redesign were the last to be tested. We caught it. It should have been designed in from the start.</p>

              <p><strong>Instrument before touching a single screen.</strong> The analytics review gave us funnel drop-off magnitude — but not segment-level breakdown, not time-on-task, not session replay by city tier. When the 6× result came in, I could show the after. I could not show the before in the same dimension. I now treat instrumentation as a design deliverable, not an engineering afterthought.</p>

              <p><strong>The design system cost was underestimated.</strong> Building it in parallel with live product work — under timeline pressure — meant some early components had to be retrofitted. I underestimated that cost and how much faster everything moved in the 18 months after the system stabilised. The system should have been the first sprint, not a concurrent one.</p>

              <p><strong>What I carried forward.</strong> After this project, I never ship without instrumentation in place first. The analytics setup, event taxonomy, and cohort segmentation plan are part of the design work. Sole accountability at scale means the data is either yours to own or yours to regret not having.</p>
            </div>
          </section>

        </article>
      </div>

      <!-- NEXT / PREV CASE STUDIES -->
      <div class="art-next-wrap">
        <div class="art-next">
          <a href="crewpal.php" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">NEXT CASE STUDY</p>
            <p class="art-next__category">ENTERPRISE OPERATIONS</p>
            <h3 class="art-next__title">CrewPal Operations Platform</h3>
            <p class="art-next__tagline">25% satisfaction lift. 18% fewer scheduling errors. 8,000+ crew.</p>
          </a>
          <a href="design-system.php" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">ALSO READ</p>
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
          <span class="art-fab-drawer__title">In this case study</span>
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

    <!-- CROSS-CONTENT LINKS -->
    <?php
      require_once __DIR__ . "/../partials/related-content.php";
      render_related_content("case-study", "indigo-booking-flow");
    ?>

    <?php require_once __DIR__ . "/../partials/footer.php"; ?>
  </div>

  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/animations.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js" defer></script>

  <!-- READING PROGRESS -->
  <script>
  (function(){
    var bar  = document.getElementById("art-progress");
    var main = document.getElementById("main-content");
    if (!bar || !main) return;
    window.addEventListener("scroll", function(){
      bar.style.width = Math.min(100, (window.scrollY / (main.scrollHeight - window.innerHeight)) * 100) + "%";
    }, { passive: true });
  })();
  </script>

  <!-- STICKY SECTION NAV — active state -->
  <script>
  (function(){
    var items = document.querySelectorAll(".cs-nav__item[data-nav]");
    var secs  = document.querySelectorAll(".cs-section[id]");
    if (!items.length) return;
    var obs = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if (entry.isIntersecting){
          items.forEach(function(n){ n.classList.remove("is-active"); });
          var active = document.querySelector('.cs-nav__item[data-nav="' + entry.target.id + '"]');
          if (active) active.classList.add("is-active");
        }
      });
    }, { rootMargin: "-20% 0px -70% 0px" });
    secs.forEach(function(s){ obs.observe(s); });
  })();
  </script>

  <!-- MOBILE FAB — scroll hide/show + drawer -->
  <script>
  (function(){
    var fab      = document.getElementById("fabBtn");
    var drawer   = document.getElementById("fabDrawer");
    var backdrop = document.getElementById("fabBackdrop");
    if (!fab || !drawer) return;

    function openDrawer(){
      fab.classList.add("is-open");
      fab.setAttribute("aria-expanded", "true");
      backdrop.classList.add("is-open");
      requestAnimationFrame(function(){
        drawer.classList.add("is-open");
        backdrop.classList.add("is-visible");
      });
      document.body.style.overflow = "hidden";
    }
    function closeDrawer(){
      fab.classList.remove("is-open");
      fab.setAttribute("aria-expanded", "false");
      drawer.classList.remove("is-open");
      backdrop.classList.remove("is-visible");
      setTimeout(function(){ backdrop.classList.remove("is-open"); }, 240);
      document.body.style.overflow = "";
    }

    fab.addEventListener("click", function(){ fab.classList.contains("is-open") ? closeDrawer() : openDrawer(); });
    backdrop.addEventListener("click", closeDrawer);
    document.addEventListener("keydown", function(e){ if (e.key === "Escape") closeDrawer(); });
    drawer.querySelectorAll(".art-fab-drawer__item").forEach(function(l){
      l.addEventListener("click", function(){ closeDrawer(); });
    });

    var lastY = 0, timer = null;
    function checkVis(){
      var y  = window.scrollY;
      var h  = window.innerHeight;
      var dh = document.documentElement.scrollHeight;
      if ((y + h) > (dh - 200)) { fab.classList.add("is-hidden"); return; }
      if (y > lastY + 4)        { fab.classList.add("is-hidden"); }
      else if (y < lastY - 4)   { fab.classList.remove("is-hidden"); }
      lastY = y;
      clearTimeout(timer);
      timer = setTimeout(function(){ fab.classList.remove("is-hidden"); }, 800);
    }
    window.addEventListener("scroll", checkVis, { passive: true });

    var fi = drawer.querySelectorAll(".art-fab-drawer__item[data-fab-toc]");
    if (fi.length){
      var o = new IntersectionObserver(function(en){
        en.forEach(function(e){
          if (!e.isIntersecting) return;
          fi.forEach(function(n){ n.classList.remove("is-active"); });
          var a = drawer.querySelector('.art-fab-drawer__item[data-fab-toc="' + e.target.id + '"]');
          if (a) a.classList.add("is-active");
        });
      }, { rootMargin: "-15% 0px -70% 0px" });
      document.querySelectorAll("[id]").forEach(function(el){ o.observe(el); });
    }
  })();
  </script>

  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>


  <?php
  /* ── GALLERY DATA ──────────────────────── */
  $galleryImages = array(
    array('src' => 'https://images.unsplash.com/photo-1520437358207-323b43b50729?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Homepage booking flow — search entry'),
    array('src' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Flight selection — fare comparison grid'),
    array('src' => 'https://images.unsplash.com/photo-1529074963764-98f45c47344b?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Passenger details — progressive disclosure'),
    array('src' => 'https://images.unsplash.com/photo-1587019158091-1a103c5dd17f?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Add-ons selection — ancillary upsell'),
    array('src' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Payment — trust signals and friction reduction'),
    array('src' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Confirmation — post-booking engagement'),
  );

  $carouselImages = array(
    'https://images.unsplash.com/photo-1520437358207-323b43b50729?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1587019158091-1a103c5dd17f?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=120&h=120&fit=crop&auto=format',
  );
  require __DIR__ . "/../partials/gallery.php";
  ?>
  <script src="<?= BASE_PATH ?>/assets/js/gallery.js" defer></script>
</body>
</html>