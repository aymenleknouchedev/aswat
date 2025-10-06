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

    .custom-video-caption {
        background: #f6f6f6;
        color: #555;
        padding: 10px 14px;
        font-size: 15px;
        text-align: right;
        font-family: asswat-regular;
    }
</style>

@php
    // Detect if video is YouTube or Vimeo link
    $isYouTube = Str::contains($video, ['youtube.com', 'youtu.be']);
    $isVimeo = Str::contains($video, ['vimeo.com']);

    // Extract embed ID for YouTube
    if ($isYouTube) {
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $video, $matches);
        $youtubeId = $matches[1] ?? null;
    }

    // Extract embed ID for Vimeo
    if ($isVimeo) {
        preg_match('/vimeo\.com\/(\d+)/', $video, $matches);
        $vimeoId = $matches[1] ?? null;
    }
@endphp

<div class="custom-video-wrapper">
    @if ($isYouTube && !empty($youtubeId))
        <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" title="YouTube video player"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen loading="lazy">
        </iframe>
    @elseif ($isVimeo && !empty($vimeoId))
        <iframe src="https://player.vimeo.com/video/{{ $vimeoId }}" title="Vimeo video player"
            allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy">
        </iframe>
    @else
        {{-- Local or hosted MP4 --}}
        <video controls preload="metadata" poster="{{ $poster ?? asset('user/assets/img/video-placeholder.jpg') }}">
            <source src="{{ $video }}" type="video/mp4">
            متصفحك لا يدعم تشغيل الفيديو.
        </video>
    @endif

    @if (!empty($caption))
        <div class="custom-video-caption">{{ $caption }}</div>
    @endif
</div>
