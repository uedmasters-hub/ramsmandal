/* =========================================================================
   core/theme.js — light/dark toggle. Persisted, system-aware, no flash.

   The pre-paint apply lives in the inline guard in base.php (so there is no
   flash before this deferred file runs). This module owns the rest:
     - keeps <meta name="theme-color"> in sync
     - reflects the resolved theme on the toggle button (aria-pressed)
     - wires the toggle (binary: flips the *resolved* theme)
     - follows OS changes while the visitor has made no explicit choice
   ========================================================================= */
(function () {
  "use strict";

  var KEY  = "rm-theme";
  var root = document.documentElement;
  var mq   = window.matchMedia ? matchMedia("(prefers-color-scheme: dark)") : null;

  function stored() {
    try { var v = localStorage.getItem(KEY); return (v === "light" || v === "dark") ? v : null; }
    catch (e) { return null; }
  }

  /* The theme actually showing right now. */
  function resolved() {
    return stored() || (mq && mq.matches ? "dark" : "light");
  }

  function syncMeta(theme) {
    var m = document.getElementById("theme-color-meta");
    if (m) m.content = theme === "dark" ? "#0e0e0d" : "#f5f5f3";
  }

  function syncButtons(theme) {
    var btns = document.querySelectorAll("[data-theme-toggle]");
    for (var i = 0; i < btns.length; i++) {
      btns[i].setAttribute("aria-pressed", String(theme === "dark"));
    }
  }

  function apply(theme, persist) {
    if (theme === "light" || theme === "dark") {
      root.setAttribute("data-theme", theme);
      if (persist) { try { localStorage.setItem(KEY, theme); } catch (e) {} }
    } else {
      root.removeAttribute("data-theme");          /* back to following the OS */
      if (persist) { try { localStorage.removeItem(KEY); } catch (e) {} }
    }
    var r = resolved();
    syncMeta(r);
    syncButtons(r);
  }

  /* Reflect current state immediately (the inline guard already set the attr). */
  apply(stored(), false);

  function wire() {
    var btns = document.querySelectorAll("[data-theme-toggle]");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function () {
        apply(resolved() === "dark" ? "light" : "dark", true);
      });
    }
  }
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", wire);
  } else {
    wire();
  }

  /* Follow the OS only while the visitor has made no explicit choice. */
  if (mq) {
    var onChange = function () { if (!stored()) apply(null, false); };
    if (mq.addEventListener) mq.addEventListener("change", onChange);
    else if (mq.addListener) mq.addListener(onChange);
  }
})();
