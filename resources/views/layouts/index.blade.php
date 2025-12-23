<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ================= SEO META ================= -->
    <meta name="description"
        content="موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين، ينقل أخبار الجزائر لحظة بلحظة. ">

    <meta name="keywords"
        content="أصوات جزائرية, أصوات, أخبار الجزائر, أخبار جزائرية, أخبار عاجلة, الجزائر, السياسة في الجزائر, الاقتصاد الجزائري, رياضة جزائرية, المجتمع الجزائري, الثقافة الجزائرية, الإعلام الجزائري, الصحافة الجزائرية, أخبار اليوم الجزائر, أخبار محلية, أخبار وطنية, أخبار دولية, صوت الجزائر, asswatdjazairira, asswat, djazair, algeriavoices, algeria, algerian news, algeria news today, breaking news algeria, algeria politics, algeria economy, algeria sports, algerian media, arabic news, north africa news, maghreb news, dz news, dz media">

    <meta name="author" content="أصوات جزائرية">
    <meta name="robots" content="index, follow">
    <meta name="language" content="ar">
    <link rel="canonical" href="{{ request()->fullUrl() }}">

    <!-- ================= RESOURCE HINTS ================= -->
    <link rel="preconnect" href="https://connect.facebook.net" crossorigin>
    <link rel="preconnect" href="https://www.instagram.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://connect.facebook.net">
    <link rel="dns-prefetch" href="https://www.instagram.com">

    <!-- ================= FAVICON ================= -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('user/assets/images/icon-logo.svg') }}" />

    <!-- ================= CRITICAL CSS ONLY ================= -->
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/fonts.css') }}">

    <!-- ================= PRELOAD CRITICAL CSS ================= -->
    <link rel="preload" href="{{ asset('user/css/main.css') }}" as="style">
    <link rel="preload" href="{{ asset('user/css/fonts.css') }}" as="style">

    <!-- ================= DEFER NON-CRITICAL CSS ================= -->
    <link rel="stylesheet" href="{{ asset('user/css/fixed-nav.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('user/css/header.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('user/css/icons.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('user/css/section-title.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('user/css/breaking-news.css') }}" media="print" onload="this.media='all'">

    <!-- ================= OPEN GRAPH ================= -->
    <meta property="og:title" content="{{ $shareTitle ?? 'أصوات جزائرية' }}" />
    <meta property="og: description"
        content="{{ $shareDescription ?? 'موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين.' }}" />
    <meta property="og:image" content="{{ asset('covergoogle.png') }}" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="أصوات جزائرية" />
    <meta property="og:locale" content="ar_AR" />

    <!-- ================= TWITTER / X ================= -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $shareTitle ?? 'أصوات جزائرية' }}">
    <meta name="twitter:description"
        content="{{ $shareDescription ?? 'موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين.' }}">
    <meta name="twitter:image" content="{{ asset('covergoogle. png') }}">
    <meta name="twitter:site" content="@asswatdjazairia">

    <!-- ================= SOCIAL LINKS ================= -->
    <link rel="me" href="https://x.com/asswatdjazairia">
    <link rel="me" href="https://instagram.com/asswatdjazairia">
    <meta property="article:publisher" content="https://web.facebook.com/asswatdjazairia">

    <!-- ================= INLINE CRITICAL STYLES ================= -->
    <style>
        * {
            -webkit-tap-highlight-color: transparent;
        }

        /* Skeleton loader for better perceived performance */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s ease-in-out infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        . fb-embed-block .fb-embed-title,
        .fb-embed-block .fb-embed-url {
            display: none;
        }

        .fb-embed-block {
            margin: 1.5rem 0;
            cursor: pointer;
            position: relative;
        }

        .fb-embed-block iframe,
        .fb-embed-block .fb-post,
        .fb-embed-block .fb-post * {
            pointer-events: none !important;
        }
    </style>

    <!-- ================= TITLE ================= -->
    <title>@yield('title')</title>
</head>

<body id="gototop">

    <!-- ================= BREAKING NEWS (NOW INSIDE BODY) ================= -->
    <div class="mobile">
        @include('user.components.breaking-news')
    </div>

    <div id="fb-root"></div>

    @yield('content')

    <!-- ================= DEFERRED SCRIPTS ================= -->
    <!-- Load Font Awesome asynchronously -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        media="print" onload="this. media='all'" />
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    </noscript>

    <!-- ================= OPTIMIZED SCRIPTS ================= -->
    <script>
        // Optimized quote replacer - runs only once after DOM is ready
        (function() {
            'use strict';

            const replaceQuotes = str => str.replace(/"([^"]*)"/g, '«$1»');

            function traverseAndReplaceText(node) {
                // Skip non-text elements
                if (['SCRIPT', 'STYLE', 'CODE', 'PRE', 'TEXTAREA', 'NOSCRIPT'].includes(node.nodeName)) {
                    return;
                }

                if (node.nodeType === Node.TEXT_NODE && node.textContent.trim().length > 0) {
                    node.textContent = replaceQuotes(node.textContent);
                } else if (node.nodeType === Node.ELEMENT_NODE) {
                    Array.from(node.childNodes).forEach(traverseAndReplaceText);
                }
            }

            // Use requestIdleCallback for better performance
            function processQuotes() {
                if ('requestIdleCallback' in window) {
                    requestIdleCallback(() => traverseAndReplaceText(document.body), {
                        timeout: 2000
                    });
                } else {
                    setTimeout(() => traverseAndReplaceText(document.body), 100);
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', processQuotes);
            } else {
                processQuotes();
            }
        })();

        // Facebook embed click handler
        document.addEventListener('click', function(e) {
            const fbBlock = e.target.closest('.fb-embed-block');
            if (fbBlock) {
                const fbUrl = fbBlock.getAttribute('data-fb-url');
                if (fbUrl) window.open(fbUrl, '_blank');
            }
        }, {
            passive: true
        });
    </script>

    <!-- ================= THIRD-PARTY SCRIPTS (LAZY LOADED) ================= -->
    <script>
        // Lazy load Facebook SDK
        (function(d, s, id) {
            let js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;

            // Load after page is interactive
            function loadFBSDK() {
                js = d.createElement(s);
                js.id = id;
                js.async = true;
                js.defer = true;
                js.crossOrigin = 'anonymous';
                js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0';
                fjs.parentNode.insertBefore(js, fjs);
            }

            if (document.readyState === 'complete') {
                setTimeout(loadFBSDK, 1000);
            } else {
                window.addEventListener('load', () => setTimeout(loadFBSDK, 1000));
            }
        }(document, 'script', 'facebook-jssdk'));

        // Lazy load Instagram embed
        function loadInstagram() {
            const script = document.createElement('script');
            script.async = true;
            script.defer = true;
            script.src = 'https://www.instagram.com/embed.js';
            document.body.appendChild(script);
        }

        if (document.querySelector('. instagram-media, [data-instgrm-permalink]')) {
            if (document.readyState === 'complete') {
                setTimeout(loadInstagram, 1500);
            } else {
                window.addEventListener('load', () => setTimeout(loadInstagram, 1500));
            }
        }
    </script>

    <!-- ================= YOUR SCRIPTS ================= -->
    <script src="{{ asset('user/js/fixed-nav.js') }}" defer></script>
    <script src="{{ asset('user/js/photos-scroll.js') }}" defer></script>
    <script src="{{ asset('user/js/breaking-news.js') }}" defer></script>
</body>

</html>
