@extends('layouts.index')

@section('title', 'أصوات جزائرية | تفاصيل الخبر')

@section('content')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.custom-article-content a').forEach(function(el) {
                el.setAttribute('target', '_blank');
                el.setAttribute('rel', 'noopener');
            });

            // Read more card click handler - for dynamically inserted content from TinyMCE
            document.addEventListener('click', function(e) {
                const card = e.target.closest('.read-more-block');
                if (card) {
                    const titleElement = card.querySelector('.read-more-title');
                    if (titleElement) {
                        const title = titleElement.textContent.trim();
                        if (title) {
                            e.preventDefault();
                            const filteredTitle = title.replace(/«|»/g, '"');
                            window.location.href = '/news/' + title;
                        }
                    }
                }
            });

            // Keyboard support for read more cards
            document.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    const card = e.target.closest('.read-more-block');
                    if (card) {
                        const titleElement = card.querySelector('.read-more-title');
                        if (titleElement) {
                            const title = titleElement.textContent.trim();
                            if (title) {
                                e.preventDefault();
                                window.location.href = '/news/' + title;
                            }
                        }
                    }
                }
            });
        });
    </script>

    {{-- ================= CSS ================= --}}
    <style>
        /* Layout */
        .web {
            width: 100%;
        }

        .custom-article-content a {
            color: #000000;
            text-decoration: none;
            position: relative;
            border-bottom: 2px solid #b2ec52;
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
            background-color: #b2ec52;
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

        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
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
            font-size: 16px;
            font-family: asswat-bold;
        }

        .writer-info .bio {
            font-size: 16px;
            color: #f5f5f5;
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
            background-color: #b2ec52;
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

        @media (max-width: 768px) {
            .text-modal-container {
                width: 100%;
                max-height: 90vh;
                bottom: 0;
                border-radius: 12px 12px 0 0;
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
            gap: 18px;
            padding: 14px 18px 14px 14px;
            direction: rtl;
            margin-top: 20px;
            margin-bottom: 20px;
            background: #F5F5F5;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            position: relative;
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
            gap: 8px;
            justify-content: center;
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
            font-family: asswat-bold;
            color: #000000;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
            line-height: 1.3;
            text-align: right;
        }

        .read-more-summary {
            display: none;
        }

        .read-more-link {
            display: none;
        }

        @media (max-width: 600px) {
            .read-more-block {
                flex-direction: column;
                gap: 12px;
                padding: 12px 8px;
            }

            .read-more-image {
                width: 100%;
                height: 200px;
            }

            .read-more-label {
                font-size: 12px;
                padding: 2px 10px 2px 6px;
            }

            .read-more-label-text {
                font-size: 12px;
                padding: 3px 10px;
                margin-left: 8px;
            }

            .read-more-category {
                font-size: 11px;
            }

            .read-more-title {
                font-size: 15px;
            }

            .read-more-summary {
                font-size: 13px;
            }
        }
    </style>

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

                <div style="margin-top: 10px" class="custom-date-share">
                    {{-- Date on the RIGHT --}}
                    <p class="date-text">{{ $day }} {{ $month }} {{ $year }}</p>

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
                        <button class="share-btn" id="shareToggle" type="button" title="مشاركة" aria-label="زر المشاركة">
                            <img src="{{ asset('user/assets/icons/send.png') }}" alt="Share" style="width:20px;">
                        </button>
                    </div>
                </div>

                {{-- Feature Image --}}
                @if ($news->template !== 'no_image')
                    <figure class="custom-article-image-wrapper">
                        <img src="{{ $news->media()->wherePivot('type', 'detail')->first()->path }}"
                            alt="{{ $news->caption }}" loading="lazy"
                            style="aspect-ratio: 16/9; object-fit: cover; cursor: pointer;" class="feature-image-clickable"
                            data-full-image="{{ $news->media()->wherePivot('type', 'detail')->first()->path }}">
                        <figcaption>{{ $news->caption ?? '' }}</figcaption>
                    </figure>
                @endif

                {{-- Album --}}
                @if ($news->template == 'album' && $news->media()->wherePivot('type', 'album')->count())
                    @include('user.components.album-slider', [
                        'albumImages' => $news->media()->wherePivot('type', 'album')->get(),
                    ])
                @endif

                {{-- Video --}}
                @if ($news->template == 'video' && $news->media()->wherePivot('type', 'video')->first())
                    @include('user.components.video-player', [
                        'video' => $news->media()->wherePivot('type', 'video')->first()->path,
                        'caption' => $news->media()->wherePivot('type', 'video')->first()->alt ?? 'فيديو',
                    ])
                @endif

                {{-- Podcast --}}
                @if ($news->template == 'podcast' && $news->media()->wherePivot('type', 'podcast')->first())
                    <div class="page-podcast-player">
                        <audio id="pagePodcast" controls style="width: 100%;">
                            <source src="{{ $news->media()->wherePivot('type', 'podcast')->first()->path }}"
                                type="audio/mpeg">
                            متصفحك لا يدعم تشغيل الصوت.
                        </audio>
                    </div>

                    <div class="floating-podcast-player" id="floatingPodcast">
                        <button class="close-btn" id="closeFloating" type="button">&times;</button>
                        <audio id="floatingAudio" controls style="width: 100%;">
                            <source src="{{ $news->media()->wherePivot('type', 'podcast')->first()->path }}"
                                type="audio/mpeg">
                            متصفحك لا يدعم تشغيل الصوت.
                        </audio>
                    </div>
                @endif

                <div style="width: 78%; margin: 0 auto;">
                    {{-- Article Content --}}
                    <div class="custom-article-content">{!! $news->content !!}</div>

                    {{-- Tags --}}
                    <div class="custom-tags">
                        @foreach ($news->tags as $tag)
                            <span>{{ $tag->name }}</span>
                        @endforeach
                    </div>

                    {{-- Writer Card --}}
                    @if ($writers->count() > 0)
                        @foreach ($writers as $writer)
                            <a href="{{ route('writer.show', $writer->id) }}"
                                style="text-decoration: none; color: inherit;">
                                <div class="writer-card">
                                    <img src="{{ $writer->image ?? asset('user.png') }}" alt="{{ $writer->name }}"
                                        loading="lazy"
                                        style="border-radius:50%; width:80px; height:80px; object-fit:cover;">
                                    <div class="writer-info">
                                        <span class="bio"><span class="name">{{ $writer->name }}</span> {{ $writer->bio }}</span>
                                    </div>
                                </div>
                            </a>
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
                            <a href="{{ route('news.show', $item->title) }}"
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
                            <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                alt="{{ $content->title ?? 'News' }}" loading="lazy">
                        </div>
                        <div class="news-card-text-news">
                            <a href="{{ route('news.show', $content->title) }}"
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
                        <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                            alt="{{ $item->title ?? '' }}" loading="lazy">

                        <h3>
                            <x-category-links :content="$item" />
                        </h3>

                        <a href="{{ route('news.show', $item->title) }}" style="text-decoration: none; color: inherit;">
                            <h2>{{ $item->title ?? '' }}</h2>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        @include('user.components.sp60')
        @include('user.components.footer')
    </div>

    {{-- ================= FULLSCREEN IMAGE MODAL ================= --}}
    <div id="fullscreenImageModal" class="fullscreen-image-modal">
        <div class="fullscreen-image-container">
            <button class="fullscreen-image-close" id="fullscreenImageClose" type="button"
                aria-label="إغلاق">×</button>
            <img id="fullscreenImageContent" src="" alt="صورة بحجم كامل">
            <div class="fullscreen-image-caption" id="fullscreenImageCaption"></div>
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

    {{-- ================= COMPREHENSIVE JAVASCRIPT ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeShareFunctionality();
            initializeTextDefinitionModal();
            initializeCopyLink();
        });

        /**
         * Initialize Share Functionality
         */
        function initializeShareFunctionality() {
            const shareContainer = document.getElementById('shareContainer');
            const shareToggle = document.getElementById('shareToggle');

            if (!shareContainer || !shareToggle) {
                console.warn('Share container or toggle button not found');
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
            const copyLinkBtn = document.getElementById('copyLinkBtn');

            if (!copyLinkBtn) {
                console.warn('Copy link button not found');
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
                modalContent.innerHTML = definition.description;

                if (definition.image) {
                    modalImageContainer.style.display = 'block';
                    modalImage.src = definition.image;
                    modalImage.alt = definition.content || 'صورة التعريف';
                } else {
                    modalImageContainer.style.display = 'none';
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

        // ================= FULLSCREEN IMAGE MODAL FUNCTIONALITY =================
        const fullscreenModal = document.getElementById('fullscreenImageModal');
        const fullscreenImageContent = document.getElementById('fullscreenImageContent');
        const fullscreenImageCaption = document.getElementById('fullscreenImageCaption');
        const fullscreenImageClose = document.getElementById('fullscreenImageClose');
        const featureImages = document.querySelectorAll('.feature-image-clickable');

        // Open fullscreen image modal
        featureImages.forEach(img => {
            img.addEventListener('click', function() {
                const fullImagePath = this.getAttribute('data-full-image');
                const caption = this.getAttribute('alt') || '{{ $news->caption ?? '' }}';

                if (fullImagePath) {
                    fullscreenImageContent.src = fullImagePath;
                    fullscreenImageCaption.textContent = caption;
                    fullscreenModal.classList.add('active');
                    document.body.style.overflow = 'hidden'; // Prevent body scroll
                }
            });
        });

        // Close fullscreen image modal
        function closeFullscreenImageModal() {
            fullscreenModal.classList.remove('active');
            document.body.style.overflow = 'auto'; // Restore body scroll
        }

        // Close button click
        fullscreenImageClose.addEventListener('click', closeFullscreenImageModal);

        // Close on backdrop click (modal container)
        fullscreenModal.addEventListener('click', function(e) {
            if (e.target === fullscreenModal) {
                closeFullscreenImageModal();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && fullscreenModal.classList.contains('active')) {
                closeFullscreenImageModal();
            }
        });

        // Prevent modal container click from closing modal
        fullscreenModal.querySelector('.fullscreen-image-container').addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>

    {{-- ================= MOBILE ================= --}}
    <div class="mobile"></div>

@endsection
