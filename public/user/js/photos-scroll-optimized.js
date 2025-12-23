/**
 * Optimized photos-scroll.js with lazy loading and caching
 * Replaces the synchronous API fetch with lazy loading and cache support
 */

const photos = [];
let photosLoaded = false;
let photosCache = null;

// ============== CACHING UTILITIES ==============

function getCachedPhotos() {
    try {
        const cached = localStorage.getItem('asswat_photos');
        const timestamp = localStorage.getItem('asswat_photos_time');
        
        if (cached && timestamp) {
            // Cache valid for 24 hours
            const age = Date.now() - parseInt(timestamp);
            if (age < 24 * 60 * 60 * 1000) {
                return JSON.parse(cached);
            }
        }
    } catch (e) {
        console.warn('Failed to retrieve cached photos:', e);
    }
    return null;
}

function cachePhotos(data) {
    try {
        localStorage.setItem('asswat_photos', JSON.stringify(data));
        localStorage.setItem('asswat_photos_time', Date.now().toString());
    } catch (e) {
        console.warn('Failed to cache photos:', e);
    }
}

// ============== PHOTO LOADING ==============

function loadPhotos() {
    if (photosLoaded) {
        return Promise.resolve(photos);
    }
    
    return new Promise((resolve) => {
        // Try to load from cache first
        photosCache = getCachedPhotos();
        if (photosCache && photosCache.length > 0) {
            photos.length = 0;
            photos.push(...photosCache);
            photosLoaded = true;
            resolve(photos);
            return;
        }
        
        // Fetch from API with timeout
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 5000);
        
        fetch('/api/photos', { 
            signal: controller.signal,
            headers: { 'Accept': 'application/json' }
        })
            .then(response => {
                clearTimeout(timeoutId);
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (Array.isArray(data) && data.length > 0) {
                    photos.length = 0;
                    photos.push(...data);
                    cachePhotos(data);
                }
                photosLoaded = true;
                resolve(photos);
            })
            .catch(err => {
                clearTimeout(timeoutId);
                console.error('Failed to fetch photos:', err);
                
                // Fall back to cache even if expired
                if (!photosCache) {
                    photosCache = getCachedPhotos();
                    if (photosCache && photosCache.length > 0) {
                        photos.length = 0;
                        photos.push(...photosCache);
                    }
                }
                
                photosLoaded = true;
                resolve(photos);
            });
    });
}

// ============== INTERSECTION OBSERVER FOR LAZY LOADING ==============

function observePhotosSection() {
    const photosEl = document.querySelector('.photos-feature');
    if (!photosEl) return;
    
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loadPhotos().then(() => {
                        // Initialize carousel/functionality after photos load
                        if (typeof initPhotoCarousel === 'function') {
                            initPhotoCarousel();
                        }
                    });
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1, rootMargin: '50px' }
    );
    
    observer.observe(photosEl);
}

// ============== INITIALIZATION ==============

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', observePhotosSection);
} else {
    observePhotosSection();
}

// ============== PHOTO CAROUSEL INITIALIZATION ==============

let currentIndex = 0;

function initPhotoCarousel() {
    if (photos.length === 0) return;
    
    const photoImage = document.getElementById('photoImage');
    const photoCategory = document.getElementById('photoCategory');
    const photoTitle = document.getElementById('photoTitle');
    const photoDescription = document.getElementById('photoDescription');
    const photoLink = document.querySelector('.photos-feature a');
    const photoTitleLink = document.querySelector('.photos-feature .content a');
    const backArrow = document.getElementById('backArrow');
    const nextArrow = document.getElementById('nextArrow');
    
    if (!photoImage) return;
    
    // Preload images with loading="lazy"
    photos.forEach((photo, index) => {
        const img = new Image();
        // Only eagerly preload first 3, rest lazy load
        if (index < 3) {
            img.src = photo.image;
        } else {
            img.loading = 'lazy';
            img.src = photo.image;
        }
    });
    
    // Update UI with current photo
    function updatePhoto() {
        const photo = photos[currentIndex];
        if (!photo) return;
        
        photoImage.src = photo.image;
        photoImage.loading = 'lazy';
        photoImage.decoding = 'async';
        
        if (photoCategory) photoCategory.textContent = photo.category || '';
        if (photoTitle) photoTitle.textContent = photo.title || '';
        if (photoDescription) photoDescription.textContent = photo.description || '';
        if (photoLink) photoLink.href = photo.link || '#';
        if (photoTitleLink) photoTitleLink.href = photo.link || '#';
        
        updateArrows();
    }
    
    // Update arrows visibility
    function updateArrows() {
        if (backArrow) {
            backArrow.classList.toggle('disabled', currentIndex === 0);
        }
        if (nextArrow) {
            nextArrow.classList.toggle('disabled', currentIndex === photos.length - 1);
        }
    }
    
    // Navigation handlers
    if (backArrow) {
        backArrow.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updatePhoto();
            }
        });
    }
    
    if (nextArrow) {
        nextArrow.addEventListener('click', () => {
            if (currentIndex < photos.length - 1) {
                currentIndex++;
                updatePhoto();
            }
        });
    }
    
    // Initial update
    updatePhoto();
}

// Export for external use
window.photosScrollModule = {
    loadPhotos,
    initPhotoCarousel,
    getPhotos: () => photos,
    clearCache: () => {
        localStorage.removeItem('asswat_photos');
        localStorage.removeItem('asswat_photos_time');
        photos.length = 0;
        photosLoaded = false;
    }
};
