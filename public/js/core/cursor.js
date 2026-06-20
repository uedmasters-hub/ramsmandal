/* =========================================================================
   core/cursor.js — the site-wide adaptive cursor disc.
   Content adapts to context, resolved from the nearest tagged element/section:
     data-cursor="RM" / "Work" / "Audit"  -> that text
     data-cursor-icon                      -> clone the element's visible <svg>
     data-cursor-icon="menu"               -> built-in glyph
     (nothing tagged)                      -> "Click"
   Additive, keyboard-safe. Gated to (hover:hover)+(pointer:fine)+no-preference.
   ========================================================================= */
(function () {
  'use strict';

  if (!matchMedia('(hover: hover) and (pointer: fine)').matches) return;
  if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var SEL  = 'a[href], button:not([disabled]), [role="button"], summary, label[for], [data-cursor], [data-cursor-icon]';
  var TAGGED = '[data-cursor], [data-cursor-icon]';

  var GLYPH = {
    menu: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>'
  };

  var el = document.createElement('div');
  el.className = 'site-cursor';
  el.setAttribute('aria-hidden', 'true');
  el.innerHTML = '<span class="site-cursor__dot">' +
                   '<span class="site-cursor__label">Click</span>' +
                   '<span class="site-cursor__icon"></span>' +
                 '</span>';
  var dot   = el.querySelector('.site-cursor__dot');
  var label = el.querySelector('.site-cursor__label');
  var icon  = el.querySelector('.site-cursor__icon');

  function init() {
    document.body.appendChild(el);
    document.body.classList.add('has-site-cursor');

    // refraction filter — bends the backdrop through the disc (the "liquid" in liquid glass)
    var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute('width', '0'); svg.setAttribute('height', '0');
    svg.setAttribute('aria-hidden', 'true');
    svg.style.cssText = 'position:absolute;width:0;height:0;pointer-events:none';
    svg.innerHTML =
      '<defs><filter id="liquidGlass" x="-35%" y="-35%" width="170%" height="170%" color-interpolation-filters="sRGB">' +
        '<feTurbulence type="fractalNoise" baseFrequency="0.011 0.013" numOctaves="2" seed="4" result="n"/>' +
        '<feGaussianBlur in="n" stdDeviation="1.1" result="b"/>' +
        '<feDisplacementMap in="SourceGraphic" in2="b" scale="48" xChannelSelector="R" yChannelSelector="G"/>' +
      '</filter></defs>';
    document.body.appendChild(svg);
  }
  if (document.body) init();
  else document.addEventListener('DOMContentLoaded', init);

  function place(e) { el.style.transform = 'translate(' + e.clientX + 'px,' + e.clientY + 'px)'; }

  function visibleSvg(node) {
    var svgs = node.querySelectorAll('svg');
    for (var i = 0; i < svgs.length; i++) {
      if (svgs[i].getClientRects().length) return svgs[i];
    }
    return svgs[0] || null;
  }

  function setIcon(html) { icon.innerHTML = html; dot.classList.add('is-icon'); }
  function setText(txt)  { label.textContent = txt; dot.classList.remove('is-icon'); }

  function resolve(target) {
    var src = target.closest(TAGGED);
    if (src && src.hasAttribute('data-cursor-icon')) {
      var kind = src.getAttribute('data-cursor-icon');
      if (kind && GLYPH[kind]) { setIcon(GLYPH[kind]); return; }
      var svg = visibleSvg(src);
      if (svg) { setIcon(svg.outerHTML); return; }
      setText(src.getAttribute('data-cursor') || 'Click');
      return;
    }
    if (src && src.hasAttribute('data-cursor')) { setText(src.getAttribute('data-cursor')); return; }
    setText('Click');
  }

  document.addEventListener('pointermove', function (e) {
    if (e.pointerType && e.pointerType !== 'mouse') return;
    place(e);
  }, { passive: true });

  document.addEventListener('pointerover', function (e) {
    if (e.pointerType && e.pointerType !== 'mouse') return;
    var t = e.target.closest ? e.target.closest(SEL) : null;
    if (t && !t.hasAttribute('data-no-cursor')) {
      resolve(t);
      place(e);
      el.classList.add('is-on');
    }
  }, { passive: true });

  document.addEventListener('pointerout', function (e) {
    if (e.pointerType && e.pointerType !== 'mouse') return;
    var to = (e.relatedTarget && e.relatedTarget.closest) ? e.relatedTarget.closest(SEL) : null;
    if (!to || to.hasAttribute('data-no-cursor')) el.classList.remove('is-on');
  }, { passive: true });

  document.addEventListener('pointerleave', function () { el.classList.remove('is-on'); });
  window.addEventListener('blur', function () { el.classList.remove('is-on'); });
})();
