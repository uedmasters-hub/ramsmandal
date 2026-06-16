<?php
/* views/partials/philosophy.php — now data-driven from content/home.php. */
$home = $home ?? content('home');
$ph   = $home['philosophy'];
?>
<section class="philosophy-banner">
  <div class="container">
    <div class="philosophy-content">
      <span class="philosophy-label"><?= e($ph['label']) ?></span>
      <h2 class="philosophy-heading"><?= e($ph['heading']) ?></h2>
      <p class="philosophy-copy"><?= e($ph['copy']) ?></p>
    </div>
  </div>
</section>
