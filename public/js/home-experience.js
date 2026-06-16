/* =========================================================================
   home-experience.js — device evolution, all dots.
   The SAME dot field reorganises through device stages:
   phone -> tablet -> laptop -> spread (full field). DOM content (interface)
   crossfades over the dot device.

   Stages are driven by a simple TIMER + CLICK state machine (no scroll):
   the field auto-advances one stage per minute, and the rail lets you jump
   to any stage. No ScrollTrigger, no pinning. Reveals below use
   IntersectionObserver.
   ========================================================================= */

import { initSmoothScroll, gsap } from "./core/smooth-scroll.js";
import { dotField } from "./core/dot-field.js";

const DEVICES  = ["phone", "tablet", "laptop", "spread"];
// mobile: only stage 1 forms the phone; tablet/laptop/spread read poorly at phone
// width, so stages 2-4 rest as a calm dotted grid and the rail icons carry the
// device identity. Idle still bursts this field into the aesthetic ideal state.
const MDEVICES = ["phone", "grid", "grid", "grid"];

const AUTO_MS = 60000;   // 1 minute per stage, then auto-advance to the next

/* ---- story progress rail: Screen / Product / Platform / Ecosystem ---- */
const RAIL_ICONS = {
  phone:   '<rect x="10" y="3" width="8" height="18" rx="2"/>',
  tablet:  '<rect x="6" y="4" width="16" height="16" rx="2"/>',
  laptop:  '<rect x="6" y="4" width="16" height="11" rx="1.2"/><path d="M3 19 L25 19 L22 15 L6 15 Z"/>',
  desktop: '<rect x="4" y="3" width="20" height="13" rx="1.4"/><path d="M14 16 L14 19"/><path d="M9.5 20 L18.5 20"/>',
};
const RAIL_KINDS = ["phone", "tablet", "laptop", "desktop"];
function railIconSVG(kind) {
  return `<svg viewBox="0 0 28 24" fill="none" stroke="currentColor" stroke-width="1.4"
    stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1.4 2.7">${RAIL_ICONS[kind]}</svg>`;
}

let railEl = null, railLabels = [], railSegs = [], railIcons = [];
function buildRail() {
  if (railEl) return;
  railEl = document.createElement("div");
  railEl.className = "story-rail";
  const icons = document.createElement("div"); icons.className = "story-rail__icons"; icons.setAttribute("aria-hidden", "true");
  RAIL_KINDS.forEach((kind) => {
    const ic = document.createElement("span"); ic.className = "ricon"; ic.innerHTML = railIconSVG(kind);
    icons.appendChild(ic); railIcons.push(ic);
  });
  const labs = document.createElement("div"); labs.className = "story-rail__labels";
  ["Screen", "Product", "Platform", "Ecosystem"].forEach((n) => {
    const s = document.createElement("span"); s.className = "srl"; s.textContent = n;
    s.setAttribute("role", "button"); s.setAttribute("tabindex", "0"); s.setAttribute("aria-label", "Go to " + n + " stage");
    labs.appendChild(s); railLabels.push(s);
  });
  const track = document.createElement("div"); track.className = "story-rail__track"; track.setAttribute("aria-hidden", "true");
  for (let i = 0; i < 4; i++) {
    const seg = document.createElement("div"); seg.className = "story-rail__seg";
    const f = document.createElement("i"); f.className = "segfill";
    seg.appendChild(f); track.appendChild(seg); railSegs.push(f);
  }
  railEl.appendChild(icons); railEl.appendChild(labs); railEl.appendChild(track);
  document.body.appendChild(railEl);
}
function renderRail(k, frac) {
  if (!railEl) return;
  railSegs.forEach((f, i) => { f.style.width = (i < k ? 1 : i === k ? frac : 0) * 100 + "%"; });
  railLabels.forEach((el, i) => el.classList.toggle("is-active", i === k));
  railIcons.forEach((el, i) => el.classList.toggle("is-active", i === k));
}
function showRail(on) { railEl && railEl.classList.toggle("is-shown", on); }

/* ---------- IntersectionObserver: fire once when an element scrolls in ---------- */
function onceInView(el, cb, { threshold = 0.18, margin = "0px 0px -8% 0px" } = {}) {
  if (!el) return;
  const io = new IntersectionObserver((ents, obs) => {
    ents.forEach((en) => { if (en.isIntersecting) { obs.unobserve(en.target); cb(en.target); } });
  }, { threshold, rootMargin: margin });
  io.observe(el);
}

