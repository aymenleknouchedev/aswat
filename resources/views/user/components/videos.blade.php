<style>
    .videos-grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .videos-card {
        display: flex;
        flex-direction: column;
    }

    .videos-card .image-wrapper {
        position: relative;
        /* مهم لتثبيت الأيقونة فقط داخل الصورة */
    }

    .videos-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .videos-card .video-icon {
        position: absolute;
        bottom: 15px;
        left: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .videos-card .video-icon svg {
        width: 16px;
        height: 16px;
        fill: #fff;
    }

    .videos-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .videos-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .videos-card p {
        font-size: 14px;
        color: #555;
    }

    /* Cursor pointer for videos categories */
    .videos-card h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for videos titles */
    .videos-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="videos-feature-grid">
    <div class="videos-grid-container container">
        <div class="videos-card">
            <div class="image-wrapper">
                <img src="./user/assets/images/IMG41.jpg" alt="Feature videos">
                <div class="video-icon">
                    <!-- أيقونة تشغيل SVG -->
                    @include('user.icons.play')
                </div>
            </div>
            <h3>تركيا</h3>
            <h2>«العمال الكردستاني».. من صعود الجبل حتى إنزال البندقية</h2>
        </div>

        <div class="videos-card">
            <div class="image-wrapper">
                <img src="./user/assets/images/IMG42.jpg" alt="Feature videos">
                <div class="video-icon">
                    <!-- أيقونة تشغيل SVG -->
                    @include('user.icons.play')
                </div>
            </div>
            <h3>فلسطين</h3>
            <h2>غزة.. ترجيح هدنة مؤقتة</h2>
        </div>

        <div class="videos-card">
            <div class="image-wrapper">
                <img src="./user/assets/images/IMG43.jpg" alt="Feature videos">
                <div class="video-icon">
                    <!-- أيقونة تشغيل SVG -->
                    @include('user.icons.play')
                </div>
            </div>
            <h3>آسيا</h3>
            <h2>الهند وباكستان تتراجعان عن حافة الهاوية</h2>
        </div>

        <div class="videos-card">
            <div class="image-wrapper">
                <img src="./user/assets/images/IMG44.jpg" alt="Feature videos">
                <div class="video-icon">
                    <!-- أيقونة تشغيل SVG -->
                    @include('user.icons.play')
                </div>
            </div>
            <h3>السودان</h3>
            <h2>البرهان من القصر الرئاسي: الخرطوم حرة</h2>
        </div>
    </div>
</section>
