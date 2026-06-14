/* core/text-ink.js — "rainfall on water" headline ink.
 *
 * The dot field is ambient. Occasionally (rate-limited, never per-collision) a
 * single floating dot becomes a drop that lands on a headline letter. Its colour
 * blooms outward from the exact contact point and spreads through the glyph over
 * ~1.5s with a soft, eased edge — like a droplet rippling on water. Multiple drops
 * on one letter coexist as layered blooms from their own origins. When the field
 * reforms (the reader moves / scrolls) the blooms drain and the type returns to
 * clean black. Typography stays primary; this is a living layer around it.
 */
import { dotField } from "./dot-field.js";

const SELECTOR   = ".he-headline";   // headlines to make reactive
const BURST_GATE = 0.45;             // only paint once the field is genuinely floating
const RECEDE_AT  = 0.25;             // below this, blooms drain back out
const GROW       = 0.055;            // bloom spread speed (lower = slower, more organic)
const DROP_MIN   = 900;              // ms — min gap between drops (calm rainfall)
const DROP_MAX   = 2200;             // ms — max gap between drops
const MAX_ACTIVE = 8;                // cap simultaneously-painted letters (keeps it readable)
const MAX_BLOOMS = 4;                // cap blooms per letter
const SAMPLE     = 44;               // dots sampled per drop attempt

function init() {
  if (matchMedia("(prefers-reduced-motion: reduce)").matches) return;
  const field = dotField();
  if (!field || !field.canvas) return;

  const heads = [...document.querySelectorAll(SELECTOR)];
  if (!heads.length) return;

  // --- wrap every letter once, preserving nested markup (e.g. .kw-accent) ---
  const letters = [];
  for (const h of heads) {
    const stage = h.closest(".he-stage") || h;
    wrapLetters(h, (span, baseColor) => letters.push({
      el: span, stage, base: baseColor, blooms: [],
    }));
  }
  if (!letters.length) return;

  const active = new Set();           // letters currently carrying blooms
  let lastDrop = 0, gap = DROP_MIN;

  function frame(now) {
    requestAnimationFrame(frame);
    const burst = field.burst;
    const spreading = burst > RECEDE_AT;

    // grow / recede existing blooms and repaint
    for (const L of [...active]) {
      for (const b of L.blooms) {
        const target = spreading ? b.max : 0;
        b.r += (target - b.r) * GROW;
      }
      if (!spreading) L.blooms = L.blooms.filter((b) => b.r > 1.2);
      if (L.blooms.length) paint(L);
      else { clear(L); active.delete(L); }
    }

    // occasionally let one dot become a drop
    if (spreading && burst > BURST_GATE && now - lastDrop > gap && active.size < MAX_ACTIVE) {
      if (tryDrop(field, letters, active)) {
        lastDrop = now;
        gap = DROP_MIN + Math.random() * (DROP_MAX - DROP_MIN);
      }
    }
  }
  requestAnimationFrame(frame);
}

/* find a floating dot sitting over a visible letter and bloom it */
function tryDrop(field, letters, active) {
  const stage = activeStage(letters);                  // the headline currently on screen
  if (!stage) return false;
  const pool = letters.filter((L) => L.stage === stage);
  if (!pool.length) return false;

  // cache rects for this attempt
  for (const L of pool) L._rect = L.el.getBoundingClientRect();

  const dots = field.dots, n = dots.length;
  for (let k = 0; k < SAMPLE; k++) {
    const d = dots[(Math.random() * n) | 0];
    for (const L of pool) {
      const r = L._rect;
      if (r.width < 1) continue;
      if (d.x >= r.left && d.x <= r.right && d.y >= r.top && d.y <= r.bottom) {
        if (L.blooms.length >= MAX_BLOOMS) L.blooms.shift();
        const diag = Math.hypot(r.width, r.height);
        L.blooms.push({
          color: `hsl(${d.hue | 0}, 60%, 46%)`,        // deeper than the floating dot — legible as type
          ox: (d.x - r.left) / r.width,
          oy: (d.y - r.top) / r.height,
          r: 0, max: diag * 1.25,
        });
        active.add(L);
        return true;
      }
    }
  }
  return false;
}

/* the .he-stage whose headline is currently most visible */
function activeStage(letters) {
  let best = null, bestO = 0.5;
  const seen = new Set();
  for (const L of letters) {
    if (seen.has(L.stage)) continue;
    seen.add(L.stage);
    const o = parseFloat(getComputedStyle(L.stage).opacity) || 0;
    if (o > bestO) { bestO = o; best = L.stage; }
  }
  return best;
}

/* compose a letter's fill: layered radial blooms over its base colour */
function paint(L) {
  const layers = L.blooms.map((b) => {
    const inner = Math.max(0, b.r * 0.82).toFixed(1);
    const outer = Math.max(0.6, b.r).toFixed(1);
    return `radial-gradient(circle at ${(b.ox * 100).toFixed(1)}% ${(b.oy * 100).toFixed(1)}%, ` +
           `${b.color} 0, ${b.color} ${inner}px, transparent ${outer}px)`;
  });
  // newest bloom on top (first in the CSS background list)
  layers.reverse();
  const s = L.el.style;
  s.backgroundImage = layers.join(",") + `, linear-gradient(${L.base}, ${L.base})`;
  s.webkitBackgroundClip = "text";
  s.backgroundClip = "text";
  s.color = "transparent";
}

/* revert a letter to clean DOM type */
function clear(L) {
  const s = L.el.style;
  s.backgroundImage = "";
  s.webkitBackgroundClip = "";
  s.backgroundClip = "";
  s.color = "";
}

/* wrap each character of an element (recursing into child elements) in a span */
function wrapLetters(node, push) {
  const kids = [...node.childNodes];
  for (const k of kids) {
    if (k.nodeType === Node.TEXT_NODE) {
      const text = k.nodeValue;
      if (!text) continue;
      const baseColor = getComputedStyle(node).color;
      const frag = document.createDocumentFragment();
      for (const ch of text) {
        if (ch === " " || ch === "\n" || ch === "\t") { frag.appendChild(document.createTextNode(ch)); continue; }
        const span = document.createElement("span");
        span.className = "ink-letter";
        span.textContent = ch;
        push(span, baseColor);
        frag.appendChild(span);
      }
      node.replaceChild(frag, k);
    } else if (k.nodeType === Node.ELEMENT_NODE) {
      wrapLetters(k, push);                              // e.g. .kw-accent keeps its own colour
    }
  }
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", init, { once: true });
} else {
  init();
}
