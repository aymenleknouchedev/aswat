<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ================= SEO META ================= -->
    <meta name="description"
        content="موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين، ينقل أخبار الجزائر لحظة بلحظة.">

    <meta name="keywords"
        content="
        أصوات جزائرية,
        أصوات,
        أخبار الجزائر,
        أخبار جزائرية,
        أخبار عاجلة,
        الجزائر,
        السياسة في الجزائر,
        الاقتصاد الجزائري,
        رياضة جزائرية,
        المجتمع الجزائري,
        الثقافة الجزائرية,
        الإعلام الجزائري,
        الصحافة الجزائرية,
        أخبار اليوم الجزائر,
        أخبار محلية,
        أخبار وطنية,
        أخبار دولية,
        صوت الجزائر,
        asswatdjazairira,
        asswat,
        djazair,
        algeriavoices,
        algeria,
        algerian news,
        algeria news today,
        breaking news algeria,
        algeria politics,
        algeria economy,
        algeria sports,
        algerian media,
        arabic news,
        north africa news,
        maghreb news,
        dz news,
        dz media
        ">

    <meta name="author" content="أصوات جزائرية">
    <meta name="robots" content="index, follow">
    <meta name="language" content="ar">
    <link rel="canonical" href="{{ request()->fullUrl() }}">

    <!-- ================= FAVICON ================= -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('user/assets/images/icon-logo.svg') }}" />

    <!-- ================= STYLES ================= -->
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/fixed-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/section-title.css') }}">

    <!-- ================= OPEN GRAPH ================= -->
    <meta property="og:title" content="{{ $shareTitle ?? 'أصوات جزائرية' }}" />
    <meta property="og:description"
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
    <meta name="twitter:image" content="{{ asset('covergoogle.png') }}">
    <meta name="twitter:site" content="@asswatdjazairia">

    <!-- ================= SOCIAL LINKS ================= -->
    <link rel="me" href="https://x.com/asswatdjazairia">
    <link rel="me" href="https://instagram.com/asswatdjazairia">
    <meta property="article:publisher" content="https://web.facebook.com/asswatdjazairia">

    <!-- ================= ICONS & EXTRA STYLES ================= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('user/css/breaking-news.css') }}">

    <!-- ================= INLINE STYLES ================= -->
    <style>
        * {
            -webkit-tap-highlight-color: transparent;
        }

        .fb-embed-block .fb-embed-title,
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

    <!-- ================= INSTAGRAM ================= -->
    <script async src="https://www.instagram.com/embed.js" onload="console.log('Instagram script loaded')"></script>

    <!-- ================= FACEBOOK EMBED CLICK ================= -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                const fbBlock = e.target.closest('.fb-embed-block');
                if (fbBlock) {
                    const fbUrl = fbBlock.getAttribute('data-fb-url');
                    if (fbUrl) {
                        window.open(fbUrl, '_blank');
                    }
                }
            });
        });
    </script>

    <!-- ================= QUOTES REPLACER ================= -->
    <script>
        function replaceQuotes(str) {
            return str.replace(/"([^"]*)"/g, '«$1»');
        }

        function traverseAndReplaceText(node) {
            if (
                node.nodeName === 'SCRIPT' ||
                node.nodeName === 'STYLE' ||
                node.nodeName === 'CODE' ||
                node.nodeName === 'PRE' ||
                node.nodeName === 'TEXTAREA'
            ) {
                return;
            }

            if (node.nodeType === Node.TEXT_NODE) {
                const text = node.textContent.trim();
                if (text.length > 0) {
                    node.textContent = replaceQuotes(node.textContent);
                }
            } else {
                node.childNodes.forEach(traverseAndReplaceText);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            traverseAndReplaceText(document.body);
        });

        if (typeof MutationObserver !== 'undefined') {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === Node.ELEMENT_NODE) {
                            traverseAndReplaceText(node);
                        }
                    });
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            });
        }
    </script>

    <!-- ================= TITLE ================= -->
    <title>@yield('title')</title>

    <!-- ================= BREAKING NEWS ================= -->
    <div class="mobile">
        @include('user.components.breaking-news')
    </div>
</head>

<body id="gototop">

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0">
    </script>

    @yield('content')

    <script src="{{ asset('user/js/fixed-nav.js') }}" defer></script>
    <script src="{{ asset('user/js/photos-scroll.js') }}" defer></script>
    <script src="{{ asset('user/js/breaking-news.js') }}" defer></script>
</body>

</html>
