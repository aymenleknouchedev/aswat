<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أفضل 10 أفلام لهاريس ديكنسون | مجموعة كريتيريون</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Use project fonts instead of Google Poppins -->
    <link rel="stylesheet" href="{{ asset('user/css/fonts.css') }}">
    <style>
        /* ==================== BASE STYLES ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'asswat-regular', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background-color: #fff;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ==================== HEADER STYLES ==================== */
        /* Hero header (scrolls away with hero) */
        header {
            background: transparent;
            backdrop-filter: none;
            color: #2c3e50;
            padding: 12px 0;
            position: absolute;
            /* inside hero, not fixed to viewport */
            width: 100%;
            z-index: 10;
            top: 0;
            left: 0;
            transition: all 0.3s ease;
            box-shadow: none;
        }

        header.scrolled {
            background: transparent;
            backdrop-filter: none;
            padding: 12px 0;
        }

        /* ==================== SECONDARY NAV (only when scrolling up past hero) ==================== */
        .scroll-navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #252525;
            /* solid white */
            padding: 14px 0;
            z-index: 1000;
            transition: transform 0.4s cubic-bezier(.4, .0, .2, 1), opacity 0.3s ease;
            transform: translateY(-110%);
            /* hidden slightly above */
            opacity: 0;
            pointer-events: none;
        }

        .scroll-navbar.visible {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }

        .logo {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.5px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            max-height: 40px;
            width: auto;
            display: block;
            transition: all 0.3s ease;
        }

        .logo-default {
            display: block !important;
        }

        .logo-scrolled {
            display: none !important;
        }

        .scroll-navbar .logo-default {
            display: none !important;
        }

        .scroll-navbar .logo-scrolled {
            display: block !important;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
            flex: 1;
            justify-content: center;
            margin: 0;
            align-items: center;
        }

        nav li {
            margin: 0;
            display: flex;
            align-items: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 0.5px;
            position: relative;
            transition: color 0.25s ease, font-weight 0.25s ease;
        }

        nav a:hover {
            color: #fff;
            /* keep text white */
            font-weight: 700;
            /* bold emphasis instead of gradient underline */
        }

        .scroll-navbar nav a {
            color: #fff;
        }

        .scroll-navbar nav a:hover {
            color: #fff;
            font-weight: 700;
        }

        /* Removed gradient underline animation */

        /* Dropdown in scroll navbar */
        .scroll-navbar .scroll-menu {
            position: relative;
        }

        .scroll-navbar .menu-toggle {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            padding: 8px 18px;
            border-radius: 28px;
            font-size: 14px;
            font-family: 'asswat-bold', 'asswat-regular', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #2c3e50;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            transition: background .25s ease, box-shadow .25s ease;
        }

        .scroll-navbar .menu-toggle:hover {
            background: #f5f7fa;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        .scroll-navbar .menu-toggle i {
            font-size: 16px;
        }

        .scroll-navbar .dropdown-menu {
            position: absolute;
            top: 110%;
            right: 0;
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 14px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            padding: 12px 0;
            min-width: 240px;
            opacity: 0;
            transform: translateY(-8px);
            pointer-events: none;
            transition: all .25s ease;
            z-index: 1200;
        }

        .scroll-navbar .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .scroll-navbar .dropdown-menu ul {
            flex-direction: column;
            gap: 4px;
        }

        .scroll-navbar .dropdown-menu ul li {
            margin: 0;
        }

        .scroll-navbar .dropdown-menu ul li a {
            color: #2c3e50;
            display: block;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            position: relative;
        }

        .scroll-navbar .dropdown-menu ul li a:hover {
            background: #f5f7fa;
            color: #667eea;
        }

        .scroll-navbar .dropdown-menu ul li.site-nav-link.active a {
            background: #eef1ff;
            color: #667eea;
            font-weight: 700;
        }

        /* Subnav inside dropdown */
        .scroll-navbar .dropdown-menu ul li .subnav-list li a {
            padding: 6px 24px;
            font-size: 13px;
            color: #445566;
            font-family: 'asswat-regular', sans-serif;
        }

        .scroll-navbar .dropdown-menu ul li .subnav-list li a:hover {
            background: #f0f3f7;
            color: #667eea;
        }

        .scroll-navbar .dropdown-menu ul li .subnav-list {
            border-top: 1px solid #f1f1f1;
            margin-top: 8px;
            padding-top: 6px;
        }

        .scroll-navbar .dropdown-menu ul li a.has-sub {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .scroll-navbar .dropdown-menu ul li a.has-sub.open .sub-arrow {
            transform: rotate(180deg);
        }

        /* Scroll navbar subnav styling */
        .scroll-navbar .site-nav-link {
            position: relative;
        }

        .scroll-navbar .site-nav-link .subnav-list {
            position: absolute;
            top: 100%;
            right: 0;
            background: #f5f5f5;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 0;
            min-width: 250px;
            list-style: none;
            margin: 8px 0 0;
            display: none;
            z-index: 50;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .1);
            flex-direction: column;
            gap: 0;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .scroll-navbar .site-nav-link .subnav-list li a {
            display: block;
            padding: 8px 18px;
            font-size: 16px;
            color: #2c3e50;
            font-family: 'asswat-regular', sans-serif;
            transition: color 0.25s ease, font-weight 0.25s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .scroll-navbar .site-nav-link .subnav-list li:last-child a {
            border-right: none;
        }

        .scroll-navbar .site-nav-link .subnav-list li a:hover {
            color: #2c3e50;
            font-weight: 700;
            background: #e8e8e8;
        }

        .scroll-navbar .site-nav-link>a.has-sub {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .scroll-navbar .site-nav-link>a.has-sub .sub-arrow {
            transition: transform .25s ease;
            font-size: 11px;
        }

        .scroll-navbar .site-nav-link>a.has-sub.open .sub-arrow {
            transform: rotate(180deg);
        }

        /* Active state for inline hero nav */
        header .site-nav-links {
            gap: 20px;
        }

        header .site-nav-link a {
            padding: 4px 6px;
        }

        header .site-nav-link.active a {
            color: #fff;
            font-weight: 700;
        }

        /* Hero header subnav dropdown (inline) */
        header .site-nav-link {
            position: relative;
        }

        header .site-nav-link .subnav-list {
            position: absolute;
            top: 100%;
            right: 0;
            background: #f5f5f5;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 0;
            min-width: 250px;
            list-style: none;
            margin: 8px 0 0;
            display: none;
            z-index: 50;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .1);
            flex-direction: column;
            gap: 0;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        header .site-nav-link .subnav-list li a {
            display: block;
            padding: 8px 18px;
            font-size: 16px;
            color: #2c3e50;
            font-family: 'asswat-regular', sans-serif;
            width: 100%;
            box-sizing: border-box;
        }

        header .site-nav-link .subnav-list li:last-child a {
            border-right: none;
        }

        header .site-nav-link .subnav-list li a:hover {
            background: #e8e8e8;
            color: #2c3e50;
            font-weight: 700;
        }

        header .site-nav-link>a.has-sub {
            display: flex;
            align-items: center;
            gap: 6px;
            height: 100%;
        }

        header .site-nav-link>a.has-sub .sub-arrow {
            transition: transform .25s ease;
            font-size: 11px;
        }

        header .site-nav-link>a.has-sub.open .sub-arrow {
            transform: rotate(180deg);
        }

        /* ==================== HERO SECTION ==================== */
        .split-hero {
            display: flex;
            height: 100vh;
            position: relative;
            overflow: hidden;
            margin-top: 0;
        }

        .hero-image {
            flex: 1;
            display: flex;
            align-items: stretch;
            justify-content: stretch;
            overflow: hidden;
            position: relative;
        }

        .hero-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.3) 0%, transparent 100%);
            z-index: 2;
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .hero-content {
            flex: 1;
            background: #252525;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0;
            position: relative;
            z-index: 3;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 600;
            font-family: 'asswat-bold', 'asswat-regular', sans-serif;
            line-height: 1.2;
            position: relative;
            z-index: 1;
            letter-spacing: -1px;
            max-width: 100%;
            padding: 0 20px;
        }

        .hero-content p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 35px;
            max-width: 90%;
            padding: 0 20px;
            position: relative;
            z-index: 1;
            line-height: 1.7;
        }

        .actor-info {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
            padding-left: 20px;
            padding-right: 20px;
        }

        .actor-name {
            font-size: 20px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .actor-films {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }

        /* ==================== CONTENT SECTION ==================== */
        .content {
            padding: 80px 0;
            background-color: inherit;
        }

        .intro {
            max-width: 850px;
            margin: 0 auto 60px;
            font-size: 17px;
            line-height: 1.9;
            text-align: justify;
            color: #555;
            font-weight: 300;
        }

        /* ==================== FILM LIST STYLES ==================== */
        .film-list {
            counter-reset: film-counter;
        }

        .film-item {
            display: flex;
            margin-bottom: 60px;
            position: relative;
            gap: 40px;
            padding: 40px;
            border-radius: 0;
            background: #fff;
            border: 0;
        }

        /* Left side: Photo and button */
        .film-left {
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .film-poster {
            width: 220px;
            border-radius: 0;
            overflow: hidden;
        }

        .film-poster img {
            width: 100%;
            height: auto;
            display: block;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .film-button {
            display: inline-block;
            padding: 10px 20px;
            background: #fff;
            color: #252525;
            text-decoration: none;
            border-radius: 0;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        .film-button.hidden {
            display: none;
        }

        /* Right side: Content */
        .film-right {
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .film-number {
            font-size: 48px;
            font-weight: 900;
            color: rgb(205, 205, 203);
            margin-bottom: 10px;
            line-height: 1;
        }

        .film-number::before {
            content: counter(film-counter);
            counter-increment: film-counter;
        }

        .film-writer {
            font-size: 14px;
            color: #888;
            margin-bottom: 12px;
            font-weight: 500;
            font-family: 'asswat-regular', sans-serif;
        }

        .film-writer.hidden {
            display: none;
        }

        .film-title {
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 700;
            font-family: 'asswat-bold', 'asswat-regular', sans-serif;
            color: #2c3e50;
        }

        .film-description {
            font-size: 15px;
            line-height: 1.8;
            text-align: justify;
            color: #555;
            font-weight: 300;
        }

        .film-metadata {
            display: flex;
            gap: 25px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
            font-size: 14px;
            color: #666;
            flex-wrap: wrap;
        }

        .film-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .rating {
            color: #ffc107;
            font-weight: 700;
        }

        /* ==================== BACK TO TOP BUTTON ==================== */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            z-index: 999;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }

        .film-item.highlight {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        }

        /* ==================== FOOTER STYLES ==================== */
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #1a2332 100%);
            color: #fff;
            padding: 50px 0 20px;
            text-align: center;
            font-size: 14px;
        }

        .footer-links {
            margin-bottom: 25px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .footer-links a:hover {
            color: #667eea;
        }

        .copyright {
            color: rgba(255, 255, 255, 0.6);
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* ==================== RESPONSIVE STYLES ==================== */
        @media (max-width: 768px) {
            .split-hero {
                flex-direction: column;
                height: auto;
                margin-top: 0;
            }

            .hero-image {
                height: 350px;
            }

            .hero-content {
                padding: 40px;
            }

            .hero-content h1 {
                font-size: 32px;
            }

            .hero-content p {
                font-size: 16px;
            }

            .film-item {
                flex-direction: column;
                padding: 30px;
                margin-bottom: 60px;
            }

            .film-poster {
                width: 100%;
            }

            .film-number {
                right: -20px;
                top: -15px;
                font-size: 80px;
            }

            nav ul {
                gap: 15px;
            }

            nav a {
                font-size: 12px;
            }

            .back-to-top {
                bottom: 20px;
                left: 20px;
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .content {
                padding: 60px 0;
            }

            .header-content {
                gap: 15px;
            }

            nav ul {
                display: none;
            }
        }

        /* ==================== ANIMATIONS ==================== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .film-item {
            animation: fadeIn 0.6s ease forwards;
        }

        .film-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .film-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .film-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .film-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        .film-item:nth-child(5) {
            animation-delay: 0.5s;
        }

        .film-item:nth-child(6) {
            animation-delay: 0.6s;
        }

        .film-item:nth-child(7) {
            animation-delay: 0.7s;
        }

        .film-item:nth-child(8) {
            animation-delay: 0.8s;
        }

        .film-item:nth-child(9) {
            animation-delay: 0.9s;
        }

        .film-item:nth-child(10) {
            animation-delay: 1s;
        }
    </style>
</head>

<body>

    <section class="split-hero">
        <header id="main-header">
            <div class="container">
                <div class="header-content">
                    <a href="/" class="logo">
                        <img class="logo-default" src="{{ asset('user/assets/images/white_logo.svg') }}" alt="Logo"
                            style="height: 40px;">
                        <img class="logo-scrolled" src="{{ asset('user/assets/images/white_logo.svg') }}" alt="Logo"
                            style="height: 40px; display: none;">
                    </a>
                    <nav>
                        <ul class="site-nav-links">
                            <li class="site-nav-link {{ request()->routeIs('latestNews') ? 'active' : '' }}"
                                id="hero-show-subnav">
                                <a href="{{ route('latestNews') }}" class="has-sub" aria-expanded="false">أخبار <i
                                        class="fa-solid fa-chevron-down sub-arrow"></i></a>
                                <ul class="subnav-list">
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'algeria']) }}">الجزائر</a></li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'world']) }}">عالم</a></li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'economy']) }}">اقتصاد</a></li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'sports']) }}">رياضة</a></li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'people']) }}">ناس</a></li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'culture']) }}">ثقافة وفنون</a>
                                    </li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'technology']) }}">تكنولوجيا</a>
                                    </li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'health']) }}">صحة</a></li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'environment']) }}">بيئة</a>
                                    </li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'media']) }}">ميديا</a></li>
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'variety']) }}">منوعات</a></li>
                                </ul>
                            </li>
                            <li class="site-nav-link {{ request()->routeIs('reviews') ? 'active' : '' }}">
                                <a href="{{ route('reviews') }}">آراء</a>
                            </li>
                            <li class="site-nav-link {{ request()->routeIs('windows') ? 'active' : '' }}">
                                <a href="{{ route('windows') }}">نوافذ</a>
                            </li>
                            <li class="site-nav-link {{ request()->routeIs('files') ? 'active' : '' }}">
                                <a href="{{ route('files') }}">ملفات</a>
                            </li>
                            <li class="site-nav-link {{ request()->routeIs('investigation') ? 'active' : '' }}">
                                <a href="{{ route('investigation') }}">فحص</a>
                            </li>
                            <li class="site-nav-link {{ request()->routeIs('videos') ? 'active' : '' }}">
                                <a href="{{ route('videos') }}">فيديو</a>
                            </li>
                            <li class="site-nav-link {{ request()->routeIs('podcasts') ? 'active' : '' }}">
                                <a href="{{ route('podcasts') }}">بودكاست</a>
                            </li>
                            <li class="site-nav-link {{ request()->routeIs('photos') ? 'active' : '' }}">
                                <a href="{{ route('photos') }}">صور</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <div class="hero-image">
            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                alt="هاريس ديكنسون" />
        </div>
        <div class="hero-content">
            <h1>أفضل 10 أفلام لهاريس ديكنسون</h1>
            <p>يختار ممثل فيلم "مثلث الحزن" عشرة أفلام من مجموعة كريتيريون ساهمت في تشكيل فهمه للسينما.</p>

            <div class="actor-info">
                <div class="actor-name">هاريس ديكنسون</div>
                <div class="actor-films">مثلث الحسن، فئران الشاطئ، القبضة الحديدية</div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="intro">
                <p>هاريس ديكنسون، الممثل البريطاني المعروف بأدواره في أفلام "مثلث الحزن" و"فئران الشاطئ" و"القبضة
                    الحديدية"، يشاركنا مجموعته الشخصية من أفلام كريتيريون التي أثرت في مهنته وحسه السينمائي. في هذه
                    القائمة، يستعرض ديكنسون الأفلام التي شكلت نظرته للفن السابع وألهمت مسيرته المهنية.</p>
            </div>

            <!-- Secondary navbar (appears only when scrolling UP past hero) -->
            <nav id="scroll-navbar" class="scroll-navbar">
                <div class="container">
                    <div class="header-content">
                        <a href="/" class="logo">
                            <img class="logo-default" src="{{ asset('user/assets/images/white_logo.svg') }}"
                                alt="Logo" style="height: 40px;">
                            <img class="logo-scrolled" src="{{ asset('user/assets/images/white_logo.svg') }}"
                                alt="Logo" style="height: 40px; display: none;">
                        </a>
                        <nav>
                            <ul class="site-nav-links">
                                <li class="site-nav-link {{ request()->routeIs('latestNews') ? 'active' : '' }}"
                                    id="scroll-show-subnav">
                                    <a href="{{ route('latestNews') }}" class="has-sub" aria-expanded="false">أخبار <i
                                            class="fa-solid fa-chevron-down sub-arrow"></i></a>
                                    <ul class="subnav-list">
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'algeria']) }}">الجزائر</a>
                                        </li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'world']) }}">عالم</a></li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'economy']) }}">اقتصاد</a>
                                        </li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'sports']) }}">رياضة</a>
                                        </li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'people']) }}">ناس</a></li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'culture']) }}">ثقافة
                                                وفنون</a></li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'technology']) }}">تكنولوجيا</a>
                                        </li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'health']) }}">صحة</a></li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'environment']) }}">بيئة</a>
                                        </li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'media']) }}">ميديا</a>
                                        </li>
                                        <li class="site-subnav-link"><a
                                                href="{{ route('newSection', ['section' => 'variety']) }}">منوعات</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="site-nav-link {{ request()->routeIs('reviews') ? 'active' : '' }}">
                                    <a href="{{ route('reviews') }}">آراء</a>
                                </li>
                                <li class="site-nav-link {{ request()->routeIs('windows') ? 'active' : '' }}">
                                    <a href="{{ route('windows') }}">نوافذ</a>
                                </li>
                                <li class="site-nav-link {{ request()->routeIs('files') ? 'active' : '' }}">
                                    <a href="{{ route('files') }}">ملفات</a>
                                </li>
                                <li class="site-nav-link {{ request()->routeIs('investigation') ? 'active' : '' }}">
                                    <a href="{{ route('investigation') }}">فحص</a>
                                </li>
                                <li class="site-nav-link {{ request()->routeIs('videos') ? 'active' : '' }}">
                                    <a href="{{ route('videos') }}">فيديو</a>
                                </li>
                                <li class="site-nav-link {{ request()->routeIs('podcasts') ? 'active' : '' }}">
                                    <a href="{{ route('podcasts') }}">بودكاست</a>
                                </li>
                                <li class="site-nav-link {{ request()->routeIs('photos') ? 'active' : '' }}">
                                    <a href="{{ route('photos') }}">صور</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </nav>

            <div class="film-list">
                <!-- Film 1 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج إنغمار برغمان</p>
                        <h2 class="film-title">الختم السابع</h2>
                        <p class="film-description">يعود فارس من الحروب الصليبية ليجد وطنه مدمرًا بالطاعون. يتحدى الموت
                            في مباراة شطرنج من أجل حياته، وينطلق في رحلة عبر مشاهد طاعونية. تستكشف تحفة برغمان أسئلة
                            عميقة حول الإيمان والموت ووجود الله.</p>
                    </div>
                </div>

                <!-- Film 2 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج فيم فيندرز</p>
                        <h2 class="film-title">باريس، تكساس</h2>
                        <p class="film-description">يخرج رجل من الصحراء بعد غياب أربع سنوات ويحاول إعادة الاتصال بابنه
                            الصغير وزوجته التي تركها خلفه. يستكشف فيلم فيندرز الطريق المؤثر موضوعات الاغتراب والذاكرة
                            والمشهد الأمريكي بتصوير سينمائي مذهل وأداء مفعم بالمشاعر لهاري دين ستانتون.</p>
                    </div>
                </div>

                <!-- Film 3 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج جون كاسافيتيس</p>
                        <h2 class="film-title">امرأة تحت التأثير</h2>
                        <p class="film-description">تؤدي سلوكيات المرأة غير التقليدية إلى إيداعها في مؤسسة عقلية، تاركة
                            زوجها لرعاية أطفالهما. تقدم جينا رولاندز أداءً استثنائيًا في فيلم كاسافيتيس الذي يفحص بصراحة
                            الزواج والصحة العقلية والتوقعات المجتمعية.</p>
                    </div>
                </div>

                <!-- Film 4 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج ستانلي كوبريك</p>
                        <h2 class="film-title">باري ليندون</h2>
                        <p class="film-description">يستخدم محتال أيرلندي دهاءه وذكاءه للصعود في الطبقات الاجتماعية
                            للمجتمع الإنجليزي في القرن الثامن عشر. ملحمة كوبريك المرئية المذهلة، التي تم تصويرها بالكامل
                            بإضاءة طبيعية وعدسات مناسبة للعصر، هي فحص دقيق للطبقة والمصير والسعي وراء المكانة.</p>
                    </div>
                </div>

                <!-- Film 5 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج فرانسوا تروفو</p>
                        <h2 class="film-title">الـ400 ضربة</h2>
                        <p class="film-description">صبي صغير في باريس، مهمل من قبل والديه، يلجأ إلى حياة الجريمة
                            الصغيرة. أصبح فيلم تروفو شبه السيرة الذاتية الأول علامة بارزة في الموجة الفرنسية الجديدة،
                            حيث يلتقط براءة وخيبة أمل الشباب بحساسية ملحوظة.</p>
                    </div>
                </div>

                <!-- Film 6 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج سبايك لي</p>
                        <h2 class="film-title">افعل الصواب</h2>
                        <p class="film-description">في أشد أيام السنة حرارة في حي في بروكلين، تصل التوترات العرقية إلى
                            نقطة الغليان. تظل تحفة لي النابضة بالحياة والمثيرة للتفكير ذات صلة اليوم كما كانت عند
                            إصدارها، مستكشفة قضايا معقدة حول العرق والمجتمع والعدالة الاجتماعية.</p>
                    </div>
                </div>

                <!-- Film 7 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج إنغمار برغمان</p>
                        <h2 class="film-title">بيرسونا</h2>
                        <p class="film-description">يتم تكليف ممرضة برعاية ممثلة توقفت فجأة عن الكلام، وتتراجع المرأتان
                            إلى كوخ في جزيرة نائية حيث تبدأ هوياتهما في الاندماج. الدراما النفسية لبرغمان هي استكشاف
                            رائد للهوية والأداء وطبيعة الذات.</p>
                    </div>
                </div>

                <!-- Film 8 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج بيتر بوجدانوفيتش</p>
                        <h2 class="film-title">آخر عرض سينمائي</h2>
                        <p class="film-description">في بلدة تكساس صغيرة تحتضر في الخمسينيات، يبلغ طالبان في المدرسة
                            الثانوية سن الرشد وسط أوضاع متغيرة. يلتقط فيلم بوجدانوفيتش الحزين المصور بالأبيض والأسود
                            الجميل نهاية حقبة بأداء ملحوظ وإحساس عميق بالحنين.</p>
                    </div>
                </div>

                <!-- Film 9 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج مايكل باول وإيميريك Pressburger</p>
                        <h2 class="film-title">الحذاء الأحمر</h2>
                        <p class="film-description">راقصة باليه شابة تمزقها بين حبها لملحن وتفانيها لفنها. تحفة باول
                            وPressburger بتقنية التكنيكولور هي واحدة من أجمل الأفلام على الإطلاق، اندماج مبهر للرقص
                            والموسيقى والسينما يستكشف التضحيات التي تتطلبها الشغف الفني.</p>
                    </div>
                </div>

                <!-- Film 10 -->
                <div class="film-item">
                    <div class="film-left">
                        <div class="film-poster">
                            <img src="https://www.burgkino.at/sites/default/files/images/2025/one-battle-after-another-15963_19.jpg"
                                alt="ملصق الفيلم">
                        </div>
                        <a href="#" class="film-button">اقرأ المزيد</a>
                    </div>
                    <div class="film-right">
                        <div class="film-number"></div>
                        <p class="film-writer hidden">إخراج جيلو بونتيكورفو</p>
                        <h2 class="film-title">معركة الجزائر</h2>
                        <p class="film-description">إعادة بناء للأحداث خلال حرب الاستقلال الجزائرية، مع التركيز على
                            تنظيم حركة حرب العصابات والأساليب التي استخدمتها القوات الاستعمارية الفرنسية لكسرها. لا يزال
                            فيلم بونتيكورفو ذو الأسلوب الوثائقي قويًا ومؤثرًا في فحص الثورة والإرهاب والمقاومة
                            الاستعمارية.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('user.components.footer')

    <!-- Back to top button -->
    <div class="back-to-top" id="backToTop">↑</div>

    <script>
        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            initFilmInteractions();
            initHeaderScroll();
            initBackToTop();
            initHeroSubnav();
            initScrollSubnav();
        });

        // Film items hover effects
        function initFilmInteractions() {
            const filmItems = document.querySelectorAll('.film-item');

            filmItems.forEach((item, index) => {
                item.setAttribute('data-film-index', index + 1);

                // Click to highlight
                item.addEventListener('click', function() {
                    filmItems.forEach(el => el.classList.remove('highlight'));
                    this.classList.add('highlight');
                });
            });
        }

        // Hero header subnav logic
        function initHeroSubnav() {
            const heroNewsLink = document.querySelector('#hero-show-subnav > a.has-sub');
            const heroSubnav = document.querySelector('#hero-show-subnav .subnav-list');
            if (!heroNewsLink || !heroSubnav) return;
            heroNewsLink.addEventListener('click', function(e) {
                e.preventDefault();
                const opened = this.classList.contains('open');
                this.classList.toggle('open', !opened);
                this.setAttribute('aria-expanded', (!opened).toString());
                heroSubnav.style.display = opened ? 'none' : 'block';
            });
            // Close if clicking elsewhere
            document.addEventListener('click', function(e) {
                if (!heroSubnav.contains(e.target) && !heroNewsLink.contains(e.target)) {
                    heroSubnav.style.display = 'none';
                    heroNewsLink.classList.remove('open');
                    heroNewsLink.setAttribute('aria-expanded', 'false');
                }
            });
        }
        // Subnav toggle logic for scroll navbar
        function initScrollSubnav() {
            const scrollNewsLink = document.querySelector('#scroll-show-subnav > a.has-sub');
            const scrollSubnav = document.querySelector('#scroll-show-subnav .subnav-list');
            if (!scrollNewsLink || !scrollSubnav) return;
            scrollNewsLink.addEventListener('click', function(e) {
                e.preventDefault();
                const opened = this.classList.contains('open');
                this.classList.toggle('open', !opened);
                this.setAttribute('aria-expanded', (!opened).toString());
                scrollSubnav.style.display = opened ? 'none' : 'block';
            });
            // Close if clicking elsewhere
            document.addEventListener('click', function(e) {
                if (!scrollSubnav.contains(e.target) && !scrollNewsLink.contains(e.target)) {
                    scrollSubnav.style.display = 'none';
                    scrollNewsLink.classList.remove('open');
                    scrollNewsLink.setAttribute('aria-expanded', 'false');
                }
            });
        }
        // Dropdown toggle logic for secondary scroll navbar
        function initDropdownMenu() {
            const toggle = document.querySelector('.scroll-navbar .menu-toggle');
            const menu = document.querySelector('.scroll-navbar .dropdown-menu');
            if (!toggle || !menu) return;

            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', (!expanded).toString());
                menu.classList.toggle('show', !expanded);
            });

            // Close on outside click
            document.addEventListener('click', function(e) {
                if (!menu.contains(e.target) && !toggle.contains(e.target)) {
                    menu.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Close on escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    menu.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Subnav (News sections) toggle
            const newsLink = menu.querySelector('#site-show-subnav > a.has-sub');
            const subnavList = menu.querySelector('#site-show-subnav .subnav-list');
            if (newsLink && subnavList) {
                newsLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    const opened = this.classList.contains('open');
                    this.classList.toggle('open', !opened);
                    this.setAttribute('aria-expanded', (!opened).toString());
                    subnavList.style.display = opened ? 'none' : 'block';
                });
            }
        }

        // Scroll logic: show secondary nav only when scrolling UP past hero
        function initHeaderScroll() {
            const heroSection = document.querySelector('.split-hero');
            const scrollNavbar = document.getElementById('scroll-navbar');
            const heroHeight = heroSection ? heroSection.offsetHeight : 0;
            let lastY = window.scrollY;
            const UP_THRESHOLD = 4; // pixels of upward movement before showing
            const DOWN_HIDE_DELAY = 0; // immediate hide on down scroll

            window.addEventListener('scroll', () => {
                const y = window.scrollY;
                const delta = y - lastY;
                const scrollingDown = delta > 0;

                // Hide while inside hero
                if (y < heroHeight) {
                    scrollNavbar.classList.remove('visible');
                } else {
                    if (!scrollingDown && Math.abs(delta) > UP_THRESHOLD) {
                        // Upward scroll beyond threshold past hero
                        scrollNavbar.classList.add('visible');
                    } else if (scrollingDown && Math.abs(delta) > DOWN_HIDE_DELAY) {
                        scrollNavbar.classList.remove('visible');
                    }
                }

                lastY = y;
            });
        }

        // Back to top button functionality
        function initBackToTop() {
            const backToTopBtn = document.getElementById('backToTop');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            });

            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Add animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
