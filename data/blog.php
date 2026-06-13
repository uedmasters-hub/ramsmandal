<?php
/* =========================================
   DATA / BLOG.PHP — Field Notes
   ========================================= */

$blogMeta = [
  "title"   => "Field Notes",
  "tagline" => "17 years of shipping products. These are the things worth writing down.",
];

$categories = [
  ["id" => "all",      "label" => "All Notes",         "icon" => "◎"],
  ["id" => "war",      "label" => "War Stories",        "icon" => "⚡"],
  ["id" => "wins",     "label" => "Quiet Wins",         "icon" => "✦"],
  ["id" => "opinion",  "label" => "Unpopular Opinions", "icon" => "◈"],
  ["id" => "research", "label" => "From the Field",     "icon" => "⬡"],
];

$posts = [

  // ── WAR STORIES ───────────────────────────────────────────────

  [
    "slug"     => "the-redesign-nobody-asked-for",
    "category" => "war",
    "tag"      => "War Story",
    "featured" => true,
    "title"    => "The Redesign Nobody Asked For",
    "subtitle" => "How a full visual overhaul tanked NPS by 12 points in two weeks — and what we did about it.",
    "excerpt"  => "We shipped what we thought was the best version of the booking flow. Clean, modern, consistent. Users hated it. Not the design — the familiarity loss. Here's what we missed.",
    "read_time"=> "6 min read",
    "date"     => "March 2024",
    "emoji"    => "💥",
    "color"    => "dark",
    "body"     => [
      "We spent four months redesigning IndiGo's booking confirmation screen. The old one was a dense information dump — booking code, passenger details, flight info, all crammed together in a layout unchanged since 2016.",
      "The new one was beautiful. Clean hierarchy, breathing room, a delightful 'You're all set!' state with the seat number large and central. Design team loved it. Stakeholders approved it. We shipped it.",
      "NPS dropped 12 points in two weeks.",
      "The culprit wasn't the design. It was the familiarity. The old screen, ugly as it was, had trained 50 million users over 8 years. They knew exactly where the PNR code was. They screenshotted it the same way every time. We moved it.",
      "Lesson: visual improvement ≠ experience improvement. Familiarity is a feature. When you change something that millions of people have automated, you're not improving — you're relearning them. That has a cost.",
      "What we did: kept the new visual design but restored the PNR code to its original position. NPS recovered within 3 weeks. Small compromise, massive outcome.",
    ],
    "takeaway" => "Familiarity is a feature. Before redesigning high-frequency screens, map what users have automated — then decide which habits are worth breaking.",
    "gallery"  => [
      ["src" => "https://images.unsplash.com/photo-1586953208448-b95a79798f07?q=80&w=1600&auto=format&fit=crop", "caption" => "Old confirmation screen — dense but familiar"],
      ["src" => "https://images.unsplash.com/photo-1587019158091-1a103c5dd17f?q=80&w=1600&auto=format&fit=crop", "caption" => "New design — clean but disorienting"],
      ["src" => "https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1600&auto=format&fit=crop", "caption" => "NPS trend — 12-point drop post-launch"],
      ["src" => "https://images.unsplash.com/photo-1461749280684-dccba630e2f6?q=80&w=1600&auto=format&fit=crop", "caption" => "Compromise solution — visual upgrade, position preserved"],
    ],
  ],

  [
    "slug"     => "when-ab-testing-lies",
    "category" => "war",
    "tag"      => "War Story",
    "featured" => false,
    "title"    => "When A/B Testing Lies to You",
    "subtitle" => "A test showed +8% conversion. We shipped it. Six months later, retention had dropped 15%.",
    "excerpt"  => "We optimised for the wrong metric. The test was technically correct — conversion did go up. But what we couldn't see in 2 weeks was what the change was doing to long-term trust.",
    "read_time"=> "5 min read",
    "date"     => "January 2024",
    "emoji"    => "📊",
    "color"    => "light",
    "body"     => [
      "The test: we added urgency messaging to the ancillary selection screen. 'Only 3 meals left at this price'. It was real scarcity — the meals were genuinely limited.",
      "2-week A/B test: +8% meal attachment. Statistical significance: 97%. We shipped.",
      "6 months later, support tickets about 'misleading' offers had increased 40%. A segment of frequent flyers — our most valuable users — had started selecting 'no meal' specifically to avoid what they perceived as pressure tactics.",
      "The conversion uplift was real. The trust damage was also real. A/B tests measure what users do in the short term — not what they feel about the product long term.",
      "What changed: we kept the scarcity signal but made it genuinely informational rather than urgency-triggering. 'Meals are limited on this route' rather than 'Only 3 left!'. Lower conversion. Higher satisfaction. Better retention.",
    ],
    "takeaway" => "Test for behaviour and sentiment. A metric that goes up while another goes down isn't a win — it's a tradeoff you need to understand before you ship.",
  ],

  [
    "slug"     => "the-44px-tap-target",
    "category" => "war",
    "tag"      => "War Story",
    "featured" => false,
    "title"    => "The 44px Tap Target That Cost ₹2 Crore",
    "subtitle" => "A button that was 32px instead of 44px. On mobile. In the payment flow.",
    "excerpt"  => "Nobody caught it in design review. Nobody caught it in QA. It shipped to 50 million users and quietly generated 34,000 failed tap events per day for 6 months.",
    "read_time"=> "4 min read",
    "date"     => "November 2023",
    "emoji"    => "📱",
    "color"    => "light",
    "body"     => [
      "The 'Confirm Payment' button in the IndiGo mobile booking flow was 32px tall. Apple's HIG says 44px minimum. Google's Material says 48dp. We knew this. We had it in our design system.",
      "What happened: a developer used the desktop component on mobile without adjustment. Passed QA on a Pixel 6 (large screen, easy tap). Failed silently on smaller devices and users with less precise thumb movements.",
      "Hotjar session recordings showed the pattern: users would tap, nothing happened, they'd tap again, sometimes hitting 'Back' by mistake. 34,000 failed tap events per day. On the payment confirmation step.",
      "Six months of this before someone noticed the session recording pattern and connected it to the button size.",
      "What it cost: conservative estimate of 2-3% payment abandonment attributable to the tap target, across 6 months of mobile bookings. The math gets uncomfortable quickly.",
    ],
    "takeaway" => "Accessibility standards aren't just for accessibility. A 44px tap target is a conversion target. Test on the smallest screen your users actually use.",
  ],

  // ── QUIET WINS ────────────────────────────────────────────────

  [
    "slug"     => "the-word-that-changed-conversion",
    "category" => "wins",
    "tag"      => "Quiet Win",
    "featured" => false,
    "title"    => "The Single Word That Changed Conversion",
    "subtitle" => "From 'Book Now' to 'Secure Your Seat'. One word change. 8% lift.",
    "excerpt"  => "The most impactful design change I made in 2023 wasn't a redesign. It wasn't a new component. It was changing two words in a CTA. Here's the psychology behind why it worked.",
    "read_time"=> "3 min read",
    "date"     => "September 2023",
    "emoji"    => "✍️",
    "color"    => "light",
    "body"     => [
      "The original CTA: 'Book Now'. Standard. Functional. Ubiquitous.",
      "The hypothesis: 'Book Now' is a command. It asks users to do something for the product. 'Secure Your Seat' is a benefit frame. It tells users what they get — specifically, the security of knowing their seat is reserved.",
      "The psychology: loss aversion + ownership language. 'Secure' activates the fear of not having something locked in. 'Your Seat' creates psychological ownership before purchase.",
      "We ran a 4-week A/B test across mobile booking flow. The result: 8% increase in tap-through to payment. On IndiGo's booking volume, that's material.",
      "The lesson isn't 'use these exact words'. The lesson is: every CTA label is a micro-copywriting decision that encodes a psychological frame. 'Book Now' is anxiety-neutral. 'Secure Your Seat' is anxiety-resolving.",
    ],
    "takeaway" => "CTA copy is product design. Run it through the loss aversion lens: does your button tell users what they get, or what you want them to do?",
  ],

  [
    "slug"     => "empty-state-that-sells",
    "category" => "wins",
    "tag"      => "Quiet Win",
    "featured" => false,
    "title"    => "The Empty State That Became a Sales Tool",
    "subtitle" => "An empty loyalty dashboard. Designed for delight. Accidentally became the highest-converting screen.",
    "excerpt"  => "When users have no points yet, what do they see? We used to show a grey 'No activity yet' message. Then we redesigned it. Loyalty program enrollment increased 28%.",
    "read_time"=> "4 min read",
    "date"     => "July 2023",
    "emoji"    => "✨",
    "color"    => "light",
    "body"     => [
      "Empty states are the most neglected screens in most products. 'No items yet'. 'Nothing to show'. 'Start by adding...' They're functional, honest, and entirely unmemorable.",
      "The IndiGo loyalty dashboard empty state showed this to new members: a grey card, the text 'No activity yet', and a small 'Start earning' link.",
      "Conversion from empty state to first loyalty action: 6%.",
      "The redesign: showed users exactly what they were missing. A progress ring at 0%, with the next reward level visible and specific. '0 of 2,400 points to Silver'. The empty ring visualised the gap between where they were and where they could be.",
      "Conversion from empty state to first loyalty action after redesign: 34%.",
      "The psychology: the Endowed Progress Effect plus Loss Aversion. Showing users the target they haven't hit yet activates both the desire to start and the mild discomfort of 'wasted potential'.",
    ],
    "takeaway" => "Empty states aren't edge cases — they're first impressions for new users. Design them for the emotional moment, not the functional minimum.",
  ],

  [
    "slug"     => "four-seconds-of-loading",
    "category" => "wins",
    "tag"      => "Quiet Win",
    "featured" => false,
    "title"    => "4 Seconds of Loading That We Turned Into Delight",
    "subtitle" => "A payment processing screen that users hated. Same wait time. Completely different experience.",
    "excerpt"  => "The payment processing step took 4 seconds — non-negotiable, it was bank infrastructure. We couldn't make it faster. So we made it feel better. CSAT for the payment flow went up 18%.",
    "read_time"=> "4 min read",
    "date"     => "May 2023",
    "emoji"    => "⏱",
    "color"    => "light",
    "body"     => [
      "Payment processing: 4 seconds. Bank-side. Not negotiable.",
      "Original experience: a spinner. Generic. Anxiety-inducing. Support tickets: 'My payment seems stuck'.",
      "What we built instead: a progress sequence. Not fake — genuine steps. 'Connecting to bank... Verifying card details... Securing your booking... Almost there...' Each step appeared at 1-second intervals.",
      "Same 4 seconds. Completely different experience. Users felt informed rather than abandoned.",
      "The psychology: perceived performance is more important than actual performance. A spinner communicates 'something is happening, we don't know what'. A step sequence communicates 'we know exactly what's happening, here's where we are'.",
      "CSAT for the payment flow: +18%. Support tickets about payment processing: -40%. Zero engineering time spent — this was a pure frontend change taking 2 days to build.",
    ],
    "takeaway" => "When you can't make something faster, make it feel faster. Perceived wait time is a design problem, not an infrastructure problem.",
  ],

  // ── UNPOPULAR OPINIONS ────────────────────────────────────────

  [
    "slug"     => "dark-patterns-are-a-short-term-win",
    "category" => "opinion",
    "tag"      => "Unpopular Opinion",
    "featured" => false,
    "title"    => "Dark Patterns Work. That's Why They're Dangerous.",
    "subtitle" => "Every dark pattern I've seen has short-term data that justifies it. The long-term data never gets measured.",
    "excerpt"  => "The uncomfortable truth about manipulative UX: it does increase conversion. The problem is what it does to the metrics nobody's tracking — trust, retention, word-of-mouth, brand reputation.",
    "read_time"=> "5 min read",
    "date"     => "February 2024",
    "emoji"    => "🎭",
    "color"    => "light",
    "body"     => [
      "I've been in product reviews where dark patterns were proposed with genuine conviction. Pre-checked opt-in boxes. Fake countdown timers. Confirm-shaming. 'Skip this offer? (I don't want to save money)'. The data in these meetings always showed the pattern worked.",
      "Here's the problem: the data window is wrong. A 2-week A/B test can show a dark pattern increasing conversion by 15%. What it can't show is what that 15% does to NPS over 6 months, or how many users talk to their friends about feeling tricked.",
      "I've seen this play out specifically. An airline (not IndiGo) added pre-checked travel insurance. Conversion of insurance: +40%. Beautiful. Eighteen months later, their social media was dominated by complaints about 'sneaky charges'. Customer acquisition cost had increased 22% because positive word-of-mouth had dried up.",
      "Dark patterns are a loan against your brand. The conversion is the drawdown. The compounding interest is the trust erosion you can't easily see or measure.",
      "My standard: if explaining how a UI element works to a user would make them feel deceived — don't build it. Not because it's illegal (though increasingly it is). Because it's a bad long-term business decision.",
    ],
    "takeaway" => "Measure what dark patterns do to your NPS, retention, and organic acquisition over 12 months. Then decide if the conversion uplift is worth it.",
  ],

  [
    "slug"     => "ux-debt-is-worse-than-tech-debt",
    "category" => "opinion",
    "tag"      => "Unpopular Opinion",
    "featured" => false,
    "title"    => "UX Debt Is More Expensive Than Tech Debt",
    "subtitle" => "Engineering teams fight for time to pay tech debt. Design teams rarely win the same argument. They should.",
    "excerpt"  => "Everyone understands a codebase that needs refactoring. The equivalent — a UX that has accumulated years of inconsistent decisions — is just as expensive to fix and much harder to quantify.",
    "read_time"=> "6 min read",
    "date"     => "December 2023",
    "emoji"    => "🏗",
    "color"    => "light",
    "body"     => [
      "Tech debt has a clear metaphor: messy code that slows development velocity. Everyone understands it. Engineers can show the cost in sprint velocity metrics.",
      "UX debt doesn't have a good metaphor yet, so it doesn't get prioritised. But it's the same problem: years of expedient design decisions that made sense locally but create a fragmented experience globally.",
      "IndiGo's product had 23 different card variants when I arrived. Three different typefaces used for the same semantic purpose. Seven distinct navigation patterns across product surfaces. Each one had been a rational local decision. Together, they were an incoherent experience.",
      "The cost of this debt: every new designer took 3 weeks to understand the system. Every new feature added friction from inconsistency. User research showed 'the app feels confusing' — not because any one screen was bad, but because the accumulated inconsistency created cognitive friction.",
      "Fixing it took 6 months of parallel work. After: new feature design time dropped 40%. Designer onboarding from 3 weeks to 4 days. UX debt paid off faster than any tech debt I've seen.",
    ],
    "takeaway" => "Quantify UX debt in terms engineering and product understand: new feature design time, designer onboarding time, user research confusion scores. Then make the case.",
  ],

  // ── FROM THE FIELD ────────────────────────────────────────────

  [
    "slug"     => "what-i-learned-at-4am",
    "category" => "research",
    "tag"      => "From the Field",
    "featured" => true,
    "title"    => "What I Learned Watching People Use Apps at 4am",
    "subtitle" => "Three nights of shadow research in airport departure lounges. This is what I saw.",
    "excerpt"  => "You cannot design operational software without watching people use it in the actual conditions they use it in. Not a usability lab. Not a Zoom call. A departure lounge at 4am with someone who's been awake for 18 hours.",
    "read_time"=> "7 min read",
    "date"     => "April 2024",
    "emoji"    => "🌙",
    "color"    => "dark",
    "body"     => [
      "I spent three nights conducting shadow research in IndiGo departure lounges for the CrewPal redesign. 4am to 8am. Watching cabin crew interact with the app before and between flights.",
      "What I saw in a usability lab: crew navigating to their schedule, reading duty assignments, checking fatigue status. Efficient enough.",
      "What I saw at 4am in Terminal 2: crew holding the phone at arm's length because the text was too small. Crew using the phone one-handed with bags on both shoulders. Crew squinting at the screen under fluorescent lights after a night flight. Crew tapping the wrong thing three times in a row because their fine motor control was compromised by fatigue.",
      "The same interface. Completely different experience.",
      "Three things I learned that I couldn't have learned in a lab: First, minimum touch target size in an operational app should be 52px, not 44px — fatigued hands are imprecise. Second, every important piece of information needs a text label as well as an icon — recognition fails under fatigue. Third, the first screen should answer the one question crew have at 4am: 'What do I need to do right now?' Not a dashboard. An answer.",
      "The redesign that came from those three nights reduced task completion time from 47 seconds to 8 seconds for the primary use case.",
    ],
    "takeaway" => "Research in context is a different discipline from research in a lab. For operational or high-stress products, context-first research isn't optional — it's the only kind that tells the truth.",
  ],

  [
    "slug"     => "the-user-who-screenshot-everything",
    "category" => "research",
    "tag"      => "From the Field",
    "featured" => false,
    "title"    => "The User Who Screenshotted Everything",
    "subtitle" => "A workaround that 8,000 people were using that nobody on the product team knew about.",
    "excerpt"  => "During research for CrewPal, I discovered that cabin crew were screenshotting their schedules and sharing them on WhatsApp because the app was too slow. The product team didn't know this. It had been happening for 2 years.",
    "read_time"=> "4 min read",
    "date"     => "March 2023",
    "emoji"    => "📸",
    "color"    => "light",
    "body"     => [
      "Research observation, night one: a crew member opens CrewPal, navigates to her schedule, takes a screenshot, closes the app, opens WhatsApp, sends the screenshot to the crew WhatsApp group.",
      "Me: 'Why did you do that?'",
      "Her: 'Because this is faster than asking people to open the app themselves.'",
      "I asked the next 8 crew members I observed. All of them did the same thing. Different WhatsApp groups. Same workaround.",
      "Nobody on the product team knew this was happening. Analytics showed users opening the schedule screen regularly — they had no visibility into what happened next. The screenshot workflow was invisible to the data.",
      "This is the core problem with analytics-only research: it tells you what users do in the app. It doesn't tell you what they do because of the app, or instead of the app.",
      "The fix in the redesign: a native 'Share schedule' button that formatted and shared a clean text version of the duty assignments. WhatsApp workaround: unnecessary. More importantly: the pattern that revealed the workaround led to three other insights about the crew's actual workflow that we'd never have found in quantitative data.",
    ],
    "takeaway" => "Workarounds are the most honest user feedback you'll ever get. They mean 'your product doesn't solve this well enough, so I built my own solution'. Find the workarounds.",
  ],

  [
    "slug"     => "when-users-lie-in-interviews",
    "category" => "research",
    "tag"      => "From the Field",
    "featured" => false,
    "title"    => "When Users Lie to You in Interviews",
    "subtitle" => "Not maliciously. They lie because they want to be helpful, and because they don't actually know why they do what they do.",
    "excerpt"  => "The social desirability bias is the most dangerous thing in user research. Users tell you what they think you want to hear, or what they think is the 'right' answer. Here's how to design around it.",
    "read_time"=> "5 min read",
    "date"     => "October 2023",
    "emoji"    => "🎭",
    "color"    => "light",
    "body"     => [
      "IndiGo booking research. Interview question: 'What factors influence your seat selection decision?'",
      "Interview answer (consistent across 40 participants): 'Price, and then window seat preference.'",
      "Hotjar recordings of actual seat selection: 78% of users selected a seat based on its position relative to exit rows, regardless of price tier. The decision was primarily about disembarkation speed — something nobody mentioned in interviews.",
      "Why the gap? Because 'I want to get off the plane faster' sounds trivial and slightly selfish. 'I prefer window seats' sounds like a real preference. Users edit their answers toward what seems like a reasonable, considered response.",
      "The research principle: behaviour data is more honest than stated preference data. Watch what people do, don't just ask what they think. When they diverge — and they will — the behaviour is true.",
      "This specific insight changed how we designed the seat selection: we added an 'Exit row proximity' filter. It became the third most-used filter within 30 days of launch.",
    ],
    "takeaway" => "Ask 'why' in interviews as a starting point, not an ending point. Validate with behaviour data. When they conflict, the behaviour is telling the truth.",
  ],

  [
    "slug"     => 'this-is-just-a-test-blog',
    "category" => 'war',
    "tag"      => 'War Story',
    "featured" => false,
    "title"    => 'This is just a test blog for review purposes',
    "subtitle" => '',
    "excerpt"  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel quam at dui convallis pulvinar non a quam. Sed venenatis nisl at lacus pretium, eget tempus nibh lacinia. Curabitur sagittis varius tempor. Aenean non nibh eget velit volutpat bibendum. Nulla vel aliquet erat. Cu',
    "read_time"=> '3 min read',
    "date"     => 'May 30 2026',
    "emoji"    => '',
    "color"    => 'light',
    "body"     => [
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel quam at dui convallis pulvinar non a quam. Sed venenatis nisl at lacus pretium, eget tempus nibh lacinia. Curabitur sagittis varius tempor. Aenean non nibh eget velit volutpat bibendum. Nulla vel aliquet erat. Curabitur condimentum diam sit amet maximus venenatis. Duis sed turpis interdum, gravida mi nec, tempor ante.

Phasellus sit amet metus orci. Donec pharetra nunc eu purus fringilla, a pretium purus tincidunt. Nam sed neque mi. Nulla auctor nibh odio, nec venenatis erat luctus eget. Donec euismod neque vitae velit feugiat, eget accumsan sem dapibus. Aenean pharetra pellentesque tellus ut blandit. Integer bibendum metus sed lacus eleifend, vel dictum nibh pretium. Cras id imperdiet tortor. Mauris malesuada varius nulla quis lobortis. Pellentesque in magna at ex sodales rhoncus sed sit amet lacus. Quisque consectetur nibh at sapien dignissim luctus. Cras ac sollicitudin nunc. Duis luctus nisl vitae erat pulvinar rutrum. Integer facilisis eros purus, quis porta orci vestibulum eget. Phasellus mollis felis ac nulla placerat, non ultrices arcu dignissim. Duis mattis ultrices erat a laoreet.',
    ],
    "takeaway" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel quam at dui convallis pulvinar non a quam. Sed venenatis nisl at lacus pretium, eget tempus nibh lacinia. Curabitur sagittis varius tempor. Aenean non nibh eget velit volutpat bibendum. Nulla vel aliquet erat. Curabitur condimentum diam sit amet maximus venenatis. Duis sed turpis interdum, gravida mi nec, tempor ante.',
  ],

];