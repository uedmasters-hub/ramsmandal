<?php /* views/partials/footer.php */ $site = $site ?? content('site'); ?>
<footer class="site-footer">
  <div class="site-footer__inner">
    <span class="site-footer__line"><?= e($site['tagline']) ?></span>
    <a class="site-footer__mail" href="mailto:<?= e($site['contact']['email']) ?>"><?= e($site['contact']['email']) ?></a>
  </div>
</footer>
