<?php
/* =========================================
   SECTIONS / COMPONENTS-GRID.PHP
   Bento grid showcasing design components
   ========================================= */

require_once __DIR__ . "/../data/components.php";
?>

<section class="bento-section" aria-label="Design Ecosystem" id="components">

  <!-- HEADER -->
  <div class="bento-header">
    <div class="bento-header__left">
      <p class="bento-kicker">DIGITAL ECOSYSTEMS</p>
      <h2 class="bento-title">
        Designing Across<br>
        <span>Ecosystems</span>
      </h2>
    </div>
  </div>

  <!-- BENTO GRID -->
  <div class="bento-grid" role="list">

    <?php foreach ($components as $c): ?>
      <button
        class="bento-card bento-card--<?= $c['size'] ?> bento-card--bg-<?= $c['bg'] ?> tl-reveal"
        role="listitem"
        data-metric="<?= $c['id'] ?>"
        aria-haspopup="dialog"
        aria-label="<?= htmlspecialchars($c['title']) ?>"
        style="--delay: <?= (array_search($c, $components) * 60) ?>ms"
      >

        <!-- TOP ROW -->
        <div class="bento-card__top">
          <span class="bento-card__category"><?= htmlspecialchars($c['category']) ?></span>
          <span class="bento-card__arrow" aria-hidden="true">↗</span>
        </div>

        <!-- ICON -->
        <div class="bento-card__icon" aria-hidden="true"><?= $c['icon'] ?></div>

        <!-- CONTENT -->
        <div class="bento-card__content">
          <h3 class="bento-card__title"><?= htmlspecialchars($c['title']) ?></h3>
          <p class="bento-card__sub"><?= htmlspecialchars($c['sub']) ?></p>
        </div>

        <!-- STAT -->
        <div class="bento-card__stat">
          <span class="bento-card__stat-value"><?= htmlspecialchars($c['stat']['value']) ?></span>
          <span class="bento-card__stat-label"><?= htmlspecialchars($c['stat']['label']) ?></span>
        </div>

      </button>
    <?php endforeach; ?>

  </div>

</section>