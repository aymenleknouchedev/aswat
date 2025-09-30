@extends('layouts.index')

@section('title', 'أصوات جزائرية | صور')

@section('content')

    @include('user.components.fixed-nav')

    {{-- Container --}}
    <div class="container">

        {{-- Title --}}
        <div class="title">
            <p class="section-title">صور</p>
            @include('user.components.ligne')
            <div class="under-title-ligne-space"></div>
        </div>

        {{-- Feature Photos --}}
        <style>
            .custom-photos-feature {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 40px;
                margin-bottom: 60px;
            }

            .custom-photos-feature .custom-image-wrapper {
                position: relative;
                width: 100%;
                height: 100%;
            }

            .custom-photos-feature img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .custom-photos-feature .custom-corner-icon {
                position: absolute;
                bottom: 15px;
                left: 20px;
                width: 45px;
                height: 45px;
                color: white;
            }

            .custom-photos-feature .custom-corner-icon img {
                width: 100%;
                height: 100%;
            }

            .custom-photos-feature .custom-content {
                margin-top: 20px;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                padding: 20px;
            }

            .custom-photos-feature .custom-content h3 {
                margin: 0;
                color: #999;
                font-size: 12px;
                font-family: asswat-light;
                font-weight: lighter;
                cursor: pointer;
            }

            .custom-photos-feature .custom-content h2 {
                margin: 10px 0 10px;
                font-size: 24px;
                line-height: 1.3;
                font-family: asswat-bold;
                cursor: pointer;
                transition: .2s;
            }

            .custom-photos-feature .custom-content p {
                margin: 0;
                font-size: 17px;
                line-height: 1.6;
                color: #555;
            }

            .custom-photos-feature .custom-content h2:hover {
                text-decoration: underline;
            }
        </style>

        <div class="custom-photos-feature">
            <div class="custom-image-wrapper">
                <img id="photoImage" src="./user/assets/images/b1.jpeg" alt="Feature Algeria">
                <div class="custom-corner-icon">
                    @include('user.icons.image')
                </div>
            </div>

            <div class="custom-content">
                <h3 id="photoCategory">البرتغال</h3>
                <h2 id="photoTitle">يوم حزين لكرة القدم.. دموع وانهيارات في وداع ديوغو جوتا الأخير</h2>
                <p id="photoDescription">أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل
                    دياز-كانيل، بعد أربع سنوات
                    على تظاهرات مناهضة للحكومة.</p>
            </div>
        </div>

        {{-- Photos Grid --}}
        <style>
            .photos-section-wrapper {
                display: grid;
                grid-template-columns: 10fr 2fr;
                /* 8/12 محتوى + 4/12 فارغ */
                gap: 20px;
            }

            .photos-section-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .photos-section-item img {
                width: 100%;
                aspect-ratio: 16 / 9;
                object-fit: cover;
                display: block;
            }

            .photos-section-item h2 {
                font-size: 18px;
                margin: 0 0 8px 0;
                font-family: asswat-bold;
                line-height: 1.4;
                cursor: pointer;
                transition: .2s;
            }

            .photos-section-item h3 {
                font-size: 12px;
                margin: 8px 0 4px;
                color: #74747C;
                font-family: asswat-light;
                font-weight: lighter;
                cursor: pointer;
            }

            .photos-section-item h2:hover {
                text-decoration: underline;
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
        </style>

        <div class="photos-section-wrapper">
            <div>
                <div class="photos-section-grid">
                    <div class="photos-section-item">
                        <img src="./user/assets/images/IMG22.jpg" alt="">
                        <h3>سياسة</h3>
                        <h2>تبون يؤكد: الجزائر ليست معزولة عن العالم</h2>
                    </div>
                    <div class="photos-section-item">
                        <img src="./user/assets/images/IMG22.jpg" alt="">
                        <h3>سياسة</h3>
                        <h2>أزمة جديدة بين الجزائر والاتحاد الأوروبي بشأن اتفاق الشراكة</h2>
                    </div>
                    <div class="photos-section-item">
                        <img src="./user/assets/images/IMG22.jpg" alt="">
                        <h3>اقتصاد</h3>
                        <h2>الحكومة تسرع مشاريع تحلية مياه البحر لمواجهة العطش</h2>
                    </div>
                    <div class="photos-section-item">
                        <img src="./user/assets/images/IMG22.jpg" alt="">
                        <h3>سياسة</h3>
                        <h2>تثبيت الحكم ضد الكاتب بوعلام صنصال بالسجن خمس سنوات</h2>
                    </div>
                    <div class="photos-section-item">
                        <img src="./user/assets/images/IMG22.jpg" alt="">
                        <h3>رياضة</h3>
                        <h2>المنتخب الجزائري يواجه السنغال في مباراة ودية</h2>
                    </div>
                    <div class="photos-section-item">
                        <img src="./user/assets/images/IMG22.jpg" alt="">
                        <h3>ثقافة</h3>
                        <h2>افتتاح مهرجان الفيلم الجزائري في باريس</h2>
                    </div>
                </div>
                <button class="photos-load-more-btn">المزيد</button>
            </div>
            <div class="photos-section-empty"></div>
        </div>

    </div>

    @include('user.components.footer')

@endsection