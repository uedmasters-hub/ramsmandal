/* =========================================================================
   core/dot-field.js  — THE SIGNATURE SYSTEM
   One living field of dots. Everything emerges from it and returns to it.
   A single 2D canvas behind the whole site. Soft gray dots on near-white,
   breathing like a living system, reacting to the cursor. Dots reorganize
   between formations (grid, RM, phone, tablet, laptop, spread); they never
   disappear. Dots belong to the environment only, never the interface.
   ========================================================================= */

const N_DESKTOP = 1400, N_MOBILE = 820;

class DotField {
  constructor() {
    this.canvas = document.getElementById("dotfield");
    if (!this.canvas) return;
    this.ctx = this.canvas.getContext("2d");
    this.reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
    this.fine = matchMedia("(hover: hover) and (pointer: fine)").matches;
    this.N = innerWidth < 760 ? N_MOBILE : N_DESKTOP;

    this.from = "grid"; this.to = "grid"; this.mix = 0;
    this.opacity = 0;            // global fade (intro reveal)
    this.ink = 0;                // 0 rest grid, 1 formed symbol/device
    this.t = 0;
    this.mx = 0; this.my = 0; this.cx = 0; this.cy = 0;
    this._visible = true;

    // idle "burst": when nothing happens the shape explodes into a floating,
    // colourful dot field; on the next pointer move / touch it reforms.
    this.burst = 0; this.targetBurst = 0; this.idleEnabled = false;
    this.idleTimer = null; this.IDLE_MS = 2600;

    this.dots = new Array(this.N);
    this.target = new Float32Array(this.N * 2);

    this._resize();
    this._buildAll();
    // seed positions on the grid
    for (let i = 0; i < this.N; i++) {
      this.dots[i] = {
        x: this.forms.grid[i*2], y: this.forms.grid[i*2+1],
        z: Math.random(), seed: Math.random() * 6.2831, r: 1.0 + Math.random() * 0.7,
        a: 0.3 + Math.random() * 0.35,
        hue: Math.random() * 360,            // colour while floating
        bigR: 1.4 + Math.random() * 4.6,     // varied size while floating (small..big)
        fvx: 0, fvy: 0,                      // float velocity
      };
    }

    addEventListener("resize", () => { this._resize(); this._buildAll(); }, { passive: true });
    document.addEventListener("visibilitychange", () => {
      this._visible = !document.hidden;
      if (this._visible) this._loop();
    });
    if (this.fine) addEventListener("pointermove", (e) => {
      this.mx = e.clientX; this.my = e.clientY;
    }, { passive: true });

    // activity = reform; silence = burst (enabled only after the intro)
    const wake = () => this._markActive();
    ["pointerdown", "pointermove", "wheel", "touchstart", "touchmove", "keydown", "scroll"]
      .forEach((ev) => addEventListener(ev, wake, { passive: true }));
    addEventListener("intro:done", () => this.enableIdle(), { once: true });

    this._loop();
  }

  _markActive() {
    if (!this.idleEnabled) return;
    this.targetBurst = 0;                                     // reform
    clearTimeout(this.idleTimer);
    this.idleTimer = setTimeout(() => this._goIdle(), this.IDLE_MS);
  }
  _goIdle() {
    this.targetBurst = 1;                                     // burst
    for (const d of this.dots) {                              // explosion kick
      const a = Math.random() * 6.2831, s = 1.5 + Math.random() * 3.5;
      d.fvx = Math.cos(a) * s; d.fvy = Math.sin(a) * s;
    }
  }
  enableIdle() { this.idleEnabled = true; this._markActive(); }

  _resize() {
    this.dpr = Math.min(devicePixelRatio || 1, 2);
    this.w = innerWidth; this.h = innerHeight;
    this.canvas.width = this.w * this.dpr; this.canvas.height = this.h * this.dpr;
    this.canvas.style.width = this.w + "px"; this.canvas.style.height = this.h + "px";
    this.ctx.setTransform(this.dpr, 0, 0, this.dpr, 0, 0);
  }

