/* =========================================================================
   home-experience.js — device evolution, all dots.
   After the intro, scroll reorganizes the SAME dot field:
   phone -> tablet -> laptop -> spread (full-screen field). No monitor, no new
   visual language. DOM content (interface) crossfades over the dot device.
   ========================================================================= */

import { initSmoothScroll, gsap, ScrollTrigger } from "./core/smooth-scroll.js";
import { dotField } from "./core/dot-field.js";

const DEVICES = ["phone", "tablet", "laptop", "spread"];
// mobile: only stage 1 forms the phone; the tablet/laptop/spread silhouettes read
// poorly at phone width, so stages 2-4 rest as a calm dotted grid and the rail icons
// carry the device identity. Idle still bursts this field into the aesthetic ideal state.
const MDEVICES = ["phone", "grid", "grid", "grid"];

/* STAGE 1 (phone) holds longer. Weighted scroll slices: phone gets a bigger
   share, the other three keep an equal share. Because the track length scales
   with TOTAL_W, Stages 2-4 keep their exact absolute scroll length + feel;
   only the phone's hold grows. */
const WEIGHTS = [1.6, 1, 1, 1];                                  // phone, tablet, laptop, spread
const TOTAL_W = WEIGHTS.reduce((a, b) => a + b, 0);
const EDGES = WEIGHTS.reduce((acc, w) => (acc.push(acc[acc.length - 1] + w / TOTAL_W), acc), [0]); // cumulative

/* Arrival -> Hold -> Exit per device state.
   Within each (possibly unequal) slice, the middle 60% is a flat HOLD; the
   outer 20% + 20% are the morph out/in shared with neighbours. */
const HOLD_MORPH = 0.2;
function holdMorph(p, list, edges) {
  const n = list.length;
  let k = n - 1;
  for (let i = 0; i < n; i++) { if (p < edges[i + 1]) { k = i; break; } }
  const len = edges[k + 1] - edges[k];
  const local = len > 0 ? (p - edges[k]) / len : 0;             // 0..1 within state k
  const ease = (t) => t * t * (3 - 2 * t);                      // smoothstep
  if (k < n - 1 && local > 1 - HOLD_MORPH) {                    // morph OUT: k -> k+1
    const t = (local - (1 - HOLD_MORPH)) / (HOLD_MORPH * 2);    // 0 -> 0.5
    return { from: list[k], to: list[k + 1], mix: ease(t) };
  }
  if (k > 0 && local < HOLD_MORPH) {                            // morph IN: k-1 -> k
    const t = 0.5 + local / (HOLD_MORPH * 2);                  // 0.5 -> 1
    return { from: list[k - 1], to: list[k], mix: ease(t) };
  }
  return { from: list[k], to: list[k], mix: 0 };                // HOLD (recognizable)
}

/* snap targets: the centre of each device's hold (fully formed), so scrolling
   always settles ON a device, never mid-transition. */
const SNAP = DEVICES.map((_, k) => (EDGES[k] + EDGES[k + 1]) / 2);

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
  // dotted device icons, one per stage, above the labels
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
function railStageFromScroll(p) {
  const n = DEVICES.length; let k = 0;
  for (let i = 0; i < n; i++) if (p >= SNAP[i] - 1e-4) k = i;
  return k;
}
function showRail(on) { railEl && railEl.classList.toggle("is-shown", on); }

/* GSAP entrance reveals for the text sections (takes over the CSS [data-reveal]) */
function revealContent() {
  if (matchMedia("(prefers-reduced-motion: reduce)").matches) return;
  document.documentElement.classList.add("gsap-reveals");   // neutralises the CSS reveal; GSAP owns it

  const rise = (el, d = 0.9, y = 30) => {
    gsap.set(el, { autoAlpha: 0, y });
    ScrollTrigger.create({ trigger: el, start: "top 86%", once: true,
      onEnter: () => gsap.to(el, { autoAlpha: 1, y: 0, duration: d, ease: "power3.out" }) });
  };

  // single blocks: lead paragraph, section headers, scale, cta
  gsap.utils.toArray([".intro__lead", ".work__head", ".scale", ".cta", ".about__lead"]).forEach((el) => rise(el));

  // discipline chips: staggered in
  document.querySelectorAll(".intro__disciplines").forEach((ul) => {
    const items = ul.querySelectorAll("li");
    gsap.set(items, { autoAlpha: 0, y: 16 });
    ScrollTrigger.create({ trigger: ul, start: "top 88%", once: true,
      onEnter: () => gsap.to(items, { autoAlpha: 1, y: 0, duration: 0.6, ease: "power2.out", stagger: 0.06 }) });
  });

  // work rows: reveal in staggered batches as they scroll into view
  const rows = gsap.utils.toArray(".work-list__row");
  if (rows.length) {
    gsap.set(rows, { autoAlpha: 0, y: 28 });
    ScrollTrigger.batch(rows, { start: "top 90%",
      onEnter: (batch) => gsap.to(batch, { autoAlpha: 1, y: 0, duration: 0.7, ease: "power3.out", stagger: 0.08, overwrite: true }) });
  }
}

