<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('user/assets/images/icon-logo.svg') }}" />

    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/fixed-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/section-title.css') }}">


    <meta property="og:title" content="{{ $shareTitle ?? '' }}" />
    <meta property="og:description" content="{{ $shareDescription ?? '' }}" />
    <meta property="og:image" content="{{ isset($shareImage) ? asset($shareImage) : '' }}" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="أصوات جزائرية" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('user/css/breaking-news.css') }}">

    <style>
        * {
            -webkit-tap-highlight-color: transparent;
        }

        /* Hide TinyMCE Facebook placeholder text/URL on the public site */
        .fb-embed-block .fb-embed-title,
        .fb-embed-block .fb-embed-url {
            display: none;
        }

        /* Add vertical spacing around Facebook embeds */
        .fb-embed-block {
            margin: 1.5rem 0;
            cursor: pointer;
            position: relative;
        }

        /* Disable all interactions with Facebook iframe */
        .fb-embed-block iframe,
        .fb-embed-block .fb-post,
        .fb-embed-block .fb-post * {
            pointer-events: none !important;
        }
    </style>

    <!-- Load Twitter/X Embed Script -->
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" onload="console.log('Twitter script loaded')"></script>

    <!-- Load Instagram Embed Script -->
    <script async src="https://www.instagram.com/embed.js" onload="console.log('Instagram script loaded')"></script>

    <script>
        // Wait for Twitter widget to be ready
        window.addEventListener('load', function() {
            console.log('Page loaded - checking for embed scripts');
            if (window.twttr) {
                console.log('Twitter object found');
                if (window.twttr.ready) {
                    window.twttr.ready(function(twttr) {
                        console.log('Twitter ready callback');
                        if (window.processEmbeds) {
                            window.processEmbeds();
                        }
                    });
                }
            }
        });
    </script>

    <script>
        // Make Facebook embeds clickable to redirect to Facebook
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
    <script>
        // Replace "..." with «...» inside visible text only
        function replaceQuotes(str) {
            return str.replace(/"([^"]*)"/g, '«$1»');
        }

        // Traverse text nodes inside visible elements
        function traverseAndReplaceText(node) {
            // Skip script, style, code, pre, textarea, etc.
            if (
                node.nodeName === 'SCRIPT' ||
                node.nodeName === 'STYLE' ||
                node.nodeName === 'CODE' ||
                node.nodeName === 'PRE' ||
                node.nodeName === 'TEXTAREA'
            ) {
                return;
            }

            // Replace text content
            if (node.nodeType === Node.TEXT_NODE) {
                const text = node.textContent.trim();
                // Replace only if it's visible text (not empty)
                if (text.length > 0) {
                    node.textContent = replaceQuotes(node.textContent);
                }
            } else {
                node.childNodes.forEach(traverseAndReplaceText);
            }
        }

        // Run on initial page load
        document.addEventListener('DOMContentLoaded', function() {
            traverseAndReplaceText(document.body);
        });

        // Observe DOM changes for dynamically added content (like modals)
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

            // Start observing when DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            });
        }
    </script>



    <title>@yield('title')</title>

    <div class="mobile">
        <!-- Breaking News Modal Component -->
        @include('user.components.breaking-news')
    </div>
</head>

<body id="gototop">

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0"></script>

    @yield('content')
    <script src="{{ asset('user/js/fixed-nav.js') }}"></script>
    <script src="{{ asset('user/js/photos-scroll.js') }}"></script>
    <script src="{{ asset('user/js/breaking-news.js') }}"></script>
</body>

</html>
