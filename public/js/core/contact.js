/* core/contact.js — submits the contact form to the server (no mailbox opens).
   Progressive enhancement: without JS the form posts normally and the route
   re-renders with the result. */
(function () {
  "use strict";

  function init() {
    var wrap = document.querySelector("[data-contact]");
    if (!wrap) return;
    var form = wrap.querySelector(".contact__form");
    if (!form) return;
    var btn = form.querySelector(".contact__send");
    var labelEl = btn ? btn.querySelector("span") : null;
    var status = form.querySelector("[data-contact-status]");

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      if (typeof form.reportValidity === "function" && !form.reportValidity()) return;

      var original = labelEl ? labelEl.textContent : "";
      if (btn) btn.disabled = true;
      if (labelEl) labelEl.textContent = "Sending…";
      if (status) { status.textContent = ""; status.classList.remove("is-error"); }

      fetch(form.action, {
        method: "POST",
        headers: { "X-Requested-With": "fetch", "Accept": "application/json" },
        body: new FormData(form)
      })
        .then(function (r) { return r.json().catch(function () { return { ok: false }; }); })
        .then(function (data) {
          if (data && data.ok) {
            var panel = wrap.querySelector(".contact__panel");
            if (panel) {
              panel.innerHTML =
                '<div class="contact__sent" role="status">' +
                  '<strong>Message sent.</strong> ' +
                  '<span>Thanks for reaching out \u2014 I\u2019ll get back to you soon.</span>' +
                '</div>';
            }
          } else {
            if (btn) btn.disabled = false;
            if (labelEl) labelEl.textContent = original;
            if (status) {
              status.textContent = (data && data.error) || "Something went wrong. Please try again, or email me directly.";
              status.classList.add("is-error");
            }
          }
        })
        .catch(function () {
          if (btn) btn.disabled = false;
          if (labelEl) labelEl.textContent = original;
          if (status) {
            status.textContent = "Network error. Please try again, or email me directly.";
            status.classList.add("is-error");
          }
        });
    });
  }

  if (document.readyState !== "loading") init();
  else document.addEventListener("DOMContentLoaded", init);
})();
