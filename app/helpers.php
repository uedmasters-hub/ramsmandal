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
