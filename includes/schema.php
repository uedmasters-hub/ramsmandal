<?php
/* =========================================
   INCLUDES / SCHEMA.PHP
   JSON-LD Structured Data for SEO

   Usage — call the right function inside <head>
   on each page type, AFTER setting page variables.

   HOMEPAGE:
     <?php echo schema_person(); ?>

   BLOG POST:
     <?php echo schema_article($post); ?>

   CASE STUDY:
     <?php echo schema_case_study($study); ?>

   UX AUDIT:
     <?php echo schema_audit($audit); ?>

   PSYCHOLOGY:
     <?php echo schema_article_generic([
       'title'   => $principle['name'],
       'desc'    => $principle['definition'],
       'url'     => 'https://6epixels.com/psychology/' . $principle['id'] . '.php',
       'image'   => 'https://6epixels.com/assets/og/og-default.jpg',
       'date'    => '2024-01-01',
       'tags'    => [$principle['category'], 'UX Psychology', 'Design'],
     ]); ?>

   ABOUT:
     <?php echo schema_person(); ?>
     <?php echo schema_breadcrumb([['Home','https://6epixels.com/'],['About','https://6epixels.com/about.php']]); ?>

   ========================================= */

/* ── SITE-WIDE CONSTANTS ──────────────────── */

define("SCHEMA_BASE_URL",    "https://6epixels.com");
define("SCHEMA_AUTHOR_NAME", "Ramesh Mandal");
define("SCHEMA_AUTHOR_URL",  "https://6epixels.com/about.php");
define("SCHEMA_LOGO_URL",    "https://6epixels.com/assets/icons/favicon-180x180.png");
define("SCHEMA_OG_DEFAULT",  "https://6epixels.com/assets/og/og-default.jpg");
define("SCHEMA_TWITTER",     "https://twitter.com/ramsmandal");
define("SCHEMA_LINKEDIN",    "https://www.linkedin.com/in/ramsmandal");

/* ─────────────────────────────────────────────────
   HELPER — output a JSON-LD <script> block
───────────────────────────────────────────────── */
function _schema_tag(array $data): string {
    return '<script type="application/ld+json">'
        . json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        . '</script>' . "\n";
}

/* ─────────────────────────────────────────────────
   1. PERSON — homepage + about page
   Tells Google who you are.
   Enables Knowledge Panel, rich author cards.
───────────────────────────────────────────────── */
function schema_person(): string {
    return _schema_tag([
        "@context"        => "https://schema.org",
        "@type"           => "Person",
        "name"            => SCHEMA_AUTHOR_NAME,
        "url"             => SCHEMA_BASE_URL,
        "image"           => SCHEMA_OG_DEFAULT,
        "jobTitle"        => "Senior UX Leader & Product Strategist",
        "description"     => "UX Design Agency in Gurgaon led by Ramesh Mandal. 17+ years driving AI-enabled product strategy at scale across aviation, SaaS, and enterprise platforms.",
        "sameAs"          => [
            SCHEMA_TWITTER,
            SCHEMA_LINKEDIN,
        ],
        "address"         => [
            "@type"            => "PostalAddress",
            "addressLocality"  => "Gurgaon",
            "addressRegion"    => "Haryana",
            "addressCountry"   => "IN",
        ],
        "areaServed"      => [
            ["@type" => "City",    "name" => "Gurgaon"],
            ["@type" => "City",    "name" => "Delhi NCR"],
            ["@type" => "Country", "name" => "India"],
        ],
        "knowsAbout"      => [
            "UX Strategy", "Design Systems", "Product Design",
            "AI-Enabled Workflows", "Conversion Rate Optimisation",
            "Enterprise UX", "Information Architecture",
            "User Research", "Design Leadership",
        ],
        "alumniOf"        => [
            [
                "@type" => "EducationalOrganization",
                "name"  => "Chaudhary Charan Singh University",
            ],
        ],
        "worksFor"        => [
            "@type" => "Organization",
            "name"  => "Intelegencia",
            "url"   => "https://www.intelegencia.com",
        ],
    ]);
}

