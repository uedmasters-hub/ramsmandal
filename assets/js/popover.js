/* =========================================
   POPOVER.JS — Chip expertise panels
   ========================================= */

(function () {
  "use strict";

  /* ── DATA ──────────────────────────────── */

  const chips = {

    "ux-systems": {
      label:   "UX SYSTEMS",
      tagline: "Design at scale, not at random.",
      summary: "UX Systems are the nervous system of any great product. I architect design languages, component libraries, and interaction patterns that let teams ship consistently — without starting from scratch every time.",
      what:    "A UX System is the single source of truth for how a product looks, feels, and behaves. It connects design tokens to code, patterns to principles, and decisions to documentation.",
      pillars: [
        { icon: "◎", title: "Design Tokens",       desc: "Color, spacing, typography, and motion — defined once, applied everywhere." },
        { icon: "⬡", title: "Component Library",   desc: "Reusable, accessible, documented UI components that scale across products." },
        { icon: "⟳", title: "Interaction Patterns", desc: "Shared mental models for navigation, feedback, loading, and error states." },
        { icon: "▦", title: "Governance Model",     desc: "Processes for contribution, versioning, and adoption across teams." },
      ],
      impact: [
        { value: "40%", label: "Faster delivery across teams" },
        { value: "3×",  label: "Design-to-dev handoff speed" },
        { value: "10+", label: "Products on one system" },
      ],
      example: "At IndiGo, I led creation of a unified design system used across the booking flow, crew app, and staff portal — reducing UI inconsistencies by 60% and cutting design review cycles in half.",
    },

    "product-strategy": {
      label:   "PRODUCT STRATEGY",
      tagline: "Vision without execution is hallucination.",
      summary: "I translate ambiguous business goals into clear product directions — defining what to build, why it matters, and how to measure success. Strategy without design thinking is just a slide deck.",
      what:    "Product Strategy is the art of making intentional bets. Understanding users deeply, reading market signals, and sequencing decisions so every feature earns its place.",
      pillars: [
        { icon: "◉", title: "Opportunity Mapping",    desc: "Identifying where user pain and business value intersect." },
        { icon: "⬟", title: "Roadmap Architecture",   desc: "Sequencing initiatives by impact, feasibility, and strategic fit." },
        { icon: "◈", title: "Metrics Definition",     desc: "Defining leading indicators that tell you if the strategy is working." },
        { icon: "⟡", title: "Stakeholder Alignment",  desc: "Building shared understanding across design, product, and business." },
      ],
      impact: [
        { value: "22%", label: "NPS improvement at IndiGo" },
        { value: "22%", label: "Ancillary revenue growth" },
        { value: "30%", label: "Reduction in support queries" },
      ],
      example: "I redefined IndiGo's ancillary product strategy by mapping the full booking journey, identifying 7 high-value intervention points, and shipping a 6-month roadmap that drove 22% revenue uplift.",
    },

    "design-infrastructure": {
      label:   "DESIGN INFRASTRUCTURE",
      tagline: "The foundation nobody sees, until it's missing.",
      summary: "Design Infrastructure is the scaffolding that makes design work sustainable. Tooling, workflows, documentation, handoff protocols — the invisible systems that let designers focus on designing.",
      what:    "Great products are built on great infrastructure. I establish the processes, tools, and environments that allow design teams to operate at speed without sacrificing quality.",
      pillars: [
        { icon: "⬡", title: "Figma Architecture",    desc: "Structured file systems, libraries, and variables that scale with the team." },
        { icon: "◎", title: "Handoff Protocols",     desc: "Annotated specs, design tokens, and developer-ready assets." },
        { icon: "▦", title: "Design Ops",            desc: "Rituals, reviews, and tooling that keep quality high and velocity fast." },
        { icon: "⟳", title: "Documentation Systems", desc: "Living docs that capture decisions, patterns, and principles." },
      ],
      impact: [
        { value: "40%", label: "Delivery velocity increase" },
        { value: "15+", label: "Designers onboarded to system" },
        { value: "60%", label: "Reduction in design debt" },
      ],
      example: "I rebuilt design infrastructure at IndiGo from scattered Sketch files to a structured Figma ecosystem — shared libraries, versioned components, and handoff standards adopted by a 15-person team.",
    },

    "ai-enabled-workflows": {
      label:   "AI-ENABLED WORKFLOWS",
      tagline: "AI amplifies great designers. It replaces average ones.",
      summary: "I integrate AI tools — Claude, Gemini, Figma AI — into design workflows to accelerate research synthesis, generate design variants, and automate repetitive production tasks.",
      what:    "AI-enabled workflows aren't about replacing creativity. They remove friction so designers spend more time on what only humans can do: judgment, empathy, and storytelling.",
      pillars: [
        { icon: "◉", title: "Research Synthesis",   desc: "Using AI to cluster insights, surface patterns, and generate hypotheses from raw data." },
        { icon: "⟡", title: "Rapid Prototyping",    desc: "Figma AI and Claude for fast concept generation and design exploration." },
        { icon: "◈", title: "Content Generation",   desc: "AI-assisted UX copy, microcopy variants, and localisation at scale." },
        { icon: "⬟", title: "Workflow Automation",  desc: "Automating handoff, annotation, and documentation with AI tooling." },
      ],
      impact: [
        { value: "3×",  label: "Faster research synthesis" },
        { value: "50%", label: "Reduction in prototype iteration time" },
        { value: "10+", label: "AI tools integrated into workflow" },
      ],
      example: "I introduced AI-augmented design sprints at Intelegencia — using Claude for rapid UX audit analysis and Figma AI for variant generation — cutting concept-to-prototype time from 5 days to under 2.",
    },

  };

  /* ── METRICS DATA ─────────────────────── */

  const metrics = {

    "operational-impact": {
      label:   "OPERATIONAL IMPACT",
      value:   "30%",
      tagline: "Operations that move faster, break less.",
      summary: "Operational impact measures how design decisions reduce friction inside the business — fewer errors, faster workflows, less rework. Good UX isn't just customer-facing; it runs the machine.",
      what:    "I redesigned internal operational systems at IndiGo to reduce crew scheduling errors, improve staff travel booking, and streamline cross-functional workflows — all directly measurable in ops metrics.",
      pillars: [
        { icon: "⬡", title: "Process Redesign",      desc: "Mapping and eliminating friction in internal operational workflows." },
        { icon: "◎", title: "Error Reduction",        desc: "UI patterns that prevent mistakes before they happen." },
        { icon: "⟳", title: "Workflow Automation",    desc: "Removing manual steps through smarter system design." },
        { icon: "▦", title: "Cross-team Efficiency",  desc: "Shared tools that align operations across departments." },
      ],
      impact: [
        { value: "30%",  label: "Operational friction reduced" },
        { value: "18%",  label: "Scheduling errors eliminated" },
        { value: "25%",  label: "Crew satisfaction increase" },
      ],
      example: "The CrewPal redesign introduced real-time shift visibility and proactive fatigue alerts — reducing scheduling errors by 18% and boosting crew satisfaction scores by 25% within two quarters.",
    },

    "customer-experience": {
      label:   "CUSTOMER EXPERIENCE",
      value:   "22%",
      tagline: "Every touchpoint is a promise kept or broken.",
      summary: "Customer experience is the sum of every interaction a user has with a product. I design the moments that matter — from first impression to loyal repeat user — with intentionality at every step.",
      what:    "CX improvement means measuring what users feel, not just what they do. NPS, CSAT, support volume, and retention are the signals. I use research, journey mapping, and iterative testing to move them.",
      pillars: [
        { icon: "◉", title: "Journey Mapping",        desc: "Visualising the full user experience across every touchpoint." },
        { icon: "⟡", title: "Friction Elimination",   desc: "Identifying and removing the moments that cause drop-off or frustration." },
        { icon: "◈", title: "NPS Optimisation",       desc: "Designing for the moments that turn users into promoters." },
        { icon: "⬟", title: "Personalisation",        desc: "Tailoring experiences to user context, history, and preference." },
      ],
      impact: [
        { value: "22%", label: "NPS improvement at IndiGo" },
        { value: "30%", label: "Reduction in support queries" },
        { value: "50M+", label: "Users across redesigned flows" },
      ],
      example: "A full redesign of IndiGo's Staff Leisure Travel App — from research through to shipping — improved NPS by 22% and was featured in the company's annual customer experience report.",
    },

    "revenue-growth": {
      label:   "REVENUE GROWTH",
      value:   "22%",
      tagline: "Design that earns its place on the P&L.",
      summary: "Revenue growth through design isn't accidental. It comes from understanding user intent, reducing abandonment, and presenting the right offer at the right moment — with clarity, not manipulation.",
      what:    "I approach revenue as a UX problem: what's stopping users from converting? I use data, heuristic analysis, and A/B testing to identify and fix the moments where money is left on the table.",
      pillars: [
        { icon: "◎", title: "Conversion Optimisation", desc: "Reducing drop-off at every step of the booking or purchase funnel." },
        { icon: "▦", title: "Ancillary Revenue",       desc: "Designing add-on experiences that feel helpful, not pushy." },
        { icon: "◉", title: "Pricing Clarity",         desc: "Transparent, scannable pricing that builds trust and drives action." },
        { icon: "⬡", title: "A/B Testing Culture",     desc: "Building a team habit of hypothesis-driven design iteration." },
      ],
      impact: [
        { value: "22%", label: "Ancillary revenue growth" },
        { value: "1",   label: "IndiGo Innovation Award 2023" },
        { value: "6E",  label: "Super Sale conversion leader" },
      ],
      example: "By redesigning the IndiGo Holidays marketplace with personalised hotel bundles and contextual upsell moments, I drove a 22% increase in ancillary revenue — winning the 2023 Innovation Award.",
    },

    "delivery-velocity": {
      label:   "DELIVERY VELOCITY",
      value:   "40%",
      tagline: "Speed is a design problem, not just an engineering one.",
      summary: "Delivery velocity measures how fast a team can go from idea to production without sacrificing quality. I architect the systems, processes, and tooling that remove bottlenecks from the design-to-ship pipeline.",
      what:    "Slow delivery is usually a design problem: unclear specs, inconsistent components, late-stage rework, and poor handoff. I fix these with systems thinking — not by working faster, but by removing the waste.",
      pillars: [
        { icon: "⟳", title: "Design Systems",         desc: "Pre-built, documented components that eliminate redundant design work." },
        { icon: "⬟", title: "Handoff Automation",     desc: "Annotated specs and tokens that developers can implement without back-and-forth." },
        { icon: "◈", title: "Sprint Rituals",         desc: "Lean design sprints that compress discovery-to-decision time." },
        { icon: "⟡", title: "AI-Assisted Workflows",  desc: "Using Claude and Figma AI to accelerate ideation and documentation." },
      ],
      impact: [
        { value: "40%", label: "Faster design-to-ship cycle" },
        { value: "3×",  label: "Handoff speed improvement" },
        { value: "2d",  label: "Prototype time (down from 5 days)" },
      ],
      example: "By establishing a shared design system and AI-augmented sprint process at Intelegencia, I reduced the average design-to-handoff cycle by 40% across a 6-person cross-functional team.",
    },

  };

  /* ── COMPONENTS DATA ──────────────────── */

  const components = {
    "booking-flow":    { label:"BOOKING FLOW",         value:"22%",  tagline:"Zero friction, maximum conversion.", summary:"Redesigned IndiGo's end-to-end booking funnel — seat selection, ancillary upsell, payment — reducing drop-off by 18% and driving 22% ancillary revenue growth.", what:"A booking flow is where intention becomes transaction. Every extra tap costs money. I mapped 47 friction points across the funnel and systematically eliminated them.", pillars:[{icon:"◎",title:"Funnel Analysis",desc:"Heatmaps, session recordings, and drop-off mapping across every step."},{icon:"⬡",title:"Progressive Disclosure",desc:"Showing only what users need at each step — no cognitive overload."},{icon:"⟳",title:"Payment Optimisation",desc:"JusPay integration reducing payment failures by 14%."},{icon:"▦",title:"Ancillary Design",desc:"Contextual upsell moments that feel helpful, not pushy."}], impact:[{value:"22%",label:"Ancillary revenue growth"},{value:"18%",label:"Drop-off reduction"},{value:"50M+",label:"Users annually"}], example:"The Super 6E Sale redesign won the IndiGo Innovation Award 2023 for highest conversion growth — a result of 6 weeks of research, prototyping, and iterative A/B testing." },
    "design-system":   { label:"DESIGN SYSTEM",         value:"40%",  tagline:"One system. Ten products. Zero inconsistency.", summary:"Built a scalable design system from scratch — tokens, components, patterns — used across IndiGo's booking flow, crew app, staff portal, and loyalty platform.", what:"A design system is leverage. Every hour invested in a reusable component saves 10 hours of repeated work. I architected a system that became the single source of truth for a 15-person design team.", pillars:[{icon:"◎",title:"Token Architecture",desc:"Color, spacing, typography, and motion defined once in Figma variables."},{icon:"⬡",title:"Component Library",desc:"200+ documented, tested, accessible components."},{icon:"⟳",title:"Contribution Model",desc:"Clear governance so any designer can propose and ship new components."},{icon:"▦",title:"Dev Handoff System",desc:"Auto-annotated specs and design tokens exported to code."}], impact:[{value:"40%",label:"Faster delivery"},{value:"200+",label:"Components shipped"},{value:"10+",label:"Products using system"}], example:"After 3 months of system-building, new feature design went from 2 weeks to 4 days. The system is now the foundation for every new IndiGo digital product." },
    "music-player":    { label:"INTERACTION DESIGN",    value:"4.9",  tagline:"Delight lives in the details.", summary:"A deep-dive into micro-interaction design — how progress bars, transitions, and haptic feedback combine to create interfaces that feel alive.", what:"Micro-interactions are the moments between actions. The animation when a song loads, the way a progress bar scrubs — these details separate good from great.", pillars:[{icon:"◉",title:"Motion Language",desc:"Consistent easing curves and durations across every interaction."},{icon:"⟡",title:"Haptic Feedback",desc:"Vibration patterns mapped to meaningful moments."},{icon:"◈",title:"Progress Feedback",desc:"Visual states for loading, playing, buffering, and error."},{icon:"⬟",title:"Gesture Design",desc:"Swipe, scrub, long-press — each mapped to the right action."}], impact:[{value:"4.9",label:"User satisfaction"},{value:"38%",label:"Engagement increase"},{value:"14",label:"Iterations to perfect"}], example:"A prototype of the scrubber interaction alone went through 14 iterations before achieving the right feel — spring physics tuned to match the mental model of physical tape." },
    "rating-system":   { label:"UX PATTERN",            value:"4.4",  tagline:"Trust is a design problem.", summary:"Designed a review system that surfaces credible social proof — balancing recency, volume, and sentiment to help users make confident decisions.", what:"A rating UI is a trust interface. Users scan ratings in milliseconds. The visual weight of the star, the distribution chart — each element either builds or erodes confidence.", pillars:[{icon:"◎",title:"Visual Hierarchy",desc:"Large rating number, distribution chart, and review count in one glance."},{icon:"▦",title:"Review Filtering",desc:"Surfacing the most helpful reviews, not just the most recent."},{icon:"⬡",title:"Sentiment Design",desc:"Color and iconography that communicate quality without words."},{icon:"⟳",title:"Trust Signals",desc:"Verified badges, photo counts, and response rates."}], impact:[{value:"31%",label:"Conversion lift with reviews"},{value:"4.4",label:"Average displayed rating"},{value:"56",label:"Reviews shown per product"}], example:"A/B testing showed that showing the rating distribution chart (not just the average) increased conversion by 31% — users trusted a 4.4 with visible distribution more than a 4.8 without." },
    "profile-card":    { label:"SOCIAL UX",             value:"423",  tagline:"Identity is the product.", summary:"Designed a user profile system that communicates expertise, builds credibility, and drives meaningful connections — for a marketplace serving 30M+ users.", what:"A profile is a first impression at scale. In a marketplace, your profile either earns trust or loses the sale. I designed a system that surfaces the right signals without visual noise.", pillars:[{icon:"◉",title:"Identity Architecture",desc:"Avatar, name, title, and verification — the trust quartet."},{icon:"⟡",title:"Social Proof Layer",desc:"Followers, activity, and endorsements surfaced contextually."},{icon:"◈",title:"Action Hierarchy",desc:"Follow, message, and share — sequenced by frequency of use."},{icon:"⬟",title:"Completeness Model",desc:"Progressive profile completion that rewards thoroughness."}], impact:[{value:"423",label:"Avg follower count"},{value:"18%",label:"Connection rate increase"},{value:"30M+",label:"Users on platform"}], example:"The redesigned profile drove an 18% increase in connection rates at Quikr — by surfacing 3 key trust signals above the fold that were previously buried." },
    "crewpal":         { label:"ENTERPRISE APP",        value:"25%",  tagline:"Complex ops, simple interface.", summary:"Redesigned the operational app used by 8,000+ IndiGo cabin crew — shift management, fatigue alerts, and duty tracking — reducing scheduling errors by 18%.", what:"Operational UX is high-stakes design. A crew member checking duty at 4am needs information instantly, with zero ambiguity. Failure means flights delayed, compliance breached.", pillars:[{icon:"◎",title:"Information Architecture",desc:"Restructuring 14 screens into 4 core views."},{icon:"⬡",title:"Alert Design",desc:"Fatigue warnings surfaced proactively, not reactively."},{icon:"⟳",title:"Offline-First",desc:"Core functions available without network connectivity."},{icon:"▦",title:"Compliance UX",desc:"Duty time regulations built into the interface flow."}], impact:[{value:"25%",label:"Crew satisfaction increase"},{value:"18%",label:"Scheduling errors reduced"},{value:"8K+",label:"Crew members served"}], example:"Post-launch, monthly scheduling error rate dropped from 340 to 278 incidents — directly attributable to the new fatigue alert system and restructured duty view." },
    "nft-marketplace": { label:"MARKETPLACE DESIGN",    value:"30M+", tagline:"Scale changes everything.", summary:"Designed the core browsing, listing, and transactional experience for Quikr — India's second-largest classifieds platform at time of design.", what:"At 30M users, every design decision is a policy. A button label change affects millions of interactions daily. I learned to design with data as the co-designer.", pillars:[{icon:"◉",title:"Browse Architecture",desc:"Category navigation designed for low-literacy, low-bandwidth users."},{icon:"⬟",title:"Listing Optimisation",desc:"Reducing listing creation time from 8 minutes to 3."},{icon:"◈",title:"Chat-First Commerce",desc:"Integrating IVR and chat as primary negotiation channels."},{icon:"⟡",title:"Trust Infrastructure",desc:"Verification badges, response rates, and listing age signals."}], impact:[{value:"30M+",label:"Monthly active users"},{value:"18%",label:"Support response improvement"},{value:"20%",label:"Email CTR for campaigns"}], example:"A redesign of the listing creation flow — from 11 steps to 6 — reduced abandonment by 34% and was rolled out to all 30M users within one sprint cycle." },
    "bold-cta":        { label:"CTA DESIGN",            value:"20%",  tagline:"The right words at the right moment.", summary:"Directed 50+ performance campaigns across email, social, and in-app — combining visual hierarchy, copy strategy, and A/B testing to consistently outperform baseline CTR.", what:"A CTA is the smallest design with the biggest business impact. The word choice, the color, the position — each variable affects whether someone acts or scrolls past.", pillars:[{icon:"◎",title:"Copy Strategy",desc:"Action-first microcopy that reduces decision friction."},{icon:"▦",title:"Visual Hierarchy",desc:"Contrast, size, and position working together for attention."},{icon:"⟳",title:"A/B Test Culture",desc:"Every CTA has a hypothesis and a measurement plan."},{icon:"◉",title:"Contextual Timing",desc:"Serving the right offer at the right point in the journey."}], impact:[{value:"20%",label:"CTR improvement"},{value:"50+",label:"Campaigns directed"},{value:"3",label:"Client verticals served"}], example:"A single CTA copy change — from 'Book Now' to 'Secure Your Seat' — increased booking completion by 8% on the IndiGo mobile app. Small words, large revenue impact." },
    "card-design":     { label:"CARD SYSTEMS",          value:"200+", tagline:"Cards are containers for decisions.", summary:"Designed a flexible card system that works across 10+ product contexts — maintaining consistency while allowing contextual variation.", what:"A card is the most common UI pattern, and the most abused. I developed a card system with clear rules — and documented when to break each rule.", pillars:[{icon:"⬡",title:"Content Hierarchy",desc:"Every card has a clear primary, secondary, and tertiary element."},{icon:"◎",title:"Interaction States",desc:"Default, hover, active, loading, and error — all designed."},{icon:"▦",title:"Density Variants",desc:"Compact, standard, and expanded versions for different contexts."},{icon:"⟳",title:"Responsive Scaling",desc:"Cards that reflow gracefully from 320px to 1440px."}], impact:[{value:"200+",label:"Components in system"},{value:"10+",label:"Product contexts"},{value:"60%",label:"Design debt reduced"}], example:"The unified card system replaced 23 different card variants across IndiGo's products — cutting new feature design time by an average of 2 days per sprint." },
    "user-persona":    { label:"USER RESEARCH",         value:"500+", tagline:"Empathy is the foundation of every decision.", summary:"Conducted and synthesised research with 500+ users across aviation, e-commerce, and SaaS contexts — turning raw insight into personas, journeys, and design principles.", what:"Research without synthesis is noise. I developed a research practice that converts user interviews, usability tests, and analytics into actionable design direction — fast.", pillars:[{icon:"◉",title:"Mixed Methods",desc:"Combining qualitative interviews with quantitative funnel data."},{icon:"⟡",title:"Persona Systems",desc:"Archetypes built from real data, not assumptions."},{icon:"◈",title:"Journey Mapping",desc:"End-to-end maps that reveal moments of delight and friction."},{icon:"⬟",title:"Insight Synthesis",desc:"Converting hours of research into a one-page design brief."}], impact:[{value:"500+",label:"Users interviewed"},{value:"12",label:"Journey maps created"},{value:"40%",label:"Research-to-decision time cut"}], example:"A 6-week research sprint with 80 IndiGo customers revealed that 73% of support queries were caused by 3 UI patterns — fixing them reduced support volume by 30%." },
    "weather-widget":  { label:"WIDGET DESIGN",         value:"27",   tagline:"Data without design is just noise.", summary:"Designed a system of information widgets — weather, flight status, loyalty points — that surface the right data at the right moment.", what:"Widgets are the intersection of data and attention. They must communicate one thing instantly, then get out of the way. I designed 27 widget variants across IndiGo's ecosystem.", pillars:[{icon:"◎",title:"At-a-Glance Design",desc:"Primary information readable in under 2 seconds."},{icon:"⬡",title:"Data Hierarchy",desc:"What to show, what to hide, and what to surface on tap."},{icon:"⟳",title:"Refresh Logic",desc:"When and how widgets update without disrupting the user."},{icon:"▦",title:"Empty States",desc:"Widgets that are useful even when there's no data yet."}], impact:[{value:"27",label:"Widget variants"},{value:"4.7",label:"App store rating maintained"},{value:"3.2M",label:"Daily flight status views"}], example:"The flight status widget — gate, delay, and boarding time in one card — became the most-used screen in the IndiGo app, with 3.2M daily views at peak." },
    "payment-ui":      { label:"FINTECH UX",            value:"14%",  tagline:"Trust at the moment of truth.", summary:"Redesigned the payment experience across IndiGo's booking flow — collaborating with JusPay to automate refund workflows and reduce payment failure rates by 14%.", what:"Payment UX is trust UX. At the moment a user enters their card details, they are at maximum anxiety. Every element must communicate security, speed, and clarity.", pillars:[{icon:"◉",title:"Trust Signals",desc:"Security badges, SSL indicators, and bank logos at the right moments."},{icon:"⬟",title:"Error Recovery",desc:"Clear, actionable error messages that don't blame the user."},{icon:"◈",title:"Method Optimisation",desc:"Surfacing the most likely payment method first."},{icon:"⟡",title:"Refund Automation",desc:"JusPay integration reducing refund resolution time by 20%."}], impact:[{value:"14%",label:"Payment failures reduced"},{value:"20%",label:"Refund resolution faster"},{value:"₹12Cr",label:"Revenue recovered annually"}], example:"By surfacing saved payment methods above the fold and redesigning the OTP input, we reduced payment abandonment by 14% — recovering an estimated ₹12Cr in annual revenue." },
  };

  /* ── DOM REFS ──────────────────────────── */

  const overlay = document.querySelector(".chip-overlay");
  const panel   = document.querySelector(".chip-panel");
  const closeBtn = document.querySelector(".chip-panel__close");
  const labelEl  = document.querySelector(".chip-panel__label");
  const bodyEl   = document.querySelector(".chip-panel__body");

  if (!overlay || !panel) return;

  /* ── RENDER ────────────────────────────── */

  function render(id, type) {
    const d = type === "metric" ? metrics[id] : type === "component" ? components[id] : chips[id];
    if (!d) return;

    labelEl.textContent = d.label;

    bodyEl.innerHTML = `

      <div class="cp-hero">
        <p class="cp-hero__tagline">${d.tagline}</p>
        <p class="cp-hero__summary">${d.summary}</p>
      </div>

      <div class="cp-section">
        <p class="cp-section-label">What it means</p>
        <p class="cp-what__text">${d.what}</p>
      </div>

      <div class="cp-section">
        <p class="cp-section-label">Four pillars</p>
        <div class="cp-pillars__grid">
          ${d.pillars.map(p => `
            <div class="cp-pillar">
              <span class="cp-pillar__icon">${p.icon}</span>
              <strong class="cp-pillar__title">${p.title}</strong>
              <p class="cp-pillar__desc">${p.desc}</p>
            </div>
          `).join("")}
        </div>
      </div>

      <div class="cp-section">
        <p class="cp-section-label">Measurable impact</p>
        <div class="cp-impact__grid">
          ${d.impact.map(s => `
            <div class="cp-impact__stat">
              <span class="cp-impact__value">${s.value}</span>
              <span class="cp-impact__label">${s.label}</span>
            </div>
          `).join("")}
        </div>
      </div>

      <div class="cp-section">
        <p class="cp-section-label">Real-world example</p>
        <blockquote class="cp-example__quote">${d.example}</blockquote>
      </div>

      <div class="cp-cta">
        <a href="/portfolio/contact.php" class="cp-cta__btn cp-cta__btn--primary">
          Let's work together
        </a>
        <a href="/portfolio/case-study/" class="cp-cta__btn cp-cta__btn--ghost">
          View case studies
        </a>
      </div>

    `;
  }

  /* ── OPEN ──────────────────────────────── */

  function open(id, type) {
    render(id, type || "chip");
    panel.scrollTop = 0;
    overlay.classList.add("is-open");
    panel.classList.add("is-open");
    document.body.classList.add("panel-open");
    closeBtn.focus();
  }

  /* ── CLOSE ─────────────────────────────── */

  function close() {
    overlay.classList.remove("is-open");
    panel.classList.remove("is-open");
    document.body.classList.remove("panel-open");
  }

  /* ── CHIP CLICK ────────────────────────── */

  document.querySelectorAll(".chip[data-chip]").forEach(function (chip) {
    chip.addEventListener("click", function () {
      open(this.dataset.chip, "chip");
    });
    chip.style.cursor = "pointer";
  });

  /* ── METRIC CLICK ───────────────────────── */

  document.querySelectorAll(".transform-metric[data-metric]").forEach(function (el) {
    el.addEventListener("click", function () {
      open(this.dataset.metric, "metric");
    });
  });

  /* ── BENTO CARD CLICK ───────────────────── */

  document.querySelectorAll(".bento-card[data-metric]").forEach(function (el) {
    el.addEventListener("click", function () {
      open(this.dataset.metric, "component");
    });
  });

  /* ── CLOSE TRIGGERS ────────────────────── */

  closeBtn.addEventListener("click", close);
  overlay.addEventListener("click", close);

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") close();
  });

})();