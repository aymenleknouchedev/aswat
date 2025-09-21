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

        @media (max-width: 800px) {
            body {
               display: none;   
            }
        }
    </style>




    @include('user.components.fixed-nav')

    {{-- <div style="height: 140px;"></div> --}}

    <div class="container">
        @include('user.components.header')
    </div>

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
            'الجزائر' => 'algeria',
            'عالم' => 'world',
            'اقتصاد' => 'economy',
            'رياضة' => 'sport',
            'ناس' => 'people',
            'ثقافة وفنون' => 'arts',
            'آراء' => 'reviews',
        ];
    @endphp

    @foreach ($sections as $title => $component)
        @include('user.components.sp60')
        <div class="container">
            @include('user.components.section-title', ['slot' => $title])
            @include("user.components.$component")
        </div>
    @endforeach

    @include('user.components.sp60')

    {{-- Videos Section --}}
    <div style="background-color: #F5F5F5;">
        @include('user.components.sp60')
        <div class="container">
            @include('user.components.section-title', ['slot' => 'فيديو'])
        </div>
        @include('user.components.videos')
        @include('user.components.sp60')
    </div>

    @include('user.components.sp60')

    {{-- Files Section --}}
    <div class="container">
        @include('user.components.section-title', ['slot' => 'ملفات'])
        @include('user.components.files')
    </div>

    @include('user.components.sp60')

    {{-- Many Titles --}}
    <div class="container">
        @include('user.components.many-titles')
    </div>

    @include('user.components.sp60')

    {{-- Media Section --}}
    <div class="container">
        @include('user.components.section-title', ['slot' => 'ميديا'])
        @include('user.components.media')
    </div>

    @include('user.components.sp60')

    {{-- Check Section --}}
    <div class="container">
        @include('user.components.section-title', ['slot' => 'فحص'])
        @include('user.components.check')
    </div>

    @include('user.components.sp60')

    {{-- Podcast Section --}}
    <div style="background-color: #F5F5F5;">
        @include('user.components.sp60')
        <div class="container">
            @include('user.components.section-title', ['slot' => 'بودكاست'])
        </div>
        @include('user.components.podcast')
        @include('user.components.sp60')
    </div>

    @include('user.components.sp60')

    {{-- Two Titles --}}
    <div class="container">
        @include('user.components.two-titles')
    </div>

    @include('user.components.sp60')

    {{-- Photos Section --}}
    <div style="background-color: #F5F5F5;">
        @include('user.components.sp60')
        <div class="container">
            <div class="title">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <p class="section-title">صور</p>
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

    @include('user.components.footer')

@endsection