/* ─────────────────────────────────────────────────
   1b. LOCAL BUSINESS — homepage only
   Strongest local SEO signal. Tells Google this is
   a UX design practice based in Gurgaon.
   Call alongside schema_person() on homepage.
───────────────────────────────────────────────── */
function schema_local_business(): string {
    return _schema_tag([
        "@context"        => "https://schema.org",
        "@type"           => ["ProfessionalService", "LocalBusiness"],
        "name"            => "Ramesh Mandal — UX Design",
        "description"     => "UX Design Agency in Gurgaon specialising in enterprise UX strategy, design systems, AI-enabled workflows, and product design for 50M+ user platforms.",
        "url"             => SCHEMA_BASE_URL,
        "logo"            => SCHEMA_LOGO_URL,
        "image"           => SCHEMA_OG_DEFAULT,
        "founder"         => [
            "@type" => "Person",
            "name"  => SCHEMA_AUTHOR_NAME,
            "url"   => SCHEMA_AUTHOR_URL,
        ],
        "address"         => [
            "@type"           => "PostalAddress",
            "streetAddress"   => "Gurgaon",
            "addressLocality" => "Gurgaon",
            "addressRegion"   => "Haryana",
            "postalCode"      => "122001",
            "addressCountry"  => "IN",
        ],
        "geo"             => [
            "@type"     => "GeoCoordinates",
            "latitude"  => "28.4595",
            "longitude" => "77.0266",
        ],
        "areaServed"      => [
            ["@type" => "City",    "name" => "Gurgaon"],
            ["@type" => "City",    "name" => "Delhi"],
            ["@type" => "City",    "name" => "Noida"],
            ["@type" => "Country", "name" => "India"],
        ],
        "serviceType"     => [
            "UX Strategy", "UX Design", "Product Design",
            "Design Systems", "AI UX Workflows",
            "Enterprise UX", "UX Audit", "UX Consulting",
        ],
        "priceRange"      => "₹₹₹",
        "telephone"       => "+91-9538000060",
        "email"           => "6epixels@gmail.com",
        "sameAs"          => [SCHEMA_TWITTER, SCHEMA_LINKEDIN],
        "openingHours"    => "Mo-Fr 09:00-18:00",
        "currenciesAccepted" => "INR, USD",
        "paymentAccepted" => "Bank Transfer, Invoice",
    ]);
}

/* ─────────────────────────────────────────────────
   2. WEBSITE — homepage only
   Enables sitelinks search box in Google results.
───────────────────────────────────────────────── */
function schema_website(): string {
    return _schema_tag([
        "@context"        => "https://schema.org",
        "@type"           => "WebSite",
        "name"            => SCHEMA_AUTHOR_NAME,
        "url"             => SCHEMA_BASE_URL,
        "description"     => "UX leadership portfolio, case studies, audits, and design thinking by Ramesh Mandal.",
        "author"          => [
            "@type" => "Person",
            "name"  => SCHEMA_AUTHOR_NAME,
            "url"   => SCHEMA_BASE_URL,
        ],
        "inLanguage"      => "en-IN",
    ]);
}

/* ─────────────────────────────────────────────────
   3. ARTICLE — blog posts
   Enables rich results: headline, image, author,
   date in search snippets.

   @param array $post — from $posts[] in data/blog.php
───────────────────────────────────────────────── */
function schema_article(array $post): string {

    /* Convert "March 2024" → ISO 8601 "2024-03-01" */
    $dateIso = _parse_date($post['date'] ?? '');
    $url     = SCHEMA_BASE_URL . '/blog/post.php?slug=' . urlencode($post['slug']);
    $image   = $post['image'] ?? SCHEMA_OG_DEFAULT;

    /* Word count → reading time in seconds */
    $words   = array_sum(array_map('str_word_count', $post['body'] ?? ['']));
    $seconds = max(120, intval($words / 200) * 60);

    return _schema_tag([
        "@context"         => "https://schema.org",
        "@type"            => "Article",
        "headline"         => $post['title'] ?? '',
        "description"      => $post['excerpt'] ?? ($post['subtitle'] ?? ''),
        "image"            => [$image],
        "datePublished"    => $dateIso,
        "dateModified"     => $dateIso,
        "author"           => [
            "@type" => "Person",
            "name"  => SCHEMA_AUTHOR_NAME,
            "url"   => SCHEMA_AUTHOR_URL,
        ],
        "publisher"        => _publisher(),
        "url"              => $url,
        "mainEntityOfPage" => ["@type" => "WebPage", "@id" => $url],
        "keywords"         => implode(', ', _blog_keywords($post['category'] ?? '')),
        "articleSection"   => $post['tag'] ?? 'UX Design',
        "timeRequired"     => 'PT' . ceil($seconds / 60) . 'M',
        "inLanguage"       => "en-IN",
        "about"            => [
            "@type" => "Thing",
            "name"  => "User Experience Design",
        ],
    ]);
}

