/* =========================================================================
   core/footer-curtain.js

   Curtain reveal for the inverted footer. As the footer scrolls into view it
   is uncovered by a clip-path wipe (top down). The not-yet-revealed area is
   clipped to transparent, so the fixed dot-field behind shows through and the
   page appears to peel up to reveal the footer.

   - One CSS var (--fr 0..1) drives the clip + a small content rise. The clip
     edge is GPU-composited; nothing layout-affecting animates.
   - No GSAP / Lenis dependency: reads window scroll, eased with a lerp so it
     is buttery on native scroll and on Lenis-smoothed pages alike.
   - rAF runs only while the var is still settling; the scroll listener is
     bound only while the footer is near the viewport (IntersectionObserver).
   - Reduced motion / no-JS / un-scrollable page: no clip, footer stays a
     plain colour-separated block.
   ========================================================================= */
(function () {
  "use strict";

  var root = document.documentElement;

  function init() {
    var footer = document.querySelector(".playground-footer");
    if (!footer) return;
    if (!footer.id) footer.id = "site-footer";

    var reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;

    function scrollable() {
      return (root.scrollHeight - window.innerHeight) > 4;
    }

    // Bail to the static, colour-separated footer.
    if (reduce || !scrollable() || !("IntersectionObserver" in window)) return;

    root.classList.add("footer-curtain-on");

    var fr = 0;        // current (eased) reveal 0..1
    var target = 0;    // scroll-derived target
    var raf = 0;

    function measure() {
      var winH = window.innerHeight || 1;
      var rect = footer.getBoundingClientRect();
      var denom = Math.min(winH, rect.height) || 1;     // reveal over <= one viewport
      var t = (winH - rect.top) / denom;                // 0 as it enters, 1 once uncovered
      target = t < 0 ? 0 : t > 1 ? 1 : t;
    }

    function apply() { root.style.setProperty("--fr", fr.toFixed(4)); }

    function frame() {
      fr += (target - fr) * 0.14;                        // ease toward target
      if (Math.abs(target - fr) < 0.001) fr = target;
      apply();
      raf = Math.abs(target - fr) > 0.0005 ? requestAnimationFrame(frame) : 0;
    }

    function kick() {
      measure();
      if (!raf) raf = requestAnimationFrame(frame);
    }

    function onScroll() { kick(); }

    var resizeTimer;
    function onResize() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        if (!scrollable()) {                             // page no longer scrollable: reveal, stop
          target = fr = 1;
          apply();
          if (raf) { cancelAnimationFrame(raf); raf = 0; }
          return;
        }
        kick();
      }, 150);
    }

    // Only listen to scroll while the footer is anywhere near the viewport.
    var io = new IntersectionObserver(function (entries) {
      if (entries[0].isIntersecting) {
        window.addEventListener("scroll", onScroll, { passive: true });
        kick();
      } else {
        window.removeEventListener("scroll", onScroll);
        target = footer.getBoundingClientRect().top < 0 ? 1 : 0;  // settle fully open / closed
        if (!raf) raf = requestAnimationFrame(frame);
      }
    }, { rootMargin: "0px 0px 0px 0px", threshold: 0 });

    io.observe(footer);
    window.addEventListener("resize", onResize, { passive: true });

    // Initial state (footer may already be visible on short pages).
    measure();
    fr = target;
    apply();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();