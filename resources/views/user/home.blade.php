@extends('layouts.index')

@section('title', 'أصوات جزائرية | الرئيسية')

@section('content')

    <style>
        /* Simple desktop loader */
        .web-loader {
            position: fixed;
            inset: 0;
            background: #0b0b0b; /* dark background to match site */
            display: none; /* default hidden, enabled on desktop */
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .web-loader .web-spinner {
            width: 48px;
            height: 48px;
            border: 3px solid rgba(255, 255, 255, 0.25);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: web-spin 1s linear infinite;
        }

        .web-loader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }

        @keyframes web-spin {
            to {
                transform: rotate(360deg);
            }
        }
        .art-section-hero {
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.0), rgba(0, 0, 0, 0.851)),
                url('{{ asset($principalTrend->trend->image) }}') center/cover no-repeat;
            color: #fff;
            direction: rtl;
            overflow: hidden;
        }

        .art-section-overlay {
            position: relative;
            /* makes sure content is on top of gradient */
            padding: 150px 20px 20px 20px;
            z-index: 1;
        }

        .art-section-title {
            text-align: right;
            font-size: 24px;
            margin-bottom: 24px;
            cursor: pointer;
        }

        .art-section-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .art-section-card {
            z-index: 1;
            /* cards are above gradient background */
        }

        .art-section-card img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
            border: 1px solid white;
        }

        .art-section-card h2 {
            margin-top: 5px;
            font-size: 15px;
            cursor: pointer;
        }

        .art-section-card h2:hover {
            margin-top: 5px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: underline;
        }

        /* Critical visibility CSS to avoid flash of wrong layout on first paint */
        .web { display: none; }
        .mobile { display: block; }
        .web-loader { display: none; }
        @media (min-width: 992px) {
            .web { display: block !important; }
            .mobile { display: none !important; }
            .web-loader { display: flex !important; }
        }
    </style>


    <!-- Simple loader (desktop only) -->
    <div id="web-loader" class="web-loader" role="status" aria-live="polite" aria-label="جارِ التحميل">
        <div class="web-spinner"></div>
    </div>

    <div class="web">
        @include('user.components.fixed-nav')

        {{-- topContents --}}
        @php
            $topContentsCount = isset($topContents) && is_countable($topContents) ? count($topContents) : 0;
        @endphp
        @if ($topContentsCount >= 7)
            <div class="container">
                @include('user.components.header')
                @include('user.components.sp60')
            </div>
        @endif

        {{-- Principal Trend Section --}}
        @if ($principalTrend->id == 1 and $principalTrend->trend->contents->count() >= 1 and $principalTrend->is_active == 1)
            <div class="container">
                <section class="art-section-hero">
                    <div class="art-section-overlay">
                        <h2 class="art-section-title">{{ $principalTrend->trend->title ?? '' }}</h2>

                        <div class="art-section-grid">
                            @foreach ($trends as $content)
                                <div class="art-section-card">
                                    <a href="{{ route('news.show', $content->title) }}">
                                        <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? asset($content->image) }}"
                                            alt="{{ $content->title }}">
                                    </a>
                                    <a href="{{ route('news.show', $content->title) }}"
                                        style="text-decoration: none; color: inherit;">
                                        <h2>{{ $content->title }}</h2>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                @include('user.components.sp60')
            </div>
        @endif

        @php
            $sections = [
                'world' => ['عالم', 5],
                'economy' => ['اقتصاد', 4],
                'sports' => ['رياضة', 6],
                'people' => ['ناس', 3],
            ];

            $algeriaItems = $algeria ?? [];
        @endphp

        {{-- Algeria section separately --}}
        @if (is_countable($algeriaItems) && count($algeriaItems) >= 4)
            @php $component = 'algeria'; @endphp {{-- define $component --}}
            <div class="container">
                @include('user.components.section-title', ['slot' => 'الجزائر', 'key' => $component])
                @include('user.components.algeria')
            </div>
        @endif

        {{-- Loop for the other sections --}}
        @foreach ($sections as $component => [$title, $minCount])
            @php
                $items = ${$component} ?? [];
            @endphp
            @if (is_countable($items) && count($items) >= $minCount)
                <div class="container">
                    @include('user.components.sp60')
                    @include('user.components.section-title', ['slot' => $title, 'key' => $component])
                    @include("user.components.$component")
                </div>
            @endif
        @endforeach




        {{-- Arts Section --}}
        @php
            $artsCount = isset($arts) && is_countable($arts) ? count($arts) : 0;
        @endphp
        @if ($artsCount >= 8)
            @include('user.components.sp60')
            <div class="container">
                <a href="{{ route('newSection', ['section' => 'culture']) }}" class="section-title">ثقافة وفنون</a>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
                @include('user.components.arts')
            </div>
        @endif

        {{-- Reviews Section --}}
        @php
            $reviewsCount = isset($reviews) && is_countable($reviews) ? count($reviews) : 0;
        @endphp
        @if ($reviewsCount >= 3)
            @include('user.components.sp60')
            <div class="container">
                <div class="title">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <a href="{{ route('reviews') }}" class="section-title">آراء</a>
                        @include('user.components.ligne')
                        <div class="under-title-ligne-space"></div>
                        <div style="display: flex;" class="icons">
                            <div id="reviewBackArrow" style="height: 32px; width: 32px; cursor: pointer;">
                                <img class="nav-logo" src="./user/assets/icons/chevron_forward.svg" alt="logo">
                            </div>
                            <div id="reviewNextArrow" style="height: 32px; width: 32px; margin-left: 5px; cursor: pointer;">
                                <img class="nav-logo" src="./user/assets/icons/chevron_backwar.svg" alt="logo">
                            </div>
                        </div>
                    </div>
                    @include('user.components.ligne')
                    <div class="under-title-ligne-space"></div>
                </div>
                @include('user.components.reviews')
            </div>
        @endif


        {{-- Videos Section --}}
        @php
            $videosCount = isset($videos) && is_countable($videos) ? count($videos) : 0;
        @endphp
        @if ($videosCount >= 4)
            @include('user.components.sp60')
            <div style="background-color: #F5F5F5;">
                @include('user.components.sp60')
                <div class="container">
                    <a href="{{ route('videos') }}" class="section-title">فيديو</a>
                    @include('user.components.ligne')
                    <div class="under-title-ligne-space"></div>
                </div>
                @include('user.components.videos')
                @include('user.components.sp60')
            </div>
        @endif


        {{-- Files Section --}}
        @php
            $filesCount = isset($files) && is_countable($files) ? count($files) : 0;
        @endphp
        @if ($filesCount >= 3)
            <div class="container">
                @include('user.components.sp60')
                <a href="{{ route('files') }}" class="section-title">ملفات</a>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
                @include('user.components.files')
            </div>
        @endif


        {{-- Many Titles --}}
        @php
            $manySections = [
                'technology' => ['تكنولوجيا', 3],
                'health' => ['صحة', 3],
                'environment' => ['بيئة', 3],
            ];
            $showManyTitles = true;
            foreach ($manySections as $key => [$title, $minCount]) {
                $items = ${$key} ?? [];
                if (!is_countable($items) || count($items) < $minCount) {
                    $showManyTitles = false;
                    break;
                }
            }
        @endphp
        @if ($showManyTitles)
            <div class="container">
                @include('user.components.sp60')
                @include('user.components.many-titles')
            </div>
        @endif


        {{-- Media Section --}}
        @php
            $mediaCount = isset($media) && is_countable($media) ? count($media) : 0;
        @endphp
        @if ($mediaCount >= 4)
            <div class="container">
                @include('user.components.sp60')
                @include('user.components.section-title', ['slot' => 'ميديا', 'component' => 'media'])
                @include('user.components.media')
            </div>
        @endif


        {{-- Check Section --}}
        @php
            $checkCount = isset($cheeck) && is_countable($cheeck) ? count($cheeck) : 0;
        @endphp
        @if ($checkCount >= 2)
            <div class="container">
                @include('user.components.sp60')
                <a href="{{ route('investigation') }}" class="section-title">فحص</a>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
                @include('user.components.check')
            </div>
        @endif

        {{-- Podcast Section --}}
        @php
            $podcastCount = isset($podcasts) && is_countable($podcasts) ? count($podcasts) : 0;
        @endphp
        @if ($podcastCount >= 4)
            @include('user.components.sp60')
            <div style="background-color: #F5F5F5;">
                @include('user.components.sp60')
                <div class="container">
                    <a href="{{ route('podcasts') }}" class="section-title">بودكاست</a>
                    @include('user.components.ligne')
                    <div class="under-title-ligne-space"></div>
                </div>
                @include('user.components.podcast')
                @include('user.components.sp60')
            </div>
        @endif


        {{-- Two Titles --}}
        @php
            $twoTitlesCount = isset($variety) && is_countable($variety) ? count($variety) : 0;
        @endphp
        @if ($twoTitlesCount >= 5)
            <div class="container">
                @include('user.components.sp60')
                @include('user.components.two-titles')
            </div>
        @endif



        {{-- Photos Section --}}
        @php
            $photosCount = isset($photos) && is_countable($photos) ? count($photos) : 0;
        @endphp
        @if ($photosCount >= 3)
            @include('user.components.sp60')
            <div style="background-color: #F5F5F5;">
                @include('user.components.sp60')
                <div class="container">
                    <div class="title">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="{{ route('photos') }}" class="section-title">صور</a>
                            @include('user.components.ligne')
                            <div class="under-title-ligne-space"></div>
                            <div style="display: flex;" class="icons">
                                <div id="backArrow" style="height: 32px; width: 32px; cursor: pointer;">
                                    <img class="nav-logo" src="./user/assets/icons/chevron_forward.svg" alt="logo">
                                </div>
                                <div id="nextArrow" style="height: 32px; width: 32px; margin-left: 5px; cursor: pointer;">
                                    <img class="nav-logo" src="./user/assets/icons/chevron_backwar.svg" alt="logo">
                                </div>
                            </div>
                        </div>
                        @include('user.components.ligne')
                        <div class="under-title-ligne-space"></div>
                    </div>
                    @include('user.components.photos')
                </div>
                @include('user.components.sp60')
            </div>
        @else
            @include('user.components.sp60')
        @endif

        @include('user.components.footer')

    </div>

    <div class="mobile">
        @include('user.mobile.mobile-home')

        <!-- Vertical snap container for mobile sections -->
        <div class="mobile-snap">
            <!-- Full-screen horizontal swipe (always 5 fake posts for now) -->
            <div class="mobile-h-wrapper">
                <div class="h-snap" dir="rtl">
                    @for ($i = 1; $i <= 5; $i++)
                        <a href="#"
                           class="h-snap-slide mobile-featured-post"
                           style="background-image: url('https://blog.govnet.co.uk/hs-fs/hubfs/shutterstock_2055335264.jpg?width=8088&height=4000&name=shutterstock_2055335264.jpg');"
                           aria-disabled="true" onclick="return false;">
                            <div class="post-overlay-dark"></div>
                            <div class="featured-post-content">
                                <p class="featured-post-category-name">تصنيف</p>
                                <h1 class="featured-post-title">عنوان تجريبي {{ $i }}</h1>
                                <p class="featured-post-description">وصف تجريبي مختصر لهذا المنشور لعرض النص أسفل الصورة.</p>
                            </div>
                        </a>
                    @endfor
                </div>
            </div>
            <!-- Full-screen horizontal swipe (always 5 fake posts for now) -->
            <div class="mobile-h-wrapper">
                <div class="h-snap" dir="rtl">
                    @for ($i = 1; $i <= 5; $i++)
                        <a href="#"
                           class="h-snap-slide mobile-featured-post"
                           style="background-image: url('https://blog.govnet.co.uk/hs-fs/hubfs/shutterstock_2055335264.jpg?width=8088&height=4000&name=shutterstock_2055335264.jpg');"
                           aria-disabled="true" onclick="return false;">
                            <div class="post-overlay-dark"></div>
                            <div class="featured-post-content">
                                <p class="featured-post-category-name">تصنيف</p>
                                <h1 class="featured-post-title">عنوان تجريبي {{ $i }}</h1>
                                <p class="featured-post-description">وصف تجريبي مختصر لهذا المنشور لعرض النص أسفل الصورة.</p>
                            </div>
                        </a>
                    @endfor
                </div>
            </div>
            <!-- Full-screen horizontal swipe (always 5 fake posts for now) -->
            <div class="mobile-h-wrapper">
                <div class="h-snap" dir="rtl">
                    @for ($i = 1; $i <= 5; $i++)
                        <a href="#"
                           class="h-snap-slide mobile-featured-post"
                           style="background-image: url('https://blog.govnet.co.uk/hs-fs/hubfs/shutterstock_2055335264.jpg?width=8088&height=4000&name=shutterstock_2055335264.jpg');"
                           aria-disabled="true" onclick="return false;">
                            <div class="post-overlay-dark"></div>
                            <div class="featured-post-content">
                                <p class="featured-post-category-name">تصنيف</p>
                                <h1 class="featured-post-title">عنوان تجريبي {{ $i }}</h1>
                                <p class="featured-post-description">وصف تجريبي مختصر لهذا المنشور لعرض النص أسفل الصورة.</p>
                            </div>
                        </a>
                    @endfor
                </div>
            </div>
            <!-- Full-screen horizontal swipe (always 5 fake posts for now) -->
            <div class="mobile-h-wrapper">
                <div class="h-snap" dir="rtl">
                    @for ($i = 1; $i <= 5; $i++)
                        <a href="#"
                           class="h-snap-slide mobile-featured-post"
                           style="background-image: url('https://blog.govnet.co.uk/hs-fs/hubfs/shutterstock_2055335264.jpg?width=8088&height=4000&name=shutterstock_2055335264.jpg');"
                           aria-disabled="true" onclick="return false;">
                            <div class="post-overlay-dark"></div>
                            <div class="featured-post-content">
                                <p class="featured-post-category-name">تصنيف</p>
                                <h1 class="featured-post-title">عنوان تجريبي {{ $i }}</h1>
                                <p class="featured-post-description">وصف تجريبي مختصر لهذا المنشور لعرض النص أسفل الصورة.</p>
                            </div>
                        </a>
                    @endfor
                </div>
            </div>
        </div>


    </div>


    <style>
        @media (max-width: 991px) {
            body {
                margin: 0;
                padding: 0;
                background-color: #000;
            }

            .web {
                display: none !important;
            }

            .mobile {
                display: block !important;
                margin: 0;
                padding: 0;
                background-color: #000;
            }

            /* Full Screen Featured Post */
            .mobile-featured-post {
                width: 100%;
                height: 100dvh;
                position: relative;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                overflow: hidden;
            }

            /* Horizontal snap wrapper (one vertical step) */
            .mobile-h-wrapper {
                width: 100%;
                height: 100vh;
                scroll-snap-align: start;
                scroll-snap-stop: always;
            }

            /* Horizontal snap track */
            .h-snap {
                height: 100%;
                width: 100%;
                display: grid;
                grid-auto-flow: column;
                grid-auto-columns: 100vw;
                overflow-x: auto;
                overflow-y: hidden;
                scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch;
                overscroll-behavior-x: contain;
                scrollbar-width: none; /* Firefox */
                direction: rtl; /* First slide at right for RTL */
            }

            .h-snap::-webkit-scrollbar {
                display: none; /* Hide scrollbar on WebKit */
            }

            .h-snap-slide {
                width: 100vw;
                height: 100%;
                scroll-snap-align: start;
                position: relative;
                display: block;
                text-decoration: none;
                color: inherit;
            }

            /* Dark Overlay */
            .post-overlay-dark {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to top, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.0), rgba(0, 0, 0, 0.0));
                z-index: 1;
            }

            /* Featured Post Content */
            .featured-post-content {
                position: absolute; /* pin block to bottom area */
                bottom: 160px; /* keep 80px empty space at the bottom of the page */
                left: 0;
                right: 0;
                z-index: 2;
                padding: 0 20px; /* horizontal padding only */
                color: #fff;
                direction: rtl;
                text-align: right;
            }

            .featured-post-category-name {
                margin: 0 0 10px 0;
                font-size: 20px;
                color: #ffffff;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .featured-post-title {
                margin: 0 0 15px 0;
                font-size: 32px;
                font-weight: 900;
                line-height: 1.4;
                color: #fff;
            }

            .featured-post-description {
                margin: 0; /* bottom space handled by container padding */
                font-size: 16px;
                color: #e0e0e0;
                line-height: 1.5;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
            }

            /* Featured Post Meta */
            .featured-post-meta {
                position: relative;
                z-index: 2;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px 20px;
                background-color: rgba(0, 0, 0, 0.8);
                direction: rtl;
                gap: 10px;
            }

            .post-category {
                display: inline-block;
                background-color: #d32f2f;
                color: #fff;
                padding: 6px 14px;
                border-radius: 3px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
            }

            .post-date {
                font-size: 12px;
                color: #999;
            }

            /* Professional CSS Scroll Snap - Instagram Reels Style */
            html,
            body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            /* Vertical snap scroller container */
            .mobile-snap {
                height: 100dvh;
                overflow-y: auto;
                scroll-behavior: smooth;
                scroll-snap-type: y mandatory;
                scroll-padding-top: 0;
                -webkit-overflow-scrolling: touch; /* iOS momentum scrolling */
            }

            .mobile-featured-post {
                height: 100vh;
                width: 100%;
                scroll-snap-align: start;
                scroll-snap-stop: always;
                flex-shrink: 0;
            }

            .mobile-container {
                scroll-snap-align: start;
                scroll-snap-stop: always;
            }

            /* Disable momentum scrolling interruption */
            body {
                -webkit-user-select: none;
                user-select: none;
            }
        }

        @media (min-width: 992px) {
            .web {
                display: block !important;
            }

            .mobile {
                display: none !important;
            }
        }
    </style>

    <script>
        // Hide desktop loader after full load
        window.addEventListener('load', function () {
            var l = document.getElementById('web-loader');
            if (l) {
                l.classList.add('hidden');
                setTimeout(function(){
                    if (l && l.parentNode) l.parentNode.removeChild(l);
                }, 300);
            }
        });
    </script>


