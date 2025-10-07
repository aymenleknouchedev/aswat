<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>أصوات جزائرية - قريباً</title>

    <style>
        /* ================== Fonts ================== */
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

        * {
            box-sizing: border-box;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'asswat-regular', sans-serif;
            color: #fff;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* ================== Video Background ================== */
        .video-bg {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: -1;
        }

        /* ================== Header ================== */
        .header {
            position: fixed;
            top: 20px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            z-index: 10;
        }

        .logo {
            width: 110px;
            animation: fadeInDown 1s ease;
            filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.4));
        }

        .social-icons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .social-icons a {
            display: inline-flex;
            transition: transform 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.15);
        }

        /* ================== Main Section ================== */
        .container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            text-align: center;
            z-index: 1;
        }

        .glass-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 50px 40px;
            max-width: 600px;
            width: 100%;
            animation: fadeInUp 1.2s ease;
        }

        h1 {
            font-family: 'asswat-bold';
            font-size: 42px;
            margin-bottom: 20px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
        }

        .tagline {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .animation-text {
            font-size: 22px;
            font-family: 'asswat-bold';
            background: linear-gradient(90deg, #fff, #52B788, #fff);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientMove 3s linear infinite;
            margin: 30px 0;
        }

        /* ================== Countdown Styles ================== */
        .countdown-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .countdown-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 15px 10px;
            min-width: 70px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .countdown-number {
            font-family: 'asswat-bold';
            font-size: 32px;
            color: #52B788;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            line-height: 1;
            margin-bottom: 5px;
        }

        .countdown-label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            text-transform: uppercase;
        }

        /* ================== Forms ================== */
        form {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px;
        }

        input[type="email"] {
            padding: 14px 18px;
            border: none;
            width: 260px;
            border-radius: 12px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
            transition: box-shadow 0.3s ease;
            border: 2px solid #e2e8f0;
            font-family: 'asswat-regular', sans-serif;

        }

        input[type="email"]:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.4);
            background: #fff;

        }

        button {
            padding: 14px 26px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-family: 'asswat-bold';
            transition: 0.3s ease;
        }

        button[type="submit"] {
            background: #52B788;
            color: #fff;
        }

        button[type="submit"]:hover {
            background: #3d9e6c;
            transform: translateY(-2px);
        }

        .career-btn {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.4);
            margin-top: 15px;
        }

        .career-btn:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateY(-2px);
        }

        /* ================== Enhanced Modal ================== */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
            overflow-y: auto;
            padding: 5px;
        }

        .modal-content {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #333;
            border-radius: 20px;
            max-width: 600px;
            width: 100%;
            position: relative;
            animation: slideIn 0.4s ease;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            margin: auto;
        }

        .modal-header {
            background: linear-gradient(135deg, #52B788 0%, #3d9e6c 100%);
            padding: 25px 30px 20px;
            text-align: center;
            color: white;
            position: relative;
        }

        .modal-header h2 {
            font-family: 'asswat-bold';
            margin: 0;
            font-size: 24px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .modal-header p {
            margin: 8px 0 0;
            opacity: 0.9;
            font-size: 15px;
        }

        .close-btn {
            position: absolute;
            top: 18px;
            left: 22px;
            font-size: 28px;
            color: rgba(255, 255, 255, 0.9);
            cursor: pointer;
            transition: all 0.3s ease;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .close-btn:hover {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 30px;
            max-height: 70vh;
            overflow-y: auto;
        }

        /* ================== NEW FORM STYLES ================== */
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .form-row {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .form-label {
            font-size: 15px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 4px;

        }

        .required-star {
            color: #e53e3e;
            font-size: 18px;
        }

        .form-input {
            padding: 14px 16px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            font-size: 16px;
            transition: all 0.3s;
            background: #ffffff;
            font-family: 'asswat-regular';
            width: 100% !important;

        }

        .form-input:focus {
            border-color: #52B788;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.2);
            outline: none;
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.5;
            padding: 14px 16px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            font-size: 16px;
            transition: all 0.3s;
            background: #ffffff;
            font-family: 'asswat-regular';
            width: 100%;
        }

        .form-textarea:focus {
            border-color: #52B788;
            outline: none;
        }

        .form-select {
            padding: 14px 16px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            font-size: 16px;
            transition: all 0.3s;
            background: #ffffff;
            font-family: 'asswat-regular';
            width: 100%;
            cursor: pointer;
        }

        .form-select:focus {
            border-color: #52B788;
            outline: none;
        }

        .file-upload-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .file-input-wrapper {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .file-display {
            flex: 1;
            background: #f7fafc;
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 15px;
            color: #718096;
            min-height: 52px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .file-display.has-file {
            border-color: #52B788;
            background: #f0fff4;
            color: #2d3748;
        }

        .file-upload-btn {
            background: #52B788;
            color: #fff;
            padding: 14px 20px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'asswat-bold';
            font-size: 15px;
            white-space: nowrap;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-upload-btn:hover {
            background: #3d9e6c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(82, 183, 136, 0.3);
        }

        .file-input {
            display: none;
        }

        .upload-icon {
            font-size: 18px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #52B788 0%, #3d9e6c 100%);
            color: #fff;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-family: 'asswat-bold';
            font-size: 17px;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 4px 12px rgba(82, 183, 136, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(82, 183, 136, 0.4);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #718096;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
        }

        /* ================== Animations ================== */
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
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-25px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
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

        @keyframes gradientMove {
            0% {
                background-position: 0% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* ================== Responsive ================== */
        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                gap: 12px;
                padding: 0 20px;
            }

            .logo {
                width: 110px;
            }

            .glass-box {
                padding: 35px 20px;
            }

            h1 {
                font-size: 30px;
            }

            input[type="email"],
            button {
                width: 100%;
            }

            .modal-content {
                max-width: 100%;
                margin: 20px;
            }

            .modal-body {
                padding: 20px;
                max-height: 65vh;
            }

            .file-input-wrapper {
                flex-direction: column;
            }

            .file-upload-btn {
                width: 100%;
                justify-content: center;
            }

            .countdown-container {
                gap: 10px;
            }

            .countdown-item {
                min-width: 60px;
                padding: 12px 8px;
            }

            .countdown-number {
                font-size: 26px;
            }

            .countdown-label {
                font-size: 12px;
            }
        }

        @media (max-width: 400px) {
            .modal-content {
                margin: 10px;
            }

            .modal-body {
                padding: 15px;
                max-height: 60vh;
            }

            .form-container {
                gap: 18px;
            }

            .countdown-item {
                min-width: 50px;
                padding: 10px 6px;
            }

            .countdown-number {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'تم بنجاح',
                    text: @json(session('success')),
                    confirmButtonText: 'حسناً',
                    customClass: {
                        popup: 'swal2-arabic'
                    }
                });
            });
        </script>
    @endif

    <video autoplay muted loop playsinline class="video-bg">
        <source src="metro.mp4" type="video/mp4" />
    </video>
    <div class="overlay"></div>

    <div class="header">
        <img class="logo" src="./user/assets/images/white_logo.svg" alt="شعار" />
        <div class="social-icons">
            <a href="https://www.youtube.com/@asswatdjazairia" target="_blank" aria-label="يوتيوب">
                <img src="./user/assets/icons/youtube.png" width="24" height="24" alt="يوتيوب" />
            </a>
            <a href="https://www.facebook.com/asswatdjazairia" target="_blank" aria-label="فيسبوك">
                <img src="./user/assets/icons/facebook.png" width="24" height="24" alt="فيسبوك" />
            </a>
            <a href="https://www.instagram.com/asswatdjazairia" target="_blank" aria-label="إنستغرام">
                <img src="./user/assets/icons/instagram.png" width="24" height="24" alt="إنستغرام" />
            </a>
            <a href="https://x.com/asswatdjazairia" target="_blank" aria-label="إكس">
                <img src="./user/assets/icons/x.png" width="24" height="24" alt="إكس" />
            </a>
        </div>
    </div>

    <div class="container">
        <div class="glass-box">
            <h1>أصوات جزائرية</h1>
            <p class="tagline">موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين</p>

            <!-- Countdown Timer -->
            <div class="countdown-container" id="countdown">
                <div class="countdown-item">
                    <div class="countdown-number" id="days">00</div>
                    <div class="countdown-label">
                        <span id="days-label">يوم</span>
                    </div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="hours">00</div>
                    <div class="countdown-label">
                        <span id="hours-label">ساعة</span>
                    </div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="minutes">00</div>
                    <div class="countdown-label">
                        <span id="minutes-label">دقيقة</span>
                    </div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="seconds">00</div>
                    <div class="countdown-label">
                        <span id="seconds-label">ثانية</span>
                    </div>
                </div>
            </div>
            <script>
                // Arabic pluralization helper
                function getArabicLabel(unit, value) {
                    value = Number(value);
                    if (unit === 'days') {
                        if (value === 1) return 'يوم';
                        if (value === 2) return 'يومان';
                        if (value >= 3 && value <= 10) return 'أيام';
                        return 'يوماً';
                    }
                    if (unit === 'hours') {
                        if (value === 1) return 'ساعة';
                        if (value === 2) return 'ساعتان';
                        if (value >= 3 && value <= 10) return 'ساعات';
                        return 'ساعة';
                    }
                    if (unit === 'minutes') {
                        if (value === 1) return 'دقيقة';
                        if (value === 2) return 'دقيقتان';
                        if (value >= 3 && value <= 10) return 'دقائق';
                        return 'دقيقة';
                    }
                    if (unit === 'seconds') {
                        if (value === 1) return 'ثانية';
                        if (value === 2) return 'ثانيتان';
                        if (value >= 3 && value <= 10) return 'ثواني';
                        return 'ثانية';
                    }
                    return '';
                }

                // Update labels on countdown tick
                function updateCountdownLabels() {
                    document.getElementById('days-label').textContent = getArabicLabel('days', document.getElementById('days')
                        .textContent);
                    document.getElementById('hours-label').textContent = getArabicLabel('hours', document.getElementById('hours')
                        .textContent);
                    document.getElementById('minutes-label').textContent = getArabicLabel('minutes', document.getElementById(
                        'minutes').textContent);
                    document.getElementById('seconds-label').textContent = getArabicLabel('seconds', document.getElementById(
                        'seconds').textContent);
                }

                // Patch the existing countdown update function
                setInterval(updateCountdownLabels, 1000);
                document.addEventListener("DOMContentLoaded", updateCountdownLabels);
            </script>

            <form id="email-form">
                <input type="email" placeholder="أدخل بريدك الإلكتروني" required />
                <button type="submit">أعلمني</button>
            </form>

            <button class="career-btn" id="career-btn">انضم إلى فريقنا</button>
        </div>
    </div>

    <!-- Enhanced Modal -->
    <div id="career-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close-btn" id="close-modal">&times;</span>
                <h2>انضم إلى فريقنا</h2>
                <p>شاركنا رحلتنا الإعلامية وكن جزءًا من فريقنا المتميز</p>
            </div>
            <div class="modal-body">
                <form action="/store-join-team" method="POST" enctype="multipart/form-data" id="career-form"
                    class="form-container">
                    @csrf
                    <!-- الاسم الكامل -->
                    <div class="form-row">
                        <label class="form-label">
                            الاسم الكامل
                            <span class="required-star">*</span>
                        </label>
                        <input type="text" name="fullname" class="form-input" placeholder="أدخل اسمك الكامل"
                            required />
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div class="form-row">
                        <label class="form-label">
                            البريد الإلكتروني
                            <span class="required-star">*</span>
                        </label>
                        <input type="email" name="email" class="form-input" placeholder="example@email.com"
                            required />
                    </div>

                    <!-- نوع الوظيفة -->
                    <div class="form-row">
                        <label class="form-label">
                            نوع الوظيفة
                            <span class="required-star">*</span>
                        </label>
                        <select name="reason" class="form-select" required>
                            <option value="" disabled selected>اختر نوع الوظيفة المناسبة لك</option>
                            <option value="journalist">صحافي/ محرّر</option>
                            <option value="infographic">أنفوغراف/ مركّب فيديو</option>
                            <option value="voiceover">معلّق صوتي</option>
                            <option value="audiovisual">صانع محتوى سمعي بصري</option>
                            <option value="translator">مترجم</option>
                            <option value="proofreader">مدقّق لغوي</option>
                        </select>
                    </div>

                    <!-- رسالة التقديم -->
                    <div class="form-row">
                        <label class="form-label">
                            لماذا تريد الانضمام إلى فريقنا؟
                            <span class="required-star">*</span>
                        </label>
                        <textarea name="message" class="form-textarea"
                            placeholder="أخبرنا عن دوافعك للانضمام إلى فريقنا، وخبراتك السابقة، وما الذي يمكنك تقديمه..." required></textarea>
                    </div>

                    <!-- رفع السيرة الذاتية -->
                    <div class="form-row">
                        <label class="form-label">السيرة الذاتية
                            <span class="required-star">*</span>
                        </label>
                        <div class="file-upload-container">
                            <div class="file-input-wrapper">
                                <div class="file-display" id="file-display">لم يتم اختيار ملف</div>
                                <label for="resume" class="file-upload-btn">
                                    <span class="upload-icon">📁</span>
                                    رفع الملف
                                </label>
                                <input required name="cv" type="file" id="resume" class="file-input"
                                    accept=".pdf,.doc,.docx" />
                            </div>
                            <div style="font-size: 13px; color: #718096;">
                                يُسمح بملفات PDF, DOC, DOCX بحد أقصى 5MB
                            </div>
                        </div>
                    </div>

                    <!-- زر الإرسال -->
                    <button type="submit" class="submit-btn">إرسال الطلب</button>
                </form>
                <div class="form-footer">
                    سنقوم بمراجعة طلبك والاتصال بك في أقرب وقت ممكن
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById("career-modal");
            const openBtn = document.getElementById("career-btn");
            const closeBtn = document.getElementById("close-modal");
            const fileInput = document.getElementById("resume");
            const fileDisplay = document.getElementById("file-display");

            // ✅ Set the target date ONCE (e.g., 30 days from page load)
            const targetDate = new Date();
            targetDate.setDate(targetDate.getDate() + 24);

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = targetDate.getTime() - now;

                if (distance <= 0) {
                    document.getElementById("days").textContent = "00";
                    document.getElementById("hours").textContent = "00";
                    document.getElementById("minutes").textContent = "00";
                    document.getElementById("seconds").textContent = "00";
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("days").textContent = days.toString().padStart(2, '0');
                document.getElementById("hours").textContent = hours.toString().padStart(2, '0');
                document.getElementById("minutes").textContent = minutes.toString().padStart(2, '0');
                document.getElementById("seconds").textContent = seconds.toString().padStart(2, '0');

                // Pulse animation when seconds update
                const secondsEl = document.getElementById("seconds");
                secondsEl.style.animation = 'pulse 0.5s ease';
                setTimeout(() => (secondsEl.style.animation = ''), 500);
            }

            // Initialize countdown
            updateCountdown();
            setInterval(updateCountdown, 1000);

            // ================= Modal =================
            openBtn.onclick = () => {
                modal.style.display = "flex";
                modal.scrollTop = 0;
            };

            closeBtn.onclick = () => (modal.style.display = "none");
            window.onclick = e => {
                if (e.target === modal) modal.style.display = "none";
            };
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') modal.style.display = "none";
            });

            // ================= File upload =================
            fileInput.onchange = () => {
                if (fileInput.files.length > 0) {
                    fileDisplay.textContent = fileInput.files[0].name;
                    fileDisplay.classList.add('has-file');
                } else {
                    fileDisplay.textContent = "لم يتم اختيار ملف";
                    fileDisplay.classList.remove('has-file');
                }
            };
        });
    </script>

</body>

</html>
