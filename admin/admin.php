<?php
/* =========================================
   ADMIN / INDEX.PHP
   Blog post manager for Field Notes.
   Password protected. Local use only.
   ========================================= */

session_start();

/* ── SIMPLE PASSWORD GATE ───────────────── */
define("ADMIN_PASS", "ramsm"); // ← change this

if (!isset($_SESSION["admin_ok"])) {
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pass"])) {
    if ($_POST["pass"] === ADMIN_PASS) {
      $_SESSION["admin_ok"] = true;
    } else {
      $loginError = "Wrong password.";
    }
  }
  if (!isset($_SESSION["admin_ok"])) {
    showLogin($loginError ?? null);
    exit;
  }
}

if (isset($_GET["logout"])) {
  session_destroy();
  header("Location: index.php");
  exit;
}

/* ── LOAD BLOG DATA ─────────────────────── */
require_once __DIR__ . "/../data/blog.php";

/* ── VIEW ───────────────────────────────── */
$view = $_GET["view"] ?? "list"; // list | new | edit

function showLogin($error = null) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin — Field Notes</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: system-ui, sans-serif; background: #f5f5f3; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
    .login { background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 16px; padding: 48px; width: 100%; max-width: 360px; }
    .login h1 { font-size: 1.4rem; font-weight: 600; margin-bottom: 8px; }
    .login p { font-size: 14px; color: #666; margin-bottom: 28px; }
    .login input { width: 100%; padding: 12px 16px; border: 1px solid rgba(0,0,0,0.12); border-radius: 8px; font-size: 15px; margin-bottom: 12px; }
    .login button { width: 100%; padding: 12px; background: #0f0f0f; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 500; cursor: pointer; }
    .error { color: #dc2626; font-size: 13px; margin-bottom: 12px; }
  </style>
</head>
<body>
  <div class="login">
    <h1>Field Notes Admin</h1>
    <p>Blog post manager for 6epixels.com</p>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="POST">
      <input type="password" name="pass" placeholder="Password" autofocus required/>
      <button type="submit">Enter →</button>
    </form>
  </div>
</body>
</html>
<?php }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin — Field Notes</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: -apple-system, "Inter", system-ui, sans-serif;
      background: #f5f5f3;
      color: #0f0f0f;
      min-height: 100vh;
    }

    /* ── LAYOUT ── */
    .admin-header {
      background: #fff;
      border-bottom: 1px solid rgba(0,0,0,0.08);
      padding: 0 32px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .admin-header__logo { font-weight: 700; font-size: 15px; }
    .admin-header__logo span { color: #1a46c9; }
    .admin-header__nav { display: flex; gap: 8px; align-items: center; }
    .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 500; text-decoration: none; border: none; cursor: pointer; transition: all 0.2s; }
    .btn-primary { background: #0f0f0f; color: #fff; }
    .btn-primary:hover { background: #1a46c9; }
    .btn-ghost { background: transparent; color: #444; border: 1px solid rgba(0,0,0,0.12); }
    .btn-ghost:hover { border-color: #0f0f0f; color: #0f0f0f; }
    .btn-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    .admin-main { padding: 32px; max-width: 1100px; margin: 0 auto; }

    /* ── POST LIST ── */
    .post-list { display: flex; flex-direction: column; gap: 1px; background: rgba(0,0,0,0.06); border-radius: 12px; overflow: hidden; }
    .post-row { background: #fff; padding: 20px 24px; display: flex; align-items: center; gap: 16px; }
    .post-row:hover { background: #fafafa; }
    .post-row__emoji { font-size: 1.4rem; width: 36px; text-align: center; flex-shrink: 0; }
    .post-row__body { flex: 1; min-width: 0; }
    .post-row__title { font-size: 15px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .post-row__meta { font-size: 12px; color: #888; margin-top: 3px; display: flex; gap: 10px; }
    .post-row__actions { display: flex; gap: 8px; flex-shrink: 0; }
    .tag { font-size: 11px; padding: 3px 8px; border-radius: 4px; font-weight: 500; }
    .tag-war      { background: #fff7ed; color: #c2410c; }
    .tag-wins     { background: #f0fdf4; color: #15803d; }
    .tag-opinion  { background: #fdf4ff; color: #9333ea; }
    .tag-research { background: #eff6ff; color: #1d4ed8; }
    .featured-badge { background: #fef9c3; color: #854d0e; font-size: 10px; padding: 2px 6px; border-radius: 4px; font-weight: 600; }

    /* ── FORM ── */
    .form-card { background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 16px; padding: 32px; }
    .form-section { margin-bottom: 28px; }
    .form-section h3 { font-size: 13px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #888; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid rgba(0,0,0,0.06); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .form-group:last-child { margin-bottom: 0; }
    label { font-size: 12px; font-weight: 500; color: #444; }
    input[type=text], input[type=email], select, textarea {
      padding: 10px 14px;
      border: 1px solid rgba(0,0,0,0.12);
      border-radius: 8px;
      font-size: 14px;
      font-family: inherit;
      width: 100%;
      transition: border-color 0.2s;
      background: #fff;
    }
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: #1a46c9;
    }
    textarea { resize: vertical; min-height: 100px; line-height: 1.6; }
    .char-count { font-size: 11px; color: #aaa; text-align: right; }

    /* Paragraph builder */
    .para-list { display: flex; flex-direction: column; gap: 8px; }
    .para-item { display: flex; gap: 8px; align-items: flex-start; }
    .para-item textarea { flex: 1; min-height: 72px; }
    .para-item .para-num { font-size: 11px; color: #aaa; padding-top: 12px; width: 20px; text-align: right; flex-shrink: 0; }
    .para-remove { background: none; border: 1px solid #fecaca; color: #dc2626; border-radius: 6px; padding: 6px 10px; cursor: pointer; font-size: 13px; flex-shrink: 0; margin-top: 8px; }
    .add-para-btn { background: none; border: 1px dashed rgba(0,0,0,0.2); color: #666; border-radius: 8px; padding: 10px 16px; width: 100%; cursor: pointer; font-size: 13px; margin-top: 8px; transition: all 0.2s; }
    .add-para-btn:hover { border-color: #1a46c9; color: #1a46c9; }

    /* AI panel */
    .ai-panel { background: linear-gradient(135deg, #eff6ff, #f5f3ff); border: 1px solid #bfdbfe; border-radius: 12px; padding: 20px 24px; margin-bottom: 24px; }
    .ai-panel h3 { font-size: 14px; font-weight: 600; color: #1d4ed8; margin-bottom: 8px; }
    .ai-panel p { font-size: 13px; color: #3730a3; margin-bottom: 14px; line-height: 1.5; }
    .ai-row { display: flex; gap: 8px; }
    .ai-row input { flex: 1; }
    .ai-generating { display: none; font-size: 13px; color: #1d4ed8; margin-top: 10px; align-items: center; gap: 8px; }
    .ai-generating.is-active { display: flex; }
    @keyframes spin { to { transform: rotate(360deg); } }
    .spinner { width: 14px; height: 14px; border: 2px solid #bfdbfe; border-top-color: #1d4ed8; border-radius: 50%; animation: spin 0.8s linear infinite; }

    /* Output */
    .output-box { background: #0f0f0f; color: #e2e8f0; border-radius: 12px; padding: 24px; font-family: "Monaco", "Menlo", monospace; font-size: 12px; line-height: 1.7; overflow-x: auto; white-space: pre; display: none; margin-top: 24px; }
    .output-box.is-visible { display: block; }

    /* Stats */
    .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
    .stat-box { background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; }
    .stat-box__val { font-size: 2rem; font-weight: 700; letter-spacing: -0.03em; }
    .stat-box__label { font-size: 12px; color: #888; margin-top: 4px; }

    .page-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 4px; }
    .page-sub   { font-size: 14px; color: #666; margin-bottom: 24px; }

    .notice { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #15803d; margin-bottom: 20px; }
  </style>
</head>
<body>

<header class="admin-header">
  <div class="admin-header__logo">Field Notes <span>Admin</span></div>
  <nav class="admin-header__nav">
    <a href="?view=list" class="btn btn-ghost">← All Posts</a>
    <a href="?view=new"  class="btn btn-primary">+ New Post</a>
    <a href="?logout=1"  class="btn btn-ghost">Log out</a>
  </nav>
</header>

<main class="admin-main">

<?php if ($view === "list"): ?>

  <!-- ══════════ LIST VIEW ══════════ -->

  <?php
    $cats   = array_count_values(array_column($posts, "category"));
    $featured = count(array_filter($posts, fn($p) => $p["featured"]));
  ?>

  <p class="page-title">Field Notes</p>
  <p class="page-sub">All posts in <code>data/blog.php</code></p>

  <div class="stats-row">
    <div class="stat-box">
      <div class="stat-box__val"><?= count($posts) ?></div>
      <div class="stat-box__label">Total Posts</div>
    </div>
    <div class="stat-box">
      <div class="stat-box__val"><?= $featured ?></div>
      <div class="stat-box__label">Featured</div>
    </div>
    <div class="stat-box">
      <div class="stat-box__val"><?= count(array_keys($cats)) ?></div>
      <div class="stat-box__label">Categories</div>
    </div>
    <div class="stat-box">
      <div class="stat-box__val"><?= array_sum(array_map(fn($p) => count($p["body"]), $posts)) ?></div>
      <div class="stat-box__label">Total Paragraphs</div>
    </div>
  </div>

  <div class="post-list">
    <?php foreach ($posts as $p): ?>
      <div class="post-row">
        <span class="post-row__emoji"><?= $p["emoji"] ?></span>
        <div class="post-row__body">
          <div class="post-row__title">
            <?= htmlspecialchars($p["title"]) ?>
            <?php if ($p["featured"]): ?><span class="featured-badge">FEATURED</span><?php endif; ?>
          </div>
          <div class="post-row__meta">
            <span class="tag tag-<?= $p["category"] ?>"><?= htmlspecialchars($p["tag"]) ?></span>
            <span><?= htmlspecialchars($p["date"]) ?></span>
            <span><?= count($p["body"]) ?> paragraphs</span>
            <span><?= htmlspecialchars($p["read_time"]) ?></span>
          </div>
        </div>
        <div class="post-row__actions">
          <a href="../blog/post.php?slug=<?= urlencode($p["slug"]) ?>" target="_blank" class="btn btn-ghost">Preview ↗</a>
          <a href="?view=edit&slug=<?= urlencode($p["slug"]) ?>" class="btn btn-ghost">Edit</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

<?php elseif ($view === "new" || $view === "edit"): ?>

  <!-- ══════════ NEW / EDIT VIEW ══════════ -->

  <?php
    $editSlug = $_GET["slug"] ?? null;
    $editing  = null;
    if ($editSlug) {
      foreach ($posts as $p) {
        if ($p["slug"] === $editSlug) { $editing = $p; break; }
      }
    }
    $isEdit = $editing !== null;
  ?>

  <p class="page-title"><?= $isEdit ? "Edit Post" : "New Post" ?></p>
  <p class="page-sub">
    <?= $isEdit
      ? "Editing: " . htmlspecialchars($editing["title"])
      : "Fill in the fields below. Use the AI assistant to generate body copy." ?>
  </p>

  <?php if ($isEdit): ?>
  <div class="notice">
    ✓ After generating the PHP block below, copy it into <code>data/blog.php</code> to replace the existing entry for this post.
  </div>
  <?php endif; ?>

  <!-- AI ASSISTANT -->
  <div class="ai-panel">
    <h3>✦ AI Writing Assistant</h3>
    <p>Describe your post idea in one sentence — the AI will write the full body paragraphs and takeaway in your voice. Fill in the title, subtitle and category first, then use this.</p>
    <div class="ai-row">
      <input type="text" id="ai-prompt" placeholder="e.g. The time a 2px border radius change caused a 6-hour incident review..." />
      <button class="btn btn-primary" onclick="generateWithAI()">Generate ✦</button>
    </div>
    <div class="ai-generating" id="ai-status">
      <div class="spinner"></div>
      Writing in Ramesh's voice...
    </div>
  </div>

  <div class="form-card">

    <div class="form-section">
      <h3>Identity</h3>
      <div class="form-row">
        <div class="form-group">
          <label>Slug (URL)</label>
          <input type="text" id="f-slug" placeholder="the-redesign-nobody-asked-for"
            value="<?= htmlspecialchars($editing["slug"] ?? "") ?>"/>
        </div>
        <div class="form-group">
          <label>Emoji</label>
          <input type="text" id="f-emoji" placeholder="💥" maxlength="2"
            value="<?= htmlspecialchars($editing["emoji"] ?? "") ?>"/>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Category</label>
          <select id="f-category">
            <option value="war"      <?= ($editing["category"] ?? "") === "war"      ? "selected" : "" ?>>⚡ War Story</option>
            <option value="wins"     <?= ($editing["category"] ?? "") === "wins"     ? "selected" : "" ?>>✦ Quiet Win</option>
            <option value="opinion"  <?= ($editing["category"] ?? "") === "opinion"  ? "selected" : "" ?>>◈ Unpopular Opinion</option>
            <option value="research" <?= ($editing["category"] ?? "") === "research" ? "selected" : "" ?>>⬡ From the Field</option>
          </select>
        </div>
        <div class="form-group">
          <label>Date</label>
          <input type="text" id="f-date" placeholder="March 2024"
            value="<?= htmlspecialchars($editing["date"] ?? "") ?>"/>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Featured?</label>
          <select id="f-featured">
            <option value="false" <?= (!($editing["featured"] ?? false)) ? "selected" : "" ?>>No</option>
            <option value="true"  <?= (($editing["featured"] ?? false))  ? "selected" : "" ?>>Yes — show in featured row</option>
          </select>
        </div>
        <div class="form-group">
          <label>Card Color</label>
          <select id="f-color">
            <option value="light" <?= ($editing["color"] ?? "") === "light" ? "selected" : "" ?>>Light (default)</option>
            <option value="dark"  <?= ($editing["color"] ?? "") === "dark"  ? "selected" : "" ?>>Dark</option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-section">
      <h3>Content</h3>
      <div class="form-group">
        <label>Title</label>
        <input type="text" id="f-title" placeholder="The Redesign Nobody Asked For"
          value="<?= htmlspecialchars($editing["title"] ?? "") ?>"/>
      </div>
      <div class="form-group">
        <label>Subtitle</label>
        <input type="text" id="f-subtitle" placeholder="How a full visual overhaul tanked NPS by 12 points in two weeks."
          value="<?= htmlspecialchars($editing["subtitle"] ?? "") ?>"/>
      </div>
      <div class="form-group">
        <label>Excerpt (shown on card)</label>
        <textarea id="f-excerpt" rows="3" maxlength="280"><?= htmlspecialchars($editing["excerpt"] ?? "") ?></textarea>
        <div class="char-count"><span id="exc-count">0</span> / 280</div>
      </div>
    </div>

    <div class="form-section">
      <h3>Body Paragraphs</h3>
      <div class="para-list" id="para-list">
        <?php
          $bodyParas = $editing["body"] ?? [""];
          foreach ($bodyParas as $i => $para):
        ?>
          <div class="para-item">
            <span class="para-num"><?= $i + 1 ?></span>
            <textarea class="para-textarea" rows="3"><?= htmlspecialchars($para) ?></textarea>
            <button class="para-remove" onclick="removePara(this)" title="Remove">✕</button>
          </div>
        <?php endforeach; ?>
      </div>
      <button class="add-para-btn" onclick="addPara()">+ Add paragraph</button>
    </div>

    <div class="form-section">
      <h3>Takeaway</h3>
      <div class="form-group">
        <textarea id="f-takeaway" rows="3" placeholder="The key lesson in one sentence..."><?= htmlspecialchars($editing["takeaway"] ?? "") ?></textarea>
      </div>
    </div>

    <div style="display:flex;gap:12px;flex-wrap:wrap">
      <button class="btn btn-primary" onclick="generatePHP()" style="font-size:14px;padding:12px 24px">
        Generate PHP Block ↓
      </button>
      <button class="btn btn-ghost" onclick="document.getElementById('output').scrollIntoView({behavior:'smooth'})">
        Jump to output
      </button>
    </div>

  </div>

  <!-- OUTPUT -->
  <div class="output-box" id="output"></div>

  <div id="copy-actions" style="display:none;margin-top:12px;display:none;gap:10px">
    <button class="btn btn-primary" onclick="copyOutput()">Copy to clipboard</button>
    <p style="font-size:13px;color:#666;align-self:center">
      Paste this block into <code>data/blog.php</code> inside the <code>$posts = [...]</code> array.
    </p>
  </div>

<?php endif; ?>

</main>

<script>
/* ═══════════════════════════════════════════
   ADMIN JS
═══════════════════════════════════════════ */

/* ── CHAR COUNT ── */
const excField = document.getElementById("f-excerpt");
const excCount = document.getElementById("exc-count");
if (excField) {
  excCount.textContent = excField.value.length;
  excField.addEventListener("input", () => {
    excCount.textContent = excField.value.length;
  });
}

/* ── PARA MANAGEMENT ── */
let paraCount = document.querySelectorAll(".para-item").length;

function addPara(text = "") {
  paraCount++;
  const list = document.getElementById("para-list");
  const item = document.createElement("div");
  item.className = "para-item";
  item.innerHTML = `
    <span class="para-num">${paraCount}</span>
    <textarea class="para-textarea" rows="3">${escHtml(text)}</textarea>
    <button class="para-remove" onclick="removePara(this)" title="Remove">✕</button>
  `;
  list.appendChild(item);
  renumberParas();
}

function removePara(btn) {
  btn.closest(".para-item").remove();
  renumberParas();
}

function renumberParas() {
  document.querySelectorAll(".para-item .para-num").forEach((el, i) => {
    el.textContent = i + 1;
  });
}

function escHtml(str) {
  return str.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;");
}

/* ── AUTO-SLUG ── */
const titleField = document.getElementById("f-title");
const slugField  = document.getElementById("f-slug");
if (titleField && slugField && !slugField.value) {
  titleField.addEventListener("input", () => {
    slugField.value = titleField.value
      .toLowerCase()
      .replace(/[^a-z0-9\s-]/g, "")
      .trim()
      .replace(/\s+/g, "-");
  });
}

/* ── AI GENERATION ── */
async function generateWithAI() {
  const prompt = document.getElementById("ai-prompt").value.trim();
  if (!prompt) { alert("Enter a post idea first."); return; }

  const title    = document.getElementById("f-title").value;
  const subtitle = document.getElementById("f-subtitle").value;
  const category = document.getElementById("f-category").value;

  const catLabels = {
    war: "War Story — something that went wrong and what I learned",
    wins: "Quiet Win — a small change with big unexpected impact",
    opinion: "Unpopular Opinion — a contrarian take on UX/design practice",
    research: "From the Field — an observation from real user/field research",
  };

  const systemPrompt = `You are Ramesh Mandal — a senior UX leader with 17+ years experience at IndiGo (India's largest airline), enterprise SaaS, and design systems. You write with authority, specificity, and zero fluff. Your voice is direct, honest, occasionally self-critical. You use real numbers. You don't hedge unnecessarily. You write like someone who has shipped things and paid for mistakes.

Write ONLY the JSON output — no preamble, no markdown, no explanation. Return exactly this structure:
{
  "paragraphs": ["paragraph 1", "paragraph 2", ...],
  "takeaway": "The key lesson in one actionable sentence."
}

Rules:
- 5-7 paragraphs
- First paragraph: drop the reader straight into the situation — no scene-setting preamble
- Use real specifics (numbers, timelines, team sizes, tool names)
- At least one paragraph should be uncomfortable/self-critical
- Last paragraph before takeaway: what actually changed or was done
- Takeaway: one sentence, actionable, no fluff
- Write in first person
- Category context: ${catLabels[category] || "Field Notes"}`;

  const userPrompt = `Post idea: ${prompt}
${title ? `Title: ${title}` : ""}
${subtitle ? `Subtitle: ${subtitle}` : ""}

Write the body paragraphs and takeaway for this Field Notes post.`;

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
      alert("AI returned unexpected format. Try again.");
      return;
    }

    /* ── FILL FORM ── */
    // Clear existing paras
    document.getElementById("para-list").innerHTML = "";
    paraCount = 0;
    parsed.paragraphs.forEach(p => addPara(p));

    // Fill takeaway
    if (parsed.takeaway) {
      document.getElementById("f-takeaway").value = parsed.takeaway;
    }

  } catch (err) {
    alert("Error calling AI: " + err.message);
  } finally {
    document.getElementById("ai-status").classList.remove("is-active");
  }
}

/* ── GENERATE PHP BLOCK ── */
function generatePHP() {
  const slug     = document.getElementById("f-slug").value.trim();
  const emoji    = document.getElementById("f-emoji").value.trim();
  const category = document.getElementById("f-category").value;
  const date     = document.getElementById("f-date").value.trim();
  const featured = document.getElementById("f-featured").value === "true";
  const color    = document.getElementById("f-color").value;
  const title    = document.getElementById("f-title").value.trim();
  const subtitle = document.getElementById("f-subtitle").value.trim();
  const excerpt  = document.getElementById("f-excerpt").value.trim();
  const takeaway = document.getElementById("f-takeaway").value.trim();

  const tagMap = {
    war: "War Story", wins: "Quiet Win",
    opinion: "Unpopular Opinion", research: "From the Field"
  };
  const readMap = { 3: "3 min read", 4: "4 min read", 5: "5 min read", 6: "6 min read", 7: "7 min read" };

  const paras = [...document.querySelectorAll(".para-textarea")]
    .map(t => t.value.trim())
    .filter(Boolean);

  const wordCount = paras.join(" ").split(/\s+/).length;
  const mins = Math.max(3, Math.round(wordCount / 200));
  const readTime = readMap[mins] || mins + " min read";

  if (!slug || !title || !paras.length || !takeaway) {
    alert("Fill in: slug, title, at least one paragraph, and takeaway.");
    return;
  }

  function phpStr(s) {
    return s.replace(/\\/g, "\\\\").replace(/'/g, "\\'");
  }

  let php = `  [\n`;
  php += `    "slug"     => '${phpStr(slug)}',\n`;
  php += `    "category" => '${category}',\n`;
  php += `    "tag"      => '${tagMap[category]}',\n`;
  php += `    "featured" => ${featured ? "true" : "false"},\n`;
  php += `    "title"    => '${phpStr(title)}',\n`;
  php += `    "subtitle" => '${phpStr(subtitle)}',\n`;
  php += `    "excerpt"  => '${phpStr(excerpt)}',\n`;
  php += `    "read_time"=> '${readTime}',\n`;
  php += `    "date"     => '${phpStr(date)}',\n`;
  php += `    "emoji"    => '${emoji}',\n`;
  php += `    "color"    => '${color}',\n`;
  php += `    "body"     => [\n`;
  paras.forEach(p => {
    php += `      '${phpStr(p)}',\n`;
  });
  php += `    ],\n`;
  php += `    "takeaway" => '${phpStr(takeaway)}',\n`;
  php += `  ],`;

  const box = document.getElementById("output");
  box.textContent = php;
  box.classList.add("is-visible");

  const actions = document.getElementById("copy-actions");
  actions.style.display = "flex";
  box.scrollIntoView({ behavior: "smooth", block: "start" });
}

/* ── COPY ── */
function copyOutput() {
  const text = document.getElementById("output").textContent;
  navigator.clipboard.writeText(text).then(() => {
    const btn = event.target;
    btn.textContent = "Copied ✓";
    setTimeout(() => btn.textContent = "Copy to clipboard", 2000);
  });
}
</script>

</body>
</html>