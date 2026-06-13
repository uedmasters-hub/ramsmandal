/**
 * assets/js/navigation.js
 *
 * Mega menu + mobile drawer + scroll behaviour.
 * Vanilla JS — no dependencies.
 *
 * Header scroll behaviours:
 *  - Scrolling DOWN past threshold → hide header (slide up)
 *  - Scrolling UP               → show header immediately
 *  - Scrolled > 40px            → activate glassmorphism
 *  - At top                     → clear glass
 */

(function () {

  "use strict";

  /* ==================================================
     ELEMENTS
  ================================================== */

  const header    = document.getElementById("site-header");
  const megaMenu  = document.getElementById("mega-menu");
  const backdrop  = document.getElementById("mega-backdrop");
  const hamburger = document.getElementById("hamburger-btn");
  const drawer    = document.getElementById("mobile-drawer");
  const scrim     = document.getElementById("mobile-scrim");
  const closeBtn  = document.getElementById("drawer-close-btn");
  const triggers  = document.querySelectorAll("[data-mega]");

  /* ==================================================
     SCROLL — hide/show + glassmorphism
  ================================================== */

  const GLASS_THRESHOLD = 40;    // px — glass activates after this
  const HIDE_THRESHOLD  = 100;   // px — hide only kicks in past this point
  const HIDE_DELTA      = 8;     // px of upward scroll (increasing Y) to trigger hide
  const SHOW_DELTA      = 6;     // px of downward scroll (decreasing Y) to show

  let lastScrollY  = 0;
  let ticking      = false;
  let isHidden     = false;
  let isGlass      = false;
  let idleTimer    = null;

  function showHeader() {
    if (isHidden) {
      header.classList.remove("is-hidden");
      isHidden = false;
    }
  }

  function hideHeader() {
    if (!isHidden) {
      header.classList.add("is-hidden");
      isHidden = true;
      if (activePanel) closeAll(true);
    }
  }

  function handleScroll() {

    const y    = window.scrollY;
    const diff = y - lastScrollY;   // positive = scrolling UP page (Y increases)
                                     // negative = scrolling DOWN page (Y decreases)

    /* ── Glassmorphism ── */
    if (y > GLASS_THRESHOLD && !isGlass) {
      header.classList.add("is-scrolled");
      isGlass = true;
    } else if (y <= GLASS_THRESHOLD && isGlass) {
      header.classList.remove("is-scrolled");
      isGlass = false;
    }

    /* ── Hide / show ── */
    if (y <= HIDE_THRESHOLD) {
      // Near top — always visible, no hide logic
      showHeader();
    } else if (diff > HIDE_DELTA) {
      // User scrolling UP the page (Y increasing) — hide header
      hideHeader();
    } else if (diff < -SHOW_DELTA) {
      // User scrolling DOWN the page (Y decreasing) — show header
      showHeader();
    }

    /* ── Idle reveal — show after 2s of no scrolling ── */
    clearTimeout(idleTimer);
    idleTimer = setTimeout(function () {
      showHeader();
    }, 2000);

    lastScrollY = y;
    ticking     = false;

  }

  window.addEventListener("scroll", function () {
    if (!ticking) {
      requestAnimationFrame(handleScroll);
      ticking = true;
    }
  }, { passive: true });

  // Run once on load
  handleScroll();


  /* ==================================================
     MEGA MENU STATE
  ================================================== */

  let activePanel = null;
  let closeTimer  = null;
  const CLOSE_DELAY = 120;

  function openPanel(key) {

    clearTimeout(closeTimer);
    if (activePanel === key) return;

    closeAll(true);

    const panel   = document.getElementById("mega-panel-" + key);
    const trigger = document.querySelector("[data-mega='" + key + "']");

    if (!panel || !trigger) return;

    panel.classList.add("is-active");
    megaMenu.classList.add("is-open");
    backdrop.classList.add("is-visible");
    header.classList.add("mega-open");
    trigger.setAttribute("aria-expanded", "true");

    activePanel = key;
  }

  function closeAll(silent) {
    if (silent) { _doClose(); return; }
    clearTimeout(closeTimer);
    closeTimer = setTimeout(_doClose, CLOSE_DELAY);
  }

  function _doClose() {
    document.querySelectorAll(".mega-panel.is-active")
      .forEach(function (p) { p.classList.remove("is-active"); });
    triggers.forEach(function (t) {
      t.setAttribute("aria-expanded", "false");
    });
    megaMenu.classList.remove("is-open");
    backdrop.classList.remove("is-visible");
    header.classList.remove("mega-open");
    activePanel = null;
  }


  /* ==================================================
     TRIGGERS — hover + click
  ================================================== */

  triggers.forEach(function (trigger) {

    trigger.addEventListener("mouseenter", function () {
      openPanel(trigger.dataset.mega);
    });

    trigger.addEventListener("mouseleave", function (e) {
      if (megaMenu && !megaMenu.contains(e.relatedTarget)) {
        closeAll(false);
      }
    });

    trigger.addEventListener("click", function () {
      activePanel === trigger.dataset.mega
        ? closeAll(true)
        : openPanel(trigger.dataset.mega);
    });

  });


  /* ==================================================
     MEGA MENU — keep open on hover
  ================================================== */

  if (megaMenu) {

    megaMenu.addEventListener("mouseenter", function () {
      clearTimeout(closeTimer);
    });

    megaMenu.addEventListener("mouseleave", function (e) {
      const goingToTrigger = Array.from(triggers).some(function (t) {
        return t.contains(e.relatedTarget);
      });
      if (!goingToTrigger) closeAll(false);
    });

  }


  /* ==================================================
     BACKDROP click
  ================================================== */

  if (backdrop) {
    backdrop.addEventListener("click", function () { closeAll(true); });
  }


  /* ==================================================
     ESCAPE KEY
  ================================================== */

  document.addEventListener("keydown", function (e) {

    if (e.key !== "Escape") return;

    if (activePanel) {
      const trigger = document.querySelector("[data-mega='" + activePanel + "']");
      closeAll(true);
      if (trigger) trigger.focus();
      return;
    }

    if (drawerOpen) {
      closeMobileDrawer();
      if (hamburger) hamburger.focus();
    }

  });


  /* ==================================================
     FOCUS TRAP — close mega when focus leaves
  ================================================== */

  document.addEventListener("focusin", function (e) {
    if (!activePanel || !header || !megaMenu) return;
    if (!header.contains(e.target) && !megaMenu.contains(e.target)) {
      closeAll(true);
    }
  });


  /* ==================================================
     ARROW KEY NAV inside mega panel
  ================================================== */

  if (megaMenu) {

    megaMenu.addEventListener("keydown", function (e) {

      if (!activePanel) return;

      const panel = document.getElementById("mega-panel-" + activePanel);
      if (!panel) return;

      const links = Array.from(
        panel.querySelectorAll(".mega-link, .mega-intro-cta, .mega-footer-link")
      );
      const idx = links.indexOf(document.activeElement);

      if (e.key === "ArrowDown" || e.key === "ArrowRight") {
        e.preventDefault();
        (links[idx + 1] || links[0]).focus();
      }

      if (e.key === "ArrowUp" || e.key === "ArrowLeft") {
        e.preventDefault();
        (links[idx - 1] || links[links.length - 1]).focus();
      }

    });

  }


  /* ==================================================
     MOBILE DRAWER
     ─────────────────────────────────────────────────
     State machine: isOpen (bool) = single source of truth
     CSS controls display (none / flex) via .is-open class
     GSAP controls motion (translateX, opacity)

     Lifecycle:
       Page load  → drawer hidden (CSS display:none default)
       Open       → add .is-open (display:flex) → GSAP animates in
       Close      → GSAP animates out → remove .is-open (display:none)

     This order guarantees:
       - No flash on load (CSS hides before GSAP even runs)
       - No open-on-load (class never pre-exists)
       - GSAP only runs after element is visible (display:flex first)
  ================================================== */

  (function initMobileDrawer() {

    /* ── Element refs ──────────────────────────────────────── */
    var elHamburger = document.getElementById('hamburger-btn');
    var elDrawer    = document.getElementById('mobile-drawer');
    var elScrim     = document.getElementById('mobile-scrim');
    var elCloseBtn  = document.getElementById('drawer-close-btn');

    /* Hard stop if critical elements are missing */
    if (!elHamburger) { console.error('[Drawer] #hamburger-btn not found'); return; }
    if (!elDrawer)    { console.error('[Drawer] #mobile-drawer not found');  return; }

    var elNavLinks = Array.from(elDrawer.querySelectorAll('.mobile-nav-link'));
    var elFooter   = elDrawer.querySelector('.mobile-drawer__footer');

    /* ── State ─────────────────────────────────────────────── */
    var isOpen   = false;
    var isGsap   = (typeof gsap !== 'undefined');
    var activeTl = null;   /* current in-flight timeline */

    /* Sanity check: drawer must start closed */
    elDrawer.classList.remove('is-open');
    if (elScrim) elScrim.classList.remove('is-open');

    /* ── Helpers ───────────────────────────────────────────── */
    function setAriaOpen(open) {
      elHamburger.classList.toggle('is-open', open);
      elHamburger.setAttribute('aria-expanded', String(open));
      elHamburger.setAttribute('aria-label',
        open ? 'Close navigation menu' : 'Open navigation menu');
      elDrawer.setAttribute('aria-hidden', String(!open));
    }

    /* ── OPEN ──────────────────────────────────────────────── */
    function openDrawer() {
      if (isOpen) return;
      isOpen = true;

      if (activeTl) { activeTl.kill(); activeTl = null; }

      /* 1. Update ARIA and body scroll */
      setAriaOpen(true);
      document.body.style.overflow = 'hidden';

      /* 2. No-GSAP fallback */
      if (!isGsap) {
        elDrawer.classList.add('is-open');
        if (elScrim) elScrim.classList.add('is-open');
        elDrawer.style.transform = 'translateX(0)';
        focusDrawer();
        return;
      }

      /* 3. Set start positions BEFORE display:flex is applied.
            gsap.set writes inline styles synchronously right now.
            classList.add then flips display:none → display:flex.
            The browser's FIRST paint of the drawer sees it already
            at x:100% — no flash, no pop, true slide-in start.    */
      gsap.set(elDrawer,   { x: '100%' });
      gsap.set(elScrim,    { opacity: 0 });
      gsap.set(elNavLinks, { opacity: 0, y: 14 });
      if (elFooter) gsap.set(elFooter, { opacity: 0, y: 10 });

      /* 4. Now make visible — already positioned off-screen */
      elDrawer.classList.add('is-open');
      if (elScrim) elScrim.classList.add('is-open');

      var tl = gsap.timeline({ onComplete: focusDrawer });

      /* Backdrop fades in — starts immediately */
      tl.to(elScrim, {
        opacity:  1,
        duration: 0.30,
        ease:     'power2.out',
      }, 0);

      /* Drawer slides in — subtle overshoot via custom ease.
         CustomEase is part of GSAP free tier via string syntax.
         'back.out(1.4)' gives a small, premium overshoot
         that settles cleanly — not bouncy, just confident.   */
      tl.to(elDrawer, {
        x:        0,
        duration: 0.50,
        ease:     'back.out(1.4)',
      }, 0.04);

      /* Nav items stagger in — fade + slight upward rise.
         Starts after drawer is ~60% in (0.04 + 0.26 = 0.30s).
         y-motion (not x) — vertical rise feels more refined. */
      tl.to(elNavLinks, {
        opacity:  1,
        y:        0,
        duration: 0.26,
        stagger:  0.05,
        ease:     'power2.out',
      }, 0.30);

      /* Footer fades in last, barely trailing items */
      if (elFooter) {
        tl.to(elFooter, {
          opacity:  1,
          y:        0,
          duration: 0.22,
          ease:     'power2.out',
        }, 0.42);
      }

      activeTl = tl;
    }

    /* ── CLOSE ─────────────────────────────────────────────── */
    function closeDrawer() {
      if (!isOpen) return;
      isOpen = false;

      if (activeTl) { activeTl.kill(); activeTl = null; }

      /* Update ARIA immediately */
      setAriaOpen(false);

      if (!isGsap) {
        /* No GSAP — hide immediately */
        elDrawer.classList.remove('is-open');
        if (elScrim) elScrim.classList.remove('is-open');
        elDrawer.style.transform = 'translateX(100%)';
        document.body.style.overflow = '';
        elHamburger.focus();
        return;
      }

      var tl = gsap.timeline({
        onComplete: function () {
          /* Remove class AFTER animation — restores display:none */
          elDrawer.classList.remove('is-open');
          if (elScrim) elScrim.classList.remove('is-open');
          document.body.style.overflow = '';
          elHamburger.focus();
        }
      });

      /* Items out — fade + slight downward drift, no stagger on close */
      var exitEls = elFooter
        ? elNavLinks.concat([elFooter])
        : elNavLinks.slice();

      tl.to(exitEls, {
        opacity:  0,
        y:        8,
        duration: 0.16,
        ease:     'power2.in',
      }, 0);

      /* Drawer out — clean exit, slightly faster than entry */
      tl.to(elDrawer, {
        x:        '100%',
        duration: 0.32,
        ease:     'power3.in',
      }, 0.06);

      /* Backdrop fades — in sync with drawer exit */
      tl.to(elScrim, {
        opacity:  0,
        duration: 0.24,
        ease:     'power2.in',
      }, 0.08);

      activeTl = tl;
    }

    /* ── Focus management ─────────────────────────────────── */
    function focusDrawer() {
      var target = elDrawer.querySelector('.mobile-drawer__close') || elNavLinks[0];
      if (target) target.focus();
    }

    /* ── Focus trap ───────────────────────────────────────── */
    elDrawer.addEventListener('keydown', function (e) {
      if (!isOpen || e.key !== 'Tab') return;
      var focusable = Array.from(elDrawer.querySelectorAll(
        'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])'
      ));
      if (focusable.length < 2) return;
      var first = focusable[0];
      var last  = focusable[focusable.length - 1];
      if (e.shiftKey && document.activeElement === first) {
        e.preventDefault(); last.focus();
      } else if (!e.shiftKey && document.activeElement === last) {
        e.preventDefault(); first.focus();
      }
    });

    /* ── Event listeners ──────────────────────────────────── */
    elHamburger.addEventListener('click', function () {
      isOpen ? closeDrawer() : openDrawer();
    });

    if (elCloseBtn) {
      elCloseBtn.addEventListener('click', closeDrawer);
    }

    if (elScrim) {
      elScrim.addEventListener('click', closeDrawer);
    }

    elNavLinks.forEach(function (link) {
      link.addEventListener('click', closeDrawer);
    });

    /* Escape key — handled globally in navigation.js already
       for mega menu; we patch drawerOpen check here           */
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && isOpen) closeDrawer();
    });

  })(); /* end initMobileDrawer */


})();