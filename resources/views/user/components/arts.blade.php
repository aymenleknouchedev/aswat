<style>
    .arts-grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        /* 4 equal cards side by side */
        gap: 20px;
    }

    .arts-card {
        display: flex;
        flex-direction: column;
    }

    .arts-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
    }

    .arts-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .arts-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .arts-card p {
        font-size: 14px;
        color: #555;
    }

    /* Cursor pointer for arts categories */
    .arts-card h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for arts titles */
    .arts-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="arts-feature-grid">
    <div class="arts-grid-container">
        @foreach($arts as $item)
            <div class="arts-card">
                <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                    alt="{{ $item->title ?? '' }}">
                <h3>
                    @if (isset($item->location) && $item->location->type === 'country')
                        {{ $item->category->name ?? '' }} - {{ $item->location->name ?? '' }}
                    @elseif (isset($item->location) && $item->location->type === 'continent')
                        {{ $item->category->name ?? '' }} - {{ $item->location->name ?? '' }}
                    @else
                        {{ $item->category->name ?? '' }}
                    @endif
                </h3>
                <h2>{{ $item->title ?? '' }}</h2>
                {{-- <p>{{ $item->summary ?? '' }}</p> --}}
            </div>
        @endforeach
    </div>
</section>
