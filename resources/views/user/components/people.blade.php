<style>
    .people-grid-container {
        display: grid;
        grid-template-columns: 8fr 4fr;
        /* Right: big, Left: list */
        gap: 20px;
    }

    .people-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .people-feature {
        position: relative;
        background-color: #F5F5F5;
    }

    .people-feature img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .people-feature .buttom-side {
        padding: 25px;
    }

    .people-feature h2 {
        font-size: 24px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
        line-height: 1.4;
    }

    .people-feature h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .people-feature p {
        font-size: 17px;
        color: #555;
        line-height: 1.5;
    }

    .people-feature-m img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .people-feature-m h2 {
        font-size: 18px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
        line-height: 1.4;
    }

    .people-feature-m h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .people-feature-m p {
        font-size: 14px;
        color: #555;
        line-height: 1.5;
    }

    .people-card-horizontal {
        display: flex;
        align-items: center;
        gap: 10px;
        direction: rtl;
        /* Image right, text left for Arabic */
    }

    .people-card-horizontal .people-card-image img {
        width: 140px;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .people-card-horizontal .people-card-text {
        flex: 1;
    }

    .people-card-horizontal .people-card-text h3 {
        font-size: 12px;
        margin: 0 0 4px;
        color: #74747C;
    }

    .people-card-horizontal .people-card-text p {
        font-size: 14px;
        margin: 0;
        font-family: asswat-medium;
        line-height: 1.4;
    }

    /* Cursor pointer for people categories */
    .people-feature h3,
    .people-feature-m h3,
    .people-card-horizontal .people-card-text h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for people titles */
    .people-feature h2:hover,
    .people-feature-m h2:hover,
    .people-card-horizontal .people-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>



<section class="people-feature-grid">
    <div class="people-grid-container">
        <!-- Right: big feature -->
        <div class="people-feature">
            <img src="{{ $people[0]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                alt="{{ $people[0]->title ?? '' }}">
            <div class="buttom-side">
                <h3>
                    @if (isset($people[0]->country))
                        {{ $people[0]->category->name ?? '' }} - {{ $people[0]->country->name ?? '' }}
                    @elseif (isset($people[0]->continent))
                        {{ $people[0]->category->name ?? '' }} - {{ $people[0]->continent->name ?? '' }}
                    @else
                        {{ $people[0]->category->name ?? '' }}
                    @endif
                </h3>
                <h2>{{ $people[0]->title ?? '' }}</h2>
                <p>{{ $people[0]->summary ?? '' }}</p>
            </div>
        </div>

        <!-- Left: list -->
        <div class="people-list">
            @foreach($people->slice(1, 2) as $person)
                <div class="people-feature-m">
                    <img src="{{ $person->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $person->title ?? '' }}">
                    <h3>
                        @if (isset($person->country))
                            {{ $person->category->name ?? '' }} - {{ $person->country->name ?? '' }}
                        @elseif (isset($person->continent))
                            {{ $person->category->name ?? '' }} - {{ $person->continent->name ?? '' }}
                        @else
                            {{ $person->category->name ?? '' }}
                        @endif
                    </h3>
                    <h2>{{ $person->title ?? '' }}</h2>
                </div>
            @endforeach
        </div>
    </div>
</section>
