<?php
session_start();
define("ADMIN_PASS", "ramsm");

if (!isset($_SESSION["admin_ok"])) {
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pass"])) {
    if ($_POST["pass"] === ADMIN_PASS) { $_SESSION["admin_ok"] = true; }
    else { $err = "Wrong password."; }
  }
  if (!isset($_SESSION["admin_ok"])) {
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Admin</title>';
    echo '<style>body{font-family:sans-serif;background:#f5f5f3;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}';
    echo '.b{background:#fff;padding:40px;border-radius:12px;width:320px;box-shadow:0 2px 20px rgba(0,0,0,.08)}';
    echo 'h2{margin-bottom:20px}input{width:100%;padding:10px;border:1px solid #ddd;border-radius:6px;margin-bottom:12px;box-sizing:border-box}';
    echo 'button{width:100%;padding:10px;background:#0f0f0f;color:#fff;border:none;border-radius:6px;cursor:pointer}';
    echo '.e{color:red;font-size:13px;margin-bottom:10px}</style></head><body>';
    echo '<div class="b"><h2>Case Study Admin</h2>';
    if (isset($err)) echo '<p class="e">' . htmlspecialchars($err) . '</p>';
    echo '<form method="POST"><input type="password" name="pass" placeholder="Password" autofocus/><button>Enter</button></form></div></body></html>';
    exit;
  }
}

if (isset($_GET["logout"])) { session_destroy(); header("Location: case-studies.php"); exit; }

require_once __DIR__ . "/../data/case-studies.php";

$view = isset($_GET["view"]) ? $_GET["view"] : "list";
$slug = isset($_GET["slug"]) ? $_GET["slug"] : "";

