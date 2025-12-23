@foreach ($otherFiles as $file)
    <div class="files-section-item">
        <a href="{{ route('news.show', $file->shortlink) }}">
            <img loading="lazy" src="{{ $file->media()->wherePivot('type', 'main')->first()->path }}" alt="{{ $file->title }}">
        </a>
        <h3>{{ $file->category->name ?? '' }}</h3>
        <a href="{{ route('news.show', $file->shortlink) }}" style="text-decoration: none; color: inherit;">
            <h2>{{ $file->title }}</h2>
        </a>
    </div>
@endforeach
