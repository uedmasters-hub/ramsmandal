/* =========================================================================
   core/smooth-scroll.js
   Lenis drives scroll. GSAP ticker drives Lenis. ScrollTrigger updates from
   Lenis. One scroll system, no competition. Exports gsap + ScrollTrigger so
   every consumer shares one registration.
   ========================================================================= */

import Lenis from "lenis";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

let lenis = null;

export function initSmoothScroll() {
  if (lenis) return lenis;

  const reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (reduce) {
    // Native scroll, no smoothing. ScrollTrigger still works off the window.
    ScrollTrigger.refresh();
    return null;
  }

  lenis = new Lenis({
    duration: 1.1,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smoothWheel: true,
    smoothTouch: false, // never hijack touch scrolling on phones
  });

  // Lenis position -> ScrollTrigger
  lenis.on("scroll", ScrollTrigger.update);

  // GSAP's clock -> Lenis (single rAF loop for the whole app)
  gsap.ticker.add((time) => lenis.raf(time * 1000));
  gsap.ticker.lagSmoothing(0);

  return lenis;
}

export { gsap, ScrollTrigger };
