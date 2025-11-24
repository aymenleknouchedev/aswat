@extends('layouts.index')

@section('title', 'أصوات جزائرية | الجزائر')

@section('content')

    <style>
        .web {
            display: block !important;
        }

        .mobile {
            display: none !important;
        }

        .newCategory {
            display: grid;
            grid-template-columns: 8fr 4fr;
            gap: 20px;
        }

        .newCategory-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .newCategory-feature {
            position: relative;
        }

        .newCategory-feature img {
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
            display: block;
        }

        .newCategory-feature h2 {
            font-size: 24px;
            margin: 0px 0px 8px 0;
            font-family: asswat-bold;
            line-height: 1.4;
        }

        .newCategory-feature h3 {
            font-family: asswat-light;
            font-weight: lighter;
            font-size: 12px;
            margin: 8px 0 4px;
            color: #74747C;
        }

        .newCategory-feature p {
            font-size: 17px;
            color: #555;
            line-height: 1.5;
        }

        .newCategory-feature-m img {
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
            display: block;
        }

        .newCategory-feature-m h2 {
            font-size: 18px;
            margin: 0px 0px 8px 0;
            font-family: asswat-bold;
            line-height: 1.4;
        }

        .newCategory-feature-m h3 {
            font-size: 12px;
            margin: 8px 0 4px;
            color: #74747C;
            font-family: asswat-light;
            font-weight: lighter;
        }

        .newCategory-feature-m p {
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

        .newCategory-all-section {
            display: grid;
            grid-template-columns: 8fr 4fr;
            gap: 70px;
        }

        .newCategory-all-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .newCategory-all-card {
            display: flex;
            gap: 20px;
            direction: rtl;
            /* Image right, text left for Arabic */
        }

        .newCategory-all-card-image img {
            width: 300px;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .newCategory-all-card-text {
            flex: 1;
        }

        .newCategory-all-card-text h3 {
            font-family: asswat-light;
            font-size: 12px;
            color: #74747C;
            margin: 0 0 4px 0;
        }

        .newCategory-all-card-text h2 {
            font-family: asswat-bold;
            font-size: 18px;
            margin: 0 0 8px 0;
            line-height: 1.4;
        }

        .newCategory-all-card-text p {
            font-size: 15px;
            color: #555;
            line-height: 1.5;
            margin: 0;
        }

        /* .newCategory-all-side {} */

        .newCategoryReadMore {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .newCategoryReadMore-list {
            margin-top: 12px;
            display: flex;
            align-items: center;
            direction: rtl;
            font-family: asswat-bold;
            border-bottom: 1px solid #ddd;
            /* الخط الرمادي */
            padding-bottom: 10px;
            /* مسافة بين النص والخط */
        }

        .newCategoryReadMore-list:last-child {
            border-bottom: none;
        }

        .newCategoryReadMore-list .number {
            font-size: 32px;
            color: #e7e7e7;
            margin-left: 10px;
            font-weight: bold;
        }

        .newCategoryReadMore-list p {
            font-size: 16px;
            color: #333;
            line-height: 1.4;
        }

        .photos-load-more-btn {
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

        .photos-load-more-btn:hover {
            background: #ddd;
        }

        /* Make all text elements clickable except description paragraphs */

        /* عناوين العناصر الكبيرة والصغيرة */
        .newCategory-feature h2,
        .newCategory-feature h3,
        .newCategory-feature-m h2,
        .newCategory-feature-m h3,
        .news-card-horizontal .news-card-text h3,
        .news-card-horizontal .news-card-text p,
        .newCategory-all-card-text h2,
        .newCategory-all-card-text h3,
        .newCategoryReadMore-list p {
            cursor: pointer;
        }

        /* القوائم الجانبية */
        .newCategoryReadMore-list {
            cursor: pointer;
        }

        /* بطاقات المقترحات */
        .news-card-horizontal {
            cursor: pointer;
        }

        /* لا تضع cursor pointer للوصف الرئيسي */
        .newCategory-feature p,
        .newCategory-feature-m p,
        .newCategory-all-card-text p {
            cursor: auto;
        }

        /* Add underline on hover for big titles */
        .newCategory-feature h2:hover,
        .newCategory-feature-m h2:hover,
        .newCategory-all-card-text h2:hover,
        .newCategoryReadMore-list p:hover,
        .news-card-horizontal .news-card-text p:hover {
            text-decoration: underline;
        }

        .art-section-hero {
            position: relative;
            margin-top: 60px;
            background: linear-gradient(rgba(0, 0, 0, 0.0), rgba(0, 0, 0, 0.851)),
                url('{{ asset($window->image ?? '') }}') center/cover no-repeat;
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

        .section-title {
            font-size: 32px;
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

    <style>
        @media (max-width: 992px) {
            .web {
                display: none !important;
            }

            .mobile {
                display: block !important;
            }

            /* Horizontal snap scroller (reuse styles from home) */
            .mobile-h-wrapper {
                width: 100%;
                height: 80svh;
                scroll-snap-align: start;
                scroll-snap-stop: always;
                position: relative;
            }

            /* Full-screen wrapper for list sections */
            .mobile-fullscreen-wrapper {
                width: 100%;
                height: 100vh;
                scroll-snap-align: start;
                scroll-snap-stop: always;
                position: relative;
            }

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
                direction: rtl;
            }

            .h-snap::-webkit-scrollbar {
                display: none;
            }

            .h-snap-slide {
                width: 100vw;
                height: 100%;
                scroll-snap-align: start;
                scroll-snap-stop: always;
                /* ensure one-slide-at-a-time */
                position: relative;
                display: block;
                text-decoration: none;
                color: inherit;
            }

            .post-overlay-dark {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to top, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.0), rgba(0, 0, 0, 0.0));
                z-index: 1;
            }

            .featured-post-section-badge {
                position: absolute;
                top: 90px;
                right: 16px;
                z-index: 2;
                background: #fff;
                color: #000;
                padding: 6px 12px;
                font-size: 23px;
                font-weight: 800;
                line-height: 1;
                border-radius: 0;
                display: inline-block;
                text-align: center;
            }

            .section-fixed-ui {
                position: absolute;
                top: 90px;
                right: 16px;
                z-index: 3;
                display: flex;
                align-items: stretch;
                gap: 8px;
            }

            .section-fixed-ui .featured-post-section-badge {
                position: static;
            }

            .h-indicators {
                display: flex;
                flex-direction: row;
                align-items: stretch;
                justify-content: flex-start;
                gap: 5px;
            }

            .h-indicator {
                width: 4px;
                height: 100%;
                background: rgba(255, 255, 255, 0.262);
                border-radius: 2px;
            }

            .h-indicator.active {
                background: #ffffff;
            }

            .mobile-featured-post {
                width: 100%;
                height: 80svh;
                position: relative;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                overflow: hidden;
            }

            .featured-post-content2 {
                position: absolute;
                bottom: 60px;
                left: 0;
                right: 0;
                z-index: 2;
                padding: 0 20px;
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
                font-size: 16px;
                color: #ffffff;
                line-height: 1.5;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                font-family: 'asswat-regular';
            }

            /* Simple list under scroller */
            .mobile-simple-list {
                padding: 12px 0 8px;
            }

            .mobile-simple-header {
                padding: 12px 16px 8px;
                font-size: 20px;
                font-weight: 800;
            }

            .mobile-simple-ul {
                list-style: none;
                margin: 0;
                padding: 0 16px 12px;
            }

            .mobile-simple-item+.mobile-simple-item {
                border-top: 1px solid rgba(0, 0, 0, 0.12);
            }

            .mobile-simple-link {
                display: flex;
                gap: 12px;
                align-items: center;
                padding: 12px 0;
                text-decoration: none;
                color: inherit;
            }

            .ms-thumb img {
                width: 135px;
                aspect-ratio: 16/9;
                object-fit: cover;
                display: block;
            }

            .ms-text {
                display: flex;
                flex-direction: column;
                /* occupy remaining space next to the 120px thumbnail + 12px gap */
                flex: 1 1 0;
                min-width: 0;
                /* allow text to shrink without overflow */
                width: calc(100% - 147px);
            }

            .ms-cat {
                margin: 0 0 6px 0;
                font-size: 14px;
                color: #74747C;
            }

            .ms-title {
                margin: 0;
                font-size: 18px;
                font-weight: 800;
                line-height: 1.35;
                color: #000;
                font-family: 'asswat-bold';
            }

            /* Mobile "Read more" button */
            #mobile-load-more-container {
                padding: 8px 0 28px;
            }

            #mobile-load-more-container .mobile-load-more-btn {
                display: block;
                width: calc(100% - 32px);
                margin: 0 16px;
                padding: 14px 16px;
                background: #e7e7e7;
                color: #252525;
                font-size: 18px;
                font-family: 'asswat-bold';
                letter-spacing: .2px;
                text-align: center;
            }

            /* Mobile Window Carousel */
            .mobile-window-section {
                padding: 12px 0 8px;
            }

            .mobile-window-header {
                padding-bottom: 8px;
            }

            .mobile-window-carousel {
                display: flex;
                gap: 12px;
                padding: 0px 16px;
                overflow-x: auto;
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                direction: rtl;
            }

            .mobile-window-carousel::-webkit-scrollbar {
                display: none;
            }

            .mobile-window-card {
                flex: 0 0 280px;
                scroll-snap-align: start;
                position: relative;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                background: #fff;
            }

            .mobile-window-card:active {
                transform: scale(0.98);
            }

            .mobile-window-link {
                display: block;
                text-decoration: none;
                color: inherit;
                height: 100%;
            }

            .mobile-window-image-wrapper {
                position: relative;
                width: 100%;
                height: 200px;
                overflow: hidden;
            }

            .mobile-window-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform 0.4s ease;
            }

            .mobile-window-card:active .mobile-window-image {
                transform: scale(1.05);
            }

            .mobile-window-overlay {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 60%;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
                pointer-events: none;
            }

            .mobile-window-content {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                padding: 16px;
                z-index: 2;
            }

            .mobile-window-card-title {
                font-size: 16px;
                font-weight: 800;
                font-family: 'asswat-bold';
                color: #fff;
                margin: 0;
                line-height: 1.4;
                text-align: right;
                direction: rtl;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            /* Most Reads full-screen section */
            .most-reads-screen {
                width: 100%;
                height: 100dvh;
                background: #252525;
                color: #000;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 131px 20px 80px;
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
            }

            .most-reads-item {
                display: flex;
                align-items: center;
                gap: 21px;
                padding: 24px 0;
            }

            .most-reads-item+.most-reads-item {
                border-top: 1px solid rgba(255, 255, 255, 0.18);
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
                font-size: 20px;
                font-weight: 800;
                line-height: 1.4;
                font-family: 'asswat-bold';
            }

            /* Suggestions full-screen section (white background) */
            .suggestions-screen {
                width: 100%;
                height: 100dvh;
                background: #ffffff;
                color: #000;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 131px 20px 80px;
                box-sizing: border-box;
            }

            .suggestions-list {
                list-style: none;
                margin: 0;
                padding: 0;
                width: 100%;
                max-width: 820px;
                display: flex;
                flex-direction: column;
                gap: 0;
            }

            .suggestions-item {
                display: flex;
                align-items: center;
                gap: 21px;
                padding: 24px 0;
            }

            .suggestions-item+.suggestions-item {
                border-top: 1px solid rgba(0, 0, 0, 0.12);
            }

            .sg-index {
                min-width: 28px;
                text-align: center;
                font-weight: 900;
                font-size: 43px;
                line-height: 1;
                color: #e7e7e7;
                font-family: 'asswat-bold';
            }

            .sg-title {
                display: inline-block;
                color: #000;
                text-decoration: none;
                font-size: 20px;
                font-weight: 800;
                line-height: 1.4;
                font-family: 'asswat-bold';
            }


        }
    </style>

    <div class="web">
        @include('user.components.fixed-nav')

        <div class="container">
            <div class="title">
                <p class="section-title">{{ $arabicName ?? 'القسم' }}</p>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
            </div>

            @if (isset($contents) && count($contents) > 0)
                <div class="newCategory">
                    <!-- Right: big feature -->
                    <div class="newCategory-feature">
                        @if (isset($contents[0]))
                            <a href="{{ route('news.show', $contents[0]->title ?? '') }}">
                                <img src="{{ $contents[0]->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/placeholder.jpg' }}"
                                    alt="{{ $contents[0]->title ?? 'عنوان الخبر' }}">
                            </a>
                            <h3>
                                <x-category-links :content="$contents[0]" />
                            </h3>
                            <a href="{{ route('news.show', $contents[0]->title ?? '') }}"
                                style="text-decoration: none; color: inherit;">
                                <h2>{{ $contents[0]->title ?? 'عنوان الخبر' }}</h2>
                            </a>
                            <p>{{ $contents[0]->summary ?? 'ملخص الخبر' }}</p>
                        @else
                            <img src="./user/assets/images/placeholder.jpg" alt="لا يوجد محتوى">
                            <h3>لا يوجد محتوى</h3>
                            <h2>لا توجد أخبار متاحة</h2>
                            <p>لم يتم العثور على أي محتوى لهذا القسم.</p>
                        @endif
                    </div>

                    <!-- Left: list -->
                    <div class="newCategory-list">
                        @if (isset($contents[1]))
                            <div class="newCategory-feature-m">
                                <a href="{{ route('news.show', $contents[1]->title ?? '') }}">
                                    <img src="{{ $contents[1]->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/placeholder.jpg' }}"
                                        alt="{{ $contents[1]->title ?? 'عنوان الخبر' }}">
                                </a>
                                <h3>
                                    <x-category-links :content="$contents[1]" />
                                </h3>
                                <a href="{{ route('news.show', $contents[1]->title ?? '') }}"
                                    style="text-decoration: none; color: inherit;">
                                    <h2>{{ $contents[1]->title ?? 'عنوان الخبر' }}</h2>
                                </a>
                                <p>{{ $contents[1]->summary ?? 'ملخص الخبر' }}</p>
                            </div>
                        @endif

                        <div class="newCategory-list-div">
                            @for ($i = 2; $i <= 3; $i++)
                                @if (isset($contents[$i]))
                                    <div class="news-card-horizontal">
                                        <div class="news-card-image">
                                            <a href="{{ route('news.show', $contents[$i]->title ?? '') }}">
                                                <img src="{{ $contents[$i]->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/placeholder.jpg' }}"
                                                    alt="{{ $contents[$i]->title ?? 'عنوان الخبر' }}">
                                            </a>
                                        </div>
                                        <div class="news-card-text">
                                            <h3>
                                                <x-category-links :content="$contents[$i]" />
                                            </h3>
                                            <a href="{{ route('news.show', $contents[$i]->title ?? '') }}"
                                                style="text-decoration: none; color: inherit;">
                                                <p>{{ $contents[$i]->title ?? 'عنوان الخبر' }}</p>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <p>لا توجد أخبار متاحة في هذا القسم حالياً.</p>
                </div>
            @endif

            @if (isset($window) &&
                    isset($windowmanagement) &&
                    $windowmanagement->status === 1 &&
                    isset($window->contents) &&
                    count($window->contents) > 0)
                <section class="art-section-hero">
                    <div class="art-section-overlay">
                        <h2 class="art-section-title">{{ $window->name ?? 'النافذة' }}</h2>
                        <div class="art-section-grid">
                            @foreach ($window->contents as $content)
                                <div class="art-section-card">
                                    <a href="{{ route('news.show', $content->title ?? '') }}">
                                        <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? ($content->image ?? './user/assets/images/placeholder.jpg') }}"
                                            alt="{{ $content->title ?? 'عنوان الخبر' }}">
                                    </a>
                                    <a href="{{ route('news.show', $content->title ?? '') }}"
                                        style="text-decoration: none; color: inherit;">
                                        <h2>{{ $content->title ?? 'عنوان الخبر' }}</h2>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @include('user.components.sp60')

            <div class="newCategory-all-section">
                <!-- Left: Cards loop -->
                <div class="newCategory-all-list">
                    @if (isset($moreContents) && count($moreContents) > 0)
                        <div id="content-container">
                            @include('user.partials.section-items', ['moreContents' => $moreContents])
                        </div>

                        <div class="text-center mt-3" id="load-more-container">
                            <button class="photos-load-more-btn btn btn-primary" data-page="1"
                                data-section="{{ $section ?? '' }}">
                                المزيد
                            </button>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p>لا توجد المزيد من الأخبار في هذا القسم.</p>
                        </div>
                    @endif
                </div>

                <!-- Right: Sidebar -->
                <div class="newCategory-all-side">
                    <div>
                        <p class="section-title">الأكثر قراءة</p>
                        @include('user.components.ligne')
                        <div class="newCategoryReadMore">
                            @if (isset($topViewed) && count($topViewed) > 0)
                                @foreach ($topViewed as $index => $item)
                                    <div class="newCategoryReadMore-list">
                                        <span class="number">{{ $index + 1 }}</span>
                                        <a href="{{ route('news.show', $item->title ?? '') }}"
                                            style="text-decoration: none; color: inherit;">
                                            <p>{{ $item->title ?? 'عنوان الخبر' }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    <p>لا توجد أخبار في قائمة الأكثر قراءة.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @include('user.components.sp60')

                    <p class="section-title">مقترحات</p>
                    @include('user.components.ligne')

                    @if (isset($suggestions) && count($suggestions) > 0)
                        @foreach ($suggestions as $content)
                            <div class="sp20" style="margin-top: 16px;"></div>
                            <div class="news-card-horizontal">
                                <div class="news-card-image">
                                    <a href="{{ route('news.show', $content->title ?? '') }}">
                                        <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/placeholder.jpg' }}"
                                            alt="{{ $content->title ?? 'تحلية مياه البحر' }}">
                                    </a>
                                </div>
                                <div class="news-card-text">
                                    <h3><x-category-links :content="$content" fallback="اقتصاد جزائري" /></h3>
                                    <a href="{{ route('news.show', $content->title ?? '') }}"
                                        style="text-decoration: none; color: inherit;">
                                        <p>{{ $content->title ?? 'عنوان الخبر' }}</p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            <p>لا توجد اقتراحات متاحة حالياً.</p>
                        </div>
                    @endif
                </div>
            </div>

            @include('user.components.sp60')
        </div>

        @include('user.components.footer')
    </div>

    <div class="mobile">
        @include('user.mobile.mobile-home')

        <!-- Mobile horizontal scroller for this section (no vertical snap) -->
        <div class="mobile-flow">
            @php
                $mobCount = isset($contents) && is_countable($contents) ? count($contents) : 0;
                $slideCount = $mobCount > 0 ? min(5, $mobCount) : 0;
            @endphp
            @if ($slideCount > 0)
                <div class="mobile-h-wrapper">
                    <div class="section-fixed-ui">
                        <div class="featured-post-section-badge">{{ $arabicName ?? 'القسم' }}</div>
                        <div class="h-indicators" role="tablist" aria-label="slides">
                            @for ($i = 0; $i < $slideCount; $i++)
                                <span class="h-indicator @if ($i === 0) active @endif"
                                    aria-label="{{ $i + 1 }}"
                                    aria-current="@if ($i === 0) true @else false @endif"></span>
                            @endfor
                        </div>
                    </div>
                    <div class="h-snap" dir="rtl">
                        @php
                            $mobItems = [];
                            if (isset($contents)) {
                                if ($contents instanceof \Illuminate\Support\Collection) {
                                    $mobItems = $contents->take($slideCount);
                                } elseif (is_array($contents)) {
                                    $mobItems = array_slice($contents, 0, $slideCount);
                                }
                            }
                        @endphp
                        @foreach ($mobItems as $c)
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
                                    <a href="{{ route('news.show', $c->title) }}"
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
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Mobile Window Carousel -->
            @if (isset($window) &&
                    isset($windowmanagement) &&
                    $windowmanagement->status === 1 &&
                    isset($window->contents) &&
                    count($window->contents) > 0)
                <div class="mobile-container">
                    <div class="mobile-window-section">
                        <div class="mobile-window-header">
                            <h2 class="mobile-simple-header">{{ $window->name ?? 'النافذة' }}</h2>
                            <div style="padding: 0px 16px">
                                @include('user.components.ligne')
                            </div>
                        </div>
                        <div class="mobile-window-carousel" dir="rtl">
                            @foreach ($window->contents as $content)
                                <div class="mobile-window-card">
                                    <a href="{{ route('news.show', $content->title ?? '') }}" class="mobile-window-link">
                                        <div class="mobile-window-image-wrapper">
                                            <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? ($content->image ?? './user/assets/images/placeholder.jpg') }}"
                                                alt="{{ $content->title ?? 'عنوان الخبر' }}" class="mobile-window-image">
                                            <div class="mobile-window-overlay"></div>
                                        </div>
                                        <div class="mobile-window-content">
                                            <h3 class="mobile-window-card-title">{{ $content->title ?? 'عنوان الخبر' }}</h3>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Simple moreContents list -->
            @php
                $moreMobItems = [];
                if (isset($moreContents)) {
                    // Support paginator, collection, or array
                    if (
                        $moreContents instanceof \Illuminate\Pagination\LengthAwarePaginator ||
                        $moreContents instanceof \Illuminate\Contracts\Pagination\Paginator
                    ) {
                        $col = $moreContents->getCollection();
                    } else {
                        $col = $moreContents;
                    }
                    if ($col instanceof \Illuminate\Support\Collection) {
                        $moreMobItems = $col->take(8);
                    } elseif (is_array($col)) {
                        $moreMobItems = array_slice($col, 0, 8);
                    }
                }
            @endphp
            @if (!empty($moreMobItems))
                <div class="mobile-container">
                    <div class="mobile-simple-list" dir="rtl">
                        <h2 class="mobile-simple-header">المزيد من {{ $arabicName ?? 'أخبار' }}</h2>
                        <div style="padding: 0px 16px">
                            @include('user.components.ligne')
                        </div>
                        <ul class="mobile-simple-ul" role="list">
                            @foreach ($moreMobItems as $mc)
                                <li class="mobile-simple-item">
                                    <a class="mobile-simple-link" href="{{ route('news.show', $mc->title) }}"
                                        aria-label="{{ $mc->title }}">
                                        <div class="ms-thumb">
                                            <img src="{{ $mc->media()->wherePivot('type', 'main')->first()->path ?? asset($mc->image ?? 'user/assets/images/default-post.jpg') }}"
                                                alt="{{ $mc->title }}">
                                        </div>
                                        <div class="ms-text">
                                            @if (isset($mc->category) && $mc->category)
                                                <p class="ms-cat">{{ $mc->category->name }}</p>
                                            @endif
                                            <p class="ms-title">
                                                {{ \Illuminate\Support\Str::limit($mc->mobile_title, 90) }}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Mobile Read More button -->
            <div class="text-center mt-3" id="mobile-load-more-container">
                <button class="mobile-load-more-btn btn btn-primary" data-page="1" data-section="{{ $section ?? '' }}">
                    المزيد
                </button>
            </div>


            <!-- Most Reads Screen -->
            @if (isset($topViewed) && $topViewed->count() > 0)
                <div class="mobile-fullscreen-wrapper">
                    <div class="section-fixed-ui">
                        <div class="featured-post-section-badge">مقروء أكثر</div>
                    </div>
                    <div class="most-reads-screen" dir="rtl">
                        <ol class="most-reads-list" role="list">
                            @foreach ($topViewed->take(5) as $i => $content)
                                <li class="most-reads-item">
                                    <span class="mr-index" aria-hidden="true">{{ $i + 1 }}</span>
                                    <a class="mr-title" href="{{ route('news.show', $content->title) }}">
                                        {{ \Illuminate\Support\Str::limit($content->mobile_title ?? $content->title, 50) }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @endif


            
            <!-- Suggestions Screen -->
            @if (isset($suggestions) && count($suggestions) > 0)
                <div class="mobile-fullscreen-wrapper">
                    <div class="section-fixed-ui">
                        <div class="featured-post-section-badge" style="background: #000; color: #fff;">مقترحات</div>
                    </div>
                    <div class="suggestions-screen" dir="rtl">
                        <ol class="suggestions-list" role="list">
                            @foreach ($suggestions->take(5) as $i => $content)
                                <li class="suggestions-item">
                                    <span class="sg-index" aria-hidden="true">{{ $i + 1 }}</span>
                                    <a class="sg-title" href="{{ route('news.show', $content->title) }}">
                                        {{ \Illuminate\Support\Str::limit($content->mobile_title ?? $content->title, 50) }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @endif

            <!-- Compact mobile footer at the end -->
            <div class="mobile-container">
                @include('user.mobile.footer')
            </div>


        </div>
    </div>



    <script>
        // Make mobile scroller dots reflect the current slide and be clickable
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth > 991) return; // mobile only
            const wrappers = Array.from(document.querySelectorAll('.mobile .mobile-h-wrapper'));
            wrappers.forEach(w => {
                const track = w.querySelector('.h-snap');
                const slides = track ? Array.from(track.querySelectorAll('.h-snap-slide')) : [];
                const indicators = Array.from(w.querySelectorAll('.h-indicator'));
                if (!track || slides.length === 0 || indicators.length === 0) return;

                function nearestIndex() {
                    const left = track.scrollLeft;
                    let best = 0,
                        bestDist = Infinity;
                    slides.forEach((s, i) => {
                        const d = Math.abs(s.offsetLeft - left);
                        if (d < bestDist) {
                            bestDist = d;
                            best = i;
                        }
                    });
                    return best;
                }

                function updateIndicators(idx) {
                    indicators.forEach((el, i) => {
                        if (i === idx) el.classList.add('active');
                        else el.classList.remove('active');
                    });
                }

                // Sync on load
                updateIndicators(0);

                // Debounced scroll listener to update active dot
                let t;
                track.addEventListener('scroll', () => {
                    clearTimeout(t);
                    t = setTimeout(() => updateIndicators(nearestIndex()), 120);
                }, {
                    passive: true
                });

                // Make dots clickable to jump to slide
                indicators.forEach((dot, i) => {
                    dot.style.cursor = 'pointer';
                    dot.addEventListener('click', () => {
                        const target = slides[i];
                        if (target) track.scrollTo({
                            left: target.offsetLeft,
                            behavior: 'smooth'
                        });
                    });
                });
            });
        });

        // Mobile Read More: fetch and append items to the simple list
        (function() {
            let mobileLoading = false;
            document.addEventListener('click', async function(e) {
                if (!e.target.classList.contains('mobile-load-more-btn')) return;
                if (mobileLoading) return;
                const btn = e.target;
                const section = btn.getAttribute('data-section');
                let page = parseInt(btn.getAttribute('data-page') || '1', 10) + 1;
                if (!section) {
                    console.error('Section is not defined');
                    return;
                }
                mobileLoading = true;
                btn.disabled = true;
                btn.textContent = 'جاري التحميل...';
                try {
                    const url = `/api/section/${section}?page=${page}`;
                    const resp = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (!resp.ok) throw new Error(`HTTP ${resp.status}`);
                    const html = await resp.text();
                    const tmp = document.createElement('div');
                    tmp.innerHTML = html;
                    const cards = Array.from(tmp.querySelectorAll('.newCategory-all-card'));
                    if (!cards.length) {
                        // No more data, remove container
                        btn.closest('#mobile-load-more-container')?.remove();
                    } else {
                        // Ensure list exists
                        let list = document.querySelector('.mobile .mobile-simple-ul');
                        if (!list) {
                            const container = document.createElement('div');
                            container.className = 'mobile-container';
                            container.innerHTML = `
                                <div class="mobile-simple-list" dir="rtl">
                                  <div class="mobile-simple-header">${document.querySelector('.featured-post-section-badge')?.textContent || 'المزيد'}</div>
                                  <ul class="mobile-simple-ul" role="list"></ul>
                                </div>`;
                            const insertPoint = document.querySelector('.mobile .mobile-flow');
                            if (insertPoint && insertPoint.parentNode) insertPoint.parentNode.insertBefore(
                                container, insertPoint.nextSibling);
                            list = container.querySelector('.mobile-simple-ul');
                        }
                        const frag = document.createDocumentFragment();
                        cards.forEach(card => {
                            const a = card.querySelector('.newCategory-all-card-text a[href]') ||
                                card.querySelector('a[href]');
                            const img = card.querySelector('img');
                            const cat = card.querySelector('.newCategory-all-card-text h3');
                            const li = document.createElement('li');
                            li.className = 'mobile-simple-item';
                            const href = a ? a.getAttribute('href') : '#';
                            const title = a ? (a.textContent || '').trim() : '';
                            const src = img ? img.getAttribute('src') : '';
                            const catText = cat ? (cat.textContent || '').trim() : '';
                            li.innerHTML = `
                                <a class="mobile-simple-link" href="${href}" aria-label="${title}">
                                  <div class="ms-thumb">
                                    <img src="${src}" alt="${title}">
                                  </div>
                                  <div class="ms-text">
                                    ${catText ? `<p class="ms-cat">${catText}</p>` : ''}
                                    <p class="ms-title">${title}</p>
                                  </div>
                                </a>`;
                            frag.appendChild(li);
                        });
                        list.appendChild(frag);
                        btn.setAttribute('data-page', String(page));
                        btn.disabled = false;
                        btn.textContent = 'المزيد';
                    }
                } catch (err) {
                    console.error('Mobile load more failed', err);
                    btn.disabled = false;
                    btn.textContent = 'المزيد';
                }
                mobileLoading = false;
            });
        })();
    </script>

