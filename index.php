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
      /* deep purple */
      --bg-2: #8E44AD;
      --accent: #FFD974;
      /* soft yellow */
      --muted: rgba(255, 255, 255, 0.14);
      /* glass */
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
    }

    .theme-dark {
      --page-bg: linear-gradient(180deg, #24123b, #2f154b);
      --hero-text: #fff;
      --card-surface: rgba(255, 255, 255, 0.06);
      --section-bg: #120617;
      --section-text: #ddd;
    }

    /* base */
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

    /* HERO / GLASS */
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

    /* responsive layout change */
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

    /* small controls row */
    .hero-controls {
      margin-top: 1.25rem;
      display: flex;
      gap: .75rem;
      align-items: center;
      flex-wrap: wrap;
    }

    /* ILLUSTRATION (simple soft svg shapes) */
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

    /* FEATURES SECTION (light card) */
    .features {
      background: var(--section-bg);
      color: var(--section-text);
      padding: 64px 12px;
    }

    .feature-card {
      background: #fff;
      border-radius: 14px;
      padding: 18px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    /* Accessibility helpers */
    .lexend {
      font-family: 'Lexend', Inter, sans-serif;
    }

    .focus-mode * {
      transition: none !important;
    }

    /* less motion */
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

    /* focus outlines for keyboard users */
    :focus {
      outline: 3px dashed var(--accent);
      outline-offset: 3px;
      border-radius: 8px;
    }

    /* Reduced motion preference */
    @media (prefers-reduced-motion: reduce) {
      * {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
        scroll-behavior: auto !important;
      }
    }

    /* Small utilities */
    .control-chip {
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.06);
      padding: .35rem .6rem;
      font-size: .9rem;
      display: inline-flex;
      gap: .6rem;
      align-items: center;
    }
  </style>
</head>

<body class="theme-light" id="pageBody">

  <!-- NAV -->
  <nav class="navbar">
    <div class="container">
      <div class="d-flex align-items-center w-100 justify-content-between">
        <div class="d-flex align-items-center gap-2">
          <!-- simple inline SVG logo -->
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

          <!-- mobile hamburger -->
          <button class="btn btn-sm btn-outline-light d-md-none" id="mobileMenuBtn" aria-expanded="false"
            aria-controls="mobileMenu">☰</button>
        </div>
      </div>
    </div>

    <!-- mobile menu (hidden on md+) -->
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

          <!-- accessibility controls -->
          <div class="control-chip" title="Accessibility controls" style="margin-left:auto;">
            <label style="display:inline-flex;align-items:center;gap:.45rem;cursor:pointer;">
              <input id="lexendToggle" type="checkbox" style="display:none">
              <span id="lexendLabel">Lexend</span>
            </label>
            <button class="btn btn-sm btn-link text-white" id="focusToggle" style="text-decoration:none;">Focus</button>
          </div>
        </div>

        <div style="margin-top:14px;">
          <a class="text-white" href="#carouselSection" id="learnMoreLink">Learn more ↓</a>
        </div>
      </div>

      <div class="illustration" aria-hidden="true">
        <!-- Soft friendly svg illustration - replace later with your art/asset -->
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

              <!-- friendly character -->
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
          <button class="btn btn-sm btn-outline-light" data-bs-target="#infoCarousel" data-bs-slide-to="0"
            aria-label="Slide 1"></button>
          <button class="btn btn-sm btn-outline-light" data-bs-target="#infoCarousel" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button class="btn btn-sm btn-outline-light" data-bs-target="#infoCarousel" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="features">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="feature-card p-3 h-100">
            <h5>Daily Check-Ins</h5>
            <p class="small">Simple mood & activity notes that make patterns obvious over time.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-3 h-100">
            <h5>Guided Messages</h5>
            <p class="small">Templates to help with difficult conversations and reduce overload.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-3 h-100">
            <h5>Privacy First</h5>
            <p class="small">Control your sharing and keep personal notes private.</p>
          </div>
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
       THEME (light / dark) toggle
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
    themeBtn.addEventListener('click', () => {
      const next = body.classList.contains('theme-dark') ? 'light' : 'dark';
      applyTheme(next);
    });

    /* ---------------------------
       ACCESSIBILITY: Lexend font toggle
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
    lexendLabel.addEventListener('click', () => { applyLexend(!document.body.classList.contains('lexend')); });

    /* ---------------------------
       FOCUS MODE (ADHD friendly)
       toggles simplified layout + reduced motion
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
       Simple touch-swipe for bootstrap carousel
       --------------------------- */
    (function enableCarouselSwipe() {
      const carousel = document.getElementById('infoCarousel');
      if (!carousel) return;
      let startX = null;
      carousel.addEventListener('touchstart', e => {
        const t = e.touches[0];
        startX = t.clientX;
      }, { passive: true });
      carousel.addEventListener('touchmove', e => {
        if (!startX) return;
        const t = e.touches[0];
        const diff = startX - t.clientX;
        if (Math.abs(diff) > 30) {
          // swipe left -> next, swipe right -> prev
          if (diff > 0) bootstrap.Carousel.getInstance(carousel).next();
          else bootstrap.Carousel.getInstance(carousel).prev();
          startX = null;
        }
      }, { passive: true });
    })();

    /* ---------------------------
       Initialize Bootstrap carousel programmatically (if needed)
       --------------------------- */
    document.addEventListener('DOMContentLoaded', function () {
      const el = document.getElementById('infoCarousel');
      if (el && !bootstrap.Carousel.getInstance(el)) {
        new bootstrap.Carousel(el, { interval: 4000, ride: 'carousel', touch: false });
      }
    });
  </script>
</body>

</html>