/* =========================================================================
   home-experience.js — device evolution, all dots.
   After the intro, scroll reorganizes the SAME dot field:
   phone -> tablet -> laptop -> spread (full-screen field). No monitor, no new
   visual language. DOM content (interface) crossfades over the dot device.
   ========================================================================= */

import { initSmoothScroll, gsap, ScrollTrigger } from "./core/smooth-scroll.js";
import { dotField } from "./core/dot-field.js";

const DEVICES = ["phone", "tablet", "laptop", "spread"];

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
    const seg = stages.length;          // 4 content stages aligned to device states

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin, start: "top top",
        end: () => "+=" + (seg * 95) + "%",
        scrub: 0.8, pin: true, anticipatePin: 1, invalidateOnRefresh: true,
        onUpdate: (self) => {
          const p = self.progress;
          if (field) {
            field.morphSequence(DEVICES, p);
            // ink stays high while the device is legible, eases toward ambient as it spreads
            field.ink = p < 0.72 ? 1 : 1 - (p - 0.72) / 0.28 * 0.55;
          }
        },
      },
    });

    // crossfade the content stages across the four states
    for (let i = 1; i < stages.length; i++) {
      const at = i - 0.5;
      tl.to(stages[i - 1], { autoAlpha: 0, duration: 0.5, ease: "power1.inOut" }, at)
        .to(stages[i],     { autoAlpha: 1, duration: 0.5, ease: "power1.inOut" }, at);
    }

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
