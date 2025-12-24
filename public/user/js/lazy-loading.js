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
            }, { once: true });
            // Fallback: show even if error occurs
            img.addEventListener('error', function() {
                this.classList.add('loaded');
            }, { once: true });
        }
    });
}

// Run immediately if DOM is ready
setupLazyLoading();

// Run on page load
document.addEventListener('DOMContentLoaded', setupLazyLoading);

// Watch for dynamically added images (for AJAX/partial loads)
const observer = new MutationObserver((mutations) => {
    // Debounce to avoid running too frequently
    clearTimeout(observer.timeout);
    observer.timeout = setTimeout(setupLazyLoading, 100);
});

observer.observe(document.body, {
    childList: true,
    subtree: true
});
