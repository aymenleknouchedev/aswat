@foreach ($otherFiles as $file)
    <div class="files-section-item">
        <img src="{{ $file->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $file->title }}">
        <h3>{{ $file->category->name ?? '' }}</h3>
        <h2>{{ $file->title }}</h2>
    </div>
@endforeach
