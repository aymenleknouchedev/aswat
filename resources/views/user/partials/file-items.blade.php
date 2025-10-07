@foreach ($otherFiles as $file)
    <div class="files-section-item">
        <img src="{{ $file->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $file->title }}">
        <h3>{{ $file->category->name ?? '' }}</h3>
        <a href="{{ route('news.show', $file->title) }}" style="text-decoration: none; color: inherit;">
            <h2>{{ $file->title }}</h2>
        </a>
    </div>
@endforeach
