<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title', 'أصوات جزائرية | ' . $news->mobile_title)
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Use project fonts instead of Google Poppins -->
    <link rel="stylesheet" href="{{ asset('user/css/fonts.css') }}">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.intro a').forEach(function(el) {
                el.setAttribute('target', '_blank');
                el.setAttribute('rel', 'noopener');
            });
        });
    </script>

    <style>
        /* ==================== BASE STYLES ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'asswat-regular', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background-color: #fff;
            overflow-x: hidden;
        }

        body.has-admin-bar {
            padding-top: 0px;
        }

        .container {
            max-width: 1208px;
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
            background: rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        .hero-image img {
            width: 100%;
            object-fit: cover;
            display: block;
        }

        .hero-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.175);
            color: #fff;
            font-size: 14px;
            padding: 12px 20px;
            margin: 0;
            text-align: right;
            direction: rtl;
            font-family: asswat-regular;
            z-index: 3;
            line-height: 1.5;
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
            font-weight: 600;
            font-family: 'asswat-bold', 'asswat-regular', sans-serif;
            line-height: 1.2;
            position: relative;
            z-index: 1;
            letter-spacing: -1px;
            max-width: 100%;
            padding: 40px 60px;
        }

        .hero-content p {
            font-size: 18px;
            color: rgb(130, 130, 130);
            margin-bottom: 35px;
            max-width: 90%;
            padding: 0 20px;
            position: relative;
            z-index: 1;
            line-height: 1.7;
        }

        .actor-info {
            position: relative;
            z-index: 1;
            padding-left: 20px;
            padding-right: 20px;
        }

        .actor-name {
            font-size: 16px;
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
            max-width: 587px;
            margin: 0 auto 60px;
            font-size: 16px !important;
            font-family: asswat-regular;
            color: #000000;
            line-height: 1.9;
            text-align: right;
            margin-bottom: 30px;
        }

        .intro * {
            font-family: asswat-regular !important;
            direction: rtl !important;
            box-sizing: border-box;
        }

        .intro p {
            margin-bottom: 15px;
        }

        .intro h2,
        .intro h4 {
            font-family: asswat-medium !important;
            color: #111 !important;
            text-align: right !important;
            margin-top: 35px !important;
            margin-bottom: 18px !important;
            font-size: 32px !important;
        }

        .intro h3 {
            color: #333 !important;
            margin: 0 !important;
        }

        .intro img {
            display: block;
            max-width: 100% !important;
            height: auto !important;
        }

        .intro a {
            color: #000000;
            text-decoration: none;
            position: relative;
            border-bottom: 2px solid #e4f0ef;
            border-radius: 0;
            padding-bottom: 1px;
            display: inline;
            transition: color 0.3s ease;
        }

        .intro a::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: -2px;
            height: 0;
            background-color: #e4f0ef;
            z-index: -1;
            transition: height 0.3s ease;
            border-radius: 0;
        }

        .intro a:hover {
            color: #000000;
        }

        .intro a:hover::before {
            height: calc(100% + 2px);
        }

        .intro figure {
            width: 100%;
            margin: 25px 0;
        }

        .intro figure img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        .intro figcaption {
            background: #F5F5F5;
            color: #555;
            font-size: 15px;
            padding: 10px;
            text-align: right;
            font-family: asswat-regular;
            direction: rtl;
        }

        .intro video {
            width: 100%;
            height: auto;
        }

        .intro iframe[src*="youtube"],
        .intro iframe[src*="vimeo"],
        .intro iframe[src*="dailymotion"] {
            width: 100%;
            height: auto;
            aspect-ratio: 16/9;
            border: none;
        }

        .intro audio {
            width: 100% !important;
            height: 50px !important;
            margin: 25px 0;
            display: block;
            border-radius: 25px;
            background: #f5f5f5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .intro blockquote {
            width: 100%;
            padding: 40px 20px;
            margin: 30px 0;
            text-align: center;
            position: relative;
            font-family: asswat-medium;
        }

        .intro blockquote p {
            font-size: 28px;
            color: #222;
            line-height: 1.6;
            font-family: asswat-bold !important;
            text-align: center !important;
        }

        .intro blockquote p span {
            font-size: 28px;
            color: #222;
            line-height: 1.6;
            font-family: asswat-bold !important;
            text-align: center !important;
        }

        .intro blockquote::before {
            content: "";
            position: absolute;
            top: 0px;
            right: 0px;
            width: 32px;
            height: 32px;
            background: url('/user/assets/icons/up.png') no-repeat center;
            background-size: contain;
        }

        .intro blockquote::after {
            content: "";
            position: absolute;
            bottom: 0px;
            left: 0px;
            width: 32px;
            height: 32px;
            background: url('/user/assets/icons/down.png') no-repeat center;
            background-size: contain;
        }

        /* Clickable text styling */
        .intro p .clickable-term {
            color: #000000;
            text-decoration: none;
            cursor: pointer;
            border-radius: 50%;
            background-color: #e4f0ef;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", Arial, sans-serif !important;
            font-size: 9px !important;
            font-weight: 700;
            vertical-align: super;
            display: inline-grid;
            place-items: center;
            line-height: 1;
            min-width: 16px;
            min-height: 16px;
            aspect-ratio: 1;
            padding: 2px;
            transition: all 0.2s ease;
        }

        .intro p .clickable-term:hover {
            background-color: #d0e8e5;
            transform: scale(1.1);
        }

        /* ==================== FILM LIST STYLES ==================== */
        .film-list {
            counter-reset: film-counter;
            max-width: 950px;
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
            box-shadow: none;
        }

        .film-poster-link {
            display: block;
            text-decoration: none;
        }

        .film-title-link {
            text-decoration: none;
            color: inherit;
        }

        /* Left side: Photo and button */
        .film-left {
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .film-poster {
            width: 215px;
            border-radius: 0;
            overflow: hidden;
            aspect-ratio: 3 / 4;
        }

        .film-poster img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        /* Right side: Content */
        .film-right {
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .film-number {
            font-size: 55px;
            color: rgb(205, 205, 203);
            margin-bottom: 10px;
            line-height: 1;
            font-family: 'asswat-bold'
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
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 700;
            font-family: 'asswat-medium', sans-serif;
            color: #000000;
        }

        .film-description {
            font-size: 16px !important;
            line-height: 1.9 !important;
            text-align: right !important;
            color: #000000 !important;
            font-weight: 300;
            font-family: asswat-regular !important;
            direction: rtl !important;
            position: relative;
            max-height: calc(1.9em * 9);
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .film-description.expanded {
            max-height: none;
            overflow: visible;
        }

        .film-description a {
            color: #000000;
            text-decoration: none;
            position: relative;
            border-bottom: 2px solid #e4f0ef;
            border-radius: 0;
            padding-bottom: 1px;
            display: inline;
            transition: color 0.3s ease;
        }

        .film-description a::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: -2px;
            height: 0;
            background-color: #e4f0ef;
            z-index: -1;
            transition: height 0.3s ease;
            border-radius: 0;
        }

        .film-description a:hover {
            color: #000000;
        }

        .film-description a:hover::before {
            height: calc(100% + 2px);
        }

        .film-description p .clickable-term {
            color: #000000;
            text-decoration: none;
            cursor: pointer;
            border-radius: 50%;
            background-color: #e4f0ef;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", Arial, sans-serif !important;
            font-size: 9px !important;
            font-weight: 700;
            vertical-align: super;
            display: inline-grid;
            place-items: center;
            line-height: 1;
            min-width: 16px;
            min-height: 16px;
            aspect-ratio: 1;
            padding: 2px;
            transition: all 0.2s ease;
        }

        .film-description p .clickable-term:hover {
            background-color: #d0e8e5;
            transform: scale(1.1);
        }

        .film-description-wrapper {
            position: relative;
        }

        .expand-description-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 15px 0;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #000000;
            font-size: 16px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-family: asswat-regular;
            width: 100%;
            justify-content: center;
            position: relative;
        }

        .expand-description-btn::before,
        .expand-description-btn::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e0e0e0;
        }

        .expand-description-btn-text {
            white-space: nowrap;
            padding: 0 12px;
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

        /* Hide mobile content on web/desktop */
        @media (min-width: 769px) {

            .mobile-navbar,
            .mobile-sidebar,
            .sidebar-overlay {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 56px;
            }

            body.has-admin-bar {
                padding-top: 0px;
            }

            .admin-top-bar {
                display: none !important;
            }

            .split-hero {
                flex-direction: column;
                height: auto;
                margin-top: 0;
            }

            header {
                display: none !important;
            }

            .scroll-navbar {
                display: none !important;
            }

            .hero-image {
                height: 50vh;
                min-height: 300px;
            }

            .hero-caption {
                font-size: 12px;
                padding: 10px 15px;
            }

            .hero-content {
                padding: 30px 20px;
            }

            .hero-content h1 {
                font-size: 24px;
                margin-bottom: 15px;
            }

            .hero-content p {
                font-size: 14px;
                margin-bottom: 20px;
            }

            .actor-info {
                margin-top: 20px;
                padding-top: 20px;
            }

            .actor-name {
                font-size: 16px;
            }

            .content {
                padding: 40px 0;
            }

            .intro {
                font-size: 15px !important;
                padding: 0 15px;
                margin-bottom: 40px;
                font-family: asswat-regular;
                color: #000000;
                line-height: 1.9;
                text-align: right;
            }

            .film-list {
                max-width: 100%;
                padding: 0 15px;
            }

            .film-item {
                flex-direction: column;
                padding: 20px;
                margin-bottom: 30px;
                gap: 20px;
                box-shadow: none;
            }

            .film-left {
                width: 100%;
                align-items: center;
            }

            .film-poster {
                width: 100%;
                max-width: 280px;
            }

            .film-right {
                width: 100%;
            }

            .film-number {
                font-size: 36px;
                text-align: center;
            }

            .film-writer {
                text-align: center;
                font-size: 13px;
            }

            .film-title {
                font-size: 22px;
                text-align: center;
            }

            .film-description {
                font-size: 14px;
                line-height: 1.7;
                max-height: calc(1.7em * 9);
            }

            .expand-description-btn {
                margin-top: 8px;
                font-size: 14px;
            }

            .expand-description-btn::after {
                font-size: 12px;
            }

            .film-description a::before {
                height: 1px;
            }

            .back-to-top {
                bottom: 20px;
                left: 20px;
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
        }

        /* ==================== TEXT DEFINITION MODAL STYLES ==================== */
        .text-definition-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10000;
            animation: modalBackdropFadeIn 0.3s ease;
        }

        @keyframes modalBackdropFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .text-modal-backdrop {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            animation: backdropFadeIn 0.3s ease;
        }

        @keyframes backdropFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .text-modal-container {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            width: 100%;
            max-height: 80vh;
            box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            animation: modalSlideUp 0.4s ease-out;
            overflow: hidden;
        }

        @keyframes modalSlideUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes modalSlideDown {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(100%);
            }
        }

        .text-modal-container.closing {
            animation: modalSlideDown 0.3s ease-out forwards;
        }

        .text-definition-modal.closing .text-modal-backdrop {
            animation: backdropFadeOut 0.3s ease forwards;
        }

        @keyframes backdropFadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .text-modal-header {
            padding: 0;
            border-bottom: none;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            background: white;
            border-radius: 0;
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 10;
        }

        .text-modal-close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #000;
            padding: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .text-modal-close:hover {
            color: #000;
            transform: scale(1.1);
        }

        .text-modal-body {
            padding: 2rem;
            overflow-y: auto;
            flex: 1;
            animation: bodyFadeIn 0.4s;
            display: flex;
            flex-direction: row;
            gap: 2rem;
            align-items: flex-start;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        @keyframes bodyFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .text-modal-title {
            font-size: 16px;
            font-weight: bold;
            color: #222;
            font-family: asswat-bold;
            text-align: right;
            direction: rtl;
            margin-bottom: 8px;
            width: 100%;
        }

        .text-modal-body p {
            margin: 0;
            color: #444;
            font-family: asswat-regular;
            font-size: 16px;
            line-height: 1.8;
            text-align: right;
            direction: rtl;
        }

        #textModalImageContainer {
            margin-bottom: 0;
            flex-shrink: 0;
            flex-grow: 0;
            order: 0;
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        #textModalImage {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 150px;
            object-fit: contain;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        #textModalImage:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .text-modal-body {
                flex-direction: column;
                gap: 1rem;
            }

            #textModalImageContainer {
                width: 100%;
                order: -1;
            }

            .text-modal-title {
                margin-top: 2rem;
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

        /* ==================== MOBILE NAVIGATION STYLES ==================== */
        @media (max-width: 768px) {
            .mobile-navbar {
                display: block !important;
                background-color: #252525;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1500;
                width: 100%;
            }

            .navbar-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 16px;
            }

            .navbar-logo a {
                display: flex;
                align-items: center;
            }

            .logo-img {
                height: 40px;
                width: auto;
            }

            .navbar-icons {
                display: flex;
                align-items: center;
            }

            .menu-toggle {
                background: none;
                border: none;
                cursor: pointer;
                padding: 8px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                position: relative;
                min-width: 44px;
                min-height: 44px;
            }

            .hamburger-icon {
                display: flex;
                flex-direction: column;
                gap: 5px;
                transition: opacity 0.3s ease;
            }

            .line {
                width: 20px;
                height: 2px;
                background-color: #ffffff;
                transition: all 0.3s ease;
                border-radius: 2px;
            }

            .menu-toggle::after {
                content: '✕';
                position: absolute;
                font-size: 24px;
                color: #ffffff;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .menu-toggle.active .hamburger-icon {
                opacity: 0;
                visibility: hidden;
            }

            .menu-toggle.active::after {
                opacity: 1;
                visibility: visible;
            }

            .mobile-sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background-color: #252525;
                transition: left 0.5s ease;
                z-index: 1400;
                padding-top: 56px;
                overflow-y: auto;
            }

            .mobile-sidebar.active {
                left: 0;
            }

            .sidebar-content {
                width: 100%;
            }

            .menu-list {
                list-style: none;
                margin: 0;
                padding: 12px 0;
            }

            .menu-list>li>.menu-item-header,
            .menu-list>li>a {
                border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            }

            .menu-list>li:last-child>.menu-item-header,
            .menu-list>li:last-child>a {
                border-bottom: none;
            }

            .menu-list a {
                display: block;
                padding: 16px 20px;
                color: #ffffff;
                text-decoration: none;
                font-size: 20px;
                font-family: 'asswat-bold', 'asswat-regular';
                transition: all 0.2s ease;
            }

            .menu-item-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .menu-item-header a {
                flex: 1;
                padding: 16px 20px;
                border-bottom: none;
            }

            .submenu-toggle {
                background: none;
                border: none;
                padding: 0;
                cursor: pointer;
                color: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 44px;
                height: 44px;
            }

            .submenu-toggle .toggle-arrow {
                transition: transform 0.3s ease;
                font-size: 16px;
            }

            .submenu-toggle.active .toggle-arrow {
                transform: rotate(90deg);
            }

            .submenu {
                list-style: none;
                margin: 0;
                padding: 0;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
                background: rgba(0, 0, 0, 0.2);
            }

            .submenu.active {
                max-height: 600px;
            }

            .submenu a {
                font-size: 16px;
                padding: 12px 20px 12px 40px;
                font-family: 'asswat-regular';
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
                z-index: 1300;
            }

            .sidebar-overlay.active {
                opacity: 1;
                visibility: visible;
            }
        }
    </style>
