/* core/topbar.js — collapse the header into a glass chip past a scroll offset,
   expand again near the top. Hysteresis avoids flicker at the threshold. */
(function () {
  'use strict';
  var bar = document.querySelector('[data-topbar]');
  if (!bar) return;

  var ON = 64, OFF = 24, compact = false, ticking = false;

  function update() {
    var y = window.scrollY || document.documentElement.scrollTop || 0;
    if (!compact && y > ON) { compact = true; bar.classList.add('is-compact'); }
    else if (compact && y < OFF) { compact = false; bar.classList.remove('is-compact'); }
    ticking = false;
  }
  function onScroll() {
    if (!ticking) { ticking = true; requestAnimationFrame(update); }
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  update(); // honour an already-scrolled position on load
})();
