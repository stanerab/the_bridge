console.log("Font resizer script loaded!");
// Single source of truth for font sizes
const FONT_SIZES = [16, 18, 20];
const STORAGE_KEY = 'appFontSize';

function applyFontSize(size) {
    document.documentElement.style.fontSize = `${size}px`;
}

function getNextSize(currentSize) {
    const currentIndex = FONT_SIZES.indexOf(currentSize);
    const nextIndex = (currentIndex + 1) % FONT_SIZES.length;
    return FONT_SIZES[nextIndex];
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Apply saved size
    const savedSize = parseInt(localStorage.getItem(STORAGE_KEY)) || FONT_SIZES[0];
    applyFontSize(savedSize);

    // Setup event listener
    document.body.addEventListener('click', (e) => {
        if (e.target.id === 'fontToggle') {
            const current = parseInt(getComputedStyle(document.documentElement).fontSize);
            const newSize = getNextSize(current);
            applyFontSize(newSize);
            localStorage.setItem(STORAGE_KEY, newSize);
        }
    });
});