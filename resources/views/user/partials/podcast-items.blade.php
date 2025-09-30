@foreach ($podcasts as $podcast)
    <div class="custom-card">
        <div class="custom-card-left">
            <div class="custom-media-group">
                <div class="custom-card-date">
                    {{ $podcast->created_at->locale('ar')->translatedFormat('d F Y') }}
                </div>
                <div class="custom-image">
                    <img src="{{ $podcast->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $podcast->title }}">
                </div>
            </div>
            <div class="custom-texts">
                <h2>{{ $podcast->title }}</h2>
                <p>{{ $podcast->summary }}</p>
            </div>
        </div>
    </div>
@endforeach
