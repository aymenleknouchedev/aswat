@extends('layouts.index')

@section('title', 'أصوات جزائرية | الرئيسية')

@section('content')

    <style>
        .art-section-hero {
            position: relative;
            margin-top: 60px;
            background: linear-gradient(rgba(0, 0, 0, 0.155), rgba(0, 0, 0, 0.851)),
                url('./user/assets/images/gaza.jpg') center/cover no-repeat;
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

        @media (max-width: 768px) {
            .web {
                display: none;
            }

            .mobile {
                display: none;
            }
        }
    </style>


    <div class="web">
        @include('user.components.fixed-nav')

        {{-- <div style="height: 140px;"></div> --}}

        @php
            $topContentsCount = isset($topContents) && is_countable($topContents) ? count($topContents) : 0;
        @endphp
        @if ($topContentsCount >= 7)
            <div class="container">
                @include('user.components.header')
            </div>
        @endif

        <div class="container">
            <section class="art-section-hero">
                <div class="art-section-overlay">
                    <h2 class="art-section-title">الحرب على غزة</h2>

                    <div class="art-section-grid">
                        <div class="art-section-card">
                            <img src="./user/assets/images/IMG9.webp" alt="Feature economy">
                            <h2>البنك الدولي يتوقع أسوأ عقد للنمو العالمي منذ الستينيات</h2>
                        </div>

                        <div class="art-section-card">
                            <img src="./user/assets/images/IMG10.webp" alt="Feature economy">
                            <h2>ترمب يهدد «بريكس» مجدداً</h2>
                        </div>

                        <div class="art-section-card">
                            <img src="./user/assets/images/IMG11.webp" alt="Feature economy">
                            <h2>«بلاكستون» تنسحب من صفقة شراء «تيك توك»</h2>
                        </div>

                        <div class="art-section-card">
                            <img src="./user/assets/images/IMG12.webp" alt="Feature economy">
                            <h2>الرئيس الجزائري: احتياطي النقد الأجنبي عند 70 مليار دولار</h2>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @php
            $sections = [
                'algeria' => ['الجزائر', 4],
                'world' => ['عالم', 5],
                'economy' => ['اقتصاد', 4],
                'sports' => ['رياضة', 6],
                'people' => ['ناس', 3],
            ];
        @endphp

        @foreach ($sections as $component => [$title, $minCount])
            @php
                $items = ${$component} ?? [];
            @endphp
            @if (is_countable($items) && count($items) >= $minCount)
                @include('user.components.sp60')
                <div class="container">
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
                <a href="{{ route('arts') }}" class="section-title">ثقافة وفنون</a>
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
                <a href="{{ route('reviews') }}" class="section-title">آراء</a>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
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
    </div>



@endsection
