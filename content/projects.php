<?php
/* =========================================================================
   content/projects.php — the work registry (single source of truth).
   Five case studies + two teardowns (folded in from the old audits).
   Long-form body for a project is optional and lives in
   content/projects/{slug}.php. DB migration later reads this same shape.
   ========================================================================= */

declare(strict_types=1);

return [
    [
        'slug'     => 'indigo-booking',
        'type'     => 'case-study',
        'title'    => 'IndiGo Booking Ecosystem',
        'company'  => 'IndiGo Airlines',
        'category' => 'Airline commerce',
        'year'     => '2022–2024',
        'tagline'  => 'Redesigning a 50M-user booking flow for conversion, clarity, and scale.',
        'metric'   => ['value' => '+22%', 'label' => 'Ancillary revenue'],
        'tone'     => 0,
        'featured' => true,
    ],
    [
        'slug'     => 'crewpal',
        'type'     => 'case-study',
        'title'    => 'CrewPal Operations Platform',
        'company'  => 'IndiGo Airlines',
        'category' => 'Enterprise app',
        'year'     => '2022–2023',
        'tagline'  => 'Simplifying high-stakes operations for 8,000+ IndiGo cabin crew.',
        'metric'   => ['value' => '+25%', 'label' => 'Crew satisfaction'],
        'tone'     => 1,
        'featured' => true,
    ],
    [
        'slug'     => 'indigo-holidays',
        'type'     => 'case-study',
        'title'    => 'IndiGo Holidays Marketplace',
        'company'  => 'IndiGo Airlines',
        'category' => 'Marketplace',
        'year'     => '2023',
        'tagline'  => 'Personalised hotel bundles driving ancillary revenue growth.',
        'metric'   => ['value' => '+22%', 'label' => 'Revenue growth'],
        'tone'     => 2,
        'featured' => true,
    ],
    [
        'slug'     => 'design-system',
        'type'     => 'case-study',
        'title'    => 'Enterprise Design System',
        'company'  => 'IndiGo Airlines',
        'category' => 'Design infrastructure',
        'year'     => '2021–2024',
        'tagline'  => 'One system powering 10+ products and a 15-person design team.',
        'metric'   => ['value' => '+40%', 'label' => 'Faster delivery'],
        'tone'     => 3,
        'featured' => true,
    ],
    [
        'slug'     => 'quikr-marketplace',
        'type'     => 'case-study',
        'title'    => 'Quikr Marketplace Redesign',
        'company'  => 'Quikr India',
        'category' => 'Marketplace',
        'year'     => '2015–2018',
        'tagline'  => "Scaling UX for 30M users during India's classifieds growth.",
        'metric'   => ['value' => '30M+', 'label' => 'Monthly users'],
        'tone'     => 4,
        'featured' => true,
    ],

    /* ---- teardowns (folded in from the old audits) ---- */
    [
        'slug'     => 'zomato-checkout',
        'type'     => 'teardown',
        'title'    => 'Zomato Checkout',
        'company'  => 'Teardown',
        'category' => 'Product teardown',
        'year'     => '2024',
        'tagline'  => 'Where a high-intent checkout leaks conversion, and how to close it.',
        'metric'   => null,
        'tone'     => 1,
        'featured' => false,
    ],
    [
        'slug'     => 'swiggy-onboarding',
        'type'     => 'teardown',
        'title'    => 'Swiggy Onboarding',
        'company'  => 'Teardown',
        'category' => 'Product teardown',
        'year'     => '2024',
        'tagline'  => 'First-run friction on a delivery app, framed as fixable decisions.',
        'metric'   => null,
        'tone'     => 3,
        'featured' => false,
    ],
];
