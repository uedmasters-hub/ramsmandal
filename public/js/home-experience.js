/* =========================================================================
   home-experience.js — device evolution, all dots.
   After the intro, scroll reorganizes the SAME dot field:
   phone -> tablet -> laptop -> spread (full-screen field). No monitor, no new
   visual language. DOM content (interface) crossfades over the dot device.
   ========================================================================= */

import { initSmoothScroll, gsap, ScrollTrigger } from "./core/smooth-scroll.js";
import { dotField } from "./core/dot-field.js";

const DEVICES = ["phone", "tablet", "laptop", "spread"];

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

function boot() {
  const root = document.getElementById("home-experience");
  if (!root) return;
  const pin    = root.querySelector(".he-pin");
  const stages = gsap.utils.toArray(root.querySelectorAll(".he-stage"));
  const field  = dotField();
  const reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;

  if (reduce) { gsap.set(stages, { autoAlpha: 0 }); gsap.set(stages[0], { autoAlpha: 1 }); return; }

  initSmoothScroll();
  const mm = gsap.matchMedia();

  // ===== DESKTOP / TABLET (>=761px) — unchanged behaviour, just no longer inherited by mobile =====
  mm.add("(min-width: 761px)", () => {
    gsap.set(stages, { autoAlpha: 0 });
    gsap.set(stages[0], { autoAlpha: 1 });

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin, start: "top top",
        end: () => "+=" + (TOTAL_W * 130) + "%",   // weighted track: phone hold longer, others unchanged
        scrub: 0.8, pin: true, anticipatePin: 1, invalidateOnRefresh: true,
        onUpdate: (self) => {
          if (!field) return;
          const m = holdMorph(self.progress, DEVICES, EDGES); // Arrival -> Hold -> Exit (weighted)
          field.setMorph(m.from, m.to, m.mix);
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
        onUpdate: (self) => {
          if (!field) return;
          const m = holdMorph(self.progress, DEVICES, EDGES); // same, weighted
          field.setMorph(m.from, m.to, m.mix);
          field.ink = self.progress < 0.72 ? 1 : 1 - (self.progress - 0.72) / 0.28 * 0.55;
        },
      },
    });

    // keynote caption: outgoing copy lifts away, incoming copy rises in
    const fade = 0.11;
    for (let i = 1; i < stages.length; i++) {
      const b = EDGES[i];
      tl.to(stages[i - 1], { autoAlpha: 0, y: -16, duration: fade, ease: "power1.in" }, b - fade / 2)
        .fromTo(stages[i], { y: 18 }, { autoAlpha: 1, y: 0, duration: fade, ease: "power2.out" }, b - fade / 2 + 0.02);
    }
    tl.to({}, { duration: 0.0001 }, 1);

    return () => gsap.set(stages, { clearProps: "all" });
  });

  // after the experience, the field rests back to its architectural grid
  ScrollTrigger.create({
    trigger: ".intro", start: "top 80%",
    onEnter: () => field && (field.setMorph("grid", "grid", 0), gsap.to(field, { ink: 0.0, duration: 0.8 })),
    onLeaveBack: () => field && (field.ink = 0.4),
  });
}

function start() { if (window.__introDone) boot(); else addEventListener("intro:done", boot, { once: true }); }
if (document.readyState !== "loading") start();
else document.addEventListener("DOMContentLoaded", start);