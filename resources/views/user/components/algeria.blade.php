<style>
    .algeria-grid-container {
        display: grid;
        grid-template-columns: 8fr 4fr;
        /* Right: big, Left: list */
        gap: 20px;
    }

    .algeria-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .algeria-feature {
        position: relative;
    }

    .algeria-feature img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .algeria-feature h2 {
        font-size: 24px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
        line-height: 1.4;
    }

    .algeria-feature h3 {
        font-family: asswat-light;
        font-weight: lighter;
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
    }

    .algeria-feature p {
        font-size: 17px;
        color: #555;
        line-height: 1.5;
    }

    .algeria-feature-m img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .algeria-feature-m h2 {
        font-size: 18px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
        line-height: 1.4;
    }

    .algeria-feature-m h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .algeria-feature-m p {
        font-size: 14px;
        color: #555;
        line-height: 1.5;
    }

    .news-card-horizontal {
        display: flex;
        align-items: center;
        gap: 10px;
        direction: rtl;
        margin-bottom: 10px;

        /* Image right, text left for Arabic */
    }

    .news-card-horizontal .news-card-image img {
        width: 140px;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .news-card-horizontal .news-card-text {
        flex: 1;
    }

    .news-card-horizontal .news-card-text h3 {
        font-size: 12px;
        margin: 0 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .news-card-horizontal .news-card-text p {
        font-size: 14px;
        margin: 0;
        font-family: asswat-medium;
        line-height: 1.4;
    }

    .algeria-extra-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        background: #f5f5f5;
        margin-top: 30px;
    }

    .extra-item {
        position: relative;
        padding: 15px;
    }

    .extra-item h3 {
        font-size: 12px;
        color: #74747C;
        margin: 0 0 5px;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .extra-item p {
        font-size: 16px;
        font-family: asswat-medium;
        line-height: 1.5;
        margin: 0;
    }

    /* .extra-item:not(:first-child)::after {
        content: "";
        position: absolute;
        top: 15%;
        right: 0;
        height: 70%;
        width: 1px;
        background: #ccc;
    } */


    /* Cursor pointer for categories (h3) */
    .algeria-feature h3,
    .algeria-feature-m h3,
    .news-card-horizontal .news-card-text h3,
    .extra-item h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for titles (h2) */
    .algeria-feature h2:hover,
    .algeria-feature-m h2:hover,
    .news-card-horizontal .news-card-text p:hover,
    .extra-item p:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    @media (max-width: 992px) {
        .algeria-grid-container {
            grid-template-columns: 1fr;
        }

        .algeria-grid-container .algeria-list {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .algeria-grid-container .algeria-list-div {
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* Add space between the cards */
        }

        .algeria-grid-container .algeria-list-div .news-card-horizontal {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .algeria-grid-container .algeria-list-div .news-card-horizontal img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .algeria-grid-container .algeria-list-div .news-card-text p {
            font-weight: bold;
        }

    }
</style>



<section class="algeria-feature-grid">
    <div class="algeria-grid-container">
        @if (isset($algeria) && count($algeria) >= 4)
            <div class="algeria-feature">
                <img src="{{ $algeria[0]->media()->wherePivot('type', 'main')->first()->path }}" alt="Feature algeria">
                <h3>
                    @if (isset($algeria[0]->country))
                        {{ $algeria[0]->category->name ?? '' }} - {{ $algeria[0]->country->name ?? '' }}
                    @elseif (isset($algeria[0]->continent))
                        {{ $algeria[0]->category->name ?? '' }} - {{ $algeria[0]->continent->name ?? '' }}
                    @else
                        {{ $algeria[0]->category->name ?? '' }}
                    @endif
                </h3>
                <a href="{{ route('news.show', $algeria[0]->title) }}" style="text-decoration: none; color: inherit;">
                    <h2>{{ $algeria[0]->title }}</h2>
                </a>
                <p>{{ $algeria[0]->summary }}</p>
            </div>

            <div class="algeria-list">
                <div class="algeria-feature-m">
                    <img src="{{ $algeria[1]->media()->wherePivot('type', 'main')->first()->path }}"
                        alt="Feature algeria small">
                    <h3>
                        @if (isset($algeria[1]->country))
                            {{ $algeria[1]->category->name ?? '' }} - {{ $algeria[1]->country->name ?? '' }}
                        @elseif (isset($algeria[1]->continent))
                            {{ $algeria[1]->category->name ?? '' }} - {{ $algeria[1]->continent->name ?? '' }}
                        @else
                            {{ $algeria[1]->category->name ?? '' }}
                        @endif
                    </h3>
                    <a href="{{ route('news.show', $algeria[1]->title) }}"
                        style="text-decoration: none; color: inherit;">
                        <h2>{{ $algeria[1]->title }}</h2>
                    </a>
                    <p>{{ $algeria[1]->summary }}</p>
                </div>

                <div class="algeria-list-div">
                    <div class="news-card-horizontal">
                        <div class="news-card-image">
                            <img src="{{ $algeria[2]->media()->wherePivot('type', 'main')->first()->path }}"
                                alt="{{ $algeria[2]->title }}">
                        </div>
                        <div class="news-card-text">
                            <h3>
                                @if (isset($algeria[2]->country))
                                    {{ $algeria[2]->category->name ?? '' }} - {{ $algeria[2]->country->name ?? '' }}
                                @elseif (isset($algeria[2]->continent))
                                    {{ $algeria[2]->category->name ?? '' }} - {{ $algeria[2]->continent->name ?? '' }}
                                @else
                                    {{ $algeria[2]->category->name ?? '' }}
                                @endif
                            </h3>
                            <a href="{{ route('news.show', $algeria[2]->title) }}"
                                style="text-decoration: none; color: inherit;">
                                <p>{{ $algeria[2]->title }}</p>
                            </a>
                        </div>
                    </div>

                    <div class="news-card-horizontal">
                        <div class="news-card-image">
                            <img src="{{ $algeria[3]->media()->wherePivot('type', 'main')->first()->path }}"
                                alt="{{ $algeria[3]->title }}">
                        </div>
                        <div class="news-card-text">
                            <h3>
                                @if (isset($algeria[3]->country))
                                    {{ $algeria[3]->category->name ?? '' }} - {{ $algeria[3]->country->name ?? '' }}
                                @elseif (isset($algeria[3]->continent))
                                    {{ $algeria[3]->category->name ?? '' }} - {{ $algeria[3]->continent->name ?? '' }}
                                @else
                                    {{ $algeria[3]->category->name ?? '' }}
                                @endif
                            </h3>
                            <a href="{{ route('news.show', $algeria[3]->title) }}"
                                style="text-decoration: none; color: inherit;">
                                <p>{{ $algeria[3]->title }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Extra Titles Grid -->
    <div class="algeria-extra-grid">
        @if(isset($algeriaLatestImportant) && count($algeriaLatestImportant) > 3)
            @foreach($algeriaLatestImportant as $item)
                <div class="extra-item">
                    <h3>{{ $item->category->name ?? '' }}</h3>
                    <a href="{{ route('news.show', $item->title) }}" styl   e="text-decoration: none; color: inherit;">
                        <p>{{ $item->title }}</p>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</section>



</section>
