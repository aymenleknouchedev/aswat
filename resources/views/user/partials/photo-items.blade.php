@foreach ($otherPhotos as $photo)
    <div class="photos-section-item">
        <img src="{{ $photo->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $photo->title }}">
        <h3>{{ $photo->category->name ?? '' }}</h3>
        <h2>{{ $photo->title }}</h2>
    </div>
@endforeach