/* GSAP entrance reveals for the text sections (takes over the CSS [data-reveal]) */
function revealContent() {
  if (matchMedia("(prefers-reduced-motion: reduce)").matches) return;
  document.documentElement.classList.add("gsap-reveals");   // neutralises the CSS reveal; GSAP owns it

  const rise = (el, d = 0.9, y = 30) => {
    if (!el) return;
    gsap.set(el, { autoAlpha: 0, y });
    onceInView(el, () => gsap.to(el, { autoAlpha: 1, y: 0, duration: d, ease: "power3.out" }));
  };
  const maskReveal = (el) => {
    if (!el) return;
    gsap.set(el, { autoAlpha: 0, yPercent: 30, clipPath: "inset(0 0 100% 0)" });
    onceInView(el, () => gsap.to(el, { autoAlpha: 1, yPercent: 0, clipPath: "inset(0 0 0% 0)", duration: 0.95, ease: "power3.out" }));
  };
  const countUp = (el) => {
    const m = el.textContent.trim().match(/^(\D*)(\d[\d,.]*)(.*)$/);
    if (!m) return;
    const pre = m[1], post = m[3], target = parseFloat(m[2].replace(/,/g, ""));
    const dec = (m[2].split(".")[1] || "").length;
    const o = { v: 0 }; el.textContent = pre + (0).toFixed(dec) + post;
    onceInView(el, () => gsap.to(o, { v: target, duration: 1.4, ease: "power2.out",
      onUpdate: () => { el.textContent = pre + o.v.toFixed(dec) + post; } }), { threshold: 0.4 });
  };

  gsap.utils.toArray(".work-list__row").forEach((row) => {
    gsap.set(row, { autoAlpha: 0, y: 28 });
    onceInView(row, () => gsap.to(row, { autoAlpha: 1, y: 0, duration: 0.7, ease: "power3.out" }), { threshold: 0.12 });
  });
  document.querySelectorAll(".work-list__metric b").forEach(countUp);
}

function boot() {
  const root = document.getElementById("home-experience");
  if (!root) return;
  const stages = gsap.utils.toArray(root.querySelectorAll(".he-stage"));
  if (!stages.length) return;
  const field  = dotField();
  const reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
  const lastK  = stages.length - 1;
  const mobile = () => matchMedia("(max-width: 760px)").matches;
  const devList = () => (mobile() ? MDEVICES : DEVICES);

  initSmoothScroll();
  buildRail(); showRail(true);

  // ---- reduced motion: show stage 0, static field, full rail, no motion ----
  if (reduce) {
    gsap.set(stages, { autoAlpha: 0 });
    gsap.set(stages[0], { autoAlpha: 1 });
    if (field) { const d = devList()[0]; field.setMorph(d, d, 0); field.ink = 1; }
    renderRail(0, 1);
    return;
  }

  // ---- stage state machine ----
  let current = -1, dwellStart = performance.now(), autoTimer = null, morphTween = null;

  const paintInk = (to) => {
    if (!field) return;
    const target = (to === "spread") ? 0 : (mobile() && to === "grid") ? 0.32 : 1;
    gsap.to(field, { ink: target, duration: 0.8, ease: "power2.out", overwrite: "auto" });
  };

  function scheduleAuto() {
    clearTimeout(autoTimer);
    if (current >= lastK) return;                 // last stage: stop so the field can burst
    autoTimer = setTimeout(() => setStage(current + 1), AUTO_MS);
  }

  function setStage(k, animate = true) {
    k = Math.max(0, Math.min(lastK, k));
    if (k === current) return;
    const prev = current; current = k;
    const dl   = devList();
    const to   = dl[k];
    const from = prev < 0 ? "grid" : dl[prev];

    // crossfade the DOM stage content
    stages.forEach((s, i) =>
      gsap.to(s, { autoAlpha: i === k ? 1 : 0, duration: animate ? 0.55 : 0, ease: "power2.out", overwrite: "auto" }));

    // morph the dot field to this stage's device
    if (field) {
      if (morphTween) morphTween.kill();
      field.targetBurst = 0; field.targetRain = 0;        // clear any idle state so the morph is visible
      if (animate && from !== to) {
        const o = { m: 0 }, desktop = !mobile();
        morphTween = gsap.to(o, {
          m: 1, duration: 1.1, ease: "power2.inOut",
          onUpdate: () => { desktop ? field.setMorphVia(from, "spread", to, o.m) : field.setMorph(from, to, o.m); },
          onComplete: () => { field.setMorph(to, to, 0); },
        });
      } else {
        field.setMorph(to, to, 0);
      }
      paintInk(to);
      field._markActive();        // restart the idle clock; the field bursts after it settles
    }

    // rail + auto countdown reset
    dwellStart = performance.now();
    renderRail(k, k >= lastK ? 1 : 0);
    scheduleAuto();
  }

  // ---- clickable rail (label or icon) -> jump to a stage ----
  const go = (k) => setStage(k);
  railLabels.forEach((el, k) => {
    el.addEventListener("click", () => go(k));
    el.addEventListener("keydown", (e) => { if (e.key === "Enter" || e.key === " ") { e.preventDefault(); go(k); } });
  });
  railIcons.forEach((el, k) => el.addEventListener("click", () => go(k)));

  // ---- rail fill: purely time-based dwell toward the next auto-jump ----
  gsap.ticker.add(() => {
    if (current < 0) return;
    const frac = current >= lastK ? 1 : Math.min(1, (performance.now() - dwellStart) / AUTO_MS);
    renderRail(current, frac);
  });

  // ---- rail show/hide + idle mode by hero visibility (replaces the .intro ScrollTrigger) ----
  const heroVis = new IntersectionObserver(([e]) => {
    if (!field) return;
    if (e.isIntersecting) {
      showRail(true);
      field.idleMode = "burst"; field.targetRain = 0;
      const d = devList()[current < 0 ? 0 : current];
      field.setMorph(d, d, 0); paintInk(d);
      field._markActive();
      scheduleAuto();                                   // resume auto-advance when the hero is on screen
    } else {
      showRail(false);
      field.idleMode = "rain"; field.targetBurst = 0;
      field.setMorph("grid", "grid", 0);
      gsap.to(field, { ink: 0, duration: 0.8 });
      field._markActive();
      clearTimeout(autoTimer);                          // pause auto-advance while reading the content below
    }
  }, { threshold: 0.45 });
  heroVis.observe(root);

  // ---- hero opening: the first stage's eyebrow + headline rise in ----
  const bits = stages[0].querySelectorAll(".he-eyebrow, .he-headline");
  gsap.from(bits, { yPercent: 60, autoAlpha: 0, duration: 1.1, ease: "power4.out", stagger: 0.12, delay: 0.15 });

  // ---- start on stage 0 and begin the cycle ----
  gsap.set(stages, { autoAlpha: 0 });
  setStage(0, false);

  // ---- content reveals below the hero ----
  revealContent();
  revealBigCards();
}

