<?php
/* views/partials/home/work.php — Selected Work.
   Header copy from content/home.php; the LIST is driven from
   content/projects.php (the work registry, single source of truth).
   This fixes the old hardcoded drift and the broken /project links. */
$home     = $home     ?? content('home');
$work     = $home['work'];
$projects = $projects ?? content('projects');
$items    = array_values(array_filter($projects, fn($p) => !empty($p['featured']) && ($p['type'] ?? '') === 'case-study'));
?>
<!-- WORK JOURNEY -->
<section class="work-v2" id="work">
  <div class="work-header">
    <div class="work-header-left">
      <span class="work-label"><?= e($work['label']) ?></span>
      <h2 class="work-title"><?= e($work['title']) ?></h2>
    </div>
    <div class="work-header-right">
      <p><?= e($work['copy']) ?></p>
    </div>
  </div>

  <div class="work-list">
    <?php foreach ($items as $p):
      $impact = !empty($p['metric'])
        ? trim($p['metric']['value'] . ' ' . lcfirst($p['metric']['label']))
        : ''; ?>
    <a href="<?= url('/work/' . $p['slug']) ?>" class="work-item" data-cursor="<?= (($p['type'] ?? '') === 'teardown') ? 'Audit' : 'Work' ?>">
      <div class="work-year"><?= e($p['year']) ?></div>
      <div class="work-project"><?= e($p['title']) ?></div>
      <div class="work-meta"><?= e($p['category']) ?></div>
      <div class="work-impact"><?= e($impact) ?></div>
    </a>
    <?php endforeach; ?>
  </div>
</section>
