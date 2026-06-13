<?php
/* views/home.php — editorial, multi-section home */
$site = content('site');
$page = [
  'title'      => $site['meta']['default_title'],
  'desc'       => $site['meta']['default_desc'],
  'body_class' => 'page-home',
  'styles'     => ['home'],
  'scripts'    => ['core/reveal'],
];
$all      = $projects ?? [];
$featured = array_values(array_filter($all, fn($p) => !empty($p['featured'])));
?>

<!-- HERO -->
<section class="hero">
  <p class="hero__role">Experience Architect</p>

  <h1 class="hero__statement">I transform<br>complexity into<br><span class="kw--accent">clarity</span>.</h1>

  <div class="hero__foot">
    <p class="hero__sub">Seventeen years across aviation, SaaS, and enterprise platforms. I shape the systems, products, and decisions behind experiences used by millions.</p>
    <div class="hero__aside">
      <p class="hero__now">Currently Sr. Manager UI/UX at <span>Intelegencia</span></p>
      <a class="hero__cue" href="#work">
        <span>Selected work</span>
        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M6 13l6 6 6-6"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- POSITIONING -->
<section class="intro">
  <p class="intro__lead" data-reveal>
    I don't design screens. I design the experiences, systems, and outcomes behind products that operate at scale, and the judgment that holds them together under real constraint.
  </p>
  <ul class="intro__disciplines" data-reveal>
    <li>Product design</li>
    <li>Enterprise UX</li>
    <li>Design systems</li>
    <li>Product strategy</li>
    <li>Design engineering</li>
    <li>Leadership</li>
  </ul>
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
        <span class="work-list__metric">
          <?php if (!empty($p['metric'])): ?><b><?= e($p['metric']['value']) ?></b> <?= e($p['metric']['label']) ?><?php endif; ?>
        </span>
        <span class="work-list__arrow" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 17 7M9 7h8v8"/></svg>
        </span>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</section>

<!-- SCALE / CREDIBILITY -->
<section class="scale" data-reveal>
  <p class="scale__line">Seventeen years. Aviation, SaaS, and enterprise. Products used by millions.</p>
  <ul class="scale__orgs">
    <li>IndiGo</li>
    <li>Intelegencia</li>
    <li>Quikr</li>
  </ul>
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
