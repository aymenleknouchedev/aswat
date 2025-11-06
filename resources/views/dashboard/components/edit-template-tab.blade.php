<!-- ======================= AZ BASE STYLES ======================= -->
<style>
    :root {
        --az-border: #dbdfea;
        --az-muted: #8091a7;
        --az-soft: #f5f6fa;
        --az-card: #ffffff;
        --az-title: #364a63;
        --az-accent: #6576ff;
        --az-accent-light: #eff6ff;
        --az-danger: #e85347;
        --az-success: #1ee0ac;
        --az-warning: #f4bd0e;
        --az-radius: 0.35rem;
        --az-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --az-shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
        --az-transition: all 0.2s ease-in-out;
    }

    [data-bs-theme="dark"] {
        --az-border: #384D69;
        --az-muted: #b7c2d0;
        --az-soft: #2b3748;
        --az-card: #0D141D;
        --az-title: #e5e9f2;
        --az-accent: #6576ff;
        --az-accent-light: #2b3748;
        --az-danger: #e85347;
        --az-success: #1ee0ac;
        --az-warning: #f4bd0e;
    }

    .text-ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .az-item-card {
        background: var(--az-card);
        border: 1px solid var(--az-border);
        border-radius: var(--az-radius);
        margin-bottom: 12px;
        padding: 16px;
        box-shadow: var(--az-shadow);
        transition: var(--az-transition);
    }

    .az-item-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transform: translateY(-1px);
    }

    .az-item-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .az-left {
        display: flex;
        align-items: center;
        flex: 1;
        min-width: 0;
        gap: 12px;
    }

    .az-thumb {
        width: 96px;
        height: 54px;
        border: 1px solid var(--az-border);
        border-radius: var(--az-radius);
        overflow: hidden;
        background: var(--az-soft);
        margin-inline: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
    }

    .az-thumb img,
    .az-thumb video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }

    .az-meta {
        min-width: 0;
        flex: 1;
    }

    .az-title {
        color: var(--az-title);
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .az-desc {
        color: var(--az-muted);
        font-size: 0.875rem;
        line-height: 1.4;
    }

    .az-drag {
        width: 40px;
        height: 40px;
        border: 1px dashed var(--az-border);
        border-radius: var(--az-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--az-muted);
        cursor: grab;
        transition: var(--az-transition);
    }

    .az-drag:hover {
        background-color: var(--az-soft);
        border-color: var(--az-muted);
        color: var(--az-muted);
    }

    .az-drag:active {
        cursor: grabbing;
    }

    .circle-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background-color: var(--az-muted);
        color: white;
        border-radius: var(--az-radius);
        font-weight: 600;
        font-size: 0.875rem;
        margin-left: 8px;
        order: 2;
    }

    .modal-footer-sticky {
        position: sticky;
        bottom: 0;
        background: var(--az-card);
        border-top: 1px solid var(--az-border);
        z-index: 2;
        padding: 1rem;
        margin-top: 1rem;
    }

    #itemMediaPreview img,
    #itemMediaPreview video {
        border: 1px solid var(--az-border);
        padding: 4px;
        max-height: 160px;
        border-radius: var(--az-radius);
        background: var(--az-soft);
        width: 100%;
        object-fit: contain;
    }

    /* Form UI */
    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--az-title);
    }

    .form-control {
        border: 1px solid var(--az-border);
        border-radius: var(--az-radius);
        padding: 10px 14px;
        transition: var(--az-transition);
        background: var(--az-card);
        color: var(--az-title);
    }

    .form-control:focus {
        border-color: var(--az-accent);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.1);
    }

    .btn {
        border-radius: var(--az-radius);
        padding: 10px 16px;
        font-weight: 500;
        transition: var(--az-transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-primary {
        background: var(--az-accent);
        border-color: var(--az-accent);
        color: white;
    }

    .btn-primary:hover {
        background: #465fff;
        border-color: #465fff;
        transform: translateY(-1px);
    }

    .btn-outline-danger {
        color: var(--az-danger);
        border-color: var(--az-danger);
    }

    .btn-outline-danger:hover {
        background: var(--az-danger);
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-outline-secondary {
        color: var(--az-muted);
        border-color: var(--az-border);
    }

    .btn-outline-secondary:hover {
        background: var(--az-soft);
        border-color: var(--az-muted);
        transform: translateY(-1px);
    }

    .btn-success {
        background: var(--az-success);
        border-color: var(--az-success);
        color: white;
    }

    .btn-success:hover {
        background: #17c99a;
        border-color: #17c99a;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: var(--az-muted);
        border-color: var(--az-muted);
        color: white;
    }

    .btn-secondary:hover {
        background: #6b7f9a;
        border-color: #6b7f9a;
        transform: translateY(-1px);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--az-muted);
        border: 2px dashed var(--az-border);
        border-radius: var(--az-radius);
        background: var(--az-soft);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--az-border);
    }

    @media (max-width: 768px) {
        .az-item-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .az-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .az-actions .btn {
            order: 1;
        }

        .az-actions .circle-number {
            order: 2;
        }

        .az-thumb {
            width: 80px;
            height: 45px;
        }
    }

    /* Font Awesome safety */
    .fa,
    .fas,
    .far,
    .fal,
    .fad,
    .fab {
        font-family: "Font Awesome 6 Free", "Font Awesome 6 Pro", "Font Awesome 6 Brands";
        font-weight: 900;
    }

    .fa-grip-vertical:before {
        content: "\f58e";
    }

    .fa-plus:before {
        content: "\2b";
    }

    .fa-trash:before {
        content: "\f1f8";
    }

    .fa-pen:before {
        content: "\f304";
    }

    .fa-floppy-disk:before {
        content: "\f0c7";
    }

    .fa-images:before {
        content: "\f302";
    }

    .fa-xmark:before {
        content: "\f00d";
    }

    .fa-file-lines:before {
        content: "\f15c";
    }
</style>

<!-- ======================= MMxx MEDIA MODAL: SPRITE + META CSRF ======================= -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
    <symbol id="mmxx-icon-image" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <circle cx="8" cy="10" r="1.5" fill="currentColor" />
        <path d="M21 19l-5.5-7-4.5 6-3-4-4 5" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="mmxx-icon-video" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
    <symbol id="mmxx-icon-voice" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <rect x="9" y="7" width="2" height="10" rx="1" fill="currentColor" />
        <rect x="13" y="11" width="2" height="6" rx="1" fill="currentColor" />
    </symbol>
    <symbol id="mmxx-icon-file" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <path d="M9 7h6M9 11h6M9 15h2" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="mmxx-icon-youtube" viewBox="0 0 24 24">
        <rect x="2" y="6" width="20" height="12" rx="4" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
</svg>

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ======================= MMxx MEDIA MODAL: MARKUP ======================= -->
<div id="mmxxMediaModal" class="mmxx-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="mmxxMediaModalTitle">
    <div class="mmxx-backdrop" data-mmxx-backdrop></div>
    <div class="mmxx-container" role="document">
        <div class="mmxx-header">
            <h5 id="mmxxMediaModalTitle">اختر الوسائط</h5>
            <button class="mmxx-close" type="button" data-mmxx-close aria-label="إغلاق">&times;</button>
        </div>

        <div class="mmxx-tabs" role="tablist" aria-label="أقسام إدارة الوسائط">
            <button type="button" class="mmxx-tab-btn mmxx-is-active" role="tab" aria-selected="true"
                aria-controls="mmxx-tab-gallery" id="mmxx-tabbtn-gallery" tabindex="0"
                data-mmxx-tab="gallery">المعرض</button>
            <button type="button" class="mmxx-tab-btn" role="tab" aria-selected="false"
                aria-controls="mmxx-tab-upload" id="mmxx-tabbtn-upload" tabindex="-1" data-mmxx-tab="upload">الرفع من
                الجهاز</button>
            <button type="button" class="mmxx-tab-btn" role="tab" aria-selected="false"
                aria-controls="mmxx-tab-import" id="mmxx-tabbtn-import" tabindex="-1"
                data-mmxx-tab="import">الاستيراد بالرابط</button>
        </div>

        <!-- Gallery -->
        <section id="mmxx-tab-gallery" class="mmxx-tab-panel" role="tabpanel" aria-labelledby="mmxx-tabbtn-gallery">
            <div class="mmxx-filters">
                <input type="text" id="mmxx-search" placeholder="ابحث عن وسائط..." />
                <select id="mmxx-type-filter" aria-label="نوع الوسائط">
                    <option value="all">كل الوسائط</option>
                    <option value="image">صورة</option>
                    <option value="video">فيديو</option>
                    <option value="voice">صوت</option>
                    <option value="file">ملف</option>
                </select>
            </div>

            <div class="mmxx-body">
                <div id="mmxx-list" class="mmxx-grid"></div>
                <div id="mmxx-loader" class="mmxx-loader" hidden>جاري التحميل...</div>
                <div id="mmxx-sentinel" class="mmxx-sentinel"></div>
            </div>

            <div class="mmxx-footer">
                <button class="mmxx-btn mmxx-btn-select" type="button" id="mmxx-btn-select">اختر</button>
                <button class="mmxx-btn mmxx-btn-cancel" type="button" data-mmxx-close>إلغاء</button>
            </div>
        </section>

        <!-- Upload -->
        <section id="mmxx-tab-upload" class="mmxx-tab-panel" role="tabpanel" aria-labelledby="mmxx-tabbtn-upload"
            hidden>
            <div class="mmxx-tab-body">
                <div class="mmxx-uploader">
                    <div class="mmxx-upload-fields" style="display: flex; flex-wrap: wrap; gap: .6rem; width: 100%;">
                        <div style="flex: 1 1 220px;">
                            <input type="file" id="mmxx-upload-input" class="mmxx-upload-input"
                                style="display: none;" />

                            <label for="mmxx-upload-input" id="mmxx-upload-label" data-ar="اختر ملف الوسائط" data-en="Select Media File"
                                style="display: block; width: 100%; cursor: pointer; padding: .6rem .7rem;
           border-radius: 0; background: var(--az-soft); color: var(--az-title); border: 1px solid transparent;
           text-align: center; transition: all 0.2s;">
                                <i class="fa fa-upload" style="margin-right: 6px;"></i>
                                <span id="mmxx-upload-label-text">اختر ملف الوسائط</span>
                            </label>
                        </div>
                        <div style="flex: 1 1 200px;">
                            <input type="text" id="mmxx-upload-name" class="mmxx-upload-name"
                                placeholder="اسم الملف"
                                style="width: 100%; padding: .6rem .7rem; border-radius: 0; background: var(--az-soft);border:none; color: var(--az-title);" />
                        </div>
                        <div style="flex: 1 1 200px;">
                            <input type="text" id="mmxx-upload-alt" class="mmxx-upload-alt"
                                placeholder="النص البديل"
                                style="width: 100%; padding: .6rem .7rem; border-radius: 0; background: var(--az-soft);border:none; color: var(--az-title);" />
                        </div>
                    </div>
                    <div class="mmxx-uploader-actions">
                        <button class="mmxx-btn mmxx-btn-secondary" type="button" id="mmxx-btn-upload-to-gallery"
                            title="إدراج في المعرض" data-ar="إدراج في المعرض" data-en="Insert into Gallery">إدراج في
                            المعرض</button>
                        <button class="mmxx-btn mmxx-btn-primary" type="button"
                            id="mmxx-btn-upload-and-select-close" title="إدراج في المقال"
                            data-ar="إدراج في المقال" data-en="Insert into Post">إدراج في المقال</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Import by URL -->
        <section id="mmxx-tab-import" class="mmxx-tab-panel" role="tabpanel" aria-labelledby="mmxx-tabbtn-import"
            hidden>
            <div class="mmxx-tab-body">
                <div class="mmxx-uploader mmxx-uploader-url"
                    style="padding: 1rem 1.25rem; background: var(--vvc-body-bg); border: 1px solid var(--vvc-border-color);">
                    <div style="display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:.7rem; width:100%;">
                        <input type="text" id="mmxx-upload-url"
                            style="flex:1 1 100%; padding:.6rem .7rem; border:1px solid var(--vvc-border-color); background:var(--vvc-body-bg); color:var(--vvc-body-color); border-radius:0; font-size:.95rem;"
                            placeholder="أدخل رابط الوسائط" />
                        <input type="text" id="mmxx-url-name" placeholder="اسم الملف"
                            style="flex:1 1 220px; padding:.6rem .7rem; border:1px solid var(--vvc-border-color); background:var(--vvc-body-bg); color:var(--vvc-body-color); border-radius:0; font-size:.95rem;" />
                        <input type="text" id="mmxx-url-alt" placeholder="النص البديل (للصور)"
                            style="flex:1 1 220px; padding:.6rem .7rem; border:1px solid var(--vvc-border-color); background:var(--vvc-body-bg); color:var(--vvc-body-color); border-radius:0; font-size:.95rem;" />
                    </div>
                    <fieldset class="mmxx-url-type-group" aria-label="نوع الوسائط للرابط"
                        style="margin-bottom:.7rem; border:1px solid var(--vvc-border-color); padding:.6rem .8rem; background:var(--vvc-body-bg); border-radius:0;">
                        <legend style="font-size:.9rem; color:var(--vvc-heading-color); padding:0 .25rem; font-weight:600;"
                            data-ar="نوع الوسائط (اختياري)" data-en="Media Type (Optional)">نوع
                            الوسائط
                            (اختياري)</legend>
                        <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
                            <label class="mmxx-radio" style="font-size:.9rem; color:var(--vvc-body-color);"><input
                                    type="radio" name="mmxx-url-type" value="auto"
                                    checked /><span>Auto</span></label>
                            <label class="mmxx-radio" style="font-size:.9rem; color:var(--vvc-body-color);"><input
                                    type="radio" name="mmxx-url-type" value="image" /><span>Image</span></label>
                            <label class="mmxx-radio" style="font-size:.9rem; color:var(--vvc-body-color);"><input
                                    type="radio" name="mmxx-url-type" value="video" /><span>Video</span></label>
                            <label class="mmxx-radio" style="font-size:.9rem; color:var(--vvc-body-color);"><input
                                    type="radio" name="mmxx-url-type" value="voice" /><span>Voice</span></label>
                            <label class="mmxx-radio" style="font-size:.9rem; color:var(--vvc-body-color);"><input
                                    type="radio" name="mmxx-url-type" value="file" /><span>File</span></label>
                        </div>
                    </fieldset>
                    <div class="mmxx-uploader-actions">
                        <button class="mmxx-btn mmxx-btn-secondary" type="button" id="mmxx-btn-import-to-gallery"
                            title="استيراد بالرابط ثم عرض في المعرض" data-ar="إدراج في المعرض"
                            data-en="Insert into Gallery">إدراج في المعرض</button>
                        <button class="mmxx-btn mmxx-btn-primary" type="button"
                            id="mmxx-btn-import-and-select-close" title="استيراد بالرابط ثم حفظ وإغلاق" data-ar="إدراج في المقال"
                            data-en="Insert into Post">إدراج في المقال</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- ======================= VVC MODAL STYLES (TinyMCE Config Matching) ======================= -->
<style>
    #mmxxMediaModal,
    #mmxxMediaModal * {
        box-sizing: border-box;
    }

    /* Color variables matching tinymce-config */
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
        --vvc-success: #1ee0ac;
        --vvc-danger: #e85347;
        --vvc-warning: #f4bd0e;
        --vvc-gray-200: #e5e9f2;
        --vvc-gray-300: #dbdfea;
        --vvc-gray-400: #b7c2d0;
        --vvc-gray-500: #8091a7;
        --vvc-gray-600: #3c4d62;
        --vvc-gray-700: #344357;
        --vvc-gray-800: #2b3748;
        --vvc-gray-900: #1f2b3a;
    }

    [data-bs-theme="dark"] {
        --vvc-body-bg: #0D141D;
        --vvc-body-color: #e5e9f2;
        --vvc-heading-color: #fff;
        --vvc-border-color: #384D69;
        --vvc-muted: #b7c2d0;
        --vvc-primary: #6576ff;
        --vvc-secondary: #364a63;
        --vvc-success: #1ee0ac;
        --vvc-danger: #e85347;
        --vvc-warning: #f4bd0e;
        --vvc-gray: #b7c2d0;
        --vvc-gray-100: #2b3748;
        --vvc-gray-200: #344357;
        --vvc-gray-300: #3c4d62;
        --vvc-gray-400: #8091a7;
        --vvc-gray-500: #b7c2d0;
        --vvc-gray-600: #dbdfea;
        --vvc-gray-700: #e5e9f2;
        --vvc-gray-800: #ebeef2;
        --vvc-gray-900: #f5f6fa;
    }

    .mmxx-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 10000;
    }

    .mmxx-modal[aria-hidden="false"] {
        display: block;
    }

    .mmxx-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        z-index: 0;
    }

    .mmxx-container {
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
        z-index: 1;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        animation: mmxxFade .2s ease-out;
    }

    @keyframes mmxxFade {
        from {
            opacity: 0;
            transform: translateY(-14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mmxx-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--vvc-border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--vvc-body-bg);
    }

    .mmxx-header h5 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--vvc-body-color);
    }

    .mmxx-close {
        font-size: 1.4rem;
        line-height: 1;
        border: 0;
        background: transparent;
        color: var(--vvc-muted);
        cursor: pointer;
    }

    .mmxx-close:hover {
        color: var(--vvc-body-color);
    }

    .mmxx-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg);
    }

    .mmxx-tab-btn {
        appearance: none;
        background: var(--vvc-body-bg);
        border: 1px solid var(--vvc-border-color);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--vvc-body-color);
    }

    .mmxx-tab-btn:focus {
        outline: 2px solid var(--vvc-ring);
        outline-offset: 1px;
    }

    .mmxx-tab-btn.mmxx-is-active {
        background: var(--vvc-primary);
        border-color: var(--vvc-primary);
        color: white;
    }

    .mmxx-tab-panel {
        display: block;
    }

    .mmxx-tab-panel[hidden] {
        display: none;
    }

    .mmxx-tab-body {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg);
    }

    .mmxx-filters {
        padding: 1rem 1.25rem;
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg);
    }

    .mmxx-filters input,
    .mmxx-filters select {
        padding: .6rem .7rem;
        font-size: .95rem;
        border: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg);
        color: var(--vvc-body-color);
        flex: 1 1 180px;
        transition: box-shadow .15s, border-color .15s;
    }

    .mmxx-filters input::placeholder {
        color: var(--vvc-muted);
    }

    .mmxx-filters input:focus,
    .mmxx-filters select:focus {
        border-color: var(--vvc-primary);
        box-shadow: 0 0 0 2px rgba(101, 118, 255, 0.1);
        outline: none;
    }

    .mmxx-body {
        padding: 1rem 1.25rem;
        overflow: auto;
        flex: 1;
        background: var(--vvc-body-bg);
    }

    .mmxx-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: .9rem;
    }

    .mmxx-empty {
        text-align: center;
        color: var(--vvc-muted);
        font-size: .95rem;
        margin: 2rem 0;
    }

    .mmxx-item {
        position: relative;
        background: var(--vvc-body-bg);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: .6rem;
        transition: border-color .15s, transform .04s ease, box-shadow .15s;
    }

    .mmxx-item:hover {
        border-color: var(--vvc-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.1);
    }

    .mmxx-item:active {
        transform: scale(.995);
    }

    .mmxx-item.mmxx-is-selected {
        border-color: var(--vvc-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.2);
    }

    .mmxx-thumb {
        width: 100%;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--vvc-gray-100);
        overflow: hidden;
        position: relative;
        border: 1px solid var(--vvc-gray-200);
    }

    .mmxx-thumb img,
    .mmxx-thumb video {
        max-width: 100%;
        max-height: 100%;
    }

    .mmxx-thumb audio {
        width: 100%;
    }

    .mmxx-badge {
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

    .mmxx-badge svg {
        width: 18px;
        height: 18px;
    }

    .mmxx-title {
        font-size: .9rem;
        color: var(--vvc-body-color);
        margin-top: .55rem;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mmxx-uploader {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .6rem;
        background: var(--vvc-body-bg);
        border: 1px solid var(--vvc-border-color);
        padding: 1rem;
    }

    .mmxx-uploader-url {
        border-style: solid;
    }

    #mmxx-upload-input {
        flex: 1 1 220px;
    }

    #mmxx-upload-name,
    #mmxx-upload-alt {
        flex: 1 1 200px;
    }

    #mmxx-upload-url,
    #mmxx-url-name,
    #mmxx-url-alt {
        flex: 1 1 100%;
    }

    .mmxx-url-type-group {
        width: 100%;
        margin: .2rem 0 .4rem;
        border: 1px solid var(--vvc-border-color);
        padding: .6rem .8rem;
    }

    .mmxx-url-type-group legend {
        font-size: .9rem;
        color: var(--vvc-body-color);
        padding: 0 .25rem;
    }

    .mmxx-radio {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        margin-inline-end: 1rem;
        cursor: pointer;
    }

    .mmxx-radio input {
        accent-color: var(--vvc-primary);
    }

    .mmxx-uploader-actions {
        display: flex;
        gap: .6rem;
    }

    .mmxx-btn {
        padding: .6rem 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        border: 1px solid var(--bs-secondary);
        background: var(--bs-secondary);
        color: var(--bs-white);
        border-radius: var(--bs-border-radius);
    }

    .mmxx-btn:hover {
        background: var(--bs-secondary-bg-subtle);
        border-color: var(--bs-secondary-border-subtle);
        color: var(--bs-body-color);
    }

    .mmxx-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .mmxx-btn-secondary {
        background: var(--bs-secondary);
        border-color: var(--bs-secondary);
        color: var(--bs-white);
    }

    .mmxx-btn-secondary:hover {
        background: var(--bs-secondary-bg-subtle);
        border-color: var(--bs-secondary-border-subtle);
        color: var(--bs-body-color);
    }

    .mmxx-btn-primary {
        background: var(--bs-primary);
        border-color: var(--bs-primary);
        color: var(--bs-white);
    }

    .mmxx-btn-primary:hover {
        background: var(--bs-primary-bg-subtle);
        border-color: var(--bs-primary-border-subtle);
        color: var(--bs-primary-text-emphasis);
    }

    .mmxx-footer {
        padding: 1rem 1.25rem;
        background: var(--vvc-body-bg);
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        border-top: 1px solid var(--vvc-border-color);
    }

    .mmxx-btn-select {
        background: var(--bs-gray-400);
        color: var(--bs-white);
        border-color: var(--bs-gray-400);
        transition: background .15s, color .15s, border-color .15s;
    }

    .mmxx-btn-select:hover {
        background: var(--bs-gray-500);
        border-color: var(--bs-gray-500);
        color: var(--bs-white);
    }

    .mmxx-btn-select:not(:disabled) {
        background: var(--bs-success);
        border-color: var(--bs-success);
    }

    .mmxx-loader {
        text-align: center;
        color: var(--vvc-muted);
        padding: .75rem;
        font-size: .95rem;
    }

    .mmxx-sentinel {
        height: 1px;
    }

    @media (max-width: 768px) {
        .mmxx-container {
            top: 2%;
            max-height: 96%;
        }

        .mmxx-tabs {
            flex-wrap: wrap;
        }

        .mmxx-filters {
            flex-direction: column;
        }

        .mmxx-filters input,
        .mmxx-filters select,
        .mmxx-uploader {
            width: 100%;
        }

        .mmxx-uploader {
            flex-direction: column;
            align-items: stretch;
        }

        .mmxx-uploader-actions {
            width: 100%;
        }

        .mmxx-uploader-actions .mmxx-btn {
            width: 100%;
        }
    }
