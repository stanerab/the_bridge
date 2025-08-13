// main.js
document.addEventListener("DOMContentLoaded", function() {
  const fontToggleBtn = document.getElementById("fontToggle");

  // Apply stored font size on page load
  const storedSize = localStorage.getItem("fontSize");
  if (storedSize) {
    document.documentElement.style.setProperty("--base-font-size", storedSize + "px");
  }

  // Only add event listener if button exists (menu page)
  if (fontToggleBtn) {
    fontToggleBtn.addEventListener("click", () => {
      let currentSize = parseInt(getComputedStyle(document.documentElement).getPropertyValue("--base-font-size"));
      let newSize = currentSize + 2; // Increase by 2px
      if (newSize > 24) newSize = 16; // Reset after 24px
      document.documentElement.style.setProperty("--base-font-size", newSize + "px");
      localStorage.setItem("fontSize", newSize);
    });
  }
});
