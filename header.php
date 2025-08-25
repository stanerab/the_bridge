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
  <nav class="navbar navbar-light bg-white px-3 d-flex justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="images/ADHD_bridge_logo2.svg" alt="ADHD Bridge Logo"
        style="max-width: 120px; height: auto; margin-right: 10px;" />
    </a>

    <!-- Right-aligned toggle -->
    <button id="themeToggleBtn" class="theme-toggle-btn" title="Toggle theme">
      <i class="bi bi-sun fade-icon"></i>
    </button>
  </nav>

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