<?php
/**
 * includes/breadcrumbs.php
 * Builds the breadcrumb trail for the current route from the v2 URL structure.
 * Pure function — no I/O, no globals — so it is trivial to unit-test.
 *
 * Returns an ordered array of crumbs: [['label' => string, 'url' => ?string], ...]
 * The final crumb always has url === null (it is the current page).
 *
 * @param string     $path  Request path, e.g. "/build/indigo-booking". REQUEST_URI is fine; query is stripped.
 * @param array|null $node  The loaded node for detail routes (uses $node['title'] when present).
 */
declare(strict_types=1);

function build_breadcrumbs(string $path, ?array $node = null): array
{
    // Section slug → human label. Edit here to match your nav copy.
    $sections = [
        'build'    => 'Case Studies',
        'write'    => 'Writing',
        'think'    => 'Thinking',
        'observe'  => 'Audits',
        'services' => 'Services',
        'about'    => 'About',
        'contact'  => 'Contact',
    ];

    $clean = parse_url($path, PHP_URL_PATH) ?: '/';
    $clean = '/' . trim($clean, '/');

    // No breadcrumbs on the home page.
    if ($clean === '/') {
        return [];
    }

    $parts   = array_values(array_filter(explode('/', trim($clean, '/')), 'strlen'));
    $section = $parts[0] ?? '';

    $crumbs = [['label' => 'Home', 'url' => '/']];

    $titleCase = static fn(string $s): string => ucwords(str_replace(['-', '_'], ' ', $s));

    if (isset($sections[$section])) {
        $isDetail = isset($parts[1]) && $parts[1] !== '';
        $crumbs[] = ['label' => $sections[$section], 'url' => $isDetail ? '/' . $section : null];

        if ($isDetail) {
            $title = isset($node['title']) && $node['title'] !== '' ? (string) $node['title'] : $titleCase($parts[1]);
            $crumbs[] = ['label' => $title, 'url' => null];
        }
    } else {
        // Unknown top-level route: best-effort single crumb.
        $crumbs[] = ['label' => $titleCase($section), 'url' => null];
    }

    // Guarantee the last crumb is never a link.
    $crumbs[count($crumbs) - 1]['url'] = null;

    return $crumbs;
}
