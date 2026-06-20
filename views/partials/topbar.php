<?php /* views/partials/topbar.php */ $site = $site ?? content('site'); ?>
<header class="topbar" data-topbar>
  <div class="topbar__inner">
    <a class="brand" href="<?= url('/') ?>" aria-label="<?= e($site['name']) ?>, home">
      <span class="brand-mark" aria-hidden="true">RM</span>
      <span class="brand-name"><?= e($site['name']) ?></span>
    </a>
    <div class="topbar-controls">
      <button class="ctrl-btn theme-btn" type="button" data-theme-toggle aria-label="Switch colour theme">
        <svg class="moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
        <svg class="sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
      </button>
      <button class="ctrl-btn menu-btn" type="button" data-menu-trigger aria-haspopup="true" aria-expanded="false" aria-controls="site-menu" aria-label="Open menu">
        <span class="bar h" aria-hidden="true"></span>
        <span class="bar v" aria-hidden="true"></span>
      </button>
    </div>
  </div>
</header>
