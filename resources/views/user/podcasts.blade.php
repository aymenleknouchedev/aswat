@extends('layouts.index')

@section('title', 'أصوات جزائرية | بودكاست')

@section('content')

    @include('user.components.fixed-nav')

    {{-- Container --}}
    <div class="container">

        {{-- Title --}}
        <div class="title">
            <p class="section-title">بودكاست</p>
            @include('user.components.ligne')
            <div class="under-title-ligne-space"></div>
        </div>

        <style>
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
                gap: 40px;
            }

            .custom-card {
                display: flex;
                flex-direction: row;
                gap: 20px;
                justify-content: space-between;
                align-items: flex-start;
                border-bottom: 1px solid #eee;
                padding-bottom: 20px;
            }

            .custom-card-left {
                display: flex;
                flex-direction: row;
                gap: 20px;
                align-items: flex-start;
            }

            .custom-media-group {
                display: flex;
                flex-direction: row;
                /* الصورة + التاريخ جنب بعض */
                align-items: center;
                /* متمركزين عموديًا */
                gap: 10px;
            }

            .custom-image {
                width: 300px;
                aspect-ratio: 16 / 9;
                flex-shrink: 0;
                overflow: hidden;
                border-radius: 5px;
            }

            .custom-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .custom-card-date {
                color: black;
                font-size: 12px;
                font-family: asswat-light;
                padding: 5px 10px;
                border-radius: 5px;
                white-space: nowrap;
            }

            .custom-texts {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .custom-texts h2 {
                margin: 0;
                font-size: 20px;
                line-height: 1.4;
                font-family: asswat-bold;
                cursor: pointer;
                transition: .2s;
            }

            .custom-texts h2:hover {
                text-decoration: underline;
            }

            .custom-texts p {
                margin: 0;
                font-size: 15px;
                line-height: 1.6;
                color: #555;
            }

            .custom-texts span {
                font-size: 11px;
                color: #999;
                font-family: asswat-light;
                cursor: pointer;
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

        {{-- Grid Section --}}
        <div class="custom-grid">
            <div class="custom-cards-wrapper">
                {{-- Cards 1-10 --}}
                @for ($i = 1; $i <= 10; $i++)
                    <div class="custom-card">
                        <div class="custom-card-left">
                            <div class="custom-media-group">
                                <div class="custom-card-date">23 يوليو 2025</div>

                                <div class="custom-image">
                                    <img src="./user/assets/images/b2.jpeg" alt="بودكاست {{ $i }}">
                                </div>
                            </div>
                            <div class="custom-texts">
                                <h2>عنوان البطاقة رقم {{ $i }}</h2>
                                <p>وصف مختصر للخبر رقم {{ $i }} يتحدث عن تفاصيل مختصرة وجذابة.</p>
                                <span>بقلم: كاتب البطاقة رقم {{ $i }}</span>
                            </div>
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
