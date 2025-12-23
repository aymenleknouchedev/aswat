<style>
    .videos-grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .videos-card {
        display: flex;
        flex-direction: column;
    }

    .videos-card .image-wrapper {
        position: relative;
        /* مهم لتثبيت الأيقونة فقط داخل الصورة */
    }

    .videos-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .videos-card .video-icon {
        position: absolute;
        bottom: 15px;
        left: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .videos-card .video-icon svg {
        width: 16px;
        height: 16px;
        fill: #fff;
    }

    .videos-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .videos-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .videos-card p {
        font-size: 14px;
        color: #555;
    }

    /* Cursor pointer for videos categories */
    .videos-card h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for videos titles */
    .videos-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="videos-feature-grid">
    <div class="videos-grid-container container">
        @foreach ($videos as $item)
            <div class="videos-card">
                <a href="{{ route('news.show', $item->shortlink) }}">
                    <div class="image-wrapper">
                        <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                            alt="{{ $item->title ?? '' }}" loading="lazy">
                        <div class="video-icon">
                            @include('user.icons.play')
                        </div>
                    </div>
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
