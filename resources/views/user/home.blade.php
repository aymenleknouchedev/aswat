@extends('layouts.index')

@section('title', 'أصوات جزائرية | الرئيسية')

@section('content')

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
            font-size: 15px;
            cursor: pointer;
        }

        .art-section-card h2:hover {
            margin-top: 5px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: underline;
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

        <!-- Full Screen Post with Background Image -->
        <div class="mobile-featured-post"
            style="background-image: url('{{ asset($principalTrend->trend->image ?? 'user/assets/images/default-post.jpg') }}');">
            <!-- Overlay -->
            <div class="post-overlay-dark"></div>

            <!-- Post Content -->
            <div class="featured-post-content">
                <h1 class="featured-post-title">{{ $principalTrend->trend->title ?? 'اخبار رئيسية' }}</h1>
                <p class="featured-post-description">{{ $principalTrend->trend->description ?? '' }}</p>
            </div>
        </div>
        <!-- Full Screen Post with Background Image -->
        <div class="mobile-featured-post"
            style="background-image: url('{{ asset($principalTrend->trend->image ?? 'user/assets/images/default-post.jpg') }}');">
            <!-- Overlay -->
            <div class="post-overlay-dark"></div>

            <!-- Post Content -->
            <div class="featured-post-content">
                <h1 class="featured-post-title">{{ $principalTrend->trend->title ?? 'اخبار رئيسية' }}</h1>
                <p class="featured-post-description">{{ $principalTrend->trend->description ?? '' }}</p>
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

            /* Dark Overlay */
            .post-overlay-dark {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3));
                z-index: 1;
            }

            /* Featured Post Content */
            .featured-post-content {
                position: relative;
                z-index: 2;
                padding: 40px 20px 20px;
                color: #fff;
                direction: rtl;
                text-align: right;
            }

            .featured-post-title {
                margin: 0 0 15px 0;
                font-size: 28px;
                font-weight: bold;
                line-height: 1.3;
                color: #fff;
            }

            .featured-post-description {
                margin: 0 0 20px 0;
                font-size: 14px;
                color: #e0e0e0;
                line-height: 1.5;
                max-height: 80px;
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

            /* Scroll Snap for Instagram Reels style */
            html {
                scroll-behavior: smooth;
            }

            .mobile {
                scroll-snap-type: y mandatory;
                overflow-y: scroll;
            }

            .mobile-featured-post {
                scroll-snap-align: start;
                scroll-snap-stop: always;
            }

            .mobile-container {
                scroll-snap-align: start;
                scroll-snap-stop: always;
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
        document.addEventListener('DOMContentLoaded', function() {
            // Only enable on mobile
            if (window.innerWidth <= 991) {
                let isScrolling = false;
                let touchStartY = 0;
                let touchStartTime = 0;
                let scrollTimeout;
                const scrollThreshold = 50;
                const scrollDuration = 800;

                function snapToNearestSection() {
                    const viewportHeight = window.innerHeight;
                    const currentScroll = window.scrollY;
                    const currentSection = Math.round(currentScroll / viewportHeight);
                    const targetScroll = currentSection * viewportHeight;

                    if (Math.abs(targetScroll - currentScroll) > 1) {
                        window.scrollTo({
                            top: targetScroll,
                            behavior: 'smooth'
                        });
                    }
                }

                // Prevent scroll snapping while user is scrolling
                let userScrolling = false;

                window.addEventListener('scroll', function() {
                    userScrolling = true;
                    clearTimeout(scrollTimeout);

                    // After scroll stops for 100ms, snap to nearest section
                    scrollTimeout = setTimeout(() => {
                        userScrolling = false;
                        if (!isScrolling) {
                            snapToNearestSection();
                        }
                    }, 1);
                }, { passive: true });

                // Wheel event for desktop/trackpad
                window.addEventListener('wheel', function(e) {
                    if (window.innerWidth > 991 || isScrolling) return;

                    const absDelta = Math.abs(e.deltaY);

                    // Only trigger on significant scroll (> threshold)
                    if (absDelta > scrollThreshold) {
                        e.preventDefault();
                        isScrolling = true;

                        const viewportHeight = window.innerHeight;
                        const currentScroll = window.scrollY;
                        let targetScroll;

                        if (e.deltaY > 0) {
                            // Scroll down
                            targetScroll = currentScroll + viewportHeight;
                        } else {
                            // Scroll up
                            targetScroll = Math.max(0, currentScroll - viewportHeight);
                        }

                        window.scrollTo({
                            top: targetScroll,
                            behavior: 'smooth'
                        });

                        setTimeout(() => {
                            isScrolling = false;
                        }, scrollDuration);
                    }
                }, { passive: false });

                // Touch swipe for mobile
                window.addEventListener('touchstart', function(e) {
                    if (window.innerWidth > 991) return;
                    touchStartY = e.touches[0].clientY;
                    touchStartTime = Date.now();
                }, { passive: true });

                window.addEventListener('touchend', function(e) {
                    if (window.innerWidth > 991) return;

                    const touchEndY = e.changedTouches[0].clientY;
                    const touchTime = Date.now() - touchStartTime;
                    const swipeDistance = touchStartY - touchEndY;

                    // Only trigger on meaningful swipes
                    if (Math.abs(swipeDistance) > scrollThreshold && touchTime < 600 && !isScrolling) {
                        isScrolling = true;

                        const viewportHeight = window.innerHeight;
                        const currentScroll = window.scrollY;
                        let targetScroll;

                        if (swipeDistance > scrollThreshold) {
                            // Swipe up - scroll down
                            targetScroll = currentScroll + viewportHeight;
                        } else if (swipeDistance < -scrollThreshold) {
                            // Swipe down - scroll up
                            targetScroll = Math.max(0, currentScroll - viewportHeight);
                        }

                        window.scrollTo({
                            top: targetScroll,
                            behavior: 'smooth'
                        });

                        setTimeout(() => {
                            isScrolling = false;
                        }, scrollDuration);
                    }
                }, { passive: true });
            }
        });
    </script>
