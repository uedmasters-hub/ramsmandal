<?php
/* =========================================
   ADMIN / AUDITS.PHP
   UX Audit manager — view, generate PHP blocks,
   AI-assisted heuristic scoring & friction mapping.
   ========================================= */

session_start();
define("ADMIN_PASS", "ramsm");

/* ── AUTH ───────────────────────────────── */
if (!isset($_SESSION["admin_ok"])) {
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pass"])) {
    if ($_POST["pass"] === ADMIN_PASS) { $_SESSION["admin_ok"] = true; }
    else { $loginError = "Wrong password."; }
  }
  if (!isset($_SESSION["admin_ok"])) { showLogin($loginError ?? null); exit; }
}

if (isset($_GET["logout"])) { session_destroy(); header("Location: audits.php"); exit; }

require_once __DIR__ . "/../data/audits.php";

$view = $_GET["view"] ?? "list";

/* ─── LOGIN PAGE ───────────────────────── */
function showLogin($error = null) { ?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"/><meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Admin — UX Audits</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:system-ui,sans-serif;background:#f5f5f3;display:flex;align-items:center;justify-content:center;min-height:100vh}
.login{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:16px;padding:48px;width:100%;max-width:360px}
.login h1{font-size:1.4rem;font-weight:600;margin-bottom:8px}
.login p{font-size:14px;color:#666;margin-bottom:28px}
.login input{width:100%;padding:12px 16px;border:1px solid rgba(0,0,0,.12);border-radius:8px;font-size:15px;margin-bottom:12px}
.login button{width:100%;padding:12px;background:#0f0f0f;color:#fff;border:none;border-radius:8px;font-size:15px;font-weight:500;cursor:pointer}
.error{color:#dc2626;font-size:13px;margin-bottom:12px}
</style></head><body>
<div class="login">
  <h1>UX Audit Admin</h1>
  <p>Audit manager for 6epixels.com</p>
  <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
  <form method="POST">
    <input type="password" name="pass" placeholder="Password" autofocus required/>
    <button type="submit">Enter →</button>
  </form>
</div>
</body></html>
<?php }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Admin — UX Audits</title>
<style>
/* ── RESET ── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,"Inter",system-ui,sans-serif;background:#f5f5f3;color:#0f0f0f;min-height:100vh}

/* ── HEADER ── */
.admin-header{background:#fff;border-bottom:1px solid rgba(0,0,0,.08);padding:0 32px;height:60px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
.admin-header__logo{font-weight:700;font-size:15px}
.admin-header__logo span{color:#1a46c9}
.admin-header__nav{display:flex;gap:8px;align-items:center}

/* ── BUTTONS ── */
.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:500;text-decoration:none;border:none;cursor:pointer;transition:all .2s;white-space:nowrap}
.btn-primary{background:#0f0f0f;color:#fff}
.btn-primary:hover{background:#1a46c9}
.btn-ghost{background:transparent;color:#444;border:1px solid rgba(0,0,0,.12)}
.btn-ghost:hover{border-color:#0f0f0f;color:#0f0f0f}
.btn-blue{background:#1a46c9;color:#fff}
.btn-blue:hover{background:#1339a8}
.btn-sm{padding:6px 12px;font-size:12px}

/* ── LAYOUT ── */
.admin-main{padding:32px;max-width:1200px;margin:0 auto}
.page-title{font-size:1.5rem;font-weight:600;margin-bottom:4px}
.page-sub{font-size:14px;color:#666;margin-bottom:24px}

/* ── STATS ROW ── */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px}
.stat-box{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:12px;padding:20px}
.stat-box__val{font-size:2rem;font-weight:700;letter-spacing:-.03em}
.stat-box__label{font-size:12px;color:#888;margin-top:4px}

/* ── AUDIT LIST ── */
.audit-list{display:flex;flex-direction:column;gap:1px;background:rgba(0,0,0,.06);border-radius:12px;overflow:hidden}
.audit-row{background:#fff;padding:20px 24px;display:flex;align-items:center;gap:16px}
.audit-row:hover{background:#fafafa}
.audit-row__img{width:80px;height:52px;border-radius:8px;object-fit:cover;flex-shrink:0;background:#f3f4f6}
.audit-row__body{flex:1;min-width:0}
.audit-row__title{font-size:15px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.audit-row__meta{font-size:12px;color:#888;margin-top:4px;display:flex;gap:12px;flex-wrap:wrap;align-items:center}
.audit-row__actions{display:flex;gap:8px;flex-shrink:0}

/* ── BADGES ── */
.badge{display:inline-flex;align-items:center;gap:4px;font-size:11px;padding:3px 8px;border-radius:4px;font-weight:600}
.badge-published{background:#f0fdf4;color:#15803d}
.badge-coming-soon{background:#fef3c7;color:#92400e}
.badge-draft{background:#f1f5f9;color:#475569}
.badge-high{background:#fef2f2;color:#dc2626}
.badge-medium{background:#fff7ed;color:#c2410c}
.badge-low{background:#f0fdf4;color:#15803d}

/* ── SCORE RING ── */
.score-ring{display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:50%;font-size:12px;font-weight:700;flex-shrink:0}
.score-high{background:#fef2f2;color:#dc2626;border:2px solid #fecaca}
.score-med{background:#fff7ed;color:#c2410c;border:2px solid #fed7aa}
.score-ok{background:#f0fdf4;color:#15803d;border:2px solid #bbf7d0}
.score-na{background:#f1f5f9;color:#94a3b8;border:2px solid #e2e8f0}

/* ── TWO-COLUMN FORM LAYOUT ── */
.form-layout{display:grid;grid-template-columns:1fr 380px;gap:24px;align-items:start}
@media(max-width:900px){.form-layout{grid-template-columns:1fr}}

/* ── FORM CARDS ── */
.form-card{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:16px;padding:28px;margin-bottom:16px}
.form-section-title{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#888;margin-bottom:16px;padding-bottom:10px;border-bottom:1px solid rgba(0,0,0,.06)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px}
.form-group{display:flex;flex-direction:column;gap:5px;margin-bottom:14px}
.form-group:last-child{margin-bottom:0}
label{font-size:12px;font-weight:500;color:#444}
.hint{font-size:11px;color:#aaa;margin-top:2px}
input[type=text],input[type=number],select,textarea{padding:9px 12px;border:1px solid rgba(0,0,0,.12);border-radius:8px;font-size:13px;font-family:inherit;width:100%;background:#fff;transition:border-color .2s}
input:focus,select:focus,textarea:focus{outline:none;border-color:#1a46c9}
textarea{resize:vertical;line-height:1.6}

/* ── HEURISTICS TABLE ── */
.h-table{width:100%;border-collapse:collapse;font-size:13px}
.h-table th{text-align:left;font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:#888;padding:8px 12px;border-bottom:2px solid rgba(0,0,0,.08)}
.h-table td{padding:10px 12px;border-bottom:1px solid rgba(0,0,0,.05);vertical-align:top}
.h-table tr:last-child td{border-bottom:none}
.h-table tr:hover td{background:#fafafa}
.h-score{width:60px}
input.score-input{width:54px;text-align:center;padding:6px 8px;border:1px solid rgba(0,0,0,.12);border-radius:6px;font-size:13px;font-weight:600}
input.score-input:focus{border-color:#1a46c9;outline:none}
.h-note{width:100%}
textarea.note-input{width:100%;min-height:60px;border:1px solid rgba(0,0,0,.10);border-radius:6px;padding:8px 10px;font-size:12px;resize:vertical;background:#fafafa}
textarea.note-input:focus{border-color:#1a46c9;outline:none;background:#fff}

/* ── FRICTION BUILDER ── */
.friction-list{display:flex;flex-direction:column;gap:8px}
.friction-item{background:#fafafa;border:1px solid rgba(0,0,0,.08);border-radius:10px;padding:14px 16px;position:relative}
.friction-item-header{display:flex;align-items:center;gap:10px;margin-bottom:10px}
.friction-num{background:#0f0f0f;color:#fff;border-radius:4px;font-size:10px;font-weight:700;padding:3px 7px;flex-shrink:0}
.friction-remove{position:absolute;top:12px;right:12px;background:none;border:1px solid #fecaca;color:#dc2626;border-radius:5px;padding:4px 8px;cursor:pointer;font-size:12px}
.friction-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px}
.friction-body{margin-top:10px;display:flex;flex-direction:column;gap:8px}
.add-btn{width:100%;padding:10px;background:none;border:1px dashed rgba(0,0,0,.15);border-radius:8px;color:#666;font-size:13px;cursor:pointer;margin-top:8px;transition:all .2s}
.add-btn:hover{border-color:#1a46c9;color:#1a46c9}

/* ── TAGS INPUT ── */
.tags-wrap{display:flex;flex-wrap:wrap;gap:6px;padding:8px 10px;border:1px solid rgba(0,0,0,.12);border-radius:8px;min-height:40px;cursor:text}
.tags-wrap:focus-within{border-color:#1a46c9}
.tag-chip{background:#f1f5f9;color:#0f0f0f;font-size:12px;padding:3px 8px;border-radius:4px;display:flex;align-items:center;gap:5px}
.tag-chip button{background:none;border:none;color:#666;cursor:pointer;font-size:13px;line-height:1;padding:0}
.tag-chip button:hover{color:#dc2626}
.tags-input{border:none;outline:none;font-size:13px;font-family:inherit;min-width:100px;flex:1;background:transparent}

/* ── AI PANEL ── */
.ai-panel{background:linear-gradient(135deg,#eff6ff,#f5f3ff);border:1px solid #bfdbfe;border-radius:12px;padding:20px 24px;margin-bottom:20px}
.ai-panel h3{font-size:14px;font-weight:600;color:#1d4ed8;margin-bottom:6px}
.ai-panel p{font-size:13px;color:#3730a3;margin-bottom:14px;line-height:1.5}
.ai-row{display:flex;gap:8px}
.ai-row input{flex:1}
.ai-status{display:none;font-size:13px;color:#1d4ed8;margin-top:10px;align-items:center;gap:8px}
.ai-status.is-active{display:flex}
@keyframes spin{to{transform:rotate(360deg)}}
.spinner{width:14px;height:14px;border:2px solid #bfdbfe;border-top-color:#1d4ed8;border-radius:50%;animation:spin .8s linear infinite;flex-shrink:0}

/* ── OUTPUT ── */
.output-box{background:#0f0f0f;color:#e2e8f0;border-radius:12px;padding:24px;font-family:"Monaco","Menlo",monospace;font-size:12px;line-height:1.7;overflow-x:auto;white-space:pre;display:none;margin-top:20px}
.output-box.is-visible{display:block}
.output-actions{display:none;gap:10px;margin-top:12px;align-items:center}
.output-actions.is-visible{display:flex}

/* ── SIDEBAR ── */
.sidebar-card{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:14px;padding:22px;margin-bottom:16px}
.sidebar-card h3{font-size:12px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#888;margin-bottom:14px}
.score-preview{text-align:center;padding:12px 0}
.score-preview__num{font-size:3.5rem;font-weight:700;letter-spacing:-.04em;color:#0f0f0f;line-height:1}
.score-preview__label{font-size:12px;color:#888;margin-top:4px}
.score-bar{height:6px;background:#f1f5f9;border-radius:3px;margin-top:10px;overflow:hidden}
.score-bar__fill{height:100%;border-radius:3px;transition:width .4s ease}
.score-good{background:#22c55e}
.score-warn{background:#f59e0b}
.score-bad{background:#ef4444}
.checklist{display:flex;flex-direction:column;gap:8px}
.checklist-item{display:flex;align-items:center;gap:8px;font-size:13px;color:#444}
.check-icon{width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;flex-shrink:0}
.check-done{background:#f0fdf4;color:#16a34a}
.check-empty{background:#f1f5f9;color:#aaa}
.notice{background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:12px 16px;font-size:13px;color:#15803d;margin-bottom:20px}
.notice-warn{background:#fff7ed;border-color:#fed7aa;color:#c2410c}
</style>
</head>
<body>

<!-- ── HEADER ── -->
<header class="admin-header">
  <div class="admin-header__logo">UX Audit <span>Admin</span></div>
  <nav class="admin-header__nav">
    <a href="?view=list"       class="btn btn-ghost btn-sm">← All Audits</a>
    <a href="?view=new"        class="btn btn-primary btn-sm">+ New Audit</a>
    <a href="index.php"        class="btn btn-ghost btn-sm">Field Notes</a>
    <a href="case-studies.php" class="btn btn-ghost btn-sm">Case Studies</a>
    <a href="?logout=1"        class="btn btn-ghost btn-sm">Log out</a>
  </nav>
</header>

<main class="admin-main">

<?php if ($view === "list"): ?>
<!-- ══════════════════════════════════════
     LIST VIEW
══════════════════════════════════════ -->

<?php
  $published  = count(array_filter($audits, fn($a) => $a["status"] === "published"));
  $comingSoon = count(array_filter($audits, fn($a) => $a["status"] === "coming-soon"));
  $totalFriction = array_sum(array_column($audits, "friction_count"));
  $avgScore = $published > 0
    ? round(array_sum(array_map(fn($a) => $a["score"], array_filter($audits, fn($a) => $a["score"] > 0))) / $published)
    : 0;
?>

<p class="page-title">UX Audits</p>
<p class="page-sub">Manage audits in <code>data/audits.php</code> and <code>audit/</code> pages</p>

<div class="stats-row">
  <div class="stat-box">
    <div class="stat-box__val"><?= count($audits) ?></div>
    <div class="stat-box__label">Total Audits</div>
  </div>
  <div class="stat-box">
    <div class="stat-box__val"><?= $published ?></div>
    <div class="stat-box__label">Published</div>
  </div>
  <div class="stat-box">
    <div class="stat-box__val"><?= $avgScore ?></div>
    <div class="stat-box__label">Avg UX Score</div>
  </div>
  <div class="stat-box">
    <div class="stat-box__val"><?= $totalFriction ?></div>
    <div class="stat-box__label">Total Friction Points</div>
  </div>
</div>

<div class="audit-list">
  <?php foreach ($audits as $a):
    $scoreClass = $a["score"] >= 70 ? "score-ok" : ($a["score"] >= 50 ? "score-med" : "score-high");
  ?>
  <div class="audit-row">
    <img class="audit-row__img" src="<?= htmlspecialchars($a["image"]) ?>" alt="" loading="lazy"/>
    <div class="audit-row__body">
      <div class="audit-row__title"><?= htmlspecialchars($a["title"]) ?></div>
      <div class="audit-row__meta">
        <span class="badge badge-<?= $a["status"] ?>"><?= ucfirst(str_replace("-"," ",$a["status"])) ?></span>
        <span class="badge badge-<?= strtolower($a["severity"]) ?>"><?= $a["severity"] ?> SEVERITY</span>
        <span><?= htmlspecialchars($a["category"]) ?></span>
        <span><?= $a["year"] ?></span>
        <?php if ($a["friction_count"] > 0): ?>
          <span><?= $a["friction_count"] ?> friction points</span>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($a["score"] > 0): ?>
      <div class="score-ring <?= $scoreClass ?>"><?= $a["score"] ?></div>
    <?php else: ?>
      <div class="score-ring score-na">—</div>
    <?php endif; ?>
    <div class="audit-row__actions">
      <?php if ($a["status"] === "published"): ?>
        <a href="../audit/<?= urlencode($a["slug"]) ?>.php" target="_blank" class="btn btn-ghost btn-sm">Preview ↗</a>
      <?php endif; ?>
      <a href="?view=edit&slug=<?= urlencode($a["slug"]) ?>" class="btn btn-ghost btn-sm">Edit</a>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<?php elseif ($view === "new" || $view === "edit"): ?>
<!-- ══════════════════════════════════════
     NEW / EDIT VIEW
══════════════════════════════════════ -->

<?php
  $editSlug = $_GET["slug"] ?? null;
  $editing  = null;
  if ($editSlug) {
    foreach ($audits as $a) {
      if ($a["slug"] === $editSlug) { $editing = $a; break; }
    }
  }
  $isEdit = $editing !== null;
  function h($s){ return htmlspecialchars($s, ENT_QUOTES); }
?>

<p class="page-title"><?= $isEdit ? "Edit Audit" : "New Audit" ?></p>
<p class="page-sub"><?= $isEdit ? "Editing: " . h($editing["title"]) : "Fill in the fields below. Use the AI assistant to score heuristics and draft friction points." ?></p>

<?php if ($isEdit): ?>
<div class="notice">
  ✓ After generating the PHP block, copy it into <code>data/audits.php</code> inside the <code>$audits = [...]</code> array. The audit page at <code>audit/<?= h($editing["slug"]) ?>.php</code> uses its own hardcoded data — update that file separately.
</div>
<?php endif; ?>

<!-- AI ASSISTANT -->
<div class="ai-panel">
  <h3>✦ AI Audit Assistant</h3>
  <p>Describe the product and what you observed — the AI will generate Nielsen heuristic scores, friction points with psychology principles, and redesign recommendations in your voice.</p>
  <div class="ai-row">
    <input type="text" id="ai-prompt" placeholder="e.g. Swiggy's home screen has 14 content zones, no clear hierarchy, and onboarding skips location permission entirely on first open..."/>
    <button class="btn btn-blue" onclick="generateWithAI()">Generate ✦</button>
  </div>
  <div class="ai-status" id="ai-status">
    <div class="spinner"></div>
    Analysing with Ramesh's UX lens...
  </div>
</div>

<div class="form-layout">

  <!-- ── LEFT COLUMN ── -->
  <div>

    <!-- IDENTITY -->
    <div class="form-card">
      <div class="form-section-title">Identity</div>
      <div class="form-row">
        <div class="form-group">
          <label>Product Name</label>
          <input type="text" id="f-product" placeholder="Zomato" value="<?= h($editing["product"] ?? "") ?>"/>
        </div>
        <div class="form-group">
          <label>Slug (URL / filename)</label>
          <input type="text" id="f-slug" placeholder="zomato-checkout" value="<?= h($editing["slug"] ?? "") ?>"/>
          <span class="hint">Used as audit/[slug].php</span>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Category</label>
          <input type="text" id="f-category" placeholder="FOOD DELIVERY" value="<?= h($editing["category"] ?? "") ?>"/>
        </div>
        <div class="form-group">
          <label>Year</label>
          <input type="text" id="f-year" placeholder="2024" value="<?= h($editing["year"] ?? date("Y")) ?>"/>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Status</label>
          <select id="f-status">
            <option value="published"   <?= ($editing["status"] ?? "") === "published"   ? "selected" : "" ?>>Published</option>
            <option value="draft"       <?= ($editing["status"] ?? "") === "draft"       ? "selected" : "" ?>>Draft</option>
            <option value="coming-soon" <?= ($editing["status"] ?? "") === "coming-soon" ? "selected" : "" ?>>Coming Soon</option>
          </select>
        </div>
        <div class="form-group">
          <label>Severity</label>
          <select id="f-severity">
            <option value="HIGH"   <?= ($editing["severity"] ?? "") === "HIGH"   ? "selected" : "" ?>>HIGH</option>
            <option value="MEDIUM" <?= ($editing["severity"] ?? "") === "MEDIUM" ? "selected" : "" ?>>MEDIUM</option>
            <option value="LOW"    <?= ($editing["severity"] ?? "") === "LOW"    ? "selected" : "" ?>>LOW</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>Cover Image URL (Unsplash or hosted)</label>
        <input type="text" id="f-image" placeholder="https://images.unsplash.com/..." value="<?= h($editing["image"] ?? "") ?>"/>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="form-card">
      <div class="form-section-title">Content</div>
      <div class="form-group">
        <label>Title</label>
        <input type="text" id="f-title" placeholder="Zomato Checkout Flow" value="<?= h($editing["title"] ?? "") ?>"/>
      </div>
      <div class="form-group">
        <label>Tagline (one sharp sentence)</label>
        <input type="text" id="f-tagline" placeholder="India's most-used food app has a checkout that loses money every hour." value="<?= h($editing["tagline"] ?? "") ?>"/>
      </div>
      <div class="form-group">
        <label>Summary (2–3 sentences — shown on listing card)</label>
        <textarea id="f-summary" rows="3"><?= h($editing["summary"] ?? "") ?></textarea>
      </div>
      <div class="form-group">
        <label>Tags</label>
        <div class="tags-wrap" id="tags-wrap" onclick="document.getElementById('tag-input').focus()">
          <?php foreach (($editing["tags"] ?? []) as $tag): ?>
            <span class="tag-chip" data-tag="<?= h($tag) ?>">
              <?= h($tag) ?>
              <button type="button" onclick="removeTag(this)">×</button>
            </span>
          <?php endforeach; ?>
          <input type="text" id="tag-input" class="tags-input" placeholder="Add tag, press Enter"/>
        </div>
        <span class="hint">Press Enter to add each tag</span>
      </div>
    </div>

    <!-- HEURISTIC SCORECARD -->
    <div class="form-card">
      <div class="form-section-title">Nielsen Heuristic Scorecard (0–10)</div>
      <table class="h-table">
        <thead>
          <tr>
            <th style="width:30px">#</th>
            <th>Heuristic</th>
            <th class="h-score">Score</th>
            <th>Note / Observation</th>
          </tr>
        </thead>
        <tbody id="heuristic-tbody">
          <?php
          $defaultHeuristics = [
            "H1"  => "Visibility of System Status",
            "H2"  => "Match Between System & Real World",
            "H3"  => "User Control & Freedom",
            "H4"  => "Consistency & Standards",
            "H5"  => "Error Prevention",
            "H6"  => "Recognition Over Recall",
            "H7"  => "Flexibility & Efficiency of Use",
            "H8"  => "Aesthetic & Minimalist Design",
            "H9"  => "Help Users Recognise Errors",
            "H10" => "Help & Documentation",
          ];
          $existingH = [];
          if ($editing) {
            // build lookup from existing audit page — not stored in data/audits.php
            // so we pre-fill blanks; user fills in from audit page or AI
          }
          foreach ($defaultHeuristics as $id => $label):
          ?>
          <tr>
            <td style="color:#aaa;font-size:11px"><?= $id ?></td>
            <td style="font-size:13px"><?= $label ?></td>
            <td><input type="number" class="score-input h-score-input" data-hid="<?= $id ?>" min="0" max="10" placeholder="—" onchange="updateScorePreview()"/></td>
            <td><textarea class="note-input h-note-input" data-hid="<?= $id ?>" rows="2" placeholder="Your specific observation..."></textarea></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <p class="hint" style="margin-top:12px">Overall score auto-calculates from the average. You can override it in the sidebar.</p>
    </div>

    <!-- FRICTION POINTS -->
    <div class="form-card">
      <div class="form-section-title">Friction Map</div>
      <div class="friction-list" id="friction-list">
        <!-- JS populates -->
      </div>
      <button class="add-btn" onclick="addFriction()">+ Add friction point</button>
    </div>

    <!-- GENERATE -->
    <div style="display:flex;gap:12px;margin-top:8px;flex-wrap:wrap">
      <button class="btn btn-primary" onclick="generatePHP()" style="padding:12px 28px;font-size:14px">
        Generate PHP Block ↓
      </button>
      <button class="btn btn-ghost" onclick="document.getElementById('output').scrollIntoView({behavior:'smooth'})">
        Jump to output
      </button>
    </div>

    <div class="output-box" id="output"></div>
    <div class="output-actions" id="output-actions">
      <button class="btn btn-primary" onclick="copyOutput()">Copy to clipboard</button>
      <p style="font-size:13px;color:#666">Paste into <code>data/audits.php</code> inside <code>$audits = [...]</code></p>
    </div>

  </div>

  <!-- ── RIGHT SIDEBAR ── -->
  <div>

    <!-- SCORE PREVIEW -->
    <div class="sidebar-card">
      <h3>UX Score</h3>
      <div class="score-preview">
        <div class="score-preview__num" id="score-display"><?= $editing["score"] ?? "—" ?></div>
        <div class="score-preview__label">/ 100</div>
        <div class="score-bar">
          <div class="score-bar__fill score-bad" id="score-bar" style="width:<?= ($editing["score"] ?? 0) ?>%"></div>
        </div>
      </div>
      <div class="form-group" style="margin-top:16px">
        <label>Override score manually</label>
        <input type="number" id="f-score" min="0" max="100" placeholder="Auto" value="<?= $editing["score"] ?? "" ?>" oninput="manualScore(this.value)"/>
      </div>
      <div class="form-group">
        <label>Friction point count</label>
        <input type="number" id="f-friction-count" min="0" placeholder="0" value="<?= $editing["friction_count"] ?? 0 ?>"/>
        <span class="hint">Auto-counts from friction list, or set manually</span>
      </div>
    </div>

    <!-- COMPLETENESS CHECKLIST -->
    <div class="sidebar-card">
      <h3>Completeness</h3>
      <div class="checklist" id="checklist">
        <div class="checklist-item"><div class="check-icon check-empty" id="chk-product">✓</div>Product & slug</div>
        <div class="checklist-item"><div class="check-icon check-empty" id="chk-title">✓</div>Title & tagline</div>
        <div class="checklist-item"><div class="check-icon check-empty" id="chk-summary">✓</div>Summary</div>
        <div class="checklist-item"><div class="check-icon check-empty" id="chk-image">✓</div>Cover image</div>
        <div class="checklist-item"><div class="check-icon check-empty" id="chk-heuristics">✓</div>Heuristic scores</div>
        <div class="checklist-item"><div class="check-icon check-empty" id="chk-friction">✓</div>Friction points</div>
        <div class="checklist-item"><div class="check-icon check-empty" id="chk-tags">✓</div>Tags added</div>
      </div>
    </div>

    <!-- QUICK TIPS -->
    <div class="sidebar-card">
      <h3>Tips</h3>
      <div style="font-size:13px;color:#555;line-height:1.7;display:flex;flex-direction:column;gap:8px">
        <p>◉ Score 0–4 = critical · 5–6 = needs work · 7–8 = acceptable · 9–10 = excellent</p>
        <p>◈ Overall score = avg of 10 heuristics × 10</p>
        <p>⬡ Friction points need a psychology principle + business impact to be publishable</p>
        <p>✦ Use AI to get a first draft — then edit in your own observations</p>
      </div>
    </div>

  </div>
</div>

<?php endif; ?>

</main>

<script>
/* ═══════════════════════════════════════════
   AUDIT ADMIN JS
═══════════════════════════════════════════ */

/* ── AUTO-SLUG ── */
const productField = document.getElementById("f-product");
const slugField    = document.getElementById("f-slug");
if (productField && slugField && !slugField.value) {
  productField.addEventListener("input", () => {
    slugField.value = productField.value
      .toLowerCase()
      .replace(/[^a-z0-9\s-]/g, "")
      .trim()
      .replace(/\s+/g, "-");
  });
}

/* ── TAGS ── */
const tagInput = document.getElementById("tag-input");
if (tagInput) {
  tagInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter" || e.key === ",") {
      e.preventDefault();
      const val = tagInput.value.trim().replace(/,/g, "");
      if (val) { addTag(val); tagInput.value = ""; }
    }
    if (e.key === "Backspace" && !tagInput.value) {
      const chips = document.querySelectorAll(".tag-chip");
      if (chips.length) chips[chips.length - 1].remove();
    }
  });
}

function addTag(text) {
  const wrap = document.getElementById("tags-wrap");
  const chip = document.createElement("span");
  chip.className = "tag-chip";
  chip.dataset.tag = text;
  chip.innerHTML = `${escHtml(text)}<button type="button" onclick="removeTag(this)">×</button>`;
  wrap.insertBefore(chip, document.getElementById("tag-input"));
  updateChecklist();
}

function removeTag(btn) {
  btn.closest(".tag-chip").remove();
  updateChecklist();
}

function getTags() {
  return [...document.querySelectorAll(".tag-chip")].map(c => c.dataset.tag).filter(Boolean);
}

/* ── FRICTION BUILDER ── */
const PSYCHOLOGY_PRINCIPLES = [
  "Hick's Law", "Fitts's Law", "Cognitive Load", "Loss Aversion",
  "Anchoring Bias", "Status Quo Bias", "Decision Fatigue", "Zeigarnik Effect",
  "Von Restorff Effect", "Serial Position Effect", "Paradox of Choice",
  "Peak-End Rule", "Endowment Effect", "Social Proof", "Scarcity Bias",
  "Progressive Disclosure", "Recognition vs Recall", "Gestalt Proximity",
];

let frictionCount = 0;

function addFriction(data = {}) {
  frictionCount++;
  const n = frictionCount;
  const list = document.getElementById("friction-list");
  const el = document.createElement("div");
  el.className = "friction-item";
  el.dataset.num = n;

  const psyOptions = PSYCHOLOGY_PRINCIPLES.map(p =>
    `<option value="${p}" ${data.principle === p ? "selected" : ""}>${p}</option>`
  ).join("");

  el.innerHTML = `
    <div class="friction-item-header">
      <span class="friction-num">F${n}</span>
      <input type="text" class="fi-title" placeholder="Friction point title" value="${escHtml(data.title||"")}" style="flex:1;font-weight:500"/>
    </div>
    <div class="friction-grid">
      <div class="form-group">
        <label>Severity</label>
        <select class="fi-severity">
          <option value="CRITICAL" ${data.severity==="CRITICAL"?"selected":""}>🔴 Critical</option>
          <option value="HIGH"     ${data.severity==="HIGH"?"selected":""}>🟠 High</option>
          <option value="MEDIUM"   ${data.severity==="MEDIUM"?"selected":""}>🟡 Medium</option>
          <option value="LOW"      ${data.severity==="LOW"?"selected":""}>🟢 Low</option>
        </select>
      </div>
      <div class="form-group">
        <label>Screen / Flow</label>
        <input type="text" class="fi-screen" placeholder="Checkout step 2" value="${escHtml(data.screen||"")}"/>
      </div>
      <div class="form-group">
        <label>Psychology Principle</label>
        <select class="fi-principle">
          <option value="">— Select —</option>
          ${psyOptions}
        </select>
      </div>
    </div>
    <div class="friction-body">
      <div class="form-group">
        <label>Observation</label>
        <textarea class="fi-observation" rows="2" placeholder="What exactly is broken and why it matters...">${escHtml(data.observation||"")}</textarea>
      </div>
      <div class="form-group">
        <label>Business Impact</label>
        <textarea class="fi-impact" rows="2" placeholder="Estimated drop-off, revenue loss, support cost...">${escHtml(data.impact||"")}</textarea>
      </div>
      <div class="form-group">
        <label>Redesign Suggestion</label>
        <textarea class="fi-redesign" rows="2" placeholder="What you would change and why...">${escHtml(data.redesign||"")}</textarea>
      </div>
    </div>
    <button class="friction-remove" onclick="removeFriction(this)">✕ Remove</button>
  `;
  list.appendChild(el);
  updateFrictionCount();
}

function removeFriction(btn) {
  btn.closest(".friction-item").remove();
  renumberFriction();
  updateFrictionCount();
}

function renumberFriction() {
  document.querySelectorAll(".friction-item").forEach((el, i) => {
    el.querySelector(".friction-num").textContent = "F" + (i + 1);
  });
}

function updateFrictionCount() {
  const count = document.querySelectorAll(".friction-item").length;
  const field = document.getElementById("f-friction-count");
  if (field && !field.dataset.manual) field.value = count;
  updateChecklist();
}

/* ── SCORE PREVIEW ── */
function updateScorePreview() {
  const inputs = [...document.querySelectorAll(".h-score-input")];
  const filled = inputs.filter(i => i.value !== "");
  if (!filled.length) return;
  const avg = filled.reduce((s, i) => s + parseFloat(i.value||0), 0) / filled.length;
  const score = Math.round(avg * 10);

  const manualOverride = document.getElementById("f-score").value;
  if (!manualOverride) renderScore(score);
  updateChecklist();
}

function manualScore(val) {
  if (val) renderScore(parseInt(val));
}

function renderScore(score) {
  const el  = document.getElementById("score-display");
  const bar = document.getElementById("score-bar");
  if (el)  el.textContent = score;
  if (bar) {
    bar.style.width = score + "%";
    bar.className = "score-bar__fill " +
      (score >= 70 ? "score-good" : score >= 50 ? "score-warn" : "score-bad");
  }
}

/* ── CHECKLIST ── */
function updateChecklist() {
  const checks = {
    "chk-product":    !!(document.getElementById("f-product")?.value && document.getElementById("f-slug")?.value),
    "chk-title":      !!(document.getElementById("f-title")?.value && document.getElementById("f-tagline")?.value),
    "chk-summary":    !!(document.getElementById("f-summary")?.value),
    "chk-image":      !!(document.getElementById("f-image")?.value),
    "chk-heuristics": document.querySelectorAll(".h-score-input").length > 0 &&
                      [...document.querySelectorAll(".h-score-input")].some(i => i.value),
    "chk-friction":   document.querySelectorAll(".friction-item").length > 0,
    "chk-tags":       getTags().length > 0,
  };
  Object.entries(checks).forEach(([id, done]) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.className = "check-icon " + (done ? "check-done" : "check-empty");
  });
}

/* Live checklist updates */
["f-product","f-slug","f-title","f-tagline","f-summary","f-image"].forEach(id => {
  const el = document.getElementById(id);
  if (el) el.addEventListener("input", updateChecklist);
});
updateChecklist();

/* ── AI GENERATION ── */
async function generateWithAI() {
  const prompt = document.getElementById("ai-prompt").value.trim();
  if (!prompt) { alert("Describe the product/flow you observed first."); return; }

  const product  = document.getElementById("f-product")?.value || "";
  const category = document.getElementById("f-category")?.value || "";

  const systemPrompt = `You are Ramesh Mandal — a senior UX leader with 17+ years at IndiGo and enterprise platforms. You conduct rigorous, opinionated UX audits grounded in Nielsen heuristics, cognitive psychology, and real business outcomes.

Your job: analyse the product observation and return structured audit data. Be specific, use real numbers where possible, name psychology principles correctly, and write in a confident first-person voice.

Return ONLY valid JSON — no markdown, no preamble:
{
  "heuristics": [
    {"id": "H1", "score": 6, "note": "specific observation..."},
    ...all 10 heuristics...
  ],
  "overall_score": 61,
  "friction_points": [
    {
      "title": "Short friction title",
      "severity": "HIGH",
      "screen": "Screen or flow name",
      "principle": "Psychology principle name",
      "observation": "What is broken and why it matters to the user",
      "impact": "Business/revenue/retention impact estimate",
      "redesign": "What you would change and the rationale"
    }
  ],
  "tagline": "One sharp, opinionated sentence about the product's core UX problem",
  "summary": "2-3 sentences summarising the audit findings for the listing card"
}

Nielsen heuristics order (use exactly these IDs):
H1: Visibility of System Status
H2: Match Between System & Real World
H3: User Control & Freedom
H4: Consistency & Standards
H5: Error Prevention
H6: Recognition Over Recall
H7: Flexibility & Efficiency of Use
H8: Aesthetic & Minimalist Design
H9: Help Users Recognise Errors
H10: Help & Documentation

Score 0–10 per heuristic. overall_score = avg × 10, rounded.
Generate 4–8 friction points. Be specific about screens, user impact, and redesign direction.`;

  const userPrompt = `Product: ${product || "Unknown"}
Category: ${category || "Unknown"}

Observation: ${prompt}

Generate the full audit scorecard, friction map, tagline, and summary.`;

  document.getElementById("ai-status").classList.add("is-active");

  try {
    const res = await fetch("https://api.anthropic.com/v1/messages", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        model: "claude-sonnet-4-20250514",
        max_tokens: 1000,
        system: systemPrompt,
        messages: [{ role: "user", content: userPrompt }],
      }),
    });

    const data = await res.json();
    const text = data.content?.[0]?.text || "";

    let parsed;
    try {
      parsed = JSON.parse(text.replace(/```json|```/g, "").trim());
    } catch {
      alert("AI returned unexpected format. Try again or check the console.");
      console.error("Raw AI response:", text);
      return;
    }

    /* ── FILL HEURISTICS ── */
    if (parsed.heuristics) {
      parsed.heuristics.forEach(h => {
        const scoreEl = document.querySelector(`.h-score-input[data-hid="${h.id}"]`);
        const noteEl  = document.querySelector(`.h-note-input[data-hid="${h.id}"]`);
        if (scoreEl) scoreEl.value = h.score;
        if (noteEl)  noteEl.value  = h.note;
      });
      updateScorePreview();
    }

    /* ── FILL SCORE ── */
    if (parsed.overall_score) {
      document.getElementById("f-score").value = parsed.overall_score;
      renderScore(parsed.overall_score);
    }

    /* ── FILL FRICTION ── */
    if (parsed.friction_points?.length) {
      document.getElementById("friction-list").innerHTML = "";
      frictionCount = 0;
      parsed.friction_points.forEach(fp => addFriction(fp));
    }

    /* ── FILL CONTENT ── */
    if (parsed.tagline && !document.getElementById("f-tagline").value) {
      document.getElementById("f-tagline").value = parsed.tagline;
    }
    if (parsed.summary && !document.getElementById("f-summary").value) {
      document.getElementById("f-summary").value = parsed.summary;
    }

    updateChecklist();

  } catch (err) {
    alert("Error: " + err.message);
    console.error(err);
  } finally {
    document.getElementById("ai-status").classList.remove("is-active");
  }
}

/* ── GENERATE PHP BLOCK ── */
function generatePHP() {
  const product  = document.getElementById("f-product").value.trim();
  const slug     = document.getElementById("f-slug").value.trim();
  const category = document.getElementById("f-category").value.trim().toUpperCase();
  const year     = document.getElementById("f-year").value.trim();
  const status   = document.getElementById("f-status").value;
  const severity = document.getElementById("f-severity").value;
  const image    = document.getElementById("f-image").value.trim();
  const title    = document.getElementById("f-title").value.trim();
  const tagline  = document.getElementById("f-tagline").value.trim();
  const summary  = document.getElementById("f-summary").value.trim();
  const scoreOverride = document.getElementById("f-score").value;
  const frictionCountVal = parseInt(document.getElementById("f-friction-count").value) || 0;
  const tags = getTags();

  /* calc score */
  let score = parseInt(scoreOverride) || 0;
  if (!score) {
    const inputs = [...document.querySelectorAll(".h-score-input")].filter(i => i.value);
    if (inputs.length) {
      const avg = inputs.reduce((s, i) => s + parseFloat(i.value), 0) / inputs.length;
      score = Math.round(avg * 10);
    }
  }

  if (!product || !slug || !title) {
    alert("Fill in: product, slug, and title at minimum.");
    return;
  }

  function ps(s) { return (s||"").replace(/\\/g,"\\\\").replace(/'/g,"\\'"); }

  let php = `  [\n`;
  php += `    "slug"          => '${ps(slug)}',\n`;
  php += `    "status"        => '${status}',\n`;
  php += `    "product"       => '${ps(product)}',\n`;
  php += `    "category"      => '${ps(category)}',\n`;
  php += `    "title"         => '${ps(title)}',\n`;
  php += `    "tagline"       => '${ps(tagline)}',\n`;
  php += `    "image"         => '${ps(image)}',\n`;
  php += `    "score"         => ${score},\n`;
  php += `    "severity"      => '${severity}',\n`;
  php += `    "year"          => '${ps(year)}',\n`;
  php += `    "tags"          => [${tags.map(t => `'${ps(t)}'`).join(", ")}],\n`;
  php += `    "friction_count"=> ${frictionCountVal || document.querySelectorAll(".friction-item").length},\n`;
  php += `    "summary"       => '${ps(summary)}',\n`;
  php += `  ],`;

  /* ── ALSO GENERATE HEURISTICS BLOCK for the audit page ── */
  const heuristics = [];
  document.querySelectorAll("tr[data-h]").length; // check
  const scoreInputs = document.querySelectorAll(".h-score-input");
  const noteInputs  = document.querySelectorAll(".h-note-input");

  if ([...scoreInputs].some(i => i.value)) {
    const hLabels = {
      H1:"Visibility of System Status", H2:"Match Between System & Real World",
      H3:"User Control & Freedom", H4:"Consistency & Standards",
      H5:"Error Prevention", H6:"Recognition Over Recall",
      H7:"Flexibility & Efficiency of Use", H8:"Aesthetic & Minimalist Design",
      H9:"Help Users Recognise Errors", H10:"Help & Documentation",
    };

    php += `\n\n// ── HEURISTICS for audit/${ps(slug)}.php ──\n`;
    php += `$heuristics = [\n`;
    scoreInputs.forEach(si => {
      const hid   = si.dataset.hid;
      const ni    = document.querySelector(`.h-note-input[data-hid="${hid}"]`);
      const sc    = si.value || "0";
      const note  = ni?.value || "";
      php += `  ["id" => "${hid}", "label" => "${hLabels[hid]}", "score" => ${sc}, "note" => '${ps(note)}'],\n`;
    });
    php += `];\n`;
    php += `$overallScore = ${score};\n`;
  }

  /* ── FRICTION POINTS ── */
  const frictionItems = document.querySelectorAll(".friction-item");
  if (frictionItems.length) {
    php += `\n// ── FRICTION POINTS for audit/${ps(slug)}.php ──\n`;
    php += `$frictionPoints = [\n`;
    frictionItems.forEach((el, i) => {
      const title_   = el.querySelector(".fi-title")?.value || "";
      const severity_ = el.querySelector(".fi-severity")?.value || "MEDIUM";
      const screen_  = el.querySelector(".fi-screen")?.value || "";
      const principle_ = el.querySelector(".fi-principle")?.value || "";
      const obs_    = el.querySelector(".fi-observation")?.value || "";
      const impact_ = el.querySelector(".fi-impact")?.value || "";
      const redesign_ = el.querySelector(".fi-redesign")?.value || "";
      php += `  [\n`;
      php += `    "id"          => "F${i+1}",\n`;
      php += `    "title"       => '${ps(title_)}',\n`;
      php += `    "severity"    => '${severity_}',\n`;
      php += `    "screen"      => '${ps(screen_)}',\n`;
      php += `    "principle"   => '${ps(principle_)}',\n`;
      php += `    "observation" => '${ps(obs_)}',\n`;
      php += `    "impact"      => '${ps(impact_)}',\n`;
      php += `    "redesign"    => '${ps(redesign_)}',\n`;
      php += `  ],\n`;
    });
    php += `];\n`;
  }

  const box     = document.getElementById("output");
  const actions = document.getElementById("output-actions");
  box.textContent = php;
  box.classList.add("is-visible");
  actions.classList.add("is-visible");
  box.scrollIntoView({ behavior: "smooth", block: "start" });
}

/* ── COPY ── */
function copyOutput() {
  navigator.clipboard.writeText(document.getElementById("output").textContent).then(() => {
    const btn = event.target;
    btn.textContent = "Copied ✓";
    setTimeout(() => btn.textContent = "Copy to clipboard", 2000);
  });
}

/* ── HELPERS ── */
function escHtml(str) {
  return String(str)
    .replace(/&/g,"&amp;")
    .replace(/</g,"&lt;")
    .replace(/>/g,"&gt;")
    .replace(/"/g,"&quot;");
}

/* init */
updateChecklist();
</script>

</body>
</html>