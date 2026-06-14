/* =========================================================================
   preloader.js — cinematic intro (ESM via import map).
   Chaos network -> self-organizes -> converges into "RM" -> morphs to a phone
   silhouette -> dissolves into the hero. Three.js atmosphere, GSAP sequencing,
   cursor parallax. Guarantees: reduced-motion / no-WebGL / error all skip
   cleanly, and it always fires `rm:intro-done` so the hero can boot.
   ========================================================================= */

import * as THREE from "three";
import { gsap } from "gsap";

const PLAY_ONCE = false;   // set true for once-per-session in production

function announceDone() {
  window.__rmIntroDone = true;
  window.dispatchEvent(new Event("rm:intro-done"));
}
function teardown(el) {
  document.documentElement.classList.remove("is-preloading");
  if (el) el.remove();
  announceDone();
}
function supportsWebGL() {
  try { return !!document.createElement("canvas").getContext("webgl"); } catch (e) { return false; }
}

/* sample the alpha pixels of rendered text into N world-space targets */
function sampleText(text, N, worldW, worldH) {
  const cw = 480, ch = 240, c = document.createElement("canvas");
  c.width = cw; c.height = ch;
  const ctx = c.getContext("2d");
  ctx.fillStyle = "#fff";
  ctx.font = "800 150px Manrope, Inter, Arial, sans-serif";
  ctx.textAlign = "center"; ctx.textBaseline = "middle";
  ctx.fillText(text, cw / 2, ch / 2 + 6);
  const data = ctx.getImageData(0, 0, cw, ch).data;
  const hits = [];
  for (let y = 0; y < ch; y += 2) for (let x = 0; x < cw; x += 2) {
    if (data[(y * cw + x) * 4 + 3] > 130) hits.push([x, y]);
  }
  const out = new Float32Array(N * 3);
  for (let i = 0; i < N; i++) {
    const [px, py] = hits.length ? hits[(Math.random() * hits.length) | 0] : [cw / 2, ch / 2];
    out[i*3]   = (px / cw - 0.5) * worldW;
    out[i*3+1] = -(py / ch - 0.5) * worldH;
    out[i*3+2] = (Math.random() - 0.5) * 4;
  }
  return out;
}

/* points along a tall rounded-rect perimeter (a phone silhouette) */
function samplePhone(N, w, h, r) {
  const out = new Float32Array(N * 3);
  const seg = [w - 2*r, Math.PI*r/2, h - 2*r, Math.PI*r/2, w - 2*r, Math.PI*r/2, h - 2*r, Math.PI*r/2];
  const total = seg.reduce((a, b) => a + b, 0);
  for (let i = 0; i < N; i++) {
    let d = (i / N) * total, k = 0;
    while (d > seg[k]) { d -= seg[k]; k++; }
    let x = 0, y = 0;
    const hw = w/2, hh = h/2;
    if (k === 0) { x = -hw + r + d; y = hh; }
    else if (k === 1) { const a = d/r; x = hw - r + Math.sin(a)*r; y = hh - r + Math.cos(a)*r; }
    else if (k === 2) { x = hw; y = hh - r - d; }
    else if (k === 3) { const a = d/r; x = hw - r + Math.sin(a + Math.PI/2)*r; y = -hh + r + Math.cos(a + Math.PI/2)*r; }
    else if (k === 4) { x = hw - r - d; y = -hh; }
    else if (k === 5) { const a = d/r; x = -hw + r + Math.sin(a + Math.PI)*r; y = -hh + r + Math.cos(a + Math.PI)*r; }
    else if (k === 6) { x = -hw; y = -hh + r + d; }
    else { const a = d/r; x = -hw + r + Math.sin(a + 3*Math.PI/2)*r; y = hh - r + Math.cos(a + 3*Math.PI/2)*r; }
    out[i*3] = x; out[i*3+1] = y; out[i*3+2] = (Math.random() - 0.5) * 3;
  }
  return out;
}

