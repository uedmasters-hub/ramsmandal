<?php
/* =========================================================================
   app/router.php — tiny matcher. Returns a dispatch closure.
   Static routes + one dynamic pattern (/work/{slug}). Method-aware.
   ========================================================================= */

declare(strict_types=1);

return function (): void {
    $routes = require __DIR__ . '/routes.php';

    // current path, with APP_BASE and query string stripped
    $uri  = rawurldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
    if (APP_BASE !== '' && str_starts_with($uri, APP_BASE)) {
        $uri = substr($uri, strlen(APP_BASE));
    }
    $uri    = '/' . trim($uri, '/');
    $uri    = $uri === '/' ? '/' : rtrim($uri, '/');
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    foreach ($routes as $route) {
        [$rMethod, $pattern, $handler] = $route;
        if ($rMethod !== $method) continue;

        // exact static match
        if ($pattern === $uri) {
            $handler([]);
            return;
        }

        // dynamic {slug} match, e.g. /work/{slug}
        if (str_contains($pattern, '{')) {
            $regex = '#^' . preg_replace('#\{[a-z_]+\}#', '([a-z0-9\-]+)', $pattern) . '$#i';
            if (preg_match($regex, $uri, $m)) {
                array_shift($m);
                $handler($m);
                return;
            }
        }
    }

    not_found();
};
