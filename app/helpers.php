<?php
/* =========================================================================
   app/helpers.php — small global helpers. No classes, just functions.
   ========================================================================= */

declare(strict_types=1);

/** Read an env var with a default. */
function env(string $key, $default = null) {
    return $_ENV[$key] ?? getenv($key) ?: $default;
}

/** Escape for HTML output. */
function e(?string $s): string {
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

/** Build an internal URL (prepends APP_BASE). */
function url(string $path = '/'): string {
    return APP_BASE . '/' . ltrim($path, '/');
}

/** Build a static asset URL under /public (served directly by Apache). */
function asset(string $path): string {
    return APP_BASE . '/public/' . ltrim($path, '/');
}

/** Static asset URL with a cache-busting ?v=<mtime>, so an updated CSS/JS file
    is fetched fresh instead of served from the browser cache. */
function asset_v(string $path): string {
    $rel  = ltrim($path, '/');
    $file = BASE_DIR . '/public/' . $rel;
    $v    = is_file($file) ? filemtime($file) : null;
    return APP_BASE . '/public/' . $rel . ($v ? '?v=' . $v : '');
}

/** Load a content data file from /content and return what it yields. */
function content(string $name) {
    $file = CONTENT_DIR . '/' . $name . '.php';
    return is_file($file) ? require $file : null;
}

/**
 * Render a view inside the base layout.
 * The view may set $page = ['title'=>, 'desc'=>, 'body_class'=>, 'styles'=>[], 'scripts'=>[]].
 */
function view(string $name, array $data = []): void {
    extract($data, EXTR_SKIP);
    $page = [];                                  // a view can overwrite this
    ob_start();
    require VIEW_DIR . '/' . $name . '.php';
    $content = ob_get_clean();                    // captured page markup
    require VIEW_DIR . '/layouts/base.php';       // wraps $content + uses $page
}

/** Send a 404 and render the not-found view. */
function not_found(): void {
    http_response_code(404);
    view('404');
    exit;
}

/** True when the client expects a JSON response (fetch/AJAX). */
function wants_json(): bool {
    $xrw = strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '');
    $acc = $_SERVER['HTTP_ACCEPT'] ?? '';
    return $xrw === 'fetch' || strpos($acc, 'application/json') !== false;
}

/** Append a line to the contact log so submissions never fail silently. */
function contact_log(string $line): void {
    $dir = BASE_DIR . '/storage';
    if (!is_dir($dir)) { @mkdir($dir, 0775, true); }
    @file_put_contents($dir . '/contact.log', '[' . date('c') . '] ' . $line . "\n", FILE_APPEND | LOCK_EX);
}

/**
 * Minimal dependency-free SMTP client (SSL / STARTTLS / plain, optional AUTH LOGIN).
 * Returns ['ok' => bool, 'error' => string]. ok === true only when the server
 * accepts the message (final 250) — a real signal, unlike mail().
 */
