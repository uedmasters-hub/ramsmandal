/* =========================================================================
   home-experience.js  (ESM, loaded via import map)
   The cinematic hero. Pinned, scrubbed, Lenis-synced. The device is DOM and
   GPU-transformed; the Three environment runs behind it and intensifies with
   progress. Three branches via gsap.matchMedia: desktop cinematic, mobile
   horizontal narrative, reduced-motion static. All teardown is context-scoped.
   ========================================================================= */

import { initSmoothScroll, gsap, ScrollTrigger } from "./core/smooth-scroll.js";
import { Environment } from "./webgl/environment.js";

function boot() {
  const root = document.getElementById("home-experience");
  if (!root) return;

  const pin     = root.querySelector(".he-pin");
  const device  = root.querySelector(".he-device");
  const stages  = gsap.utils.toArray(root.querySelectorAll(".he-stage"));
  const eco      = root.querySelector(".he-ecosystem");
  const canvas  = root.querySelector(".he-env");
  const count   = stages.length;          // 5
  const reduce  = matchMedia("(prefers-reduced-motion: reduce)").matches;

  // environment (skips itself if no WebGL)
  const env = canvas ? new Environment(canvas) : null;

  // Reduced motion / no transition support: leave the static stacked fallback
  // that the CSS already renders. Mark ready so the stage shows.
  root.classList.add("he-ready");
  if (reduce) return;

  initSmoothScroll();

  const mm = gsap.matchMedia();

  // ---------- DESKTOP: cinematic pin + scrub ----------
  mm.add("(min-width: 901px)", () => {
    // each stage owns an equal slice of the scrubbed timeline
    const segments = count - 1;

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin,
        start: "top top",
        end: () => "+=" + (count * 80) + "%",  // ~80vh of scroll per stage
        scrub: 0.8,
        pin: true,
        anticipatePin: 1,
        onUpdate: (self) => env && env.setProgress(self.progress),
      },
    });

    // stage 0 visible at rest
    gsap.set(stages, { autoAlpha: 0 });
    gsap.set(stages[0], { autoAlpha: 1 });
    gsap.set(eco, { autoAlpha: 0 });

    // device grows + tilts as influence widens
    tl.to(device, { scale: 1.18, rotateY: -7, rotateX: 2, ease: "none", duration: segments }, 0);

    // crossfade stages along the timeline
    for (let i = 1; i < count; i++) {
      const at = i - 0.5;
      tl.to(stages[i - 1], { autoAlpha: 0, duration: 0.5, ease: "power1.inOut" }, at)
        .to(stages[i],     { autoAlpha: 1, duration: 0.5, ease: "power1.inOut" }, at);
    }

    // payoff: the device frame dissolves, the ecosystem takes the full frame
    tl.to(device, { autoAlpha: 0, scale: 1.6, filter: "blur(6px)", duration: 0.6, ease: "power2.in" }, segments - 0.6)
      .to(eco,    { autoAlpha: 1, duration: 0.6, ease: "power2.out" }, segments - 0.4);

    return () => { gsap.set([stages, device, eco], { clearProps: "all" }); };
  });

  // ---------- MOBILE: vertical scroll -> horizontal narrative ----------
  mm.add("(max-width: 900px)", () => {
    const track = root.querySelector(".he-stages");
    if (!track) return;

    gsap.set(stages, { autoAlpha: 1 });    // all visible, laid side by side
    const shift = () => -(track.scrollWidth - window.innerWidth);

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: pin,
        start: "top top",
        end: () => "+=" + track.scrollWidth,
        scrub: 0.6,
        pin: true,
        anticipatePin: 1,
        invalidateOnRefresh: true,
        onUpdate: (self) => env && env.setProgress(self.progress),
      },
    });
    tl.to(track, { x: shift, ease: "none" });

    return () => { gsap.set(track, { clearProps: "all" }); };
  });

  // keep the WebGL theme in sync if the user toggles dark mode
  const themeObserver = new MutationObserver(() => env && env.setThemeFromCSS());
  themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ["data-theme"] });

  window.addEventListener("beforeunload", () => { mm.revert(); env && env.dispose(); });
}

if (document.readyState !== "loading") boot();
else document.addEventListener("DOMContentLoaded", boot);
