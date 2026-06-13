/* core/reveal.js — entrance: adds .is-ready to <html> after fonts settle */
(function () {
  "use strict";
  var root = document.documentElement;
  var reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
  function ready() { requestAnimationFrame(function () { root.classList.add("is-ready"); }); }
  if (reduce) ready();
  else if (document.fonts && document.fonts.ready) document.fonts.ready.then(ready);
  else window.addEventListener("load", ready);
  setTimeout(ready, 600);
})();
