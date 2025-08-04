<style>
    .sport-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* 3 equal columns */
        gap: 20px;
    }

    .sport-feature {
        display: flex;
        flex-direction: column;
    }

    .sport-feature img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .sport-feature h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .sport-feature h2 {
        font-size: 16px;
        margin: 0px 0px 4px 0px;
        font-family: asswat-bold;
        color: #333;
    }

    .sport-feature p {
        font-size: 13px;
        color: #555;
        /* margin-top: 25px; */
    }

    .sport-card-horizontal {
        display: flex;
        align-items: center;
        gap: 10px;
        direction: rtl;
    }

    .sport-card-horizontal .sport-card-image img {
        width: 120px;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .sport-card-horizontal .sport-card-text {
        flex: 1;
    }

    .sport-card-horizontal .sport-card-text h3 {
        font-size: 12px;
        margin: 0 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .sport-card-horizontal .sport-card-text p {
        font-size: 14px;
        margin: 0;
        font-family: asswat-medium;
        line-height: 1.4;
    }

    .sport-column {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Cursor pointer for sport categories */
    .sport-feature h3,
    .sport-card-horizontal .sport-card-text h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for sport titles */
    .sport-feature h2:hover,
    .sport-card-horizontal .sport-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="sport-feature-grid">
    <div class="sport-grid-container">
        <!-- Column 1 -->
        <div class="sport-feature">
            <img src="./user/assets/images/IMG30.webp" alt="Feature sport">
            <h3>كرة قدم</h3>
            <h2>ريان آيت نوري أمام فرصة العمر في «سيتي»</h2>
            <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات
                على تظاهرات مناهضة للحكومة.</p>
        </div>

        <!-- Column 2 -->
        <div class="sport-feature">
            <img src="./user/assets/images/IMG31.jpg" alt="Feature sport">
            <h3>كرة قدم</h3>
            <h2>«مانشستر يونايتد» يلاحق هشام بوداوي.. وسبب غريب يمنع إتمام الصفقة</h2>
            <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات
                على تظاهرات مناهضة للحكومة.</p>
        </div>

        <!-- Column 3: 4 stacked rows -->
        <div class="sport-column">
            <div class="sport-card-horizontal">
                <div class="sport-card-image">
                    <img src="./user/assets/images/IMG33.jpg" alt="خبر">
                </div>
                <div class="sport-card-text">
                    <h3>ألعاب أولمبية</h3>
                    <p>«الدوري الماسي»: الجامايكي سيفيل يفاجئ لايلز في لندن</p>
                </div>
            </div>

            <div class="sport-card-horizontal">
                <div class="sport-card-image">
                    <img src="./user/assets/images/IMG29.jpg" alt="خبر">
                </div>
                <div class="sport-card-text">
                    <h3>كرة قدم</h3>
                    <p>تفاصيل أزمة يوسف بلايلي مع «الترجي»</p>
                </div>
            </div>

            <div class="sport-card-horizontal">
                <div class="sport-card-image">
                    <img src="./user/assets/images/IMG34.webp" alt="خبر">
                </div>
                <div class="sport-card-text">
                    <h3>كرة قدم</h3>
                    <p>أخيراً... مبيومو إلى «مانشستر يونايتد»</p>
                </div>
            </div>

            <div class="sport-card-horizontal">
                <div class="sport-card-image">
                    <img src="./user/assets/images/IMG32.jpg" alt="خبر">
                </div>
                <div class="sport-card-text">
                    <h3>كرة قدم</h3>
                    <p>برشلونة يقترب من التعاقد مع ماركوس راشفورد</p>
                </div>
            </div>
        </div>
    </div>
</section>
