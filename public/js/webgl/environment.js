/* =========================================================================
   webgl/environment.js  — LIVING SYSTEMS NETWORK
   Not a shader. A 3D field of nodes connected by edges: a living organization.
   Nodes breathe, connections flex, the whole field drifts with depth fog.
   Progress 0->1 grows density and brightness (focused craft -> connected system).
   Budget: single renderer, DPR<=1.75, ~92 nodes/capped edges, paused when hidden,
   static single frame under reduced motion. Theme-aware colours.
   ========================================================================= */

import * as THREE from "three";

export class Environment {
  constructor(canvas) {
    this.canvas = canvas;
    this.enabled = !!canvas && this._supports();
    this._raf = 0; this._visible = true; this._t = 0;
    this._progress = 0; this._target = 0;
    this._clock = new THREE.Clock();
    if (this.enabled) this._init();
  }

  _supports() {
    try { return !!document.createElement("canvas").getContext("webgl"); }
    catch (e) { return false; }
  }

  _init() {
    const w = this.canvas.clientWidth || window.innerWidth;
    const h = this.canvas.clientHeight || window.innerHeight;

    this.renderer = new THREE.WebGLRenderer({ canvas: this.canvas, antialias: true, alpha: true });
    this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.75));
    this.renderer.setSize(w, h, false);

    this.scene = new THREE.Scene();
    this.camera = new THREE.PerspectiveCamera(58, w / h, 0.1, 200);
    this.camera.position.set(0, 0, 46);

    this.group = new THREE.Group();
    this.scene.add(this.group);

    this._buildNetwork();
    this.setThemeFromCSS();

    window.addEventListener("resize", this._onResize = () => this.resize());
    document.addEventListener("visibilitychange", this._onVis = () => {
      this._visible = !document.hidden;
      if (this._visible) this._loop(); else cancelAnimationFrame(this._raf);
    });

    if (matchMedia("(prefers-reduced-motion: reduce)").matches) {
      this._progress = 0.4; this._update(0); this.renderer.render(this.scene, this.camera);
    } else { this._loop(); }
  }

  _buildNetwork() {
    const N = 92;
    const spread = new THREE.Vector3(58, 34, 30);
    this.base = [];
    for (let i = 0; i < N; i++) {
      this.base.push(new THREE.Vector3(
        (Math.random() - 0.5) * spread.x,
        (Math.random() - 0.5) * spread.y,
        (Math.random() - 0.5) * spread.z
      ));
    }
    const threshold = 13, maxPer = 3;
    this.edges = [];
    for (let i = 0; i < N; i++) {
      let added = 0; const order = [];
      for (let j = i + 1; j < N; j++) order.push([j, this.base[i].distanceTo(this.base[j])]);
      order.sort((a, b) => a[1] - b[1]);
      for (const pair of order) { if (added >= maxPer) break; if (pair[1] < threshold) { this.edges.push([i, pair[0]]); added++; } }
    }

    this.nodePos = new Float32Array(N * 3);
    const pg = new THREE.BufferGeometry();
    pg.setAttribute("position", new THREE.BufferAttribute(this.nodePos, 3));
    this.pointsMat = new THREE.PointsMaterial({ size: 1.5, sizeAttenuation: true, transparent: true, opacity: 0.9 });
    this.points = new THREE.Points(pg, this.pointsMat);
    this.group.add(this.points);

    this.linePos = new Float32Array(this.edges.length * 2 * 3);
    const lg = new THREE.BufferGeometry();
    lg.setAttribute("position", new THREE.BufferAttribute(this.linePos, 3));
    this.lineMat = new THREE.LineBasicMaterial({ transparent: true, opacity: 0.18 });
    this.lines = new THREE.LineSegments(lg, this.lineMat);
    this.group.add(this.lines);
  }

  setThemeFromCSS() {
    if (!this.enabled) return;
    const cs = getComputedStyle(document.documentElement);
    const read = (n, fb) => (cs.getPropertyValue(n).trim() || fb);
    const bg     = new THREE.Color(read("--bg", "#f5f5f3"));
    const ink    = new THREE.Color(read("--text-primary", "#0f0f0f"));
    const accent = new THREE.Color(read("--blue", "#1a46c9"));
    this.scene.fog = new THREE.Fog(bg.getHex(), 40, 96);
    this.pointsMat.color = ink;
    this.lineMat.color = accent;
  }

  setProgress(p) { this._target = Math.max(0, Math.min(1, p)); }

  resize() {
    if (!this.enabled) return;
    const w = this.canvas.clientWidth || window.innerWidth;
    const h = this.canvas.clientHeight || window.innerHeight;
    this.renderer.setSize(w, h, false);
    this.camera.aspect = w / h; this.camera.updateProjectionMatrix();
  }

  _update(dt) {
    this._t += dt;
    this._progress += (this._target - this._progress) * 0.07;
    const p = this._progress;

    for (let i = 0; i < this.base.length; i++) {
      const b = this.base[i], o = i * 3, amp = 0.6 + p * 0.7;
      this.nodePos[o]   = b.x + Math.sin(this._t * 0.4 + i) * amp;
      this.nodePos[o+1] = b.y + Math.cos(this._t * 0.33 + i * 1.3) * amp;
      this.nodePos[o+2] = b.z + Math.sin(this._t * 0.28 + i * 0.7) * amp;
    }
    this.points.geometry.attributes.position.needsUpdate = true;

    for (let e = 0; e < this.edges.length; e++) {
      const a = this.edges[e][0], b = this.edges[e][1], o = e * 6;
      this.linePos[o]   = this.nodePos[a*3];   this.linePos[o+1] = this.nodePos[a*3+1]; this.linePos[o+2] = this.nodePos[a*3+2];
      this.linePos[o+3] = this.nodePos[b*3];   this.linePos[o+4] = this.nodePos[b*3+1]; this.linePos[o+5] = this.nodePos[b*3+2];
    }
    this.lines.geometry.attributes.position.needsUpdate = true;

    this.group.scale.setScalar(1 + p * 0.18);
    this.group.rotation.y += dt * (0.02 + p * 0.03);
    this.group.rotation.x = Math.sin(this._t * 0.05) * 0.06;
    this.lineMat.opacity = 0.12 + p * 0.30;
    this.pointsMat.opacity = 0.55 + p * 0.4;
    this.pointsMat.size = 1.4 + p * 1.2;
    this.camera.position.z = 46 - p * 8;
  }

  _loop() {
    if (!this.enabled || !this._visible) return;
    this._raf = requestAnimationFrame(() => this._loop());
    this._update(Math.min(this._clock.getDelta(), 0.05));
    this.renderer.render(this.scene, this.camera);
  }

  dispose() {
    cancelAnimationFrame(this._raf);
    window.removeEventListener("resize", this._onResize);
    document.removeEventListener("visibilitychange", this._onVis);
    if (this.renderer) this.renderer.dispose();
  }
}
