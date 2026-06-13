<?php
/* =========================================
   DATA / RESOURCES.PHP
   ========================================= */

$resourcesMeta = [
  "title"   => "The UX Leader's Toolkit",
  "tagline" => "Everything I wish I'd had on day one.",
  "desc"    => "17 years of frameworks, references, tools, and thinking distilled into one page. Take what's useful. Leave what isn't. No email required.",
];

/* ── DOWNLOADS ── Actual usable templates */
$downloads = [
  [
    "id"       => "ux-audit-template",
    "icon"     => "◎",
    "label"    => "FREE TEMPLATE",
    "title"    => "UX Audit Framework",
    "desc"     => "The exact 47-point heuristic checklist I use for client audits. Covers information architecture, interaction patterns, trust signals, mobile parity, and accessibility. Copy it, adapt it, ship it.",
    "format"   => "Figma + PDF",
    "pages"    => "12 pages",
    "color"    => "blue",
    "cta"      => "Get the template",
    "href"     => "/contact.php?type=resource&item=ux-audit-template",
  ],
  [
    "id"       => "design-brief",
    "icon"     => "⬡",
    "label"    => "FREE TEMPLATE",
    "title"    => "Design Brief for Stakeholders",
    "desc"     => "A one-page brief format that aligns design, product, and business before a single wireframe gets made. Covers problem statement, success metrics, constraints, and non-goals. Saves weeks of misalignment.",
    "format"   => "Notion + PDF",
    "pages"    => "1 page",
    "color"    => "blue",
    "cta"      => "Get the brief",
    "href"     => "/contact.php?type=resource&item=design-brief",
  ],
  [
    "id"       => "research-synthesis",
    "icon"     => "◈",
    "label"    => "FREE TEMPLATE",
    "title"    => "Research Synthesis Toolkit",
    "desc"     => "From raw interview notes to actionable insights in 3 steps. Includes affinity mapping template, insight statement format, and the 'So what?' framework for converting findings into design decisions.",
    "format"   => "FigJam + PDF",
    "pages"    => "8 pages",
    "color"    => "blue",
    "cta"      => "Get the toolkit",
    "href"     => "/contact.php?type=resource&item=research-synthesis",
  ],
  [
    "id"       => "ux-metrics",
    "icon"     => "⬟",
    "label"    => "FREE TEMPLATE",
    "title"    => "UX Metrics Dashboard",
    "desc"     => "The metrics I track across every project: conversion funnel, task completion rate, error frequency, NPS, and time-on-task. Pre-built Mixpanel dashboard template + manual tracking sheet for teams without analytics tools.",
    "format"   => "Mixpanel + Sheets",
    "pages"    => "5 pages",
    "color"    => "blue",
    "cta"      => "Get the dashboard",
    "href"     => "/contact.php?type=resource&item=ux-metrics",
  ],
];

/* ── READING STACK ── Annotated books */
$books = [
  [
    "title"   => "Don't Make Me Think",
    "author"  => "Steve Krug",
    "year"    => "2014",
    "emoji"   => "🧠",
    "rating"  => 5,
    "take"    => "Still the best single book on UX. Read it before anything else. Then read it again after 5 years — you'll understand different things.",
    "for"     => "Everyone",
    "quote"   => "Clarity trumps consistency.",
  ],
  [
    "title"   => "Hooked",
    "author"  => "Nir Eyal",
    "year"    => "2014",
    "emoji"   => "🪝",
    "rating"  => 4,
    "take"    => "Essential for understanding engagement loops. Read it critically — the same model that builds healthy habits builds addiction. Know which you're building.",
    "for"     => "Product designers",
    "quote"   => "Technologies are just habits in a different form.",
  ],
  [
    "title"   => "Thinking, Fast and Slow",
    "author"  => "Daniel Kahneman",
    "year"    => "2011",
    "emoji"   => "⚡",
    "rating"  => 5,
    "take"    => "The foundational text for understanding how users actually make decisions versus how we assume they do. Every UX principle has roots here.",
    "for"     => "Senior designers & researchers",
    "quote"   => "Nothing in life is as important as you think it is, while you are thinking about it.",
  ],
  [
    "title"   => "The Design of Everyday Things",
    "author"  => "Don Norman",
    "year"    => "2013",
    "emoji"   => "🚪",
    "rating"  => 5,
    "take"    => "If you only read one book on design cognition, this is it. The concept of affordances alone will change how you see every interface.",
    "for"     => "Everyone",
    "quote"   => "Good design is actually a lot harder to notice than poor design.",
  ],
  [
    "title"   => "Sprint",
    "author"  => "Jake Knapp",
    "year"    => "2016",
    "emoji"   => "🏃",
    "rating"  => 4,
    "take"    => "The 5-day design sprint format is genuinely useful for high-stakes decisions. I've used it 8 times. Works best with real users on day 5 — many teams skip this and miss the point.",
    "for"     => "Design teams & product leads",
    "quote"   => "Work alone together.",
  ],
  [
    "title"   => "Continuous Discovery Habits",
    "author"  => "Teresa Torres",
    "year"    => "2021",
    "emoji"   => "🔭",
    "rating"  => 5,
    "take"    => "The best modern book on connecting research to product decisions. The opportunity solution tree is the most useful framework I've adopted in the last 5 years.",
    "for"     => "Product designers & PMs",
    "quote"   => "Discovery is not a phase. It's a habit.",
  ],
];

