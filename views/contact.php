<?php
/* views/contact.php — a working, useful contact page.
   The form composes a professional email to the inbox (mailto), with a
   no-JS fallback via the form's mailto action. */
$site   = content('site');
$inbox  = 'ramsmandal@gmail.com';                 // inquiries route here
$social = $site['social'] ?? [];

$page = [
  'title'      => 'Contact — Ramesh Mandal',
  'desc'       => 'Start a conversation about UX leadership roles, design systems consulting, or a product teardown.',
  'body_class' => 'page-contact',
  'styles'     => ['contact'],
  'scripts'    => ['core/reveal', 'core/contact'],
];

/* Map — centred on the given coordinates, no marker (OpenStreetMap embed, no key). */
$lat = 28.484504; $lon = 77.110418; $dx = 0.045; $dy = 0.028;
$bbox = implode('%2C', [$lon - $dx, $lat - $dy, $lon + $dx, $lat + $dy]);
$mapSrc = 'https://www.openstreetmap.org/export/embed.html?bbox=' . $bbox . '&layer=mapnik';

$mailFallback = 'mailto:' . $inbox . '?subject=' . rawurlencode('Inquiry via ramsmandal.com');
?>
<div class="contact" data-contact data-inbox="<?= e($inbox) ?>">

  <header class="contact__head" data-reveal>
    <span class="contact__eyebrow">● Contact</span>
    <h1 class="contact__title">Let&rsquo;s build something clear.</h1>
    <p class="contact__lead">Roles, consulting engagements, or a teardown of your product. Tell me what you&rsquo;re working on and I&rsquo;ll get back to you, usually within two business days.</p>
  </header>

  <div class="contact__grid">

    <section class="contact__panel" data-reveal>
      <form class="contact__form" action="<?= e($mailFallback) ?>" method="post" enctype="text/plain" novalidate>
        <div class="field">
          <label for="cf-name">Name</label>
          <input id="cf-name" name="name" type="text" autocomplete="name" required>
        </div>
        <div class="field">
          <label for="cf-email">Email</label>
          <input id="cf-email" name="email" type="email" autocomplete="email" inputmode="email" required>
        </div>
        <div class="field">
          <label for="cf-topic">What&rsquo;s this about?</label>
          <div class="select">
            <select id="cf-topic" name="topic">
              <option>A role or opportunity</option>
              <option>Consulting or design systems</option>
              <option>A product audit or teardown</option>
              <option>Something else</option>
            </select>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
          </div>
        </div>
        <div class="field">
          <label for="cf-message">Message</label>
          <textarea id="cf-message" name="message" rows="5" required></textarea>
        </div>
        <button class="contact__send" type="submit" data-cursor="Send">
          <span>Send message</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
        <p class="contact__hint" data-contact-status aria-live="polite">
          Opens in your email app, addressed to <a href="mailto:<?= e($inbox) ?>"><?= e($inbox) ?></a>.
        </p>
      </form>
    </section>

    <aside class="contact__aside">
      <div class="contact__card" data-reveal>
        <h2 class="contact__card-title">Reach me directly</h2>
        <ul class="contact__channels">
          <li>
            <a href="mailto:<?= e($inbox) ?>" data-cursor="Email">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
              <span><?= e($inbox) ?></span>
            </a>
          </li>
          <?php foreach ($social as $s): $url = $s['url'] ?? '#'; if ($url === '' || $url === '#') continue; ?>
          <li>
            <a href="<?= e($url) ?>" target="_blank" rel="noopener" data-cursor="<?= e($s['label']) ?>">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1"/><path d="M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/></svg>
              <span><?= e($s['label']) ?></span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="contact__card" data-reveal>
        <h2 class="contact__card-title">What I can help with</h2>
        <ul class="contact__help">
          <li>UX leadership and team direction</li>
          <li>Design systems, from audit to adoption</li>
          <li>Product and flow teardowns, with a fix plan</li>
        </ul>
      </div>

      <figure class="contact__map" data-reveal>
        <iframe title="Map of my base in Delhi NCR, India" src="<?= e($mapSrc) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <figcaption>Based in Delhi NCR, India &mdash; working with teams worldwide.</figcaption>
      </figure>
    </aside>

  </div>
</div>
