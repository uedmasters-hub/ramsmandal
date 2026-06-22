/* =========================================================================
   core/footer-curtain.js

   Footer entrance. The footer lives in normal flow (the whole thing scrolls,
   poster wall and all). When it scrolls into view, a GSAP timeline reveals it:
   the closing statement rises, the contact nav staggers in, and the posters
   cascade up into their rotations.

   - GSAP is reused from the page's importmap when present, otherwise pulled
     from the CDN, so the entrance works site-wide.
   - Pieces are hidden by CSS up-front (html.js) to avoid a flash; this module
     animates them in, then clears inline styles so hover/rotation behave.
   - Reduced motion, no GSAP, or no IntersectionObserver: reveal instantly.
   ========================================================================= */
(function () {
  "use strict";

  function reveal(footer) { footer.classList.add("fx-done"); }

  async function loadGsap() {
    try { var m = await import("gsap"); return m.gsap || m.default; }
    catch (e) {
      try { var c = await import("https://unpkg.com/gsap@3.12.5/index.js"); return c.gsap || c.default; }
      catch (e2) { return null; }
    }
  }

  function init() {
    var footer = document.querySelector(".playground-footer");
    if (!footer) return;
    if (!footer.id) footer.id = "site-footer";

    var reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (reduce || !("IntersectionObserver" in window)) { reveal(footer); return; }

    var status  = footer.querySelector(".footer-status");
    var title   = footer.querySelector(".footer-title");
    var labels  = footer.querySelectorAll(".footer-label");
    var links   = footer.querySelectorAll(".footer-nav-group a");
    var posters = footer.querySelectorAll(".poster");

    // Safety net: if GSAP never resolves, reveal anyway.
    var fallback = setTimeout(function () { reveal(footer); }, 2600);

    var started = false;
    var io = new IntersectionObserver(function (entries) {
      if (!entries[0].isIntersecting || started) return;
      started = true;
      io.disconnect();

      loadGsap().then(function (gsap) {
        if (!gsap) { clearTimeout(fallback); reveal(footer); return; }
        clearTimeout(fallback);

        var rot = function (i, el) {
          var r = parseFloat(getComputedStyle(el).getPropertyValue("--r"));
          return isNaN(r) ? 0 : r;
        };

        gsap.set([status, title], { y: 42, autoAlpha: 0 });
        gsap.set([].slice.call(labels).concat([].slice.call(links)), { y: 24, autoAlpha: 0 });
        gsap.set(posters, { y: 66, scale: 0.9, rotation: 0, autoAlpha: 0, transformOrigin: "50% 65%" });

        gsap.timeline({
          defaults: { ease: "power3.out" },
          onComplete: function () {
            reveal(footer);
            gsap.set([status, title], { clearProps: "all" });
            gsap.set([].slice.call(labels).concat([].slice.call(links)), { clearProps: "all" });
            gsap.set(posters, { clearProps: "all" });   // hand rotation + hover back to CSS
          }
        })
        .to(status,  { y: 0, autoAlpha: 1, duration: 0.6 }, 0)
        .to(title,   { y: 0, autoAlpha: 1, duration: 0.9 }, 0.05)
        .to(labels,  { y: 0, autoAlpha: 1, duration: 0.5, stagger: 0.08 }, 0.2)
        .to(links,   { y: 0, autoAlpha: 1, duration: 0.5, stagger: 0.06 }, 0.28)
        .to(posters, { y: 0, scale: 1, rotation: rot, autoAlpha: 1, duration: 0.7,
                       stagger: { each: 0.04, from: "random" } }, 0.18);
      });
    }, { rootMargin: "0px 0px -12% 0px", threshold: 0.01 });

    io.observe(footer);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();