@extends('layouts.index')

@section('title', 'أصوات جزائرية | ' . ($theme->title ?? 'الأخبار'))

@section('content')

    <style>
        .web {
            display: block !important;
        }

        .mobile {
            display: none !important;
        }

        .section-title {
            font-size: 32px;
        }

        .newCategory-all-section {
            width: 100%;
        }

        .newCategory-all-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .newCategory-all-card {
            display: flex;
            flex-direction: column;
            direction: rtl;
            background: #f5f5f5;
        }

        .newCategory-all-card-image img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            display: block;
        }

        .newCategory-all-card-text {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 18px 20px;
        }


        .newCategory-all-card-text h3 {
            font-family: asswat-regular !important;
            font-weight: normal !important;
            font-size: 16px !important;
            color: #7c7c74 !important;
            margin: 0 0 4px 0 !important;
        }

        .newCategory-all-card-text h2 {
            font-family: asswat-bold !important;
            font-weight: normal !important;
            font-size: 20px !important;
            color: #333 !important;
            margin: 0 0 4px 0 !important;
        }

        .newCategory-all-card-text p {
            font-size: 16px !important;
            line-height: 1.5 !important;
            color: #555 !important;
            margin: 0 !important;
        }



        /* Load more button */
        .category-load-more-btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 12px 0;
            margin: 60px auto;
            background: #f5f5f5;
            color: #000;
            font-family: asswat-medium;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: .3s ease;
        }

        .category-load-more-btn:hover {
            background: #ddd;
        }

        /* Mobile simple header */
        .mobile-simple-header {
            padding: 12px 16px 8px;
            font-size: 28px;
            font-weight: 800;
            font-family: 'asswat-bold';
        }

        .mobile-simple-ul {
            list-style: none;
            margin: 0;
            padding: 0 16px 12px;
        }

        .mobile-simple-item+.mobile-simple-item {
            border-top: 1px solid rgba(0, 0, 0, 0.12);
        }

        .mobile-more-link {
            display: flex;
            flex-direction: column;
            padding: 12px 0;
            text-decoration: none;
            color: inherit;
        }

        .mobile-more-link .ms-thumb {
            width: 100%;
        }

        .mobile-more-link .ms-thumb img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .mobile-more-link .ms-text {
            display: flex;
            flex-direction: column;
            padding-top: 8px;
        }

        .ms-title {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.35;
            color: #000;
            font-family: 'asswat-bold';
        }

        .mobile-load-more-btn {
            display: block;
            width: 90%;
            max-width: 400px;
            margin: 20px auto;
            padding: 12px 24px;
            background: #f5f5f5;
            color: #000;
            font-family: asswat-medium;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: .3s ease;
        }

        .mobile-load-more-btn:hover {
            background: #ddd;
        }

        /* Greybar hide on scroll */
        #greybar {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        #greybar.hide {
            transform: translateY(-100%);
            opacity: 0;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .newCategory-all-list {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .web {
                display: none !important;
            }

            .mobile {
                display: block !important;
            }

            .newCategory-all-list {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .newCategory-all-list {
                grid-template-columns: 1fr;
            }
        }

        .theme-hero-full {
            position: relative;
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            min-height: 480px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            direction: rtl;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .theme-hero-header {
            width: 100%;
            padding: 16px 30px;
            z-index: 10;
        }

        .theme-hero-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .theme-hero-logo img {
            height: 40px;
            width: auto;
            display: block;
        }

        .theme-hero-nav {
            list-style: none;
            display: flex;
            gap: 28px;
            margin: 0;
            padding: 0;
        }

        .theme-hero-nav a {
            color: #fff;
            text-decoration: none;
            font-family: asswat-medium;
            font-size: 16px;
        }

        .theme-hero-nav a:hover {
            font-weight: 700;
        }

        .theme-hero-nav-item.has-sub {
            position: relative;
        }

        .theme-hero-nav-item.has-sub > a i {
            font-size: 11px;
            margin-right: 4px;
        }

        .theme-hero-subnav {
            position: absolute;
            top: 100%;
            right: 0;
            list-style: none;
            margin: 0;
            padding: 10px 0;
            background: rgba(0, 0, 0, 0.85);
            min-width: 160px;
            display: none;
            z-index: 20;
        }

        .theme-hero-nav-item.has-sub:hover .theme-hero-subnav {
            display: block;
        }

        .theme-hero-subnav li a {
            display: block;
            padding: 8px 16px;
            color: #fff;
            font-family: asswat-regular;
            font-size: 15px;
            text-decoration: none;
            white-space: nowrap;
        }

        .theme-hero-subnav li a:hover {
            background: rgba(255, 255, 255, 0.1);
            font-weight: 400;
        }

        .theme-hero-search {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 6px 12px;
            gap: 8px;
        }

        .theme-hero-search input {
            background: transparent;
            border: none;
            outline: none;
            color: #fff;
            font-family: asswat-regular;
            font-size: 14px;
            width: 140px;
        }

        .theme-hero-search input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .theme-hero-search button {
            background: transparent;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .theme-hero-title-wrap {
            padding: 40px 30px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
        }

        .theme-hero-title {
            font-family: asswat-bold;
            font-size: 48px;
            color: #fff;
            margin: 0;
            line-height: 1.2;
            text-align: right;
        }

        .theme-hero-mobile {
            position: relative;
            width: 100%;
            min-height: 180px;
            display: flex;
            align-items: flex-end;
            direction: rtl;
            margin-bottom: 12px;
        }

        .theme-hero-title-mobile {
            font-family: asswat-bold;
            font-size: 26px;
            color: #fff;
            margin: 0;
            padding: 16px;
            line-height: 1.25;
            text-align: right;
            width: 100%;
        }

        #mobile-tags-container .mobile-simple-item {
            background: #f5f5f5 !important;
            margin-bottom: 16px;
        }

        #mobile-tags-container .mobile-more-link {
            padding: 0 !important;
        }

        #mobile-tags-container .mobile-more-link .ms-thumb img {
            aspect-ratio: 4/3 !important;
            border-radius: 0 !important;
        }

        #mobile-tags-container .mobile-more-link .ms-text {
            padding: 14px 16px !important;
        }
    </style>

    <div class="web">
        @if (!(in_array($type, ['Window', 'Trend']) && !empty($theme->image)))
            @include('user.components.fixed-nav')
        @endif

        @if (in_array($type, ['Window', 'Trend']) && !empty($theme->image))
            <div class="theme-hero-full"
                style="background: linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.75)), url('{{ asset($theme->image) }}') center/cover no-repeat;">
                <header class="theme-hero-header">
                    <div class="theme-hero-header-inner">
                        <a href="{{ route('index') }}" class="theme-hero-logo">
                            <img src="{{ asset('user/assets/images/white_logo.svg') }}" alt="Logo">
                        </a>
                        <nav>
                            <ul class="theme-hero-nav">
                                <li class="theme-hero-nav-item has-sub">
                                    <a href="{{ route('latestNews') }}">أخبار <i class="fa-solid fa-chevron-down"></i></a>
                                    <ul class="theme-hero-subnav">
                                        <li><a href="{{ route('newSection', ['section' => 'algeria']) }}">الجزائر</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'world']) }}">عالم</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'economy']) }}">اقتصاد</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'sports']) }}">رياضة</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'people']) }}">ناس</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'culture']) }}">ثقافة وفنون</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'technology']) }}">تكنولوجيا</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'health']) }}">صحة</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'environment']) }}">بيئة</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'media']) }}">ميديا</a></li>
                                        <li><a href="{{ route('newSection', ['section' => 'variety']) }}">منوعات</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('reviews') }}">آراء</a></li>
                                <li><a href="{{ route('windows') }}">نوافذ</a></li>
                                <li><a href="{{ route('files') }}">ملفات</a></li>
                                <li><a href="{{ route('investigation') }}">فحص</a></li>
                                <li><a href="{{ route('videos') }}">فيديو</a></li>
                                <li><a href="{{ route('podcasts') }}">بودكاست</a></li>
                                <li><a href="{{ route('photos') }}">صور</a></li>
                            </ul>
                        </nav>
                        <form action="{{ route('search') }}" method="GET" class="theme-hero-search">
                            <input name="query" type="text" placeholder="ابحث...">
                            <button type="submit" aria-label="ابحث">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </header>
                <div class="theme-hero-title-wrap">
                    <h1 class="theme-hero-title">{{ $theme->name ?? ($theme->title ?? 'الأخبار') }}</h1>
                </div>
            </div>
        @endif

        <div class="container">
            @if (!(in_array($type, ['Window', 'Trend']) && !empty($theme->image)))
                <div class="title">
                    <p class="section-title">{{ $theme->title ?? 'الأخبار' }}</p>
                    @include('user.components.ligne')
                    <div class="under-title-ligne-space"></div>
                </div>
            @else
                <div class="under-title-ligne-space"></div>
            @endif

            <div class="newCategory-all-section">
                <div class="newCategory-all-list" id="category-container">
                    @foreach ($articles as $item)
                        <div class="newCategory-all-card">
                            <!-- Image -->
                            <div class="newCategory-all-card-image">
                                <a href="{{ route('news.show', $item->shortlink) }}">
                                    <img loading="lazy" decoding="async" src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                        alt="{{ $item->title }}">
                                </a>
                            </div>

                            <!-- Text -->
                            <div class="newCategory-all-card-text">
                                <h3>
                                    @if ($item->category && $item->country)
                                        <a
                                            href="{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}">
                                            {{ $item->category->name ?? '' }}
                                        </a>
                                        -
                                        <a
                                            href="{{ route('category.show', ['id' => $item->country->id, 'type' => 'Country']) }}">
                                            {{ $item->country->name ?? '' }}
                                        </a>
                                    @elseif ($item->category && $item->continent)
                                        <a
                                            href="{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}">
                                            {{ $item->category->name ?? '' }}
                                        </a>
                                        -
                                        <a
                                            href="{{ route('category.show', ['id' => $item->continent->id, 'type' => 'Continent']) }}">
                                            {{ $item->continent->name ?? '' }}
                                        </a>
                                    @elseif ($item->category)
                                        <a
                                            href="{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}">
                                            {{ $item->category->name ?? '' }}
                                        </a>
                                    @endif
                                </h3>
                                <a href="{{ route('news.show', $item->shortlink) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <h2>{{ $item->title }}</h2>
                                </a>
                                <p>{{ $item->summary }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if (count($articles) >= 9)
                    <div class="text-center mt-3" id="load-more-container">
                        <button class="category-load-more-btn" data-page="1">المزيد</button>
                    </div>
                @else
                    <div style="height: 60px;"></div>
                @endif
            </div>

            @include('user.components.sp60')
        </div>

        @include('user.components.footer')
    </div>

    <div class="mobile">
        @include('user.mobile.mobile-home')

        <!-- Grey navigation bar -->
        <div id="greybar"
            style="background-color: #252525; height: 68px; position: fixed; top: 0; left: 0; right: 0; z-index: 10;">
        </div>

        <!-- Mobile Trends Content -->
        <div class="mobile-flow">
            <div class="mobile-container" style="margin-top: 68px;">
                <div class="mobile-simple-list" dir="rtl">
                    @if (in_array($type, ['Window', 'Trend']) && !empty($theme->image))
                        <div class="theme-hero-mobile"
                            style="background: linear-gradient(rgba(0,0,0,0.0), rgba(0,0,0,0.75)), url('{{ asset($theme->image) }}') center/cover no-repeat;">
                            <h2 class="theme-hero-title-mobile">{{ $theme->name ?? ($theme->title ?? 'الأخبار') }}</h2>
                        </div>
                    @else
                        <h2 class="mobile-simple-header">{{ $theme->title ?? 'الأخبار' }}</h2>
                    @endif
                    <div style="padding: 0px 16px">
                        @include('user.components.ligne')
                    </div>
                    <ul class="mobile-simple-ul" role="list" id="mobile-tags-container">
                        @foreach ($articles as $item)
                            @include('user.mobile.item')
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Mobile Load More button -->
            @if (count($articles) >= 9)
                <div class="text-center" id="mobile-load-more-container">
                    <button class="mobile-load-more-btn" data-page="1">المزيد</button>
                </div>
            @else
                <div style="height: 40px;"></div>
            @endif

            <!-- Mobile Footer -->
            @include('user.mobile.footer')

        </div>

    </div>

    <script>
        // Initialize Greybar Hide on Scroll
        function initializeGreybarScroll() {
            const greybar = document.getElementById('greybar');
            if (!greybar) return;

            const footer = document.querySelector('footer');

            window.addEventListener('scroll', function() {
                const footerRect = footer.getBoundingClientRect();
                const greybarRect = greybar.getBoundingClientRect();

                // Hide greybar only when it's about to overlap with footer
                if (footerRect.top < greybarRect.bottom) {
                    greybar.classList.add('hide');
                } else {
                    greybar.classList.remove('hide');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 992) {
                initializeGreybarScroll();
            }
        });

        let loading = false;
        const categoryId = @json($current_id ?? null);
        const categoryType = @json($type ?? '');

        document.addEventListener("click", async function(e) {
            // Desktop load more
            if (e.target.classList.contains("category-load-more-btn")) {
                if (loading) return;

                let btn = e.target;
                let page = parseInt(btn.getAttribute("data-page")) + 1;

                loading = true;
                btn.disabled = true;
                btn.textContent = "جاري التحميل...";

                try {
                    let response = await fetch(`/trend/${categoryId}?page=${page}`, {
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    });

                    if (!response.ok) throw new Error("خطأ في السيرفر");

                    let data = await response.text();

                    if (data.trim().length === 0) {
                        btn.closest("#load-more-container").remove();
                    } else {
                        document.getElementById("category-container").insertAdjacentHTML("beforeend", data);
                        btn.setAttribute("data-page", page);
                        btn.disabled = false;
                        btn.textContent = "المزيد";
                    }
                } catch (error) {
                    alert("خطأ في تحميل المزيد");
                    btn.disabled = false;
                    btn.textContent = "المزيد";
                }

                loading = false;
            }

            // Mobile load more
            if (e.target.classList.contains("mobile-load-more-btn")) {
                if (loading) return;

                let btn = e.target;
                let page = parseInt(btn.getAttribute("data-page")) + 1;

                loading = true;
                btn.disabled = true;
                btn.textContent = "جاري التحميل...";

                try {
                    let response = await fetch(`/trend/${categoryId}?page=${page}&view=mobile`, {
                        headers: { "X-Requested-With": "XMLHttpRequest" }
                    });

                    if (!response.ok) throw new Error("خطأ في السيرفر");

                    let data = await response.text();
                    const trimmed = data.trim();

                    if (trimmed.length === 0) {
                        const cont = btn.closest("#mobile-load-more-container");
                        if (cont) cont.remove();
                    } else {
                        const mobileContainer = document.getElementById("mobile-tags-container");
                        if (mobileContainer) {
                            mobileContainer.insertAdjacentHTML("beforeend", trimmed);
                        }

                        btn.setAttribute("data-page", page);
                        btn.disabled = false;
                        btn.textContent = "المزيد";
                    }
                } catch (error) {
                    alert("خطأ في تحميل المزيد");
                    btn.disabled = false;
                    btn.textContent = "المزيد";
                }

                loading = false;
            }
        });
    </script>
@endsection
