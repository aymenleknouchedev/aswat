@extends('layouts.index')

@section('title', 'أصوات جزائرية | ثقافة و فنون')

@section('content')

    <style>
        .newCategory {
            display: grid;
            grid-template-columns: 8fr 4fr;
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
            margin: 0 0 8px 0;
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

        .newCategory-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .newCategory-feature-m img {
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
            display: block;
        }

        .newCategory-feature-m h2 {
            font-size: 18px;
            margin: 0 0 8px 0;
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

        .economy-grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* 4 equal cards side by side */
            gap: 20px;
        }

        .economy-card {
            display: flex;
            flex-direction: column;
        }

        .economy-card img {
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
        }

        .economy-card h3 {
            font-size: 12px;
            margin: 8px 0 4px;
            color: #74747C;
            font-family: asswat-light;
            font-weight: lighter;
        }

        .economy-card h2 {
            font-size: 16px;
            margin: 0;
            font-family: asswat-bold;
            color: #333;
        }

        .economy-card p {
            font-size: 14px;
            color: #555;
        }



        .art-section-hero {
            position: relative;
            margin-top: 20px;
            background: linear-gradient(rgba(0, 0, 0, 0.155), rgba(0, 0, 0, 0.851)),
                url('./user/assets/images/IMG9.webp') center/cover no-repeat;
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
        }



        /* المؤشر pointer لجميع النصوص داخل الكروت والأقسام */
        .newCategory-feature,
        .newCategory-feature *,
        .newCategory-feature-m,
        .newCategory-feature-m *,
        .news-card-horizontal,
        .news-card-horizontal *,
        .economy-card,
        .economy-card *,
        .art-section-card,
        .art-section-card * {
            cursor: pointer;
        }

        /* تحت خط للعناوين عند المرور */
        .newCategory-feature h2:hover,
        .newCategory-feature-m h2:hover,
        .news-card-horizontal .news-card-text p:hover,
        .economy-card h2:hover,
        .art-section-card h2:hover {
            text-decoration: underline;
        }
    </style>

    @include('user.components.fixed-nav')

    {{-- Container --}}
    <div class="container">

        {{-- Title --}}
        <div class="title">
            <p class="section-title">ثقافة و فنون</p>
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

        @include('user.components.sp60')

        {{-- Title --}}
        <div class="title">
            <p class="section-title">أفكار</p>
            @include('user.components.ligne')
            <div class="under-title-ligne-space"></div>
        </div>


        <section class="economy-feature-grid">
            <div class="economy-grid-container">
                <div class="economy-card">
                    <img src="./user/assets/images/IMG9.webp" alt="Feature economy">
                    <h3></h3>
                    <h2>البنك الدولي يتوقع أسوأ عقد للنمو العالمي منذ الستينيات</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG10.webp" alt="Feature economy">
                    <h3></h3>
                    <h2>ترمب يهدد «بريكس» مجدداً</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG11.webp" alt="Feature economy">
                    <h3></h3>
                    <h2>«بلاكستون» تنسحب من صفقة شراء «تيك توك»</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG12.webp" alt="Feature economy">
                    <h3></h3>
                    <h2>الرئيس الجزائري: احتياطي النقد الأجنبي عند 70 مليار دولار</h2>
                </div>
            </div>
        </section>

        @include('user.components.sp60')

        {{-- Title --}}
        <div class="title">
            <p class="section-title">فنون</p>
            @include('user.components.ligne')
            <div class="under-title-ligne-space"></div>
        </div>

        <section class="economy-feature-grid">
            <div class="economy-grid-container">
                <div class="economy-card">
                    <img src="./user/assets/images/IMG9.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>البنك الدولي يتوقع أسوأ عقد للنمو العالمي منذ الستينيات</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG10.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>ترمب يهدد «بريكس» مجدداً</h2>

                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG11.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>«بلاكستون» تنسحب من صفقة شراء «تيك توك»</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG12.webp" alt="Feature economy">

                    <h3>اقتصاد جزائري</h3>
                    <h2>الرئيس الجزائري: احتياطي النقد الأجنبي عند 70 مليار دولار</h2>
                </div>
            </div>
        </section>


        <section class="art-section-hero">
            <div class="art-section-overlay">
                <h2 class="art-section-title">ورق قديم</h2>

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




        @include('user.components.sp60')

        {{-- Title --}}
        <div class="title">
            <p class="section-title">كتب</p>
            @include('user.components.ligne')
            <div class="under-title-ligne-space"></div>
        </div>

        <section class="economy-feature-grid">
            <div class="economy-grid-container">
                <div class="economy-card">
                    <img src="./user/assets/images/IMG9.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>البنك الدولي يتوقع أسوأ عقد للنمو العالمي منذ الستينيات</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG10.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>ترمب يهدد «بريكس» مجدداً</h2>

                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG11.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>«بلاكستون» تنسحب من صفقة شراء «تيك توك»</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG12.webp" alt="Feature economy">

                    <h3>اقتصاد جزائري</h3>
                    <h2>الرئيس الجزائري: احتياطي النقد الأجنبي عند 70 مليار دولار</h2>
                </div>
            </div>
        </section>

        <section class="art-section-hero">
            <div class="art-section-overlay">
                <h2 class="art-section-title">ورق قديم</h2>

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
        @include('user.components.sp60')

        {{-- Title --}}
        <div class="title">
            <p class="section-title">شوهد من قبل</p>
            @include('user.components.ligne')
            <div class="under-title-ligne-space"></div>
        </div>

        <section class="economy-feature-grid">
            <div class="economy-grid-container">
                <div class="economy-card">
                    <img src="./user/assets/images/IMG9.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>البنك الدولي يتوقع أسوأ عقد للنمو العالمي منذ الستينيات</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG10.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>ترمب يهدد «بريكس» مجدداً</h2>

                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG11.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>«بلاكستون» تنسحب من صفقة شراء «تيك توك»</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG12.webp" alt="Feature economy">

                    <h3>اقتصاد جزائري</h3>
                    <h2>الرئيس الجزائري: احتياطي النقد الأجنبي عند 70 مليار دولار</h2>
                </div>
            </div>

            <section class="art-section-hero">
                <div class="art-section-overlay">
                    <h2 class="art-section-title">كان</h2>

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

        </section>
        @include('user.components.sp60'){{-- Title --}}
        <div class="title">
            <p class="section-title">نصوص</p>
            @include('user.components.ligne')
            <div class="under-title-ligne-space"></div>
        </div>

        <section class="economy-feature-grid">
            <div class="economy-grid-container">
                <div class="economy-card">
                    <img src="./user/assets/images/IMG9.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>البنك الدولي يتوقع أسوأ عقد للنمو العالمي منذ الستينيات</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG10.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>ترمب يهدد «بريكس» مجدداً</h2>

                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG11.webp" alt="Feature economy">

                    <h3>اقتصاد عالمي</h3>
                    <h2>«بلاكستون» تنسحب من صفقة شراء «تيك توك»</h2>
                </div>
                <div class="economy-card">
                    <img src="./user/assets/images/IMG12.webp" alt="Feature economy">
                    <h3>اقتصاد جزائري</h3>
                    <h2>الرئيس الجزائري: احتياطي النقد الأجنبي عند 70 مليار دولار</h2>
                </div>
            </div>


        </section>





        @include('user.components.sp60')

    </div>

    @include('user.components.footer')

@endsection
