<?php
/* =========================================================================
   app/routes.php — the whole map. Four surfaces, nothing more.
   Format: [METHOD, '/path', handler(array $params)]
   ========================================================================= */

declare(strict_types=1);

return [

    ['GET', '/', function () {
        $projects = content('projects');
        view('home', ['projects' => $projects, 'currentKey' => 'home']);
    }],

    ['GET', '/work', function () {
        $projects = content('projects');
        view('work', ['projects' => $projects, 'currentKey' => 'work']);
    }],

    ['GET', '/work/{slug}', function (array $p) {
        $slug     = $p[0];
        $projects = content('projects');
        $project  = null;
        foreach ($projects as $row) {
            if ($row['slug'] === $slug) { $project = $row; break; }
        }
        if (!$project) { not_found(); return; }

        // optional long-form body lives in content/projects/{slug}.php
        $bodyFile = CONTENT_DIR . '/projects/' . $slug . '.php';
        $body     = is_file($bodyFile) ? $bodyFile : null;

        view('project', ['project' => $project, 'body' => $body, 'currentKey' => 'work']);
    }],

    ['GET', '/about', function () {
        $profile = content('profile');
        view('about', ['profile' => $profile, 'currentKey' => 'about']);
    }],

    ['GET', '/contact', function () {
        view('contact', ['currentKey' => 'contact', 'sent' => false]);
    }],

    ['POST', '/contact', function () {
        $res = contact_submit($_POST);
        if (wants_json()) {
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode($res);
            exit;
        }
        view('contact', [
            'currentKey' => 'contact',
            'sent'       => $res['ok'],
            'error'      => $res['ok'] ? null : ($res['error'] ?? ''),
        ]);
    }],

    ['GET', '/sitemap.xml', function () {
        header('Content-Type: application/xml; charset=UTF-8');
        echo sitemap_xml(content('site'), content('projects'));
        exit;
    }],
];
