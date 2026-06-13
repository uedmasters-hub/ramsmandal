/* =============================================
   GALLERY.JS
   Floating carousel FAB + lightbox.
   Used on: case-study, audit, blog pages.

   Data (set by partials/gallery.php):
     window.GALLERY_IMAGES   — lightbox images
     window.CAROUSEL_IMAGES  — FAB carousel URLs

   Reveal: 3s OR 10% scroll — whichever first.
   Scroll: hide on down, show on up / idle 800ms.
   Carousel: crossfade every 2.5s, pauses when
             tab hidden or lightbox open.
   ============================================= */

(function () {
  'use strict';

  var galleryImages  = window.GALLERY_IMAGES  || [];
  var carouselImages = window.CAROUSEL_IMAGES || [];

  /* Nothing to show → exit */
  if (!galleryImages.length && !carouselImages.length) return;

  /* ── PRELOAD CAROUSEL IMAGES ─────────────── */
  /* Load tiny square images immediately so carousel
     is ready the moment the FAB appears.           */
  var carouselLoaded = [];
  carouselImages.forEach(function (src, i) {
    var img = new Image();
    img.onload = function () { carouselLoaded[i] = true; };
    img.src = src;
  });

  /* ── BUILD FAB ───────────────────────────── */
  var fab = document.createElement('button');
  fab.className = 'gallery-fab';
  fab.setAttribute('aria-label', 'View design screens');
  fab.setAttribute('type', 'button');

  /* Carousel ring — SVG progress + two stacked imgs for sequential fade */
  var carouselRing = '';
  if (carouselImages.length) {
    /* SVG progress ring dimensions */
    /* The SVG sits at -3px offset (inset:-3px in CSS).
       Total SVG size = 36 + 6 = 42px.
       Circle cx/cy = 21 (centre of 42px).
       Radius = 18 (leaves 3px for stroke on each side).
       Circumference = 2π×18 ≈ 113.1                       */
    carouselRing =
      '<span class="gallery-fab__carousel" aria-hidden="true">' +
        /* Progress ring SVG */
        '<svg class="gallery-fab__progress" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">' +
          '<circle class="gallery-fab__progress-track" cx="21" cy="21" r="18"/>' +
          '<circle class="gallery-fab__progress-bar"  cx="21" cy="21" r="18" id="galCarProgress"/>' +
        '</svg>' +
        /* Image clip wrapper */
        '<span class="gallery-fab__carousel-clip">' +
          '<img class="gallery-fab__carousel-img gallery-fab__carousel-img--a" src="" alt="" />' +
          '<img class="gallery-fab__carousel-img gallery-fab__carousel-img--b" src="" alt="" />' +
        '</span>' +
      '</span>';
  } else {
    carouselRing = '<span class="gallery-fab__icon" aria-hidden="true">◫</span>';
  }

  fab.innerHTML =
    carouselRing +
    '<span class="gallery-fab__text">Design Screens</span>' +
    '<span class="gallery-fab__count">' + galleryImages.length + '</span>';

  /* ── BUILD LIGHTBOX ──────────────────────── */
  var overlay = document.createElement('div');
  overlay.className = 'gallery-overlay';
  overlay.setAttribute('role', 'dialog');
  overlay.setAttribute('aria-modal', 'true');
  overlay.setAttribute('aria-label', 'Image gallery');

  overlay.innerHTML = [
    '<div class="gallery-header">',
    '  <div class="gallery-header__left">',
    '    <span class="gallery-header__title">Design Screens</span>',
    '    <span class="gallery-header__count">' + galleryImages.length + ' images</span>',
    '  </div>',
    '  <button class="gallery-header__close" type="button" aria-label="Close gallery">✕</button>',
    '</div>',
    '<div class="gallery-grid-wrap" id="galleryGrid">',
    '  <div class="gallery-grid" id="galleryGridInner"></div>',
    '</div>',
    '<div class="gallery-single" id="gallerySingle">',
    '  <div class="gallery-single__img-wrap">',
    '    <img class="gallery-single__img" id="gallerySingleImg" src="" alt="" />',
    '  </div>',
    '  <div class="gallery-single__footer">',
    '    <button class="gallery-back-btn" type="button" id="galleryBackBtn">← All screens</button>',
    '    <p class="gallery-single__caption" id="gallerySingleCaption"></p>',
    '    <div class="gallery-single__nav">',
    '      <button class="gallery-nav-btn" type="button" id="galleryPrev" aria-label="Previous">←</button>',
    '      <span class="gallery-single__counter" id="galleryCounter"></span>',
    '      <button class="gallery-nav-btn" type="button" id="galleryNext" aria-label="Next">→</button>',
    '    </div>',
    '  </div>',
    '</div>',
  ].join('');

  document.body.appendChild(fab);
  document.body.appendChild(overlay);

  /* ── REFS ────────────────────────────────── */
  var imgA      = fab.querySelector('.gallery-fab__carousel-img--a');
  var imgB      = fab.querySelector('.gallery-fab__carousel-img--b');
  var gridWrap  = document.getElementById('galleryGrid');
  var gridInner = document.getElementById('galleryGridInner');
  var single    = document.getElementById('gallerySingle');
  var singleImg = document.getElementById('gallerySingleImg');
  var singleCap = document.getElementById('gallerySingleCaption');
  var counter   = document.getElementById('galleryCounter');
  var backBtn   = document.getElementById('galleryBackBtn');
  var prevBtn   = document.getElementById('galleryPrev');
  var nextBtn   = document.getElementById('galleryNext');
  var closeBtn  = overlay.querySelector('.gallery-header__close');

  var currentIdx  = 0;
  var isOpen      = false;
  var thumbsBuilt = false;

  /* ── CAROUSEL ENGINE ─────────────────────── */
  var carIdx     = 0;
  var carActive  = 'a';
  var carTimer   = null;
  var carRunning = false;
  var progEl     = document.getElementById('galCarProgress');

  /* Progress ring constants */
  var CIRCUMFERENCE = 2 * Math.PI * 18; /* r=18, ≈ 113.1 */
  var RING_DURATION = 4500;             /* ms for ring to complete one sweep */
  var PAUSE_AFTER   = 800;             /* ms to hold after ring completes */
  var FADE_OUT      = 500;             /* ms fade-out duration */
  var FADE_IN       = 500;             /* ms fade-in duration (matches CSS transition) */
  var TOTAL_CYCLE   = RING_DURATION + PAUSE_AFTER + FADE_OUT + FADE_IN; /* ~6300ms */
  var KEYFRAME_NAME = 'galCarSweep';

  /* Inject @keyframes once into a style tag */
  (function injectKeyframes() {
    var style = document.createElement('style');
    style.textContent =
      '@keyframes ' + KEYFRAME_NAME + ' {' +
        'from { stroke-dashoffset: ' + CIRCUMFERENCE.toFixed(2) + '; }' +
        'to   { stroke-dashoffset: 0; }' +
      '}';
    document.head.appendChild(style);
  }());

  function progStart() {
    if (!progEl) return;
    progEl.style.strokeDasharray  = CIRCUMFERENCE.toFixed(2);
    progEl.style.strokeDashoffset = CIRCUMFERENCE.toFixed(2);
    /* Remove + force reflow + re-add to restart animation */
    progEl.style.animation = 'none';
    progEl.getBoundingClientRect(); /* reflow */
    progEl.style.animation =
      KEYFRAME_NAME + ' ' + RING_DURATION + 'ms linear forwards';
  }

  function progStop() {
    if (!progEl) return;
    progEl.style.animation = 'none';
  }

  function carStart() {
    if (!carouselImages.length || carRunning) return;
    carRunning = true;
    /* First image into slot A immediately */
    if (imgA) {
      imgA.src = carouselImages[0];
      imgA.classList.add('is-front');
    }
    progStart();
    carScheduleNext();
  }

  function carStop() {
    carRunning = false;
    clearTimeout(carTimer);
    progStop();
  }

  /* Schedule next step after full cycle: ring + pause + fades */
  function carScheduleNext() {
    carTimer = setTimeout(carStep, RING_DURATION + PAUSE_AFTER);
  }

  function carStep() {
    if (!carRunning || !carouselImages.length) return;
    var nextIdx = (carIdx + 1) % carouselImages.length;
    var outEl   = carActive === 'a' ? imgA : imgB;
    var inEl    = carActive === 'a' ? imgB : imgA;

    /* Preload next image into back slot */
    inEl.src = carouselImages[nextIdx];

    /* Fade OUT current */
    outEl.classList.remove('is-front');

    /* After fade-out: fade IN new image */
    setTimeout(function () {
      if (!carRunning) return;
      inEl.classList.add('is-front');

      /* After fade-in completes: restart ring and schedule next */
      setTimeout(function () {
        if (!carRunning) return;
        progStart();
        carScheduleNext();
      }, FADE_IN);

    }, FADE_OUT);

    carActive = carActive === 'a' ? 'b' : 'a';
    carIdx    = nextIdx;
  }

  /* Pause when tab not visible */
  document.addEventListener('visibilitychange', function () {
    if (document.hidden) carStop();
    else if (!isOpen) carStart();
  });

  /* ── REVEAL LOGIC ────────────────────────── */
  var revealed  = false;
  var lastY     = 0;
  var idleTimer = null;

  function reveal() {
    if (revealed) return;
    revealed = true;
    lastY    = window.scrollY;
    fab.classList.add('is-visible');
    carStart();
  }

  setTimeout(reveal, 3000);

  function onScroll() {
    var y  = window.scrollY;
    var h  = window.innerHeight;
    var dh = document.documentElement.scrollHeight;

    if (!revealed && y / Math.max(1, dh - h) >= 0.10) reveal();

    if (revealed) {
      if ((y + h) > (dh - 200)) {
        fab.classList.add('is-hidden');
        clearTimeout(idleTimer);
        lastY = y;
        return;
      }
      if (y > lastY + 4) {
        fab.classList.add('is-hidden');
        clearTimeout(idleTimer);
      } else if (y < lastY - 4) {
        fab.classList.remove('is-hidden');
        clearTimeout(idleTimer);
      }
      clearTimeout(idleTimer);
      idleTimer = setTimeout(function () {
        if (window.scrollY > 150) fab.classList.remove('is-hidden');
      }, 800);
      if (y < 150) fab.classList.add('is-hidden');
      lastY = y;
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });

  /* ── LIGHTBOX OPEN / CLOSE ───────────────── */
  function openGallery() {
    isOpen = true;
    carStop();
    overlay.classList.add('is-open');
    document.body.style.overflow = 'hidden';
    showGrid();
    buildGrid();
    setTimeout(function () { closeBtn.focus(); }, 100);
  }

  function closeGallery() {
    isOpen = false;
    overlay.classList.remove('is-open');
    document.body.style.overflow = '';
    carStart();
    fab.focus();
  }

  /* ── GRID VIEW ───────────────────────────── */
  function showGrid() {
    gridWrap.style.display = '';
    single.classList.remove('is-active');
  }

  function buildGrid() {
    if (thumbsBuilt) return;
    thumbsBuilt = true;
    galleryImages.forEach(function (item, idx) {
      var thumb = document.createElement('div');
      thumb.className = 'gallery-thumb';
      thumb.setAttribute('role', 'button');
      thumb.setAttribute('tabindex', '0');
      thumb.setAttribute('aria-label', item.caption || ('Image ' + (idx + 1)));
      thumb.innerHTML =
        '<img class="gallery-thumb__img" src="' + item.src + '" alt="' + (item.caption || '') + '" loading="lazy" />' +
        '<div class="gallery-thumb__overlay">⤢</div>' +
        (item.caption ? '<p class="gallery-thumb__caption">' + item.caption + '</p>' : '');
      gridInner.appendChild(thumb);

      var ti = thumb.querySelector('.gallery-thumb__img');
      function onLoad() {
        setTimeout(function () { thumb.classList.add('is-loaded'); }, idx * 55);
      }
      ti.addEventListener('load', onLoad);
      if (ti.complete) onLoad();

      thumb.addEventListener('click', function () { openSingle(idx); });
      thumb.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openSingle(idx); }
      });
    });
  }

  /* ── SINGLE IMAGE VIEW ───────────────────── */
  function openSingle(idx) {
    currentIdx = idx;
    gridWrap.style.display = 'none';
    single.classList.add('is-active');
    loadSingle(idx);
  }

  function loadSingle(idx) {
    var item = galleryImages[idx];
    singleImg.classList.remove('is-ready');
    singleImg.src = '';
    singleCap.textContent = item.caption || '';
    counter.textContent   = (idx + 1) + ' / ' + galleryImages.length;
    prevBtn.disabled      = idx === 0;
    nextBtn.disabled      = idx === galleryImages.length - 1;
    var tmp = new Image();
    tmp.onload = function () {
      singleImg.src = item.src;
      singleImg.alt = item.caption || '';
      requestAnimationFrame(function () {
        requestAnimationFrame(function () {
          singleImg.classList.add('is-ready');
        });
      });
    };
    tmp.src = item.src;
  }

  function goTo(idx) {
    if (idx < 0 || idx >= galleryImages.length) return;
    currentIdx = idx;
    loadSingle(idx);
  }

  /* ── EVENTS ──────────────────────────────── */
  fab.addEventListener('click', openGallery);
  closeBtn.addEventListener('click', closeGallery);
  prevBtn.addEventListener('click', function () { goTo(currentIdx - 1); });
  nextBtn.addEventListener('click', function () { goTo(currentIdx + 1); });
  backBtn.addEventListener('click', showGrid);

  overlay.addEventListener('click', function (e) {
    if (e.target === overlay) closeGallery();
  });

  document.addEventListener('keydown', function (e) {
    if (!isOpen) return;
    if (e.key === 'Escape')      closeGallery();
    if (e.key === 'ArrowLeft'  && single.classList.contains('is-active')) goTo(currentIdx - 1);
    if (e.key === 'ArrowRight' && single.classList.contains('is-active')) goTo(currentIdx + 1);
  });

  /* Touch swipe */
  var txStart = 0;
  overlay.addEventListener('touchstart', function (e) {
    txStart = e.changedTouches[0].clientX;
  }, { passive: true });
  overlay.addEventListener('touchend', function (e) {
    if (!single.classList.contains('is-active')) return;
    var dx = e.changedTouches[0].clientX - txStart;
    if (Math.abs(dx) > 50) { dx < 0 ? goTo(currentIdx + 1) : goTo(currentIdx - 1); }
  }, { passive: true });

})();