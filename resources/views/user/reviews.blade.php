@extends('layouts.index')

@section('title', 'أصوات جزائرية | آراء')

@section('content')

    @include('user.components.fixed-nav')

    {{-- Container --}}
    <div class="container">

        {{-- Title --}}
        <div class="title">
            <p class="section-title">آراء</p>
            @include('user.components.ligne')
            <div class="under-title-ligne-space"></div>
        </div>

        {{-- Feature Section --}}
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

            /* Grid Section */
            .custom-grid {
                display: grid;
                grid-template-columns: 9fr 3fr;
                gap: 40px;
                margin-bottom: 60px;
                align-items: flex-start;
            }

            .custom-cards-wrapper {
                display: flex;
                flex-direction: column;
            }

            .custom-card {
                display: flex;
                flex-direction: row;
                gap: 20px;
                padding: 20px 0;
                border-bottom: 1px solid #ddd;
                align-items: center;
            }

            .custom-card:last-child {
                border-bottom: none;
            }

            .custom-card .custom-image {
                width: 75px;
                height: 75px;
                flex-shrink: 0;
            }

            .custom-card .custom-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                border-radius: 50%;
            }

            .custom-card .custom-texts {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .custom-card .custom-texts h2 {
                margin: 0 0 5px;
                font-size: 24px;
                line-height: 1.3;
                font-family: asswat-bold;
                cursor: pointer;
                transition: .2s;
            }

            .custom-card .custom-texts p {
                margin: 0 0 5px;
                font-size: 17px;
                line-height: 1.5;
                color: #555;
            }

            .custom-card .custom-texts span {
                font-size: 10px;
                color: #999;
                font-family: asswat-light;
                cursor: pointer;
            }

            .custom-card .custom-texts h2:hover {
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

        {{-- Featured Article --}}
        <div class="custom-photos-feature">
            <div class="custom-image-wrapper">
                <img id="photoImage" src="./user/assets/images/b2.jpeg" alt="Feature Algeria">
                <div class="custom-corner-icon">
                    @include('user.icons.image')
                </div>
            </div>

            <div class="custom-content">
                <h3 id="photoCategory">البرتغال</h3>
                <h2 id="photoTitle">يوم حزين لكرة القدم.. دموع وانهيارات في وداع ديوغو جوتا الأخير</h2>
                <p id="photoDescription">أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل
                    دياز-كانيل، بعد أربع سنوات على تظاهرات مناهضة للحكومة.</p>
            </div>
        </div>

        {{-- Grid Section --}}
        <div class="custom-grid">
            <div class="custom-cards-wrapper">
                {{-- Cards 1-10 --}}
                @for ($i = 1; $i <= 10; $i++)
                    <div class="custom-card">
                        <div class="custom-image">
                            <img src="./user/assets/images/b2.jpeg" alt="خبر">
                        </div>
                        <div class="custom-texts">
                            <h2>عنوان البطاقة رقم {{ $i }}</h2>
                            <p>وصف مختصر للخبر رقم {{ $i }} يتحدث عن تفاصيل مختصرة وجذابة.</p>
                            <span>بقلم: كاتب البطاقة رقم {{ $i }}</span>
                        </div>
                    </div>
                @endfor
                {{-- Pagination Button --}}
                <button class="photos-load-more-btn">المزيد</button>

            </div>
            {{-- 3/12 Empty --}}
            <div></div>
        </div>


    </div>

    @include('user.components.footer')

@endsection
