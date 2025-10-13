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

    <div class="mobile"></div>
@endsection


<script>
    let loading = false;

    document.addEventListener("click", async function(e) {
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
    });
</script>
