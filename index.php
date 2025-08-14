<!-- Particles Background (only below navbar) -->
<div id="particles-container">
  <div id="particles-js"></div>
</div>

<!-- Main Hero Section -->
<div class="hero-content"
  style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: calc(100vh - var(--navbar-height)); color: black; text-align: center; position: relative; z-index: 1;">

  <img src="images/ADHD_bridge_logo.svg" alt="bridge" aria-labelledby="header-logo" loading="eager" decoding="async"
    class="rounded" style="color:transparent; max-width: 250px; height: auto; filter: contrast(1.2) brightness(1.1);" />

  <h1 style="margin-top: 24px; color: black; font-family: 'Segoe UI', sans-serif;">
  </h1>

  <a href="choose_role.php"
    style="margin-top: 32px; padding: 12px 40px; background-color: #6f42c1; color: white; font-size: 18px; text-decoration: none; border: none; border-radius: 8px; display: inline-block;">
    Get Started →
  </a>
</div>

<!-- Particles.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
  particlesJS("particles-js", {
    particles: {
      number: { value: 60, density: { enable: true, value_area: 800 } },
      color: { value: "#333333" },
      shape: {
        type: "circle",
        stroke: { width: 0, color: "#000000" }
      },
      opacity: { value: 0.8, random: false },
      size: { value: 3, random: true },
      line_linked: {
        enable: true,
        distance: 150,
        color: "#444444",
        opacity: 0.6,
        width: 1
      },
      move: {
        enable: true,
        speed: 2,
        direction: "none",
        out_mode: "bounce"
      }
    },
    interactivity: {
      detect_on: "canvas",
      events: {
        onhover: { enable: true, mode: "grab" },
        onclick: { enable: true, mode: "push" }
      },
      modes: {
        grab: { distance: 200, line_linked: { opacity: 0.8 } },
        push: { particles_nb: 4 }
      }
    },
    retina_detect: true
  });
</script>

<!-- CSS -->
<style>
  /* Detect navbar height dynamically */
  :root {
    --navbar-height: 70px;
    /* default fallback */
  }

  nav.navbar {
    position: relative;
    z-index: 10;
  }

  /* Container for particles below navbar */
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
    z-index: 1;
  }

  body,
  html {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: #ffffff;
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