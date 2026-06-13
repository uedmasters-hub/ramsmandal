/* =========================================
   APP.JS — main init
   ========================================= */

(function () {
  "use strict";

  /* ── SMART NAV ─────────────────────────── */

  (function () {

    var header    = document.querySelector(".site-header");
    if (!header) return;

    var THRESHOLD = 80;
    var DELTA     = 12;
    var IDLE_MS   = 2500;

    var lastY     = 0;
    var ticking   = false;
    var idleTimer = null;

    function onScroll() {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(update);
    }

    function update() {
      var y     = window.scrollY;
      var delta = y - lastY;

      if (y <= THRESHOLD) {
        show();
        header.classList.remove("is-elevated");
        lastY   = y;
        ticking = false;
        return;
      }

      header.classList.add("is-elevated");

      var threshold = window.innerWidth < 768 ? 20 : DELTA;

      if (delta > threshold) {
        hide();
        resetIdle();
      } else if (delta < -threshold) {
        show();
        clearIdleTimer();
      }

      lastY   = y;
      ticking = false;
    }

    function show() {
      header.classList.remove("is-hidden");
      document.body.classList.remove("nav-hidden");
    }

    function hide() {
      header.classList.add("is-hidden");
      document.body.classList.add("nav-hidden");
    }

    function resetIdle() {
      clearIdleTimer();
      idleTimer = setTimeout(show, IDLE_MS);
    }

    function clearIdleTimer() {
      if (idleTimer) { clearTimeout(idleTimer); idleTimer = null; }
    }

    window.addEventListener("scroll", onScroll, { passive: true });

  })();

  /* ── ACTIVE NAV ────────────────────────── */

  var path  = window.location.pathname;
  var links = document.querySelectorAll(".site-nav__link");

  links.forEach(function (link) {
    var href = link.getAttribute("href");
    if (href === path || (path === "/" && href === "/")) {
      link.classList.add("is-active");
    }
  });

  /* ── STAT CARD 3D TILT (desktop only) ─── */

  if (window.innerWidth > 768) {
    var cards = document.querySelectorAll(".stat-card");

    cards.forEach(function (card) {
      card.addEventListener("mousemove", function (e) {
        var rect = card.getBoundingClientRect();
        var x    = e.clientX - rect.left - rect.width  / 2;
        var y    = e.clientY - rect.top  - rect.height / 2;
        var rotY = (x / rect.width)  *  8;
        var rotX = (y / rect.height) * -8;
        card.style.transform =
          "perspective(1200px) rotateX(" + rotX + "deg) rotateY(" + rotY + "deg) translateY(-5px)";
      });

      card.addEventListener("mouseleave", function () {
        card.style.transform = "";
      });
    });
  }

})();

/* ── MOBILE NAV DRAWER ─────────────────────── */

(function () {

  var hamburger = document.querySelector(".nav-hamburger");
  var drawer    = document.querySelector(".nav-drawer");
  var closeBtn  = document.querySelector(".nav-drawer__close");

  if (!hamburger || !drawer) return;

  function openDrawer() {
    drawer.classList.add("is-open");
    hamburger.classList.add("is-active");
    hamburger.setAttribute("aria-expanded", "true");
    drawer.setAttribute("aria-hidden", "false");
    /* Lock scroll on both html and body — Android needs both */
    document.documentElement.style.overflow = "hidden";
    document.body.style.overflow = "hidden";
  }

  function closeDrawer() {
    drawer.classList.remove("is-open");
    hamburger.classList.remove("is-active");
    hamburger.setAttribute("aria-expanded", "false");
    drawer.setAttribute("aria-hidden", "true");
    document.documentElement.style.overflow = "";
    document.body.style.overflow = "";
  }

  hamburger.addEventListener("click", openDrawer);
  if (closeBtn) closeBtn.addEventListener("click", closeDrawer);

  /* close on backdrop tap */
  drawer.addEventListener("click", function (e) {
    if (e.target === drawer) closeDrawer();
  });

  /* close on Escape */
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeDrawer();
  });

  /* close drawer links on tap */
  var drawerLinks = drawer.querySelectorAll(".nav-drawer__link");
  drawerLinks.forEach(function (link) {
    link.addEventListener("click", closeDrawer);
  });

})();