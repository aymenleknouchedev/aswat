<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>أصوات جزائرية - قريباً</title>
    <style>
        /* ✅ استدعاء الخطوط */
        @font-face {
            font-family: 'asswat-bold';
            src: url('./user/fonts/reith_qalam_bold.ttf') format('truetype');
            font-weight: bold;
        }

        @font-face {
            font-family: 'asswat-regular';
            src: url('./user/fonts/reith_qalam_regular.ttf') format('truetype');
            font-weight: normal;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'asswat-regular', sans-serif;
            color: #fff;
            text-align: center;
            overflow: hidden;
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
            font-family: 'asswat-bold', sans-serif;
            margin-bottom: 35px;
            animation: fadeInDown 1.5s ease;
        }

        p.tagline {
            font-size: 18px;
            margin-bottom: 20px;
            line-height: 1.6;
            animation: fadeIn 2s ease;
            font-family: 'asswat-regular', sans-serif;
        }

        .animation-text {
            font-size: 26px;
            font-family: 'asswat-bold', sans-serif;
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
            font-family: 'asswat-regular', sans-serif;
        }

        button {
            padding: 12px 24px;
            background: #52B788;
            color: #fff;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'asswat-bold', sans-serif;
        }

        button:hover {
            background: #3d9e6c;
            transform: translateY(-2px);
        }

        footer {
            margin-top: 20px;
            font-size: 16px;
            animation: fadeIn 2.5s ease;
            font-family: 'asswat-regular', sans-serif;
        }

        .social-icons a {
            margin: 0 8px;
            font-family: 'asswat-bold', sans-serif;
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .social-icons a:hover {
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
            }

            .glass-box {
                padding: 50px 25px;
                min-height: 80vh;
            }

            h1 {
                font-size: 34px;
            }

            p.tagline {
                font-size: 18px;
            }

            .animation-text {
                font-size: 22px;
            }

            input[type="email"],
            button {
                font-size: 18px;
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
            <p class="tagline">موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين</p>

            <div class="animation-text">ترقبونا قريباً</div>

            <form>
                <input type="email" placeholder="أدخل بريدك الإلكتروني">
                <button type="submit">أعلمني</button>
            </form>

            <footer>
                <p>تابعونا على</p>
                <div class="social-icons">
                    <a href="https://www.facebook.com/asswatdjazairia" target="_blank">فيسبوك</a> |
                    <a href="https://x.com/asswatdjazairia" target="_blank">إكس</a> |
                    <a href="https://www.instagram.com/asswatdjazairia" target="_blank">إنستغرام</a> |
                    <a href="https://www.youtube.com/@asswatdjazairia" target="_blank">يوتيوب</a>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