@endsection

<script>
    let loading = false;

    document.addEventListener("click", async function(e) {
        if (e.target.classList.contains("photos-load-more-btn")) {
            if (loading) return;

            let btn = e.target;
            let page = parseInt(btn.getAttribute("data-page")) + 1;
            let section = btn.getAttribute("data-section");

            // Check if section is defined
            if (!section) {
                console.error("Section is not defined");
                alert("خطأ: لم يتم تحديد القسم");
                return;
            }

            console.log(`Loading more for section: ${section}, page: ${page}`);

            loading = true;
            btn.disabled = true;
            btn.textContent = "جاري التحميل...";

            try {
                const url = `/api/section/${section}?page=${page}`;
                console.log(`Fetching URL: ${url}`);

                let response = await fetch(url, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                console.log(`Response status: ${response.status}`);

                if (!response.ok) {
                    throw new Error(`HTTP Error: ${response.status} - ${response.statusText}`);
                }

                let data = await response.text();
                console.log(`Received data length: ${data.length}`);

                if (data.trim().length === 0) {
                    btn.closest("#load-more-container")?.remove();
                } else {
                    let container = document.querySelector("#content-container");
                    if (container) {
                        container.insertAdjacentHTML("beforeend", data);
                        btn.setAttribute("data-page", page);
                        btn.disabled = false;
                        btn.textContent = "المزيد";
                    }
                }
            } catch (error) {
                console.error("Error loading more content:", error);
                alert("خطأ في تحميل المزيد: " + error.message);
                btn.disabled = false;
                btn.textContent = "المزيد";
            }

            loading = false;
        }
    });
</script>
