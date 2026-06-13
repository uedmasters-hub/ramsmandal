<?php
/* =========================================
   ABOUT.PHP
   ========================================= */

require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/data/about.php";
// Extra data now in about.php data file
require_once __DIR__ . "/data/experience.php";

$currentKey = "about";
$pageTitle  = "About Ramesh Mandal — UX Design Agency Lead, Gurgaon";
$pageDesc   = "Ramesh Mandal leads a UX design practice in Gurgaon with 17+ years across aviation, SaaS, and enterprise platforms. Design systems, product strategy, and AI-enabled workflows at scale.";
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>" />

  <title><?= htmlspecialchars($pageTitle) ?></title>
  <!-- OG / TWITTER META -->
  <meta property="og:site_name"    content="Ramesh Mandal"/>
  <meta property="og:type"         content="website"/>
  <meta property="og:url"          content="https://6epixels.com/about"/>
  <meta property="og:title"        content="Ramesh Mandal — About"/>
  <meta property="og:description"  content="Sr. Manager UI/UX, 17+ years. Led IndiGo booking, CrewPal, and design systems serving millions."/>
  <meta property="og:image"        content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="Ramesh Mandal — About"/>
  <meta name="twitter:description" content="Sr. Manager UI/UX, 17+ years. Led IndiGo booking, CrewPal, and design systems serving millions."/>
  <meta name="twitter:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <link rel="canonical"            href="https://6epixels.com/about"/>

  <!-- JSON-LD STRUCTURED DATA -->
  <?php
    require_once __DIR__ . "/includes/schema.php";
    echo schema_person();
    echo schema_breadcrumb([
      ['Home',  'https://6epixels.com/'],
      ['About', 'https://6epixels.com/about.php'],
    ]);
  ?>

  <!-- FAVICON -->
  <link rel="icon" type="image/x-icon"     href="/assets/icons/favicon.ico"/>
  <link rel="icon" type="image/svg+xml"    href="/assets/icons/favicon.svg"/>
  <link rel="icon" type="image/png" sizes="32x32"  href="/assets/icons/favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16"  href="/assets/icons/favicon-16x16.png"/>
  <link rel="apple-touch-icon" sizes="180x180"     href="/assets/icons/favicon-180x180.png"/>
  <meta name="theme-color" content="#0f0f0f"/>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/preloader.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/variables.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/animations.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/reset.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/main.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/global.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/navigation.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/background.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/experience.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/footer.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/about.css" />

