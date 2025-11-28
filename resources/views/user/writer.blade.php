@extends('layouts.index')

@section('title', 'أصوات جزائرية | ' . ($writer->name ?? 'الكاتب'))

@section('content')
    <style>
        .web {
            display: block !important;
        }

        .mobile {
            display: none !important;
        }

        .writer-header {
            display: flex;
            align-items: center;
            gap: 30px;
            direction: rtl;
            margin: 40px 0px;
            flex-wrap: wrap;
        }

        .writer-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .writer-info {
            flex: 1;
        }

        .writer-info h1 {
            font-family: asswat-bold;
            font-size: 26px;
            margin: 0 0 10px 0;
        }

        .writer-info p {
            font-family: asswat-regular;
            font-size: 18px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
            max-width: 750px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .social-links a {
            text-decoration: none;
            color: #0077b6;
            font-family: asswat-medium;
            transition: 0.3s;
        }

        .social-links a:hover {
            color: #023e8a;
        }

        /* Title bar (articles + socials) */
        .writer-title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            direction: rtl;
            flex-wrap: wrap;
            gap: 10px;
        }

        .writer-title-bar .section-title {
            font-family: asswat-bold;
            font-size: 22px;
            margin: 0;
        }

        .writer-title-bar .social-links {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .writer-title-bar .social-links a {
            text-decoration: none;
            color: #0077b6;
            font-family: asswat-medium;
            transition: 0.3s;
        }

        .writer-title-bar .social-links a:hover {
            color: #023e8a;
        }

        /* Articles section */
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
            flex-wrap: wrap;
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

        /* Mobile styles */
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

        .mobile-writer-header {
            padding: 16px;
            text-align: center;
            direction: rtl;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .mobile-writer-header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
        }

        .mobile-writer-header h1 {
            font-family: asswat-bold;
            font-size: 18px;
            margin: 0 0 8px 0;
            color: #333;
        }

        .mobile-writer-header p {
            font-family: asswat-regular;
            font-size: 16px;
            color: #666;
            line-height: 1.4;
            margin: 0 0 12px 0;
        }

        .mobile-writer-socials {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .mobile-writer-socials a {
            text-decoration: none;
            color: #666;
            font-size: 18px;
        }

        @media (max-width: 992px) {
            .web {
                display: none !important;
            }

            .mobile {
                display: block !important;
            }

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

            .writer-header {
                flex-direction: column;
                text-align: center;
            }

            .writer-header img {
                width: 120px;
                height: 120px;
            }

            .social-links {
                justify-content: center;
            }

            .writer-title-bar {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <div class="web">
        @include('user.components.fixed-nav')

        <div class="container">
            <!-- Writer Info -->
            <div class="writer-header">
                @if ($writer->image)
                    <img src="{{ $writer->image }}" alt="{{ $writer->name }}">
                @endif
                <div class="writer-info">
                    <h1>{{ $writer->name }}</h1>
                    <p>{{ $writer->bio ?? '' }}</p>
                </div>
            </div>

            <!-- Writer Articles -->
            <div class="title">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
                <div class="writer-title-bar" style="margin-bottom:10px">
                    <h2 class="section-title"></h2>
                    <div class="social-links">
                        @if ($writer && $writer->x)
                            <a href="{{ $writer->x }}" target="_blank" title="تويتر">
                                <i class="fa-brands fa-x-twitter" style="color: #888; font-size: 1.3em;"></i>
                            </a>
                        @endif
                        @if ($writer && $writer->facebook)
                            <a href="{{ $writer->facebook }}" target="_blank" title="فيسبوك">
                                <i class="fab fa-facebook" style="color: #888; font-size: 1.3em;"></i>
                            </a>
                        @endif
                        @if ($writer && $writer->instagram)
                            <a href="{{ $writer->instagram }}" target="_blank" title="انستغرام">
                                <i class="fab fa-instagram" style="color: #888; font-size: 1.3em;"></i>
                            </a>
                        @endif
                        @if ($writer && $writer->linkedin)
                            <a href="{{ $writer->linkedin }}" target="_blank" title="لينكدإن">
                                <i class="fab fa-linkedin" style="color: #888; font-size: 1.3em;"></i>
                            </a>
                        @endif
                        {{-- Add more socials as needed --}}
                    </div>
                </div>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
            </div>

            <div class="newCategory-all-section">
                <div class="newCategory-all-list" id="category-container">
                    @include('user.partials.writer-items', ['articles' => $articles])
                    <div class="text-center mt-3" id="load-more-container">
                        <button class="category-load-more-btn" data-page="1">المزيد</button>
                    </div>
                </div>

                <div class="newCategory-all-side">
                    {{-- يمكن إضافة "الأكثر قراءة" هنا لاحقًا --}}
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

        <!-- Mobile Writer Content -->
        <div class="mobile-flow">
            <div class="mobile-container" style="margin-top: 68px;">
                <!-- Writer Header -->
                <div class="mobile-writer-header">
                    @if ($writer->image)
                        <img src="{{ $writer->image }}" alt="{{ $writer->name }}">
                    @endif
                    <h1>{{ $writer->name }}</h1>
                    <p>{{ \Illuminate\Support\Str::limit($writer->bio ?? '', 250) }}</p>
                    <div class="mobile-writer-socials">
                        @if ($writer && $writer->x)
                            <a href="{{ $writer->x }}" target="_blank" title="تويتر">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        @endif
                        @if ($writer && $writer->facebook)
                            <a href="{{ $writer->facebook }}" target="_blank" title="فيسبوك">
                                <i class="fab fa-facebook"></i>
                            </a>
                        @endif
                        @if ($writer && $writer->instagram)
                            <a href="{{ $writer->instagram }}" target="_blank" title="انستغرام">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if ($writer && $writer->linkedin)
                            <a href="{{ $writer->linkedin }}" target="_blank" title="لينكدإن">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Articles List -->
                <div class="mobile-simple-list" dir="rtl">
                    <ul class="mobile-simple-ul" role="list" id="mobile-writer-container">
                        @forelse ($articles as $item)
                            <li class="mobile-simple-item">
                                <a class="mobile-more-link" href="{{ route('news.show', $item->title) }}"
                                    aria-label="{{ $item->title }}">
                                    <div class="ms-thumb">
                                        <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                            alt="{{ $item->title }}">
                                    </div>
                                    <div class="ms-text">
                                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 14px; color: #999; margin: 0 0 4px 0;">
                                            <p style="margin: 0;">{{ $item->category->name ?? 'بدون فئة' }}</p>
                                            <p style="margin: 0;">{{ $item->created_at->format('d/m/Y') }}</p>
                                        </div>
                                        <p class="ms-title">
                                            {{ \Illuminate\Support\Str::limit($item->mobile_title ?? $item->title, 90) }}
                                        </p>
                                        <p style="font-size: 14px; color: #999; margin: 4px 0 0 0; line-height: 1.4;">
                                            {{ \Illuminate\Support\Str::limit($item->summary ?? $item->description ?? '', 250) }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li style="padding: 12px 0; text-align: center; color: #999;">لا توجد مقالات.</li>
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

    // Desktop Load More functionality
    let loading = false;
    const writerId = {{ $writer->id }};

    document.addEventListener("click", async function(e) {
        // Desktop load more
        if (e.target.classList.contains("category-load-more-btn")) {
            if (loading) return;

            const btn = e.target;
            const page = parseInt(btn.getAttribute("data-page")) + 1;

            loading = true;
            btn.disabled = true;
            btn.textContent = "جاري التحميل...";

            try {
                const response = await fetch(`/writer/${writerId}?page=${page}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!response.ok) throw new Error("خطأ في السيرفر");

                const data = await response.text();

                if (data.trim().length === 0) {
                    btn.closest("#load-more-container").remove();
                } else {
                    btn.closest("#load-more-container")
                        .insertAdjacentHTML("beforebegin", data);
                    btn.setAttribute("data-page", page);
                    btn.disabled = false;
                    btn.textContent = "المزيد";
                }
            } catch (error) {
                alert("حدث خطأ أثناء تحميل المزيد.");
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
                let response = await fetch(`/writer/${writerId}?page=${page}`, {
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
                    // Append to mobile container
                    const mobileContainer = document.getElementById("mobile-writer-container");
                    if (mobileContainer) {
                        if (trimmed.includes('mobile-simple-item')) {
                            mobileContainer.insertAdjacentHTML("beforeend", trimmed);
                        } else {
                            const wrapper = document.createElement('div');
                            wrapper.innerHTML = trimmed;
                            const cards = wrapper.querySelectorAll('.newCategory-all-card');

                            if (cards.length === 0) {
                                mobileContainer.insertAdjacentHTML("beforeend", trimmed);
                            } else {
                                let html = '';
                                cards.forEach(card => {
                                    const linkEl = card.querySelector('a[href]');
                                    const href = linkEl ? linkEl.getAttribute('href') : '#';
                                    const imgEl = card.querySelector('img');
                                    const imgSrc = imgEl ? imgEl.getAttribute('src') : '';
                                    const titleEl = card.querySelector('.newCategory-all-card-text h2') || card.querySelector('h2') || linkEl;
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
