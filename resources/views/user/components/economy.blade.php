<style>
    .economy-grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        /* 4 equal cards side by side */
        gap: 20px;
    }

    .economy-card {
        display: flex;
        flex-direction: column;
    }

    .economy-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
    }

    .economy-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .economy-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .economy-card p {
        font-size: 14px;
        color: #555;
    }

    /* Cursor pointer for economy categories */
    .economy-card h3 {
        cursor: pointer;
        font-family: asswat-light;
        font-weight: lighter;
    }

    /* Cursor pointer + underline on hover for economy titles */
    .economy-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="economy-feature-grid">
    <div class="economy-grid-container">
        <div class="economy-card">
            <img src="./user/assets/images/IMG9.webp" alt="Feature economy">

            <h3>اقتصاد عالمي</h3>
            <h2>البنك الدولي يتوقع أسوأ عقد للنمو العالمي منذ الستينيات</h2>
        </div>
        <div class="economy-card">
            <img src="./user/assets/images/IMG10.webp" alt="Feature economy">

            <h3>اقتصاد عالمي</h3>
            <h2>ترمب يهدد «بريكس» مجدداً</h2>

        </div>
        <div class="economy-card">
            <img src="./user/assets/images/IMG11.webp" alt="Feature economy">

            <h3>اقتصاد عالمي</h3>
            <h2>«بلاكستون» تنسحب من صفقة شراء «تيك توك»</h2>
        </div>
        <div class="economy-card">
            <img src="./user/assets/images/IMG12.webp" alt="Feature economy">

            <h3>اقتصاد جزائري</h3>
            <h2>الرئيس الجزائري: احتياطي النقد الأجنبي عند 70 مليار دولار</h2>
        </div>
    </div>
</section>
