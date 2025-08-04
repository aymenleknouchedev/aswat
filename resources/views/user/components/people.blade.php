<style>
    .people-grid-container {
        display: grid;
        grid-template-columns: 8fr 4fr;
        /* Right: big, Left: list */
        gap: 20px;
    }

    .people-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .people-feature {
        position: relative;
        background-color: #F5F5F5;
    }

    .people-feature img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .people-feature .buttom-side {
        padding: 25px;
    }

    .people-feature h2 {
        font-size: 24px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
        line-height: 1.4;
    }

    .people-feature h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .people-feature p {
        font-size: 17px;
        color: #555;
        line-height: 1.5;
    }

    .people-feature-m img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .people-feature-m h2 {
        font-size: 18px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
        line-height: 1.4;
    }

    .people-feature-m h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .people-feature-m p {
        font-size: 14px;
        color: #555;
        line-height: 1.5;
    }

    .people-card-horizontal {
        display: flex;
        align-items: center;
        gap: 10px;
        direction: rtl;
        /* Image right, text left for Arabic */
    }

    .people-card-horizontal .people-card-image img {
        width: 140px;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .people-card-horizontal .people-card-text {
        flex: 1;
    }

    .people-card-horizontal .people-card-text h3 {
        font-size: 12px;
        margin: 0 0 4px;
        color: #74747C;
    }

    .people-card-horizontal .people-card-text p {
        font-size: 14px;
        margin: 0;
        font-family: asswat-medium;
        line-height: 1.4;
    }

    /* Cursor pointer for people categories */
    .people-feature h3,
    .people-feature-m h3,
    .people-card-horizontal .people-card-text h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for people titles */
    .people-feature h2:hover,
    .people-feature-m h2:hover,
    .people-card-horizontal .people-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>



<section class="people-feature-grid">
    <div class="people-grid-container">
        <!-- Right: big feature -->
        <div class="people-feature">
            <img src="./user/assets/images/IMG35.jpeg" alt="Feature people">
            <div class="buttom-side">
                <h3>فلسطين</h3>
                <h2>وسائل التواصل الاجتماعي تنتفض: الجوع يفتك بقطاع غزة</h2>
                <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع
                    سنوات
                    على تظاهرات مناهضة للحكومة.</p>
            </div>
        </div>

        <!-- Left: list -->
        <div class="people-list">
            <div class="people-feature-m">
                <img src="./user/assets/images/IMG36.jpg" alt="Feature people small">
                <h3>مجتمعات</h3>
                <h2>الصين تعلن خطة لتحفيز الإنجاب: 500 دولار سنويًا لكل طفل حتى سن الثالثة</h2>
            </div>

            <div class="people-feature-m">
                <img src="./user/assets/images/IMG37.jpg" alt="Feature people small">
                <h3>مجتمعات</h3>
                <h2>القاديانية.. 135 عامًا من الجدل حول النبوة والانتماء للإسلام</h2>
            </div>
        </div>
    </div>
</section>
