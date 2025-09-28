@extends('layouts.index')

@section('title', 'أصوات جزائرية | صور')

@section('content')

    <style>
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

        .custom-meta {
            font-size: 14px;
            color: #888;
            margin-bottom: 5px;
            font-family: asswat-light;
            text-align: right;
        }

        .custom-meta-date {
            font-size: 14px;
            color: #888;
            margin-bottom: 10px;
            font-family: asswat-light;
            text-align: right;
        }

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

        .custom-article-content {
            font-size: 16px;
            color: #333;
            line-height: 1.8;
            /* change from medium to regular */
            text-align: right;
            margin-bottom: 30px;
        }

        /* === Blockquote Custom Styling === */
        .custom-article-content blockquote {
            width: 100%;
            background: #f5f5f5;
            padding: 60px 20px;
            margin: 30px 0;
            border-radius: 10px;
            text-align: center;
            position: relative;
            box-sizing: border-box;
            font-family: asswat-medium;
        }

        /* Text */
        .custom-article-content blockquote p {
            margin: 0;
            font-size: 1.2rem;
            color: #222;
            line-height: 1.6;
        }

        /* Top-right image icon */
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

        /* Bottom-left image icon */
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
    </style>

    <div class="web">
        @include('user.components.fixed-nav')

        <div class="custom-container">
            <div class="custom-main">

                {{-- التصنيف --}}
                <div class="custom-category">
                    {{ $news->category->name }}
                </div>

                {{-- العنوان --}}
                <h1 class="custom-article-title">
                    {{ $news->long_title }}
                </h1>

                {{-- الملخص --}}
                <div class="custom-article-summary">
                    {{ $news->summary }}
                </div>

                {{-- الكاتب --}}
                <div class="custom-meta">
                    {{ $news->writer->name ?? 'غير معروف' }}
                </div>

                {{-- التاريخ --}}
                <div class="custom-meta-date">
                    {{ \Carbon\Carbon::parse($news->published_at)->format('d-m-Y') }}
                </div>

                @if ($news->template !== 'no-image')
                    {{-- الصورة --}}
                    <div class="custom-article-image-wrapper">
                        <img src="{{ $news->media()->wherePivot('type', 'detail')->first()->path }}" alt="Feature Algeria">
                        <div style="background: #eee; color: #555; font-size: 15px; padding: 10px; text-align: right;">
                            {{ $news->media()->wherePivot('type', 'detail')->first()->alt ?? 'لا توجد رسالة وصفية للصورة.' }}
                        </div>
                    </div>
                @endif


                @if ($news->template == 'video' && $news->media()->wherePivot('type', 'video')->first())
                    @php
                        $video = $news->media()->wherePivot('type', 'video')->first()->path;

                        // Check if it's a YouTube URL
preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]+)/', $video, $matches);
$videoId = $matches[1] ?? null;

// Check if it's a local file (not YouTube)
                        $isLocal = !$videoId;
                    @endphp

                    <div class="custom-article-image-wrapper">
                        @if ($videoId)
                            {{-- YouTube video --}}
                            <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $videoId }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        @elseif($isLocal)
                            {{-- Local uploaded video --}}
                            <video width="100%" height="400" controls>
                                <source src="{{ asset($video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                @endif

                {{-- 🎙️ Podcast --}}
                @if ($news->template == 'podcast' && $news->media()->wherePivot('type', 'podcast')->first())
                    @php
                        $podcast = $news->media()->wherePivot('type', 'podcast')->first()->path;
                    @endphp

                    <div class="custom-podcast-wrapper"
                        style="background:#f5f5f5; padding:20px; border-radius:10px; margin:20px 0;">
                        <h3 style="margin-bottom:10px; color:#333; font-weight:bold; font-size:18px; text-align:right;">
                            🎧 استمع إلى البودكاست
                        </h3>
                        <audio controls style="width:100%; outline:none; border:none; background:#f5f5f5;">
                            <source src="{{ asset($podcast) }}" type="audio/mpeg">
                            متصفحك لا يدعم تشغيل ملفات الصوت.
                        </audio>
                    </div>
                @endif


                {{-- النص الكامل --}}
                <div class="custom-article-content">
                    {!! $news->content !!}
                </div>

                {{-- الوسوم --}}
                <div class="custom-tags">
                    @foreach ($news->tags as $tag)
                        <span>{{ $tag->name }}</span>
                    @endforeach
                </div>

                {{-- بطاقة الكاتب --}}
                <div class="writer-card">
                    @if ($news->writer && $news->writer->path)
                        <img src="/storage/{{ $news->writer->path }}" alt="Writer">
                    @else
                        <img src="{{ asset('user.png') }}" alt="Writer">
                    @endif
                    <div class="writer-info">
                        <div class="name">{{ $news->writer->name ?? 'غير معروف' }}</div>
                        <div class="bio">{{ $news->writer->bio ?? 'لا توجد نبذة عن الكاتب.' }}</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- سايدبار --}}
        {{-- <div class="custom-sidebar">
                <!-- العمود 1 -->
                <div>
                    <a class="section-title">الأكثر قراءة</a>
                    @include('user.components.ligne')
                    <div class="two-titles-list">
                        @foreach ($topViewed as $index => $item)
                            <div class="two-titles-list-ite">
                                <span class="number">{{ $index + 1 }}</span>
                                <p>{{ $item->title }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div> --}}
    </div>

    @include('user.components.footer')
    </div>

    <div class="mobile">
    </div>

@endsection
