{{-- Audio Player Component with Integrated Controls on Cover --}}
<div class="audio-player-container">
    {{-- Cover Image with Integrated Player --}}
    <figure class="audio-cover-wrapper">
        @if($cover)
            <img src="{{ $cover }}" alt="{{ $caption }}" class="audio-cover-image" loading="lazy">
        @else
            <div class="audio-cover-placeholder">
                <i class="fas fa-music"></i>
            </div>
        @endif

        {{-- Audio Player Overlay (appears on cover) --}}
        <div class="audio-overlay" id="audioOverlay">
            {{-- Darkened backdrop --}}
            <div class="audio-overlay-backdrop"></div>

            {{-- Play/Pause Button --}}
            <button class="audio-play-button" id="audioPlayButton" type="button" aria-label="تشغيل/إيقاف">
                <i class="fas fa-play" id="audioPlayIcon"></i>
            </button>

            {{-- Creative Progress Line --}}
            <div class="audio-progress-wrapper">
                <div class="audio-progress-line" id="audioProgressLine">
                    <div class="audio-progress-fill" id="audioProgressFill"></div>
                    <div class="audio-progress-dot" id="audioProgressDot"></div>
                </div>
            </div>
        </div>

        {{-- Hidden Audio Element --}}
        <audio id="audioElement" preload="metadata">
            <source src="{{ $audio }}" type="audio/mpeg">
            متصفحك لا يدعم تشغيل الصوت.
        </audio>

        {{-- Caption --}}
        @if($caption)
            <figcaption class="audio-caption">{{ $caption }}</figcaption>
        @endif
    </figure>
</div>

<style>
/* ===== Audio Player Container ===== */
.audio-player-container {
    position: relative;
    width: 100%;
    margin-bottom: 20px;
}

/* ===== Cover Image Wrapper ===== */
.audio-cover-wrapper {
    position: relative;
    width: 100%;
    margin: 0;
    overflow: hidden;
}

.audio-cover-image {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    display: block;
}

.audio-cover-placeholder {
    width: 100%;
    aspect-ratio: 16/9;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 4rem;
}

/* ===== Audio Overlay ===== */
.audio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
}

.audio-cover-wrapper:hover .audio-overlay,
.audio-overlay.is-playing {
    opacity: 1;
    pointer-events: auto;
}

/* ===== Darkened Backdrop ===== */
.audio-overlay-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    transition: background 0.3s ease;
}

.audio-overlay.is-playing .audio-overlay-backdrop {
    background: rgba(0, 0, 0, 0.6);
}

/* ===== Play/Pause Button ===== */
.audio-play-button {
    position: relative;
    z-index: 10;
    background: rgba(255, 255, 255, 0.95);
    border: none;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 30px;
}

.audio-play-button:hover {
    transform: scale(1.1);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
}

.audio-play-button:active {
    transform: scale(0.95);
}

.audio-play-button i {
    font-size: 32px;
    color: #667eea;
    transition: all 0.2s ease;
}

.audio-play-button.is-playing i {
    font-size: 28px;
}

/* ===== Creative Progress Line ===== */
.audio-progress-wrapper {
    position: relative;
    z-index: 10;
    width: 80%;
    max-width: 500px;
}

.audio-progress-line {
    position: relative;
    width: 100%;
    height: 4px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 2px;
    cursor: pointer;
    overflow: visible;
}

