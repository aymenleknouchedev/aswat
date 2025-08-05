<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('public/user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/fixed-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/section-title.css') }}">

    <title>@yield('title')</title>
</head>

<body id="gototop">

    @yield('content')

    <script src="{{ asset('public/user/js/fixed-nav.js') }}"></script>
    <script src="{{ asset('public/user/js/photos-scroll.js') }}"></script>
</body>

</html>
