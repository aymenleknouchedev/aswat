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
