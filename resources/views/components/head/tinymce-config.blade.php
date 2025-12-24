<!-- VVC Media Modal + TinyMCE 8 with READ MORE Feature - OPTIMIZED -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ============================================
     SECTION 1: SVG ICONS SPRITE
     ============================================ -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
    <!-- Image icon for media thumbnails -->
    <symbol id="vvc-icon-image" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <circle cx="8" cy="10" r="1.5" fill="currentColor" />
        <path d="M21 19l-5.5-7-4.5 6-3-4-4 5" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <!-- Video icon for media thumbnails -->
    <symbol id="vvc-icon-video" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
</svg>

<!-- ============================================
     SECTION 2: MEDIA MODAL
     ============================================ -->
<div id="vvcMediaModal" class="vvc-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="vvcMediaModalTitle">
    <div class="vvc-backdrop" data-vvc-backdrop></div>
    <div class="vvc-container" role="document">
        <!-- Header with title and close button -->
        <div class="vvc-header">
            <h5 id="vvcMediaModalTitle">اختر الوسائط</h5>
            <button class="vvc-close" type="button" data-vvc-close aria-label="إغلاق">&times;</button>
        </div>

        <!-- Tab navigation: Gallery, Upload, and Import -->
        <div class="vvc-tabs" role="tablist" aria-label="أقسام إدارة الوسائط">
            <button type="button" class="vvc-tab-btn vvc-is-active" role="tab" aria-selected="true"
                aria-controls="vvc-tab-gallery" id="vvc-tabbtn-gallery" tabindex="0"
                data-vvc-tab="gallery">المعرض</button>
            <button type="button" class="vvc-tab-btn" role="tab" aria-selected="false"
                aria-controls="vvc-tab-upload" id="vvc-tabbtn-upload" tabindex="-1" data-vvc-tab="upload">الرفع من
                الجهاز</button>
            <button type="button" class="vvc-tab-btn" role="tab" aria-selected="false"
                aria-controls="vvc-tab-import" id="vvc-tabbtn-import" tabindex="-1" data-vvc-tab="import">استيراد عبر
                رابط</button>
        </div>

        <!-- GALLERY TAB: Browse existing media -->
        <section id="vvc-tab-gallery" class="vvc-tab-panel" role="tabpanel" aria-labelledby="vvc-tabbtn-gallery">
            <!-- Search and filter controls -->
            <div class="vvc-filters">
                <input type="text" id="vvc-search" placeholder="ابحث عن وسائط..." />
                <select id="vvc-type-filter" aria-label="نوع الوسائط">
                    <option value="all">كل الوسائط</option>
                    <option value="image">صورة</option>
                    <option value="video">فيديو</option>
                </select>
            </div>
            <!-- Media grid display area -->
            <div class="vvc-body">
                <div id="vvc-list" class="vvc-grid"></div>
                <div id="vvc-loader" class="vvc-loader" hidden>جاري التحميل...</div>
                <!-- Sentinel element for infinite scroll detection -->
                <div id="vvc-sentinel" class="vvc-sentinel"></div>
            </div>
            <!-- Footer with action buttons -->
            <div class="vvc-footer">
                <button class="vvc-btn vvc-btn-select" type="button" id="vvc-btn-select" disabled>اختر</button>
                <button class="vvc-btn vvc-btn-cancel" type="button" data-vvc-close>إلغاء</button>
            </div>
        </section>

        <!-- UPLOAD TAB: Upload new media -->
        <section id="vvc-tab-upload" class="vvc-tab-panel" role="tabpanel" aria-labelledby="vvc-tabbtn-upload" hidden>
            <div class="vvc-tab-body">
                <div class="vvc-uploader">
                    <!-- File input fields: file picker, name, alt text -->
                    <div class="vvc-upload-fields" style="display:flex;flex-wrap:wrap;gap:.6rem;width:100%;">
                        <!-- File picker field -->
                        <div style="flex:1 1 260px;">
                            <label for="vvc-upload-input" id="vvc-upload-label"
                                style="display:block;width:100%;cursor:pointer;padding:.6rem .7rem;border:1px solid var(--bs-border-color);background:var(--bs-body-bg);color:var(--bs-body-color);text-align:center;border-radius:var(--bs-border-radius);">
                                <i class="fa fa-upload" style="margin-left:6px;"></i>
                                <span id="vvc-upload-label-text">اختر ملف الوسائط</span>
                                <input type="file" id="vvc-upload-input" class="vvc-upload-input"
                                    accept="image/*,video/*" style="display:none;" />
                            </label>
                        </div>
                        <!-- Media name field -->
                        <div style="flex:1 1 220px;">
                            <input type="text" id="vvc-upload-name" class="vvc-upload-name"
                                placeholder="اسم الملف"
                                style="width:100%;padding:.6rem .7rem;border:1px solid var(--bs-border-color);background:var(--bs-body-bg);color:var(--bs-body-color);border-radius:var(--bs-border-radius);" />
                        </div>
                        <!-- Alt text field (for images) -->
                        <div style="flex:1 1 220px;">
                            <input type="text" id="vvc-upload-alt" class="vvc-upload-alt"
                                placeholder="النص البديل (للصور)"
                                style="width:100%;padding:.6rem .7rem;border:1px solid var(--bs-border-color);background:var(--bs-body-bg);color:var(--bs-body-color);border-radius:var(--bs-border-radius);" />
                        </div>
                    </div>
                    <!-- Upload action button -->
                    <div class="vvc-uploader-actions">
                        <button class="vvc-btn vvc-btn-primary" type="button" id="vvc-btn-upload-to-gallery"
                            title="رفع ثم عرض في المعرض">إدراج في المعرض</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- IMPORT TAB: Import from URL -->
        <section id="vvc-tab-import" class="vvc-tab-panel" role="tabpanel" aria-labelledby="vvc-tabbtn-import"
            hidden>
            <div class="vvc-tab-body">
                <div class="vvc-uploader">
                    <!-- Import input fields: URL, name, alt text -->
                    <div class="vvc-upload-fields" style="display:flex;flex-wrap:wrap;gap:.6rem;width:100%;">
                        <!-- URL input field - Full Width -->
                        <div style="flex:1 1 100%;">
                            <input type="url" id="vvc-import-url" class="vvc-import-url"
                                placeholder="أدخل رابط الوسائط"
                                style="width:100%;padding:.6rem .7rem;border:1px solid var(--bs-border-color);background:var(--bs-body-bg);color:var(--bs-body-color);border-radius:var(--bs-border-radius);direction:rtl;" />
                        </div>
                        <!-- Media name field - 50% -->
                        <div style="flex:1 1 calc(50% - 0.3rem);">
                            <input type="text" id="vvc-import-name" class="vvc-import-name"
                                placeholder="اسم الملف"
                                style="width:100%;padding:.6rem .7rem;border:1px solid var(--bs-border-color);background:var(--bs-body-bg);color:var(--bs-body-color);border-radius:var(--bs-border-radius);" />
                        </div>
                        <!-- Alt text field - 50% -->
                        <div style="flex:1 1 calc(50% - 0.3rem);">
                            <input type="text" id="vvc-import-alt" class="vvc-import-alt"
                                placeholder="النص البديل (للصور)"
                                style="width:100%;padding:.6rem .7rem;border:1px solid var(--bs-border-color);background:var(--bs-body-bg);color:var(--bs-body-color);border-radius:var(--bs-border-radius);" />
                        </div>
                    </div>
                    <!-- Import action button -->
                    <div class="vvc-uploader-actions">
                        <button class="vvc-btn vvc-btn-primary" type="button" id="vvc-btn-import-to-gallery"
                            title="استيراد ثم عرض في المعرض">استيراد للمعرض</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- ============================================
     SECTION 3: TEXT MODAL (Clickable Terms)
     ============================================ -->
<div id="vvcTextModal" class="vvc-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="vvcTextModalTitle">
    <div class="vvc-backdrop" data-vvc-text-backdrop></div>
    <div class="vvc-container" role="document" style="max-width:600px;">
        <div class="vvc-header">
            <h5 id="vvcTextModalTitle">إضافة نص قابل للنقر</h5>
            <button class="vvc-close" type="button" data-vvc-text-close aria-label="إغلاق">&times;</button>
        </div>
        <div class="vvc-tab-body">
            <!-- Display text input -->
            <div style="margin-bottom:1rem;">
                <label for="vvc-text-content"
                    style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">النص
                    المعروض:</label>
                <input type="text" id="vvc-text-content" placeholder="أدخل النص الذي سيظهر في المقال"
                    style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);">
            </div>
            <!-- Key field (auto-generated from content) -->
            <div style="margin-bottom:1rem;">
                <label for="vvc-text-key"
                    style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">المفتاح
                    (للعرض في القائمة):</label>
                <input type="text" id="vvc-text-key" placeholder="سيتم إنشاؤه تلقائياً من النص"
                    style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);"
                    readonly>
                <small style="color:var(--vvc-muted);">يتم إنشاء هذا تلقائياً من النص المعروض</small>
            </div>
            <!-- Description field (shown in popup) -->
            <div style="margin-bottom:1rem;">
                <label for="vvc-text-description"
                    style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">الوصف
                    (سيظهر في النافذة المنبثقة):</label>
                <textarea id="vvc-text-description" rows="4" placeholder="أدخل الوصف الكامل الذي سيظهر عند النقر على النص"
                    style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);"></textarea>
            </div>
            <!-- Optional image picker -->
            <div style="margin-bottom:1rem;">
                <label style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">صورة
                    (اختياري):</label>
                <button class="vvc-btn vvc-btn-secondary" type="button" id="vvc-btn-pick-image"
                    style="margin-bottom:0.75rem;width:100%;padding:0.75rem;">📷 اختر صورة من المعرض</button>
                <!-- Image preview container -->
                <div id="vvc-image-preview-container" style="display:none;">
                    <div style="position:relative;margin-bottom:0.5rem;">
                        <img id="vvc-image-preview" src="" alt="معاينة الصورة"
                            style="width:100%;max-height:200px;object-fit:cover;border:1px solid var(--vvc-border-color);border-radius:4px;">
                        <button type="button" id="vvc-btn-remove-image"
                            style="position:absolute;top:5px;right:5px;background:#e85347;color:white;border:none;border-radius:50%;width:30px;height:30px;cursor:pointer;font-size:18px;display:flex;align-items:center;justify-content:center;">×</button>
                    </div>
                    <small id="vvc-image-path" style="color:var(--vvc-muted);display:block;"></small>
                </div>
            </div>
        </div>
        <!-- Footer with action buttons -->
        <div class="vvc-footer">
            <button class="vvc-btn vvc-btn-primary" type="button" id="vvc-btn-insert-text">إدراج النص</button>
            <button class="vvc-btn vvc-btn-cancel" type="button" data-vvc-text-close>إلغاء</button>
        </div>
    </div>
