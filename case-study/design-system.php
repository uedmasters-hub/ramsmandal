<?php
require_once __DIR__ . "/../includes/config.php";

$currentKey = "work";
$pageTitle  = "Enterprise Design System — Case Study";
$pageDesc   = "How I built IndiGo's enterprise design system from scratch — 200+ components, 10+ products, 40% faster delivery, and a 15-person team that finally spoke the same visual language.";

$meta = [
  ["label" => "Role",     "value" => "Sr. Manager UI/UX"],
  ["label" => "Company",  "value" => "IndiGo Airlines"],
  ["label" => "Duration", "value" => "3 years ongoing"],
  ["label" => "Year",     "value" => "2021 – 2024"],
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
  <meta property="og:url"          content="https://6epixels.com/case-study/design-system"/>
  <meta property="og:title"        content="Enterprise Design System — Case Study"/>
  <meta property="og:description"  content="One system. Ten products. 40% faster delivery. 200+ components, 15 designers, 3 years."/>
  <meta property="og:image"        content="https://images.unsplash.com/photo-1558655146-9f40138edfeb?q=80&w=1200&auto=format&fit=crop"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="Enterprise Design System — Case Study"/>
  <meta name="twitter:description" content="One system. Ten products. 40% faster delivery. 200+ components, 15 designers, 3 years."/>
  <meta name="twitter:image"       content="https://images.unsplash.com/photo-1558655146-9f40138edfeb?q=80&w=1200&auto=format&fit=crop"/>
  <link rel="canonical"            href="https://6epixels.com/case-study/design-system"/>

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
        if ($cs["slug"] === "design-system") { $studyForSchema = $cs; break; }
    }
    if ($studyForSchema) {
        echo schema_case_study($studyForSchema, "https://6epixels.com/case-study/design-system");
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
        <span class="preloader__name-text">Enterprise Design System</span>
        <span class="preloader__name-role">Case Study · Design Infrastructure</span>
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

  <?php
    $currentKey = "work"; // this is header section
    require_once __DIR__ . "/../partials/navigation.php";
  ?>

  <div class="page-wrapper">

    <main id="main-content">

      <!-- HERO IMAGE -->
      <div class="cs-detail-hero fade-in">
        <img
          class="cs-detail-hero__img"
          src="https://images.unsplash.com/photo-1558655146-9f40138edfeb?q=80&w=2400&auto=format&fit=crop"
          alt="Design system components and grid representing enterprise design infrastructure"
          loading="eager"
        />
        <div class="cs-detail-hero__overlay"></div>
        <div class="cs-detail-hero__content">
          <p class="cs-detail-hero__category">DESIGN INFRASTRUCTURE</p>
          <h1 class="cs-detail-hero__title">Enterprise<br>Design System</h1>
          <p class="cs-detail-hero__tagline">
            One system. Ten products. A 15-person team that finally spoke the same language.
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
            <h2 class="cs-section__title">Ten products. Zero shared language.</h2>
            <div class="cs-section__body">
              <p>By 2021, IndiGo's digital product portfolio had grown to 10+ products — booking flow, check-in, CrewPal, Staff Travel, IndiGo Holidays, loyalty, corporate portal, cargo, airport kiosks, and internal operations tools. Each had been built by different teams, at different times, with different design decisions. The result was a portfolio that shared a logo but not much else.</p>
              <p>Buttons had 6 different visual treatments across products. Typography scaled inconsistently between mobile and web. A designer moving from the booking team to the CrewPal team had to relearn every pattern. Engineering spent 20% of sprint capacity recreating UI components that already existed somewhere else in the codebase.</p>
              <p>I proposed, resourced, and led the build of IndiGo's first enterprise design system — a shared Figma library, token architecture, component documentation, and handoff protocol used across all 10 products and a 15-person design team.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">40%</div>
                <div class="cs-metric-card__label">Faster delivery velocity across product teams</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">200+</div>
                <div class="cs-metric-card__label">Components built and documented</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">60%</div>
                <div class="cs-metric-card__label">Reduction in design debt across the portfolio</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">10+</div>
                <div class="cs-metric-card__label">Products actively using the system</div>
              </div>
            </div>
          </section>

          <!-- PROBLEM -->
          <section class="cs-section" id="problem">
            <span class="cs-section__label">02 — Problem</span>
            <h2 class="cs-section__title">The hidden cost of inconsistency</h2>
            <div class="cs-section__body">
              <p>The problem with design inconsistency is that it's invisible until you measure it. No one flags "we have 6 button styles" as a business risk. It surfaces slowly — in slower sprints, in engineering rework, in user confusion when moving between IndiGo products, in onboarding time for new designers.</p>
              <p>I made it visible by quantifying it. Before proposing the system, I spent 3 weeks auditing the portfolio and building a business case:</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">1</div>
                <div>
                  <p class="cs-step__title">Component duplication across codebases</p>
                  <p class="cs-step__desc">The same button component existed in 8 different forms across product codebases. Engineering estimated 340 hours per quarter spent recreating UI components that already existed elsewhere. That's 9 weeks of one engineer's time — every quarter — spent on zero-value work.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">2</div>
                <div>
                  <p class="cs-step__title">Designer onboarding took 3–4 weeks</p>
                  <p class="cs-step__desc">A new designer joining any IndiGo product team had to reverse-engineer the visual language from existing screens. There was no documentation, no component library, no design principles. Every designer rebuilt context from scratch. Average time to first independent contribution: 3.5 weeks.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">3</div>
                <div>
                  <p class="cs-step__title">Design reviews consumed by inconsistency debates</p>
                  <p class="cs-step__desc">In cross-team design reviews, 40% of feedback was about visual inconsistency — wrong button radius, different spacing from the adjacent product, mismatched type scale. None of this was about product thinking or user experience. It was quality noise that could have been eliminated by a shared standard.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">4</div>
                <div>
                  <p class="cs-step__title">Users noticed — and lost trust</p>
                  <p class="cs-step__desc">In usability sessions, participants frequently commented on visual inconsistencies when moving between IndiGo products. "This looks like a different app" was a direct quote from 7 separate sessions. Inconsistency signals low quality — and low quality erodes trust, even when the underlying product works.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- RESEARCH -->
          <section class="cs-section" id="research">
            <span class="cs-section__label">03 — Research</span>
            <h2 class="cs-section__title">Auditing 10 products before writing a single component</h2>
            <div class="cs-section__body">
              <p>Design system work is infrastructure work — and infrastructure decisions made without a thorough audit create new problems while solving old ones. I spent 6 weeks in research and audit before proposing a single token or building a single component.</p>
              <p><strong>Visual audit:</strong> Screenshot-catalogued every UI component across all 10 products. 2,400 screens captured and tagged by component type. Found: 6 button variants, 11 card styles, 4 navigation patterns, 9 form field treatments, and 14 different uses of the IndiGo blue across the portfolio.</p>
              <p><strong>Designer interviews:</strong> 1:1s with all 15 designers across product teams. Core finding: every designer was maintaining their own personal Figma library of IndiGo components because no official one existed. 15 shadow libraries, each slightly different, each drifting further from the others over time.</p>
              <p><strong>Engineering interviews:</strong> 8 engineers across 4 teams. Core finding: the front-end teams had started building their own informal component libraries in code — 3 separate React component libraries existed across the codebase, none of them shared, all of them partially inconsistent with each other.</p>
              <p><strong>Competitive benchmark:</strong> Audited the design systems of Airbnb (Lunar), Atlassian (Atlaskit), IBM (Carbon), and Shopify (Polaris) — specifically their token architecture, documentation standards, and governance models. Carbon's token hierarchy and Polaris's usage documentation became the primary references.</p>
            </div>
            <blockquote class="cs-callout">
              "I've built my own Figma library over 2 years. It has everything I need. But it only works for me — and when I leave, it leaves with me."<br>
              <small>— Senior designer, booking team</small>
            </blockquote>
            <div class="cs-section__body">
              <p>This quote defined the risk I was solving: IndiGo's design knowledge was locked in individuals, not institutionalised. The system needed to outlast any single designer — including me.</p>
            </div>
          </section>

          <!-- PSYCHOLOGY -->
          <section class="cs-section" id="psychology">
            <span class="cs-section__label">04 — Psychology</span>
            <h2 class="cs-section__title">The human side of systems adoption</h2>
            <div class="cs-section__body">
              <p>Design systems fail more often from adoption problems than from technical ones. A technically perfect system that designers don't use is worthless. Understanding the psychological barriers to adoption shaped every decision about how the system was built and rolled out.</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">IKEA effect — involve people in building it</p>
                  <p class="cs-step__desc">People value things they've helped create more than things handed to them. I involved designers from all 4 product teams in the component definition phase — running working sessions where teams nominated the patterns they wanted standardised first. This created co-ownership rather than compliance.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Loss aversion — frame it as gain, not replacement</p>
                  <p class="cs-step__desc">Designers were attached to their personal libraries. "We're replacing your library with ours" would have created resistance. The framing was "we're building a foundation that makes your library better" — the system was positioned as amplifying individual work, not overriding it.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">◎</div>
                <div>
                  <p class="cs-step__title">Social proof — early adopters as advocates</p>
                  <p class="cs-step__desc">I identified 3 influential senior designers and onboarded them to the system first — before any wider rollout. Their public use of the system in design reviews created social proof. When the booking team's lead designer was using it and crediting it publicly, adoption accelerated faster than any mandate would have.</p>
                </div>
              </div>
            </div>
            <div style="margin-top:16px">
              <span class="cs-insight">🧠 IKEA Effect</span>
              <span class="cs-insight">🧠 Loss Aversion</span>
              <span class="cs-insight">🧠 Social Proof</span>
              <span class="cs-insight">🧠 Mere Exposure Effect</span>
              <span class="cs-insight">🧠 Autonomy Preservation</span>
            </div>
          </section>

          <!-- PROCESS -->
          <section class="cs-section" id="process">
            <span class="cs-section__label">05 — Process</span>
            <h2 class="cs-section__title">Three years. Four phases. One living system.</h2>
            <div class="cs-section__body">
              <p>A design system is never finished — it's a product with its own roadmap. The build was structured in four phases, each with a defined scope and measurable adoption milestone before moving to the next.</p>
            </div>
            <div class="cs-steps">
              <div class="cs-step">
                <div class="cs-step__num">1</div>
                <div>
                  <p class="cs-step__title">Phase 1 — Foundation (6 months, 2021)</p>
                  <p class="cs-step__desc">Token architecture: colour, typography, spacing, elevation, border radius. A single source of truth for every visual decision. All tokens defined in Figma variables and mirrored to CSS custom properties for engineering. 4 cross-team working sessions to ratify tokens before they were locked. Output: 80 design tokens, zero ambiguity about the core visual language.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">2</div>
                <div>
                  <p class="cs-step__title">Phase 2 — Core Components (8 months, 2022)</p>
                  <p class="cs-step__desc">Built the 40 highest-frequency components nominated by product teams in the audit — buttons, form fields, navigation, cards, modals, alerts, badges, and tables. Each component: Figma variants for all states (default/hover/active/disabled/error), usage documentation, do/don't examples, and accessibility specification. Engineering received component specs in a format they could build directly from.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">3</div>
                <div>
                  <p class="cs-step__title">Phase 3 — Patterns & Templates (10 months, 2022–2023)</p>
                  <p class="cs-step__desc">Moved from atoms to molecules and organisms. Built 12 page templates (listing, detail, checkout, confirmation, empty state, error, onboarding, dashboard) and 28 interaction patterns (search, filter, sort, pagination, infinite scroll, form validation). Templates reduced new feature design time from days to hours for common layouts.</p>
                </div>
              </div>
              <div class="cs-step">
                <div class="cs-step__num">4</div>
                <div>
                  <p class="cs-step__title">Phase 4 — Governance & Contribution (Ongoing, 2023–2024)</p>
                  <p class="cs-step__desc">A system no one can contribute to dies. Established a contribution protocol — any designer can propose a new component via a standardised brief, reviewed by a 3-person system team in a fortnightly session. Accepted components are built, documented, and released in a monthly system update. By 2024, 30% of new components were contributed by product teams, not the system team.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- SOLUTION -->
          <section class="cs-section" id="solution">
            <span class="cs-section__label">06 — Solution</span>
            <h2 class="cs-section__title">What the system is made of</h2>
            <div class="cs-section__body">
              <p><strong>Token architecture — the foundation everything else inherits from.</strong> Three token tiers: primitive tokens (raw values — `blue-600: #1a46c9`), semantic tokens (intent-based — `color-action-primary: blue-600`), and component tokens (component-specific — `button-background-primary: color-action-primary`). This hierarchy means a brand colour change cascades through the entire system by updating one primitive token — not 200 components.</p>
              <p><strong>200+ Figma components with full variant coverage.</strong> Every component built with Figma's variant system — all states, all sizes, all themes (light/dark, though dark was IndiGo internal tools only). Auto-layout used throughout for components that needed to scale with content. Every component detached from its origin file — teams could use them without being blocked by library permission issues.</p>
              <p><strong>Documentation built into the components.</strong> Each Figma component has an annotation layer (hidden by default, visible for developers) with spacing specs, colour tokens, and accessibility notes embedded directly. No separate spec document to keep in sync. The component is the spec.</p>
              <p><strong>Handoff protocol — eliminating the design-engineering gap.</strong> A standardised Figma frame structure for every feature delivery: component inventory, spacing annotations, state map, edge cases, and mobile breakpoints — all in one deliverable. Engineering reported 40% reduction in back-and-forth clarification requests after the protocol was adopted.</p>
            </div>
            <blockquote class="cs-callout">
              The token architecture change — moving from hardcoded hex values to semantic token references — meant when IndiGo updated their brand blue in late 2023, the change propagated across all 10 products and 200 components in 4 hours, not 4 weeks.
            </blockquote>
          </section>

          <!-- OUTCOMES -->
          <section class="cs-section" id="outcomes">
            <span class="cs-section__label">07 — Outcomes</span>
            <h2 class="cs-section__title">Infrastructure that compounded over time</h2>
            <div class="cs-section__body">
              <p>Design system ROI is hard to measure in a single quarter. The value compounds — every component built is a component never rebuilt, every pattern documented is a pattern never debated again. Measured at the 18-month mark after core components launched:</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">40%</div>
                <div class="cs-metric-card__label">Faster design-to-dev delivery — measured across 6 product teams over 3 quarters</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">60%</div>
                <div class="cs-metric-card__label">Reduction in design debt — components with multiple inconsistent versions eliminated</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">3.5w → 4d</div>
                <div class="cs-metric-card__label">Designer onboarding time — new team members productive in days, not weeks</div>
              </div>
              <div class="cs-metric-card">
                <div class="cs-metric-card__value">30%</div>
                <div class="cs-metric-card__label">Component contributions from product teams — system is self-sustaining</div>
              </div>
            </div>
            <div class="cs-section__body" style="margin-top:48px">
              <p>The brand colour update in late 2023 was the system's most visible proof point. A change that would previously have required a designer on each of 10 product teams to manually update hundreds of screens was completed in 4 hours by updating a single primitive token. That moment converted the final sceptics in engineering leadership.</p>
              <p>The system also changed how IndiGo hired designers. Job descriptions for product designer roles now listed "experience with design systems" as a requirement — a direct response to how central the system had become to day-to-day work.</p>
            </div>
          </section>

          <!-- LEARNINGS -->
          <section class="cs-section" id="learnings">
            <span class="cs-section__label">08 — Learnings</span>
            <h2 class="cs-section__title">What three years of systems work teaches you</h2>
            <div class="cs-section__body">
              <p><strong>A design system is a product, not a project.</strong> The most common failure mode is treating system work as a one-time deliverable — build it, ship it, done. It's not done. It needs a roadmap, a release cadence, a contribution model, and a team who owns it long-term. The governance structure I put in place in Phase 4 was more important than any component built in Phase 2.</p>
              <p><strong>Adoption is a design problem.</strong> The system's technical quality mattered less than whether people used it. I spent more time on onboarding, documentation clarity, and the contribution protocol than on the components themselves. The best design system in the world is worthless if teams build around it. Make adoption the easiest path.</p>
              <p><strong>Start with tokens, not components.</strong> Every design system I've seen that started with components eventually had to go back and retrofit a token layer — which breaks everything. Tokens first means every subsequent component decision is coherent. It's slower to start, but it's the only architecture that scales.</p>
              <p><strong>Involve engineering from day one, not handoff.</strong> The three separate React component libraries that existed before this system were built because engineering didn't trust that design would give them something they could actually use. Involving engineers in component definition — specifically in deciding what states and variants to include — meant the Figma components mapped to code components almost one-to-one. Handoff went from painful to near-automatic.</p>
              <p><strong>Document the decisions, not just the outcomes.</strong> Future designers and engineers don't need to know what the button radius is — they can see it. They need to know <em>why</em> it's 6px and not 4px or 8px. Every significant system decision was documented with the reasoning — the constraints, the alternatives considered, and why this choice was made. That context is what prevents the system from being second-guessed every 6 months.</p>
            </div>
          </section>

        </article>

      </div>

      <!-- NEXT CASE STUDIES -->
            <div class="art-next-wrap">
        <div class="art-next">
          <a href="indigo-booking.php" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">START FROM THE BEGINNING</p>
            <p class="art-next__category">AIRLINE COMMERCE</p>
            <h3 class="art-next__title">IndiGo Booking Ecosystem</h3>
            <p class="art-next__tagline">Redesigning a 50M-user booking flow.</p>
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
      render_related_content("case-study", "design-system");
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
    array('src' => 'https://images.unsplash.com/photo-1558655146-9f40138edfeb?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Component library — atomic design tokens'),
    array('src' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Typography system — scale and hierarchy'),
    array('src' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Colour system — accessible palette'),
    array('src' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Grid system — layout foundations'),
    array('src' => 'https://images.unsplash.com/photo-1559028012-481c04fa702d?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Documentation — contribution guidelines'),
  );

  $carouselImages = array(
    'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1559028012-481c04fa702d?w=120&h=120&fit=crop&auto=format',
  );
  require __DIR__ . "/../partials/gallery.php";
  ?>
  <script src="<?= BASE_PATH ?>/assets/js/gallery.js" defer></script>
</body>
</html>