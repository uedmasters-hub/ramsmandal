<?php
/* views/home.php — dot-field hero (preloader + device evolution) + editorial sections */
$site = content('site');
$page = [
  'title'      => $site['meta']['default_title'],
  'desc'       => $site['meta']['default_desc'],
  'body_class' => 'page-home',
  'styles'     => ['home', 'home-experience', 'home-marquee', 'work-journey'],
  'scripts'    => ['core/reveal', 'work-journey'],
  'modules'    => ['preloader', 'home-experience', 'core/text-ink', 'logo-marquee'],
  'importmap'  => json_encode([
    'imports' => [
      'lenis'              => 'https://unpkg.com/lenis@1.1.20/dist/lenis.mjs',
      'gsap'               => 'https://unpkg.com/gsap@3.12.5/index.js',
      'gsap/ScrollTrigger' => 'https://unpkg.com/gsap@3.12.5/ScrollTrigger.js',
    ],
  ], JSON_UNESCAPED_SLASHES),
];
$all      = $projects ?? [];
$featured = array_values(array_filter($all, fn($p) => !empty($p['featured'])));
$prev     = array_slice($featured, 0, 3);
?>

<!-- DOT-FIELD HERO (device evolution lives in the global dot canvas) -->
<section id="home-experience" class="he">
  <div class="he-pin">
    <div class="he-stage-layer">

      <!-- 0 phone -->
      <div class="he-stage">
        <p class="he-eyebrow">Experience Architect</p>
        <h1 class="he-headline">I transform complexity into <span class="kw-accent">clarity</span>.</h1>
      </div>

      <!-- 1 tablet -->
      <div class="he-stage">
        <h2 class="he-headline">From a single screen to a <span class="kw-accent">working system</span>.</h2>
        <p class="he-sub">Seventeen years across aviation, SaaS, and enterprise platforms, shaping products used by millions.</p>
      </div>

      <!-- 2 laptop -->
      <div class="he-stage">
        <h2 class="he-headline">A designer makes <span class="kw-accent">screens</span>.</h2>
        <div class="he-previews">
          <?php foreach ($prev as $p): ?>
          <div class="he-prev"><b><?= e($p['title']) ?></b><span><?= e($p['company']) ?></span></div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- 3 spread / ecosystem -->
      <div class="he-stage">
        <h2 class="he-headline">An experience architect makes <span class="kw-accent">ecosystems</span>.</h2>
        <div class="he-regions">
          <div class="he-region"><b>Work</b><span>Products at scale</span></div>
          <div class="he-region"><b>Systems</b><span>Design infrastructure</span></div>
          <div class="he-region"><b>Thinking</b><span>Decisions, tradeoffs</span></div>
          <div class="he-region"><b>Leadership</b><span>Teams of 15+</span></div>
          <div class="he-region"><b>Impact</b><span>Measured outcomes</span></div>
          <div class="he-region"><b>Strategy</b><span>Complexity to clarity</span></div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- PRELOADER narrative (beneath the RM the dots form) -->
<div id="preloader" class="preloader" aria-hidden="true">
  <p class="preloader__narrative">Complexity <span class="arrow">&rarr;</span> Clarity</p>
</div>

<!-- BIG CARDS — draggable discipline rail -->
<section class="big-cards" aria-label="What I do">
  <div class="big-cards__track" data-drag>
    <article class="big-card big-card--accent">
      <span class="big-card__eyebrow">01 / Practice</span>
      <div class="big-card__body">
        <h3 class="big-card__title">Product &amp; platform design</h3>
        <p class="big-card__desc">Customer-facing and enterprise products shaped from the first flow to the shipped system.</p>
      </div>
      <span class="big-card__num" aria-hidden="true">01</span>
    </article>
    <article class="big-card">
      <span class="big-card__eyebrow">02 / Practice</span>
      <div class="big-card__body">
        <h3 class="big-card__title">Enterprise UX</h3>
        <p class="big-card__desc">Complex internal tools and operations platforms made usable for the people who run the business.</p>
      </div>
      <span class="big-card__num" aria-hidden="true">02</span>
    </article>
    <article class="big-card">
      <span class="big-card__eyebrow">03 / Practice</span>
      <div class="big-card__body">
        <h3 class="big-card__title">Design systems</h3>
        <p class="big-card__desc">Reusable component systems and standards that keep teams fast and consistent at scale.</p>
      </div>
      <span class="big-card__num" aria-hidden="true">03</span>
    </article>
    <article class="big-card">
      <span class="big-card__eyebrow">04 / Practice</span>
      <div class="big-card__body">
        <h3 class="big-card__title">Product strategy</h3>
        <p class="big-card__desc">Roadmaps grounded in user needs, business goals, and what engineering can realistically ship.</p>
      </div>
      <span class="big-card__num" aria-hidden="true">04</span>
    </article>
    <article class="big-card">
      <span class="big-card__eyebrow">05 / Practice</span>
      <div class="big-card__body">
        <h3 class="big-card__title">Design engineering</h3>
        <p class="big-card__desc">Designs that survive contact with code, prototyped and built, not just drawn.</p>
      </div>
      <span class="big-card__num" aria-hidden="true">05</span>
    </article>
    <article class="big-card">
      <span class="big-card__eyebrow">06 / Practice</span>
      <div class="big-card__body">
        <h3 class="big-card__title">Design leadership</h3>
        <p class="big-card__desc">Teams of fifteen-plus designers and researchers aligned around outcomes that matter.</p>
      </div>
      <span class="big-card__num" aria-hidden="true">06</span>
    </article>
  </div>
