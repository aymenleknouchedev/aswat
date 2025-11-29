@extends('layouts.index')

@section('title', 'أصوات جزائرية | ' . ($theme->name ?? 'الأخبار'))

@section('content')

    <style>
        .web {
            display: block !important;
        }

        .mobile {
            display: none !important;
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
            align-items: center;
            gap: 20px;
            direction: rtl;
            align-items: center;
            /* vertical center */
        }

        .newCategory-all-card-date {
            color: #333;
            font-size: 14px;
            min-width: 70px;
            text-align: center;
        }

        .newCategory-all-card-image img {
            width: 300px;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
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



        /* Load more button */
        .category-load-more-btn {
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

        .category-load-more-btn:hover {
            background: #ddd;
        }

        /* Greybar hide on scroll */
        #greybar {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        #greybar.hide {
            transform: translateY(-100%);
            opacity: 0;
        }

        /* Mobile simple header */
        .mobile-simple-header {
            padding: 12px 16px 8px;
            font-size: 20px;
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

        .mobile-load-more-btn {
            display: block;
            width: 90%;
            max-width: 400px;
            margin: 20px auto;
            padding: 12px 24px;
            background: #f5f5f5;
            color: #000;
            font-family: asswat-medium;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: .3s ease;
        }

        .mobile-load-more-btn:hover {
            background: #ddd;
        }

        /* Responsive */
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
                <p class="section-title">{{ $theme->name ?? 'الأخبار' }}</p>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
            </div>

            <div class="newCategory-all-section">
                <!-- Left: أخبار التصنيف -->
                <div class="newCategory-all-list" id="category-container">
                    @foreach ($articles as $item)
                        <div class="newCategory-all-card">
                            <!-- Date on the left -->
                            <div class="newCategory-all-card-date">
                                @php
                                    $months = [
                                        '01' => 'يناير',
                                        '02' => 'فبراير',
                                        '03' => 'مارس',
                                        '04' => 'أبريل',
                                        '05' => 'مايو',
                                        '06' => 'يونيو',
                                        '07' => 'يوليو',
                                        '08' => 'أغسطس',
                                        '09' => 'سبتمبر',
                                        '10' => 'أكتوبر',
                                        '11' => 'نوفمبر',
                                        '12' => 'ديسمبر',
                                    ];
                                    $date = $item->created_at;
                                    $day = $date->format('d');
                                    $month = $months[$date->format('m')];
                                    $year = $date->format('Y');
                                @endphp
                                <h4>{{ $day }} {{ $month }} {{ $year }}</h4>
                            </div>

                            <!-- Image -->
                            <div class="newCategory-all-card-image">
                                <a href="{{ route('news.show', $item->title) }}">
                                    <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                        alt="{{ $item->title }}">
                                </a>
                            </div>

                            <!-- Text -->
                            <div class="newCategory-all-card-text">
                                <a href="{{ route('news.show', $item->title) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <h2>{{ $item->title }}</h2>
                                </a>
                                <p>{{ $item->summary }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center mt-3" id="load-more-container">
                        <button class="category-load-more-btn" data-page="1">المزيد</button>
                    </div>
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

        <!-- Mobile Category Content -->
        <div class="mobile-flow">
            <div class="mobile-container" style="margin-top: 68px;">
                <div class="mobile-simple-list" dir="rtl">
                    <h2 class="mobile-simple-header">{{ $theme->name ?? 'الأخبار' }}</h2>
                    <div style="padding: 0px 16px">
                        @include('user.components.ligne')
                    </div>
                    <ul class="mobile-simple-ul" role="list" id="mobile-category-container">
                        @foreach ($articles as $item)
                            @include('user.mobile.item')
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Mobile Load More button -->
            <div class="text-center" id="mobile-load-more-container">
                <button class="mobile-load-more-btn" data-page="1">المزيد</button>
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

    // Category Load More functionality
    let loading = false;
    const categoryId = {{ $current_id }};
    const categoryType = "{{ $type }}";

    document.addEventListener("click", async function(e) {
        // Desktop load more
        if (e.target.classList.contains("category-load-more-btn")) {
            if (loading) return;

            let btn = e.target;
            let page = parseInt(btn.getAttribute("data-page")) + 1;

            loading = true;
            btn.disabled = true;
            btn.textContent = "جاري التحميل...";

            try {
                let response = await fetch(`/category/${categoryId}/${categoryType}?page=${page}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!response.ok) throw new Error("خطأ في السيرفر");

                let data = await response.text();

                if (data.trim().length === 0) {
                    btn.closest("#load-more-container").remove();
                } else {
                    btn.closest("#load-more-container").insertAdjacentHTML("beforebegin", data);
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

        // Mobile load more
        if (e.target.classList.contains("mobile-load-more-btn")) {
            if (loading) return;

            let btn = e.target;
            let page = parseInt(btn.getAttribute("data-page")) + 1;

            loading = true;
            btn.disabled = true;
            btn.textContent = "جاري التحميل...";

            try {
                let response = await fetch(`/category/${categoryId}/${categoryType}?page=${page}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!response.ok) throw new Error("خطأ في السيرفر");

                let data = await response.text();
                const trimmed = data.trim();

                if (trimmed.length === 0) {
                    const cont = btn.closest("#mobile-load-more-container");
                    if (cont) cont.remove();
                } else {
                    // Ensure appended items match the initial mobile card structure
                    const mobileContainer = document.getElementById("mobile-category-container");
                    if (mobileContainer) {
                        // If backend already returns mobile items, append directly
                        if (trimmed.includes('mobile-simple-item')) {
                            mobileContainer.insertAdjacentHTML("beforeend", trimmed);
                        } else {
                            // Transform desktop cards (newCategory-all-card) into mobile items
                            const wrapper = document.createElement('div');
                            wrapper.innerHTML = trimmed;
                            const cards = wrapper.querySelectorAll('.newCategory-all-card');

                            if (cards.length === 0) {
                                // Fallback: append raw if unknown format
                                mobileContainer.insertAdjacentHTML("beforeend", trimmed);
                            } else {
                                let html = '';
                                cards.forEach(card => {
                                    const linkEl = card.querySelector('a[href]');
                                    const href = linkEl ? linkEl.getAttribute('href') : '#';
                                    const imgEl = card.querySelector('img');
                                    const imgSrc = imgEl ? imgEl.getAttribute('src') : '';
                                    const titleEl = card.querySelector(
                                        '.newCategory-all-card-text h2') || card.querySelector(
                                        'h2') || linkEl;
                                    let title = titleEl ? (titleEl.textContent || '').trim() : '';
                                    if (title.length > 90) title = title.slice(0, 87) + '...';

                                    html += `
                                        <li class="mobile-simple-item">
                                            <a class="mobile-more-link" href="${href}" aria-label="${title}">
                                                <div class="ms-thumb">
                                                    <img src="${imgSrc}" alt="${title}">
                                                </div>
                                                <div class="ms-text">
                                                    <p class="ms-title">${title}</p>
                                                </div>
                                            </a>
                                        </li>
                                    `;
                                });

                                if (html) mobileContainer.insertAdjacentHTML('beforeend', html);
                            }
                        }
                    }

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
