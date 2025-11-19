<div class="album-slider">
    <h3>ألبوم الصور</h3>

    @if(isset($albumImages) && $albumImages->count())
        <div class="slider-container" id="albumSlider">
            <button class="slider-btn prev-btn" onclick="moveSlide(-1)">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </button>

            @foreach($albumImages as $index => $image)
                <div class="slide {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ $image->path }}"
                         alt="{{ $image->alt ?? 'Album Image ' . ($index + 1) }}"
                         class="album-image-clickable"
                         data-index="{{ $index }}"
                         data-caption="{{ $index === 0 && isset($caption) ? $caption : ($image->alt ?? '') }}">
                </div>
            @endforeach

            <button class="slider-btn next-btn" onclick="moveSlide(1)">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </button>
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
    position: relative;
    max-width: 700px;
    margin: 50px auto;
    font-family: 'Tajawal', sans-serif;
}

.album-slider h3 {
    margin-bottom: 15px;
    font-size: 1.6rem;
    color: #111;
    font-weight: 600;
}

.slider-container {
    position: relative;
    overflow: hidden;
    background: #000;
}

.slide {
    display: none;
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
    transition: opacity 0.3s;
}

.slide img:hover {
    opacity: 0.9;
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
    let autoSlideInterval;
    const slides = document.querySelectorAll('.slide');
    const sliderContainer = document.getElementById('albumSlider');

    function showSlide(index) {
        if (index >= slides.length) currentSlideIndex = 0;
        else if (index < 0) currentSlideIndex = slides.length - 1;
        else currentSlideIndex = index;

        slides.forEach((s, i) => s.classList.toggle('active', i === currentSlideIndex));
    }

    function moveSlide(step) {
        showSlide(currentSlideIndex + step);
    }

    function startAutoSlide() {
        stopAutoSlide();
        autoSlideInterval = setInterval(() => moveSlide(1), 5000);
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    sliderContainer.addEventListener('mouseenter', stopAutoSlide);
    sliderContainer.addEventListener('mouseleave', startAutoSlide);

    showSlide(currentSlideIndex);
    startAutoSlide();

    // Make moveSlide globally accessible for the buttons
    window.moveSlide = moveSlide;

    // Initialize album gallery for fullscreen viewing
    initializeAlbumGallery();
});

/**
 * Initialize album gallery for fullscreen preview
 */
function initializeAlbumGallery() {
    const albumImages = [];
    const clickableImages = document.querySelectorAll('.album-image-clickable');

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
