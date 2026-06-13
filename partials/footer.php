<?php
/**
 * partials/footer.php
 *
 * Site-wide footer.
 * Include at the bottom of every page, before </body>.
 *
 * NOTE: Script tags are handled per-page, not here,
 * so each page controls its own JS load order.
 */
require_once __DIR__ . "/../data/navigation.php";
?>

<footer class="site-footer" role="contentinfo">

  <div class="footer-top">

    <!-- BRAND -->
    <div class="footer-brand">
      <div class="footer-logo">
        <span class="footer-logo__mark" aria-hidden="true">RM</span>
        <span class="footer-logo__text">Ramesh Mandal</span>
      </div>
      <p class="footer-tagline">
        UX Leader driving AI-enabled<br>product strategy at scale.
      </p>
      <div class="footer-social" aria-label="Social links">
        <a href="https://in.linkedin.com/in/ramsmandal" class="footer-social__link" target="_blank" rel="noopener" aria-label="LinkedIn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
        </a>
        <a href="mailto:ramsmandal@icloud.com" class="footer-social__link" aria-label="Email">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </a>
      </div>
    </div>

    <!-- NAV + EXPERTISE -->
    <div class="footer-middle">

      <nav class="footer-nav" aria-label="Footer navigation">
        <p class="footer-nav__heading">Navigation</p>
        <a href="<?= BASE_PATH ?>/"               class="footer-nav__link">Home</a>
        <a href="<?= BASE_PATH ?>/about.php"      class="footer-nav__link">About</a>
        <a href="<?= BASE_PATH ?>/case-study/"    class="footer-nav__link">Work</a>
        <a href="<?= BASE_PATH ?>/blog/"          class="footer-nav__link">Field Notes</a>
        <a href="<?= BASE_PATH ?>/audit/"         class="footer-nav__link">Lab</a>
        <a href="<?= BASE_PATH ?>/resources.php"  class="footer-nav__link">Toolkit</a>
        <a href="<?= BASE_PATH ?>/contact.php"    class="footer-nav__link">Contact</a>
      </nav>

      <div class="footer-expertise">
        <p class="footer-nav__heading">Expertise</p>
        <?php
        $skills = ["UX Strategy","Design Systems","AI-Enabled Workflows",
                   "Enterprise UX","Product Thinking","CRO & Growth",
                   "UX Research","Design Leadership"];
        foreach ($skills as $s): ?>
          <span class="footer-expertise__item"><?= htmlspecialchars($s) ?></span>
        <?php endforeach; ?>
      </div>

    </div>

    <!-- CTA -->
    <div class="footer-cta">
      <p class="footer-nav__heading">Let's Connect</p>
      <p class="footer-cta__text">
        Open to senior UX leadership, product strategy, and enterprise design roles.
      </p>
      <a href="mailto:ramsmandal@icloud.com" class="footer-cta__btn">
        Send a Message ↗
      </a>
      <p class="footer-cta__location">
        📍 Gurugram, India · Available remotely
      </p>
    </div>

  </div>

  <!-- BOTTOM -->
  <div class="footer-bottom">
    <p class="footer-bottom__copy">
      © <?= date('Y') ?> Ramesh Mandal. Built with systems thinking.
    </p>
    <nav class="footer-bottom__links" aria-label="Legal and SEO links">
      <a href="<?= BASE_PATH ?>/seo">Site Map</a>
      <a href="<?= BASE_PATH ?>/sitemap.xml">XML Sitemap</a>
    </nav>
    <p class="footer-bottom__stack">
      PHP · HTML5 · Modular CSS · Vanilla JS
    </p>
  </div>

</footer>