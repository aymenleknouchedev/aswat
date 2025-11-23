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


    <style>
        /* Disable touch effects globally */
        * {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        /* Allow text selection */
        input, textarea, button, a {
            user-select: auto;
            -webkit-user-select: auto;
        }

        /* Remove tap highlight on touch devices */
        @media (hover: none) and (pointer: coarse) {
            * {
            -webkit-tap-highlight-color: transparent !important;
            }
        }

        /* Loader for desktop view (min-width: 992px) */
        .loader-desktop {
            display: none;
        }

        @media (min-width: 992px) {
            .loader-desktop {
                display: flex;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #ffffff;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                animation: fadeOut 0.5s ease-in-out 2s forwards;
            }

            .loader-spinner {
                width: 50px;
                height: 50px;
                border: 5px solid #f3f3f3;
                border-top: 5px solid #3498db;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            @keyframes fadeOut {
                0% { opacity: 1; }
                100% { opacity: 0; visibility: hidden; }
            }
        }
    </style>

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

    <!-- Loader for desktop (min-width: 992px) -->
    <div class="loader-desktop">
        {{-- <div class="loader-spinner"></div> --}}
    </div>

    @yield('content')

    <script src="{{ asset('user/js/fixed-nav.js') }}"></script>
    <script src="{{ asset('user/js/photos-scroll.js') }}"></script>
</body>

</html>
