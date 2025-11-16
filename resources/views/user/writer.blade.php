@extends('layouts.index')

@section('title', 'أصوات جزائرية | ' . ($writer->name ?? 'الكاتب'))

@section('content')
    <style>
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
            align-self: flex-start;
            flex-direction: column;
        }

        .newCategory-all-card-text h3 {
             font-family: asswat-regular !important;
            font-weight: normal !important;
            font-size: 16px;
            color: #7c7c74;
            margin: 0 0 4px 0;
        }

        .newCategory-all-card-text h2 {
           font-family: asswat-bold;
            font-size: 22px;
            margin: 0 0 8px 0;
            line-height: 1.4;
        }

        .newCategory-all-card-text p {
            font-size: 16px !important;
            color: #555 !important;
            line-height: 1.5 !important;
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

    <div class="mobile"></div>
@endsection

<script>
    let loading = false;
    const writerId = {{ $writer->id }};

    document.addEventListener("click", async function(e) {
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
    });
</script>
