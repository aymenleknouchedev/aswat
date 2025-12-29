<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missahat | مساحات للإعلام والثقافة والفنون</title>
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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', sans-serif;
            background: #0a0a0f;
            color: #ffffff;
            line-height: 1.6;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(236, 72, 153, 0.1) 0%, transparent 50%);
            z-index: -1;
            animation: bgShift 20s ease infinite;
        }

        @keyframes bgShift {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(10, 10, 15, 0.8);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
            z-index: 1000;
            padding: 18px 0;
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: 800;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            list-style: none;
        }

        .nav-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #a855f7);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #ffffff;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Sections */
        section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 120px 32px;
            position: relative;
        }

        .container {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            position: relative;
        }

        .hero h1 {
            font-size: 72px;
            font-weight: 900;
            margin-bottom: 28px;
            letter-spacing: -0.03em;
            line-height: 1.1;
            background: linear-gradient(135deg, #ffffff 0%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 22px;
            color: #94a3b8;
            margin-bottom: 48px;
            max-width: 720px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 20px;
        }

        .btn {
            padding: 16px 40px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            color: #ffffff;
            box-shadow: 0 10px 40px -10px rgba(99, 102, 241, 0.6);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-primary:hover::before {
            opacity: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 60px -10px rgba(99, 102, 241, 0.8);
        }

        .btn-primary span {
            position: relative;
            z-index: 1;
        }

        .btn-secondary {
            background: rgba(99, 102, 241, 0.1);
            color: #a5b4fc;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(99, 102, 241, 0.2);
            border-color: rgba(99, 102, 241, 0.5);
            transform: translateY(-2px);
        }

        /* Services Section */
        .services {
            background: transparent;
        }

        .section-title {
            font-size: 13px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #6366f1;
            margin-bottom: 16px;
            text-align: center;
            font-weight: 600;
        }

        .section-heading {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 72px;
            text-align: center;
            background: linear-gradient(135deg, #ffffff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 28px;
        }

        .service-card {
            background: rgba(15, 15, 25, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 24px;
            padding: 40px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.5), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .service-card:hover {
            border-color: rgba(99, 102, 241, 0.5);
            transform: translateY(-8px);
            box-shadow: 0 20px 60px -10px rgba(99, 102, 241, 0.3);
        }

        .service-card:hover::before {
            opacity: 1;
        }

        .service-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(168, 85, 247, 0.2));
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            font-size: 32px;
            transition: all 0.4s ease;
        }

        .service-card:hover .service-icon {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(168, 85, 247, 0.3));
            transform: scale(1.1) rotate(5deg);
        }

        .service-card h3 {
            font-size: 22px;
            margin-bottom: 16px;
            color: #ffffff;
        }

        .service-card p {
            color: #94a3b8;
            font-size: 15px;
            line-height: 1.8;
        }

        /* About Section */
        .about {
            background: transparent;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .about-text h2 {
            font-size: 48px;
            margin-bottom: 28px;
            background: linear-gradient(135deg, #ffffff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .about-text p {
            font-size: 18px;
            color: #94a3b8;
            line-height: 1.9;
            margin-bottom: 20px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            background: rgba(15, 15, 25, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 24px;
            padding: 48px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: rgba(99, 102, 241, 0.1);
        }

        .stat-number {
            font-size: 56px;
            font-weight: 900;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 14px;
            font-weight: 500;
        }

        /* Contact Section */
        .contact {
            background: transparent;
        }

        .contact-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-content h2 {
            font-size: 48px;
            margin-bottom: 28px;
            background: linear-gradient(135deg, #ffffff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .contact-content p {
            font-size: 20px;
            color: #94a3b8;
            margin-bottom: 48px;
            line-height: 1.7;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 64px;
            margin-top: 56px;
            flex-wrap: wrap;
        }

        .contact-item {
            text-align: center;
            padding: 24px 32px;
            background: rgba(15, 15, 25, 0.6);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            border-color: rgba(99, 102, 241, 0.5);
            transform: translateY(-4px);
        }

        .contact-item-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #6366f1;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .contact-item-value {
            font-size: 17px;
            color: #ffffff;
            font-weight: 500;
        }

        .contact-item-value a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-item-value a:hover {
            color: #a855f7;
        }

        /* Footer */
        footer {
            background: rgba(10, 10, 15, 0.8);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-top: 1px solid rgba(99, 102, 241, 0.1);
            padding: 40px 32px;
            text-align: center;
        }

        footer p {
            color: #64748b;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            section {
                padding: 80px 24px;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero p {
                font-size: 18px;
            }

            .hero-cta {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .section-heading {
                font-size: 36px;
            }

            .about-content {
                grid-template-columns: 1fr;
                gap: 48px;
            }

            .about-text h2 {
                font-size: 36px;
            }

            .stats {
                padding: 36px 24px;
            }

            .stat-number {
                font-size: 42px;
            }

            .contact-content h2 {
                font-size: 36px;
            }

            .contact-info {
                gap: 24px;
                flex-direction: column;
            }

            .contact-item {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">مساحات</div>
            <ul class="nav-links">
                <li><a href="#home">الرئيسية</a></li>
                <li><a href="#services">الخدمات</a></li>
                <li><a href="#about">من نحن</a></li>
                <li><a href="#contact">تواصل معنا</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <h1>مساحات للإعلام<br>والثقافة والفنون</h1>
            <p>نصمم ونطوّر التجارب الرقمية التي تحكي قصصكم. من الفكرة إلى المنصة الحية، نحن شريككم في كل خطوة.</p>
            <div class="hero-cta">
                <a href="#contact" class="btn btn-primary"><span>ابدأ مشروعك</span></a>
                <a href="#services" class="btn btn-secondary">اكتشف خدماتنا</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-title">الخدمات</div>
            <h2 class="section-heading">ما نقدّمه لكم</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🎨</div>
                    <h3>تصميم تجربة المستخدم</h3>
                    <p>نصمم واجهات بسيطة، جميلة، وسهلة الاستخدام تضع المستخدم في قلب التجربة.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">💻</div>
                    <h3>تطوير المنصات الرقمية</h3>
                    <p>نبني مواقع ومنصات سريعة، آمنة، وقابلة للتوسع باستخدام أحدث التقنيات.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📱</div>
                    <h3>نظم إدارة المحتوى</h3>
                    <p>نطوّر أنظمة إدارة محتوى مخصصة تمنحكم السيطرة الكاملة على محتواكم الرقمي.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">✍️</div>
                    <h3>إنتاج المحتوى</h3>
                    <p>نساعدكم في صياغة وإنتاج محتوى صحفي ورقمي احترافي يصل إلى جمهوركم.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <div class="section-title">من نحن</div>
                    <h2>نؤمن بقوة التصميم والتطوير الذكي</h2>
                    <p>"مساحات" هي شركة متخصصة في تصميم وتطوير الحلول الرقمية المتكاملة. نجمع بين الإبداع البصري والتطوير التقني لنقدم منتجات رقمية استثنائية.</p>
                    <p>نعمل مع مؤسسات إعلامية، ثقافية، وإبداعية لتحويل أفكارهم إلى منصات رقمية حية تخدم جمهورهم وتحقق أهدافهم.</p>
                </div>
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">مشروع منجز</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">30+</div>
                        <div class="stat-label">عميل راضٍ</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">سنوات خبرة</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">التزام بالجودة</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="contact-content">
                <div class="section-title">تواصل معنا</div>
                <h2>هل لديكم مشروع في ذهنكم؟</h2>
                <p>نحن هنا للاستماع إليكم ومساعدتكم في تحويل أفكاركم إلى واقع رقمي.</p>
                <div class="hero-cta">
                    <a href="mailto:info@missahat.com" class="btn btn-primary">راسلنا الآن</a>
                </div>
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-item-label">البريد الإلكتروني</div>
                        <div class="contact-item-value"><a href="mailto:info@missahat.com">info@missahat.com</a></div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-label">الهاتف</div>
                        <div class="contact-item-value"><a href="tel:+213000000000">+213 000 000 000</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2025 مساحات للإعلام والثقافة والفنون. جميع الحقوق محفوظة.</p>
    </footer>
</body>

</html>
