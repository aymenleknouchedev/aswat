@extends('layouts.index')

@section('title', $news->mobile_title)

@php
    $shareTitle = $news->share_title ?: $news->long_title;
    $shareDescription = $news->share_description ?: $news->summary;
    $shareImagePath = $news->share_image ?: $news->media()->wherePivot('type', 'main')->first();
    // share_image and main_image are already stored as absolute URLs in the DB,
    // so we use them directly and only fall back to a local default image.
    $shareImageUrl = $shareImagePath ?: asset('covergoogle.png');
@endphp

@section('meta_description', $shareDescription)
@section('meta_og_title', $shareTitle)
@section('meta_og_description', $shareDescription)
@section('meta_og_image', $shareImageUrl)
@section('meta_twitter_title', $shareTitle)
@section('meta_twitter_description', $shareDescription)
@section('meta_twitter_image', $shareImageUrl)

@section('content')

    <script>
        // Function to process Instagram embeds
        function processEmbeds() {
            console.log('Processing Instagram embeds...');
            
            // Process Instagram embeds
            if (window.instgrm && window.instgrm.Embed) {
                console.log('Found Instagram, processing...');
                try {
                    window.instgrm.Embed.process();
                } catch (e) {
                    console.error('Error processing Instagram:', e);
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.custom-article-content a').forEach(function(el) {
                el.setAttribute('target', '_blank');
                el.setAttribute('rel', 'noopener');
            });

            // Read more card click handler - for dynamically inserted content from TinyMCE
            document.addEventListener('click', function(e) {
                const card = e.target.closest('.read-more-block');
                if (card) {
                    const shortlink = card.dataset.shortlink;
                    if (shortlink) {
                        e.preventDefault();
                        window.location.href = '/article/' + shortlink;
                    }
                }
            });

            // Keyboard support for read more cards
            document.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    const card = e.target.closest('.read-more-block');
                    if (card) {
                        const shortlink = card.dataset.shortlink;
                        if (shortlink) {
                            e.preventDefault();
                            window.location.href = '/article/' + shortlink;
                        }
                    }
                }
            });

            // Process embeds at different intervals as scripts load
            processEmbeds();
            setTimeout(processEmbeds, 500);
            setTimeout(processEmbeds, 1500);
        });

        // Expose globally for manual triggering if needed
        window.processEmbeds = processEmbeds;
    </script>

    {{-- ================= CSS ================= --}}
    <style>
        /* Critical visibility CSS to avoid flash of wrong layout on first paint */
        .web {
            display: none;
        }

        .mobile {
            display: block;
        }



        @media (min-width: 992px) {
            .web {
                display: block !important;
            }

            .mobile {
                display: none !important;
            }
        }

        /* Layout */
        .web {
            width: 100%;
        }

        .custom-article-content a {
            color: #000000;
            text-decoration: none;
            position: relative;
            border-bottom: 2px solid #e4f0ef;
            border-radius: 0;
            padding-bottom: 1px;
            display: inline;
            transition: color 0.3s ease;
        }

        .custom-article-content a::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: -2px;
            height: 0;
            background-color: #e4f0ef;
            z-index: -1;
            transition: height 0.3s ease;
            border-radius: 0;
        }

        .custom-article-content a:hover::before {
            height: calc(100% + 2px);
        }

        .custom-container {
            max-width: 1200px;
            margin: 40px auto;
            display: flex;
            flex-direction: row;
            gap: 20px;
            padding: 0 11px;
        }

        .custom-main {
            flex: 0 0 70%;
            max-width: 70%;
        }

        .custom-sidebar {
            flex: 0 0 calc(30% - 20px);
            max-width: calc(30% - 20px);
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

            .web {
                display: block !important;
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
            font-family: asswat-regular;
            font-weight: bolder;
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
            position: relative;
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
            color: #000000;
            line-height: 1.9;
            text-align: right;
            margin-bottom: 30px;
        }

        .custom-article-content p span {
            font-size: 28px !important;
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
        .custom-article-content h4 {
            font-family: asswat-medium !important;
            color: #111 !important;
            text-align: right !important;
            margin-top: 35px !important;
            margin-bottom: 18px !important;
            font-size: 32px !important;
        }

        .custom-article-content h3 {
            color: #333 !important;
            margin: 0 !important;
        }

        /* Image spacing and captions */
        .custom-article-content img {
            display: block;
            max-width: 100% !important;
            height: auto !important;
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

        /* Video styling within content */
        .custom-article-content video {
            width: 100%;
            height: auto;
        }

        .custom-article-content iframe[src*="youtube"],
        .custom-article-content iframe[src*="vimeo"],
        .custom-article-content iframe[src*="dailymotion"] {
            width: 100%;
            height: auto;
            aspect-ratio: 16/9;
            border: none;
        }

        /* Audio styling within content */
        .custom-article-content audio {
            width: 100% !important;
            height: 50px !important;
            margin: 25px 0;
            display: block;
            border-radius: 25px;
            background: #f5f5f5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .custom-article-content audio::-webkit-media-controls-panel {
            background: linear-gradient(to right, #f5f5f5, #ffffff);
            border-radius: 25px;
        }

        .custom-article-content audio::-webkit-media-controls-play-button,
        .custom-article-content audio::-webkit-media-controls-pause-button {
            background-color: #000;
            border-radius: 50%;
        }

        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
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

        .custom-article-content blockquote p span {
            font-size: 28px;
            color: #222;
            line-height: 1.6;
            font-family: asswat-bold !important;
            text-align: center !important;
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
            background: url('/user/assets/icons/up.png') no-repeat center;
            background-size: contain;
        }

        .custom-article-content blockquote::after {
            content: "";
            position: absolute;
            bottom: 0px;
            left: 0px;
            width: 32px;
            height: 32px;
            background: url('/user/assets/icons/down.png') no-repeat center;
            background-size: contain;
        }

        /* Instagram Embed Styles */
        .custom-article-content .instagram-media {
            margin: 20px auto !important;
            width: 100% !important;
            max-width: 540px !important;
        }

        .custom-article-content .instagram-media iframe {
            max-width: 100% !important;
        }

        /* Tags */
        .custom-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            row-gap: 22px;
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
            color: #555 !important;
        }

        .writer-info .name {
            font-size: 16px;
            color: #555 !important;
            font-family: asswat-bold;
        }

        .writer-info .bio {
            font-size: 16px;
            color: #555 !important;
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

        .news-card-horizontal-news {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            direction: rtl;
            margin-bottom: 10px;
        }

        .news-card-horizontal-news .news-card-image-news img {
            width: 140px;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .news-card-horizontal-news .news-card-text-news {
            flex: 1;
        }

        .news-card-horizontal-news .news-card-text-news h3 {
            font-size: 12px;
            margin: 0 0 4px;
            color: #74747C;
            font-family: asswat-light;
            font-weight: lighter;
        }

        .news-card-horizontal-news .news-card-text-news p {
            font-size: 14px;
            margin: 0;
            font-family: asswat-medium;
            line-height: 1.4;
        }

        .economy-grid-container-news {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .economy-card-news {
            display: flex;
            flex-direction: column;
        }

        .economy-card-news img {
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
        }

        .economy-card-news h3 {
            font-size: 12px;
            margin: 8px 0 4px;
            color: #74747C;
            font-family: asswat-light;
            font-weight: lighter;
        }

        .economy-card-news h2 {
            font-size: 16px;
            margin: 0;
            font-family: asswat-bold;
            color: #333;
        }

        .economy-card-news p {
            font-size: 14px;
            color: #555;
        }

        .economy-card-news h3 {
            cursor: pointer;
            font-family: asswat-light;
            font-weight: lighter;
        }

        .economy-card-news h2:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            .floating-podcast-player {
                width: 95%;
                padding: 10px 12px;
            }
        }

        /* ===== Social Share Section ===== */
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
            justify-content: flex-end;
            gap: 10px;
            position: relative;
        }

        .share-icons {
            display: flex;
            gap: 8px;
            opacity: 0;
            transform: translateX(-10px);
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
            color: #929292;
            transition: color 0.3s ease;
        }

        .share-icons a:hover {
            color: #333;
        }

        .share-icons img {
            width: 30px;
            height: 30px;
        }

        .share-btn {
            background: #ffffff;
            border: none;
            border-radius: 50%;
            width: 27px;
            height: 27px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .share-btn:hover {
            background: #f5f5f5;
        }

        .newCategoryReadMoreNews {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .newCategoryReadMoreNews-list {
            margin-top: 12px;
            display: flex;
            align-items: center;
            direction: rtl;
            font-family: asswat-bold;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .newCategoryReadMoreNews-list:last-child {
            border-bottom: none;
        }

        .newCategoryReadMoreNews-list .number {
            font-size: 32px;
            color: #e7e7e7;
            margin-left: 10px;
            font-weight: bold;
        }

        .newCategoryReadMoreNews-list p {
            font-size: 16px;
            color: #333;
            line-height: 1.4;
        }

        .section-title {
            font-size: 20px;
            font-family: asswat-bold;
            color: #141414;
            text-align: right;
        }

        /* Clickable text styling */
        .custom-article-content p .clickable-term {
            color: #000000;
            text-decoration: none;
            cursor: pointer;
            border-radius: 50%;
            background-color: #e4f0ef;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", Arial, sans-serif !important;
            font-size: 9px !important;
            font-weight: 700;
            vertical-align: super;
            display: inline-grid;
            place-items: center;
            line-height: 1;
            min-width: 16px;
            min-height: 16px;
            aspect-ratio: 1;
            padding: 3px;
            box-sizing: border-box;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        /* Text definition modal */
        .text-definition-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10000;
            animation: modalBackdropFadeIn 0.3s ease;
        }

        @keyframes modalBackdropFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .text-modal-backdrop {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            animation: backdropFadeIn 0.3s ease;
        }

        @keyframes backdropFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .text-modal-container {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            width: 100%;
            max-height: 80vh;
            box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            animation: modalSlideUp 0.4s ease-out;
            overflow: hidden;
        }

        @keyframes modalSlideUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes modalSlideDown {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(100%);
            }
        }

        .text-modal-container.closing {
            animation: modalSlideDown 0.3s ease-out forwards;
        }

        .text-definition-modal.closing .text-modal-backdrop {
            animation: backdropFadeOut 0.3s ease forwards;
        }

        @keyframes backdropFadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .text-modal-header {
            padding: 0;
            border-bottom: none;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            background: white;
            border-radius: 0;
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 10;
        }

        .text-modal-close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #000;
            padding: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .text-modal-close:hover {
            color: #000;
            transform: scale(1.1);
        }

        @keyframes closeBtnPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .text-modal-body {
            padding: 2rem;
            overflow-y: auto;
            flex: 1;
            animation: bodyFadeIn 0.4s;
            display: flex;
            flex-direction: row;
            gap: 2rem;
            align-items: flex-start;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        @keyframes bodyFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .text-modal-title {
            font-size: 16px;
            font-weight: bold;
            color: #222;
            font-family: asswat-bold;
            text-align: right;
            direction: rtl;
            margin-bottom: 8px;
            width: 100%;
        }

        .text-modal-body p {
            margin: 0;
            color: #444;
            font-family: asswat-regular;
            font-size: 16px;
            line-height: 1.8;
            text-align: right;
            direction: rtl;
        }

        #textModalImageContainer {
            margin-bottom: 0;
            flex-shrink: 0;
            flex-grow: 0;
            order: 0;
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        #textModalImage {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 150px;
            object-fit: contain;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        #textModalImage:hover {
            opacity: 0.9;
        }

        /* Full-screen image viewer */
        .feature-image-clickable {
            cursor: pointer;
        }

        .fullscreen-image-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: none;
            z-index: 10001;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fullscreen-image-modal.active {
            display: flex;
        }

        .fullscreen-image-container {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fullscreen-image-container img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
            display: block;
        }

        .fullscreen-image-close {
            position: fixed;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: #fff;
            font-size: 40px;
            cursor: pointer;
            padding: 0;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
            z-index: 10002;
        }

        .fullscreen-image-close:hover {
            transform: scale(1.2);
        }

        .fullscreen-image-prev,
        .fullscreen-image-next {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #fff;
            font-size: 60px;
            cursor: pointer;
            padding: 20px 15px;
            width: 60px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 10003;
            font-family: Arial, sans-serif;
            font-weight: 100;
        }

        .fullscreen-image-prev {
            right: 20px;
        }

        .fullscreen-image-next {
            left: 20px;
        }



        .fullscreen-image-prev:disabled,
        .fullscreen-image-next:disabled {
            opacity: 0.1;
            cursor: not-allowed;
            pointer-events: none;
        }

        .fullscreen-image-counter {
            position: fixed;
            top: 20px;
            left: 20px;
            background: none;
            color: #fff;
            padding: 10px 20px;
            font-family: asswat-medium;
            font-size: 16px;
            z-index: 10003;
        }

        .fullscreen-image-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 15px 25px;
            text-align: right;
            font-family: asswat-regular;
            direction: rtl;
        }

        /* Make content images clickable */
        .custom-article-content img {
            cursor: pointer;
            transition: opacity 0.3s;
        }

        @media (max-width: 768px) {
            .text-modal-container {
                width: 100%;
                max-height: 90vh;
                bottom: 0;
            }

            .text-modal-body {
                flex-direction: column;
                gap: 1rem;
                padding: 1.5rem;
                max-width: 100%;
            }

            #textModalImageContainer {
                order: -1;
                justify-content: center;
            }

            #textModalImage {
                width: auto;
                height: auto;
                max-width: 100%;
                max-height: 300px;
                cursor: pointer;
            }

            .text-modal-body p {
                padding: 0;
                font-size: 16px;
            }

            .text-modal-title {
                font-size: 22px;
                margin-bottom: 12px;
            }

            .economy-grid-container-news {
                grid-template-columns: repeat(2, 1fr);
            }

            .fullscreen-image-prev,
            .fullscreen-image-next {
                font-size: 40px;
                width: 50px;
                height: 60px;
                padding: 10px 8px;
            }

            .fullscreen-image-prev {
                right: 10px;
            }

            .fullscreen-image-next {
                left: 10px;
            }

            .fullscreen-image-counter {
                font-size: 14px;
                padding: 8px 15px;
                top: 15px;
                left: 15px;
            }

            .fullscreen-image-close {
                font-size: 32px;
                width: 40px;
                height: 40px;
                top: 15px;
                right: 15px;
            }
        }

        @media (max-width: 480px) {
            .economy-grid-container-news {
                grid-template-columns: 1fr;
            }

            .custom-article-title {
                font-size: 28px;
            }
        }

        /* ===== Read More Card ===== */
        .read-more-block {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 12px;
            direction: rtl;
            margin-top: 28px;
            margin-bottom: 28px;
            background: #F5F5F5;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            position: relative;
            border-radius: 6px;
        }

        /* Placeholder state (before content loads) */
        .read-more-block .read-more-placeholder {
            display: block;
            text-align: center;
            color: #999;
            font-size: 14px;
            padding: 1rem;
        }

        /* Hide placeholder when content is loaded */
        .read-more-block:has(.read-more-content) .read-more-placeholder {
            display: none;
        }

        .read-more-label-text {
            font-size: 18px;
            font-family: asswat-bold;
            color: #666;
            display: flex;
            align-items: center;
            white-space: nowrap;
            order: -1;
        }

        .read-more-image {
            width: 160px;
            height: 90px;
            aspect-ratio: 16/9;
            object-fit: cover;
            flex-shrink: 0;
            display: block;
            position: relative;
        }

        .read-more-label {
            position: absolute;
            right: 0;
            top: 0;
            background: #e7e7e7;
            color: #333;
            font-family: asswat-bold;
            font-size: 13px;
            padding: 3px 12px 3px 8px;
            border-bottom-left-radius: 12px;
            border-top-right-radius: 4px;
            z-index: 2;
            letter-spacing: 0.5px;
        }

        .read-more-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
            justify-content: center;
            padding: 0 8px;
        }

        .read-more-category {
            font-size: 12px;
            font-family: asswat-regular;
            color: #888;
            text-align: right;
            margin: 0;
        }

        .read-more-title {
            font-size: 18px;
            font-family: asswat-medium !important;
            color: #000000;
            margin-top: 2px !important;
            margin-bottom: 2px !important;
            line-height: 1.3;
            text-align: right;
        }

        .read-more-summary {
            display: none;
        }

        @media (max-width: 600px) {
            .read-more-block {
                flex-direction: row;
                gap: 8px;
                background: #f9f9f9;
                border-radius: 0;
                overflow: visible;
                border: none;
                box-shadow: none;
                transition: none;
                align-items: center;
            }

            .read-more-block:active {
                box-shadow: none;
                transform: none;
            }

            .read-more-label-text {
                font-size: 13px;
                padding: 0;
                margin: 0;
                display: block;
                order: -1;
                min-width: 60px;
                text-align: center;
            }

            .read-more-image {
                width: 120px;
                height: 70px;
                order: 0;
                flex-shrink: 0;
            }

            .read-more-content {
                padding: 0;
                gap: 4px;
                flex: 1;
            }

            .read-more-label {
                display: none;
            }

            .read-more-category {
                font-size: 11px;
                color: #999;
                margin: 0 !important;
            }

            .read-more-title {
                font-size: 14px;
                line-height: 1.3;
                margin: 0 !important;
            }

            .read-more-summary {
                font-size: 13px;
                color: #666;
                line-height: 1.3;
                display: none;
            }
        }

        /* ===== IMPROVED AUDIO PLAYER STYLES ===== */
        .audio-player-wrapper {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .audio-player-image {
            position: relative;
            width: 100%;
            overflow: hidden;
            cursor: pointer;
        }

        .audio-player-image img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
            aspect-ratio: 16/9;
            transition: filter 0.3s ease;
        }

        .audio-player-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .audio-player-wrapper.playing .audio-player-overlay {
            opacity: 1;
            background: rgba(0, 0, 0, 0.6);
        }

        .audio-player-wrapper.playing .audio-player-image img {
            filter: brightness(0.7);
        }

        .audio-play-icon {
            position: absolute;
            bottom: 20px;
            left: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 5;
            transition: all 0.3s ease;
        }



        .audio-play-icon i {
            font-size: 23px;
            color: #ffffff;
            margin-left: 2px;
        }


        .audio-player-wrapper.playing .audio-play-icon i {
            color: #ffffff;
        }

        /* Updated Creative podcast lines - Aligned with play icon - Interactive for seeking */
        .podcast-lines {
            position: absolute;
            bottom: 20px;
            left: 65px;
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 4px;
            height: 35px;
            cursor: pointer;
        }

        .audio-player-wrapper.playing .podcast-lines {
            opacity: 1;
            pointer-events: auto;
        }

        .podcast-line {
            width: 3px;
            background: #ffffff89;
            border-radius: 2px;
            animation: wave 1.5s ease-in-out infinite;
            transform-origin: center;
        }

        /* Fade effect for lines - darker to lighter from left to right */
        .podcast-line:nth-child(1) {
            opacity: 1;
        }

        .podcast-line:nth-child(2) {
            opacity: 0.95;
        }

        .podcast-line:nth-child(3) {
            opacity: 0.9;
        }

        .podcast-line:nth-child(4) {
            opacity: 0.85;
        }

        .podcast-line:nth-child(5) {
            opacity: 0.8;
        }

        .podcast-line:nth-child(6) {
            opacity: 0.75;
        }

        .podcast-line:nth-child(7) {
            opacity: 0.7;
        }

        .podcast-line:nth-child(8) {
            opacity: 0.65;
        }

        .podcast-line:nth-child(9) {
            opacity: 0.6;
        }

        .podcast-line:nth-child(10) {
            opacity: 0.55;
        }

        .podcast-line:nth-child(11) {
            opacity: 0.5;
        }

        .podcast-line:nth-child(12) {
            opacity: 0.45;
        }

        .podcast-line:nth-child(13) {
            opacity: 0.4;
        }

        .podcast-line:nth-child(14) {
            opacity: 0.35;
        }

        .podcast-line:nth-child(15) {
            opacity: 0.3;
        }

        /* Different heights and animation delays for each line */
        .podcast-line:nth-child(1) {
            height: 20px;
            animation-delay: 0s;
        }

        .podcast-line:nth-child(2) {
            height: 28px;
            animation-delay: 0.1s;
        }

        .podcast-line:nth-child(3) {
            height: 15px;
            animation-delay: 0.2s;
        }

        .podcast-line:nth-child(4) {
            height: 22px;
            animation-delay: 0.3s;
        }

        .podcast-line:nth-child(5) {
            height: 18px;
            animation-delay: 0.4s;
        }

        .podcast-line:nth-child(6) {
            height: 25px;
            animation-delay: 0.5s;
        }

        .podcast-line:nth-child(7) {
            height: 30px;
            animation-delay: 0.6s;
        }

        .podcast-line:nth-child(8) {
            height: 20px;
            animation-delay: 0.7s;
        }

        .podcast-line:nth-child(9) {
            height: 12px;
            animation-delay: 0.8s;
        }

        .podcast-line:nth-child(10) {
            height: 18px;
            animation-delay: 0.9s;
        }

        .podcast-line:nth-child(11) {
            height: 14px;
            animation-delay: 1.0s;
        }

        .podcast-line:nth-child(12) {
            height: 22px;
            animation-delay: 1.1s;
        }

        .podcast-line:nth-child(13) {
            height: 16px;
            animation-delay: 1.2s;
        }

        .podcast-line:nth-child(14) {
            height: 10px;
            animation-delay: 1.3s;
        }

        .podcast-line:nth-child(15) {
            height: 8px;
            animation-delay: 1.4s;
        }

        @keyframes wave {

            0%,
            100% {
                transform: scaleY(1);
            }

            50% {
                transform: scaleY(0.6);
            }
        }

        .audio-player-controls {
            background: transparent;
            padding: 0;
            border-radius: 0;
            display: flex;
            align-items: center;
            gap: 0;
        }

        .audio-player-controls audio {
            flex: 1;
            height: 40px;
        }

        .audio-time {
            font-family: asswat-regular;
            font-size: 14px;
            color: #666;
            min-width: 100px;
            text-align: center;
        }

        .audio-caption {
            background: #F5F5F5;
            color: #555;
            font-size: 15px;
            padding: 10px;
            text-align: right;
            font-family: asswat-regular;
            direction: rtl;
        }

        /* Audio time display - positioned on the right side */
        .audio-time-display {
            position: absolute;
            bottom: 20px;
            right: 20px;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            z-index: 5;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .audio-player-wrapper.playing .audio-time-display {
            opacity: 1;
        }

        /* Responsive styles for podcast lines and audio controls */
        @media (max-width: 768px) {
            .podcast-lines {
                left: 55px;
                width: 10%;
                height: 30px;
                gap: 3px;
            }

            .podcast-line {
                width: 2px;
            }

            .podcast-line:nth-child(1) {
                height: 16px;
            }

            .podcast-line:nth-child(2) {
                height: 22px;
            }

            .podcast-line:nth-child(3) {
                height: 12px;
            }

            .podcast-line:nth-child(4) {
                height: 18px;
            }

            .podcast-line:nth-child(5) {
                height: 14px;
            }

            .podcast-line:nth-child(6) {
                height: 20px;
            }

            .podcast-line:nth-child(7) {
                height: 24px;
            }

            .podcast-line:nth-child(8) {
                height: 16px;
            }

            .podcast-line:nth-child(9) {
                height: 10px;
            }

            .podcast-line:nth-child(10) {
                height: 14px;
            }

            .podcast-line:nth-child(11) {
                height: 11px;
            }

            .podcast-line:nth-child(12) {
                height: 18px;
            }

            .podcast-line:nth-child(13) {
                height: 13px;
            }

            .podcast-line:nth-child(14) {
                height: 8px;
            }

            .podcast-line:nth-child(15) {
                height: 6px;
            }

            .audio-time-display {
                font-size: 12px;
                padding: 6px 10px;
                right: 15px;
                bottom: 15px;
            }

            .audio-progress-container {
                padding: 0 15px;
                height: 40px;
            }

            .audio-progress-handle {
                width: 14px;
                height: 14px;
            }

            /* Mobile article styles */
            .mobile-article-container {
                margin-top: 68px;
                padding: 20px;
                direction: rtl;
                background: #fff;
            }

            .mobile-article-category {
                font-size: 16px;
                color: #888;
                margin-bottom: 10px;
                text-align: right;
            }

            .mobile-article-category a {
                color: #888;
                text-decoration: none;
            }

            .mobile-article-title {
                font-size: 28px;
                font-family: asswat-medium;
                color: #141414;
                margin-bottom: 12px;
                line-height: 1.4;
                text-align: right;
            }

            .mobile-article-summary {
                font-size: 16px;
                color: #555;
                line-height: 1.6;
                margin-bottom: 15px;
                text-align: right;
                font-family: asswat-regular;
                font-weight: bold;
            }

            .mobile-article-meta {
                font-size: 16px;
                color: #141414;
                font-family: asswat-light;
                margin-bottom: 15px;
                text-align: right;
                line-height: 1.6;
            }

            .mobile-article-meta a {
                color: #141414;
                text-decoration: none;
            }

            .mobile-article-date-share {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
                padding-bottom: 15px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .mobile-article-date {
                font-size: 14px;
                color: #888;
            }

            .mobile-article-image {
                width: 100%;
                margin: 15px 0;
                overflow: hidden;
            }

            .mobile-article-image img {
                width: 100%;
                height: auto;
                display: block;
                object-fit: cover;
                aspect-ratio: 16/9;
                cursor: pointer;
            }

            .mobile-article-image figcaption {
                font-size: 14px;
                color: #888;
                padding: 8px;
                background: #f9f9f9;
                text-align: right;
            }

            .mobile-article-content {
                font-size: 16px !important;
                font-family: asswat-regular;
                color: #000000;
                line-height: 1.9;
                text-align: right;
                margin-bottom: 30px;
            }

            .mobile-article-content p span {
                font-size: 28px !important;
                font-family: asswat-regular;
                color: #333;
                line-height: 1.9;
                text-align: right;
                margin: 5px 0px;
            }

            .mobile-article-content * {
                font-family: asswat-regular !important;
                direction: rtl !important;
                box-sizing: border-box;
            }

            .mobile-article-content p {
                margin-bottom: 15px;
                text-align: right;
            }

            .mobile-article-content h2,
            .mobile-article-content h4 {
                font-family: asswat-medium !important;
                color: #111 !important;
                text-align: right !important;
                margin-top: 35px !important;
                margin-bottom: 18px !important;
                font-size: 24px !important;
            }

            .mobile-article-content h3 {
                color: #333 !important;
                margin: 0 !important;
                font-family: 'asswat-medium' !important;
            }

            /* Image spacing and captions */
            .mobile-article-content img {
                display: block;
                max-width: 100% !important;
                height: auto !important;
                cursor: pointer;
            }

            /* Content figure styling */
            .mobile-article-content figure {
                width: 100%;
                margin: 25px 0;
            }

            .mobile-article-content figure img {
                width: 100%;
                height: auto;
                display: block;
                object-fit: cover;
            }

            .mobile-article-content figcaption {
                background: #F5F5F5;
                color: #555;
                font-size: 15px;
                padding: 10px;
                text-align: right;
                font-family: asswat-regular;
                direction: rtl;
            }

            /* Video styling within mobile content */
            .mobile-article-content video {
                width: 100%;
                height: auto;
            }

            .mobile-article-content iframe[src*="youtube"],
            .mobile-article-content iframe[src*="vimeo"],
            .mobile-article-content iframe[src*="dailymotion"] {
                width: 100%;
                height: auto;
                aspect-ratio: 16/9;
                border: none;
            }

            /* Audio styling within mobile content */
            .mobile-article-content audio {
                width: 100% !important;
                height: 50px !important;
                margin: 20px 0;
                display: block;
                border-radius: 25px;
                background: #f5f5f5;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            }

            .mobile-article-content audio::-webkit-media-controls-panel {
                background: linear-gradient(to right, #f5f5f5, #ffffff);
                border-radius: 25px;
            }

            .mobile-article-content audio::-webkit-media-controls-play-button,
            .mobile-article-content audio::-webkit-media-controls-pause-button {
                background-color: #000;
                border-radius: 50%;
            }

            .mobile-article-content a {
                color: #000000;
                text-decoration: none;
                position: relative;
                border-bottom: 2px solid #e4f0ef;
                border-radius: 0;
                padding-bottom: 1px;
                display: inline;
                transition: color 0.3s ease;
            }

            .mobile-article-content a::before {
                content: '';
                position: absolute;
                left: 0;
                right: 0;
                bottom: -2px;
                height: 0;
                background-color: #e4f0ef;
                z-index: -1;
                transition: height 0.3s ease;
                border-radius: 0;
            }

            .mobile-article-content a:hover::before {
                height: calc(100% + 2px);
            }

            /* Blockquote */
            .mobile-article-content blockquote {
                width: 100%;
                padding: 40px 20px;
                margin: 30px 0;
                text-align: center;
                position: relative;
                font-family: asswat-medium;
            }

            .mobile-article-content blockquote p span {
                font-size: 28px;
                color: #222;
                line-height: 1.6;
                font-family: asswat-bold !important;
                text-align: center !important;
            }

            .mobile-article-content blockquote p {
                font-size: 28px;
                color: #222;
                line-height: 1.6;
                font-family: asswat-bold !important;
                text-align: center !important;
            }

            .mobile-article-content blockquote::before {
                content: "";
                position: absolute;
                top: 0px;
                right: 0px;
                width: 32px;
                height: 32px;
                background: url('/user/assets/icons/up.png') no-repeat center;
                background-size: contain;
            }

            .mobile-article-content blockquote::after {
                content: "";
                position: absolute;
                bottom: 0px;
                left: 0px;
                width: 32px;
                height: 32px;
                background: url('/user/assets/icons/down.png') no-repeat center;
                background-size: contain;
            }

            /* Clickable text styling */
            .mobile-article-content p .clickable-term {
                color: #000000;
                text-decoration: none;
                cursor: pointer;
                border-radius: 50%;
                background-color: #e4f0ef;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", Arial, sans-serif !important;
                font-size: 9px !important;
                font-weight: 700;
                vertical-align: super;
                display: inline-grid;
                place-items: center;
                line-height: 1;
                min-width: 16px;
                min-height: 16px;
                aspect-ratio: 1;
                padding: 3px;
                box-sizing: border-box;
                transition: transform 0.2s ease, background-color 0.2s ease;
            }

            .mobile-article-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin: 20px 0;
                justify-content: flex-start;
            }

            .mobile-article-tags a {
                display: inline-block;
                padding: 6px 12px;
                background: #f0f0f0;
                color: #333;
                text-decoration: none;
                font-size: 14px;
            }

            .mobile-article-tags a:hover {
                background: #e0e0e0;
            }

            .mobile-writer-card {
                background: #f9f9f9;
                padding: 15px;
                margin: 20px 0;
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 12px;
                align-items: center;
                direction: rtl;
            }

            .mobile-writer-image {
                width: 100px;
                height: 100px;
                min-width: 100px;
                border-radius: 50%;
                object-fit: cover;
            }

            .mobile-writer-info {
                flex: 1;
                display: flex;
                gap: 0;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
            }

            .mobile-writer-name {
                font-size: 16px;
                font-family: asswat-bold;
                color: #333;
                margin-bottom: 0;
                margin-right: 6px;
            }

            .mobile-writer-bio {
                font-size: 16px;
                color: #888;
                line-height: 1.4;
                margin: 0;
            }

            .mobile-related-section {
                margin-top: 30px;
                padding: 12px 0 34px;
                background-color: #ffffff;
                border-top: none;
            }

            .mobile-related-title {
                font-size: 18px;
                font-family: asswat-bold;
                color: #000;
                margin-bottom: 15px;
                text-align: right;
                padding: 0 16px;
            }

            .mobile-related-carousel {
                display: flex;
                flex-direction: column;
                gap: 12px;
                overflow-x: visible;
                overflow-y: visible;
                scrollbar-width: none;
                direction: rtl;
            }

            .mobile-related-carousel::-webkit-scrollbar {
                display: none;
            }

            .mobile-related-card {
                display: flex;
                flex-direction: column;
                flex: 0 0 auto;
                width: 100%;
                text-decoration: none;
                color: inherit;
                direction: rtl;
                position: relative;
                overflow: hidden;
                background: transparent;
                border-radius: 0;
            }

            .mobile-related-image {
                width: 100%;
                height: 180px;
                object-fit: cover;
                display: block;
                margin-bottom: 0;
            }

            .mobile-related-content {
                flex: 1;
                padding: 12px 0;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }

            .mobile-related-category {
                font-size: 11px;
                color: #888;
                margin-bottom: 6px;
                text-align: right;
            }

            .mobile-related-title-text {
                font-size: 14px;
                font-family: asswat-bold;
                color: #000;
                line-height: 1.5;
                text-align: right;
                word-wrap: break-word;
            }

            /* Greybar hide on scroll */
            #greybar {
                transition: transform 0.3s ease, opacity 0.3s ease;
            }

            #greybar.hide {
                transform: translateY(-100%);
                opacity: 0;
            }
        }

        /* ===== RELATED NEWS CAROUSEL (Mobile) ===== */
        @media (max-width: 768px) {
            .mobile-related-news-wrapper {
                background: #fff;
                height: auto;
                display: flex;
                flex-direction: column;
                position: relative;
                padding: 16px 0;
            }

            .mobile-related-news-badge {
                position: relative;
                top: auto;
                right: auto;
                background: transparent;
                color: #000;
                padding: 0px 0px 16px 16px;
                font-size: 20px;
                line-height: 1;
                border-radius: 0;
                display: block;
                text-align: right;
                z-index: 10;
                font-family: 'asswat-medium';
            }

            .related-news-track {
                width: 100%;
                height: auto;
                overflow-x: auto;
                overflow-y: hidden;
                display: flex;
                align-items: flex-start;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                direction: rtl;
                gap: 16px;
            }

            .related-news-track::-webkit-scrollbar {
                display: none;
            }

            .related-news-scroll-card {
                flex: 0 0 80vw;
                height: auto;
                scroll-snap-align: start;
                overflow: hidden;
                display: flex;
                flex-direction: column;
            }

            .related-news-scroll-card img {
                width: 100%;
                aspect-ratio: 16 / 9;
                object-fit: cover;
                display: block;
            }

            .related-news-scroll-card-content {
                padding: 12px 0px;
                color: #333;
                text-align: right;
                display: flex;
                flex-direction: column;
                gap: 6px;
                min-height: 80px;
            }

            .related-news-scroll-category {
                font-size: 16px;
                color: #666;
            }

            .related-news-scroll-title {
                font-size: 18px;
                font-weight: 800;
                line-height: 1.3;
                color: #000;
                font-family: 'asswat-bold';
            }

            .related-news-scroll-desc {
                font-size: 13px;
                color: #555;
                line-height: 1.5;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                font-family: 'asswat-regular';
            }
        }

        @media (max-width: 480px) {
            .podcast-lines {
                left: 50px;
                width: 10%;
                height: 25px;
                gap: 2px;
            }

            .podcast-line {
                width: 2px;
            }

            .podcast-line:nth-child(1) {
                height: 14px;
            }

            .podcast-line:nth-child(2) {
                height: 18px;
            }

            .podcast-line:nth-child(3) {
                height: 10px;
            }

            .podcast-line:nth-child(4) {
                height: 15px;
            }

            .podcast-line:nth-child(5) {
                height: 12px;
            }

            .podcast-line:nth-child(6) {
                height: 17px;
            }

            .podcast-line:nth-child(7) {
                height: 20px;
            }

            .podcast-line:nth-child(8) {
                height: 14px;
            }

            .podcast-line:nth-child(9) {
                height: 8px;
            }

            .podcast-line:nth-child(10) {
                height: 12px;
            }

            .podcast-line:nth-child(11) {
                height: 9px;
            }

            .podcast-line:nth-child(12) {
                height: 15px;
            }

            .podcast-line:nth-child(13) {
                height: 11px;
            }

            .podcast-line:nth-child(14) {
                height: 7px;
            }

            .podcast-line:nth-child(15) {
                height: 5px;
            }

            .audio-time-display {
                font-size: 11px;
                padding: 5px 8px;
                right: 10px;
                bottom: 12px;
            }

            .audio-progress-container {
                padding: 0 10px;
                height: 35px;
            }

            .audio-progress-handle {
                width: 12px;
                height: 12px;
            }
        }
    </style>

    {{-- ================= FULLSCREEN IMAGE MODAL ================= --}}
    <div id="fullscreenImageModal" class="fullscreen-image-modal">
        <div class="fullscreen-image-container">
            <button class="fullscreen-image-close" id="fullscreenImageClose" type="button" aria-label="إغلاق">×</button>
            <button class="fullscreen-image-prev" id="fullscreenImagePrev" type="button"
                aria-label="الصورة السابقة">‹</button>
            <button class="fullscreen-image-next" id="fullscreenImageNext" type="button"
                aria-label="الصورة التالية">›</button>
            <img id="fullscreenImageContent" src="" alt="صورة بحجم كامل">
            <div class="fullscreen-image-caption" id="fullscreenImageCaption"></div>
            <div class="fullscreen-image-counter" id="fullscreenImageCounter"></div>
        </div>
    </div>

    {{-- ================= TEXT DEFINITION MODAL ================= --}}
    <div id="textDefinitionModal" class="text-definition-modal" style="display: none;" role="dialog"
        aria-labelledby="textModalTitle">
        <div class="text-modal-backdrop"></div>
        <div class="text-modal-container">
            <div class="text-modal-header">
                <button class="text-modal-close" id="textModalCloseBtn" type="button" aria-label="إغلاق">×</button>
            </div>
            <div class="text-modal-body">
                <div id="textModalImageContainer" style="display: none;">
                    <img id="textModalImage" src="" alt="صورة التعريف">
                </div>
                <div>
                    <h3 id="textModalTitle" class="text-modal-title"></h3>
                    <p id="textModalContent"></p>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= WEB ================= --}}
    <div class="web">
        @include('user.components.fixed-nav')

        <div class="custom-container">
            <div class="custom-main">

                {{-- Category --}}
                <div class="custom-category">
                    @if (isset($news->country))
                        <a href="{{ route('category.show', ['id' => $news->category->id, 'type' => 'Category']) }}"
                            style="color: #888; text-decoration: none;">
                            {{ $news->category->name ?? '' }}
                        </a>
                        -
                        <a href="{{ route('category.show', ['id' => $news->country->id, 'type' => 'Country']) }}"
                            style="color: #888; text-decoration: none;">
                            {{ $news->country->name ?? '' }}
                        </a>
                    @elseif (isset($news->continent))
                        <a href="{{ route('category.show', ['id' => $news->category->id, 'type' => 'Category']) }}"
                            style="color: #888; text-decoration: none;">
                            {{ $news->category->name ?? '' }}
                        </a>
                        -
                        <a href="{{ route('category.show', ['id' => $news->continent->id, 'type' => 'Continent']) }}"
                            style="color: #888; text-decoration: none;">
                            {{ $news->continent->name ?? '' }}
                        </a>
                    @else
                        <a href="{{ route('category.show', ['id' => $news->category->id, 'type' => 'Category']) }}"
                            style="color: #888; text-decoration: none;">
                            {{ $news->category->name ?? '' }}
                        </a>
                    @endif
                </div>

                {{-- Title --}}
                <h1 class="custom-article-title">{{ $news->long_title }}</h1>

                {{-- Summary --}}
                <div class="custom-article-summary">{{ $news->summary }}</div>

                {{-- Authors --}}
                <div class="custom-meta">

                    @php
                        $writers = $news->writers;
                    @endphp

                    @if ($writers->count() > 0)
                        @if ($news->city)
                            {{ $news->city->name }} -
                        @endif
                        {{-- First writer with city --}}
                        <span>
                            @if ($writers[0]->pivot->role)
                                <span style="color: #888;">{{ $writers[0]->pivot->role }}:</span>
                            @endif
                        </span>
                        <a href="{{ route('writer.show', $writers[0]->id) }}">

                            {{ $writers[0]->name }}

                        </a>

                        {{-- Other writers, each on a new line --}}
                        @foreach ($writers->slice(1) as $writer)
                            <br>
                            <a href="{{ route('writer.show', $writer->id) }}">
                                <span>
                                    @if ($writer->pivot->role)
                                        <span style="color: #888;">{{ $writer->pivot->role }}:</span>
                                    @endif
                                    {{ $writer->name }}

                                </span>
                            </a>
                        @endforeach
                    @endif

                </div>

                {{-- Date and Share Section --}}
                @php
                    $months = [
                        '01' => 'جانفي',
                        '02' => 'فيفري',
                        '03' => 'مارس',
                        '04' => 'أفريل',
                        '05' => 'ماي',
                        '06' => 'جوان',
                        '07' => 'جويلية',
                        '08' => 'أوت',
                        '09' => 'سبتمبر',
                        '10' => 'أكتوبر',
                        '11' => 'نوفمبر',
                        '12' => 'ديسمبر',
                    ];

                    // Use published_date if available (first publication), otherwise published_at, then created_at
                    $dateToUse = null;
                    if ($news->published_date) {
                        $dateToUse = $news->published_date;
                    } elseif ($news->published_at) {
                        $dateToUse = $news->published_at;
                    } else {
                        $dateToUse = $news->created_at;
                    }

                    // Convert to Carbon instance if it's a string
                if (is_string($dateToUse)) {
                    $date = \Carbon\Carbon::parse($dateToUse);
                } else {
                    $date = $dateToUse;
                }

                $day = $date->format('d');
                $month = $months[$date->format('m')];
                $year = $date->format('Y');
                $time = $date->format('H:i');
                @endphp

                @php
                    $shareTitle = $news->share_title ?: $news->long_title;
                    $shareDescription = $news->share_description ?: $news->summary;
                    $shareImage = $news->share_image ?: $news->main_image;
                @endphp

                <div style="margin-top: 10px" class="custom-date-share">
                    {{-- Date on the RIGHT --}}
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <p class="date-text">{{ $day }} {{ $month }} {{ $year }} |
                            {{ $time }}</p>

                        @php
                            $totalViews = $news->contentDailyViews->sum('views') ?? 0;
                        @endphp

                        @if ($totalViews > 50)
                            <div class="views-count"
                                style="display: flex; align-items: center; gap: 5px; color: #888; font-size: 14px;">
                                <i class="fas fa-eye"></i>
                                <span>{{ number_format($totalViews) }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Share on the LEFT --}}
                    <div class="share-container" id="shareContainer">
                        <div class="share-icons">
                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" title="مشاركة على فيسبوك" rel="noopener" class="share-icon">
                                <i class="fa-brands fa-facebook"></i>
                            </a>

                            {{-- X (Twitter) --}}
                            <a href="https://x.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($shareTitle . ' - ' . $shareDescription) }}"
                                target="_blank" title="مشاركة على X" rel="noopener" class="share-icon">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>

                            {{-- WhatsApp --}}
                            <a href="https://wa.me/?text={{ urlencode($shareTitle . ' - ' . $shareDescription . ' ' . request()->fullUrl()) }}"
                                target="_blank" title="مشاركة على واتساب" rel="noopener" class="share-icon">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>

                            {{-- Copy Link --}}
                            <a href="#" id="copyLinkBtn" title="نسخ الرابط" rel="noopener" class="share-icon">
                                <i class="fa-solid fa-link"></i>
                            </a>
                        </div>

                        {{-- Share Button --}}
                        <button class="share-btn" id="shareToggle" type="button" title="مشاركة"
                            aria-label="زر المشاركة">
                            <img src="{{ asset('user/assets/icons/send.png') }}" alt="Share" style="width:20px;">
                        </button>
                    </div>
                </div>

                {{-- Feature Image (hidden for video/album/podcast templates since they use it as cover) --}}
                @if (
                    $news->template !== 'no_image' &&
                        $news->template !== 'video' &&
                        $news->template !== 'album' &&
                        $news->template !== 'podcast')
                    <figure class="custom-article-image-wrapper">
                        <img src="{{ $news->media()->wherePivot('type', 'detail')->first()->path }}"
                            alt="{{ $news->caption }}" loading="lazy"
                            style="aspect-ratio: 16/9; object-fit: cover; cursor: pointer;"
                            class="feature-image-clickable"
                            data-full-image="{{ $news->media()->wherePivot('type', 'detail')->first()->path }}">
                        <figcaption>{{ $news->caption ?? '' }}</figcaption>
                    </figure>
                @endif

                @if ($news->template == 'no_image')
                    @include('user.components.ligne')
                    <br>
                @endif

                {{-- Album --}}
                @if ($news->template == 'album' && $news->media()->wherePivot('type', 'album')->count())
                    @php
                        // Use the article's main image as the first slide (cover) in the album
                        $mainImage = $news->media()->wherePivot('type', 'main')->first();
                        $albumImages = $news->media()->wherePivot('type', 'album')->get();

                        // Prepend main image as the first slide if it exists
                        if ($mainImage) {
                            $allAlbumImages = collect([$mainImage])->concat($albumImages);
                        } else {
                            $allAlbumImages = $albumImages;
                        }
                    @endphp
                    @include('user.components.album-slider', [
                        'albumImages' => $allAlbumImages,
                        'caption' => $news->caption ?? '',
                    ])
                @endif

                {{-- Video --}}
                @if ($news->template == 'video' && $news->media()->wherePivot('type', 'video')->first())
                    @php
                        // Use the article's main image as the video poster/thumbnail
