<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      overflow: hidden;
    }

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
      background: rgba(0, 0, 0, 0.3);
      z-index: -1;
    }

    /* ✅ رأس الصفحة */
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
      width: 90px;
      animation: fadeInDown 1.2s ease;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    }

    .social-icons a {
      margin: 0 8px;
      display: inline-block;
      transition: transform 0.3s;
    }

    .social-icons a:hover {
      transform: scale(1.1);
    }

    .container {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 20px;
    }

    .glass-box {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 60px;
      max-width: 600px;
      width: 100%;
      animation: fadeInUp 1.5s ease;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    h1 {
      font-size: 42px;
      font-family: 'asswat-bold', sans-serif;
      margin-bottom: 25px;
      animation: fadeInDown 1.5s ease;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .tagline {
      font-size: 20px;
      margin-bottom: 20px;
      line-height: 1.6;
      animation: fadeIn 2s ease;
    }

    .animation-text {
      font-size: 20px;
      font-family: 'asswat-bold', sans-serif;
      margin: 40px 0;
      background: linear-gradient(90deg, #fff, #52B788, #fff);
      background-size: 200% auto;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: gradientMove 3s linear infinite;
    }

    form {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 25px;
    }

    input[type="email"] {
      padding: 14px 18px;
      border: none;
      width: 250px;
      font-size: 16px;
      background: rgba(255, 255, 255, 0.9);
      transition: all 0.3s ease;
      font-family: 'asswat-regular';
    }

    input[type="email"]:focus {
      background: #fff;
      box-shadow: 0 0 0 2px rgba(82, 183, 136, 0.5);
      outline: none;
    }

    button {
      padding: 14px 28px;
      background: #52B788;
      color: #fff;
      border: none;
      font-size: 16px;
      cursor: pointer;
      font-family: 'asswat-bold', sans-serif;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: 0.3s;
    }

    button:hover {
      background: #3d9e6c;
      transform: translateY(-2px);
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .career-btn {
      background: rgba(255, 255, 255, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.3);
      margin-top: 10px;
    }

    .career-btn:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    /* ✅ نافذة التوظيف */
    .modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.7);
      z-index: 1000;
      animation: fadeIn 0.3s ease;
    }

    .modal-content {
      position: relative;
      background: #fff;
      margin: 5% auto;
      padding: 40px;
      width: 90%;
      max-width: 500px;
      color: #333;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
      animation: slideIn 0.4s ease;
    }

    .close-btn {
      position: absolute;
      top: 15px;
      left: 15px;
      font-size: 28px;
      cursor: pointer;
      color: #555;
      transition: color 0.3s;
    }

    .close-btn:hover {
      color: #52B788;
    }

    .modal h2 {
      font-family: 'asswat-bold';
      color: #52B788;
      margin-bottom: 20px;
      font-size: 24px;
      text-align: center;
    }

    .modal form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      text-align: right;
    }

    .form-group label {
      font-size: 14px;
      font-weight: bold;
      margin-bottom: 6px;
      color: #333;
    }

    .modal input,
    .modal textarea,
    .modal select {
      padding: 12px 15px;
      border: 1px solid #ddd;
      font-size: 13px;
      transition: all 0.3s ease;
      font-family: 'asswat-regular';
    }

    .modal input:focus,
    .modal textarea:focus,
    .modal select:focus {
      border-color: #52B788;
      box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.3);
      outline: none;
    }

    .modal textarea {
      min-height: 100px;
      resize: vertical;
    }

    .file-input-container {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .file-input-label {
      background: #ffffff;
      color: #2e2e2e;
      padding: 10px 15px;
      cursor: pointer;
      font-family: 'asswat-regular';
      font-size: 13px;
      transition: 0.3s;
      border: #cecece solid 1px;
    }

    .file-input-label:hover {
      background: #e9e9e9;
      border: #e9e9e9 solid 1px;

    }

    .file-input {
      display: none;
    }

    .file-name {
      flex: 1;
      padding: 10px;
      border: 1px solid #ddd;
      background: #f9f9f9;
      font-size: 14px;
      color: #666;
    }

    .submit-btn {
      background: #52B788;
      color: #fff;
      border: none;
      padding: 14px;
      font-family: 'asswat-regular';
      cursor: pointer;
      box-shadow: none;
      transition: 0.3s;
    }

    .submit-btn:hover {
      background: #52B788;
      box-shadow: none;
    }

    /* ✅ Animations */
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

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
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

    /* ✅ Responsive */
    @media (max-width: 600px) {
      .header {
        flex-direction: column;
        gap: 10px;
        padding: 0 20px;
      }

      .logo {
        width: 120px;
      }

      .glass-box {
        padding: 40px 20px;
      }

      h1 {
        font-size: 32px;
      }

      .animation-text {
        font-size: 22px;
      }

      input[type="email"],
      button {
        width: 100%;
      }
    }

    .red-color {
      color: red;
    }
  </style>
</head>

<body>

  <video autoplay muted loop playsinline class="video-bg">
    <source src="metro.mp4" type="video/mp4">
  </video>
  <div class="overlay"></div>

  <!-- ✅ رأس الصفحة -->
  <div class="header">
    <img class="logo" src="./user/assets/images/white_logo.svg" alt="شعار">
    <div class="social-icons">
      <a href="https://www.facebook.com/asswatdjazairia" target="_blank">
        <img src="./user/assets/icons/facebook.png" width="24" height="24" alt="فيسبوك">
      </a>
      <a href="https://x.com/asswatdjazairia" target="_blank">
        <img src="./user/assets/icons/x.png" width="24" height="24" alt="إكس">
      </a>
      <a href="https://www.instagram.com/asswatdjazairia" target="_blank">
        <img src="./user/assets/icons/instagram.png" width="24" height="24" alt="إنستغرام">
      </a>
      <a href="https://www.youtube.com/@asswatdjazairia" target="_blank">
        <img src="./user/assets/icons/youtube.png" width="24" height="24" alt="يوتيوب">
      </a>
    </div>
  </div>

  <div class="container">
    <div class="glass-box">
      <h1>أصوات جزائرية</h1>
      <p class="tagline">موقع إخباري مستقل يُعنى بتقديم محتوًى إعلامي متوازن ورصين</p>
      <div class="animation-text" id="countdown"></div>

      <form id="email-form">
        <input class="form-control" type="email" placeholder="أدخل بريدك الإلكتروني" required>
        <button type="submit">أعلمني</button>
      </form>

      <button class="career-btn" id="career-btn">انضم إلى فريقنا</button>
    </div>
  </div>

  <div id="career-modal" class="modal">
    <div class="modal-content" style="max-width:650px; padding:20px;">
      <span class="close-btn" id="close-modal">&times;</span>
      <h2>انضم إلى فريقنا</h2>
      <form id="career-form" class="w-100">
        <div class="form-group" style="width:calc(100% - 35px);">
          <label>الاسم الكامل <span class="red-color">*</span></label>
          <input type="text" name="fullname" required style="width:100%;">
        </div>
        <div class="form-group" style="width:calc(100% - 35px);">
          <label>البريد الإلكتروني <span class="red-color">*</span></label>
          <input type="email" name="email" required style="width:100%;">
        </div>
        <div class="form-group" style="width:calc(100%);">
          <label>نوع الوظيفة <span class="red-color">*</span></label>
          <select name="reason" required style="width:100%;" class="form-group">
            <option value="journalist">صحافي/ محرّر</option>
            <option value="infographic">أنفوغراف/ مركّب فيديو</option>
            <option value="voiceover">معلّق صوتي </option>
            <option value="audiovisual">صانع محتوى سمعي بصري</option>
            <option value="translator">مترجم</option>
            <option value="proofreader">مدقّق لغوي</option>
          </select>
        </div>
        <div class="form-group" style="width:calc(100% - 35px);">
          <label>لماذا تريد الانضمام إلى فريقنا؟ <span class="red-color">*</span></label>
          <span style="font-size: 13px; color: gray; margin-bottom: 10px;">تحدّث عن نفسك ومهاراتك وإنجازاتك بشكل موجز،
            وما الذي تعتقد أنّ بإمكانك تقديمه لمشروع "أصوات جزائرية".</span>
          <textarea name="message" required style="width:100%; resize: none;"></textarea>
        </div>

        <div class="file-input-container" style="width:100%;">
          <span class="file-name" id="file-name" style="width:100%;">لم يتم اختيار ملف</span>
          <label for="resume" class="file-input-label">رفع السيرة الذاتية</label>
          <input type="file" name="cv" id="resume" class="file-input" accept=".pdf,.doc,.docx">
        </div>

        <button type="submit" class="submit-btn" style="width:100%;">إرسال الطلب</button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const careerBtn = document.getElementById('career-btn');
      const modal = document.getElementById('career-modal');
      const closeModal = document.getElementById('close-modal');
      const fileInput = document.getElementById('resume');
      const fileName = document.getElementById('file-name');

      // فتح النافذة
      careerBtn.addEventListener('click', () => {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
      });

      // إغلاق النافذة
      closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
        document.body.style.overflow = 'hidden';
      });

      // إغلاق عند النقر خارج المحتوى
      window.addEventListener('click', (e) => {
        if (e.target === modal) {
          modal.style.display = 'none';
          document.body.style.overflow = 'hidden';
        }
      });

      // عرض اسم الملف
      fileInput.addEventListener('change', function () {
        fileName.textContent = this.files.length ? this.files[0].name : 'لم يتم اختيار ملف';
      });

      // معالجة نموذج التوظيف
      document.getElementById('career-form').addEventListener('submit', function (e) {
        e.preventDefault();
        // if there is no file selected, alert the user
        if (!this.querySelector('input[name="cv"]').files.length) {
          alert('يرجى رفع سيرتك الذاتية للمتابعة.');
          return;
        }

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('fullname', this.querySelector('input[name="fullname"]').value);
        formData.append('email', this.querySelector('input[name="email"]').value);
        formData.append('message', this.querySelector('textarea[name="message"]').value);
        formData.append('cv', this.querySelector('input[name="cv"]').files[0]);
        formData.append('reason', this.querySelector('select[name="reason"]').value);

        fetch("{{ route('dashboard.store-join-team') }}", {
          method: "POST",
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // عرض رسالة نجاح جميلة داخل نافذة منبثقة
              const successMsg = document.createElement('div');
              successMsg.style.position = 'fixed';
              successMsg.style.top = '50%';
              successMsg.style.left = '50%';
              successMsg.style.transform = 'translate(-50%, -50%)';
              successMsg.style.background = '#fff';
              successMsg.style.color = '#52B788';
              successMsg.style.padding = '40px 30px';
              successMsg.style.borderRadius = '18px';
              successMsg.style.boxShadow = '0 8px 24px rgba(0,0,0,0.18)';
              successMsg.style.fontFamily = "'asswat-bold', sans-serif";
              successMsg.style.fontSize = '22px';
              successMsg.style.textAlign = 'center';
              successMsg.style.zIndex = '2000';
              successMsg.innerHTML = 'شكراً لتقديم طلبك!<br>سنتواصل معك قريباً.';

              document.body.appendChild(successMsg);

              setTimeout(() => {
                successMsg.remove();
                document.body.style.overflow = 'hidden';
              }, 3500);
            } else {
              alert('حدث خطأ أثناء تقديم الطلب: ' + data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
        modal.style.display = 'none';
        document.body.style.overflow = 'hidden';
        this.reset();
      });

      // معالجة نموذج البريد الإلكتروني
      document.getElementById('email-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        if (email) {
          alert('شكراً لك! سنقوم بإعلامك عند إطلاق الموقع.');
          this.reset();
        }
      });
    });
  </script>

  <!-- عدّاد تنازلي بسيط -->
  <style>
    /* ✅ Countdown Styling */
    .countdown-container {
      margin: 40px 0;
      display: flex;
      justify-content: center;
    }

    .countdown {
      display: flex;
      flex-direction: column;
      gap: 25px;
      font-family: 'asswat-bold', sans-serif;
      text-align: center;
      background: linear-gradient(90deg, #fff, #52B788, #fff);
      background-size: 200% auto;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: gradientMove 3s linear infinite;
    }

    .countdown .line {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .countdown .time-box {
      min-width: 90px;
      padding: 18px 12px;
      border-radius: 15px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: transform 0.3s;
    }

    .countdown .time-box:hover {
      transform: translateY(-5px) scale(1.05);
    }

    .countdown .number {
      font-size: 36px;
      margin-bottom: 5px;
    }

    .countdown .label {
      font-size: 15px;
      color: rgba(255, 255, 255, 0.85);
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const countdownElement = document.getElementById("countdown");
      const launchDate = new Date("Nov 1, 2025 00:00:00").getTime();

      const interval = setInterval(() => {
        const now = new Date().getTime();
        const distance = launchDate - now;

        if (distance <= 0) {
          clearInterval(interval);
          countdownElement.innerHTML = `
                <div class="line">
                    <div class="time-box">
                        <span class="number">🚀</span>
                        <span class="label">تم الإطلاق!</span>
                    </div>
                </div>`;
          return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownElement.innerHTML = `
            <div class="line" style="font-size: 30px; margin-bottom:10px;">
                <div class="time-box">
                <span class="number"> باق ${days}</span>
                <span class="label">${days === 1
            ? 'يوم واحد'
            : days <= 3
              ? 'أيام'
              : days < 10
                ? 'أيام'
                : 'يومًا'
          }</span>
                </div>
            </div>
            <div class="line">
              <div class="time-box">
                <span class="number">${hours}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}</span>
              </div>
            </div>
          `;
      }, 1000);
    });
  </script>


</body>

</html>