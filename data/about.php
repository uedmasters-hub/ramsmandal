<?php
/* =========================================
   DATA / ABOUT.PHP
   ========================================= */

$about = [

  "name"     => "Ramesh Mandal",
  "title"    => "UX Leader driving AI-enabled product strategy at scale",
  "summary"  => [
    "I design clarity into complex systems — and then I measure whether it worked.",
    "With 17+ years across aviation, SaaS, and enterprise platforms, I've evolved from UI craft to UX strategy — leading high-scale products serving tens of millions of users.",
    "Today, I integrate design systems, product thinking, and AI-driven workflows to accelerate decision-making, improve usability, and deliver measurable business impact.",
  ],
  "email"    => "ramsmandal@icloud.com",
  "phone"    => "+91 9538000060",
  "location" => "Gurugram, India · Remote & Hybrid",
  "linkedin" => "https://in.linkedin.com/in/ramsmandal",

  "stats" => [
    ["value" => "17+", "label" => "Years of Experience"],
    ["value" => "50M+","label" => "Users Served"],
    ["value" => "10+", "label" => "Enterprise Products"],
    ["value" => "15+", "label" => "Designers Led"],
  ],

  "competencies" => [
    [
      "area"   => "Leadership & Strategy",
      "skills" => ["UX Strategy & Vision", "Cross-functional Leadership", "Product Roadmapping", "Stakeholder Alignment"],
    ],
    [
      "area"   => "Experience Design",
      "skills" => ["Interaction Design", "Information Architecture", "Design Systems & Scalability", "Accessibility & Usability"],
    ],
    [
      "area"   => "CX & Growth",
      "skills" => ["Conversion Optimisation", "Personalisation & Journey Design", "User Research & Validation", "NPS Improvement"],
    ],
    [
      "area"   => "AI & Innovation",
      "skills" => ["AI-Augmented Design Workflows", "Rapid Prototyping", "Figma AI · Claude · Gemini", "Design Automation"],
    ],
  ],

  "tools"  => ["Figma", "Adobe Suite", "Mixpanel", "Hotjar", "Jira", "Claude AI", "Gemini", "Figma AI"],

  "education" => [
    [
      "degree"  => "Master of Fine Arts (Design)",
      "school"  => "Chaudhary Charan Singh University",
      "year"    => "2010 – 2012",
    ],
    [
      "degree"  => "Google UX Design Certificate",
      "school"  => "Google · Data-Driven Design, Accessibility",
      "year"    => "2021",
    ],
    [
      "degree"  => "UI/UX Design Specialisation",
      "school"  => "CalArts · Agile, Design Thinking",
      "year"    => "2020",
    ],
  ],

  "awards" => [
    [
      "title" => "IndiGo Innovation Award",
      "year"  => "2023",
      "desc"  => "Super 6E Sale conversion growth — highest in company history.",
    ],
    [
      "title" => "Featured in Company Report",
      "year"  => "2024",
      "desc"  => "NPS improvements in Staff Leisure Travel App.",
    ],
  ],

  "principles" => [
    [
      "number" => "01",
      "title"  => "Clarity before aesthetics",
      "desc"   => "A beautiful interface that confuses is a failed interface. I design for understanding first — every visual decision must earn its place by reducing cognitive load.",
    ],
    [
      "number" => "02",
      "title"  => "Systems over screens",
      "desc"   => "Individual screens are symptoms. I design systems — the patterns, components, and principles that make every future screen consistent and faster to build.",
    ],
    [
      "number" => "03",
      "title"  => "Data as co-designer",
      "desc"   => "Intuition opens the door. Data decides. Every design decision I ship has a hypothesis, a metric, and a plan to measure whether it worked.",
    ],
    [
      "number" => "04",
      "title"  => "AI amplifies, not replaces",
      "desc"   => "I use Claude, Gemini, and Figma AI to remove friction from the creative process — faster synthesis, faster prototyping — so human judgment gets more time.",
    ],
  ],

];


