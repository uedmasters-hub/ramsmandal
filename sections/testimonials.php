<?php
require_once __DIR__ . "/../data/testimonials.php";
?>

<!-- =============================================
     TESTIMONIALS
     ============================================= -->
<section class="testimonials-section" aria-label="Testimonials">

  <div class="testimonials-header">
    <p class="testimonials-kicker">WHAT LEADERS SAY</p>
    <h2 class="testimonials-title">
      Trusted by<br><span>Decision Makers</span>
    </h2>
  </div>

  <div class="testimonials-grid" role="list">
    <?php foreach ($testimonials as $i => $t): ?>
      <article
        class="testimonial-card tl-reveal"
        role="listitem"
        style="--delay: <?= ($i % 3) * 100 ?>ms"
      >
        <div class="testimonial-card__quote-mark" aria-hidden="true">"</div>
        <blockquote class="testimonial-card__quote">
          <?= htmlspecialchars($t['quote']) ?>
        </blockquote>
        <footer class="testimonial-card__footer">
          <div class="testimonial-card__avatar" aria-hidden="true">
            <?= htmlspecialchars($t['avatar']) ?>
          </div>
          <div class="testimonial-card__meta">
            <strong class="testimonial-card__name"><?= htmlspecialchars($t['name']) ?></strong>
            <span class="testimonial-card__role">
              <?= htmlspecialchars($t['role']) ?> · <?= htmlspecialchars($t['company']) ?>
            </span>
          </div>
        </footer>
      </article>
    <?php endforeach; ?>
  </div>

</section>

<!-- =============================================
     CLIENT LOGO CLOUD
     ============================================= -->
<section class="logos-section" aria-label="Companies worked with">

  <p class="logos-label">TRUSTED BY TEAMS AT</p>

  <div class="logos-grid" role="list">
    <?php foreach ($clients as $client): ?>
      <div class="logo-item" role="listitem" aria-label="<?= htmlspecialchars($client['name']) ?>">
        <span class="logo-item__abbr" aria-hidden="true"><?= htmlspecialchars($client['abbr']) ?></span>
        <span class="logo-item__name"><?= htmlspecialchars($client['name']) ?></span>
      </div>
    <?php endforeach; ?>
  </div>

</section>

<!-- =============================================
     MARQUEE STRIP — OPEN TO WORK
     ============================================= -->
<div class="marquee-strip" aria-label="Open to new opportunities" role="marquee">
  <div class="marquee-track">
    <?php
    $items = [
      "✦ OPEN TO WORK",
      "UX LEADERSHIP ROLES",
      "✦ PRODUCT STRATEGY",
      "DESIGN SYSTEMS",
      "✦ ENTERPRISE UX",
      "AI-ENABLED DESIGN",
      "✦ AVAILABLE GLOBALLY",
      "REMOTE & HYBRID",
    ];
    // Duplicate for seamless loop
    $all = array_merge($items, $items);
    foreach ($all as $item): ?>
      <span class="marquee-item"><?= htmlspecialchars($item) ?></span>
    <?php endforeach; ?>
  </div>
</div>