.audio-progress-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    background: linear-gradient(90deg, #fff 0%, rgba(255, 255, 255, 0.9) 100%);
    border-radius: 2px;
    width: 0%;
    transition: width 0.1s linear;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

.audio-progress-dot {
    position: absolute;
    top: 50%;
    left: 0%;
    transform: translate(-50%, -50%);
    width: 14px;
    height: 14px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
    transition: all 0.1s linear;
    opacity: 0;
}

.audio-overlay.is-playing .audio-progress-dot {
    opacity: 1;
}

.audio-progress-line:hover .audio-progress-dot {
    transform: translate(-50%, -50%) scale(1.3);
}

/* ===== Caption ===== */
.audio-caption {
    background: #F5F5F5;
    color: #555;
    font-size: 15px;
    padding: 10px;
    text-align: right;
    font-family: asswat-regular;
    direction: rtl;
}

/* ===== Animations ===== */
@keyframes pulse {
    0%, 100% {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    }
    50% {
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
    }
}

.audio-play-button.is-playing {
    animation: pulse 2s ease-in-out infinite;
}

/* ===== Responsive ===== */
@media (max-width: 768px) {
    .audio-play-button {
        width: 70px;
        height: 70px;
    }

    .audio-play-button i {
        font-size: 28px;
    }

    .audio-play-button.is-playing i {
        font-size: 24px;
    }

    .audio-progress-wrapper {
        width: 85%;
    }
}

@media (max-width: 480px) {
    .audio-play-button {
        width: 60px;
        height: 60px;
        margin-bottom: 20px;
    }

    .audio-play-button i {
        font-size: 24px;
    }

    .audio-play-button.is-playing i {
        font-size: 20px;
    }

    .audio-progress-wrapper {
        width: 90%;
    }

    .audio-progress-line {
        height: 3px;
    }

    .audio-progress-dot {
        width: 12px;
        height: 12px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const overlay = document.getElementById('audioOverlay');
    const audio = document.getElementById('audioElement');
    const playButton = document.getElementById('audioPlayButton');
    const playIcon = document.getElementById('audioPlayIcon');
    const progressLine = document.getElementById('audioProgressLine');
    const progressFill = document.getElementById('audioProgressFill');
    const progressDot = document.getElementById('audioProgressDot');

    // State
    let isDragging = false;

    // Play/Pause toggle
    playButton.addEventListener('click', function(e) {
        e.stopPropagation();
        togglePlayPause();
    });

    function togglePlayPause() {
        if (audio.paused) {
            audio.play();
        } else {
            audio.pause();
        }
    }

    // Update UI based on play/pause state
    audio.addEventListener('play', function() {
        playIcon.className = 'fas fa-pause';
        playButton.classList.add('is-playing');
        overlay.classList.add('is-playing');
    });

    audio.addEventListener('pause', function() {
        playIcon.className = 'fas fa-play';
        playButton.classList.remove('is-playing');
    });

    audio.addEventListener('ended', function() {
        playIcon.className = 'fas fa-play';
        playButton.classList.remove('is-playing');
        overlay.classList.remove('is-playing');
        audio.currentTime = 0;
    });

    // Update progress
    audio.addEventListener('timeupdate', function() {
        if (!isDragging && audio.duration) {
            const percent = (audio.currentTime / audio.duration) * 100;
            progressFill.style.width = `${percent}%`;
            progressDot.style.left = `${percent}%`;
        }
    });

    // Seek functionality
    function seekToPosition(e) {
        const rect = progressLine.getBoundingClientRect();
        const pos = (e.clientX - rect.left) / rect.width;
        const clampedPos = Math.max(0, Math.min(1, pos));
        audio.currentTime = clampedPos * audio.duration;

        // Update UI immediately
        const percent = clampedPos * 100;
        progressFill.style.width = `${percent}%`;
        progressDot.style.left = `${percent}%`;
    }

    // Progress bar click
    progressLine.addEventListener('click', function(e) {
        seekToPosition(e);
    });

    // Progress bar drag
    progressLine.addEventListener('mousedown', function(e) {
        isDragging = true;
        seekToPosition(e);
    });

    document.addEventListener('mousemove', function(e) {
        if (isDragging) {
            seekToPosition(e);
        }
    });

    document.addEventListener('mouseup', function() {
        isDragging = false;
    });

    // Touch support for mobile
    progressLine.addEventListener('touchstart', function(e) {
        isDragging = true;
        const touch = e.touches[0];
        const rect = progressLine.getBoundingClientRect();
        const pos = (touch.clientX - rect.left) / rect.width;
        const clampedPos = Math.max(0, Math.min(1, pos));
        audio.currentTime = clampedPos * audio.duration;
    });

    document.addEventListener('touchmove', function(e) {
        if (isDragging) {
            const touch = e.touches[0];
            const rect = progressLine.getBoundingClientRect();
            const pos = (touch.clientX - rect.left) / rect.width;
            const clampedPos = Math.max(0, Math.min(1, pos));
            audio.currentTime = clampedPos * audio.duration;

            const percent = clampedPos * 100;
            progressFill.style.width = `${percent}%`;
            progressDot.style.left = `${percent}%`;
        }
    });

    document.addEventListener('touchend', function() {
        isDragging = false;
    });

    // Keyboard support
    document.addEventListener('keydown', function(e) {
        // Only if audio is playing or overlay is visible
        if (overlay.classList.contains('is-playing')) {
            if (e.code === 'Space') {
                e.preventDefault();
                togglePlayPause();
            } else if (e.code === 'ArrowLeft') {
                e.preventDefault();
                audio.currentTime = Math.max(0, audio.currentTime - 5);
            } else if (e.code === 'ArrowRight') {
                e.preventDefault();
                audio.currentTime = Math.min(audio.duration, audio.currentTime + 5);
            }
        }
    });
});
</script>
