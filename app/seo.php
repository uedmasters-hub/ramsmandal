<?php
/* =========================================================================
   app/seo.php — the SEO engine.
   Absolute-URL helpers, JSON-LD builders, and the sitemap generator.
   Pure functions; no output here except the json_ld() string builder.
   ========================================================================= */

declare(strict_types=1);

/** Canonical site origin, e.g. https://ramsmandal.com (no trailing slash).
    Prefers APP_URL (env), then content/site.php meta.url, then the request. */
function seo_origin(): string {
    if (defined('APP_URL') && APP_URL !== '') return APP_URL;
    $site = content('site');
    if (!empty($site['meta']['url'])) return rtrim($site['meta']['url'], '/');
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https')
        || (($_SERVER['SERVER_PORT'] ?? '') == 443);
    $host = $_SERVER['HTTP_HOST'] ?? 'ramsmandal.com';
    return ($https ? 'https' : 'http') . '://' . $host;
}

/** Absolute URL for an internal path (adds origin + APP_BASE). */
function seo_url(string $path = '/'): string {
    return seo_origin() . (defined('APP_BASE') ? APP_BASE : '') . '/' . ltrim($path, '/');
}

/** Absolute URL for a /public asset. */
function seo_asset(string $path): string {
    return seo_origin() . asset($path);
}

/** The current request path, normalised the same way the router does. */
function seo_current_path(): string {
    $uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
    if (defined('APP_BASE') && APP_BASE !== '' && str_starts_with($uri, APP_BASE)) {
        $uri = substr($uri, strlen(APP_BASE));
    }
    $uri = '/' . trim($uri, '/');
    return $uri === '/' ? '/' : rtrim($uri, '/');
}

/** Canonical absolute URL for the current page. */
function seo_canonical(): string {
    $p = seo_current_path();
    return seo_origin() . (defined('APP_BASE') ? APP_BASE : '') . ($p === '/' ? '/' : $p);
}

/** Render one JSON-LD <script> block from an associative array. */
function json_ld(array $data): string {
    $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    return '<script type="application/ld+json">' . $json . '</script>';
}

/* ---- schema builders -------------------------------------------------- */

/** The Person graph node — Ramesh. Reused as author across the site. */
function schema_person(array $site): array {
    $sameAs = [];
    foreach (($site['social'] ?? []) as $s) {
        if (!empty($s['url']) && $s['url'] !== '#') $sameAs[] = $s['url'];
    }
    $worksFor = [];
    $profile = content('profile');
    foreach (($profile['experience'] ?? []) as $job) {
        if (!empty($job['company'])) $worksFor[] = ['@type' => 'Organization', 'name' => $job['company']];
    }
    $node = [
        '@type'       => 'Person',
        '@id'         => seo_origin() . '/#person',
        'name'        => $site['name'] ?? 'Ramesh Mandal',
        'jobTitle'    => $site['role'] ?? 'Experience Architect',
        'description' => $site['meta']['default_desc'] ?? '',
        'url'         => seo_url('/'),
        'image'       => seo_asset('og/og-default.jpg'),
        'email'       => 'mailto:' . ($site['contact']['email'] ?? ''),
        'knowsAbout'  => [
            'Product Design', 'Enterprise UX', 'Design Systems', 'Product Strategy',
            'Design Engineering', 'Design Leadership', 'User Experience',
        ],
    ];
    if ($sameAs)   $node['sameAs']   = array_values(array_unique($sameAs));
    if ($worksFor) $node['worksFor'] = $worksFor[0];   // current employer
    return $node;
}

/** The WebSite graph node. */
function schema_website(array $site): array {
    return [
        '@type'     => 'WebSite',
        '@id'       => seo_origin() . '/#website',
        'url'       => seo_url('/'),
        'name'      => $site['meta']['default_title'] ?? ($site['name'] ?? 'Ramesh Mandal'),
        'description' => $site['meta']['default_desc'] ?? '',
        'inLanguage' => 'en',
        'publisher' => ['@id' => seo_origin() . '/#person'],
    ];
}

/** A breadcrumb trail. $items = [[name, url], ...] (url absolute). */
function schema_breadcrumb(array $items): array {
    $list = [];
    foreach ($items as $i => [$name, $url]) {
        $list[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $name, 'item' => $url];
    }
    return ['@type' => 'BreadcrumbList', 'itemListElement' => $list];
}

/** A project as a CreativeWork. */
function schema_creativework(array $project, array $site): array {
    return [
        '@type'         => 'CreativeWork',
        'name'          => $project['title'] ?? '',
        'headline'      => $project['title'] ?? '',
        'description'   => $project['tagline'] ?? '',
        'url'           => seo_url('/work/' . ($project['slug'] ?? '')),
        'about'         => $project['category'] ?? '',
        'creator'       => ['@id' => seo_origin() . '/#person'],
        'author'        => ['@id' => seo_origin() . '/#person'],
        'datePublished' => preg_replace('/\D.*$/', '', (string)($project['year'] ?? '')) ?: null,
        'publisher'     => ['@id' => seo_origin() . '/#person'],
    ];
}

/* ---- sitemap ---------------------------------------------------------- */

/** Build a sitemap.xml string from the site + project registry. */
function sitemap_xml(array $site, array $projects): string {
    $today = date('Y-m-d');
    $urls = [
        ['/',        '1.0', 'weekly'],
        ['/work',    '0.9', 'weekly'],
        ['/about',   '0.7', 'monthly'],
        ['/contact', '0.6', 'yearly'],
    ];
    foreach ($projects as $p) {
        if (!empty($p['slug'])) $urls[] = ['/work/' . $p['slug'], '0.8', 'monthly'];
    }

    $out  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as [$path, $priority, $freq]) {
        $loc = htmlspecialchars(seo_url($path), ENT_XML1);
        $out .= "  <url>\n";
        $out .= "    <loc>{$loc}</loc>\n";
        $out .= "    <lastmod>{$today}</lastmod>\n";
        $out .= "    <changefreq>{$freq}</changefreq>\n";
        $out .= "    <priority>{$priority}</priority>\n";
        $out .= "  </url>\n";
    }
    $out .= '</urlset>' . "\n";
    return $out;
}