</div>

<!-- ============================================
     SECTION 4: DEFINITION MODAL (Term Details)
     ============================================ -->
<div id="vvcDefinitionModal" class="vvc-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="vvcDefinitionModalTitle">
    <div class="vvc-backdrop" data-vvc-definition-backdrop></div>
    <div class="vvc-container" role="document" style="max-width:600px;">
        <div class="vvc-header">
            <h5 id="vvcDefinitionModalTitle">تعريف المصطلح</h5>
            <button class="vvc-close" type="button" data-vvc-definition-close aria-label="إغلاق">&times;</button>
        </div>
        <div class="vvc-tab-body">
            <!-- Definition image container -->
            <div id="vvc-definition-image-container" style="margin-bottom:1rem;display:none;">
                <img id="vvc-definition-image" src="" alt="صورة التعريف"
                    style="width:100%;max-height:300px;object-fit:cover;border-radius:4px;border:1px solid var(--vvc-border-color);">
            </div>
            <!-- Definition content -->
            <div id="vvc-definition-content" style="color:var(--vvc-body-color);line-height:1.6;"></div>
        </div>
        <!-- Footer -->
        <div class="vvc-footer">
            <button class="vvc-btn vvc-btn-cancel" type="button" data-vvc-definition-close>إغلاق</button>
        </div>
    </div>
</div>

<!-- ============================================
     SECTION 5: READ MORE MODAL
     ============================================ -->
<div id="vvcReadMoreModal" class="vvc-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="vvcReadMoreModalTitle">
    <div class="vvc-backdrop" data-vvc-readmore-backdrop></div>
    <div class="vvc-container" role="document" style="max-width:800px;">
        <div class="vvc-header">
            <h5 id="vvcReadMoreModalTitle">إدراج اقرأ المزيد</h5>
            <button class="vvc-close" type="button" data-vvc-readmore-close aria-label="إغلاق">&times;</button>
        </div>
        <div class="vvc-tab-body">
            <!-- Section filter dropdown -->
            <div style="margin-bottom:1rem;">
                <label for="vvc-readmore-section"
                    style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">القسم:</label>
                <select id="vvc-readmore-section"
                    style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);">
                    <option value="">-- كل الأقسام --</option>
                </select>
            </div>
            <!-- Search field -->
            <div style="margin-bottom:1rem;">
                <label for="vvc-readmore-search"
                    style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">بحث في
                    المحتوى:</label>
                <input type="text" id="vvc-readmore-search" placeholder="ابحث عن محتوى..."
                    style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);">
            </div>
            <!-- Content selection dropdown -->
            <div style="margin-bottom:1rem;">
                <label for="vvc-readmore-content"
                    style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">اختر
                    المحتوى:</label>
                <select id="vvc-readmore-content"
                    style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);">
                    <option value="">-- اختر محتوى من قاعدة البيانات --</option>
                </select>
            </div>
            <!-- Content preview -->
            <div style="margin-bottom:1rem;">
                <label
                    style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">معاينة:</label>
                <div id="vvc-readmore-preview"
                    style="border:1px solid var(--vvc-border-color);padding:1rem;background:var(--vvc-gray-100);min-height:100px;">
                    <p style="color:var(--vvc-muted);text-align:center;margin:2rem 0;">سوف تظهر معاينة المحتوى هنا</p>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="vvc-footer">
            <button class="vvc-btn vvc-btn-primary" type="button" id="vvc-btn-insert-readmore">إدراج</button>
            <button class="vvc-btn vvc-btn-cancel" type="button" data-vvc-readmore-close>إلغاء</button>
        </div>
    </div>
</div>

<!-- ============================================
     SECTION 6: STYLES
     ============================================ -->
