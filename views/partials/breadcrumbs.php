<?php
/**
 * partials/breadcrumbs.php
 * Renders the breadcrumb trail for the current route.
 *
 * Expects either:
 *   - $breadcrumbs : a pre-built array from build_breadcrumbs(), OR
 *   - $path (+ optional $node) in scope, from which it derives the trail.
 *
 * Emits Schema.org BreadcrumbList microdata for SEO. Renders nothing on home.
 * No inline CSS/JS — styling lives in css/breadcrumbs.css.
 */
if (!isset($breadcrumbs)) {
    $breadcrumbs = build_breadcrumbs($path ?? ($_SERVER['REQUEST_URI'] ?? '/'), $node ?? null);
}
if (!empty($breadcrumbs)):
    $last = count($breadcrumbs) - 1;
?>
<nav class="breadcrumbs" aria-label="Breadcrumb">
    <ol class="breadcrumbs__list" itemscope itemtype="https://schema.org/BreadcrumbList">
        <?php foreach ($breadcrumbs as $i => $crumb): ?>
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <?php if (!empty($crumb['url']) && $i !== $last): ?>
                <a class="breadcrumbs__link" itemprop="item" href="<?= htmlspecialchars((string) $crumb['url'], ENT_QUOTES) ?>">
                    <span itemprop="name"><?= htmlspecialchars((string) $crumb['label'], ENT_QUOTES) ?></span>
                </a>
            <?php else: ?>
                <span class="breadcrumbs__current" itemprop="name" aria-current="page"><?= htmlspecialchars((string) $crumb['label'], ENT_QUOTES) ?></span>
            <?php endif; ?>
            <meta itemprop="position" content="<?= (int) ($i + 1) ?>">
        </li>
        <?php endforeach; ?>
    </ol>
</nav>
<?php endif; ?>