</section>

<div class="site-container">
<!-- POSITIONING -->
<section class="intro">
  <p class="intro__lead" data-reveal>
    I don't design screens. I design the experiences, systems, and outcomes behind products that operate at scale, and the judgment that holds them together under real constraint.
  </p>
  <ul class="intro__disciplines" data-reveal>
    <li>Product design</li><li>Enterprise UX</li><li>Design systems</li>
    <li>Product strategy</li><li>Design engineering</li><li>Leadership</li>
  </ul>
</section>

<!-- LOGO MARQUEE -->

<section class="logo-marquee">

    <div class="logo-marquee__fade"></div>

    <div class="logo-marquee__track">

        <!-- Row duplicated for seamless loop -->

        <div class="logo-marquee__group">

            <img src="/public/img/logos/indigo.svg" alt="IndiGo">
            <img src="/public/img/logos/quikr.svg" alt="Quikr">
            <img src="/public/img/logos/intelegencia.svg" alt="Intelegencia">
            <img src="/public/img/logos/client4.svg" alt="">
            <img src="/public/img/logos/client5.svg" alt="">
            <img src="/public/img/logos/client6.svg" alt="">

        </div>

        <div class="logo-marquee__group">

            <img src="/public/img/logos/indigo.svg" alt="IndiGo">
            <img src="/public/img/logos/quikr.svg" alt="Quikr">
            <img src="/public/img/logos/intelegencia.svg" alt="Intelegencia">
            <img src="/public/img/logos/client4.svg" alt="">
            <img src="/public/img/logos/client5.svg" alt="">
            <img src="/public/img/logos/client6.svg" alt="">

        </div>

                <div class="logo-marquee__group">

            <img src="/public/img/logos/indigo.svg" alt="IndiGo">
            <img src="/public/img/logos/quikr.svg" alt="Quikr">
            <img src="/public/img/logos/intelegencia.svg" alt="Intelegencia">
            <img src="/public/img/logos/client4.svg" alt="">
            <img src="/public/img/logos/client5.svg" alt="">
            <img src="/public/img/logos/client6.svg" alt="">

        </div>

    </div>

</section>

<!-- WORK JOURNEY -->

<section class="work-v2" id="work">

    <div class="work-header">

        <div class="work-header-left">
            <span class="work-label">● Selected Work</span>

            <h2 class="work-title">
                Products, platforms and systems
                designed for scale.
            </h2>
        </div>

        <div class="work-header-right">
            <p>
                Seventeen years designing products,
                platforms and ecosystems across aviation,
                enterprise and marketplace businesses.
            </p>
        </div>

    </div>

    <div class="work-list">

        <a href="/project/indigo-booking" class="work-item">

            <div class="work-year">
                2022–2024
            </div>

            <div class="work-project">
                IndiGo Booking Ecosystem
            </div>

            <div class="work-meta">
                Airline commerce platform
            </div>

            <div class="work-impact">
                +22% ancillary revenue
            </div>

        </a>

        <a href="/project/crewpal" class="work-item">

            <div class="work-year">
                2020–2023
            </div>

            <div class="work-project">
                CrewPal Operations Platform
            </div>

            <div class="work-meta">
                Enterprise operations platform
            </div>

            <div class="work-impact">
                +28% crew efficiency
            </div>

        </a>

        <a href="/project/holidays" class="work-item">

            <div class="work-year">
                2023
            </div>

            <div class="work-project">
                IndiGo Holidays Marketplace
            </div>

            <div class="work-meta">
                Travel marketplace
            </div>

            <div class="work-impact">
                +22% revenue growth
            </div>

        </a>

        <a href="/project/design-system" class="work-item">

            <div class="work-year">
                2021–2024
            </div>

            <div class="work-project">
                Enterprise Design System
            </div>

            <div class="work-meta">
                Design infrastructure
            </div>

            <div class="work-impact">
                +40% faster delivery
            </div>

        </a>

        <a href="/project/quikr" class="work-item">

            <div class="work-year">
                2015–2018
            </div>

            <div class="work-project">
                Quikr Marketplace Redesign
            </div>

            <div class="work-meta">
                Marketplace platform
            </div>

            <div class="work-impact">
                30M+ monthly users
            </div>

        </a>

    </div>

</section>



<!-- SCALE -->
<section class="scale" data-reveal>
  <p class="scale__line">
      Seventeen years. Aviation, SaaS, and enterprise.
      Products used by millions.
  </p>

  <ul class="scale__orgs">
      <li>IndiGo</li>
      <li>Intelegencia</li>
      <li>Quikr</li>
  </ul>
</section>