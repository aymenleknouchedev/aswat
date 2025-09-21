<style>
    .many-titles-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .many-titles-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }



    .many-titles-feature-m {
        height: 355px;
    }

    .many-titles-feature-m img {
        width: 100%;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .many-titles-feature-m h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .many-titles-feature-m h2 {
        font-size: 18px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
        line-height: 1.4;
    }

    .many-titles-feature-m .top {
        height: 291px;
    }



    .many-titles-feature-m p {
        font-size: 14px;
        margin-top: 8px;
        line-height: 1.5;
        color: #555;
    }

    .many-titles-card {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        direction: rtl;
    }

    .many-titles-card-image {
        flex-shrink: 0;
        width: 120px;
    }

    .many-titles-card-image img {
        width: 100%;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .many-titles-card-text span {
        font-size: 12px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .many-titles-card-text p {
        font-size: 14px;
        margin: 0;
        line-height: 1.4;
        font-family: asswat-bold;
        color: #333;
    }

    /* Cursor pointer for many-titles categories */
    .many-titles-card-text span {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for many-titles titles */
    .many-titles-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    /* Cursor pointer + underline for main feature h2 titles */
    .many-titles-feature-m h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    /* Cursor pointer for main feature h3 categories */
    .many-titles-feature-m h3 {
        cursor: pointer;
    }

    @media (max-width: 1050px) {
        .many-titles-feature-m .top {
            height: 260px;
        }

        .many-titles-card-text p {
            font-size: 12px;
        }
    }
</style>

<section class="many-titles-feature-grid">
    <div class="many-titles-grid-container">

        <!-- Column 1 -->
        <div>
            <p class="section-title">تكنولوجيا</p>
            <div class="many-titles-column">
                @include('user.components.ligne')

                <div class="many-titles-feature-m">
                    <div class="top">
                        <img src="./user/assets/images/IMG48.jpg" alt="Feature people small">
                        <h3>تقنية</h3>
                        <h2>«أوبن إيه آي» تطلق «تشات جي بي تي» الجديد.. يتصفح ويحلل ويقرر</h2>
                    </div>
                    <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد
                        أربع سنوات
                        على تظاهرات مناهضة للحكومة.</p>
                </div>

                <div class="many-titles-card">
                    <div class="many-titles-card-image">
                        <img src="./user/assets/images/IMG49.jpg" alt="كاتب الخبر">
                    </div>
                    <div class="many-titles-card-text">
                        <span>تقنية</span>
                        <p>السباق نحو «الأطفال الخارقين» يُشعل وادي السيليكون</p>
                    </div>
                </div>

                <div class="many-titles-card">
                    <div class="many-titles-card-image">
                        <img src="./user/assets/images/IMG50.jpeg" alt="كاتب الخبر">
                    </div>
                    <div class="many-titles-card-text">
                        <span>تقنية</span>
                        <p>"نتفليكس" تستخدم الذكاء الاصطناعي لأول مرة في أحد مسلسلاتها</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Column 2 -->
        <div>
            <p class="section-title">صحة</p>
            <div class="many-titles-column">
                @include('user.components.ligne')

                <div class="many-titles-feature-m">
                    <div class="top">
                        <img src="./user/assets/images/IMG51.webp" alt="Feature people small">
                        <h3>تغذية</h3>
                        <h2>هل يجب التوقف عن أكل البيض لحماية القلب؟</h2>
                    </div>
                    <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد
                        أربع سنوات
                        على تظاهرات مناهضة للحكومة.</p>
                </div>

                <div class="many-titles-card">
                    <div class="many-titles-card-image">
                        <img src="./user/assets/images/IMG52.jpg" alt="كاتب الخبر">
                    </div>
                    <div class="many-titles-card-text">
                        <span>الصحة العالمية</span>
                        <p>أكثر من 14 مليون طفل حُرموا من اللقاحات عام 2024</p>
                    </div>
                </div>

                <div class="many-titles-card">
                    <div class="many-titles-card-image">
                        <img src="./user/assets/images/IMG53.jpg" alt="كاتب الخبر">
                    </div>
                    <div class="many-titles-card-text">
                        <span>تغذية</span>
                        <p>سبعة آثار جانبية خطيرة للكرياتين</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Column 3 -->
        <div>
            <p class="section-title">بيئة</p>
            <div class="many-titles-column">
                @include('user.components.ligne')

                <div class="many-titles-feature-m">
                    <div class="top">
                        <img src="./user/assets/images/IMG54.webp" alt="Feature people small">
                        <h3>مناخ</h3>
                        <h2>موجة الحر في أوروبا أودت بحياة 2300 شخص</h2>
                    </div>
                    <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد
                        أربع سنوات
                        على تظاهرات مناهضة للحكومة.</p>
                </div>

                <div class="many-titles-card">
                    <div class="many-titles-card-image">
                        <img src="./user/assets/images/IMG55.webp" alt="كاتب الخبر">
                    </div>
                    <div class="many-titles-card-text">
                        <span>مناخ</span>
                        <p>«ناسا»: مستويات سطح البحار ارتفعت أكثر من المتوقع عام 2024</p>
                    </div>
                </div>

                <div class="many-titles-card">
                    <div class="many-titles-card-image">
                        <img src="./user/assets/images/IMG56.webp" alt="كاتب الخبر">
                    </div>
                    <div class="many-titles-card-text">
                        <span>بيئة</span>
                        <p>طيور الكركي الرمادية تعاود الظهور في مستنقعات رواندا بفضل طبيب بيطري</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
