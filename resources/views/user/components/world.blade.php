<style>
    .world-grid-container {
        display: grid;
        grid-template-columns: 6fr 3fr 3fr;
        gap: 20px;
    }

    .world-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .world-feature {
        position: relative;
    }

    .world-feature img {
        width: 100%;
        aspect-ratio: 16 / 9;

    }

    .world-feature h2 {
        font-size: 24px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
    }

    .world-feature h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .world-feature p {
        font-size: 17px;
        color: #555;
    }

    .world-feature-m {
        height: 243px;

    }

    .world-feature-m img {
        width: 100%;
        aspect-ratio: 16 / 9;

    }

    .world-feature-m h2 {
        font-size: 16px;
        margin-top: 8px 0px;
        font-family: asswat-bold;
    }

    .world-feature-m h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .world-feature-m p {
        font-size: 14px;
        color: #555;
    }

    .world-feature h3,
    .world-feature-m h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for world titles */
    .world-feature h2:hover,
    .world-feature-m h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>



<section class="world-feature-grid">
    <div class="world-grid-container">
        <!-- Right column: big feature -->
        <div class="world-feature">
            <img src="./user/assets/images/IMG17.webp" alt="Feature world">

            <h3>سوريا</h3>
            <h2>عودة المواجهات إلى السويداء رغم إعلان وقف إطلاق النار
            </h2>
            <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات
                على تظاهرات مناهضة للحكومة.
            </p>
        </div>

        <!-- Left column: small world cards -->
        <div class="world-list">
            <div class="world-feature-m">
                <img src="./user/assets/images/IMG14.webp" alt="Feature world">
                <h3>فلسطين</h3>
                <h2>استشهاد 68 فلسطينيًا في غارات إسرائيلية متواصلة على غزة</h2>
            </div>
            <div class="world-feature-m">
                <img src="./user/assets/images/IMG13.webp" alt="Feature world">
                <h3>إيران</h3>
                <h2>عراقجي: مستعدون للتفاوض مع أميركا إذا عوّضتنا عن الأضرار التي لحقت بنا</h2>
            </div>
        </div>

        <!-- Left column: small world cards -->
        <div class="world-list">
            <div class="world-feature-m">
                <img src="./user/assets/images/IMG18.jpg" alt="Feature world">
                <h3>أفريقيا</h3>
                <h2>اتفاق لوقف النار بين الكونغو والمتمردين</h2>
            </div>
            <div class="world-feature-m">
                <img src="./user/assets/images/IMG16.jpg" alt="Feature world">
                <h3>آسيا</h3>
                <h2>اتهام رئيس كوريا الجنوبية السابق بإساءة استخدام السلطة</h2>
            </div>
        </div>

    </div>
</section>
