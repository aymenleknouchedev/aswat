<style>
    .media-grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        /* 4 equal cards side by side */
        gap: 20px;
    }

    .media-card {
        display: flex;
        flex-direction: column;
    }

    .media-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
    }

    .media-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .media-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .media-card p {
        font-size: 14px;
        color: #555;
    }

    /* Cursor pointer for media category */
    .media-card h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline for media title on hover */
    .media-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="media-feature-grid">
    <div class="media-grid-container">
        @foreach ($media as $item)
            <div class="media-card">
                <a href="{{ route('news.show', $item->shortlink) }}">
                    <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $item->title ?? '' }}" loading="lazy">
                </a>
                <h3>
                    <x-category-links :content="$item" />
                </h3>
                <a href="{{ route('news.show', $item->shortlink) }}" style="text-decoration: none; color: inherit;">
                    <h2>{{ $item->title ?? '' }}</h2>
                </a>
            </div>
        @endforeach
    </div>
</section>
