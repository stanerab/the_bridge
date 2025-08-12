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

    body {
      background-color: var(--bg-color);
      color: var(--text-color);
      transition: background-color 0.3s, color 0.3s;
    }

    body.dark-mode {
      --bg-color: #121212;
      --text-color: #ffffff;
    }
  </style>
  <script>
    // Apply saved theme before page shows
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark-mode');
    }
  </script>



  <style>
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow-x: hidden;
    }
  </style>
</head>

<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-light bg-white px-3">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="images/ADHD_bridge_logo2.svg" alt="ADHD Bridge Logo" loading="eager" decoding="async"
        style="color:transparent; max-width: 120px; height: auto; margin-right: 10px;" class="rounded" />
      <span class="mb-0 h1"></span>
    </a>
  </nav>