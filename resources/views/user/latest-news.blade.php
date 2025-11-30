@extends('layouts.index')

@section('title', 'أصوات جزائرية | آخر الأخبار')

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
            display: grid;
            grid-template-columns: 10fr 2fr;
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
            align-items: center;
        }

        .newCategory-all-card-image img {
            width: 300px;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .newCategory-all-card-content {
            display: flex;
            justify-content: space-between;
            flex: 1;
        }

        .newCategory-all-card-text {
            flex: 1;
            display: flex;
            flex-direction: column;
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

        .newCategory-all-card-date {
            display: flex;
            align-items: center;
            /* vertically center */
            text-align: center;
            color: #333;
            /* dark grey */
            font-size: 14px;
            min-width: 70px;
            /* adjust as needed */
            order: -1;
            /* move to the left of the image */
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

        /* Greybar hide on scroll */
        #greybar {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        #greybar.hide {
            transform: translateY(-100%);
            opacity: 0;
        }

        /* Optional: responsive for mobile */
        @media (max-width: 992px) {
            .newCategory-all-section {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .newCategory-all-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .newCategory-all-card-image img {
                width: 100%;
            }

            .newCategory-all-card-date {
                order: 0;
                /* back to normal in mobile */
                min-width: auto;
                align-items: flex-start;
                margin-bottom: 10px;
            }
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
        }
    </style>

    <div class="web">
        @include('user.components.fixed-nav')

        <div class="container">
            <div class="title">
                <p class="section-title">أخبار</p>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
            </div>

            <div class="newCategory-all-section">
                <!-- Left: آخر الأخبار -->
                <div class="newCategory-all-list">
                    @forelse ($latestContents as $item)
                        <div class="newCategory-all-card">
                            <div class="newCategory-all-card-date">
                                <h4 style="width: 100px">
                                    @php
                                        \Carbon\Carbon::setLocale('ar'); // تفعيل اللغة العربية

                                        $created = \Carbon\Carbon::parse($item->created_at);
                                        $now = \Carbon\Carbon::now();
                                        $diffHours = $created->diffInHours($now);
                                    @endphp

                                    @if ($diffHours < 24)
                                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                            <span>{{ $created->diffForHumans(null, null, false, 1) }}</span>
                                        </div>
                                    @else
                                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                            <span>{{ $created->translatedFormat('d F Y') }}</span>
                                            <span style="color: #74747C;">{{ $created->translatedFormat('H:i') }}</span>
                                        </div>
                                    @endif
                                </h4>
                            </div>
                            <div class="newCategory-all-card-image">
                                <a href="{{ route('news.show', $item->title) }}">
                                    <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                        alt="{{ $item->title }}">
                                </a>
                            </div>
                            <div class="newCategory-all-card-text">
                                <h3><x-category-links :content="$item" /></h3>
                                <a href="{{ route('news.show', $item->title) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <h2>{{ $item->title }}</h2>
                                </a>
                                <p>{{ $item->summary }}</p>
                            </div>
                        </div>
                    @empty
                        <p>لا توجد أخبار حالياً.</p>
                    @endforelse
                </div>

                <!-- Right: الأكثر قراءة -->
                <div class="newCategory-all-side">
                    {{-- هنا تقدر تضيف ويدجت "الأكثر قراءة" --}}
                </div>
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

        <!-- Mobile Latest News Content -->
        <div class="mobile-flow">
            <div class="mobile-container" style="margin-top: 68px;">
                <div class="mobile-simple-list" dir="rtl">
                    <h2 class="mobile-simple-header">أخبار</h2>
                    <div style="padding: 0px 16px">
                        @include('user.components.ligne')
                    </div>
                    <ul class="mobile-simple-ul" role="list" id="mobile-latest-container">
                        @forelse ($latestContents as $item)
                            @include('user.mobile.item')
                        @empty
                            <li style="padding: 12px 0; text-align: center; color: #999;">لا توجد أخبار حالياً.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Mobile Footer -->
            @include('user.mobile.footer')

        </div>

    </div>
@endsection

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
</script>
