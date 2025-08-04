<style>
    .files-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .files-card {
        display: flex;
        flex-direction: row;
        align-items: flex-top;
        gap: 15px;
        direction: rtl;
        /* For Arabic alignment */
    }

    .files-card .files-card-image {
        flex-shrink: 0;
        width: 160px;
        /* ثابت أو نسبي حسب المساحة */
        aspect-ratio: 16/9;
    }

    .files-card .files-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .files-card .files-card-text {
        flex: 1;
    }

    .files-card .files-card-text p {
        font-size: 14px;
        margin: 0 0 4px;
        font-family: asswat-bold;
        color: #333;
        line-height: 1.4;
    }

    .files-card .files-card-text span {
        font-size: 12px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    /* Cursor pointer for files categories */
    .files-card .files-card-text span {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for files titles */
    .files-card .files-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="files-feature-grid">
    <div class="files-grid-container">
        <div class="files-card">
            <div class="files-card-image">
                <img src="./user/assets/images/IMG45.jpg" alt="كاتب الخبر">
            </div>
            <div class="files-card-text">
                <span>مسار</span>
                <p>نيلسون مانديلا... من النضال السرّي إلى إسقاط نظام الفصل العنصري</p>
            </div>
        </div>

        <div class="files-card">
            <div class="files-card-image">
                <img src="./user/assets/images/IMG46.webp" alt="كاتب الخبر">
            </div>
            <div class="files-card-text">
                <span>سياسة</span>
                <p>موريتانيا والتطبيع.. هل ينطلق قطار «اتفاقيات أبراهام» من نواكشوط مجددًا؟</p>
            </div>
        </div>

        <div class="files-card">
            <div class="files-card-image">
                <img src="./user/assets/images/IMG47.webp" alt="كاتب الخبر">
            </div>
            <div class="files-card-text">
                <span>أسئلة</span>
                <p>التقارب الجزائري الأميركي.. هل ينهي الهيمنة الاقتصادية الصينية؟</p>
            </div>
        </div>
    </div>
</section>
