<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>أصوات جزائرية - قريباً</title>
    <style>
        /* ✅ استدعاء الخط */
        @font-face {
            font-family: 'asswat';
            src: url('./user/assets/fonts/asswat.woff2') format('woff2'),
                url('./user/assets/fonts/asswat.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'asswat', sans-serif;
            color: #fff;
            text-align: center;
            overflow: hidden;
        }

        * {
            font-family: 'asswat', sans-serif;
        }

        /* ✅ placeholder */
        input::placeholder {
            font-family: 'asswat', sans-serif;
            font-size: 16px;
            color: #ddd;
        }

        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0),
                    rgba(82, 183, 136, 0.51));
            z-index: -1;
        }

        .logo {
            position: fixed;
            top: 40px;
            right: 40px;
            width: 90px;
            z-index: 10;
            animation: fadeInDown 1.2s ease;
        }

        .container {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 20px;
        }

        .glass-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            padding: 60px 60px;
            max-width: 600px;
            width: 100%;
            animation: fadeInUp 1.5s ease;
        }

        h1 {
            font-size: 40px;
            font-weight: 700;
            animation: fadeInDown 1.5s ease;
            margin-bottom: 35px;
        }

        p.tagline {
            font-size: 18px;
            margin-bottom: 20px;
            line-height: 1.6;
            animation: fadeIn 2s ease;
            font-weight: 600;
        }

        /* ✅ النص الجديد */
        .animation-text {
            font-size: 26px;
            font-weight: bold;
            margin: 50px 0;
            background: linear-gradient(90deg, #ffffff, #52B788, #ffffff);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientMove 3s linear infinite;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        form {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        input[type="email"] {
            padding: 12px 16px;
            border: none;
            width: 250px;
            font-size: 16px;
            outline: none;
        }

        button {
            padding: 12px 24px;
            background: #52B788;
            color: #fff;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #3d9e6c;
            transform: translateY(-2px);
        }

        footer {
            margin-top: 20px;
            font-size: 16px;
            animation: fadeIn 2.5s ease;
        }

        .social-icons span {
            margin: 0 10px;
            cursor: pointer;
            font-weight: bold;
            transition: color 0.3s;
        }

        .social-icons span:hover {
            color: #52B788;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @media (max-width: 600px) {
            .logo {
                position: relative;
                top: 0;
                right: 0;
                margin: 20px auto;
                display: block;
                width: 140px;
                /* ✅ تكبير الشعار */
            }

            .glass-box {
                padding: 50px 25px;
                /* ✅ أكبر من السابق */
                min-height: 80vh;
                /* ✅ طول إضافي */
            }

            h1 {
                font-size: 34px;
                /* ✅ تكبير العنوان */
            }

            p.tagline {
                font-size: 18px;
                /* ✅ أكبر */
            }

            .animation-text {
                font-size: 22px;
                /* ✅ تكبير النص المتحرك */
            }

            input[type="email"],
            button {
                font-size: 18px;
                /* ✅ أكبر */
            }
        }
    </style>
</head>

<body>
    <video autoplay muted loop playsinline class="video-bg">
        <source src="metro.mp4" type="video/mp4">
    </video>
    <div class="overlay"></div>

    <img class="logo" src="./user/assets/images/white_logo.svg" alt="شعار">

    <div class="container">
        <div class="glass-box">
            <h1>أصوات جزائرية</h1>
            <p class="tagline">منصة إخبارية جزائرية حديثة، تقدم لكم آخر المستجدات، التحليلات، والرأي المستقل</p>

            <!-- ✅ النص الجديد -->
            <div class="animation-text">الموقع قيد التطوير - ترقبونا قريباً</div>

            <form>
                <input type="email" placeholder="أدخل بريدك الإلكتروني">
                <button type="submit">أعلمني</button>
            </form>

            <footer>
                <p>تابعونا على</p>
                <div class="social-icons">
                    <span>فيسبوك</span> |
                    <span>إكس</span> |
                    <span>إنستغرام</span> |
                    <span>يوتيوب</span>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
