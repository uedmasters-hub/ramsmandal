(function () {
  "use strict";

  const el = document.getElementById("typewriter");
  if (!el) return;

  /* inject cursor as sibling element */
  const cursor = document.createElement("span");
  cursor.className = "tw-cursor";
  cursor.setAttribute("aria-hidden", "true");
  el.insertAdjacentElement("afterend", cursor);

  const texts = [
    "modern digital products.",
    "AI-enabled workflows.",
    "enterprise UX systems.",
    "design infrastructure.",
    "scalable product teams."
  ];

  let textIdx  = 0;
  let charIdx  = 0;
  let deleting = false;

  function tick() {
    const current = texts[textIdx];

    if (!deleting) {
      el.textContent = current.slice(0, charIdx + 1);
      charIdx++;
      if (charIdx === current.length) {
        deleting = true;
        setTimeout(tick, 1800);
        return;
      }
    } else {
      el.textContent = current.slice(0, charIdx - 1);
      charIdx--;
      if (charIdx === 0) {
        deleting = false;
        textIdx  = (textIdx + 1) % texts.length;
      }
    }

    setTimeout(tick, deleting ? 42 : 78);
  }

  tick();
})();