function smtp_send(array $cfg, string $to, string $subject, string $body, array $extraHeaders = []): array {
    $host = (string)($cfg['host'] ?? '');
    $port = (int)($cfg['port'] ?? 587);
    $secure = strtolower((string)($cfg['secure'] ?? 'tls'));   // ssl | tls | none
    $user = (string)($cfg['user'] ?? '');
    $pass = (string)($cfg['pass'] ?? '');
    $from = (string)($cfg['from'] ?? $user);
    $fromName = (string)($cfg['from_name'] ?? '');
    if ($host === '' || $from === '') { return ['ok' => false, 'error' => 'SMTP not configured']; }

    $remote = ($secure === 'ssl' ? 'ssl://' : 'tcp://') . $host . ':' . $port;
    $ctx = stream_context_create(['ssl' => ['verify_peer' => true, 'verify_peer_name' => true, 'SNI_enabled' => true]]);
    $fp = @stream_socket_client($remote, $errno, $errstr, 15, STREAM_CLIENT_CONNECT, $ctx);
    if (!$fp) { return ['ok' => false, 'error' => "connect failed ($errno): $errstr"]; }
    stream_set_timeout($fp, 15);

    $read = function () use ($fp) {
        $data = '';
        while (($line = fgets($fp, 600)) !== false) {
            $data .= $line;
            if (strlen($line) >= 4 && $line[3] === ' ') break;
        }
        return $data;
    };
    $code = static fn($r) => (int)substr((string)$r, 0, 3);
    $say  = function ($c) use ($fp) { fwrite($fp, $c . "\r\n"); };
    $bye  = function ($msg) use ($fp) { @fwrite($fp, "QUIT\r\n"); @fclose($fp); return ['ok' => false, 'error' => $msg]; };

    if ($code($read()) !== 220) { return $bye('no greeting'); }
    $ehlo = preg_replace('/[^A-Za-z0-9.\-]/', '', (string)($_SERVER['SERVER_NAME'] ?? 'localhost')) ?: 'localhost';
    $say("EHLO $ehlo"); if ($code($read()) !== 250) { return $bye('EHLO refused'); }

    if ($secure === 'tls') {
        $say('STARTTLS'); if ($code($read()) !== 220) { return $bye('STARTTLS refused'); }
        $ok = @stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        if (!$ok) { return $bye('TLS failed'); }
        $say("EHLO $ehlo"); if ($code($read()) !== 250) { return $bye('EHLO refused after TLS'); }
    }
    if ($user !== '') {
        $say('AUTH LOGIN'); if ($code($read()) !== 334) { return $bye('AUTH unsupported'); }
        $say(base64_encode($user)); if ($code($read()) !== 334) { return $bye('username refused'); }
        $say(base64_encode($pass)); if ($code($read()) !== 235) { return $bye('authentication failed'); }
    }
    $say("MAIL FROM:<$from>"); if ($code($read()) !== 250) { return $bye('MAIL FROM refused'); }
    $say("RCPT TO:<$to>"); $rc = $code($read()); if ($rc !== 250 && $rc !== 251) { return $bye('RCPT TO refused'); }
    $say('DATA'); if ($code($read()) !== 354) { return $bye('DATA refused'); }

    $domain = preg_replace('/^www\./', '', $ehlo);
    $namePart = $fromName !== '' ? '"' . str_replace('"', '', $fromName) . '" ' : '';
    $head = [
        'Date: ' . date('r'),
        'From: ' . $namePart . "<$from>",
        "To: <$to>",
        'Subject: =?UTF-8?B?' . base64_encode($subject) . '?=',
        'Message-ID: <' . bin2hex(random_bytes(8)) . '@' . $domain . '>',
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
    ];
    foreach ($extraHeaders as $h) { $head[] = $h; }

    $msg = implode("\r\n", $head) . "\r\n\r\n" . str_replace("\n", "\r\n", str_replace("\r\n", "\n", $body));
    $msg = preg_replace('/^\./m', '..', $msg);                 // dot-stuffing
    $say($msg); $say('.');
    if ($code($read()) !== 250) { return $bye('message rejected'); }
    $say('QUIT'); @fclose($fp);
    return ['ok' => true];
}

/** Append the full submission to a readable log so a lead is never lost. */
function contact_record(string $name, string $email, string $topic, string $message): void {
    $dir = BASE_DIR . '/storage';
    if (!is_dir($dir)) { @mkdir($dir, 0775, true); }
    $entry = '[' . date('Y-m-d H:i:s') . "] FROM: {$name} <{$email}> | TOPIC: {$topic}\n"
           . "MESSAGE: {$message}\n" . str_repeat('-', 60) . "\n";
    @file_put_contents($dir . '/contact-submissions.log', $entry, FILE_APPEND | LOCK_EX);
}

/**
 * Validate, RECORD (always), then deliver a contact-form submission.
 * Capture is guaranteed via storage/contact-submissions.log; email is best-effort:
 * authenticated SMTP when configured (reliable, e.g. iCloud), else PHP mail().
 * Returns ['ok' => bool, 'error' => string].
 */
