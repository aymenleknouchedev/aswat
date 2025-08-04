<style>
    .media-grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        /* 4 equal cards side by side */
        gap: 20px;
    }

    .media-card {
        display: flex;
        flex-direction: column;
    }

    .media-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
    }

    .media-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .media-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .media-card p {
        font-size: 14px;
        color: #555;
    }

    /* Cursor pointer for media category */
    .media-card h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline for media title on hover */
    .media-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="media-feature-grid">
    <div class="media-grid-container">
        <div class="media-card">
            <img src="./user/assets/images/IMG57.webp" alt="Feature media">
            <h3>مشهد</h3>
            <h2>كيف يؤطّر الإعلام المعارك ويتلاعب بسردياتها؟</h2>
        </div>

        <div class="media-card">
            <img src="./user/assets/images/IMG58.webp" alt="Feature media">
            <h3>منصات</h3>
            <h2>قنوات «فيسبوك».. هل تنجح في دعم الأخبار وتعزيز التفاعل؟</h2>
        </div>

        <div class="media-card">
            <img src="./user/assets/images/IMG59.jpg" alt="Feature media">
            <h3>صحافة</h3>
            <h2>دراسة أوروبية: الإعلام التقليدي محكوم عليه بالزوال</h2>
        </div>

        <div class="media-card">
            <img src="./user/assets/images/IMG60.jpg" alt="Feature media">
            <h3>الولايات المتحدة</h3>
            <h2>ترامب يقاضي "وول ستريت جورنال" ويطلب تعويضًا بعشرة مليارات دولار</h2>
        </div>
    </div>
</section>
