@foreach ($otherPodcasts as $podcast)
    <div class="podcasts-section-item">
        <a href="{{ route('news.show', $podcast->title) }}" class="podcasts-section-item-image-wrapper">
            <img src="{{ $podcast->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $podcast->title }}">
            <div class="podcasts-section-item-play-icon">
                <i class="fas fa-headphones"></i>
            </div>
        </a>
        <h3> <x-category-links :content="$podcast" /></h3>
        <a href="{{ route('news.show', $podcast->title) }}" style="text-decoration: none; color: inherit;">
            <h2>{{ $podcast->title }}</h2>
        </a>
    </div>
@endforeach
