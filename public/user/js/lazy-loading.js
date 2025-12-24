// Show images only when completely loaded (global for all pages)
function setupLazyLoading() {
    const lazyImages = document.querySelectorAll('img[loading="lazy"]:not(.loaded)');
    lazyImages.forEach(img => {
        // If image is cached and already loaded
        if (img.complete) {
            img.classList.add('loaded');
        } else {
            // When image finishes loading
            img.addEventListener('load', function() {
                this.classList.add('loaded');
            });
            // Fallback: show even if error occurs
            img.addEventListener('error', function() {
                this.classList.add('loaded');
            });
        }
    });
}

// Run on initial page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupLazyLoading);
} else {
    setupLazyLoading();
}

// Handle dynamically added images
const observer = new MutationObserver(setupLazyLoading);
observer.observe(document.body, {
    childList: true,
    subtree: true
});
