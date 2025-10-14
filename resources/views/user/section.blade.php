@extends('layouts.index')

@section('title', 'أصوات جزائرية | الجزائر')

@section('content')

    <style>
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
                url('{{ asset($window->image) }}') center/cover no-repeat;
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

        <div class="container">
            <div class="title">
                <p class="section-title">{{ $arabicName }}</p>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
            </div>

            <div class="newCategory">
                <!-- Right: big feature -->
                <div class="newCategory-feature">
                    <img src="{{ $contents[0]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $contents[0]->title ?? '' }}">
                    <h3>
                        <x-category-links :content="$contents[0]" />

                    </h3>
                    <a href="{{ route('news.show', $contents[0]->title) }}" style="text-decoration: none; color: inherit;">
                        <h2>{{ $contents[0]->title ?? '' }}</h2>
                    </a>
                    <p>{{ $contents[0]->summary ?? '' }}</p>
                </div>

                <!-- Left: list -->
                <div class="newCategory-list">
                    <div class="newCategory-feature-m">
                        <img src="{{ $contents[1]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                            alt="{{ $contents[1]->title ?? '' }}">
                        <h3>
                            <x-category-links :content="$contents[1]" />

                        </h3>
                        <a href="{{ route('news.show', $contents[1]->title) }}"
                            style="text-decoration: none; color: inherit;">
                            <h2>{{ $contents[1]->title ?? '' }}</h2>
                        </a>
                        <p>{{ $contents[1]->summary ?? '' }}</p>
                    </div>

                    <div class="newCategory-list-div">
                        @for ($i = 2; $i <= 3; $i++)
                            @if (isset($contents[$i]))
                                <div class="news-card-horizontal">
                                    <div class="news-card-image">
                                        <img src="{{ $contents[$i]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                            alt="{{ $contents[$i]->title ?? '' }}">
                                    </div>
                                    <div class="news-card-text">
                                        <h3>
                                            <x-category-links :content="$contents[$i]" />

                                        </h3>
                                        <a href="{{ route('news.show', $contents[$i]->title) }}"
                                            style="text-decoration: none; color: inherit;">
                                            <p>{{ $contents[$i]->title ?? '' }}</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>

            @if (count($window->contents ?? []) >= 0 && $windowmanagement->status === 1)
                <section class="art-section-hero">
                    <div class="art-section-overlay">
                        <h2 class="art-section-title">{{ $window->name }}</h2>
                        <div class="art-section-grid">
                            @foreach ($window->contents ?? [] as $content)
                                <div class="art-section-card">
                                    <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? asset($content->image) }}"
                                        alt="{{ $content->title }}">
                                    <a href="{{ route('news.show', $content->title) }}"
                                        style="text-decoration: none; color: inherit;">
                                        <h2>{{ $content->title }}</h2>
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
                    <div id="content-container">
                        @include('user.partials.section-items', ['moreContents' => $moreContents])
                    </div>

                    <div class="text-center mt-3" id="load-more-container">
                        <button class="photos-load-more-btn btn btn-primary" data-page="1"
                            data-section="{{ $section }}">
                            المزيد
                        </button>
                    </div>
                </div>

                <!-- Right: Empty -->
                <div class="newCategory-all-side">
                    <div>
                        <p class="section-title">الأكثر قراءة</p>
                        @include('user.components.ligne')
                        <div class="newCategoryReadMore">
                            @foreach ($topViewed as $index => $item)
                                <div class="newCategoryReadMore-list">
                                    <span class="number">{{ $index + 1 }}</span>
                                    <a href="{{ route('news.show', $item->title) }}"
                                        style="text-decoration: none; color: inherit;">
                                        <p>{{ $item->title }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    @include('user.components.sp60')

                    <p class="section-title">مقترحات</p>
                    @include('user.components.ligne')

                    @foreach ($suggestions as $content)
                        <div class="sp20" style="margin-top: 16px;"></div>
                        <div class="news-card-horizontal">
                            <div class="news-card-image">
                                <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                    alt="{{ $content->title ?? 'تحلية مياه البحر' }}">
                            </div>
                            <div class="news-card-text">
                                <x-category-links :content="$content" fallback="اقتصاد جزائري" />
                                <a href="{{ route('news.show', $content->title) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <p>{{ $content->title ?? '' }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>

            @include('user.components.sp60')



        </div>

        @include('user.components.footer')
    </div>

    <div class="mobile">
    </div>


@endsection


<script>
    let loading = false;

    document.addEventListener("click", async function(e) {
        if (e.target.classList.contains("photos-load-more-btn")) {
            if (loading) return;

            let btn = e.target;
            let page = parseInt(btn.getAttribute("data-page")) + 1;
            let section = btn.getAttribute("data-section");

            loading = true;
            btn.disabled = true;
            btn.textContent = "جاري التحميل...";

            try {
                let response = await fetch(`/section/${section}?page=${page}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                if (!response.ok) throw new Error("خطأ في السيرفر");

                let data = await response.text();

                if (data.trim().length === 0) {
                    btn.closest("#load-more-container").remove();
                } else {
                    document.querySelector("#content-container").insertAdjacentHTML("beforeend", data);
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
