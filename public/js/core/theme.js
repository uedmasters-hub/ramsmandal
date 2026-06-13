/* core/theme.js — light/dark toggle, persisted, system-aware */
(function () {
  "use strict";
  var root = document.documentElement;
  var btn = document.querySelector("[data-theme-toggle]");
  if (!btn) return;
  try { var s = localStorage.getItem("rm-theme"); if (s === "light" || s === "dark") root.setAttribute("data-theme", s); } catch (e) {}
  btn.addEventListener("click", function () {
    var cur = root.getAttribute("data-theme") || (matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
    var next = cur === "dark" ? "light" : "dark";
    root.setAttribute("data-theme", next);
    try { localStorage.setItem("rm-theme", next); } catch (e) {}
  });
})();
