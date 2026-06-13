<?php
/* =========================================
   DATA / AUDITS.PHP
   ========================================= */

$audits = [

  [
    "slug"      => "zomato-checkout",
    "status"    => "published",
    "product"   => "Zomato",
    "category"  => "FOOD DELIVERY",
    "title"     => "Zomato Checkout Flow",
    "tagline"   => "India's most-used food app has a checkout that loses money every hour.",
    "image"     => "https://images.unsplash.com/photo-1565299507177-b0ac66763828?q=80&w=1600&auto=format&fit=crop",
    "score"     => 61,
    "severity"  => "HIGH",
    "year"      => "2024",
    "tags"      => ["Checkout UX", "Mobile", "E-commerce", "India"],
    "friction_count" => 7,
    "summary"   => "The checkout flow introduces 4 unnecessary steps, buries the most popular payment method, and has no recovery path for failed orders.",
  ],

  [
    "slug"      => "swiggy-onboarding",
    "status"    => "published",
    "product"   => "Swiggy",
    "category"  => "FOOD DELIVERY",
    "title"     => "Swiggy Onboarding & Home",
    "tagline"   => "Swiggy's home screen tries to do everything and succeeds at nothing.",
    "image"     => "https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1600&auto=format&fit=crop",
    "score"     => 58,
    "severity"  => "HIGH",
    "year"      => "2024",
    "tags"      => ["Onboarding", "Information Architecture", "Mobile", "India"],
    "friction_count" => 9,
    "summary"   => "The home screen suffers from severe information overload, poor hierarchy, and an onboarding flow that skips the most important question.",
  ],

  [
    "slug"      => "netflix-india",
    "status"    => "coming-soon",
    "product"   => "Netflix India",
    "category"  => "STREAMING",
    "title"     => "Netflix India Browse Experience",
    "tagline"   => "Too much content, not enough curation.",
    "image"     => "https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?q=80&w=1600&auto=format&fit=crop",
    "score"     => 0,
    "severity"  => "MEDIUM",
    "year"      => "2025",
    "tags"      => ["Browse UX", "Recommendation Systems", "Mobile", "Streaming"],
    "friction_count" => 0,
    "summary"   => "Coming soon.",
  ],

];
