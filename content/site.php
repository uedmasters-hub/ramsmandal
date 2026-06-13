<?php
/* =========================================================================
   content/site.php — site-wide config: nav, identity, contact, meta.
   ========================================================================= */

declare(strict_types=1);

return [
    'name'    => 'Ramesh Mandal',
    'role'    => 'Experience Architect',
    'tagline' => 'I transform complexity into clarity.',

    'nav' => [
        ['key' => 'home',    'label' => 'Home',    'path' => '/'],
        ['key' => 'work',    'label' => 'Work',    'path' => '/work'],
        ['key' => 'about',   'label' => 'About',   'path' => '/about'],
        ['key' => 'contact', 'label' => 'Contact', 'path' => '/contact'],
    ],

    'contact' => [
        'email' => 'ramsmandal@icloud.com',
        'phone' => '+91 9538000060',
    ],

    'social' => [
        ['label' => 'LinkedIn', 'url' => '#'],   // drop in the real URL
    ],

    'meta' => [
        'default_title' => 'Ramesh Mandal — Experience Architect',
        'default_desc'  => 'Experience Architect with 17 years across aviation, SaaS, and enterprise platforms. I transform complexity into clarity.',
        'og_image'      => '/public/og/og-default.jpg',
    ],
];
