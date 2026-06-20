/* =========================================================================
   work-tiles.js — magic on the Work grid.
   - hover / tap a tile  -> the card bursts into colourful dots (hero language:
                            hsl(hue,70%,56%), 1.3–4.7px) and the cursor becomes
                            a "Click" disc.
   - click a tile        -> a dot burst from the pointer + a veil fade hands off
                            to the project page.
   Narrative purpose: anticipate (hover) + transition (click).
   Gated: bursts/cursor only on (hover:hover)+(pointer:fine)+no reduced-motion.
   Keyboard activation is never animated. No imports; loaded with defer.
   ========================================================================= */
(function () {
  'use strict';

  var tiles = Array.prototype.slice.call(document.querySelectorAll('.work-tile'));
  if (!tiles.length) return;

  var reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  var fine   = matchMedia('(hover: hover) and (pointer: fine)').matches;

  /* ---------- shared FX canvas ---------- */
  var cv  = document.createElement('canvas');
  cv.className = 'tile-fx';
  document.body.appendChild(cv);
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, dpr = 1;

  function size() {
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    W = window.innerWidth; H = window.innerHeight;
    cv.width = W * dpr; cv.height = H * dpr;
    cv.style.width = W + 'px'; cv.style.height = H + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }
  size();
  window.addEventListener('resize', size, { passive: true });

  /* ---------- particle pool ---------- */
  var P = [], raf = 0, navigating = false;

  function emit(x, y, n, spread, speed, o) {
    o = o || {};
    for (var i = 0; i < n; i++) {
      var a = Math.random() * Math.PI * 2;
      var v = speed * (0.3 + Math.random() * 0.7);
      P.push({
        x: x + (Math.random() - 0.5) * spread,
        y: y + (Math.random() - 0.5) * spread,
        vx: Math.cos(a) * v,
        vy: Math.sin(a) * v - (o.lift || 0),
        r: 1.3 + Math.random() * 3.4,            // hero dot size
        hue: Math.random() * 360,                // hero full-spectrum
        life: 1,
        decay: o.decay || (0.013 + Math.random() * 0.02),
        grav: o.grav != null ? o.grav : 0.03,
        drag: o.drag || 0.96
      });
    }
    if (!raf) raf = requestAnimationFrame(tick);
  }

  /* burst from points spread across a card's surface */
  function cardBurst(tile, n) {
    var r = tile.getBoundingClientRect();
    for (var i = 0; i < n; i++) {
      emit(r.left + Math.random() * r.width, r.top + Math.random() * r.height,
           1, 0, 2.4, { grav: 0.02 });
    }
  }

  function tick() {
    ctx.clearRect(0, 0, W, H);
    for (var i = P.length - 1; i >= 0; i--) {
      var p = P[i];
      p.vx *= p.drag;
      p.vy = p.vy * p.drag + p.grav;
      p.x += p.vx; p.y += p.vy;
      p.life -= p.decay;
      if (p.life <= 0) { P.splice(i, 1); continue; }
      ctx.globalAlpha = Math.max(0, p.life) * 0.9;
      ctx.fillStyle = 'hsl(' + p.hue + ', 70%, 56%)';
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r * (0.4 + p.life * 0.8), 0, 6.2832);
      ctx.fill();
    }
    ctx.globalAlpha = 1;
    if (P.length) { raf = requestAnimationFrame(tick); }
    else { raf = 0; ctx.clearRect(0, 0, W, H); }
  }

  /* ---------- custom "Click" cursor (fine + motion only) ---------- */
  var cursor = null;
  if (fine && !reduce) {
    document.body.classList.add('tiles-fx');
    cursor = document.createElement('div');
    cursor.className = 'tile-cursor';
    cursor.innerHTML = '<span class="tile-cursor__dot"><span>Click</span></span>';
    document.body.appendChild(cursor);
  }
  function placeCursor(x, y) {
    if (cursor) cursor.style.transform = 'translate(' + x + 'px,' + y + 'px)';
  }

  /* ---------- hover wiring ---------- */
  if (fine && !reduce) {
    tiles.forEach(function (tile) {
      tile.addEventListener('pointerenter', function (e) {
        if (e.pointerType !== 'mouse') return;
        if (cursor) { cursor.classList.add('is-on'); placeCursor(e.clientX, e.clientY); }
        cardBurst(tile, 64);                       // the explosion
      });
      tile.addEventListener('pointermove', function (e) {
        if (e.pointerType !== 'mouse') return;
        placeCursor(e.clientX, e.clientY);
        if (Math.random() < 0.22) emit(e.clientX, e.clientY, 1, 6, 1.6, { grav: 0.01, decay: 0.03 });
      });
      tile.addEventListener('pointerleave', function (e) {
        if (e.pointerType !== 'mouse') return;
        if (cursor) cursor.classList.remove('is-on');
      });
    });
  }

  /* ---------- click -> warp transition ---------- */
  function warp(href, x, y) {
    if (navigating) return;
    navigating = true;
    if (cursor) cursor.classList.remove('is-on');
    emit(x, y, 140, 8, 7, { grav: 0, drag: 0.99, decay: 0.01 });   // big burst
    var veil = document.createElement('div');
    veil.className = 'tile-warp';
    document.body.appendChild(veil);
    requestAnimationFrame(function () { veil.classList.add('is-on'); });
    setTimeout(function () { window.location.href = href; }, 520);
  }

  tiles.forEach(function (tile) {
    tile.addEventListener('click', function (e) {
      if (e.defaultPrevented || navigating) return;
      // let keyboard activation (detail 0), modified clicks and middle-click pass through
      if (e.detail === 0 || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
      var href = tile.getAttribute('href');
      if (!href) return;
      if (reduce) return;                          // reduced motion: normal navigation
      e.preventDefault();
      var r = tile.getBoundingClientRect();
      var x = e.clientX || (r.left + r.width / 2);
      var y = e.clientY || (r.top + r.height / 2);
      if (!fine) cardBurst(tile, 64);              // touch: explode the card first
      warp(href, x, y);
    });
  });

  /* a fresh page should not inherit a frozen veil on bfcache restore */
  window.addEventListener('pageshow', function (e) {
    if (e.persisted) {
      navigating = false;
      var v = document.querySelector('.tile-warp');
      if (v) v.remove();
    }
  });
})();
