/* =========================================
   ANIMATIONS.JS
   Scroll-reveal for all pages.
   Depends on CSS classes in:
     main.css       → .fade-in / .is-visible
     experience.css → .tl-reveal / .is-visible
                      .timeline__track-fill / .is-active
   ========================================= */

(function () {
  "use strict";

  /* ── RESPECT REDUCED MOTION ────────────── */

  const prefersReduced =
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  if (prefersReduced) {
    /* Make everything visible immediately — no animation */
    document.querySelectorAll(
      ".fade-in, .tl-reveal, .cs-section, .cs-metric-card, .cs-step"
    ).forEach(function (el) {
      el.classList.add("is-visible");
    });
    var fill = document.querySelector(".timeline__track-fill");
    if (fill) fill.classList.add("is-active");
    return;
  }

  /* ── SHARED OBSERVER FACTORY ───────────── */

  function makeObserver(onEnter, options) {
    return new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) onEnter(e.target);
      });
    }, options || {});
  }

  /* =========================================
     1. FADE-IN
        Used by: stat cards, hero content,
        transform cards, metrics, about hero,
        about stats, case-study hero image
  ========================================= */

  var fadeEls = document.querySelectorAll(".fade-in");

  if (fadeEls.length) {
    var fadeObs = makeObserver(function (el) {
      el.classList.add("is-visible");
      fadeObs.unobserve(el);
    }, { threshold: 0.1, rootMargin: "0px 0px -40px 0px" });

    fadeEls.forEach(function (el) {
      /* Skip cursor elements */
      if (el.hasAttribute("data-no-animate")) return;
      fadeObs.observe(el);
    });
  }

  /* =========================================
     2. TL-REVEAL (slide in left / right)
        Used by: timeline entries, bento cards,
        testimonial cards, about moments,
        principle cards, competency rows,
        credential items, about testimonials
  ========================================= */

  var tlEls = document.querySelectorAll(".tl-reveal");

  if (tlEls.length) {
    var tlObs = makeObserver(function (el) {
      el.classList.add("is-visible");
      tlObs.unobserve(el);
    }, { threshold: 0.1, rootMargin: "0px 0px -60px 0px" });

    tlEls.forEach(function (el) { tlObs.observe(el); });
  }

  /* =========================================
     3. TIMELINE TRACK FILL
        The vertical line that draws downward
  ========================================= */

  var tlTrack = document.querySelector(".timeline__track-fill");

  if (tlTrack) {
    var trackObs = makeObserver(function () {
      tlTrack.classList.add("is-active");
      trackObs.disconnect();
    }, { threshold: 0.05 });

    trackObs.observe(tlTrack.closest(".timeline") || tlTrack.parentElement);
  }

  /* =========================================
     4. SECTION HEADERS
        Kicker + title fade up on scroll
  ========================================= */

  var sectionHeaders = document.querySelectorAll(
    ".section-header, .transform-header, .exp-header, " +
    ".blog-hero, .cs-listing-hero, .psych-hero"
  );

  if (sectionHeaders.length) {
    var headerObs = makeObserver(function (el) {
      el.classList.add("is-visible");
      headerObs.unobserve(el);
    }, { threshold: 0.15 });

    sectionHeaders.forEach(function (el) {
      if (!el.classList.contains("fade-in")) {
        el.classList.add("fade-in");
      }
      headerObs.observe(el);
    });
  }

  /* =========================================
     5. STAGGERED CHILDREN
        Any container with [data-stagger]
        staggers its direct children
  ========================================= */

  var staggerContainers = document.querySelectorAll("[data-stagger]");

  if (staggerContainers.length) {
    var staggerObs = makeObserver(function (container) {
      var children = container.children;
      var delay    = parseInt(container.dataset.stagger, 10) || 80;
      Array.prototype.forEach.call(children, function (child, i) {
        setTimeout(function () {
          child.classList.add("is-visible");
        }, i * delay);
      });
      staggerObs.unobserve(container);
    }, { threshold: 0.1, rootMargin: "0px 0px -40px 0px" });

    staggerContainers.forEach(function (el) {
      /* Tag children as fade-in so CSS picks them up */
      Array.prototype.forEach.call(el.children, function (child) {
        if (!child.classList.contains("fade-in")) {
          child.classList.add("fade-in");
        }
      });
      staggerObs.observe(el);
    });
  }

  /* =========================================
     6. PHILOSOPHY QUOTES
  ========================================= */

  var philEls = document.querySelectorAll(
    ".philosophy-quote, .philosophy-attr, .phil-card"
  );

  if (philEls.length) {
    var philObs = makeObserver(function (el) {
      el.classList.add("is-visible");
      philObs.unobserve(el);
    }, { threshold: 0.2 });

    philEls.forEach(function (el) {
      if (!el.classList.contains("fade-in")) {
        el.classList.add("fade-in");
      }
      philObs.observe(el);
    });
  }

  /* =========================================
     7. CASE STUDY SECTIONS
        Each section fades + rises on scroll
  ========================================= */

  var csSections = document.querySelectorAll(".cs-section");

  if (csSections.length) {
    var csObs = makeObserver(function (el) {
      el.classList.add("is-visible");
      csObs.unobserve(el);
    }, { threshold: 0.08, rootMargin: "0px 0px -80px 0px" });

    csSections.forEach(function (el) {
      if (!el.classList.contains("fade-in")) {
        el.classList.add("fade-in");
      }
      csObs.observe(el);
    });
  }

  /* =========================================
     8. METRIC CARDS (case study)
        Stagger reveal within each row
  ========================================= */

  var metricRows = document.querySelectorAll(".cs-metrics-row");

  if (metricRows.length) {
    var metricObs = makeObserver(function (row) {
      var cards = row.querySelectorAll(".cs-metric-card");
      cards.forEach(function (card, i) {
        setTimeout(function () {
          card.classList.add("is-visible");
        }, i * 100);
      });
      metricObs.unobserve(row);
    }, { threshold: 0.15 });

    /* Tag metric cards with fade-in */
    document.querySelectorAll(".cs-metric-card").forEach(function (card) {
      if (!card.classList.contains("fade-in")) {
        card.classList.add("fade-in");
      }
    });

    metricRows.forEach(function (row) { metricObs.observe(row); });
  }

  /* =========================================
     9. ALREADY VISIBLE ON LOAD
        Anything in the viewport on page load
        should be visible immediately
  ========================================= */

  setTimeout(function () {
    var allAnimated = document.querySelectorAll(".fade-in, .tl-reveal");

    allAnimated.forEach(function (el) {
      var r = el.getBoundingClientRect();
      if (r.top < window.innerHeight * 0.95) {
        el.classList.add("is-visible");
      }
    });

    /* Timeline track — if already in view */
    if (tlTrack) {
      var r = tlTrack.getBoundingClientRect();
      if (r.top < window.innerHeight) {
        tlTrack.classList.add("is-active");
      }
    }
  }, 150);

})();