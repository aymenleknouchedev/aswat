<style>
    .check-grid-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        /* 4 equal cards side by side */
        gap: 20px;
    }

    .check-card {
        display: flex;
        flex-direction: column;
    }

    .check-card img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
    }

    .check-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .check-card h2 {
        font-size: 24px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
    }

    .check-card p {
        font-size: 14px;
        color: #555;
    }

    /* تفعيل المؤشر */
    .check-card h3 {
        cursor: pointer;
    }

    /* تفعيل التحديد على العنوان عند التحويم */
    .check-card h2:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="check-feature-grid">
    <div class="check-grid-container">
        <div class="check-card">
            <img src="./user/assets/images/IMG80.webp" alt="Feature check">
            <h3>ذاكرة</h3>
            <h2>أم كلثوم.. هل غنت للثورة الجزائرية؟</h2>
            <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات
                على تظاهرات مناهضة للحكومة.</p>
        </div>

        <div class="check-card">
            <img src="./user/assets/images/IMG81.jpg" alt="Feature check">
            <h3>منصات</h3>
            <h2>العلاجات المتداولة على تيك توك: تضليل يفاقم معاناة المرضى</h2>
            <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات
                على تظاهرات مناهضة للحكومة.</p>
        </div>
    </div>
</section>
