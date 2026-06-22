# ramsmandal.com — architecture

Personal portfolio of Ramesh Mandal, Experience Architect. A storytelling medium,
not a case-study archive. Four surfaces: **Home, Work, About, Contact.**
Core message: *I transform complexity into clarity.*

**Stack:** PHP 8.1+ (no framework), vanilla JS ES6 modules, modular CSS with custom
properties, GSAP + ScrollTrigger + Lenis + THREE.js for motion, self-hosted fonts.
One optional Composer dependency: `vlucas/phpdotenv` (a fallback `.env` parser runs
when it is absent). A lazy PDO singleton exists in `app/db.php` for a later DB phase;
today all content is flat PHP arrays under `content/`.

## How a request flows

```
Browser → .htaccess → index.php → app/bootstrap.php (constants, .env, helpers, seo)
        → app/router.php (matcher) → app/routes.php (handler)
        → view('home', data): views/home.php captured into $content
        → views/layouts/base.php wraps $content using $page
```

Real files under `/public` are served directly by Apache. Everything else routes to
`index.php`. No `.php` in URLs; the `<head>` is built once in `base.php`.

Key helpers (`app/helpers.php`): `url($p)` -> `APP_BASE/$p`; `asset($p)` /
`asset_v($p)` -> `APP_BASE/public/$p` (the `_v` variant appends `?v=<mtime>` for
cache-busting); `content($name)` -> `require content/$name.php`; `view($name,$data)`
-> render a view inside `base.php`; `not_found()` -> 404.

## The map (as built)

```
index.php                    front controller
app/
  bootstrap.php              BASE_DIR / VIEW_DIR / CONTENT_DIR, .env, APP_ENV/APP_BASE/APP_URL
  helpers.php                env e url asset asset_v content view not_found build_breadcrumbs ...
  router.php                 request matcher -> dispatch
  routes.php                 THE map (see below)
  seo.php                    meta tags, JSON-LD, sitemap_xml()
  db.php                     lazy PDO singleton (unused until DB phase)
includes/
  breadcrumbs.php            build_breadcrumbs() for the breadcrumb bar
content/                     data-first, single source of truth
  site.php                   nav, identity, contact, social, meta
  home.php                   home narrative: hero, disciplines, intro, logos, work header,
                             perspectives, philosophy, scale
  projects.php               work registry: slug, title, year, category, type, featured, metric ...
  profile.php                About data
  projects/{slug}.php        optional long-form project body
views/
  layouts/base.php           the ONE shell: head + #dotfield + topbar + <main> + footer + menu + scripts
  home.php work.php project.php about.php contact.php 404.php
  partials/                  topbar, menu, footer, breadcrumbs, seo, perspectives, philosophy
  partials/home/             hero, preloader, disciplines, intro, logos, work, scale
public/
  css/   variables theme fonts reset base topbar menu footer footer-playground breadcrumbs cursor
         home home-experience home-marquee big-cards work-rail work-journey perspectives philosophy
         about contact project 404
  js/    core/{theme,menu,topbar,cursor,reveal,dot-field,smooth-scroll,text-ink,footer,footer-curtain,contact}.js
         home-experience.js big-cards-gallery.js logo-marquee.js preloader.js project.js
         work-journey.js work-tiles.js
  fonts/  img/  icons/  og/
storage/                     private (denied by the web server)
```

### Routes (`app/routes.php`)

```
GET  /                 -> view('home')      home composition
GET  /work             -> view('work')      work index (from content/projects.php)
GET  /work/{slug}      -> view('project')   look up project by slug; optional body from content/projects/{slug}.php
GET  /about            -> view('about')
GET  /contact          -> view('contact')
POST /contact          -> contact_submit(); JSON when wants_json(), else re-render
GET  /sitemap.xml      -> sitemap_xml()
```

## Asset loading (per view)

A view sets `$page = ['title','desc','body_class','styles'=>[],'scripts'=>[],'modules'=>[],'importmap'=>...]`
then prints markup. `base.php` always loads the globals (variables, theme, reset, base,
topbar, menu, footer(+playground), breadcrumbs, cursor; and theme/menu/topbar/cursor
JS + dot-field), then:

- `styles[]`   -> `<link>` (in array order, so later entries win the cascade)
- `scripts[]`  -> `<script defer>` (classic)
- `modules[]`  -> `<script type="module">`
- `importmap`  -> one `<script type="importmap">` for bare ES specifiers (`lenis`,
  `gsap`, `gsap/ScrollTrigger`); present on pages that use them (Home, project).

Home (`views/home.php`) loads styles `home, home-experience, home-marquee, big-cards,
work-journey, perspectives, philosophy` and modules `preloader, home-experience,
core/text-ink, logo-marquee, big-cards-gallery`. Section order:
`hero -> preloader -> disciplines (big-cards gallery)` then inside `.site-container`:
`intro -> logos -> work -> perspectives -> philosophy -> scale`.