/* ── TOOLBOX ── Software actually used */
$tools = [
  [
    "name"    => "Figma",
    "cat"     => "Design",
    "emoji"   => "🎨",
    "use"     => "Primary design tool. Everything from wireframes to shipped components.",
    "honest"  => "Auto Layout took 3 weeks to click. Now I can't design without it.",
    "level"   => "Expert",
  ],
  [
    "name"    => "Claude AI",
    "cat"     => "AI",
    "emoji"   => "🤖",
    "use"     => "Research synthesis, UX copy variants, audit analysis, rapid prototyping prompts.",
    "honest"  => "Changed how I do research synthesis. 3-hour affinity mapping → 40 minutes.",
    "level"   => "Advanced",
  ],
  [
    "name"    => "Mixpanel",
    "cat"     => "Analytics",
    "emoji"   => "📊",
    "use"     => "Funnel analysis, event tracking, cohort analysis for retention work.",
    "honest"  => "Only useful if engineering instruments events properly. Get that conversation early.",
    "level"   => "Advanced",
  ],
  [
    "name"    => "Hotjar",
    "cat"     => "Research",
    "emoji"   => "🔥",
    "use"     => "Session recordings, heatmaps, funnel visualisation.",
    "honest"  => "Session recordings are worth 100 surveys. Watch 20 sessions before writing a brief.",
    "level"   => "Advanced",
  ],
  [
    "name"    => "FigJam",
    "cat"     => "Collaboration",
    "emoji"   => "🗺",
    "use"     => "Journey mapping, affinity diagrams, design critiques, retrospectives.",
    "honest"  => "Replaced Miro for me. Better Figma integration. Worse sticky note physics.",
    "level"   => "Expert",
  ],
  [
    "name"    => "Notion",
    "cat"     => "Documentation",
    "emoji"   => "📋",
    "use"     => "Design system documentation, research repositories, project wikis.",
    "honest"  => "Great for docs. Terrible for tasks. Use it for one, not both.",
    "level"   => "Advanced",
  ],
  [
    "name"    => "Gemini AI",
    "cat"     => "AI",
    "emoji"   => "✨",
    "use"     => "Image analysis, competitor research, accessibility checks on screenshots.",
    "honest"  => "Better than Claude for visual analysis tasks specifically.",
    "level"   => "Intermediate",
  ],
  [
    "name"    => "Jira",
    "cat"     => "Project Management",
    "emoji"   => "🎯",
    "use"     => "Sprint tracking, design task management, cross-team alignment.",
    "honest"  => "Nobody enjoys Jira. But everyone uses it. Learn the keyboard shortcuts.",
    "level"   => "Advanced",
  ],
];