/* ─────────────────────────────────────────────────
   4. CASE STUDY — treated as Article + CreativeWork
   Helps Google understand portfolio work.

   @param array $study — from $caseStudies[] in data/case-studies.php
   @param string $fullUrl — full canonical URL of the study page
───────────────────────────────────────────────── */
function schema_case_study(array $study, string $fullUrl = ''): string {

    if (!$fullUrl) {
        $fullUrl = SCHEMA_BASE_URL . '/case-study/' . urlencode($study['slug']) . '.php';
    }

    $keywords   = array_merge(
        $study['tags'] ?? [],
        ['UX Case Study', 'Product Design', 'User Experience', $study['company'] ?? '']
    );

    $output  = _schema_tag([
        "@context"         => "https://schema.org",
        "@type"            => "Article",
        "headline"         => $study['title'] ?? '',
        "description"      => $study['tagline'] ?? '',
        "image"            => [$study['image'] ?? SCHEMA_OG_DEFAULT],
        "datePublished"    => _year_to_iso($study['year'] ?? ''),
        "dateModified"     => date('Y-m-d'),
        "author"           => [
            "@type" => "Person",
            "name"  => SCHEMA_AUTHOR_NAME,
            "url"   => SCHEMA_AUTHOR_URL,
        ],
        "publisher"        => _publisher(),
        "url"              => $fullUrl,
        "mainEntityOfPage" => ["@type" => "WebPage", "@id" => $fullUrl],
        "keywords"         => implode(', ', $keywords),
        "articleSection"   => "UX Case Study",
        "about"            => [
            "@type" => "Thing",
            "name"  => $study['company'] ?? 'Product Design',
        ],
        "inLanguage"       => "en-IN",
    ]);

    /* BreadcrumbList */
    $output .= schema_breadcrumb([
        ['Home',         SCHEMA_BASE_URL . '/'],
        ['Case Studies', SCHEMA_BASE_URL . '/case-study/'],
        [$study['title'] ?? 'Case Study', $fullUrl],
    ]);

    return $output;
}

/* ─────────────────────────────────────────────────
   5. UX AUDIT — treated as Article + Review
   Helps Google understand analytical / review content.

   @param array $audit — from $audits[] in data/audits.php
   @param int   $score — $overallScore from the audit PHP file
───────────────────────────────────────────────── */
function schema_audit(array $audit, int $score = 0): string {

    $fullUrl  = SCHEMA_BASE_URL . '/audit/' . urlencode($audit['slug']) . '.php';
    $useScore = $score ?: ($audit['score'] ?? 0);

    $keywords = array_merge(
        $audit['tags'] ?? [],
        ['UX Audit', 'Heuristic Analysis', 'UX Review', $audit['product'] ?? '']
    );

    $output = _schema_tag([
        "@context"         => "https://schema.org",
        "@type"            => "Article",
        "headline"         => ($audit['title'] ?? '') . ' — UX Audit',
        "description"      => $audit['summary'] ?? $audit['tagline'] ?? '',
        "image"            => [$audit['image'] ?? SCHEMA_OG_DEFAULT],
        "datePublished"    => ($audit['year'] ?? date('Y')) . '-01-01',
        "dateModified"     => date('Y-m-d'),
        "author"           => [
            "@type" => "Person",
            "name"  => SCHEMA_AUTHOR_NAME,
            "url"   => SCHEMA_AUTHOR_URL,
        ],
        "publisher"        => _publisher(),
        "url"              => $fullUrl,
        "mainEntityOfPage" => ["@type" => "WebPage", "@id" => $fullUrl],
        "keywords"         => implode(', ', $keywords),
        "articleSection"   => "UX Audit",
        "inLanguage"       => "en-IN",
        "about"            => [
            "@type" => "SoftwareApplication",
            "name"  => $audit['product'] ?? '',
            "applicationCategory" => $audit['category'] ?? '',
        ],
    ]);

    /* Review schema — enables star ratings if score present */
    if ($useScore > 0) {
        $output .= _schema_tag([
            "@context"   => "https://schema.org",
            "@type"      => "Review",
            "name"       => 'UX Review: ' . ($audit['title'] ?? ''),
            "reviewBody" => $audit['summary'] ?? '',
            "author"     => [
                "@type" => "Person",
                "name"  => SCHEMA_AUTHOR_NAME,
                "url"   => SCHEMA_AUTHOR_URL,
            ],
            "itemReviewed" => [
                "@type" => "SoftwareApplication",
                "name"  => $audit['product'] ?? '',
                "applicationCategory" => $audit['category'] ?? '',
            ],
            "reviewRating" => [
                "@type"       => "Rating",
                "ratingValue" => round($useScore / 10, 1),  /* convert 0–100 → 0–10 */
                "bestRating"  => "10",
                "worstRating" => "0",
            ],
            "url"          => $fullUrl,
        ]);
    }

    /* Breadcrumb */
    $output .= schema_breadcrumb([
        ['Home',       SCHEMA_BASE_URL . '/'],
        ['UX Audits',  SCHEMA_BASE_URL . '/audit/'],
        [$audit['title'] ?? 'Audit', $fullUrl],
    ]);

    return $output;
}

