<?php
/* views/partials/home/hero.php — dot-field hero, device-evolution stages.
   Content from content/home.php['hero']; stage-2 previews from projects. */
$home  = $home  ?? content('home');
$hero  = $home['hero'];
$prev  = $prev  ?? array_slice(
    array_values(array_filter(($projects ?? content('projects')), fn($p) => !empty($p['featured']))),
    0, 3
);
?>
<!-- DOT-FIELD HERO (device evolution lives in the global dot canvas) -->
<section id="home-experience" class="he">
  <div class="he-pin">
    <div class="he-stage-layer">
      <?php foreach ($hero['stages'] as $stage):
        $tag = in_array(($stage['heading_tag'] ?? 'h2'), ['h1', 'h2'], true) ? $stage['heading_tag'] : 'h2'; ?>
      <div class="he-stage">
        <?php if (!empty($stage['eyebrow'])): ?>
        <p class="he-eyebrow"><?= e($stage['eyebrow']) ?></p>
        <?php endif; ?>
        <<?= $tag ?> class="he-headline"><?= $stage['heading_html'] ?></<?= $tag ?>>
        <?php if (!empty($stage['sub'])): ?>
        <p class="he-sub"><?= e($stage['sub']) ?></p>
        <?php endif; ?>
        <?php if (!empty($stage['previews'])): ?>
        <div class="he-previews">
          <?php foreach ($prev as $p): ?>
          <div class="he-prev"><b><?= e($p['title']) ?></b><span><?= e($p['company']) ?></span></div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($stage['regions'])): ?>
        <div class="he-regions">
          <?php foreach ($stage['regions'] as $r): ?>
          <div class="he-region"><b><?= e($r['title']) ?></b><span><?= e($r['sub']) ?></span></div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
