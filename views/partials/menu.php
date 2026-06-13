<?php /* views/partials/menu.php — Home/Work/About/Contact, driven by site nav */
$site = $site ?? content('site');
$current = $current ?? ($currentKey ?? '');
?>
<div class="menu-scrim" data-menu-close hidden></div>
<nav id="site-menu" class="site-menu" aria-label="Primary" inert>
  <ul class="site-menu__list">
    <?php foreach ($site['nav'] as $item): ?>
    <li><a href="<?= url($item['path']) ?>"<?= $current === $item['key'] ? ' aria-current="page"' : '' ?>><?= e($item['label']) ?></a></li>
    <?php endforeach; ?>
  </ul>
  <div class="site-menu__foot">
    <a class="mail" href="mailto:<?= e($site['contact']['email']) ?>"><?= e($site['contact']['email']) ?></a>
    <span class="social">
      <?php foreach ($site['social'] as $s): ?>
      <a href="<?= e($s['url']) ?>" aria-label="<?= e($s['label']) ?>">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9h4v12H3zM9 9h3.8v1.7h.05c.53-1 1.83-2.05 3.77-2.05C20.4 8.65 21 11 21 14.1V21h-4v-6.1c0-1.45-.03-3.3-2-3.3s-2.3 1.57-2.3 3.2V21H9z"/></svg>
      </a>
      <?php endforeach; ?>
      <a href="mailto:<?= e($site['contact']['email']) ?>" aria-label="Email">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
      </a>
    </span>
  </div>
</nav>
