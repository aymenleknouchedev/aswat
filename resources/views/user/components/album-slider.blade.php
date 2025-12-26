<div class="album-slider">
    @php
        $sliderId = $sliderId ?? ('albumSlider_' . uniqid());
    @endphp
    @if(isset($albumImages) && $albumImages->count())
        <div class="slider-container" id="{{ $sliderId }}">

            @foreach($albumImages as $index => $image)
                <div class="slide {{ $index === 0 ? 'active' : '' }}">
                    <div class="image-placeholder">
                        <div class="spinner"></div>
                    </div>
                    <img src="{{ $image->path }}"
                         alt="{{ $image->alt ?? 'Album Image ' . ($index + 1) }}"
                         class="album-image-clickable"
                         data-index="{{ $index }}"
                         loading="lazy"
                         data-caption="{{ $index === 0 && isset($caption) ? $caption : ($image->alt ?? '') }}">
                    <div class="album-gallery-indicator">
                        <i class="fa-solid fa-images"></i>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Persistent caption for all slides --}}
        @if(isset($caption) && $caption)
            <div class="slide-caption">
                {{ $caption }}
            </div>
        @endif
    @else
        <p>لا توجد صور في الألبوم.</p>
    @endif
</div>

{{-- ================= CSS ================= --}}
<style>
.album-slider {
  
}

.slider-container {
    position: relative;
    overflow: hidden;
    background: #000;
}

.slide {
    display: none;
    position: relative;
}

.slide.active {
    display: block;
}

.slide img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    user-select: none;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.slide img:hover {
    opacity: 0.9;
}

/* ===== Image placeholder / loader ===== */
.image-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #111;
    background: radial-gradient(circle at center, #333 0, #000 60%);
    z-index: 2;
    transition: opacity 0.3s ease;
}

.image-placeholder .spinner {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top-color: #fff;
    animation: album-spinner 0.8s linear infinite;
}

@keyframes album-spinner {
    to { transform: rotate(360deg); }
}

/* When image finished loading */
.slide.loaded .image-placeholder {
    opacity: 0;
    pointer-events: none;
}

.slide.loaded img {
    opacity: 1;
}

/* ===== Gallery icon indicator ===== */
.album-gallery-indicator {
    position: absolute;
    left: 12px;
    bottom: 12px;
    color: #fff;
    border-radius: 999px;
    padding: 6px 10px;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    z-index: 3;
    pointer-events: none; /* keep image click behavior */
}

.album-gallery-indicator i {
    font-size: 14px;
}

/* ===== Caption ===== */
.slide-caption {
    background: #f6f6f6;
    color: #555;
    padding: 10px 14px;
    font-size: 15px;
    text-align: right;
    font-family: asswat-regular;
    direction: rtl;
}

/* ===== Arrows ===== */
.slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.15);
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 5;
    opacity: 0;
    pointer-events: none;
}

/* Fade-in arrows on hover */
.slider-container:hover .slider-btn {
    opacity: 1;
    pointer-events: all;
}

.slider-btn svg {
    stroke: #fff;
    transition: transform 0.3s ease, stroke 0.3s ease;
}

.slider-btn:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-50%) scale(1.1);
}

.slider-btn:hover svg {
    stroke: #fff; /* Keep arrow visible */
}

.prev-btn { left: 15px; }
.next-btn { right: 15px; }

/* ===== Responsive ===== */
@media (max-width: 768px) {
    .slide img {
        height: 250px;
    }

    .album-gallery-indicator {
        left: 10px;
        bottom: 10px;
        padding: 5px 8px;
        font-size: 16px;
    }

    .slider-btn {
        padding: 8px;
    }

    .slider-btn svg {
        width: 20px;
        height: 20px;
    }
}
</style>

{{-- ================= JS ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentSlideIndex = 0;
    const sliderContainer = document.getElementById('{{ $sliderId }}');
    if (!sliderContainer) {
        return;
    }
    const slides = sliderContainer.querySelectorAll('.slide');

    // Handle image loading / placeholder fade
    slides.forEach(slide => {
        const img = slide.querySelector('img');
        const placeholder = slide.querySelector('.image-placeholder');
        if (!img || !placeholder) return;

        function markLoaded() {
            slide.classList.add('loaded');
        }

        function markError() {
            placeholder.innerHTML = '<span style="color:#fff;font-family:asswat-regular;font-size:14px;">تعذر تحميل الصورة</span>';
        }

        if (img.complete && img.naturalWidth > 0) {
            markLoaded();
        } else {
            img.addEventListener('load', markLoaded, { once: true });
            img.addEventListener('error', markError, { once: true });
        }
    });

    function showSlide(index) {
        // Clamp index so slider does NOT loop infinitely
        if (index >= slides.length) index = slides.length - 1;
        if (index < 0) index = 0;
        currentSlideIndex = index;

        slides.forEach((s, i) => s.classList.toggle('active', i === currentSlideIndex));
    }

    function moveSlide(step) {
        showSlide(currentSlideIndex + step);
    }

    showSlide(currentSlideIndex);

    // Make moveSlide globally accessible for the buttons
    window.moveSlide = moveSlide;

    // Initialize album gallery for fullscreen viewing
    initializeAlbumGallery(sliderContainer);
});

