<?php include("includes/header.php"); ?>

<!-- Particles Background (ONLY on this page) -->
<div id="particles-js"></div>

<!-- Main Hero Section -->
<div
  style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; color: black; text-align: center; position: relative; z-index: 1;">

  <img src="images/ADHD_bridge_logo.svg" alt="bridge" aria-labelledby="header-logo" loading="eager" decoding="async"
    class="rounded" style="color:transparent; max-width: 250px; height: auto; filter: contrast(1.2) brightness(1.1);" />

  <h1 style="margin-top: 24px; color: black; font-family: 'Segoe UI', sans-serif;">
  </h1>

  <a href="login.php"
    style="margin-top: 32px; padding: 12px 40px; background-color: #6f42c1; color: white; font-size: 18px; text-decoration: none; border: none; border-radius: 8px; display: inline-block;">
    Get Started →
  </a>
</div>

<!-- Particles.js CDN and Config (ONLY on index.php) -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
  particlesJS("particles-js", {
    particles: {
      number: { value: 60, density: { enable: true, value_area: 800 } },
      color: { value: "#333333" },  // Dark gray instead of white
      shape: {
        type: "circle",
        stroke: { width: 0, color: "#000000" }
      },
      opacity: { value: 0.8, random: false },  // More opaque
      size: { value: 3, random: true },
      line_linked: {
        enable: true,
        distance: 150,
        color: "#444444",  // Dark gray lines for visibility
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

<!-- Particles CSS -->
<style>
  #particles-js {
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 0;
    top: 0;
    left: 0;
  }

  body,
  html {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
    background-color: #ffffff;
    /* Pure white background */
  }
</style>