/* =========================================================================
   big-cards-gallery.js — two-stage discipline gallery (home).

   STATE 01  sticky spotlight: native scroll progress through .bc-stage-wrap
             drives --active card; GSAP crossfades the full-image slides.
   STATE 02  the rail below is revealed (drag-to-scroll + staggered entrance).

   Directional cursor (fine pointer only): first card -> right arrow, middle ->
   both, last -> left; unavailable arrows are hidden. Click advances/retreats
   via Lenis. Touch / reduced-motion: the spotlight collapses to static cards
   (CSS), and only the rail interaction runs.

   Retire the old big-cards block in home-experience.js: remove the calls
   `revealBigCards();` and `initBigCardsDrag();` so they don't double-bind.
   ========================================================================= */
import { gsap, } from "./core/smooth-scroll.js";
import { initSmoothScroll } from "./core/smooth-scroll.js";

(function () {
  "use strict";

  var clamp = function (v, a, b) { return v < a ? a : v > b ? b : v; };

  var section = document.querySelector(".big-cards[data-bc]");
  if (!section) return;

  var wrap   = section.querySelector(".bc-stage-wrap");
  var stage  = section.querySelector(".bc-stage");
  var slides = [].slice.call(section.querySelectorAll(".bc-slide"));
  var ticks  = [].slice.call(section.querySelectorAll(".bc-progress__tick"));
  var rail   = section.querySelector(".big-cards__track");
  var count  = slides.length;

  var fine   = matchMedia("(hover: hover) and (pointer: fine)").matches;
  var reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
  var coarse = matchMedia("(pointer: coarse)").matches || matchMedia("(max-width: 760px)").matches;

  /* ---- STATE 02 rail: drag-to-scroll + entrance (always on) ------------- */
  railDrag(rail);
  railReveal(rail, reduce);

  /* On touch / reduced-motion the CSS lays the slides out statically; the
     spotlight scrubber and cursor would only get in the way. */
  if (!wrap || !stage || count === 0 || reduce || coarse || !fine) return;

  /* ---- STATE 01 spotlight ----------------------------------------------- */
  var active = -1;

  function setActive(i, animate) {
    i = clamp(i, 0, count - 1);
    if (i === active) return;
    active = i;
    for (var k = 0; k < ticks.length; k++) ticks[k].classList.toggle("is-active", k === i);
    updateCursor();
    var dur = animate ? 0.55 : 0;
    slides.forEach(function (s, k) {
      if (k === i) {
        gsap.to(s, { autoAlpha: 1, scale: 1, yPercent: 0, duration: dur, ease: "power3.out", overwrite: "auto" });
      } else {
        gsap.to(s, { autoAlpha: 0, scale: 0.965, yPercent: (k < i ? -1 : 1) * 3, duration: dur, ease: "power2.out", overwrite: "auto" });
      }
    });
  }

  gsap.set(slides, { autoAlpha: 0, scale: 0.965 });
  setActive(0, false);

  var ticking = false;
  function onScroll() {
    if (ticking) return; ticking = true;
    requestAnimationFrame(function () {
      ticking = false;
      var range = wrap.offsetHeight - window.innerHeight;
      var top = wrap.getBoundingClientRect().top;
      var p = range > 0 ? clamp(-top / range, 0, 1) : 0;
      setActive(Math.round(p * (count - 1)), true);
    });
  }
  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", onScroll, { passive: true });
  onScroll();

  /* ---- directional cursor ----------------------------------------------- */
  var CHEV_L = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>';
  var CHEV_R = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>';

  var cur = document.createElement("div");
  cur.className = "bc-cursor";
  cur.setAttribute("aria-hidden", "true");
  cur.innerHTML = '<span class="bc-cursor__arrow bc-cursor__arrow--l">' + CHEV_L + "</span>" +
                  '<span class="bc-cursor__arrow bc-cursor__arrow--r">' + CHEV_R + "</span>";
  var arrowL = cur.querySelector(".bc-cursor__arrow--l");
  var arrowR = cur.querySelector(".bc-cursor__arrow--r");
  document.body.appendChild(cur);

  function updateCursor() {
    if (!arrowL || !arrowR) return;      // cursor not built yet (first setActive)
    arrowL.hidden = active <= 0;
    arrowR.hidden = active >= count - 1;
  }
  updateCursor();

  stage.addEventListener("pointermove", function (e) {
    if (e.pointerType && e.pointerType !== "mouse") return;
    cur.style.transform = "translate(" + e.clientX + "px," + e.clientY + "px) scale(1)";
    cur.classList.add("is-on");
  }, { passive: true });
  stage.addEventListener("pointerleave", function () { cur.classList.remove("is-on"); });
  window.addEventListener("blur", function () { cur.classList.remove("is-on"); });

  stage.addEventListener("click", function (e) {
    var dir = (e.clientX < window.innerWidth / 2) ? -1 : 1;
    go(active + dir);
  });

  function go(i) {
    i = clamp(i, 0, count - 1);
    if (i === active) return;
    var range = wrap.offsetHeight - window.innerHeight;
    var wrapTop = window.scrollY + wrap.getBoundingClientRect().top;
    var y = wrapTop + (i / (count - 1)) * range;
    var lenis = null;
    try { lenis = initSmoothScroll(); } catch (err) {}
    if (lenis && lenis.scrollTo) lenis.scrollTo(y, { duration: 0.9 });
    else window.scrollTo({ top: y, behavior: "smooth" });
  }

  /* ---- helpers ---------------------------------------------------------- */
  function railDrag(track) {
    if (!track) return;
    var down = false, startX = 0, startScroll = 0, moved = false;
    track.addEventListener("pointerdown", function (e) {
      down = true; moved = false; startX = e.clientX; startScroll = track.scrollLeft;
      track.classList.add("is-dragging");
      try { track.setPointerCapture(e.pointerId); } catch (_) {}
    });
    track.addEventListener("pointermove", function (e) {
      if (!down) return;
      var dx = e.clientX - startX;
      if (Math.abs(dx) > 3) moved = true;
      track.scrollLeft = startScroll - dx;
    });
    var end = function () { if (!down) return; down = false; track.classList.remove("is-dragging"); };
    track.addEventListener("pointerup", end);
    track.addEventListener("pointercancel", end);
    track.addEventListener("pointerleave", end);
    track.addEventListener("click", function (e) { if (moved) { e.preventDefault(); e.stopPropagation(); } }, true);
  }

  function railReveal(track, reduced) {
    if (!track || reduced) return;
    var cards = track.querySelectorAll(".big-card");
    gsap.set(cards, { autoAlpha: 0, y: 40 });
    var io = new IntersectionObserver(function (entries) {
      if (!entries[0].isIntersecting) return;
      io.disconnect();
      gsap.to(cards, { autoAlpha: 1, y: 0, duration: 0.8, ease: "power3.out", stagger: 0.08 });
    }, { threshold: 0.15, rootMargin: "0px 0px -8% 0px" });
    io.observe(track);
  }
})();