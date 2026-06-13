/* =============================================================
   TRANSITIONS.JS
   Page fade transitions · Smooth anchor scroll · Drawer stagger
   ============================================================= */

(function () {
  "use strict";

  var prefersReduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* =============================================================
     PAGE FADE — handled in animations.js initPageTransitions()
     This file handles additional scroll-linked transitions.
  ============================================================= */

  /* =============================================================
     SMOOTH SCROLL for anchor links
  ============================================================= */

  if (!prefersReduced) {
    document.addEventListener("click", function (e) {
      var link = e.target.closest('a[href^="#"]');
      if (!link) return;

      var id = link.getAttribute("href").slice(1);
      if (!id) return;

      var target = document.getElementById(id);
      if (!target) return;

      e.preventDefault();

      var headerH = (document.querySelector(".header") || { offsetHeight: 80 }).offsetHeight;
      var top     = target.getBoundingClientRect().top + window.scrollY - headerH - 24;

      window.scrollTo({ top: top, behavior: "smooth" });

      /* Update URL without jump */
      history.pushState(null, "", "#" + id);
    });
  }

  /* =============================================================
     SCROLL — update body scroll class (for sticky nav styling)
  ============================================================= */

  var lastScrollY = 0;
  var ticking     = false;

  function onScroll() {
    var scrollY = window.scrollY;

    /* Scrolled state — triggers nav background */
    if (scrollY > 20) {
      document.body.classList.add("is-scrolled");
    } else {
      document.body.classList.remove("is-scrolled");
    }

    /* Scroll direction */
    if (scrollY > lastScrollY + 4) {
      document.body.classList.add("scroll-down");
      document.body.classList.remove("scroll-up");
    } else if (scrollY < lastScrollY - 4) {
      document.body.classList.add("scroll-up");
      document.body.classList.remove("scroll-down");
    }

    lastScrollY = scrollY;
    ticking     = false;
  }

  window.addEventListener("scroll", function () {
    if (!ticking) {
      requestAnimationFrame(onScroll);
      ticking = true;
    }
  }, { passive: true });

  onScroll();

})();