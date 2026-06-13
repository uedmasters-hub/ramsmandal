<?php
require_once __DIR__ . "/../includes/config.php";
$currentKey = "work";
$pageTitle  = "Quikr Unified Design System — Case Study";
$pageDesc   = "How I built Quikr's first cross-vertical design system as sole design lead — a token-based foundation adopted by five engineering teams across five product verticals in 18 months.";
$meta = [
  ["label" => "Role",     "value" => "Design System Owner"],
  ["label" => "Company",  "value" => "Quikr India"],
  ["label" => "Duration", "value" => "18 months"],
  ["label" => "Year",     "value" => "2015 – 2017"],
];
$nav = [
  ["id" => "overview",   "label" => "Overview"],
  ["id" => "problem",    "label" => "Problem"],
  ["id" => "research",   "label" => "Research"],
  ["id" => "process",    "label" => "Process"],
  ["id" => "validation", "label" => "Validation"],
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
  <meta property="og:url"          content="https://6epixels.com/case-study/quikr-design-system"/>
  <meta property="og:title"        content="Quikr Unified Design System — Case Study"/>
  <meta property="og:description"  content="One token foundation. Five product verticals. 18 months. Built as sole design lead with zero prior system at Quikr."/>
  <meta property="og:image"        content="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200&auto=format&fit=crop"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="Quikr Unified Design System — Case Study"/>
  <meta name="twitter:description" content="One token foundation. Five product verticals. 18 months. Built as sole design lead."/>
  <meta name="twitter:image"       content="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200&auto=format&fit=crop"/>
  <link rel="canonical"            href="https://6epixels.com/case-study/quikr-design-system"/>

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
</head>
<body data-header="dark">

  <div class="art-progress" id="art-progress" role="progressbar" aria-label="Reading progress"></div>

  <!-- PRELOADER -->
  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">Quikr Design System</span>
        <span class="preloader__name-role">Case Study · Design Infrastructure</span>
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
          src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2400&auto=format&fit=crop"
          alt="Design system components representing Quikr's unified platform"
          loading="eager"
        />
        <div class="cs-detail-hero__overlay"></div>
        <div class="cs-detail-hero__content">
          <p class="cs-detail-hero__category">DESIGN SYSTEM · PLATFORM INFRASTRUCTURE</p>
          <h1 class="cs-detail-hero__title">Quikr Unified<br>Design System</h1>
          <p class="cs-detail-hero__tagline">One token foundation. Five fragmented verticals. Built from scratch as the sole design lead.</p>
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
            <h2 class="cs-section__title">One platform. Five engineering teams. No shared design language.</h2>
            <div class="cs-section__body">
              <p>Quikr was India's largest classifieds platform — 1,000 cities, 13 categories, $350 million raised. Between 2015 and 2017, an aggressive acquisition strategy produced five distinct product verticals: QuikrCars, QuikrHomes, QuikrJobs, QuikrServices, and the core marketplace. Each ran on its own codebase, with its own engineering team and its own visual language. The platform looked like five different companies sharing a logo.</p>
              <p>I joined as a Visual Designer, progressed to Sr. Visual Designer, and was moved into the core team by the VP as a UI Designer after the classified homepage redesign demonstrated I was operating at a different level. From there I took end-to-end ownership of the design system initiative — the first at Quikr — as sole design lead.</p>
              <p>The brief was "make it consistent." The real question was how to build one design language that feels native to each vertical, reduces the cost of building all of them, and gets adopted by engineers who have no structural reason to use it.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">5 / 5</div>
                <div class="cs-metric-card__label">Verticals fully adopted</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">18 mo</div>
                <div class="cs-metric-card__label">Full adoption timeline</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">3-layer</div>
                <div class="cs-metric-card__label">Token architecture</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">Solo</div>
                <div class="cs-metric-card__label">Design lead — no team</div>
              </div>
            </div>
          </section>

          <!-- ═══════════════════════════════════════
               02 — PROBLEM
          ════════════════════════════════════════ -->
          <section class="cs-section" id="problem">
            <span class="cs-section__label">02 — Problem</span>
            <h2 class="cs-section__title">16 acquisitions. Five codebases. Zero shared foundation.</h2>
            <div class="cs-section__body">
              <p>CEO Pranay Chulet's acquisition strategy was logical from a market coverage standpoint. Between 2015 and 2017, Quikr acquired 16 companies — CommonFloor in real estate, Babajob in blue-collar jobs, and a string of category specialists. Each brought vertical depth, established user bases, and proprietary data. Each also brought its own product, its own engineering culture, and its own interface language.</p>
              <p>The competitive pressure was real. Vertical specialists owned their categories with depth: Naukri and Shine in jobs, 99acres and MagicBricks in real estate, CarDekho and CarTrade in automobiles, OLX in general classifieds. The only durable answer was to ship faster and more coherently than those specialists. That required a shared design foundation. There wasn't one.</p>
              <p><strong>What fragmentation actually cost.</strong> Every new feature required five parallel design and build cycles with no shared components. A button style decision made in QuikrJobs had no relationship to the equivalent decision in QuikrHomes. Brand inconsistency was visible to users crossing verticals. Engineering teams were solving the same interface problems independently, repeatedly. Design-to-dev handoff was slow because there was no shared vocabulary — every spec had to be built from scratch.</p>
            </div>
            <blockquote class="cs-callout">"The platform looked like five different companies sharing a logo. That's not a brand problem — it's a product infrastructure problem."</blockquote>
          </section>

          <!-- ═══════════════════════════════════════
               03 — RESEARCH & AUDIT
          ════════════════════════════════════════ -->
          <section class="cs-section" id="research">
            <span class="cs-section__label">03 — Research &amp; Audit</span>
            <h2 class="cs-section__title">You can't design what you haven't inventoried.</h2>
            <div class="cs-section__body">
              <p><strong>The audit advantage.</strong> Having joined as a Visual Designer responsible for iconography, marketing materials, and brand collaterals, I had something most design system leads don't have at the start: I understood what the brand was actually made of. Where inconsistencies lived. Which were legacy drift versus legitimate vertical-specific decisions. That knowledge made the audit phase faster and the token decisions more honest.</p>

              <p><strong>What the audit found.</strong> Across five verticals: 14 distinct button styles with no shared logic. Six different typographic scales with conflicting base sizes. Colour values defined by hex code in each codebase — no named tokens, no relationship between values. Spacing defined inline on a per-component basis. No shared iconography. No governance model for any of it. The inconsistency wasn't the result of bad decisions — it was the result of five teams making good decisions in isolation.</p>

              <p><strong>The classified homepage redesign — the project that changed my mandate.</strong> What was framed as a visual execution task, I treated as a problem-solving exercise: connecting visual hierarchy decisions to user scanning behaviour and category orientation. The VP recognised it, corrected my title to UI Designer, and moved me into the core team. The design system mandate followed directly. That ground-level work wasn't a detour — it was the foundation that made everything else possible.</p>

              <p><strong>Engineering interviews.</strong> Before designing a single component, I spent two weeks talking to engineering leads across all five verticals. The recurring theme: inconsistency wasn't their biggest frustration. Re-solving the same problems was. Every vertical had independently built form validation, card layouts, and navigation patterns. The appetite for a shared system was there — the ask was that it had to be practical within their existing stacks, not a theoretical ideal that required a full rewrite to adopt.</p>
            </div>
          </section>

          <!-- ═══════════════════════════════════════
               04 — PROCESS & DECISIONS
          ════════════════════════════════════════ -->
          <section class="cs-section" id="process">
            <span class="cs-section__label">04 — Process &amp; Decisions</span>
            <h2 class="cs-section__title">Three decisions that shaped how the system was built — and whether it would last.</h2>
            <div class="cs-section__body">

              <!-- DECISION 1 -->
              <h3>Decision 1 — Three-layer architecture, not a flat style guide</h3>
              <p><strong>Context:</strong> The obvious output was a visual style guide — PDF, colour swatches, type specimens. Fast to produce. Easy to share. Easy to ignore. A style guide documents decisions; it doesn't enforce them. With five engineering teams and no shared tooling, a document wouldn't fix a structural problem.</p>
              <p><strong>Options considered:</strong> Visual style guide — fast to produce, compliance without consistency, no propagation mechanism. Token-based system — named variables as source of truth, components inherit from them, changes propagate automatically.</p>
              <p><strong>Chosen:</strong> Token-first. Three layers: an immutable core of design tokens and typography, a shared component library governed by a two-vertical rule (a component only enters the shared library if it's needed by at least two verticals — preventing premature abstraction), and a vertical extension layer built on the same token set. Every colour, spacing value, and type scale defined as a named variable. Every component references tokens, not hard-coded values. Changing a token changes every component that uses it — across all five verticals simultaneously. Consistency becomes the path of least resistance, not a compliance ask.</p>
              <p><strong>Trade-off accepted:</strong> Implementing the token layer required individual buy-in from each vertical's engineering lead — harder than handing over a PDF. I worked with each tech lead to make the implementation practical within their existing stack. This was relationship work as much as design work. It took time a style guide would not have required. It also produced adoption a style guide never would have.</p>

              <!-- DECISION 2 -->
              <h3>Decision 2 — The two-vertical rule for shared components</h3>
              <p><strong>Context:</strong> Every design system faces the same failure mode: premature abstraction. Components added to the shared library before they're genuinely needed by multiple contexts become constraints that slow down the verticals they were supposed to serve. The system becomes something to work around, not with.</p>
              <p><strong>Options considered:</strong> Add everything that could theoretically be shared — maximum breadth, maximum drift risk. Add only what was actively duplicated — slower initial build, higher adoption confidence.</p>
              <p><strong>Chosen:</strong> A component enters the shared library only when at least two verticals need it independently. Until then, it lives in the vertical's own layer. This kept the shared library lean, intentional, and trusted. Engineering teams knew that if a component was in the shared library, it had been validated across real contexts — not designed speculatively.</p>

              <!-- DECISION 3 -->
              <h3>Decision 3 — QuikrJobs first, fully complete</h3>
              <p><strong>Context:</strong> Stakeholder pressure was to roll out across all five verticals simultaneously — show breadth, show momentum. Five 40%-complete implementations with no clean reference would have produced the same fragmentation the system was designed to solve. Adoption without a working proof point is change management without evidence.</p>
              <p><strong>Options considered:</strong> Simultaneous rollout — visible momentum, shallow adoption, no clean reference. Sequential rollout — one complete reference implementation that vertical leads could see, touch, and evaluate before committing their own teams.</p>
              <p><strong>Chosen:</strong> QuikrJobs as the first complete implementation. Highest listing volume, clearest user flows, and an engineering lead willing to partner on the build. Once Jobs ran cleanly on the system, it became the proof of concept that made every subsequent vertical conversation easier. The question shifted from "why should we adopt this?" to "when can we get this?"</p>

            </div>
          </section>

          <!-- ═══════════════════════════════════════
               05 — VALIDATION
          ════════════════════════════════════════ -->
          <section class="cs-section" id="validation">
            <span class="cs-section__label">05 — Validation</span>
            <h2 class="cs-section__title">You can't user-test a token. Validation had to happen in production.</h2>
            <div class="cs-section__body">
              <p>A design system's quality isn't visible in a Figma file — it's visible when real engineers build against real specs and real users encounter real interfaces. The QuikrJobs rollout was staged deliberately: each stage gated on the previous one clearing before the next began.</p>
            </div>

            <div class="cs-section__body">
              <p><strong>Stage 1 — Spec review with engineering lead.</strong> Annotated component specs reviewed before any build began. The Jobs engineering team identified 3 spacing conflicts with their existing grid. Fixed before build. This stage alone justified the sequential approach — those conflicts would have shipped silently in a simultaneous rollout.</p>

              <p><strong>Stage 2 — Full prototype review.</strong> Complete Jobs listing flow built on new components. Stakeholder review across product, design, and engineering. Card hierarchy approved. Navigation transition required one revision. Signed off for build.</p>

              <p><strong>Stage 3 — Search and browse live.</strong> No regressions. Component behaviour matched intent. System cleared for the listing creation flow.</p>

              <p><strong>Stage 4 — Listing creation and account flows live.</strong> Two edge cases in form validation surfaced in production. Fixed in the shared component layer — and propagated automatically to all subsequent verticals before they'd even built those flows. This is what a token system produces: fixes that compound forward.</p>
            </div>

            <blockquote class="cs-callout">"A design system that's been tested only by the person who built it hasn't been tested. The QuikrJobs rollout surfaced problems I hadn't anticipated — and fixed them before they became systemic across four more verticals."</blockquote>

            <div class="cs-section__body">
              <p><strong>What nearly shipped — and was caught.</strong> An early version of the listing card used a single unified template across all five verticals — same hierarchy, same information density, same visual weight for every data point. Jobs and Services accepted it. Homes and Cars pushed back in review, correctly: a property listing card and a vehicle listing card require fundamentally different scan patterns. Price prominence, image hierarchy, and the role of technical specifications differ significantly between a ₹40 lakh flat and a ₹2 lakh car.</p>
              <p>The fix was a shared structural foundation — card container, spacing, border treatment, responsive behaviour — with vertical-specific information hierarchies built on top. The base was identical across all five verticals. The expression adapted to category context. It was a harder build. It was the right solution. And because the fix was made in the shared component layer, subsequent verticals got it right without re-discovering the problem.</p>
            </div>
          </section>

          <!-- ═══════════════════════════════════════
               06 — OUTCOMES
          ════════════════════════════════════════ -->
          <section class="cs-section" id="outcomes">
            <span class="cs-section__label">06 — Outcomes</span>
            <h2 class="cs-section__title">All five verticals. One foundation. A collateral standard that outlasted my tenure.</h2>
            <div class="cs-section__body">
              <p>All five verticals — QuikrJobs, QuikrServices, QuikrCars, QuikrHomes, and the core marketplace — were running on the shared token and component system within 18 months of the initiative starting. The adoption sequence followed the QuikrJobs reference exactly: each vertical's engineering lead had seen the Jobs implementation before committing, which compressed their adoption timelines significantly.</p>
              <p><strong>The collateral standard.</strong> In parallel with the product design system, I established a new collateral design standard — a direct challenge to the Marketing Head's existing approach, which produced inconsistent brand output across verticals. The new standard was adopted institutionally. It is still being followed at Quikr. That's the metric that matters most for that chapter: not what I produced, but what the organisation continued to produce without me in the room.</p>
              <p><strong>The VP recognition and title correction.</strong> The classified homepage redesign — the project that preceded the design system mandate — resulted in the VP correcting my title from Visual Designer to UI Designer and moving me into the core team. That's the signal that what I was doing had been recognised as operating at a different level, not just executing more competently at the same one.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">5 / 5</div>
                <div class="cs-metric-card__label">Verticals on the system</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">18 mo</div>
                <div class="cs-metric-card__label">Full adoption achieved</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">16+</div>
                <div class="cs-metric-card__label">Acquired companies unified</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">Still live</div>
                <div class="cs-metric-card__label">Collateral standard post-tenure</div>
              </div>
            </div>
            <div class="cs-section__body">
              <p><strong>The organisational shift that mattered most.</strong> Product and engineering teams started opening the design system before scoping new features. Not because they were told to — because it was faster. The shared vocabulary moved from a design artefact into the daily language of product and engineering decision-making. That shift — from compliance to utility — is what separates a design system that lasts from one that gets abandoned the moment the person who built it moves on.</p>
            </div>
          </section>

          <!-- ═══════════════════════════════════════
               07 — LEARNINGS
          ════════════════════════════════════════ -->
          <section class="cs-section" id="learnings">
            <span class="cs-section__label">07 — Learnings</span>
            <h2 class="cs-section__title">What I'd do differently. And what I'd do exactly the same.</h2>
            <div class="cs-section__body">
              <p><strong>Instrument adoption from the start.</strong> I knew the system was being used. I could not show designer productivity rate before and after, component drift rate over time, or user-facing metric improvement attributed specifically to UI consistency. The business case for a design system is easier to make — and easier to defend — with user data alongside engineering data. That instrumentation should have been part of the system specification, not an afterthought.</p>

              <p><strong>The two-vertical rule was right — and I'd enforce it earlier.</strong> The listing card near-miss happened because I tried to abstract a component before it had been validated in two real contexts. The rule existed; I bent it once under deadline pressure. It cost a revision cycle. The rule exists for exactly that reason.</p>

              <p><strong>The relationship work was the real work.</strong> The technical design of the system — tokens, components, documentation — was the visible part. The invisible part was convincing five engineering leads, one at a time, that adopting the system would make their lives easier rather than constrain them. That required understanding their stacks, their pressures, and their objections before presenting any solution. No amount of good system design survives a team that hasn't bought in. The real work is building enough trust with engineering teams that they see the system as a tool that serves them, not a constraint imposed on them.</p>

              <p><strong>What I carried into every subsequent project.</strong> At IndiGo, the design system wasn't a deliverable at the end — it was the first decision. That sequencing came directly from Quikr: I knew from experience what it costs to build the system after the product, and I refused to repeat it. The authority to change a system comes from having lived inside it first.</p>
            </div>
          </section>

        </article>
      </div>

      <!-- NEXT / PREV CASE STUDIES -->
      <div class="art-next-wrap">
        <div class="art-next">
          <a href="<?= BASE_PATH ?>/case-study/indigo-booking.php" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">NEXT CASE STUDY</p>
            <p class="art-next__category">CONSUMER AVIATION</p>
            <h3 class="art-next__title">IndiGo Booking Flow &amp; CX Transformation</h3>
            <p class="art-next__tagline">6× fare selection uplift. NPS +22 pts. 6M monthly passengers.</p>
          </a>
          <a href="<?= BASE_PATH ?>/case-study/crewpal.php" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">ALSO READ</p>
            <p class="art-next__category">ENTERPRISE OPERATIONS</p>
            <h3 class="art-next__title">CrewPal Operations Platform</h3>
            <p class="art-next__tagline">25% satisfaction lift. 18% fewer scheduling errors. 8,000+ crew.</p>
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
      render_related_content("case-study", "quikr-design-system");
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

  <!-- MOBILE FAB -->
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
    array('src' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Quikr UI system — component inventory'),
    array('src' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Pattern library — reusable templates'),
    array('src' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Email campaign design system — CTR optimisation'),
  );

  $carouselImages = array(
    'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=120&h=120&fit=crop&auto=format',
  );
  require __DIR__ . "/../partials/gallery.php";
  ?>
  <script src="<?= BASE_PATH ?>/assets/js/gallery.js" defer></script>
</body>
</html>