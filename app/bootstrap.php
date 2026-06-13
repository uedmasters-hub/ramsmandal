<?php
/* =========================================================================
   app/bootstrap.php — runs before everything
   Loads .env, sets error reporting, exposes path constants + helpers.
   No framework. One Composer dependency (vlucas/phpdotenv) when present.
   ========================================================================= */

declare(strict_types=1);

define('BASE_DIR', dirname(__DIR__));            // filesystem root of the project
define('VIEW_DIR', BASE_DIR . '/views');
define('CONTENT_DIR', BASE_DIR . '/content');

/* ---- .env loader (works with or without Composer) ---- */
$autoload = BASE_DIR . '/vendor/autoload.php';
if (is_file($autoload)) {
    require $autoload;
    if (class_exists(\Dotenv\Dotenv::class) && is_file(BASE_DIR . '/.env')) {
        \Dotenv\Dotenv::createImmutable(BASE_DIR)->safeLoad();
    }
} elseif (is_file(BASE_DIR . '/.env')) {
    // minimal fallback parser if Composer is not installed yet
    foreach (file(BASE_DIR . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if ($line[0] === '#' || !str_contains($line, '=')) continue;
        [$k, $v] = array_map('trim', explode('=', $line, 2));
        $_ENV[$k] = trim($v, "\"'");
    }
}

require __DIR__ . '/helpers.php';

/* ---- environment ---- */
define('APP_ENV',  env('APP_ENV', 'production'));
define('APP_BASE', rtrim(env('APP_BASE', ''), '/'));   // e.g. "/ramsmandal-v2" on XAMPP, "" at root
define('APP_URL',  rtrim(env('APP_URL', ''), '/'));

if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}