function boot() {
  const root = document.getElementById("home-experience");
  if (!root) return;
  const pin    = root.querySelector(".he-pin");
  const stages = gsap.utils.toArray(root.querySelectorAll(".he-stage"));
  const field  = dotField();
  const reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;

  if (reduce) { gsap.set(stages, { autoAlpha: 0 }); gsap.set(stages[0], { autoAlpha: 1 }); return; }

  revealContent();   // GSAP entrance animations for the sections below the hero

  initSmoothScroll();
  const lenis = initSmoothScroll();
  buildRail(); showRail(true);
  const mm = gsap.matchMedia();
  let heroST = null;                                   // set by whichever breakpoint is active

  // ===== DESKTOP / TABLET (>=761px) — unchanged behaviour, just no longer inherited by mobile =====
  mm.add("(min-width: 761px)", () => {
    gsap.set(stages, { autoAlpha: 0 });
    gsap.set(stages[0], { autoAlpha: 1 });

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin, start: "top top",
        end: () => "+=" + (TOTAL_W * 130) + "%",   // weighted track: phone hold longer, others unchanged
        scrub: 0.8, pin: true, anticipatePin: 1, invalidateOnRefresh: true,
        snap: { snapTo: SNAP, duration: { min: 0.25, max: 0.7 }, delay: 0.05, ease: "power2.inOut" },
        onUpdate: (self) => {
          if (!field) return;
          const m = holdMorph(self.progress, DEVICES, EDGES); // Arrival -> Hold -> Exit (weighted)
          if (m.from === m.to) field.setMorph(m.from, m.to, 0);          // hold
          else field.setMorphVia(m.from, "spread", m.to, m.mix);        // break into dots, reform
          // ink stays high while the device is legible, eases toward ambient as it spreads
          field.ink = self.progress < 0.72 ? 1 : 1 - (self.progress - 0.72) / 0.28 * 0.55;
        },
      },
    });

    // content swaps DURING each transition, so the held device always carries its own copy
    const fade = 0.10;
    for (let i = 1; i < stages.length; i++) {
      const b = EDGES[i];                                  // content swaps at the weighted device boundary
      tl.to(stages[i - 1], { autoAlpha: 0, duration: fade, ease: "power1.inOut" }, b - fade / 2)
        .to(stages[i],     { autoAlpha: 1, duration: fade, ease: "power1.inOut" }, b - fade / 2 + 0.02);
    }
    tl.to({}, { duration: 0.0001 }, 1);                    // normalise total duration so positions == progress
    heroST = tl.scrollTrigger;

    return () => gsap.set(stages, { clearProps: "all" });
  });

  // ===== MOBILE (<=760px) — dedicated keynote close-up choreography =====
  // Device is allowed to crop; typography leads. Captions slide like a keynote.
  mm.add("(max-width: 760px)", () => {
    gsap.set(stages, { autoAlpha: 0, y: 0 });
    gsap.set(stages[0], { autoAlpha: 1 });

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin, start: "top top",
        end: () => "+=" + (TOTAL_W * 175) + "%",    // weighted track (phone hold longer)
        scrub: 0.7, pin: true, anticipatePin: 1, invalidateOnRefresh: true,
        snap: { snapTo: SNAP, duration: { min: 0.3, max: 0.8 }, delay: 0.05, ease: "power2.inOut" },
        onUpdate: (self) => {
          if (!field) return;
          const m = holdMorph(self.progress, MDEVICES, EDGES);   // phone -> grid -> grid -> grid
          field.setMorph(m.from, m.to, m.mix);                   // gentle morph, no break-into-spread on mobile
          // ink: phone reads as a device (dark); once it dissolves to grid, stay calm/subtle
          const e1 = EDGES[1];
          field.ink = self.progress < e1 - 0.05 ? 1
            : self.progress > e1 + 0.05 ? 0.32
            : 1 - (self.progress - (e1 - 0.05)) / 0.1 * 0.68;
        },
      },
    });

    // mobile: content slides in HORIZONTALLY (different from desktop), nothing crops/breaks
    const fade = 0.11;
    for (let i = 1; i < stages.length; i++) {
      const b = EDGES[i];
      tl.to(stages[i - 1], { autoAlpha: 0, x: -60, duration: fade, ease: "power1.in" }, b - fade / 2)
        .fromTo(stages[i], { x: 60 }, { autoAlpha: 1, x: 0, duration: fade, ease: "power2.out" }, b - fade / 2 + 0.02);
    }
    tl.to({}, { duration: 0.0001 }, 1);
    heroST = tl.scrollTrigger;

    return () => gsap.set(stages, { clearProps: "all" });
  });

  // ===== AUTO-ADVANCE: if the reader isn't scrolling, glide to the next stage =====
  // Manual scroll/touch cancels it; at the final stage it stops so the field can burst.
  const AUTO_MS = 120000, lastK = DEVICES.length - 1;   // 2 min per stage
  let autoTimer = null, autoJumping = false, dwellStart = performance.now(), userScrolling = false, usTimer = null;
  const curStage = () => {
    if (!heroST) return 0;
    const p = heroST.progress; let k = lastK;
    for (let i = 0; i < DEVICES.length; i++) { if (p < EDGES[i + 1]) { k = i; break; } }
    return k;
  };
  const scrollForStage = (k) => heroST.start + (heroST.end - heroST.start) * SNAP[k];
  // dwellStart syncs with the auto countdown, so the rail fills exactly toward the next jump
  const scheduleAuto = () => { clearTimeout(autoTimer); dwellStart = performance.now(); autoTimer = setTimeout(doAuto, AUTO_MS); };
  function doAuto() {
    if (autoJumping || !heroST || !heroST.isActive) { scheduleAuto(); return; }
    const k = curStage();
    if (k >= lastK) return;                              // ecosystem reached -> let the dot field burst
    autoJumping = true;
    const y = scrollForStage(k + 1);
    const done = () => { autoJumping = false; scheduleAuto(); };
    if (lenis) lenis.scrollTo(y, { duration: 1.2, easing: (t) => 1 - Math.pow(1 - t, 3), onComplete: done });
    else { scrollTo({ top: y, behavior: "smooth" }); setTimeout(done, 1300); }
  }
  ["wheel", "touchstart", "touchmove", "pointerdown", "keydown"].forEach((ev) =>
    addEventListener(ev, () => {
      userScrolling = true; clearTimeout(usTimer); usTimer = setTimeout(() => { userScrolling = false; }, 600);
      if (!autoJumping) scheduleAuto();
    }, { passive: true }));
  scheduleAuto();

  // ===== CLICKABLE RAIL: tap a stage (label or icon) to glide there =====
  function goToStage(k) {
    if (!heroST || autoJumping) return;
    const y = scrollForStage(k);
    autoJumping = true;
    userScrolling = true; clearTimeout(usTimer); usTimer = setTimeout(() => { userScrolling = false; }, 1200);
    const done = () => { autoJumping = false; scheduleAuto(); };
    if (lenis) lenis.scrollTo(y, { duration: 1.0, easing: (t) => 1 - Math.pow(1 - t, 3), onComplete: done });
    else { scrollTo({ top: y, behavior: "smooth" }); setTimeout(done, 1100); }
  }
  railLabels.forEach((el, k) => {
    el.addEventListener("click", () => goToStage(k));
    el.addEventListener("keydown", (e) => { if (e.key === "Enter" || e.key === " ") { e.preventDefault(); goToStage(k); } });
  });
  railIcons.forEach((el, k) => el.addEventListener("click", () => goToStage(k)));

  // rail: during a dwell it fills over the 2-min countdown; while moving it follows the scroll
  gsap.ticker.add(() => {
    if (!heroST || !heroST.isActive) return;
    const k = railStageFromScroll(heroST.progress);
    let frac;
    if (k >= lastK) frac = 1;                            // final stage: full bar
    else if (autoJumping || userScrolling) {
      frac = Math.min(1, Math.max(0, (heroST.progress - SNAP[k]) / (SNAP[k + 1] - SNAP[k]))); // follow scroll
    } else {
      frac = Math.min(1, (performance.now() - dwellStart) / AUTO_MS);                          // fill over the dwell
    }
    renderRail(k, frac);
  });

  // after the experience, the field rests to its grid; idle now drips a little rain
  ScrollTrigger.create({
    trigger: ".intro", start: "top 80%",
    onEnter: () => { showRail(false); if (field) { field.idleMode = "rain"; field.targetBurst = 0; field.setMorph("grid", "grid", 0); gsap.to(field, { ink: 0.0, duration: 0.8 }); field._markActive(); } },
    onLeaveBack: () => { showRail(true); if (field) { field.idleMode = "burst"; field.targetRain = 0; field.ink = 0.4; field._markActive(); } },
  });
}

function start() { if (window.__introDone) boot(); else addEventListener("intro:done", boot, { once: true }); }
if (document.readyState !== "loading") start();
else document.addEventListener("DOMContentLoaded", start);
