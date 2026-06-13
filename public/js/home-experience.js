/* =========================================================================
   home-experience.js — device morph + SCREEN TAKEOVER.
   phone -> tablet -> laptop -> screen expands to fill the viewport -> frame
   and glass dissolve -> the visitor falls through into the ecosystem.
   Geometry is config-driven (STAGES). No monitor: the desktop is the moment
   the interface becomes larger than the device, not another object.
   ========================================================================= */

import { initSmoothScroll, gsap, ScrollTrigger } from "./core/smooth-scroll.js";
import { Environment } from "./webgl/environment.js";

/* w/h/r/bezel px strings; island/deck/frameA/screenA 0..1; tilt deg; content idx */
const STAGES = [
  { key: "phone",  w: "280px", h: "584px", r: "46px", bezel: "12px", tilt: 0, island: 1, deck: 0, content: 0 },
  { key: "tablet", w: "604px", h: "452px", r: "30px", bezel: "16px", tilt: 0, island: 0, deck: 0, content: 1 },
  { key: "laptop", w: "720px", h: "452px", r: "16px", bezel: "14px", tilt: 7, island: 0, deck: 1, content: 2 },
  // "expand" sizes are computed from the viewport at build (px so they tween cleanly)
];

function boot() {
  const root = document.getElementById("home-experience");
  if (!root) return;
  const pin    = root.querySelector(".he-pin");
  const rig    = root.querySelector(".he-rig");
  const device = root.querySelector(".he-device");
  const stages = gsap.utils.toArray(root.querySelectorAll(".he-stage"));
  const eco    = root.querySelector(".he-ecosystem");
  const canvas = root.querySelector(".he-env");
  const reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;

  const env = canvas ? new Environment(canvas) : null;
  root.classList.add("he-ready");

  if (reduce) { setVars(device, STAGES[0]); showOnly(stages, 0); return; }

  initSmoothScroll();
  const mm = gsap.matchMedia();

  // ---------- DESKTOP / TABLET: full morph + takeover ----------
  mm.add("(min-width: 901px)", () => {
    const expand = { w: innerWidth + "px", h: innerHeight + "px", r: "0px", bezel: "0px", tilt: 0, island: 0, deck: 0, content: 3 };
    const order = [...STAGES, expand];

    setVars(device, order[0]);
    gsap.set(device, { "--frameA": 1, "--screenA": 1 });
    gsap.set(stages, { autoAlpha: 0 }); gsap.set(stages[0], { autoAlpha: 1 });
    gsap.set(eco, { autoAlpha: 0 });

    const last = order.length - 1; // index of "expand"
    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin, start: "top top", end: () => "+=" + ((order.length + 1) * 90) + "%",
        scrub: 0.8, pin: true, anticipatePin: 1, invalidateOnRefresh: true,
        onUpdate: (self) => env && env.setProgress(self.progress),
      },
    });

    for (let i = 0; i < last; i++) {
      const b = order[i + 1];
      tl.to(device, geom(b), i);
      tl.to(stages[order[i].content], { autoAlpha: 0, duration: 0.4, ease: "power1.inOut" }, i + 0.3)
        .to(stages[b.content],        { autoAlpha: 1, duration: 0.4, ease: "power1.inOut" }, i + 0.35);
    }
    // grow the rig to true scale as the screen expands
    tl.to(rig, { scale: 1, duration: 1, ease: "power2.inOut" }, last - 1);

    // BREAK FREE: glass + frame dissolve, regions fade, ecosystem takes over
    tl.to(device, { "--frameA": 0, "--screenA": 0, duration: 0.7, ease: "power2.in" }, last + 0.05)
      .to(stages[order[last].content], { autoAlpha: 0, duration: 0.45 }, last + 0.05)
      .to(eco, { autoAlpha: 1, duration: 0.7, ease: "power2.out" }, last + 0.25);

    return () => gsap.set([device, rig, stages, eco], { clearProps: "all" });
  });

  // ---------- MOBILE: one device, readable, then takeover ----------
  mm.add("(max-width: 900px)", () => {
    const phone = { w: Math.min(innerWidth * 0.86, 340) + "px", h: Math.min(innerHeight * 0.74, 640) + "px",
                    r: "40px", bezel: "12px", tilt: 0, island: 1, deck: 0 };
    const expand = { w: innerWidth + "px", h: innerHeight + "px", r: "0px", bezel: "0px", tilt: 0, island: 0, deck: 0 };

    setVars(device, phone);
    gsap.set(device, { "--frameA": 1, "--screenA": 1 });
    gsap.set(stages, { autoAlpha: 0 }); gsap.set(stages[0], { autoAlpha: 1 });
    gsap.set(eco, { autoAlpha: 0 });

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin, start: "top top", end: () => "+=" + (stages.length + 1) * 100 + "%",
        scrub: 0.6, pin: true, anticipatePin: 1, invalidateOnRefresh: true,
        onUpdate: (self) => env && env.setProgress(self.progress),
      },
    });
    // crossfade the four content stages, one visible at a time
    for (let i = 1; i < stages.length; i++) {
      tl.to(stages[i - 1], { autoAlpha: 0, duration: 0.4 }, i)
        .to(stages[i],     { autoAlpha: 1, duration: 0.4 }, i + 0.05);
    }
    // takeover
    tl.to(device, geom(expand), stages.length)
      .to(device, { "--frameA": 0, "--screenA": 0, duration: 0.6 }, stages.length + 0.6)
      .to(stages[stages.length - 1], { autoAlpha: 0, duration: 0.4 }, stages.length + 0.6)
      .to(eco, { autoAlpha: 1, duration: 0.6 }, stages.length + 0.8);

    return () => gsap.set([device, stages, eco], { clearProps: "all" });
  });

  const themeObs = new MutationObserver(() => env && env.setThemeFromCSS());
  themeObs.observe(document.documentElement, { attributes: true, attributeFilter: ["data-theme"] });
  addEventListener("beforeunload", () => { mm.revert(); env && env.dispose(); });
}

function geom(s) {
  return { "--w": s.w, "--h": s.h, "--r": s.r, "--bezel": s.bezel,
           "--tilt": s.tilt, "--island": s.island, "--deck": s.deck,
           duration: 1, ease: "power2.inOut" };
}
function setVars(el, s) {
  gsap.set(el, { "--w": s.w, "--h": s.h, "--r": s.r, "--bezel": s.bezel,
                 "--tilt": s.tilt, "--island": s.island, "--deck": s.deck });
}
function showOnly(stages, idx) { stages.forEach((s, i) => gsap.set(s, { autoAlpha: i === idx ? 1 : 0 })); }

if (document.readyState !== "loading") boot();
else document.addEventListener("DOMContentLoaded", boot);
