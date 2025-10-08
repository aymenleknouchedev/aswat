<style>
    .sport-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* 3 equal columns */
        gap: 20px;
    }

    .sport-feature {
        display: flex;
        flex-direction: column;
    }

    .sport-feature img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .sport-feature h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .sport-feature h2 {
        font-size: 16px;
        margin: 0px 0px 4px 0px;
        font-family: asswat-bold;
        color: #333;
    }

    .sport-feature p {
        font-size: 13px;
        color: #555;
        /* margin-top: 25px; */
    }

    .sport-card-horizontal {
        display: flex;
        align-items: center;
        gap: 10px;
        direction: rtl;
    }

    .sport-card-horizontal .sport-card-image img {
        width: 120px;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .sport-card-horizontal .sport-card-text {
        flex: 1;
    }

    .sport-card-horizontal .sport-card-text h3 {
        font-size: 12px;
        margin: 0 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .sport-card-horizontal .sport-card-text p {
        font-size: 14px;
        margin: 0;
        font-family: asswat-medium;
        line-height: 1.4;
    }

    .sport-column {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Cursor pointer for sport categories */
    .sport-feature h3,
    .sport-card-horizontal .sport-card-text h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for sport titles */
    .sport-feature h2:hover,
    .sport-card-horizontal .sport-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>
<section class="sport-feature-grid">
    <div class="sport-grid-container">
        <!-- Column 1 -->
        <div class="sport-feature">
            <img src="{{ $sports[0]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                alt="{{ $sports[0]->title ?? '' }}">
            <h3>
                @if (isset($sports[0]->country))
                    {{ $sports[0]->category->name ?? '' }} - {{ $sports[0]->country->name ?? '' }}
                @elseif (isset($sports[0]->continent))
                    {{ $sport[0]->category->name ?? '' }} - {{ $sport[0]->continent->name ?? '' }}
                @else
                    {{ $sport[0]->category->name ?? '' }}
                @endif
            </h3>
            <a href="{{ route('news.show', $sports[0]->title) }}" style="text-decoration: none; color: inherit;">
                <h2>{{ $sports[0]->title ?? '' }}</h2>
            </a>
            <p>{{ $sports[0]->summary ?? '' }}</p>
        </div>

        <!-- Column 2 -->
        <div class="sport-feature">
            <img src="{{ $sports[1]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                alt="{{ $sports[1]->title ?? '' }}">
            <h3>
                @if (isset($sports[1]->country))
                    {{ $sports[1]->category->name ?? '' }} - {{ $sports[1]->country->name ?? '' }}
                @elseif (isset($sports[1]->continent))
                    {{ $sports[1]->category->name ?? '' }} - {{ $sports[1]->continent->name ?? '' }}
                @else
                    {{ $sports[1]->category->name ?? '' }}
                @endif
            </h3>
            <a href="{{ route('news.show', $sports[1]->title) }}" style="text-decoration: none; color: inherit;">
                <h2>{{ $sports[1]->title ?? '' }}</h2>
            </a>
            <p>{{ $sports[1]->summary ?? '' }}</p>
        </div>

        <!-- Column 3: 4 stacked rows -->
        <div class="sport-column">
            @for ($i = 2; $i < 6; $i++)
                @if (isset($sports[$i]))
                    <div class="sport-card-horizontal">
                        <div class="sport-card-image">
                            <img src="{{ $sports[$i]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                alt="{{ $sports[$i]->title ?? '' }}">
                        </div>
                        <div class="sport-card-text">
                            <h3>
                                @if (isset($sports[$i]->country))
                                    {{ $sports[$i]->category->name ?? '' }} - {{ $sports[$i]->country->name ?? '' }}
                                @elseif (isset($sports[$i]->continent))
                                    {{ $sports[$i]->category->name ?? '' }} - {{ $sports[$i]->continent->name ?? '' }}
                                @else
                                    {{ $sports[$i]->category->name ?? '' }}
                                @endif
                            </h3>
                            <a href="{{ route('news.show', $sports[$i]->title) }}" style="text-decoration: none; color: inherit;">
                                <p>{{ $sports[$i]->title ?? '' }}</p>
                            </a>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
    </div>
</section>
