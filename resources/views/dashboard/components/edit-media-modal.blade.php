<!-- ================== xmm MEDIA MODAL (FULL, FIXED, TYPE BADGE, NO SUCCESS ALERTS) ================== -->
<!-- Sprite d’icônes (optionnel) -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
    <symbol id="xmm-icon-image" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <circle cx="8" cy="10" r="1.5" fill="currentColor" />
        <path d="M21 19l-5.5-7-4.5 6-3-4-4 5" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="xmm-icon-video" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
    <symbol id="xmm-icon-voice" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <rect x="9" y="7" width="2" height="10" rx="1" fill="currentColor" />
        <rect x="13" y="11" width="2" height="6" rx="1" fill="currentColor" />
    </symbol>
    <symbol id="xmm-icon-file" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <path d="M9 7h6M9 11h6M9 15h2" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="xmm-icon-youtube" viewBox="0 0 24 24">
        <rect x="2" y="6" width="20" height="12" rx="4" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
</svg>

<!-- CSRF -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="xmmMediaModal" class="xmm-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="xmmMediaModalTitle">
    <div class="xmm-backdrop" data-xmm-backdrop></div>
    <div class="xmm-container" role="document">
        <div class="xmm-header">
            <h5 id="xmmMediaModalTitle">اختر الوسائط</h5>
            <button class="xmm-close" type="button" data-xmm-close aria-label="إغلاق">&times;</button>
        </div>

        <!-- Tabs -->
        <div class="xmm-tabs" role="tablist" aria-label="أقسام إدارة الوسائط">
            <button type="button" class="xmm-tab-btn xmm-is-active" role="tab" aria-selected="true"
                aria-controls="xmm-tab-gallery" id="xmm-tabbtn-gallery" tabindex="0"
                data-xmm-tab="gallery">المعرض</button>
            <button type="button" class="xmm-tab-btn" role="tab" aria-selected="false"
                aria-controls="xmm-tab-upload" id="xmm-tabbtn-upload" tabindex="-1" data-xmm-tab="upload">الرفع من
                الجهاز</button>
            <button type="button" class="xmm-tab-btn" role="tab" aria-selected="false"
                aria-controls="xmm-tab-import" id="xmm-tabbtn-import" tabindex="-1" data-xmm-tab="import">الاستيراد
                بالرابط</button>
        </div>

        <!-- Gallery -->
        <section id="xmm-tab-gallery" class="xmm-tab-panel" role="tabpanel" aria-labelledby="xmm-tabbtn-gallery">
            <div class="xmm-filters">
                <input type="text" id="xmm-search" placeholder="ابحث عن وسائط..." />
                <select id="xmm-type-filter" aria-label="نوع الوسائط">
                    <option value="all">كل الوسائط</option>
                    <option value="image">صورة</option>
                    <option value="video">فيديو</option>
                    <option value="voice">صوت</option>
                    <option value="file">ملف</option>
                </select>
            </div>

            <div class="xmm-body">
                <div id="xmm-list" class="xmm-grid"></div>
                <div id="xmm-loader" class="xmm-loader" hidden>جاري التحميل...</div>
            </div>
            <nav id="xmm-pagination" class="xmm-pagination" aria-label="ترقيم الصفحات"></nav>

            <div class="xmm-footer">
                <button class="xmm-btn xmm-btn-select" type="button" id="xmm-btn-select">اختر</button>
                <button class="xmm-btn xmm-btn-cancel" type="button" data-xmm-close>إلغاء</button>
            </div>
        </section>

        <!-- Upload -->
        <section id="xmm-tab-upload" class="xmm-tab-panel" role="tabpanel" aria-labelledby="xmm-tabbtn-upload"
            hidden>
            <div class="xmm-tab-body">
                <div class="xmm-uploader">
                    <div class="xmm-upload-fields" style="display: flex; flex-wrap: wrap; gap: .6rem; width: 100%;">
                        <div style="flex: 1 1 220px;">
                            <label for="xmm-upload-input" id="xmm-upload-label"
                                style="display: block; width: 100%; cursor: pointer; padding: .6rem .7rem; border: 1px solid #dcdcdc; border-radius: 0; background: #fafafa; color: #333; text-align: center; transition: all 0.2s;">
                                <i class="fa fa-upload" style="margin-right: 6px;"></i>
                                <span id="xmm-upload-label-text">اختر ملف الوسائط</span>
                                <input type="file" id="xmm-upload-input" class="xmm-upload-input"
                                    style="display: none;" />
                            </label>
                        </div>
                        <div style="flex: 1 1 200px;">
                            <input type="text" id="xmm-upload-name" class="xmm-upload-name"
                                placeholder="اسم الملف"
                                style="width: 100%; padding: .6rem .7rem; border: 1px solid #dcdcdc; border-radius: 0; background: #fff;" />
                        </div>
                        <div style="flex: 1 1 200px;">
                            <input type="text" id="xmm-upload-alt" class="xmm-upload-alt"
                                placeholder="النص البديل"
                                style="width: 100%; padding: .6rem .7rem; border: 1px solid #dcdcdc; border-radius: 0; background: #fff;" />
                        </div>
                    </div>
                    <div class="xmm-uploader-actions">
                        <button class="xmm-btn xmm-btn-secondary" type="button" id="xmm-btn-upload-to-gallery"
                            title="إدراج في المعرض">إدراج في المعرض</button>
                        <button class="xmm-btn xmm-btn-primary" type="button" id="xmm-btn-upload-and-select-close"
                            title="إدراج في المقال">إدراج في المقال</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Import by URL -->
        <section id="xmm-tab-import" class="xmm-tab-panel" role="tabpanel" aria-labelledby="xmm-tabbtn-import"
            hidden>
            <div class="xmm-tab-body">
                <div class="xmm-uploader xmm-uploader-url"
                    style="padding:1.2rem; border-radius:8px; background:#fafbfc; border:1px solid var(--xmm-border); box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display:flex; flex-wrap:wrap; gap:.7rem; margin-bottom:.7rem;">
                        <input type="text" id="xmm-upload-url"
                            style="flex:1 1 220px; padding:.7rem 1rem; border:1px solid #dcdcdc; border-radius:6px; background:#fff; font-size:1rem;"
                            placeholder="الرابط" />
                        <input type="text" id="xmm-url-name" placeholder="اسم الملف"
                            style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid #dcdcdc; border-radius:6px; background:#fff; font-size:1rem;" />
                        <input type="text" id="xmm-url-alt" placeholder="النص البديل"
                            style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid #dcdcdc; border-radius:6px; background:#fff; font-size:1rem;" />
                    </div>
                    <fieldset class="xmm-url-type-group" aria-label="نوع الوسائط للرابط"
                        style="margin-bottom:.7rem; border-radius:6px; border:1px solid #e5e7eb; padding:.7rem 1rem; background:#fff;">
                        <legend style="font-size:.97rem; color:#333; padding:0 .3rem; font-weight:500;">نوع الوسائط
                            (اختياري)</legend>
                        <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
                            <label class="xmm-radio" style="font-size:.97rem;"><input type="radio"
                                    name="xmm-url-type" value="auto" checked /><span>Auto</span></label>
                            <label class="xmm-radio" style="font-size:.97rem;"><input type="radio"
                                    name="xmm-url-type" value="image" /><span>Image</span></label>
                            <label class="xmm-radio" style="font-size:.97rem;"><input type="radio"
                                    name="xmm-url-type" value="video" /><span>Video</span></label>
                            <label class="xmm-radio" style="font-size:.97rem;"><input type="radio"
                                    name="xmm-url-type" value="voice" /><span>Voice</span></label>
                            <label class="xmm-radio" style="font-size:.97rem;"><input type="radio"
                                    name="xmm-url-type" value="file" /><span>File</span></label>
                        </div>
                    </fieldset>
                    <div class="xmm-uploader-actions" style="display:flex; gap:.7rem; margin-bottom:.7rem;">
                        <button class="xmm-btn xmm-btn-secondary" type="button" id="xmm-btn-import-to-gallery"
                            title="استيراد بالرابط ثم عرض في المعرض"
                            style="border-radius:6px; font-size:1rem; padding:.7rem 1.2rem;">إدراج في المعرض
                        </button>
                        <button class="xmm-btn xmm-btn-primary" type="button" id="xmm-btn-import-and-select-close"
                            title="استيراد بالرابط ثم حفظ وإغلاق"
                            style="border-radius:6px; font-size:1rem; padding:.7rem 1.2rem;">إدراج في المقال</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    /* ===== xmm NAMESPACE – neutral white/grey, no rounded corners ===== */
    #xmmMediaModal,
    #xmmMediaModal * {
        box-sizing: border-box;
    }

    #xmmMediaModal * {
        border-radius: 0 !important;
    }

    :root {
        --xmm-bg: #fff;
        --xmm-text: #111;
        --xmm-border: #e5e7eb;
        --xmm-ring: #d1d5db;
        --xmm-muted: #6b7280;
        --xmm-black: #111;
        --xmm-black-strong: #000;
    }

    .xmm-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 10000;
    }

    .xmm-modal[aria-hidden="false"] {
        display: block;
    }

    .xmm-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        z-index: 0;
    }

    .xmm-container {
        position: absolute;
        inset: auto 0;
        top: 5%;
        margin: 0 auto;
        width: clamp(320px, 92vw, 1000px);
        max-height: 90%;
        background: var(--xmm-bg);
        color: var(--xmm-text);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        animation: xmmFade .2s ease-out;
    }

    @keyframes xmmFade {
        from {
            opacity: 0;
            transform: translateY(-14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .xmm-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--xmm-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
    }

    .xmm-header h5 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 600;
    }

    .xmm-close {
        font-size: 1.4rem;
        line-height: 1;
        border: 0;
        background: transparent;
        color: #666;
        cursor: pointer;
    }

    .xmm-close:hover {
        color: #000;
    }

    .xmm-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--xmm-border);
        background: #fff;
    }

    .xmm-tab-btn {
        appearance: none;
        background: #fff;
        border: 1px solid var(--xmm-border);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--xmm-text);
    }

    .xmm-tab-btn:focus {
        outline: 2px solid var(--xmm-ring);
        outline-offset: 1px;
    }

    .xmm-tab-btn.xmm-is-active {
        border-color: #dcdcdc;
    }

    .xmm-tab-panel {
        display: block;
    }

    .xmm-tab-panel[hidden] {
        display: none;
    }

    .xmm-tab-body {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--xmm-border);
        background: #fff;
    }

    .xmm-filters {
        padding: 1rem 1.25rem;
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--xmm-border);
        background: #fff;
    }

    .xmm-filters input,
    .xmm-filters select {
        padding: .6rem .7rem;
        font-size: .95rem;
        border: 1px solid #dcdcdc;
        background: #fff;
        color: var(--xmm-text);
        flex: 1 1 180px;
        transition: box-shadow .15s, border-color .15s;
    }

    .xmm-filters input::placeholder {
        color: var(--xmm-muted);
    }

    .xmm-filters input:focus,
    .xmm-filters select:focus {
        border-color: #cfcfcf;
        box-shadow: 0 0 0 2px var(--xmm-ring);
        outline: none;
    }

    .xmm-body {
        padding: 1rem 1.25rem;
        overflow: auto;
        flex: 1;
        background: #fff;
        min-height: 0;
    }

    .xmm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: .9rem;
    }

    .xmm-empty {
        text-align: center;
        color: var(--xmm-muted);
        font-size: .95rem;
        margin: 2rem 0;
    }

    .xmm-item {
        position: relative;
        border: 1px solid var(--xmm-border);
        background: #fff;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: .6rem;
        transition: border-color .15s, transform .04s ease, box-shadow .15s;
    }

    .xmm-item:hover {
        border-color: #cfcfcf;
        box-shadow: 0 0 0 3px #f3f4f6;
    }

    .xmm-item:active {
        transform: scale(.995);
    }

    .xmm-item.xmm-is-selected {
        border-color: #cfcfcf;
        box-shadow: 0 0 0 3px #e5e7eb;
    }


    .xmm-title {
        font-size: .9rem;
        color: #374151;
        margin-top: .55rem;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .xmm-uploader {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .6rem;
        background: #fff;
        border: 1px solid var(--xmm-border);
        padding: 1rem;
    }

    .xmm-uploader-url {
        border-style: solid;
    }

    #xmm-upload-input {
        flex: 1 1 220px;
    }

    #xmm-upload-name,
    #xmm-upload-alt {
        flex: 1 1 200px;
    }

    #xmm-upload-url,
    #xmm-url-name,
    #xmm-url-alt {
        flex: 1 1 220px;
    }

    /* NEW: URL type radios */
    .xmm-url-type-group {
        width: 100%;
        margin: .2rem 0 .4rem;
        border: 1px solid var(--xmm-border);
        padding: .6rem .8rem;
    }

    .xmm-url-type-group legend {
        font-size: .9rem;
        color: #333;
        padding: 0 .25rem;
    }

    .xmm-radio {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        margin-inline-end: 1rem;
        cursor: pointer;
    }

    .xmm-radio input {
        accent-color: #000;
    }

    .xmm-uploader-actions {
        display: flex;
        gap: .6rem;
    }

    .xmm-btn {
        padding: .6rem 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        border: 1px solid var(--xmm-black);
        background: var(--xmm-black);
        color: #fff;
    }

    .xmm-btn:hover {
        background: var(--xmm-black-strong);
        border-color: var(--xmm-black-strong);
    }

    .xmm-btn-secondary {
        background: #444;
        border-color: #444;
    }

    .xmm-btn-secondary:hover {
        background: #222;
        border-color: #222;
    }

    .xmm-btn-primary {
        background: var(--xmm-black);
        border-color: var(--xmm-black);
    }

    .xmm-footer {
        padding: 1rem 1.25rem;
        background: #fff;
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        border-top: 1px solid var(--xmm-border);
    }

    .xmm-btn-select {
        background: #fff;
        color: var(--xmm-black);
        border-color: var(--xmm-black);
    }

    .xmm-btn-select:hover {
        background: #f5f5f5;
    }

    .xmm-btn-cancel {
        background: #444;
        border-color: #444;
        color: #fff;
    }

    .xmm-btn-cancel:hover {
        background: #222;
        border-color: #222;
    }

    .xmm-loader {
        text-align: center;
        color: var(--xmm-muted);
        padding: .75rem;
        font-size: .95rem;
    }

    .xmm-sentinel {
        height: 1px;
    }
    .xmm-pagination {
        display: flex;
        flex-wrap: wrap;
        gap: .35rem;
        justify-content: center;
        align-items: center;
        padding: .65rem 1rem;
        border-top: 1px solid var(--xmm-border, #dbdfea);
        background: var(--xmm-gray-100, #f3f4f8);
        flex-shrink: 0;
    }
    .xmm-pagination button {
        min-width: 36px;
        height: 34px;
        padding: 0 .7rem;
        border: 1px solid var(--xmm-border, #dbdfea) !important;
        background: var(--xmm-bg, #fff);
        color: var(--xmm-text, #526484);
        cursor: pointer;
        font-weight: 600;
        font-size: .9rem;
        border-radius: 6px !important;
        transition: background .15s, color .15s, border-color .15s, transform .05s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .xmm-pagination button:hover:not(:disabled) {
        background: var(--xmm-primary, #6576ff);
        border-color: var(--xmm-primary, #6576ff) !important;
        color: #fff;
    }
    .xmm-pagination button:active:not(:disabled) { transform: scale(.96); }
    .xmm-pagination button.xmm-page-active {
        background: var(--xmm-primary, #6576ff);
        border-color: var(--xmm-primary, #6576ff) !important;
        color: #fff;
        box-shadow: 0 2px 6px rgba(101, 118, 255, 0.35);
    }
    .xmm-pagination button:disabled { opacity: .45; cursor: not-allowed; }
    .xmm-pagination .xmm-page-ellipsis { padding: 0 .25rem; color: var(--xmm-muted, #8091a7); font-weight: 700; }
    .xmm-pagination .xmm-page-info {
        margin-inline-start: auto;
        font-size: .85rem;
        color: var(--xmm-muted, #8091a7);
        font-weight: 500;
    }
    @media (max-width: 600px) {
        .xmm-pagination .xmm-page-info { width: 100%; text-align: center; margin: .25rem 0 0; }
    }


    @media (max-width: 768px) {
        .xmm-container {
            top: 2%;
            max-height: 96%;
        }

        .xmm-tabs {
            flex-wrap: wrap;
        }

        .xmm-filters {
            flex-direction: column;
        }

        .xmm-filters input,
        .xmm-filters select,
        .xmm-uploader {
            width: 100%;
        }

        .xmm-uploader {
            flex-direction: column;
            align-items: stretch;
        }

        .xmm-uploader-actions {
            width: 100%;
        }

        .xmm-uploader-actions .xmm-btn {
            width: 100%;
        }
    }
</style>

<script>
    (() => {
        // ===== Endpoints =====
        const FETCH_URL = "{{ route('dashboard.media.getAllMediaPaginated') }}";
        const UPLOAD_URL = "{{ route('dashboard.media.store') }}";
        const IMPORT_URL = "{{ route('dashboard.media_url.store') }}"; // عرّفه عند وجود خدمة الاستيراد عبر الرابط

        const modal = document.getElementById("xmmMediaModal");
        const backdrop = modal.querySelector("[data-xmm-backdrop]");
        const closes = modal.querySelectorAll("[data-xmm-close]");
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        // Gallery
        const listEl = document.getElementById("xmm-list");
        const loaderEl = document.getElementById("xmm-loader");
        const paginationEl = document.getElementById("xmm-pagination");
        const searchInput = document.getElementById("xmm-search");
        const typeSelect = document.getElementById("xmm-type-filter");
        const btnSelect = document.getElementById("xmm-btn-select");

        // Upload
        const uploadInput = document.getElementById("xmm-upload-input");
        const uploadName = document.getElementById("xmm-upload-name");
        const uploadAlt = document.getElementById("xmm-upload-alt");
        const btnUploadToGallery = document.getElementById("xmm-btn-upload-to-gallery");
        const btnUploadSelectAndClose = document.getElementById("xmm-btn-upload-and-select-close");

        // Import URL
        const uploadUrlInput = document.getElementById("xmm-upload-url");
        const urlNameInput = document.getElementById("xmm-url-name");
        const urlAltInput = document.getElementById("xmm-url-alt");
        const btnImportToGallery = document.getElementById("xmm-btn-import-to-gallery");
        const btnImportSelectAndClose = document.getElementById("xmm-btn-import-and-select-close");
        const urlTypeRadios = modal.querySelectorAll("input[name='xmm-url-type']");

        // Tabs
        const tabButtons = Array.from(modal.querySelectorAll('.xmm-tab-btn'));
        const tabPanels = {
            gallery: document.getElementById('xmm-tab-gallery'),
            upload: document.getElementById('xmm-tab-upload'),
            import: document.getElementById('xmm-tab-import'),
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
            if (media.path && isYouTubeUrl(media.path)) return "xmm-icon-youtube";
            const kind = getMediaKind(media);
            if (kind === "image") return "xmm-icon-image";
            if (kind === "video") return "xmm-icon-video";
            if (kind === "voice") return "xmm-icon-voice";
            return "xmm-icon-file";
        }

        function getSelectedUrlType() {
            const checked = Array.from(urlTypeRadios).find(r => r.checked);
            return checked ? checked.value : "auto";
        }

        // ===== Public API =====
        window.xmmMediaModalManager = {
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
            // Reset upload label visual feedback
            const uploadLabel = document.getElementById('xmm-upload-label');
            const uploadLabelText = document.getElementById('xmm-upload-label-text');
            if (uploadLabelText) uploadLabelText.textContent = 'اختر ملف الوسائط';
            if (uploadLabel) uploadLabel.style.border = '1px solid #dcdcdc';
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
            setTimeout(() => document.getElementById("xmm-search")?.focus(), 0);
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
        modal.querySelector(".xmm-container").addEventListener("click", e => e.stopPropagation());
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
        tabButtons.forEach(btn => btn.addEventListener('click', () => switchTab(btn.dataset.xmmTab)));

        function switchTab(tab) {
            if (!tabPanels[tab]) return;
            state.activeTab = tab;
            tabButtons.forEach(b => {
                const active = b.dataset.xmmTab === tab;
                b.classList.toggle('xmm-is-active', active);
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
                if (opts.active) b.classList.add("xmm-page-active");
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
                    span.className = "xmm-page-ellipsis";
                    span.textContent = "…";
                    paginationEl.appendChild(span);
                }
                paginationEl.appendChild(mkBtn(String(pg), pg, { active: pg === cur }));
                prev = pg;
            }
            paginationEl.appendChild(mkBtn("»", cur + 1, { disabled: cur >= last }));
            const info = document.createElement("span");
            info.className = "xmm-page-info";
            info.textContent = `صفحة ${cur} من ${last} — ${state.total} عنصر`;
            paginationEl.appendChild(info);
        }
        // ===== Render =====
        function renderList() {
            listEl.innerHTML = "";
            const filtered = state.type === "all" ? state.list : state.list.filter(m => getMediaKind(m) === state
                .type);
            if (!filtered.length) {
                listEl.innerHTML = `<div class="xmm-empty">لا توجد وسائط للعرض</div>`;
                return;
            }
            filtered.forEach(media => {
                const kind = getMediaKind(media);
                const item = document.createElement("div");
                item.className = "xmm-item";
                if (state.selected && state.selected.id === media.id) item.classList.add("xmm-is-selected");
                item.addEventListener("click", () => toggleSelect(media));

                const title = document.createElement("div");
                title.className = "xmm-title";
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
            window.xmmMediaModalManager.onMediaSelected({
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
            if (window.compressImage && /^image\//i.test(file0.type)) {
                try { file0 = await window.compressImage(file0); } catch (_) {}
            }
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
                            const items = [...listEl.querySelectorAll('.xmm-item')];
                            const el = items.find(elm => {
                                const title = elm.querySelector('.xmm-title')?.textContent
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
                    window.xmmMediaModalManager.onMediaSelected({
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
                        window.xmmMediaModalManager.onMediaSelected({
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
                btnUploadToGallery.textContent = "رفع & فتح المعرض";
                btnUploadSelectAndClose.textContent = "رفع & حفظ وإغلاق";
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
                            const items = [...listEl.querySelectorAll('.xmm-item')];
                            const el = items.find(elm => {
                                const title = elm.querySelector('.xmm-title')?.textContent
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
                    window.xmmMediaModalManager.onMediaSelected({
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
                        window.xmmMediaModalManager.onMediaSelected({
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
        const uploadLabel = document.getElementById('xmm-upload-label');
        const uploadLabelText = document.getElementById('xmm-upload-label-text');
        uploadInput?.addEventListener('change', (e) => {
            const files = e.target.files;
            if (files && files.length > 0) {
                const fileName = files[0].name;
                if (uploadLabelText) uploadLabelText.textContent = 'تم تحميل الملف';
                if (uploadLabel) uploadLabel.style.border = '1px solid #000';

                // Auto-fill name and alt fields if empty
                if (upName && !upName.value) {
                    const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                    upName.value = nameWithoutExt;
                    if (upAlt) upAlt.value = nameWithoutExt;
                }
            } else {
                if (uploadLabelText) uploadLabelText.textContent = 'اختر ملف الوسائط';
                if (uploadLabel) uploadLabel.style.border = '1px solid #dcdcdc';
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
            if (!state.list.length) listEl.innerHTML = `<div class="xmm-empty">لا توجد وسائط للعرض</div>`;
        })();
    })();
</script>
