<style>
    .two-titles-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 20px;
    }

    .second-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .two-titles-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .two-titles-list-ite {
        margin-top: 12px;
        display: flex;
        align-items: center;
        direction: rtl;
        font-family: asswat-bold;
        border-bottom: 1px solid #ddd;
        /* الخط الرمادي */
        padding-bottom: 10px;
        /* مسافة بين النص والخط */
    }

    .two-titles-list-ite:last-child {
        border-bottom: none;
    }

    .two-titles-list-ite .number {
        font-size: 32px;
        color: #e7e7e7;
        margin-left: 10px;
        font-weight: bold;
    }

    .two-titles-list-ite p {
        font-size: 16px;
        color: #333;
        line-height: 1.4;
    }

    .two-titles-right-card {
        display: flex;
        flex-direction: column;
    }

    .two-titles-right-card img {
        width: 100%;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .two-titles-right-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .two-titles-right-card h2 {
        font-size: 18px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
        line-height: 1.4;
    }

    .two-titles-right-card p {
        font-size: 14px;
        margin: 8px 0 0;
        color: #555;
        line-height: 1.5;
    }

    .two-titles-files-card-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .two-titles-files-card {
        display: flex;
        align-items: center;
        gap: 15px;
        direction: rtl;
    }

    .two-titles-files-card-image {
        flex-shrink: 0;
        width: 120px;
    }

    .two-titles-files-card-image img {
        width: 100%;
        height: auto;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .two-titles-files-card-text span {
        font-size: 12px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .two-titles-files-card-text p {
        font-size: 14px;
        margin: 0;
        line-height: 1.4;
        font-family: asswat-bold;
        color: #333;
    }

    /* جعل النصوص قابلة للنقر */
    .two-titles-list-ite p {
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .two-titles-list-ite p:hover {
        color: #000;
        text-decoration: underline;
    }

    /* جعل النصوص قابلة للنقر */
    .two-titles-list-ite p {
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .two-titles-list-ite p:hover {
        color: #000;
        text-decoration: underline;
    }

    /* للعنوان في اليمين */
    .two-titles-right-card h2 {
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .two-titles-right-card h2:hover {
        color: #000;
        text-decoration: underline;
    }

    /* للبطاقات الصغيرة في العمود 2 */
    .two-titles-files-card-text p {
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .two-titles-files-card-text p:hover {
        color: #000;
        text-decoration: underline;
    }

    /* المؤشر والمؤثر للفئات */
    .two-titles-right-card h3,
    .two-titles-files-card-text span,
    .two-titles-list-ite .number {
        cursor: pointer;
    }
</style>

<section class="two-titles-grid">

    <!-- العمود 1 -->
    <div>
        <p class="section-title">الأكثر قراءة</p>
        @include('user.components.ligne')
        <div class="two-titles-list">
            <div class="two-titles-list-ite">
                <span class="number">1</span>
                <p>فاجعة في العراق.. وفاة 60 شخصًا على الأقل بحريق «مول الكوت» في واسط</p>
            </div>
            <div class="two-titles-list-ite">
                <span class="number">2</span>
                <p>يعاني منه دونالد ترمب.. إليك ما يجب أن تعرفه عن القصور الوريدي المزمن</p>
            </div>
            <div class="two-titles-list-ite">
                <span class="number">3</span>
                <p>جنبلاط طرح حلًّا لأحداث السويداء.. إليك النقاط التي عرضها</p>
            </div>
            <div class="two-titles-list-ite">
                <span class="number">4</span>
                <p>دماء وجثث في الأزقة.. صور تكشف انتهاكات بحق المدنيين في السويداء</p>
            </div>
            <div class="two-titles-list-ite">
                <span class="number">5</span>
                <p>هل تذهب إلى ألبانيزي أم ترمب؟ نوبل للسلام: تاريخ من التحيّزات</p>
            </div>
        </div>
    </div>


    <!-- العمود 2 -->
    <div>
        <p class="section-title">منوعات</p>
        @include('user.components.ligne')
        <div style="height: 20px;"></div>
        <div class="two-titles-right-card">
            <div class="second-grid">
                <div>
                    <img src="./user/assets/images/A1.jpg" alt="خبر">
                    <h3>مصر</h3>
                    <h2>دعوى قضائية لإلغاء حفل "سكوربيونز" بسبب دعمها الاحتلال الإسرائيلي</h2>
                    <p>أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد
                        أربع سنوات
                        على تظاهرات مناهضة للحكومة.</p>
                </div>

                <div class="two-titles-files-card-list">
                    <div class="two-titles-files-card">
                        <div class="two-titles-files-card-image">
                            <img src="./user/assets/images/A2.jpg" alt="كاتب الخبر">
                        </div>
                        <div class="two-titles-files-card-text">
                            <span>موسيقى</span>
                            <p>آمال ماهر تعود بألبوم "حاجة غير" بعد ست سنوات من الغياب</p>
                        </div>
                    </div>

                    <div class="two-titles-files-card">
                        <div class="two-titles-files-card-image">
                            <img src="./user/assets/images/A3.jpeg" alt="كاتب الخبر">
                        </div>
                        <div class="two-titles-files-card-text">
                            <span>ذكرى</span>
                            <p>نصف قرن على المصافحة السوفييتية الأميركية في الفضاء</p>
                        </div>
                    </div>

                    <div class="two-titles-files-card">
                        <div class="two-titles-files-card-image">
                            <img src="./user/assets/images/A4.jpg" alt="كاتب الخبر">
                        </div>
                        <div class="two-titles-files-card-text">
                            <span>فرنسا</span>
                            <p>فتح تحقيق في شيكات قدمها مبابي لضباط في الشرطة الفرنسية</p>
                        </div>
                    </div>

                    <div class="two-titles-files-card">
                        <div class="two-titles-files-card-image">
                            <img src="./user/assets/images/A5.jpeg" alt="كاتب الخبر">
                        </div>
                        <div class="two-titles-files-card-text">
                            <span>بريطانيا</span>
                            <p>لغز اختفاء أميرين صغيرين في برج لندن يعود إلى الواجهة بعد خمسة قرون</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
