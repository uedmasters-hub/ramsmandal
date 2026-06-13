/* =========================================================================
   webgl/environment.js
   A living atmosphere, not a particle toy. One full-frame plane runs a slow
   domain-warped flow field. As progress climbs 0 -> 1 the field gains
   structure (filaments / nodes): focused craft becoming a connected system.

   Budget: single WebGLRenderer, DPR capped at 1.75, paused when hidden,
   no continuous loop under reduced motion. 60fps target on a 2-octave warp.
   ========================================================================= */

import * as THREE from "three";

const VERT = /* glsl */ `
  varying vec2 vUv;
  void main() { vUv = uv; gl_Position = vec4(position, 1.0); }
`;

const FRAG = /* glsl */ `
  precision highp float;
  varying vec2 vUv;
  uniform vec2  uRes;
  uniform float uTime;
  uniform float uProgress;   // 0..1 scroll progress
  uniform vec3  uBg;
  uniform vec3  uInk;
  uniform vec3  uAccent;

  // hash / value noise
  float hash(vec2 p){ p = fract(p*vec2(123.34,456.21)); p += dot(p,p+45.32); return fract(p.x*p.y); }
  float noise(vec2 p){
    vec2 i = floor(p), f = fract(p);
    float a = hash(i), b = hash(i+vec2(1,0)), c = hash(i+vec2(0,1)), d = hash(i+vec2(1,1));
    vec2 u = f*f*(3.0-2.0*f);
    return mix(mix(a,b,u.x), mix(c,d,u.x), u.y);
  }
  float fbm(vec2 p){
    float v = 0.0, a = 0.5;
    for(int i=0;i<4;i++){ v += a*noise(p); p *= 2.0; a *= 0.5; }
    return v;
  }

  void main(){
    vec2 uv = vUv;
    float agitate = mix(0.6, 1.6, uProgress);

    // domain warp -> flowing field
    vec2 q = vec2(fbm(uv*2.0 + uTime*0.03), fbm(uv*2.0 - uTime*0.025 + 7.3));
    float f = fbm(uv*3.0 + q*agitate + uTime*0.02);

    // base atmosphere: bg <-> ink, very low contrast
    vec3 col = mix(uBg, uInk, smoothstep(0.35, 0.85, f) * 0.16);

    // filaments / connective structure emerge with progress
    float ridges = abs(fbm(uv*4.0 + q*2.0 - uTime*0.04) - 0.5);
    float fil = smoothstep(0.06, 0.0, ridges) * smoothstep(0.15, 0.9, uProgress);
    col = mix(col, uAccent, fil * 0.5);

    // soft node glints late in the journey
    float nodes = smoothstep(0.86, 0.99, noise(uv*9.0 + floor(uTime*0.4))) * smoothstep(0.55, 1.0, uProgress);
    col += uAccent * nodes * 0.35;

    // gentle vignette for depth
    float vig = smoothstep(1.2, 0.2, length(uv-0.5));
    col = mix(col*0.96, col, vig);

    gl_FragColor = vec4(col, 1.0);
  }
`;

export class Environment {
  constructor(canvas) {
    this.canvas = canvas;
    this.enabled = !!canvas && this._supportsWebGL();
    this._raf = 0;
    this._visible = true;
    this._progress = 0;
    this._target = 0;
    this._clock = new THREE.Clock();
    if (this.enabled) this._init();
  }

  _supportsWebGL() {
    try { return !!document.createElement("canvas").getContext("webgl2"); }
    catch (e) { return false; }
  }

  _init() {
    this.renderer = new THREE.WebGLRenderer({ canvas: this.canvas, antialias: false, alpha: false });
    this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.75));
    this.scene = new THREE.Scene();
    this.camera = new THREE.Camera();

    this.uniforms = {
      uRes:      { value: new THREE.Vector2(1, 1) },
      uTime:     { value: 0 },
      uProgress: { value: 0 },
      uBg:       { value: new THREE.Color(0xf5f5f3) },
      uInk:      { value: new THREE.Color(0x0f0f0f) },
      uAccent:   { value: new THREE.Color(0x1a46c9) },
    };
    const mat = new THREE.ShaderMaterial({ vertexShader: VERT, fragmentShader: FRAG, uniforms: this.uniforms });
    this.scene.add(new THREE.Mesh(new THREE.PlaneGeometry(2, 2), mat));

    this.setThemeFromCSS();
    this.resize();
    window.addEventListener("resize", this._onResize = () => this.resize());
    document.addEventListener("visibilitychange", this._onVis = () => {
      this._visible = !document.hidden;
      if (this._visible) this._loop(); else cancelAnimationFrame(this._raf);
    });

    // reduced motion: render one static frame and stop
    if (matchMedia("(prefers-reduced-motion: reduce)").matches) {
      this.uniforms.uProgress.value = 0.5;
      this.renderer.render(this.scene, this.camera);
    } else {
      this._loop();
    }
  }

  setThemeFromCSS() {
    if (!this.enabled) return;
    const cs = getComputedStyle(document.documentElement);
    const read = (n, fb) => (cs.getPropertyValue(n).trim() || fb);
    this.uniforms.uBg.value.set(read("--bg", "#f5f5f3"));
    this.uniforms.uInk.value.set(read("--text-primary", "#0f0f0f"));
    this.uniforms.uAccent.value.set(read("--blue", "#1a46c9"));
  }

  setProgress(p) { this._target = Math.max(0, Math.min(1, p)); }

  resize() {
    if (!this.enabled) return;
    const w = this.canvas.clientWidth || window.innerWidth;
    const h = this.canvas.clientHeight || window.innerHeight;
    this.renderer.setSize(w, h, false);
    this.uniforms.uRes.value.set(w, h);
  }

  _loop() {
    if (!this.enabled || !this._visible) return;
    this._raf = requestAnimationFrame(() => this._loop());
    this.uniforms.uTime.value += this._clock.getDelta();
    // ease progress toward target for buttery scrub
    this._progress += (this._target - this._progress) * 0.08;
    this.uniforms.uProgress.value = this._progress;
    this.renderer.render(this.scene, this.camera);
  }

  dispose() {
    cancelAnimationFrame(this._raf);
    window.removeEventListener("resize", this._onResize);
    document.removeEventListener("visibilitychange", this._onVis);
    if (this.renderer) this.renderer.dispose();
  }
}
