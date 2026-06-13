/* =========================================
   CURSOR.JS
   ========================================= */
(function () {
  "use strict";

  /* Skip touch devices */
  if (window.matchMedia("(hover: none)").matches) return;

  var dot  = document.createElement("div");
  var ring = document.createElement("div");

  /* Absolute minimal inline styles — no classes, no CSS file */
  dot.style.cssText = [
    "position:fixed",
    "width:14px",
    "height:14px",
    "background:#000000",
    "border-radius:50%",
    "pointer-events:none",
    "z-index:999999",
    "top:0",
    "left:0",
    "transform:translate(-50%,-50%)",
    "opacity:1",
    "display:block",
  ].join(";");

  ring.style.cssText = [
    "position:fixed",
    "width:42px",
    "height:42px",
    "border:2.5px solid #000000",
    "border-radius:50%",
    "pointer-events:none",
    "z-index:999998",
    "top:0",
    "left:0",
    "transform:translate(-50%,-50%)",
    "opacity:0.7",
    "display:block",
    "background:transparent",
  ].join(";");

  document.body.appendChild(ring);
  document.body.appendChild(dot);

  /* Kill native cursor */
  document.head.insertAdjacentHTML("beforeend",
    "<style>*{cursor:none!important}</style>"
  );

  var mx = -300, my = -300;
  var rx = -300, ry = -300;
  var going = false;

  function loop() {
    rx += (mx - rx) * 0.13;
    ry += (my - ry) * 0.13;
    dot.style.left  = mx + "px";
    dot.style.top   = my + "px";
    ring.style.left = Math.round(rx) + "px";
    ring.style.top  = Math.round(ry) + "px";
    requestAnimationFrame(loop);
  }

  window.addEventListener("mousemove", function (e) {
    mx = e.clientX;
    my = e.clientY;
    if (!going) { going = true; loop(); }
  }, { passive: true });

  window.addEventListener("mouseleave", function () {
    dot.style.opacity  = "0";
    ring.style.opacity = "0";
  });

  window.addEventListener("mouseenter", function () {
    dot.style.opacity  = "1";
    ring.style.opacity = "0.7";
  });

  /* Hover state */
  document.addEventListener("mouseover", function (e) {
    var el = e.target;
    var hoverable = el && el.closest &&
      (el.closest("a") || el.closest("button") || el.closest(".chip") ||
       el.closest(".bento-card") || el.closest(".blog-card") ||
       el.closest(".audit-card") || el.closest(".stat-card"));

    if (hoverable) {
      dot.style.background    = "#1a46c9";
      dot.style.width         = "16px";
      dot.style.height        = "16px";
      ring.style.borderColor  = "rgba(26,70,201,0.6)";
      ring.style.width        = "56px";
      ring.style.height       = "56px";
    } else {
      dot.style.background    = "#000000";
      dot.style.width         = "14px";
      dot.style.height        = "14px";
      ring.style.borderColor  = "#000000";
      ring.style.width        = "42px";
      ring.style.height       = "42px";
    }
  }, { passive: true });

  document.addEventListener("mousedown", function () {
    dot.style.width  = "8px";
    dot.style.height = "8px";
    dot.style.background = "#1a46c9";
  });

  document.addEventListener("mouseup", function () {
    dot.style.width  = "14px";
    dot.style.height = "14px";
  });

})();