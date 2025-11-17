<style>
    .check-grid-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        /* 4 equal cards side by side */
        gap: 20px;
    }

    .check-card {
        display: flex;
        flex-direction: column;
    }

    .check-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
    }

    .check-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .check-card h2 {
        font-size: 24px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .check-card p {
        font-size: 14px;
        color: #555;
    }

    /* تفعيل المؤشر */
    .check-card h3 {
        cursor: pointer;
    }

    /* تفعيل التحديد على العنوان عند التحويم */
    .check-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="check-feature-grid">
    <div class="check-grid-container">
        @foreach ($cheeck as $item)
            <div class="check-card">
                <a href="{{ route('news.show', $item->title) }}">
                    <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $item->title ?? '' }}">
                </a>
                <h3>
                    <x-category-links :content="$item" />

                </h3>
                <a href="{{ route('news.show', $item->title) }}" style="text-decoration: none; color: inherit;">
                    <h2>{{ $item->title ?? '' }}</h2>
                </a>
                <p>{{ $item->description ?? '' }}</p>
            </div>
        @endforeach
    </div>
</section>