  /* ---------- formations (each returns N*2 positions, sorted for coherent morphs) ---------- */
  _buildAll() {
    this.forms = {
      grid:   this._grid(),
      rm:     this._sample((c) => this._drawText(c, "RM")),
      phone:  this._sample((c) => this._drawDevice(c, "phone")),
      tablet: this._sample((c) => this._drawDevice(c, "tablet")),
      laptop: this._sample((c) => this._drawDevice(c, "laptop")),
      spread: this._spread(),
    };
    for (const k in this.forms) this._sortByAngle(this.forms[k]);
  }

  _grid() {
    const out = new Float32Array(this.N * 2);
    const aspect = this.w / this.h;
    const cols = Math.round(Math.sqrt(this.N * aspect));
    const rows = Math.ceil(this.N / cols);
    const mx = this.w * 0.06, my = this.h * 0.08;
    const gw = this.w - mx * 2, gh = this.h - my * 2;
    for (let i = 0; i < this.N; i++) {
      const c = i % cols, r = Math.floor(i / cols);
      out[i*2]   = mx + (cols <= 1 ? gw/2 : (c / (cols - 1)) * gw);
      out[i*2+1] = my + (rows <= 1 ? gh/2 : (r / (rows - 1)) * gh);
    }
    return out;
  }

  _spread() {
    const out = new Float32Array(this.N * 2);
    for (let i = 0; i < this.N; i++) {
      out[i*2]   = Math.random() * this.w;
      out[i*2+1] = Math.random() * this.h;
    }
    return out;
  }

  _sample(drawFn) {
    const off = document.createElement("canvas");
    off.width = this.w; off.height = this.h;
    const c = off.getContext("2d");
    c.clearRect(0, 0, this.w, this.h);
    c.fillStyle = "#000"; c.strokeStyle = "#000";
    drawFn(c);
    const data = c.getImageData(0, 0, this.w, this.h).data;
    const pts = [];
    const step = 4;
    for (let y = 0; y < this.h; y += step)
      for (let x = 0; x < this.w; x += step)
        if (data[(y * this.w + x) * 4 + 3] > 40) pts.push(x, y);
    const out = new Float32Array(this.N * 2);
    const count = pts.length / 2;
    if (count === 0) return this._grid();
    for (let i = 0; i < this.N; i++) {
      const j = Math.floor((i * count) / this.N) * 2;
      out[i*2] = pts[j]; out[i*2+1] = pts[j+1];
    }
    return out;
  }

  _drawText(c, text) {
    const size = Math.min(this.w, this.h) * 0.46;
    c.font = `800 ${size}px Manrope, Inter, system-ui, sans-serif`;
    c.textAlign = "center"; c.textBaseline = "middle";
    c.fillText(text, this.w / 2, this.h * 0.46);
  }

  _roundRect(c, x, y, w, h, r) {
    c.beginPath();
    c.moveTo(x + r, y);
    c.arcTo(x + w, y, x + w, y + h, r);
    c.arcTo(x + w, y + h, x, y + h, r);
    c.arcTo(x, y + h, x, y, r);
    c.arcTo(x, y, x + w, y, r);
    c.closePath();
  }

