@extends('layouts.index')

@section('title', 'أصوات جزائرية | تفاصيل الخبر')

@section('content')

    {{-- ================= CSS ================= --}}
    <style>
        /* Layout */
        .web {
            width: 100%;
        }

        .custom-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            display: flex;
            flex-direction: row;
            gap: 40px;
        }

        .custom-main {
            flex: 0 0 60%;
            max-width: 60%;
        }

        .custom-sidebar {
            flex: 0 0 40%;
            max-width: 40%;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .web {
                display: none;
            }
        }

        @media (min-width: 768px) {
            .mobile {
                display: none;
            }
        }

        @media (max-width: 900px) {
            .custom-container {
                flex-direction: column;
                gap: 0;
            }

            .custom-main,
            .custom-sidebar {
                width: 100%;
                flex: unset;
            }

            .custom-sidebar {
                margin-top: 30px;
            }
        }

        /* Article meta */
        .custom-category {
            font-size: 16px;
            font-family: asswat-medium;
            color: #888;
            margin-bottom: 10px;
            text-align: right;
        }

        .custom-article-title {
            font-size: 40px;
            font-family: asswat-medium;
            color: #141414;
            line-height: 1.4;
            text-align: right;
            margin-bottom: 20px;
        }

        .custom-article-summary {
            font-size: 18px;
            color: #555;
            font-family: asswat-medium;
            margin-bottom: 15px;
            text-align: right;
        }

        .custom-meta,
        .custom-meta-date {
            font-size: 15px;
            color: #141414;
            font-family: asswat-light;
            text-align: right;
        }

        /* Images */
        .custom-article-image-wrapper {
            width: 100%;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .custom-article-image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        /* Image caption styling */
        .custom-article-image-wrapper figcaption {
            background: #F5F5F5;
            color: #555;
            font-size: 15px;
            padding: 10px;
            text-align: right;
            font-family: asswat-regular;
            direction: rtl;
        }

        /* ===================== CONTENT ===================== */
        .custom-article-content {
            font-size: 16px !important;
            font-family: asswat-regular;
            color: #333;
            line-height: 1.9;
            text-align: right;
            margin-bottom: 30px;
        }

        .custom-article-content p span {
            font-size: 16px !important;
            font-family: asswat-regular;
            color: #333;
            line-height: 1.9;
            text-align: right;
            margin: 5px 0px;
        }

        .custom-article-content * {
            font-family: asswat-regular !important;
            direction: rtl !important;
            box-sizing: border-box;
        }

        .custom-article-content h2,
        .custom-article-content h3,
        .custom-article-content h4 {
            font-family: asswat-medium !important;
            color: #111 !important;
            text-align: right !important;
            margin-top: 35px !important;
            margin-bottom: 18px !important;
            font-size: 32px !important;
        }

        .custom-article-content h3 {
            font-size: 22px !important;
            color: #333 !important;
        }

        /* Image spacing and captions */
        .custom-article-content img {
            display: block;
            max-width: 100% !important;
            height: auto !important;
            margin: 25px 0 0 0 !important;
        }

        /* Content figure styling */
        .custom-article-content figure {
            width: 100%;
            margin: 25px 0;
        }

        .custom-article-content figure img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        .custom-article-content figcaption {
            background: #F5F5F5;
            color: #555;
            font-size: 15px;
            padding: 10px;
            text-align: right;
            font-family: asswat-regular;
            direction: rtl;
        }

        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            border-radius: 10px;
            /* optional, for soft edges */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            /* optional */
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }


        /* Blockquote */
        .custom-article-content blockquote {
            width: 100%;
            padding: 40px 20px;
            margin: 30px 0;
            text-align: center;
            position: relative;
            font-family: asswat-medium;

        }

        .custom-article-content blockquote p {
            font-size: 28px;
            color: #222;
            line-height: 1.6;
            font-family: asswat-bold !important;
            text-align: center !important;
        }

        .custom-article-content blockquote::before {
            content: "";
            position: absolute;
            top: 0px;
            right: 0px;
            width: 32px;
            height: 32px;
            background: url('/user/assets/icons/quote-top.png') no-repeat center;
            background-size: contain;
            transform: scaleY(-1);
        }

        .custom-article-content blockquote::after {
            content: "";
            position: absolute;
            bottom: 0px;
            left: 0px;
            width: 32px;
            height: 32px;
            background: url('/user/assets/icons/quote-bottom.png') no-repeat center;
            background-size: contain;
        }

        /* Tags */
        .custom-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 40px;
        }

        .custom-tags span {
            background: #f1f1f1;
            color: #000;
            font-size: 14px;
            padding: 6px 14px;
            font-family: asswat-medium;
            cursor: pointer;
            transition: 0.2s;
        }

        .custom-tags span:hover {
            background: #ddd;
        }

        /* Writer Card */
        .writer-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: #fafafa;
            border: 1px solid #eee;
        }

        .writer-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }

        .writer-info {
            display: flex;
            flex-direction: column;
            text-align: right;
        }

        .writer-info .name {
            font-size: 18px;
            font-family: asswat-bold;
            color: #222;
        }

        .writer-info .bio {
            font-size: 14px;
            color: #666;
            font-family: asswat-regular;
        }

        /* Floating podcast */
        .floating-podcast-player {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            background: #fff;
            border-radius: 12px;
            padding: 16px 24px;
            display: none;
            align-items: center;
            gap: 16px;
            width: 80%;
            max-width: 800px;
            border: 1px solid #ddd;
        }

        .floating-podcast-player .close-btn {
            background: none;
            border: none;
            font-size: 22px;
            color: #888;
            cursor: pointer;
            margin-right: 8px;
        }

        @media (max-width: 600px) {
            .floating-podcast-player {
                width: 95%;
                padding: 10px 12px;
            }
        }
    </style>

    {{-- ===== Social Share Section ===== --}}
    <style>
        .custom-date-share {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .date-text {
            color: #888;
            font-size: 15px;
            margin: 0;
        }

        .share-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
            position: relative;
        }

        .share-icons {
            display: flex;
            gap: 8px;
            opacity: 0;
            transform: translateX(10px);
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .share-container.active .share-icons {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
        }

        .share-icons a {
            border-radius: 50%;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .share-icons img {
            width: 26px;
            height: 26px;
        }

        .share-btn {
            background: #ffffff;
            border: none;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .share-btn:hover {
            background: #f5f5f5;
        }
    </style>

    {{-- ================= WEB ================= --}}
    <div class="web">
        @include('user.components.fixed-nav')

        <div class="custom-container">
            <div class="custom-main">

                {{-- التصنيف --}}
                <div class="custom-category">{{ $news->category->name }}</div>

                {{-- العنوان --}}
                <h1 class="custom-article-title">{{ $news->long_title }}</h1>

                {{-- الملخص --}}
                <div class="custom-article-summary">{{ $news->summary }}</div>

                {{-- الكاتب --}}
                <div class="custom-meta">

                    @if ($news->city)
                        {{ $news->city->name }} -
                    @endif
                    @if ($news->writer && $news->writer->name)
                        <a href="{{ route('writer.show', $news->writer->id) }}">
                            <span> {{ $news->writer->name }}</span>
                        </a>
                    @else
                        <span> بدون كاتب</span>
                    @endif

                </div>

                {{-- التاريخ --}}
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
                    $date = $news->created_at;
                    $day = $date->format('d');
                    $month = $months[$date->format('m')];
                    $year = $date->format('Y');
                @endphp


                @php
                    $shareTitle = $news->share_title ?: $news->long_title;
                    $shareDescription = $news->share_description ?: $news->summary;
                    $shareImage = $news->share_image ?: $news->main_image;
                @endphp



                <div class="custom-date-share">
                    {{-- Date on the RIGHT --}}
                    <p class="date-text">{{ $day }} {{ $month }} {{ $year }}</p>

                    {{-- Share on the LEFT --}}
                    <div class="share-container" id="shareContainer">
                        <div class="share-icons">
                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" title="مشاركة على فيسبوك" rel="noopener">
                                <img src="{{ asset('user/assets/icons/fb.png') }}" alt="Facebook">
                            </a>

                            {{-- X (Twitter) --}}
                            <a href="https://x.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($shareTitle . ' - ' . $shareDescription) }}"
                                target="_blank" title="مشاركة على X" rel="noopener">
                                <img src="{{ asset('user/assets/icons/twitter.png') }}" alt="X">
                            </a>

                            {{-- WhatsApp --}}
                            <a href="https://wa.me/?text={{ urlencode($shareTitle . ' - ' . $shareDescription . ' ' . request()->fullUrl()) }}"
                                target="_blank" title="مشاركة على واتساب" rel="noopener">
                                <img src="{{ asset('user/assets/icons/whatsapp.png') }}" alt="WhatsApp">
                            </a>
                        </div>


                        <button class="share-btn" id="shareToggle" title="مشاركة">
                            <img src="{{ asset('user/assets/icons/send.png') }}" alt="Share" style="width:20px;">
                        </button>
                    </div>
                </div>


                {{-- صورة --}}
                @if ($news->template !== 'no_image')
                    <figure class="custom-article-image-wrapper">
                        <img src="{{ $news->media()->wherePivot('type', 'detail')->first()->path }}" alt="Feature Algeria"
                            loading="lazy">
                        <figcaption>
                            {{ $news->media()->wherePivot('type', 'detail')->first()->alt ?? $news->mobile_title }}
                        </figcaption>
                    </figure>
                @endif

                {{-- ألبوم صور --}}
                @if ($news->template == 'album' && $news->media()->wherePivot('type', 'album')->count())
                    @include('user.components.album-slider', [
                        'albumImages' => $news->media()->wherePivot('type', 'album')->get(),
                    ])
                @endif

                {{-- فيديو --}}
                @if ($news->template == 'video' && $news->media()->wherePivot('type', 'video')->first())
                    @include('user.components.video-player', [
                        'video' => $news->media()->wherePivot('type', 'video')->first()->path,
                        'caption' => $news->media()->wherePivot('type', 'video')->first()->alt ?? 'فيديو',
                    ])
                @endif

                {{-- بودكاست --}}
                @if ($news->template == 'podcast' && $news->media()->wherePivot('type', 'podcast')->first())
                    <div class="page-podcast-player">
                        <audio id="pagePodcast" controls style="width: 100%;">
                            <source src="{{ $news->media()->wherePivot('type', 'podcast')->first()->path }}"
                                type="audio/mpeg">
                            متصفحك لا يدعم تشغيل الصوت.
                        </audio>
                    </div>

                    <div class="floating-podcast-player" id="floatingPodcast">
                        <button class="close-btn" id="closeFloating">&times;</button>
                        <audio id="floatingAudio" controls style="width: 100%;">
                            <source src="{{ $news->media()->wherePivot('type', 'podcast')->first()->path }}"
                                type="audio/mpeg">
                            متصفحك لا يدعم تشغيل الصوت.
                        </audio>
                    </div>
                @endif

                {{-- النص الكامل --}}
                <div class="custom-article-content">{!! $news->content !!}</div>

                {{-- الوسوم --}}
                <div class="custom-tags">
                    @foreach ($news->tags as $tag)
                        <span>{{ $tag->name }}</span>
                    @endforeach
                </div>

                {{-- بطاقة الكاتب --}}
                @if (optional($news->writer))
                    <div class="writer-card">
                        <a href="{{ route('writer.show', $news->writer->id) }}">
                            <img src="{{ $news->writer->image ?? asset('user.png') }}" alt="Writer" loading="lazy">
                        </a>
                        <div class="writer-info">
                            <a href="{{ route('writer.show', $news->writer->id) }}">
                                <span> <span style="font-weight:bold;">{{ $news->writer->name }}</span>
                            </a>
                            {{ $news->writer->bio }}</span>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        @include('user.components.footer')
    </div>

    {{-- ================= MOBILE ================= --}}
    <div class="mobile"></div>

    {{-- ================= SCRIPT ================= --}}
    <script>
        const pagePodcast = document.getElementById("pagePodcast");
        const floatingPodcast = document.getElementById("floatingPodcast");
        const floatingAudio = document.getElementById("floatingAudio");
        const closeFloating = document.getElementById("closeFloating");

        pagePodcast?.addEventListener("play", () => {
            floatingPodcast.style.display = "flex";
            floatingAudio.play();
            pagePodcast.pause();
        });

        closeFloating?.addEventListener("click", () => {
            floatingAudio.pause();
            floatingPodcast.style.display = "none";
        });
    </script>

    <script>
        const toggle = document.getElementById('shareToggle');
        const text = document.getElementById('shareText');

        function toggleShare() {
            toggle.parentElement.classList.toggle('active');
        }

        toggle.addEventListener('click', toggleShare);
        text.addEventListener('click', toggleShare);
    </script>

@endsection
