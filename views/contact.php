<?php
/* views/contact.php */
$site = content('site');
$page = ['title' => 'Contact — Ramesh Mandal', 'desc' => 'Get in touch.', 'body_class' => 'page-contact', 'styles' => ['contact'], 'scripts' => ['core/reveal']];
?>
<section class="contact">
  <h1>Let's talk</h1>
  <p>For roles, collaborations, or a teardown of your product.</p>
  <p class="contact__direct">
    <a href="mailto:<?= e($site['contact']['email']) ?>"><?= e($site['contact']['email']) ?></a><br>
    <a href="tel:<?= e(str_replace(' ', '', $site['contact']['phone'])) ?>"><?= e($site['contact']['phone']) ?></a>
  </p>
  <?php if (!empty($sent)): ?><p class="contact__sent">Thanks, your message is on its way.</p><?php endif; ?>
</section>
