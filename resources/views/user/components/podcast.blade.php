<style>
    .podcasts-grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .podcasts-card {
        display: flex;
        flex-direction: column;
    }

    .podcasts-card .image-wrapper {
        position: relative;
        /* مهم لتثبيت الأيقونة فقط داخل الصورة */
    }

    .podcasts-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .podcasts-card .video-icon {
        position: absolute;
        bottom: 15px;
        left: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .podcasts-card .video-icon svg {
        width: 16px;
        height: 16px;
        fill: #fff;
    }

    .podcasts-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .podcasts-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .podcasts-card p {
        font-size: 14px;
        color: #555;
    }

    /* جعل الهيدر قابل للنقر */
    .podcasts-card h3 {
        cursor: pointer;
    }

    /* إضافة تفاعل hover على العنوان */
    .podcasts-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>
<section class="podcasts-feature-grid">
    <div class="podcasts-grid-container container">
        @foreach ($podcasts as $podcast)
            <div class="podcasts-card">
                <a href="{{ route('news.show', $podcast->shortlink) }}">
                    <div class="image-wrapper">
                        <img loading="lazy" src="{{ $podcast->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                            alt="{{ $podcast->title ?? '' }}">
                        <div class="video-icon">
                            @include('user.icons.headphones')
                        </div>
                    </div>
                </a>
                <h3>
                    <x-category-links :content="$podcast" />

                </h3>
                <a href="{{ route('news.show', $podcast->shortlink) }}" style="text-decoration: none; color: inherit;">
                    <h2>{{ $podcast->title ?? '' }}</h2>
                </a>
            </div>
        @endforeach
    </div>
</section>
