@foreach ($articles as $item)
    <div class="newCategory-all-card">
        <!-- Image -->
        <div class="newCategory-all-card-image">
            <a href="{{ route('news.show', $item->shortlink) }}">
                <img loading="lazy" src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                    alt="{{ $item->title }}">
            </a>
        </div>

        <!-- Text -->
        <div class="newCategory-all-card-text">
            <h3>{{ $item->category->name ?? '' }}</h3>
            <a href="{{ route('news.show', $item->shortlink) }}"
                style="text-decoration: none; color: inherit;">
                <h2>{{ $item->title }}</h2>
            </a>
            <p>{{ $item->summary }}</p>
        </div>
    </div>
@endforeach