/**
 * Initialize album gallery for fullscreen preview
 */
function initializeAlbumGallery(root) {
    if (!root) return;
    const albumImages = [];
    const clickableImages = root.querySelectorAll('.album-image-clickable');

    // Collect all album images with their data
    clickableImages.forEach((img, index) => {
        albumImages.push({
            src: img.src,
            caption: img.getAttribute('data-caption') || '',
            element: img,
            index: index
        });
    });

    // Add click handlers to all album images
    albumImages.forEach((imageData, index) => {
        imageData.element.addEventListener('click', function(e) {
            e.preventDefault();
            openAlbumGallery(index);
        });
    });

    /**
     * Open album gallery at specific index
     */
    function openAlbumGallery(index) {
        // Check if fullscreen modal exists (from news.blade.php)
        const fullscreenModal = document.getElementById('fullscreenImageModal');
        if (!fullscreenModal) {
            console.warn('Fullscreen modal not found');
            return;
        }

        const fullscreenImageContent = document.getElementById('fullscreenImageContent');
        const fullscreenImageCaption = document.getElementById('fullscreenImageCaption');
        const fullscreenImageCounter = document.getElementById('fullscreenImageCounter');
        const fullscreenImagePrev = document.getElementById('fullscreenImagePrev');
        const fullscreenImageNext = document.getElementById('fullscreenImageNext');

        let currentAlbumIndex = index;

        // Show current album image
        function showAlbumImage() {
            if (albumImages.length === 0) return;

            const currentImage = albumImages[currentAlbumIndex];
            fullscreenImageContent.src = currentImage.src;

            // Only show caption for the first image (main image/cover)
            if (currentAlbumIndex === 0 && currentImage.caption) {
                fullscreenImageCaption.textContent = currentImage.caption;
                fullscreenImageCaption.style.display = 'block';
            } else {
                fullscreenImageCaption.style.display = 'none';
            }

            // Update counter
            fullscreenImageCounter.textContent = `${currentAlbumIndex + 1} / ${albumImages.length}`;

            // Update navigation buttons
            fullscreenImagePrev.disabled = currentAlbumIndex === albumImages.length - 1;
            fullscreenImageNext.disabled = currentAlbumIndex === 0;

            // Show/hide navigation based on image count
            if (albumImages.length <= 1) {
                fullscreenImagePrev.style.display = 'none';
                fullscreenImageNext.style.display = 'none';
                fullscreenImageCounter.style.display = 'none';
            } else {
                fullscreenImagePrev.style.display = 'flex';
                fullscreenImageNext.style.display = 'flex';
                fullscreenImageCounter.style.display = 'block';
            }
        }

        // Navigate to previous image
        function showPreviousAlbumImage() {
            if (currentAlbumIndex < albumImages.length - 1) {
                currentAlbumIndex++;
                showAlbumImage();
            }
        }

        // Navigate to next image
        function showNextAlbumImage() {
            if (currentAlbumIndex > 0) {
                currentAlbumIndex--;
                showAlbumImage();
            }
        }

        // Set up navigation handlers
        const prevHandler = () => showPreviousAlbumImage();
        const nextHandler = () => showNextAlbumImage();

        // Remove any existing handlers and add new ones
        fullscreenImagePrev.onclick = prevHandler;
        fullscreenImageNext.onclick = nextHandler;

        // Show the modal with the current image
        showAlbumImage();
        fullscreenModal.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Handle keyboard navigation
        function handleKeyPress(e) {
            if (fullscreenModal.classList.contains('active')) {
                if (e.key === 'ArrowLeft') {
                    showNextAlbumImage();
                } else if (e.key === 'ArrowRight') {
                    showPreviousAlbumImage();
                }
            }
        }

        // Add keyboard listener
        document.addEventListener('keydown', handleKeyPress);

        // Clean up when modal closes
        const closeHandler = function() {
            document.removeEventListener('keydown', handleKeyPress);
            fullscreenModal.removeEventListener('transitionend', closeHandler);
        };

        fullscreenModal.addEventListener('transitionend', closeHandler);
    }
}
</script>