/* ─────────────────────────────────────────────────
   6. GENERIC ARTICLE — psychology pages, resources
   Use when you have basic page data but no typed schema.

   @param array $data = [
     'title', 'desc', 'url', 'image', 'date', 'tags', 'section'
   ]
───────────────────────────────────────────────── */
function schema_article_generic(array $data): string {
    return _schema_tag([
        "@context"         => "https://schema.org",
        "@type"            => "Article",
        "headline"         => $data['title'] ?? '',
        "description"      => $data['desc'] ?? '',
        "image"            => [$data['image'] ?? SCHEMA_OG_DEFAULT],
        "datePublished"    => $data['date'] ?? date('Y-m-d'),
        "dateModified"     => $data['modified'] ?? $data['date'] ?? date('Y-m-d'),
        "author"           => [
            "@type" => "Person",
            "name"  => SCHEMA_AUTHOR_NAME,
            "url"   => SCHEMA_AUTHOR_URL,
        ],
        "publisher"        => _publisher(),
        "url"              => $data['url'] ?? SCHEMA_BASE_URL,
        "mainEntityOfPage" => ["@type" => "WebPage", "@id" => $data['url'] ?? SCHEMA_BASE_URL],
        "keywords"         => implode(', ', (array)($data['tags'] ?? [])),
        "articleSection"   => $data['section'] ?? 'UX Design',
        "inLanguage"       => "en-IN",
    ]);
}

/* ─────────────────────────────────────────────────
   7. BREADCRUMB — add to any page with hierarchy
   Enables breadcrumb trail in Google search results.

   @param array $crumbs = [['Label', 'https://url'], ...]
───────────────────────────────────────────────── */
function schema_breadcrumb(array $crumbs): string {
    $items = [];
    foreach ($crumbs as $i => [$name, $url]) {
        $items[] = [
            "@type"    => "ListItem",
            "position" => $i + 1,
            "name"     => $name,
            "item"     => $url,
        ];
    }
    return _schema_tag([
        "@context"        => "https://schema.org",
        "@type"           => "BreadcrumbList",
        "itemListElement" => $items,
    ]);
}

/* ─────────────────────────────────────────────────
   8. FAQ — for psychology / blog pages with Q&A
   Enables FAQ rich results directly in search.

   @param array $faqs = [['Question?', 'Answer.'], ...]
───────────────────────────────────────────────── */
function schema_faq(array $faqs): string {
    $entities = [];
    foreach ($faqs as [$q, $a]) {
        $entities[] = [
            "@type"          => "Question",
            "name"           => $q,
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text"  => $a,
            ],
        ];
    }
    return _schema_tag([
        "@context"   => "https://schema.org",
        "@type"      => "FAQPage",
        "mainEntity" => $entities,
    ]);
}

/* ─────────────────────────────────────────────────
   PRIVATE HELPERS
───────────────────────────────────────────────── */

function _publisher(): array {
    return [
        "@type" => "Person",
        "name"  => SCHEMA_AUTHOR_NAME,
        "url"   => SCHEMA_BASE_URL,
        "logo"  => [
            "@type" => "ImageObject",
            "url"   => SCHEMA_LOGO_URL,
            "width"  => 180,
            "height" => 180,
        ],
    ];
}

/* "March 2024" → "2024-03-01" */
function _parse_date(string $date): string {
    if (empty($date)) return date('Y-m-d');
    $months = [
        'january'=>'01','february'=>'02','march'=>'03','april'=>'04',
        'may'=>'05','june'=>'06','july'=>'07','august'=>'08',
        'september'=>'09','october'=>'10','november'=>'11','december'=>'12',
    ];
    $parts = explode(' ', trim($date));
    if (count($parts) === 2) {
        $month = $months[strtolower($parts[0])] ?? '01';
        return $parts[1] . '-' . $month . '-01';
    }
    /* already ISO or just a year */
    if (strlen($date) === 4 && is_numeric($date)) return $date . '-01-01';
    return date('Y-m-d', strtotime($date)) ?: date('Y-m-d');
}

/* "2022 – 2024" → "2022-01-01" */
function _year_to_iso(string $year): string {
    preg_match('/(\d{4})/', $year, $m);
    return isset($m[1]) ? $m[1] . '-01-01' : date('Y-m-d');
}

function _blog_keywords(string $category): array {
    $map = [
        'war'      => ['UX Leadership', 'Design Lessons', 'Product Design', 'War Stories'],
        'wins'     => ['UX Wins', 'Conversion Optimisation', 'Design Impact', 'Product Design'],
        'opinion'  => ['UX Opinion', 'Design Thinking', 'Product Strategy', 'Design Criticism'],
        'research' => ['User Research', 'UX Research', 'Field Research', 'Design Insights'],
    ];
    return $map[$category] ?? ['UX Design', 'Product Design', 'Design Leadership'];
}