  _drawDevice(c, kind) {
    const cx = this.w / 2, cy = this.h * 0.46;
    c.lineWidth = 7;
    let sw, sh, r;
    if (kind === "phone")  {
      const mobile = this.w <= 760;
      const pw = mobile ? this.w * 0.82 : Math.min(this.h * 0.9, this.w * 0.60); // wide on desktop
      const ph = pw * 1.95;                                  // tall -> crops off the bottom
      const pr = pw * 0.14;
      const px = cx - pw / 2;
      const py = this.h * (mobile ? 0.16 : 0.12);            // top-anchored: space above, crop below
      c.lineWidth = mobile ? 7 : 8;
      this._roundRect(c, px, py, pw, ph, pr); c.stroke();
      const nw = pw * 0.28, nh = Math.max(4, pw * 0.04);
      this._roundRect(c, cx - nw / 2, py + pw * 0.09, nw, nh, nh / 2); c.fill();   // notch
      c.fillRect(px + pw - 2, py + ph * 0.13, 5, ph * 0.05);                        // side button
      return;                                                                       // skip the shared centered draw
    }
    if (kind === "tablet") {
      if (this.w <= 760) {
        const tw = this.w * 0.9, th = tw * 1.35, tr = tw * 0.05;   // big portrait frame, crops below
        const tx = cx - tw / 2, ty = this.h * 0.11;
        c.lineWidth = 6;
        this._roundRect(c, tx, ty, tw, th, tr); c.stroke();
        c.beginPath(); c.arc(cx, ty + tw * 0.05, 4, 0, 6.29); c.fill();
        return;
      }
      const tw = Math.min(this.w * 0.9, this.h * 1.3);     // clearly wider than the phone
      const th = tw * 1.15;                                // crops off the bottom
      const tr = tw * 0.045;                               // tablet: gentle corners
      const tx = cx - tw / 2, ty = this.h * 0.13;          // top-anchored
      c.lineWidth = 7;
      this._roundRect(c, tx, ty, tw, th, tr); c.stroke();
      c.beginPath(); c.arc(cx, ty + tw * 0.045, 4, 0, 6.29); c.fill();   // front camera
      return;
    }
    if (kind === "laptop") {
      if (this.w <= 760) {
        const lw = this.w * 0.96, lh = lw * 1.2, lr = lw * 0.04;   // widest mobile frame, crops below
        const lx = cx - lw / 2, ly = this.h * 0.1;
        c.lineWidth = 6;
        this._roundRect(c, lx, ly, lw, lh, lr); c.stroke();
        return;
      }
      const lw = Math.min(this.w * 0.88, this.h * 1.5);    // widest device (landscape)
      const lh = lw * 0.58;                                // landscape screen
      const block = lh + lh * 0.09;                        // screen + keyboard base
      const lx = cx - lw / 2, ly = cy - block / 2;
      c.lineWidth = 7;
      this._roundRect(c, lx, ly, lw, lh, 16); c.stroke();  // screen
      const dw = lw * 1.14, dh = lh * 0.09;                // keyboard base (trapezoid)
      c.beginPath();
      c.moveTo(cx - lw / 2, ly + lh);
      c.lineTo(cx + lw / 2, ly + lh);
      c.lineTo(cx + dw / 2, ly + lh + dh);
      c.lineTo(cx - dw / 2, ly + lh + dh);
      c.closePath(); c.stroke();
      c.beginPath(); c.arc(cx, ly + 9, 3, 0, 6.29); c.fill();  // webcam
      return;
    }
  }

  _sortByAngle(arr) {
    const n = arr.length / 2;
    const idx = Array.from({ length: n }, (_, i) => i);
    const cx = this.w / 2, cy = this.h / 2;
    idx.sort((a, b) =>
      Math.atan2(arr[a*2+1] - cy, arr[a*2] - cx) - Math.atan2(arr[b*2+1] - cy, arr[b*2] - cx));
    const copy = arr.slice();
    for (let i = 0; i < n; i++) { arr[i*2] = copy[idx[i]*2]; arr[i*2+1] = copy[idx[i]*2+1]; }
  }

  /* ---------- public control ---------- */
  setMorph(from, to, mix) { this.from = from; this.to = to; this.mix = Math.max(0, Math.min(1, mix)); }
  // break & reform: from -> via (scatter) -> to. Dots dissolve into the field, then gather again.
  setMorphVia(from, via, to, t) {
    t = Math.max(0, Math.min(1, t));
    if (t < 0.5) this.setMorph(from, via, t * 2);
    else this.setMorph(via, to, (t - 0.5) * 2);
  }
  morphSequence(list, p) {
    const seg = Math.max(0, Math.min(1, p)) * (list.length - 1);
    const i = Math.min(list.length - 2, Math.floor(seg));
    this.setMorph(list[i], list[i + 1], seg - i);
  }

