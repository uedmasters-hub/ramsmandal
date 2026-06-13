/* =========================================================================
   webgl/environment.js — LIVING DIGITAL ECOSYSTEM
   Atmosphere over infrastructure. Layered soft particles (depth + glow),
   slow volumetric blooms, a few flowing energy trails, and cursor-driven
   spatial parallax. Progress 0->1 opens the world: more motion, depth, light.
   Fixed dark backdrop in both themes so additive glow reads. 60fps budget.
   ========================================================================= */

import * as THREE from "three";

export class Environment {
  constructor(canvas) {
    this.canvas = canvas;
    this.enabled = !!canvas && this._supports();
    this._raf = 0; this._visible = true; this._t = 0;
    this._p = 0; this._pt = 0;
    this._mx = 0; this._my = 0; this._cx = 0; this._cy = 0;
    this._fine = matchMedia("(hover: hover) and (pointer: fine)").matches;
    this._clock = new THREE.Clock();
    if (this.enabled) this._init();
  }

  _supports() { try { return !!document.createElement("canvas").getContext("webgl"); } catch (e) { return false; } }

  _accent() {
    const v = getComputedStyle(document.documentElement).getPropertyValue("--blue").trim();
    return new THREE.Color(v || "#3f6dff");
  }

  _init() {
    const w = this.canvas.clientWidth || innerWidth, h = this.canvas.clientHeight || innerHeight;
    this.renderer = new THREE.WebGLRenderer({ canvas: this.canvas, antialias: false, alpha: true });
    this.renderer.setPixelRatio(Math.min(devicePixelRatio, 1.75));
    this.renderer.setSize(w, h, false);
    this.dpr = Math.min(devicePixelRatio, 1.75);

    this.scene = new THREE.Scene();
    this.scene.fog = new THREE.FogExp2(0x06070c, 0.0085);
    this.camera = new THREE.PerspectiveCamera(60, w / h, 0.1, 400);
    this.camera.position.set(0, 0, 78);

    this.group = new THREE.Group();
    this.scene.add(this.group);

    this.tex = this._softTexture();
    const accent = this._accent();
    this.colA = accent.clone();
    this.colB = new THREE.Color(0x9fd0ff);

    this._buildParticles();
    this._buildBlooms();
    this._buildTrails();

    addEventListener("resize", this._onResize = () => this.resize());
    document.addEventListener("visibilitychange", this._onVis = () => {
      this._visible = !document.hidden;
      if (this._visible) this._loop(); else cancelAnimationFrame(this._raf);
    });
    if (this._fine) addEventListener("pointermove", this._onMove = (e) => {
      this._mx = (e.clientX / innerWidth) * 2 - 1;
      this._my = (e.clientY / innerHeight) * 2 - 1;
    }, { passive: true });

    if (matchMedia("(prefers-reduced-motion: reduce)").matches) {
      this._p = 0.35; this._frame(0); this.renderer.render(this.scene, this.camera);
    } else { this._loop(); }
  }

  _softTexture() {
    const s = 64, c = document.createElement("canvas"); c.width = c.height = s;
    const g = c.getContext("2d").createRadialGradient(s/2, s/2, 0, s/2, s/2, s/2);
    g.addColorStop(0, "rgba(255,255,255,1)");
    g.addColorStop(0.25, "rgba(255,255,255,0.55)");
    g.addColorStop(1, "rgba(255,255,255,0)");
    const ctx = c.getContext("2d"); ctx.fillStyle = g; ctx.fillRect(0, 0, s, s);
    const t = new THREE.CanvasTexture(c); t.needsUpdate = true; return t;
  }

  _buildParticles() {
    const COUNT = innerWidth < 760 ? 1400 : 2600;
    const pos = new Float32Array(COUNT * 3), scl = new Float32Array(COUNT), seed = new Float32Array(COUNT);
    for (let i = 0; i < COUNT; i++) {
      pos[i*3]   = (Math.random() - 0.5) * 150;
      pos[i*3+1] = (Math.random() - 0.5) * 95;
      pos[i*3+2] = (Math.random() - 0.5) * 120 - 20;
      scl[i] = 0.5 + Math.random() * 2.0;
      seed[i] = Math.random();
    }
    const g = new THREE.BufferGeometry();
    g.setAttribute("position", new THREE.BufferAttribute(pos, 3));
    g.setAttribute("aScale", new THREE.BufferAttribute(scl, 1));
    g.setAttribute("aSeed", new THREE.BufferAttribute(seed, 1));

    this.pUniforms = {
      uTime: { value: 0 }, uProgress: { value: 0 }, uSize: { value: 26 }, uDpr: { value: this.dpr },
      uTex: { value: this.tex }, uColorA: { value: this.colA }, uColorB: { value: this.colB }, uOpacity: { value: 0.5 },
    };
    const mat = new THREE.ShaderMaterial({
      uniforms: this.pUniforms, transparent: true, depthWrite: false, blending: THREE.AdditiveBlending,
      vertexShader: `
        uniform float uTime, uProgress, uSize, uDpr;
        attribute float aScale, aSeed; varying float vSeed, vFade;
        void main(){
          vSeed = aSeed; float s = aSeed*6.2831; float t = uTime*0.06;
          vec3 p = position;
          p.x += sin(t + s)*2.2; p.y += cos(t*0.9 + s)*2.2; p.z += sin(t*0.7 + s*1.3)*2.2;
          p *= (1.0 + uProgress*0.18);
          vec4 mv = modelViewMatrix * vec4(p,1.0); float dist = -mv.z;
          vFade = smoothstep(190.0, 15.0, dist);
          gl_PointSize = aScale * uSize * uDpr * (60.0/dist);
          gl_Position = projectionMatrix * mv;
        }`,
      fragmentShader: `
        uniform sampler2D uTex; uniform vec3 uColorA, uColorB; uniform float uOpacity;
        varying float vSeed, vFade;
        void main(){
          float a = texture2D(uTex, gl_PointCoord).a;
          vec3 c = mix(uColorA, uColorB, vSeed);
          gl_FragColor = vec4(c, a*vFade*uOpacity);
        }`,
    });
    this.particles = new THREE.Points(g, mat);
    this.group.add(this.particles);
  }

