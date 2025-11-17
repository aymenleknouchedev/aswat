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
            .section-title {
                font-size: 32px;
            }

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
                aspect-ratio: 4 / 3;
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

        @if ($featured)
            <div class="custom-photos-feature">
                <div class="custom-image-wrapper">
                    <img src="{{ $featured->media()->wherePivot('type', 'main')->first()->path }}"
                        alt="{{ $featured->title }}">
                    <div class="custom-corner-icon">
                        @include('user.icons.image')
                    </div>
                </div>
                <div class="custom-content">
                    <h3><x-category-links :content="$featured" /></h3>
                    <a href="{{ route('news.show', $featured->title) }}" style="text-decoration: none; color: inherit;">
                        <h2>{{ $featured->title }}</h2>
                    </a>
                    <p>{{ $featured->summary }}</p>
                </div>
            </div>
        @endif

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
                aspect-ratio: 4 / 3;
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

        {{-- Photos Grid --}}
        <div class="photos-section-wrapper">
            <div>
                <div class="photos-section-grid" id="photos-container">
                    @include('user.partials.photo-items', ['otherPhotos' => $otherPhotos])
                </div>

                <div class="text-center mt-3" id="load-more-container">
                    <button class="photos-load-more-btn" data-page="1">المزيد</button>
                </div>
            </div>
            <div class="photos-section-empty"></div>
        </div>

    </div>

    @include('user.components.footer')

@endsection


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
                let response = await fetch(`/section/photos?page=${page}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!response.ok) throw new Error("خطأ في السيرفر");

                let data = await response.text();

                if (data.trim().length === 0) {
                    btn.closest("#load-more-container").remove();
                } else {
                    document.querySelector("#photos-container").insertAdjacentHTML("beforeend", data);
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
