<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ================= SEO META ================= -->
    <meta name="description"
        content="@yield('meta_description', 'موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين، ينقل أخبار الجزائر لحظة بلحظة.')">

    <meta name="keywords"
        content="@yield('meta_keywords', 'أصوات جزائرية, أصوات, أخبار الجزائر، أخبار جزائرية، أخبار عاجلة، الجزائر، السياسة في الجزائر، الاقتصاد الجزائري، رياضة جزائرية، المجتمع الجزائري، الثقافة الجزائرية، الإعلام الجزائري، الصحافة الجزائرية، أخبار اليوم الجزائر، أخبار محلية، أخبار وطنية، أخبار دولية، صوت الجزائر، asswatdjazairira, asswat, djazair, algeriavoices, algeria, algerian news, algeria news today, breaking news algeria, algeria politics, algeria economy, algeria sports, algerian media, arabic news, north africa news, maghreb news, dz news, dz media')">

    <meta name="author" content="أصوات جزائرية">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
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

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('meta_og_title', 'أصوات جزائرية')" />
    <meta property="og:description" content="@yield('meta_og_description', 'موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين.')" />
    <meta property="og:image" content="@yield('meta_og_image', asset('covergoogle.png'))" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="أصوات جزائرية" />
    <meta property="og:locale" content="ar_DZ" />

    <!-- ================= TWITTER / X ================= -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_twitter_title', 'أصوات جزائرية')">
    <meta name="twitter:description"
        content="@yield('meta_twitter_description', 'موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين.')">
    <meta name="twitter:image" content="@yield('meta_twitter_image', asset('covergoogle.png'))">
    <meta name="twitter:site" content="@asswatdjazairia">

    <!-- ================= SOCIAL LINKS ================= -->
    <link rel="me" href="https://x.com/asswatdjazairia">
    <link rel="me" href="https://instagram.com/asswatdjazairia">
    <meta property="article:publisher" content="https://web.facebook.com/asswatdjazairia">

    <!-- ================= SEO: SITEMAP & FEEDS ================= -->
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">

    <!-- Per-page injected SEO (JSON-LD, article meta) -->
    @stack('seo')

    <!-- ================= ICONS & EXTRA STYLES ================= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('user/css/breaking-news.css') }}">

    <!-- ================= INLINE STYLES ================= -->
    <style>
        * {
            -webkit-tap-highlight-color: transparent;
        }

        img {
            -webkit-user-drag: none;
        }

        /* Generic fade-in for images after they finish loading */
        img.img-fade {
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        img.img-fade.img-fade-in {
            opacity: 1;
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

        /* Hide raw fb-post/fb-video blockquote until Facebook SDK renders */
        .fb-embed-block .fb-post,
        .fb-embed-block .fb-video {
            visibility: hidden;
            height: 0;
            overflow: hidden;
        }

        /* Show once Facebook SDK has processed it (adds iframe) */
        .fb-embed-block .fb-post.fb_iframe_widget,
        .fb-embed-block .fb-video.fb_iframe_widget,
        .fb-embed-block .fb_iframe_widget {
            visibility: visible !important;
            height: auto !important;
            overflow: visible !important;
        }

        /* Fallback link card shown when SDK fails to render the embed */
        .fb-embed-block.embed-fallback .fb-post,
        .fb-embed-block.embed-fallback .fb-video,
        .x-embed-block.embed-fallback blockquote.twitter-tweet,
        .ig-embed-block.embed-fallback blockquote.instagram-media {
            display: none !important;
        }
        .fb-embed-block.embed-fallback .fb-embed-title,
        .fb-embed-block.embed-fallback .fb-embed-url,
        .x-embed-block.embed-fallback .x-embed-title,
        .x-embed-block.embed-fallback .x-embed-url,
        .ig-embed-block.embed-fallback .ig-embed-title,
        .ig-embed-block.embed-fallback .ig-embed-url {
            display: block !important;
        }
        .embed-fallback {
            border: 1px solid #e2e2e2;
            border-radius: 8px;
            padding: 16px;
            background: #fafafa;
            text-align: right;
            direction: rtl;
        }
        .embed-fallback .fb-embed-title,
        .embed-fallback .x-embed-title,
        .embed-fallback .ig-embed-title {
            font-weight: 600;
            margin-bottom: 6px;
        }
        .embed-fallback .fb-embed-url,
        .embed-fallback .x-embed-url,
        .embed-fallback .ig-embed-url {
            color: #1877f2;
            word-break: break-all;
            font-size: 14px;
        }

        .fb-embed-block iframe,
        .fb-embed-block .fb-post *:not(iframe),
        .fb-embed-block .fb-video *:not(iframe) {
            pointer-events: none !important;
        }
    </style>

    <!-- ================= INSTAGRAM ================= -->
    <script async src="https://www.instagram.com/embed.js" onload="console.log('Instagram script loaded')"></script>

    <!-- ================= X (TWITTER) ================= -->
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" onload="console.log('Twitter widgets.js loaded')"></script>
    <style>
        /* Hide placeholder text */
        .x-embed-block .x-embed-title,
        .x-embed-block .x-embed-url {
            display: none;
        }

        .x-embed-block {
            margin: 1.5rem 0;
            cursor: pointer;
            position: relative;
        }

        /* Hide raw blockquote until widgets.js renders the iframe */
        blockquote.twitter-tweet {
            display: none !important;
        }

        /* Hide raw Instagram blockquote until embed.js renders */
        blockquote.instagram-media {
            display: none !important;
        }

        /* Show Instagram once embed.js processes it into iframe */
        .instagram-media-rendered,
        iframe.instagram-media {
            display: block !important;
        }

        /* Hide Instagram placeholder text on frontend */
        .ig-embed-block .ig-embed-title,
        .ig-embed-block .ig-embed-url {
            display: none;
        }

        .ig-embed-block {
            margin: 1.5rem 0;
        }
    </style>

    <!-- ================= SOCIAL EMBED CLICK HANDLERS ================= -->
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

                // X (Twitter) embed click handler
                const xBlock = e.target.closest('.x-embed-block');
                if (xBlock) {
                    const xUrl = xBlock.getAttribute('data-x-url');
                    if (xUrl) {
                        window.open(xUrl, '_blank');
                    }
                }

                // Instagram embed click handler
                const igBlock = e.target.closest('.ig-embed-block');
                if (igBlock) {
                    const igUrl = igBlock.getAttribute('data-ig-url');
                    if (igUrl) {
                        window.open(igUrl, '_blank');
                    }
                }
            });
        });
    </script>

    <!-- ================= QUOTES REPLACER ================= -->
    <script>
        const EMBED_SKIP_SELECTOR =
            '.fb-embed-block, .x-embed-block, .ig-embed-block, ' +
            '.fb-post, .fb-video, .fb-page, ' +
            'blockquote.twitter-tweet, blockquote.instagram-media, blockquote.fb-xfbml-parse-ignore, ' +
            '[class*="fb_iframe_widget"], iframe';

        function replaceQuotes(str) {
            return str.replace(/"([^"]*)"/g, '«$1»');
        }

        function isInsideEmbed(node) {
            const el = node.nodeType === Node.ELEMENT_NODE ? node : node.parentElement;
            return !!(el && el.closest && el.closest(EMBED_SKIP_SELECTOR));
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

            if (node.nodeType === Node.ELEMENT_NODE && node.matches && node.matches(EMBED_SKIP_SELECTOR)) {
                return;
            }

            if (node.nodeType === Node.TEXT_NODE) {
                if (isInsideEmbed(node)) return;
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
                            if (node.matches && node.matches(EMBED_SKIP_SELECTOR)) return;
                            if (isInsideEmbed(node)) return;
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

    <!-- ================= DISABLE IMAGE RIGHT-CLICK & DRAG ================= -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent right-click on images only
            document.addEventListener('contextmenu', function(e) {
                if (e.target.tagName === 'IMG') {
                    e.preventDefault();
                }
            });

            // Prevent dragging images
            document.addEventListener('dragstart', function(e) {
                if (e.target.tagName === 'IMG') {
                    e.preventDefault();
                }
            });
        });
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
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v21.0">
    </script>

    @yield('content')

    {{-- Global lazy-loading + show images only after they finish loading --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var supportsNativeLazy = 'loading' in HTMLImageElement.prototype;

            document.querySelectorAll('img').forEach(function(img) {
                // Skip images explicitly marked as eager
                if (img.dataset.loading !== 'eager' && supportsNativeLazy && !img.hasAttribute('loading')) {
                    img.setAttribute('loading', 'lazy');
                }

                // Start hidden, then reveal on load/error
                img.classList.add('img-fade');

                function reveal() {
                    img.classList.add('img-fade-in');
                }

                // Already loaded (from cache, etc.)
                if (img.complete && img.naturalWidth > 0) {
                    reveal();
                } else {
                    img.addEventListener('load', reveal, {
                        once: true
                    });
                    // Also reveal on error so broken images don't stay invisible
                    img.addEventListener('error', reveal, {
                        once: true
                    });
                }
            });
        });
    </script>

    <script src="{{ asset('user/js/fixed-nav.js') }}"></script>
    <script src="{{ asset('user/js/photos-scroll.js') }}"></script>
    <script src="{{ asset('user/js/breaking-news.js') }}"></script>
</body>

</html>
