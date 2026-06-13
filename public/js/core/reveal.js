/* core/reveal.js — hero entrance (.is-ready) + scroll reveals ([data-reveal] → .in-view) */
(function () {
  "use strict";
  var root = document.documentElement;
  var reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;

  function ready() { requestAnimationFrame(function () { root.classList.add("is-ready"); }); }
  if (reduce) ready();
  else if (document.fonts && document.fonts.ready) document.fonts.ready.then(ready);
  else window.addEventListener("load", ready);
  setTimeout(ready, 600);

  var els = document.querySelectorAll("[data-reveal]");
  if (!els.length) return;
  if (reduce || !("IntersectionObserver" in window)) {
    els.forEach(function (el) { el.classList.add("in-view"); });
    return;
  }
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (en) {
      if (en.isIntersecting) { en.target.classList.add("in-view"); io.unobserve(en.target); }
    });
  }, { rootMargin: "0px 0px -10% 0px", threshold: 0.12 });
  els.forEach(function (el) { io.observe(el); });
})();
