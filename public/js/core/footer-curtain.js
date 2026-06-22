/* =========================================================================
   core/footer-curtain.js

   Curtain reveal: the footer is pinned (fixed) at the bottom; a page-coloured
   shutter covers it and lifts away on scroll so the body appears to slide up
   off the footer. The live dot-field is raised just above the shutter, so its
   real dots paint over the shutter and there is no flat seam.

   - One CSS var (--lift 0..1) drives the shutter's translateY. Transform only.
   - Eased with a lerp so it is buttery on native and Lenis-smoothed scroll.
   - rAF runs only while settling; reduced motion / no-JS / un-scrollable page
     falls back to a static, colour-separated footer in normal flow.
   ========================================================================= */
(function () {
  "use strict";

  var root = document.documentElement;

  function init() {
    var footer = document.querySelector(".playground-footer");
    if (!footer) return;
    if (!footer.id) footer.id = "site-footer";

    var reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;

    function maxScroll() { return root.scrollHeight - window.innerHeight; }
    function scrollable() { return maxScroll() > 40; }

    if (reduce || !scrollable() || !("IntersectionObserver" in window)) return;

    // page-coloured shutter that covers the pinned footer, then lifts
    var shutter = document.createElement("div");
    shutter.className = "curtain-shutter";
    shutter.setAttribute("aria-hidden", "true");
    document.body.appendChild(shutter);

    root.classList.add("footer-fixed-on");

    var lift = 0;      // current (eased) shutter lift 0..1
    var target = 0;    // scroll-derived target
    var raf = 0;

    function measure() {
      var winH = window.innerHeight || 1;
      var start = maxScroll() - winH;                   // runway = last viewport of scroll
      var y = window.scrollY || window.pageYOffset || 0;
      var t = (y - start) / winH;
      target = t < 0 ? 0 : t > 1 ? 1 : t;
    }

    function apply() { root.style.setProperty("--lift", lift.toFixed(4)); }

    function frame() {
      lift += (target - lift) * 0.16;
      if (Math.abs(target - lift) < 0.001) lift = target;
      apply();
      raf = Math.abs(target - lift) > 0.0005 ? requestAnimationFrame(frame) : 0;
    }

    function kick() { measure(); if (!raf) raf = requestAnimationFrame(frame); }

    function onScroll() { kick(); }

    var resizeTimer;
    function onResize() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        if (!scrollable()) { target = lift = 1; apply(); return; }  // can't scroll: leave open
        kick();
      }, 150);
    }

    window.addEventListener("scroll", onScroll, { passive: true });
    window.addEventListener("resize", onResize, { passive: true });

    measure();
    lift = target;
    apply();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();