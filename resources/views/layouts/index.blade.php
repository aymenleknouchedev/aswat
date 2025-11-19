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

    @yield('content')

    <script src="{{ asset('user/js/fixed-nav.js') }}"></script>
    <script src="{{ asset('user/js/photos-scroll.js') }}"></script>
</body>

</html>
