@foreach ($otherPhotos as $photo)
    <div class="photos-section-item">
        <img src="{{ $photo->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $photo->title }}">
        <h3> <x-category-links :content="$photo" /></h3>
        <a href="{{ route('news.show', $photo->title) }}" style="text-decoration: none; color: inherit;">
            <h2>{{ $photo->title }}</h2>
        </a>
    </div>
@endforeach
