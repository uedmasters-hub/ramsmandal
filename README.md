# ramsmandal.com

Personal portfolio of Ramesh Mandal, Experience Architect — *I transform complexity
into clarity.* Four pages: **Home, Work, About, Contact.**

No framework, no build step. PHP front controller + vanilla JS ES modules + modular
CSS. Motion via GSAP, ScrollTrigger, Lenis (and THREE.js for the dot-field). Content
lives in plain PHP arrays under `content/`, so editing the site means editing data,
not markup.

## Run it

1. Needs PHP 8.1+. From the project root:
   ```
   php -S localhost:8000
   ```
   (or drop the folder into XAMPP `htdocs/`).
2. If it runs in a subfolder, create a `.env` with `APP_BASE=/your-subfolder`
   (leave it empty at the web root). Add `APP_ENV=development` to see errors.
   No `.env` is required at the root; it defaults to production.
3. `composer install` is optional — it only pulls in `phpdotenv`. A built-in `.env`
   parser runs without it.
4. Add the fonts (`public/fonts/*.woff2`) and icons (`public/icons/*`) if they are
   missing from your checkout.

Open the site. Home is the most complete page.

## Where things are

```
app/        bootstrap, router, routes, helpers          (the plumbing)
content/    site.php  home.php  projects.php  profile.php  (edit the site here)
views/      base.php (the shell) + one file per page + partials/
public/     css/  js/  fonts/  img/  icons/
```

- **Add or edit a page's content** -> the matching file in `content/`.
- **Add a case study** -> add a row to `content/projects.php` (with a `slug`), and an
  optional long-form body at `content/projects/{slug}.php`. It appears under
  `/work/{slug}` automatically.
- **Routes** are listed in `app/routes.php`: `/`, `/work`, `/work/{slug}`, `/about`,
  `/contact`.

## How links work

Pages link with the `url()` helper, e.g. `url('/work/' . $slug)` -> `/work/{slug}`,
which the router resolves to the project whose `slug` matches in `content/projects.php`.
The Selected Work list on the home page is built straight from that registry, so its
links never drift.

## The big cards gallery (home)

The six **disciplines** shown on the home page. It is a two-stage, full-image
experience.

- **Markup:** `views/partials/home/disciplines.php`
- **Data:** `content/home.php` -> `disciplines` (`title`, `desc`, optional `image`)
- **Styles:** `public/css/big-cards.css`
- **Behaviour:** `public/js/big-cards-gallery.js`

**State 1 — spotlight.** As you scroll into the section it pins and shows one card at
a time, image-dominant, advancing card by card. Small progress ticks track where you
are.

**State 2 — gallery.** After the last card it releases into the full draggable rail of
all six cards (the first card is the blue accent card). Same order, same content.

**Gallery cursor** (desktop / mouse only):

- **First card:** a right arrow only.
- **Middle cards:** both arrows.
- **Last card:** a left arrow only.

Unavailable arrows are hidden, not greyed out. Clicking the left/right side moves a
card. On phones and tablets there is no custom cursor — the cards stack and you tap and
scroll normally. (Note: the discipline cards are a visual gallery and do not link
anywhere; the clickable project links live in the Selected Work list below.)

## House rules

- Animate only `transform` and `opacity`; every animation has a reduced-motion path.
- One accent colour (`--blue`); all colours come from CSS variables.
- No inline CSS/JS (one allowed exception: the theme guard in `base.php`).
- Custom cursors only on fine-pointer (mouse) devices.

See `ARCHITECTURE.md` for the technical detail.
