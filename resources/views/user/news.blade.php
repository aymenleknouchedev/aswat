@extends('layouts.index')

@section('title', 'أصوات جزائرية | صور')

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
            font-size: 32px;
            font-family: asswat-bold;
            color: #222;
            line-height: 1.4;
            text-align: right;
            margin-bottom: 20px;
        }

        .custom-article-summary {
            font-size: 18px;
            color: #555;
            font-family: asswat-light;
            margin-bottom: 15px;
            text-align: right;
        }

        .custom-meta,
        .custom-meta-date {
            font-size: 14px;
            color: #888;
            font-family: asswat-light;
            text-align: right;
            margin-bottom: 10px;
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

        /* Content */
        .custom-article-content {
            font-size: 16px;
            font-family: asswat-regular;
            color: #333;
            line-height: 1.8;
            text-align: right;
            margin-bottom: 30px;
        }

        .custom-article-content * {
            font-size: 16px !important;
            font-family: asswat-regular !important;
            text-align: justify !important;
        }

        .custom-article-content img {
            max-width: 100% !important;
            height: auto !important;
            display: block;
        }

        .custom-article-content img+.caption,
        .custom-article-content figcaption {
            display: block;
            background: #eee;
            color: #555;
            font-size: 15px;
            padding: 10px;
            text-align: right;
            margin-top: 0;
        }

        /* Blockquote */
        .custom-article-content blockquote {
            width: 100%;
            background: #f5f5f5;
            padding: 60px 20px;
            margin: 30px 0;
            text-align: center;
            position: relative;
            font-family: asswat-medium;
        }

        .custom-article-content blockquote p {
            margin: 0;
            font-size: 1.2rem;
            color: #222;
            line-height: 1.6;
        }

        .custom-article-content blockquote::before {
            content: "";
            position: absolute;
            top: 10px;
            right: 15px;
            width: 32px;
            height: 32px;
            background: url('/user/assets/icons/quote-top.png') no-repeat center;
            background-size: contain;
        }

        .custom-article-content blockquote::after {
            content: "";
            position: absolute;
            bottom: 10px;
            left: 15px;
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
            width: 60px;
            height: 60px;
            object-fit: cover;
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
            /* hidden by default */
            align-items: center;
            gap: 16px;
            width: 80%;
            /* 80% width */
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
                <div class="custom-meta">{{ $news->writer->name ?? 'غير معروف' }}</div>

                {{-- التاريخ --}}
                <div class="custom-meta-date">
                    {{ \Carbon\Carbon::parse($news->published_at)->format('d-m-Y') }}
                </div>

                {{-- صورة --}}
                @if ($news->template !== 'no_image')
                    <div class="custom-article-image-wrapper">
                        <img src="{{ $news->media()->wherePivot('type', 'detail')->first()->path }}" alt="Feature Algeria">
                        <div style="background:#eee; color:#555; font-size:15px; padding:10px; text-align:right;">
                            {{ $news->media()->wherePivot('type', 'detail')->first()->alt ?? 'لا توجد رسالة وصفية للصورة.' }}
                        </div>
                    </div>
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
                <div class="writer-card">
                    <img src="{{ $news->writer && $news->writer->path ? '/storage/' . $news->writer->path : asset('user.png') }}"
                        alt="Writer">
                    <div class="writer-info">
                        <div class="name">{{ $news->writer->name ?? 'غير معروف' }}</div>
                        <div class="bio">{{ $news->writer->bio ?? 'لا توجد نبذة عن الكاتب.' }}</div>
                    </div>
                </div>

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

        // When page podcast plays -> show floating player
        pagePodcast?.addEventListener("play", () => {
            floatingPodcast.style.display = "flex";
            floatingAudio.play();
            pagePodcast.pause();
        });

        // When closing floating player -> pause audio
        closeFloating?.addEventListener("click", () => {
            floatingAudio.pause();
            floatingPodcast.style.display = "none";
        });
    </script>

@endsection
