<?php
/* =========================================
   SECTIONS / EXPERIENCE.PHP
   ========================================= */

require_once __DIR__ . "/../data/experience.php";
?>

<section class="experience-section" aria-label="Career timeline" id="experience">

  <!-- HEADER -->
  <div class="experience-header">

    <div class="experience-header__left">
      <p class="experience-kicker">EXECUTIVE_CHRONOLOGY</p>
      <h2 class="experience-title">
        Building<br>
        <span>Digital Legacies.</span>
      </h2>
    </div>

    <div class="experience-header__right">
      <span class="experience-range">2007 — Present</span>
    </div>

  </div>

  <!-- TIMELINE -->
  <div class="timeline" role="list">

    <!-- VERTICAL LINE -->
    <div class="timeline__track" aria-hidden="true">
      <div class="timeline__track-fill"></div>
    </div>

    <?php foreach ($experience as $i => $entry): ?>

      <article
        class="timeline__entry timeline__entry--<?= $entry['side'] ?> tl-reveal"
        role="listitem"
        style="--delay: <?= $i * 120 ?>ms"
        aria-label="<?= htmlspecialchars($entry['company']) ?>, <?= htmlspecialchars($entry['period']) ?>"
      >

        <!-- NODE ON LINE -->
        <div
          class="timeline__node<?= $entry['current'] ? ' timeline__node--active' : '' ?>"
          aria-hidden="true"
        ></div>

        <!-- CARD -->
        <div class="timeline__card">

          <!-- PERIOD PILL -->
          <span class="timeline__period<?= $entry['current'] ? ' timeline__period--current' : '' ?>">
            <?= htmlspecialchars($entry['period']) ?>
          </span>

          <!-- COMPANY -->
          <h3 class="timeline__company"><?= htmlspecialchars($entry['company']) ?></h3>

          <!-- ROLE -->
          <p class="timeline__role"><?= htmlspecialchars($entry['role']) ?></p>

          <!-- DESC -->
          <p class="timeline__desc"><?= htmlspecialchars($entry['desc']) ?></p>

          <!-- TAGS -->
          <?php if (!empty($entry['tags'])): ?>
            <div class="timeline__tags" aria-label="Skills involved">
              <?php foreach ($entry['tags'] as $tag): ?>
                <span class="timeline__tag">• <?= htmlspecialchars($tag) ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>

      </article>

    <?php endforeach; ?>

  </div>

</section>