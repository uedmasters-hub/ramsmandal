<?php
/* views/about.php */
$page = ['title' => 'About — Ramesh Mandal', 'desc' => 'Experience Architect, 17 years.', 'body_class' => 'page-about', 'styles' => ['about'], 'scripts' => ['core/reveal']];
?>
<section class="about">
  <header class="about__head">
    <h1>About</h1>
    <?php foreach (($profile['summary'] ?? []) as $para): ?><p><?= e($para) ?></p><?php endforeach; ?>
  </header>
  <div class="about__exp">
    <h2>Experience</h2>
    <ol>
      <?php foreach (($profile['experience'] ?? []) as $job): ?>
      <li>
        <div class="about__exp-top"><strong><?= e($job['company']) ?></strong><span><?= e($job['period']) ?></span></div>
        <div class="about__exp-role"><?= e($job['role']) ?>, <?= e($job['place']) ?></div>
        <p><?= e($job['note']) ?></p>
      </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
