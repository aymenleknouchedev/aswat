<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missahat | مساحات - تصميم وتطوير استثنائي</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #ffffff;
            color: #1a1a1a;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(125deg, #f8f9fa 0%, #ffffff 50%, #f8f9fa 100%);
        }

        .bg-animation::before,
        .bg-animation::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            animation: float 20s ease-in-out infinite;
        }

        .bg-animation::before {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, #10b981 0%, transparent 70%);
            top: -300px;
            right: -200px;
            animation-delay: 0s;
        }

        .bg-animation::after {
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, #059669 0%, transparent 70%);
            bottom: -400px;
            left: -300px;
            animation-delay: 5s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(50px, -50px) scale(1.1); }
            66% { transform: translate(-30px, 40px) scale(0.9); }
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(30px) saturate(150%);
            -webkit-backdrop-filter: blur(30px) saturate(150%);
            border-bottom: 1px solid rgba(16, 185, 129, 0.1);
            z-index: 1000;
            padding: 20px 0;
            transition: all 0.3s ease;
        }

        nav.scrolled {
            padding: 15px 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 900;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            gap: 50px;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            color: #6b7280;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #10b981, #059669);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #10b981;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-cta {
            padding: 12px 28px !important;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50px;
            color: #ffffff !important;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
        }

        .nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(16, 185, 129, 0.5);
        }

        .nav-cta::after {
            display: none;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 140px 40px 80px;
            position: relative;
        }

        .hero-content {
            max-width: 1400px;
            width: 100%;
            text-align: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 50px;
            font-size: 14px;
            color: #059669;
            margin-bottom: 32px;
            animation: fadeInUp 0.8s ease;
        }

        .hero-badge i {
            color: #10b981;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 80px;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 32px;
            letter-spacing: -2px;
            animation: fadeInUp 1s ease 0.2s both;
        }

        .hero h1 .gradient-text {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 22px;
            color: #6b7280;
            max-width: 800px;
            margin: 0 auto 48px;
            line-height: 1.8;
            animation: fadeInUp 1s ease 0.4s both;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease 0.6s both;
        }

        .btn {
            padding: 18px 42px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            box-shadow: 0 12px 40px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: #ffffff;
            color: #1a1a1a;
            border: 2px solid rgba(16, 185, 129, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(16, 185, 129, 0.05);
            border-color: rgba(16, 185, 129, 0.6);
            transform: translateY(-4px);
        }

        /* Floating Elements */
        .hero-float {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
            filter: blur(60px);
            animation: float 15s ease-in-out infinite;
        }

        .hero-float:nth-child(1) {
            top: 10%;
            left: 10%;
        }

        .hero-float:nth-child(2) {
            bottom: 20%;
            right: 10%;
            animation-delay: 3s;
        }

        /* Section Styles */
        section {
            padding: 120px 40px;
            position: relative;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 50px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #10b981;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 56px;
            font-weight: 900;
            margin-bottom: 24px;
            line-height: 1.2;
            letter-spacing: -1px;
            color: #1a1a1a;
        }

        .section-title .gradient-text {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-description {
            font-size: 20px;
            color: #6b7280;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
        }

        .service-card {
            background: #ffffff;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(16, 185, 129, 0.15);
            border-radius: 24px;
            padding: 48px 36px;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #10b981, #059669);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .service-card:hover {
            transform: translateY(-12px);
            border-color: rgba(16, 185, 129, 0.4);
            box-shadow: 0 30px 80px rgba(16, 185, 129, 0.15);
        }

        .service-card:hover::before {
            opacity: 1;
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.15));
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            font-size: 36px;
            color: #10b981;
            transition: all 0.4s ease;
        }

        .service-card:hover .service-icon {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.25));
            transform: scale(1.1) rotate(5deg);
        }

        .service-card h3 {
            font-size: 24px;
            margin-bottom: 16px;
            font-weight: 800;
            color: #1a1a1a;
        }

        .service-card p {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .service-link {
            color: #10b981;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: gap 0.3s ease;
        }

        .service-link:hover {
            gap: 12px;
        }

        /* Process Section */
        .process-timeline {
            position: relative;
            padding: 60px 0;
        }

        .process-timeline::before {
            content: '';
            position: absolute;
            width: 3px;
            height: 100%;
            background: linear-gradient(180deg, 
                transparent 0%, 
                rgba(16, 185, 129, 0.2) 10%, 
                rgba(16, 185, 129, 0.4) 50%, 
                rgba(5, 150, 105, 0.2) 90%, 
                transparent 100%);
            left: 50%;
            top: 0;
            transform: translateX(-50%);
        }

        .process-step {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 60px;
            margin-bottom: 120px;
            position: relative;
            align-items: center;
        }

        .process-step:last-child {
            margin-bottom: 0;
        }

        .process-step:nth-child(odd) .process-content:first-child {
            text-align: left;
        }

        .process-step:nth-child(odd) .process-content:last-child {
            opacity: 0;
            pointer-events: none;
        }

        .process-step:nth-child(even) .process-content:first-child {
            opacity: 0;
            pointer-events: none;
        }

        .process-step:nth-child(even) .process-content:last-child {
            text-align: right;
        }

        .process-number {
            width: 140px;
            height: 140px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: 5px solid #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 56px;
            font-weight: 900;
            color: #ffffff;
            position: relative;
            z-index: 2;
            box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3);
            flex-shrink: 0;
        }

        .process-content {
            padding: 40px;
            background: #ffffff;
            border: 2px solid rgba(16, 185, 129, 0.15);
            border-radius: 24px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
        }

        .process-content:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 50px rgba(16, 185, 129, 0.15);
            border-color: rgba(16, 185, 129, 0.3);
        }

        .process-content h3 {
            font-size: 28px;
            margin-bottom: 16px;
            font-weight: 800;
            color: #1a1a1a;
        }

        .process-content p {
            color: #6b7280;
            line-height: 1.8;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.03) 0%, rgba(5, 150, 105, 0.05) 100%);
            border-top: 1px solid rgba(16, 185, 129, 0.1);
            border-bottom: 1px solid rgba(16, 185, 129, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 60px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 64px;
            font-weight: 900;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
            display: block;
        }

        .stat-label {
            font-size: 16px;
            color: #6b7280;
            font-weight: 600;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 32px;
            padding: 100px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-section h2 {
            font-size: 52px;
            font-weight: 900;
            margin-bottom: 24px;
            color: #ffffff;
        }

        .cta-section p {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 40px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-section .btn {
            background: #ffffff;
            color: #10b981;
            font-weight: 800;
        }

        .cta-section .btn:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background: #f8f9fa;
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(16, 185, 129, 0.1);
            padding: 80px 40px 40px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 80px;
            margin-bottom: 60px;
        }

        .footer-brand h3 {
            font-size: 32px;
            font-weight: 900;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
        }

        .footer-brand p {
            color: #6b7280;
            line-height: 1.8;
            margin-bottom: 32px;
        }

        .social-links {
            display: flex;
            gap: 16px;
        }

        .social-links a {
            width: 48px;
            height: 48px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #10b981;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.4);
            transform: translateY(-4px);
        }

        .footer-section h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #1a1a1a;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 12px;
        }

        .footer-section ul li a {
            color: #6b7280;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 15px;
        }

        .footer-section ul li a:hover {
            color: #10b981;
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            padding-top: 40px;
            border-top: 1px solid rgba(16, 185, 129, 0.1);
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero h1 {
                font-size: 56px;
            }

            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
            }

            .process-step {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 32px;
                margin-bottom: 60px;
            }

            .process-timeline::before {
                display: none;
            }

            .process-step:nth-child(odd) .process-content:last-child,
            .process-step:nth-child(even) .process-content:first-child {
                opacity: 1;
                pointer-events: auto;
            }

            .process-step:nth-child(even) .process-content:last-child {
                text-align: center;
            }

            .process-step::after {
                display: none;
            }

            .process-number {
                margin: 0 auto;
                width: 100px;
                height: 100px;
                font-size: 42px;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero-description {
                font-size: 18px;
            }

            .section-title {
                font-size: 36px;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .cta-section {
                padding: 60px 32px;
            }

            .cta-section h2 {
                font-size: 36px;
            }
        }
    </style>
</head>

<body>
    <div class="bg-animation"></div>

    <!-- Navigation -->
    <nav id="navbar">
        <div class="nav-container">
            <div class="logo">مساحات</div>
            <ul class="nav-links">
                <li><a href="#home">الرئيسية</a></li>
                <li><a href="#services">الخدمات</a></li>
                <li><a href="#process">طريقة العمل</a></li>
                <li><a href="#stats">إنجازاتنا</a></li>
                <li><a href="#contact" class="nav-cta">تواصل معنا</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-float"></div>
        <div class="hero-float"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-sparkles"></i>
                <span>نبني المستقبل الرقمي معاً</span>
            </div>
            <h1>
                نحوّل أفكاركم إلى<br>
                <span class="gradient-text">تجارب رقمية استثنائية</span>
            </h1>
            <p class="hero-description">
                شريكك الإبداعي في رحلة التحول الرقمي. نصمم ونطور منصات رقمية متقدمة تجمع بين الإبداع البصري والأداء التقني العالي، مع التركيز على تحقيق أهداف عملك وتجاوز توقعات جمهورك.
            </p>
            <div class="hero-buttons">
                <a href="#contact" class="btn btn-primary">
                    <i class="fas fa-rocket"></i>
                    <span>ابدأ مشروعك الآن</span>
                </a>
                <a href="#services" class="btn btn-secondary">
                    <i class="fas fa-compass"></i>
                    <span>استكشف خدماتنا</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-cube"></i>
                    <span>الخدمات</span>
                </div>
                <h2 class="section-title">حلول <span class="gradient-text">رقمية متكاملة</span></h2>
                <p class="section-description">نقدم مجموعة شاملة من الخدمات الرقمية المصممة لتلبية احتياجاتكم وتحقيق أهدافكم</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-wand-magic-sparkles"></i></div>
                    <h3>تصميم UI/UX احترافي</h3>
                    <p>نصمم تجارب مستخدم بديهية وجذابة باستخدام أحدث معايير التصميم العالمية، مع التركيز على سهولة الاستخدام والجمال البصري.</p>
                    <a href="#" class="service-link">
                        <span>اكتشف المزيد</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-code"></i></div>
                    <h3>تطوير ويب متقدم</h3>
                    <p>نبني منصات ويب قوية وسريعة باستخدام Laravel, React, و Vue.js. حلول قابلة للتوسع ومحسّنة للأداء.</p>
                    <a href="#" class="service-link">
                        <span>اكتشف المزيد</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-mobile-screen-button"></i></div>
                    <h3>تطبيقات الموبايل</h3>
                    <p>تطبيقات iOS و Android أصلية وهجينة تقدم تجربة سلسة وعالية الأداء على جميع الأجهزة المحمولة.</p>
                    <a href="#" class="service-link">
                        <span>اكتشف المزيد</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>تسويق رقمي ذكي</h3>
                    <p>استراتيجيات تسويق رقمي متكاملة: SEO, SEM, إدارة وسائل التواصل، وحملات إعلانية مدروسة تحقق نتائج حقيقية.</p>
                    <a href="#" class="service-link">
                        <span>اكتشف المزيد</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-pen-nib"></i></div>
                    <h3>إنتاج محتوى إبداعي</h3>
                    <p>كتابة محتوى احترافي، إنتاج فيديو، تصوير فوتوغرافي، وبودكاست. نحكي قصتكم بطريقة مؤثرة وجذابة.</p>
                    <a href="#" class="service-link">
                        <span>اكتشف المزيد</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-shield-halved"></i></div>
                    <h3>استشارات تقنية</h3>
                    <p>نساعدك في اتخاذ القرارات التقنية الصحيحة: اختيار التقنيات، تخطيط البنية التحتية، وتحسين الأداء.</p>
                    <a href="#" class="service-link">
                        <span>اكتشف المزيد</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-diagram-project"></i>
                    <span>طريقة العمل</span>
                </div>
                <h2 class="section-title">من الفكرة إلى <span class="gradient-text">الإطلاق</span></h2>
                <p class="section-description">منهجية عمل احترافية ومجرّبة تضمن نجاح مشروعك في كل مرحلة</p>
            </div>
            <div class="process-timeline">
                <div class="process-step">
                    <div class="process-content">
                        <h3>الاستكشاف والتخطيط</h3>
                        <p>نبدأ بفهم عميق لأهدافك واحتياجات جمهورك. نحلل المنافسين ونضع استراتيجية واضحة للمشروع مع جدول زمني دقيق.</p>
                    </div>
                    <div class="process-number">01</div>
                    <div></div>
                </div>
                <div class="process-step">
                    <div></div>
                    <div class="process-number">02</div>
                    <div class="process-content">
                        <h3>التصميم والنماذج الأولية</h3>
                        <p>نصمم واجهات مستخدم عصرية ونماذج تفاعلية تمنحك رؤية واضحة للمنتج النهائي قبل بدء التطوير.</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-content">
                        <h3>التطوير والبناء</h3>
                        <p>فريقنا التقني يحول التصاميم إلى منصة حية، مع اختبارات مستمرة لضمان الجودة والأداء العالي.</p>
                    </div>
                    <div class="process-number">03</div>
                    <div></div>
                </div>
                <div class="process-step">
                    <div></div>
                    <div class="process-number">04</div>
                    <div class="process-content">
                        <h3>الإطلاق والدعم المستمر</h3>
                        <p>نطلق مشروعك بثقة ونبقى معك للدعم الفني، التحديثات، والتحسينات المستمرة لضمان نجاحك على المدى الطويل.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">150+</span>
                    <div class="stat-label">مشروع منجز بنجاح</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number">95+</span>
                    <div class="stat-label">عميل راضٍ ومتكرر</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number">8+</span>
                    <div class="stat-label">سنوات خبرة متخصصة</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number">100%</span>
                    <div class="stat-label">التزام بالجودة</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="contact" style="padding: 80px 40px;">
        <div class="container">
            <div class="cta-section">
                <div class="cta-content">
                    <h2>هل أنتم مستعدون لبدء مشروعكم؟</h2>
                    <p>دعونا نحول أفكاركم إلى واقع رقمي مذهل. فريقنا جاهز لمساعدتكم في كل خطوة.</p>
                    <a href="mailto:contact@missahat.com" class="btn">
                        <i class="fas fa-paper-plane"></i>
                        <span>تحدث مع فريقنا الآن</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h3>مساحات</h3>
                <p>شريكك الإبداعي في رحلة التحول الرقمي. نصمم ونطور تجارب رقمية استثنائية تحقق أهدافك وتتجاوز توقعات جمهورك.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-behance"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4>الخدمات</h4>
                <ul>
                    <li><a href="#">تصميم UI/UX</a></li>
                    <li><a href="#">تطوير الويب</a></li>
                    <li><a href="#">تطبيقات الموبايل</a></li>
                    <li><a href="#">التسويق الرقمي</a></li>
                    <li><a href="#">إنتاج المحتوى</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>الشركة</h4>
                <ul>
                    <li><a href="#">من نحن</a></li>
                    <li><a href="#">أعمالنا</a></li>
                    <li><a href="#">المدونة</a></li>
                    <li><a href="#">الوظائف</a></li>
                    <li><a href="#">تواصل معنا</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>التواصل</h4>
                <ul>
                    <li><a href="mailto:contact@missahat.com">contact@missahat.com</a></li>
                    <li><a href="tel:+213000000000">+213 000 000 000</a></li>
                    <li><a>الجزائر العاصمة، الجزائر</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 مساحات للإعلام والثقافة والفنون. جميع الحقوق محفوظة. صُنع بـ <i class="fas fa-heart" style="color: #10b981;"></i> في الجزائر</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>
