@extends('layouts.index')

@section('title', 'أصوات جزائرية | كُن في الصورة')

@section('content')

    <!-- Page Loader -->
    <style>
        .page-loader {
            position: fixed;
            inset: 0;
            background: #ffffff;
            /* dark to match site */
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 300ms ease;
        }

        .page-loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loader-spinner {
            width: 56px;
            height: 56px;
            border: 4px solid rgba(255, 255, 255, 0.25);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <div id="pageLoader" class="page-loader" aria-live="polite" aria-busy="true" role="status">
        <div class="loader-spinner" aria-hidden="true"></div>
        <span class="sr-only"
            style="position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); border:0;">جاري
            التحميل…</span>
    </div>

    <style>
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
            font-size: 16px;
            cursor: pointer;
            font-family: 'asswat-medium';
        }

        .art-section-card h2:hover {
            margin-top: 5px;
            cursor: pointer;
            text-decoration: underline;
        }

        .art-section-card-date {
            color: #dadada;
            font-size: 12px;
            margin-top: 8px;
            font-family: 'asswat-regular';
        }

        /* Critical visibility CSS to avoid flash of wrong layout on first paint */
        .web {
            display: none;
        }

        .mobile {
            display: block;
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

    <style>
        @php
            $months = [
                '01' => 'جانفي',
                '02' => 'فيفري',
                '03' => 'مارس',
                '04' => 'أفريل',
                '05' => 'ماي',
                '06' => 'جوان',
                '07' => 'جويلية',
                '08' => 'أوت',
                '09' => 'سبتمبر',
                '10' => 'أكتوبر',
                '11' => 'نوفمبر',
                '12' => 'ديسمبر',
            ];
        @endphp
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
                height: 100vh;
                position: relative;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                overflow: hidden;
            }

            /* Most Reads full-screen section */
            .most-reads-screen {
                width: 100%;
                height: 100vh;
                background: #252525;
                /* grey background */
                color: #000;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 131px 20px 80px;
                /* breathing room top/bottom like other screens */
                box-sizing: border-box;
            }

            .most-reads-list {
                list-style: none;
                margin: 0;
                padding: 0;
                width: 100%;
                max-width: 820px;
                display: flex;
                flex-direction: column;
                gap: 0;
                /* use padding + borders on items for consistent spacing */
            }

            .most-reads-item {
                display: flex;
                align-items: center;
                gap: 21px;
                /* spacing between number and title */
                padding: 24px 0;
                /* consistent vertical rhythm */
            }

            .most-reads-item+.most-reads-item {
                border-top: 1px solid rgba(255, 255, 255, 0.18);
                /* single divider between items */
            }

            .mr-index {
                min-width: 28px;
                text-align: center;
                font-weight: 900;
                font-size: 43px;
                line-height: 1;
                color: #9e9e9e;
                font-family: 'asswat-bold';
            }

            .mr-title {
                display: inline-block;
                color: #fff;
                text-decoration: none;
                font-size: 16px;
                font-weight: 800;
                line-height: 1.4;
                font-family: 'asswat-bold';
            }

            /* Removed click effect */

            /* Horizontal snap wrapper (one vertical step) */
            .mobile-h-wrapper {
                width: 100%;
                height: 100vh;
                scroll-snap-align: start;
                scroll-snap-stop: always;
                position: relative;
                /* to anchor fixed badge within wrapper */
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
                scrollbar-width: none;
                /* Firefox */
                direction: rtl;
                /* First slide at right for RTL */
            }

            .h-snap::-webkit-scrollbar {
                display: none;
                /* Hide scrollbar on WebKit */
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

            /* Top section badge: icon + text (no backgrounds) */
            .featured-post-section-badge {
                position: absolute;
                top: 90px;
                right: 16px;
                /* RTL alignment */
                z-index: 2;
                background: transparent;
                color: #fff;
                font-size: 24px;
                font-weight: 800;
                font-family: 'asswat-bold';
                line-height: 1.2;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                text-align: center;
            }

            /* svg icon from public/user/assets/icons/adjicon.svg before the text */
            .featured-post-section-badge::before {
                content: '';
                width: 30px;
                height: 30px;
                border-radius: 0;
                background-color: transparent;
                background-image: url('{{ asset('user/assets/icons/adjicon.svg') }}');
                background-repeat: no-repeat;
                background-position: center;
                /* make the SVG icon appear white */
                filter: invert(63%) sepia(24%) saturate(749%) hue-rotate(103deg) brightness(93%) contrast(92%);
                flex-shrink: 0;
            }

            /* Fixed UI container holding section badge */
            .section-fixed-ui {
                position: absolute;
                top: 90px;
                right: 16px;
                z-index: 3;
                display: flex;
                align-items: stretch;
            }

            /* Icon positioned separately on the side */
            .section-image-icon {
                position: static;
                background: #fff;
                color: #fff;
                width: 40px;
                height: 40px;
                min-height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                margin-left: auto;
            }

            .section-fixed-ui .featured-post-section-badge {
                position: static;
            }

            /* Refined bottom-center indicators (mobile carousels) */
            .h-indicators {
                position: absolute;
                left: 50%;
                bottom: 96px;
                transform: translateX(-50%);
                z-index: 3;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                padding: 4px 8px;
                border-radius: 999px;
                background-color: rgba(0, 0, 0, 0.4);
                backdrop-filter: blur(10px);
            }

            .h-indicator {
                width: 7px;
                height: 7px;
                border-radius: 999px;
                /* background: rgba(255, 255, 255, 0.38); */
                background: #59cc99;
                opacity: 0.2;
                transition: all 0.1s ease;
            }

            .h-indicator.active {
                width: 16px;
                background: #59cc99;
                opacity: 1;
            }

            /* Featured Post Content */
            .featured-post-content {
                position: absolute;
                /* pin block to bottom area */
                bottom: 160px;
                /* keep 80px empty space at the bottom of the page */
                left: 0;
                right: 0;
                z-index: 2;
                padding: 0 20px;
                /* horizontal padding only */
                color: #fff;
                direction: rtl;
                text-align: right;
            }

            /* Featured Post Content */
            .featured-post-content2 {
                position: absolute;
                /* pin block to bottom area */
                bottom: 160px;
                /* keep 80px empty space at the bottom of the page */
                left: 0;
                right: 0;
                z-index: 2;
                padding: 0 20px;
                /* horizontal padding only */
                color: #fff;
                direction: rtl;
                text-align: right;
            }

            .featured-post-category-name {
                margin: 0 0 14px 0;
                font-size: 22px;
                color: #ffffff;
                letter-spacing: 1px;
            }

            .featured-post-title {
                margin: 0 0 15px 0;
                font-size: 32px;
                font-weight: 900;
                line-height: 1.4;
                color: #fff;
                font-family: 'asswat-bold';
            }

            .featured-post-description {
                margin: 0;
                /* bottom space handled by container padding */
                font-size: 16px;
                color: #ffffff;
                line-height: 1.5;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                font-family: 'asswat-regular';

            }

            /* Author block (آراء) */
            .featured-post-author {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                margin: 0 0 30px 0;
            }

            .featured-post-author .author-avatar {
                width: 90px;
                height: 90px;
                border-radius: 50%;
                object-fit: cover;
            }

            .featured-post-author .author-name {
                font-size: 20px;
                color: #ffffff;
                letter-spacing: 0.5px;
                font-family: 'asswat-bold';
            }

            /* Centered opinion layout (آراء) */
            .opinion-center {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .opinion-avatar {
                width: 110px;
                height: 110px;
                border-radius: 50%;
                object-fit: cover;
                border: 1px solid rgba(255, 255, 255, 0.85);
                margin-bottom: 10px;
            }

            .opinion-author {
                font-size: 22px;
                color: #fff;
                font-family: 'asswat-regular';
                margin: 10px 0px;
            }

            .opinion-title {
                margin-top: 10px;
                font-size: 30px;
                font-weight: 900;
                line-height: 1.35;
                color: #fff;
                font-family: 'asswat-bold';
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
                height: 100vh;
                overflow-y: auto;
                scroll-behavior: smooth;
                scroll-snap-type: y mandatory;
                scroll-padding-top: 0;
                -webkit-overflow-scrolling: touch;
                /* iOS momentum scrolling */
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

        /* Back to Top Button Styles */
        @media (max-width: 991px) {
            .back-to-top-btn {
                position: fixed;
                bottom: 20px;
                left: 20px;
                z-index: 1000;
                width: 40px;
                height: 40px;
                background-color: rgb(255, 255, 255);
                border: none;
                border-radius: 50%;
                cursor: pointer;
                display: none;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .back-to-top-btn.show {
                display: flex;
            }

            .back-to-top-btn:active {
                transform: scale(0.95);
                background-color: rgb(255, 255, 255);
            }

            .back-to-top-btn svg {
                width: 28px;
                height: 28px;
                fill: #000000;
            }

            @supports (padding: max(0px)) {
                .back-to-top-btn {
                    bottom: calc(40px + max(0px, env(safe-area-inset-bottom)));
                    left: calc(15px + max(0px, env(safe-area-inset-left)));
                }
            }
        }

        @media (min-width: 992px) {
            .back-to-top-btn {
                display: none !important;
            }
        }
    </style>

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
                        <a href="{{ route('trend.show', $principalTrend->trend->id) }}" style="text-decoration: none; color: inherit;">
                            <h2 class="art-section-title">{{ $principalTrend->trend->title ?? '' }}</h2>
                        </a>
                        <div class="art-section-grid">
                            @foreach ($trends->take(4) as $content)
                                @php
                                    $date = $content->created_at;
                                    $day = $date->format('d');
                                    $month = $months[$date->format('m')];
                                    $year = $date->format('Y');
                                    $time = $date->format('H:i');
                                @endphp
                                <div class="art-section-card">
                                    <a href="{{ route('news.show', $content->shortlink) }}">
                                        <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? asset($content->image) }}"
                                            alt="{{ $content->title }}">
                                    </a>
                                    <p class="art-section-card-date">{{ $day }} {{ $month }} {{ $year }} | {{ $time }}</p>
                                    <a href="{{ route('news.show', $content->shortlink) }}"
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

        <!-- Back to Top Button -->
        {{-- <button id="backToTopBtn" class="back-to-top-btn" aria-label="العودة إلى الأعلى" title="العودة إلى الأعلى">
            <i class="fas fa-chevron-up"></i>
        </button> --}}

        <!-- Vertical snap container for mobile sections -->
        <div class="mobile-snap">

            {{-- top contents (featured first slider) --}}
            @if (isset($topContents) && is_countable($topContents) && $topContents->count())
                @php $topcontentslist = $topContents->count(); @endphp
                <div class="mobile-h-wrapper">
                    <div class="section-fixed-ui">
                        <div class="featured-post-section-badge">في الواجهة</div>
                    </div>
                    <div class="h-snap" dir="rtl">
                        @foreach ($topContents->take($topcontentslist) as $tc)
                            @php $c = $tc->content ?? null; @endphp
                            @if ($c)
                                <div class="h-snap-slide mobile-featured-post"
                                    style="background-image: url('{{ $c->media()->wherePivot('type', 'mobile')->first()?->path ?? ($c->media()->wherePivot('type', 'main')->first()?->path ?? asset($c->image ?? 'user/assets/images/default-post.jpg')) }}');">
                                    <div class="post-overlay-dark"></div>
                                    <div class="featured-post-content2">
                                        @if (isset($c->category) && $c->category)
                                            <p class="featured-post-category-name">
                                                <a href="{{ route('category.show', ['id' => $c->category->id, 'type' => 'Category']) }}"
                                                    style="color: inherit; text-decoration: none;">
                                                    {{ $c->category->name }}
                                                </a>
                                            </p>
                                        @endif
                                        <a href="{{ route('news.show', $c->shortlink) }}"
                                            style="text-decoration: none; color: inherit;">
                                            <h1 class="featured-post-title">
                                                {{ \Illuminate\Support\Str::limit($c->mobile_title ?? $c->title, 50) }}
                                            </h1>
                                            <p class="featured-post-description">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($c->summary ?? ($c->description ?? '')), 130) }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="h-indicators" role="tablist" aria-label="slides">
                        @for ($i = 0; $i < $topcontentslist; $i++)
                            <span class="h-indicator @if ($i === 0) active @endif"
                                aria-label="{{ $i + 1 }}"
                                aria-current="@if ($i === 0) true @else false @endif"></span>
                        @endfor
                    </div>
                </div>

            @endif


            {{-- Principal Trend Section (Mobile) --}}
            @if ($principalTrend->id == 1 and $principalTrend->trend->contents->count() >= 1 and $principalTrend->is_active == 1)
                @php $trendsCount = isset($trends) && is_countable($trends) ? count($trends) : 0; @endphp
                @if ($trendsCount >= 1)
                    <div class="mobile-h-wrapper">
                        <div class="section-fixed-ui">
                            <div class="featured-post-section-badge">
                                <a href="{{ route('trend.show', $principalTrend->trend->id) }}" style="color: inherit; text-decoration: none;">
                                    {{ $principalTrend->trend->title ?? 'اتجاه' }}
                                </a>
                            </div>
                        </div>
                        <div class="h-snap" dir="rtl">
                            @foreach ($trends->take(5) as $content)
                                <div class="h-snap-slide mobile-featured-post"
                                    style="background-image: url('{{ $content->media()->wherePivot('type', 'mobile')->first()?->path ?? ($content->media()->wherePivot('type', 'main')->first()?->path ?? asset($content->image ?? 'user/assets/images/default-post.jpg')) }}');">
                                    <div class="post-overlay-dark"></div>
                                    <div class="featured-post-content2">
                                        @if (isset($content->category) && $content->category)
                                            <p class="featured-post-category-name">
                                                <a href="{{ route('category.show', ['id' => $content->category->id, 'type' => 'Category']) }}"
                                                    style="color: inherit; text-decoration: none;">
                                                    {{ $content->category->name }}
                                                </a>
                                            </p>
                                        @endif
                                        <a href="{{ route('news.show', $content->shortlink) }}"
                                            style="text-decoration: none; color: inherit;">
                                            <h1 class="featured-post-title">
                                                {{ \Illuminate\Support\Str::limit($content->mobile_title ?? $content->title, 50) }}
                                            </h1>
                                            <p class="featured-post-description">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($content->summary ?? ''), 130) }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="h-indicators" role="tablist" aria-label="slides">
                            @for ($i = 0; $i < min(5, $trendsCount); $i++)
                                <span class="h-indicator @if ($i === 0) active @endif"
                                    aria-label="{{ $i + 1 }}"
                                    aria-current="@if ($i === 0) true @else false @endif"></span>
                            @endfor
                        </div>
                    </div>
                @endif
            @endif


            {{-- most reads --}}
            @if (isset($topViewed) && is_countable($topViewed) && $topViewed->count())
                <div class="mobile-h-wrapper">
                    <div class="section-fixed-ui">
                        <div class="featured-post-section-badge">الأكثر قراءة</div>
                    </div>
                    <div class="most-reads-screen" dir="rtl">
                        <ol class="most-reads-list" role="list">
                            @foreach ($topViewed->take(5) as $i => $content)
                                <li class="most-reads-item">
                                    <span class="mr-index" aria-hidden="true">{{ $i + 1 }}</span>
                                    <a class="mr-title" href="{{ route('news.show', $content->shortlink) }}">
                                        {{ \Illuminate\Support\Str::limit($content->mobile_title ?? $content->title, 50) }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @endif

            {{-- sections --}}
            @foreach ($sectionscontents ?? [] as $sectionTitle => $collection)
                @if ($sectionTitle == 'آراء')
                    @if ($collection && $collection->count())
                        @php $slideCount = min(5, $collection->count()); @endphp
                        <div class="mobile-h-wrapper">
                            <div class="section-fixed-ui">
                                <div class="featured-post-section-badge">
                                    <a href="{{ route('newSection', ['section' => 'reviews']) }}"
                                        style="color: inherit; text-decoration: none;">{{ $sectionTitle }}</a>
                                </div>
                            </div>
                            <div class="h-snap" dir="rtl">
                                @foreach ($collection->take(5) as $content)
                                    <div class="h-snap-slide mobile-featured-post"
                                        style="background-image: url('{{ $content->media()->wherePivot('type', 'mobile')->first()?->path ?? asset($content->image ?? 'user/assets/images/default-post.jpg') }}');">
                                        <div class="post-overlay-dark"></div>
                                        <div class="featured-post-content">
                                            @php
                                                $firstWriter = $content->writers()->first();
                                            @endphp
                                            <div class="opinion-center">
                                                @if ($firstWriter)
                                                    <a href="{{ route('writer.show', ['id' => $firstWriter->id]) }}"
                                                        class="opinion-writer-link"
                                                        style="text-decoration: none; color: inherit;">
                                                        <img class="opinion-avatar"
                                                            src="{{ asset($firstWriter->image ?? 'user/assets/images/default-post.jpg') }}"
                                                            alt="{{ $firstWriter->name ?? '' }}">
                                                    </a>
                                                    <div>
                                                        <a href="{{ route('writer.show', ['id' => $firstWriter->id]) }}">
                                                            <span class="opinion-author">{{ $firstWriter->name }}</span>
                                                        </a>
                                                        <a href="{{ route('news.show', $content->shortlink) }}"
                                                            style="text-decoration: none; color: inherit;">
                                                            <h1 class="opinion-title">{{ $content->mobile_title }}</h1>
                                                        </a>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="h-indicators" role="tablist" aria-label="slides">
                                @for ($i = 0; $i < $slideCount; $i++)
                                    <span class="h-indicator @if ($i === 0) active @endif"
                                        aria-label="{{ $i + 1 }}"
                                        aria-current="@if ($i === 0) true @else false @endif"></span>
                                @endfor
                            </div>
                        </div>
                    @endif
                @else
                    @if ($collection && $collection->count())
                        @php $slideCount = min(5, $collection->count()); @endphp
                        <div class="mobile-h-wrapper">
                            <div class="section-fixed-ui">
                                @php
                                    // Map Arabic section titles to English slugs for the newSection route
                                    $slugMap = [
                                        'الجزائر' => 'algeria',
                                        'عالم' => 'world',
                                        'اقتصاد' => 'economy',
                                        'رياضة' => 'sports',
                                        'ناس' => 'people',
                                        'ثقافة وفنون' => 'culture',
                                        'آراء' => 'reviews',
                                        'فيديو' => 'videos',
                                        'ملفات' => 'files',
                                        'تكنولوجيا' => 'technology',
                                        'صحة' => 'health',
                                        'بيئة' => 'environment',
                                        'ميديا' => 'media',
                                        'فحص' => 'investigation',
                                        'بودكاست' => 'podcasts',
                                        'منوعات' => 'variety',
                                        'صور' => 'photos',
                                    ];
                                    $sectionSlug = $slugMap[$sectionTitle] ?? null;
                                @endphp

                                <div class="featured-post-section-badge">
                                    @if ($sectionSlug)
                                        <a href="{{ route('newSection', ['section' => $sectionSlug]) }}"
                                            style="color: inherit; text-decoration: none;">{{ $sectionTitle }}</a>
                                    @else
                                        {{ $sectionTitle }}
                                    @endif
                                </div>
                            </div>
                            <div class="h-snap" dir="rtl">
                                @foreach ($collection->take(5) as $content)
                                    <div class="h-snap-slide mobile-featured-post"
                                        style="background-image: url('{{ $content->media()->wherePivot('type', 'mobile')->first()?->path ?? asset($content->image ?? 'user/assets/images/default-post.jpg') }}');">
                                        <div class="post-overlay-dark"></div>

                                        @if ($content->template === 'normal_image' && $sectionSlug === 'photos')
                                            <div
                                                style="position: absolute; top: 90px; left: 9px; z-index: 2; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 25px;">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        @if ($content->template === 'video' && $sectionSlug === 'videos')
                                            <div
                                                style="position: absolute; top: 90px; left: 9px; z-index: 2; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 25px;">
                                                <i class="fas fa-video"></i>
                                            </div>
                                        @endif
                                        @if ($content->template === 'podcast' && $sectionSlug === 'podcasts')
                                            <div
                                                style="position: absolute; top: 90px; left: 9px; z-index: 2; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 25px;">
                                                <i class="fas  fa-headphones"></i>
                                            </div>
                                        @endif
                                        <div class="featured-post-content">
                                            @if (isset($content->category) && $content->category)
                                                <p class="featured-post-category-name">
                                                    <a href="{{ route('category.show', ['id' => $content->category->id, 'type' => 'Category']) }}"
                                                        style="color: inherit; text-decoration: none;">
                                                        {{ $content->category->name }}
                                                    </a>
                                                </p>
                                            @endif
                                            <a href="{{ route('news.show', $content->shortlink) }}"
                                                style="text-decoration: none; color: inherit;">
                                                <h1 class="featured-post-title">{{ $content->mobile_title }}</h1>
                                                <p class="featured-post-description">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($content->summary ?? ($content->description ?? '')), 130) }}
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="h-indicators" role="tablist" aria-label="slides">
                                @for ($i = 0; $i < $slideCount; $i++)
                                    <span class="h-indicator @if ($i === 0) active @endif"
                                        aria-label="{{ $i + 1 }}"
                                        aria-current="@if ($i === 0) true @else false @endif"></span>
                                @endfor
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach

            <!-- Compact mobile footer at the end -->
            <div class="mobile-container">
                @include('user.mobile.footer')
            </div>

        </div>
    </div>



    <script>
        // Mobile auto horizontal scroll ONLY for currently visible vertical section (immediate start)
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth > 991) return; // mobile only
            const wrappers = Array.from(document.querySelectorAll('.mobile-h-wrapper'));
            const states = new Map();
            const INTERVAL = 4000;
            const FIRST_DELAY = 4000; // wait full 4s before first advance
            const PAUSE_AFTER_INTERACTION = 8000; // shorter pause after manual interaction
            let activeWrapper = null;

            wrappers.forEach(w => {
                const track = w.querySelector('.h-snap');
                if (!track) return;
                const slides = Array.from(track.querySelectorAll('.h-snap-slide'));
                if (slides.length < 2) return;
                states.set(w, {
                    track,
                    slides,
                    index: 0,
                    userPausedUntil: 0,
                    timeoutId: null,
                    running: false,
                    indicators: Array.from(w.querySelectorAll('.h-indicator'))
                });
                ['touchstart', 'wheel', 'mousedown'].forEach(evt => {
                    track.addEventListener(evt, () => {
                        const st = states.get(w);
                        if (!st) return;
                        st.userPausedUntil = Date.now() + PAUSE_AFTER_INTERACTION;
                    }, {
                        passive: true
                    });
                });
                // Update indicators when user scrolls manually (instant)
                track.addEventListener('scroll', () => {
                    const st = states.get(w);
                    if (!st) return;
                    syncIndexToNearest(st);
                    updateIndicators(st);
                }, {
                    passive: true
                });
            });

            function schedule(st, delay) {
                clearTimeout(st.timeoutId);
                st.timeoutId = setTimeout(function tick() {
                    const now = Date.now();
                    if (now < st.userPausedUntil) {
                        // re-check sooner while paused
                        schedule(st, 500);
                        return;
                    }
                    advance(st);
                    schedule(st, INTERVAL);
                }, delay);
            }

            function startAuto(w) {
                const st = states.get(w);
                if (!st || st.running) return;
                st.running = true;
                // immediate first schedule with short delay
                schedule(st, FIRST_DELAY);
            }

            function stopAuto(w) {
                const st = states.get(w);
                if (!st || !st.running) return;
                st.running = false;
                clearTimeout(st.timeoutId);
                st.timeoutId = null;
            }

            function syncIndexToNearest(st) {
                const currentLeft = st.track.scrollLeft;
                let nearest = st.index,
                    minDist = Infinity;
                st.slides.forEach((s, i) => {
                    const d = Math.abs(s.offsetLeft - currentLeft);
                    if (d < minDist) {
                        minDist = d;
                        nearest = i;
                    }
                });
                st.index = nearest;
            }

            function updateIndicators(st) {
                if (!st.indicators || !st.indicators.length) return;
                st.indicators.forEach((el, i) => {
                    if (i === st.index) el.classList.add('active');
                    else el.classList.remove('active');
                });
            }

            function advance(st) {
                // sync index to nearest before advancing
                syncIndexToNearest(st);
                const next = (st.index + 1) % st.slides.length;
                st.index = next;
                const target = st.slides[next];
                if (target) st.track.scrollTo({
                    left: target.offsetLeft,
                    behavior: 'smooth'
                });
                updateIndicators(st);
            }

            // IntersectionObserver to determine visible wrapper (lower thresholds)
            const observer = new IntersectionObserver(entries => {
                let candidate = activeWrapper;
                let ratio = 0;
                entries.forEach(e => {
                    if (e.isIntersecting && e.intersectionRatio > ratio) {
                        ratio = e.intersectionRatio;
                        candidate = e.target;
                    }
                });
                // Start when at least 35% visible
                if (candidate && ratio >= 0.35 && candidate !== activeWrapper) {
                    if (activeWrapper) stopAuto(activeWrapper);
                    activeWrapper = candidate;
                    startAuto(activeWrapper);
                }
            }, {
                threshold: [0, 0.15, 0.35, 0.5, 0.75, 1]
            });

            wrappers.forEach(w => observer.observe(w));
            // Fallback: if observer hasn't activated after 1s, start first wrapper
            setTimeout(() => {
                if (!activeWrapper && wrappers[0]) {
                    activeWrapper = wrappers[0];
                    startAuto(activeWrapper);
                }
            }, 1000);

            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    if (activeWrapper) stopAuto(activeWrapper);
                } else {
                    if (activeWrapper) startAuto(activeWrapper);
                }
            });
        });

        // Back to Top Button Functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Hide loader when page is fully loaded (images included) or after a max timeout
            const loader = document.getElementById('pageLoader');
            const hideLoader = () => {
                if (!loader) return;
                loader.classList.add('hidden');
                setTimeout(() => loader.remove(), 400);
            };
            // Prefer window load for full content readiness
            if (document.readyState === 'complete') {
                hideLoader();
            } else {
                window.addEventListener('load', hideLoader, {
                    once: true
                });
                // Fallback: in case load doesn't fire (e.g., cached resources), hide after 3.5s
                setTimeout(hideLoader, 3500);
            }

            if (window.innerWidth > 991) return; // mobile only

            const backToTopBtn = document.getElementById('backToTopBtn');
            const mobileSnap = document.querySelector('.mobile-snap');

            if (!backToTopBtn || !mobileSnap) return;

            // Show/hide button based on scroll position
            const handleScroll = () => {
                if (mobileSnap.scrollTop > 300) {
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            };

            // Scroll to top functionality
            const scrollToTop = () => {
                mobileSnap.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            };

            // Event listeners
            mobileSnap.addEventListener('scroll', handleScroll, {
                passive: true
            });
            backToTopBtn.addEventListener('click', scrollToTop);

            // Handle window resize (from desktop to mobile or vice versa)
            window.addEventListener('resize', () => {
                if (window.innerWidth > 991) {
                    backToTopBtn.classList.remove('show');
                }
            });
        });
    </script>




@endsection
