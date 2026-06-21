/* core/contact.js — composes a professional email to the inbox from the contact
   form. Progressive enhancement: without JS the form's mailto action still works. */
(function () {
  "use strict";

  function init() {
    var wrap = document.querySelector("[data-contact]");
    if (!wrap) return;
    var form  = wrap.querySelector(".contact__form");
    var inbox = wrap.getAttribute("data-inbox");
    var status = wrap.querySelector("[data-contact-status]");
    if (!form || !inbox) return;

    function val(id) { var el = form.querySelector(id); return el ? el.value.trim() : ""; }

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      if (typeof form.reportValidity === "function" && !form.reportValidity()) return;

      var name    = val("#cf-name");
      var sender  = val("#cf-email");
      var topic   = val("#cf-topic");
      var message = val("#cf-message");

      var subject = "[ramsmandal.com] " + topic + (name ? " — " + name : "");
      var body =
        "Hi Ramesh,\n\n" +
        message + "\n\n" +
        "—\n" +
        "Name:  " + name + "\n" +
        "Email: " + sender + "\n" +
        "Topic: " + topic + "\n" +
        "Sent from ramsmandal.com/contact";

      var href = "mailto:" + inbox +
        "?subject=" + encodeURIComponent(subject) +
        "&body="    + encodeURIComponent(body);

      if (status) status.textContent = "Opening your email app…";
      window.location.href = href;
    });
  }

  if (document.readyState !== "loading") init();
  else document.addEventListener("DOMContentLoaded", init);
})();
