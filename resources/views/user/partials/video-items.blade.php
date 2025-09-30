@foreach ($videos as $video)
    <div class="custom-card">
        <div class="custom-card-left">
            <div class="custom-media-group">
                <div class="custom-card-date">
                    {{ $video->created_at->locale('ar')->translatedFormat('d F Y') }}
                </div>
                <div class="custom-image">
                    <img src="{{ $video->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $video->title }}">
                </div>
            </div>
            <div class="custom-texts">
                <h2>{{ $video->title }}</h2>
                <p>{{ $video->summary }}</p>
            </div>
        </div>
    </div>
@endforeach
