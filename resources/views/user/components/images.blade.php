<style>
    .podcast-grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .podcast-card {
        position: relative;
        /* لتثبيت الأيقونة داخل الصورة */
        display: flex;
        flex-direction: column;
    }

    .podcast-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .podcast-card .video-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        padding: 8px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .podcast-card .video-icon svg {
        width: 16px;
        height: 16px;
        fill: #fff;
    }

    .podcast-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
    }

    .podcast-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .podcast-card p {
        font-size: 14px;
        color: #555;
    }
</style>

<section class="podcast-feature-grid">
    <div class="podcast-grid-container container">
        <div class="podcast-card">
            <img src="https://picsum.photos/1920/1080" alt="Feature podcast" loading="lazy">
            <div class="video-icon">
                <!-- أيقونة تشغيل SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </div>
            <h3>سياسة</h3>
            <h2>عنوان الخبر الأول</h2>
        </div>

        <div class="podcast-card">
            <img src="https://picsum.photos/1920/1080" alt="Feature podcast" loading="lazy">
            <div class="video-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </div>
            <h3>اقتصاد</h3>
            <h2>عنوان الخبر الثاني</h2>
        </div>

        <div class="podcast-card">
            <img src="https://picsum.photos/1920/1080" alt="Feature podcast" loading="lazy">
            <div class="video-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </div>
            <h3>رياضة</h3>
            <h2>عنوان الخبر الثالث</h2>
        </div>

        <div class="podcast-card">
            <img src="https://picsum.photos/1920/1080" alt="Feature podcast" loading="lazy">
            <div class="video-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </div>
            <h3>تكنولوجيا</h3>
            <h2>عنوان الخبر الرابع</h2>
        </div>
    </div>
</section>
