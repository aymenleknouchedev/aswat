@foreach ($otherVideos as $video)
    <div class="videos-section-item">
        <a href="{{ route('news.show', $video->shortlink) }}" class="videos-section-item-image-wrapper">
            <img loading="lazy" src="{{ $video->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $video->title }}">
            <div class="videos-section-item-play-icon">
                <i class="fas fa-play"></i>
            </div>
        </a>
        <h3><x-category-links :content="$video" /></h3>
        <a href="{{ route('news.show', $video->shortlink) }}" style="text-decoration: none; color: inherit;">
            <h2>{{ $video->title }}</h2>
        </a>
    </div>
@endforeach