$mainImage = $news->media()->wherePivot('type', 'main')->first();
                        $posterImage = $mainImage ? $mainImage->path : null;
                    @endphp
                    @include('user.components.video-player', [
                        'video' => $news->media()->wherePivot('type', 'video')->first()->path,
                        'caption' => $news->media()->wherePivot('type', 'video')->first()->alt ?? 'فيديو',
                        'poster' => $posterImage,
                        'context' => 'web',
                    ])
                @endif

                {{-- Podcast/Audio --}}
                @if ($news->template == 'podcast' && $news->media()->wherePivot('type', 'podcast')->first())
                    @php
                        // Use the article's main image as the audio cover
$mainImage = $news->media()->wherePivot('type', 'main')->first();
$coverImage = $mainImage ? $mainImage->path : null;
$audioPath = $news->media()->wherePivot('type', 'podcast')->first()->path;
                    @endphp

                    {{-- Enhanced Audio Player --}}
                    <div class="audio-player-wrapper" id="audioPlayerWrapper">

                        <div class="audio-player-image" style="position:relative;">
                            <img src="{{ $coverImage }}" alt="{{ $news->caption ?? 'بودكاست' }}" loading="lazy">
                            {{-- Play icon positioned at bottom left --}}
                            <div class="audio-play-icon" id="audioPlayIcon">
                                <i class="fa-solid fa-play"></i>
                            </div>
                            {{-- Vertical podcast lines aligned with play icon - Interactive for seeking --}}
                            <div class="podcast-lines" id="podcastLines">
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                                <div class="podcast-line"></div>
                            </div>
                            {{-- Time display on the right side --}}
                            <div class="audio-time-display" id="audioTimeDisplay">
                                <span id="currentTime">0:00</span> / <span id="totalDuration">0:00</span>
                            </div>
                        </div>

                        {{-- Audio controls --}}
                        <div class="audio-player-controls">
                            <audio id="podcastAudio" preload="metadata">
                                <source src="{{ $audioPath }}" type="audio/mpeg">
                                متصفحك لا يدعم تشغيل الصوتيات.
                            </audio>
                        </div>

                        {{-- Caption --}}
                        @if ($news->caption)
                            <div class="audio-caption">{{ $news->caption }}</div>
                        @endif
                    </div>
                @endif

                <div style="width: 78%; margin: 0 auto;">
                    {{-- Article Content --}}
                    <div class="custom-article-content">{!! $news->content !!}</div>

                    {{-- Tags --}}
                    <div class="custom-tags">
                        @foreach ($news->tags as $tag)
                            <a href="{{ route('tag.show', $tag->id) }}" style="text-decoration: none; color: inherit;">
                                <span>
                                    {{ $tag->name }}
                                </span>
                            </a>
                        @endforeach
                    </div>

                    {{-- Writer Card --}}
                    @if ($writers->count() > 0)
                        @foreach ($writers as $writer)
                            @if ($writer->bio != '')
                                <a href="{{ route('writer.show', $writer->id) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <div class="writer-card">
                                        <img src="{{ $writer->image ?? asset('user.png') }}" alt="{{ $writer->name }}"
                                            loading="lazy"
                                            style="border-radius:50%; width:80px; height:80px; object-fit:cover;">
                                        <div class="writer-info">
                                            <span class="bio"><span class="name">{{ $writer->name }}</span>
                                                {{ $writer->bio }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endif
                            <br>
                        @endforeach
                    @endif
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="custom-sidebar">
                <p class="section-title">الأكثر قراءة</p>
                @include('user.components.ligne')

                <div class="newCategoryReadMoreNews">
                    @foreach ($lastWeekNews as $index => $item)
                        <div class="newCategoryReadMoreNews-list">
                            <span class="number">{{ $index + 1 }}</span>
                            <a href="{{ route('news.show', $item->shortlink) }}"
                                style="text-decoration: none; color: inherit;">
                                <p>{{ $item->title }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>

                @include('user.components.sp60')

                <p class="section-title">المزيد من {{ $news->category->name }}</p>
                @include('user.components.ligne')

                @foreach ($lastNews as $content)
                    <div class="sp20" style="margin-top: 16px;"></div>
                    <div class="news-card-horizontal-news">
                        <div class="news-card-image-news">
                            <a href="{{ route('news.show', $content->shortlink) }}">
                                <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                    alt="{{ $content->title ?? 'News' }}" loading="lazy">
                            </a>
                        </div>
                        <div class="news-card-text-news">
                            <a href="{{ route('news.show', $content->shortlink) }}"
                                style="text-decoration: none; color: inherit;">
                                <p>{{ $content->title ?? '' }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Related News Section --}}
        <section class="economy-feature-grid container">
            <p class="section-title">ذات صلة</p>
            <div style="height: 5px"></div>
            @include('user.components.ligne')
            <div style="height: 20px"></div>

            <div class="economy-grid-container-news">
                @foreach ($relatedNews as $item)
                    <div class="economy-card-news">
                        <a href="{{ route('news.show', $item->shortlink) }}">
                            <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                alt="{{ $item->title ?? '' }}" loading="lazy">
                        </a>

                        <h3>
                            <x-category-links :content="$item" />
                        </h3>

                        <a href="{{ route('news.show', $item->shortlink) }}"
                            style="text-decoration: none; color: inherit;">
                            <h2>{{ $item->title ?? '' }}</h2>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        @include('user.components.sp60')
        @include('user.components.footer')
    </div>

    <div class="mobile">
        @include('user.mobile.mobile-home')
        <!-- Mobile Article Content -->
        <div class="mobile-article-container">
            <div id="greybar"
                style="background-color: #252525; height: 68px; position: fixed; top: 0; left: 0; right: 0; z-index: 10;">
            </div>
            <!-- Category -->
            <div class="mobile-article-category">
                @if (isset($news->country))
                    <a href="{{ route('category.show', ['id' => $news->category->id, 'type' => 'Category']) }}">
                        {{ $news->category->name ?? '' }}
                    </a>
                    -
                    <a href="{{ route('category.show', ['id' => $news->country->id, 'type' => 'Country']) }}">
                        {{ $news->country->name ?? '' }}
                    </a>
                @elseif (isset($news->continent))
                    <a href="{{ route('category.show', ['id' => $news->category->id, 'type' => 'Category']) }}">
                        {{ $news->category->name ?? '' }}
                    </a>
                    -
                    <a href="{{ route('category.show', ['id' => $news->continent->id, 'type' => 'Continent']) }}">
                        {{ $news->continent->name ?? '' }}
                    </a>
                @else
                    <a href="{{ route('category.show', ['id' => $news->category->id, 'type' => 'Category']) }}">
                        {{ $news->category->name ?? '' }}
                    </a>
                @endif
            </div>

            <!-- Title -->
            <h1 class="mobile-article-title">{{ $news->long_title }}</h1>

            <!-- Summary -->
            <div class="mobile-article-summary">{{ $news->summary }}</div>

            <!-- Meta / Writers -->
            <div class="mobile-article-meta">
                @php
                    $writers = $news->writers;
                @endphp

                @if ($writers->count() > 0)
                    @if ($news->city)
                        {{ $news->city->name }} -
                    @endif
                    {{-- First writer with city --}}
                    <span>
                        @if ($writers[0]->pivot->role)
                            <span style="color: #888;">{{ $writers[0]->pivot->role }}:</span>
                        @endif
                    </span>
                    <a href="{{ route('writer.show', $writers[0]->id) }}">
                        {{ $writers[0]->name }}
                    </a>

                    {{-- Other writers, each on a new line --}}
                    @foreach ($writers->slice(1) as $writer)
                        <br>
                        <a href="{{ route('writer.show', $writer->id) }}">
                            <span>
                                @if ($writer->pivot->role)
                                    <span style="color: #888;">{{ $writer->pivot->role }}:</span>
                                @endif
                                {{ $writer->name }}
                            </span>
                        </a>
                    @endforeach
                @endif
            </div>

            <!-- Date and Share -->
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
                $time = $date->format('H:i');
            @endphp

            @php
                $shareTitle = $news->share_title ?: $news->long_title;
                $shareDescription = $news->share_description ?: $news->summary;
                $shareImage = $news->share_image ?: $news->main_image;
            @endphp

            <div class="mobile-article-date-share">
                <span class="mobile-article-date">{{ $day }} {{ $month }} {{ $year }} |
                    {{ $time }}</span>

                {{-- Share on the LEFT (matching web version exactly) --}}
                <div class="share-container" id="shareContainerMobile">
                    <div class="share-icons">
                        {{-- Facebook --}}
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                            target="_blank" title="مشاركة على فيسبوك" rel="noopener" class="share-icon">
                            <i class="fa-brands fa-facebook"></i>
                        </a>

                        {{-- X (Twitter) --}}
                        <a href="https://x.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($shareTitle . ' - ' . $shareDescription) }}"
                            target="_blank" title="مشاركة على X" rel="noopener" class="share-icon">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>

                        {{-- WhatsApp --}}
                        <a href="https://wa.me/?text={{ urlencode($shareTitle . ' - ' . $shareDescription . ' ' . request()->fullUrl()) }}"
                            target="_blank" title="مشاركة على واتساب" rel="noopener" class="share-icon">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>

                        {{-- Copy Link --}}
                        <a href="#" id="copyLinkBtnMobile" title="نسخ الرابط" rel="noopener" class="share-icon">
                            <i class="fa-solid fa-link"></i>
                        </a>
                    </div>

                    {{-- Share Button --}}
                    <button class="share-btn" id="shareToggleMobile" type="button" title="مشاركة"
                        aria-label="زر المشاركة">
                        <img src="{{ asset('user/assets/icons/send.png') }}" alt="Share" style="width:20px;">
                    </button>
                </div>
            </div>

            <!-- Feature Image -->
            @if ($news->template == 'normal_image')
                <figure class="mobile-article-image">
                    <img src="{{ $news->media()->wherePivot('type', 'detail')->first()->path }}"
                        alt="{{ $news->caption }}" loading="lazy" style="cursor: pointer;">
                    @if ($news->caption)
                        <figcaption>{{ $news->caption }}</figcaption>
                    @endif
                </figure>
            @endif

            @if ($news->template == 'no_image')
                @include('user.components.ligne')
                <br>
            @endif

            <!-- Album -->
            @if ($news->template == 'album' && $news->media()->wherePivot('type', 'album')->count())
                @php
                    $mainImage = $news->media()->wherePivot('type', 'main')->first();
                    $albumImages = $news->media()->wherePivot('type', 'album')->get();
                    if ($mainImage) {
                        $allAlbumImages = collect([$mainImage])->concat($albumImages);
                    } else {
                        $allAlbumImages = $albumImages;
                    }
                @endphp
                @include('user.components.album-slider', [
                    'albumImages' => $allAlbumImages,
                    'caption' => $news->caption ?? '',
                ])
            @endif

            <!-- Video -->
            @if ($news->template == 'video' && $news->media()->wherePivot('type', 'video')->first())
                @php
                    $mainImage = $news->media()->wherePivot('type', 'main')->first();
                    $posterImage = $mainImage ? $mainImage->path : null;
                @endphp
                @include('user.components.video-player', [
                    'video' => $news->media()->wherePivot('type', 'video')->first()->path,
                    'caption' => $news->media()->wherePivot('type', 'video')->first()->alt ?? 'فيديو',
                    'poster' => $posterImage,
                    'context' => 'mobile',
                ])
            @endif

            <!-- Podcast/Audio -->
            @if ($news->template == 'podcast' && $news->media()->wherePivot('type', 'podcast')->first())
                @php
                    $mainImage = $news->media()->wherePivot('type', 'main')->first();
                    $coverImage = $mainImage ? $mainImage->path : null;
                    $audioPath = $news->media()->wherePivot('type', 'podcast')->first()->path;
                @endphp

                <div class="audio-player-wrapper" id="audioPlayerWrapperMobile">
                    <div class="audio-player-image" style="position:relative;">
                        <img src="{{ $coverImage }}" alt="{{ $news->caption ?? 'بودكاست' }}" loading="lazy">
                        <div class="audio-play-icon" id="audioPlayIconMobile">
                            <i class="fa-solid fa-play"></i>
                        </div>
                        <div class="podcast-lines" id="podcastLinesMobile">
                            @for ($i = 0; $i < 15; $i++)
                                <div class="podcast-line"></div>
                            @endfor
                        </div>
                        <div class="audio-time-display" id="audioTimeDisplayMobile">
                            <span id="currentTimeMobile">0:00</span> / <span id="totalDurationMobile">0:00</span>
                        </div>
                    </div>
                    <div class="audio-player-controls">
                        <audio id="podcastAudioMobile" preload="metadata">
                            <source src="{{ $audioPath }}" type="audio/mpeg">
                            متصفحك لا يدعم تشغيل الصوتيات.
                        </audio>
                    </div>
                    @if ($news->caption)
                        <div class="audio-caption">{{ $news->caption }}</div>
                    @endif
                </div>
            @endif

            <!-- Article Content -->
            <div class="mobile-article-content">{!! $news->content !!}</div>

            <!-- Tags -->
            <div class="mobile-article-tags">
                @foreach ($news->tags as $tag)
                    <a href="{{ route('tag.show', $tag->id) }}">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>

            <!-- Writer Cards -->
            @php $writers = $news->writers; @endphp
            @if ($writers->count() > 0)
                @foreach ($writers as $writer)
                    @if ($writer->bio != '')
                        <a href="{{ route('writer.show', $writer->id) }}" style="text-decoration: none; color: inherit;">
                            <div class="mobile-writer-card">
                                <img src="{{ $writer->image ?? asset('user.png') }}" alt="{{ $writer->name }}"
                                    class="mobile-writer-image" loading="lazy">
                                <div class="mobile-writer-info">
                                    <div class="mobile-writer-bio"><span class="mobile-writer-name">{{ $writer->name }}
                                        </span>{{ $writer->bio }}</div>
                                </div>
                            </div>
                        </a>
                        <div style="height: 15px;"></div>
                    @endif
                @endforeach
            @endif


            <!-- Related News Section (Carousel) -->
            @if (isset($relatedNews) && $relatedNews->count() > 0)
                <div class="mobile-related-news-wrapper">
                    <div class="mobile-related-news-badge">ذات صلة</div>
                    @include('user.components.ligne')
                    <div style="height: 8px"></div>
                    <div class="related-news-track" dir="rtl">
                        @foreach ($relatedNews->take(5) as $item)
                            <article class="related-news-scroll-card">
                                <a href="{{ route('news.show', $item->shortlink) }}"
                                    style="text-decoration: none; color: inherit;">
                                    @php
                                        $img =
                                            $item->media()->wherePivot('type', 'detail')->first()?->path ??
                                            ($item->media()->wherePivot('type', 'main')->first()?->path ??
                                                asset($item->image ?? 'user/assets/images/default-post.jpg'));
                                    @endphp
                                    <img src="{{ $img }}" alt="{{ $item->title }}">
                                </a>
                                <div class="related-news-scroll-card-content">
                                    @if (isset($item->category) && $item->category)
                                        <p class="related-news-scroll-category">
                                            <a href="{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}"
                                                style="color: inherit; text-decoration: none;">
                                                {{ $item->category->name }}
                                            </a>
                                        </p>
                                    @endif
                                    <a href="{{ route('news.show', $item->shortlink) }}"
                                        style="text-decoration: none; color: inherit;">
                                        <h3 class="related-news-scroll-title">
                                            {{ \Illuminate\Support\Str::limit($item->mobile_title, 51) }}</h3>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        <!-- Compact mobile footer at the end -->
        <div class="mobile-container">
            @include('user.mobile.footer')
        </div>
    </div>





    {{-- ================= COMPREHENSIVE JAVASCRIPT ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeShareFunctionality();
            initializeTextDefinitionModal();
            initializeCopyLink();
            initializeAudioPlayer();
            initializeGreybarScroll();
        });

        /**
         * Initialize Greybar Hide on Scroll
         */
        function initializeGreybarScroll() {
            const greybar = document.getElementById('greybar');
            if (!greybar) return;

            window.addEventListener('scroll', function() {
                const footer = document.querySelector('footer');
                if (!footer) return;

                const greybarRect = greybar.getBoundingClientRect();
                const footerRect = footer.getBoundingClientRect();

                // Hide greybar only when it's about to overlap with footer
                if (footerRect.top < greybarRect.bottom) {
                    greybar.classList.add('hide');
                } else {
                    greybar.classList.remove('hide');
                }
            });
        }

        /**
         * Initialize Enhanced Audio Player
         */
        function initializeAudioPlayer() {
            // Initialize both web and mobile audio players
            initializeSingleAudioPlayer('audioPlayerWrapper', 'podcastAudio', 'audioPlayIcon',
                'audioProgressBarInteractive', 'audioProgressFillInteractive', 'audioProgressHandle',
                'currentTime', 'totalDuration');

            initializeSingleAudioPlayer('audioPlayerWrapperMobile', 'podcastAudioMobile', 'audioPlayIconMobile',
                null, null, null, 'currentTimeMobile', 'totalDurationMobile');
        }

        /**
         * Initialize a single audio player instance
         */
        function initializeSingleAudioPlayer(wrapperId, audioId, playIconId, progressBarId, progressFillId, handleId,
            currentTimeId, totalDurationId) {
            const audioPlayerWrapper = document.getElementById(wrapperId);
            const audioElement = document.getElementById(audioId);
            const playIcon = document.getElementById(playIconId);
            const audioProgressBarInteractive = progressBarId ? document.getElementById(progressBarId) : null;
            const audioProgressFillInteractive = progressFillId ? document.getElementById(progressFillId) : null;
            const audioProgressHandle = handleId ? document.getElementById(handleId) : null;
            const currentTimeDisplay = document.getElementById(currentTimeId);
            const totalDurationDisplay = document.getElementById(totalDurationId);

            if (!audioPlayerWrapper || !audioElement) return;

            let isDragging = false;

            // Format time helper
            function formatTime(seconds) {
                if (!seconds || isNaN(seconds)) return '0:00';
                const mins = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${mins}:${secs.toString().padStart(2, '0')}`;
            }

            // Update progress bar and time display
            function updateProgress() {
                if (audioElement.duration && audioProgressFillInteractive && audioProgressHandle) {
                    const percent = (audioElement.currentTime / audioElement.duration) * 100;
                    audioProgressFillInteractive.style.width = percent + '%';
                    audioProgressHandle.style.left = percent + '%';
                }

                // Update time displays
                if (currentTimeDisplay) {
                    currentTimeDisplay.textContent = formatTime(audioElement.currentTime);
                }
                if (totalDurationDisplay && audioElement.duration) {
                    totalDurationDisplay.textContent = formatTime(audioElement.duration);
                }
            }

            // Seek to position
            function seekToPosition(clientX) {
                const rect = audioProgressBarInteractive.getBoundingClientRect();
                const pos = (clientX - rect.left) / rect.width;
                const clampedPos = Math.max(0, Math.min(1, pos));

                if (audioElement.duration) {
                    audioElement.currentTime = clampedPos * audioElement.duration;

                    // Update UI immediately
                    const percent = clampedPos * 100;
                    audioProgressFillInteractive.style.width = percent + '%';
                    audioProgressHandle.style.left = percent + '%';
                }
            }

            // Click on progress bar
            if (audioProgressBarInteractive) {
                audioProgressBarInteractive.addEventListener('click', function(e) {
                    seekToPosition(e.clientX);
                });

                // Mouse drag handlers
                audioProgressHandle.addEventListener('mousedown', function(e) {
                    e.preventDefault();
                    isDragging = true;
                    audioProgressHandle.classList.add('dragging');
                });

                document.addEventListener('mousemove', function(e) {
                    if (isDragging) {
                        seekToPosition(e.clientX);
                    }
                });

                document.addEventListener('mouseup', function() {
                    if (isDragging) {
                        isDragging = false;
                        audioProgressHandle.classList.remove('dragging');
                    }
                });

                // Touch drag handlers for mobile
                audioProgressHandle.addEventListener('touchstart', function(e) {
                    e.preventDefault();
                    isDragging = true;
                    audioProgressHandle.classList.add('dragging');
                });

                document.addEventListener('touchmove', function(e) {
                    if (isDragging && e.touches.length > 0) {
                        seekToPosition(e.touches[0].clientX);
                    }
                });

                document.addEventListener('touchend', function() {
                    if (isDragging) {
                        isDragging = false;
                        audioProgressHandle.classList.remove('dragging');
                    }
                });
            }

            // Toggle play/pause
            function togglePlayPause() {
                if (audioElement.paused) {
                    audioElement.play();
                    audioPlayerWrapper.classList.add('playing');
                    playIcon.innerHTML = '<i class="fa-solid fa-pause"></i>';
                } else {
                    audioElement.pause();
                    audioPlayerWrapper.classList.remove('playing');
                    playIcon.innerHTML = '<i class="fa-solid fa-play"></i>';
                }
            }

            // Event listeners
            playIcon.addEventListener('click', function(e) {
                e.stopPropagation();
                togglePlayPause();
            });

            audioPlayerWrapper.querySelector('.audio-player-image').addEventListener('click', function() {
                togglePlayPause();
            });

            audioElement.addEventListener('timeupdate', updateProgress);

            audioElement.addEventListener('loadedmetadata', function() {
                updateProgress();
            });

            audioElement.addEventListener('ended', function() {
                audioPlayerWrapper.classList.remove('playing');
                playIcon.innerHTML = '<i class="fa-solid fa-play"></i>';
            });
        }

        /**
         * Initialize Share Functionality
         */
        function initializeShareFunctionality() {
            // Initialize web share
            initializeSingleShare('shareContainer', 'shareToggle');
            // Initialize mobile share
            initializeSingleShare('shareContainerMobile', 'shareToggleMobile');
        }

        /**
         * Initialize a single share container
         */
        function initializeSingleShare(containerId, toggleId) {
            const shareContainer = document.getElementById(containerId);
            const shareToggle = document.getElementById(toggleId);

            if (!shareContainer || !shareToggle) {
                return;
            }

            // Toggle share menu on button click
            shareToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                shareContainer.classList.toggle('active');
            });

            // Close share menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!shareContainer.contains(e.target)) {
                    shareContainer.classList.remove('active');
                }
            });

            // Prevent closing when clicking inside share container
            shareContainer.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        /**
         * Initialize Copy Link Functionality
         */
        function initializeCopyLink() {
            // Initialize web copy link
            initializeSingleCopyLink('copyLinkBtn');
            // Initialize mobile copy link
            initializeSingleCopyLink('copyLinkBtnMobile');
        }

        /**
         * Initialize a single copy link button
         */
        function initializeSingleCopyLink(btnId) {
            const copyLinkBtn = document.getElementById(btnId);

            if (!copyLinkBtn) {
                return;
            }

            copyLinkBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const url = window.location.href;

                // Copy to clipboard
                navigator.clipboard.writeText(url).then(function() {
                    // Show success message
                    showCopySuccessMessage(copyLinkBtn);
                }).catch(function(err) {
                    console.error('Failed to copy:', err);
                    // Fallback for older browsers
                    fallbackCopyToClipboard(url, copyLinkBtn);
                });
            });
        }

        /**
         * Show Copy Success Message
         */
        function showCopySuccessMessage(element) {
            const originalHTML = element.innerHTML;
            const originalTitle = element.title;

            element.innerHTML = '<i class="fa-solid fa-check"></i>';
            element.title = 'تم نسخ الرابط';

            setTimeout(function() {
                element.innerHTML = originalHTML;
                element.title = originalTitle;
            }, 2000);
        }

        /**
         * Fallback Copy to Clipboard (for older browsers)
         */
        function fallbackCopyToClipboard(text, element) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            showCopySuccessMessage(element);
        }

        /**
         * Initialize Text Definition Modal
         */
        function initializeTextDefinitionModal() {
            const textDefinitions = {};

            // Find all clickable terms in the content
            document.querySelectorAll('.clickable-term').forEach(function(element) {
                const term = element.getAttribute('data-term');
                const imagePath = element.getAttribute('data-image');
                const description = element.getAttribute('data-description');

                if (term && description) {
                    textDefinitions[term] = {
                        content: element.textContent,
                        description: description,
                        image: imagePath || null
                    };
                }
            });

            // Get modal elements
            const modal = document.getElementById('textDefinitionModal');
            const modalContent = document.getElementById('textModalContent');
            const modalTitle = document.getElementById('textModalTitle');
            const modalImage = document.getElementById('textModalImage');
            const modalImageContainer = document.getElementById('textModalImageContainer');
            const modalBackdrop = modal.querySelector('.text-modal-backdrop');
            const modalClose = document.getElementById('textModalCloseBtn');

            if (!modal || !modalContent || !modalTitle) {
                console.warn('Modal elements not found');
                return;
            }

            // Handle clicks on clickable text
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('clickable-term')) {
                    e.preventDefault();
                    const term = e.target.getAttribute('data-term');

                    // Try different variations of the term key
                    let definition = textDefinitions[term] ||
                        textDefinitions[term.toLowerCase()] ||
                        textDefinitions[term.toLowerCase().replace(/\s+/g, '-')] ||
                        textDefinitions[term.toLowerCase().replace(/\s+/g, '_')];

                    if (definition) {
                        showTextModal(term, definition);
                    } else {
                        // Fallback: show modal with term not found
                        showTextModal(term, {
                            description: 'لم يتم العثور على تعريف مفصل لهذا المصطلح.',
                            image: null
                        });
                    }
                }
            });

            // Function to show modal with text definition (including image)
            function showTextModal(term, definition) {
                modalTitle.textContent = term;
                
                // Apply quote replacement to the description
                const descriptionWithQuotes = definition.description.replace(/"([^"]*)"/g, '«$1»');
                modalContent.innerHTML = descriptionWithQuotes;

                if (definition.image) {
                    modalImageContainer.style.display = 'block';
                    modalImage.src = definition.image;
                    modalImage.alt = definition.content || 'صورة التعريف';

                    // Add click handler to open image in fullscreen without caption
                    modalImage.onclick = function() {
                        openSingleImage(this.src, '');
                    };
                } else {
                    modalImageContainer.style.display = 'none';
                    modalImage.onclick = null;
                }

                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }

            // Function to close modal
            function closeTextModal() {
                const modalContainer = modal.querySelector('.text-modal-container');

                // Add closing animation classes
                modal.classList.add('closing');
                modalContainer.classList.add('closing');

                // Wait for animation to complete before hiding
                setTimeout(function() {
                    modal.style.display = 'none';
                    modal.classList.remove('closing');
                    modalContainer.classList.remove('closing');
                    document.body.style.overflow = '';
                }, 300); // Match animation duration
            }

            // Event listeners for closing modal
            modalBackdrop.addEventListener('click', closeTextModal);
            modalClose.addEventListener('click', closeTextModal);

            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'block') {
                    closeTextModal();
                }
            });

            // Prevent modal container click from closing modal
            modal.querySelector('.text-modal-container').addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // ================= FULLSCREEN IMAGE GALLERY FUNCTIONALITY =================
        const fullscreenModal = document.getElementById('fullscreenImageModal');
        const fullscreenImageContent = document.getElementById('fullscreenImageContent');
        const fullscreenImageCaption = document.getElementById('fullscreenImageCaption');
        const fullscreenImageCounter = document.getElementById('fullscreenImageCounter');
        const fullscreenImageClose = document.getElementById('fullscreenImageClose');
        const fullscreenImagePrev = document.getElementById('fullscreenImagePrev');
        const fullscreenImageNext = document.getElementById('fullscreenImageNext');

        // Gallery state
        let galleryImages = [];
        let currentImageIndex = 0;
        let isGalleryMode = false; // Track if we're in gallery mode or single image mode

        // Initialize feature image (principal image)
        function initializeFeatureImage() {
            const featureImage = document.querySelector('.feature-image-clickable');
            if (featureImage) {
                featureImage.addEventListener('click', function() {
                    const fullImagePath = this.getAttribute('data-full-image');
                    const caption = this.getAttribute('alt') || '{{ $news->caption ?? '' }}';

                    if (fullImagePath) {
                        openSingleImage(fullImagePath, caption);
                    }
                });
            }
        }

        // Initialize content images gallery
        function initializeGallery() {
            galleryImages = [];

            // Add all content images only (excluding feature image)
            const contentImages = document.querySelectorAll('.custom-article-content img');
            contentImages.forEach(img => {
                const figure = img.closest('figure');
                const caption = figure ? (figure.querySelector('figcaption')?.textContent || img.getAttribute(
                    'alt') || '') : (img.getAttribute('alt') || '');

                galleryImages.push({
                    src: img.src,
                    caption: caption,
                    element: img
                });
            });

            // Add click handlers to all gallery images
            galleryImages.forEach((imageData, index) => {
                imageData.element.addEventListener('click', function(e) {
                    e.preventDefault();
                    openGallery(index);
                });
            });
        }

        // Open single image (for feature image)
        function openSingleImage(imagePath, caption) {
            isGalleryMode = false;
            fullscreenImageContent.src = imagePath;

            // Show or hide caption based on whether caption exists
            if (caption && caption.trim() !== '') {
                // Apply quote replacement to caption
                const captionWithQuotes = caption.replace(/"([^"]*)"/g, '«$1»');
                fullscreenImageCaption.textContent = captionWithQuotes;
                fullscreenImageCaption.style.display = 'block';
            } else {
                fullscreenImageCaption.style.display = 'none';
            }

            // Hide navigation controls for single image
            fullscreenImagePrev.style.display = 'none';
            fullscreenImageNext.style.display = 'none';
            fullscreenImageCounter.style.display = 'none';

            fullscreenModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Open gallery at specific index (for content images)
        function openGallery(index) {
            isGalleryMode = true;
            currentImageIndex = index;
            showCurrentImage();
            fullscreenModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            updateNavigationButtons();
        }

        // Show current image in gallery
        function showCurrentImage() {
            if (galleryImages.length === 0) return;

            const currentImage = galleryImages[currentImageIndex];
            fullscreenImageContent.src = currentImage.src;
            // Apply quote replacement to caption
            const captionWithQuotes = currentImage.caption.replace(/"([^"]*)"/g, '«$1»');
            fullscreenImageCaption.textContent = captionWithQuotes;
            fullscreenImageCaption.style.display = 'block'; // Always show caption in gallery mode

            // Update counter (1-based index for display)
            fullscreenImageCounter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;

            updateNavigationButtons();
        }

        // Update navigation button states
        function updateNavigationButtons() {
            if (!isGalleryMode) return;

            fullscreenImagePrev.disabled = currentImageIndex === galleryImages.length - 1;
            fullscreenImageNext.disabled = currentImageIndex === 0;

            // Hide buttons if only one image
            if (galleryImages.length <= 1) {
                fullscreenImagePrev.style.display = 'none';
                fullscreenImageNext.style.display = 'none';
                fullscreenImageCounter.style.display = 'none';
            } else {
                fullscreenImagePrev.style.display = 'flex';
                fullscreenImageNext.style.display = 'flex';
                fullscreenImageCounter.style.display = 'block';
            }
        }

        // Navigate to previous image
        function showPreviousImage() {
            if (!isGalleryMode) return;
            if (currentImageIndex < galleryImages.length - 1) {
                currentImageIndex++;
                showCurrentImage();
            }
        }

        // Navigate to next image
        function showNextImage() {
            if (!isGalleryMode) return;
            if (currentImageIndex > 0) {
                currentImageIndex--;
                showCurrentImage();
            }
        }

        // Close modal
        function closeFullscreenImageModal() {
            fullscreenModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Event listeners
        fullscreenImageClose.addEventListener('click', closeFullscreenImageModal);
        fullscreenImagePrev.addEventListener('click', showPreviousImage);
        fullscreenImageNext.addEventListener('click', showNextImage);

        // Close on backdrop click
        fullscreenModal.addEventListener('click', function(e) {
            if (e.target === fullscreenModal) {
                closeFullscreenImageModal();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (fullscreenModal.classList.contains('active')) {
                if (e.key === 'Escape') {
                    closeFullscreenImageModal();
                } else if (isGalleryMode) {
                    if (e.key === 'ArrowLeft') {
                        showNextImage();
                    } else if (e.key === 'ArrowRight') {
                        showPreviousImage();
                    }
                }
            }
        });

        // Prevent modal container click from closing modal
        fullscreenModal.querySelector('.fullscreen-image-container').addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Initialize both feature image and gallery when page loads
        initializeFeatureImage();
        initializeGallery();
    </script>



    {{-- ================= DYNAMIC READMORE LOADER ================= --}}
    @include('components.readmore-loader')

@endsection


