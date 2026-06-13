<?php
/* =========================================
   DATA / COMPONENTS.PHP
   ========================================= */

$components = [

  [
    "id"       => "booking-flow",
    "size"     => "tall",        // row 1 col 1 — tall card
    "category" => "CONVERSION SYSTEM",
    "title"    => "Airline Booking Flow",
    "sub"      => "IndiGo · 50M+ users",
    "bg"       => "dark-blue",
    "icon"     => "✈",
    "stat"     => ["value" => "22%", "label" => "Revenue lift"],
    "tagline"  => "Zero friction, maximum conversion.",
    "summary"  => "Redesigned IndiGo's end-to-end booking funnel — seat selection, ancillary upsell, payment — reducing drop-off by 18% and driving 22% ancillary revenue growth.",
    "what"     => "A booking flow is where intention becomes transaction. Every extra tap, every moment of confusion, costs money. I mapped 47 friction points across the funnel and systematically eliminated them.",
    "pillars"  => [
      ["icon" => "◎", "title" => "Funnel Analysis",       "desc" => "Heatmaps, session recordings, and drop-off mapping across every step."],
      ["icon" => "⬡", "title" => "Progressive Disclosure", "desc" => "Showing only what users need at each step — no cognitive overload."],
      ["icon" => "⟳", "title" => "Payment Optimisation",  "desc" => "JusPay integration reducing payment failures by 14%."],
      ["icon" => "▦", "title" => "Ancillary Design",      "desc" => "Contextual upsell moments that feel helpful, not pushy."],
    ],
    "impact"   => [
      ["value" => "22%", "label" => "Ancillary revenue growth"],
      ["value" => "18%", "label" => "Drop-off reduction"],
      ["value" => "50M+", "label" => "Users annually"],
    ],
    "example"  => "The Super 6E Sale redesign alone won the IndiGo Innovation Award 2023 for highest conversion growth — a result of 6 weeks of research, prototyping, and iterative A/B testing.",
  ],

  [
    "id"       => "design-system",
    "size"     => "wide",        // row 1 col 2 — wide card
    "category" => "DESIGN SYSTEM",
    "title"    => "Enterprise Component Library",
    "sub"      => "Figma · 200+ components",
    "bg"       => "light-blue",
    "icon"     => "⬡",
    "stat"     => ["value" => "40%", "label" => "Delivery speed"],
    "tagline"  => "One system. Ten products. Zero inconsistency.",
    "summary"  => "Built a scalable design system from scratch — tokens, components, patterns — used across IndiGo's booking flow, crew app, staff portal, and loyalty platform.",
    "what"     => "A design system is leverage. Every hour invested in a reusable component saves 10 hours of repeated work. I architected a system that became the single source of truth for a 15-person design team.",
    "pillars"  => [
      ["icon" => "◎", "title" => "Token Architecture",   "desc" => "Color, spacing, typography, and motion defined once in Figma variables."],
      ["icon" => "⬡", "title" => "Component Library",    "desc" => "200+ documented, tested, accessible components."],
      ["icon" => "⟳", "title" => "Contribution Model",   "desc" => "Clear governance so any designer can propose and ship new components."],
      ["icon" => "▦", "title" => "Dev Handoff System",   "desc" => "Auto-annotated specs and design tokens exported to code."],
    ],
    "impact"   => [
      ["value" => "40%", "label" => "Faster delivery"],
      ["value" => "200+", "label" => "Components shipped"],
      ["value" => "10+", "label" => "Products using system"],
    ],
    "example"  => "After 3 months of system-building, new feature design went from 2 weeks to 4 days. The system is now the foundation for every new IndiGo digital product.",
  ],

  [
    "id"       => "music-player",
    "size"     => "small",       // row 1 col 3 top
    "category" => "INTERACTION DESIGN",
    "title"    => "Media Player UI",
    "sub"      => "Micro-interaction study",
    "bg"       => "light-blue",
    "icon"     => "▶",
    "stat"     => ["value" => "4.9", "label" => "Satisfaction score"],
    "tagline"  => "Delight lives in the details.",
    "summary"  => "A deep-dive into micro-interaction design — how progress bars, transitions, and haptic feedback combine to create interfaces that feel alive.",
    "what"     => "Micro-interactions are the moments between actions. The animation when a song loads, the way a progress bar scrubs, the bounce when you hit the end. These details separate good from great.",
    "pillars"  => [
      ["icon" => "◉", "title" => "Motion Language",    "desc" => "Consistent easing curves and durations across every interaction."],
      ["icon" => "⟡", "title" => "Haptic Feedback",    "desc" => "Vibration patterns mapped to meaningful moments."],
      ["icon" => "◈", "title" => "Progress Feedback",  "desc" => "Visual states for loading, playing, buffering, and error."],
      ["icon" => "⬟", "title" => "Gesture Design",     "desc" => "Swipe, scrub, long-press — each mapped to the right action."],
    ],
    "impact"   => [
      ["value" => "4.9", "label" => "User satisfaction"],
      ["value" => "38%", "label" => "Engagement increase"],
      ["value" => "12",  "label" => "Micro-interactions designed"],
    ],
    "example"  => "A prototype of the scrubber interaction alone went through 14 iterations before achieving the right feel — spring physics tuned to match the mental model of physical tape.",
  ],

  [
    "id"       => "rating-system",
    "size"     => "small",       // row 1 col 3 bottom
    "category" => "UX PATTERN",
    "title"    => "Rating & Review System",
    "sub"      => "Trust & social proof",
    "bg"       => "light-blue",
    "icon"     => "★",
    "stat"     => ["value" => "4.4", "label" => "Avg rating shown"],
    "tagline"  => "Trust is a design problem.",
    "summary"  => "Designed a review system that surfaces credible social proof — balancing recency, volume, and sentiment to help users make confident decisions.",
    "what"     => "A rating UI is a trust interface. Users scan ratings in milliseconds. The visual weight of the star, the bar chart distribution, the review count — each element either builds or erodes confidence.",
    "pillars"  => [
      ["icon" => "◎", "title" => "Visual Hierarchy",   "desc" => "Large rating number, distribution chart, and review count in one glance."],
      ["icon" => "▦", "title" => "Review Filtering",   "desc" => "Surfacing the most helpful reviews, not the most recent."],
      ["icon" => "⬡", "title" => "Sentiment Design",   "desc" => "Color and iconography that communicate quality without words."],
      ["icon" => "⟳", "title" => "Trust Signals",      "desc" => "Verified badges, photo counts, and response rates."],
    ],
    "impact"   => [
      ["value" => "31%", "label" => "Conversion lift with reviews"],
      ["value" => "4.4", "label" => "Average displayed rating"],
      ["value" => "56",  "label" => "Reviews shown per product"],
    ],
    "example"  => "A/B testing showed that showing the rating distribution chart (not just the average) increased conversion by 31% — users trusted a 4.4 with visible distribution more than a 4.8 without.",
  ],

  [
    "id"       => "profile-card",
    "size"     => "tall-wide",   // row 1 col 4 — tall right card
    "category" => "SOCIAL UX",
    "title"    => "User Profile System",
    "sub"      => "Identity & connection",
    "bg"       => "light-blue",
    "icon"     => "◉",
    "stat"     => ["value" => "423", "label" => "Avg connections"],
    "tagline"  => "Identity is the product.",
    "summary"  => "Designed a user profile system that communicates expertise, builds credibility, and drives meaningful connections — for a marketplace serving 30M+ users.",
    "what"     => "A profile is a first impression at scale. In a marketplace, your profile either earns trust or loses the sale. I designed a system that surfaces the right signals without visual noise.",
    "pillars"  => [
      ["icon" => "◉", "title" => "Identity Architecture", "desc" => "Avatar, name, title, and verification — the trust quartet."],
      ["icon" => "⟡", "title" => "Social Proof Layer",    "desc" => "Followers, activity, and endorsements surfaced contextually."],
      ["icon" => "◈", "title" => "Action Hierarchy",      "desc" => "Follow, message, and share — sequenced by frequency of use."],
      ["icon" => "⬟", "title" => "Completeness Model",    "desc" => "Progressive profile completion that rewards thoroughness."],
    ],
    "impact"   => [
      ["value" => "423", "label" => "Avg follower count"],
      ["value" => "18%", "label" => "Connection rate increase"],
      ["value" => "30M+", "label" => "Users on platform"],
    ],
    "example"  => "The redesigned profile drove an 18% increase in connection rates at Quikr — primarily by surfacing 3 key trust signals above the fold that were previously buried in the profile.",
  ],

  [
    "id"       => "crewpal",
    "size"     => "medium-left", // row 2 col 1 tall
    "category" => "ENTERPRISE APP",
    "title"    => "CrewPal Operations",
    "sub"      => "IndiGo · 8,000+ crew",
    "bg"       => "dark-blue",
    "icon"     => "⟡",
    "stat"     => ["value" => "25%", "label" => "Satisfaction up"],
    "tagline"  => "Complex ops, simple interface.",
    "summary"  => "Redesigned the operational app used by 8,000+ IndiGo cabin crew — shift management, fatigue alerts, and duty tracking — reducing scheduling errors by 18%.",
    "what"     => "Operational UX is high-stakes design. A crew member checking duty assignments at 4am in an airport lounge needs information instantly, with zero ambiguity. Failure means flights delayed, compliance breached.",
    "pillars"  => [
      ["icon" => "◎", "title" => "Information Architecture", "desc" => "Restructuring 14 screens into 4 core views."],
      ["icon" => "⬡", "title" => "Alert Design",            "desc" => "Fatigue warnings surfaced proactively, not reactively."],
      ["icon" => "⟳", "title" => "Offline-First",           "desc" => "Core functions available without network connectivity."],
      ["icon" => "▦", "title" => "Compliance UX",           "desc" => "Duty time regulations built into the interface flow."],
    ],
    "impact"   => [
      ["value" => "25%", "label" => "Crew satisfaction increase"],
      ["value" => "18%", "label" => "Scheduling errors reduced"],
      ["value" => "8K+", "label" => "Crew members served"],
    ],
    "example"  => "Post-launch, the monthly scheduling error rate dropped from 340 to 278 incidents — directly attributable to the new fatigue alert system and restructured duty view.",
  ],

  [
    "id"       => "nft-marketplace",
    "size"     => "wide-center", // row 2 col 2-3 wide
    "category" => "MARKETPLACE DESIGN",
    "title"    => "Digital Marketplace UI",
    "sub"      => "Quikr · 30M+ users",
    "bg"       => "gradient-art",
    "icon"     => "▦",
    "stat"     => ["value" => "30M+", "label" => "Users served"],
    "tagline"  => "Scale changes everything.",
    "summary"  => "Designed the core browsing, listing, and transactional experience for Quikr — India's second-largest classifieds platform at the time of design.",
    "what"     => "At 30M users, every design decision is a policy. A button label change affects millions of interactions daily. I learned to design with data as the co-designer.",
    "pillars"  => [
      ["icon" => "◉", "title" => "Browse Architecture",  "desc" => "Category navigation designed for low-literacy, low-bandwidth users."],
      ["icon" => "⬟", "title" => "Listing Optimisation", "desc" => "Reducing listing creation time from 8 minutes to 3."],
      ["icon" => "◈", "title" => "Chat-First Commerce",  "desc" => "Integrating IVR and chat as primary negotiation channels."],
      ["icon" => "⟡", "title" => "Trust Infrastructure", "desc" => "Verification badges, response rates, and listing age signals."],
    ],
    "impact"   => [
      ["value" => "30M+", "label" => "Monthly active users"],
      ["value" => "18%",  "label" => "Support response improvement"],
      ["value" => "20%",  "label" => "Email CTR for campaigns"],
    ],
    "example"  => "A redesign of the listing creation flow — from 11 steps to 6 — reduced abandonment by 34% and was rolled out to all 30M users within one sprint cycle.",
  ],

  [
    "id"       => "bold-cta",
    "size"     => "small-bottom-left", // row 3 col 1 bottom small
    "category" => "CTA DESIGN",
    "title"    => "Campaign & CTA System",
    "sub"      => "50+ campaigns shipped",
    "bg"       => "purple-dark",
    "icon"     => "◈",
    "stat"     => ["value" => "20%", "label" => "CTR increase"],
    "tagline"  => "The right words at the right moment.",
    "summary"  => "Directed 50+ performance campaigns across email, social, and in-app — combining visual hierarchy, copy strategy, and A/B testing to consistently outperform baseline CTR.",
    "what"     => "A CTA is the smallest design with the biggest business impact. The word choice, the color, the position, the white space around it — each variable affects whether someone acts or scrolls past.",
    "pillars"  => [
      ["icon" => "◎", "title" => "Copy Strategy",      "desc" => "Action-first microcopy that reduces decision friction."],
      ["icon" => "▦", "title" => "Visual Hierarchy",   "desc" => "Contrast, size, and position working together for attention."],
      ["icon" => "⟳", "title" => "A/B Test Culture",   "desc" => "Every CTA has a hypothesis and a measurement plan."],
      ["icon" => "◉", "title" => "Contextual Timing",  "desc" => "Serving the right offer at the right point in the journey."],
    ],
    "impact"   => [
      ["value" => "20%", "label" => "CTR improvement"],
      ["value" => "50+", "label" => "Campaigns directed"],
      ["value" => "3",   "label" => "Client verticals served"],
    ],
    "example"  => "A single CTA copy change — from 'Book Now' to 'Secure Your Seat' — increased booking completion by 8% on the IndiGo mobile app. Small words, large revenue impact.",
  ],

  [
    "id"       => "card-design",
    "size"     => "medium-center",
    "category" => "CARD SYSTEMS",
    "title"    => "Information Card Design",
    "sub"      => "Reusable UI patterns",
    "bg"       => "white",
    "icon"     => "⬟",
    "stat"     => ["value" => "200+", "label" => "Components"],
    "tagline"  => "Cards are containers for decisions.",
    "summary"  => "Designed a flexible card system that works across 10+ product contexts — from product listings to user profiles to data dashboards — maintaining consistency while allowing contextual variation.",
    "what"     => "A card is the most common UI pattern, and the most abused. I developed a card system with clear rules: one primary action, one secondary detail, one image slot — and documented when to break each rule.",
    "pillars"  => [
      ["icon" => "⬡", "title" => "Content Hierarchy", "desc" => "Every card has a clear primary, secondary, and tertiary element."],
      ["icon" => "◎", "title" => "Interaction States", "desc" => "Default, hover, active, loading, and error — all designed."],
      ["icon" => "▦", "title" => "Density Variants",  "desc" => "Compact, standard, and expanded versions for different contexts."],
      ["icon" => "⟳", "title" => "Responsive Scaling", "desc" => "Cards that reflow gracefully from 320px to 1440px."],
    ],
    "impact"   => [
      ["value" => "200+", "label" => "Components in system"],
      ["value" => "10+",  "label" => "Product contexts"],
      ["value" => "60%",  "label" => "Design debt reduced"],
    ],
    "example"  => "The unified card system replaced 23 different card variants across IndiGo's products — reducing visual inconsistency and cutting new feature design time by an average of 2 days per sprint.",
  ],

  [
    "id"       => "user-persona",
    "size"     => "medium-center-2",
    "category" => "USER RESEARCH",
    "title"    => "Persona & Journey Design",
    "sub"      => "Research-led UX",
    "bg"       => "light-blue",
    "icon"     => "◉",
    "stat"     => ["value" => "500+", "label" => "Users tested"],
    "tagline"  => "Empathy is the foundation of every decision.",
    "summary"  => "Conducted and synthesised research with 500+ users across aviation, e-commerce, and SaaS contexts — turning raw insight into personas, journeys, and design principles.",
    "what"     => "Research without synthesis is noise. I developed a research practice that converts user interviews, usability tests, and analytics into actionable design direction — fast.",
    "pillars"  => [
      ["icon" => "◉", "title" => "Mixed Methods",    "desc" => "Combining qualitative interviews with quantitative funnel data."],
      ["icon" => "⟡", "title" => "Persona Systems",  "desc" => "Archetypes built from real data, not assumptions."],
      ["icon" => "◈", "title" => "Journey Mapping",  "desc" => "End-to-end maps that reveal moments of delight and friction."],
      ["icon" => "⬟", "title" => "Insight Synthesis", "desc" => "Converting hours of research into a one-page design brief."],
    ],
    "impact"   => [
      ["value" => "500+", "label" => "Users interviewed"],
      ["value" => "12",   "label" => "Journey maps created"],
      ["value" => "40%",  "label" => "Research-to-decision time cut"],
    ],
    "example"  => "A 6-week research sprint with 80 IndiGo customers revealed that 73% of support queries were caused by 3 UI patterns — fixing those 3 patterns reduced support volume by 30%.",
  ],

  [
    "id"       => "weather-widget",
    "size"     => "small-br-1",
    "category" => "WIDGET DESIGN",
    "title"    => "Data Widget System",
    "sub"      => "Information at a glance",
    "bg"       => "white",
    "icon"     => "◎",
    "stat"     => ["value" => "27", "label" => "Widget variants"],
    "tagline"  => "Data without design is just noise.",
    "summary"  => "Designed a system of information widgets — weather, flight status, loyalty points, notifications — that surface the right data at the right moment.",
    "what"     => "Widgets are the intersection of data and attention. They must communicate one thing instantly, then get out of the way. I designed 27 widget variants across IndiGo's ecosystem.",
    "pillars"  => [
      ["icon" => "◎", "title" => "At-a-Glance Design", "desc" => "Primary information readable in under 2 seconds."],
      ["icon" => "⬡", "title" => "Data Hierarchy",     "desc" => "What to show, what to hide, and what to surface on tap."],
      ["icon" => "⟳", "title" => "Refresh Logic",      "desc" => "When and how widgets update without disrupting the user."],
      ["icon" => "▦", "title" => "Empty States",       "desc" => "Widgets that are useful even when there's no data yet."],
    ],
    "impact"   => [
      ["value" => "27",  "label" => "Widget variants"],
      ["value" => "4.7", "label" => "App store rating maintained"],
      ["value" => "2s",  "label" => "Target information scan time"],
    ],
    "example"  => "The flight status widget — showing gate, delay, and boarding time in one card — became the most-used screen in the IndiGo app, with 3.2M daily views at peak.",
  ],

  [
    "id"       => "payment-ui",
    "size"     => "small-br-2",
    "category" => "FINTECH UX",
    "title"    => "Payment & Checkout UX",
    "sub"      => "Zero-friction transactions",
    "bg"       => "gradient-blue",
    "icon"     => "⟳",
    "stat"     => ["value" => "14%", "label" => "Failure reduction"],
    "tagline"  => "Trust at the moment of truth.",
    "summary"  => "Redesigned the payment experience across IndiGo's booking flow — collaborating with JusPay to automate refund workflows and reduce payment failure rates by 14%.",
    "what"     => "Payment UX is trust UX. At the moment a user enters their card details, they are at maximum anxiety. Every element of the UI must communicate security, speed, and clarity.",
    "pillars"  => [
      ["icon" => "◉", "title" => "Trust Signals",     "desc" => "Security badges, SSL indicators, and bank logos at the right moments."],
      ["icon" => "⬟", "title" => "Error Recovery",    "desc" => "Clear, actionable error messages that don't blame the user."],
      ["icon" => "◈", "title" => "Method Optimisation", "desc" => "Surfacing the most likely payment method first."],
      ["icon" => "⟡", "title" => "Refund Automation", "desc" => "JusPay integration reducing refund resolution time by 20%."],
    ],
    "impact"   => [
      ["value" => "14%", "label" => "Payment failures reduced"],
      ["value" => "20%", "label" => "Refund resolution faster"],
      ["value" => "₹",   "label" => "Crores in recovered revenue"],
    ],
    "example"  => "By surfacing saved payment methods above the fold and redesigning the OTP input, we reduced payment abandonment by 14% — recovering an estimated ₹12Cr in annual revenue.",
  ],

];