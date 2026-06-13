<?php
/**
 * partials/header.php
 * Desktop header + Mobile drawer
 *
 * REQUIRES before including this file:
 *   $currentKey  (string)  — active nav key, e.g. "case-studies"
 *   $pageTitle   (string)  — optional page <title>
 *
 * BASE_PATH is read from config.php if not already defined.
 */

// ── Guard: define BASE_PATH if config wasn't loaded yet ──────────
if (!defined('BASE_PATH')) {
    $configPath = __DIR__ . '/../includes/config.php';
    if (file_exists($configPath)) {
        require_once $configPath;
    } else {
        define('BASE_PATH', ''); // live root fallback
    }
}

$currentKey = $currentKey ?? '';
$pageTitle  = $pageTitle  ?? 'Ramesh Mandal — UX Leader';

// ── Nav items ────────────────────────────────────────────────────
$navItems = [
    [
        'key'   => 'case-studies',
        'label' => 'Case Studies',
        'href'  => '/case-study/',
        'icon'  => 'fa-book-open',
    ],
    [
        'key'   => 'audits',
        'label' => 'UX Audits',
        'href'  => '/audit/',
        'icon'  => 'fa-magnifying-glass',
    ],
    [
        'key'   => 'blog',
        'label' => 'Stories & Essays',
        'href'  => '/blog/',
        'icon'  => 'fa-message',
    ],
    [
        'key'   => 'psychology',
        'label' => 'Behavioural Design',
        'href'  => '/psychology/',
        'icon'  => 'fa-brain',
    ],
    [
        'key'   => 'experiments',
        'label' => 'Experiments',
        'href'  => '/lab/',
        'icon'  => 'fa-vial-circle-check',
    ],
    [
        'key'   => 'resources',
        'label' => 'Toolkit',
        'href'  => '/resources.php',
        'icon'  => 'fa-toolbox',
    ],
    [
        'key'   => 'about',
        'label' => 'About',
        'href'  => '/about.php',
        'icon'  => 'fa-user',
    ],
];

// Desktop nav keys (subset)
$desktopKeys = ['case-studies', 'audits', 'blog', 'psychology', 'resources', 'about'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($pageTitle); ?></title>

  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- FONT AWESOME 6 FREE (icons in drawer) -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/assets/css/variables.css" />
  <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/assets/css/reset.css" />
  <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/assets/css/main.css" />
  <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/assets/css/background.css" />
  <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/assets/css/navigation.css" />
  <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/assets/css/animations.css" />
  <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/assets/css/cursor.css" />
</head>
<body>

<!-- SKIP LINK -->
<a href="#main" class="skip-link">Skip to content</a>

<!-- BACKGROUND -->
<div class="background" aria-hidden="true">
  <div class="grid"></div>
  <div class="mouse-light"></div>
</div>

<!-- ─────────────────────────────────────────────────
     HEADER
───────────────────────────────────────────────── -->
<header class="site-header" role="banner">

  <!-- Logo -->
  <a href="<?php echo BASE_PATH; ?>/" class="site-header__logo" aria-label="Ramesh Mandal — Home">
    <span class="logo-mark" aria-hidden="true">RM</span>
    <span class="logo-name">RAMESH MANDAL</span>
  </a>

  <!-- Desktop nav -->
  <nav class="site-header__nav" aria-label="Primary navigation">
    <?php foreach ($navItems as $item):
      if (!in_array($item['key'], $desktopKeys)) continue;
      $active = ($currentKey === $item['key']);
    ?>
      <a
        href="<?php echo BASE_PATH . htmlspecialchars($item['href']); ?>"
        class="nav-link<?php echo $active ? ' nav-link--active' : ''; ?>"
        <?php echo $active ? 'aria-current="page"' : ''; ?>
      ><?php echo htmlspecialchars($item['label']); ?></a>
    <?php endforeach; ?>
  </nav>

  <!-- Actions -->
  <div class="site-header__actions">
    <a href="<?php echo BASE_PATH; ?>/contact.php" class="btn-connect">Connect</a>
    <button
      class="hamburger"
      id="drawer-toggle"
      aria-label="Open navigation menu"
      aria-expanded="false"
      aria-controls="mobile-drawer"
    >
      <span class="hamburger__bar"></span>
      <span class="hamburger__bar"></span>
      <span class="hamburger__bar"></span>
    </button>
  </div>

</header>

<!-- ─────────────────────────────────────────────────
     MOBILE DRAWER
───────────────────────────────────────────────── -->
<div class="drawer-backdrop" id="drawer-backdrop" aria-hidden="true"></div>

<nav
  class="drawer"
  id="mobile-drawer"
  aria-label="Mobile navigation"
  aria-hidden="true"
  role="dialog"
  aria-modal="true"
>
  <!-- Drawer header -->
  <div class="drawer__header">
    <a href="<?php echo BASE_PATH; ?>/" class="drawer__logo" aria-label="Home">
      <span class="logo-mark" aria-hidden="true">RM</span>
      <span class="logo-name">RAMESH MANDAL</span>
    </a>
    <button class="drawer__close" id="drawer-close" aria-label="Close navigation menu">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
        <path d="M2 2l16 16M18 2L2 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
      </svg>
    </button>
  </div>

  <!-- Nav rows -->
  <ul class="drawer__nav" role="list">
    <?php foreach ($navItems as $i => $item):
      $active = ($currentKey === $item['key']);
    ?>
      <li
        class="drawer__item<?php echo $active ? ' drawer__item--active' : ''; ?>"
        style="--item-index: <?php echo $i; ?>;"
      >
        <a
          href="<?php echo BASE_PATH . htmlspecialchars($item['href']); ?>"
          class="drawer__link"
          <?php echo $active ? 'aria-current="page"' : ''; ?>
        >
          <span class="drawer__icon" aria-hidden="true">
            <i class="fa-solid <?php echo htmlspecialchars($item['icon']); ?>"></i>
          </span>
          <span class="drawer__label"><?php echo htmlspecialchars($item['label']); ?></span>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>

  <!-- Footer -->
  <div class="drawer__footer">
    <a href="<?php echo BASE_PATH; ?>/contact.php" class="drawer__cta">
      Connect
      <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
        <path d="M1 13L13 1M13 1H4M13 1v9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </a>
    <p class="drawer__availability">
      <span class="available-dot" aria-hidden="true"></span>
      Available for senior UX leadership roles
    </p>
  </div>

</nav>

<!-- ─────────────────────────────────────────────────
     MAIN CONTENT STARTS
───────────────────────────────────────────────── -->
<main id="main">