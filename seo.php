<?php
/* =========================================
   SEO.PHP — Search Engine Optimisation Hub
   Site index + keyword targeting page.
   Linked from footer. Crawled by Google.
   ========================================= */

require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/includes/schema.php";
require_once __DIR__ . "/data/case-studies.php";
require_once __DIR__ . "/data/blog.php";

$currentKey = "";
$pageTitle  = "UX Design Agency Gurgaon — Site Map & SEO | Ramesh Mandal";
$pageDesc   = "Complete site index for Ramesh Mandal's UX Design Agency based in Gurgaon. Find case studies, UX audits, psychology articles, and design essays. Serving clients across Delhi NCR and India.";
?>
<!DOCTYPE html>
<html lang="en-IN">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>"/>
  <meta name="keywords" content="UX Design Agency Gurgaon, UX Designer Gurgaon, UX Consultant Delhi NCR, Product Design India, Ramesh Mandal, UX Portfolio, UX Case Studies India, Design Systems Agency, Enterprise UX India, AI UX Design, UX Audit India, UX Strategy Gurgaon"/>
  <meta name="robots" content="index, follow"/>
  <link rel="canonical" href="https://6epixels.com/seo"/>

  <!-- Open Graph -->
  <meta property="og:site_name"   content="Ramesh Mandal — UX Design Agency"/>
  <meta property="og:type"        content="website"/>
  <meta property="og:url"         content="https://6epixels.com/seo"/>
  <meta property="og:title"       content="UX Design Agency Gurgaon — Ramesh Mandal"/>
  <meta property="og:description" content="Site index and SEO hub for Ramesh Mandal's UX Design Agency, Gurgaon. Case studies, audits, psychology, and essays."/>
  <meta property="og:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:locale"      content="en_IN"/>

  <!-- Schema -->
  <?php
    echo schema_person();
    echo schema_local_business();
    echo schema_breadcrumb([
        ["Home", "https://6epixels.com/"],
        ["Site Map", "https://6epixels.com/seo"],
    ]);
    // FAQ schema — keyword-rich Q&A Google can display directly
    echo schema_faq([
        ["What is Ramesh Mandal's UX Design Agency?",
         "Ramesh Mandal is a UX Leader and Product Strategist running a UX Design Agency based in Gurgaon, India. With 17+ years of experience across aviation, SaaS, and enterprise platforms, the agency specialises in UX strategy, design systems, AI-enabled workflows, and conversion optimisation for large-scale digital products."],
        ["Where is the UX Design Agency located?",
         "The agency is based in Gurgaon (Gurugram), Haryana, India — in the Delhi NCR region. Work is delivered remotely and on-site across India and globally."],
        ["What services does the UX Design Agency offer?",
         "Services include UX Strategy, UX Audits, Design Systems, Product Design, AI-Enabled Workflows, Conversion Rate Optimisation (CRO), Enterprise UX, User Research, and UX Leadership consulting."],
        ["What industries does Ramesh Mandal specialise in?",
         "Aviation (IndiGo Airlines), SaaS, e-commerce and marketplace platforms (Quikr), enterprise operations software, fintech, and food delivery. Experience spans B2C products serving 50M+ users and B2B enterprise tools for 8,000+ users."],
        ["How can I hire a UX designer or UX agency in Gurgaon?",
         "Contact Ramesh Mandal directly via the contact page at 6epixels.com/contact for consulting, full-time opportunities, collaboration, or speaking engagements. The agency is currently available for senior UX leadership and consulting engagements."],
    ]);
  ?>

  <!-- Preconnect -->
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>

  <!-- CSS -->
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/variables.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/reset.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/main.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/global.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/navigation.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/footer.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/animations.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/seo.css"/>

  <link rel="icon" href="<?= BASE_PATH ?>/assets/icons/favicon.ico"/>
</head>
<body>

<?php $currentKey = ""; require __DIR__ . "/partials/navigation.php"; ?>

