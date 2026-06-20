<?php
/* views/about.php — About, presented in the home section language. */
$page = ['title' => 'About — Ramesh Mandal',
         'desc'  => 'Experience Architect with 17 years turning complex systems into clarity across aviation, SaaS, and enterprise products.',
         'body_class' => 'page-about', 'styles' => ['about'], 'scripts' => ['core/reveal']];
$profile = $profile ?? content('profile');
?>
<div class="about">

  <!-- intro -->
  <section class="about-intro" data-reveal>
    <span class="about-eyebrow">● About</span>
    <h1 class="about-lead"><?= e($profile['lead'] ?? 'About') ?></h1>
    <?php if (!empty($profile['role'])): ?>
    <p class="about-meta"><?= e($profile['role']) ?> &middot; <?= e($profile['tenure'] ?? '') ?> &middot; <?= e($profile['location'] ?? '') ?></p>
    <?php endif; ?>
    <div class="about-intro__body">
      <?php foreach (($profile['intro'] ?? []) as $para): ?><p><?= e($para) ?></p><?php endforeach; ?>
    </div>
  </section>

  <!-- numbers -->
  <?php if (!empty($profile['numbers'])): ?>
  <section class="about-numbers" data-reveal>
    <?php foreach ($profile['numbers'] as $n): ?>
    <div class="about-stat">
      <span class="about-stat__value"><?= e($n['value']) ?></span>
      <span class="about-stat__label"><?= e($n['label']) ?></span>
    </div>
    <?php endforeach; ?>
  </section>
  <?php endif; ?>

  <!-- experience -->
  <section class="about-section" data-reveal>
    <div class="about-section__head">
      <span class="about-eyebrow">● Experience</span>
      <h2 class="about-section__title">The path here.</h2>
    </div>
    <ol class="about-timeline">
      <?php foreach (($profile['experience'] ?? []) as $job): ?>
      <li class="about-role">
        <span class="about-role__period"><?= e($job['period']) ?></span>
        <div class="about-role__body">
          <h3 class="about-role__company"><?= e($job['company']) ?></h3>
          <p class="about-role__title"><?= e($job['role']) ?> &middot; <?= e($job['place']) ?></p>
          <p class="about-role__note"><?= e($job['note']) ?></p>
        </div>
      </li>
      <?php endforeach; ?>
    </ol>
  </section>

  <!-- recognition -->
  <?php if (!empty($profile['credentials'])): ?>
  <section class="about-section" data-reveal>
    <div class="about-section__head">
      <span class="about-eyebrow">● Recognition</span>
      <h2 class="about-section__title">Education and awards.</h2>
    </div>
    <ul class="about-creds">
      <?php foreach ($profile['credentials'] as $cred): ?>
      <li class="about-cred"><?= e($cred) ?></li>
      <?php endforeach; ?>
    </ul>
  </section>
  <?php endif; ?>

</div>
