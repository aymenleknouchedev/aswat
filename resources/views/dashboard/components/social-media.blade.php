<!-- ====================== SOCIAL MEDIA TAB ====================== -->
<div class="tab-pane" id="social-media" role="tabpanel" aria-labelledby="social-media-tab">
    <div class="social-media-tab-content">
        <div class="row g-3 mt-3">
            <!-- Share Image (uses the same field-card pattern as the Media tab) -->
            <div class="col-12">
                <div class="template-fields">
                    <h6 class="template-title">الصورة</h6>
                    <div class="fields-grid">
                        <div class="field-card field-card--full">
                            <label class="field-label">صورة المشاركة</label>
                        </div>
                        <div class="field-card">
                            <div class="field-preview" id="share_image_preview_field">
                                <!-- Empty state (visible when no image is selected) -->
                                <div id="share_image_placeholder" class="field-empty"
                                    onclick="document.getElementById('btnPickShareImage').click();">
                                    <i class="fas fa-image"></i>
                                    <span>اختر صورة</span>
                                </div>
                                <!-- Preview state (visible when an image is selected) -->
                                <div id="share_image_preview_wrapper" class="media-preview-selected d-none">
                                    <div class="media-visual">
                                        <img id="share_image_preview" class="media-thumb" src="" alt="">
                                    </div>
                                    <div class="media-info">
                                        <span class="media-title" id="share_image_name">بدون عنوان</span>
                                        <span class="media-type">صورة</span>
                                    </div>
                                    <div class="media-actions">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            id="btnPickShareImage">تغيير</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            id="btnRemoveShareImage">حذف</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Hidden inputs that JS / form submission consume -->
                            <input type="hidden" id="share_image_url" name="share_image_url">
                            <input type="hidden" id="share_image_id" name="share_image_id">
                            <input type="hidden" id="share_image_title" name="share_image_title">
                            <input type="hidden" id="share_image_alt" name="share_image_alt">
                            <!-- Compatibility shim: the bridge JS still binds to btnClearShareImage -->
                            <button type="button" id="btnClearShareImage" class="d-none" aria-hidden="true"></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Share Title (full width) -->
            <div class="col-12">
                <div class="template-fields">
                    <h6 class="template-title">العنوان</h6>
                    <div class="fields-grid">
                        <div class="field-card field-card--full">
                            <label for="share_title" class="field-label">العنوان</label>
                            <input type="text" id="share_title" name="share_title" class="form-control"
                                value="{{ old('share_title', '') }}" placeholder="أدخل عنوان المشاركة" maxlength="100"
                                oninput="updatePreview()">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Share Description (full width) -->
            <div class="col-12">
                <div class="template-fields">
                    <h6 class="template-title">الوصف</h6>
                    <div class="fields-grid">
                        <div class="field-card field-card--full">
                            <label for="share_description" class="field-label">الوصف</label>
                            <textarea id="share_description" name="share_description" class="form-control" rows="4"
                                placeholder="أدخل وصف المشاركة" maxlength="260" oninput="updatePreview()">{{ old('share_description', '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* === Social Media preview helpers === */
    .image-preview-container img {
        max-height: 200px
    }
</style>

<!-- ================== MMXc MEDIA MODAL (FULL, FIXED, TYPE BADGE, NO SUCCESS ALERTS) ================== -->
<!-- Sprite d'icônes (optionnel) -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
    <symbol id="mmxc-icon-image" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <circle cx="8" cy="10" r="1.5" fill="currentColor" />
        <path d="M21 19l-5.5-7-4.5 6-3-4-4 5" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="mmxc-icon-video" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
    <symbol id="mmxc-icon-voice" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <rect x="9" y="7" width="2" height="10" rx="1" fill="currentColor" />
        <rect x="13" y="11" width="2" height="6" rx="1" fill="currentColor" />
    </symbol>
    <symbol id="mmxc-icon-file" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <path d="M9 7h6M9 11h6M9 15h2" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="mmxc-icon-youtube" viewBox="0 0 24 24">
        <rect x="2" y="6" width="20" height="12" rx="4" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
</svg>

<!-- CSRF -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="mmxcMediaModal" class="mmxc-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="mmxcMediaModalTitle">
    <div class="mmxc-backdrop" data-mmxc-backdrop></div>
    <div class="mmxc-container" role="document">
        <div class="mmxc-header">
            <h5 id="mmxcMediaModalTitle">اختر الوسائط</h5>
            <button class="mmxc-close" type="button" data-mmxc-close aria-label="إغلاق">&times;</button>
        </div>

        <!-- Tabs -->
        <div class="mmxc-tabs" role="tablist" aria-label="أقسام إدارة الوسائط">
            <button type="button" class="mmxc-tab-btn mmxc-is-active" role="tab" aria-selected="true"
                aria-controls="mmxc-tab-gallery" id="mmxc-tabbtn-gallery" tabindex="0" data-mmxc-tab="gallery"
                data-en="Gallery" data-ar="المعرض">المعرض</button>
            <button type="button" class="mmxc-tab-btn" role="tab" aria-selected="false"
                aria-controls="mmxc-tab-upload" id="mmxc-tabbtn-upload" tabindex="-1" data-mmxc-tab="upload"
                data-en="Upload from device" data-ar="الرفع من الجهاز">الرفع من
                الجهاز</button>
            <button type="button" class="mmxc-tab-btn" role="tab" aria-selected="false"
                aria-controls="mmxc-tab-import" id="mmxc-tabbtn-import" tabindex="-1" data-mmxc-tab="import"
                data-en="Import by URL" data-ar="الاستيراد بالرابط">الاستيراد
                بالرابط</button>
        </div>

        <!-- Gallery -->
        <section id="mmxc-tab-gallery" class="mmxc-tab-panel" role="tabpanel" aria-labelledby="mmxc-tabbtn-gallery">
            <div class="mmxc-filters">
                <input type="text" id="mmxc-search" placeholder="ابحث عن وسائط..." />
                <select id="mmxc-type-filter" aria-label="نوع الوسائط">
                    <option value="all">كل الوسائط</option>
                    <option value="image">صورة</option>
                    <option value="video">فيديو</option>
                    <option value="voice">صوت</option>
                    <option value="file">ملف</option>
                </select>
            </div>

            <div class="mmxc-body">
                <div id="mmxc-list" class="mmxc-grid"></div>
                <div id="mmxc-loader" class="mmxc-loader" hidden>جاري التحميل...</div>
            </div>
            <nav id="mmxc-pagination" class="mmxc-pagination" aria-label="ترقيم الصفحات"></nav>

            <div class="mmxc-footer">
                <button class="mmxc-btn mmxc-btn-select" type="button" id="mmxc-btn-select" data-en="Select"
                    data-ar="اختر">اختر</button>
                <button class="mmxc-btn mmxc-btn-cancel" type="button" data-mmxc-close data-en="Cancel"
                    data-ar="إلغاء">إلغاء</button>
            </div>
        </section>

        <!-- Upload -->
        <section id="mmxc-tab-upload" class="mmxc-tab-panel" role="tabpanel" aria-labelledby="mmxc-tabbtn-upload"
            hidden>
            <div class="mmxc-tab-body">
                <div class="mmxc-uploader">
                    <div class="mmxc-upload-fields" style="display: flex; flex-wrap: wrap; gap: .6rem; width: 100%;">
                        <div style="flex: 1 1 220px;">
                            <input type="file" id="mmxc-upload-input" class="mmxc-upload-input"
                                style="display: none;" />
                            <label for="mmxc-upload-input" id="mmxc-upload-label"
                                style="display: block; width: 100%; cursor: pointer; padding: .6rem .7rem; border: 1px solid var(--mmxc-border); border-radius: 0; background: var(--mmxc-gray-100); color: var(--mmxc-text); text-align: center; transition: all 0.2s;"
                                data-ar="اختر ملف الوسائط" data-en="Select media file">
                                <i class="fa fa-upload" style="margin-right: 6px;"></i>
                                <span id="mmxc-upload-label-text">اختر ملف الوسائط</span>
                            </label>

                        </div>
                        <div style="flex: 1 1 200px;">
                            <input type="text" id="mmxc-upload-name" class="mmxc-upload-name"
                                placeholder="اسم الملف"
                                style="width: 100%; padding: .6rem .7rem; border: 1px solid var(--mmxc-border); border-radius: 0; background: var(--mmxc-bg); color: var(--mmxc-text);" />
                        </div>
                        <div style="flex: 1 1 200px;">
                            <input type="text" id="mmxc-upload-alt" class="mmxc-upload-alt"
                                placeholder="النص البديل"
                                style="width: 100%; padding: .6rem .7rem; border: 1px solid var(--mmxc-border); border-radius: 0; background: var(--mmxc-bg); color: var(--mmxc-text);" />
                        </div>
                    </div>
                    <div class="mmxc-uploader-actions">
                        <button class="mmxc-btn mmxc-btn-secondary" type="button" id="mmxc-btn-upload-to-gallery"
                            title="إدراج في المعرض" data-en="Insert into gallery" data-ar="إدراج في المعرض">إدراج في
                            المعرض</button>
                        <button class="mmxc-btn mmxc-btn-primary" type="button" id="mmxc-btn-upload-and-select-close"
                            title="إدراج في المقال" data-en="Insert into article" data-ar="إدراج في المقال">إدراج في
                            المقال</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Import by URL -->
        <section id="mmxc-tab-import" class="mmxc-tab-panel" role="tabpanel" aria-labelledby="mmxc-tabbtn-import"
            hidden>
            <div class="mmxc-tab-body">
                <div class="mmxc-uploader mmxc-uploader-url"
                    style="padding:1.2rem; border-radius:8px; border:1px solid var(--mmxc-border); box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display:flex; flex-wrap:wrap; gap:.7rem; margin-bottom:.7rem; width:100%;">
                        <input type="text" id="mmxc-upload-url"
                            style="flex:1 1 100%; padding:.7rem 1rem; border:1px solid var(--mmxc-border); border-radius:6px; background:var(--mmxc-bg); color:var(--mmxc-text); font-size:1rem;"
                            placeholder="الرابط" />
                        <input type="text" id="mmxc-url-name" placeholder="اسم الملف"
                            style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid var(--mmxc-border); border-radius:6px; background:var(--mmxc-bg); color:var(--mmxc-text); font-size:1rem;" />
                        <input type="text" id="mmxc-url-alt" placeholder="النص البديل"
                            style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid var(--mmxc-border); border-radius:6px; background:var(--mmxc-bg); color:var(--mmxc-text); font-size:1rem;" />
                    </div>
                    <fieldset class="mmxc-url-type-group" aria-label="نوع الوسائط للرابط"
                        style="margin-bottom:.7rem; border-radius:6px; border:1px solid var(--mmxc-border); padding:.7rem 1rem; background:var(--mmxc-bg);">
                        <legend style="font-size:.97rem; color:var(--mmxc-text); padding:0 .3rem; font-weight:500;">نوع
                            الوسائط
                            (اختياري)</legend>
                        <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
                            <label class="mmxc-radio" style="font-size:.97rem; color:var(--mmxc-text);"><input
                                    type="radio" name="mmxc-url-type" value="auto"
                                    checked /><span>Auto</span></label>
                            <label class="mmxc-radio" style="font-size:.97rem; color:var(--mmxc-text);"><input
                                    type="radio" name="mmxc-url-type" value="image" /><span>Image</span></label>
                            <label class="mmxc-radio" style="font-size:.97rem; color:var(--mmxc-text);"><input
                                    type="radio" name="mmxc-url-type" value="video" /><span>Video</span></label>
                            <label class="mmxc-radio" style="font-size:.97rem; color:var(--mmxc-text);"><input
                                    type="radio" name="mmxc-url-type" value="voice" /><span>Voice</span></label>
                            <label class="mmxc-radio" style="font-size:.97rem; color:var(--mmxc-text);"><input
                                    type="radio" name="mmxc-url-type" value="file" /><span>File</span></label>
                        </div>
                    </fieldset>
                    <div class="mmxc-uploader-actions" style="display:flex; gap:.7rem; margin-bottom:.7rem;">
                        <button class="mmxc-btn mmxc-btn-secondary" type="button" id="mmxc-btn-import-to-gallery"
                            title="استيراد بالرابط ثم عرض في المعرض"
                            style="border-radius:6px; font-size:1rem; padding:.7rem 1.2rem;">إدراج في المعرض
                        </button>
                        <button class="mmxc-btn mmxc-btn-primary" type="button" id="mmxc-btn-import-and-select-close"
                            title="استيراد بالرابط ثم حفظ وإغلاق"
                            style="border-radius:6px; font-size:1rem; padding:.7rem 1.2rem;">إدراج في المقال</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    /* ===== MMXc NAMESPACE – Updated for white/dark mode compatibility ===== */
    #mmxcMediaModal,
    #mmxcMediaModal * {
        box-sizing: border-box;
    }

    #mmxcMediaModal * {
        border-radius: 0 !important;
    }

    :root {
        /* Light mode colors */
        --mmxc-primary: #6576ff;
        --mmxc-secondary: #364a63;
        --mmxc-success: #1ee0ac;
        --mmxc-danger: #e85347;
        --mmxc-warning: #f4bd0e;
        --mmxc-info: #09c2de;

        --mmxc-bg: #fff;
        --mmxc-text: #526484;
        --mmxc-border: #dbdfea;
        --mmxc-ring: #6576ff;
        --mmxc-muted: #8091a7;

        --mmxc-gray-100: #ebeef2;
        --mmxc-gray-200: #e5e9f2;
        --mmxc-gray-300: #dbdfea;
        --mmxc-gray-400: #b7c2d0;
        --mmxc-gray-500: #8091a7;
        --mmxc-gray-600: #3c4d62;
        --mmxc-gray-700: #344357;
        --mmxc-gray-800: #2b3748;
        --mmxc-gray-900: #1f2b3a;
    }

    [data-bs-theme="dark"] {
        /* Dark mode colors */
        --mmxc-primary: #6576ff;
        --mmxc-secondary: #364a63;
        --mmxc-success: #1ee0ac;
        --mmxc-danger: #e85347;
        --mmxc-warning: #f4bd0e;
        --mmxc-info: #09c2de;

        --mmxc-bg: #0D141D;
        --mmxc-text: #e5e9f2;
        --mmxc-border: #384D69;
        --mmxc-ring: #6576ff;
        --mmxc-muted: #b7c2d0;

        --mmxc-gray-100: #2b3748;
        --mmxc-gray-200: #344357;
        --mmxc-gray-300: #3c4d62;
        --mmxc-gray-400: #8091a7;
        --mmxc-gray-500: #b7c2d0;
        --mmxc-gray-600: #dbdfea;
        --mmxc-gray-700: #e5e9f2;
        --mmxc-gray-800: #ebeef2;
        --mmxc-gray-900: #f5f6fa;
    }

    .mmxc-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 10000;
    }

    .mmxc-modal[aria-hidden="false"] {
        display: block;
    }

    .mmxc-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        z-index: 0;
    }

    .mmxc-container {
        position: absolute;
        inset: auto 0;
        top: 5%;
        margin: 0 auto;
        width: clamp(320px, 92vw, 1000px);
        max-height: 90%;
        background: var(--mmxc-bg);
        color: var(--mmxc-text);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        animation: mmxcFade .2s ease-out;
    }

    @keyframes mmxcFade {
        from {
            opacity: 0;
            transform: translateY(-14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mmxc-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--mmxc-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--mmxc-bg);
    }

    .mmxc-header h5 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--mmxc-text);
    }

    .mmxc-close {
        font-size: 1.4rem;
        line-height: 1;
        border: 0;
        background: transparent;
        color: var(--mmxc-muted);
        cursor: pointer;
    }

    .mmxc-close:hover {
        color: var(--mmxc-text);
    }

    .mmxc-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--mmxc-border);
        background: var(--mmxc-bg);
    }

    .mmxc-tab-btn {
        appearance: none;
        background: var(--mmxc-bg);
        border: 1px solid var(--mmxc-border);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--mmxc-text);
    }

    .mmxc-tab-btn:focus {
        outline: 2px solid var(--mmxc-ring);
        outline-offset: 1px;
    }

    .mmxc-tab-btn.mmxc-is-active {
        background: var(--mmxc-primary);
        border-color: var(--mmxc-primary);
        color: white;
    }

    .mmxc-tab-panel {
        display: block;
    }

    .mmxc-tab-panel[hidden] {
        display: none;
    }

    .mmxc-tab-body {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--mmxc-border);
        background: var(--mmxc-bg);
    }

    .mmxc-filters {
        padding: 1rem 1.25rem;
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--mmxc-border);
        background: var(--mmxc-bg);
    }

    .mmxc-filters input,
    .mmxc-filters select {
        padding: .6rem .7rem;
        font-size: .95rem;
        border: 1px solid var(--mmxc-border);
        background: var(--mmxc-bg);
        color: var(--mmxc-text);
        flex: 1 1 180px;
        transition: box-shadow .15s, border-color .15s;
    }

    .mmxc-filters input::placeholder {
        color: var(--mmxc-muted);
    }

    .mmxc-filters input:focus,
    .mmxc-filters select:focus {
        border-color: var(--mmxc-primary);
        box-shadow: 0 0 0 2px rgba(101, 118, 255, 0.1);
        outline: none;
    }

    .mmxc-body {
        padding: 1rem 1.25rem;
        overflow: auto;
        flex: 1;
        background: var(--mmxc-bg);
        min-height: 0;
    }

    .mmxc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: .9rem;
    }

    .mmxc-empty {
        text-align: center;
        color: var(--mmxc-muted);
        font-size: .95rem;
        margin: 2rem 0;
    }

    .mmxc-item {
        position: relative;
        background: var(--mmxc-bg);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: .6rem;
        transition: border-color .15s, transform .04s ease, box-shadow .15s;
    }

    .mmxc-item:hover {
        border-color: var(--mmxc-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.1);
    }

    .mmxc-item:active {
        transform: scale(.995);
    }

    .mmxc-item.mmxc-is-selected {
        border-color: var(--mmxc-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.2);
    }

    .mmxc-thumb {
        width: 100%;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--mmxc-gray-100);
        overflow: hidden;
        position: relative;
        border: 1px solid var(--mmxc-gray-200);
    }

    .mmxc-thumb img,
    .mmxc-thumb video {
        max-width: 100%;
        max-height: 100%;
    }

    .mmxc-thumb audio {
        width: 100%;
    }

    .mmxc-badge {
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

    .mmxc-badge svg {
        width: 18px;
        height: 18px;
    }

    .mmxc-title {
        font-size: .9rem;
        color: var(--mmxc-text);
        margin-top: .55rem;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mmxc-uploader {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .6rem;
        background: var(--mmxc-bg);
        border: 1px solid var(--mmxc-border);
        padding: 1rem;
    }

    .mmxc-uploader-url {
        border-style: solid;
    }

    #mmxc-upload-input {
        flex: 1 1 220px;
    }

    #mmxc-upload-name,
    #mmxc-upload-alt {
        flex: 1 1 200px;
    }

    #mmxc-upload-url,
    #mmxc-url-name,
    #mmxc-url-alt {
        flex: 1 1 220px;
    }

    /* NEW: URL type radios */
    .mmxc-url-type-group {
        width: 100%;
        margin: .2rem 0 .4rem;
        border: 1px solid var(--mmxc-border);
        padding: .6rem .8rem;
    }

    .mmxc-url-type-group legend {
        font-size: .9rem;
        color: var(--mmxc-text);
        padding: 0 .25rem;
    }

    .mmxc-radio {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        margin-inline-end: 1rem;
        cursor: pointer;
    }

    .mmxc-radio input {
        accent-color: var(--mmxc-primary);
    }

    .mmxc-uploader-actions {
        display: flex;
        gap: .6rem;
    }

    .mmxc-btn {
        padding: .6rem 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        border: 1px solid var(--bs-secondary);
        background: var(--bs-secondary);
        color: var(--bs-white);
        border-radius: var(--bs-border-radius);
    }

    .mmxc-btn:hover {
        background: var(--bs-secondary-bg-subtle);
        border-color: var(--bs-secondary-border-subtle);
        color: var(--bs-body-color);
    }

    .mmxc-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .mmxc-btn-secondary {
        background: var(--bs-secondary);
        border-color: var(--bs-secondary);
        color: var(--bs-white);
    }

    .mmxc-btn-secondary:hover {
        background: var(--bs-secondary-bg-subtle);
        border-color: var(--bs-secondary-border-subtle);
        color: var(--bs-body-color);
    }

    .mmxc-btn-primary {
        background: var(--bs-primary);
        border-color: var(--bs-primary);
        color: var(--bs-white);
    }

    .mmxc-btn-primary:hover {
        background: var(--bs-primary-bg-subtle);
        border-color: var(--bs-primary-border-subtle);
        color: var(--bs-primary-text-emphasis);
    }

    .mmxc-footer {
        padding: 1rem 1.25rem;
        background: var(--mmxc-bg);
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        border-top: 1px solid var(--mmxc-border);
    }

    .mmxc-btn-select {
        background: var(--bs-gray-400);
        color: var(--bs-white);
        border-color: var(--bs-gray-400);
        transition: background .15s, color .15s, border-color .15s;
    }

    .mmxc-btn-select:hover {
        background: var(--bs-gray-500);
        border-color: var(--bs-gray-500);
        color: var(--bs-white);
    }

    .mmxc-btn-select:not(:disabled) {
        background: var(--bs-success);
        border-color: var(--bs-success);
    }

    .mmxc-btn-cancel {
        background: var(--bs-danger);
        border-color: var(--bs-danger);
        color: var(--bs-white);
    }

    .mmxc-btn-cancel:hover {
        background: var(--bs-danger-bg-subtle);
        border-color: var(--bs-danger-border-subtle);
        color: var(--bs-danger-text-emphasis);
    }

    .mmxc-loader {
        text-align: center;
        color: var(--mmxc-muted);
        padding: .75rem;
        font-size: .95rem;
    }

    .mmxc-sentinel {
        height: 1px;
    }
    .mmxc-pagination {
        display: flex;
        flex-wrap: wrap;
        gap: .35rem;
        justify-content: center;
        align-items: center;
        padding: .65rem 1rem;
        border-top: 1px solid var(--mmxc-border, #dbdfea);
        background: var(--mmxc-gray-100, #f3f4f8);
        flex-shrink: 0;
    }
    .mmxc-pagination button {
        min-width: 36px;
        height: 34px;
        padding: 0 .7rem;
        border: 1px solid var(--mmxc-border, #dbdfea) !important;
        background: var(--mmxc-bg, #fff);
        color: var(--mmxc-text, #526484);
        cursor: pointer;
        font-weight: 600;
        font-size: .9rem;
        border-radius: 6px !important;
        transition: background .15s, color .15s, border-color .15s, transform .05s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .mmxc-pagination button:hover:not(:disabled) {
        background: var(--mmxc-primary, #6576ff);
        border-color: var(--mmxc-primary, #6576ff) !important;
        color: #fff;
    }
    .mmxc-pagination button:active:not(:disabled) { transform: scale(.96); }
    .mmxc-pagination button.mmxc-page-active {
        background: var(--mmxc-primary, #6576ff);
        border-color: var(--mmxc-primary, #6576ff) !important;
        color: #fff;
        box-shadow: 0 2px 6px rgba(101, 118, 255, 0.35);
    }
    .mmxc-pagination button:disabled { opacity: .45; cursor: not-allowed; }
    .mmxc-pagination .mmxc-page-ellipsis { padding: 0 .25rem; color: var(--mmxc-muted, #8091a7); font-weight: 700; }
    .mmxc-pagination .mmxc-page-info {
        margin-inline-start: auto;
        font-size: .85rem;
        color: var(--mmxc-muted, #8091a7);
        font-weight: 500;
    }
    @media (max-width: 600px) {
        .mmxc-pagination .mmxc-page-info { width: 100%; text-align: center; margin: .25rem 0 0; }
    }


    @media (max-width: 768px) {
        #mmxcMediaModal .mmxc-container,
        .mmxc-modal.mmxc-modal .mmxc-container {
            top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important;
            transform: none !important;
            width: 100vw !important; max-width: 100vw !important;
            height: 100vh !important; max-height: 100vh !important;
            border-radius: 0 !important; position: fixed !important;
        }
        .mmxc-tabs { flex-wrap: wrap; }
        .mmxc-filters { flex-direction: column; padding: .75rem !important; }
        .mmxc-filters input,
        .mmxc-filters select,
        .mmxc-uploader {
            width: 100% !important; flex: 0 0 auto !important;
            height: auto !important; min-height: 0 !important;
        }
        .mmxc-uploader { flex-direction: column; align-items: stretch; }
        .mmxc-uploader-actions { width: 100%; }
        .mmxc-uploader-actions .mmxc-btn { width: 100%; }
    }

/* === MMX-UI-ENHANCE-V2 === */
.mmxc-modal.mmxc-modal ,
.mmxc-modal.mmxc-modal  * { border-radius: 0 !important; }
.mmxc-modal.mmxc-modal .mmxc-container {
    max-height: 90vh !important;
    height: auto !important;
    width: clamp(320px, 94vw, 1080px) !important;
    border-radius: 0 !important;
    box-shadow: 0 12px 32px rgba(15,23,42,.12) !important;
    overflow: hidden !important;
    display: flex !important;
    flex-direction: column !important;
    border: 1px solid rgba(15,23,42,.06);
    background: var(--mmxc-bg, #fff) !important;
}
.mmxc-modal.mmxc-modal .mmxc-header {
    padding: 1rem 1.25rem !important;
    background: var(--mmxc-bg, #fff) !important;
    border-bottom: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0;
}
.mmxc-modal.mmxc-modal .mmxc-header h5 { font-size: 1rem !important; font-weight: 600 !important; letter-spacing: -0.01em; }
.mmxc-modal.mmxc-modal .mmxc-close {
    width: 30px; height: 30px;
    border-radius: 0 !important;
    display: inline-flex; align-items: center; justify-content: center;
    color: var(--mmxc-muted, #94a3b8) !important;
    transition: background .12s, color .12s;
    background: transparent !important;
}
.mmxc-modal.mmxc-modal .mmxc-close:hover { background: rgba(15,23,42,.05) !important; color: var(--mmxc-text, #1e293b) !important; }

.mmxc-modal.mmxc-modal .mmxc-tabs {
    padding: .5rem .85rem !important;
    gap: .25rem !important;
    background: var(--mmxc-bg, #fff) !important;
    border-bottom: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0;
    overflow-x: auto;
}
.mmxc-modal.mmxc-modal .mmxc-tab-btn {
    border-radius: 0 !important;
    padding: .5rem .9rem !important;
    border: 1px solid transparent !important;
    background: transparent !important;
    color: var(--mmxc-muted, #64748b) !important;
    font-weight: 500 !important;
    font-size: .88rem !important;
    transition: background .12s, color .12s;
    white-space: nowrap;
    box-shadow: none !important;
}
.mmxc-modal.mmxc-modal .mmxc-tab-btn:hover:not(.mmxc-is-active) {
    background: rgba(15,23,42,.04) !important;
    color: var(--mmxc-text, #1e293b) !important;
}
.mmxc-modal.mmxc-modal .mmxc-tab-btn.mmxc-is-active {
    background: rgba(101,118,255,.10) !important;
    color: var(--mmxc-primary, #6576ff) !important;
    border-color: transparent !important;
    box-shadow: none !important;
}

.mmxc-modal.mmxc-modal .mmxc-tab-panel { display: flex !important; flex-direction: column; flex: 1 1 auto; min-height: 0; overflow: hidden; }
.mmxc-modal.mmxc-modal .mmxc-tab-panel[hidden] { display: none !important; }

.mmxc-modal.mmxc-modal .mmxc-filters {
    padding: .9rem 1.25rem !important;
    background: var(--mmxc-bg, #fff) !important;
    border-bottom: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0;
    gap: .5rem !important;
}

.mmxc-modal.mmxc-modal .mmxc-body {
    flex: 1 1 auto !important;
    min-height: 200px !important;
    overflow: auto !important;
    padding: 1.25rem !important;
    background: var(--mmxc-bg, #fff) !important;
    scrollbar-width: thin;
}
.mmxc-modal.mmxc-modal .mmxc-body::-webkit-scrollbar { width: 6px; }
.mmxc-modal.mmxc-modal .mmxc-body::-webkit-scrollbar-thumb { background: rgba(15,23,42,.15); border-radius: 0; }
.mmxc-modal.mmxc-modal .mmxc-body::-webkit-scrollbar-thumb:hover { background: rgba(15,23,42,.25); }

.mmxc-modal.mmxc-modal .mmxc-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)) !important;
    gap: .75rem !important;
}

.mmxc-modal.mmxc-modal .mmxc-empty {
    grid-column: 1 / -1;
    text-align: center;
    color: var(--mmxc-muted, #94a3b8);
    font-size: .92rem;
    padding: 3rem 1rem !important;
    background: transparent;
    border: 0;
    margin: 0 !important;
}

.mmxc-modal.mmxc-modal .mmxc-item {
    background: var(--mmxc-bg, #fff) !important;
    border: 1px solid rgba(15,23,42,.08) !important;
    border-radius: 0 !important;
    overflow: hidden;
    padding: 0 !important;
    transition: border-color .12s, box-shadow .12s !important;
    display: flex !important;
    flex-direction: column;
    cursor: pointer;
    position: relative;
}
.mmxc-modal.mmxc-modal .mmxc-item:hover {
    border-color: rgba(101,118,255,.4) !important;
    box-shadow: 0 2px 8px rgba(15,23,42,.06) !important;
}
.mmxc-modal.mmxc-modal .mmxc-item.mmxc-is-selected {
    border-color: var(--mmxc-primary, #6576ff) !important;
    box-shadow: 0 0 0 2px rgba(101,118,255,.25) !important;
}
.mmxc-modal.mmxc-modal .mmxc-item.mmxc-is-selected::before {
    content: '✓';
    position: absolute;
    top: 8px;
    inset-inline-end: 8px;
    width: 22px; height: 22px;
    background: var(--mmxc-primary, #6576ff);
    color: #fff;
    border-radius: 50% !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .75rem;
    font-weight: 700;
    z-index: 2;
}

.mmxc-modal.mmxc-modal .mmxc-thumb {
    height: 120px !important;
    width: 100% !important;
    border: 0 !important;
    background: rgba(15,23,42,.03) !important;
    border-radius: 0 !important;
}
.mmxc-modal.mmxc-modal .mmxc-thumb img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    max-width: none !important;
    max-height: none !important;
}

.mmxc-modal.mmxc-modal .mmxc-title {
    margin: 0 !important;
    padding: .5rem .65rem !important;
    font-size: .82rem !important;
    font-weight: 500 !important;
    color: var(--mmxc-text, #334155) !important;
    background: var(--mmxc-bg, #fff);
    border-top: 1px solid rgba(15,23,42,.05);
}

.mmxc-modal.mmxc-modal .mmxc-badge {
    border-radius: 0 !important;
    background: rgba(15,23,42,.65) !important;
    backdrop-filter: blur(4px);
    border: 0 !important;
    width: 24px !important;
    height: 24px !important;
    top: 6px;
    inset-inline-start: 6px;
}

.mmxc-modal.mmxc-modal .mmxc-loader {
    text-align: center;
    color: var(--mmxc-muted, #94a3b8);
    padding: 1rem !important;
    font-size: .88rem;
}
.mmxc-modal.mmxc-modal .mmxc-loader::before {
    content: '';
    display: inline-block;
    width: 12px; height: 12px;
    margin-inline-end: .5rem;
    border: 2px solid rgba(15,23,42,.1);
    border-top-color: var(--mmxc-primary, #6576ff);
    border-radius: 50% !important;
    animation: mmxc-spin .7s linear infinite;
    vertical-align: -1px;
}
@keyframes mmxc-spin { to { transform: rotate(360deg); } }

.mmxc-modal.mmxc-modal .mmxc-pagination {
    display: flex !important;
    flex-wrap: wrap;
    gap: .25rem !important;
    align-items: center;
    padding: .6rem 1.25rem !important;
    background: var(--mmxc-bg, #fff) !important;
    border-top: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0 !important;
}
.mmxc-modal.mmxc-modal .mmxc-pagination button {
    min-width: 32px !important;
    height: 32px !important;
    padding: 0 .55rem !important;
    border: 1px solid transparent !important;
    background: transparent !important;
    color: var(--mmxc-text, #475569) !important;
    border-radius: 0 !important;
    font-weight: 500 !important;
    font-size: .85rem !important;
    cursor: pointer;
    transition: background .12s, color .12s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: none !important;
}
.mmxc-modal.mmxc-modal .mmxc-pagination button:hover:not(:disabled) {
    background: rgba(15,23,42,.05) !important;
    color: var(--mmxc-text, #1e293b) !important;
    border-color: transparent !important;
}
.mmxc-modal.mmxc-modal .mmxc-pagination button.mmxc-page-active {
    background: var(--mmxc-primary, #6576ff) !important;
    border-color: var(--mmxc-primary, #6576ff) !important;
    color: #fff !important;
    box-shadow: none !important;
}
.mmxc-modal.mmxc-modal .mmxc-pagination button:disabled { opacity: .35; cursor: not-allowed; }
.mmxc-modal.mmxc-modal .mmxc-pagination .mmxc-page-ellipsis { padding: 0 .25rem; color: var(--mmxc-muted, #94a3b8); }
.mmxc-modal.mmxc-modal .mmxc-pagination .mmxc-page-info {
    margin-inline-start: auto;
    font-size: .8rem;
    color: var(--mmxc-muted, #94a3b8);
    font-weight: 400;
}

.mmxc-modal.mmxc-modal .mmxc-footer {
    padding: .85rem 1.25rem !important;
    background: var(--mmxc-bg, #fff) !important;
    border-top: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0 !important;
    display: flex;
    gap: .5rem;
    justify-content: flex-end;
}
.mmxc-modal.mmxc-modal .mmxc-btn {
    border-radius: 0 !important;
    padding: .55rem 1.1rem !important;
    font-weight: 500 !important;
    font-size: .9rem !important;
    transition: background .12s, color .12s, border-color .12s;
    border: 1px solid transparent !important;
    box-shadow: none !important;
}
.mmxc-modal.mmxc-modal .mmxc-btn-primary { background: var(--mmxc-primary, #6576ff) !important; color: #fff !important; border-color: var(--mmxc-primary, #6576ff) !important; }
.mmxc-modal.mmxc-modal .mmxc-btn-primary:hover:not(:disabled) { background: #5566ee !important; border-color: #5566ee !important; }
.mmxc-modal.mmxc-modal .mmxc-btn-secondary { background: rgba(15,23,42,.05) !important; color: var(--mmxc-text, #1e293b) !important; }
.mmxc-modal.mmxc-modal .mmxc-btn-secondary:hover:not(:disabled) { background: rgba(15,23,42,.09) !important; }
.mmxc-modal.mmxc-modal .mmxc-btn-cancel { background: transparent !important; color: var(--mmxc-muted, #64748b) !important; border-color: rgba(15,23,42,.12) !important; }
.mmxc-modal.mmxc-modal .mmxc-btn-cancel:hover { background: rgba(15,23,42,.04) !important; color: var(--mmxc-text, #1e293b) !important; }
.mmxc-modal.mmxc-modal .mmxc-btn-select:not(:disabled) { background: var(--mmxc-primary, #6576ff) !important; color: #fff !important; border-color: var(--mmxc-primary, #6576ff) !important; }
.mmxc-modal.mmxc-modal .mmxc-btn-select:not(:disabled):hover { background: #5566ee !important; border-color: #5566ee !important; }
.mmxc-modal.mmxc-modal .mmxc-btn-select:disabled { background: rgba(15,23,42,.05) !important; color: var(--mmxc-muted, #94a3b8) !important; }

.mmxc-modal.mmxc-modal .mmxc-tab-body {
    padding: 1.25rem !important;
    background: var(--mmxc-bg, #fff) !important;
    overflow: auto;
    flex: 1 1 auto;
    min-height: 0;
}

.mmxc-modal.mmxc-modal  input[type="text"],
.mmxc-modal.mmxc-modal  input[type="search"],
.mmxc-modal.mmxc-modal  input[type="url"],
.mmxc-modal.mmxc-modal  input[type="email"],
.mmxc-modal.mmxc-modal  input[type="number"],
.mmxc-modal.mmxc-modal  input[type="file"],
.mmxc-modal.mmxc-modal  textarea,
.mmxc-modal.mmxc-modal  select {
    border-radius: 0 !important;
    border: 1px solid rgba(15,23,42,.10) !important;
    padding: .55rem .8rem !important;
    background: var(--mmxc-bg, #fff) !important;
    color: var(--mmxc-text, #1e293b) !important;
    font-size: .9rem !important;
    transition: border-color .12s, box-shadow .12s !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
    font-family: inherit !important;
    font-weight: 400 !important;
}
.mmxc-modal.mmxc-modal  input:focus,
.mmxc-modal.mmxc-modal  textarea:focus,
.mmxc-modal.mmxc-modal  select:focus {
    border-color: var(--mmxc-primary, #6576ff) !important;
    box-shadow: 0 0 0 3px rgba(101,118,255,.12) !important;
    outline: none !important;
}
.mmxc-modal.mmxc-modal  input::placeholder,
.mmxc-modal.mmxc-modal  textarea::placeholder {
    color: var(--mmxc-muted, #94a3b8) !important;
    opacity: 1;
    font-weight: 400;
}
.mmxc-modal.mmxc-modal  input[type="file"] { padding: .4rem .55rem !important; cursor: pointer; }
.mmxc-modal.mmxc-modal  label {
    color: var(--mmxc-text, #334155) !important;
    font-size: .85rem !important;
    font-weight: 500 !important;
    display: inline-block;
    margin-bottom: .25rem;
}
.mmxc-modal.mmxc-modal  fieldset {
    border-radius: 0 !important;
    border: 1px solid rgba(15,23,42,.08) !important;
    padding: .7rem 1rem !important;
    background: transparent !important;
}
.mmxc-modal.mmxc-modal  fieldset legend {
    font-size: .78rem !important;
    color: var(--mmxc-muted, #94a3b8) !important;
    font-weight: 500 !important;
    padding: 0 .4rem !important;
}
.mmxc-modal.mmxc-modal  .mmxc-radio {
    background: transparent;
    border: 1px solid rgba(15,23,42,.10);
    border-radius: 0;
    padding: .3rem .65rem !important;
    transition: border-color .12s;
    font-size: .85rem !important;
}
.mmxc-modal.mmxc-modal  .mmxc-radio:hover { border-color: rgba(101,118,255,.4); }
.mmxc-modal.mmxc-modal  .mmxc-radio input[type="radio"] { accent-color: var(--mmxc-primary, #6576ff); margin-inline-end: .25rem; }
.mmxc-modal.mmxc-modal  .mmxc-uploader,
.mmxc-modal.mmxc-modal  .mmxc-uploader-url {
    border-radius: 0 !important;
    border: 1px solid rgba(15,23,42,.08) !important;
    background: var(--mmxc-bg, #fff) !important;
    padding: 1rem !important;
    gap: .6rem !important;
    box-shadow: none !important;
}
.mmxc-modal.mmxc-modal  [id$="-upload-label"] {
    border-radius: 0 !important;
    border: 1px dashed rgba(15,23,42,.18) !important;
    background: rgba(15,23,42,.02) !important;
    padding: 1rem !important;
    transition: border-color .12s, background .12s;
    color: var(--mmxc-muted, #64748b) !important;
}
.mmxc-modal.mmxc-modal  [id$="-upload-label"]:hover {
    border-color: var(--mmxc-primary, #6576ff) !important;
    background: rgba(101,118,255,.04) !important;
    color: var(--mmxc-text, #1e293b) !important;
}

/* File-selected state: green/success accent */
.mmxc-modal.mmxc-modal  [id$="-upload-label"][data-file-selected="true"] {
    border: 1px solid #16a34a !important;
    background: rgba(22,163,74,.06) !important;
    color: #15803d !important;
    text-align: start !important;
    padding: .85rem 1rem !important;
    display: flex !important;
    align-items: center !important;
    gap: .75rem !important;
}
.mmxc-modal.mmxc-modal  [id$="-upload-label"][data-file-selected="true"] i,
.mmxc-modal.mmxc-modal  [id$="-upload-label"][data-file-selected="true"] em { display: none !important; }
.mmxc-modal.mmxc-modal  [id$="-upload-label"][data-file-selected="true"]::before {
    content: '✓';
    flex-shrink: 0;
    width: 24px; height: 24px;
    background: #16a34a;
    color: #fff;
    border-radius: 50% !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
    font-weight: 700;
}
.mmxc-modal.mmxc-modal  [id$="-upload-label"][data-file-selected="true"] span,
.mmxc-modal.mmxc-modal  [id$="-upload-label"][data-file-selected="true"] [id$="-upload-label-text"] {
    flex: 1 1 auto;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight: 500;
    color: #15803d !important;
}
.mmxc-modal.mmxc-modal  [id$="-upload-label"][data-file-selected="true"]::after {
    content: 'تغيير';
    flex-shrink: 0;
    font-size: .78rem;
    padding: .25rem .55rem;
    border-radius: 6px;
    background: rgba(22,163,74,.12);
    color: #15803d;
    font-weight: 500;
}

/* === Field layout: clean two-column grid === */
.mmxc-modal.mmxc-modal  .mmxc-upload-fields {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: .85rem !important;
    width: 100% !important;
}
.mmxc-modal.mmxc-modal  .mmxc-upload-fields > * {
    flex: unset !important;
    width: 100% !important;
    min-width: 0 !important;
    margin: 0 !important;
}
/* file picker spans full width — it's the prominent field */
.mmxc-modal.mmxc-modal  .mmxc-upload-fields > *:has(> [id$="-upload-label"]),
.mmxc-modal.mmxc-modal  .mmxc-upload-fields > *:has([id$="-upload-input"]) {
    grid-column: 1 / -1 !important;
}

/* Import-by-URL row layout: URL on its own row, name+alt side-by-side */
.mmxc-modal.mmxc-modal  .mmxc-uploader-url > div:first-of-type {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: .75rem !important;
    margin-bottom: .85rem !important;
}
.mmxc-modal.mmxc-modal  .mmxc-uploader-url > div:first-of-type > *:first-child {
    grid-column: 1 / -1 !important;
}
.mmxc-modal.mmxc-modal  .mmxc-uploader-url > div:first-of-type > * { flex: unset !important; width: 100% !important; min-width: 0 !important; }

/* Radio group: even spacing */
.mmxc-modal.mmxc-modal  .mmxc-url-type-group > div {
    display: flex !important;
    flex-wrap: wrap;
    gap: .5rem !important;
}

/* Action button rows */
.mmxc-modal.mmxc-modal  .mmxc-uploader-actions {
    display: flex !important;
    gap: .5rem !important;
    justify-content: flex-end !important;
    margin-top: .25rem !important;
    width: 100% !important;
    padding-top: .75rem;
    border-top: 1px solid rgba(15,23,42,.06);
}

/* Tab body single column constraint for narrow modals */
@media (max-width: 640px) {
    .mmxc-modal.mmxc-modal  .mmxc-upload-fields,
    .mmxc-modal.mmxc-modal  .mmxc-uploader-url > div:first-of-type {
        grid-template-columns: 1fr !important;
    }
    .mmxc-modal.mmxc-modal  .mmxc-uploader-actions { flex-direction: column; }
    .mmxc-modal.mmxc-modal  .mmxc-uploader-actions .mmxc-btn { width: 100%; }
}

@media (max-width: 600px) {
    .mmxc-modal.mmxc-modal .mmxc-pagination .mmxc-page-info { width: 100%; text-align: center; margin-top: .25rem; }
    .mmxc-modal.mmxc-modal .mmxc-grid { grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)) !important; }
    .mmxc-modal.mmxc-modal .mmxc-thumb { height: 110px !important; }
}
/* === END MMX-UI-ENHANCE-V2 === */
</style>
<script>
(function() {
    if (window.__mxxFileSelectedHook) return;
    window.__mxxFileSelectedHook = true;
    document.addEventListener('change', function(e) {
        const input = e.target;
        if (!input || input.type !== 'file' || !input.id || !input.id.endsWith('-upload-input')) return;
        const labelId = input.id.replace('-upload-input', '-upload-label');
        const label = document.getElementById(labelId);
        if (!label) return;
        const file = input.files && input.files[0];
        if (file) {
            label.setAttribute('data-file-selected', 'true');
            const txtId = labelId + '-text';
            const txtEl = document.getElementById(txtId) || label.querySelector('span');
            if (txtEl) txtEl.textContent = file.name;
            else {
                const span = document.createElement('span');
                span.textContent = file.name;
                label.appendChild(span);
            }
        } else {
            label.removeAttribute('data-file-selected');
        }
    }, true);
})();
</script>
<style>
</style>
<script>
(function() {
    if (window.__mxxFileSelectedHook) return;
    window.__mxxFileSelectedHook = true;
    document.addEventListener('change', function(e) {
        const input = e.target;
        if (!input || input.type !== 'file' || !input.id || !input.id.endsWith('-upload-input')) return;
        const labelId = input.id.replace('-upload-input', '-upload-label');
        const label = document.getElementById(labelId);
        if (!label) return;
        const file = input.files && input.files[0];
        if (file) {
            label.setAttribute('data-file-selected', 'true');
            const txtId = labelId + '-text';
            const txtEl = document.getElementById(txtId) || label.querySelector('span');
            if (txtEl) txtEl.textContent = file.name;
            else {
                const span = document.createElement('span');
                span.textContent = file.name;
                label.appendChild(span);
            }
        } else {
            label.removeAttribute('data-file-selected');
        }
    }, true);
})();
</script>
<style>
</style>
<script>
(function() {
    if (window.__mxxFileSelectedHook) return;
    window.__mxxFileSelectedHook = true;
    document.addEventListener('change', function(e) {
        const input = e.target;
        if (!input || input.type !== 'file' || !input.id || !input.id.endsWith('-upload-input')) return;
        const labelId = input.id.replace('-upload-input', '-upload-label');
        const label = document.getElementById(labelId);
        if (!label) return;
        const file = input.files && input.files[0];
        if (file) {
            label.setAttribute('data-file-selected', 'true');
            const txtId = labelId + '-text';
            const txtEl = document.getElementById(txtId) || label.querySelector('span');
            if (txtEl) txtEl.textContent = file.name;
            else {
                const span = document.createElement('span');
                span.textContent = file.name;
                label.appendChild(span);
            }
        } else {
            label.removeAttribute('data-file-selected');
        }
    }, true);
})();
</script>
<style>
</style>

<!-- ====================== Scripts ====================== -->
<script>
    (() => {
        // ===== Endpoints =====
        const FETCH_URL = "{{ route('dashboard.media.getAllMediaPaginated') }}";
        const UPLOAD_URL = "{{ route('dashboard.media.store') }}";
        const IMPORT_URL = "{{ route('dashboard.media_url.store') }}"; // عرّفه عند وجود خدمة الاستيراد عبر الرابط

        const modal = document.getElementById("mmxcMediaModal");
        const backdrop = modal.querySelector("[data-mmxc-backdrop]");
        const closes = modal.querySelectorAll("[data-mmxc-close]");
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        // Gallery
        const listEl = document.getElementById("mmxc-list");
        const loaderEl = document.getElementById("mmxc-loader");
        const paginationEl = document.getElementById("mmxc-pagination");
        const searchInput = document.getElementById("mmxc-search");
        const typeSelect = document.getElementById("mmxc-type-filter");
        const btnSelect = document.getElementById("mmxc-btn-select");

        // Upload
        const uploadInput = document.getElementById("mmxc-upload-input");
        const uploadName = document.getElementById("mmxc-upload-name");
        const uploadAlt = document.getElementById("mmxc-upload-alt");
        const btnUploadToGallery = document.getElementById("mmxc-btn-upload-to-gallery");
        const btnUploadSelectAndClose = document.getElementById("mmxc-btn-upload-and-select-close");

        // Import URL
        const uploadUrlInput = document.getElementById("mmxc-upload-url");
        const urlNameInput = document.getElementById("mmxc-url-name");
        const urlAltInput = document.getElementById("mmxc-url-alt");
        const btnImportToGallery = document.getElementById("mmxc-btn-import-to-gallery");
        const btnImportSelectAndClose = document.getElementById("mmxc-btn-import-and-select-close");
        const urlTypeRadios = modal.querySelectorAll("input[name='mmxc-url-type']");

        // Tabs
        const tabButtons = Array.from(modal.querySelectorAll('.mmxc-tab-btn'));
        const tabPanels = {
            gallery: document.getElementById('mmxc-tab-gallery'),
            upload: document.getElementById('mmxc-tab-upload'),
            import: document.getElementById('mmxc-tab-import'),
        };

        const state = {
            isOpen: false,
            page: 1,
            lastPage: 1,
            total: 0,
            isLoading: false,
            search: "",
            type: "all",
            list: [],
            selected: null,
            currentField: "",
            activeTab: 'gallery'
        };

        // ===== Helpers =====
        const YT_REGEX =
            /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/i;
        const isYouTubeUrl = (url = "") => YT_REGEX.test(url);
        const getYouTubeId = (url = "") => (url.match(YT_REGEX)?.[1] ?? null);
        const extFromPath = (p = "") => (p.split("?")[0].split(".").pop() || "").toLowerCase();

        function getMediaKind(media) {
            if (media.path && isYouTubeUrl(media.path)) return "video";
            const mt = (media.media_type || "").toLowerCase();
            if (["image", "video", "audio", "voice", "file"].includes(mt)) return (mt === "audio" ? "voice" : mt);
            const ext = extFromPath(media.path || media.url || "");
            if (["jpg", "jpeg", "png", "gif", "webp", "bmp", "svg"].includes(ext)) return "image";
            if (["mp4", "webm", "mkv", "mov", "avi", "m4v"].includes(ext)) return "video";
            if (["mp3", "wav", "ogg", "m4a", "aac", "flac"].includes(ext)) return "voice";
            return "file";
        }
        const mapFilterForServer = (t) => (t === "voice" ? "audio" : t);

        function getBadgeIconId(media) {
            if (media.path && isYouTubeUrl(media.path)) return "mmxc-icon-youtube";
            const kind = getMediaKind(media);
            if (kind === "image") return "mmxc-icon-image";
            if (kind === "video") return "mmxc-icon-video";
            if (kind === "voice") return "mmxc-icon-voice";
            return "mmxc-icon-file";
        }

        function getSelectedUrlType() {
            const checked = Array.from(urlTypeRadios).find(r => r.checked);
            return checked ? checked.value : "auto";
        }

        // ===== Public API =====
        window.mmxcMediaModalManager = {
            openModal(fieldName) {
                openModal(fieldName);
            },
            closeModal() {
                closeModal();
            },
            onMediaSelected(payload) {
                if (window.mediaTabManager && typeof window.mediaTabManager.onMediaSelected === "function") {
                    window.mediaTabManager.onMediaSelected(payload);
                }
            }
        };

        // ===== Reset UI/state =====
        function clearAllInputs() {
            searchInput && (searchInput.value = "");
            typeSelect && (typeSelect.value = "all");
            uploadInput && (uploadInput.value = "");
            uploadName && (uploadName.value = "");
            uploadAlt && (uploadAlt.value = "");
            uploadUrlInput && (uploadUrlInput.value = "");
            urlNameInput && (urlNameInput.value = "");
            urlAltInput && (urlAltInput.value = "");
            // reset radios to Auto
            urlTypeRadios.forEach(r => {
                r.checked = (r.value === "auto");
            });
        }

        function resetStateFilters() {
            state.search = "";
            state.type = "all";
            state.selected = null;
        }

        // ===== Open/close =====
        function openModal(fieldName = "") {
            state.currentField = fieldName;
            state.isOpen = true;
            modal.setAttribute("aria-hidden", "false");
            document.documentElement.style.overflow = "hidden";
            resetStateFilters();
            clearAllInputs();
            switchTab('gallery');
            resetAndLoad();
            setTimeout(() => document.getElementById("mmxc-search")?.focus(), 0);
        }

        function closeModal() {
            state.isOpen = false;
            modal.setAttribute("aria-hidden", "true");
            document.documentElement.style.overflow = "";
            resetStateFilters();
            clearAllInputs();
        }

        backdrop.addEventListener("click", closeModal);
        closes.forEach(b => b.addEventListener("click", closeModal));
        modal.querySelector(".mmxc-container").addEventListener("click", e => e.stopPropagation());
        document.addEventListener("keydown", e => {
            if (!state.isOpen) return;
            if (e.key === "Escape") closeModal();
            if (e.key === "ArrowRight" || e.key === "ArrowLeft") {
                const idx = tabButtons.findIndex(b => b.getAttribute('aria-selected') === "true");
                if (idx > -1) {
                    const dir = e.key === "ArrowRight" ? 1 : -1;
                    const next = (idx + dir + tabButtons.length) % tabButtons.length;
                    tabButtons[next].click();
                    tabButtons[next].focus();
                }
            }
        });

        // ===== Tabs =====
        tabButtons.forEach(btn => btn.addEventListener('click', () => switchTab(btn.dataset.mmxcTab)));

        function switchTab(tab) {
            if (!tabPanels[tab]) return;
            state.activeTab = tab;
            tabButtons.forEach(b => {
                const active = b.dataset.mmxcTab === tab;
                b.classList.toggle('mmxc-is-active', active);
                b.setAttribute('aria-selected', String(active));
                b.tabIndex = active ? 0 : -1;
            });
            Object.entries(tabPanels).forEach(([name, panel]) => {
                panel.hidden = (name !== tab);
            });
        }

                // ===== Fetch/pagination =====
        async function resetAndLoad() {
            state.page = 1;
            await loadPage(1);
        }

        async function loadPage(pageNum) {
            if (state.isLoading) return;
            state.isLoading = true;
            loaderEl.hidden = false;
            try {
                const url = new URL(FETCH_URL, window.location.origin);
                url.searchParams.set("page", pageNum);
                url.searchParams.set("search", state.search.trim());
                url.searchParams.set("type", mapFilterForServer(state.type));
                const res = await fetch(url.toString(), { headers: { Accept: "application/json" } });
                const data = await res.json();
                state.list = Array.isArray(data.data) ? data.data : [];
                state.page = data.current_page || pageNum;
                state.lastPage = data.last_page || 1;
                state.total = data.total || 0;
            } catch (err) {
                console.error(err);
                state.list = [];
            } finally {
                state.isLoading = false;
                loaderEl.hidden = true;
                renderList();
                renderPagination();
            }
        }

        function renderPagination() {
            if (!paginationEl) return;
            paginationEl.innerHTML = "";
            if (state.lastPage <= 1) return;
            const cur = state.page, last = state.lastPage;
            const mkBtn = (label, page, opts = {}) => {
                const b = document.createElement("button");
                b.type = "button";
                b.textContent = label;
                if (opts.active) b.classList.add("mmxc-page-active");
                if (opts.disabled) b.disabled = true;
                else b.addEventListener("click", () => loadPage(page));
                return b;
            };
            paginationEl.appendChild(mkBtn("«", cur - 1, { disabled: cur <= 1 }));
            const pages = new Set([1, last, cur, cur - 1, cur + 1]);
            const sorted = [...pages].filter(x => x >= 1 && x <= last).sort((a, b) => a - b);
            let prev = 0;
            for (const pg of sorted) {
                if (pg - prev > 1) {
                    const span = document.createElement("span");
                    span.className = "mmxc-page-ellipsis";
                    span.textContent = "…";
                    paginationEl.appendChild(span);
                }
                paginationEl.appendChild(mkBtn(String(pg), pg, { active: pg === cur }));
                prev = pg;
            }
            paginationEl.appendChild(mkBtn("»", cur + 1, { disabled: cur >= last }));
            const info = document.createElement("span");
            info.className = "mmxc-page-info";
            info.textContent = `صفحة ${cur} من ${last} — ${state.total} عنصر`;
            paginationEl.appendChild(info);
        }
        // ===== Render =====
        function renderList() {
            listEl.innerHTML = "";
            const filtered = state.type === "all" ? state.list : state.list.filter(m => getMediaKind(m) === state
                .type);
            if (!filtered.length) {
                listEl.innerHTML = `<div class="mmxc-empty">لا توجد وسائط للعرض</div>`;
                return;
            }
            filtered.forEach(media => {
                const kind = getMediaKind(media);
                const item = document.createElement("div");
                item.className = "mmxc-item";
                if (state.selected && state.selected.id === media.id) item.classList.add("mmxc-is-selected");
                item.addEventListener("click", () => toggleSelect(media));

                const thumb = document.createElement("div");
                thumb.className = "mmxc-thumb";

                const badge = document.createElement("div");
                badge.className = "mmxc-badge";
                badge.title = kind === "voice" ? "audio" : (isYouTubeUrl(media.path) ? "youtube" : kind);
                const iconId = getBadgeIconId(media);
                badge.innerHTML = `<svg aria-hidden="true"><use href="#${iconId}"></use></svg>`;
                thumb.appendChild(badge);

                if (media.path && isYouTubeUrl(media.path)) {
                    const vid = getYouTubeId(media.path);
                    const img = document.createElement("img");
                    img.src = `https://img.youtube.com/vi/${vid}/hqdefault.jpg`;
                    img.alt = media.name || "YouTube";
                    img.loading = "lazy";
                    thumb.appendChild(img);
                } else if (kind === "image") {
                    const img = document.createElement("img");
                    img.src = media.path;
                    img.alt = media.alt || media.name || "";
                    img.loading = "lazy";
                    thumb.appendChild(img);
                } else if (kind === "video") {
                    if (/\.(mp4|webm|mkv|mov|avi|m4v)(\?|$)/i.test(media.path || "")) {
                        const video = document.createElement("video");
                        video.src = media.path;
                        video.muted = true;
                        video.preload = "metadata";
                        thumb.appendChild(video);
                    }
                } else if (kind === "voice") {
                    const audio = document.createElement("audio");
                    audio.src = media.path;
                    audio.preload = "metadata";
                    audio.controls = true;
                    thumb.appendChild(audio);
                }

                item.appendChild(thumb);

                const title = document.createElement("div");
                title.className = "mmxc-title";
                title.textContent = media.name || "";
                item.appendChild(title);

                listEl.appendChild(item);
            });
        }

        function toggleSelect(media) {
            const isSame = state.selected && state.selected.id === media.id;
            state.selected = isSame ? null : media;
            renderList();
        }

        // ===== Search/filter =====
        searchInput?.addEventListener("input", async e => {
            state.search = e.target.value;
            await resetAndLoad();
        });
        typeSelect?.addEventListener("change", async e => {
            state.type = e.target.value;
            await resetAndLoad();
        });

        // ===== Confirm selection =====
        btnSelect?.addEventListener("click", () => {
            if (!state.selected) {
                alert("يرجى اختيار وسيط واحد على الأقل.");
                return;
            }
            window.mmxcMediaModalManager.onMediaSelected({
                id: state.selected.id,
                url: state.selected.path,
                title: state.selected.name || "",
                alt: state.selected.alt || ""
            });
            closeModal();
        });

        // ===== Parsing & matching helpers =====
        function tryParseJsonFromText(text) {
            if (!text) return null;
            const clean = text.replace(/^\uFEFF/, "").trim();
            try {
                return JSON.parse(clean);
            } catch {
                const m = clean.match(/\{[\s\S]*\}/);
                if (m) {
                    try {
                        return JSON.parse(m[0]);
                    } catch {}
                }
                return {
                    __nonJson: true,
                    __raw: clean
                };
            }
        }

        function extractCreatedFromPayload(payload) {
            if (!payload || typeof payload !== "object") return [];
            if (Array.isArray(payload.data)) return payload.data;
            if (Array.isArray(payload.media)) return payload.media;
            if (payload.data) return [payload.data];
            if (payload.media) return [payload.media];
            return [];
        }

        function basenameNoExt(filename = "") {
            const base = filename.split("/").pop() || filename;
            return base.replace(/\.[^.]+$/, "").trim();
        }

        function findJustUploadedInState({
            fileName,
            nameVal
        }) {
            const base = basenameNoExt(fileName || "");
            if (nameVal) {
                const byName = state.list.find(m => (m.name || "").trim() === nameVal.trim());
                if (byName) return byName;
            }
            if (base) {
                const byBase = state.list.find(m => (m.name || "").trim() === base || (m.title || "").trim() ===
                    base);
                if (byBase) return byBase;
            }
            return state.list[0] || null;
        }

        // ===== Upload (open gallery / select-close) =====
        async function uploadMediaAndHandle(mode) {
            const files = uploadInput.files;
            if (!files || !files.length) {
                alert("⚠️ لم يتم اختيار أي ملف للرفع.");
                return;
            }
            let file0 = files[0];
            const nameVal = (uploadName.value || "").trim();
            const altVal = (uploadAlt.value || "").trim();

            if (window.compressImage && /^image\//i.test(file0.type)) {
                try {
                    btnUploadToGallery.textContent = "جارٍ ضغط الصورة...";
                    btnUploadSelectAndClose.textContent = "جارٍ ضغط الصورة...";
                    file0 = await window.compressImage(file0);
                } catch (_) {}
            }

            const form = new FormData();
            form.append("media", file0);
            if (nameVal) form.append("name", nameVal);
            if (altVal) form.append("alt", altVal);

            let created = null;
            try {
                btnUploadToGallery.disabled = true;
                btnUploadSelectAndClose.disabled = true;
                btnUploadToGallery.textContent = "جارٍ الرفع... 0%";
                btnUploadSelectAndClose.textContent = "جارٍ الرفع... 0%";

                const res = window.uploadWithProgress
                    ? await window.uploadWithProgress(UPLOAD_URL, form, {
                        headers: { "X-CSRF-TOKEN": CSRF, "Accept": "application/json" },
                        onProgress: ({ percent }) => {
                            const t = percent != null ? `جارٍ الرفع... ${percent}%` : "جارٍ الرفع...";
                            btnUploadToGallery.textContent = t;
                            btnUploadSelectAndClose.textContent = t;
                        },
                    })
                    : await (async () => {
                        const r = await fetch(UPLOAD_URL, {
                            method: "POST",
                            headers: { "X-CSRF-TOKEN": CSRF, "Accept": "application/json" },
                            body: form
                        });
                        return { ok: r.ok, status: r.status, body: await r.text() };
                    })();
                const bodyText = res.body;
                if (!res.ok) {
                    console.error("❌ Upload failed:", res.status, bodyText);
                    alert("فشل رفع الملف.\nStatus: " + res.status);
                    return;
                }

                const parsed = tryParseJsonFromText(bodyText);
                created = parsed && !parsed.__nonJson ? extractCreatedFromPayload(parsed) : null;

                if (mode === "gallery") {
                    switchTab('gallery');
                    await resetAndLoad();
                    let picked = null;
                    if (created && created.length) {
                        const cid = created[0].id;
                        picked = state.list.find(m => m.id === cid) || null;
                    }
                    if (!picked) {
                        picked = findJustUploadedInState({
                            fileName: file0.name,
                            nameVal
                        });
                    }
                    if (picked) {
                        state.selected = picked;
                        renderList();
                        requestAnimationFrame(() => {
                            const items = [...listEl.querySelectorAll('.mmxc-item')];
                            const el = items.find(elm => {
                                const title = elm.querySelector('.mmxc-title')?.textContent
                                    .trim() || "";
                                return (picked.name || "") === title;
                            }) || items[0];
                            el?.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        });
                    }
                    uploadInput.value = "";
                    uploadName.value = "";
                    uploadAlt.value = "";
                    return;
                }

                // select-close
                if (created && created.length) {
                    const first = created[0];
                    window.mmxcMediaModalManager.onMediaSelected({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || nameVal || "",
                        alt: first.alt || altVal || ""
                    });
                    closeModal();
                } else {
                    await resetAndLoad();
                    const picked = findJustUploadedInState({
                        fileName: file0.name,
                        nameVal
                    });
                    if (picked) {
                        window.mmxcMediaModalManager.onMediaSelected({
                            id: picked.id,
                            url: picked.url || picked.path,
                            title: picked.name || nameVal || "",
                            alt: picked.alt || altVal || ""
                        });
                    } else {
                        console.warn("Upload OK but unable to determine the created media from response.");
                    }
                    closeModal();
                }
            } catch (err) {
                console.error("🔥 Exception during upload:", err);
                alert("حدث خطأ أثناء الرفع:\n" + (err && err.message ? err.message : err));
            } finally {
                btnUploadToGallery.disabled = false;
                btnUploadSelectAndClose.disabled = false;
                btnUploadToGallery.textContent = "إدراج في المعرض";
                btnUploadSelectAndClose.textContent = "إدراج في المقال";
            }
        }

        // ===== Import via URL (with media type radio) =====
        async function importViaUrl(mode) {
            if (!IMPORT_URL) {
                alert("⚠️ لم يتم ضبط مسار الاستيراد عبر الرابط في الخادم.");
                return;
            }
            const urlVal = (uploadUrlInput.value || "").trim();
            const nameVal = (urlNameInput.value || "").trim();
            const altVal = (urlAltInput.value || "").trim();
            const typeVal = getSelectedUrlType(); // auto | image | video | voice | file
            if (!urlVal) {
                alert("⚠️ يرجى إدخال الرابط أولاً.");
                return;
            }

            // إذا اختار المستخدم voice نمرره كـ audio إلى الخادم
            const payloadType = typeVal === "auto" ? undefined : mapFilterForServer(typeVal);

            let created = null;
            try {
                btnImportToGallery.disabled = true;
                btnImportSelectAndClose.disabled = true;
                btnImportToGallery.textContent = "جارٍ الاستيراد...";
                btnImportSelectAndClose.textContent = "جارٍ الاستيراد...";

                const res = await fetch(IMPORT_URL, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": CSRF,
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        url: urlVal,
                        name: nameVal || undefined,
                        alt: altVal || undefined,
                        media_type: payloadType // قد يتجاهله الخادم إن كان Auto/undefined
                    })
                });
                const bodyText = await res.text();
                if (!res.ok) {
                    console.error("❌ Import failed:", res.status, bodyText);
                    alert("فشل الاستيراد.\nStatus: " + res.status);
                    return;
                }

                const parsed = tryParseJsonFromText(bodyText);
                created = parsed && !parsed.__nonJson ? extractCreatedFromPayload(parsed) : null;

                if (mode === "gallery") {
                    switchTab('gallery');
                    await resetAndLoad();

                    let picked = null;
                    if (created && created.length) {
                        const cid = created[0].id;
                        picked = state.list.find(m => m.id === cid) || null;
                    }
                    if (!picked) {
                        picked = nameVal ?
                            state.list.find(m => (m.name || "").trim() === nameVal.trim()) :
                            (state.list[0] || null);
                    }
                    if (picked) {
                        state.selected = picked;
                        renderList();
                        requestAnimationFrame(() => {
                            const items = [...listEl.querySelectorAll('.mmxc-item')];
                            const el = items.find(elm => {
                                const title = elm.querySelector('.mmxc-title')?.textContent
                                    .trim() || "";
                                return (picked.name || "") === title;
                            }) || items[0];
                            el?.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        });
                    }
                    uploadUrlInput.value = "";
                    urlNameInput.value = "";
                    urlAltInput.value = "";
                    urlTypeRadios.forEach(r => {
                        r.checked = (r.value === "auto");
                    });
                    return;
                }

                // select-close
                if (created && created.length) {
                    const first = created[0];
                    window.mmxcMediaModalManager.onMediaSelected({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || nameVal || "",
                        alt: first.alt || altVal || ""
                    });
                    closeModal();
                } else {
                    await resetAndLoad();
                    const picked = nameVal ?
                        state.list.find(m => (m.name || "").trim() === nameVal.trim()) :
                        (state.list[0] || null);
                    if (picked) {
                        window.mmxcMediaModalManager.onMediaSelected({
                            id: picked.id,
                            url: picked.url || picked.path,
                            title: picked.name || nameVal || "",
                            alt: picked.alt || altVal || ""
                        });
                    } else {
                        console.warn("Import OK but unable to determine created media.");
                    }
                    closeModal();
                }
            } catch (err) {
                console.error("🔥 Exception during import:", err);
                alert("حدث خطأ أثناء الاستيراد:\n" + (err && err.message ? err.message : err));
            } finally {
                btnImportToGallery.disabled = false;
                btnImportSelectAndClose.disabled = false;
                btnImportToGallery.textContent = "إدراج في المعرض";
                btnImportSelectAndClose.textContent = "إدراج في المقال";
            }
        }

        // ===== Bindings =====
        btnUploadToGallery?.addEventListener("click", () => uploadMediaAndHandle('gallery'));
        btnUploadSelectAndClose?.addEventListener("click", () => uploadMediaAndHandle('select-close'));
        btnImportToGallery?.addEventListener("click", () => importViaUrl('gallery'));
        btnImportSelectAndClose?.addEventListener("click", () => importViaUrl('select-close'));

        // Visual feedback for file selection
        const uploadLabel = document.getElementById('mmxc-upload-label');
        const uploadLabelText = document.getElementById('mmxc-upload-label-text');
        uploadInput?.addEventListener('change', (e) => {
            const files = e.target.files;
            if (files && files.length > 0) {
                const fileName = files[0].name;
                if (uploadLabelText) uploadLabelText.textContent = 'تم تحميل الملف';
                if (uploadLabel) uploadLabel.style.border = '1px solid var(--mmxc-primary)';

                // Auto-fill name and alt fields if empty
                if (uploadName && !uploadName.value) {
                    const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                    uploadName.value = nameWithoutExt;
                    if (uploadAlt) uploadAlt.value = nameWithoutExt;
                }
            } else {
                if (uploadLabelText) uploadLabelText.textContent = 'اختر ملف الوسائط';
                if (uploadLabel) uploadLabel.style.border = '1px solid var(--mmxc-border)';
            }
        });

        // Auto-fill for URL input
        uploadUrlInput?.addEventListener('input', (e) => {
            const url = e.target.value.trim();
            if (url && urlNameInput && !urlNameInput.value) {
                try {
                    const urlPath = new URL(url, window.location.origin).pathname;
                    const fileName = urlPath.split('/').pop();
                    const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                    if (nameWithoutExt && nameWithoutExt !== '') {
                        urlNameInput.value = nameWithoutExt;
                        if (urlAltInput) urlAltInput.value = nameWithoutExt;
                    }
                } catch (err) {
                    // Invalid URL, ignore
                }
            }
        });

        // ===== Initial render =====
        (function init() {
            if (!state.list.length) listEl.innerHTML = `<div class="mmxc-empty">لا توجد وسائط للعرض</div>`;
        })();
    })();

    // --------- BRIDGE Social Media ↔ MMXc ----------
    const shareUrl = document.getElementById('share_image_url');
    const shareId = document.getElementById('share_image_id');
    const shareTitle = document.getElementById('share_image_title');
    const shareAlt = document.getElementById('share_image_alt');

    const previewWrap = document.getElementById('share_image_preview_wrapper');
    const previewImg = document.getElementById('share_image_preview');
    const previewName = document.getElementById('share_image_name');
    const placeholder = document.getElementById('share_image_placeholder');

    const btnPick = document.getElementById('btnPickShareImage');
    const btnClear = document.getElementById('btnClearShareImage');
    const btnRemove = document.getElementById('btnRemoveShareImage');

    const prevTitle = document.getElementById('preview_title');
    const prevDesc = document.getElementById('preview_description');
    const prevImgWrap = document.getElementById('preview_image_container');
    const prevImg = document.getElementById('preview_image');

    function setShareImage(payload) {
        shareId.value = payload.id || '';
        shareUrl.value = payload.url || '';
        shareTitle.value = payload.title || '';
        shareAlt.value = payload.alt || '';
        if (payload.url) {
            previewImg.src = payload.url;
            previewImg.alt = payload.alt || payload.title || '';
            previewName.textContent = payload.title || payload.url;
            previewWrap.classList.remove('d-none');
            placeholder.classList.add('d-none');
            if (prevImg) {
                prevImg.src = payload.url;
                prevImg.alt = payload.alt || payload.title || '';
                prevImgWrap && (prevImgWrap.style.display = '');
            }
        } else {
            previewWrap.classList.add('d-none');
            placeholder.classList.remove('d-none');
            if (prevImg) {
                prevImg.removeAttribute('src');
                prevImgWrap && (prevImgWrap.style.display = 'none');
            }
        }
    }

    // FIXED: Proper remove function
    function removeShareImage() {
        setShareImage({
            id: '',
            url: '',
            title: '',
            alt: ''
        });
    }

    // Attach the function to window for onclick
    window.removeShareImage = removeShareImage;

    window.updatePreview = function() {
        const t = document.getElementById('share_title')?.value || '';
        const d = document.getElementById('share_description')?.value || '';
        if (prevTitle) prevTitle.textContent = t.trim() || 'عنوان المشاركة';
        if (prevDesc) prevDesc.textContent = d.trim() || 'وصف المشاركة';
    };

    function openMMXcForSocial() {
        window.mmxcMediaModalManager.openModal('social_media');
        // Override the onMediaSelected callback for this specific use case
        window.mmxcMediaModalManager.onMediaSelected = function(media) {
            if (!media || !media.url) {
                alert('لا يمكن استخدام هذا الوسيط');
                return;
            }
            setShareImage({
                id: media.id || '',
                url: media.url || '',
                title: media.title || '',
                alt: media.alt || ''
            });
        };
    }

    // FIXED: Proper event listeners for all delete buttons
    btnPick && btnPick.addEventListener('click', openMMXcForSocial);
    btnClear && btnClear.addEventListener('click', removeShareImage);
    btnRemove && btnRemove.addEventListener('click', removeShareImage);

    // Bridge de soumission: recopier share_image_url → share_image (nom back)
    document.addEventListener('DOMContentLoaded', function() {
        const tab = document.getElementById('social-media');
        if (!tab) return;
        const form = tab.closest('form');
        if (!form) return;
        form.addEventListener('submit', function() {
            let hidden = form.querySelector('input[name="share_image"]');
            if (!hidden) {
                hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'share_image';
                form.appendChild(hidden);
            }
            hidden.value = shareUrl?.value || '';
        });
    });
</script>
