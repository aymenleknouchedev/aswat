<style>
    .files-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .files-card {
        display: flex;
        flex-direction: row;
        align-items: flex-top;
        gap: 15px;
        direction: rtl;
    }

    .files-card .files-card-image {
        flex-shrink: 0;
        width: 160px;
        height: auto;
        /* ثابت أو نسبي حسب المساحة */
        aspect-ratio: 16/9;
    }

    .files-card .files-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .files-card .files-card-text {
        flex: 1;
    }

    .files-card .files-card-text p {
        font-size: 14px;
        margin: 0 0 4px;
        font-family: asswat-bold;
        color: #333;
        line-height: 1.4;
    }

    .files-card .files-card-text span {
        font-size: 12px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    /* Cursor pointer for files categories */
    .files-card .files-card-text span {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for files titles */
    .files-card .files-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    @media (max-width: 900px) {
        .files-card {
            display: grid;
            grid-template-columns: 1fr;
        }

        .files-card .files-card-image {
            flex-shrink: 0;
            width: 100% !important;
            height: auto;
            /* ثابت أو نسبي حسب المساحة */
            aspect-ratio: 16/9;
        }

        .files-card .files-card-image img {
            width: 100%;
            aspect-ratio: 16/9;
        }

    }
</style>

<section class="files-feature-grid">
    <div class="files-grid-container">
        @foreach ($files as $item)
            <div class="files-card">
                <div class="files-card-image">
                    <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $item->title ?? '' }}">
                </div>
                <div class="files-card-text">
                    <span>
                        @if (isset($item->location) && $item->location->type === 'country')
                            {{ $item->category->name ?? '' }} - {{ $item->location->name ?? '' }}
                        @elseif (isset($item->location) && $item->location->type === 'continent')
                            {{ $item->category->name ?? '' }} - {{ $item->location->name ?? '' }}
                        @else
                            {{ $item->category->name ?? '' }}
                        @endif
                    </span>
                    <p>{{ $item->title ?? '' }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