<div class="page-wrapper">
<main class="seo-page" id="main-content">

  <!-- ══════════════════════════════════
       HERO
       ══════════════════════════════════ -->
  <section class="seo-hero">
    <div class="seo-hero__inner">
      <p class="seo-hero__kicker">
        <span class="seo-hero__kicker-line"></span>
        UX_SITEMAP
      </p>
      <h1 class="seo-hero__title">
        UX Design Agency<br>
        <span>based in Gurgaon</span>
      </h1>
      <p class="seo-hero__desc">
        This page is a complete index of all work, writing, and resources published
        by Ramesh Mandal — UX Leader and Product Strategist operating out of Gurgaon,
        India. 17+ years. 50M+ users. Enterprise scale.
      </p>
      <div class="seo-hero__pills">
        <span class="seo-pill">Gurgaon · Haryana</span>
        <span class="seo-pill">Delhi NCR</span>
        <span class="seo-pill">Remote · India-wide</span>
        <span class="seo-pill">Global clients</span>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════
       SERVICES — keyword-rich copy
       ══════════════════════════════════ -->
  <section class="seo-section">
    <div class="seo-section__inner">
      <h2 class="seo-section__title">UX Design Services — Gurgaon & Remote</h2>
      <p class="seo-section__lead">
        Ramesh Mandal's UX Design Agency provides end-to-end UX and product design
        services for enterprise companies, funded startups, and digital-first businesses
        across India and globally. Based in Gurgaon (Delhi NCR).
      </p>
      <div class="seo-services">
        <?php
        $services = [
            ["UX Strategy & Vision",         "Defining the north star for digital products — from research synthesis to roadmap alignment. Delivered for IndiGo, Intelegencia, and Quikr at enterprise scale."],
            ["UX Audits & Heuristic Analysis","Public and private UX audits with friction mapping, psychology breakdowns, and concrete redesign recommendations. See Zomato and Swiggy audits."],
            ["Design Systems",               "Building scalable component libraries, design tokens, and contribution frameworks that accelerate delivery. 40% velocity improvement at IndiGo."],
            ["AI-Enabled UX Workflows",      "Integrating AI tools (Figma AI, Claude, Gemini) into design processes for faster research synthesis, prototype generation, and decision support."],
            ["Conversion Rate Optimisation", "Data-driven UX changes that move business metrics. The IndiGo booking flow redesign drove 22% revenue growth and 30% support reduction."],
            ["Enterprise Product Design",    "Designing complex operational systems for large user bases — CrewPal for 8,000+ cabin crew, Staff Travel Portal, loyalty programs with 500+ user tests."],
            ["User Research & Validation",   "From diary studies to contextual inquiry to usability testing. Every design decision grounded in evidence, not assumption."],
            ["UX Leadership & Consulting",   "Fractional UX leadership, team building, process design, and cross-functional alignment for organisations scaling their design capability."],
        ];
        foreach ($services as [$title, $desc]):
        ?>
        <article class="seo-service">
          <h3 class="seo-service__title"><?= htmlspecialchars($title) ?></h3>
          <p class="seo-service__desc"><?= htmlspecialchars($desc) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════
       CASE STUDIES
       ══════════════════════════════════ -->
  <section class="seo-section seo-section--alt">
    <div class="seo-section__inner">
      <h2 class="seo-section__title">UX Case Studies</h2>
      <p class="seo-section__lead">
        Deep dives into real enterprise design problems — with research, psychology
        insights, process documentation, and measurable business outcomes.
      </p>
      <ul class="seo-link-list">
        <?php foreach ($caseStudies as $cs): ?>
        <?php if (($cs['status'] ?? '') !== 'published') continue; ?>
        <li class="seo-link-item">
          <a href="<?= BASE_PATH ?>/case-study/<?= htmlspecialchars($cs['slug']) ?>" class="seo-link">
            <span class="seo-link__title"><?= htmlspecialchars($cs['title']) ?></span>
            <span class="seo-link__meta"><?= htmlspecialchars($cs['category'] ?? '') ?> · <?= htmlspecialchars($cs['company'] ?? '') ?> · <?= htmlspecialchars($cs['year'] ?? '') ?></span>
            <span class="seo-link__desc"><?= htmlspecialchars($cs['tagline'] ?? '') ?></span>
          </a>
        </li>
        <?php endforeach; ?>
        <li class="seo-link-item seo-link-item--cta">
          <a href="<?= BASE_PATH ?>/case-study/" class="seo-link seo-link--all">
            View all case studies →
          </a>
        </li>
      </ul>
    </div>
  </section>

  <!-- ══════════════════════════════════
       UX AUDITS
       ══════════════════════════════════ -->
  <section class="seo-section">
    <div class="seo-section__inner">
      <h2 class="seo-section__title">UX Audits — Public Teardowns</h2>
      <p class="seo-section__lead">
        Honest heuristic analysis of real products used by millions — Zomato, Swiggy,
        and more. Published publicly. No NDAs. No filters.
      </p>
      <ul class="seo-link-list">
        <?php
        $audits = [
            ["zomato-checkout",   "Zomato Checkout Flow UX Audit",          "FOOD DELIVERY · UX AUDIT",    "7 friction points identified. Psychology of checkout anxiety. Redesign suggestions for a platform processing millions of daily orders."],
            ["swiggy-onboarding", "Swiggy Onboarding & Home Screen UX Audit","FOOD DELIVERY · UX AUDIT",    "9 friction points. Information architecture breakdown. Behavioural design critique across the critical first-session flow."],
        ];
        foreach ($audits as [$slug, $title, $category, $desc]):
        ?>
        <li class="seo-link-item">
          <a href="<?= BASE_PATH ?>/audit/<?= $slug ?>" class="seo-link">
            <span class="seo-link__title"><?= htmlspecialchars($title) ?></span>
            <span class="seo-link__meta"><?= htmlspecialchars($category) ?></span>
            <span class="seo-link__desc"><?= htmlspecialchars($desc) ?></span>
          </a>
        </li>
        <?php endforeach; ?>
        <li class="seo-link-item seo-link-item--cta">
          <a href="<?= BASE_PATH ?>/audit/" class="seo-link seo-link--all">View all audits →</a>
        </li>
      </ul>
    </div>
  </section>

  <!-- ══════════════════════════════════
       FIELD NOTES — blog
       ══════════════════════════════════ -->
  <section class="seo-section seo-section--alt">
    <div class="seo-section__inner">
      <h2 class="seo-section__title">Field Notes — UX Design Essays</h2>
      <p class="seo-section__lead">
        Real observations from 17 years shipping enterprise products. War stories, quiet
        wins, unpopular opinions, and field research from aviation, SaaS, and marketplace UX.
      </p>
      <ul class="seo-link-list">
        <?php foreach ($posts as $post):
          if (($post['slug'] ?? '') === 'this-is-just-a-test-blog') continue;
        ?>
        <li class="seo-link-item">
          <a href="<?= BASE_PATH ?>/blog/<?= htmlspecialchars($post['slug']) ?>" class="seo-link">
            <span class="seo-link__title"><?= htmlspecialchars($post['title'] ?? '') ?></span>
            <span class="seo-link__meta"><?= htmlspecialchars($post['tag'] ?? '') ?> · <?= htmlspecialchars($post['read_time'] ?? '') ?> · <?= htmlspecialchars($post['date'] ?? '') ?></span>
            <span class="seo-link__desc"><?= htmlspecialchars($post['subtitle'] ?? $post['excerpt'] ?? '') ?></span>
          </a>
        </li>
        <?php endforeach; ?>
        <li class="seo-link-item seo-link-item--cta">
          <a href="<?= BASE_PATH ?>/blog/" class="seo-link seo-link--all">Browse all field notes →</a>
        </li>
      </ul>
    </div>
  </section>

  <!-- ══════════════════════════════════
       CORE PAGES
       ══════════════════════════════════ -->
  <section class="seo-section">
    <div class="seo-section__inner">
      <h2 class="seo-section__title">Core Pages</h2>
      <ul class="seo-link-list seo-link-list--grid">
        <?php
        $core = [
            ["/",            "Homepage",        "Overview of UX work, stats, case studies, and the design philosophy behind 17+ years of enterprise product design in India."],
            ["/about",       "About",           "Background, career history, design principles, and leadership philosophy. From Times of India to IndiGo to Intelegencia."],
            ["/contact",     "Contact & Hire",  "Open to senior UX leadership, consulting, collaboration, and speaking. Based in Gurgaon, available remotely across India."],
            ["/resources",   "UX Resources",    "Free UX templates, annotated reading list, proprietary frameworks, and honest tool reviews curated from 17 years of practice."],
            ["/psychology/", "UX Psychology",   "24 psychological principles explained — attention, motivation, memory, social proof, and cognitive bias in product design."],
        ];
        foreach ($core as [$url, $title, $desc]):
        ?>
        <li class="seo-link-item">
          <a href="<?= BASE_PATH . $url ?>" class="seo-link">
            <span class="seo-link__title"><?= htmlspecialchars($title) ?></span>
            <span class="seo-link__desc"><?= htmlspecialchars($desc) ?></span>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- ══════════════════════════════════
       KEYWORDS — rich text for Google
       ══════════════════════════════════ -->
  <section class="seo-section seo-section--alt seo-section--keywords">
    <div class="seo-section__inner">
      <h2 class="seo-section__title">Expertise Keywords</h2>
      <p class="seo-section__lead">
        Search terms this practice covers — for hiring managers, founders, and
        organisations looking for senior UX leadership in India.
      </p>
      <div class="seo-kw-groups">
        <?php
        $kwGroups = [
            "Location & Agency" => [
                "UX Design Agency Gurgaon",
                "UX Designer Gurgaon",
                "UX Agency Gurugram",
                "UX Consultant Delhi NCR",
                "Product Designer Gurgaon",
                "Design Agency India",
                "UX Design Company India",
                "Senior UX Designer India",
                "UX Leader India",
            ],
            "Services" => [
                "UX Strategy",
                "UX Audit",
                "Heuristic Analysis",
                "Design Systems",
                "Component Library",
                "Conversion Rate Optimisation",
                "CRO UX",
                "AI-Enabled UX",
                "Enterprise UX Design",
                "Product Design Consulting",
                "UX Leadership",
                "Fractional CPO",
                "Design Sprint Facilitation",
            ],
            "Industry" => [
                "Aviation UX",
                "Airline App Design",
                "Booking Flow Optimisation",
                "Loyalty Program UX",
                "Food Delivery UX",
                "E-commerce UX",
                "Marketplace UX",
                "Enterprise App Design",
                "SaaS UX Design",
                "Fintech UX",
                "Operations App Design",
            ],
            "Specialisations" => [
                "Design Systems Architect",
                "UX Portfolio India",
                "Information Architecture",
                "Interaction Design",
                "Mobile UX Design",
                "User Research India",
                "Usability Testing",
                "Figma Design System",
                "AI UX Workflows",
                "UX Psychology",
                "Behavioural Design",
            ],
        ];
        foreach ($kwGroups as $group => $keywords):
        ?>
        <div class="seo-kw-group">
          <h3 class="seo-kw-group__title"><?= htmlspecialchars($group) ?></h3>
          <ul class="seo-kw-list">
            <?php foreach ($keywords as $kw): ?>
            <li class="seo-kw-item"><?= htmlspecialchars($kw) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════
       ABOUT SNAPSHOT — rich entity text
       ══════════════════════════════════ -->
  <section class="seo-section">
    <div class="seo-section__inner seo-about">
      <h2 class="seo-section__title">About the Agency</h2>
      <div class="seo-about__body">
        <p>
          <strong>Ramesh Mandal</strong> is a Senior UX Leader and Product Strategist
          running an independent UX Design practice based in <strong>Gurgaon, Haryana</strong>
          (Delhi NCR), India. With over <strong>17 years of experience</strong> across
          aviation, SaaS, e-commerce, and enterprise software, Ramesh has designed
          products used by more than <strong>50 million users</strong>.
        </p>
        <p>
          Previously <strong>Sr. Manager UI/UX at IndiGo Airlines</strong> (InterGlobe
          Aviation Ltd.), where he led end-to-end UX for 10+ customer-facing and internal
          applications — including the booking flow, CrewPal cabin crew app, IndiGo
          Holidays marketplace, and enterprise design system. Currently leading UX
          strategy at <strong>Intelegencia</strong>, delivering digital programs across
          the US, UK, and Middle East markets.
        </p>
        <p>
          The practice operates from <strong>Gurgaon</strong> and serves clients remotely
          across India and internationally. Services span UX strategy, product design,
          design systems, AI-enabled workflows, UX audits, and senior design leadership.
          Winner of the <strong>IndiGo Innovation Award 2023</strong> for Super 6E Sale
          conversion growth.
        </p>
        <div class="seo-about__facts">
          <?php
          $facts = [
              ["17+",    "Years of Experience"],
              ["50M+",   "Users Served"],
              ["10+",    "Enterprise Platforms"],
              ["15+",    "Designers Led"],
              ["500+",   "User Tests Conducted"],
              ["2023",   "IndiGo Innovation Award"],
          ];
          foreach ($facts as [$val, $label]):
          ?>
          <div class="seo-fact">
            <span class="seo-fact__val"><?= $val ?></span>
            <span class="seo-fact__label"><?= htmlspecialchars($label) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════
       CTA
       ══════════════════════════════════ -->
  <section class="seo-cta">
    <div class="seo-cta__inner">
      <h2 class="seo-cta__title">Looking for a UX Design Agency in Gurgaon?</h2>
      <p class="seo-cta__desc">
        Available for senior UX leadership, consulting, and collaboration.
        Based in Gurgaon — remote and hybrid across India and globally.
      </p>
      <div class="seo-cta__actions">
        <a href="<?= BASE_PATH ?>/contact" class="btn btn--primary btn--lg">Get in touch</a>
        <a href="<?= BASE_PATH ?>/case-study/" class="btn btn--ghost btn--lg">View case studies</a>
      </div>
    </div>
  </section>

</main>

<?php require __DIR__ . "/partials/footer.php"; ?>
</div><!-- /.page-wrapper -->

<script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
<script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>
<script src="<?= BASE_PATH ?>/assets/js/animations.js" defer></script>
<script src="<?= BASE_PATH ?>/assets/js/app.js" defer></script>
<script src="<?= BASE_PATH ?>/assets/js/transitions.js" defer></script>

</body>
</html>