</head>

<body class="{{ Auth::check() ? 'has-admin-bar' : '' }}">

    <!-- Mobile Navigation (visible only on mobile) -->
    <nav class="mobile-navbar" id="mobileNavbar" style="display: none;">
        <div class="navbar-content">
            <div class="navbar-logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('user/assets/images/white_logo.svg') }}" alt="Logo" class="logo-img">
                </a>
            </div>
            <div class="navbar-icons">
                <button class="menu-toggle" id="mobileMenuToggle" aria-label="Toggle Menu">
                    <span class="hamburger-icon">
                        <span class="line line-1"></span>
                        <span class="line line-2"></span>
                        <span class="line line-3"></span>
                    </span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Sidebar -->
    <div class="mobile-sidebar" id="mobileSidebar">
        <div class="sidebar-content">
            <ul class="menu-list">
                <li class="menu-item-with-submenu">
                    <div class="menu-item-header">
                        <a href="{{ route('latestNews') }}">أخبار</a>
                        <button class="submenu-toggle" aria-label="Toggle submenu">
                            <i class="fa-solid fa-chevron-left toggle-arrow" aria-hidden="true"></i>
                        </button>
                    </div>
                    <ul class="submenu" id="newsSubmenu">
                        <li><a href="{{ route('newSection', ['section' => 'algeria']) }}">الجزائر</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'world']) }}">عالم</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'economy']) }}">اقتصاد</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'sports']) }}">رياضة</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'people']) }}">ناس</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'culture']) }}">ثقافة وفنون</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'technology']) }}">تكنولوجيا</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'health']) }}">صحة</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'environment']) }}">بيئة</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'media']) }}">ميديا</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'variety']) }}">منوعات</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('reviews') }}">آراء</a></li>
                <li><a href="{{ route('windows') }}">نوافذ</a></li>
                <li><a href="{{ route('files') }}">ملفات</a></li>
                <li><a href="{{ route('investigation') }}">فحص</a></li>
                <li><a href="{{ route('videos') }}">فيديو</a></li>
                <li><a href="{{ route('podcasts') }}">بودكاست</a></li>
                <li><a href="{{ route('photos') }}">صور</a></li>
            </ul>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @if (Auth::check())
        <div class="admin-top-bar">
            <div class="container admin-bar-content">
                <span>
                    <i class="fas fa-user"></i>
                    {{ Auth::user()->name }}
                </span>

                <div class="admin-actions">
                    <a target="_blank" href="{{ route('dashboard.index') }}" title="لوحة التحكم">
                        <i class="fas fa-gauge"></i>
                    </a>
                    @if (isset($news))
                        <a href="{{ route('dashboard.content.edit', $news->id) }}" class="btn btn-sm btn-warning"
                            title="تعديل">
                            <i class="fas fa-pencil"></i>
                        </a>
                    @endif

                    <a href="{{ route('dashboard.content.create') }}" class="btn btn-sm btn-warning" title="إضافة خبر">
                        <i class="fa-solid fa-plus"></i>
                    </a>

                    <a href="{{ route('dashboard.breakingnew.create') }}" class="admin-action-breaking"
                        title="إضافة عاجل">
                        <i class="fa-solid fa-plus"></i>
                    </a>

                    <a href="{{ route('dashboard.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        title="تسجيل الخروج">
                        <i class="fas fa-arrow-right-from-bracket"></i>
                    </a>
                    <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST"
                        style="display:none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <style>
            .admin-top-bar {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 36px;
                background: #F5F5F5;
                color: #333;
                font-size: 14px;
                z-index: 2001;
                display: flex;
                align-items: center;
            }

            .admin-bar-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 30px;
            }

            .admin-bar-content span {
                font-family: asswat-bold, asswat-regular;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .admin-actions {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .admin-actions a {
                color: #333;
                text-decoration: none;
                transition: color 0.2s;
                font-size: 16px;
            }

            .admin-actions a i {
                font-family: "Font Awesome 6 Free";
                font-weight: 900;
            }

            .admin-actions a:hover {
                color: #555;
            }

            .admin-action-breaking i {
                color: #dc3545;
                font-size: 16px;
            }

            .admin-action-breaking:hover i {
                color: #c82333;
            }



            .split-hero {
                margin-top: 36px;
            }

            header {
                top: 36px;
            }
        </style>
    @endif

    <section class="split-hero">
        <header id="main-header">
            <div class="container">
                <div class="header-content">
                    <a href="/" class="logo">
                        <img class="logo-default" src="{{ asset('user/assets/images/white_logo.svg') }}" alt="Logo"
                            style="height: 40px;">
                        <img class="logo-scrolled" src="{{ asset('user/assets/images/white_logo.svg') }}"
                            alt="Logo" style="height: 40px; display: none;">
                    </a>
                    <nav>
                        <ul class="site-nav-links">
                            <li class="site-nav-link {{ request()->routeIs('latestNews') ? 'active' : '' }}"
                                id="hero-show-subnav">
                                <a href="{{ route('latestNews') }}" class="has-sub" aria-expanded="false">أخبار <i
                                        class="fa-solid fa-chevron-down sub-arrow"></i></a>
                                <ul class="subnav-list">
                                    <li class="site-subnav-link"><a
                                            href="{{ route('newSection', ['section' => 'algeria']) }}">الجزائر</a>
                                    </li>
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
            <img src="{{ $news->media()->wherePivot('type', 'mobile')->first()->path }}" alt="{{ $news->title }}">
            @if ($news->caption)
                <figcaption class="hero-caption">{{ $news->caption }}</figcaption>
            @endif
        </div>
        <div class="hero-content">
            {{-- Category --}}
            <div class="custom-category">
                @if (isset($news->country))
                    <a href="{{ route('category.show', ['id' => $news->category->id, 'type' => 'Category']) }}"
                        style="color: #888; text-decoration: none;">
                        {{ $news->category->name ?? '' }}
                    </a>
                    -
                    <a href="{{ route('category.show', ['id' => $news->country->id, 'type' => 'Country']) }}"
                        style="color: #888; text-decoration: none;">
                        {{ $news->country->name ?? '' }}
                    </a>
                @elseif (isset($news->continent))
                    <a href="{{ route('category.show', ['id' => $news->category->id, 'type' => 'Category']) }}"
                        style="color: #888; text-decoration: none;">
                        {{ $news->category->name ?? '' }}
                    </a>
                    -
                    <a href="{{ route('category.show', ['id' => $news->continent->id, 'type' => 'Continent']) }}"
                        style="color: #888; text-decoration: none;">
                        {{ $news->continent->name ?? '' }}
                    </a>
                @else
                    <a href="{{ route('category.show', ['id' => $news->category->id, 'type' => 'Category']) }}"
                        style="color: #888; text-decoration: none;">
                        {{ $news->category->name ?? '' }}
                    </a>
                @endif
            </div>
            <h1>{{ $news->long_title }}</h1>
            <p>{{ $news->summary }}</p>

            <div class="actor-info">
                <div class="actor-name">{{ $news->writers->first()?->name ?? '' }} - {{ $news->city->name ?? '' }}
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="intro">
                <p>{!! $news->content !!}</p>
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
                                    <a href="{{ route('latestNews') }}" class="has-sub" aria-expanded="false">أخبار
                                        <i class="fa-solid fa-chevron-down sub-arrow"></i></a>
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
                @foreach ($news->contentLists()->with('writer')->orderBy('index')->get() as $item)
                    <div class="film-item">
                        <div class="film-left">
                            <div class="film-poster">
                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}"
                                    class="preview-image" data-preview-src="{{ asset($item->image) }}"
                                    data-preview-title="{{ $item->title }}" style="cursor: pointer;">
                            </div>
                        </div>
                        <div class="film-right">
                            <div class="film-number"></div>
                            @if ($item->writer()->first())
                                <p class="film-writer">{{ $item->writer()->first()->name }}</p>
                            @else
                                <p class="film-writer hidden">كاتب غير معروف</p>
                            @endif
                            @if ($item->url)
                                <a href="{{ $item->url }}" class="film-title-link">
                                    <h2 class="film-title">{{ $item->title }}</h2>
                                </a>
                            @else
                                <h2 class="film-title">{{ $item->title }}</h2>
                            @endif
                            <div class="film-description-wrapper">
                                <div class="film-description">{!! $item->description !!}</div>
                                <button class="expand-description-btn" aria-label="عرض المزيد">
                                    <span class="expand-description-btn-text">عرض المزيد</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Web Footer (desktop/tablet) -->
    <div class="web-footer">
        @include('user.components.footer')
    </div>

    <!-- Mobile Footer (mobile only) -->
    <div class="mobile-footer">
        @include('user.mobile.footer')
    </div>

    <!-- Back to top button -->
    <div class="back-to-top" id="backToTop">↑</div>

    <style>
        /* Show web footer on desktop/tablet, hide mobile footer */
        .web-footer {
            display: block;
        }

        .mobile-footer {
            display: none;
        }

        @media (max-width: 768px) {

            /* Hide web footer on mobile, show mobile footer */
            .web-footer {
                display: none;
            }

            .mobile-footer {
                display: block;
            }
        }
    </style>

    <script>
        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            initHeaderScroll();
            initBackToTop();
            initHeroSubnav();
            initScrollSubnav();
            initMobileMenu();
            initDescriptionToggle();
            initImagePreview();
        });

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

        // Mobile menu functionality
        let mobileMenuInitialized = false;

        function initMobileMenu() {
            if (mobileMenuInitialized) return;

            const menuToggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const submenuToggle = document.querySelector('.submenu-toggle');
            const submenu = document.getElementById('newsSubmenu');

            if (!menuToggle || !sidebar || !overlay) {
                console.log('Mobile menu elements not found');
                return;
            }

            // Toggle sidebar
            function toggleSidebar() {
                menuToggle.classList.toggle('active');
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            }

            menuToggle.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Toggle submenu
            if (submenuToggle && submenu) {
                submenuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.toggle('active');
                    submenu.classList.toggle('active');
                });
            }

            mobileMenuInitialized = true;
            console.log('Mobile menu initialized');
        }

        // Description expand/collapse functionality
        function initDescriptionToggle() {
            const expandButtons = document.querySelectorAll('.expand-description-btn');

            expandButtons.forEach(button => {
                const description = button.previousElementSibling;
                const buttonText = button.querySelector('.expand-description-btn-text');

                // Check if description text is overflowing (more than 9 lines)
                const isOverflowing = description.scrollHeight > description.offsetHeight;

                if (!isOverflowing) {
                    button.style.display = 'none';
                }

                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isExpanded = description.classList.contains('expanded');

                    if (isExpanded) {
                        description.classList.remove('expanded');
                        this.classList.remove('expanded');
                        this.classList.add('collapsed');
                        buttonText.textContent = 'عرض المزيد';
                    } else {
                        description.classList.add('expanded');
                        this.classList.add('expanded');
                        this.classList.remove('collapsed');
                        buttonText.textContent = 'إخفاء';
                    }
                });
            });
        }
    </script>

    {{-- ================= TEXT DEFINITION MODAL ================= --}}
    <div id="textDefinitionModal" class="text-definition-modal" style="display: none;" role="dialog"
        aria-labelledby="textModalTitle">
        <div class="text-modal-backdrop"></div>
        <div class="text-modal-container">
            <div class="text-modal-header">
                <button class="text-modal-close" id="textModalCloseBtn" type="button" aria-label="إغلاق">×</button>
            </div>
            <div class="text-modal-body">
                <div id="textModalImageContainer" style="display: none;">
                    <img id="textModalImage" src="" alt="صورة التعريف">
                </div>
                <div>
                    <h3 id="textModalTitle" class="text-modal-title"></h3>
                    <p id="textModalContent"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        /**
         * Initialize Text Definition Modal
         */
        function initializeTextDefinitionModal() {
            const textDefinitions = {};

            // Find all clickable terms in the content
            document.querySelectorAll('.clickable-term').forEach(function(element) {
                const term = element.getAttribute('data-term');
                const imagePath = element.getAttribute('data-image');
                const description = element.getAttribute('data-description');

                if (term && description) {
                    textDefinitions[term] = {
                        content: element.textContent,
                        description: description,
                        image: imagePath || null
                    };
                }
            });

            // Get modal elements
            const modal = document.getElementById('textDefinitionModal');
            const modalContent = document.getElementById('textModalContent');
            const modalTitle = document.getElementById('textModalTitle');
            const modalImage = document.getElementById('textModalImage');
            const modalImageContainer = document.getElementById('textModalImageContainer');
            const modalBackdrop = modal.querySelector('.text-modal-backdrop');
            const modalClose = document.getElementById('textModalCloseBtn');

            if (!modal || !modalContent || !modalTitle) {
                console.warn('Modal elements not found');
                return;
            }

            // Handle clicks on clickable text
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('clickable-term')) {
                    e.preventDefault();
                    const term = e.target.getAttribute('data-term');

                    // Try different variations of the term key
                    let definition = textDefinitions[term] ||
                        textDefinitions[term.toLowerCase()] ||
                        textDefinitions[term.toLowerCase().replace(/\s+/g, '-')] ||
                        textDefinitions[term.toLowerCase().replace(/\s+/g, '_')];

                    if (definition) {
                        showTextModal(term, definition);
                    } else {
                        // Fallback: show modal with term not found
                        showTextModal(term, {
                            description: 'لم يتم العثور على تعريف مفصل لهذا المصطلح.',
                            image: null
                        });
                    }
                }
            });

            // Function to show modal with text definition (including image)
            function showTextModal(term, definition) {
                modalTitle.textContent = term;

                // Apply quote replacement to the description
                const descriptionWithQuotes = definition.description.replace(/"([^"]*)"/g, '«$1»');
                modalContent.innerHTML = descriptionWithQuotes;

                if (definition.image) {
                    modalImageContainer.style.display = 'block';
                    modalImage.src = definition.image;
                    modalImage.alt = definition.content || 'صورة التعريف';
                } else {
                    modalImageContainer.style.display = 'none';
                    modalImage.onclick = null;
                }

                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }

            // Function to close modal
            function closeTextModal() {
                const modalContainer = modal.querySelector('.text-modal-container');

                // Add closing animation classes
                modal.classList.add('closing');
                modalContainer.classList.add('closing');

                // Wait for animation to complete before hiding
                setTimeout(function() {
                    modal.style.display = 'none';
                    modal.classList.remove('closing');
                    modalContainer.classList.remove('closing');
                    document.body.style.overflow = '';
                }, 300); // Match animation duration
            }

            // Event listeners for closing modal
            modalBackdrop.addEventListener('click', closeTextModal);
            modalClose.addEventListener('click', closeTextModal);

            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'block') {
                    closeTextModal();
                }
            });

            // Prevent modal container click from closing modal
            modal.querySelector('.text-modal-container').addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // Initialize when document is ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeTextDefinitionModal();
            replaceQuotesInPage();
        });

        /**
         * Replace all straight quotes "" with guillemets «» throughout the page
         */
        function replaceQuotesInPage() {
            // Function to recursively replace quotes in text nodes
            function replaceInNode(node) {
                if (node.nodeType === Node.TEXT_NODE) {
                    // Replace all occurrences of "text" with «text»
                    node.textContent = node.textContent.replace(/"([^"]*)"/g, '«$1»');
                } else if (node.nodeType === Node.ELEMENT_NODE) {
                    // Skip script and style tags
                    if (node.tagName !== 'SCRIPT' && node.tagName !== 'STYLE') {
                        for (let child of node.childNodes) {
                            replaceInNode(child);
                        }
                    }
                }
            }

            // Process the entire body to replace all quotes
            replaceInNode(document.body);
        }

        // Image preview functionality
        function initImagePreview() {
            const previewImages = document.querySelectorAll('.preview-image');
            const modal = document.getElementById('imagePreviewModal');
            const previewImg = document.getElementById('previewImg');
            const previewTitle = document.getElementById('previewTitle');
            const closeBtn = document.getElementById('closeImagePreview');
            const backdrop = document.getElementById('previewBackdrop');

            previewImages.forEach(img => {
                img.addEventListener('click', function(e) {
                    e.preventDefault();
                    const src = this.getAttribute('data-preview-src');
                    const title = this.getAttribute('data-preview-title');

                    previewImg.src = src;
                    previewTitle.textContent = title;
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                });
            });

            function closePreview() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }

            closeBtn.addEventListener('click', closePreview);
            backdrop.addEventListener('click', closePreview);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'flex') {
                    closePreview();
                }
            });
        }
    </script>

    <!-- Image Preview Modal -->
    <div id="imagePreviewModal" class="image-preview-modal" style="display: none;">
        <div id="previewBackdrop" class="preview-backdrop"></div>
        <div class="preview-container">
            <button id="closeImagePreview" class="preview-close-btn" aria-label="إغلاق">×</button>
            <img id="previewImg" src="" alt="معاينة الصورة" class="preview-image-large">
            <div class="preview-title" id="previewTitle"></div>
        </div>
    </div>

    <style>
        .image-preview-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .preview-backdrop {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(5px);
        }

        .preview-container {
            position: relative;
            z-index: 10000;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            max-width: 90vw;
            max-height: 90vh;
            animation: previewFadeIn 0.3s ease;
        }

        @keyframes previewFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .preview-image-large {
            max-width: 100%;
            max-height: 80vh;
            object-fit: fill;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .preview-close-btn {
            position: absolute;
            top: -40px;
            right: 0;
            background: none;
            border: none;
            color: #fff;
            font-size: 32px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10001;
        }

        .preview-close-btn:hover {
            color: #ccc;
            transform: scale(1.1);
        }

        .preview-title {
            color: #fff;
            font-size: 16px;
            font-family: asswat-regular;
            text-align: center;
            max-width: 90vw;
            direction: rtl;
        }

        @media (max-width: 768px) {
            .preview-close-btn {
                top: 10px;
            }

            .preview-image-large {
                max-height: 60vh;
            }

            .preview-title {
                font-size: 14px;
                padding: 0 20px;
            }
        }
    </style>
</body>

</html>
