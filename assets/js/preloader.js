/* =========================================
   PRELOADER.JS
   ========================================= */

(function () {
  "use strict";

  var preloader = document.getElementById("preloader");
  var bar       = document.getElementById("preloader-bar");
  var counter   = document.getElementById("preloader-counter");
  var page      = document.querySelector(".page-wrapper");

  if (!preloader) return;

  /* ── SCROLL LOCK — Android-safe ──────────
     Store scrollY → position:fixed the body →
     restore scrollY on unlock.
     This is the ONLY approach that reliably
     prevents scroll-behind on Android Chrome.
  ──────────────────────────────────────── */

  var savedScrollY = 0;

  function lockScroll() {
    savedScrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
    document.body.style.top = "-" + savedScrollY + "px";
    document.body.classList.add("is-loading");
  }

  function unlockScroll() {
    document.body.classList.remove("is-loading");
    document.body.style.top = "";
    window.scrollTo(0, savedScrollY);
  }

  /* Lock immediately before anything renders */
  lockScroll();

  /* ── PROGRESS ─────────────────────────── */

  var current = 0;
  var target  = 0;
  var raf     = null;
  var done    = false;

  function setProgress(val) {
    current = Math.min(val, 100);
    if (bar)     bar.style.width     = current + "%";
    if (counter) counter.textContent = Math.floor(current) + "%";
  }

  function tick() {
    if (current < target) {
      current += (target - current) * 0.08 + 0.3;
      setProgress(current);
    }
    if (!done || current < 100) {
      raf = requestAnimationFrame(tick);
    }
  }

  function phase1() {
    target = 70;
    raf = requestAnimationFrame(tick);
  }

  function phase2() {
    target = 100;
    done   = true;
    setTimeout(dismiss, 500);
  }

  function dismiss() {
    cancelAnimationFrame(raf);
    setProgress(100);

    setTimeout(function () {
      /* Unlock scroll FIRST — avoids one-frame body height flash */
      unlockScroll();

      /* Then hide preloader */
      preloader.classList.add("is-done");

      /* Then reveal page */
      if (page) {
        setTimeout(function () {
          page.classList.add("is-revealed");
        }, 80);
      }
    }, 280);
  }

  /* ── START ─────────────────────────────── */

  setTimeout(phase1, 200);

  if (document.readyState === "complete") {
    setTimeout(phase2, 900);
  } else {
    window.addEventListener("load", function () {
      var elapsed = performance.now();
      var minTime = 800;
      var wait    = Math.max(0, minTime - elapsed);
      setTimeout(phase2, wait);
    });
  }

  /* Safety net */
  setTimeout(function () {
    if (!preloader.classList.contains("is-done")) {
      phase2();
    }
  }, 2500);

})();