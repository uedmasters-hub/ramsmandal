/* =========================================================================
   core/cursor.js — the site-wide "Click" cursor.
   Over any interactive element the native cursor is replaced by a small accent
   disc that springs in. Label defaults to "Click"; override per element with
   data-cursor="Open" etc. Opt out with data-no-cursor.
   Additive only: elements stay fully keyboard- and pointer-operable.
   Gated to (hover:hover)+(pointer:fine) and prefers-reduced-motion:no-preference.
   No imports; loaded with defer. Reuses existing tokens (--blue, --ease-spring).
   ========================================================================= */
(function () {
  'use strict';

  if (!matchMedia('(hover: hover) and (pointer: fine)').matches) return;
  if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var SEL = 'a[href], button:not([disabled]), [role="button"], summary, label[for], [data-cursor]';

  var el = document.createElement('div');
  el.className = 'site-cursor';
  el.setAttribute('aria-hidden', 'true');
  el.innerHTML = '<span class="site-cursor__dot"><span class="site-cursor__label">Click</span></span>';
  var label = el.querySelector('.site-cursor__label');

  function init() {
    document.body.appendChild(el);
    document.body.classList.add('has-site-cursor');
  }
  if (document.body) init();
  else document.addEventListener('DOMContentLoaded', init);

  function place(e) {
    el.style.transform = 'translate(' + e.clientX + 'px,' + e.clientY + 'px)';
  }

  document.addEventListener('pointermove', function (e) {
    if (e.pointerType && e.pointerType !== 'mouse') return;
    place(e);
  }, { passive: true });

  document.addEventListener('pointerover', function (e) {
    if (e.pointerType && e.pointerType !== 'mouse') return;
    var t = e.target.closest ? e.target.closest(SEL) : null;
    if (t && !t.hasAttribute('data-no-cursor')) {
      label.textContent = t.getAttribute('data-cursor') || 'Click';
      place(e);
      el.classList.add('is-on');
    }
  }, { passive: true });

  document.addEventListener('pointerout', function (e) {
    if (e.pointerType && e.pointerType !== 'mouse') return;
    var to = (e.relatedTarget && e.relatedTarget.closest) ? e.relatedTarget.closest(SEL) : null;
    if (!to || to.hasAttribute('data-no-cursor')) el.classList.remove('is-on');
  }, { passive: true });

  // hide when the pointer leaves the document or the window loses focus
  document.addEventListener('pointerleave', function () { el.classList.remove('is-on'); });
  window.addEventListener('blur', function () { el.classList.remove('is-on'); });
})();