/* ── LEADERSHIP PHILOSOPHY ── */
$leadershipBeliefs = [
  [
    "belief"   => "Design decisions are business decisions.",
    "expand"   => "Every pixel has a cost and a return. I ask 'what does this move on the P&L?' before I ask 'does this look right?' That framing changes how design gets prioritised.",
  ],
  [
    "belief"   => "The best design review is a user session.",
    "expand"   => "Opinions in a meeting room are opinions. 20 minutes of a real user struggling with your prototype is data. I run user sessions before design reviews, not after.",
  ],
  [
    "belief"   => "Systems thinking beats screen thinking.",
    "expand"   => "Junior designers fix screens. Senior designers fix systems. I ask where the pattern breaks before I ask how to fix this instance.",
  ],
  [
    "belief"   => "Clarity is a leadership skill.",
    "expand"   => "The most valuable thing I bring to a cross-functional team is the ability to translate between user reality, design intent, and engineering feasibility — in real time, without losing anyone.",
  ],
  [
    "belief"   => "Ship, measure, iterate. In that order.",
    "expand"   => "Perfect is a failure mode. Shipping imperfect work with a measurement plan beats shipping nothing while waiting for certainty.",
  ],
  [
    "belief"   => "AI is a tool, not a threat.",
    "expand"   => "I've integrated AI into every part of my workflow — research synthesis, copy variants, prototype generation. Designers who use AI will replace designers who don't.",
  ],
];

/* ── SIGNATURE MOMENTS ── */
$signatureMoments = [
  [
    "year"     => "2023",
    "company"  => "IndiGo Airlines",
    "title"    => "The booking flow that won an award",
    "desc"     => "Redesigned the entire IndiGo booking funnel — seat selection, ancillary upsell, payment — across 18 months. The Super 6E Sale version became the highest-converting sale event in company history.",
    "metrics"  => ["22% revenue uplift", "18% drop-off reduction", "₹ crores recovered"],
    "award"    => "IndiGo Innovation Award 2023",
    "href"     => "/case-study/indigo-booking.php",
    "color"    => "blue",
  ],
  [
    "year"     => "2022",
    "company"  => "IndiGo Airlines",
    "title"    => "The operational app crew actually use",
    "desc"     => "Rebuilt CrewPal from 14 confusing screens to 4 clear views. Crew had been screenshotting schedules and sharing on WhatsApp for 2 years. After the redesign — that workaround disappeared.",
    "metrics"  => ["47s → 8s task time", "25% satisfaction up", "8,000+ crew served"],
    "award"    => null,
    "href"     => "/case-study/crewpal.php",
    "color"    => "dark",
  ],
  [
    "year"     => "2021–24",
    "company"  => "IndiGo Airlines",
    "title"    => "One design system. Ten products.",
    "desc"     => "Built the design system that became the single source of truth for a 15-person team across 10+ products. New feature design time went from 2 weeks to 4 days. Still in use today.",
    "metrics"  => ["40% faster delivery", "200+ components", "60% design debt cleared"],
    "award"    => null,
    "href"     => "/case-study/design-system.php",
    "color"    => "light",
  ],
];

/* ── SELECTED TESTIMONIALS (2 for about page) ── */
$aboutTestimonials = [
  [
    "quote"   => "Ramesh has a rare ability to translate complex business requirements into elegant, scalable UX systems. His work on the IndiGo booking ecosystem directly contributed to a measurable NPS improvement.",
    "name"    => "Priya Sharma",
    "role"    => "VP Product",
    "company" => "IndiGo Airlines",
    "avatar"  => "PS",
  ],
  [
    "quote"   => "Working with Ramesh transformed how our design team operates. He didn't just redesign screens — he redesigned our entire process. Delivery velocity went up 40% within two quarters.",
    "name"    => "Arjun Mehta",
    "role"    => "Head of Engineering",
    "company" => "Intelegencia",
    "avatar"  => "AM",
  ],
];


