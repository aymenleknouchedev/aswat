@extends('layouts.index')

@section('title', 'أصوات جزائرية | آراء')

@section('content')

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
            align-items: align-start;
        }

        .custom-card:last-child {
            border-bottom: none;
        }

        .custom-card .custom-image {
            width: 90px;
            height: 90px;
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
            margin: 20px 0 0 0;
            font-size: 17px;
            line-height: 1.5;
            color: #555;
        }

        .custom-card .custom-texts span {
            font-size: 17px;
            color: #999;
            font-family: asswat-regular;
            cursor: pointer;
        }

        .custom-card .custom-texts h2:hover {
            text-decoration: underline;
        }

        .reviews-load-more-btn {
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

        .section-title {
            font-size: 32px;
        }

        .alert-info {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            color: #6c757d;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .web {
                display: none;
            }

            .mobile {
                display: none;
            }
        }
    </style>

    <div class="web">
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
            @if (isset($reviews) && count($reviews) > 0 && isset($reviews[0]))
                <div class="custom-photos-feature">
                    <div class="custom-image-wrapper">
                        <img src="{{ $reviews[0]->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/placeholder.jpg' }}"
                            alt="{{ $reviews[0]->title ?? 'رأي مميز' }}">
                        <div class="custom-corner-icon">
                            @include('user.icons.image')
                        </div>
                    </div>
                    <div class="custom-content">
                        <h3>
                            @if ($reviews[0]->writer && $reviews[0]->writer->name)
                                <a href="{{ route('writer.show', $reviews[0]->writer->id) }}">
                                    {{ $reviews[0]->writer->name }}
                                </a>
                            @else
                                بدون كاتب
                            @endif
                        </h3>
                        <a href="{{ route('news.show', $reviews[0]->title ?? '') }}"
                            style="text-decoration: none; color: inherit;">
                            <h2>{{ $reviews[0]->title ?? 'عنوان الرأي' }}</h2>
                        </a>
                        <p>{{ $reviews[0]->summary ?? 'ملخص الرأي' }}</p>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <p>لا توجد آراء متاحة حالياً.</p>
                </div>
            @endif

            <div style="display: flex; width: 100%; gap: 40px;">
                <div style="flex: 7;">
                    {{-- Grid Section --}}
                    @if (isset($otherReviews) && count($otherReviews) > 0)
                        <div class="custom-cards-wrapper" id="reviews-container">
                            {{-- Cards 1-10 --}}
                            @include('user.partials.review-items', ['otherReviews' => $otherReviews])
                        </div>
                        {{-- Pagination Button --}}
                        <div class="text-center mt-3" id="load-more-container">
                            <button class="reviews-load-more-btn btn btn-primary" data-page="1">
                                المزيد
                            </button>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p>لا توجد المزيد من الآراء.</p>
                        </div>
                    @endif
                </div>
                <div style="flex: 3;"></div>
            </div>
        </div>
    </div>

    @include('user.components.footer')

    <div class="mobile"></div>
@endsection

{{-- Scripts --}}
<script>
    let loading = false;

    document.addEventListener("click", async function(e) {
        if (e.target.classList.contains("reviews-load-more-btn")) {
            if (loading) return;

            let btn = e.target;
            let page = parseInt(btn.getAttribute("data-page")) + 1;

            // Check if we have a valid page number
            if (isNaN(page)) {
                console.error("Invalid page number");
                return;
            }

            loading = true;
            btn.disabled = true;
            btn.textContent = "جاري التحميل...";

            try {
                let response = await fetch(`{{ route('reviews') }}?page=${page}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!response.ok) throw new Error("خطأ في السيرفر");

                let data = await response.text();

                if (data.trim().length === 0) {
                    // Safely remove load more container
                    let container = btn.closest("#load-more-container");
                    if (container) {
                        container.remove();
                    }
                } else {
                    let reviewsContainer = document.querySelector("#reviews-container");
                    if (reviewsContainer) {
                        reviewsContainer.insertAdjacentHTML("beforeend", data);
                        btn.setAttribute("data-page", page);
                        btn.disabled = false;
                        btn.textContent = "المزيد";
                    }
                }
            } catch (error) {
                console.error("Error loading more reviews:", error);
                alert("خطأ في تحميل المزيد");
                btn.disabled = false;
                btn.textContent = "المزيد";
            }

            loading = false;
        }
    });
</script>
