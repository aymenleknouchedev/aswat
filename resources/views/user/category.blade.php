@extends('layouts.index')

@section('title', 'أصوات جزائرية | ' . ($theme->name ?? 'الأخبار'))

@section('content')

    <style>
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
            align-self: flex-start;
        }


        .newCategory-all-card-text p {
            font-size: 16px !important;
            color: #555 !important;
            line-height: 1.5 !important;
            margin: 0 !important;
        }

        .newCategory-all-card-text h2 {
            font-family: asswat-bold !important;
            font-weight: normal !important;
            font-size: 20px !important;
            color: #333 !important;
            margin: 0 0 4px 0 !important;
        }

        .newCategory-all-card-text h3 {
            font-family: asswat-regular !important;
            font-weight: normal !important;
            font-size: 16px !important;
            color: #555 !important;
            margin: 0 0 4px 0 !important;
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
                                <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                    alt="{{ $item->title }}">
                            </div>

                            <!-- Text -->
                            <div class="newCategory-all-card-text">
                                <a href="{{ route('news.show', $item->title) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <h2>{{ $item->title }}</h2>
                                </a>
                                <h3>{{ $item->summary }}</h3>
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

    <div class="mobile"></div>
@endsection

<script>
    let loading = false;
    const categoryId = {{ $current_id }};
    const categoryType = "{{ $type }}";

    document.addEventListener("click", async function(e) {
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
    });
</script>
