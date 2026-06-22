<?php
/* =========================================================================
   views/layouts/base.php — the ONE shell. Every page renders into $content.
   Expects (all optional): $page['title','desc','body_class','styles','scripts']
   Globals always loaded: tokens, theme, reset, base, topbar, menu, footer.
   ========================================================================= */

$site    = content('site');
$title   = $page['title']      ?? $site['meta']['default_title'];
$desc    = $page['desc']       ?? $site['meta']['default_desc'];
$bodyCls = $page['body_class'] ?? '';
$crumbs  = build_breadcrumbs($_SERVER['REQUEST_URI'] ?? '/');
if (!empty($crumbs)) { $bodyCls = trim($bodyCls . ' has-breadcrumbs'); }
$styles  = $page['styles']     ?? [];
$scripts = $page['scripts']    ?? [];
$current = $currentKey         ?? '';
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title><?= e($title) ?></title>

  <!-- theme-color: light default, kept in sync by the guard below + core/theme.js -->
  <meta name="theme-color" content="#f5f5f3" id="theme-color-meta">

  <!-- FOUC + theme guard (the one accepted inline-JS exception): apply the saved
       theme and matching browser-chrome colour before first paint, no flash -->
  <script>
    (function () {
      var d = document.documentElement;
      d.className = "js";
      var dark = false;
      try {
        var t = localStorage.getItem("rm-theme");
        if (t === "light" || t === "dark") { d.setAttribute("data-theme", t); dark = t === "dark"; }
        else { dark = matchMedia("(prefers-color-scheme: dark)").matches; }
      } catch (e) {}
      var m = document.getElementById("theme-color-meta");
      if (m) m.content = dark ? "#0e0e0d" : "#f5f5f3";
    })();
  </script>

  <?php require VIEW_DIR . '/partials/seo.php'; ?>

  <link rel="icon" type="image/svg+xml" href="<?= asset_v('icons/favicon.svg') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= asset_v('icons/favicon-32.png') ?>">
  <link rel="icon" type="image/x-icon" href="<?= asset_v('icons/favicon.ico') ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= asset_v('icons/apple-touch-icon.png') ?>">
  <link rel="manifest" href="<?= asset('site.webmanifest') ?>">

  <!-- global stylesheets: tokens first -->
  <link rel="stylesheet" href="<?= asset_v('css/fonts.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/variables.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/theme.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/reset.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/base.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/topbar.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/menu.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/footer.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/footer-playground.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/breadcrumbs.css') ?>">
  <link rel="stylesheet" href="<?= asset_v('css/cursor.css') ?>">
  <?php foreach ($styles as $s): ?>
  <link rel="stylesheet" href="<?= asset_v("css/{$s}.css") ?>">
  <?php endforeach; ?>
  <?php if (!empty($page['importmap'])): ?>
  <script type="importmap"><?= $page['importmap'] ?></script>
  <?php endif; ?>
</head>
<body class="<?= e($bodyCls) ?>">

  <canvas id="dotfield" class="dotfield" aria-hidden="true"></canvas>

  <?php require VIEW_DIR . '/partials/topbar.php'; ?>

  <main id="main-content"><?php require VIEW_DIR . '/partials/breadcrumbs.php'; ?><?= $content ?></main>

  <?php require VIEW_DIR . '/partials/footer.php'; ?>
  <?php require VIEW_DIR . '/partials/menu.php'; ?>

  <!-- global scripts -->
  <script src="<?= asset('js/core/theme.js') ?>" defer></script>
  <script src="<?= asset('js/core/menu.js') ?>" defer></script>
  <script src="<?= asset('js/core/topbar.js') ?>" defer></script>
  <script src="<?= asset('js/core/cursor.js') ?>" defer></script>
  <script src="<?= asset('js/core/footer-curtain.js') ?>" defer></script>
  <?php foreach ($scripts as $j): ?>
  <script src="<?= asset("js/{$j}.js") ?>" defer></script>
  <?php endforeach; ?>
  <script type="module" src="<?= asset('js/core/dot-field.js') ?>"></script>
  <?php foreach (($page['modules'] ?? []) as $m): ?>
  <script type="module" src="<?= asset("js/{$m}.js") ?>"></script>
  <?php endforeach; ?>

</body>
</html>