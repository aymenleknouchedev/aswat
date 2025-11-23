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

    <style>
        /* Disable tap/click visual effects globally */
        a, button, [role="button"] {
            -webkit-tap-highlight-color: transparent;
        }
        /* Neutralize :active click effects app-wide without impacting focus accessibility */
        *:active {
            opacity: 1 !important;
            transform: none !important;
            box-shadow: none !important;
        }

        /* Simple global loader */
        .app-loader {
            position: fixed;
            inset: 0;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 99999;
        }
        .app-loader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }
        .app-loader .app-spinner {
            width: 48px;
            height: 48px;
            border: 3px solid rgba(0, 0, 0, 0.12);
            border-top-color: #333333;
            border-radius: 50%;
            animation: app-spin 1s linear infinite;
        }
        @keyframes app-spin { to { transform: rotate(360deg); } }
    </style>


    <meta property="og:title" content="{{ $shareTitle ?? '' }}" />
    <meta property="og:description" content="{{ $shareDescription ?? '' }}" />
    <meta property="og:image" content="{{ isset($shareImage) ? asset($shareImage) : '' }}" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="أصوات جزائرية" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


    <script>
        document.addEventListener('DOMContentLoaded', function() {

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

            // Run only on the visible body content (not head)
            traverseAndReplaceText(document.body);
        });
    </script>



    <title>@yield('title')</title>
</head>

<body id="gototop">

    <!-- Global loader -->
    <div id="app-loader" class="app-loader" role="status" aria-live="polite" aria-label="جارِ التحميل">
        <div class="app-spinner" aria-hidden="true"></div>
    </div>

    @yield('content')

    <script src="{{ asset('user/js/fixed-nav.js') }}"></script>
    <script src="{{ asset('user/js/photos-scroll.js') }}"></script>
    <script>
        (function() {
            var loader = document.getElementById('app-loader');
            var didHide = false;

            function hideLoader() {
                if (didHide) return; // idempotent
                didHide = true;
                if (!loader) return;
                loader.classList.add('hidden');
                loader.setAttribute('aria-hidden', 'true');
            }

            function showLoader() {
                didHide = false;
                if (!loader) return;
                loader.classList.remove('hidden');
                loader.removeAttribute('aria-hidden');
            }

            // Expose simple API (for AJAX navigations if needed)
            window.AppLoader = { hide: hideLoader, show: showLoader };

            // Multiple, robust hide triggers
            // 1) As soon as DOM is interactive
            document.addEventListener('DOMContentLoaded', function() {
                // Defer one tick to allow first paint
                setTimeout(hideLoader, 0);
            });
            // 2) After all assets load (ideal)
            window.addEventListener('load', hideLoader);
            // 3) Safety fallback in case 'load' is blocked by a slow/failed asset
            setTimeout(hideLoader, 4000);
        })();
    </script>
</body>

</html>
