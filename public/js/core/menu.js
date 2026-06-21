/* core/menu.js — origin-aware menu: the panel opens from the trigger's actual
   position (full bar top-right, or the compact pill), focus-trapped, Esc + scrim close. */
(function () {
  "use strict";
  var body = document.body;
  var reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
  var trigger = document.querySelector("[data-menu-trigger]");
  var panel = document.getElementById("site-menu");
  var scrim = document.querySelector("[data-menu-close]");
  if (!trigger || !panel) return;
  var links = panel.querySelectorAll("a[href]"), first = links[0], last = links[links.length - 1], open = false;

  // anchor the panel just below the trigger, on whichever side has room
  function positionPanel() {
    if (window.innerWidth <= 560) {           // phones: let CSS centre it
      ["top", "left", "right", "transform-origin"].forEach(function (k) { panel.style.removeProperty(k); });
      return;
    }
    var r = trigger.getBoundingClientRect();
    var margin = 12, gap = 12;
    var pw = Math.min(360, window.innerWidth - 32);
    var left = r.right - pw, origin = "top right";   // align panel's right edge to the button
    if (left < margin) { left = r.left; origin = "top left"; }  // no room left -> open rightward
    left = Math.max(margin, Math.min(left, window.innerWidth - pw - margin));
    panel.style.setProperty("top", (r.bottom + gap) + "px", "important");
    panel.style.setProperty("left", left + "px", "important");
    panel.style.setProperty("right", "auto", "important");
    panel.style.setProperty("transform-origin", origin, "important");
  }

  function setOpen(state) {
    open = state;
    if (state) positionPanel();
    body.classList.toggle("menu-open", state);
    trigger.setAttribute("aria-expanded", String(state));
    trigger.setAttribute("aria-label", state ? "Close menu" : "Open menu");
    if (state) { if (scrim) scrim.hidden = false; panel.removeAttribute("inert"); if (first) first.focus({ preventScroll: true }); }
    else { panel.setAttribute("inert", ""); trigger.focus({ preventScroll: true });
      setTimeout(function () { if (!open && scrim) scrim.hidden = true; }, reduce ? 0 : 320); }
  }
  trigger.addEventListener("click", function () { setOpen(!open); });
  if (scrim) scrim.addEventListener("click", function () { setOpen(false); });
  panel.addEventListener("click", function (e) { if (e.target.closest("a[href]")) setOpen(false); });
  window.addEventListener("resize", function () { if (open) positionPanel(); });
  window.addEventListener("scroll", function () { if (open) positionPanel(); }, { passive: true });
  document.addEventListener("keydown", function (e) {
    if (!open) return;
    if (e.key === "Escape") { setOpen(false); return; }
    if (e.key === "Tab") {
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    }
  });
})();
