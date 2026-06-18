<?php
/* =========================================================================
   content/home.php — ALL home-page narrative content, in one place.
   The home view and its partials read from here; the work list reads from
   content/projects.php (the work registry). Nothing on the home page is
   hardcoded in markup. Convention: *_html fields carry intentional inline
   markup and are echoed raw; every other field is escaped with e().
   ========================================================================= */

declare(strict_types=1);

return [

    /* ---- dot-field hero: device-evolution stages ---- */
    'hero' => [
        'eyebrow' => 'Experience Architect',
        'stages'  => [
            [
                'eyebrow'      => 'Experience Architect',
                'heading_tag'  => 'h1',
                'heading_html' => 'I transform complexity into <span class="kw-accent">clarity</span>.',
            ],
            [
                'heading_tag'  => 'h2',
                'heading_html' => 'From a single screen to a <span class="kw-accent">working system</span>.',
                'sub'          => 'Seventeen years across aviation, SaaS, and enterprise platforms, shaping products used by millions.',
            ],
            [
                'heading_tag'  => 'h2',
                'heading_html' => 'A designer makes <span class="kw-accent">screens</span>.',
                'previews'     => true,   // rendered from featured projects
            ],
            [
                'heading_tag'  => 'h2',
                'heading_html' => 'An experience architect makes <span class="kw-accent">ecosystems</span>.',
                'regions'      => [
                    ['title' => 'Work',       'sub' => 'Products at scale'],
                    ['title' => 'Systems',    'sub' => 'Design infrastructure'],
                    ['title' => 'Thinking',   'sub' => 'Decisions, tradeoffs'],
                    ['title' => 'Leadership', 'sub' => 'Teams of 15+'],
                    ['title' => 'Impact',     'sub' => 'Measured outcomes'],
                    ['title' => 'Strategy',   'sub' => 'Complexity to clarity'],
                ],
            ],
        ],
    ],

    /* ---- preloader narrative beneath the RM the dots form ---- */
    'preloader' => ['from' => 'Complexity', 'to' => 'Clarity'],

    /* ---- big-cards discipline rail (first card carries the accent) ---- */
    'disciplines' => [
        ['title' => 'Product & platform design', 'desc' => 'Customer-facing and enterprise products shaped from the first flow to the shipped system.'],
        ['title' => 'Enterprise UX',             'desc' => 'Complex internal tools and operations platforms made usable for the people who run the business.'],
        ['title' => 'Design systems',            'desc' => 'Reusable component systems and standards that keep teams fast and consistent at scale.'],
        ['title' => 'Product strategy',          'desc' => 'Roadmaps grounded in user needs, business goals, and what engineering can realistically ship.'],
        ['title' => 'Design engineering',        'desc' => 'Designs that survive contact with code, prototyped and built, not just drawn.'],
        ['title' => 'Design leadership',         'desc' => 'Teams of fifteen-plus designers and researchers aligned around outcomes that matter.'],
    ],

    /* ---- positioning ---- */
    'intro' => [
        'lead'        => "I don't design screens. I design the experiences, systems, and outcomes behind products that operate at scale, and the judgment that holds them together under real constraint.",
        'disciplines' => ['Product design', 'Enterprise UX', 'Design systems', 'Product strategy', 'Design engineering', 'Leadership'],
    ],

    /* ---- client logo marquee (looped 3x for a seamless track) ---- */
    'logos' => [
        ['src' => '/public/img/logos/indigo.svg',       'alt' => 'IndiGo'],
        ['src' => '/public/img/logos/quikr.svg',        'alt' => 'Quikr'],
        ['src' => '/public/img/logos/intelegencia.svg', 'alt' => 'Intelegencia'],
        ['src' => '/public/img/logos/client4.svg',      'alt' => ''],
        ['src' => '/public/img/logos/client5.svg',      'alt' => ''],
        ['src' => '/public/img/logos/client6.svg',      'alt' => ''],
    ],

    /* ---- selected work: header copy (the LIST comes from projects.php) ---- */
    'work' => [
        'label' => '● Selected Work',
        'title' => 'Products, platforms and systems designed for scale.',
        'copy'  => 'Seventeen years designing products, platforms and ecosystems across aviation, enterprise and marketplace businesses.',
    ],

    /* ---- perspectives ---- */
    'perspectives' => [
        'label' => '● Selected Perspectives',
        'title' => 'What people remember after working together.',
        'copy'  => 'Across aviation, enterprise and marketplace products, the common thread has been bringing clarity to complex systems and helping teams move forward.',
        'cards' => [
            ['quote' => 'Ramesh consistently transformed ambiguity into structured product decisions and aligned multiple teams around a shared direction.', 'role' => 'Director Product',   'org' => 'IndiGo Airlines'],
            ['quote' => 'His strength is not screens. It is understanding systems, operations and the people behind them.',                                  'role' => 'Head of UX',         'org' => 'Enterprise Platform'],
            ['quote' => 'The work balanced business goals, user needs and engineering realities without compromising quality.',                            'role' => 'Engineering Leader', 'org' => 'Marketplace Product'],
        ],
    ],

    /* ---- philosophy banner ---- */
    'philosophy' => [
        'label'   => '● Philosophy',
        'heading' => 'The principles behind every product I design.',
        'copy'    => '17 years designing products, platforms and ecosystems has taught me that clarity is rarely the starting point.',
    ],

    /* ---- scale closer ---- */
    'scale' => [
        'line' => 'Seventeen years. Aviation, SaaS, and enterprise. Products used by millions.',
        'orgs' => ['IndiGo', 'Intelegencia', 'Quikr'],
    ],

    'disciplines' => [
        ['title' => 'Product & platform design', 'desc' => '...', 'image' => 'product.webp',         'image_alt' => 'Product design work'],
        ['title' => 'Enterprise UX',             'desc' => '...', 'image' => 'enterprise.webp',      'image_alt' => 'Enterprise UX work'],
        ['title' => 'Design systems',            'desc' => '...', 'image' => 'design-systems.webp',  'image_alt' => 'Design system work'],
        // ...the rest
    ]
