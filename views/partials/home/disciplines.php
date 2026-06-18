<?php
/* views/partials/home/disciplines.php — draggable big-cards discipline rail.
   data-drag + class names preserved for home-experience.js drag logic.
   Each card carries an optional 'image' (and 'image_alt'); when absent the
   media slot stays a quiet framed panel so the layout never breaks. */
$home  = $home ?? content('home');
$cards = $home['disciplines'];
?>
<!-- BIG CARDS — draggable discipline rail -->
<section class="big-cards" aria-label="What I do">
  <div class="big-cards__track" data-drag>
    <?php foreach ($cards as $i => $c):
      $n   = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
      $cls = 'big-card' . ($i === 0 ? ' big-card--accent' : '');
      $img = $c['image'] ?? ''; ?>
    <article class="<?= $cls ?>">
      <span class="big-card__eyebrow"><?= $n ?> / Practice</span>
      <div class="big-card__media">
        <?php if (!empty($c['image'])): ?>
          <img class="big-card__img" src="<?= asset('img/disciplines/' . $c['image']) ?>"
              alt="<?= e($c['image_alt'] ?? '') ?>" loading="lazy" decoding="async" draggable="false">
        <?php endif; ?>
      </div>
      <!-- <div class="big-card__media">
        <?php if ($img !== ''): ?>
        <img class="big-card__img" src="<?= e($img) ?>"
             alt="<?= e($c['image_alt'] ?? $c['title']) ?>"
             loading="lazy" decoding="async" draggable="false">
        <?php endif; ?>
      </div> -->
      <div class="big-card__body">
        <h3 class="big-card__title"><?= e($c['title']) ?></h3>
        <p class="big-card__desc"><?= e($c['desc']) ?></p>
      </div>
      <span class="big-card__num" aria-hidden="true"><?= $n ?></span>
    </article>
    <?php endforeach; ?>
  </div>
</section>