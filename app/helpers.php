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

/**
 * Validate + send a contact-form submission by email.
 * Returns ['ok' => bool, 'error' => string].  No DB; mail() only.
 */
function contact_submit(array $in): array {
    $to   = env('CONTACT_TO', 'ramsmandal@icloud.com');

    // honeypot: bots fill the hidden "company" field — silently accept and drop
    if (trim((string)($in['company'] ?? '')) !== '') {
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

    $subject = '[ramsmandal.com] ' . $topic . ' — ' . $name;
    $body =
        "New message from the ramsmandal.com contact form\n\n" .
        "Name:  {$name}\n" .
        "Email: {$email}\n" .
        "Topic: {$topic}\n\n" .
        "Message:\n{$message}\n";

    // From must be on the site's own domain for deliverability; visitor is the Reply-To
    $domain = preg_replace('/^www\./', '', (string)($_SERVER['SERVER_NAME'] ?? 'ramsmandal.com'));
    $from   = env('CONTACT_FROM', 'no-reply@' . $domain);
    $headers = implode("\r\n", [
        'From: Ramesh Mandal Website <' . $from . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'X-Mailer: PHP/' . phpversion(),
    ]);
    $encSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

    $ok = @mail($to, $encSubject, $body, $headers, '-f' . $from);
    if (!$ok) {
        return ['ok' => false, 'error' => 'Sorry, the message could not be sent right now. Please email me directly.'];
    }
    return ['ok' => true];
}
