<?php include("includes/header.php"); ?>
<h4>Menu</h4>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>ADHD Bridge - Menu</title>

  <style>
    /* Light mode defaults */
    :root {
      --bg-color: #ffffff;
      --text-color: #000000;
    }

    body,
    html {
      background-color: var(--bg-color);
      color: var(--text-color);
      transition: background-color 0.3s, color 0.3s;
      height: 100%;
      margin: 0;
      padding: 0;
    }

    /* Dark mode overrides for the page */
    body.dark-mode,
    html.dark-mode {
      --bg-color: #000000;
      /* pure black */
      --text-color: #ffffff;
      background-color: #000000 !important;
      color: #ffffff !important;
    }

    /* Make all elements follow the theme, EXCEPT navbar */
    body.dark-mode *:not(.navbar):not(.navbar *):not(nav):not(nav *) {
      background-color: transparent !important;
      color: var(--text-color) !important;
      border-color: var(--text-color) !important;
    }

    /* Toggle Switch styling */
    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 25px;
      vertical-align: middle;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: 0.4s;
      border-radius: 25px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 19px;
      width: 19px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: 0.4s;
      border-radius: 50%;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:checked+.slider:before {
      transform: translateX(25px);
    }
  </style>
</head>

<body>
  <ul>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact us</a></li>
    <li>
      Dark / Light mode
      <label class="switch">
        <input type="checkbox" id="themeToggle">
        <span class="slider"></span>
      </label>
    </li>
    <li><a href="#">Font size change</a></li>
  </ul>

  <script>
    const toggle = document.getElementById('themeToggle');
    const body = document.body;
    const html = document.documentElement;

    // Load saved theme
    if (localStorage.getItem('theme') === 'dark') {
      body.classList.add('dark-mode');
      html.classList.add('dark-mode');
      toggle.checked = true;
    }

    // Toggle theme
    toggle.addEventListener('change', function () {
      body.classList.toggle('dark-mode');
      html.classList.toggle('dark-mode');
      if (body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
    });
  </script>

</body>

</html>

<?php include("includes/footer.php"); ?>