<?php
/* views/project.php — single journey template */
$page = ['title' => $project['title'] . ' — Ramesh Mandal', 'desc' => $project['tagline'], 'body_class' => 'page-project', 'styles' => ['project'], 'scripts' => ['core/reveal', 'project']];
?>
<article class="project">
  <?php
    $heroCover  = $project['image'] ?? ('work/' . $project['slug'] . '.webp');
    $hasHeroImg = is_file(BASE_DIR . '/public/img/' . $heroCover);
  ?>
  <header class="project__hero tone-<?= (int)($project['tone'] ?? 0) ?><?= $hasHeroImg ? ' has-media' : '' ?>">
    <div class="project__hero-inner<?= $hasHeroImg ? ' has-media' : '' ?>">
      <div class="project__hero-text">
        <span class="project__eyebrow"><?= e($project['company']) ?> · <?= e($project['year']) ?></span>
        <h1 class="project__title"><?= e($project['title']) ?></h1>
        <p class="project__tagline"><?= e($project['tagline']) ?></p>
      </div>
      <?php if ($hasHeroImg): ?>
      <figure class="project__hero-media">
        <img src="<?= asset('img/' . $heroCover) ?>" alt="<?= e($project['title']) ?>" decoding="async" fetchpriority="high">
      </figure>
      <?php endif; ?>
    </div>
  </header>
  <div class="project__body">
    <div class="project__reading">
      <?php if ($body): require $body; else: ?>
        <p class="project__placeholder">The full journey for this project is being written. Registry data is live; the long-form body drops into <code>content/projects/<?= e($project['slug']) ?>.php</code>.</p>
      <?php endif; ?>
    </div>
  </div>
  <nav class="project__back"><a href="<?= url('/work') ?>">Back to all work</a></nav>
</article>