</style>

<!-- ======================= MMxx MODAL SCRIPT ======================= -->
<script>
    (() => {
        const FETCH_URL = "{{ route('dashboard.media.getAllMediaPaginated') }}";
        const UPLOAD_URL = "{{ route('dashboard.media.store') }}";
        const IMPORT_URL = "{{ route('dashboard.media_url.store') }}";

        const modal = document.getElementById("mmxxMediaModal");
        const backdrop = modal.querySelector("[data-mmxx-backdrop]");
        const closes = modal.querySelectorAll("[data-mmxx-close]");
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        const listEl = document.getElementById("mmxx-list");
        const loaderEl = document.getElementById("mmxx-loader");
        const sentinel = document.getElementById("mmxx-sentinel");
        const searchInput = document.getElementById("mmxx-search");
        const typeSelect = document.getElementById("mmxx-type-filter");
        const btnSelect = document.getElementById("mmxx-btn-select");

        const uploadInput = document.getElementById("mmxx-upload-input");
        const uploadName = document.getElementById("mmxx-upload-name");
        const uploadAlt = document.getElementById("mmxx-upload-alt");
        const btnUploadToGallery = document.getElementById("mmxx-btn-upload-to-gallery");
        const btnUploadSelectAndClose = document.getElementById("mmxx-btn-upload-and-select-close");

        const uploadUrlInput = document.getElementById("mmxx-upload-url");
        const urlNameInput = document.getElementById("mmxx-url-name");
        const urlAltInput = document.getElementById("mmxx-url-alt");
        const btnImportToGallery = document.getElementById("mmxx-btn-import-to-gallery");
        const btnImportSelectAndClose = document.getElementById("mmxx-btn-import-and-select-close");
        const urlTypeRadios = modal.querySelectorAll("input[name='mmxx-url-type']");

        const tabButtons = Array.from(modal.querySelectorAll('.mmxx-tab-btn'));
        const tabPanels = {
            gallery: document.getElementById('mmxx-tab-gallery'),
            upload: document.getElementById('mmxx-tab-upload'),
            import: document.getElementById('mmxx-tab-import'),
        };

        const state = {
            isOpen: false,
            page: 1,
            perPage: 12,
            hasMore: true,
            isLoading: false,
            search: "",
            type: "all",
            list: [],
            selected: null,
            observer: null,
            activeTab: 'gallery'
        };

        // Helpers
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
        const mapFilterForServer = t => (t === "voice" ? "audio" : t);

        function getBadgeIconId(media) {
            if (media.path && isYouTubeUrl(media.path)) return "mmxx-icon-youtube";
            const kind = getMediaKind(media);
            if (kind === "image") return "mmxx-icon-image";
            if (kind === "video") return "mmxx-icon-video";
            if (kind === "voice") return "mmxx-icon-voice";
            return "mmxx-icon-file";
        }

        function getSelectedUrlType() {
            const checked = Array.from(urlTypeRadios).find(r => r.checked);
            return checked ? checked.value : "auto";
        }

        // Public API
        window.mmxxMediaModalManager = {
            openModal() {
                openModal();
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

        // Reset UI
        function clearAllInputs() {
            searchInput && (searchInput.value = "");
            typeSelect && (typeSelect.value = "all");
            uploadInput && (uploadInput.value = "");
            uploadName && (uploadName.value = "");
            uploadAlt && (uploadAlt.value = "");
            uploadUrlInput && (uploadUrlInput.value = "");
            urlNameInput && (urlNameInput.value = "");
            urlAltInput && (urlAltInput.value = "");
            urlTypeRadios.forEach(r => r.checked = (r.value === "auto"));
            // Reset upload label visual feedback
            const uploadLabel = document.getElementById('mmxx-upload-label');
            const uploadLabelText = document.getElementById('mmxx-upload-label-text');
            if (uploadLabelText) uploadLabelText.textContent = 'اختر ملف الوسائط';
            if (uploadLabel) uploadLabel.style.border = '1px solid transparent';
        }

        function resetStateFilters() {
            state.search = "";
            state.type = "all";
            state.selected = null;
        }

        // Open/Close
        function openModal() {
            state.isOpen = true;
            modal.setAttribute("aria-hidden", "false");
            document.documentElement.style.overflow = "hidden";
            resetStateFilters();
            clearAllInputs();
            switchTab('gallery');
            resetAndLoad();
            setTimeout(() => document.getElementById("mmxx-search")?.focus(), 0);
        }

        function closeModal() {
            state.isOpen = false;
            modal.setAttribute("aria-hidden", "true");
            document.documentElement.style.overflow = "";
            resetStateFilters();
            clearAllInputs();

            // FIXED: Always reopen the parent item modal when MMxx modal closes
            setTimeout(() => {
                if (window.itemModalManager && typeof window.itemModalManager.reopenItemModal ===
                    'function') {
                    window.itemModalManager.reopenItemModal();
                }
            }, 150);
        }
        backdrop.addEventListener("click", closeModal);
        closes.forEach(b => b.addEventListener("click", closeModal));
        modal.querySelector(".mmxx-container").addEventListener("click", e => e.stopPropagation());
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

        // Tabs
        tabButtons.forEach(btn => btn.addEventListener('click', () => switchTab(btn.dataset.mmxxTab)));

        function switchTab(tab) {
            if (!tabPanels[tab]) return;
            state.activeTab = tab;
            tabButtons.forEach(b => {
                const active = b.dataset.mmxxTab === tab;
                b.classList.toggle('mmxx-is-active', active);
                b.setAttribute('aria-selected', String(active));
                b.tabIndex = active ? 0 : -1;
            });
            Object.entries(tabPanels).forEach(([name, panel]) => panel.hidden = (name !== tab));
        }

        // Fetch/pagination
        async function resetAndLoad() {
            state.page = 1;
            state.hasMore = true;
            state.list = [];
            renderList();
            await loadMore(true);
            setupObserver();
        }

        function setupObserver() {
            if (state.observer) state.observer.disconnect();
            const rootEl = tabPanels.gallery.querySelector(".mmxx-body");
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
        async function loadMore(reset = false) {
            if (state.isLoading || !state.hasMore) return;
            state.isLoading = true;
            loaderEl.hidden = false;
            try {
                const url = new URL(FETCH_URL, window.location.origin);
                url.searchParams.set("page", state.page);
                url.searchParams.set("search", state.search.trim());
                url.searchParams.set("type", mapFilterForServer(state.type));
                const res = await fetch(url.toString(), {
                    headers: {
                        Accept: "application/json"
                    }
                });
                const data = await res.json();
                const items = Array.isArray(data.data) ? data.data : [];
                const hasMore = !!data.next_page_url;
                state.list = reset ? items : state.list.concat(items);
                state.hasMore = hasMore;
                state.page += 1;
            } catch (err) {
                console.error(err);
            } finally {
                state.isLoading = false;
                loaderEl.hidden = true;
                renderList();
            }
        }

        // Render
        function renderList() {
            listEl.innerHTML = "";
            const filtered = state.type === "all" ? state.list : state.list.filter(m => getMediaKind(m) === state
                .type);
            if (!filtered.length) {
                listEl.innerHTML = `<div class="mmxx-empty">لا توجد وسائط للعرض</div>`;
                return;
            }
            filtered.forEach(media => {
                const kind = getMediaKind(media);
                const item = document.createElement("div");
                item.className = "mmxx-item";
                if (state.selected && state.selected.id === media.id) item.classList.add(
                    "mmxx-is-selected");
                item.addEventListener("click", () => toggleSelect(media));

                const thumb = document.createElement("div");
                thumb.className = "mmxx-thumb";

                const badge = document.createElement("div");
                badge.className = "mmxx-badge";
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
                title.className = "mmxx-title";
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

        // Search/filter
        searchInput?.addEventListener("input", async e => {
            state.search = e.target.value;
            await resetAndLoad();
        });
        typeSelect?.addEventListener("change", async e => {
            state.type = e.target.value;
            await resetAndLoad();
        });

        // Confirm selection
        btnSelect?.addEventListener("click", () => {
            if (!state.selected) {
                alert('يرجى اختيار وسيط.');
                return;
            }
            window.mmxxMediaModalManager.onMediaSelected({
                id: state.selected.id,
                url: state.selected.path,
                title: state.selected.name || "",
                alt: state.selected.alt || ""
            });
            closeModal();
        });

        // Upload & Import utils
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

        async function uploadMediaAndHandle(mode) {
            const files = uploadInput.files;
            if (!files || !files.length) {
                alert("⚠️ لم يتم اختيار أي ملف للرفع.");
                return;
            }
            const file0 = files[0];
            const nameVal = (uploadName.value || "").trim();
            const altVal = (uploadAlt.value || "").trim();

            const form = new FormData();
            form.append("media", file0);
            if (nameVal) form.append("name", nameVal);
            if (altVal) form.append("alt", altVal);

            let created = null;
            try {
                btnUploadToGallery.disabled = true;
                btnUploadSelectAndClose.disabled = true;
                btnUploadToGallery.textContent = "جارٍ الرفع...";
                btnUploadSelectAndClose.textContent = "جارٍ الرفع...";
                const res = await fetch(UPLOAD_URL, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": CSRF,
                        "Accept": "application/json"
                    },
                    body: form
                });
                const bodyText = await res.text();
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
                    // auto-select just uploaded
                    let picked = null;
                    if (created && created.length) {
                        const cid = created[0].id;
                        picked = state.list.find(m => m.id === cid) || null;
                    }
                    if (!picked) {
                        picked = state.list[0] || null;
                    }
                    if (picked) {
                        state.selected = picked;
                        renderList();
                    }
                    uploadInput.value = "";
                    uploadName.value = "";
                    uploadAlt.value = "";
                    return;
                }
                // select-close
                if (created && created.length) {
                    const first = created[0];
                    window.mmxxMediaModalManager.onMediaSelected({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || nameVal || "",
                        alt: first.alt || altVal || ""
                    });
                    closeModal();
                } else {
                    await resetAndLoad();
                    const picked = state.list[0] || null;
                    if (picked) {
                        window.mmxxMediaModalManager.onMediaSelected({
                            id: picked.id,
                            url: picked.url || picked.path,
                            title: picked.name || nameVal || "",
                            alt: picked.alt || altVal || ""
                        });
                    }
                    closeModal();
                }
            } catch (err) {
                console.error("🔥 Exception during upload:", err);
                alert("حدث خطأ أثناء الرفع:\n" + (err?.message || err));
            } finally {
                btnUploadToGallery.disabled = false;
                btnUploadSelectAndClose.disabled = false;
                btnUploadToGallery.textContent = "إدراج في المعرض";
                btnUploadSelectAndClose.textContent = "إدراج في المقال";
            }
        }

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
                        media_type: payloadType
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
                        picked = state.list[0] || null;
                    }
                    if (picked) {
                        state.selected = picked;
                        renderList();
                    }
                    uploadUrlInput.value = "";
                    urlNameInput.value = "";
                    urlAltInput.value = "";
                    urlTypeRadios.forEach(r => r.checked = (r.value === "auto"));
                    return;
                }
                // select-close
                if (created && created.length) {
                    const first = created[0];
                    window.mmxxMediaModalManager.onMediaSelected({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || nameVal || "",
                        alt: first.alt || altVal || ""
                    });
                    closeModal();
                } else {
                    await resetAndLoad();
                    const picked = state.list[0] || null;
                    if (picked) {
                        window.mmxxMediaModalManager.onMediaSelected({
                            id: picked.id,
                            url: picked.url || picked.path,
                            title: picked.name || nameVal || "",
                            alt: picked.alt || altVal || ""
                        });
                    }
                    closeModal();
                }
            } catch (err) {
                console.error("🔥 Exception during import:", err);
                alert("حدث خطأ أثناء الاستيراد:\n" + (err?.message || err));
            } finally {
                btnImportToGallery.disabled = false;
                btnImportSelectAndClose.disabled = false;
                btnImportToGallery.textContent = "إدراج في المعرض";
                btnImportSelectAndClose.textContent = "إدراج في المقال";
            }
        }

        // Bindings
        btnUploadToGallery?.addEventListener("click", () => uploadMediaAndHandle('gallery'));
        btnUploadSelectAndClose?.addEventListener("click", () => uploadMediaAndHandle('select-close'));
        btnImportToGallery?.addEventListener("click", () => importViaUrl('gallery'));
        btnImportSelectAndClose?.addEventListener("click", () => importViaUrl('select-close'));

        // Visual feedback for file selection
        const uploadLabel = document.getElementById('mmxx-upload-label');
        const uploadLabelText = document.getElementById('mmxx-upload-label-text');
        uploadInput?.addEventListener('change', (e) => {
            const files = e.target.files;
            if (files && files.length > 0) {
                const fileName = files[0].name;
                if (uploadLabelText) uploadLabelText.textContent = 'تم تحميل الملف';
                if (uploadLabel) uploadLabel.style.border = '1px solid var(--az-accent)';

                // Auto-fill name and alt fields if empty
                if (uploadName && !uploadName.value) {
                    const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                    uploadName.value = nameWithoutExt;
                    if (uploadAlt) uploadAlt.value = nameWithoutExt;
                }
            } else {
                if (uploadLabelText) uploadLabelText.textContent = 'اختر ملف الوسائط';
                if (uploadLabel) uploadLabel.style.border = '1px solid transparent';
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

        // Initial
        (function init() {
            if (!state.list.length) listEl.innerHTML = `<div class="mmxx-empty">لا توجد وسائط للعرض</div>`;
        })();
    })();
</script>

<!-- ======================= CONTENT TAB (DISPLAY METHOD + LIST ZONE) ======================= -->
<div id="contentTab" class="container py-3">
    <div id="list-items-hidden-inputs"></div>

    <div id="template" class="tab-pane show active" role="tabpanel">
        <div class="form-group col-lg-12 mb-3">
            <label class="form-label">القالب</label><span class="text-danger"> *</span>
            <div class="d-flex flex-column mt-2">
                <label class="form-check form-check-inline mb-2">
                    <input class="form-check-input" type="radio" name="display_method" value="simple"
                        {{ isset($content) && $content->display_method == 'simple' ? 'checked' : '' }}>
                    <span class="form-check-label">أساسي</span>
                </label>
                <label class="form-check form-check-inline mb-2">
                    <input class="form-check-input" type="radio" name="display_method" value="list"
                        {{ isset($content) && $content->display_method == 'list' ? 'checked' : '' }}>
                    <span class="form-check-label">قائمة</span>
                </label>
                <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="display_method" value="file"
                        {{ isset($content) && $content->display_method == 'file' ? 'checked' : '' }}>
                    <span class="form-check-label">ملف</span>
                </label>
            </div>
        </div>

        <div id="dynamic-items-section" class="mt-3" style="display:none;">
            <div class="d-flex" style="margin-bottom:10px;">
                <button type="button" id="add-item-btn" class="btn btn-primary mx-1" data-bs-toggle="modal"
                    data-bs-target="#itemModal">
                    <i class="fa fa-plus"></i> إضافة عنصر
                </button>
                <button type="button" id="clear-all-btn" class="btn btn-outline-danger mx-1"
                    style="transition:background 0.2s;">
                    <i class="fa fa-trash"></i> حذف الكل
                </button>
                <style>
                    #clear-all-btn:hover {
                        background: var(--az-danger);
                        color: #fff;
                        border-color: var(--az-danger);
                    }
                </style>
            </div>
            <div id="items-container"></div>
        </div>
    </div>
</div>

<!-- ======================= ITEM MODAL (PARENT) ======================= -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة / تعديل عنصر</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editIndex" />
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-2">
                            <label class="form-label">العنوان <span class="text-danger">*</span></label>
                            <input id="itemTitle" class="form-control" placeholder="عنوان واضح" />
                        </div>

                        <!-- Writer Selection Field - FIXED -->
                        <div class="mb-2">
                            <label class="form-label">الكاتب <span class="text-danger">*</span></label>
                            <select id="itemWriter" class="form-control">
                                <option value="">اختر كاتب</option>
                                @foreach ($writers as $writer)
                                    <option value="{{ $writer->name }}">{{ $writer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">الرابط <small class="text-muted" id="itemLinkNote">(مطلوب في
                                    وضع ملف)</small></label>
                            <input id="itemLinkUrl" class="form-control" placeholder="https://..." />
                        </div>

                        <div class="mb-2">
                            <label class="form-label">الوسائط <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <input id="itemMediaUrl" class="form-control" placeholder="لم يتم الاختيار" readonly>
                                <button type="button" class="btn btn-outline-secondary" id="btnPickMedia"><i
                                        class="fa fa-images"></i></button>
                                <button type="button" class="btn btn-outline-danger" id="btnClearMedia"
                                    title="مسح"><i class="fa fa-xmark"></i></button>
                            </div>
                            <input type="hidden" id="itemMediaId">
                            <input type="hidden" id="itemMediaTitle">
                            <input type="hidden" id="itemMediaAlt">
                            <div id="itemMediaPreview" class="mt-2"></div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">الوصف <span class="text-danger">*</span></label>
                            <textarea id="itemDescription" class="form-control tinymce-simple" rows="4"></textarea>
                        </div>

                        <script src="https://cdn.tiny.cloud/1/vw6sltzauw9x6b3cl3eby8nj99q4eoavzv581jnnmabxbhq2/tinymce/6/tinymce.min.js"
                            referrerpolicy="origin"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Enhanced theme detection
                                function getPreferredTheme() {
                                    const stored = localStorage.getItem('theme');
                                    if (stored) return stored;
                                    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                                }

                                const theme = getPreferredTheme();

                                tinymce.init({
                                    selector: 'textarea#itemDescription',
                                    directionality: 'rtl',
                                    height: 600,
                                    promotion: false,
                                    onboarding: false,

                                    // 🚫 Disable auto focus
                                    auto_focus: '',

                                    // Dark/light mode
                                    skin: theme === 'dark' ? 'oxide-dark' : 'oxide',
                                    content_css: theme === 'dark' ? 'dark' : 'default',

                                    // Plugins
                                    plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print save searchreplace table visualblocks visualchars wordcount',

                                    // Show all tools without collapsing
                                    toolbar_mode: 'expand',

                                    // Toolbar (added twitterEmbed button)
                                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | code fullscreen wordcount searchreplace | link table image media blockquote twitterEmbed | bullist numlist | copy cut paste selectall pastetext | removeformat subscript superscript charmap emoticons insertdatetime pagebreak preview print visualblocks visualchars help',

                                    // Font families & sizes (pt based)
                                    fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 36pt',
                                    font_family_formats: 'Arial=arial,helvetica,sans-serif; Helvetica=helvetica; Times New Roman=times new roman,times; Courier New=courier new,courier;',

                                    // Default style applied to content
                                    content_style: 'body { font-family: Arial, Helvetica, sans-serif; font-size:18pt; line-height:1.6; }',

                                    // Setup - FIXED with skip_focus
                                    setup: (editor) => {
                                        // Default font on init - USING skip_focus: true
                                        editor.on('init', () => {
                                            editor.execCommand('FontName', false, 'Arial', {
                                                skip_focus: true
                                            });
                                            editor.execCommand('FontSize', false, '18pt', {
                                                skip_focus: true
                                            });
                                        });

                                        // ✅ Enhanced Twitter Embed button with validation
                                        editor.ui.registry.addButton('twitterEmbed', {
                                            text: 'Twitter',
                                            tooltip: 'Embed Twitter Post',
                                            onAction: () => {
                                                editor.windowManager.open({
                                                    title: 'Embed Twitter Post',
                                                    body: {
                                                        type: 'panel',
                                                        items: [{
                                                            type: 'textarea',
                                                            name: 'embed',
                                                            label: 'Paste Twitter embed code here',
                                                            placeholder: '<blockquote class="twitter-tweet">...</blockquote>'
                                                        }]
                                                    },
                                                    buttons: [{
                                                            type: 'cancel',
                                                            text: 'Cancel'
                                                        },
                                                        {
                                                            type: 'submit',
                                                            text: 'Insert',
                                                            primary: true,
                                                            enabled: false
                                                        }
                                                    ],
                                                    onChange: (api) => {
                                                        const data = api.getData();
                                                        const isValid = data.embed.includes(
                                                            'twitter-tweet');
                                                        api.blocking.set('submit', !isValid);
                                                    },
                                                    onSubmit: (api) => {
                                                        const data = api.getData();
                                                        const embedCode = data.embed.trim();

                                                        // Enhanced validation for Twitter embed
                                                        if (!embedCode.includes('twitter-tweet')) {
                                                            editor.windowManager.alert(
                                                                'Please enter a valid Twitter embed code containing "twitter-tweet"'
                                                            );
                                                            return;
                                                        }

                                                        editor.insertContent(embedCode, {
                                                            skip_focus: true
                                                        });
                                                        api.close();
                                                    }
                                                });
                                            }
                                        });
                                    },

                                    // Security enhancement
                                    paste_preprocess: (plugin, args) => {
                                        // Clean pasted content from potential XSS
                                        args.content = args.content.replace(
                                            /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
                                    },

                                    // Enhanced file upload with size validation
                                    file_picker_types: 'image',
                                    file_picker_callback: (cb, value, meta) => {
                                        const input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');

                                        input.onchange = function() {
                                            const file = this.files[0];

                                            // File size validation (5MB limit)
                                            if (file.size > 5 * 1024 * 1024) {
                                                alert('File size too large. Please select a file smaller than 5MB.');
                                                return;
                                            }

                                            const reader = new FileReader();
                                            reader.onload = function() {
                                                const id = 'blobid' + (new Date()).getTime();
                                                const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                                const base64 = reader.result.split(',')[1];
                                                const blobInfo = blobCache.create(id, file, base64);
                                                blobCache.add(blobInfo);

                                                cb(blobInfo.blobUri(), {
                                                    title: file.name
                                                });
                                            };
                                            reader.readAsDataURL(file);
                                        };

                                        input.click();
                                    },

                                    // Menubar
                                    menubar: 'file edit view insert format tools table help',

                                    // Other settings
                                    editimage_cors_hosts: ['picsum.photos'],
                                    autosave_ask_before_unload: true,
                                    autosave_interval: '30s',
                                    autosave_prefix: '{path}{query}-{id}-',
                                    autosave_restore_when_empty: false,
                                    autosave_retention: '2m',
                                    image_advtab: true,
                                    image_caption: true,
                                    noneditable_class: 'mceNonEditable',
                                    contextmenu: 'link image table',

                                    // 🚀 Allow Twitter / embed tags
                                    extended_valid_elements: 'script[src|async|charset],blockquote[class|lang|dir],iframe[src|width|height|frameborder|allowfullscreen]',
                                    valid_children: '+body[script],+div[script]',
                                    valid_elements: '*[*]',

                                    // Remove branding for better UX
                                    branding: false
                                }).catch(error => {
                                    console.error('TinyMCE initialization error:', error);
                                });
                            });

                            // Theme toggle function (if needed elsewhere)
                            function toggleTheme() {
                                const currentTheme = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';
                                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                                localStorage.setItem('theme', newTheme);
                                location.reload();
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-sticky">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button id="saveItemBtn" type="button" class="btn btn-success mx-2">
                    <i class="fa fa-floppy-disk me-1"></i> حفظ العنصر
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ======================= DEP: Sortable ======================= -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<!-- ======================= MAIN ITEMS LOGIC ======================= -->
<script>
    (function() {
        const rootTab = document.getElementById('contentTab');
        const mainForm = rootTab ? rootTab.closest('form') : null;
        const hiddenInputsContainer = document.getElementById('list-items-hidden-inputs');

        const displayMethodRadios = document.querySelectorAll('input[name="display_method"]');
        const dynamicSection = document.getElementById('dynamic-items-section');
        const addBtn = document.getElementById('add-item-btn');
        const clearAllBtn = document.getElementById('clear-all-btn');

        const container = document.getElementById('items-container');
        const modalEl = document.getElementById('itemModal');

        const editIndexInput = document.getElementById('editIndex');
        const saveBtn = document.getElementById('saveItemBtn');
        const titleEl = document.getElementById('itemTitle');
        const descEl = document.getElementById('itemDescription');
        const linkEl = document.getElementById('itemLinkUrl');
        const linkNote = document.getElementById('itemLinkNote');
        const writerEl = document.getElementById('itemWriter'); // Writer select element

        const inpUrl = document.getElementById('itemMediaUrl');
        const inpId = document.getElementById('itemMediaId');
        const inpTitle = document.getElementById('itemMediaTitle');
        const inpAlt = document.getElementById('itemMediaAlt');
        const prev = document.getElementById('itemMediaPreview');

        // Nettoyage backdrops Bootstrap si besoin
        if (window.bootstrap && modalEl) {
            modalEl.addEventListener('hidden.bs.modal', cleanupBackdrops);
            modalEl.addEventListener('hide.bs.modal', cleanupBackdrops);
        }

        function cleanupBackdrops() {
            try {
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.documentElement.style.overflow = '';
            } catch (e) {}
        }

        let items = [];
        let currentModeName = 'simple';

        function refreshLinkNote() {
            if (!linkNote) return;
            if (currentModeName === 'file') {
                linkNote.textContent = '(مطلوب في وضع ملف)';
                linkEl?.setAttribute('aria-required', 'true');
            } else {
                linkNote.textContent = '(اختياري إلا في وضع ملف)';
                linkEl?.removeAttribute('aria-required');
            }
        }

        function toggleSection() {
            const show = (currentModeName === 'list' || currentModeName === 'file');
            dynamicSection.style.display = show ? 'block' : 'none';
            refreshLinkNote();
        }

        function switchMode(m) {
            if (m === currentModeName) return;
            currentModeName = m;
            renderItems();
            toggleSection();
        }

        function renderPreview() {
            prev.textContent = '';
            const url = (inpUrl.value || '').trim();
            if (!url) return;
            const lower = url.toLowerCase();
            if (/\.(jpg|jpeg|png|webp|gif|bmp|svg)(\?|$)/.test(lower)) {
                const img = new Image();
                img.src = url;
                img.alt = inpAlt.value || inpTitle.value || '';
                img.style.maxHeight = '140px';
                img.loading = 'lazy';
                prev.appendChild(img);
            } else if (/\.(mp4|webm|mkv|mov|m4v)(\?|$)/.test(lower)) {
                const v = document.createElement('video');
                v.src = url;
                v.controls = true;
                v.style.maxHeight = '140px';
                prev.appendChild(v);
            } else if (/\.(mp3|wav|ogg|m4a|flac|aac)(\?|$)/.test(lower)) {
                const a = document.createElement('audio');
                a.src = url;
                a.controls = true;
                prev.appendChild(a);
            } else {
                const a = document.createElement('a');
                a.href = url;
                a.target = '_blank';
                a.textContent = 'فتح الملف';
                prev.appendChild(a);
            }
        }

        const getTinyHtml = id => (window.tinymce && tinymce.get(id)) ? tinymce.get(id).getContent() : (document
            .getElementById(id)?.value || '').trim();
        const getTinyText = id => (window.tinymce && tinymce.get(id)) ? tinymce.get(id).getContent({
            format: 'text'
        }).replace(/\s+/g, ' ').trim() : (document.getElementById(id)?.value || '').replace(/\s+/g, ' ').trim();

        function textFromHtml(html) {
            const tmp = document.createElement('div');
            tmp.innerHTML = html || '';
            return (tmp.textContent || '').replace(/\s+/g, ' ').trim();
        }

        // ===== Rendu des items (inclut mx sur les boutons) =====
        function _renderItemsInternal() {
            container.textContent = '';
            if (!items.length) {
                const emp = document.createElement('div');
                emp.style.color = 'var(--az-muted)';
                emp.style.border = '1px dashed var(--az-border)';
                emp.style.borderRadius = '0';
                emp.style.padding = '16px';
                emp.textContent = 'لا توجد عناصر بعد. أضف أول عنصر.';
                container.appendChild(emp);
                return;
            }
            items.forEach((it, i) => {
                const card = document.createElement('div');
                card.className = 'az-item-card';
                card.dataset.item = String(i);

                const row = document.createElement('div');
                row.className = 'az-item-row';

                const left = document.createElement('div');
                left.className = 'az-left';

                const drag = document.createElement('div');
                drag.className = 'az-drag no-select';
                drag.innerHTML = '<i class="fa fa-grip-vertical"></i>';
                left.appendChild(drag);

                const thumb = document.createElement('div');
                thumb.className = 'az-thumb';
                const u = it.image || '';
                const isImg = /\.(jpg|jpeg|png|webp|gif|bmp|svg)(\?|$)/i.test(u);
                const isVid = /\.(mp4|webm|mkv|mov|m4v)(\?|$)/i.test(u);
                if (isImg) {
                    const im = new Image();
                    im.src = u;
                    im.loading = 'lazy';
                    im.alt = it.media_alt || it.media_title || it.title || '';
                    thumb.appendChild(im);
                } else if (isVid) {
                    const v = document.createElement('video');
                    v.src = u;
                    v.muted = true;
                    v.preload = 'metadata';
                    thumb.appendChild(v);
                } else {
                    thumb.innerHTML = '<i class="fa fa-file-lines"></i>';
                }
                left.appendChild(thumb);

                const meta = document.createElement('div');
                meta.className = 'az-meta';
                const t = document.createElement('div');
                t.className = 'az-title text-ellipsis';
                t.textContent = it.title || 'بدون عنوان';

                // Display writer name - FIXED: Use correct property name
                const writerInfo = document.createElement('div');
                writerInfo.className = 'az-desc text-ellipsis';
                const writerName = it.writer_name || it.writer || 'غير محدد';
                writerInfo.textContent = `الكاتب: ${writerName}`;

                const d = document.createElement('div');
                d.className = 'az-desc text-ellipsis';
                d.textContent = textFromHtml(it.description || '');

                meta.appendChild(t);
                meta.appendChild(writerInfo);
                meta.appendChild(d);
                left.appendChild(meta);

                const right = document.createElement('div');
                right.className = 'az-actions d-flex align-items-center';
                right.style.gap = '.25rem';

                const editBtn = document.createElement('button');
                editBtn.type = 'button';
                editBtn.className = 'btn btn-sm btn-outline-primary mx-1';
                editBtn.innerHTML = '<i class="fa fa-pen"></i> تعديل';
                editBtn.addEventListener('click', () => {
                    editIndexInput.value = String(i);
                    titleEl.value = it.title || '';
                    if (window.tinymce && tinymce.get('itemDescription')) {
                        tinymce.get('itemDescription').setContent(it.description || '');
                    } else {
                        const txt = document.getElementById('itemDescription');
                        if (txt) txt.value = it.description || '';
                    }
                    linkEl.value = it.url || '';
                    inpId.value = it.media_id || '';
                    inpUrl.value = it.image || '';
                    inpTitle.value = it.media_title || '';
                    inpAlt.value = it.media_alt || '';

                    // FIXED: Enhanced writer selection with multiple property fallbacks
                    if (writerEl) {
                        // Try multiple possible property names for writer
                        const writerValue = it.writer_name || it.writer || it.author_name || it
                            .author || '';
                        console.log('Setting writer select to:', writerValue, 'from item:', it);
                        writerEl.value = writerValue;
                    }

                    renderPreview();

                    if (window.bootstrap && bootstrap.Modal) {
                        bootstrap.Modal.getOrCreateInstance(modalEl).show();
                    } else {
                        modalEl.style.display = 'block';
                        modalEl.setAttribute('aria-hidden', 'false');
                    }
                });

                const delBtn = document.createElement('button');
                delBtn.type = 'button';
                delBtn.className = 'btn btn-sm btn-outline-danger mx-1';
                delBtn.innerHTML = '<i class="fa fa-trash"></i> حذف';
                delBtn.addEventListener('click', () => {
                    items.splice(i, 1);
                    renderItems();
                });

                const badge = document.createElement('span');
                badge.className = 'circle-number';
                badge.textContent = String(i + 1);

                right.appendChild(editBtn);
                right.appendChild(delBtn);
                right.appendChild(badge);

                row.appendChild(left);
                row.appendChild(right);
                card.appendChild(row);
                container.appendChild(card);
            });
        }

        // Expose / redefine renderItems globally to keep compatibility
        window.renderItems = _renderItemsInternal;

        // Radios
        displayMethodRadios.forEach(r => r.addEventListener('change', e => switchMode(e.target.value)));

        // Pick media with MMxx modal (fermer puis ré-ouvrir le modal item)
        const btnPick = document.getElementById('btnPickMedia');
        const btnClear = document.getElementById('btnClearMedia');

        // Global item modal manager
        window.itemModalManager = {
            reopenItemModal: function() {
                setTimeout(() => {
                    if (window.bootstrap && bootstrap.Modal) {
                        bootstrap.Modal.getOrCreateInstance(modalEl).show();
                    } else {
                        modalEl.style.display = 'block';
                        modalEl.setAttribute('aria-hidden', 'false');
                    }
                }, 150);
            }
        };

        btnPick?.addEventListener('click', () => {
            if (!window.mmxxMediaModalManager) {
                alert('MMxx Media Modal غير محمّل');
                return;
            }

            // Ferme le modal parent d'abord
            if (window.bootstrap && bootstrap.Modal) {
                const itemModalInstance = bootstrap.Modal.getInstance(modalEl) || bootstrap.Modal
                    .getOrCreateInstance(modalEl);
                itemModalInstance.hide();
            } else {
                modalEl.style.display = 'none';
                modalEl.setAttribute('aria-hidden', 'true');
                cleanupBackdrops();
            }

            // Callback sélection media
            window.mmxxMediaModalManager.onMediaSelected = function(media) {
                if (!media || !media.url) {
                    alert('لا يمكن استخدام هذا الوسيط');
                    return;
                }
                inpId.value = media.id || '';
                inpUrl.value = media.url || '';
                inpTitle.value = media.title || '';
                inpAlt.value = media.alt || '';
                renderPreview();

                // Ré-ouvrir le modal parent
                setTimeout(() => {
                    if (window.bootstrap && bootstrap.Modal) {
                        bootstrap.Modal.getOrCreateInstance(modalEl).show();
                    } else {
                        modalEl.style.display = 'block';
                        modalEl.setAttribute('aria-hidden', 'false');
                    }
                }, 300);
            };

            // Ouvrir MMxx
            setTimeout(() => {
                window.mmxxMediaModalManager.openModal();
            }, 150);
        });

        btnClear?.addEventListener('click', () => {
            inpId.value = '';
            inpUrl.value = '';
            inpTitle.value = '';
            inpAlt.value = '';
            prev.textContent = '';
        });

        addBtn?.addEventListener('click', () => {
            editIndexInput.value = '';
            titleEl.value = '';
            linkEl.value = '';
            if (window.tinymce && tinymce.get('itemDescription')) tinymce.get('itemDescription').setContent(
                '');
            inpId.value = '';
            inpUrl.value = '';
            inpTitle.value = '';
            inpAlt.value = '';
            // Reset writer selection
            if (writerEl) {
                writerEl.value = '';
            }
            prev.textContent = '';
        });

        // Save item - FIXED writer handling
        saveBtn?.addEventListener('click', () => {
            const mode = currentModeName;
            const title = (titleEl.value || '').trim();
            const descriptionText = getTinyText('itemDescription');
            const descriptionHTML = getTinyHtml('itemDescription');
            const imageUrl = (inpUrl.value || '').trim();
            const linkUrl = (linkEl.value || '').trim();
            const writerName = writerEl ? writerEl.value : ''; // Get writer name directly

            if (!title) return alert('العنوان مطلوب');
            if (!descriptionText) return alert('الوصف مطلوب');
            if (!imageUrl) return alert('الصورة مطلوبة');
            if (!writerName) return alert('الكاتب مطلوب'); // Validate writer
            if (mode === 'file' && !linkUrl) return alert('الرابط مطلوب في وضع ملف');

            const payload = {
                title,
                description: descriptionHTML,
                image: imageUrl,
                url: linkUrl || null,
                media_id: inpId.value || null,
                media_title: inpTitle.value || '',
                media_alt: inpAlt.value || '',
                writer_name: writerName // Use writer_name directly
            };

            if (editIndexInput.value !== '') {
                const idx = parseInt(editIndexInput.value, 10);
                if (Number.isFinite(idx) && idx >= 0 && idx < items.length) items[idx] = payload;
            } else {
                items.push(payload);
            }
            renderItems();

            if (window.bootstrap && bootstrap.Modal) {
                bootstrap.Modal.getOrCreateInstance(modalEl).hide();
            } else {
                modalEl.style.display = 'none';
                modalEl.setAttribute('aria-hidden', 'true');
            }
            cleanupBackdrops();
        });

        // Sortable
        if (container) {
            new Sortable(container, {
                animation: 150,
                handle: '.az-drag',
                onEnd: e => {
                    const o = e.oldIndex,
                        n = e.newIndex;
                    if (!Number.isFinite(o) || !Number.isFinite(n)) return;
                    const m = items.splice(o, 1)[0];
                    items.splice(n, 0, m);
                    renderItems();
                }
            });
        }

        // Clear All
        if (clearAllBtn) {
            // reset listeners if script re-injecté
            const clone = clearAllBtn.cloneNode(true);
            clearAllBtn.parentNode.replaceChild(clone, clearAllBtn);
            clone.addEventListener('click', () => {
                if (!items.length) {
                    alert('لا توجد عناصر لحذفها.');
                    return;
                }
                if (!confirm('هل تريد حذف جميع العناصر؟ لا يمكن التراجع.')) return;
                items = [];
                renderItems();
            });
        }

        // Init - FIXED: Properly load writer data from server
        (function init() {
            // Get initial data from server using your controller variables
            const templateData = {
                display_method: "{{ $content->display_method ?? 'simple' }}",
                items: @json($contentItems ?? [])
            };

            // Set display method
            currentModeName = templateData.display_method;
            const displayMethodRadio = document.querySelector(
                `input[name="display_method"][value="${templateData.display_method}"]`);
            if (displayMethodRadio) {
                displayMethodRadio.checked = true;
            }

            // Load items if they exist - map from your contentLists structure with writer support
            if (templateData.items && templateData.items.length > 0) {
                items = templateData.items.map(item => ({
                    title: item.title || '',
                    description: item.description || '',
                    image: item.image || '',
                    url: item.url || '',
                    media_id: item.media_id || '',
                    media_title: item.media_title || '',
                    media_alt: item.media_alt || '',
                    writer_name: item.writer_name || item.writer ||
                        '' // Support multiple property names
                }));

                // Debug: Log loaded items to verify writer data
                console.log('Loaded items with writer data:', items);
            }

            toggleSection();
            renderItems();
        })();

        // Generate hidden inputs for form submission
        function generateHiddenInputs() {
            hiddenInputsContainer.innerHTML = '';

            // Add display method
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = 'display_method';
            methodInput.value = currentModeName;
            hiddenInputsContainer.appendChild(methodInput);

            // Add items as JSON
            const itemsInput = document.createElement('input');
            itemsInput.type = 'hidden';
            itemsInput.name = 'items';
            itemsInput.value = JSON.stringify(items);
            hiddenInputsContainer.appendChild(itemsInput);
        }

        // Call this before form submission
        if (mainForm) {
            mainForm.addEventListener('submit', function(e) {
                generateHiddenInputs();
            });
        }
    })();
</script>

<!-- ======================= ZERO RADIUS OVERRIDES (GLOBAL) ======================= -->
<style>
    /* Zéro arrondi global et cohérent */
    :root {
        --az-radius: 0 !important;
    }

    /* Composants AZ sans arrondi */
    .az-item-card,
    .az-thumb,
    #itemMediaPreview img,
    #itemMediaPreview video,
    .form-control,
    .btn,
    .input-group .form-control,
    .input-group .btn,
    .modal-content,
    .modal-header,
    .modal-body,
    .modal-footer,
    .empty-state,
    .circle-number {
        border-radius: 0 !important;
    }

    /* MMxx modal : forcer zéro arrondi partout */
    #mmxxMediaModal,
    #mmxxMediaModal * {
        border-radius: 0 !important;
    }

    /* Espacement doux entre boutons d'action (en plus des mx-1) */
    .az-actions {
        gap: .25rem;
    }
</style>
