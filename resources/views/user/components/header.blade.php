<style>
    .news-grid-container {
        display: grid;
        grid-template-columns: 8fr 2fr 2fr;
        gap: 20px;
    }

    .news-list {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }


    .news-item {
        height: 250px;
    }

    .news-item-noimage {
        height: 110px;
    }

    .news-item-noimage h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .news-item-noimage p {
        font-size: 16px;
        font-family: asswat-bold;
    }

    .news-feature h3 {
        font-size: 12px;
        margin: 0px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .news-item img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        display: block;
    }

    .news-item h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .news-item p {
        font-size: 16px;
        font-family: asswat-bold;
    }

    .news-feature {
        position: relative;
    }

    .news-feature img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
    }

    .news-feature h2 {
        font-size: 24px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
    }

    .news-feature h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;

    }

    .news-feature p {
        font-size: 17px;
        color: #555;
    }

    /* === Titles: underline + pointer === */
    .news-feature h2:hover,
    .news-item p:hover,
    .news-item-noimage p:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    /* === Categories: pointer only === */
    .news-feature h3:hover,
    .news-item h3:hover,
    .news-item-noimage h3:hover {
        cursor: pointer;
    }

    @media (max-width: 1150px) {
        .news-list {
            gap: 10px;
        }
    }

    @media (max-width: 992px) {
        .news-grid-container {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: repeat(3, auto);
        }

        .news-list {
            display: flex;
            flex-direction: row;
            gap: 40px;
        }

        .news-list>* {
            flex: 1 1 0;
            max-width: 33.33%;
        }

        .news-list .news-item {
            height: 100px;
        }

        .news-list .news-item img {
            display: none;
        }

        .news-list .news-item p {
            font-size: 15px;
        }

        .news-list .news-item-noimage p {
            font-size: 15px;
        }
    }
</style>




