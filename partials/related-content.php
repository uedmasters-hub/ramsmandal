<?php
/* =========================================
   PARTIALS / RELATED-CONTENT.PHP
   Full-bleed cross-content linking section.
   Self-contained CSS. No external stylesheet.

   Call: render_related_content('case-study', 'indigo-booking');
         render_related_content('audit', 'zomato-checkout');
         render_related_content('blog', $post['slug']);
   ========================================= */

function render_related_content(string $type, string $slug): void {

  /* Load each data file in its own closure — avoids include_once / global scope issues */
  $posts = (function(){
    $blogMeta=[]; $categories=[]; $posts=[];
    include __DIR__.'/../data/blog.php';
    return $posts;
  })();
  $audits = (function(){
    $audits=[];
    include __DIR__.'/../data/audits.php';
    return $audits;
  })();
  $caseStudies = (function(){
    $caseStudies=[];
    include __DIR__.'/../data/case-studies.php';
    return $caseStudies;
  })();
  $principles = (function(){
    $psychologyMeta=[]; $categories=[]; $principles=[];
    include __DIR__.'/../data/psychology.php';
    return $principles;
  })();

  /* ── PICKS ── */
  $blogPicks = [];
  foreach ($posts as $p) {
    if ($type === 'blog' && $p['slug'] === $slug) continue;
    $blogPicks[] = $p;
    if (count($blogPicks) >= 2) break;
  }
  $auditPick = null;
  foreach ($audits as $a) {
    if ($a['status'] !== 'published') continue;
    if ($type === 'audit' && $a['slug'] === $slug) continue;
    $auditPick = $a; break;
  }
  $csPick = null;
  foreach ($caseStudies as $cs) {
    if ($cs['status'] !== 'published') continue;
    if ($type === 'case-study' && $cs['slug'] === $slug) continue;
    $csPick = $cs; break;
  }
  $psychPick = ($type !== 'psychology') ? ($principles[0] ?? null) : null;

  /* ── Count columns so we know how many to render ── */
  $colCount = 0;
  if ($type !== 'blog'         && !empty($blogPicks)) $colCount++;
  if ($type !== 'audit'        && $auditPick)         $colCount++;
  if ($type !== 'case-study'   && $csPick)            $colCount++;
  if ($psychPick)                                      $colCount++;

  if ($colCount === 0) return;
  ?>
<style>
/* =============================================
   KEEP READING — full-bleed, consistent across
   all page types. Padding mirrors footer.
   ============================================= */
.rc-section {
  padding:    64px 64px;
  box-sizing: border-box;
}
.rc-header { margin-bottom: 36px; }
.rc-kicker {
  font-size: 11px; font-weight: 600; letter-spacing: .16em;
  text-transform: uppercase; color: var(--blue, #1a46c9);
  display: flex; align-items: center; gap: 10px; margin-bottom: 10px;
}
.rc-kicker::before { content:""; width:18px; height:1.5px; background:var(--blue,#1a46c9); }
.rc-title {
  font-size: clamp(1.8rem, 5vw, 3rem); font-weight: 300;
  letter-spacing: -.06em; line-height: 1; color: var(--text-primary, #0f0f0f);
}
.rc-title span { color: var(--blue, #1a46c9); }

/* Grid — exactly N equal columns, full width, no max-width cap */
.rc-grid {
  display: grid;
  grid-template-columns: repeat(<?= $colCount ?>, 1fr);
  gap: 16px;
}
.rc-col {
  background: var(--bg-elevated, #fff);
  padding: 16px;
  display: flex; flex-direction: column; gap: 12px;
  border-radius: 16px;
}
.rc-col__label {
  font-size: 11px; font-weight: 600; letter-spacing: .12em;
  text-transform: uppercase; color: var(--text-muted, #888);
  display: flex; align-items: center; gap: 6px;
  /* background: var(--bg, #f5f5f3); */
  /* border: 1px solid var(--border, rgba(0,0,0,.08)); */
  border-radius: 6px;
  padding: 6px 10px;
}
.rc-col__items { display: flex; flex-direction: column; gap: 8px; }
.rc-item {
  display: flex; align-items: center; gap: 12px;
  padding: 12px; border-radius: 10px; text-decoration: none;
  /* background: var(--bg, #f5f5f3); */
  border: 1px solid var(--border, rgba(0,0,0,.07));
  transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
}
.rc-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(26,70,201,0.09);
  border-color: rgba(26,70,201,.18);
}
.rc-item:hover .rc-item__arrow { transform: translateX(3px); color: var(--blue,#1a46c9); }
.rc-item__emoji { font-size: 1.3rem; flex-shrink: 0; width: 32px; text-align: center; }
.rc-item__thumb {
  width: 56px; height: 36px; object-fit: cover;
  border-radius: 6px; flex-shrink: 0; background: var(--border,rgba(0,0,0,.07));
}
.rc-item__body { flex: 1; min-width: 0; }
.rc-item__tag {
  font-size: 10px; font-weight: 600; letter-spacing: .1em;
  text-transform: uppercase; color: var(--blue,#1a46c9); margin-bottom: 2px;
}
.rc-item__title {
  font-size: 13px; font-weight: 500; color: var(--text-primary,#0f0f0f);
  line-height: 1.3; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.rc-item__meta {
  font-size: 11px; color: var(--text-muted,#888); margin-top: 1px;
  overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.rc-item__arrow {
  font-size: 14px; color: var(--text-muted,#888);
  flex-shrink: 0; transition: transform .18s, color .18s;
}
.rc-item__browse {
  display: block; font-size: 12px; color: var(--blue,#1a46c9);
  text-decoration: none; padding: 8px 10px;
  border-radius: 8px;
  transition: border-color .18s, background .18s;
  box-sizing: border-box; width: 100%;
}
.rc-item__browse:hover { border-color: rgba(26,70,201,.3); background: rgba(26,70,201,.04); border-radius: 6px; }

@media (max-width: 1024px) {
  .rc-section { padding: 64px 40px; }
  .rc-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
}
@media (max-width: 768px) {
  .rc-section { padding: 40px 20px; }
  .rc-grid {
    grid-template-columns: 1fr;
    gap: 10px;
  }
  .rc-col {
    padding: 16px;
    border-radius: 12px;
  }
  .rc-col__items { width: 100%; box-sizing: border-box; overflow: hidden; }
  .rc-col         { overflow: hidden; }

  /* Items: contained, no overflow */
  .rc-item {
    box-sizing: border-box;
    min-width:  0;
    max-width:  100%;
  }
  .rc-item__title { white-space: normal; }
  .rc-item__meta  { white-space: normal; }
  .rc-item__thumb { width: 44px; height: 30px; flex-shrink: 0; }
  .rc-item__body  { min-width: 0; flex: 1; overflow: hidden; }
}
</style>

<section class="rc-section" aria-label="More to explore">
  <div class="rc-header">
    <p class="rc-kicker">KEEP READING</p>
    <h2 class="rc-title">More from the <span>platform</span></h2>
  </div>
  <div class="rc-grid">

    <?php if ($type !== 'blog' && !empty($blogPicks)): ?>
    <div class="rc-col">
      <p class="rc-col__label"><span>⚡</span> Field Notes</p>
      <div class="rc-col__items">
        <?php foreach ($blogPicks as $p): ?>
        <a href="/blog/<?= urlencode($p['slug']) ?>" class="rc-item">
          <span class="rc-item__emoji"><?= htmlspecialchars($p['emoji']) ?></span>
          <div class="rc-item__body">
            <p class="rc-item__tag"><?= htmlspecialchars($p['tag']) ?></p>
            <p class="rc-item__title"><?= htmlspecialchars($p['title']) ?></p>
            <p class="rc-item__meta"><?= htmlspecialchars($p['read_time']) ?></p>
          </div>
          <span class="rc-item__arrow">→</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if ($type !== 'audit' && $auditPick): ?>
    <div class="rc-col">
      <p class="rc-col__label"><span>◎</span> UX Audits</p>
      <div class="rc-col__items">
        <a href="/audit/<?= urlencode($auditPick['slug']) ?>" class="rc-item">
          <img src="<?= htmlspecialchars($auditPick['image']) ?>"
               alt="<?= htmlspecialchars($auditPick['product']) ?>"
               class="rc-item__thumb" loading="lazy" width="56" height="36"/>
          <div class="rc-item__body">
            <p class="rc-item__tag"><?= htmlspecialchars($auditPick['category']) ?></p>
            <p class="rc-item__title"><?= htmlspecialchars($auditPick['title']) ?></p>
            <p class="rc-item__meta">Score <?= $auditPick['score'] ?>/100 · <?= $auditPick['friction_count'] ?> friction points</p>
          </div>
          <span class="rc-item__arrow">→</span>
        </a>
      </div>
    </div>
    <?php endif; ?>

    <?php if ($type !== 'case-study' && $csPick): ?>
    <div class="rc-col">
      <p class="rc-col__label"><span>◈</span> Case Studies</p>
      <div class="rc-col__items">
        <a href="/case-study/<?= urlencode($csPick['slug']) ?>" class="rc-item">
          <img src="<?= htmlspecialchars($csPick['image']) ?>"
               alt="<?= htmlspecialchars($csPick['title']) ?>"
               class="rc-item__thumb" loading="lazy" width="56" height="36"/>
          <div class="rc-item__body">
            <p class="rc-item__tag"><?= htmlspecialchars($csPick['category']) ?></p>
            <p class="rc-item__title"><?= htmlspecialchars($csPick['title']) ?></p>
            <p class="rc-item__meta"><?= htmlspecialchars($csPick['year']) ?> · <?= htmlspecialchars($csPick['company']) ?></p>
          </div>
          <span class="rc-item__arrow">→</span>
        </a>
      </div>
    </div>
    <?php endif; ?>

    <?php if ($psychPick): ?>
    <div class="rc-col">
      <p class="rc-col__label"><span>⬡</span> UX Psychology</p>
      <div class="rc-col__items">
        <a href="/psychology/" class="rc-item">
          <div class="rc-item__body">
            <p class="rc-item__tag"><?= htmlspecialchars(ucfirst($psychPick['category'])) ?></p>
            <p class="rc-item__title"><?= htmlspecialchars($psychPick['name']) ?></p>
            <p class="rc-item__meta"><?= htmlspecialchars($psychPick['tagline']) ?></p>
          </div>
          <span class="rc-item__arrow">→</span>
        </a>
        <a href="/psychology/" class="rc-item__browse">Browse all 14 principles →</a>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>
<?php
} // end render_related_content