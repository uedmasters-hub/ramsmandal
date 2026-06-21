<?php
/* views/partials/breadcrumbs.php — renders $crumbs (from build_breadcrumbs()).
   Schema.org BreadcrumbList microdata; nothing on home. */
if (!empty($crumbs ?? [])):
    $last = count($crumbs) - 1;
?>
<nav class="breadcrumbs" aria-label="Breadcrumb">
  <ol class="breadcrumbs__list" itemscope itemtype="https://schema.org/BreadcrumbList">
    <?php foreach ($crumbs as $i => $c): ?>
    <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <?php if (!empty($c['url']) && $i !== $last): ?>
        <a class="breadcrumbs__link" itemprop="item" href="<?= e(url($c['url'])) ?>"><span itemprop="name"><?= e($c['label']) ?></span></a>
      <?php else: ?>
        <span class="breadcrumbs__current" itemprop="name" aria-current="page"><?= e($c['label']) ?></span>
      <?php endif; ?>
      <meta itemprop="position" content="<?= (int) ($i + 1) ?>">
    </li>
    <?php endforeach; ?>
  </ol>
</nav>
<?php endif; ?>