<section class="news-feature-grid" id="news-feature-grid">
    <div class="news-grid-container">
        <!-- Right column: big feature -->
        <div class="news-feature">
            <img src="{{ $topContents[0]->content->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                alt="{{ $topContents[0]->content->title ?? '' }}">
            <h3>
                @if (isset($topContents[0]->content->country))
                    {{ $topContents[0]->content->category->name ?? '' }} -
                    {{ $topContents[0]->content->country->name ?? '' }}
                @elseif (isset($topContents[0]->content->continent))
                    {{ $topContents[0]->content->category->name ?? '' }} -
                    {{ $topContents[0]->content->continent->name ?? '' }}
                @else
                    {{ $topContents[0]->content->category->name ?? '' }}
                @endif
            </h3>
            <a href="{{ route('news.show', $topContents[0]->content->title) }}" style="text-decoration: none; color: inherit;">
                <h2>{{ $topContents[0]->content->title ?? '' }}</h2>
            </a>
            <p>{{ $topContents[0]->content->summary ?? '' }}</p>
        </div>

        <!-- Left column: small news cards -->
        <div class="news-list">
            <div class="news-item">
                <img src="{{ $topContents[1]->content->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                    alt="News 1">
                <h3>
                    @if (isset($topContents[1]->content->country))
                        {{ $topContents[1]->content->category->name ?? '' }} -
                        {{ $topContents[1]->content->country->name ?? '' }}
                    @elseif (isset($topContents[1]->content->continent))
                        {{ $topContents[1]->content->category->name ?? '' }} -
                        {{ $topContents[1]->content->continent->name ?? '' }}
                    @else
                        {{ $topContents[1]->content->category->name ?? '' }}
                    @endif
                </h3>
                <a href="{{ route('news.show', $topContents[1]->content->title) }}" style="text-decoration: none; color: inherit;">
                    <p>{{ $topContents[1]->content->title ?? '' }}</p>
                </a>
            </div>
            <div class="news-item">
                <img src="{{ $topContents[2]->content->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                    alt="News 2">
                <h3>
                    @if (isset($topContents[2]->content->country))
                        {{ $topContents[2]->content->category->name ?? '' }} -
                        {{ $topContents[2]->content->country->name ?? '' }}
                    @elseif (isset($topContents[2]->content->continent))
                        {{ $topContents[2]->content->category->name ?? '' }} -
                        {{ $topContents[2]->content->continent->name ?? '' }}
                    @else
                        {{ $topContents[2]->content->category->name ?? '' }}
                    @endif
                </h3>
                <a href="{{ route('news.show', $topContents[2]->content->title) }}" style="text-decoration: none; color: inherit;">
                    <p>{{ $topContents[2]->content->title ?? '' }}</p>
                </a>
            </div>
            <div class="news-item-noimage">
                <h3>
                    @if (isset($topContents[3]->content->country))
                        {{ $topContents[3]->content->category->name ?? '' }} -
                        {{ $topContents[3]->content->country->name ?? '' }}
                    @elseif (isset($topContents[3]->content->continent))
                        {{ $topContents[3]->content->category->name ?? '' }} -
                        {{ $topContents[3]->content->continent->name ?? '' }}
                    @else
                        {{ $topContents[3]->content->category->name ?? '' }}
                    @endif
                </h3>
                <a href="{{ route('news.show', $topContents[3]->content->title) }}" style="text-decoration: none; color: inherit;">
                    <p>{{ $topContents[3]->content->title ?? '' }}</p>
                </a>
            </div>
        </div>
        <!-- Left column: small news cards -->
        <div class="news-list">
            <div class="news-item">
                <img src="{{ $topContents[4]->content->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                    alt="News 1">
                <h3>
                    @if (isset($topContents[4]->content->country))
                        {{ $topContents[4]->content->category->name ?? '' }} -
                        {{ $topContents[4]->content->country->name ?? '' }}
                    @elseif (isset($topContents[4]->content->continent))
                        {{ $topContents[4]->content->category->name ?? '' }} -
                        {{ $topContents[4]->content->continent->name ?? '' }}
                    @else
                        {{ $topContents[4]->content->category->name ?? '' }}
                    @endif
                </h3>
                <a href="{{ route('news.show', $topContents[4]->content->title) }}" style="text-decoration: none; color: inherit;">
                    <p>{{ $topContents[4]->content->title ?? '' }}</p>
                </a>
            </div>
            <div class="news-item">
                <img src="{{ $topContents[5]->content->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                    alt="News 2">
                <h3>
                    @if (isset($topContents[5]->content->country))
                        {{ $topContents[5]->content->category->name ?? '' }} -
                        {{ $topContents[5]->content->country->name ?? '' }}
                    @elseif (isset($topContents[5]->content->continent))
                        {{ $topContents[5]->content->category->name ?? '' }} -
                        {{ $topContents[5]->content->continent->name ?? '' }}
                    @else
                        {{ $topContents[5]->content->category->name ?? '' }}
                    @endif
                </h3>
                <a href="{{ route('news.show', $topContents[5]->content->title) }}" style="text-decoration: none; color: inherit;">
                    <p>{{ $topContents[5]->content->title ?? '' }}</p>
                </a>
            </div>
            <div class="news-item-noimage">
                <h3>
                    @if (isset($topContents[6]->content->country))
                        {{ $topContents[6]->content->category->name ?? '' }} -
                        {{ $topContents[6]->content->country->name ?? '' }}
                    @elseif (isset($topContents[6]->content->continent))
                        {{ $topContents[6]->content->category->name ?? '' }} -
                        {{ $topContents[6]->content->continent->name ?? '' }}
                    @else
                        {{ $topContents[6]->content->category->name ?? '' }}
                    @endif
                </h3>
                <a href="{{ route('news.show', $topContents[6]->content->title) }}" style="text-decoration: none; color: inherit;">
                    <p>{{ $topContents[6]->content->title ?? '' }}</p>
                </a>
            </div>
        </div>

    </div>
</section>