## Big cards gallery (Home)

A two-stage, full-image presentation of the six **disciplines**.

**Where it lives**

- Markup: `views/partials/home/disciplines.php` (Home only).
- Data: `content/home.php` -> `$home['disciplines']` — six items
  `{ title, desc, image?, image_alt? }`. The first three carry images
  (`public/img/disciplines/*.webp`); the rest fall back to a quiet branded panel.
- Styles: `public/css/big-cards.css` (loaded after `home-experience` so it wins).
- Behaviour: `public/js/big-cards-gallery.js` (a module; imports the page's `gsap`).

**Card links / route mapping.** The discipline cards are a visual gallery — they carry
**no `href`** and have no per-card destinations. Project destinations live in the
separate Selected Work section (`views/partials/home/work.php`), where each row is
`<a href="<?= url('/work/' . $p['slug']) ?>">` driven by the featured case studies in
`content/projects.php`. So a work link maps: `projects.php` slug -> `url('/work/{slug}')`
(= `APP_BASE/work/{slug}`) -> the `/work/{slug}` route -> `views/project.php`. Both the
gallery and the work list are generated from their single data source, so order and
mapping never drift from the markup.

**State 01 — single-card spotlight.** `.bc-stage` is `position: sticky` inside a tall
`.bc-stage-wrap` (`height: calc(var(--bc-count) * 70vh + 22vh)`; the `70vh` tunes how
long the focus phase lasts). Native scroll progress through the wrap drives
`activeCardIndex = round(progress * (count - 1))`. GSAP crossfades the stacked
full-image `.bc-slide` elements — the active one to `opacity:1 / scale:1`, the rest
faded and nudged — so the image is the dominant element and the gallery advances one
card at a time. The `.bc-progress` ticks reflect the active card.

**State 02 — expanded rail.** When the sticky stage releases, the existing
`.big-cards__track` rail (all cards, drag-to-scroll, accent first card) is revealed
below with a staggered GSAP entrance. It is generated from the same `$cards` loop, so
identity and order are identical to State 01.

**Gallery cursor** (`.bc-cursor`, fine-pointer only, driven by `activeCardIndex`):

- **First card** (`index 0`): right arrow only — the left arrow is hidden.
- **Middle cards**: both arrows.
- **Last card** (`index count-1`): left arrow only — the right arrow is hidden.

Unavailable arrows are removed (`hidden`), never shown disabled. Clicking the left or
right half advances/retreats via Lenis `scrollTo`. The cursor reuses the site's frosted
material and is gated to `(hover:hover) and (pointer:fine)`; the global site cursor
steps aside over the stage. On touch and `prefers-reduced-motion` the spotlight
collapses to stacked, static cards (CSS) and only the rail interaction runs — desktop
cursor patterns are never forced onto touch.

## Conventions (do not break)

- No inline CSS, no inline JS — one exception: the FOUC/theme guard line in `base.php`
  (it sets `html.js` and the saved theme before first paint).
- Animate only `transform` and `opacity`. House eases live in `variables.css`.
- Every motion timeline ships its `prefers-reduced-motion` path in the same pass.
- Custom cursors are gated to `(hover:hover) and (pointer:fine)` and `no-preference`.
- Scroll-driven sections prefer `position: sticky` + native scroll progress (Lenis-
  friendly) over fragile ScrollTrigger pinning.
- Colours come from CSS custom properties only. One locked accent (`--blue`).
- No em dashes. Real metrics and real brands only.

## Run it locally

1. PHP 8.1+. Serve via Apache (drop the folder in `htdocs/`) or `php -S localhost:8000`.
2. Optionally create `.env`: set `APP_BASE` to the subfolder it runs under
   (`/ramsmandal-v2` on XAMPP, empty at the web root) and `APP_ENV=development` to see
   errors. Without `.env` it defaults to production at the root.
3. `composer install` is optional (phpdotenv); the bootstrap has a fallback parser.
4. Add `public/fonts/*.woff2` and `public/icons/*` from backup if missing.
5. Visit the site. Home is the most complete surface; Work/About/Contact render from
   real data in `content/`.

## Build phases (roadmap)

- **Phase 0 (done):** scaffold, router, layout, tokens, Home, real-data routes.
- **Phase 1:** fonts + favicons + OG in place; Work index polish; Lenis/motion wiring.
- **Phase 2:** first full project journey (`content/projects/indigo-booking.php` +
  `project.js` scroll choreography) as the template.
- **Phase 3:** the remaining journeys.
- **Phase 4:** About + Contact to full fidelity; contact POST (validation + send).
- **Phase 5 (optional):** migrate `content/projects.php` into MySQL (`app/db.php`);
  swap `content()` reads for `db()`.
- **Phase 6:** the WebGL signature moment, only where it deepens a journey.
