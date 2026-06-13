/* =========================================
   CONTACT.JS — Form interactions
   ========================================= */

(function () {
  "use strict";

  const form       = document.getElementById("contact-form");
  const submitBtn  = document.getElementById("form-submit");
  const successEl  = document.getElementById("contact-success");
  const globalErr  = document.getElementById("form-global-error");
  const charCount  = document.getElementById("char-count");
  const messageEl  = document.getElementById("field-message");
  const csrfInput  = document.getElementById("csrf-token");

  if (!form) return;

  /* ── ENQUIRY TYPE TOGGLE ─────────────────── */

  document.querySelectorAll(".form-type-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      document.querySelectorAll(".form-type-btn").forEach(function (b) {
        b.classList.remove("is-active");
      });
      this.classList.add("is-active");
      document.getElementById("field-type").value = this.dataset.type;
    });
  });

  /* ── CHAR COUNT ──────────────────────────── */

  if (messageEl && charCount) {
    messageEl.addEventListener("input", function () {
      const len = this.value.length;
      charCount.textContent = len + " / 3000";
      charCount.classList.toggle("is-warning", len > 2700);
    });
  }

  /* ── FIELD VALIDATION ────────────────────── */

  function showError(fieldId, msg) {
    const input = document.getElementById("field-" + fieldId);
    const err   = document.getElementById("error-" + fieldId);
    if (input) input.classList.add("has-error");
    if (err)   { err.textContent = msg; err.classList.add("is-visible"); }
  }

  function clearErrors() {
    document.querySelectorAll(".form-input, .form-textarea").forEach(function (el) {
      el.classList.remove("has-error");
    });
    document.querySelectorAll(".form-error").forEach(function (el) {
      el.classList.remove("is-visible");
    });
    globalErr.classList.remove("is-visible");
  }

  /* ── REAL-TIME CLEAR ON INPUT ────────────── */

  form.querySelectorAll(".form-input, .form-textarea").forEach(function (el) {
    el.addEventListener("input", function () {
      this.classList.remove("has-error");
      const id  = this.id.replace("field-", "");
      const err = document.getElementById("error-" + id);
      if (err) err.classList.remove("is-visible");
    });
  });

  /* ── SUBMIT ──────────────────────────────── */

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    clearErrors();

    /* Loading state */
    submitBtn.disabled = true;
    submitBtn.classList.add("is-loading");

    const data = new FormData(form);

    fetch("api/contact.php", {
      method:  "POST",
      body:    data,
      headers: { "X-Requested-With": "XMLHttpRequest" }
    })
    .then(function (res) {
      /* capture status before parsing so we can check 429 */
      var status = res.status;
      return res.json().then(function(json) {
        json._status = status;
        return json;
      });
    })
    .then(function (json) {

      submitBtn.disabled = false;
      submitBtn.classList.remove("is-loading");

      /* ── RATE LIMIT: show countdown ── */
      if (json._status === 429 || (json.success === false && json.message && json.message.toLowerCase().includes("wait"))) {
        startRateCountdown(60);
        return;
      }

      if (json.success) {

        /* Update CSRF token for next submission */
        if (json.csrf_token && csrfInput) {
          csrfInput.value = json.csrf_token;
        }

        /* Hide entire form wrap (header + form), show success */
        const formWrap = document.querySelector(".contact-form-wrap");
        if (formWrap) formWrap.style.display = "none";
        form.style.display = "none";
        successEl.classList.add("is-visible");
        successEl.scrollIntoView({ behavior: "smooth", block: "center" });

      } else if (json.errors) {

        /* Field-level errors */
        Object.entries(json.errors).forEach(function ([field, msg]) {
          showError(field, msg);
        });

        /* Scroll to first error */
        const firstErr = form.querySelector(".has-error");
        if (firstErr) firstErr.scrollIntoView({ behavior: "smooth", block: "center" });

      } else {

        /* Global error */
        globalErr.textContent = json.message || "Something went wrong. Please try again.";
        globalErr.classList.add("is-visible");

      }

    })
    .catch(function () {

      submitBtn.disabled = false;
      submitBtn.classList.remove("is-loading");
      globalErr.textContent = "Network error. Please check your connection and try again.";
      globalErr.classList.add("is-visible");

    });

  });

  /* ── RATE LIMIT COUNTDOWN ── */
  function startRateCountdown(seconds) {
    let remaining = seconds;
    const bar     = document.getElementById("rate-bar-fill");
    const text    = document.getElementById("rate-countdown-text");
    const wrap    = document.getElementById("rate-countdown");

    if (!wrap) return;

    wrap.style.display = "block";
    globalErr.classList.remove("is-visible");
    submitBtn.disabled = true;

    /* Animate progress bar */
    setTimeout(function() {
      if (bar) bar.style.width = "0%";
    }, 50);

    const interval = setInterval(function() {
      remaining--;
      if (text) text.textContent = remaining + "s";
      if (bar)  bar.style.width  = ((seconds - remaining) / seconds * 100) + "%";

      if (remaining <= 0) {
        clearInterval(interval);
        wrap.style.display  = "none";
        submitBtn.disabled  = false;
        if (bar)  bar.style.width = "0%";
      }
    }, 1000);
  }

})();