<style>
    /* CSS Custom Properties (Theme Variables) */
    :root {
        --vvc-primary: #6576ff;
        --vvc-secondary: #364a63;
        --vvc-gray: #8091a7;
        --vvc-body-bg: #fff;
        --vvc-body-color: #526484;
        --vvc-heading-color: #364a63;
        --vvc-border-color: #dbdfea;
        --vvc-muted: #8091a7;
        --vvc-gray-100: #ebeef2;
    }

    /* Dark theme overrides */
    [data-bs-theme="dark"] {
        --vvc-body-bg: #0D141D;
        --vvc-body-color: #e5e9f2;
        --vvc-heading-color: #fff;
        --vvc-border-color: #384D69;
        --vvc-muted: #b7c2d0;
        --vvc-gray-100: #2b3748;
    }

    /* Reset box-sizing for modal elements */
    #vvcMediaModal,
    #vvcMediaModal * {
        box-sizing: border-box;
    }

    #vvcMediaModal * {
        border-radius: 0 !important;
    }

    /* ---- MODAL CONTAINER STYLES ---- */
    .vvc-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 10100;
    }

    .vvc-modal[aria-hidden="false"] {
        display: block;
    }

    /* Modal backdrop (semi-transparent overlay) */
    .vvc-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        z-index: 0;
    }

    /* Modal container */
    .vvc-container {
        position: absolute;
        inset: auto 0;
        top: 5%;
        margin: 0 auto;
        width: clamp(320px, 92vw, 1000px);
        max-height: 90%;
        background: var(--vvc-body-bg);
        color: var(--vvc-body-color);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 10001;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        animation: vvcFade .2s ease-out;
    }

    /* Modal fade-in animation */
    @keyframes vvcFade {
        from {
            opacity: 0;
            transform: translateY(-14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ---- HEADER STYLES ---- */
    .vvc-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--vvc-border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--vvc-body-bg);
    }

    .vvc-header h5 {
        color: var(--vvc-heading-color);
        margin: 0;
    }

    /* Close button */
    .vvc-close {
        font-size: 1.4rem;
        border: 0;
        background: transparent;
        color: var(--vvc-gray);
        cursor: pointer;
    }

    /* ---- TAB STYLES ---- */
    .vvc-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg);
    }

    /* Individual tab button */
    .vvc-tab-btn {
        background: var(--vvc-body-bg);
        border: 1px solid var(--vvc-border-color);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--vvc-body-color);
    }

    /* Active tab button */
    .vvc-tab-btn.vvc-is-active {
        background: var(--vvc-primary);
        border-color: var(--vvc-primary);
        color: white;
    }

    /* Tab panel (content area) */
    .vvc-tab-panel {
        display: block;
    }

    .vvc-tab-panel[hidden] {
        display: none;
    }

    /* Tab body content area */
    .vvc-tab-body {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg);
        flex: 1;
        overflow-y: auto;
    }

    /* ---- FILTER AND SEARCH STYLES ---- */
    .vvc-filters {
        padding: 1rem 1.25rem;
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg);
    }

    .vvc-filters input,
    .vvc-filters select {
        padding: .6rem .7rem;
        font-size: .95rem;
        border: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg);
        color: var(--vvc-body-color);
        flex: 1 1 180px;
    }

    /* ---- MEDIA GRID STYLES ---- */
    .vvc-body {
        padding: 1rem 1.25rem;
        overflow: auto;
        flex: 1;
        background: var(--vvc-body-bg);
    }

    /* Grid layout for media items */
    .vvc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: .9rem;
    }

    /* Empty state message */
    .vvc-empty {
        text-align: center;
        color: var(--vvc-muted);
        font-size: .95rem;
        margin: 2rem 0;
    }

    /* Individual media item */
    .vvc-item {
        position: relative;
        background: var(--vvc-body-bg);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: .6rem;
    }

    /* Media item hover state */
    .vvc-item:hover {
        border-color: var(--vvc-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.1);
    }

    /* Media item selected state */
    .vvc-item.vvc-is-selected {
        border-color: var(--vvc-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.2);
    }

    /* Media thumbnail container */
    .vvc-thumb {
        width: 100%;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--vvc-gray-100);
        overflow: hidden;
        position: relative;
        border: 1px solid var(--vvc-border-color);
    }

    .vvc-thumb img,
    .vvc-thumb video {
        max-width: 100%;
        max-height: 100%;
    }

    /* Placeholder for link-only videos (e.g., YouTube/Vimeo) */
    .vvc-thumb-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        color: #fff;
        background: linear-gradient(135deg, rgba(30, 30, 30, .85), rgba(60, 60, 60, .65));
        text-align: center;
        padding: .5rem;
    }

    .vvc-thumb-placeholder .vvc-thumb-icon {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, .15);
        border: 1px solid rgba(255, 255, 255, .25);
    }

    .vvc-thumb-placeholder .vvc-thumb-text {
        font-size: .85rem;
        color: #eaeaea;
        line-height: 1.2;
    }

    /* Badge (image/video indicator) */
    .vvc-badge {
        position: absolute;
        top: 6px;
        left: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .2);
    }

    /* Media title */
    .vvc-title {
        font-size: .9rem;
        color: var(--vvc-heading-color);
        margin-top: .55rem;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ---- UPLOADER STYLES ---- */
    .vvc-uploader {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .6rem;
        background: var(--vvc-body-bg);
        border: 1px solid var(--vvc-border-color);
        padding: 1rem;
    }

    .vvc-uploader-actions {
        display: flex;
        gap: .6rem;
    }

    /* ---- BUTTON STYLES ---- */
    .vvc-btn {
        padding: .6rem 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        border: 1px solid var(--bs-secondary);
        background: var(--bs-secondary);
        color: var(--bs-white);
        border-radius: var(--bs-border-radius);
    }

    .vvc-btn:hover {
        background: var(--bs-secondary-bg-subtle);
        border-color: var(--bs-secondary-border-subtle);
        color: var(--bs-body-color);
    }

    .vvc-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Secondary button variant */
    .vvc-btn-secondary {
        background: var(--bs-secondary);
        border-color: var(--bs-secondary);
        color: var(--bs-white);
    }

    .vvc-btn-secondary:hover {
        background: var(--bs-secondary-bg-subtle);
        border-color: var(--bs-secondary-border-subtle);
        color: var(--bs-body-color);
    }

    /* Primary button variant */
    .vvc-btn-primary {
        background: var(--bs-primary);
        border-color: var(--bs-primary);
        color: var(--bs-white);
    }

    .vvc-btn-primary:hover {
        background: var(--bs-primary-bg-subtle);
        border-color: var(--bs-primary-border-subtle);
        color: var(--bs-primary-text-emphasis);
    }

    /* Select button */
    .vvc-btn-select {
        background: var(--bs-success);
        color: var(--bs-white);
        border-color: var(--bs-success);
    }

    .vvc-btn-select:hover {
        background: var(--bs-success-bg-subtle);
        border-color: var(--bs-success-border-subtle);
        color: var(--bs-success-text-emphasis);
    }

    .vvc-btn-select:disabled {
        background: var(--bs-gray-400);
        border-color: var(--bs-gray-400);
        color: var(--bs-white);
    }

    /* Cancel button */
    .vvc-btn-cancel {
        background: var(--bs-danger);
        border-color: var(--bs-danger);
        color: var(--bs-white);
    }

    .vvc-btn-cancel:hover {
        background: var(--bs-danger-bg-subtle);
        border-color: var(--bs-danger-border-subtle);
        color: var(--bs-danger-text-emphasis);
    }

    /* ---- FOOTER STYLES ---- */
    .vvc-footer {
        padding: 1rem 1.25rem;
        background: var(--vvc-body-bg);
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        border-top: 1px solid var(--vvc-border-color);
    }

    /* ---- LOADING INDICATOR ---- */
    .vvc-loader {
        text-align: center;
        color: var(--vvc-muted);
        padding: .75rem;
        font-size: .95rem;
    }

    /* Sentinel for infinite scroll */
    .vvc-sentinel {
        height: 1px;
    }

    /* ---- CLICKABLE TERM STYLES ---- */
    .clickable-term {
        color: #0066cc;
        text-decoration: underline;
        cursor: pointer;
        padding: 2px 4px;
        border-radius: 3px;
        transition: background-color 0.2s;
        background-color: transparent;
    }

    .clickable-term:hover {
        background-color: #e6f2ff;
        text-decoration: none;
    }

    /* ---- READ MORE BLOCK STYLES ---- */
    .read-more-block {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        margin: 0.75rem 0;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: stretch;
        pointer-events: auto;
        user-select: none;
    }

    .read-more-block * {
        pointer-events: auto;
        user-select: text;
    }

    /* Read more label text */
    .read-more-block .read-more-label-text {
        font-size: 0.8rem;
        font-weight: 600;
        color: #666;
        background: #e7e7e7;
        padding: 0.25rem 0.75rem;
        border-radius: 4px;
        display: flex;
        align-items: center;
        margin-left: 0.75rem;
        white-space: nowrap;
        order: -1;
    }

    /* Read more block image */
    .read-more-block .read-more-image {
        width: 35%;
        height: auto;
        max-height: 150px;
        object-fit: cover;
    }

    /* Read more block content area */
    .read-more-block .read-more-content {
        width: 65%;
        padding: 0.75rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Read more category */
    .read-more-block .read-more-category {
        font-size: 0.75rem;
        color: #888;
        text-align: right;
        margin: 0 0 0.25rem 0;
    }

    /* Read more title */
    .read-more-block .read-more-title {
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 0.35rem 0;
        color: #364a63;
    }

    /* Read more summary text */
    .read-more-block .read-more-summary {
        color: #526484;
        line-height: 1.4;
        margin: 0;
        font-size: 0.9rem;
    }

    /* Read more link button */
    .read-more-block .read-more-link {
        display: inline-block;
        margin-top: 0.5rem;
        padding: 0.35rem 0.75rem;
        background: #6576ff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 500;
        font-size: 0.85rem;
        transition: background 0.2s;
        align-self: flex-start;
    }

    .read-more-block .read-more-link:hover {
        background: #465fff;
    }

    /* ---- RESPONSIVE DESIGN ---- */
    @media (max-width:768px) {
        .vvc-container {
            top: 2%;
            max-height: 96%;
        }

        .vvc-tabs {
            flex-wrap: wrap;
        }

        .vvc-filters {
            flex-direction: column;
        }

        .vvc-uploader-actions .vvc-btn {
            width: 100%;
        }

        /* Stack read more blocks vertically on mobile */
        .read-more-block {
            flex-direction: column;
        }

        .read-more-block .read-more-image {
            width: 100%;
            height: 120px;
        }

        .read-more-block .read-more-content {
            width: 100%;
        }
    }
</style>

<!-- ============================================
     SECTION 7: TINYMCE LIBRARY
     ============================================ -->
<script src="https://cdn.tiny.cloud/1/vw6sltzauw9x6b3cl3eby8nj99q4eoavzv581jnnmabxbhq2/tinymce/8/tinymce.min.js"
    referrerpolicy="origin" crossorigin="anonymous"></script>

<!-- ============================================
     SECTION 8: JAVASCRIPT - MAIN APPLICATION
     ============================================ -->
<script>
    /**
     * ============================================
     * IIFE - MAIN APPLICATION SCOPE
     * ============================================
     * Encapsulates all functionality in a private scope
     * to avoid global namespace pollution
     */
    (function() {
        // ============================================
        // PRE-LOADED DATA FROM SERVER
        // ============================================
        @php
            try {
                $currentContentId = isset($content) ? $content->id : null;
                $readMoreContent = \App\Models\Content::whereIn('status', ['published', 'draft'])
                    ->when($currentContentId, function ($query, $contentId) {
                        return $query->where('id', '!=', $contentId);
                    })
                    ->select(['id', 'title', 'summary', 'created_at', 'category_id', 'section_id'])
                    ->with([
                        'media' => function ($q) {
                            $q->wherePivot('type', 'main');
                        },
                        'category',
                        'section',
                    ])
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->map(function ($item) {
                        $mainImage = $item->media()->wherePivot('type', 'main')->first();
                        $imagePath = $mainImage ? $mainImage->path : null;
                        if ($imagePath && !str_starts_with($imagePath, 'http')) {
                            $imagePath = url($imagePath);
                        }
                        return [
                            'id' => $item->id,
                            'title' => $item->title ?? 'Untitled',
                            'category' => $item->category->name ?? null,
                            'section_id' => $item->section_id ?? null,
                            'section' => $item->section->name ?? null,
                            'image_url' => $imagePath,
                            'summary' => \Illuminate\Support\Str::limit($item->summary ?? '', 150),
                            'link' => url('/content/' . $item->id),
                            'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                        ];
                    });

                // Load sections for the filter dropdown
                $sections = \App\Models\Section::orderBy('name')->get(['id', 'name']);
            } catch (\Exception $e) {
                $readMoreContent = collect([]);
                $sections = collect([]);
            }
        @endphp
        const READ_MORE_DATA = @json($readMoreContent);
        const SECTIONS_DATA = @json($sections);

        // ============================================
        // CONFIGURATION & CONSTANTS
        // ============================================
        const FETCH_URL = "{{ route('dashboard.media.getAllMediaPaginated') }}";
        const UPLOAD_URL = "{{ route('dashboard.media.store') }}";
        const IMPORT_URL = "{{ route('dashboard.media_url.store') }}";
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content') || '';

        // ============================================
        // DOM ELEMENT REFERENCES - MEDIA MODAL
        // ============================================
        const modal = document.getElementById("vvcMediaModal");
        const backdrop = modal.querySelector('[data-vvc-backdrop]');
        const closes = modal.querySelectorAll('[data-vvc-close]');
        const container = modal.querySelector('.vvc-container');

        const listEl = document.getElementById('vvc-list');
        const loaderEl = document.getElementById('vvc-loader');
        const sentinel = document.getElementById('vvc-sentinel');
        const searchInp = document.getElementById('vvc-search');
        const typeSel = document.getElementById('vvc-type-filter');
        const btnSelect = document.getElementById('vvc-btn-select');

        const upInput = document.getElementById('vvc-upload-input');
        const upName = document.getElementById('vvc-upload-name');
        const upAlt = document.getElementById('vvc-upload-alt');
        const btnUpGal = document.getElementById('vvc-btn-upload-to-gallery');

        const impUrl = document.getElementById('vvc-import-url');
        const impName = document.getElementById('vvc-import-name');
        const impAlt = document.getElementById('vvc-import-alt');
        const btnImpGal = document.getElementById('vvc-btn-import-to-gallery');

        // ============================================
        // APPLICATION STATE
        // ============================================
        const state = {
            isOpen: false,
            page: 1,
            hasMore: true,
            isLoading: false,
            search: "",
            type: "all",
            list: [],
            selected: null,
            observer: null,
            activeTab: 'gallery',
            currentField: 'tiny'
        };

        // ============================================
        // UTILITY FUNCTIONS
        // ============================================

        /**
         * Extract file extension from path
         * @param {string} p - File path
         * @returns {string} File extension in lowercase
         */
        const extFromPath = (p = "") => (p.split('?')[0].split('.').pop() || "").toLowerCase();

        /**
         * Convert relative URL to absolute URL
         * @param {string} u - URL to convert
         * @returns {string} Absolute URL
         */
        const toAbsoluteUrl = (u) => {
            if (!u) return u;
            if (/^https?:\/\//i.test(u)) return u;
            return `${window.location.origin}${u.startsWith('/')?'':'/'}${u}`;
        };

        /**
         * Determine media type (image or video)
         * @param {object} m - Media object
         * @returns {string} 'image' or 'video'
         */
        function getMediaKind(m) {
            const mt = (m.media_type || '').toLowerCase();
            if (mt === 'image' || mt === 'video') return mt;
            const ext = extFromPath(m.path || m.url || '');
            if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].includes(ext)) return 'image';
            return 'video';
        }

        /**
         * Get appropriate icon ID for badge
         * @param {object} m - Media object
         * @returns {string} Icon symbol ID
         */
        const getBadgeIconId = (m) => (getMediaKind(m) === 'image' ? 'vvc-icon-image' : 'vvc-icon-video');

        // ============================================
        // MEDIA MODAL MANAGER (Public API)
        // ============================================
        window.vvcMediaModalManager = {
            /**
             * Open the media modal
             * @param {string} fieldName - Name of the field calling this
             */
            openModal(fieldName = "") {
                state.currentField = fieldName;
                state.isOpen = true;
                modal.setAttribute('aria-hidden', 'false');
                document.documentElement.style.overflow = 'hidden';
                resetState();
                // If image type requested, pre-filter to images
                if (window._tinyRequestedType === 'image') {
                    state.type = 'image';
                    if (typeSel) typeSel.value = 'image';
                }
                switchTab('gallery');
                resetAndLoad();
                setTimeout(() => searchInp?.focus(), 0);
            },

            /**
             * Close the media modal
             */
            closeModal() {
                state.isOpen = false;
                modal.setAttribute('aria-hidden', 'true');
                document.documentElement.style.overflow = '';
                resetState();
            },

            /**
             * Handle media selection - determines where to insert selected media
             * @param {object} payload - Media object with url, title, alt, type
             */
            onMediaSelected(payload) {
                const normalized = {
                    url: payload.url,
                    title: payload.title || "",
                    alt: payload.alt || "",
                    type: (payload.type === 'image' ? 'image' : 'video')
                };

                // Case 1: TinyMCE picker promise waiting for result
                if (typeof window._resolveTinyPick === 'function') {
                    const resolver = window._resolveTinyPick;
                    window._resolveTinyPick = null;
                    window._tinyRequestedType = null;
                    resolver(normalized);
                    this.closeModal();
                    return;
                }

                // Case 2: Insert into active TinyMCE editor
                if (window.tinymce && tinymce.activeEditor && normalized.url) {
                    try {
                        tinymce.activeEditor.focus();
                        const isImg = /\.(png|jpe?g|webp|gif|bmp|svg)(\?|$)/i.test(normalized.url);
                        if (isImg) {
                            tinymce.activeEditor.execCommand('mceInsertContent', false,
                                `<img class="tiny-sm" src="${escapeHtml(normalized.url)}" alt="${escapeHtml(normalized.alt||normalized.title)}" title="${escapeHtml(normalized.title)}"/>`
                            );
                        } else {
                            const u = normalized.url;
                            const youtubeMatch = u.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/i);
                            const vimeoMatch = u.match(/vimeo\.com\/(\d+)/i);
                            if (youtubeMatch) {
                                const vid = youtubeMatch[1];
                                tinymce.activeEditor.execCommand('mceInsertContent', false,
                                    `<iframe class="tiny-sm" src="https://www.youtube.com/embed/${escapeHtml(vid)}" frameborder="0" allowfullscreen></iframe>`
                                );
                            } else if (vimeoMatch) {
                                const vid = vimeoMatch[1];
                                tinymce.activeEditor.execCommand('mceInsertContent', false,
                                    `<iframe class="tiny-sm" src="https://player.vimeo.com/video/${escapeHtml(vid)}" frameborder="0" allowfullscreen></iframe>`
                                );
                            } else {
                                tinymce.activeEditor.execCommand('mceInsertContent', false,
                                    `<video class="tiny-sm" src="${escapeHtml(normalized.url)}" controls preload="metadata"></video>`
                                );
                            }
                        }
                        this.closeModal();
                    } catch (e) {
                        console.error('Tiny insert failed:', e);
                    }
                    return;
                }

                // Case 3: Custom media tab manager (if exists)
                if (window.mediaTabManager?.onMediaSelected) {
                    window.mediaTabManager.onMediaSelected(normalized);
                    this.closeModal();
                }
            }
        };

        /**
         * Helper to close modal
         */
        function closeModal() {
            window.vvcMediaModalManager.closeModal();
        }

        // ============================================
        // MODAL EVENT LISTENERS
        // ============================================
        backdrop.addEventListener('click', closeModal);
        closes.forEach(b => b.addEventListener('click', closeModal));
        container.addEventListener('click', e => e.stopPropagation());

        /**
         * Keyboard navigation and shortcuts
         */
        document.addEventListener('keydown', e => {
            if (!state.isOpen) return;
            if (e.key === 'Escape') closeModal();
            // Arrow keys to switch tabs
            if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
                const btns = [...document.querySelectorAll('.vvc-tab-btn')];
                const idx = btns.findIndex(b => b.getAttribute('aria-selected') === 'true');
                if (idx > -1) {
                    const next = (idx + (e.key === 'ArrowRight' ? 1 : -1) + btns.length) % btns.length;
                    btns[next].click();
                    btns[next].focus();
                }
            }
        });

        // ============================================
        // TAB SWITCHING
        // ============================================
        document.querySelectorAll('.vvc-tab-btn').forEach(btn => btn.addEventListener('click', () => switchTab(btn
            .dataset.vvcTab)));

        /**
         * Switch between Gallery, Upload, and Import tabs
         * @param {string} tab - Tab name ('gallery', 'upload', or 'import')
         */
        function switchTab(tab) {
            const panels = {
                gallery: document.getElementById('vvc-tab-gallery'),
                upload: document.getElementById('vvc-tab-upload'),
                import: document.getElementById('vvc-tab-import')
            };
            if (!panels[tab]) return;
            state.activeTab = tab;
            // Update tab button states
            document.querySelectorAll('.vvc-tab-btn').forEach(b => {
                const active = b.dataset.vvcTab === tab;
                b.classList.toggle('vvc-is-active', active);
                b.setAttribute('aria-selected', String(active));
                b.tabIndex = active ? 0 : -1;
            });
            // Show/hide tab panels
            Object.entries(panels).forEach(([name, p]) => p.hidden = (name !== tab));
        }

        /**
         * Reset application state
         */
        function resetState() {
            state.page = 1;
            state.hasMore = true;
            state.isLoading = false;
            state.search = "";
            state.type = 'all';
            state.list = [];
            state.selected = null;
            if (searchInp) searchInp.value = '';
            if (typeSel) typeSel.value = 'all';
            if (state.observer) {
                try {
                    state.observer.disconnect();
                } catch {}
                state.observer = null;
            }
            if (upInput) upInput.value = '';
            if (upName) upName.value = '';
            if (upAlt) upAlt.value = '';
            if (impUrl) impUrl.value = '';
            if (impName) impName.value = '';
            if (impAlt) impAlt.value = '';
            // Reset upload label visual feedback
            const uploadLabel = document.getElementById('vvc-upload-label');
            const uploadLabelText = document.getElementById('vvc-upload-label-text');
            if (uploadLabelText) uploadLabelText.textContent = 'اختر ملف الوسائط';
            if (uploadLabel) uploadLabel.style.border = '1px solid var(--vvc-border-color)';
            if (btnSelect) btnSelect.disabled = true;
        }

        /**
         * Reset and load initial media list
         */
        async function resetAndLoad() {
            state.page = 1;
            state.hasMore = true;
            state.list = [];
            renderList();
            await loadMore(true);
            setupObserver();
        }

        /**
         * Setup Intersection Observer for infinite scroll
         */
        function setupObserver() {
            if (state.observer) state.observer.disconnect();
            const rootEl = document.querySelector('#vvc-tab-gallery .vvc-body');
            state.observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) loadMore();
                });
            }, {
                root: rootEl,
                threshold: 1
            });
            state.observer.observe(sentinel);
        }

        /**
         * Load more media items (pagination)
         * @param {boolean} reset - Whether to reset pagination
         */
        async function loadMore(reset = false) {
            if (state.isLoading || !state.hasMore) return;
            state.isLoading = true;
            loaderEl.hidden = false;
            try {
                const url = new URL(FETCH_URL, window.location.origin);
                url.searchParams.set('page', state.page);
                url.searchParams.set('search', state.search.trim());
                url.searchParams.set('type', state.type);
                const res = await fetch(url.toString(), {
                    headers: {
                        Accept: 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`Fetch ${res.status}`);
                const data = await res.json();
                const items = Array.isArray(data.data) ? data.data : [];
                const hasMore = !!data.next_page_url;
                state.list = reset ? items : state.list.concat(items);
                state.hasMore = hasMore;
                state.page += 1;
            } catch (err) {
                console.error(err);
                if (reset) listEl.innerHTML = '<div class="vvc-empty">تعذّر تحميل الوسائط.</div>';
            } finally {
                state.isLoading = false;
                loaderEl.hidden = true;
                renderList();
            }
        }

        /**
         * Render media items grid
         */
        function renderList() {
            listEl.innerHTML = '';
            const filtered = state.type === 'all' ? state.list : state.list.filter(m => getMediaKind(m) === state
                .type);
            if (!filtered.length) {
                listEl.innerHTML = '<div class="vvc-empty">لا توجد وسائط للعرض</div>';
                return;
            }
            filtered.forEach(media => {
                const kind = getMediaKind(media);
                const item = document.createElement('div');
                item.className = 'vvc-item';
                if (state.selected && state.selected.id === media.id) item.classList.add('vvc-is-selected');
                item.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleSelect(media);
                });

                // Create thumbnail
                const thumb = document.createElement('div');
                thumb.className = 'vvc-thumb';
                const badge = document.createElement('div');
                badge.className = 'vvc-badge';
                badge.title = kind;
                badge.innerHTML =
                    `<svg aria-hidden="true"><use href="#${getBadgeIconId(media)}"></use></svg>`;
                thumb.appendChild(badge);

                // Add image or video to thumbnail
                if (kind === 'image') {
                    const img = document.createElement('img');
                    img.src = toAbsoluteUrl(media.path || media.url);
                    img.alt = media.alt || media.name || '';
                    img.loading = 'lazy';
                    thumb.appendChild(img);
                } else {
                    if (/\.(mp4|webm|mkv|mov|avi|m4v)(\?|$)/i.test(media.path || media.url || '')) {
                        const video = document.createElement('video');
                        video.src = toAbsoluteUrl(media.path || media.url);
                        video.muted = true;
                        video.preload = 'metadata';
                        thumb.appendChild(video);
                    } else {
                        // Link-only video (e.g., YouTube/Vimeo) — show a styled placeholder
                        const ph = document.createElement('div');
                        ph.className = 'vvc-thumb-placeholder';
                        const icon = document.createElement('div');
                        icon.className = 'vvc-thumb-icon';
                        icon.innerHTML = `<svg aria-hidden="true"><use href="#vvc-icon-video"></use></svg>`;
                        const text = document.createElement('div');
                        text.className = 'vvc-thumb-text';
                        // Short label with domain or generic text
                        try {
                            const u = new URL(media.url || media.path, window.location.origin);
                            text.textContent = u.hostname ? `فيديو من ${u.hostname}` : 'رابط فيديو';
                        } catch {
                            text.textContent = 'رابط فيديو';
                        }
                        ph.appendChild(icon);
                        ph.appendChild(text);
                        thumb.appendChild(ph);
                    }
                }
                item.appendChild(thumb);

                // Add title
                const title = document.createElement('div');
                title.className = 'vvc-title';
                title.textContent = media.name || '';
                item.appendChild(title);
                listEl.appendChild(item);
            });
        }

        /**
         * Toggle media selection
         * @param {object} media - Media object to toggle
         */
        function toggleSelect(media) {
            const isSame = state.selected && state.selected.id === media.id;
            state.selected = isSame ? null : media;
            renderList();
            if (btnSelect) btnSelect.disabled = !state.selected;
        }

        // ============================================
        // SEARCH AND FILTER EVENT LISTENERS
        // ============================================
        let searchTimeout;
        searchInp?.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                state.search = e.target.value;
                resetAndLoad();
            }, 350);
        });

        typeSel?.addEventListener('change', (e) => {
            state.type = e.target.value;
            resetAndLoad();
        });

        // ============================================
        // SELECT AND UPLOAD BUTTON LISTENERS
        // ============================================
        btnSelect?.addEventListener('click', () => {
            if (!state.selected) {
                alert('يرجى اختيار وسيط واحد على الأقل.');
                return;
            }
            const kind = getMediaKind(state.selected);
            const payload = {
                id: state.selected.id,
                url: toAbsoluteUrl(state.selected.path || state.selected.url),
                title: state.selected.name || '',
                alt: state.selected.alt || '',
                type: kind
            };
            window.vvcMediaModalManager.onMediaSelected(payload);
        });

        /**
         * Upload media file
         * @param {string} mode - Upload mode ('gallery' to show in gallery after upload)
         */
        async function uploadMedia(mode) {
            const files = upInput?.files;
            if (!files || !files.length) {
                alert('⚠️ لم يتم اختيار أي ملف للرفع.');
                return;
            }
            const file0 = files[0];
            const nameVal = (upName.value || '').trim() || file0.name;
            const altVal = (upAlt.value || '').trim();

            // Validate file type
            const isImg = file0.type.startsWith('image/');
            const isVid = file0.type.startsWith('video/');
            if (!isImg && !isVid) {
                alert('يُسمح فقط بالصور أو الفيديو.');
                return;
            }

            // Prepare form data
            const form = new FormData();
            form.append('media', file0);
            form.append('name', nameVal);
            if (altVal && isImg) form.append('alt', altVal);

            try {
                btnUpGal.disabled = true;
                btnUpGal.textContent = 'جارٍ الرفع...';
                const res = await fetch(UPLOAD_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    },
                    body: form
                });
                const bodyText = await res.text();
                if (!res.ok) {
                    console.error('Upload failed', res.status, bodyText);
                    alert('فشل الرفع.');
                    return;
                }
                const parsed = tryParseJson(bodyText);
                const created = extractCreated(parsed);

                if (mode === 'gallery') {
                    switchTab('gallery');
                    await resetAndLoad();
                    if (created.length) {
                        state.selected = created[0];
                        renderList();
                        if (btnSelect) btnSelect.disabled = false;
                    }
                    upInput.value = '';
                    upName.value = '';
                    upAlt.value = '';
                    return;
                }
            } catch (err) {
                console.error('Upload exception', err);
                alert('حدث خطأ أثناء الرفع.');
            } finally {
                btnUpGal.disabled = false;
                btnUpGal.textContent = 'إدراج في المعرض';
            }
        }

        /**
         * Safely parse JSON
         * @param {string} text - JSON text to parse
         * @returns {object|null} Parsed object or null
         */
        function tryParseJson(text) {
            if (!text) return null;
            const clean = text.replace(/^\uFEFF/, '').trim();
            try {
                return JSON.parse(clean);
            } catch {
                return null;
            }
        }

        /**
         * Extract created media from response
         * @param {object} obj - Response object
         * @returns {array} Array of created media
         */
        function extractCreated(obj) {
            if (!obj || typeof obj !== 'object') return [];
            if (Array.isArray(obj.data)) return obj.data;
            if (Array.isArray(obj.media)) return obj.media;
            if (obj.data) return [obj.data];
            if (obj.media) return [obj.media];
            return [];
        }

        btnUpGal?.addEventListener('click', () => uploadMedia('gallery'));

        // Visual feedback for file selection
        const uploadLabel = document.getElementById('vvc-upload-label');
        const uploadLabelText = document.getElementById('vvc-upload-label-text');
        upInput?.addEventListener('change', (e) => {
            const files = e.target.files;
            if (files && files.length > 0) {
                const fileName = files[0].name;
                uploadLabelText.textContent = 'تم تحميل الملف';
                uploadLabel.style.border = '1px solid var(--vvc-body-color)';

                // Auto-fill name and alt fields if empty
                if (!upName.value) {
                    const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                    upName.value = nameWithoutExt;
                    upAlt.value = nameWithoutExt;
                }
            } else {
                uploadLabelText.textContent = 'اختر ملف الوسائط';
                uploadLabel.style.border = '1px solid var(--vvc-border-color)';
            }
        });

        /**
         * Import media from URL
         * @param {string} mode - Import mode ('gallery' to show in gallery after import)
         */
        async function importMedia(mode) {
            const urlVal = (impUrl?.value || '').trim();
            if (!urlVal) {
                alert('⚠️ لم يتم إدخال رابط.');
                return;
            }

            const nameVal = (impName?.value || '').trim();
            const altVal = (impAlt?.value || '').trim();

            try {
                btnImpGal.disabled = true;
                btnImpGal.textContent = 'جارٍ الاستيراد...';

                const res = await fetch(IMPORT_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        url: urlVal,
                        name: nameVal || undefined,
                        alt: altVal || undefined,
                        media_type: 'auto'
                    })
                });

                const bodyText = await res.text();
                if (!res.ok) {
                    console.error('Import failed', res.status, bodyText);
                    alert('فشل الاستيراد.');
                    return;
                }

                const parsed = tryParseJson(bodyText);
                const created = extractCreated(parsed);

                if (mode === 'gallery') {
                    switchTab('gallery');
                    await resetAndLoad();
                    if (created.length) {
                        state.selected = created[0];
                        renderList();
                        if (btnSelect) btnSelect.disabled = false;
                    }
                    impUrl.value = '';
                    impName.value = '';
                    impAlt.value = '';
                    return;
                }
            } catch (err) {
                console.error('Import exception', err);
                alert('حدث خطأ أثناء الاستيراد.');
            } finally {
                btnImpGal.disabled = false;
                btnImpGal.textContent = 'استيراد للمعرض';
            }
        }

        btnImpGal?.addEventListener('click', () => importMedia('gallery'));

        // Visual feedback for URL input
        impUrl?.addEventListener('input', (e) => {
            const url = e.target.value.trim();
            if (url) {
                // Auto-extract name from URL if name field is empty
                if (!impName.value) {
                    const urlPath = new URL(url, window.location.origin).pathname;
                    const fileName = urlPath.split('/').pop();
                    const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                    if (nameWithoutExt && nameWithoutExt !== '') {
                        impName.value = nameWithoutExt;
                        impAlt.value = nameWithoutExt;
                    }
                }
            }
        });

        if (!state.list.length) {
            listEl.innerHTML = '<div class="vvc-empty">لا توجد وسائط للعرض</div>';
        }

        // ============================================
        // GLOBAL TEXT DEFINITIONS STORAGE
        // ============================================
        window.vvcTextDefinitions = window.vvcTextDefinitions || {};

        // ============================================
        // TEXT MODAL REFERENCES
        // ============================================
        const textModal = document.getElementById("vvcTextModal");
        const textBackdrop = textModal.querySelector('[data-vvc-text-backdrop]');
        const textCloses = textModal.querySelectorAll('[data-vvc-text-close]');
        const textContainer = textModal.querySelector('.vvc-container');
        const textContentInput = document.getElementById('vvc-text-content');
        const textKeyInput = document.getElementById('vvc-text-key');
        const textDescriptionInput = document.getElementById('vvc-text-description');
        const btnInsertText = document.getElementById('vvc-btn-insert-text');
        const btnPickImage = document.getElementById('vvc-btn-pick-image');
        const btnRemoveImage = document.getElementById('vvc-btn-remove-image');
        const imagePreviewContainer = document.getElementById('vvc-image-preview-container');
        const imagePreview = document.getElementById('vvc-image-preview');
        const imagePath = document.getElementById('vvc-image-path');

        // ============================================
        // DEFINITION MODAL REFERENCES
        // ============================================
        const definitionModal = document.getElementById("vvcDefinitionModal");
        const definitionBackdrop = definitionModal.querySelector('[data-vvc-definition-backdrop]');
        const definitionCloses = definitionModal.querySelectorAll('[data-vvc-definition-close]');
        const definitionContainer = definitionModal.querySelector('.vvc-container');
        const definitionImageContainer = document.getElementById('vvc-definition-image-container');
        const definitionImage = document.getElementById('vvc-definition-image');
        const definitionContent = document.getElementById('vvc-definition-content');

        // ============================================
        // READ MORE MODAL REFERENCES
        // ============================================
        const readMoreModal = document.getElementById("vvcReadMoreModal");
        const readMoreBackdrop = readMoreModal.querySelector('[data-vvc-readmore-backdrop]');
        const readMoreCloses = readMoreModal.querySelectorAll('[data-vvc-readmore-close]');
        const readMoreContainer = readMoreModal.querySelector('.vvc-container');
        const readMoreSectionSelect = document.getElementById('vvc-readmore-section');
        const readMoreSearchInput = document.getElementById('vvc-readmore-search');
        const readMoreContentSelect = document.getElementById('vvc-readmore-content');
        const readMorePreview = document.getElementById('vvc-readmore-preview');
        const btnInsertReadMore = document.getElementById('vvc-btn-insert-readmore');

        // ============================================
        // TEXT MODAL STATE
        // ============================================
        let textModalState = {
            selectedImage: null,
            selectedImagePath: null,
            editingElement: null, // Element being edited (null for new insertion)
            isEditMode: false // Track if we're in edit mode
        };

        // ============================================
        // TEXT MODAL MANAGER (Public API)
        // ============================================
        window.vvcTextModalManager = {
            /**
             * Open text modal
             * @param {HTMLElement} elementToEdit - Optional: existing clickable-term element to edit
             */
            openModal(elementToEdit = null) {
                textModalState.selectedImage = null;
                textModalState.selectedImagePath = null;
                textModalState.editingElement = elementToEdit;
                textModalState.isEditMode = !!elementToEdit;

                textModal.setAttribute('aria-hidden', 'false');
                document.documentElement.style.overflow = 'hidden';

                // If editing an existing element, pre-fill the form
                if (elementToEdit) {
                    textContentInput.value = elementToEdit.textContent || '';
                    textKeyInput.value = elementToEdit.getAttribute('data-term') || '';
                    textDescriptionInput.value = elementToEdit.getAttribute('data-description') || '';

                    const imageUrl = elementToEdit.getAttribute('data-image');
                    if (imageUrl) {
                        textModalState.selectedImagePath = imageUrl;
                        imagePreview.src = imageUrl;
                        imagePath.textContent = imageUrl;
                        imagePreviewContainer.style.display = 'block';
                    } else {
                        imagePreviewContainer.style.display = 'none';
                    }

                    // Make key field editable in edit mode
                    textKeyInput.removeAttribute('readonly');
                    textKeyInput.style.background = 'var(--vvc-body-bg)';

                    // Update button text for edit mode
                    btnInsertText.textContent = 'تحديث النص';
                } else {
                    // Clear form for new insertion
                    textContentInput.value = '';
                    textKeyInput.value = '';
                    textDescriptionInput.value = '';
                    imagePreviewContainer.style.display = 'none';

                    // Make key field readonly in insert mode (auto-generated)
                    textKeyInput.setAttribute('readonly', 'readonly');
                    textKeyInput.style.background = '';

                    // Get selected text from editor if available
                    if (window.tinymce && tinymce.activeEditor) {
                        const selectedText = tinymce.activeEditor.selection.getContent({
                            format: 'text'
                        });
                        if (selectedText) {
                            textContentInput.value = selectedText;
                            updateKeyFromContent();
                        }
                    }

                    // Update button text for insert mode
                    btnInsertText.textContent = 'إدراج النص';
                }

                setTimeout(() => textContentInput.focus(), 0);
            },

            /**
             * Close text modal
             */
            closeModal() {
                textModal.setAttribute('aria-hidden', 'true');
                document.documentElement.style.overflow = '';
                textModalState.selectedImage = null;
                textModalState.selectedImagePath = null;
                textModalState.editingElement = null;
                textModalState.isEditMode = false;
            },

            /**
             * Add text definition to storage
             * @param {string} key - Definition key
             * @param {string} content - Display text
             * @param {string} description - Full description
             * @param {string} imagePath - Optional image URL
             */
            addTextDefinition(key, content, description, imagePath = null) {
                window.vvcTextDefinitions[key] = {
                    content,
                    description,
                    image: imagePath
                };
            }
        };

        // ============================================
        // DEFINITION MODAL MANAGER (Public API)
        // ============================================
        window.vvcDefinitionModalManager = {
            /**
             * Open definition modal for a term
             * @param {string} term - Term key to display definition for
             */
            openModal(term) {
                const definition = window.vvcTextDefinitions[term];
                if (!definition) return;
                definitionContent.textContent = definition.description;
                if (definition.image) {
                    definitionImageContainer.style.display = 'block';
                    definitionImage.src = definition.image;
                    definitionImage.alt = definition.content;
                } else {
                    definitionImageContainer.style.display = 'none';
                }
                definitionModal.setAttribute('aria-hidden', 'false');
                document.documentElement.style.overflow = 'hidden';
            },

            /**
             * Close definition modal
             */
            closeModal() {
                definitionModal.setAttribute('aria-hidden', 'true');
                document.documentElement.style.overflow = '';
            }
        };

        // ============================================
        // READ MORE MODAL MANAGER (Public API)
        // ============================================
        window.vvcReadMoreModalManager = {
            /**
             * Open read more modal
             */
            openModal() {
                readMoreModal.setAttribute('aria-hidden', 'false');
                document.documentElement.style.overflow = 'hidden';

                // Populate sections dropdown
                readMoreSectionSelect.innerHTML = '<option value="">-- كل الأقسام --</option>';
                if (SECTIONS_DATA && SECTIONS_DATA.length > 0) {
                    SECTIONS_DATA.forEach(section => {
                        const option = document.createElement('option');
                        option.value = section.id;
                        option.textContent = section.name;
                        readMoreSectionSelect.appendChild(option);
                    });
                }

                // Reset filters and load content
                readMoreSectionSelect.value = '';
                readMoreSearchInput.value = '';
                readMoreContentSelect.value = '';
                readMorePreview.innerHTML =
                    '<p style="color:var(--vvc-muted);text-align:center;margin:2rem 0;">ستظهر معاينة المحتوى هنا</p>';
                loadReadMoreContent();
                setTimeout(() => readMoreContentSelect.focus(), 0);
            },

            /**
             * Close read more modal
             */
            closeModal() {
                readMoreModal.setAttribute('aria-hidden', 'true');
                document.documentElement.style.overflow = '';
            }
        };

        /**
         * Load "read more" content options (Now using pre-loaded data)
         * @param {string} searchTerm - Optional search term
         * @param {string} sectionId - Optional section filter
         */
        function loadReadMoreContent(searchTerm = '', sectionId = '') {
            try {
                // Use pre-loaded data instead of AJAX
                let contentList = READ_MORE_DATA || [];

                // Exclude current content being edited (prevent self-reference)
                if (window.CURRENT_CONTENT_ID) {
                    contentList = contentList.filter(item =>
                        item.id != window.CURRENT_CONTENT_ID
                    );
                }

                // Filter by section if provided
                if (sectionId && sectionId.trim()) {
                    contentList = contentList.filter(item =>
                        item.section_id == sectionId
                    );
                }

                // Filter by search term if provided
                if (searchTerm && searchTerm.trim()) {
                    const search = searchTerm.trim().toLowerCase();
                    contentList = contentList.filter(item =>
                        (item.title && item.title.toLowerCase().includes(search)) ||
                        (item.summary && item.summary.toLowerCase().includes(search))
                    );
                }

                // Populate dropdown
                readMoreContentSelect.innerHTML =
                    '<option value="">-- اختر محتوى من قاعدة البيانات --</option>';

                if (contentList.length === 0) {
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = searchTerm ? '-- لا توجد نتائج --' : '-- لا يوجد محتوى --';
                    readMoreContentSelect.appendChild(option);
                    return;
                }

                contentList.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.title;
                    option.dataset.category = item.category || '';
                    option.dataset.image = item.image_url || '';
                    option.dataset.summary = item.summary || '';
                    option.dataset.link = item.link || '';
                    readMoreContentSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading content:', error);
                readMoreContentSelect.innerHTML = '<option value="">-- خطأ في تحميل المحتوى --</option>';
            }
        }

        /**
         * Handle read more section filter change
         */
        readMoreSectionSelect?.addEventListener('change', function(e) {
            const searchTerm = readMoreSearchInput.value || '';
            const sectionId = e.target.value || '';
            loadReadMoreContent(searchTerm, sectionId);
        });

        /**
         * Handle read more search input
         */
        let readMoreSearchTimeout;
        readMoreSearchInput?.addEventListener('input', function(e) {
            clearTimeout(readMoreSearchTimeout);
            readMoreSearchTimeout = setTimeout(() => {
                const sectionId = readMoreSectionSelect.value || '';
                loadReadMoreContent(e.target.value, sectionId);
            }, 300);
        });

        /**
         * Handle read more content selection change
         */
        readMoreContentSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (!this.value) {
                readMorePreview.innerHTML =
                    '<p style="color:var(--vvc-muted);text-align:center;margin:2rem 0;">سيظهر معاينة المحتوى هنا</p>';
                return;
            }
            let html = '<div class="read-more-block">';
            html += '<span class="read-more-label-text">اقرأ أيضاً</span>';
            if (selectedOption.dataset.image) {
                html +=
                    `<img src="${escapeHtml(selectedOption.dataset.image)}" alt="${escapeHtml(selectedOption.textContent)}" class="read-more-image">`;
            }
            html += `<div class="read-more-content">`;
            if (selectedOption.dataset.category) {
                html += `<p class="read-more-category">${escapeHtml(selectedOption.dataset.category)}</p>`;
            }
            html += `<h3 class="read-more-title">${escapeHtml(selectedOption.textContent)}</h3>`;
            if (selectedOption.dataset.summary) {
                html += `<p class="read-more-summary">${escapeHtml(selectedOption.dataset.summary)}</p>`;
            }
            if (selectedOption.dataset.link) {
                html +=
                    `<a href="${escapeHtml(selectedOption.dataset.link)}" class="read-more-link">اقرأ المزيد</a>`;
            }
            html += '</div></div>';
            readMorePreview.innerHTML = html;
        });

        /**
         * Update key field from content
         */
        function updateKeyFromContent() {
            const content = textContentInput.value.trim();
            const key = content.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]/g, '');
            textKeyInput.value = key || 'undefined';
        }

        textContentInput.addEventListener('input', updateKeyFromContent);

        /**
         * Handle image picker from text modal
         */
        btnPickImage.addEventListener('click', () => {
            window._textModalImageCallback = (imageData) => {
                textModalState.selectedImage = imageData;
                textModalState.selectedImagePath = imageData.url;
                imagePreviewContainer.style.display = 'block';
                imagePreview.src = imageData.url;
                imagePath.textContent = `مسار: ${imageData.url}`;
            };
            window._tinyRequestedType = 'image';
            textModal.style.zIndex = '10050';
            window.vvcMediaModalManager.openModal('textmodal');
        });

        /**
         * Remove selected image from text modal
         */
        btnRemoveImage.addEventListener('click', () => {
            textModalState.selectedImage = null;
            textModalState.selectedImagePath = null;
            imagePreviewContainer.style.display = 'none';
            imagePreview.src = '';
            imagePath.textContent = '';
        });

        /**
         * Insert read more block into editor
         */
        btnInsertReadMore.addEventListener('click', () => {
            const selectedOption = readMoreContentSelect.options[readMoreContentSelect.selectedIndex];
            const contentId = readMoreContentSelect.value;
            if (!contentId) {
                alert('⚠️ يرجى اختيار محتوى من القائمة');
                return;
            }

            // Insert only a placeholder div with data-content-id attribute
            // The frontend will dynamically load and render the actual content
            let html =
                `<div class="read-more-block mceNonEditable" data-content-id="${escapeHtml(contentId)}" contenteditable="false">`;
            html += '<span class="read-more-placeholder">جاري تحميل المحتوى...</span>';
            html += '</div><p>&nbsp;</p>';

            if (window.tinymce && tinymce.activeEditor) {
                tinymce.activeEditor.focus();
                tinymce.activeEditor.execCommand('mceInsertContent', false, html);
            } else {
                alert('⚠️ محرر TinyMCE غير متاح');
                return;
            }
            window.vvcReadMoreModalManager.closeModal();
        });

        /**
         * Restore z-index when closing media modal
         */
        const originalCloseModal = window.vvcMediaModalManager.closeModal;
        window.vvcMediaModalManager.closeModal = function() {
            originalCloseModal.call(this);
            textModal.style.zIndex = '';
        };

        /**
         * Handle image selection from media modal for text modal
         */
        const originalOnMediaSelected = window.vvcMediaModalManager.onMediaSelected;
        window.vvcMediaModalManager.onMediaSelected = function(payload) {
            if (typeof window._textModalImageCallback === 'function') {
                window._textModalImageCallback(payload);
                window._textModalImageCallback = null;
                window.vvcMediaModalManager.closeModal();
                return;
            }
            originalOnMediaSelected.call(this, payload);
        };

        // ============================================
        // MODAL EVENT LISTENERS
        // ============================================
        textBackdrop.addEventListener('click', () => window.vvcTextModalManager.closeModal());
        textCloses.forEach(b => b.addEventListener('click', () => window.vvcTextModalManager.closeModal()));
        textContainer.addEventListener('click', e => e.stopPropagation());

        definitionBackdrop.addEventListener('click', () => window.vvcDefinitionModalManager.closeModal());
        definitionCloses.forEach(b => b.addEventListener('click', () => window.vvcDefinitionModalManager
            .closeModal()));
        definitionContainer.addEventListener('click', e => e.stopPropagation());

        readMoreBackdrop.addEventListener('click', () => window.vvcReadMoreModalManager.closeModal());
        readMoreCloses.forEach(b => b.addEventListener('click', () => window.vvcReadMoreModalManager.closeModal()));
        readMoreContainer.addEventListener('click', e => e.stopPropagation());

        /**
         * Insert or update clickable text in editor
         */
        btnInsertText.addEventListener('click', () => {
            const content = textContentInput.value.trim();
            const key = textKeyInput.value.trim();
            const description = textDescriptionInput.value.trim();

            if (!content) {
                alert('⚠️ يرجى إدخال النص المعروض');
                return;
            }
            if (!description) {
                alert('⚠️ يرجى إدخال الوصف');
                return;
            }

            // Add or update text definition in storage
            window.vvcTextModalManager.addTextDefinition(key, content, description, textModalState
                .selectedImagePath);

            if (textModalState.isEditMode && textModalState.editingElement) {
                // UPDATE MODE: Update existing element
                const oldKey = textModalState.editingElement.getAttribute('data-term');

                // Update the element's attributes and content
                textModalState.editingElement.textContent = content;
                textModalState.editingElement.setAttribute('data-term', key);
                textModalState.editingElement.setAttribute('data-description', description);

                if (textModalState.selectedImagePath) {
                    textModalState.editingElement.setAttribute('data-image', textModalState
                        .selectedImagePath);
                } else {
                    textModalState.editingElement.removeAttribute('data-image');
                }

                // If key changed, remove old definition from storage
                if (oldKey && oldKey !== key && window.vvcTextDefinitions[oldKey]) {
                    delete window.vvcTextDefinitions[oldKey];
                }

                // Trigger TinyMCE change event
                if (window.tinymce && tinymce.activeEditor) {
                    tinymce.activeEditor.fire('change');
                }
            } else {
                // INSERT MODE: Create new element
                if (window.tinymce && tinymce.activeEditor) {
                    tinymce.activeEditor.focus();
                    const escapedKey = escapeHtml(key).replace(/"/g, '&quot;');
                    const escapedDesc = escapeHtml(description).replace(/"/g, '&quot;');
                    const escapedContent = escapeHtml(content);
                    let attr =
                        `class="clickable-term" data-term="${escapedKey}" data-description="${escapedDesc}"`;
                    if (textModalState.selectedImagePath) {
                        attr +=
                            ` data-image="${escapeHtml(textModalState.selectedImagePath).replace(/"/g, '&quot;')}"`;
                    }
                    tinymce.activeEditor.execCommand('mceInsertContent', false,
                        `<span ${attr}>${escapedContent}</span>`);
                } else {
                    alert('⚠️ محرر TinyMCE غير متاح');
                    return;
                }
            }
            window.vvcTextModalManager.closeModal();
        });

        /**
         * Handle clickable term clicks to show definition modal
         */
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('clickable-term')) {
                e.preventDefault();
                const term = e.target.getAttribute('data-term');
                window.vvcDefinitionModalManager.openModal(term);
            }
        });

        /**
         * Global keyboard shortcuts (Escape to close modals)
         */
        document.addEventListener('keydown', e => {
            if (textModal.getAttribute('aria-hidden') === 'false' && e.key === 'Escape') {
                window.vvcTextModalManager.closeModal();
            }
            if (definitionModal.getAttribute('aria-hidden') === 'false' && e.key === 'Escape') {
                window.vvcDefinitionModalManager.closeModal();
            }
            if (readMoreModal.getAttribute('aria-hidden') === 'false' && e.key === 'Escape') {
                window.vvcReadMoreModalManager.closeModal();
            }
        });

        /**
         * HTML escape function for security
         * @param {string} str - String to escape
         * @returns {string} Escaped string
         */
        window.escapeHtml = function(str) {
            if (str == null) return '';
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g,
                '&quot;').replace(/'/g, '&#39;');
        };
    })();

    /**
     * ============================================
     * TINYMCE INITIALIZATION
     * ============================================
     */

    // Load Instagram embed script
    if (!window.instagramEmbedLoaded) {
        const instagramScript = document.createElement('script');
        instagramScript.src = 'https://www.instagram.com/embed.js';
        instagramScript.async = true;
        document.head.appendChild(instagramScript);
        window.instagramEmbedLoaded = true;
    }

    // Detect theme preference
    const theme = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';

    /**
     * Pick media for TinyMCE editor
     * @param {object} opts - Options (type: 'media', 'image', etc)
     * @returns {Promise} Promise resolving to selected media object
     */
    window.pickMediaForTiny = function(opts = {
        type: 'media'
    }) {
        return new Promise((resolve) => {
            window._resolveTinyPick = resolve;
            window._tinyRequestedType = opts.type || 'media';
            if (window.vvcMediaModalManager?.openModal) {
                window.vvcMediaModalManager.openModal('tiny');
            } else {
                console.error('vvc Modal manager not found.');
                resolve(null);
            }
        });
    };

    /**
     * TinyMCE Configuration and Initialization
     */
    tinymce.init({
        selector: 'textarea#myeditorinstance',
        directionality: 'rtl',
        height: 600,
        promotion: false,
        onboarding: false,
        auto_focus: false,
        // Custom CSS for editor content
        content_style: `
        body{font-family:Arial,Helvetica,sans-serif !important;font-size:18pt !important;line-height:1.6 !important;}
        img.tiny-sm,video.tiny-sm{width:280px;height:auto;max-width:100%;}

        /* Facebook embed block placeholder inside editor */
        .fb-embed-block{
            display:block;
            border:2px dashed #1877f2;
            background:#f5f7fb;
            padding:0.75rem 1rem;
            margin:1rem 0;
            border-radius:6px;
            text-align:center;
            font-size:0.9rem;
            color:#41516b;
            cursor:pointer;
        }
        .fb-embed-block .fb-embed-title{
            font-weight:700;
            margin-bottom:0.25rem;
        }
        .fb-embed-block .fb-embed-url{
            font-size:0.8rem;
            direction:ltr;
            unicode-bidi:bidi-override;
            word-break:break-all;
            color:#1877f2;
        }
        /* Hide actual fb-post markup inside editor; only show placeholder */
        .fb-embed-block .fb-post{
            display:none;
        }
        .clickable-term{color:#0066cc;text-decoration:underline;cursor:pointer;padding:2px 4px;border-radius:3px;transition:background-color 0.2s;background-color:transparent;}
        .clickable-term:hover{background-color:#e6f2ff;text-decoration:none;}

        /* ReadMore Block Container */
        .read-more-block{
            border:2px solid #e0e0e0;
            border-radius:8px;
            overflow:hidden;
            margin:1rem 0;
            background:#fff;
            box-shadow:0 2px 8px rgba(0,0,0,0.1);
            display:flex;
            align-items:stretch;
            position:relative;
            user-select:none;
            cursor:pointer;
            transition:all 0.2s ease;
        }
        .read-more-block:hover{
            box-shadow:0 4px 12px rgba(0,0,0,0.15);
            border-color:#6576ff;
        }

        /* ReadMore Label Badge */
        .read-more-block .read-more-label-text{
            position:absolute;
            top:8px;
            left:8px;
            font-size:0.7rem;
            font-weight:600;
            color:#fff;
            background:#6576ff;
            padding:4px 12px;
            border-radius:12px;
            z-index:10;
            box-shadow:0 2px 4px rgba(0,0,0,0.2);
        }

        /* ReadMore Image (Right Side) */
        .read-more-block .read-more-image{
            width:180px;
            min-width:180px;
            max-width:180px;
            height:auto;
            max-height:150px;
            object-fit:cover;
            order:2;
            flex-shrink:0;
        }

        /* ReadMore Content Area (Left Side) */
        .read-more-block .read-more-content{
            flex:1;
            padding:1rem;
            display:flex;
            flex-direction:column;
            justify-content:center;
            order:1;
            min-width:0;
        }

        /* Category Label */
        .read-more-block .read-more-category{
            font-size:0.75rem;
            color:#888;
            text-align:right;
            margin:0 0 0.5rem 0;
            font-weight:500;
        }

        /* Title */
        .read-more-block .read-more-title{
            font-size:1.1rem;
            font-weight:700;
            margin:0 0 0.5rem 0;
            color:#2c3e50;
            line-height:1.4;
            text-align:right;
        }

        /* Summary Text */
        .read-more-block .read-more-summary{
            color:#555;
            line-height:1.5;
            margin:0;
            font-size:0.9rem;
            text-align:right;
            overflow:hidden;
            display:-webkit-box;
            -webkit-line-clamp:2;
            -webkit-box-orient:vertical;
        }

        /* Placeholder (Loading State) */
        .read-more-block .read-more-placeholder{
            display:block;
            text-align:center;
            color:#6576ff;
            font-weight:600;
            font-size:0.95rem;
            padding:2rem;
            width:100%;
        }

        .mceNonEditable{outline:2px solid transparent;transition:outline-color 0.2s;}
        .mceNonEditable:focus,.mceNonEditable.mce-edit-focus{outline-color:#6576ff !important;}
    `,
        setup: (editor) => {
            // ---- READMORE LOADER FOR TINYMCE ----
            // Load and render ReadMore blocks inside TinyMCE editor
            function loadReadMoreBlocksInEditor() {
                const editorBody = editor.getBody();
                if (!editorBody) return;

                const readMoreBlocks = editorBody.querySelectorAll(
                    '.read-more-block[data-content-id]:not([data-loaded])');

                if (readMoreBlocks.length === 0) return;

                console.log('Found ReadMore blocks in TinyMCE:', readMoreBlocks.length);

                // Extract all content IDs
                const contentIds = Array.from(readMoreBlocks).map(block => block.dataset.contentId);

                // Batch fetch all ReadMore contents
                fetch('/api/readmore-batch', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            ids: contentIds
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            console.error('ReadMore API error:', response.status, response.statusText);
                            throw new Error(`Network response was not ok: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(result => {
                        console.log('ReadMore API response:', result);
                        if (result.success && result.data) {
                            // Replace each placeholder with actual content
                            readMoreBlocks.forEach(block => {
                                const contentId = block.dataset.contentId;
                                const contentData = result.data.find(item => item.id ==
                                    contentId);

                                if (contentData) {
                                    console.log(`Rendering ReadMore card for ID: ${contentId}`,
                                        contentData);
                                    renderReadMoreCardInEditor(block, contentData);
                                    block.setAttribute('data-loaded', 'true');
                                } else {
                                    // Content not found
                                    const placeholder = block.querySelector(
                                        '.read-more-placeholder');
                                    if (placeholder) {
                                        placeholder.textContent = 'محتوى غير موجود';
                                        placeholder.style.color = '#dc3545';
                                    }
                                    console.warn(
                                        `ReadMore content not found for ID: ${contentId}`);
                                }
                            });
                        } else {
                            console.error('Failed to load ReadMore content:', result.message ||
                                'Unknown error');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching ReadMore content:', error);
                        readMoreBlocks.forEach(block => {
                            const placeholder = block.querySelector('.read-more-placeholder');
                            if (placeholder) {
                                placeholder.textContent = 'خطأ في تحميل المحتوى';
                                placeholder.style.color = '#dc3545';
                            }
                        });
                    });
            }

            // Render a ReadMore card with fetched data inside TinyMCE
            function renderReadMoreCardInEditor(placeholderBlock, contentData) {
                // Set the shortlink data attribute for click handler
                if (contentData.shortlink) {
                    placeholderBlock.setAttribute('data-shortlink', contentData.shortlink);
                }

                // Build the HTML for the ReadMore card content
                let html = '<span class="read-more-label-text">اقرأ أيضاً</span>';

                if (contentData.image_url) {
                    html +=
                        `<img src="${escapeHtml(contentData.image_url)}" alt="${escapeHtml(contentData.title)}" class="read-more-image">`;
                }

                html += '<div class="read-more-content">';

                if (contentData.category) {
                    html += `<p class="read-more-category">${escapeHtml(contentData.category)}</p>`;
                }

                html += `<h3 class="read-more-title">${escapeHtml(contentData.title)}</h3>`;

                if (contentData.summary) {
                    html += `<p class="read-more-summary">${escapeHtml(contentData.summary)}</p>`;
                }

                html += '</div>';

                // Insert the content into the existing block
                placeholderBlock.innerHTML = html;
            }

            // Load readmore blocks when editor content is set or changed
            editor.on('SetContent', function() {
                setTimeout(loadReadMoreBlocksInEditor, 100);
            });

            // Load readmore blocks when editor is initialized
            editor.on('init', function() {
                setTimeout(loadReadMoreBlocksInEditor, 100);
            });

            // ---- CLICKABLE TEXT DOUBLE-CLICK EDIT HANDLER ----
            // Track double-clicks manually since TinyMCE's dblclick event is unreliable with inline elements
            let lastClickTime = 0;
            let lastClickTarget = null;
            const DOUBLE_CLICK_DELAY = 500; // milliseconds

            editor.on('click', function(e) {
                const target = e.target;
                const currentTime = Date.now();

                // Check if the clicked element is a clickable term
                if (target.classList && target.classList.contains('clickable-term')) {
                    // Check if this is a double-click (same target within delay)
                    if (lastClickTarget === target && (currentTime - lastClickTime) <
                        DOUBLE_CLICK_DELAY) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Open modal in edit mode with the current element
                        if (window.vvcTextModalManager?.openModal) {
                            window.vvcTextModalManager.openModal(target);
                        }

                        // Reset tracking
                        lastClickTime = 0;
                        lastClickTarget = null;
                    } else {
                        // First click - track it
                        lastClickTime = currentTime;
                        lastClickTarget = target;
                    }
                } else {
                    // Reset tracking if clicking elsewhere
                    lastClickTime = 0;
                    lastClickTarget = null;
                }
            });

            // ---- MEDIA PICKER BUTTON ----
            editor.ui.registry.addButton('vvcPicker', {
                text: 'وسائط',
                tooltip: 'اختيار وسائط من المعرض',
                onAction: async () => {
                    const picked = await window.pickMediaForTiny({
                        type: 'media'
                    });
                    if (!picked || !picked.url) return;
                    const isImg = /\.(png|jpe?g|webp|gif|bmp|svg)(\?|$)/i.test(picked.url);
                    editor.focus();
                    if (isImg) {
                        editor.execCommand('mceInsertContent', false,
                            `<figure class="image"><img class="tiny-sm" src="${escapeHtml(picked.url)}" alt="${escapeHtml(picked.alt||picked.title)}" title="${escapeHtml(picked.title)}"/><figcaption>${escapeHtml(picked.title)}</figcaption></figure>`
                        );
                    } else {
                        const u = picked.url;
                        const youtubeMatch = u.match(
                            /(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/i);
                        const vimeoMatch = u.match(/vimeo\.com\/(\d+)/i);
                        if (youtubeMatch) {
                            const vid = youtubeMatch[1];
                            editor.execCommand('mceInsertContent', false,
                                `<iframe class="tiny-sm" src="https://www.youtube.com/embed/${escapeHtml(vid)}" frameborder="0" allowfullscreen></iframe>`
                            );
                        } else if (vimeoMatch) {
                            const vid = vimeoMatch[1];
                            editor.execCommand('mceInsertContent', false,
                                `<iframe class="tiny-sm" src="https://player.vimeo.com/video/${escapeHtml(vid)}" frameborder="0" allowfullscreen></iframe>`
                            );
                        } else {
                            editor.execCommand('mceInsertContent', false,
                                `<video class="tiny-sm" src="${escapeHtml(picked.url)}" controls preload="metadata"></video>`
                            );
                        }
                    }
                }
            });

            // ---- CLICKABLE TEXT BUTTON ----
            editor.ui.registry.addButton('vvcClickableText', {
                text: 'نص تفاعلي',
                tooltip: 'إضافة نص قابل للنقر',
                onAction: () => {
                    if (window.vvcTextModalManager?.openModal) {
                        window.vvcTextModalManager.openModal();
                    }
                }
            });

            // ---- READ MORE BUTTON ----
            editor.ui.registry.addButton('vvcReadMore', {
                text: 'اقرأ المزيد',
                tooltip: 'إدراج محتوى اقرأ المزيد',
                onAction: () => {
                    if (window.vvcReadMoreModalManager?.openModal) {
                        window.vvcReadMoreModalManager.openModal();
                    }
                }
            });

            // ---- FACEBOOK POST EMBED BUTTON ----
            editor.ui.registry.addButton('vvcFacebookPost', {
                text: 'فيسبوك',
                tooltip: 'إدراج منشور فيسبوك',
                onAction: () => {
                    const url = window.prompt('أدخل رابط منشور فيسبوك');
                    if (!url) return;

                    const trimmedUrl = url.trim();
                    if (!trimmedUrl) return;

                    const safeUrl = escapeHtml(trimmedUrl);
                    const fbPostHtml = `
                        <div class="fb-embed-block mceNonEditable" contenteditable="false" data-fb-url="${safeUrl}" onclick="window.open('${safeUrl}', '_blank')" style="cursor: pointer;">
                            <div class="fb-embed-title">منشور فيسبوك</div>
                            <div class="fb-embed-url">${safeUrl}</div>
                            <div class="fb-post" data-href="${safeUrl}" data-show-text="false">
                                <blockquote class="fb-xfbml-parse-ignore" cite="${safeUrl}">
                                    <a href="${safeUrl}" target="_blank" rel="noopener noreferrer">${safeUrl}</a>
                                </blockquote>
                            </div>
                        </div>
                    `;

                    editor.insertContent(fbPostHtml);
                }
            });

            // ---- INSTAGRAM POST EMBED BUTTON ----
            editor.ui.registry.addButton('vvcInstagramPost', {
                text: 'انستجرام',
                tooltip: 'إدراج منشور انستجرام',
                onAction: () => {
                    const url = window.prompt('أدخل رابط منشور انستجرام');
                    if (!url) return;

                    const trimmedUrl = url.trim();
                    if (!trimmedUrl) return;

                    const safeUrl = escapeHtml(trimmedUrl);
                    
                    const instagramPostHtml = `
                        <div style="display: flex; justify-content: center; margin: 20px 0;">
                            <blockquote class="instagram-media" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                                <div style="padding:16px;">
                                    <a href="${safeUrl}" target="_blank" rel="noopener noreferrer">منشور من Instagram</a>
                                </div>
                            </blockquote>
                        </div>
                    `;

                    editor.insertContent(instagramPostHtml);
                    
                    // Schedule reprocessing after a short delay to allow DOM to update
                    setTimeout(() => {
                        if (window.instgrm && window.instgrm.Embed) {
                            window.instgrm.Embed.process();
                        }
                    }, 100);
                }
            });

            // ---- CONTEXT MENU (Right-click) ----
            editor.ui.registry.addContextMenu('copy_cut_paste', {
                predicate: (node) => true,
                items: 'copy cut paste'
            });

            // ---- CONTEXT MENU ITEM FOR EDITING CLICKABLE TEXT ----
            editor.ui.registry.addMenuItem('editClickableText', {
                text: 'تعديل النص التفاعلي',
                icon: 'edit-block',
                onAction: function() {
                    const selectedNode = editor.selection.getNode();
                    if (selectedNode && selectedNode.classList && selectedNode.classList
                        .contains('clickable-term')) {
                        window.vvcTextModalManager.openModal(selectedNode);
                    }
                }
            });

            // Add context menu for clickable text elements
            editor.ui.registry.addContextMenu('clickable_text', {
                predicate: (node) => {
                    return node.classList && node.classList.contains('clickable-term');
                },
                items: 'editClickableText | copy cut paste'
            });

            // ---- CUSTOM PASTE BUTTON ----
            editor.ui.registry.addButton('vvcPaste', {
                text: 'لصق',
                tooltip: 'لصق من الحافظة (Ctrl+V)',
                icon: 'paste',
                onAction: () => {
                    navigator.clipboard.readText().then((text) => {
                        if (text) {
                            editor.execCommand('mceInsertContent', false, escapeHtml(
                                text));
                        }
                    }).catch((err) => {
                        alert(
                            '⚠️ تعذّر الوصول إلى الحافظة. يرجى استخدام Ctrl+V بدلاً من ذلك.'
                        );
                        console.error('Clipboard access error:', err);
                    });
                }
            });
        },
        // Theme configuration
        skin: theme === 'dark' ? 'oxide-dark' : 'oxide',
        content_css: theme === 'dark' ? 'dark' : 'default',
        // Plugins
        plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help hr image imagetools importcss insertdatetime link lists media nonbreaking noneditable pagebreak preview print save searchreplace table template visualblocks visualchars wordcount',
        noneditable_class: 'mceNonEditable',
        toolbar_mode: 'wrap',
        // Toolbar configuration
        toolbar: [
            'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor',
            '| alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist',
            '| link table image media blockquote vvcPicker vvcClickableText vvcReadMore vvcFacebookPost vvcInstagramPost vvcPaste',
            '| code fullscreen wordcount searchreplace | removeformat subscript superscript charmap emoticons insertdatetime pagebreak preview print template visualblocks visualchars help'
        ].join(' '),
        fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 36pt',
        font_family_formats: 'Arial=arial,helvetica,sans-serif; Helvetica=helvetica; Times New Roman=times new roman,times; Courier New=courier;',
        file_picker_types: 'image media',
        /**
         * Custom file picker for images and media
         */
        file_picker_callback: async (cb, value, meta) => {
            const picked = await window.pickMediaForTiny({
                type: meta.filetype
            });
            if (!picked || !picked.url) return;
            if (meta.filetype === 'image') {
                cb(picked.url, {
                    title: picked.title || '',
                    alt: picked.alt || '',
                    class: 'tiny-sm'
                });
            } else {
                cb(picked.url, {
                    text: picked.title || picked.url
                });
            }
        },
        image_caption: true,
        image_title: true,
        image_advtab: true,
        menubar: 'file edit view insert format tools table help',
        // Context menu configuration
        contextmenu: 'copy cut vvcPaste | selectall',
        // Auto-save configuration
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        // Extended valid elements for custom HTML
        extended_valid_elements: 'script[src|async|charset],blockquote[class|lang|dir],iframe[src|width|height|frameborder|allowfullscreen|allow|scrolling|style]',
        valid_children: '+body[script],+div[script]',
        valid_elements: '*[*]'
    });
</script>
