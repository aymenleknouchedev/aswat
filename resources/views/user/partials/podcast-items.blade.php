@foreach ($otherPodcasts as $podcast)
    <div class="podcasts-section-item">
        <img src="{{ $podcast->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $podcast->title }}">
        <h3>{{ $podcast->category->name ?? '' }}</h3>
        <a href="{{ route('news.show', $podcast->title) }}" style="text-decoration: none; color: inherit;">
            <h2>{{ $podcast->title }}</h2>
        </a>
    </div>
@endforeach
