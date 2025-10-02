@foreach ($otherVideos as $video)
    <div class="videos-section-item">
        <img src="{{ $video->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $video->title }}">
        <h3>{{ $video->category->name ?? '' }}</h3>
        <h2>{{ $video->title }}</h2>
    </div>
@endforeach
