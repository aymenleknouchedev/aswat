{{-- resources/views/user/components/video-player.blade.php --}}

<style>
    .custom-video-wrapper {
        width: 100%;
        margin: 30px 0;
        overflow: hidden;
        background: #000;
        position: relative;
    }

    .custom-video-wrapper iframe,
    .custom-video-wrapper video {
        width: 100%;
        height: 100%;
        display: block;
        aspect-ratio: 16 / 9;
        border: none;
    }

    /* Make video poster/thumbnail cover the entire video area */
    .custom-video-wrapper video {
        object-fit: cover;
    }

    .custom-video-caption {
        background: #f6f6f6;
        color: #555;
        padding: 10px 14px;
        font-size: 15px;
        text-align: right;
        font-family: asswat-regular;
    }

    /* Video cover with play button */
    .video-cover {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        cursor: pointer;
        overflow: hidden;
        background: #000;
    }

    .video-cover img {
        transition: transform 0.3s ease;
    }

    .video-cover:hover img {
        transform: scale(1.05);
    }

    .play-button {
        position: absolute;
        bottom: 15px;
        left: 15px;
        transition: transform 0.3s ease;
        pointer-events: none;
    }

    .video-cover:hover .play-button {
        transform: scale(1.1);
    }
</style>

<script>
function loadYouTubeVideo(videoId) {
    const cover = document.getElementById('videoCover' + videoId);
    const player = document.getElementById('videoPlayer' + videoId);

    if (cover && player) {
        cover.style.display = 'none';
        player.style.display = 'block';
    }
}

function loadVimeoVideo(videoId) {
    const cover = document.getElementById('videoCover' + videoId);
    const player = document.getElementById('videoPlayer' + videoId);

    if (cover && player) {
        cover.style.display = 'none';
        player.style.display = 'block';
    }
}
</script>

@php
    // Detect if video is YouTube or Vimeo link
    $isYouTube = Str::contains($video, ['youtube.com', 'youtu.be', 'youtube.com/shorts']);
    $isVimeo = Str::contains($video, ['vimeo.com']);

    // Extract embed ID for YouTube
    if ($isYouTube) {
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([^&?\/\s]+)/', $video, $matches);
        $youtubeId = $matches[1] ?? null;
    }

    // Extract embed ID for Vimeo
    if ($isVimeo) {
        preg_match('/vimeo\.com\/(\d+)/', $video, $matches);
        $vimeoId = $matches[1] ?? null;
    }

    // Check if poster is provided for YouTube/Vimeo
    $hasPoster = isset($poster) && !empty($poster);
@endphp

<div class="custom-video-wrapper">
    @if ($isYouTube && !empty($youtubeId))
        @if ($hasPoster)
            {{-- Show poster as clickable cover for YouTube videos --}}
            @php
                $posterUrl = str_starts_with($poster, '/storage/') ? asset($poster) : $poster;
            @endphp
            <div class="video-cover" id="videoCover{{ $youtubeId }}" onclick="loadYouTubeVideo('{{ $youtubeId }}')">
                <img src="{{ $posterUrl }}" alt="Video thumbnail" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 16/9;">
                <div class="play-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M12 8L30 20L12 32V8Z" fill="#FFFFFF"/>
                    </svg>
                </div>
            </div>
            <div id="videoPlayer{{ $youtubeId }}" style="display: none;">
                <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1" title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen loading="lazy">
                </iframe>
            </div>
        @else
            <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" title="YouTube video player"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen loading="lazy">
            </iframe>
        @endif
    @elseif ($isVimeo && !empty($vimeoId))
        @if ($hasPoster)
            {{-- Show poster as clickable cover for Vimeo videos --}}
            @php
                $posterUrl = str_starts_with($poster, '/storage/') ? asset($poster) : $poster;
            @endphp
            <div class="video-cover" id="videoCover{{ $vimeoId }}" onclick="loadVimeoVideo('{{ $vimeoId }}')">
                <img src="{{ $posterUrl }}" alt="Video thumbnail" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 16/9;">
                <div class="play-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M12 8L30 20L12 32V8Z" fill="#FFFFFF"/>
                    </svg>
                </div>
            </div>
            <div id="videoPlayer{{ $vimeoId }}" style="display: none;">
                <iframe src="https://player.vimeo.com/video/{{ $vimeoId }}?autoplay=1" title="Vimeo video player"
                    allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy">
                </iframe>
            </div>
        @else
            <iframe src="https://player.vimeo.com/video/{{ $vimeoId }}" title="Vimeo video player"
                allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy">
            </iframe>
        @endif
    @else
        {{-- Local or hosted MP4 --}}
        @php
            // Generate proper URL for local videos
            $videoUrl = $video;
            if (str_starts_with($video, '/storage/')) {
                // Convert to asset URL for local storage videos
                $videoUrl = asset($video);
            } elseif (str_starts_with($video, 'storage/')) {
                // Handle missing leading slash
                $videoUrl = asset('/' . $video);
            } elseif (!filter_var($video, FILTER_VALIDATE_URL)) {
                // If not a valid URL and not a storage path, try asset helper
                $videoUrl = asset($video);
            }
        @endphp
        @php
            // Use provided poster, or default placeholder
            $posterImage = $poster ?? asset('user/assets/img/video-placeholder.jpg');

            // If poster is a path starting with /storage/, convert to full URL
            if (isset($poster) && str_starts_with($poster, '/storage/')) {
                $posterImage = asset($poster);
            }
        @endphp
        <video controls preload="metadata" poster="{{ $posterImage }}">
            <source src="{{ $videoUrl }}" type="video/mp4">
            متصفحك لا يدعم تشغيل الفيديو.
        </video>
    @endif

    @if (!empty($caption))
        <div class="custom-video-caption">{{ $caption }}</div>
    @endif
</div>
