<style>
    .news-grid-container {
        display: grid;
        grid-template-columns: 8fr 2fr 2fr;
        gap: 20px;
    }

    .news-list {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .news-item {
        height: 250px;
    }

    .news-item-noimage {
        height: 110px;
    }

    .news-item-noimage h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .news-item-noimage p {
        font-size: 16px;
        font-family: asswat-bold;
    }

    .news-feature h3 {
        font-size: 12px;
        margin: 0px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .news-item img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        display: block;
    }

    .news-item h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .news-item p {
        font-size: 16px;
        font-family: asswat-bold;
    }

    .news-feature {
        position: relative;
    }

    .news-feature img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
    }

    .news-feature h2 {
        font-size: 24px;
        margin: 0px 0px 8px 0;
        font-family: asswat-bold;
    }

    .news-feature h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;

    }

    .news-feature p {
        font-size: 17px;
        color: #555;
    }

    /* === Titles: underline + pointer === */
    .news-feature h2:hover,
    .news-item p:hover,
    .news-item-noimage p:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    /* === Categories: pointer only === */
    .news-feature h3:hover,
    .news-item h3:hover,
    .news-item-noimage h3:hover {
        cursor: pointer;
    }
</style>




<section class="news-feature-grid">
    <div class="news-grid-container">
        <!-- Right column: big feature -->
        <div class="news-feature">
            <img src="./user/assets/images/IMG27.webp" alt="Feature News">
            <h3>ذاكرة</h3>
            <h2>عودة بصرية إلى «المهرجان الثقافي الأفريقي» في الجزائر عام 1969</h2>
            <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات
                على تظاهرات مناهضة للحكومة.
            </p>
        </div>

        <!-- Left column: small news cards -->
        <div class="news-list">
            <div class="news-item">
                <img src="./user/assets/images/IMG23.jpg" alt="News 1">
                <h3>سياسة</h3>
                <p>ترمب: المواقع النووية الثلاثة في إيران دُمّرت بالكامل</p>
            </div>
            <div class="news-item">
                <img src="./user/assets/images/IMG25.jpg" alt="News 2">
                <h3>تاريخ</h3>
                <p>الثورة الجزائرية في ذكرى انتصارها الثالثة والسبعين</p>
            </div>
            <div class="news-item-noimage">
                <h3>القضية الفلسطينية</h3>
                <p>الشرطة البريطانية تُوقف عشرات من أنصار مجموعة «فلسطين أكشن»</p>
            </div>
        </div>

        <!-- Left column: small news cards -->
        <div class="news-list">
            <div class="news-item">
                <img src="./user/assets/images/IMG26.jpg" alt="News 3">
                <h3>القضية الفلسطينية</h3>
                <p>جورج عبد الله يشيد ﺑ«التعبئة» التي أدت إلى الإفراج عنه</p>
            </div>
            <div class="news-item">
                <img src="./user/assets/images/IMG24.webp" alt="News 4">
                <h3>الحرب على غزة</h3>
                <p>الفاتيكان يشكك في التصريحات الإسرائيلية بشأن الهجوم على كنيسة بغزة</p>
            </div>
            <div class="news-item-noimage">
                <h3>الولايات المتحدة</h3>
                <p>بعد عودته إلى الواجهة.. ما الملاحقات القضائية بحق إبستين وتداعياتها؟</p>
            </div>
        </div>
    </div>
</section>