<style>
    .many-titles-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .many-titles-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }



    .many-titles-feature-m {
        height: 355px;
    }

    .many-titles-feature-m img {
        width: 100%;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .many-titles-feature-m h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .many-titles-feature-m h2 {
        font-size: 18px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
        line-height: 1.4;
    }

    .many-titles-feature-m .top {
        height: 291px;
    }



    .many-titles-feature-m p {
        font-size: 14px;
        margin-top: 8px;
        line-height: 1.5;
        color: #555;
    }

    .many-titles-card {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        direction: rtl;
    }

    .many-titles-card-image {
        flex-shrink: 0;
        width: 120px;
    }

    .many-titles-card-image img {
        width: 100%;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .many-titles-card-text span {
        font-size: 12px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .many-titles-card-text p {
        font-size: 14px;
        margin: 0;
        line-height: 1.4;
        font-family: asswat-bold;
        color: #333;
    }

    /* Cursor pointer for many-titles categories */
    .many-titles-card-text span {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for many-titles titles */
    .many-titles-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    /* Cursor pointer + underline for main feature h2 titles */
    .many-titles-feature-m h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    /* Cursor pointer for main feature h3 categories */
    .many-titles-feature-m h3 {
        cursor: pointer;
    }

    @media (max-width: 1050px) {
        .many-titles-feature-m .top {
            height: 260px;
        }

        .many-titles-card-text p {
            font-size: 12px;
        }
    }
</style>

@php
    $manySections = [
        'technology' => ['تكنولوجيا'],
        'health' => ['صحة'],
        'environment' => ['بيئة'],
    ];
@endphp

<section class="many-titles-feature-grid">
    <div class="many-titles-grid-container">

        <!-- Column 1 -->
        <div>
            <p class="section-title"><a href="{{ route('newSection', ['section' => 'technology']) }}"
                    style="color: inherit; text-decoration: none;">تكنولوجيا</a></p>
            <div class="many-titles-column">
                @include('user.components.ligne')

                @if (isset($technology[0]))
                    <div class="many-titles-feature-m">
                        <div class="top">
                            <img src="{{ $technology[0]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                alt="{{ $technology[0]->title ?? '' }}">
                            <h3>
                                @if (isset($technology[0]->country))
                                    {{ $technology[0]->category->name ?? '' }} -
                                    {{ $technology[0]->country->name ?? '' }}
                                @elseif (isset($technology[0]->continent))
                                    {{ $technology[0]->category->name ?? '' }} -
                                    {{ $technology[0]->continent->name ?? '' }}
                                @else
                                    {{ $technology[0]->category->name ?? '' }}
                                @endif
                            </h3>
                            <h2>{{ $technology[0]->title ?? '' }}</h2>
                            <p>{{ $technology[0]->summary ?? '' }}</p>
                        </div>
                        {{-- <p>{{ $technology[0]->summary ?? '' }}</p> --}}
                    </div>
                @endif

                @foreach ($technology->slice(1, 2) as $item)
                    <div class="many-titles-card">
                        <div class="many-titles-card-image">
                            <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                alt="{{ $item->title ?? '' }}">
                        </div>
                        <div class="many-titles-card-text">
                            <span>
                                @if (isset($item->country))
                                    {{ $item->category->name ?? '' }} - {{ $item->country->name ?? '' }}
                                @elseif (isset($item->continent))
                                    {{ $item->category->name ?? '' }} - {{ $item->continent->name ?? '' }}
                                @else
                                    {{ $item->category->name ?? '' }}
                                @endif
                            </span>
                            <p>{{ $item->title ?? '' }}</p>
                            {{-- <p>{{ $item->summary ?? '' }}</p> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Column 2 -->
        <div>
            <p class="section-title">
                <a href="{{ route('newSection', ['section' => 'health']) }}"
                    style="color: inherit; text-decoration: none;">صحة</a>
            </p>
            <div class="many-titles-column">
                @include('user.components.ligne')

                @if (isset($health[0]))
                    <div class="many-titles-feature-m">
                        <div class="top">
                            <img src="{{ $health[0]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                alt="{{ $health[0]->title ?? '' }}">
                            <h3>
                                @if (isset($health[0]->country))
                                    {{ $health[0]->category->name ?? '' }} - {{ $health[0]->country->name ?? '' }}
                                @elseif (isset($health[0]->continent))
                                    {{ $health[0]->category->name ?? '' }} - {{ $health[0]->continent->name ?? '' }}
                                @else
                                    {{ $health[0]->category->name ?? '' }}
                                @endif
                            </h3>
                            <h2>{{ $health[0]->title ?? '' }}</h2>
                            <p>{{ $health[0]->summary ?? '' }}</p>
                        </div>
                        {{-- <p>{{ $health[0]->summary ?? '' }}</p> --}}
                    </div>
                @endif

                @foreach ($health->slice(1, 2) as $item)
                    <div class="many-titles-card">
                        <div class="many-titles-card-image">
                            <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                alt="{{ $item->title ?? '' }}">
                        </div>
                        <div class="many-titles-card-text">
                            <span>
                                @if (isset($item->country))
                                    {{ $item->category->name ?? '' }} - {{ $item->country->name ?? '' }}
                                @elseif (isset($item->continent))
                                    {{ $item->category->name ?? '' }} - {{ $item->continent->name ?? '' }}
                                @else
                                    {{ $item->category->name ?? '' }}
                                @endif
                            </span>
                            <p>{{ $item->title ?? '' }}</p>
                            {{-- <p>{{ $item->summary ?? '' }}</p> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Column 3 -->
        <div>
            <p class="section-title">
                <a href="{{ route('newSection', ['section' => 'environment']) }}"
                    style="color: inherit; text-decoration: none;">بيئة</a>
            </p>
            <div class="many-titles-column">
                @include('user.components.ligne')

                @if (isset($environment[0]))
                    <div class="many-titles-feature-m">
                        <div class="top">
                            <img src="{{ $environment[0]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                alt="{{ $environment[0]->title ?? '' }}">
                            <h3>
                                @if (isset($environment[0]->country))
                                    {{ $environment[0]->category->name ?? '' }} -
                                    {{ $environment[0]->country->name ?? '' }}
                                @elseif (isset($environment[0]->continent))
                                    {{ $environment[0]->category->name ?? '' }} -
                                    {{ $environment[0]->continent->name ?? '' }}
                                @else
                                    {{ $environment[0]->category->name ?? '' }}
                                @endif
                            </h3>
                            <h2>{{ $environment[0]->title ?? '' }}</h2>
                            <p>{{ $environment[0]->summary ?? '' }}</p>
                        </div>
                        {{-- <p>{{ $environment[0]->summary ?? '' }}</p> --}}
                    </div>
                @endif

                @foreach ($environment->slice(1, 2) as $item)
                    <div class="many-titles-card">
                        <div class="many-titles-card-image">
                            <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                alt="{{ $item->title ?? '' }}">
                        </div>
                        <div class="many-titles-card-text">
                            <span>
                                @if (isset($item->country))
                                    {{ $item->category->name ?? '' }} - {{ $item->country->name ?? '' }}
                                @elseif (isset($item->continent))
                                    {{ $item->category->name ?? '' }} - {{ $item->continent->name ?? '' }}
                                @else
                                    {{ $item->category->name ?? '' }}
                                @endif
                            </span>
                            <p>{{ $item->title ?? '' }}</p>
                            {{-- <p>{{ $item->summary ?? '' }}</p> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
