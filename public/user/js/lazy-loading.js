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

// Run on load event (for cached images)
window.addEventListener('load', setupLazyLoading);

// Watch for dynamically added images (for AJAX/partial loads, mobile scrolling)
const observer = new MutationObserver((mutations) => {
    // Debounce to avoid running too frequently
    clearTimeout(observer.timeout);
    observer.timeout = setTimeout(setupLazyLoading, 50);
});

observer.observe(document.body, {
    childList: true,
    subtree: true
});

// Re-setup after user scrolls (for mobile snap container)
if (document.querySelector('.mobile-snap')) {
    const mobileSnap = document.querySelector('.mobile-snap');
    let scrollTimer;
    mobileSnap.addEventListener('scroll', () => {
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(setupLazyLoading, 100);
    }, { passive: true });
}
