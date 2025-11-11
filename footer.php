<footer id="mainFooter" class="fixed-bottom bg-white border-top d-flex justify-content-around py-2 transition-footer">
  <a href="home.php" class="text-muted text-center">
    <i class="bi bi-house-fill"></i><br>Home
  </a>
  <a href="toolkit.php" class="text-muted text-center">
    <i class="bi bi-people"></i><br>Toolkit
  </a>
  <a href="chat.php" class="text-muted text-center">
    <i class="bi bi-chat-dots"></i><br>Chat
  </a>
  <a href="menu.php" class="text-muted text-center">
    <i class="bi bi-list"></i><br>Menu
  </a>
</footer>

<script>
  let lastScrollTop = 0;
  const footer = document.getElementById("mainFooter");
  const scrollThreshold = 10; // minimal movement before triggering

  window.addEventListener("scroll", () => {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (Math.abs(currentScroll - lastScrollTop) <= scrollThreshold) return;

    if (currentScroll > lastScrollTop) {
      // Scrolling down
      footer.style.transform = "translateY(100%)";
    } else {
      // Scrolling up
      footer.style.transform = "translateY(0)";
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
  });
</script>


<style>
  .transition-footer {
    transition: transform 0.3s ease-in-out;
    box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
  }
</style>