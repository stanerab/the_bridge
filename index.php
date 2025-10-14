<!-- Particles Background -->
<div id="particles-container">
  <div id="particles-js"></div>
</div>

<!-- Main Hero Section -->
<div class="hero-content">
  <img src="images/ADHD_bridge_logo.svg" alt="ADHD Bridge Logo" class="rounded logo" />
  <h1 class="hero-title">Welcome to <span class="text-primary">ADHD Bridge</span></h1>
  <a href="login.php" class="btn-get-started">Get Started →</a>
</div>

<!-- Particles.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
  particlesJS("particles-js", {
    particles: {
      number: { value: 60, density: { enable: true, value_area: 800 } },
      color: { value: "#333333" },
      shape: { type: "circle", stroke: { width: 0, color: "#000000" } },
      opacity: { value: 0.8 },
      size: { value: 3, random: true },
      line_linked: { enable: true, distance: 150, color: "#444444", opacity: 0.6, width: 1 },
      move: { enable: true, speed: 2, direction: "none", out_mode: "bounce" }
    },
    interactivity: {
      detect_on: "canvas",
      events: { onhover: { enable: true, mode: "grab" }, onclick: { enable: true, mode: "push" } },
      modes: { grab: { distance: 200, line_linked: { opacity: 0.8 } }, push: { particles_nb: 4 } }
    },
    retina_detect: true
  });
</script>

<!-- CSS -->
<style>
  :root {
    --navbar-height: 70px;
  }

  body,
  html {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: #ffffff;
  }

  #particles-container {
    position: fixed;
    top: var(--navbar-height);
    left: 0;
    width: 100%;
    height: calc(100% - var(--navbar-height));
    z-index: 0;
  }

  #particles-js {
    width: 100%;
    height: 100%;
  }

  .hero-content {
    position: relative;
    z-index: 2;
    /* Make sure hero content is above particles */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: calc(100vh - var(--navbar-height));
    text-align: center;
    color: black;
  }

  .hero-content .logo {
    max-width: 250px;
    height: auto;
    filter: contrast(1.2) brightness(1.1);
  }

  .hero-title {
    margin-top: 24px;
    font-family: 'Segoe UI', sans-serif;
    font-size: 2rem;
  }

  .btn-get-started {
    margin-top: 32px;
    padding: 12px 40px;
    background-color: #6f42c1;
    color: white;
    font-size: 18px;
    text-decoration: none;
    border-radius: 8px;
    display: inline-block;
    position: relative;
    z-index: 3;
    /* ensure button is always clickable */
  }

  nav.navbar {
    position: relative;
    z-index: 10;
  }
</style>

<!-- JS to auto-detect navbar height -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector("nav.navbar");
    if (navbar) {
      const navHeight = navbar.offsetHeight + "px";
      document.documentElement.style.setProperty("--navbar-height", navHeight);
    }
  });
</script>