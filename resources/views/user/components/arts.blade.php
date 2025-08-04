<style>
    .arts-grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        /* 4 equal cards side by side */
        gap: 20px;
    }

    .arts-card {
        display: flex;
        flex-direction: column;
    }

    .arts-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
    }

    .arts-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .arts-card h2 {
        font-size: 16px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .arts-card p {
        font-size: 14px;
        color: #555;
    }

    /* Cursor pointer for arts categories */
    .arts-card h3 {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for arts titles */
    .arts-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="arts-feature-grid">
    <div class="arts-grid-container">
        <div class="arts-card">
            <img src="./user/assets/images/IMG15.jpg" alt="Feature arts">
            <h3>سينما</h3>
            <h2>حين حاكم يوسف شاهين نفسه</h2>
        </div>

        <div class="arts-card">
            <img src="./user/assets/images/IMG1.webp" alt="Feature arts">
            <h3>تشكيل</h3>
            <h2>ملهمة بيكاسو.. غوغل يحتفل بذكرى ميلاد باية</h2>
        </div>
        <div class="arts-card">
            <img src="./user/assets/images/IMG5.webp" alt="Feature arts">
            <h3>كتب</h3>
            <h2>من قلب المركز إلى هامش العالم.. كيف تعيد الرأسمالية إنتاج الهيمنة؟</h2>
        </div>
        <div class="arts-card">
            <img src="./user/assets/images/IMG3.webp" alt="Feature arts">
            <h3>أدب</h3>
            <h2>أبناء الشبكة العنكبوتية.. الكافكاوية كما نعيشها اليوم</h2>
        </div>
        <div class="arts-card">
            <img src="./user/assets/images/IMG6.webp" alt="Feature arts">
            <h3>كتاب</h3>
            <h2>صحيفة «فلسطين» اليافوية تعود لتروي قصة الوطن بين عامي 1911 و1948</h2>
        </div>
        <div class="arts-card">
            <img src="./user/assets/images/IMG4.webp" alt="Feature arts">
            <h3>آثار</h3>
            <h2>داكار- جيبوتي.. بعثة فرنسية سرقت كنوز أفريقيا الفنية</h2>
        </div>
        <div class="arts-card">
            <img src="./user/assets/images/IMG7.webp" alt="Feature arts">
            <h3>نقد</h3>
            <h2>هل ما زال الأدب قادرًا على تغيير العالم؟</h2>
        </div>
        <div class="arts-card">
            <img src="./user/assets/images/IMG2.webp" alt="Feature arts">
            <h3>فكر</h3>
            <h2>«معذبو الأرض».. لماذا لا تزال أفكار فرانتز فانون ملهمة؟</h2>
        </div>
    </div>
</section>
