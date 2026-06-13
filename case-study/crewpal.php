<?php
require_once __DIR__ . "/../includes/config.php";
$currentKey = "work";
$pageTitle  = "CrewPal Operations Platform — Case Study";
$pageDesc   = "How I redesigned the operational app for 8,000+ IndiGo cabin crew, reducing scheduling errors by 18% and boosting crew satisfaction by 25%.";
$meta = [
  ["label" => "Role",     "value" => "Sr. Manager UI/UX"],
  ["label" => "Company",  "value" => "IndiGo Airlines"],
  ["label" => "Duration", "value" => "9 months"],
  ["label" => "Year",     "value" => "2022 – 2023"],
];
$nav = [
  ["id" => "overview",  "label" => "Overview"],
  ["id" => "problem",   "label" => "Problem"],
  ["id" => "research",  "label" => "Research"],
  ["id" => "process",   "label" => "Process"],
  ["id" => "solution",  "label" => "Solution"],
  ["id" => "outcomes",  "label" => "Outcomes"],
  ["id" => "learnings", "label" => "Learnings"],
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
  <meta property="og:url"          content="https://6epixels.com/case-study/crewpal"/>
  <meta property="og:title"        content="CrewPal Operations Platform — Case Study"/>
  <meta property="og:description"  content="Enterprise UX for 8,000+ cabin crew. 25% satisfaction lift, 18% fewer scheduling errors."/>
  <meta property="og:image"        content="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=1200&auto=format&fit=crop"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="CrewPal Operations Platform — Case Study"/>
  <meta name="twitter:description" content="Enterprise UX for 8,000+ cabin crew. 25% satisfaction lift, 18% fewer scheduling errors."/>
  <meta name="twitter:image"       content="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=1200&auto=format&fit=crop"/>
  <link rel="canonical"            href="https://6epixels.com/case-study/crewpal"/>
  
  <!-- FAVICON -->
  <link rel="icon" type="image/x-icon"     href="/assets/icons/favicon.ico"/>
  <link rel="icon" type="image/svg+xml"    href="/assets/icons/favicon.svg"/>
  <link rel="icon" type="image/png" sizes="32x32"  href="/assets/icons/favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16"  href="/assets/icons/favicon-16x16.png"/>
  <link rel="apple-touch-icon" sizes="180x180"     href="/assets/icons/favicon-180x180.png"/>
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
        if ($cs["slug"] === "crewpal") { $studyForSchema = $cs; break; }
    }
    if ($studyForSchema) {
        echo schema_case_study($studyForSchema, "https://6epixels.com/case-study/crewpal");
    }
  ?>
