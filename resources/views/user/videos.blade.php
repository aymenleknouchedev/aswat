@extends('layouts.index')

@section('title', 'أصوات جزائرية | فيديوهات')

@section('content')

    <style>
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
                <p class="section-title">فيديوهات</p>
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
                    align-items: center;
                    gap: 10px;
                }

                .custom-image {
                    width: 300px;
                    aspect-ratio: 16 / 9;
                    flex-shrink: 0;
                    overflow: hidden;
                }

                .custom-image img,
                .custom-image video {
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

                .videos-load-more-btn {
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

                .videos-load-more-btn:hover {
                    background: #ddd;
                }
            </style>

            {{-- Grid Section --}}
            <div class="custom-grid">
                <div class="videos-section-wrapper">
                    <div>
                        <div class="custom-cards-wrapper" id="video-list">
                            @include('user.partials.video-items', ['videos' => $videos])
                        </div>

                        @if ($videos->count() >= 10)
                            <div class="text-center mt-3" id="load-more-container">
                                <button class="videos-load-more-btn" data-page="1">المزيد</button>
                            </div>
                        @endif
                    </div>
                    <div class="videos-section-empty"></div>
                </div>

                {{-- Sidebar 3/12 --}}
                <div></div>
            </div>

        </div>

        @include('user.components.footer')

        <div class="mobile">
        </div>

    </div>

@endsection

<script>
    let loading = false;

    document.addEventListener("click", async function(e) {
        if (e.target.classList.contains("videos-load-more-btn")) {
            if (loading) return;

            let btn = e.target;
            let page = parseInt(btn.getAttribute("data-page")) + 1;

            loading = true;
            btn.disabled = true;
            btn.textContent = "جاري التحميل...";

            try {
                let response = await fetch(`/section/videos?page=${page}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!response.ok) throw new Error("خطأ في السيرفر");

                let data = await response.text();

                if (data.trim().length === 0) {
                    btn.closest("#load-more-container").remove();
                } else {
                    document.querySelector("#video-list").insertAdjacentHTML("beforeend", data);
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
