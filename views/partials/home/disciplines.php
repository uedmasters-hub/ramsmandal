<?php
/* views/partials/home/disciplines.php — two-stage discipline gallery.
   STATE 01: .bc-stage spotlight (one full-image card at a time, scroll-driven).
   STATE 02: .big-cards__track rail (draggable), the existing gallery.
   Both are generated from the SAME $cards source, so order + mapping are
   identical. Cards carry no destination link today; none is invented here.
   Behaviour + cursor live in big-cards-gallery.js; styles in big-cards.css. */
$home  = $home ?? content('home');
$cards = $home['disciplines'];
$count = count($cards);
?>
<!-- BIG CARDS — two-stage discipline gallery -->
<section class="big-cards" data-bc aria-label="What I do" style="--bc-count: <?= $count ?>">

  <!-- STATE 01 — sticky single-card spotlight -->
  <div class="bc-stage-wrap">
    <div class="bc-stage" data-no-cursor>
      <?php foreach ($cards as $i => $c):
        $n   = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
        $img = $c['image'] ?? ''; ?>
      <figure class="bc-slide" data-index="<?= $i ?>">
        <div class="bc-slide__media">
          <?php if (!empty($img)): ?>
            <img class="bc-slide__img" src="<?= asset('img/disciplines/' . $img) ?>"
                 alt="<?= e($c['image_alt'] ?? '') ?>" loading="lazy" decoding="async" draggable="false">
          <?php else: ?>
            <span class="bc-slide__ghost" aria-hidden="true"><?= $n ?></span>
          <?php endif; ?>
        </div>
        <figcaption class="bc-slide__cap">
          <span class="bc-slide__num"><?= $n ?> / Practice</span>
          <h3 class="bc-slide__title"><?= e($c['title']) ?></h3>
        </figcaption>
      </figure>
      <?php endforeach; ?>

      <div class="bc-progress" aria-hidden="true">
        <?php for ($i = 0; $i < $count; $i++): ?>
        <span class="bc-progress__tick<?= $i === 0 ? ' is-active' : '' ?>"></span>
        <?php endfor; ?>
      </div>
    </div>
  </div>

  <!-- STATE 02 — draggable rail (existing gallery; same order + mapping) -->
  <div class="big-cards__track" data-drag>
    <?php foreach ($cards as $i => $c):
      $n   = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
      $cls = 'big-card' . ($i === 0 ? ' big-card--accent' : ''); ?>
    <article class="<?= $cls ?>">
      <span class="big-card__eyebrow"><?= $n ?> / Practice</span>
      <div class="big-card__media">
        <?php if (!empty($c['image'])): ?>
          <img class="big-card__img" src="<?= asset('img/disciplines/' . $c['image']) ?>"
               alt="<?= e($c['image_alt'] ?? '') ?>" loading="lazy" decoding="async" draggable="false">
        <?php endif; ?>
      </div>
      <div class="big-card__body">
        <h3 class="big-card__title"><?= e($c['title']) ?></h3>
        <p class="big-card__desc"><?= e($c['desc']) ?></p>
      </div>
      <span class="big-card__num" aria-hidden="true"><?= $n ?></span>
    </article>
    <?php endforeach; ?>
  </div>

</section>