</head>
<body data-header="dark">
  <div class="art-progress" id="art-progress" role="progressbar" aria-label="Reading progress"></div>
  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">CrewPal</span>
        <span class="preloader__name-role">Case Study · Enterprise App</span>
      </div>
      <div class="preloader__bar-wrap"><div class="preloader__bar" id="preloader-bar"></div></div>
      <span class="preloader__counter" id="preloader-counter">0%</span>
    </div>
  </div>
  <div class="bg-canvas" aria-hidden="true"><div class="bg-grid"></div><div class="bg-orb-1"></div><div class="bg-orb-2"></div></div>
  
  <?php
    $currentKey = "work"; // this is header section
    require_once __DIR__ . "/../partials/navigation.php";
  ?>

  <div class="page-wrapper">
    <main id="main-content">
      <div class="cs-detail-hero fade-in">
        <img class="cs-detail-hero__img" src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=2400&auto=format&fit=crop" alt="Aircraft representing crew operations" loading="eager"/>
        <div class="cs-detail-hero__overlay"></div>
        <div class="cs-detail-hero__content">
          <p class="cs-detail-hero__category">CREW OPERATIONS SYSTEM</p>
          <h1 class="cs-detail-hero__title">CrewPal Operations<br>Platform</h1>
          <p class="cs-detail-hero__tagline">Simplifying high-stakes operations for 8,000+ IndiGo cabin crew.</p>
        </div>
      </div>
      <div class="cs-meta-bar">
        <?php foreach ($meta as $m): ?>
          <div class="cs-meta-item">
            <span class="cs-meta-item__label"><?= htmlspecialchars($m['label']) ?></span>
            <span class="cs-meta-item__value"><?= htmlspecialchars($m['value']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="cs-content">
        <nav class="cs-nav" aria-label="Case study sections">
          <?php foreach ($nav as $n): ?>
            <a href="#<?= $n['id'] ?>" class="cs-nav__item" data-nav="<?= $n['id'] ?>"><?= htmlspecialchars($n['label']) ?></a>
          <?php endforeach; ?>
        </nav>
        <article class="cs-article">

          <section class="cs-section" id="overview">
            <span class="cs-section__label">01 — Overview</span>
            <h2 class="cs-section__title">8,000 crew members. One broken app.</h2>
            <div class="cs-section__body">
              <p>CrewPal is IndiGo's operational app used by all 8,000+ cabin crew members for shift management, duty tracking, and fatigue monitoring. When I inherited the project, it had 14 screens, constant complaints about usability, and a scheduling error rate that was costing the airline real money.</p>
              <p>Operational UX is high-stakes design. A crew member checking duty assignments at 4am in an airport lounge needs information instantly, with zero ambiguity. Failure means flights delayed, compliance breached.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card"><div class="cs-metric-card__value">25%</div><div class="cs-metric-card__label">Crew satisfaction increase</div></div>
              <div class="cs-metric-card"><div class="cs-metric-card__value">18%</div><div class="cs-metric-card__label">Scheduling errors reduced</div></div>
              <div class="cs-metric-card"><div class="cs-metric-card__value">14→4</div><div class="cs-metric-card__label">Screens restructured to core views</div></div>
              <div class="cs-metric-card"><div class="cs-metric-card__value">8K+</div><div class="cs-metric-card__label">Crew members using the redesign</div></div>
            </div>
          </section>

          <section class="cs-section" id="problem">
            <span class="cs-section__label">02 — Problem</span>
            <h2 class="cs-section__title">The app that crew dreaded opening</h2>
            <div class="cs-section__body">
              <p>Shadow research revealed the real problem: crew members were screenshotting their schedules and sharing them on WhatsApp because the app was too slow and confusing to use at 4am. A mission-critical operational tool had been abandoned for a workaround.</p>
              <p><strong>Root causes:</strong> 14 separate screens for information that should be on one. No proactive alerts for fatigue threshold breaches. No offline capability for airport dead zones. Compliance requirements buried under layers of navigation.</p>
            </div>
          </section>

          <section class="cs-section" id="research">
            <span class="cs-section__label">03 — Research</span>
            <h2 class="cs-section__title">Shadow research at 4am in terminal lounges</h2>
            <div class="cs-section__body">
              <p>I spent 3 nights conducting shadow research — observing crew members using the app in their actual work environment. The results were more damning than any survey would have revealed.</p>
              <p>Key insight: <strong>the most critical information (next duty, fatigue status, schedule changes) was on screen 7 of 14.</strong> Crew were navigating 6 screens every time they needed the one thing they checked 8x per day.</p>
            </div>
            <blockquote class="cs-callout">"I know my roster by heart because the app takes too long. I only use it for sign-off." — Cabin crew member, 6 years at IndiGo</blockquote>
          </section>

          <section class="cs-section" id="process">
            <span class="cs-section__label">04 — Process</span>
            <h2 class="cs-section__title">Restructure, then redesign</h2>
            <div class="cs-section__body">
              <p>The first decision was architectural, not visual. I restructured the 14 screens into 4 core views based on frequency of use: Today's Duty, My Schedule, Notifications, and Profile/Compliance. Everything else became secondary navigation.</p>
              <p>Prototyped with 40 crew members across 3 months. Each round of testing happened in context — airport lounges, hotel rooms, on mobile with fatigue-level lighting conditions. By round 3, task completion time for the primary action (checking next duty) dropped from 47 seconds to 8 seconds.</p>
            </div>
          </section>

          <section class="cs-section" id="solution">
            <span class="cs-section__label">05 — Solution</span>
            <h2 class="cs-section__title">One screen. Everything you need.</h2>
            <div class="cs-section__body">
              <p><strong>Today view as the home screen.</strong> Next duty, departure time, aircraft number, and fatigue status — all above the fold. No navigation required for the daily check-in.</p>
              <p><strong>Proactive fatigue alerts.</strong> Rather than requiring crew to check their fatigue status, the app surfaces alerts when thresholds are approaching. Compliance became passive rather than active.</p>
              <p><strong>Offline-first architecture.</strong> Worked with engineering to cache duty data for 72 hours. The app works fully offline — critical for airport dead zones.</p>
            </div>
          </section>

          <section class="cs-section" id="outcomes">
            <span class="cs-section__label">06 — Outcomes</span>
            <h2 class="cs-section__title">The WhatsApp workaround disappeared</h2>
            <div class="cs-section__body">
              <p>Three months post-launch, the informal WhatsApp schedule-sharing groups had reduced by 80%. Crew were using the app because it was faster than the workaround. That's the real measure of success.</p>
            </div>
            <div class="cs-metrics-row">
              <div class="cs-metric-card"><div class="cs-metric-card__value">47s→8s</div><div class="cs-metric-card__label">Task completion time for primary action</div></div>
              <div class="cs-metric-card"><div class="cs-metric-card__value">80%</div><div class="cs-metric-card__label">Reduction in WhatsApp workaround usage</div></div>
              <div class="cs-metric-card"><div class="cs-metric-card__value">25%</div><div class="cs-metric-card__label">Crew satisfaction in post-launch survey</div></div>
              <div class="cs-metric-card"><div class="cs-metric-card__value">18%</div><div class="cs-metric-card__label">Scheduling errors in first quarter</div></div>
            </div>
          </section>

          <section class="cs-section" id="learnings">
            <span class="cs-section__label">07 — Learnings</span>
            <h2 class="cs-section__title">What I'd do differently</h2>
            <div class="cs-section__body">
              <p><strong>Shadow research is non-negotiable for operational tools.</strong> No survey or interview would have revealed the 4am lounge behaviour. Physical context changes everything.</p>
              <p><strong>Architecture before aesthetics.</strong> The biggest impact came from restructuring information hierarchy — not from visual polish. Always solve the structure first.</p>
            </div>
          </section>

        </article>
      </div>
      <div class="art-next-wrap">
        <div class="art-next">
          <a href="indigo-booking.php" class="art-next__card">
            <span class="art-next__arrow">↗</span>
            <p class="art-next__label">PREVIOUS CASE STUDY</p>
            <p class="art-next__category">AIRLINE COMMERCE</p>
            <h3 class="art-next__title">IndiGo Booking Ecosystem</h3>
            <p class="art-next__tagline">22% revenue growth. 50M users.</p>
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
      render_related_content("case-study", "crewpal");
    ?>

    <?php require_once __DIR__ . "/../partials/footer.php"; ?>
  </div>
  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/animations.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js" defer></script>
  <script>
  (function(){const bar=document.getElementById("art-progress"),main=document.getElementById("main-content");if(!bar||!main)return;window.addEventListener("scroll",function(){bar.style.width=Math.min(100,(window.scrollY/(main.scrollHeight-window.innerHeight))*100)+"%";},{passive:true});})();
  (function(){const items=document.querySelectorAll(".cs-nav__item[data-nav]"),secs=document.querySelectorAll(".cs-section[id]");if(!items.length)return;const obs=new IntersectionObserver(function(e){e.forEach(function(s){if(s.isIntersecting){items.forEach(function(n){n.classList.remove("is-active");});const a=document.querySelector('.cs-nav__item[data-nav="'+s.target.id+'"]');if(a)a.classList.add("is-active");}});},{rootMargin:"-20% 0px -70% 0px"});secs.forEach(function(s){obs.observe(s);});})();
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
    array('src' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Dashboard — shift overview and status'),
    array('src' => 'https://images.unsplash.com/photo-1562564055-71e051d33c19?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Schedule view — weekly roster grid'),
    array('src' => 'https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Fatigue alert system — warning states'),
    array('src' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Swap request flow — peer-to-peer handoff'),
    array('src' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1600&auto=format&fit=crop', 'caption' => 'Notifications — real-time crew comms'),
  );

  $carouselImages = array(
    'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?w=120&h=120&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=120&h=120&fit=crop&auto=format',
  );
  require __DIR__ . "/../partials/gallery.php";
  ?>
  <script src="<?= BASE_PATH ?>/assets/js/gallery.js" defer></script>
</body>
</html>