<style>
    .podcasts-grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .podcasts-card {
        display: flex;
        flex-direction: column;
    }

    .podcasts-card .image-wrapper {
        position: relative;
        /* مهم لتثبيت الأيقونة فقط داخل الصورة */
    }

    .podcasts-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .podcasts-card .video-icon {
        position: absolute;
        bottom: 15px;
        left: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .podcasts-card .video-icon svg {
        width: 16px;
        height: 16px;
        fill: #fff;
    }

    .podcasts-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .podcasts-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .podcasts-card p {
        font-size: 14px;
        color: #555;
    }

    /* جعل الهيدر قابل للنقر */
    .podcasts-card h3 {
        cursor: pointer;
    }

    /* إضافة تفاعل hover على العنوان */
    .podcasts-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>
<section class="podcasts-feature-grid">
    <div class="podcasts-grid-container container">
        <div class="podcasts-card">
            <div class="image-wrapper">
                <img src="./user/assets/images/IMG90.jpg" alt="Feature podcasts">
                <div class="video-icon">
                    <!-- أيقونة تشغيل SVG -->
                    @include('user.icons.headphones')
                </div>
            </div>
            <h3>منوعات</h3>
            <h2>أطعمة نحبها قد تختفي من حياتنا في المستقبل</h2>
        </div>

        <div class="podcasts-card">
            <div class="image-wrapper">
                <img src="./user/assets/images/IMG91.webp" alt="Feature podcasts">
                <div class="video-icon">
                    <!-- أيقونة تشغيل SVG -->
                    @include('user.icons.headphones')
                </div>
            </div>
            <h3>طفولة</h3>
            <h2>قصة محمد مع التعنيف الجسدي</h2>
        </div>

        <div class="podcasts-card">
            <div class="image-wrapper">
                <img src="./user/assets/images/IMG92.webp" alt="Feature podcasts">
                <div class="video-icon">
                    <!-- أيقونة تشغيل SVG -->
                    @include('user.icons.headphones')
                </div>
            </div>
            <h3>غزة اليوم</h3>
            <h2>قصف إسرائيلي يستهدف كنيسة العائلة المقدسة</h2>
        </div>

        <div class="podcasts-card">
            <div class="image-wrapper">
                <img src="./user/assets/images/IMG93.jpg" alt="Feature podcasts">
                <div class="video-icon">
                    <!-- أيقونة تشغيل SVG -->
                    @include('user.icons.headphones')
                </div>
            </div>
            <h3>خرافات</h3>
            <h2>الجانب المظلم للشبكة العنكبوتية</h2>
        </div>
    </div>
</section>
