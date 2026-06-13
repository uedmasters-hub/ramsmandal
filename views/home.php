<?php
/* views/home.php */
$site = content('site');
$page = [
  'title'      => $site['meta']['default_title'],
  'desc'       => $site['meta']['default_desc'],
  'body_class' => 'page-home',
  'styles'     => ['home', 'work-rail'],
  'scripts'    => ['core/reveal'],
];
$rail = array_slice($projects ?? [], 0, 5);
?>
<section class="home-stage">
  <div class="home-hero">
    <h1 class="home-hero__title">
      <span class="line"><span>I transform</span></span>
      <span class="line"><span>complexity into</span></span>
      <span class="line"><span class="accent-word">clarity<svg class="underline" viewBox="0 0 300 24" preserveAspectRatio="none" aria-hidden="true"><path d="M4 16 C 70 6, 150 6, 230 12 S 290 18, 296 14"/></svg></span>.</span></span>
    </h1>
    <p class="home-hero__sub">
      Experience Architect with 17 years across aviation, SaaS, and enterprise platforms.
      I shape the systems, products, and decisions behind experiences used by millions, at IndiGo, Intelegencia, and Quikr.
    </p>
  </div>

  <section class="home-work" aria-label="Selected work">
    <div class="home-work__head">
      <span class="label">Selected work</span>
      <a class="all" href="<?= url('/work') ?>">View all
        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
    <div class="home-rail">
      <?php foreach ($rail as $p): ?>
      <a class="work-tile" href="<?= url('/work/' . $p['slug']) ?>">
        <div class="work-tile__thumb tone-<?= (int)($p['tone'] ?? 0) ?>">
          <span class="tag"><?= e($p['company']) ?></span>
          <?php if (!empty($p['metric'])): ?>
          <p class="metric"><?= e($p['metric']['value']) ?><small><?= e($p['metric']['label']) ?></small></p>
          <?php endif; ?>
        </div>
        <div class="work-tile__meta">
          <div class="title"><?= e($p['title']) ?></div>
          <div class="org"><?= e($p['category']) ?></div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>
</section>
