<?php
/* =========================================
   SECTIONS / TRANSFORMATIONS.PHP
   ========================================= */

require_once __DIR__ . "/../data/transformations.php";

$featured = $transformations["featured"];
$cards    = $transformations["cards"];
$metrics  = $transformations["metrics"];
?>

<section class="transform-section" aria-label="Operational Transformations">

  <!-- HEADER -->
  <div class="transform-header">

    <p class="transform-kicker">EXECUTIVE_CHRONOLOGY</p>

    <h2 class="transform-title">
      Operational<br>
      <span>Transformations</span>
    </h2>

  </div>

  <!-- GRID -->
  <div class="transform-grid">

    <!-- FEATURED -->
    <a href="<?= htmlspecialchars($featured['href']) ?>" class="transform-featured fade-in" aria-label="<?= htmlspecialchars($featured['title']) ?>">

      <img
        class="transform-featured__img"
        src="<?= htmlspecialchars($featured["image"]) ?>"
        alt="<?= htmlspecialchars($featured["title"]) ?>"
        loading="lazy"
      />

      <div class="transform-featured__overlay" aria-hidden="true"></div>

      <div class="transform-featured__top" aria-hidden="true">
        <span>EXPLORE SYSTEM</span>
        <span>↗</span>
      </div>

      <div class="transform-featured__play" aria-hidden="true">▶</div>

      <div class="transform-featured__content">

        <p class="transform-featured__label">
          <?= htmlspecialchars($featured["label"]) ?>
        </p>

        <h3 class="transform-featured__title">
          <?= htmlspecialchars($featured["title"]) ?>
        </h3>

        <p class="transform-featured__desc">
          <?= htmlspecialchars($featured["description"]) ?>
        </p>

      </div>

    </a>

    <!-- SIDE CARDS -->
    <div class="transform-side">

      <?php foreach ($cards as $card): ?>

        <a
          href="<?= htmlspecialchars($card["href"]) ?>"
          class="transform-card fade-in"
          aria-label="<?= htmlspecialchars($card["title"]) ?>"
        >

          <span class="transform-card__arrow" aria-hidden="true">↗</span>

          <p class="transform-card__label">
            <?= htmlspecialchars($card["category"]) ?>
          </p>

          <h3 class="transform-card__title">
            <?= htmlspecialchars($card["title"]) ?>
          </h3>

        </a>

      <?php endforeach; ?>

    </div>

  </div>

  <!-- NOTE -->
  <div class="transform-note" role="note">
    <span class="transform-note__icon" aria-hidden="true">ⓘ</span>
    <p>Selected systems designed to improve operational clarity, scalability, and product performance.</p>
  </div>

  <!-- METRICS -->
  <div class="transform-metrics" aria-label="Impact metrics">

    <?php foreach ($metrics as $metric): ?>

      <button
        class="transform-metric fade-in"
        data-metric="<?= htmlspecialchars($metric['id']) ?>"
        aria-haspopup="dialog"
        aria-label="Learn more about <?= htmlspecialchars($metric['desc']) ?>"
      >
        <p class="transform-metric__label"><?= htmlspecialchars($metric["label"]) ?></p>
        <h4 class="transform-metric__value"><?= htmlspecialchars($metric["value"]) ?></h4>
        <span class="transform-metric__desc"><?= htmlspecialchars($metric["desc"]) ?></span>
        <span class="transform-metric__arrow" aria-hidden="true">↗</span>
      </button>

    <?php endforeach; ?>

  </div>

</section>