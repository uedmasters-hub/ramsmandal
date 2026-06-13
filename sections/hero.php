<?php
/* =========================================
   SECTIONS / HERO.PHP
   ========================================= */

require_once __DIR__ . "/../data/stats.php";
?>

<div class="hero-wrapper">

  <!-- HERO -->
  <section class="hero" aria-label="Hero">
    <div class="hero__content">

      <h1 class="hero__title">
        Building scalable systems for
        <span id="typewriter" aria-live="polite"></span>
      </h1>

      <div class="hero__meta" aria-label="Key highlights">
        <span class="hero__meta-item">17+ Years Experience</span>
        <span class="hero__meta-item">10+ Enterprise Products</span>
        <span class="hero__meta-item">Millions of Users Served</span>
        <span class="hero__meta-item">Former UX Lead at IndiGo</span>
        <span class="hero__meta-item">📍 Gurgaon, India</span>
      </div>

      <div class="hero__chips" role="list" aria-label="Expertise areas">
        <button class="chip"          role="listitem" data-chip="ux-systems"            aria-haspopup="dialog">UX SYSTEMS</button>
        <button class="chip"          role="listitem" data-chip="product-strategy"       aria-haspopup="dialog">PRODUCT STRATEGY</button>
        <button class="chip chip--accent" role="listitem" data-chip="design-infrastructure" aria-haspopup="dialog">DESIGN INFRASTRUCTURE</button>
        <button class="chip chip--accent" role="listitem" data-chip="ai-enabled-workflows"  aria-haspopup="dialog">AI-ENABLED WORKFLOWS</button>
      </div>

    </div>
  </section>

  <!-- STATS -->
  <section class="stats-grid" aria-label="Impact statistics">
    <?php foreach ($stats as $stat): ?>
      <div class="stat-card fade-in">
        <p class="stat-card__label"><?= htmlspecialchars($stat["label"]) ?></p>
        <h2 class="stat-card__value"><?= htmlspecialchars($stat["value"]) ?></h2>
        <span class="stat-card__desc"><?= htmlspecialchars($stat["desc"]) ?></span>
      </div>
    <?php endforeach; ?>
  </section>

</div>

<!-- ── CHIP POPOVER ── -->
<div class="chip-overlay" aria-hidden="true"></div>

<aside
  class="chip-panel"
  role="dialog"
  aria-modal="true"
  aria-label="Expertise detail"
  aria-hidden="true"
>
  <div class="chip-panel__header">
    <span class="chip-panel__label"></span>
    <button class="chip-panel__close" aria-label="Close panel">✕</button>
  </div>
  <div class="chip-panel__body"></div>
</aside>