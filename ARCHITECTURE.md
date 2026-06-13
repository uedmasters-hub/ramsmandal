# ramsmandal.com — architecture

Personal portfolio of Ramesh Mandal, Experience Architect. A storytelling medium,
not a case-study archive. Four surfaces, no more: **Home, Work, About, Contact.**
Core message: *I transform complexity into clarity.*

Stack: PHP 8.1+ (no framework), MySQL (later), vanilla JS ES6 modules, modular CSS
with custom properties, GSAP + ScrollTrigger + THREE.js + Lenis for the motion layer,
self-hosted Inter + Manrope. One Composer dependency: vlucas/phpdotenv.

## How a request flows

```
Browser → .htaccess → index.php → app/bootstrap.php (env, helpers, paths)
        → app/router.php (strip APP_BASE, match) → app/routes.php (handler)
        → view('home', data) → views/home.php captured → views/layouts/base.php wraps it
```

Real static files under `/public` are served directly by Apache. Everything else
is routed to `index.php`. No `.php` in URLs, no per-page `<head>` duplication.

## The map

```
index.php                  front controller
app/
  bootstrap.php            env load, error mode, path constants
  helpers.php              env() url() asset() e() content() view() not_found()
  router.php               matcher → dispatch closure
  routes.php               THE map: / /work /work/{slug} /about /contact (GET+POST)
  db.php                   lazy PDO singleton (unused until DB phase)
content/                   data-first, DB-ready (single source of truth)
  site.php                 nav, identity, contact, social, meta
  projects.php             work registry (5 case studies + 2 teardowns)
  profile.php              About data (from resume)
  projects/{slug}.php      optional long-form journey body
views/
  layouts/base.php         the ONE shell (head + topbar + menu + footer + scripts)
  partials/                head fragments: topbar, menu, footer
  home.php work.php project.php about.php contact.php 404.php
public/
  css/   variables, theme, fonts, reset, base, topbar, menu, footer, home, work-rail, project, about, contact
  js/    core/{theme,menu,reveal}.js, project.js, lib/ (gsap/three/lenis), webgl/
  fonts/ Inter + Manrope woff2  (drop in from backup)
  img/work/{slug}/  self-hosted WebP, dimensions set
  icons/ og/
db/      schema.sql, seed.php  (DB phase)
storage/ private, Require all denied
```

## Conventions (do not break)

- No inline CSS, no inline JS (one exception: the FOUC guard line in `base.php`).
- Animate only `transform` and `opacity`. House eases live in `variables.css`.
- Every motion timeline ships its `prefers-reduced-motion` path in the same pass.
- Colours come from CSS custom properties only. One locked accent (`--blue`).
- No em dashes anywhere. Real metrics and real brands only.
- A view sets `$page = ['title','desc','body_class','styles','scripts']` then prints markup.
  Globals (reset, base, theme, topbar, menu, footer, theme.js, menu.js) load automatically.

## Run it locally (XAMPP)

1. Drop the folder in `htdocs/` (e.g. `htdocs/ramsmandal-v2`).
2. `cp .env.example .env` and confirm `APP_BASE=/ramsmandal-v2`.
3. (Optional now) `composer install` for phpdotenv; the bootstrap has a fallback parser so it boots without it.
4. Add the woff2 files to `public/fonts/` and favicons to `public/icons/` from backup.
5. Visit `http://localhost/ramsmandal-v2/`. Home is complete; Work/About/Contact render with real data.

## Build phases

- **Phase 0 (done):** scaffold, router, layout, tokens, Home complete, other routes live with real data.
- **Phase 1:** self-hosted fonts + favicons + OG image in place; polish Work index; wire Lenis + `core/motion.js`.
- **Phase 2:** first full project journey (`content/projects/indigo-booking.php` + `project.js` scroll choreography) as the template.
- **Phase 3:** the remaining journeys; fold the best blog/psychology thinking into their decisions/lessons beats.
- **Phase 4:** About + Contact to full fidelity; contact POST handler (validation + send).
- **Phase 5 (optional):** migrate `content/projects.php` into MySQL via `db/schema.sql` + `db/seed.php`; swap `content()` for `db()` reads.
- **Phase 6:** the WebGL/signature moment, only where it deepens a journey.
```
```
