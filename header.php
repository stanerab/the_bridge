<?php include_once('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADHD Bridge</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/css/style.css" />

  <style>
    :root {
      --bg-color: #ffffff;
      --text-color: #000000;
    }

    body,
    html {
      background-color: var(--bg-color);
      color: var(--text-color);
      transition: background-color 0.3s ease, color 0.3s ease;
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body.dark-mode,
    html.dark-mode {
      --bg-color: #121212;
      --text-color: #ffffff;
      --box-color: #27ae60;
      background-color: #121212 !important;
      color: #ffffff !important;
    }

    /* Exclude navbar and footer and their children from dark mode background/text/border overrides */
    body.dark-mode *:not(.navbar):not(.navbar *):not(nav):not(nav *):not(footer):not(footer *) {
      background-color: transparent !important;
      color: var(--text-color) !important;
      border-color: var(--text-color) !important;
    }

    /* Keep navbar light always */
    .navbar {
      background-color: #fff !important;
      color: #000 !important;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Keep footer light always */
    footer {
      background-color: #fff !important;
      color: #000 !important;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Icon always black */
    .theme-toggle-btn i {
      color: #000 !important;
      transition: color 0.3s ease;
    }

    /* Moon icon black on dark mode since navbar stays white */
    body.dark-mode .theme-toggle-btn i.bi-moon {
      color: #000 !important;
    }

    /* Professional theme toggle button inside navbar */
    .theme-toggle-btn {
      background-color: transparent;
      border: none;
      font-size: 1.4rem;
      color: inherit;
      padding: 6px;
      border-radius: 50%;
      transition: background-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
    }

    /* Smooth icon fade */
    .fade-icon {
      transition: opacity 0.25s ease;
    }

    .fade-out {
      opacity: 0;
    }
  </style>

  <script>
    // Apply saved theme before render
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark-mode');
      document.body?.classList.add('dark-mode');
    }
  </script>
</head>

<body>


  <!-- Navbar with dark mode toggle on right -->
  <nav class="navbar navbar-expand-md navbar-light bg-white py-2">
    <div class="container d-flex align-items-center justify-content-between">

      <!-- Left: Logo + Brand -->
      <div class="d-flex align-items-center gap-2">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <!-- SVG Logo -->
          <svg viewBox="0 0 100 100" width="36" height="36" role="img" aria-hidden="true">
            <defs>
              <linearGradient id="g1" x1="0" x2="1">
                <stop offset="0" stop-color="#FFD974" />
                <stop offset="1" stop-color="#FFB4A2" />
              </linearGradient>
            </defs>
            <circle cx="50" cy="50" r="50" fill="url(#g1)" />
            <path d="M36 60c8-18 28-18 34-6" stroke="#6F42C1" stroke-width="6" stroke-linecap="round" fill="none" />
          </svg>
          <!-- Brand Name -->
          <span class="ms-2 fw-bold text-dark">ADHD Bridge</span>
        </a>
      </div>
      <div class="col-md-4 text-md-end d-flex justify-content-end align-items-center gap-2">
        <div class="d-inline-block focus-badge px-3 py-2 rounded-pill">
          <small class="fw-medium"></small>
        </div>
        </a>
      </div>




      <!-- Right: Theme toggle button -->
      <div class="d-flex align-items-center gap-2">
        <button id="themeToggleBtn" class="btn btn-sm btn-outline-dark" title="Toggle theme">
          <i class="bi bi-sun fade-icon"></i>
        </button>
      </div>

    </div>
  </nav>

  <style>
    /* Ensure SVG logo has no border/background */
    .navbar svg {
      display: block;
      background: transparent;
    }
  </style>


  <script>
    const toggleBtn = document.getElementById('themeToggleBtn');
    const body = document.body;
    const html = document.documentElement;
    const icon = toggleBtn.querySelector('i');

    function setTheme(theme, animate = false) {
      if (animate) {
        icon.classList.add('fade-out');
        setTimeout(() => {
          icon.classList.remove('fade-out');
        }, 250);
      }

      if (theme === 'dark') {
        body.classList.add('dark-mode');
        html.classList.add('dark-mode');
        icon.classList.replace('bi-sun', 'bi-moon');
      } else {
        body.classList.remove('dark-mode');
        html.classList.remove('dark-mode');
        icon.classList.replace('bi-moon', 'bi-sun');
      }
      localStorage.setItem('theme', theme);
    }

    // Load saved theme
    if (localStorage.getItem('theme') === 'dark') {
      setTheme('dark');
    } else {
      setTheme('light');
    }

    toggleBtn.addEventListener('click', () => {
      if (body.classList.contains('dark-mode')) {
        setTheme('light', true);
      } else {
        setTheme('dark', true);
      }
    });
  </script>