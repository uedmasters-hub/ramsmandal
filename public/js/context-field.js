/* =========================================================================
   context-field.js — contextual floating elements around the dot device.
   A separate decorative layer of concept chips (Research, Constraint, ...)
   that drift in the MARGINS only. Count scales with the device state:
   phone 3-5, tablet 8-10, laptop 15-20, full 30-50. Chips are placed by
   rejection sampling OUTSIDE the device silhouette + headline bounds, so they
   never overlap either. Does not modify existing sections or choreography.
   ========================================================================= */

import { gsap, ScrollTrigger } from "./core/smooth-scroll.js";

const CONCEPTS = ["Research", "Constraint", "Decision", "User Need", "Flow",
                  "Architecture", "Design System", "Strategy", "Leadership", "Impact"];
const RANGES   = [[3, 5], [8, 10], [15, 20], [30, 50]];      // phone, tablet, laptop, full
const DEV_DIMS = [[0.30, 0.62], [0.62, 0.46], [0.66, 0.42]]; // ×viewport-height (matches dot field)
const SIZES    = [11, 11, 12, 12, 12, 13, 14];

let layers = [];
let wired  = false;

const rand = (a, b) => a + Math.random() * (b - a);
function shuffle(a) { for (let i = a.length - 1; i > 0; i--) { const j = (Math.random() * (i + 1)) | 0; [a[i], a[j]] = [a[j], a[i]]; } return a; }

function rectPct(left, top, right, bottom) {
  return { x0: left / innerWidth * 100, y0: top / innerHeight * 100,
           x1: right / innerWidth * 100, y1: bottom / innerHeight * 100 };
}
function deviceRect(si) {                       // null for spread (no silhouette)
  if (si === 3) return null;
  const W = innerWidth, H = innerHeight, cx = W / 2, cy = H * 0.46;
  const w = DEV_DIMS[si][0] * H, h = DEV_DIMS[si][1] * H;
  return rectPct(cx - w / 2, cy - h / 2, cx + w / 2, cy + h / 2);
}
function contentRect(stageEl) {
  let x0 = 1e9, y0 = 1e9, x1 = -1e9, y1 = -1e9, found = false;
  for (const k of stageEl.children) {
    const r = k.getBoundingClientRect();
    if (r.width === 0 && r.height === 0) continue;
    found = true;
    x0 = Math.min(x0, r.left); y0 = Math.min(y0, r.top);
    x1 = Math.max(x1, r.right); y1 = Math.max(y1, r.bottom);
  }
  return found ? rectPct(x0, y0, x1, y1) : null;
}
function safeZone(si, stageEl) {
  const a = contentRect(stageEl), b = deviceRect(si);
  let z = a || b;
  if (a && b) z = { x0: Math.min(a.x0, b.x0), y0: Math.min(a.y0, b.y0),
                    x1: Math.max(a.x1, b.x1), y1: Math.max(a.y1, b.y1) };
  if (!z) return null;
  const m = 5;                                  // breathing margin around the safe zone
  return { x0: z.x0 - m, y0: z.y0 - m, x1: z.x1 + m, y1: z.y1 + m };
}

function placeChips(si, stageEl, target) {
  const safe = safeZone(si, stageEl);
  const minDist = Math.max(5.5, 15 - target * 0.22);
  const pts = []; let tries = 0; const maxTries = target * 80;
  while (pts.length < target && tries < maxTries) {
    tries++;
    const x = rand(5, 95), y = rand(13, 90);    // 13% top clears the header zone
    if (safe && x > safe.x0 && x < safe.x1 && y > safe.y0 && y < safe.y1) continue;
    let ok = true;
    for (const p of pts) if (Math.hypot(p.x - x, p.y - y) < minDist) { ok = false; break; }
    if (ok) pts.push({ x, y });
  }
  return pts;                                    // may be fewer than target on small screens (space-limited = no overlap)
}

function labelsFor(n) {
  const pool = shuffle([...CONCEPTS]); const out = [];
  for (let i = 0; i < n; i++) { if (i % pool.length === 0 && i) shuffle(pool); out.push(pool[i % pool.length]); }
  return out;
}
function makeChip(label, p, i) {
  const el = document.createElement("span");
  el.className = "cf-chip";
  el.textContent = label;
  el.style.setProperty("--x", p.x + "%");
  el.style.setProperty("--y", p.y + "%");
  el.style.setProperty("--i", i);
  el.style.setProperty("--cf-size", SIZES[(Math.random() * SIZES.length) | 0] + "px");
  el.style.setProperty("--cf-dur", (6 + Math.random() * 5).toFixed(2) + "s");
  el.style.setProperty("--cf-delay", (Math.random() * 3).toFixed(2) + "s");
  return el;
}

function build() {
  const root = document.getElementById("home-experience");
  if (!root) return [];
  const pin = root.querySelector(".he-pin");
  const stages = [...root.querySelectorAll(".he-stage")];
  if (!pin || !stages.length) return [];

  pin.querySelectorAll(".context-field").forEach((n) => n.remove());
  const field = document.createElement("div");
  field.className = "context-field";
  const out = [];
  stages.forEach((stEl, si) => {
    const layer = document.createElement("div");
    layer.className = "cf-layer";
    const target = Math.round(rand(RANGES[si][0], RANGES[si][1]));
    const pts = placeChips(si, stEl, target);
    const labels = labelsFor(pts.length);
    pts.forEach((p, i) => layer.appendChild(makeChip(labels[i], p, i)));
    field.appendChild(layer);
    out.push(layer);
  });
  pin.appendChild(field);
  out[0] && out[0].classList.add("is-on");
  return out;
}

function setActive(idx) { layers.forEach((l, i) => l.classList.toggle("is-on", i === idx)); }

function wire() {
  if (wired) return; wired = true;
  const pin = document.querySelector("#home-experience .he-pin");
  if (!pin) return;
  const mm = gsap.matchMedia();
  const make = (mult) => ScrollTrigger.create({
    trigger: pin, start: "top top", end: () => "+=" + (4 * mult) + "%", scrub: true,
    onUpdate: (s) => { const p = s.progress; setActive(p < 0.25 ? 0 : p < 0.5 ? 1 : p < 0.75 ? 2 : 3); },
  });
  mm.add("(min-width: 761px)", () => { const st = make(130); return () => st.kill(); });
  mm.add("(max-width: 760px)",  () => { const st = make(175); return () => st.kill(); });
}

function boot() { layers = build(); wire(); requestAnimationFrame(() => ScrollTrigger.refresh()); }

let rz;
addEventListener("resize", () => { clearTimeout(rz); rz = setTimeout(() => { layers = build(); ScrollTrigger.refresh(); }, 250); }, { passive: true });

function start() {
  if (window.__introDone) requestAnimationFrame(boot);
  else addEventListener("intro:done", () => requestAnimationFrame(boot), { once: true });
}
if (document.readyState !== "loading") start();
else document.addEventListener("DOMContentLoaded", start);