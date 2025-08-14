document.getElementById('fontToggle').addEventListener('click', function() {
    // Get the root html element
    const htmlElement = document.documentElement;
    
    // Get current font size or set default if not set
    let currentSize = parseFloat(getComputedStyle(htmlElement).fontSize) || 16;
    
    // Define size options (in pixels)
    const sizeOptions = [16, 18, 20]; // You can adjust these values
    
    // Find next size or cycle back to first
    const currentIndex = sizeOptions.indexOf(currentSize);
    const nextIndex = (currentIndex + 1) % sizeOptions.length;
    const newSize = sizeOptions[nextIndex];
    
    // Apply new font size
    htmlElement.style.fontSize = newSize + 'px';
    
    // Store preference in localStorage
    localStorage.setItem('preferredFontSize', newSize);
});

// Check for saved preference on page load
window.addEventListener('DOMContentLoaded', function() {
    const savedSize = localStorage.getItem('preferredFontSize');
    if (savedSize) {
        document.documentElement.style.fontSize = savedSize + 'px';
    }
});