/* ── FAQ ── */
$faq = [

  [
    "q" => "You've spent 7 years at IndiGo. Can you adapt to a different industry or culture?",
    "a" => "Seven years is long — I'll be direct about that. But IndiGo isn't one product; it's 15+ different products across booking, operations, loyalty, and enterprise tools, each with its own user base, constraints, and politics. I've worked with product managers from IITs, engineers with zero design appreciation, and C-suite stakeholders who measure everything in rupees. The industry is aviation. The work is scaling digital systems under pressure — and that transfers. I've also been consulting at Intelegencia across US, UK, and Middle East markets since 2025, specifically to stress-test my adaptability. So far, the patterns translate.",
  ],

  [
    "q" => "Are you a designer or a design manager? The portfolio shows both.",
    "a" => "Both — and I think that's a feature, not a confusion. I lead teams, but I still get into Figma. I run design reviews, but I also run user sessions myself. At IndiGo I led 15+ designers while remaining the design decision-maker on the most critical flows. I've seen leaders who 'went management' and lost their craft instinct — they make bad calls because they've forgotten what it feels like to struggle with a layout. I haven't. What I offer is strategic leadership with practitioner credibility. If you need someone who only manages up and never gets their hands dirty — I'm probably not the right fit.",
  ],

  [
    "q" => "What have you genuinely failed at?",
    "a" => "Two things I'll own publicly. First: I shipped a booking confirmation redesign that tanked NPS by 12 points because I optimised for visual quality without accounting for familiarity loss. 50 million people had automated a specific screen — we moved things, they noticed. We fixed it in 3 weeks, but I should have caught it in research. Second: in my early management years, I protected my team from difficult stakeholder feedback instead of preparing them to handle it. It felt like leadership. It was actually avoidance. The designers who grew fastest were the ones I put in the room, not the ones I shielded. I corrected both — but they're real failures.",
  ],

  [
    "q" => "Why should we hire you over someone with a FAANG or top-tier startup background?",
    "a" => "Honest answer: if you need someone with deep consumer app experience at a company known for design culture, a Swiggy or Razorpay hire probably wins. I haven't worked in that environment. What I have done is shipped UX at genuine scale — 50M+ users — in a company where design wasn't the default language, which means I've had to earn every stakeholder's trust with evidence, not reputation. I've built systems from scratch, convinced engineers to delay a sprint for a UX fix, and turned NPS data into a budget conversation. That's harder to do when everyone already believes in design. If you want someone who can operate in ambiguous, high-stakes environments without a design-first safety net — that's my background.",
  ],

  [
    "q" => "Are you open to individual contributor roles, or only leadership positions?",
    "a" => "Open to both, with clarity on what I bring to each. As an IC, you get senior-level craft with strategic context — I won't just execute briefs, I'll question the brief when it needs questioning. As a leader, you get someone who still designs, which means my feedback in reviews is specific rather than directional. What I'm not well-suited for: pure execution roles where the design decisions are already made and I'm just producing. That's not a seniority issue — it's a boredom and attrition risk for both of us.",
  ],

  [
    "q" => "What's your working style like — what do teams say about you?",
    "a" => "I'll give you the actual feedback patterns rather than a self-assessment. What I hear consistently: direct, sometimes uncomfortably so. Good at cutting through ambiguity quickly. Gets frustrated when process substitutes for thinking. Brings rigour to research that most designers skip. Makes good calls under pressure. Where I get harder to work with: I have low tolerance for decisions made by seniority rather than evidence, and I'll say so. I work best with teams that want to be challenged, not just supported. If the culture rewards deference over debate, there'll be friction.",
  ],

  [
    "q" => "You use AI tools extensively. Does that mean your work is AI-generated?",
    "a" => "No — and the distinction matters. I use Claude for research synthesis: clustering 40 interview transcripts into themes in 40 minutes instead of 4 hours. I use Figma AI for generating layout variants to explore, not to ship. I use AI for first-draft UX copy that I then rewrite. The judgment — which insight matters, which layout works, which copy is honest — is still mine. AI removes the friction from the parts of design that don't require creativity, so creativity gets more time. If you're evaluating whether I'm intellectually lazy: look at the case studies. The thinking in them is mine.",
  ],

  [
    "q" => "You're a UX leader — are you also technical enough to work closely with engineering?",
    "a" => "Yes — and I have the certificate to prove it, though that's not really the point. I'm a certified Full Stack Developer, which means I understand the full stack of constraints engineers are working within: component architecture, state management, API dependencies, performance budgets. In practice this means I don't design things that are expensive to build for no good reason, I can read a pull request and understand what changed, and when an engineer says 'that's technically complex', I know whether they mean genuinely complex or just unfamiliar. Design-engineering friction is one of the biggest delivery bottlenecks I've seen — understanding both sides of the conversation is how I eliminate it.",
  ],

];