function softTexture() {
  const s = 64, c = document.createElement("canvas"); c.width = c.height = s;
  const ctx = c.getContext("2d");
  const g = ctx.createRadialGradient(s/2, s/2, 0, s/2, s/2, s/2);
  g.addColorStop(0, "rgba(255,255,255,1)"); g.addColorStop(0.3, "rgba(255,255,255,.5)"); g.addColorStop(1, "rgba(255,255,255,0)");
  ctx.fillStyle = g; ctx.fillRect(0, 0, s, s);
  const t = new THREE.CanvasTexture(c); t.needsUpdate = true; return t;
}

function init() {
  const el = document.getElementById("preloader");
  if (!el) { announceDone(); return; }

  const reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
  const seen = PLAY_ONCE && (() => { try { return sessionStorage.getItem("rm-intro"); } catch (e) { return false; } })();

  if (reduce || !supportsWebGL() || seen) {
    gsap.to(el, { autoAlpha: 0, duration: 0.4, onComplete: () => teardown(el) });
    return;
  }
  try { if (PLAY_ONCE) sessionStorage.setItem("rm-intro", "1"); } catch (e) {}

  document.documentElement.classList.add("is-preloading");
  const canvas = el.querySelector(".pre-canvas");
  const wComplex = el.querySelector('[data-word="complexity"]');
  const wClarity = el.querySelector('[data-word="clarity"]');

  // ---- scene ----
  const w = innerWidth, h = innerHeight;
  const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: false });
  renderer.setPixelRatio(Math.min(devicePixelRatio, 1.75));
  renderer.setSize(w, h, false);
  const scene = new THREE.Scene();
  scene.fog = new THREE.FogExp2(0x06070c, 0.012);
  const camera = new THREE.PerspectiveCamera(58, w / h, 0.1, 300);
  camera.position.z = 70;
  const group = new THREE.Group(); scene.add(group);

  const accent = new THREE.Color(getComputedStyle(document.documentElement).getPropertyValue("--blue").trim() || "#3f6dff");
  const N = innerWidth < 760 ? 420 : 680;
  const worldW = 56, worldH = 28;

  const chaos = new Float32Array(N * 3);
  for (let i = 0; i < N; i++) {
    chaos[i*3]   = (Math.random() - 0.5) * 120;
    chaos[i*3+1] = (Math.random() - 0.5) * 70;
    chaos[i*3+2] = (Math.random() - 0.5) * 80;
  }
  const rm = sampleText("RM", N, worldW, worldH);
  const phone = samplePhone(N, 24, 50, 7);

  const pos = new Float32Array(N * 3); pos.set(chaos);
  const pgeo = new THREE.BufferGeometry();
  pgeo.setAttribute("position", new THREE.BufferAttribute(pos, 3));
  const pmat = new THREE.PointsMaterial({ map: softTexture(), size: 1.7, sizeAttenuation: true,
    transparent: true, depthWrite: false, blending: THREE.AdditiveBlending, color: 0xbfd4ff, opacity: 0 });
  const points = new THREE.Points(pgeo, pmat); group.add(points);

  // edges from chaos topology
  const pairs = [];
  for (let i = 0; i < N; i++) {
    let added = 0;
    for (let j = i + 1; j < N && added < 2; j++) {
      const dx = chaos[i*3]-chaos[j*3], dy = chaos[i*3+1]-chaos[j*3+1], dz = chaos[i*3+2]-chaos[j*3+2];
      if (dx*dx + dy*dy + dz*dz < 240) { pairs.push(i, j); added++; }
    }
  }
  const lpos = new Float32Array(pairs.length * 3);
  const lgeo = new THREE.BufferGeometry();
  lgeo.setAttribute("position", new THREE.BufferAttribute(lpos, 3));
  const lmat = new THREE.LineBasicMaterial({ color: accent, transparent: true, depthWrite: false,
    blending: THREE.AdditiveBlending, opacity: 0 });
  const lines = new THREE.LineSegments(lgeo, lmat); group.add(lines);

  // ---- animated state ----
  const S = { morph: 0, jitter: 1, edge: 0, pts: 0 };
  let mx = 0, my = 0, cx = 0, cy = 0, t = 0, raf = 0;
  addEventListener("pointermove", onMove, { passive: true });
  function onMove(e) { mx = (e.clientX / innerWidth) * 2 - 1; my = (e.clientY / innerHeight) * 2 - 1; }

  function frame() {
    raf = requestAnimationFrame(frame);
    t += 0.016;
    const m = S.morph;
    for (let i = 0; i < N; i++) {
      const o = i * 3;
      let tx, ty, tz;
      if (m <= 1) { const k = m; tx = chaos[o]*(1-k)+rm[o]*k; ty = chaos[o+1]*(1-k)+rm[o+1]*k; tz = chaos[o+2]*(1-k)+rm[o+2]*k; }
      else { const k = m - 1; tx = rm[o]*(1-k)+phone[o]*k; ty = rm[o+1]*(1-k)+phone[o+1]*k; tz = rm[o+2]*(1-k)+phone[o+2]*k; }
      const j = S.jitter;
      pos[o]   = tx + Math.sin(t*1.3 + i) * j;
      pos[o+1] = ty + Math.cos(t*1.1 + i*1.3) * j;
      pos[o+2] = tz + Math.sin(t*0.9 + i*0.7) * j;
    }
    pgeo.attributes.position.needsUpdate = true;
    for (let e = 0; e < pairs.length; e += 2) {
      const a = pairs[e]*3, b = pairs[e+1]*3, o = (e/2)*6;
      lpos[o]=pos[a];lpos[o+1]=pos[a+1];lpos[o+2]=pos[a+2];
      lpos[o+3]=pos[b];lpos[o+4]=pos[b+1];lpos[o+5]=pos[b+2];
    }
    lgeo.attributes.position.needsUpdate = true;
    pmat.opacity = S.pts; lmat.opacity = S.edge;

    cx += (mx - cx) * 0.04; cy += (my - cy) * 0.04;
    group.rotation.y = cx * 0.18; group.rotation.x = -cy * 0.12;
    renderer.render(scene, camera);
  }
  frame();

  // ---- the film ----
  const tl = gsap.timeline({ onComplete: finish });
  tl.to(S, { pts: 1, edge: 1, duration: 1.0, ease: "power1.out" }, 0.1)
    .to(wComplex, { opacity: 0.92, duration: 0.8, ease: "power1.out" }, 0.6)
    .to(S, { morph: 1, duration: 2.8, ease: "power2.inOut" }, 1.3)   // self-organize -> RM
    .to(S, { jitter: 0.12, duration: 2.8, ease: "power2.inOut" }, 1.3)
    .to(S, { edge: 0.18, duration: 2.4, ease: "power1.inOut" }, 1.6)  // connections thin = clarity
    .to(wComplex, { opacity: 0, duration: 0.7 }, 3.0)
    .to(wClarity, { opacity: 1, duration: 0.9, ease: "power1.out" }, 3.1)
    .to({}, { duration: 0.5 })                                        // hold RM
    .to(S, { morph: 2, duration: 1.0, ease: "power2.inOut" }, 4.4)    // RM -> phone silhouette
    .to(S, { edge: 0, duration: 0.8 }, 4.4)
    .to([wClarity], { opacity: 0, duration: 0.6 }, 4.7)
    .to(el, { autoAlpha: 0, duration: 0.9, ease: "power2.inOut" }, 5.2); // dissolve into hero

  function finish() {
    cancelAnimationFrame(raf);
    removeEventListener("pointermove", onMove);
    renderer.dispose();
    teardown(el);
  }

  // hard safety: never trap the visitor
  setTimeout(() => { if (document.getElementById("preloader")) { gsap.killTweensOf(S); finish(); } }, 9000);
  addEventListener("resize", () => {
    renderer.setSize(innerWidth, innerHeight, false);
    camera.aspect = innerWidth / innerHeight; camera.updateProjectionMatrix();
  });
}

if (document.readyState !== "loading") init();
else document.addEventListener("DOMContentLoaded", init);
