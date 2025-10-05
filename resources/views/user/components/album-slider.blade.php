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
                    <img src="{{ $image->path }}" alt="Album Image {{ $index + 1 }}">
                </div>
            @endforeach

            <button class="slider-btn next-btn" onclick="moveSlide(1)">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </button>
        </div>
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
    animation: fade 0.8s ease-in-out;
}

.slide.active {
    display: block;
}

.slide img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    user-select: none;
    transition: transform 0.3s ease-in-out;
}

.slide img:hover {
    transform: scale(1.02);
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

/* ===== Animation ===== */
@keyframes fade {
    from { opacity: 0.3; }
    to { opacity: 1; }
}

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
});
</script>
