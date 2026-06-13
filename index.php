<?php
/* =========================================================================
   index.php — Front controller
   Every request (that is not a real static file) lands here via .htaccess.
   ========================================================================= */

declare(strict_types=1);

require __DIR__ . '/app/bootstrap.php';

$router = require __DIR__ . '/app/router.php';
$router(); // dispatch the current request