/* big cards: drag-to-scroll (always on) + entrance (IntersectionObserver) */
let bigTrack = null;
function initBigCardsDrag() {
  bigTrack = document.querySelector(".big-cards__track[data-drag]");
  if (!bigTrack) return;
  let down = false, startX = 0, startScroll = 0, moved = false;
  bigTrack.addEventListener("pointerdown", (e) => {
    down = true; moved = false; startX = e.clientX; startScroll = bigTrack.scrollLeft;
    bigTrack.classList.add("is-dragging");
    try { bigTrack.setPointerCapture(e.pointerId); } catch (_) {}
  });
  bigTrack.addEventListener("pointermove", (e) => {
    if (!down) return;
    const dx = e.clientX - startX;
    if (Math.abs(dx) > 3) moved = true;
    bigTrack.scrollLeft = startScroll - dx;
  });
  const end = () => { if (!down) return; down = false; bigTrack.classList.remove("is-dragging"); };
  bigTrack.addEventListener("pointerup", end);
  bigTrack.addEventListener("pointercancel", end);
  bigTrack.addEventListener("pointerleave", end);
  // swallow the click that follows a drag so inner links don't fire on release
  bigTrack.addEventListener("click", (e) => { if (moved) { e.preventDefault(); e.stopPropagation(); } }, true);
}
function revealBigCards() {
  if (!bigTrack || matchMedia("(prefers-reduced-motion: reduce)").matches) return;
  const cards = bigTrack.querySelectorAll(".big-card");
  gsap.set(cards, { autoAlpha: 0, y: 40 });
  onceInView(bigTrack, () => gsap.to(cards, { autoAlpha: 1, y: 0, duration: 0.8, ease: "power3.out", stagger: 0.08 }), { threshold: 0.15 });
}

function start() { if (window.__introDone) boot(); else addEventListener("intro:done", boot, { once: true }); }
initBigCardsDrag();
if (document.readyState !== "loading") start();
else document.addEventListener("DOMContentLoaded", start);
