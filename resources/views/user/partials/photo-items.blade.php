@foreach ($otherPhotos as $photo)
    <div class="photos-section-item">
        <a href="{{ route('news.show', $photo->shortlink) }}" class="photos-section-item-image-wrapper">
            <img loading="lazy" src="{{ $photo->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $photo->title }}">
            <div class="photos-section-item-play-icon">
                <i class="fas fa-images"></i>
            </div>
        </a>
        <h3> <x-category-links :content="$photo" /></h3>
        <a href="{{ route('news.show', $photo->shortlink) }}" style="text-decoration: none; color: inherit;">
            <h2>{{ $photo->title }}</h2>
        </a>
    </div>
@endforeach