  /* ---------- render ---------- */
  _loop() {
    if (!this._visible) return;
    requestAnimationFrame(() => this._loop());
    this.t += 0.016;
    this.cx += (this.mx - this.cx) * 0.05;
    this.cy += (this.my - this.cy) * 0.05;

    const A = this.forms[this.from], B = this.forms[this.to], mix = this.mix;
    const ctx = this.ctx;
    ctx.clearRect(0, 0, this.w, this.h);

    // ease burst: slow to explode, quicker to reform
    const tgt = this.idleEnabled ? this.targetBurst : 0;
    this.burst += (tgt - this.burst) * (tgt > this.burst ? 0.012 : 0.07);
    if (this.burst < 0.001) this.burst = 0;
    const burst = this.burst, pull = 1 - burst;

    const inkCol = 20, restCol = 175;
    const px = (this.cx - this.w / 2), py = (this.cy - this.h / 2);

    for (let i = 0; i < this.N; i++) {
      const d = this.dots[i];
      const tx = A[i*2] + (B[i*2] - A[i*2]) * mix;
      const ty = A[i*2+1] + (B[i*2+1] - A[i*2+1]) * mix;
      // pull toward the shape (scaled down while bursting)
      d.x += (tx - d.x) * 0.085 * pull;
      d.y += (ty - d.y) * 0.085 * pull;
      // free float while bursting
      if (burst > 0.02) {
        d.x += d.fvx * burst; d.y += d.fvy * burst;
        d.fvx += (Math.random() - 0.5) * 0.10; d.fvy += (Math.random() - 0.5) * 0.10;
        d.fvx *= 0.97; d.fvy *= 0.97;
        if (d.x < 4 && d.fvx < 0) d.fvx = -d.fvx;
        if (d.x > this.w - 4 && d.fvx > 0) d.fvx = -d.fvx;
        if (d.y < 4 && d.fvy < 0) d.fvy = -d.fvy;
        if (d.y > this.h - 4 && d.fvy > 0) d.fvy = -d.fvy;
      }

      // breathing + cursor depth parallax + gentle attraction (fade out while bursting)
      const breath = this.reduce ? 0 : Math.sin(this.t * 1.3 + d.seed) * 0.5;
      let dx = d.x + px * d.z * 0.04 * pull;
      let dy = d.y + py * d.z * 0.04 * pull;
      if (this.fine && !this.reduce && burst < 0.5) {
        const ax = this.cx - dx, ay = this.cy - dy, dist = Math.hypot(ax, ay);
        if (dist < 140) { const f = (1 - dist / 140) * 6 * pull; dx += (ax / dist) * f; dy += (ay / dist) * f; }
      }

      const rad = Math.max(0.4, d.r * (1 + breath * 0.18) * pull + d.bigR * burst);  // small..big while floating
      if (burst < 0.02) {
        const tone = Math.round(restCol + (inkCol - restCol) * this.ink);
        ctx.globalAlpha = Math.max(0, (d.a * (0.55 + 0.45 * d.z)) * this.opacity * (0.6 + 0.4 * this.ink));
        ctx.fillStyle = `rgb(${tone},${tone},${tone + 4})`;
      } else {
        ctx.globalAlpha = Math.max(0, (0.45 + 0.5 * d.z) * Math.max(this.opacity, 0.75));
        ctx.fillStyle = `hsl(${d.hue}, ${Math.round(72 * burst)}%, 58%)`;            // gray -> colour
      }
      ctx.beginPath();
      ctx.arc(dx, dy, rad, 0, 6.2832);
      ctx.fill();
    }
    ctx.globalAlpha = 1;
  }
}

let _field = null;
export function dotField() {
  if (_field === null) _field = new DotField();
  return _field;
}

// auto-init as the site-wide background (rests on the grid)
const f = dotField();
if (f && f.canvas) {
  // fade the resting field in softly
  let o = 0; const fade = () => { o = Math.min(1, o + 0.03); f.opacity = o * 0.5; if (o < 1) requestAnimationFrame(fade); };
  fade();
}