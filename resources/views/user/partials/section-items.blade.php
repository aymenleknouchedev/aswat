@foreach ($moreContents as $content)
    <div style="margin-bottom: 15px" class="newCategory-all-card">
        <div class="newCategory-all-card-image">
            <a href="{{ route('news.show', $content->shortlink) }}">
                <img loading="lazy" src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG19.jpg' }}"
                    alt="{{ $content->title ?? 'News Image' }}">
            </a>
        </div>
        <div class="newCategory-all-card-text">
            <h3> <x-category-links :content="$content" />
            </h3>
            <a href="{{ route('news.show', $content->shortlink) }}" style="text-decoration: none; color: inherit;">
                <h2>{{ $content->title ?? '' }}</h2>
            </a>
            <p>{{ $content->summary ?? '' }}</p>

        </div>
    </div>
@endforeach
