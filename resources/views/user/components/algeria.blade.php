<style>
    .algeria-grid-container {
        display: grid;
        grid-template-columns: 8fr 4fr;
        /* Right: big, Left: list */
        gap: 20px;
    }

    .algeria-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .algeria-feature {
        position: relative;
    }

    .algeria-feature img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .algeria-feature h2 {
        font-size: 24px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
        line-height: 1.4;
    }

    .algeria-feature h3 {
        font-family: asswat-light;
        font-weight: lighter;
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
    }

    .algeria-feature p {
        font-size: 17px;
        color: #555;
        line-height: 1.5;
    }

    .algeria-feature-m img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    .algeria-feature-m h2 {
        font-size: 18px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
        line-height: 1.4;
    }

    .algeria-feature-m h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .algeria-feature-m p {
        font-size: 14px;
        color: #555;
        line-height: 1.5;
    }

    .news-card-horizontal {
        display: flex;
        align-items: center;
        gap: 10px;
        direction: rtl;
        /* Image right, text left for Arabic */
    }

    .news-card-horizontal .news-card-image img {
        width: 140px;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .news-card-horizontal .news-card-text {
        flex: 1;
    }

    .news-card-horizontal .news-card-text h3 {
        font-size: 12px;
        margin: 0 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .news-card-horizontal .news-card-text p {
        font-size: 14px;
        margin: 0;
        font-family: asswat-medium;
        line-height: 1.4;
    }

    .algeria-extra-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        background: #f5f5f5;
        margin-top: 30px;
    }

    .extra-item {
        position: relative;
        padding: 15px;
    }

    .extra-item h3 {
        font-size: 12px;
        color: #74747C;
        margin: 0 0 5px;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .extra-item p {
        font-size: 16px;
        font-family: asswat-medium;
        line-height: 1.5;
        margin: 0;
    }

    /* .extra-item:not(:first-child)::after {
        content: "";
        position: absolute;
        top: 15%;
        right: 0;
        height: 70%;
        width: 1px;
        background: #ccc;
    } */


    /* Cursor pointer for categories (h3) */
    .algeria-feature h3,
    .algeria-feature-m h3,
    .news-card-horizontal .news-card-text h3,
    .extra-item h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for titles (h2) */
    .algeria-feature h2:hover,
    .algeria-feature-m h2:hover,
    .news-card-horizontal .news-card-text p:hover,
    .extra-item p:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    @media (max-width: 992px) {
        .algeria-grid-container {
            grid-template-columns: 1fr;
        }

        .algeria-grid-container .algeria-list {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }

        .algeria-grid-container .algeria-list-div {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .algeria-grid-container .algeria-list-div .news-card-horizontal {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: flex-start
        }

        .algeria-grid-container .algeria-list-div .news-card-horizontal img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .algeria-grid-container .algeria-list-div .news-card-text p {
            font-weight: bold;
        }

    }
</style>



<section class="algeria-feature-grid">
    <div class="algeria-grid-container">
        <!-- Right: big feature -->
        <div class="algeria-feature">
            <img src="./user/assets/images/IMG21.jpg" alt="Feature algeria">
            <h3>سياسة</h3>
            <h2>تبون: الجزائر ليست معزولة دوليًا</h2>
            <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات
                على تظاهرات مناهضة للحكومة.</p>
        </div>

        <!-- Left: list -->
        <div class="algeria-list">
            <div class="algeria-feature-m">
                <img src="./user/assets/images/IMG22.jpg" alt="Feature algeria small">
                <h3>سياسة</h3>
                <h2>بوادر أزمة حادة بين الجزائر والاتحاد الأوروبي بسبب «اتفاق الشراكة»</h2>
                <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع
                    سنوات على تظاهرات مناهضة للحكومة.
                </p>
            </div>

            <div class="algeria-list-div">
                <div class="news-card-horizontal">
                    <div class="news-card-image">
                        <img src="./user/assets/images/IMG20.jpg" alt="تحلية مياه البحر">
                    </div>
                    <div class="news-card-text">
                        <h3>اقتصاد جزائري</h3>
                        <p>الجزائر تُسرّع وتيرة تحلية مياه البحر لتفكيك «قنبلة العطش»</p>
                    </div>
                </div>

                <div class="news-card-horizontal">
                    <div class="news-card-image">
                        <img src="./user/assets/images/IMG19.jpg" alt="بوعلام صنصال">
                    </div>
                    <div class="news-card-text">
                        <h3>سياسة</h3>
                        <p>تثبيت الحكم بسجن الكاتب بوعلام صنصال خمس سنوات</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra Titles Grid -->
    <div class="algeria-extra-grid">
        <div class="extra-item">
            <h3>سياسة</h3>
            <p>الحكومة الجزائرية تعتمد قانونًا جديدًا لمكافحة غسل الأموال</p>
        </div>
        <div class="extra-item">
            <h3>سياسة</h3>
            <p>الجزائر وموريتانيا تتفقان على إطلاق «آلية تنسيق» بالحدود</p>
        </div>
        <div class="extra-item">
            <h3>سياسة</h3>
            <p>تعزيز التعاون الجزائري - السويسري لاسترداد ثروات مهربة في فترة بوتفليقة</p>
        </div>
        <div class="extra-item">
            <h3>سياسة</h3>
            <p>سجن ثلاثة مترشحين سابقين للرئاسة بتهم فساد مالي</p>
        </div>
    </div>
</section>



</section>
