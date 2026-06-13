<?php
/* =========================================
   CONFIG.PHP
   =========================================
   ONE line to change between environments.

   Live (6epixels.com root):
     define("ENV", "production");

   Local dev:
     define("ENV", "development");
   ========================================= */

// ── ENVIRONMENT ────────────────────────────
define("ENV", "production");  // ← "development" for local

// ── ERROR HANDLING ─────────────────────────
if (ENV === "development") {
  ini_set("display_errors", 1);
  ini_set("display_startup_errors", 1);
  error_reporting(E_ALL);
} else {
  ini_set("display_errors", 0);
  error_reporting(0);
  // Log errors to file instead
  ini_set("log_errors", 1);
  ini_set("error_log", __DIR__ . "/../storage/php-errors.log");
}

// ── DERIVED (don't touch) ──────────────────
define("BASE_PATH",  "");
define("SITE_ROOT",  dirname(__DIR__));
define("ASSET_PATH", BASE_PATH . "/assets");