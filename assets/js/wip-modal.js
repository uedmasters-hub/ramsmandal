/* =============================================
   WIP-MODAL.JS
   Work-in-progress modal — homepage only.

   Lifecycle:
   1. Check sessionStorage — skip if seen
   2. Wait for preloader to dismiss
   3. 400ms pause → spring entry (centre screen)
   4. Typewriter types the title
   5. 5s countdown ring + tick
   6. Hover pauses ring + timers; mouseleave resumes
   7. Auto-close when ring completes

   Close: ✕ / backdrop / Escape / CTA / auto
   sessionStorage key: wip_seen
   ============================================= */

(function () {
  'use strict';

  /* Already seen this session → bail */
  try {
    // TEMP: show every load — restore when screens are ready
    // if (sessionStorage.getItem('wip_seen')) return;
  } catch (e) {}

  /* ── CONSTANTS ───────────────────────────── */
  var COUNTDOWN    = 8;     /* seconds — slightly longer to allow reading */
  var PRELOAD_WAIT = 400;   /* ms after preloader exits */

  /* Typewriter phrases — line 1 stays static, line 2 types */
  var TW_LINE1  = 'You caught me';
  var TW_PHRASE = 'mid-build.';
  var TW_SPEED  = 60;   /* ms per character */

  /* SVG ring: viewBox 36×36, cx/cy=18, r=16 → circumference ≈ 100.53
     Arc sits 2px outside the 32px button — minimal, tight orbit        */
  var RADIUS = 16;
  var CIRC   = (2 * Math.PI * RADIUS).toFixed(2); /* 100.53 */

  /* ── BUILD HTML ──────────────────────────── */
  var backdrop = document.createElement('div');
  backdrop.className = 'wip-backdrop';
  backdrop.setAttribute('aria-hidden', 'true');

  var modal = document.createElement('div');
  modal.className = 'wip-modal';
  modal.setAttribute('role', 'dialog');
  modal.setAttribute('aria-modal', 'true');
  modal.setAttribute('aria-label', 'Work in progress notice');

  modal.innerHTML =
    /* Close + ring */
    '<div class="wip-close-wrap">' +
      '<svg class="wip-ring" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">' +
        '<circle class="wip-ring__track" fill="none" stroke="none" cx="18" cy="18" r="' + RADIUS + '"/>' +
        '<circle class="wip-ring__bar" fill="none" stroke="none" cx="18" cy="18" r="' + RADIUS + '" id="wipRingBar"/>' +
      '</svg>' +
      '<button class="wip-close" id="wipClose" aria-label="Close">✕</button>' +
    '</div>' +

    /* Kicker */
    '<p class="wip-kicker">Behind the scenes</p>' +

    /* Title — line1 static, line2 typed */
    '<h2 class="wip-title">' +
      '<span class="wip-title__line1">' + TW_LINE1 + '</span><br>' +
      '<span class="wip-title__line2 wip-tw" id="wipTw"></span>' +
      '<span class="wip-cursor" id="wipCursor">|</span>' +
    '</h2>' +

    /* Body */
    '<p class="wip-desc">' +
      'The work is <strong>real</strong>. Case studies, audits, and essays are all live — ' +
      'with outcomes, process, and real decisions documented. ' +
      'Final mockups and screens are being prepped and will go live soon.' +
    '</p>' +

    /* Actions */
    '<div class="wip-actions">' +
      '<a href="/case-study/" class="wip-cta" id="wipCta">Read the work →</a>' +
      '<button class="wip-dismiss" id="wipDismiss">Maybe later</button>' +
    '</div>' +

    /* Countdown */
    '<span class="wip-countdown">' +
      'Closes in <span id="wipCountdownNum">' + COUNTDOWN + '</span>s' +
      '<span class="wip-pause-hint" id="wipPauseHint"> · hover to pause</span>' +
    '</span>';

  document.body.appendChild(backdrop);
  document.body.appendChild(modal);

  /* ── REFS ────────────────────────────────── */
  var ringBar     = document.getElementById('wipRingBar');
  var closeBtn    = document.getElementById('wipClose');
  var ctaBtn      = document.getElementById('wipCta');
  var dismissBtn  = document.getElementById('wipDismiss');
  var countdownEl = document.getElementById('wipCountdownNum');
  var pauseHint   = document.getElementById('wipPauseHint');
  var twEl        = document.getElementById('wipTw');
  var cursorEl    = document.getElementById('wipCursor');

  var autoTimer   = null;
  var tickTimer   = null;
  var twTimer     = null;
  var remaining   = COUNTDOWN;
  var isOpen      = false;
  var isPaused    = false;
  var ringStart   = null;   /* timestamp when ring started / resumed */
  var ringElapsed = 0;      /* ms already consumed before pause */

  /* ── INJECT KEYFRAMES ────────────────────── */
  var style = document.createElement('style');
  style.id  = 'wip-styles';
  style.textContent =
    '@keyframes wipRingSweep {' +
      'from { stroke-dashoffset: ' + CIRC + '; }' +
      'to   { stroke-dashoffset: 0; }' +
    '}' +
    '@keyframes wipCursorBlink {' +
      '0%,49%{ opacity:1; } 50%,100%{ opacity:0; }' +
    '}';
  document.head.appendChild(style);

  /* ── TYPEWRITER ──────────────────────────── */
  function startTypewriter(onDone) {
    var chars = TW_PHRASE.split('');
    var idx   = 0;
    twEl.textContent = '';

    function typeNext() {
      if (idx < chars.length) {
        twEl.textContent += chars[idx++];
        twTimer = setTimeout(typeNext, TW_SPEED);
      } else {
        /* Done typing — stop cursor blink after a beat */
        setTimeout(function () {
          if (cursorEl) cursorEl.style.opacity = '0';
        }, 1200);
        if (onDone) onDone();
      }
    }
    typeNext();
  }

  /* ── RING ────────────────────────────────── */
  function startRing(durationMs) {
    var dur         = durationMs || (COUNTDOWN * 1000);
    var startOffset = parseFloat(CIRC) - (parseFloat(CIRC) * (ringElapsed / (COUNTDOWN * 1000)));

    /* Step 1: kill animation, apply dasharray+offset WHILE stroke is none
       This guarantees the browser never renders a full solid circle        */
    ringBar.style.animation        = 'none';
    ringBar.style.stroke           = 'none';
    ringBar.style.strokeDasharray  = CIRC;
    ringBar.style.strokeDashoffset = startOffset.toFixed(2);
    ringBar.getBoundingClientRect(); /* commit invisible state */

    /* Step 2: now safe to show colour — arc is already clipped by dashoffset */
    ringBar.style.stroke   = 'var(--blue, #1a46c9)';
    ringBar.style.opacity  = '0.75';
    ringBar.getBoundingClientRect(); /* commit colour */

    /* Step 3: start sweep */
    ringBar.style.animation = 'wipRingSweep ' + dur + 'ms linear forwards';
    ringStart = Date.now();
  }

  function pauseRing() {
    /* Capture current offset from computed style */
    var computed = window.getComputedStyle(ringBar);
    var current  = parseFloat(computed.strokeDashoffset);
    ringBar.style.strokeDashoffset = current;
    ringBar.style.animation        = 'none';
    /* Add elapsed time */
    if (ringStart) ringElapsed += Date.now() - ringStart;
    ringStart = null;
  }

  function resumeRing() {
    var totalMs    = COUNTDOWN * 1000;
    var leftMs     = Math.max(0, totalMs - ringElapsed);
    startRing(leftMs);
  }

  /* ── TICK ────────────────────────────────── */
  function startTick() {
    remaining = COUNTDOWN;
    if (countdownEl) countdownEl.textContent = remaining;
    tickTimer = setInterval(function () {
      if (!isPaused) {
        remaining -= 1;
        if (countdownEl) countdownEl.textContent = Math.max(0, remaining);
        if (remaining <= 0) clearInterval(tickTimer);
      }
    }, 1000);
  }

  /* ── HOVER PAUSE / RESUME ────────────────── */
  modal.addEventListener('mouseenter', function () {
    if (!isOpen || isPaused) return;
    isPaused = true;

    /* Pause timers */
    clearTimeout(autoTimer);
    clearInterval(tickTimer);

    /* Pause ring */
    pauseRing();

    /* Visual feedback */
    if (pauseHint) pauseHint.textContent = ' · paused';
    modal.classList.add('is-paused');
  });

  modal.addEventListener('mouseleave', function () {
    if (!isOpen || !isPaused) return;
    isPaused = false;

    /* Restart tick from current remaining */
    tickTimer = setInterval(function () {
      remaining -= 1;
      if (countdownEl) countdownEl.textContent = Math.max(0, remaining);
      if (remaining <= 0) clearInterval(tickTimer);
    }, 1000);

    /* Resume ring */
    resumeRing();

    /* Reschedule auto-close for remaining time */
    var leftMs = Math.max(0, (COUNTDOWN * 1000) - ringElapsed);
    autoTimer  = setTimeout(closeModal, leftMs);

    if (pauseHint) pauseHint.textContent = ' · hover to pause';
    modal.classList.remove('is-paused');
  });

  /* ── OPEN ────────────────────────────────── */
  function openModal() {
    if (isOpen) return;
    isOpen = true;

    backdrop.classList.add('is-open');
    modal.classList.add('is-open');

    setTimeout(function () { closeBtn.focus(); }, 120);

    /* Type the title first, then start countdown */
    startTypewriter(function () {
      startRing();
      startTick();
      autoTimer = setTimeout(closeModal, COUNTDOWN * 1000);
    });
  }

  /* ── CLOSE ───────────────────────────────── */
  function closeModal() {
    if (!isOpen) return;
    isOpen = false;

    clearTimeout(autoTimer);
    clearInterval(tickTimer);
    clearTimeout(twTimer);

    modal.classList.add('is-closing');
    modal.classList.remove('is-open', 'is-paused');
    backdrop.classList.remove('is-open');

    // TEMP: disabled — restore when screens are ready
    // try { sessionStorage.setItem('wip_seen', '1'); } catch (e) {}

    setTimeout(function () {
      if (modal.parentNode)    modal.parentNode.removeChild(modal);
      if (backdrop.parentNode) backdrop.parentNode.removeChild(backdrop);
    }, 500);
  }

  /* ── EVENTS ──────────────────────────────── */
  closeBtn.addEventListener('click', closeModal);
  dismissBtn.addEventListener('click', closeModal);
  ctaBtn.addEventListener('click', closeModal);
  backdrop.addEventListener('click', closeModal);

  document.addEventListener('keydown', function onKey(e) {
    if (e.key === 'Escape' && isOpen) {
      closeModal();
      document.removeEventListener('keydown', onKey);
    }
  });

  /* ── WAIT FOR PRELOADER ──────────────────── */
  var preloader = document.getElementById('preloader');

  function waitForPreloader() {
    if (!preloader) {
      setTimeout(openModal, 800);
      return;
    }

    /* Already dismissed before we attached */
    if (preloader.classList.contains('is-done')) {
      setTimeout(openModal, PRELOAD_WAIT);
      return;
    }

    var observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (m) {
        if (preloader.classList.contains('is-done')) {
          observer.disconnect();
          setTimeout(openModal, PRELOAD_WAIT);
        }
      });
    });

    observer.observe(preloader, { attributes: true, attributeFilter: ['class'] });

    /* Safety net */
    setTimeout(function () {
      if (!isOpen) { observer.disconnect(); openModal(); }
    }, 4500);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', waitForPreloader);
  } else {
    waitForPreloader();
  }

})();