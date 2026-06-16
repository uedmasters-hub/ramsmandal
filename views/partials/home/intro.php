<?php
/* views/partials/home/intro.php — positioning lead + discipline list. */
$home  = $home ?? content('home');
$intro = $home['intro'];
?>
<!-- POSITIONING -->
<section class="intro">
  <p class="intro__lead" data-reveal><?= e($intro['lead']) ?></p>
  <ul class="intro__disciplines" data-reveal>
    <?php foreach ($intro['disciplines'] as $d): ?><li><?= e($d) ?></li><?php endforeach; ?>
  </ul>
</section>
