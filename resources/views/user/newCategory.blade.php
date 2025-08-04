@php
    $titles = [
        'بعد استهدافها.. الحوثيون يتبنون إغراق سفينة "إترنيتي" في البحر الأحمر',
        'الاتحاد الجزائري يتعاقد مع الإسباني مارتن زوبيمندي',
        'بعد استهدافها.. الحوثيون يتبنون إغراق سفينة "إترنيتي" في البحر الأحمر',
        'الاتحاد الجزائري يتعاقد مع الإسباني مارتن زوبيمندي',
        'بعد استهدافها.. الحوثيون يتبنون إغراق سفينة "إترنيتي" في البحر الأحمر',
        'الاتحاد الجزائري يتعاقد مع الإسباني مارتن زوبيمندي',
        'بعد استهدافها.. الحوثيون يتبنون إغراق سفينة "إترنيتي" في البحر الأحمر',
        'الاتحاد الجزائري يتعاقد مع الإسباني مارتن زوبيمندي',
        'بعد استهدافها.. الحوثيون يتبنون إغراق سفينة "إترنيتي" في البحر الأحمر',
        'الاتحاد الجزائري يتعاقد مع الإسباني مارتن زوبيمندي',
    ];

    $description =
        'أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات على تظاهرات مناهضة للحكومة.';
@endphp



@extends('layouts.index')

@section('title', 'أصوات جزائرية | الجزائر')

@section('content')

    <style>
        .newCategory {
            display: grid;
            grid-template-columns: 8fr 4fr;
            /* Right: big, Left: list */
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
            background: linear-gradient(rgba(0, 0, 0, 0.155), rgba(0, 0, 0, 0.851)),
                url('./user/assets/images/dz.jpg') center/cover no-repeat;
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

    @include('user.components.fixed-nav')

    {{-- Container --}}
    <div class="container">

        {{-- Title --}}
        <div class="title">
            <p class="section-title">الجزائر</p>
            @include('user.components.ligne')
            <div class="under-title-ligne-space"></div>
        </div>

        <div class="newCategory">
            <!-- Right: big feature -->
            <div class="newCategory-feature">
                <img src="./user/assets/images/IMG21.jpg" alt="Feature newCategory">
                <h3>سياسة</h3>
                <h2>تبون: الجزائر ليست معزولة دوليًا</h2>
                <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات
                    على تظاهرات مناهضة للحكومة.</p>
            </div>

            <!-- Left: list -->
            <div class="newCategory-list">
                <div class="newCategory-feature-m">
                    <img src="./user/assets/images/IMG22.jpg" alt="Feature newCategory small">
                    <h3>سياسة</h3>
                    <h2>بوادر أزمة حادة بين الجزائر والاتحاد الأوروبي بسبب «اتفاق الشراكة»</h2>
                    <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع
                        سنوات على تظاهرات مناهضة للحكومة.
                    </p>
                </div>

                <div class="news-card-horizontal">
                    <div class="news-card-image">
                        <img src="./user/assets/images/IMG20.jpg" alt="تحلية مياه البحر">
                    </div>
                    <div class="news-card-text">
                        <h3>اقتصاد جزائري</h3>
                        <p>الجزائر تُسرّع وتيرة تحلية مياه البحر لتفكيك «قنبلة العطش»</p>
                    </div>
                </div>

                <div class="news-card-horizontal">
                    <div class="news-card-image">
                        <img src="./user/assets/images/IMG19.jpg" alt="بوعلام صنصال">
                    </div>
                    <div class="news-card-text">
                        <h3>سياسة</h3>
                        <p>تثبيت الحكم بسجن الكاتب بوعلام صنصال خمس سنوات</p>
                    </div>
                </div>
            </div>
        </div>


        <div>
            <section class="art-section-hero">
                <div class="art-section-overlay">
                    <h2 class="art-section-title">الذاكرة الجزائرية</h2>

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


        @include('user.components.sp60')


        <div class="newCategory-all-section">
            <!-- Left: Cards loop -->
            <div class="newCategory-all-list">
                @foreach ($titles as $title)
                    <div class="newCategory-all-card">
                        <div class="newCategory-all-card-image">
                            <img src="./user/assets/images/IMG19.jpg" alt="News Image">
                        </div>
                        <div class="newCategory-all-card-text">
                            <h3>سياسة</h3>
                            <h2>{{ $title }}</h2>
                            <p>{{ $description }}</p>
                        </div>
                    </div>
                @endforeach
                <button class="photos-load-more-btn">المزيد</button>

            </div>

            <!-- Right: Empty -->
            <div class="newCategory-all-side">
                <div>
                    <p class="section-title">الأكثر قراءة</p>
                    @include('user.components.ligne')
                    <div class="newCategoryReadMore">
                        <div class="newCategoryReadMore-list">
                            <span class="number">1</span>
                            <p>فاجعة في العراق.. وفاة 60 شخصًا على الأقل بحريق «مول الكوت» في واسط</p>
                        </div>
                        <div class="newCategoryReadMore-list">
                            <span class="number">2</span>
                            <p>يعاني منه دونالد ترمب.. إليك ما يجب أن تعرفه عن القصور الوريدي المزمن</p>
                        </div>
                        <div class="newCategoryReadMore-list">
                            <span class="number">3</span>
                            <p>جنبلاط طرح حلًّا لأحداث السويداء.. إليك النقاط التي عرضها</p>
                        </div>
                        <div class="newCategoryReadMore-list">
                            <span class="number">4</span>
                            <p>دماء وجثث في الأزقة.. صور تكشف انتهاكات بحق المدنيين في السويداء</p>
                        </div>
                        <div class="newCategoryReadMore-list">
                            <span class="number">5</span>
                            <p>هل تذهب إلى ألبانيزي أم ترمب؟ نوبل للسلام: تاريخ من التحيّزات</p>
                        </div>
                    </div>

                </div>

                @include('user.components.sp60')

                <p class="section-title">مقترحات</p>
                @include('user.components.ligne')

                @for ($i = 1; $i <= 5; $i++)
                    <div class="sp20" style="margin-top: 16px;">
                    </div>
                    <div class="news-card-horizontal">
                        <div class="news-card-image">
                            <img src="./user/assets/images/IMG20.jpg" alt="تحلية مياه البحر">
                        </div>
                        <div class="news-card-text">
                            <h3>اقتصاد جزائري</h3>
                            <p>الجزائر تُسرّع وتيرة تحلية مياه البحر لتفكيك «قنبلة العطش»</p>
                        </div>
                    </div>
                @endfor
            </div>


        </div>

        @include('user.components.sp60')



    </div>

    @include('user.components.footer')

@endsection
