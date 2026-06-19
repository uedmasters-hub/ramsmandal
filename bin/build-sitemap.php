<?php
/* bin/build-sitemap.php — writes a physical sitemap.xml at the project root.
   Run: php bin/build-sitemap.php   (e.g. after adding a project, on deploy).
   Works without .htaccess/mod_rewrite, since the file is served directly. */
declare(strict_types=1);
require __DIR__ . '/../app/bootstrap.php';
$xml = sitemap_xml(content('site'), content('projects'));
file_put_contents(BASE_DIR . '/sitemap.xml', $xml);
echo "Wrote sitemap.xml (" . substr_count($xml, '<loc>') . " urls)\n";
