<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ADHD Bridge — Landing</title>

  <!-- Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Lexend:wght@300;400;600&display=swap"
    rel="stylesheet">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* =========================
       COLOR PALETTE (CSS VARS)
       ========================= */
    :root {
      --bg-1: #6F42C1;
      --bg-2: #8E44AD;
      --accent: #FFD974;
      --muted: rgba(255, 255, 255, 0.14);
      --card-bg: rgba(255, 255, 255, 0.12);
      --text-on-dark: #ffffff;
      --surface: #ffffff;
      --surface-text: #222222;
      --success: #2bb673;
      --shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
      --radius-lg: 20px;
    }

    /* Dark / Light theme variables */
    .theme-light {
      --page-bg: linear-gradient(-45deg, var(--bg-1), var(--bg-2), #9b59b6, #5a32a3);
      --hero-text: var(--text-on-dark);
      --card-surface: var(--card-bg);
      --section-bg: var(--surface);
      --section-text: var(--surface-text);
      --feature-bg: rgba(255, 255, 255, 0.95);
      --feature-border: rgba(0, 0, 0, 0.1);
      --testimonial-bg: rgba(255, 255, 255, 0.95);
    }

    .theme-dark {
      --page-bg: linear-gradient(180deg, #24123b, #2f154b);
      --hero-text: #fff;
      --card-surface: rgba(255, 255, 255, 0.06);
      --section-bg: #120617;
      --section-text: #ddd;
      --feature-bg: rgba(30, 30, 30, 0.95);
      --feature-border: rgba(255, 255, 255, 0.1);
      --testimonial-bg: rgba(40, 40, 40, 0.95);
    }

    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: var(--page-bg);
      background-size: 400% 400%;
      animation: gradientFlow 14s ease infinite;
      color: var(--hero-text);
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      transition: background .35s ease, color .2s ease;
    }

    @keyframes gradientFlow {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    /* NAV */
    .navbar {
      background: transparent;
      padding: .75rem 1rem;
    }

    .brand {
      font-weight: 800;
      letter-spacing: .2px;
    }

    /* HERO */
    .hero {
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 4rem 1rem;
    }

    .glass {
      width: 100%;
      max-width: 980px;
      background: var(--card-surface);
      backdrop-filter: blur(16px) saturate(140%);
      border-radius: var(--radius-lg);
      padding: 36px;
      box-shadow: var(--shadow);
      text-align: left;
      display: grid;
      grid-template-columns: 1fr 420px;
      gap: 24px;
      align-items: center;
    }

    @media (max-width: 900px) {
      .glass {
        grid-template-columns: 1fr;
        padding: 28px;
      }

      .illustration {
        order: -1;
      }
    }

    .hero-title {
      font-size: clamp(1.5rem, 3.8vw, 2.4rem);
      margin: 0 0 .5rem 0;
      font-weight: 800;
    }

    .hero-sub {
      margin: 0 0 1rem 0;
      opacity: .95;
      font-size: 1.02rem;
    }

    .btn-primary-pill {
      border-radius: 999px;
      padding: .7rem 1.25rem;
      background: linear-gradient(90deg, #ffffff, #f3e8ff);
      color: #4b2b93;
      font-weight: 700;
      border: none;
    }

    .btn-outline-pill {
      border-radius: 999px;
      padding: .6rem 1rem;
      background: transparent;
      border: 1px solid rgba(255, 255, 255, 0.18);
      color: var(--hero-text);
    }

    .hero-controls {
      margin-top: 1.25rem;
      display: flex;
      gap: .75rem;
      align-items: center;
      flex-wrap: wrap;
    }

    .illustration {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 8px;
    }

    .illustration svg {
      width: 100%;
      max-width: 360px;
      height: auto;
      display: block;
    }

    /* CAROUSEL */
    .carousel-inner {
      background: transparent;
      color: var(--section-text);
      padding: 2rem 1rem;
    }

    .carousel-item {
      padding: 1rem 0;
      text-align: center;
    }

    .carousel .carousel-indicators [data-bs-target] {
      background: var(--accent);
    }

    /* FEATURES SECTION */
    .features-section {
      background: var(--section-bg);
      color: var(--section-text);
      padding: 4rem 2rem;
    }

    .features-container {
      display: flex;
      justify-content: center;
      gap: 2rem;
      flex-wrap: wrap;
      max-width: 1200px;
      margin: 0 auto;
    }

    .feature-card {
      flex: 1;
      min-width: 280px;
      max-width: 320px;
      padding: 2.5rem 2rem;
      border-radius: var(--radius-lg);
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background: var(--feature-bg);
      border: 1px solid var(--feature-border);
      opacity: 0;
      transform: translateY(30px);
    }

    /* Feature icons */
    .feature-icon {
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
      display: block;
      transition: transform 0.3s ease;
    }

    .feature-card:hover .feature-icon {
      transform: scale(1.1);
    }

    /* Focus mode support */
    .focus-mode .feature-card {
      background: rgba(255, 255, 255, 0.98);
    }

    .theme-dark.focus-mode .feature-card {
      background: rgba(20, 20, 20, 0.98);
    }

    /* Hover effects */
    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .theme-dark .feature-card:hover {
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
    }

    /* Feature card content */
    .feature-card h5 {
      margin-bottom: 1rem;
      font-weight: 600;
      font-size: 1.25rem;
      color: var(--section-text);
    }

    .feature-card .small {
      line-height: 1.5;
      opacity: 0.8;
      color: var(--section-text);
    }

    /* Slide-in animation */
    .feature-card.visible {
      opacity: 1;
      transform: translateY(0);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }

    /* Staggered animation delays */
    .feature-card:nth-child(1) {
      transition-delay: 0.1s;
    }

    .feature-card:nth-child(2) {
      transition-delay: 0.2s;
    }

    .feature-card:nth-child(3) {
      transition-delay: 0.3s;
    }

    /* TESTIMONIALS */
    .testimonials {
      background: var(--section-bg);
      color: var(--section-text);
      padding: 4rem 2rem;
    }

    .testimonial-card {
      background: var(--testimonial-bg);
      border: 1px solid var(--feature-border);
      transition: transform 0.3s ease;
    }

    .testimonial-card:hover {
      transform: translateY(-3px);
    }

    .avatar-placeholder {
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
    }

    /* STATISTICS */
    .stats {
      background: var(--page-bg);
      color: var(--hero-text);
      padding: 4rem 2rem;
    }

    .stat-number {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
    }

    /* HOW IT WORKS */
    .how-it-works {
      background: var(--section-bg);
      color: var(--section-text);
      padding: 4rem 2rem;
    }

    .step-number {
      font-weight: bold;
      font-size: 1.2rem;
    }

    .mockup-placeholder {
      background: var(--feature-bg);
      border: 1px solid var(--feature-border);
    }

    /* FAQ */
    .faq {
      background: var(--page-bg);
      color: var(--hero-text);
      padding: 4rem 2rem;
    }

    .accordion-button {
      background: var(--card-surface);
      color: var(--hero-text);
    }

    .accordion-button:not(.collapsed) {
      background: var(--card-surface);
      color: var(--hero-text);
    }

    .accordion-body {
      background: var(--section-bg);
      color: var(--section-text);
    }

    /* FINAL CTA */
    .final-cta {
      background: linear-gradient(135deg, var(--bg-1), var(--bg-2));
      color: white;
      padding: 4rem 2rem;
    }

    /* TRUST BADGES */
    .trust-badges {
      background: var(--section-bg);
      padding: 3rem 2rem;
    }

    .badge-placeholder {
      min-width: 120px;
      text-align: center;
    }

    /* Responsive design */
    @media (max-width: 768px) {

      .features-section,
      .testimonials,
      .stats,
      .how-it-works,
      .faq,
      .final-cta {
        padding: 3rem 1rem;
      }

      .features-container {
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
      }

      .feature-card {
        min-width: 100%;
        max-width: 400px;
        padding: 2rem 1.5rem;
      }

      .feature-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
      }

      .stat-number {
        font-size: 2rem;
      }
    }

    /* Accessibility helpers */
    .lexend {
      font-family: 'Lexend', Inter, sans-serif;
    }

    .focus-mode * {
      transition: none !important;
    }

    .focus-mode .feature-card {
      opacity: 1;
      transform: none;
    }

    .focus-mode .glass {
      padding: 42px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
    }

    .focus-mode .hero-sub,
    .focus-mode .carousel-item p {
      font-size: 1.05rem;
      line-height: 1.6;
    }

    :focus {
      outline: 3px dashed var(--accent);
      outline-offset: 3px;
      border-radius: 8px;
    }

    @media (prefers-reduced-motion: reduce) {
      * {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
        scroll-behavior: auto !important;
      }
    }

    .control-chip {
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.06);
      padding: .35rem .6rem;
      font-size: .9rem;
      display: inline-flex;
      gap: .6rem;
      align-items: center;
    }

    /* Add this to your existing CSS to fix FAQ colors */
    .faq {
      background: var(--section-bg) !important;
      color: var(--section-text) !important;
    }

    .accordion-button {
      color: var(--section-text) !important;
      background: var(--feature-bg) !important;
    }

    .accordion-body {
      color: var(--section-text) !important;
      background: var(--feature-bg) !important;
    }
  </style>
</head>

<body class="theme-light" id="pageBody">

  <!-- NAV -->
  <nav class="navbar">
    <div class="container">
      <div class="d-flex align-items-center w-100 justify-content-between">
        <div class="d-flex align-items-center gap-2">
          <div style="width:44px; height:44px; display:grid; place-items:center;">
            <svg viewBox="0 0 100 100" width="36" height="36" role="img" aria-hidden="true">
              <defs>
                <linearGradient id="g1" x1="0" x2="1">
                  <stop offset="0" stop-color="#FFD974" />
                  <stop offset="1" stop-color="#FFB4A2" />
                </linearGradient>
              </defs>
              <circle cx="50" cy="50" r="44" fill="url(#g1)" />
              <path d="M36 60c8-18 28-18 34-6" stroke="#6F42C1" stroke-width="6" stroke-linecap="round" fill="none" />
            </svg>
          </div>
          <div class="brand">ADHD Bridge</div>
        </div>

        <div class="d-flex align-items-center gap-2">
          <button class="btn btn-sm btn-light" id="themeToggle" aria-pressed="false" title="Toggle theme">Dark</button>
          <div class="d-none d-md-block">
            <a class="btn btn-sm btn-outline-light" href="login.php">Login</a>
            <a class="btn btn-sm btn-warning ms-2" href="register.php">Register</a>
          </div>
          <button class="btn btn-sm btn-outline-light d-md-none" id="mobileMenuBtn" aria-expanded="false"
            aria-controls="mobileMenu">☰</button>
        </div>
      </div>
    </div>

    <div id="mobileMenu" style="display:none; background:rgba(0,0,0,0.08); padding:10px;">
      <div class="d-flex flex-column gap-2">
        <a href="login.php" class="btn btn-light btn-sm w-100">Login</a>
        <a href="register.php" class="btn btn-warning btn-sm w-100">Register</a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="glass" role="region" aria-labelledby="heroTitle">
      <div>
        <h1 id="heroTitle" class="hero-title">Welcome to <span style="color:var(--accent)">ADHD Bridge</span></h1>
        <p class="hero-sub">Tools and gentle structure to help adults with ADHD communicate more clearly with family and
          feel understood.</p>

        <div class="hero-controls">
          <a class="btn btn-primary-pill" href="register.php">Get Started — it's free</a>
          <a class="btn btn-outline-pill" href="login.php">Login</a>

          <div class="control-chip" title="Accessibility controls" style="margin-left:auto;">
            <label style="display:inline-flex;align-items:center;gap:.45rem;cursor:pointer;">
              <input id="lexendToggle" type="checkbox" style="display:none">
              <span id="lexendLabel">Lexend</span>
            </label>
            <button class="btn btn-sm btn-link text-white" id="focusToggle" style="text-decoration:none;">Focus</button>
          </div>
        </div>

        <div style="margin-top:14px;">
          <a class="text-white" href="#featuresSection" id="learnMoreLink">Learn more ↓</a>
        </div>
      </div>

      <div class="illustration" aria-hidden="true">
        <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="L1" x1="0" x2="1">
              <stop offset="0" stop-color="#ffd974" />
              <stop offset="1" stop-color="#ffb4a2" />
            </linearGradient>
          </defs>
          <g transform="translate(10,10)">
            <ellipse cx="240" cy="220" rx="180" ry="120" fill="#fff" opacity="0.06" />
            <g transform="translate(40,30)">
              <rect x="0" y="0" rx="28" ry="28" width="320" height="220" fill="#fff" opacity="0.03" />
              <circle cx="260" cy="60" r="44" fill="#fff" opacity="0.06"></circle>
              <g transform="translate(60,60)">
                <ellipse cx="56" cy="56" rx="56" ry="56" fill="#FFD974" />
                <circle cx="42" cy="50" r="6" fill="#6F42C1" />
                <circle cx="70" cy="50" r="6" fill="#6F42C1" />
                <path d="M40 70 Q56 86 72 70" stroke="#6F42C1" stroke-width="4" fill="none" stroke-linecap="round" />
              </g>
            </g>
          </g>
        </svg>
      </div>
    </div>
  </section>

  <!-- CAROUSEL -->
  <section id="carouselSection" class="py-4">
    <div class="container">
      <div id="infoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">
          <div class="carousel-item active text-center">
            <h4>💬 Structured Conversations</h4>
            <p>Guided prompts designed to reduce overwhelm and make your message clear.</p>
          </div>
          <div class="carousel-item text-center">
            <h4>🧠 Mood & Pattern Tracking</h4>
            <p>Small daily check-ins to help you notice trends—not judge them.</p>
          </div>
          <div class="carousel-item text-center">
            <h4>🤝 Family Support Tools</h4>
            <p>Share structured notes with loved ones so everyone stays on the same page.</p>
          </div>
        </div>

        <div class="d-flex justify-content-center gap-2 mt-3">
          <button type="button" data-bs-target="#infoCarousel" data-bs-slide="prev"
            class="btn btn-sm btn-outline-light">‹</button>
          <button type="button" data-bs-target="#infoCarousel" data-bs-slide="next"
            class="btn btn-sm btn-outline-light">›</button>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section id="featuresSection" class="features-section">
    <div class="features-container">
      <div class="feature-card">
        <div class="feature-icon">📊</div>
        <h5>Daily Check-Ins</h5>
        <p class="small">Simple mood & activity notes that make patterns obvious over time.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">💬</div>
        <h5>Guided Messages</h5>
        <p class="small">Templates to help with difficult conversations and reduce overload.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">🔒</div>
        <h5>Privacy First</h5>
        <p class="small">Control your sharing and keep personal notes private.</p>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="testimonials">
    <div class="container">
      <h2 class="text-center mb-5">Trusted by ADHD Adults Worldwide</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="testimonial-card p-4 rounded-3 h-100">
            <div class="stars mb-3">⭐⭐⭐⭐⭐</div>
            <p class="mb-3">"Finally, a tool that understands how my brain works. The guided conversations have
              transformed how I communicate with my partner."</p>
            <div class="d-flex align-items-center">
              <div class="avatar-placeholder rounded-circle bg-primary me-3" style="width: 40px; height: 40px;"></div>
              <div>
                <strong>Sarah M.</strong>
                <div class="small opacity-75">User for 6 months</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-card p-4 rounded-3 h-100">
            <div class="stars mb-3">⭐⭐⭐⭐⭐</div>
            <p class="mb-3">"The daily check-ins take 2 minutes but have given me insights I've missed for years.
              Game-changer."</p>
            <div class="d-flex align-items-center">
              <div class="avatar-placeholder rounded-circle bg-success me-3" style="width: 40px; height: 40px;"></div>
              <div>
                <strong>James T.</strong>
                <div class="small opacity-75">User for 3 months</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-card p-4 rounded-3 h-100">
            <div class="stars mb-3">⭐⭐⭐⭐⭐</div>
            <p class="mb-3">"Privacy-focused and ADHD-friendly. Finally, an app that doesn't overwhelm me with
              notifications."</p>
            <div class="d-flex align-items-center">
              <div class="avatar-placeholder rounded-circle bg-warning me-3" style="width: 40px; height: 40px;"></div>
              <div>
                <strong>Alex K.</strong>
                <div class="small opacity-75">User for 1 year</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- STATISTICS -->
  <section class="stats">
    <div class="container">
      <div class="row text-center g-4">
        <div class="col-md-3">
          <div class="stat-number h2 fw-bold" data-count="89">0%</div>
          <div class="small">Report better communication</div>
        </div>
        <div class="col-md-3">
          <div class="stat-number h2 fw-bold" data-count="72">0%</div>
          <div class="small">Reduced relationship stress</div>
        </div>
        <div class="col-md-3">
          <div class="stat-number h2 fw-bold" data-count="5000">0</div>
          <div class="small">Active users</div>
        </div>
        <div class="col-md-3">
          <div class="stat-number h2 fw-bold" data-count="98">0%</div>
          <div class="small">Privacy satisfaction</div>
        </div>
      </div>
    </div>
  </section>
  <!-- HOW IT WORKS - Alternative Centered Layout -->
  <section class="how-it-works">
    <div class="container">
      <h2 class="text-center mb-5">How ADHD Bridge Works</h2>
      <div class="row justify-content-center text-center">
        <div class="col-lg-10">
          <div class="row g-4">
            <div class="col-md-4">
              <div class="step-vertical text-center p-4">
                <div
                  class="step-number rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                  style="width: 60px; height: 60px; font-size: 1.25rem;">1</div>
                <h5>Quick Daily Check-in</h5>
                <p class="mb-0">Spend 1 minute logging your mood and energy levels. No pressure, just patterns.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="step-vertical text-center p-4">
                <div
                  class="step-number rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3"
                  style="width: 60px; height: 60px; font-size: 1.25rem;">2</div>
                <h5>Use Guided Templates</h5>
                <p class="mb-0">When conversations get tough, use our ADHD-friendly message templates.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="step-vertical text-center p-4">
                <div
                  class="step-number rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center mb-3"
                  style="width: 60px; height: 60px; font-size: 1.25rem;">3</div>
                <h5>See Patterns Emerge</h5>
                <p class="mb-0">Understand your triggers and strengths through simple, visual insights.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </div>
  </div>
  </div>
  </div>
  </div>
  </section>

  <!-- FAQ -->
  <section class="faq">
    <div class="container">
      <h2 class="text-center mb-5">Frequently Asked Questions</h2>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="accordion" id="faqAccordion">
            <div class="accordion-item border-0 mb-3">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq1">
                  Is my data really private?
                </button>
              </h3>
              <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Yes! We use end-to-end encryption and never sell your data. You control exactly what gets shared and
                  with whom.
                </div>
              </div>
            </div>
            <div class="accordion-item border-0 mb-3">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq2">
                  How much time does this take daily?
                </button>
              </h3>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Most users spend 2-5 minutes on daily check-ins. The guided messages save time by providing
                  ready-to-use templates for difficult conversations.
                </div>
              </div>
            </div>
            <div class="accordion-item border-0">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse"
                  data-bs-target="#faq3">
                  Is this suitable for people newly diagnosed with ADHD?
                </button>
              </h3>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Absolutely! ADHD Bridge is designed to be accessible for everyone, whether you're newly diagnosed or
                  have been managing ADHD for years.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FINAL CTA -->
  <section class="final-cta">
    <div class="container text-center">
      <h2 class="mb-3">Ready to Build Better Communication?</h2>
      <p class="lead mb-4">Join thousands of ADHD adults finding clarity and connection.</p>
      <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
        <a href="register.php" class="btn btn-light btn-lg px-4 py-2 fw-bold">Start Your Free Trial</a>
        <a href="#featuresSection" class="btn btn-outline-light btn-lg px-4 py-2">Learn More</a>
      </div>
      <div class="mt-3 small opacity-75">
        No credit card required • 30-day free trial • Cancel anytime
      </div>
    </div>
  </section>

  <!-- TRUST BADGES -->
  <section class="trust-badges">
    <div class="container">
      <div class="text-center small mb-3" style="color: var(--section-text)">Trusted and recommended by</div>
      <div class="row align-items-center justify-content-center g-4">
        <div class="col-auto">
          <div class="badge-placeholder rounded p-3"
            style="color: var(--section-text); border: 1px solid var(--feature-border); background: var(--feature-bg);">
            ADHD Coach Association</div>
        </div>
        <div class="col-auto">
          <div class="badge-placeholder rounded p-3"
            style="color: var(--section-text); border: 1px solid var(--feature-border); background: var(--feature-bg);">
            Privacy Certified</div>
        </div>
        <div class="col-auto">
          <div class="badge-placeholder rounded p-3"
            style="color: var(--section-text); border: 1px solid var(--feature-border); background: var(--feature-bg);">
            Mental Health Tech</div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="py-3 text-center" style="color:rgba(255,255,255,0.85)">
    <small>© <?= date('Y') ?> ADHD Bridge — Made with care</small>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    /* ---------------------------
       THEME toggle
    --------------------------- */
    const body = document.getElementById('pageBody');
    const themeBtn = document.getElementById('themeToggle');
    const storedTheme = localStorage.getItem('bridge-theme') || 'light';
    function applyTheme(t) {
      if (t === 'dark') {
        body.classList.remove('theme-light'); body.classList.add('theme-dark');
        themeBtn.textContent = 'Light';
        themeBtn.setAttribute('aria-pressed', 'true');
      } else {
        body.classList.remove('theme-dark'); body.classList.add('theme-light');
        themeBtn.textContent = 'Dark';
        themeBtn.setAttribute('aria-pressed', 'false');
      }
      localStorage.setItem('bridge-theme', t);
    }
    applyTheme(storedTheme);
    themeBtn.addEventListener('click', () => applyTheme(body.classList.contains('theme-dark') ? 'light' : 'dark'));

    /* ---------------------------
       Lexend font toggle
    --------------------------- */
    const lexendToggle = document.getElementById('lexendToggle');
    const lexendLabel = document.getElementById('lexendLabel');
    const storedLexend = localStorage.getItem('bridge-lexend') === 'true';
    function applyLexend(on) {
      if (on) { document.body.classList.add('lexend'); lexendLabel.textContent = 'Lexend ✓'; }
      else { document.body.classList.remove('lexend'); lexendLabel.textContent = 'Lexend'; }
      localStorage.setItem('bridge-lexend', on ? 'true' : 'false');
    }
    applyLexend(storedLexend);
    lexendLabel.addEventListener('click', () => applyLexend(!document.body.classList.contains('lexend')));

    /* ---------------------------
       FOCUS MODE
    --------------------------- */
    const focusBtn = document.getElementById('focusToggle');
    const storedFocus = localStorage.getItem('bridge-focus') === 'true';
    function applyFocus(on) {
      if (on) { document.body.classList.add('focus-mode'); focusBtn.textContent = 'Exit Focus'; }
      else { document.body.classList.remove('focus-mode'); focusBtn.textContent = 'Focus'; }
      localStorage.setItem('bridge-focus', on ? 'true' : 'false');
    }
    applyFocus(storedFocus);
    focusBtn.addEventListener('click', () => applyFocus(!document.body.classList.contains('focus-mode')));

    /* ---------------------------
       Mobile menu toggle
    --------------------------- */
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    mobileBtn.addEventListener('click', () => {
      const visible = mobileMenu.style.display === 'block';
      mobileMenu.style.display = visible ? 'none' : 'block';
      mobileBtn.setAttribute('aria-expanded', !visible);
    });

    /* ---------------------------
       Smooth scroll for links
    --------------------------- */
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
      });
    });

    /* ---------------------------
       Slide-in features on scroll
    --------------------------- */
    function revealFeatures() {
      const features = document.querySelectorAll('.feature-card');
      const windowBottom = window.innerHeight + window.scrollY;
      features.forEach(f => {
        if (windowBottom > f.offsetTop + 100) {
          f.classList.add('visible');
        }
      });
    }

    /* ---------------------------
       Animate statistics
    --------------------------- */
    function animateStats() {
      const statNumbers = document.querySelectorAll('.stat-number');
      statNumbers.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-count'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
          current += step;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          stat.textContent = Math.floor(current) + (stat.textContent.includes('%') ? '%' : '');
        }, 16);
      });
    }

    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          if (entry.target.classList.contains('stats')) {
            animateStats();
          }
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 });

    // Observe sections for animations
    const statsSection = document.querySelector('.stats');
    if (statsSection) observer.observe(statsSection);

    window.addEventListener('scroll', revealFeatures);
    window.addEventListener('load', revealFeatures);
  </script>
</body>

</html>