console.log("Font resizer script loaded!");

// Available font sizes
const FONT_SIZES = [16, 18, 20]; 
const STORAGE_KEY = 'appFontSize';

// Apply font size to the root element (html)
function applyFontSize(size) {
    document.documentElement.style.fontSize = `${size}px`;
}

// Get the next font size in the array
function getNextSize(currentSize) {
    const index = FONT_SIZES.indexOf(currentSize);
    return FONT_SIZES[(index + 1) % FONT_SIZES.length];
}

document.addEventListener('DOMContentLoaded', () => {
    // Initialize saved size or default
    let savedSize = parseInt(localStorage.getItem(STORAGE_KEY));
    if (!savedSize || !FONT_SIZES.includes(savedSize)) savedSize = FONT_SIZES[0];
    applyFontSize(savedSize);

    // Button click
    const btn = document.getElementById('fontToggle');
    btn.addEventListener('click', () => {
        // Always read current size from storage
        let current = parseInt(localStorage.getItem(STORAGE_KEY)) || FONT_SIZES[0];
        const next = getNextSize(current);
        applyFontSize(next);
        localStorage.setItem(STORAGE_KEY, next);
        console.log(`Font size changed to ${next}px`);
    });
});
    