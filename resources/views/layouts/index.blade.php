<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Replace "..." with «...» in all text nodes and attribute values in all tags
            function replaceQuotes(str) {
                return str.replace(/"([^"]*)"/g, '«$1»');
            }

            // Replace in all text nodes
            function traverseAndReplaceText(node) {
                if (node.nodeType === Node.TEXT_NODE) {
                    node.textContent = replaceQuotes(node.textContent);
                } else {
                    node.childNodes.forEach(traverseAndReplaceText);
                }
            }
            traverseAndReplaceText(document.body);
            traverseAndReplaceText(document.head);

            // Replace in all attribute values
            document.querySelectorAll('*').forEach(function(el) {
                Array.from(el.attributes).forEach(function(attr) {
                    attr.value = replaceQuotes(attr.value);
                });
            });
        });
    </script> --}}


    <title>@yield('title')</title>
</head>

<body id="gototop">

    @yield('content')

    <script src="{{ asset('user/js/fixed-nav.js') }}"></script>
    <script src="{{ asset('user/js/photos-scroll.js') }}"></script>
</body>

</html>
