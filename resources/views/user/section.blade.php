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
                        @if (isset($contents[0]->country))
                            {{ $contents[0]->category->name ?? '' }} - {{ $contents[0]->country->name ?? '' }}
                        @elseif (isset($contents[0]->continent))
                            {{ $contents[0]->category->name ?? '' }} - {{ $contents[0]->continent->name ?? '' }}
                        @else
                            {{ $contents[0]->category->name ?? '' }}
                        @endif
                    </h3>
                    <h2>{{ $contents[0]->title ?? '' }}</h2>
                    <p>{{ $contents[0]->summary ?? '' }}</p>
                </div>

                <!-- Left: list -->
                <div class="newCategory-list">
                    <div class="newCategory-feature-m">
                        <img src="{{ $contents[1]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                            alt="{{ $contents[1]->title ?? '' }}">
                        <h3>
                            @if (isset($contents[1]->country))
                                {{ $contents[1]->category->name ?? '' }} - {{ $contents[1]->country->name ?? '' }}
                            @elseif (isset($contents[1]->continent))
                                {{ $contents[1]->category->name ?? '' }} - {{ $contents[1]->continent->name ?? '' }}
                            @else
                                {{ $contents[1]->category->name ?? '' }}
                            @endif
                        </h3>
                        <h2>{{ $contents[1]->title ?? '' }}</h2>
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
                                            @if (isset($contents[$i]->country))
                                                {{ $contents[$i]->category->name ?? '' }} -
                                                {{ $contents[$i]->country->name ?? '' }}
                                            @elseif (isset($contents[$i]->continent))
                                                {{ $contents[$i]->category->name ?? '' }} -
                                                {{ $contents[$i]->continent->name ?? '' }}
                                            @else
                                                {{ $contents[$i]->category->name ?? '' }}
                                            @endif
                                        </h3>
                                        <p>{{ $contents[$i]->title ?? '' }}</p>
                                    </div>
                                </div>
                            @endif
                        @endfor
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
    </div>

    <div class="mobile">
    </div>


@endsection
