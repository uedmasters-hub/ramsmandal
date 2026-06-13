<?php
/* views/work.php — index of journeys (stub layout, real data) */
$page = ['title' => 'Work — Ramesh Mandal', 'desc' => 'Selected projects and teardowns.', 'body_class' => 'page-work', 'styles' => ['work-rail'], 'scripts' => ['core/reveal']];
?>
<section class="work-index">
  <header class="work-index__head">
    <h1>Work</h1>
    <p>Projects presented as journeys: the context, the constraints, the decisions, and the outcomes.</p>
  </header>
  <div class="work-index__grid">
    <?php foreach (($projects ?? []) as $p): ?>
    <a class="work-tile" href="<?= url('/work/' . $p['slug']) ?>">
      <div class="work-tile__thumb tone-<?= (int)($p['tone'] ?? 0) ?>">
        <span class="tag"><?= e($p['company']) ?></span>
        <?php if (!empty($p['metric'])): ?><p class="metric"><?= e($p['metric']['value']) ?><small><?= e($p['metric']['label']) ?></small></p><?php endif; ?>
      </div>
      <div class="work-tile__meta">
        <div class="title"><?= e($p['title']) ?></div>
        <div class="org"><?= e($p['tagline']) ?></div>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
</section>
