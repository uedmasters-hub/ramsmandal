/* =========================================
   BACKGROUND.JS
   6epixels.com — Ramesh Mandal Portfolio

   The animated gradient lives in background.css via CSS
   @keyframes on body — no JS needed for the animation.

   This file only handles:
   1. Mouse glow follow (lerp)
   2. Removing any body.style.background overrides
      that could block the CSS animation
   ========================================= */

(function () {

  "use strict";

  /* ── CLEAR any inline background that blocks CSS animation ──
     Old versions of this file set body.style.background via JS.
     That inline style has higher specificity than @keyframes
     and completely prevents the CSS gradient animation.
     We clear it once on load so CSS takes full control.         */

  if (document.body.style.background) {
    document.body.style.background = "";
  }

  /* ── MOUSE GLOW — lerp follow ───────────────────────────── */

  var glow = document.querySelector(".bg-mouse-glow");

  if (glow && window.matchMedia("(pointer: fine)").matches) {

    var mx  = window.innerWidth  / 2;
    var my  = window.innerHeight / 2;
    var cx  = mx;
    var cy  = my;

    document.addEventListener("mousemove", function (e) {
      mx = e.clientX;
      my = e.clientY;
    }, { passive: true });

    (function tick() {
      cx += (mx - cx) * 0.07;
      cy += (my - cy) * 0.07;
      glow.style.left = cx + "px";
      glow.style.top  = cy + "px";
      requestAnimationFrame(tick);
    })();

  }

})();