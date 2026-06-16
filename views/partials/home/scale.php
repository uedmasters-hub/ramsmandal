<?php
/* views/partials/home/scale.php — closing scale statement. */
$home  = $home ?? content('home');
$scale = $home['scale'];
?>
<!-- SCALE -->
<section class="scale" data-reveal>
  <p class="scale__line"><?= e($scale['line']) ?></p>
  <ul class="scale__orgs">
    <?php foreach ($scale['orgs'] as $org): ?><li><?= e($org) ?></li><?php endforeach; ?>
  </ul>
</section>