/* ── FRAMEWORKS ── Proprietary thinking models */
$frameworks = [
  [
    "id"    => "clarity-before-conversion",
    "num"   => "01",
    "title" => "Clarity Before Conversion",
    "desc"  => "Most conversion problems are clarity problems in disguise. Before optimising the CTA, ask: does the user understand what happens when they click it? Does the page answer the four questions users always have: What is this? What can I do here? Why should I? What do I risk? Answer those, and conversion follows.",
    "steps" => [
      "Map the 4 user questions for every key screen",
      "Identify which questions aren't answered above the fold",
      "Fix clarity gaps before running A/B tests on CTAs",
      "Measure comprehension, not just conversion",
    ],
    "used"  => "IndiGo booking flow · Quikr listing creation",
  ],
  [
    "id"    => "impact-effort-prioritisation",
    "num"   => "02",
    "title" => "Impact × Effort → Sequence",
    "desc"  => "Not all UX problems are equal. I score every identified issue on two axes: user impact (1–5) and engineering effort (1–5). The high impact, low effort quadrant gets shipped first. The high impact, high effort quadrant gets resourced for the next quarter. The low impact, anything quadrant goes in the backlog.",
    "steps" => [
      "List all identified friction points from audit",
      "Score each: user impact (1–5) and effort (1–5)",
      "Plot on 2×2. Ship Q1 first (high impact, low effort)",
      "Resource Q2 (high impact, high effort) in next planning cycle",
    ],
    "used"  => "Every UX audit and redesign project",
  ],
  [
    "id"    => "the-3am-test",
    "num"   => "03",
    "title" => "The 3am Test",
    "desc"  => "Before finalising any operational or high-frequency UI, I ask: would this work for someone who is tired, stressed, and on a small screen? Operational software fails at 3am. Booking flows fail when users are rushing. If the design only works for a rested, focused user with good eyesight and reliable internet — it's not designed for the real world.",
    "steps" => [
      "Identify your highest-stress user moment",
      "Define the device and context (screen size, lighting, network)",
      "Test specifically in that context — not a usability lab",
      "Treat any failure in context as a critical bug, not a minor issue",
    ],
    "used"  => "CrewPal (4am airport lounge) · IndiGo payment (mobile, poor signal)",
  ],
  [
    "id"    => "measure-then-design",
    "num"   => "04",
    "title" => "Measure First, Then Design",
    "desc"  => "Every design decision should have a hypothesis and a metric. Before wireframing, I define: what will change in user behaviour if this works? What will I measure? What constitutes success? This shifts design from opinion to evidence. It also makes stakeholder conversations easier — you\'re not defending a design, you\'re proposing an experiment.",
    "steps" => [
      "Write the hypothesis: 'If we change X, users will do Y more/less'",
      "Identify the metric that proves/disproves it",
      "Design the test, not just the feature",
      "Set a decision threshold before running the test",
    ],
    "used"  => "Every major IndiGo feature · Quikr listing flow redesign",
  ],
];

/* ── QUICK REFS ── One-line answers to common questions */
$quickRefs = [
  ["q" => "Minimum mobile tap target size?",      "a" => "44×44px (Apple) / 48×48dp (Google). Use 52px for operational/fatigued contexts."],
  ["q" => "How many items in a nav menu?",        "a" => "5–7. More than 7 and users start missing items (Miller's Law)."],
  ["q" => "Minimum readable font size on mobile?","a" => "16px for body. Never below 12px for anything. 14px is the real-world minimum."],
  ["q" => "How long should a loading state wait?","a" => "Show feedback at 100ms. Show progress at 1s. Explain delay at 3s. Offer cancel at 10s."],
  ["q" => "When to use a modal vs a new page?",   "a" => "Modal: quick action, doesn't need history/bookmark. New page: complex task, shareable, needs back button."],
  ["q" => "How many questions in a user survey?", "a" => "5–7 max. More than 10 and completion rate drops below 40%."],
  ["q" => "Ideal line length for body copy?",     "a" => "65–75 characters. Below 45 feels choppy. Above 85 loses the line on return."],
  ["q" => "How many A/B variants to test?",       "a" => "2. Maximum 3. More than that and you don't have enough traffic to reach significance."],
  ["q" => "What's a good NPS score for apps?",    "a" => "Above 30 is good. Above 50 is excellent. Below 0 means you have serious work to do."],
  ["q" => "How long should onboarding take?",     "a" => "Under 3 minutes to first value. Every step beyond that loses ~15% of users."],
  ["q" => "Empty state: what goes there?",        "a" => "The next best action + why it matters + an example of what it looks like when filled."],
  ["q" => "Error message formula?",              "a" => "What happened + Why (if useful) + What to do next. Never blame the user."],
];