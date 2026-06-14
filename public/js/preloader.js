/* =========================================================================
   preloader.js — the first chapter, made of the same dots.
   grid (alive) -> gather into RM -> narrative beneath -> RM flows into the
   phone -> hand off to the hero. No spinner, bar, %, or loading text.
   ========================================================================= */

import { dotField } from "./core/dot-field.js";
import { gsap } from "./core/smooth-scroll.js";

function finish(field) {
  if (field) { field.from = "phone"; field.to = "phone"; field.mix = 0; field.ink = 1; field.opacity = 1; }
  document.documentElement.classList.remove("intro-lock");
  document.documentElement.classList.add("intro-done");
  window.__introDone = true;
  dispatchEvent(new Event("intro:done"));
}

function run() {
  const field = dotField();
  const overlay = document.getElementById("preloader");
  const narrative = overlay ? overlay.querySelector(".preloader__narrative") : null;

  document.documentElement.classList.add("intro-lock");

  if (!field || !field.canvas) { finish(field); return; }

  if (matchMedia("(prefers-reduced-motion: reduce)").matches) {
    field.opacity = 1; field.ink = 1; field.setMorph("phone", "phone", 0);
    if (narrative) gsap.set(narrative, { autoAlpha: 1 });
    setTimeout(() => finish(field), 600);
    return;
  }

  const proxy = { mix: 0 };
  const tl = gsap.timeline({ onComplete: () => finish(field) });

  // 1. the field breathes into view as a grid
  field.setMorph("grid", "grid", 0);
  tl.to(field, { opacity: 0.55, duration: 1.0, ease: "power1.out" }, 0);

  // 2. the dots gather into RM (pure, centered)
  tl.add(() => { field.setMorph("grid", "rm", 0); proxy.mix = 0; }, ">-0.1");
  tl.to(proxy, { mix: 1, duration: 1.7, ease: "power2.inOut", onUpdate: () => (field.mix = proxy.mix) });
  tl.to(field, { ink: 1, opacity: 0.95, duration: 1.5, ease: "power2.inOut" }, "<");

  // 3. narrative appears BENEATH the symbol
  if (narrative) tl.fromTo(narrative, { autoAlpha: 0, y: 16 }, { autoAlpha: 1, y: 0, duration: 0.8, ease: "power2.out" }, "-=0.2");
  tl.to({}, { duration: 0.9 }); // hold on "complexity becoming clarity"

  // 4. RM flows into the phone, same dots
  tl.add(() => { field.setMorph("rm", "phone", 0); proxy.mix = 0; });
  tl.to(proxy, { mix: 1, duration: 1.5, ease: "power2.inOut", onUpdate: () => (field.mix = proxy.mix) });
  if (narrative) tl.to(narrative, { autoAlpha: 0, y: -12, duration: 0.6, ease: "power1.in" }, "<");

  // safety net
  setTimeout(() => { if (!window.__introDone) { tl.kill(); finish(field); } }, 9000);
}

if (document.readyState !== "loading") run();
else document.addEventListener("DOMContentLoaded", run);
