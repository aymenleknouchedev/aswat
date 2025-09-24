<style>
    .world-grid-container {
        display: grid;
        grid-template-columns: 6fr 3fr 3fr;
        gap: 20px;
    }

    .world-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .world-feature {
        position: relative;
    }

    .world-feature img {
        width: 100%;
        aspect-ratio: 16 / 9;

    }

    .world-feature h2 {
        font-size: 24px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
    }

    .world-feature h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .world-feature p {
        font-size: 17px;
        color: #555;
    }

    .world-feature-m {
        height: 243px;

    }

    .world-feature-m img {
        width: 100%;
        aspect-ratio: 16 / 9;

    }

    .world-feature-m h2 {
        font-size: 16px;
        margin-top: 8px 0px;
        font-family: asswat-bold;
    }

    .world-feature-m h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .world-feature-m p {
        font-size: 14px;
        color: #555;
    }

    .world-feature h3,
    .world-feature-m h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for world titles */
    .world-feature h2:hover,
    .world-feature-m h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>



<section class="world-feature-grid">
    <div class="world-grid-container">
        <!-- Right column: big feature -->
        <div class="world-feature">
            <img src="{{ $world[0]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                alt="{{ $world[0]->title ?? '' }}">

            <h3>
                @if (isset($world[0]->country))
                    {{ $world[0]->category->name ?? '' }} - {{ $world[0]->country->name ?? '' }}
                @elseif (isset($world[0]->continent))
                    {{ $world[0]->category->name ?? '' }} - {{ $world[0]->continent->name ?? '' }}
                @else
                    {{ $world[0]->category->name ?? '' }}
                @endif
            </h3>
            <h2>{{ $world[0]->title ?? '' }}</h2>
            <p>{{ $world[0]->summary ?? '' }}</p>
        </div>

        <!-- Left column: small world cards -->
        <div class="world-list">
            @if (isset($world[1]))
                @php $item = $world[1]; @endphp
                <div class="world-feature-m">
                    <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $item->title ?? '' }}">
                    <h3>
                        @if (isset($item->country))
                            {{ $item->category->name ?? '' }} - {{ $item->country->name ?? '' }}
                        @elseif (isset($item->continent))
                            {{ $item->category->name ?? '' }} - {{ $item->continent->name ?? '' }}
                        @else
                            {{ $item->category->name ?? '' }}
                        @endif
                    </h3>
                    <h2>{{ $item->title ?? '' }}</h2>
                </div>
            @endif

            @if (isset($world[2]))
                @php $item = $world[2]; @endphp
                <div class="world-feature-m">
                    <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $item->title ?? '' }}">
                    <h3>
                        @if (isset($item->country))
                            {{ $item->category->name ?? '' }} - {{ $item->country->name ?? '' }}
                        @elseif (isset($item->continent))
                            {{ $item->category->name ?? '' }} - {{ $item->continent->name ?? '' }}
                        @else
                            {{ $item->category->name ?? '' }}
                        @endif
                    </h3>
                    <h2>{{ $item->title ?? '' }}</h2>
                </div>
            @endif

        </div>
        <!-- Left column: small world cards -->
        <div class="world-list">
            @if (isset($world[3]))
                @php $item = $world[3]; @endphp
                <div class="world-feature-m">
                    <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $item->title ?? '' }}">
                    <h3>
                        @if (isset($item->country))
                            {{ $item->category->name ?? '' }} - {{ $item->country->name ?? '' }}
                        @elseif (isset($item->continent))
                            {{ $item->category->name ?? '' }} - {{ $item->continent->name ?? '' }}
                        @else
                            {{ $item->category->name ?? '' }}
                        @endif
                    </h3>
                    <h2>{{ $item->title ?? '' }}</h2>
                </div>
            @endif

            @if (isset($world[4]))
                @php $item = $world[4]; @endphp
                <div class="world-feature-m">
                    <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $item->title ?? '' }}">
                    <h3>
                        @if (isset($item->country))
                            {{ $item->category->name ?? '' }} - {{ $item->country->name ?? '' }}
                        @elseif (isset($item->continent))
                            {{ $item->category->name ?? '' }} - {{ $item->continent->name ?? '' }}
                        @else
                            {{ $item->category->name ?? '' }}
                        @endif
                    </h3>
                    <h2>{{ $item->title ?? '' }}</h2>
                </div>
            @endif

        </div>



    </div>
</section>
