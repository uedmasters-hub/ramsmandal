<?php
/* views/partials/perspectives.php — now data-driven from content/home.php. */
$home = $home ?? content('home');
$p    = $home['perspectives'];
?>
<section class="perspectives">
  <div class="perspectives-header">
    <div>
      <span class="perspectives-label"><?= e($p['label']) ?></span>
      <h2 class="perspectives-title"><?= e($p['title']) ?></h2>
    </div>
    <p class="perspectives-copy"><?= e($p['copy']) ?></p>
  </div>

  <div class="perspectives-grid">
    <?php foreach ($p['cards'] as $c): ?>
    <article class="perspective-card">
      <p class="perspective-quote">&ldquo;<?= e($c['quote']) ?>&rdquo;</p>
      <div class="perspective-meta">
        <strong><?= e($c['role']) ?></strong>
        <span><?= e($c['org']) ?></span>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</section>