function h($s) { return htmlspecialchars($s, ENT_QUOTES); }
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Case Study Admin</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,system-ui,sans-serif;background:#f5f5f3;color:#111;min-height:100vh}
.hdr{background:#fff;border-bottom:1px solid #e5e7eb;padding:0 24px;height:56px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50}
.hdr strong{font-size:15px}.hdr strong span{color:#1a46c9}
.hnav{display:flex;gap:8px}
.btn{display:inline-flex;align-items:center;padding:7px 14px;border-radius:7px;font-size:13px;font-weight:500;text-decoration:none;border:1px solid transparent;cursor:pointer;background:transparent;color:#444;border-color:#d1d5db;transition:all .15s}
.btn:hover{border-color:#111;color:#111}
.btnp{background:#111;color:#fff;border-color:#111}.btnp:hover{background:#1a46c9;border-color:#1a46c9;color:#fff}
.main{padding:24px;max-width:1000px;margin:0 auto}
.pt{font-size:1.4rem;font-weight:600;margin-bottom:4px}
.ps{font-size:13px;color:#666;margin-bottom:20px}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px}
.sbox{background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:16px}
.sv{font-size:1.8rem;font-weight:700}.sl{font-size:12px;color:#888;margin-top:2px}
.list{border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;background:#fff}
.row{display:flex;align-items:center;gap:14px;padding:16px 20px;border-bottom:1px solid #f3f4f6}
.row:last-child{border-bottom:none}.row:hover{background:#fafafa}
.rimg{width:72px;height:46px;border-radius:6px;object-fit:cover;flex-shrink:0}
.rbody{flex:1;min-width:0}
.rtitle{font-size:14px;font-weight:500}
.rmeta{font-size:12px;color:#888;margin-top:3px;display:flex;gap:10px;flex-wrap:wrap}
.tag{background:#f1f5f9;color:#475569;font-size:11px;padding:2px 7px;border-radius:4px}
.fb{background:#fef3c7;color:#92400e;font-size:10px;padding:2px 6px;border-radius:4px;font-weight:600}
.mcs{display:flex;gap:8px;margin-top:6px;flex-wrap:wrap}
.mc{font-size:11px;background:#f8fafc;border:1px solid #e5e7eb;border-radius:4px;padding:3px 8px}
.mc strong{color:#1a46c9}
.racts{display:flex;gap:6px;flex-shrink:0}
.card{background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:24px;margin-bottom:16px}
.sh3{font-size:11px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#888;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #f3f4f6}
.fg{display:flex;flex-direction:column;gap:4px;margin-bottom:12px}
.frow{display:grid;grid-template-columns:1fr 1fr;gap:12px}
label{font-size:12px;font-weight:500;color:#444}
input,select,textarea{padding:8px 11px;border:1px solid #d1d5db;border-radius:7px;font-size:13px;font-family:inherit;width:100%;transition:border .15s}
input:focus,select:focus,textarea:focus{outline:none;border-color:#1a46c9}
textarea{resize:vertical;line-height:1.6}
.hint{font-size:11px;color:#aaa;margin-top:2px}
.mlist{display:flex;flex-direction:column;gap:8px}
.mrow{display:grid;grid-template-columns:100px 1fr auto;gap:8px;align-items:center}
.mrem,.madd{padding:6px 10px;border-radius:6px;cursor:pointer;font-size:12px}
.mrem{background:none;border:1px solid #fecaca;color:#dc2626}
.madd{background:none;border:1px dashed #d1d5db;color:#666;width:100%;margin-top:6px}
.madd:hover{border-color:#1a46c9;color:#1a46c9}
.tlist{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:8px}
.ti{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;border-radius:5px;padding:3px 9px;font-size:12px;display:flex;align-items:center;gap:5px}
.ti button{background:none;border:none;color:#93c5fd;cursor:pointer;font-size:13px}
.tir{display:flex;gap:8px}.tir input{flex:1}
.aipanel{background:linear-gradient(135deg,#eff6ff,#f5f3ff);border:1px solid #bfdbfe;border-radius:10px;padding:18px 22px;margin-bottom:16px}
.aipanel h3{font-size:14px;font-weight:600;color:#1d4ed8;margin-bottom:6px}
.aipanel p{font-size:13px;color:#3730a3;margin-bottom:10px}
.airow{display:flex;gap:8px}.airow input{flex:1}
.aist{display:none;font-size:13px;color:#1d4ed8;margin-top:8px;align-items:center;gap:8px}
.aist.on{display:flex}
@keyframes sp{to{transform:rotate(360deg)}}
.sp{width:13px;height:13px;border:2px solid #bfdbfe;border-top-color:#1d4ed8;border-radius:50%;animation:sp .8s linear infinite}
.seclist{display:flex;flex-direction:column;gap:10px}
.secitem{border:1px solid #e5e7eb;border-radius:8px;overflow:hidden}
.sechead{background:#f8fafc;padding:10px 14px;display:flex;align-items:center;gap:8px;cursor:pointer}
.secnum{font-size:11px;color:#888;width:22px;font-weight:600}
.seclabel{font-size:13px;font-weight:500;flex:1}
.secbody{padding:14px;display:none}
.secbody.open{display:block}
.out{background:#111;color:#d1fae5;border-radius:10px;padding:20px;font-family:monospace;font-size:11px;line-height:1.7;overflow-x:auto;white-space:pre;display:none;margin-top:16px;max-height:440px;overflow-y:auto}
.out.on{display:block}
.oacts{display:none;margin-top:10px;gap:10px;align-items:center}
.oacts.on{display:flex}
.oacts p{font-size:12px;color:#666}
.notice{background:#f0fdf4;border:1px solid #bbf7d0;border-radius:7px;padding:10px 14px;font-size:13px;color:#15803d;margin-bottom:16px}
code{background:rgba(0,0,0,.06);padding:1px 5px;border-radius:3px;font-size:11px}
@media(max-width:640px){.frow,.stats{grid-template-columns:1fr}}
</style>
</head>
<body>
<header class="hdr">
  <strong>Case Studies <span>Admin</span></strong>
  <nav class="hnav">
    <a href="index.php"  class="btn">Blog</a>
    <a href="?view=list" class="btn">All</a>
    <a href="?view=new"  class="btn btnp">+ New</a>
    <a href="?logout=1"  class="btn">Out</a>
  </nav>
</header>
<main class="main">

<?php if ($view === "list"): ?>

<p class="pt">Case Studies</p>
<p class="ps">Manage entries in <code>data/case-studies.php</code></p>

<?php
  $pub = 0; $feat = 0; $cos = array();
  foreach ($caseStudies as $cs) {
    if ($cs["status"] === "published") $pub++;
    if ($cs["featured"]) $feat++;
    $cos[$cs["company"]] = 1;
  }
?>

<div class="stats">
  <div class="sbox"><div class="sv"><?php echo count($caseStudies); ?></div><div class="sl">Studies</div></div>
  <div class="sbox"><div class="sv"><?php echo $pub; ?></div><div class="sl">Published</div></div>
  <div class="sbox"><div class="sv"><?php echo $feat; ?></div><div class="sl">Featured</div></div>
  <div class="sbox"><div class="sv"><?php echo count($cos); ?></div><div class="sl">Companies</div></div>
</div>

<div class="list">
<?php foreach ($caseStudies as $cs): ?>
  <div class="row">
    <img class="rimg" src="<?php echo h($cs["image"]); ?>" alt=""/>
    <div class="rbody">
      <div class="rtitle"><?php echo h($cs["title"]); ?> <?php if ($cs["featured"]): ?><span class="fb">FEATURED</span><?php endif; ?></div>
      <div class="rmeta">
        <span class="tag"><?php echo h($cs["category"]); ?></span>
        <span><?php echo h($cs["company"]); ?></span>
        <span><?php echo h($cs["year"]); ?></span>
        <span><?php echo h($cs["duration"]); ?></span>
      </div>
      <div class="mcs">
        <?php foreach (array_slice($cs["metrics"], 0, 4) as $m): ?>
          <span class="mc"><strong><?php echo h($m["value"]); ?></strong> <?php echo h($m["label"]); ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="racts">
      <a href="../case-study/<?php echo urlencode($cs["slug"]); ?>.php" target="_blank" class="btn">View</a>
      <a href="?view=edit&amp;slug=<?php echo urlencode($cs["slug"]); ?>" class="btn">Edit</a>
    </div>
  </div>
<?php endforeach; ?>
</div>

<?php elseif ($view === "new" || $view === "edit"): ?>

<?php
  $ed = null;
  if ($slug) { foreach ($caseStudies as $cs) { if ($cs["slug"] === $slug) { $ed = $cs; break; } } }
  $isEdit = $ed !== null;
  $mets = $ed ? $ed["metrics"] : array(
    array("value"=>"","label"=>""), array("value"=>"","label"=>""),
    array("value"=>"","label"=>""), array("value"=>"","label"=>"")
  );
  $secs = array(
    array("id"=>"overview",  "n"=>"01","l"=>"Overview"),
    array("id"=>"problem",   "n"=>"02","l"=>"Problem"),
    array("id"=>"research",  "n"=>"03","l"=>"Research"),
    array("id"=>"psychology","n"=>"04","l"=>"Psychology"),
    array("id"=>"process",   "n"=>"05","l"=>"Process"),
    array("id"=>"solution",  "n"=>"06","l"=>"Solution"),
    array("id"=>"outcomes",  "n"=>"07","l"=>"Outcomes"),
    array("id"=>"learnings", "n"=>"08","l"=>"Learnings"),
  );
?>

<p class="pt"><?php echo $isEdit ? "Edit Case Study" : "New Case Study"; ?></p>
<p class="ps"><?php echo $isEdit ? "Editing: " . h($ed["title"]) : "Fill the form then generate output."; ?></p>
<div class="notice">Generates: (1) data block for <code>data/case-studies.php</code> and (2) page PHP file for <code>case-study/slug.php</code></div>

<div class="aipanel">
  <h3>AI Writing Assistant</h3>
  <p>Describe the project. Claude writes all 8 sections in your voice.</p>
  <div class="airow">
    <input type="text" id="aip" placeholder="e.g. Redesigned IndiGo staff portal, cut task time from 8 min to 90 sec"/>
    <button class="btn btnp" onclick="doAI()">Generate</button>
  </div>
  <div class="aist" id="aist"><div class="sp"></div>Writing...</div>
</div>

<div class="card">
  <div class="sh3">Identity</div>
  <div class="frow">
    <div class="fg"><label>Slug</label><input type="text" id="f-slug" value="<?php echo h($ed ? $ed["slug"] : ""); ?>" placeholder="indigo-staff-portal"/></div>
    <div class="fg"><label>Status</label><select id="f-status"><option value="published" <?php echo ($ed && $ed["status"]==="published")?"selected":""; ?>>Published</option><option value="draft" <?php echo ($ed && $ed["status"]==="draft")?"selected":""; ?>>Draft</option></select></div>
  </div>
  <div class="fg"><label>Category</label><input type="text" id="f-cat" value="<?php echo h($ed ? $ed["category"] : ""); ?>" placeholder="ENTERPRISE PORTAL"/></div>
  <div class="fg"><label>Title</label><input type="text" id="f-title" value="<?php echo h($ed ? $ed["title"] : ""); ?>" placeholder="Staff Travel Portal"/></div>
  <div class="fg"><label>Tagline</label><input type="text" id="f-tag" value="<?php echo h($ed ? $ed["tagline"] : ""); ?>" placeholder="One sentence summary..."/></div>
  <div class="fg"><label>Hero Image URL</label><input type="url" id="f-img" value="<?php echo h($ed ? $ed["image"] : ""); ?>" placeholder="https://images.unsplash.com/..."/><p class="hint">Unsplash URL + ?q=80&amp;w=1600&amp;auto=format&amp;fit=crop</p></div>
  <div class="frow">
    <div class="fg"><label>Featured</label><select id="f-feat"><option value="0" <?php echo ($ed && !$ed["featured"])?"selected":""; ?>>No</option><option value="1" <?php echo ($ed && $ed["featured"])?"selected":""; ?>>Yes</option></select></div>
    <div class="fg"><label>Year</label><input type="text" id="f-year" value="<?php echo h($ed ? $ed["year"] : ""); ?>" placeholder="2022 - 2024"/></div>
  </div>
  <div class="frow">
    <div class="fg"><label>Role</label><input type="text" id="f-role" value="<?php echo h($ed ? $ed["role"] : ""); ?>" placeholder="Sr. Manager UI/UX"/></div>
    <div class="fg"><label>Company</label><input type="text" id="f-co" value="<?php echo h($ed ? $ed["company"] : ""); ?>" placeholder="IndiGo Airlines"/></div>
  </div>
  <div class="fg"><label>Duration</label><input type="text" id="f-dur" value="<?php echo h($ed ? $ed["duration"] : ""); ?>" placeholder="6 months"/></div>

  <div class="sh3" style="margin-top:20px">Metrics</div>
  <div class="mlist" id="mlist">
    <?php foreach ($mets as $m): ?>
      <div class="mrow">
        <input type="text" class="mv" placeholder="22%" value="<?php echo h($m["value"]); ?>"/>
        <input type="text" class="ml" placeholder="Revenue Growth" value="<?php echo h($m["label"]); ?>"/>
        <button class="mrem" onclick="this.closest('.mrow').remove()">x</button>
      </div>
    <?php endforeach; ?>
  </div>
  <button class="madd" onclick="addM()">+ Add metric</button>

  <div class="sh3" style="margin-top:20px">Tags</div>
  <div class="tlist" id="tlist">
    <?php foreach (($ed ? $ed["tags"] : array()) as $t): ?>
      <span class="ti"><?php echo h($t); ?><button onclick="this.closest('.ti').remove()">x</button></span>
    <?php endforeach; ?>
  </div>
  <div class="tir">
    <input type="text" id="tag-in" placeholder="CRO, UX Strategy..." onkeydown="if(event.key==='Enter'){addTag();event.preventDefault();}"/>
    <button class="btn" onclick="addTag()">Add</button>
  </div>

  <button class="btn btnp" style="width:100%;justify-content:center;padding:11px;margin-top:20px" onclick="genData()">Generate Data Block</button>
  <div class="out" id="out-data"></div>
  <div class="oacts" id="acts-data">
    <button class="btn btnp" onclick="cp('out-data','acts-data')">Copy</button>
    <p>Paste into <code>data/case-studies.php</code> inside the array</p>
  </div>
</div>

<div class="card">
  <div class="sh3">Case Study Sections</div>
  <p style="font-size:13px;color:#666;margin-bottom:14px">Use AI or fill manually. Each section = heading + body text.</p>
  <div class="seclist">
    <?php foreach ($secs as $s): ?>
      <div class="secitem">
        <div class="sechead" onclick="tog(this)">
          <span class="secnum"><?php echo $s["n"]; ?></span>
          <span class="seclabel"><?php echo $s["l"]; ?></span>
          <span>+</span>
        </div>
        <div class="secbody" id="sb-<?php echo $s["id"]; ?>">
          <div class="fg"><label>Heading</label><input type="text" id="h-<?php echo $s["id"]; ?>" placeholder="Section heading..."/></div>
          <div class="fg"><label>Content (blank line = new paragraph)</label><textarea id="b-<?php echo $s["id"]; ?>" rows="5" placeholder="Write content here..."></textarea></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <button class="btn btnp" style="width:100%;justify-content:center;padding:11px;margin-top:16px" onclick="genPage()">Generate Page File</button>
  <div class="out" id="out-page"></div>
  <div class="oacts" id="acts-page">
    <button class="btn btnp" onclick="cp('out-page','acts-page')">Copy</button>
    <p>Save as <code>case-study/<span id="fn">slug</span>.php</code></p>
  </div>
</div>

<?php endif; ?>
</main>
<script>
function addM(){var l=document.getElementById("mlist"),d=document.createElement("div");d.className="mrow";d.innerHTML='<input type="text" class="mv" placeholder="40%"/><input type="text" class="ml" placeholder="Label"/><button class="mrem" onclick="this.closest(\'.mrow\').remove()">x</button>';l.appendChild(d);}
function addTag(){var i=document.getElementById("tag-in"),v=i.value.trim();if(!v)return;v.split(",").forEach(function(t){t=t.trim();if(!t)return;var l=document.getElementById("tlist"),s=document.createElement("span");s.className="ti";s.innerHTML=t+'<button onclick="this.closest(\'.ti\').remove()">x</button>';l.appendChild(s);});i.value="";}
function tog(h){var b=h.nextElementSibling;b.classList.toggle("open");h.querySelector("span:last-child").textContent=b.classList.contains("open")?"−":"+";}
function esc(s){return(s||"").replace(/\\/g,"\\\\").replace(/'/g,"\\'")}
function genData(){
  var sl=document.getElementById("f-slug").value.trim();
  var ti=document.getElementById("f-title").value.trim();
  if(!sl||!ti){alert("Slug and title required.");return;}
  var st=document.getElementById("f-status").value;
  var ca=document.getElementById("f-cat").value.trim();
  var tg=document.getElementById("f-tag").value.trim();
  var im=document.getElementById("f-img").value.trim();
  var ft=document.getElementById("f-feat").value==="1";
  var yr=document.getElementById("f-year").value.trim();
  var ro=document.getElementById("f-role").value.trim();
  var co=document.getElementById("f-co").value.trim();
  var du=document.getElementById("f-dur").value.trim();
  var ms=[]; document.querySelectorAll(".mrow").forEach(function(r){var v=r.querySelector(".mv").value.trim(),l=r.querySelector(".ml").value.trim();if(v||l)ms.push({v:v,l:l});});
  var ts=[]; document.querySelectorAll(".tlist .ti").forEach(function(t){ts.push(t.childNodes[0].textContent.trim());});
  var o="  [\n";
  o+="    \"slug\"     => '"+esc(sl)+"',\n";
  o+="    \"status\"   => '"+st+"',\n";
  o+="    \"category\" => '"+esc(ca)+"',\n";
  o+="    \"title\"    => '"+esc(ti)+"',\n";
  o+="    \"tagline\"  => '"+esc(tg)+"',\n";
  o+="    \"image\"    => '"+esc(im)+"',\n";
  o+="    \"year\"     => '"+esc(yr)+"',\n";
  o+="    \"role\"     => '"+esc(ro)+"',\n";
  o+="    \"company\"  => '"+esc(co)+"',\n";
  o+="    \"duration\" => '"+esc(du)+"',\n";
  o+="    \"featured\" => "+(ft?"true":"false")+",\n";
  o+="    \"tags\"     => ["+ts.map(function(t){return"'"+esc(t)+"'";}).join(", ")+"],\n";
  o+="    \"metrics\"  => [\n";
  ms.forEach(function(m){o+="      [\"value\" => '"+esc(m.v)+"', \"label\" => '"+esc(m.l)+"'],\n";});
  o+="    ],\n  ],";
  show("out-data","acts-data",o);
}
function genPage(){
  var sl=document.getElementById("f-slug").value.trim()||"new-study";
  var ti=document.getElementById("f-title").value.trim()||"Case Study";
  var tg=document.getElementById("f-tag").value.trim();
  var ro=document.getElementById("f-role").value.trim();
  var co=document.getElementById("f-co").value.trim();
  var du=document.getElementById("f-dur").value.trim();
  var yr=document.getElementById("f-year").value.trim();
  var im=document.getElementById("f-img").value.trim();
  var ms=[]; document.querySelectorAll(".mrow").forEach(function(r){var v=r.querySelector(".mv").value.trim(),l=r.querySelector(".ml").value.trim();if(v)ms.push({v:v,l:l});});
  var mH=""; ms.forEach(function(m){mH+='              <div class="cs-metric-card"><div class="cs-metric-card__value">'+m.v+'<\/div><div class="cs-metric-card__label">'+m.l+'<\/div><\/div>\n';});
  var ids=["overview","problem","research","psychology","process","solution","outcomes","learnings"];
  var nums=["01","02","03","04","05","06","07","08"];
  var sH=""; ids.forEach(function(id,i){
    var hv=document.getElementById("h-"+id).value.trim();
    var bv=document.getElementById("b-"+id).value.trim();
    var ps=bv?bv.split(/\n{2,}/).filter(function(p){return p.trim();}) :[];
    sH+='          <section class="cs-section" id="'+id+'">\n';
    sH+='            <span class="cs-section__label">'+nums[i]+' \u2014 '+id.charAt(0).toUpperCase()+id.slice(1)+'<\/span>\n';
    if(hv) sH+='            <h2 class="cs-section__title">'+hv+'<\/h2>\n';
    if(ps.length){sH+='            <div class="cs-section__body">\n';ps.forEach(function(p){sH+='              <p>'+p.replace(/</g,"&lt;")+'<\/p>\n';});sH+='            <\/div>\n';}
    if(id==="overview"||id==="outcomes"){sH+='            <div class="cs-metrics-row">\n'+mH+'            <\/div>\n';}
    sH+='          <\/section>\n';
  });
  var o="";
  /* Build PHP page - use string literals not template to avoid PHP parsing issues */
  o+='<?'+'php\n';
  o+='require_once __DIR__ . "/../includes/config.php";\n';
  o+='$'+'currentKey = "case-studies";\n';
  o+='$'+'pageTitle  = "'+esc(ti)+' \u2014 Case Study";\n';
  o+='$'+'pageDesc   = "'+esc(tg)+'";\n';
  o+='$'+'meta = [\n';
  o+='  ["label" => "Role",     "value" => "'+esc(ro)+'"],\n';
  o+='  ["label" => "Company",  "value" => "'+esc(co)+'"],\n';
  o+='  ["label" => "Duration", "value" => "'+esc(du)+'"],\n';
  o+='  ["label" => "Year",     "value" => "'+esc(yr)+'"],\n';
  o+='];\n';
  o+='$'+'nav = [\n';
  ids.forEach(function(id,i){o+='  ["id" => "'+id+'", "label" => "'+ids[i].charAt(0).toUpperCase()+ids[i].slice(1)+'"],\n';});
  o+='];\n?'+'>\n';
  o+='<!DOCTYPE html>\n<html lang="en">\n<head>\n';
  o+='  <meta charset="UTF-8"/>\n  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>\n';
  o+='  <title>'+ti+' \u2014 Case Study<\/title>\n';
  o+='  <link rel="icon" href="/assets/icons/favicon.ico"/>\n';
  o+='  <link rel="preconnect" href="https://fonts.googleapis.com"/>\n';
  o+='  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700&display=swap" rel="stylesheet"/>\n';
  o+='  <link rel="stylesheet" href="../assets/css/preloader.css"/>\n';
  o+='  <link rel="stylesheet" href="../assets/css/variables.css"/>\n';
  o+='  <link rel="stylesheet" href="../assets/css/animations.css"/>\n';
  o+='  <link rel="stylesheet" href="../assets/css/reset.css"/>\n';
  o+='  <link rel="stylesheet" href="../assets/css/main.css"/>\n';
  o+='  <link rel="stylesheet" href="../assets/css/navigation.css"/>\n';
  o+='  <link rel="stylesheet" href="../assets/css/background.css"/>\n';
  o+='  <link rel="stylesheet" href="../assets/css/footer.css"/>\n';
  o+='  <link rel="stylesheet" href="../assets/css/case-study.css"/>\n';
  o+='<\/head>\n<body>\n';
  o+='  <div class="cs-progress-bar" id="cs-progress"><\/div>\n';
  o+='  <div class="preloader" id="preloader" aria-hidden="true"><div class="preloader__grid"><\/div><div class="preloader__inner"><div class="preloader__mark">RM<\/div><div class="preloader__name"><span class="preloader__name-text">'+ti+'<\/span><span class="preloader__name-role">Case Study<\/span><\/div><div class="preloader__bar-wrap"><div class="preloader__bar" id="preloader-bar"><\/div><\/div><span class="preloader__counter" id="preloader-counter">0%<\/span><\/div><\/div>\n';
  o+='  <div class="bg-canvas" aria-hidden="true"><div class="bg-grid"><\/div><div class="bg-orb-1"><\/div><div class="bg-orb-2"><\/div><\/div>\n';
  o+='  <'+'?php require_once __DIR__ . "/../partials/header.php"; ?'+'>\n';
  o+='  <div class="page-wrapper">\n    <main id="main-content">\n';
  o+='      <div class="cs-detail-hero fade-in"><img class="cs-detail-hero__img" src="'+im+'" alt="'+ti+'" loading="eager"/><div class="cs-detail-hero__overlay"><\/div><div class="cs-detail-hero__content"><p class="cs-detail-hero__category">CASE STUDY<\/p><h1 class="cs-detail-hero__title">'+ti+'<\/h1><p class="cs-detail-hero__tagline">'+tg+'<\/p><\/div><\/div>\n';
  o+='      <div class="cs-meta-bar"><'+'?php foreach ($'+'meta as $'+'m): ?'+'><div class="cs-meta-item"><span class="cs-meta-item__label"><'+'?php echo htmlspecialchars($'+'m[\'label\']); ?'+'><\/span><span class="cs-meta-item__value"><'+'?php echo htmlspecialchars($'+'m[\'value\']); ?'+'><\/span><\/div><'+'?php endforeach; ?'+'><\/div>\n';
  o+='      <div class="cs-content"><nav class="cs-nav"><'+'?php foreach ($'+'nav as $'+'n): ?'+'><a href="#<'+'?php echo $'+'n[\'id\']; ?'+'>" class="cs-nav__item" data-nav="<'+'?php echo $'+'n[\'id\']; ?'+'>"><'+'?php echo htmlspecialchars($'+'n[\'label\']); ?'+'><\/a><'+'?php endforeach; ?'+'><\/nav>\n';
  o+='        <article class="cs-article">\n'+sH+'        <\/article>\n      <\/div>\n';
  o+='      <div class="cs-next"><div><p class="cs-next__label">All Case Studies<\/p><a href="index.php" class="cs-next__link"><p class="cs-next__title">View All Work<\/p><span class="cs-next__arrow">\u2197<\/span><\/a><\/div><\/div>\n';
  o+='    <\/main>\n    <'+'?php require_once __DIR__ . "/../partials/footer.php"; ?'+'>\n  <\/div>\n';
  o+='  <sc'+'ript src="../assets/js/preloader.js"><\/sc'+'ript>\n';
  o+='  <sc'+'ript src="../assets/js/background.js" defer><\/sc'+'ript>\n';
  o+='  <sc'+'ript src="../assets/js/animations.js" defer><\/sc'+'ript>\n';
  o+='  <sc'+'ript src="../assets/js/app.js" defer><\/sc'+'ript>\n';
  o+='  <sc'+'ript>\n  (function(){var b=document.getElementById("cs-progress"),m=document.getElementById("main-content");if(!b||!m)return;window.addEventListener("scroll",function(){b.style.width=Math.min(100,(window.scrollY/(m.scrollHeight-window.innerHeight))*100)+"%";},{passive:true});})();\n  <\/sc'+'ript>\n<\/body>\n<\/html>';
  document.getElementById("fn").textContent=sl+".php";
  show("out-page","acts-page",o);
}
async function doAI(){
  var prompt=document.getElementById("aip").value.trim();
  if(!prompt){alert("Describe the project first.");return;}
  var ti=document.getElementById("f-title").value;
  var ro=document.getElementById("f-role").value;
  var co=document.getElementById("f-co").value;
  var sys='You are Ramesh Mandal, Sr. Manager UI/UX with 17+ years. Write in first person, specific, honest, with real numbers. Return ONLY valid JSON:\n{"overview":{"heading":"...","body":"para1\\n\\npara2"},"problem":{"heading":"...","body":"para1\\n\\npara2"},"research":{"heading":"...","body":"para1\\n\\npara2"},"psychology":{"heading":"...","body":"para1\\n\\npara2"},"process":{"heading":"...","body":"para1\\n\\npara2"},"solution":{"heading":"...","body":"para1\\n\\npara2"},"outcomes":{"heading":"...","body":"para1\\n\\npara2"},"learnings":{"heading":"...","body":"para1\\n\\npara2"}}';
  document.getElementById("aist").classList.add("on");
  try{
    var r=await fetch("https://api.anthropic.com/v1/messages",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({model:"claude-sonnet-4-20250514",max_tokens:1000,system:sys,messages:[{role:"user",content:"Project: "+prompt+"\nTitle: "+ti+"\nRole: "+ro+"\nCompany: "+co}]})});
    var d=await r.json();
    var t=(d.content&&d.content[0]?d.content[0].text:"").replace(/```json|```/g,"").trim();
    var p=JSON.parse(t);
    ["overview","problem","research","psychology","process","solution","outcomes","learnings"].forEach(function(id){
      var x=p[id];if(!x)return;
      var hEl=document.getElementById("h-"+id);
      var bEl=document.getElementById("b-"+id);
      if(hEl&&x.heading)hEl.value=x.heading;
      if(bEl&&x.body)bEl.value=x.body;
      var sec=document.getElementById("sb-"+id);
      if(sec){sec.classList.add("open");sec.previousElementSibling.querySelector("span:last-child").textContent="-";}
    });
    alert("Done! Review the sections then click Generate Page File.");
  }catch(err){alert("AI error: "+err.message);}
  finally{document.getElementById("aist").classList.remove("on");}
}
function show(oid,aid,c){var b=document.getElementById(oid);b.textContent=c;b.classList.add("on");document.getElementById(aid).classList.add("on");b.scrollIntoView({behavior:"smooth",block:"start"});}
function cp(oid,aid){navigator.clipboard.writeText(document.getElementById(oid).textContent).then(function(){var b=document.querySelector("#"+aid+" .btn");var orig=b.textContent;b.textContent="Copied!";setTimeout(function(){b.textContent=orig;},2000);});}
var tf=document.getElementById("f-title");var sf=document.getElementById("f-slug");
if(tf&&sf&&!sf.value){tf.addEventListener("input",function(){sf.value=tf.value.toLowerCase().replace(/[^a-z0-9\s-]/g,"").trim().replace(/\s+/g,"-");});}
</script>
</body>
</html>