</head>
<body>

  <!-- PRELOADER -->
  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">Ramesh Mandal</span>
        <span class="preloader__name-role">UX Leader · Product Strategist</span>
      </div>
      <div class="preloader__bar-wrap">
        <div class="preloader__bar" id="preloader-bar"></div>
      </div>
      <span class="preloader__counter" id="preloader-counter">0%</span>
    </div>
  </div>

  <!-- BACKGROUND -->
  <div class="bg-canvas" aria-hidden="true">
    <div class="bg-grid"></div>
    <div class="bg-orb-1"></div>
    <div class="bg-orb-2"></div>
    <div class="bg-mouse-glow"></div>
  </div>

  <?php require __DIR__ . "/partials/navigation.php"; ?>
  <div class="page-wrapper">


    <main id="main-content">

      <!-- ══════════════════════════════════
           HERO
           ══════════════════════════════════ -->
      <section class="about-hero" aria-label="About Ramesh Mandal">

        <!-- LEFT -->
        <div class="about-hero__left fade-in">

          <div>
            <p class="about-kicker">ABOUT ME</p>
            <h1 class="about-hero__name">
              Ramesh<br><span>Mandal.</span>
            </h1>
          </div>

          <p class="about-hero__tagline"><?= htmlspecialchars($about['title']) ?></p>

          <div class="about-hero__identity">
            <div class="about-avatar" aria-hidden="true">RM</div>
            <div class="about-hero__meta">
              <p class="about-hero__meta-name">Ramesh Mandal</p>
              <p class="about-hero__meta-role">Sr. Manager UI/UX · Intelegencia</p>
            </div>
            <a
              href="/assets/resume/Ramesh_Kumar_Mandal.pdf"
              class="about-hero__resume"
              download="Ramesh_Kumar_Mandal.pdf"
              aria-label="Download resume PDF"
            >⬇ Resume</a>
          </div>

        </div>

        <!-- RIGHT -->
        <div class="about-hero__right fade-in">

          <?php foreach ($about['summary'] as $para): ?>
            <p class="about-summary__para"><?= htmlspecialchars($para) ?></p>
          <?php endforeach; ?>

          <div class="about-hero__contact">
            <div class="about-contact-item">
              <span class="about-contact-item__icon">✉</span>
              <a href="mailto:<?= htmlspecialchars($about['email']) ?>"><?= htmlspecialchars($about['email']) ?></a>
            </div>
            <div class="about-contact-item">
              <span class="about-contact-item__icon">📱</span>
              <a href="tel:+919538000060"><?= htmlspecialchars($about['phone']) ?></a>
            </div>
            <div class="about-contact-item">
              <span class="about-contact-item__icon">📍</span>
              <span><?= htmlspecialchars($about['location']) ?></span>
            </div>
            <div class="about-contact-item">
              <span class="about-contact-item__icon">in</span>
              <a href="<?= htmlspecialchars($about['linkedin']) ?>" target="_blank" rel="noopener">LinkedIn Profile ↗</a>
            </div>
            <div class="about-availability">
              <span class="about-availability__dot" aria-hidden="true"></span>
              <span class="about-availability__text">Available for new opportunities</span>
            </div>
          </div>

        </div>

      </section>

      <!-- ══════════════════════════════════
           STATS
           ══════════════════════════════════ -->
      <div class="about-stats" aria-label="Career statistics">
        <?php foreach ($about['stats'] as $stat): ?>
          <div class="about-stat fade-in">
            <span class="about-stat__value"><?= htmlspecialchars($stat['value']) ?></span>
            <span class="about-stat__label"><?= htmlspecialchars($stat['label']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- ══════════════════════════════════
           SIGNATURE MOMENTS
           ══════════════════════════════════ -->
      <section class="about-moments" aria-label="Signature work">

        <div class="about-section-header">
          <p class="about-section-kicker">SIGNATURE WORK</p>
          <h2 class="about-section-title">Three moments that<br><span>defined the career.</span></h2>
        </div>

        <div class="about-moments__grid">
          <?php foreach ($signatureMoments as $m): ?>
            <a
              href="<?= htmlspecialchars($m['href']) ?>"
              class="about-moment about-moment--<?= $m['color'] ?> tl-reveal"
              aria-label="<?= htmlspecialchars($m['title']) ?>"
            >
              <div class="about-moment__body">
                <div>
                  <span class="about-moment__year"><?= htmlspecialchars($m['year']) ?></span>
                  <span class="about-moment__company"> · <?= htmlspecialchars($m['company']) ?></span>
                </div>
                <h3 class="about-moment__title"><?= htmlspecialchars($m['title']) ?></h3>
                <p class="about-moment__desc"><?= htmlspecialchars($m['desc']) ?></p>
              </div>
              <div class="about-moment__footer">
                <div class="about-moment__metrics">
                  <?php foreach ($m['metrics'] as $metric): ?>
                    <span class="about-moment__metric"><?= htmlspecialchars($metric) ?></span>
                  <?php endforeach; ?>
                </div>
                <?php if ($m['award']): ?>
                  <p class="about-moment__award">★ <?= htmlspecialchars($m['award']) ?></p>
                <?php endif; ?>
                <p class="about-moment__cta">Read case study →</p>
              </div>
            </a>
          <?php endforeach; ?>
        </div>

      </section>

      <!-- ══════════════════════════════════
           DESIGN PRINCIPLES
           ══════════════════════════════════ -->
      <section class="about-principles" aria-label="Design principles">

        <div class="about-section-header">
          <p class="about-section-kicker">HOW I THINK</p>
          <h2 class="about-section-title">
            Design<br><span>Principles</span>
          </h2>
        </div>

        <div class="principles-grid" role="list">
          <?php foreach ($about['principles'] as $p): ?>
            <article class="principle-card tl-reveal" role="listitem">
              <span class="principle-card__number"><?= htmlspecialchars($p['number']) ?></span>
              <h3 class="principle-card__title"><?= htmlspecialchars($p['title']) ?></h3>
              <p class="principle-card__desc"><?= htmlspecialchars($p['desc']) ?></p>
            </article>
          <?php endforeach; ?>
        </div>

      </section>

      <!-- ══════════════════════════════════
           COMPETENCIES
           ══════════════════════════════════ -->
      <section class="about-competencies" aria-label="Core competencies">

        <div class="about-section-header">
          <p class="about-section-kicker">EXPERTISE</p>
          <h2 class="about-section-title">
            Core<br><span>Competencies</span>
          </h2>

          <div class="about-tools" style="margin-top:40px">
            <p class="tools-heading">Tools & Platforms</p>
            <div class="tools-list">
              <?php foreach ($about['tools'] as $tool): ?>
                <span class="tool-badge"><?= htmlspecialchars($tool) ?></span>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="competencies-grid">
          <?php foreach ($about['competencies'] as $comp): ?>
            <div class="competency-row tl-reveal">
              <span class="competency-row__area"><?= htmlspecialchars($comp['area']) ?></span>
              <div class="competency-row__skills">
                <?php foreach ($comp['skills'] as $skill): ?>
                  <span class="competency-skill"><?= htmlspecialchars($skill) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </section>

      <!-- ══════════════════════════════════
           LEADERSHIP PHILOSOPHY
           ══════════════════════════════════ -->
      <section class="about-leadership" aria-label="Leadership philosophy">

        <div class="about-section-header" style="margin-bottom:0">
          <p class="about-section-kicker">HOW I LEAD</p>
          <h2 class="about-section-title">Six things I <span>believe deeply</span></h2>
          <p style="font-size:14px;color:var(--text-muted);line-height:1.6;margin-top:16px">
            These aren't values-page platitudes. They're the actual filters
            I run every design and leadership decision through.
          </p>
        </div>

        <div class="about-beliefs">
          <?php foreach ($leadershipBeliefs as $i => $b): ?>
            <div
              class="about-belief<?= $i === 0 ? ' is-open' : '' ?>"
              onclick="toggleBelief(this)"
              tabindex="0"
              role="button"
              aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"
            >
              <div class="about-belief__header">
                <span class="about-belief__text"><?= htmlspecialchars($b['belief']) ?></span>
                <span class="about-belief__chevron" aria-hidden="true">›</span>
              </div>
              <div class="about-belief__expand" aria-hidden="<?= $i === 0 ? 'false' : 'true' ?>">
                <p class="about-belief__expand-text"><?= htmlspecialchars($b['expand']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </section>

      <!-- ══════════════════════════════════
           EXPERIENCE TIMELINE
           ══════════════════════════════════ -->
      <?php require_once __DIR__ . "/sections/experience.php"; ?>

      <!-- ══════════════════════════════════
           WHAT LEADERS SAY
           ══════════════════════════════════ -->
      <section class="about-testimonials" aria-label="Testimonials">

        <div class="about-section-header">
          <p class="about-section-kicker">WHAT LEADERS SAY</p>
          <h2 class="about-section-title">Trusted by the <span>people I've shipped with</span></h2>
        </div>

        <div class="about-testimonials__grid">
          <?php foreach ($aboutTestimonials as $t): ?>
            <article class="about-testi-card hover-lift tl-reveal">
              <div class="about-testi-card__mark" aria-hidden="true">"</div>
              <blockquote class="about-testi-card__quote"><?= htmlspecialchars($t['quote']) ?></blockquote>
              <footer class="about-testi-card__footer">
                <div class="about-testi-card__avatar" aria-hidden="true"><?= htmlspecialchars($t['avatar']) ?></div>
                <div>
                  <strong class="about-testi-card__name"><?= htmlspecialchars($t['name']) ?></strong>
                  <span class="about-testi-card__role"><?= htmlspecialchars($t['role']) ?> · <?= htmlspecialchars($t['company']) ?></span>
                </div>
              </footer>
            </article>
          <?php endforeach; ?>
        </div>

      </section>

      <!-- ══════════════════════════════════
           EDUCATION + AWARDS
           ══════════════════════════════════ -->
      <section class="about-credentials" aria-label="Education and awards">

        <!-- EDUCATION -->
        <div class="credentials-section">
          <div class="about-section-header">
            <p class="about-section-kicker">EDUCATION</p>
            <h2 class="about-section-title">
              Academic<br><span>Background</span>
            </h2>
          </div>
          <div class="credentials-list">
            <?php foreach ($about['education'] as $edu): ?>
              <div class="credential-item tl-reveal">
                <span class="credential-item__year"><?= htmlspecialchars($edu['year']) ?></span>
                <div>
                  <p class="credential-item__title"><?= htmlspecialchars($edu['degree']) ?></p>
                  <p class="credential-item__sub"><?= htmlspecialchars($edu['school']) ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- AWARDS -->
        <div class="credentials-section">
          <div class="about-section-header">
            <p class="about-section-kicker">RECOGNITION</p>
            <h2 class="about-section-title">
              Awards &<br><span>Achievements</span>
            </h2>
          </div>
          <div class="credentials-list">
            <?php foreach ($about['awards'] as $award): ?>
              <div class="credential-item tl-reveal">
                <span class="credential-item__year"><?= htmlspecialchars($award['year']) ?></span>
                <div>
                  <p class="credential-item__title"><?= htmlspecialchars($award['title']) ?></p>
                  <p class="credential-item__sub"><?= htmlspecialchars($award['desc']) ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

      </section>

      <!-- ══════════════════════════════════
           FAQ
           ══════════════════════════════════ -->
      <section class="about-faq" aria-label="Frequently asked questions">

        <div class="about-faq__intro">
          <p class="about-section-kicker">HARD QUESTIONS</p>
          <h2 class="about-section-title">
            The ones hiring<br>
            <span>teams actually ask.</span>
          </h2>
          <p class="about-faq__desc">
            These are the questions that usually get asked after you leave the room.
            I'd rather answer them here.
          </p>
          <div class="about-faq__note">
            Honest answers only. No corporate hedging.
          </div>
        </div>

        <div class="about-faq__list">
          <?php foreach ($faq as $i => $item): ?>
            <div
              class="about-faq__item"
              onclick="toggleFaq(this)"
              tabindex="0"
              role="button"
              aria-expanded="false"
            >
              <div class="about-faq__q">
                <span class="about-faq__q-text"><?= htmlspecialchars($item['q']) ?></span>
                <span class="about-faq__icon" aria-hidden="true">+</span>
              </div>
              <div class="about-faq__a" aria-hidden="true">
                <p class="about-faq__a-text"><?= htmlspecialchars($item['a']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </section>

      <!-- ══════════════════════════════════
           CTA BAND
           ══════════════════════════════════ -->
      <section class="about-cta" aria-label="Get in touch">
        <div class="about-cta__text">
          <h2 class="about-cta__heading">
            Ready to build<br>something exceptional?
          </h2>
          <p class="about-cta__sub">
            Open to senior UX leadership, product strategy,<br>and enterprise design roles globally.
          </p>
        </div>
        <div class="about-cta__actions">
          <a href="/contact.php" class="about-cta__btn about-cta__btn--primary">
            Get in touch ↗
          </a>
          <a href="<?= htmlspecialchars($about['linkedin']) ?>" target="_blank" rel="noopener" class="about-cta__btn about-cta__btn--ghost">
            View LinkedIn
          </a>
        </div>
      </section>

    </main>


    <!-- MARQUEE -->
    <?php
    $marqueeItems = [
      "✦ OPEN TO WORK",
      "UX LEADERSHIP ROLES",
      "✦ PRODUCT STRATEGY",
      "DESIGN SYSTEMS",
      "✦ ENTERPRISE UX",
      "AI-ENABLED DESIGN",
      "✦ AVAILABLE GLOBALLY",
      "REMOTE & HYBRID",
    ];
    $all = array_merge($marqueeItems, $marqueeItems);
    ?>
    <div class="about-marquee" aria-label="Open to new opportunities" role="marquee">
      <div class="about-marquee__track">
        <?php foreach ($all as $item): ?>
          <span class="about-marquee__item"><?= htmlspecialchars($item) ?></span>
        <?php endforeach; ?>
      </div>
    </div>

    <?php require __DIR__ . "/partials/footer.php"; ?>

  </div>

  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js"  defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/animations.js"  defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js"         defer></script>


  <script>
  function toggleFaq(el) {
    const isOpen = el.classList.contains("is-open");
    document.querySelectorAll(".about-faq__item.is-open").forEach(function(f){
      f.classList.remove("is-open");
      f.setAttribute("aria-expanded","false");
      f.querySelector(".about-faq__a").setAttribute("aria-hidden","true");
    });
    if (!isOpen) {
      el.classList.add("is-open");
      el.setAttribute("aria-expanded","true");
      el.querySelector(".about-faq__a").setAttribute("aria-hidden","false");
    }
  }
  document.querySelectorAll(".about-faq__item").forEach(function(f){
    f.addEventListener("keydown",function(e){
      if(e.key==="Enter"||e.key===" "){ e.preventDefault(); toggleFaq(this); }
    });
  });

  function toggleBelief(el) {
    const isOpen = el.classList.contains("is-open");
    document.querySelectorAll(".about-belief.is-open").forEach(function(b){
      b.classList.remove("is-open");
      b.setAttribute("aria-expanded","false");
      b.querySelector(".about-belief__expand").setAttribute("aria-hidden","true");
    });
    if (!isOpen) {
      el.classList.add("is-open");
      el.setAttribute("aria-expanded","true");
      el.querySelector(".about-belief__expand").setAttribute("aria-hidden","false");
    }
  }
  document.querySelectorAll(".about-belief").forEach(function(b){
    b.addEventListener("keydown",function(e){
      if(e.key==="Enter"||e.key===" "){ e.preventDefault(); toggleBelief(this); }
    });
  });
  </script>
  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>
</body>
</html>