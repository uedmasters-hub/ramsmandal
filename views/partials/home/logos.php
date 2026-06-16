<?php
/* views/partials/home/logos.php — client logo marquee.
   One logo list, looped 3x for a seamless track (was hardcoded thrice). */
$home  = $home ?? content('home');
$logos = $home['logos'];
?>
<!-- LOGO MARQUEE -->
<section class="logo-marquee">
  <div class="logo-marquee__fade"></div>
  <div class="logo-marquee__track">
    <?php for ($g = 0; $g < 3; $g++): ?>
    <div class="logo-marquee__group"<?= $g > 0 ? ' aria-hidden="true"' : '' ?>>
      <?php foreach ($logos as $logo): ?>
      <img src="<?= e($logo['src']) ?>" alt="<?= e($logo['alt']) ?>"<?= $logo['alt'] === '' ? ' aria-hidden="true"' : '' ?>>
      <?php endforeach; ?>
    </div>
    <?php endfor; ?>
  </div>
</section>
