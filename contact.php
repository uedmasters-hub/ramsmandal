<?php
/* =========================================
   CONTACT.PHP
   ========================================= */

/* Session must start before ANY output */
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . "/includes/config.php";

/* Generate CSRF token */
if (empty($_SESSION["csrf_token"])) {
  $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

$currentKey = "";
$pageTitle = "Contact Ramesh Mandal — UX Consultant Gurgaon | Hire a UX Leader";
$pageDesc  = "Hire Ramesh Mandal — UX Design Agency in Gurgaon. Open to senior UX leadership, consulting, and collaboration. Based in Gurgaon, available remotely across India and globally.";
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>" />

  <title><?= htmlspecialchars($pageTitle) ?></title>
  <!-- OG / TWITTER META -->
  <meta property="og:site_name"    content="Ramesh Mandal"/>
  <meta property="og:type"         content="website"/>
  <meta property="og:url"          content="https://6epixels.com/contact"/>
  <meta property="og:title"        content="Contact Ramesh Mandal"/>
  <meta property="og:description"  content="Open to senior UX leadership roles, product strategy, and enterprise design consultancy."/>
  <meta property="og:image"        content="https://6epixels.com/assets/og/og-default.jpg"/>
  <meta property="og:image:width"  content="1200"/>
  <meta property="og:image:height" content="630"/>
  <meta property="og:locale"       content="en_IN"/>
  <meta name="twitter:card"        content="summary_large_image"/>
  <meta name="twitter:site"        content="@ramsmandal"/>
  <meta name="twitter:title"       content="Contact Ramesh Mandal"/>
  <meta name="twitter:description" content="Open to senior UX leadership roles, product strategy, and enterprise design consultancy."/>
  <meta name="twitter:image"       content="https://6epixels.com/assets/og/og-default.jpg"/>
  <link rel="canonical"            href="https://6epixels.com/contact"/>

  <!-- FAVICON -->
  <link rel="icon" type="image/x-icon"     href="/assets/icons/favicon.ico"/>
  <link rel="icon" type="image/svg+xml"    href="/assets/icons/favicon.svg"/>
  <link rel="icon" type="image/png" sizes="32x32"  href="/assets/icons/favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16"  href="/assets/icons/favicon-16x16.png"/>
  <link rel="apple-touch-icon" sizes="180x180"     href="/assets/icons/favicon-180x180.png"/>
  <meta name="theme-color" content="#0f0f0f"/>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/preloader.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/variables.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/animations.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/reset.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/main.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/global.css"/>
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/navigation.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/background.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/footer.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/testimonials.css" />
  <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/contact.css" />


  <?php
    require_once __DIR__ . "/includes/schema.php";
    echo schema_person();
    echo schema_breadcrumb([
        ["Home", "https://6epixels.com/"],
        ["Contact", "https://6epixels.com/contact"],
    ]);
  ?>
</head>
<body>


  <!-- PRELOADER -->
  <div class="preloader" id="preloader" aria-hidden="true">
    <div class="preloader__grid"></div>
    <div class="preloader__inner">
      <div class="preloader__mark">RM</div>
      <div class="preloader__name">
        <span class="preloader__name-text">Get in Touch</span>
        <span class="preloader__name-role">Let's build something exceptional</span>
      </div>
      <div class="preloader__bar-wrap"><div class="preloader__bar" id="preloader-bar"></div></div>
      <span class="preloader__counter" id="preloader-counter">0%</span>
    </div>
  </div>

  <!-- BACKGROUND -->
  <div class="bg-canvas" aria-hidden="true">
    <div class="bg-grid"></div>
    <div class="bg-orb-1"></div>
    <div class="bg-orb-2"></div>
    <div class="bg-mouse-glow"></div>
  </div>

  <?php require __DIR__ . "/partials/navigation.php"; ?>
  <div class="page-wrapper">


    <main id="main-content">

      <div class="contact-page">

        <!-- ── LEFT ── -->
        <div class="contact-left">

          <div>
            <p class="contact-kicker">GET IN TOUCH</p>

            <h1 class="contact-title">
              Let's build<br>
              something<br>
              <span>exceptional.</span>
            </h1>

            <p class="contact-desc">
              I'm open to senior UX leadership roles, product strategy engagements,
              and enterprise design consultancy. If you're building something
              that matters at scale — let's talk.
            </p>
          </div>

          <div>
            <div class="contact-details">

              <div class="contact-detail">
                <div class="contact-detail__icon" aria-hidden="true">✉</div>
                <div>
                  <span class="contact-detail__label">Email</span>
                  <a href="mailto:ramsmandal@icloud.com">
                    <span class="contact-detail__value">ramsmandal@icloud.com</span>
                  </a>
                </div>
              </div>

              <div class="contact-detail">
                <div class="contact-detail__icon" aria-hidden="true">📱</div>
                <div>
                  <span class="contact-detail__label">Phone</span>
                  <a href="tel:+919538000060">
                    <span class="contact-detail__value">+91 95380 00060</span>
                  </a>
                </div>
              </div>

              <div class="contact-detail">
                <div class="contact-detail__icon" aria-hidden="true">📍</div>
                <div>
                  <span class="contact-detail__label">Location</span>
                  <span class="contact-detail__value">Gurugram, India · Remote &amp; Hybrid</span>
                </div>
              </div>

              <div class="contact-detail">
                <div class="contact-detail__icon" aria-hidden="true">in</div>
                <div>
                  <span class="contact-detail__label">LinkedIn</span>
                  <a href="https://in.linkedin.com/in/ramsmandal" target="_blank" rel="noopener">
                    <span class="contact-detail__value">linkedin.com/in/ramsmandal</span>
                  </a>
                </div>
              </div>

            </div>

            <div class="contact-availability">
              <span class="contact-availability__dot" aria-hidden="true"></span>
              <span class="contact-availability__text">Available for new opportunities</span>
            </div>

          </div>

        </div>

        <!-- ── RIGHT ── -->
        <div class="contact-right">

          <!-- SUCCESS -->
          <div class="contact-success" id="contact-success" role="alert" aria-live="polite">
            <div class="contact-success__card">
              <p class="contact-success__sent">Message delivered</p>
              <h2 class="contact-success__title">You'll hear from<br>me soon.</h2>
              <p class="contact-success__sub">I read every message personally and respond thoughtfully — not with a template.</p>
            </div>
            <div class="contact-success__timeline">
              <p class="contact-success__tl-label">What happens next</p>
              <div class="contact-success__step">
                <div class="contact-success__step-dot contact-success__step-dot--done">✓</div>
                <div>
                  <p class="contact-success__step-title">Message received</p>
                  <p class="contact-success__step-desc">Logged and in my inbox.</p>
                  <p class="contact-success__step-time">Just now</p>
                </div>
              </div>
              <div class="contact-success__step">
                <div class="contact-success__step-dot contact-success__step-dot--soon">→</div>
                <div>
                  <p class="contact-success__step-title">I read it properly</p>
                  <p class="contact-success__step-desc">Not skimmed. I'll understand what you actually need.</p>
                  <p class="contact-success__step-time">Within a few hours</p>
                </div>
              </div>
              <div class="contact-success__step">
                <div class="contact-success__step-dot contact-success__step-dot--later">◎</div>
                <div>
                  <p class="contact-success__step-title">A real reply</p>
                  <p class="contact-success__step-desc">Specific to your message — not a template.</p>
                  <p class="contact-success__step-time">Within 24 hours</p>
                </div>
              </div>
            </div>
          </div>

          <!-- FORM -->
          <div class="contact-form-wrap" id="contact-form-wrap">

            <form class="contact-form" id="contact-form" novalidate aria-label="Contact form">

              <div class="form-hp" aria-hidden="true">
                <input type="text" name="website" tabindex="-1" autocomplete="off"/>
              </div>
              <input type="hidden" name="csrf_token" id="csrf-token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"/>
              <input type="hidden" name="type" id="field-type" value="Job Opportunity"/>

              <!-- TYPE SELECTOR -->
              <div class="form-type-row">
                <p class="contact-form-header__label" style="margin-bottom:14px">I'm reaching out about</p>
                <div class="form-type-group" role="group" aria-label="Enquiry type">
                  <button type="button" class="form-type-btn is-active" data-type="Job opportunity">Job opportunity</button>
                  <button type="button" class="form-type-btn" data-type="Consulting">Consulting</button>
                  <button type="button" class="form-type-btn" data-type="Collaboration">Collaboration</button>
                  <button type="button" class="form-type-btn" data-type="Speaking">Speaking</button>
                  <button type="button" class="form-type-btn" data-type="Other">Other</button>
                </div>
              </div>

              <!-- FIELDS -->
              <div class="form-fields">

                <div class="form-row">
                  <div class="form-field">
                    <label class="form-label" for="field-name">Your Name</label>
                    <input class="form-input" type="text" id="field-name" name="name" placeholder="Priya Sharma" autocomplete="name" required maxlength="100"/>
                    <span class="form-error" id="error-name" role="alert"></span>
                  </div>
                  <div class="form-field">
                    <label class="form-label" for="field-email">Email Address</label>
                    <input class="form-input" type="email" id="field-email" name="email" placeholder="priya@company.com" autocomplete="email" required/>
                    <span class="form-error" id="error-email" role="alert"></span>
                  </div>
                </div>

                <div class="form-field">
                  <label class="form-label" for="field-subject">Subject</label>
                  <input class="form-input" type="text" id="field-subject" name="subject" placeholder="Senior UX Lead role at Acme Corp" maxlength="200" required/>
                  <span class="form-error" id="error-subject" role="alert"></span>
                </div>

                <div class="form-field">
                  <div class="form-footer-row">
                    <label class="form-label" for="field-message">Message</label>
                    <span class="form-char-count" id="char-count" aria-live="polite">0 / 3000</span>
                  </div>
                  <textarea class="form-textarea" id="field-message" name="message" placeholder="Tell me about the role, project, or opportunity. The more context you share, the better I can respond." maxlength="3000" required></textarea>
                  <span class="form-error" id="error-message" role="alert"></span>
                </div>

              </div>

              <!-- FOOTER -->
              <div class="form-footer-block">
                <div class="form-global-error" id="form-global-error" role="alert"></div>
                <div class="rate-countdown" id="rate-countdown" style="display:none" role="status" aria-live="polite">
                  <div class="rate-countdown__top">
                    <span class="rate-countdown__msg">You've already sent a message.</span>
                    <span class="rate-countdown__timer" id="rate-countdown-text">60s</span>
                  </div>
                  <div class="rate-countdown__bar-wrap">
                    <div class="rate-countdown__bar" id="rate-bar-fill"></div>
                  </div>
                  <span class="rate-countdown__hint">Button re-enables automatically.</span>
                </div>
                <button class="form-submit" type="submit" id="form-submit">
                  <span class="form-submit__spinner" aria-hidden="true"></span>
                  <span class="form-submit__label">Send Message ↗</span>
                </button>
                <p class="form-footer-note">Your message is encrypted in transit</p>
              </div>

            </form>
          </div>

        </div>

      </div>

    </main>


    <!-- MARQUEE -->
    <?php
    $mItems = ["✦ OPEN TO WORK","UX LEADERSHIP ROLES","✦ PRODUCT STRATEGY","DESIGN SYSTEMS","✦ ENTERPRISE UX","AI-ENABLED DESIGN","✦ AVAILABLE GLOBALLY","REMOTE & HYBRID"];
    $mAll   = array_merge($mItems, $mItems);
    ?>
    <div class="marquee-strip" aria-label="Open to new opportunities" role="marquee">
      <div class="marquee-track">
        <?php foreach ($mAll as $mi): ?><span class="marquee-item"><?= htmlspecialchars($mi) ?></span><?php endforeach; ?>
      </div>
    </div>

    <?php require __DIR__ . "/partials/footer.php"; ?>

  </div>

  <script src="<?= BASE_PATH ?>/assets/js/preloader.js"></script>
  <script src="<?= BASE_PATH ?>/assets/js/background.js" defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/app.js"        defer></script>
  <script src="<?= BASE_PATH ?>/assets/js/contact.js"    defer></script>

  <script src="<?= BASE_PATH ?>/assets/js/navigation.js" defer></script>
</body>
</html>