  _buildBlooms() {
    this.blooms = [];
    for (let i = 0; i < 3; i++) {
      const m = new THREE.SpriteMaterial({ map: this.tex, transparent: true, depthWrite: false,
        blending: THREE.AdditiveBlending, color: i === 1 ? this.colB : this.colA, opacity: 0.06 });
      const sp = new THREE.Sprite(m);
      sp.scale.setScalar(70 + i * 28);
      sp.position.set((i - 1) * 40, (i % 2 ? 1 : -1) * 18, -30 - i * 14);
      this.blooms.push(sp); this.group.add(sp);
    }
  }

  _buildTrails() {
    this.trailUniforms = { uTime: { value: 0 }, uColor: { value: this.colA }, uOpacity: { value: 0.0 } };
    const mat = new THREE.ShaderMaterial({
      uniforms: this.trailUniforms, transparent: true, depthWrite: false, blending: THREE.AdditiveBlending,
      vertexShader: `attribute float aT; varying float vT; void main(){ vT = aT;
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0); }`,
      fragmentShader: `uniform float uTime, uOpacity; uniform vec3 uColor; varying float vT;
        void main(){ float m = fract(vT - uTime*0.07);
          float glow = exp(-m*m*42.0) + exp(-(1.0-m)*(1.0-m)*42.0);
          gl_FragColor = vec4(uColor, (0.03 + glow*0.5) * uOpacity); }`,
    });
    this.trails = new THREE.Group();
    for (let k = 0; k < 6; k++) {
      const pts = [];
      for (let j = 0; j < 5; j++) pts.push(new THREE.Vector3((Math.random()-0.5)*130, (Math.random()-0.5)*80, (Math.random()-0.5)*90-10));
      const curve = new THREE.CatmullRomCurve3(pts);
      const sampled = curve.getPoints(120);
      const g = new THREE.BufferGeometry().setFromPoints(sampled);
      const aT = new Float32Array(sampled.length);
      for (let i = 0; i < sampled.length; i++) aT[i] = i / (sampled.length - 1);
      g.setAttribute("aT", new THREE.BufferAttribute(aT, 1));
      this.trails.add(new THREE.Line(g, mat));
    }
    this.group.add(this.trails);
  }

  setThemeFromCSS() {
    if (!this.enabled) return;
    this.colA.copy(this._accent());
    this.pUniforms.uColorA.value.copy(this.colA);
    this.trailUniforms.uColor.value.copy(this.colA);
  }

  setProgress(p) { this._pt = Math.max(0, Math.min(1, p)); }

  resize() {
    if (!this.enabled) return;
    const w = this.canvas.clientWidth || innerWidth, h = this.canvas.clientHeight || innerHeight;
    this.renderer.setSize(w, h, false);
    this.camera.aspect = w / h; this.camera.updateProjectionMatrix();
  }

  _frame(dt) {
    this._t += dt;
    this._p += (this._pt - this._p) * 0.06;
    const p = this._p;

    this.pUniforms.uTime.value = this._t;
    this.pUniforms.uProgress.value = p;
    this.pUniforms.uOpacity.value = 0.35 + p * 0.55;
    this.trailUniforms.uTime.value = this._t;
    this.trailUniforms.uOpacity.value = 0.15 + p * 0.6;
    this.blooms.forEach((b, i) => { b.material.opacity = 0.05 + p * 0.10; b.position.x += Math.sin(this._t*0.1 + i)*0.01; });

    this.group.rotation.y += dt * (0.01 + p * 0.02);

    // cursor parallax: spatial movement, not hover
    const amp = 6 + p * 8;
    this._cx += (this._mx - this._cx) * 0.04;
    this._cy += (this._my - this._cy) * 0.04;
    this.camera.position.x = this._cx * amp;
    this.camera.position.y = -this._cy * amp * 0.7;
    this.camera.position.z = 78 - p * 16;
    this.camera.lookAt(0, 0, 0);
  }

  _loop() {
    if (!this.enabled || !this._visible) return;
    this._raf = requestAnimationFrame(() => this._loop());
    this._frame(Math.min(this._clock.getDelta(), 0.05));
    this.renderer.render(this.scene, this.camera);
  }

  dispose() {
    cancelAnimationFrame(this._raf);
    removeEventListener("resize", this._onResize);
    document.removeEventListener("visibilitychange", this._onVis);
    if (this._onMove) removeEventListener("pointermove", this._onMove);
    if (this.renderer) this.renderer.dispose();
  }
}
