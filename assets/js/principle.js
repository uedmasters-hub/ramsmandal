/* =========================================
   PRINCIPLE.JS — Psychology article behaviours
   Vanilla only. Reading progress · scroll reveals ·
   reflection-effect demo. Reduced-motion aware.
   ========================================= */
(function () {
  "use strict";
  var reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ── Reading progress (shares #art-progress with article.css) ── */
  (function () {
    var bar = document.getElementById("art-progress");
    var main = document.getElementById("main-content");
    if (!bar || !main) return;
    window.addEventListener("scroll", function () {
      var h = main.scrollHeight - window.innerHeight;
      var pct = h > 0 ? Math.min(100, (window.scrollY / h) * 100) : 0;
      bar.style.width = pct + "%";
    }, { passive: true });
  })();

  /* ── Scroll reveals: fire once, threshold 0.2 ── */
  (function () {
    var els = document.querySelectorAll(".pr-reveal");
    if (!els.length) return;
    if (!("IntersectionObserver" in window) || reduced) {
      els.forEach(function (el) { el.classList.add("is-in"); });
      return;
    }
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add("is-in"); io.unobserve(e.target); }
      });
    }, { threshold: 0.2 });
    els.forEach(function (el) { io.observe(el); });
  })();

  /* ── Reflection-effect demo ── */
  (function () {
    var wrap = document.querySelector("[data-pr-demo='reflection']");
    if (!wrap) return;

    var choicesEl = wrap.querySelector("[data-pr-choices]");
    var stepEl = wrap.querySelector("[data-pr-step]");
    var promptEl = wrap.querySelector("[data-pr-prompt]");
    var subEl = wrap.querySelector("[data-pr-sub]");
    var progressEl = wrap.querySelector("[data-pr-progress]");
    var revealEl = wrap.querySelector("[data-pr-reveal]");
    var gainEl = wrap.querySelector("[data-pr-gain]");
    var lossEl = wrap.querySelector("[data-pr-loss]");
    var verdictEl = wrap.querySelector("[data-pr-verdict]");
    var restartEl = wrap.querySelector("[data-pr-restart]");
    if (!choicesEl) return;

    var state = { step: 0, picks: [] };
    var FRAMES = [
      {
        label: "Choice 1 of 2 \u00b7 A gain",
        prompt: "You\u2019re handed a decision. Which do you take?",
        sub: "Both options are worth \u20b9500 on average.",
        sure:   { tag: "The sure thing", main: "Take <b>\u20b9500</b>", detail: "Guaranteed. No risk." },
        gamble: { tag: "The coin flip",  main: "Flip for <b>\u20b91,000</b>", detail: "50% you win \u20b91,000, 50% you win nothing." }
      },
      {
        label: "Choice 2 of 2 \u00b7 A loss",
        prompt: "New scenario. You\u2019ve been given \u20b91,000 \u2014 now choose.",
        sub: "Both options leave you \u20b9500 on average.",
        sure:   { tag: "The sure thing", main: "Give back <b>\u20b9500</b>", detail: "Guaranteed. You keep \u20b9500, no risk." },
        gamble: { tag: "The coin flip",  main: "Flip to keep it", detail: "50% you keep all \u20b91,000, 50% you lose it all." }
      }
    ];

    function paint() {
      var f = FRAMES[state.step];
      stepEl.textContent = f.label;
      promptEl.textContent = f.prompt;
      subEl.textContent = f.sub;
      var btns = choicesEl.querySelectorAll(".pr-choice");
      var data = [f.sure, f.gamble];
      btns.forEach(function (b, i) {
        b.classList.remove("is-picked");
        b.querySelector(".pr-choice__tag").textContent = data[i].tag;
        b.querySelector(".pr-choice__main").innerHTML = data[i].main;
        b.querySelector(".pr-choice__detail").textContent = data[i].detail;
      });
      progressEl.textContent = state.step === 0 ? "Pick one to continue." : "One more.";
    }

    choicesEl.addEventListener("click", function (e) {
      var btn = e.target.closest(".pr-choice");
      if (!btn) return;
      state.picks[state.step] = btn.getAttribute("data-pick");
      btn.classList.add("is-picked");
      state.step++;
      if (state.step < FRAMES.length) { setTimeout(paint, 220); }
      else { setTimeout(showReveal, 260); }
    });

    function showReveal() {
      choicesEl.style.display = "none";
      progressEl.style.display = "none";
      var g = state.picks[0], l = state.picks[1];
      gainEl.textContent = g === "sure" ? "You took the sure \u20b9500" : "You gambled";
      gainEl.className = "pr-rc__pick " + (g === "sure" ? "is-sure" : "is-gamble");
      lossEl.textContent = l === "gamble" ? "You gambled to avoid the loss" : "You took the sure loss";
      lossEl.className = "pr-rc__pick " + (l === "gamble" ? "is-gamble" : "is-sure");

      if (g === "sure" && l === "gamble") {
        verdictEl.innerHTML = "You took the sure thing when it was a gain, then rolled the dice to dodge the loss \u2014 even though the odds and amounts were identical. That flip is loss aversion\u2019s signature: <b>we accept risks to avoid losses that we\u2019d never accept to chase gains.</b> Roughly three in four people choose exactly as you did.";
      } else if (g === l) {
        verdictEl.innerHTML = "You stayed consistent across both frames \u2014 rarer than you\u2019d expect. <b>Most people flip:</b> cautious with gains, suddenly bold when facing a loss. That the framing <em>can</em> flip behaviour at all is the whole point.";
      } else {
        verdictEl.innerHTML = "Interesting \u2014 you went the opposite way from the textbook pattern. <b>Most people protect gains and gamble on losses;</b> the reference point usually does the steering, even when we swear it doesn\u2019t.";
      }
      revealEl.classList.add("is-shown");
    }

    if (restartEl) {
      restartEl.addEventListener("click", function () {
        state = { step: 0, picks: [] };
        revealEl.classList.remove("is-shown");
        choicesEl.style.display = "";
        progressEl.style.display = "";
        paint();
      });
    }

    paint();
  })();
})();