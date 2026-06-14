<?php
/* views/home.php — dot-field hero (preloader + device evolution) + editorial sections */
$site = content('site');
$page = [
  'title'      => $site['meta']['default_title'],
  'desc'       => $site['meta']['default_desc'],
  'body_class' => 'page-home',
  'styles'     => ['home', 'home-experience', 'home-case-slider'],
  'scripts'    => ['core/reveal'],
  'modules'    => ['preloader', 'home-experience', 'home-case-slider'],
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
        <h2 class="he-headline">From a single screen to a working system.</h2>
        <p class="he-sub">Seventeen years across aviation, SaaS, and enterprise platforms, shaping products used by millions.</p>
      </div>

      <!-- 2 laptop -->
      <div class="he-stage">
        <h2 class="he-headline">A designer makes screens.</h2>
        <div class="he-previews">
          <?php foreach ($prev as $p): ?>
          <div class="he-prev"><b><?= e($p['title']) ?></b><span><?= e($p['company']) ?></span></div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- 3 spread / ecosystem -->
      <div class="he-stage">
        <h2 class="he-headline">An experience architect makes ecosystems.</h2>
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

<section class="case-slider" id="featured-work">

    <div class="case-slider__track">

        <?php foreach ($featured as $p): ?>

        <article class="case-card">

            <div class="case-card__media">

                <?php if(!empty($p['cover'])): ?>
                    <img
                        src="<?= asset($p['cover']) ?>"
                        alt="<?= e($p['title']) ?>"
                        loading="lazy"
                    >
                <?php endif; ?>

            </div>

            <div class="case-card__content">

                <span class="case-card__company">
                    <?= e($p['company']) ?>
                </span>

                <h3>
                    <?= e($p['title']) ?>
                </h3>

                <p>
                    <?= !empty($p['excerpt'])
                        ? e($p['excerpt'])
                        : 'View detailed case study.'
                    ?>
                </p>

                <a href="<?= url('/work/' . $p['slug']) ?>">
                    View Case Study →
                </a>

            </div>

        </article>

        <?php endforeach; ?>

    </div>

</section>

<!-- WORK INDEX -->
<section class="work" id="work">
  <header class="work__head" data-reveal>
    <h2>Selected work</h2>
    <a class="work__all" href="<?= url('/work') ?>">All work
      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
    </a>
  </header>
  <ul class="work-list">
    <?php foreach ($featured as $p): ?>
    <li class="work-list__row" data-reveal>
      <a class="work-list__link" href="<?= url('/work/' . $p['slug']) ?>">
        <span class="work-list__year"><?= e($p['year']) ?></span>
        <span class="work-list__title"><?= e($p['title']) ?></span>
        <span class="work-list__meta"><?= e($p['company']) ?> &middot; <?= e($p['category']) ?></span>
        <span class="work-list__metric"><?php if (!empty($p['metric'])): ?><b><?= e($p['metric']['value']) ?></b> <?= e($p['metric']['label']) ?><?php endif; ?></span>
        <span class="work-list__arrow" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 17 7M9 7h8v8"/></svg>
        </span>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</section>

<!-- SCALE -->
<section class="scale" data-reveal>
  <p class="scale__line">Seventeen years. Aviation, SaaS, and enterprise. Products used by millions.</p>
  <ul class="scale__orgs"><li>IndiGo</li><li>Intelegencia</li><li>Quikr</li></ul>
</section>

<!-- CONTACT CTA -->
<section class="cta" data-reveal>
  <h2 class="cta__title">Have a complex problem worth solving?</h2>
  <div class="cta__actions">
    <a class="cta__link" href="<?= url('/contact') ?>">Start a conversation
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
    </a>
    <a class="cta__mail" href="mailto:<?= e($site['contact']['email']) ?>"><?= e($site['contact']['email']) ?></a>
  </div>
</section>
