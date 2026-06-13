<?php
/* views/404.php — editorial not-found */
$page = [
  'title'      => 'Page not found | Ramesh Mandal',
  'desc'       => 'The page you are looking for does not exist.',
  'body_class' => 'page-404',
  'styles'     => ['404'],
  'scripts'    => ['core/reveal'],
];
?>
<section class="nf">
  <p class="nf__code">Error 404</p>
  <h1 class="nf__title">This page doesn't exist.</h1>
  <p class="nf__text">The link may be broken, or the page may have moved. Here is the way back into the work.</p>
  <div class="nf__actions">
    <a class="nf__home" href="<?= url('/') ?>">Back to home
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
    </a>
    <nav class="nf__links" aria-label="Other pages">
      <a href="<?= url('/work') ?>">Work</a>
      <a href="<?= url('/about') ?>">About</a>
      <a href="<?= url('/contact') ?>">Contact</a>
    </nav>
  </div>
</section>
