/* =========================================================================
   home-experience.js — drives the physical device morph + network.
   The morph is CONFIG-DRIVEN: every device's geometry lives in STAGES, so
   tuning the journey means editing numbers here, not rewriting tweens.
   ========================================================================= */

import { initSmoothScroll, gsap, ScrollTrigger } from "./core/smooth-scroll.js";
import { Environment } from "./webgl/environment.js";

/* geometry per device. w/h/r/bezel are px strings; island/deck/stand are 0..1;
   tilt is degrees; content = which stage copy is visible. Tune freely. */
const STAGES = [
  { key: "mobile",  w: "280px", h: "584px", r: "46px", bezel: "12px", tilt: 0, island: 1, deck: 0, stand: 0, content: 0 },
  { key: "tablet",  w: "604px", h: "452px", r: "30px", bezel: "16px", tilt: 0, island: 0, deck: 0, stand: 0, content: 1 },
  { key: "laptop",  w: "720px", h: "452px", r: "16px", bezel: "14px", tilt: 7, island: 0, deck: 1, stand: 0, content: 2 },
  { key: "desktop", w: "940px", h: "540px", r: "10px", bezel: "12px", tilt: 0, island: 0, deck: 0, stand: 1, content: 3 },
];

function boot() {
  const root = document.getElementById("home-experience");
  if (!root) return;

  const pin    = root.querySelector(".he-pin");
  const device = root.querySelector(".he-device");
  const stages = gsap.utils.toArray(root.querySelectorAll(".he-stage"));
  const eco    = root.querySelector(".he-ecosystem");
  const canvas = root.querySelector(".he-env");
  const reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;

  const env = canvas ? new Environment(canvas) : null;

  root.classList.add("he-ready");
  if (reduce) { applyGeometry(device, STAGES[0]); showOnly(stages, 0); return; }

  initSmoothScroll();
  const mm = gsap.matchMedia();

  // ---------- DESKTOP / TABLET: physical morph ----------
  mm.add("(min-width: 901px)", () => {
    applyGeometry(device, STAGES[0], true);
    gsap.set(stages, { autoAlpha: 0 });
    gsap.set(stages[STAGES[0].content], { autoAlpha: 1 });
    gsap.set(eco, { autoAlpha: 0 });

    const segs = STAGES.length - 1;            // 3 transitions
    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin, start: "top top",
        end: () => "+=" + (STAGES.length * 90) + "%",
        scrub: 0.8, pin: true, anticipatePin: 1,
        onUpdate: (self) => env && env.setProgress(self.progress),
      },
    });

    for (let i = 0; i < segs; i++) {
      const a = STAGES[i], b = STAGES[i + 1];
      // morph the body geometry + parts continuously
      tl.to(device, {
        "--w": b.w, "--h": b.h, "--r": b.r, "--bezel": b.bezel,
        "--tilt": b.tilt, "--island": b.island, "--deck": b.deck, "--stand": b.stand,
        duration: 1, ease: "power2.inOut",
      }, i);
      // hand content over mid-morph
      tl.to(stages[a.content], { autoAlpha: 0, duration: 0.4, ease: "power1.inOut" }, i + 0.3)
        .to(stages[b.content], { autoAlpha: 1, duration: 0.4, ease: "power1.inOut" }, i + 0.35);
    }

    // payoff: dissolve the desktop, enter the ecosystem
    tl.to(device, { autoAlpha: 0, scale: 1.5, filter: "blur(7px)", duration: 0.6, ease: "power2.in" }, segs - 0.2)
      .to(eco,    { autoAlpha: 1, duration: 0.6, ease: "power2.out" }, segs - 0.1);

    return () => gsap.set([device, stages, eco], { clearProps: "all" });
  });

  // ---------- MOBILE: horizontal narrative (no morph) ----------
  mm.add("(max-width: 900px)", () => {
    applyGeometry(device, STAGES[0]);
    gsap.set(stages, { autoAlpha: 0 });
    gsap.set(stages[0], { autoAlpha: 1 });

    const order = STAGES.map((s) => s.content);
    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin, start: "top top",
        end: () => "+=" + (STAGES.length * 100) + "%",
        scrub: 0.6, pin: true, anticipatePin: 1,
        onUpdate: (self) => env && env.setProgress(self.progress),
      },
    });
    for (let i = 1; i < order.length; i++) {
      tl.to(stages[order[i - 1]], { autoAlpha: 0, duration: 0.4 }, i)
        .to(stages[order[i]],     { autoAlpha: 1, duration: 0.4 }, i + 0.05);
    }
    tl.to(eco, { autoAlpha: 1, duration: 0.5 }, order.length - 0.3);
    return () => gsap.set([stages, eco], { clearProps: "all" });
  });

  const themeObs = new MutationObserver(() => env && env.setThemeFromCSS());
  themeObs.observe(document.documentElement, { attributes: true, attributeFilter: ["data-theme"] });

  window.addEventListener("beforeunload", () => { mm.revert(); env && env.dispose(); });
}

function applyGeometry(el, s, instant) {
  const set = { "--w": s.w, "--h": s.h, "--r": s.r, "--bezel": s.bezel,
                "--tilt": s.tilt, "--island": s.island, "--deck": s.deck, "--stand": s.stand };
  gsap.set(el, set);
}
function showOnly(stages, idx) {
  stages.forEach((s, i) => gsap.set(s, { autoAlpha: i === idx ? 1 : 0 }));
}

if (document.readyState !== "loading") boot();
else document.addEventListener("DOMContentLoaded", boot);
