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
  <meta name="description" content="<?= e($desc) ?>">

  <!-- FOUC + entrance guard (the one accepted inline-JS exception) -->
  <script>document.documentElement.className = "js";</script>

  <meta property="og:title" content="<?= e($title) ?>">
  <meta property="og:description" content="<?= e($desc) ?>">
  <meta property="og:type" content="website">
  <?php if (APP_URL): ?><meta property="og:image" content="<?= e(APP_URL . $site['meta']['og_image']) ?>"><?php endif; ?>
  <meta name="twitter:card" content="summary_large_image">

  <link rel="icon" type="image/svg+xml" href="<?= asset('icons/favicon.svg') ?>">
  <link rel="icon" type="image/x-icon" href="<?= asset('icons/favicon.ico') ?>">
  <meta name="theme-color" content="#0f0f0f">

  <!-- global stylesheets: tokens first -->
  <link rel="stylesheet" href="<?= asset('css/fonts.css') ?>">
  <link rel="stylesheet" href="<?= asset('css/variables.css') ?>">
  <link rel="stylesheet" href="<?= asset('css/theme.css') ?>">
  <link rel="stylesheet" href="<?= asset('css/reset.css') ?>">
  <link rel="stylesheet" href="<?= asset('css/base.css') ?>">
  <link rel="stylesheet" href="<?= asset('css/topbar.css') ?>">
  <link rel="stylesheet" href="<?= asset('css/menu.css') ?>">
  <link rel="stylesheet" href="<?= asset('css/footer.css') ?>">
  <link rel="stylesheet" href="<?= asset('footer-playground.css') ?>">
  <?php foreach ($styles as $s): ?>
  <link rel="stylesheet" href="<?= asset("css/{$s}.css") ?>">
  <?php endforeach; ?>
  <?php if (!empty($page['importmap'])): ?>
  <script type="importmap"><?= $page['importmap'] ?></script>
  <?php endif; ?>
</head>
<body class="<?= e($bodyCls) ?>">

  <canvas id="dotfield" class="dotfield" aria-hidden="true"></canvas>

  <?php require VIEW_DIR . '/partials/topbar.php'; ?>

  <main id="main-content"><?= $content ?></main>

  <?php require VIEW_DIR . '/partials/footer.php'; ?>
  <?php require VIEW_DIR . '/partials/menu.php'; ?>

  <!-- global scripts -->
  <script src="<?= asset('js/core/theme.js') ?>" defer></script>
  <script src="<?= asset('js/core/menu.js') ?>" defer></script>
  <?php foreach ($scripts as $j): ?>
  <script src="<?= asset("js/{$j}.js") ?>" defer></script>
  <?php endforeach; ?>
  <script type="module" src="<?= asset('js/core/dot-field.js') ?>"></script>
  <?php foreach (($page['modules'] ?? []) as $m): ?>
  <script type="module" src="<?= asset("js/{$m}.js") ?>"></script>
  <?php endforeach; ?>

</body>
</html>
