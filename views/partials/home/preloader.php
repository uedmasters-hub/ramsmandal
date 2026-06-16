<?php
/* views/partials/home/preloader.php — narrative beneath the RM dot form. */
$home = $home ?? content('home');
$pre  = $home['preloader'];
?>
<!-- PRELOADER narrative (beneath the RM the dots form) -->
<div id="preloader" class="preloader" aria-hidden="true">
  <p class="preloader__narrative"><?= e($pre['from']) ?> <span class="arrow">&rarr;</span> <?= e($pre['to']) ?></p>
</div>
