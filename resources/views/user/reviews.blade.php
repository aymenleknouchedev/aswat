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
            <a href="{{ route('news.show', $reviews[0]->id) }}" style="text-decoration: none; color: inherit;">
                <div class="custom-photos-feature">
                    <div class="custom-image-wrapper">
                        <img src="{{ $reviews[0]->media()->wherePivot('type', 'main')->first()->path }}"
                            alt="Feature reviews">
                        <div class="custom-corner-icon">
                            @include('user.icons.image')
                        </div>
                    </div>
                    <div class="custom-content">
                        <h3>
                            @if (isset($reviews[0]->country))
                                {{ $reviews[0]->category->name ?? '' }} - {{ $reviews[0]->country->name ?? '' }}
                            @elseif (isset($reviews[0]->continent))
                                {{ $reviews[0]->category->name ?? '' }} - {{ $reviews[0]->continent->name ?? '' }}
                            @else
                                {{ $reviews[0]->category->name ?? '' }}
                            @endif
                        </h3>
                        <h2>{{ $reviews[0]->title }}</h2>
                        <p>{{ $reviews[0]->summary }}</p>
                    </div>
                </div>
            </a>

            <div style="display: flex; width: 100%; gap: 40px;">
                <div style="flex: 7;">
                    {{-- Grid Section --}}
                    <div class="custom-cards-wrapper" id="reviews-container">
                        {{-- Cards 1-10 --}}
                        @include('user.partials.review-items', ['review' => $otherReviews])
                    </div>
                    {{-- Pagination Button --}}
                    <div class="text-center mt-3" id="load-more-container">
                        <button class="photos-load-more-btn btn btn-primary" data-page="1">
                            المزيد
                        </button>
                    </div>
                </div>
                <div style="flex: 3;"></div>
            </div>
        </div>
    </div>

    @include('user.components.footer')

    <div class="mobile"></div>
    </div>
@endsection

{{-- Scripts --}}
<script>
    let loading = false;

    document.addEventListener("click", async function(e) {
        if (e.target.classList.contains("photos-load-more-btn")) {
            if (loading) return;

            let btn = e.target;
            let page = parseInt(btn.getAttribute("data-page")) + 1;

            loading = true;
            btn.disabled = true;
            btn.textContent = "جاري التحميل...";

            try {
                let response = await fetch(`/section/reviews?page=${page}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!response.ok) throw new Error("خطأ في السيرفر");

                let data = await response.text();

                if (data.trim().length === 0) {
                    btn.closest("#load-more-container").remove();
                } else {
                    document.querySelector("#reviews-container").insertAdjacentHTML("beforeend", data);
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
