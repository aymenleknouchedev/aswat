@extends('layouts.index')

@section('title', 'أصوات جزائرية | نوافذ ')

<style>
    .art-section-hero {
        position: relative;

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

    <style>
        .window-section {
            display: block;
        }

        .window-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .window-card {
            display: flex;
            gap: 20px;
            direction: rtl;
        }

        .window-card-image img {
            width: 300px;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .window-card-text {
            flex: 1;
        }

        .window-card-text h3 {
            font-family: asswat-light;
            font-size: 12px;
            color: #74747C;
            margin: 0 0 4px 0;
        }

        .window-card-text h2 {
            font-family: asswat-bold;
            font-size: 18px;
            margin: 0 0 8px 0;
            line-height: 1.4;
        }

        .window-card-text p {
            font-size: 15px;
            color: #555;
            line-height: 1.5;
            margin: 0;
        }
    </style>

    <div class="web">
        @include('user.components.fixed-nav')

        <div class="container">
            <div class="title">
                <p class="section-title">نوافذ</p>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
            </div>

            <div class="window-section">
                <!-- Left: نافذة المستخدم -->
                <div class="window-list" id="window-container">
                    @include('user.partials.window-items', ['windows' => $windows])
                </div>

                <!-- Right: الأكثر قراءة -->
                <div class="window-side">
                    {{-- يمكنك إضافة ويدجت "الأكثر قراءة" هنا --}}
                </div>
            </div>

            <div class="text-center mt-3" id="load-more-container">
                <button class="window-load-more-btn" data-page="1">المزيد</button>
            </div>

            <style>
                .window-load-more-btn {
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

                .window-load-more-btn:hover {
                    background: #ddd;
                }
            </style>

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

        <!-- Mobile Windows Content -->
        <div class="mobile-flow">
            <div class="mobile-container" style="margin-top: 68px;">
                <div class="mobile-simple-list" dir="rtl">
                    <h2 class="mobile-simple-header">نوافذ</h2>
                    <div style="padding: 0px 16px">
                        @include('user.components.ligne')
                    </div>
                    <ul class="mobile-simple-ul" role="list" id="mobile-windows-container">
                        @forelse ($windows as $item)
                            <li class="mobile-simple-item">
                                <a class="mobile-more-link" href="{{ route('news.show', $item->title) }}"
                                    aria-label="{{ $item->title }}">
                                    <div class="ms-thumb">
                                        <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                            alt="{{ $item->title }}">
                                    </div>
                                    <div class="ms-text">
                                        <p style="font-size: 14px; color: #7c7c74; margin: 0 0 4px 0; font-family: asswat-regular;">
                                            نافذة
                                        </p>
                                        <p class="ms-title">
                                            {{ \Illuminate\Support\Str::limit($item->mobile_title ?? $item->title, 90) }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li style="padding: 12px 0; text-align: center; color: #999;">لا توجد نوافذ حالياً.</li>
                        @endforelse
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

    <style>
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

        /* Greybar hide on scroll */
        #greybar {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        #greybar.hide {
            transform: translateY(-100%);
            opacity: 0;
        }
    </style>

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

    let loading = false;

    document.addEventListener("click", async function(e) {
        // Desktop load more
        if (e.target.classList.contains("window-load-more-btn")) {
            if (loading) return;

            let btn = e.target;
            let page = parseInt(btn.getAttribute("data-page")) + 1;

            loading = true;
            btn.disabled = true;
            btn.textContent = "جاري التحميل...";

            try {
                let response = await fetch(`/section/windows?page=${page}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!response.ok) throw new Error("خطأ في السيرفر");

                let data = await response.text();

                if (data.trim().length === 0) {
                    btn.closest("#load-more-container").remove();
                } else {
                    document.querySelector("#window-container").insertAdjacentHTML("beforeend", data);
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
                let response = await fetch(`/section/windows?page=${page}`, {
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
                    const mobileContainer = document.getElementById("mobile-windows-container");
                    if (mobileContainer) {
                        if (trimmed.includes('mobile-simple-item')) {
                            mobileContainer.insertAdjacentHTML("beforeend", trimmed);
                        } else {
                            const wrapper = document.createElement('div');
                            wrapper.innerHTML = trimmed;
                            const cards = wrapper.querySelectorAll('[class*="window-card"]');

                            if (cards.length === 0) {
                                mobileContainer.insertAdjacentHTML("beforeend", trimmed);
                            } else {
                                let html = '';
                                cards.forEach(card => {
                                    const linkEl = card.querySelector('a[href]');
                                    const href = linkEl ? linkEl.getAttribute('href') : '#';
                                    const imgEl = card.querySelector('img');
                                    const imgSrc = imgEl ? imgEl.getAttribute('src') : '';
                                    const titleEl = card.querySelector('h2');
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