function contact_submit(array $in): array {
    $to = env('CONTACT_TO', 'ramsmandal@icloud.com');

    // honeypot (we accept either field name)
    if (trim((string)($in['company'] ?? '')) !== '' || trim((string)($in['website'] ?? '')) !== '') {
        contact_log('honeypot triggered — dropped');
        return ['ok' => true];
    }

    $cut     = static function (string $s, int $n): string {
        return function_exists('mb_substr') ? mb_substr($s, 0, $n) : substr($s, 0, $n);
    };
    $oneLine = static fn(string $s): string => trim(preg_replace('/[\r\n]+/', ' ', $s) ?? '');
    $name    = $cut($oneLine((string)($in['name'] ?? '')), 120);
    $email   = $oneLine((string)($in['email'] ?? ''));
    $topic   = $cut($oneLine((string)($in['topic'] ?? '')), 120);
    $message = trim((string)($in['message'] ?? ''));

    $allowed = ['A role or opportunity', 'Consulting or design systems', 'A product audit or teardown', 'Something else'];
    if (!in_array($topic, $allowed, true)) { $topic = 'Something else'; }

    if ($name === '' || $message === '') {
        return ['ok' => false, 'error' => 'Please add your name and a message.'];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['ok' => false, 'error' => 'Please enter a valid email address.'];
    }
    $message = $cut($message, 6000);

    // 1) ALWAYS record the full submission — this is the reliability guarantee
    contact_record($name, $email, $topic, $message);

    $subject = '[ramsmandal.com] ' . $topic . ' — ' . $name;
    $bodyText =
        "New message from the ramsmandal.com contact form\n" .
        str_repeat('-', 50) . "\n\n" .
        "Name:  {$name}\n" .
        "Email: {$email}\n" .
        "Topic: {$topic}\n\n" .
        "Message:\n{$message}\n\n" .
        str_repeat('-', 50) . "\n" .
        'Sent: ' . date('Y-m-d H:i:s') . ' | IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n";
    $replyTo = 'Reply-To: "' . str_replace('"', '', $name) . '" <' . $email . '>';
    $domain  = preg_replace('/^www\./', '', (string)($_SERVER['SERVER_NAME'] ?? 'ramsmandal.com'));

    // 2) Deliver — authenticated SMTP first (reliable, works for iCloud), else mail()
    if (env('SMTP_HOST', '')) {
        $cfg = [
            'host'      => env('SMTP_HOST', ''),
            'port'      => env('SMTP_PORT', 587),
            'secure'    => env('SMTP_SECURE', 'tls'),
            'user'      => env('SMTP_USER', ''),
            'pass'      => env('SMTP_PASS', ''),
            'from'      => env('CONTACT_FROM', env('SMTP_USER', 'no-reply@' . $domain)),
            'from_name' => env('CONTACT_FROM_NAME', 'ramsmandal.com'),
        ];
        $res = smtp_send($cfg, $to, $subject, $bodyText, [$replyTo]);
        contact_log('SMTP ' . ($res['ok'] ? 'sent' : 'FAILED: ' . $res['error']) . " | to=$to reply=$email");
    } else {
        $from = env('CONTACT_FROM', 'no-reply@' . $domain);
        $headers = implode("\r\n", [
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'From: ramsmandal.com <' . $from . '>',
            $replyTo,
            'X-Mailer: PHP/' . PHP_VERSION,
        ]);
        $sent = function_exists('mail')
            ? @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $bodyText, $headers, '-f' . $from)
            : false;
        contact_log('mail() ' . ($sent ? 'returned true (delivery to iCloud NOT guaranteed — use SMTP or a Gmail recipient)' : 'failed/unavailable') . " | to=$to reply=$email");
    }

    // Submission is captured for certain (in the log) -> confirm to the visitor.
    return ['ok' => true];
}

/**
 * Breadcrumb trail for the current path, matched to this site's routes
 * (/, /work, /work/{slug}, /about, /contact). Returns [] on home.
 * Project titles are resolved from the projects registry.
 */
function build_breadcrumbs(string $path): array {
    $clean = '/' . trim(parse_url($path, PHP_URL_PATH) ?: '/', '/');
    if ($clean === '/') { return []; }

    $labels = ['work' => 'Work', 'about' => 'About', 'contact' => 'Contact'];
    $parts  = array_values(array_filter(explode('/', trim($clean, '/')), 'strlen'));
    $section = $parts[0] ?? '';
    $tc = static fn(string $s): string => ucwords(str_replace(['-', '_'], ' ', $s));

    $crumbs = [['label' => 'Home', 'url' => '/']];

    if (isset($labels[$section])) {
        $isDetail = isset($parts[1]) && $parts[1] !== '';
        $crumbs[] = ['label' => $labels[$section], 'url' => $isDetail ? '/' . $section : null];
        if ($isDetail) {
            $title = $tc($parts[1]);
            if ($section === 'work') {
                foreach ((content('projects') ?: []) as $p) {
                    if (($p['slug'] ?? '') === $parts[1]) { $title = (string) $p['title']; break; }
                }
            }
            $crumbs[] = ['label' => $title, 'url' => null];
        }
    } else {
        $crumbs[] = ['label' => $tc($section), 'url' => null];
    }

    $crumbs[count($crumbs) - 1]['url'] = null;   // current page is never a link
    return $crumbs;
}
