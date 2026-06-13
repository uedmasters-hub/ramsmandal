<?php
/* =========================================
   API / CONTACT.PHP — Form handler
   Works on localhost + production
   ========================================= */

header("Content-Type: application/json");
header("X-Content-Type-Options: nosniff");
header("Access-Control-Allow-Origin: *");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  echo json_encode(["success" => false, "message" => "Method not allowed."]);
  exit;
}

if (session_status() === PHP_SESSION_NONE) { session_start(); }

/* ── CSRF ─────────────────────────────────── */
$token = $_POST["csrf_token"] ?? "";
if (!isset($_SESSION["csrf_token"]) || !hash_equals($_SESSION["csrf_token"], $token)) {
  http_response_code(403);
  echo json_encode(["success" => false, "message" => "Invalid request. Please reload and try again."]);
  exit;
}

/* ── HONEYPOT ─────────────────────────────── */
if (!empty($_POST["website"])) {
  echo json_encode(["success" => true]);
  exit;
}

/* ── SANITISE ─────────────────────────────── */
function clean(string $v): string {
  return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, "UTF-8");
}

$name    = clean($_POST["name"]    ?? "");
$email   = trim($_POST["email"]    ?? "");
$subject = clean($_POST["subject"] ?? "");
$message = clean($_POST["message"] ?? "");
$type    = clean($_POST["type"]    ?? "General Enquiry");

/* ── VALIDATE ─────────────────────────────── */
$errors = [];
if (strlen($name) < 2 || strlen($name) > 100)        $errors["name"]    = "Please enter your full name.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL))        $errors["email"]   = "Please enter a valid email.";
if (strlen($subject) < 3 || strlen($subject) > 200)   $errors["subject"] = "Subject must be 3–200 characters.";
if (strlen($message) < 20 || strlen($message) > 3000) $errors["message"] = "Message must be 20–3000 characters.";

if (!empty($errors)) {
  http_response_code(422);
  echo json_encode(["success" => false, "errors" => $errors]);
  exit;
}

/* ── RATE LIMIT ───────────────────────────── */
$now = time();
if (isset($_SESSION["last_contact"]) && ($now - $_SESSION["last_contact"]) < 60) {
  http_response_code(429);
  echo json_encode(["success" => false, "message" => "Please wait before sending another message."]);
  exit;
}

/* ── EMAIL CONFIG ─────────────────────────── */
$to      = "6epixels@gmail.com";           // ← updated email
$subject_line = "[Portfolio] {$type}: {$subject}";

$body_text = implode("\n", [
  "New message from your portfolio",
  str_repeat("─", 50),
  "",
  "Name:     {$name}",
  "Email:    {$email}",
  "Type:     {$type}",
  "Subject:  {$subject}",
  "",
  "Message:",
  $message,
  "",
  str_repeat("─", 50),
  "Sent:     " . date("Y-m-d H:i:s"),
  "IP:       " . ($_SERVER["REMOTE_ADDR"] ?? "unknown"),
]);

/* ── LOG TO FILE (always — works on localhost) ── */
$log_dir  = __DIR__ . "/../storage";
$log_file = $log_dir . "/contact-submissions.log";

if (!is_dir($log_dir)) {
  mkdir($log_dir, 0755, true);
}

$log_entry = "[" . date("Y-m-d H:i:s") . "] FROM: {$name} <{$email}> | TYPE: {$type} | SUBJECT: {$subject}\nMESSAGE: {$message}\n" . str_repeat("-", 60) . "\n";
file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);

/* ── TRY SMTP VIA GMAIL (production) ─────── */
$mail_sent = false;

/* Method 1: Try PHP mail() with proper headers */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "From: Portfolio Contact <noreply@ramesh-mandal.com>\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "X-Mailer: PHP/" . PHP_VERSION . "\r\n";

$mail_sent = @mail($to, $subject_line, $body_text, $headers);

/* Method 2: If mail() fails, try sending via Gmail SMTP using sockets */
if (!$mail_sent) {
  $mail_sent = sendViaSmtp($to, $subject_line, $body_text, $name, $email);
}

/* ── RESPOND ──────────────────────────────── */
// Always succeed if we at least logged it — user gets confirmation,
// you check the log file at /storage/contact-submissions.log
$_SESSION["last_contact"] = $now;
$_SESSION["csrf_token"]   = bin2hex(random_bytes(32));

echo json_encode([
  "success"    => true,
  "csrf_token" => $_SESSION["csrf_token"],
  "mail_sent"  => $mail_sent,
]);

/* ── SMTP FUNCTION ────────────────────────── */
function sendViaSmtp(string $to, string $subject, string $body, string $fromName, string $replyTo): bool {
  /*
   * Fill these in once you're on a live server with SMTP access.
   * For Gmail: enable App Password at myaccount.google.com/apppasswords
   * then paste the 16-char password below.
   */
  $smtp_host = "smtp.gmail.com";
  $smtp_port = 587;
  $smtp_user = "6epixels@gmail.com";   // your Gmail
  $smtp_pass = "";                      // ← paste Gmail App Password here when on server

  if (empty($smtp_pass)) return false;

  try {
    $sock = fsockopen("tls://{$smtp_host}", 465, $errno, $errstr, 10);
    if (!$sock) return false;

    $read = function($sock) { $r = ""; while ($l = fgets($sock, 512)) { $r .= $l; if (substr($l,3,1)==" ") break; } return $r; };

    $read($sock); // greeting
    fputs($sock, "EHLO localhost\r\n");      $read($sock);
    fputs($sock, "AUTH LOGIN\r\n");           $read($sock);
    fputs($sock, base64_encode($smtp_user)."\r\n"); $read($sock);
    fputs($sock, base64_encode($smtp_pass)."\r\n"); $r = $read($sock);
    if (strpos($r,"235") === false) { fclose($sock); return false; }

    fputs($sock, "MAIL FROM:<{$smtp_user}>\r\n");  $read($sock);
    fputs($sock, "RCPT TO:<{$to}>\r\n");            $read($sock);
    fputs($sock, "DATA\r\n");                        $read($sock);

    $msg  = "To: {$to}\r\n";
    $msg .= "From: Portfolio Contact <{$smtp_user}>\r\n";
    $msg .= "Reply-To: {$fromName} <{$replyTo}>\r\n";
    $msg .= "Subject: {$subject}\r\n";
    $msg .= "MIME-Version: 1.0\r\n";
    $msg .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
    $msg .= $body . "\r\n.\r\n";
    fputs($sock, $msg); $r = $read($sock);

    fputs($sock, "QUIT\r\n");
    fclose($sock);
    return strpos($r,"250") !== false;
  } catch (\Throwable $e) {
    return false;
  }
}