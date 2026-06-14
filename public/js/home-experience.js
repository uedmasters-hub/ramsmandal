/* =========================================================================
   home-experience.js — device evolution, all dots.
   After the intro, scroll reorganizes the SAME dot field:
   phone -> tablet -> laptop -> spread (full-screen field). No monitor, no new
   visual language. DOM content (interface) crossfades over the dot device.
   ========================================================================= */

import { initSmoothScroll, gsap, ScrollTrigger } from "./core/smooth-scroll.js";
import { dotField } from "./core/dot-field.js";

const DEVICES = ["phone", "tablet", "laptop", "spread"];

/* Arrival -> Hold -> Exit per device state.
   Each state owns an equal slice of scroll: the middle 60% is a flat HOLD
   (device fully formed + recognizable); the outer 20% + 20% are the morph
   out/in shared with neighbours. Returns {from,to,mix} for field.setMorph. */
const HOLD_MORPH = 0.2;                 // 20% morph-in + 20% morph-out per state
function holdMorph(p, list) {
  const n = list.length, slice = 1 / n;
  const k = Math.min(n - 1, Math.floor(p / slice));
  const local = (p - k * slice) / slice;          // 0..1 within state k
  const ease = (t) => t * t * (3 - 2 * t);         // smoothstep
  if (k < n - 1 && local > 1 - HOLD_MORPH) {                 // morph OUT: k -> k+1
    const t = (local - (1 - HOLD_MORPH)) / (HOLD_MORPH * 2); // 0 -> 0.5
    return { from: list[k], to: list[k + 1], mix: ease(t) };
  }
  if (k > 0 && local < HOLD_MORPH) {                         // morph IN: k-1 -> k
    const t = 0.5 + local / (HOLD_MORPH * 2);               // 0.5 -> 1
    return { from: list[k - 1], to: list[k], mix: ease(t) };
  }
  return { from: list[k], to: list[k], mix: 0 };             // HOLD (recognizable)
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

  mm.add("(min-width: 1px)", () => {
    gsap.set(stages, { autoAlpha: 0 });
    gsap.set(stages[0], { autoAlpha: 1 });

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin, start: "top top",
        end: () => "+=" + (DEVICES.length * 130) + "%",   // longer track so holds get real scroll room
        scrub: 0.8, pin: true, anticipatePin: 1, invalidateOnRefresh: true,
        onUpdate: (self) => {
          if (!field) return;
          const m = holdMorph(self.progress, DEVICES);     // Arrival -> Hold -> Exit
          field.setMorph(m.from, m.to, m.mix);
          // ink stays high while the device is legible, eases toward ambient as it spreads
          field.ink = self.progress < 0.72 ? 1 : 1 - (self.progress - 0.72) / 0.28 * 0.55;
        },
      },
    });

    // content swaps DURING each transition, so the held device always carries its own copy
    const fade = 0.10;
    for (let i = 1; i < stages.length; i++) {
      const b = i / stages.length;                         // boundary progress (0.25, 0.5, 0.75)
      tl.to(stages[i - 1], { autoAlpha: 0, duration: fade, ease: "power1.inOut" }, b - fade / 2)
        .to(stages[i],     { autoAlpha: 1, duration: fade, ease: "power1.inOut" }, b - fade / 2 + 0.02);
    }
    tl.to({}, { duration: 0.0001 }, 1);                    // normalise total duration so positions == progress

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