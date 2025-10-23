<!-- ================== VVC MEDIA MODAL + TinyMCE 8 (FULL, ZERO-BUG TEMPLATE) ================== -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ====== Icons Sprite ====== -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
    <symbol id="vvc-icon-image" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <circle cx="8" cy="10" r="1.5" fill="currentColor" />
        <path d="M21 19l-5.5-7-4.5 6-3-4-4 5" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="vvc-icon-video" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
    <symbol id="vvc-icon-voice" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <rect x="9" y="7" width="2" height="10" rx="1" fill="currentColor" />
        <rect x="13" y="11" width="2" height="6" rx="1" fill="currentColor" />
    </symbol>
    <symbol id="vvc-icon-file" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <path d="M9 7h6M9 11h6M9 15h2" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="vvc-icon-youtube" viewBox="0 0 24 24">
        <rect x="2" y="6" width="20" height="12" rx="4" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
</svg>

<!-- ====== Modal ====== -->
<div id="vvcMediaModal" class="vvc-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="vvcMediaModalTitle">
    <div class="vvc-backdrop" data-vvc-backdrop></div>
    <div class="vvc-container" role="document">
        <div class="vvc-header">
            <h5 id="vvcMediaModalTitle">اختر الوسائط</h5>
            <button class="vvc-close" type="button" data-vvc-close aria-label="إغلاق">&times;</button>
        </div>

        <!-- Tabs -->
        <div class="vvc-tabs" role="tablist" aria-label="أقسام إدارة الوسائط">
            <button type="button" class="vvc-tab-btn vvc-is-active" role="tab" aria-selected="true"
                aria-controls="vvc-tab-gallery" id="vvc-tabbtn-gallery" tabindex="0"
                data-vvc-tab="gallery">المعرض</button>
            <button type="button" class="vvc-tab-btn" role="tab" aria-selected="false"
                aria-controls="vvc-tab-upload" id="vvc-tabbtn-upload" tabindex="-1" data-vvc-tab="upload">الرفع من
                الجهاز</button>
            <button type="button" class="vvc-tab-btn" role="tab" aria-selected="false"
                aria-controls="vvc-tab-import" id="vvc-tabbtn-import" tabindex="-1" data-vvc-tab="import">الاستيراد
                بالرابط</button>
        </div>

        <!-- Gallery -->
        <section id="vvc-tab-gallery" class="vvc-tab-panel" role="tabpanel" aria-labelledby="vvc-tabbtn-gallery">
            <div class="vvc-filters">
                <input type="text" id="vvc-search" placeholder="ابحث عن وسائط..." />
                <select id="vvc-type-filter" aria-label="نوع الوسائط">
                    <option value="all">كل الوسائط</option>
                    <option value="image">صورة</option>
                    <option value="video">فيديو</option>
                    <option value="voice">صوت</option>
                    <option value="file">ملف</option>
                </select>
            </div>
            <div class="vvc-body">
                <div id="vvc-list" class="vvc-grid"></div>
                <div id="vvc-loader" class="vvc-loader" hidden>جاري التحميل...</div>
                <div id="vvc-sentinel" class="vvc-sentinel"></div>
            </div>
            <div class="vvc-footer">
                <button class="vvc-btn vvc-btn-select" type="button" id="vvc-btn-select" disabled>اختر</button>
                <button class="vvc-btn vvc-btn-cancel" type="button" data-vvc-close>إلغاء</button>
            </div>
        </section>

        <!-- Upload -->
        <section id="vvc-tab-upload" class="vvc-tab-panel" role="tabpanel" aria-labelledby="vvc-tabbtn-upload"
            hidden>
            <div class="vvc-tab-body">
                <div class="vvc-uploader">
                    <div class="vvc-upload-fields" style="display:flex; flex-wrap:wrap; gap:.6rem; width:100%;">
                        <div style="flex:1 1 260px;">
                            <label for="vvc-upload-input"
                                style="display:block; width:100%; cursor:pointer; padding:.6rem .7rem; border:1px solid #dcdcdc; background:#fafafa; color:#333; text-align:center;">
                                <i class="fa fa-upload" style="margin-right:6px;"></i> اختر ملف الوسائط
                                <input type="file" id="vvc-upload-input" class="vvc-upload-input"
                                    accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt"
                                    style="display:none;" />
                            </label>
                        </div>
                        <div style="flex:1 1 220px;">
                            <input type="text" id="vvc-upload-name" class="vvc-upload-name"
                                placeholder="اسم الملف"
                                style="width:100%; padding:.6rem .7rem; border:1px solid #dcdcdc; background:#fff;" />
                        </div>
                        <div style="flex:1 1 220px;">
                            <input type="text" id="vvc-upload-alt" class="vvc-upload-alt"
                                placeholder="النص البديل"
                                style="width:100%; padding:.6rem .7rem; border:1px solid #dcdcdc; background:#fff;" />
                        </div>
                    </div>
                    <div class="vvc-uploader-actions">
                        <button class="vvc-btn vvc-btn-secondary" type="button" id="vvc-btn-upload-to-gallery"
                            title="رفع ثم عرض في المعرض">رفع & فتح المعرض</button>
                        <button class="vvc-btn vvc-btn-primary" type="button" id="vvc-btn-upload-and-select-close"
                            title="رفع ثم حفظ وإغلاق">رفع & حفظ وإغلاق</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Import by URL -->
        <section id="vvc-tab-import" class="vvc-tab-panel" role="tabpanel" aria-labelledby="vvc-tabbtn-import"
            hidden>
            <div class="vvc-tab-body">
                <div class="vvc-uploader vvc-uploader-url"
                    style="padding:1.2rem; background:#fafbfc; border:1px solid var(--vvc-border);">
                    <div style="display:flex; flex-wrap:wrap; gap:.7rem; margin-bottom:.7rem;">
                        <input type="text" id="vvc-upload-url" placeholder="الرابط"
                            style="flex:1 1 260px; padding:.7rem 1rem; border:1px solid #dcdcdc; background:#fff;" />
                        <input type="text" id="vvc-url-name" placeholder="اسم الملف"
                            style="flex:1 1 220px; padding:.7rem 1rem; border:1px solid #dcdcdc; background:#fff;" />
                        <input type="text" id="vvc-url-alt" placeholder="النص البديل"
                            style="flex:1 1 220px; padding:.7rem 1rem; border:1px solid #dcdcdc; background:#fff;" />
                    </div>

                    <fieldset class="vvc-url-type-group" aria-label="نوع الوسائط للرابط"
                        style="margin-bottom:.7rem; border:1px solid #e5e7eb; padding:.7rem 1rem; background:#fff;">
                        <legend style="font-size:.97rem; color:#333; padding:0 .3rem; font-weight:500;">نوع الوسائط
                            (اختياري)</legend>
                        <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
                            <label class="vvc-radio" style="font-size:.97rem;"><input type="radio"
                                    name="vvc-url-type" value="auto" checked /><span>Auto</span></label>
                            <label class="vvc-radio" style="font-size:.97rem;"><input type="radio"
                                    name="vvc-url-type" value="image" /><span>Image</span></label>
                            <label class="vvc-radio" style="font-size:.97rem;"><input type="radio"
                                    name="vvc-url-type" value="video" /><span>Video</span></label>
                            <label class="vvc-radio" style="font-size:.97rem;"><input type="radio"
                                    name="vvc-url-type" value="voice" /><span>Voice</span></label>
                            <label class="vvc-radio" style="font-size:.97rem;"><input type="radio"
                                    name="vvc-url-type" value="file" /><span>File</span></label>
                        </div>
                    </fieldset>

                    <div class="vvc-uploader-actions" style="display:flex; gap:.7rem; margin-bottom:.7rem;">
                        <button class="vvc-btn vvc-btn-secondary" type="button" id="vvc-btn-import-to-gallery"
                            title="استيراد بالرابط ثم عرض في المعرض">استيراد & فتح المعرض</button>
                        <button class="vvc-btn vvc-btn-primary" type="button" id="vvc-btn-import-and-select-close"
                            title="استيراد بالرابط ثم حفظ وإغلاق">استيراد & حفظ وإغلاق</button>
                    </div>

                    <small class="vvc-selection-hint"
                        style="display:block; color:var(--vvc-muted); font-size:.97rem;">
                        يُقبل الرابط المباشر أو رابط YouTube. يمكن تحديد نوع الوسائط يدوياً أو تركه على Auto.
                    </small>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- ====== Styles ====== -->
<style>
    #vvcMediaModal,
    #vvcMediaModal * {
        box-sizing: border-box;
    }

    #vvcMediaModal * {
        border-radius: 0 !important;
    }

    :root {
        --vvc-bg: #fff;
        --vvc-text: #111;
        --vvc-border: #e5e7eb;
        --vvc-ring: #d1d5db;
        --vvc-muted: #6b7280;
        --vvc-black: #111;
        --vvc-black-strong: #000;
    }

    .vvc-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 10000;
    }

    .vvc-modal[aria-hidden="false"] {
        display: block;
    }

    .vvc-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        z-index: 0;
    }

    .vvc-container {
        position: absolute;
        inset: auto 0;
        top: 5%;
        margin: 0 auto;
        width: clamp(320px, 92vw, 1000px);
        max-height: 90%;
        background: var(--vvc-bg);
        color: var(--vvc-text);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        animation: vvcFade .2s ease-out;
    }

    @keyframes vvcFade {
        from {
            opacity: 0;
            transform: translateY(-14px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    .vvc-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--vvc-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
    }

    .vvc-close {
        font-size: 1.4rem;
        border: 0;
        background: transparent;
        color: #666;
        cursor: pointer;
    }

    .vvc-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--vvc-border);
        background: #fff;
    }

    .vvc-tab-btn {
        background: #fff;
        border: 1px solid var(--vvc-border);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--vvc-text);
    }

    .vvc-tab-btn.vvc-is-active {
        border-color: #dcdcdc;
    }

    .vvc-tab-panel {
        display: block;
    }

    .vvc-tab-panel[hidden] {
        display: none;
    }

    .vvc-tab-body {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--vvc-border);
        background: #fff;
    }

    .vvc-filters {
        padding: 1rem 1.25rem;
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--vvc-border);
        background: #fff;
    }

    .vvc-filters input,
    .vvc-filters select {
        padding: .6rem .7rem;
        font-size: .95rem;
        border: 1px solid #dcdcdc;
        background: #fff;
        color: var(--vvc-text);
        flex: 1 1 180px;
    }

    .vvc-body {
        padding: 1rem 1.25rem;
        overflow: auto;
        flex: 1;
        background: #fff;
    }

    .vvc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: .9rem;
    }

    .vvc-empty {
        text-align: center;
        color: var(--vvc-muted);
        font-size: .95rem;
        margin: 2rem 0;
    }

    .vvc-item {
        position: relative;
        border: 1px solid var(--vvc-border);
        background: #fff;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: .6rem;
    }

    .vvc-item:hover {
        border-color: #cfcfcf;
        box-shadow: 0 0 0 3px #f3f4f6;
    }

    .vvc-item.vvc-is-selected {
        border-color: #cfcfcf;
        box-shadow: 0 0 0 3px #e5e7eb;
    }

    .vvc-thumb {
        width: 100%;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fafafa;
        overflow: hidden;
        position: relative;
        border: 1px solid #f0f0f0;
    }

    .vvc-thumb img,
    .vvc-thumb video {
        max-width: 100%;
        max-height: 100%;
    }

    .vvc-thumb audio {
        width: 100%;
    }

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

    .vvc-title {
        font-size: .9rem;
        color: #374151;
        margin-top: .55rem;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .vvc-uploader {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .6rem;
        background: #fff;
        border: 1px solid var(--vvc-border);
        padding: 1rem;
    }

    .vvc-uploader-actions {
        display: flex;
        gap: .6rem;
    }

    .vvc-btn {
        padding: .6rem 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        border: 1px solid var(--vvc-black);
        background: var(--vvc-black);
        color: #fff;
    }

    .vvc-btn:hover {
        background: var(--vvc-black-strong);
        border-color: var(--vvc-black-strong);
    }

    .vvc-btn-secondary {
        background: #444;
        border-color: #444;
    }

    .vvc-btn-secondary:hover {
        background: #222;
        border-color: #222;
    }

    .vvc-btn-primary {
        background: var(--vvc-black);
        border-color: var(--vvc-black);
    }

    .vvc-footer {
        padding: 1rem 1.25rem;
        background: #fff;
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        border-top: 1px solid var(--vvc-border);
    }

    .vvc-btn-select {
        background: #fff;
        color: var(--vvc-black);
        border-color: var(--vvc-black);
    }

    .vvc-btn-select:hover {
        background: #f5f5f5;
    }

    .vvc-btn-cancel {
        background: #444;
        border-color: #444;
        color: #fff;
    }

    .vvc-btn-cancel:hover {
        background: #222;
        border-color: #222;
    }

    .vvc-loader {
        text-align: center;
        color: var(--vvc-muted);
        padding: .75rem;
        font-size: .95rem;
    }

    .vvc-sentinel {
        height: 1px;
    }

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
    }
</style>

<!-- ====== Modal + Bridge Logic ====== -->
<script>
    (function() {
        // ---------- Endpoints (Laravel) ----------
        const FETCH_URL = "{{ route('dashboard.media.getAllMediaPaginated') }}";
        const UPLOAD_URL = "{{ route('dashboard.media.store') }}";
        const IMPORT_URL = "{{ route('dashboard.media_url.store') }}";
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        // ---------- Elements ----------
        const modal = document.getElementById("vvcMediaModal");
        const backdrop = modal.querySelector("[data-vvc-backdrop]");
        const closes = modal.querySelectorAll("[data-vvc-close]");
        const container = modal.querySelector(".vvc-container");

        // Gallery
        const listEl = document.getElementById("vvc-list");
        const loaderEl = document.getElementById("vvc-loader");
        const sentinel = document.getElementById("vvc-sentinel");
        const searchInp = document.getElementById("vvc-search");
        const typeSel = document.getElementById("vvc-type-filter");
        const btnSelect = document.getElementById("vvc-btn-select");

        // Upload
        const upInput = document.getElementById("vvc-upload-input");
        const upName = document.getElementById("vvc-upload-name");
        const upAlt = document.getElementById("vvc-upload-alt");
        const btnUpGal = document.getElementById("vvc-btn-upload-to-gallery");
        const btnUpSel = document.getElementById("vvc-btn-upload-and-select-close");

        // Import URL
        const urlInp = document.getElementById("vvc-upload-url");
        const urlName = document.getElementById("vvc-url-name");
        const urlAlt = document.getElementById("vvc-url-alt");
        const btnImpGal = document.getElementById("vvc-btn-import-to-gallery");
        const btnImpSel = document.getElementById("vvc-btn-import-and-select-close");

        // ---------- State ----------
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

        // ---------- Helpers ----------
        const YT_REGEX =
            /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/i;
        const isYouTubeUrl = (u = "") => YT_REGEX.test(u);
        const getYouTubeId = (u = "") => (u.match(YT_REGEX)?.[1] ?? null);
        const extFromPath = (p = "") => (p.split("?")[0].split(".").pop() || "").toLowerCase();
        const toAbsoluteUrl = (u) => {
            if (!u) return u;
            if (/^https?:\/\//i.test(u)) return u;
            return `${window.location.origin}${u.startsWith('/')?'':'/'}${u}`;
        };

        function getMediaKind(m) {
            if (m.path && isYouTubeUrl(m.path)) return "video";
            const mt = (m.media_type || "").toLowerCase();
            if (["image", "video", "audio", "voice", "file"].includes(mt)) return (mt === "audio" ? "voice" : mt);
            const ext = extFromPath(m.path || m.url || "");
            if (["jpg", "jpeg", "png", "gif", "webp", "bmp", "svg"].includes(ext)) return "image";
            if (["mp4", "webm", "mkv", "mov", "avi", "m4v"].includes(ext)) return "video";
            if (["mp3", "wav", "ogg", "m4a", "aac", "flac"].includes(ext)) return "voice";
            return "file";
        }
        const mapFilterForServer = (t) => (t === "voice" ? "audio" : t);
        const getBadgeIconId = (m) => (m.path && isYouTubeUrl(m.path)) ? "vvc-icon-youtube" : ({
            image: "vvc-icon-image",
            video: "vvc-icon-video",
            voice: "vvc-icon-voice",
            file: "vvc-icon-file"
        } [getMediaKind(m)] || "vvc-icon-file");

        // ---------- Public API ----------
        window.vvcMediaModalManager = {
            openModal(fieldName = "") {
                openModal(fieldName);
            },
            closeModal() {
                closeModal();
            },
            onMediaSelected(payload) {
                // Normalisation unique pour TinyMCE et autres consommateurs
                const normalized = {
                    url: payload.url,
                    title: payload.title || "",
                    alt: payload.alt || "",
                    type: payload.type || ""
                };

                // A) TinyMCE via promesse bridge
                if (typeof window._resolveTinyPick === 'function') {
                    const resolver = window._resolveTinyPick;
                    window._resolveTinyPick = null;
                    window._tinyRequestedType = null;
                    resolver(normalized);
                    closeModal();
                    return;
                }

                // B) Insertion directe si éditeur actif
                if (window.tinymce && tinymce.activeEditor && normalized.url) {
                    try {
                        tinymce.activeEditor.focus();
                        const isImg = /\.(png|jpe?g|webp|gif|bmp|svg)(\?|$)/i.test(normalized.url);
                        if (isImg) {
                            tinymce.activeEditor.execCommand('mceInsertContent', false,
                                `<img src="${escapeHtml(normalized.url)}" alt="${escapeHtml(normalized.alt || normalized.title)}" title="${escapeHtml(normalized.title)}"/>`
                            );
                        } else {
                            tinymce.activeEditor.execCommand('mceInsertContent', false,
                                `<a href="${escapeHtml(normalized.url)}" target="_blank" rel="noopener">${escapeHtml(normalized.title || normalized.url)}</a>`
                            );
                        }
                        closeModal();
                    } catch (e) {
                        console.error('Tiny insert failed:', e);
                    }
                    return;
                }

                // C) Callback externe optionnel
                if (window.mediaTabManager?.onMediaSelected) {
                    window.mediaTabManager.onMediaSelected(normalized);
                    closeModal();
                }
            }
        };

        // ---------- Open / Close ----------
        function openModal(fieldName = "") {
            state.currentField = fieldName;
            state.isOpen = true;
            modal.setAttribute("aria-hidden", "false");
            document.documentElement.style.overflow = "hidden";

            resetState();

            // Filtrage initial selon demande TinyMCE (image|media|file)
            if (window._tinyRequestedType) {
                const map = {
                    image: 'image',
                    media: 'video',
                    file: 'file'
                };
                const t = map[window._tinyRequestedType] || 'all';
                state.type = t;
                const sel = document.getElementById("vvc-type-filter");
                if (sel) sel.value = t;
            }

            switchTab('gallery');
            resetAndLoad();
            setTimeout(() => document.getElementById("vvc-search")?.focus(), 0);
        }

        function closeModal() {
            state.isOpen = false;
            modal.setAttribute("aria-hidden", "true");
            document.documentElement.style.overflow = "";
            resetState();
        }
        backdrop.addEventListener("click", closeModal);
        closes.forEach(b => b.addEventListener("click", closeModal));
        container.addEventListener("click", e => e.stopPropagation());
        document.addEventListener("keydown", e => {
            if (!state.isOpen) return;
            if (e.key === "Escape") closeModal();
            if (e.key === "ArrowRight" || e.key === "ArrowLeft") {
                const btns = [...document.querySelectorAll('.vvc-tab-btn')];
                const idx = btns.findIndex(b => b.getAttribute('aria-selected') === "true");
                if (idx > -1) {
                    const next = (idx + (e.key === "ArrowRight" ? 1 : -1) + btns.length) % btns.length;
                    btns[next].click();
                    btns[next].focus();
                }
            }
        });

        // ---------- Tabs ----------
        document.querySelectorAll('.vvc-tab-btn').forEach(btn => btn.addEventListener('click', () => switchTab(btn
            .dataset.vvcTab)));

        function switchTab(tab) {
            const panels = {
                gallery: document.getElementById('vvc-tab-gallery'),
                upload: document.getElementById('vvc-tab-upload'),
                import: document.getElementById('vvc-tab-import')
            };
            if (!panels[tab]) return;
            state.activeTab = tab;
            document.querySelectorAll('.vvc-tab-btn').forEach(b => {
                const active = b.dataset.vvcTab === tab;
                b.classList.toggle('vvc-is-active', active);
                b.setAttribute('aria-selected', String(active));
                b.tabIndex = active ? 0 : -1;
            });
            Object.entries(panels).forEach(([name, p]) => p.hidden = (name !== tab));
        }

        // ---------- Reset ----------
        function resetState() {
            state.page = 1;
            state.hasMore = true;
            state.isLoading = false;
            state.search = "";
            state.type = "all";
            state.list = [];
            state.selected = null;
            if (searchInp) searchInp.value = "";
            if (typeSel) typeSel.value = "all";
            if (state.observer) {
                try {
                    state.observer.disconnect();
                } catch {}
                state.observer = null;
            }
            if (upInput) upInput.value = "";
            if (upName) upName.value = "";
            if (upAlt) upAlt.value = "";
            if (urlInp) urlInp.value = "";
            if (urlName) urlName.value = "";
            if (urlAlt) urlAlt.value = "";
            if (btnSelect) btnSelect.disabled = true;
        }

        // ---------- Fetch / Pagination ----------
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
            const rootEl = document.querySelector("#vvc-tab-gallery .vvc-body");
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
                if (!res.ok) throw new Error(`Fetch ${res.status}`);
                const data = await res.json();
                const items = Array.isArray(data.data) ? data.data : [];
                const hasMore = !!data.next_page_url;
                state.list = reset ? items : state.list.concat(items);
                state.hasMore = hasMore;
                state.page += 1;
            } catch (err) {
                console.error(err);
                if (reset) listEl.innerHTML = `<div class="vvc-empty">تعذّر تحميل الوسائط.</div>`;
            } finally {
                state.isLoading = false;
                loaderEl.hidden = true;
                renderList();
            }
        }

        // ---------- Render ----------
        function renderList() {
            listEl.innerHTML = "";
            const filtered = state.type === "all" ? state.list : state.list.filter(m => getMediaKind(m) === state
                .type);
            if (!filtered.length) {
                listEl.innerHTML = `<div class="vvc-empty">لا توجد وسائط للعرض</div>`;
                return;
            }

            filtered.forEach(media => {
                const kind = getMediaKind(media);
                const item = document.createElement("div");
                item.className = "vvc-item";
                if (state.selected && state.selected.id === media.id) item.classList.add("vvc-is-selected");
                item.addEventListener("click", (e) => {
                    e.stopPropagation();
                    toggleSelect(media);
                });

                const thumb = document.createElement("div");
                thumb.className = "vvc-thumb";
                const badge = document.createElement("div");
                badge.className = "vvc-badge";
                badge.title = (kind === "voice" ? "audio" : (isYouTubeUrl(media.path) ? "youtube" : kind));
                badge.innerHTML =
                    `<svg aria-hidden="true"><use href="#${getBadgeIconId(media)}"></use></svg>`;
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
                    img.src = toAbsoluteUrl(media.path || media.url);
                    img.alt = media.alt || media.name || "";
                    img.loading = "lazy";
                    thumb.appendChild(img);
                } else if (kind === "video") {
                    if (/\.(mp4|webm|mkv|mov|avi|m4v)(\?|$)/i.test(media.path || "")) {
                        const video = document.createElement("video");
                        video.src = toAbsoluteUrl(media.path);
                        video.muted = true;
                        video.preload = "metadata";
                        thumb.appendChild(video);
                    }
                } else if (kind === "voice") {
                    const audio = document.createElement("audio");
                    audio.src = toAbsoluteUrl(media.path);
                    audio.preload = "metadata";
                    audio.controls = true;
                    thumb.appendChild(audio);
                }

                item.appendChild(thumb);
                const title = document.createElement("div");
                title.className = "vvc-title";
                title.textContent = media.name || "";
                item.appendChild(title);
                listEl.appendChild(item);
            });
        }

        function toggleSelect(media) {
            const isSame = state.selected && state.selected.id === media.id;
            state.selected = isSame ? null : media;
            renderList();
            if (btnSelect) btnSelect.disabled = !state.selected;
        }

        // ---------- Search / Filter ----------
        let searchTimeout;
        searchInp?.addEventListener("input", (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                state.search = e.target.value;
                resetAndLoad();
            }, 350);
        });
        typeSel?.addEventListener("change", (e) => {
            state.type = e.target.value;
            resetAndLoad();
        });

        // ---------- Confirm Selection ----------
        btnSelect?.addEventListener("click", () => {
            if (!state.selected) {
                alert("يرجى اختيار وسيط واحد على الأقل.");
                return;
            }
            const kind = getMediaKind(state.selected);
            const payload = {
                id: state.selected.id,
                url: toAbsoluteUrl(state.selected.path || state.selected.url),
                title: state.selected.name || "",
                alt: state.selected.alt || "",
                type: kind
            };
            window.vvcMediaModalManager.onMediaSelected(payload);
        });

        // ---------- Upload / Import utils ----------
        function tryParseJson(text) {
            if (!text) return null;
            const clean = text.replace(/^\uFEFF/, "").trim();
            try {
                return JSON.parse(clean);
            } catch {
                return null;
            }
        }

        function extractCreated(obj) {
            if (!obj || typeof obj !== 'object') return [];
            if (Array.isArray(obj.data)) return obj.data;
            if (Array.isArray(obj.media)) return obj.media;
            if (obj.data) return [obj.data];
            if (obj.media) return [obj.media];
            return [];
        }

        // ---------- Upload ----------
        async function uploadMedia(mode) {
            const files = upInput?.files;
            if (!files || !files.length) {
                alert("⚠️ لم يتم اختيار أي ملف للرفع.");
                return;
            }
            const file0 = files[0];
            const nameVal = (upName.value || "").trim() || file0.name;
            const altVal = (upAlt.value || "").trim();

            const form = new FormData();
            form.append("media", file0);
            form.append("name", nameVal);
            if (altVal) form.append("alt", altVal);

            try {
                btnUpGal.disabled = true;
                btnUpSel.disabled = true;
                btnUpGal.textContent = "جارٍ الرفع...";
                btnUpSel.textContent = "جارٍ الرفع...";

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
                    console.error("Upload failed", res.status, bodyText);
                    alert("فشل الرفع.");
                    return;
                }

                const parsed = tryParseJson(bodyText);
                const created = extractCreated(parsed);

                if (mode === "gallery") {
                    switchTab('gallery');
                    await resetAndLoad();
                    if (created.length) {
                        state.selected = created[0];
                        renderList();
                        if (btnSelect) btnSelect.disabled = false;
                    }
                    upInput.value = "";
                    upName.value = "";
                    upAlt.value = "";
                    return;
                }

                if (created.length) {
                    const first = created[0];
                    const url = toAbsoluteUrl(first.url || first.path);
                    const kind = getMediaKind(first);
                    window.vvcMediaModalManager.onMediaSelected({
                        id: first.id,
                        url,
                        title: first.name || nameVal,
                        alt: first.alt || altVal,
                        type: kind
                    });
                }
            } catch (err) {
                console.error("Upload exception", err);
                alert("حدث خطأ أثناء الرفع.");
            } finally {
                btnUpGal.disabled = false;
                btnUpSel.disabled = false;
                btnUpGal.textContent = "رفع & فتح المعرض";
                btnUpSel.textContent = "رفع & حفظ وإغلاق";
            }
        }

        // ---------- Import by URL ----------
        function selectedUrlType() {
            const r = modal.querySelector("input[name='vvc-url-type']:checked");
            return r ? r.value : 'auto';
        }
        async function importByUrl(mode) {
            if (!IMPORT_URL) {
                alert("⚠️ لم يتم ضبط مسار الاستيراد عبر الرابط في الخادم.");
                return;
            }

            const urlVal = (urlInp.value || "").trim();
            const nameVal = (urlName.value || "").trim();
            const altVal = (urlAlt.value || "").trim();
            const tVal = selectedUrlType();
            if (!urlVal) {
                alert("⚠️ يرجى إدخال الرابط أولاً.");
                return;
            }

            const payloadType = (tVal === 'auto') ? undefined : mapFilterForServer(tVal);

            try {
                btnImpGal.disabled = true;
                btnImpSel.disabled = true;
                btnImpGal.textContent = "جارٍ الاستيراد...";
                btnImpSel.textContent = "جارٍ الاستيراد...";

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
                    console.error("Import failed", res.status, bodyText);
                    alert("فشل الاستيراد.");
                    return;
                }

                const parsed = tryParseJson(bodyText);
                const created = extractCreated(parsed);

                if (mode === "gallery") {
                    switchTab('gallery');
                    await resetAndLoad();
                    if (created.length) {
                        state.selected = created[0];
                        renderList();
                        if (btnSelect) btnSelect.disabled = false;
                    }
                    urlInp.value = "";
                    urlName.value = "";
                    urlAlt.value = "";
                    return;
                }

                if (created.length) {
                    const first = created[0];
                    const url = toAbsoluteUrl(first.url || first.path);
                    const kind = getMediaKind(first);
                    window.vvcMediaModalManager.onMediaSelected({
                        id: first.id,
                        url,
                        title: first.name || nameVal,
                        alt: first.alt || altVal,
                        type: kind
                    });
                }
            } catch (err) {
                console.error("Import exception", err);
                alert("حدث خطأ أثناء الاستيراد.");
            } finally {
                btnImpGal.disabled = false;
                btnImpSel.disabled = false;
                btnImpGal.textContent = "استيراد & فتح المعرض";
                btnImpSel.textContent = "استيراد & حفظ وإغلاق";
            }
        }

        // ---------- Bindings ----------
        btnUpGal?.addEventListener("click", () => uploadMedia('gallery'));
        btnUpSel?.addEventListener("click", () => uploadMedia('select-close'));
        btnImpGal?.addEventListener("click", () => importByUrl('gallery'));
        btnImpSel?.addEventListener("click", () => importByUrl('select-close'));

        // ---------- Initial state ----------
        if (!state.list.length) {
            listEl.innerHTML = `<div class="vvc-empty">لا توجد وسائط للعرض</div>`;
        }

        // ---------- Safe HTML escape (shared with TinyMCE insertion) ----------
        window.escapeHtml = function(str) {
            if (str == null) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        };
    })();
</script>

<!-- ====== TinyMCE 8 CDN ====== -->
<script src="https://cdn.tiny.cloud/1/vw6sltzauw9x6b3cl3eby8nj99q4eoavzv581jnnmabxbhq2/tinymce/8/tinymce.min.js" referrerpolicy="origin"
    crossorigin="anonymous"></script>

<!-- ====== TinyMCE Init + Bridge ====== -->
<script>
    (function() {
        const theme = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';

        // Bridge TinyMCE <-> VVC
        window.pickMediaForTiny = function(opts = {
            type: 'file'
        }) {
            return new Promise((resolve) => {
                window._resolveTinyPick = resolve;
                window._tinyRequestedType = opts.type || 'file'; // 'image' | 'media' | 'file'
                if (window.vvcMediaModalManager?.openModal) {
                    window.vvcMediaModalManager.openModal('tiny');
                } else {
                    console.error('vvc Modal manager not found. Ensure the modal script is loaded.');
                    resolve(null);
                }
            });
        };

        tinymce.init({
            selector: 'textarea#myeditorinstance',
            directionality: 'rtl',
            height: 600,
            promotion: false,
            onboarding: false,
            auto_focus: false,

            content_style: `
      body { font-family: Arial, Helvetica, sans-serif !important; font-size: 18pt !important; line-height: 1.6 !important; }
      figure.image { display: inline-block; }
      figcaption { font-size: .9em; color: #666; }
    `,

            setup: (editor) => {
                // Bouton personnalisé (insert direct)
                editor.ui.registry.addButton('vvcPicker', {
                    text: 'وسائط',
                    tooltip: 'اختيار وسائط من المعرض',
                    onAction: async () => {
                        const picked = await window.pickMediaForTiny({
                            type: 'file'
                        });
                        if (!picked || !picked.url) return;
                        const url = picked.url;
                        const title = picked.title || '';
                        const alt = picked.alt || title || '';
                        const isImg = /\.(png|jpe?g|webp|gif|bmp|svg)(\?|$)/i.test(url);

                        editor.focus();

                        if (isImg) {
                            editor.execCommand('mceInsertContent', false,
                                `<figure class="image"><img src="${escapeHtml(url)}" alt="${escapeHtml(alt)}" title="${escapeHtml(title)}"/><figcaption>${escapeHtml(title)}</figcaption></figure>`
                            );
                        } else {
                            editor.execCommand('mceInsertContent', false,
                                `<a href="${escapeHtml(url)}" target="_blank" rel="noopener">${escapeHtml(title || url)}</a>`
                            );
                        }
                    }
                });
            },

            skin: theme === 'dark' ? 'oxide-dark' : 'oxide',
            content_css: theme === 'dark' ? 'dark' : 'default',

            plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help hr image imagetools importcss insertdatetime link lists media nonbreaking pagebreak preview print quickbars save searchreplace table template visualblocks visualchars wordcount',

            toolbar_mode: 'wrap',
            toolbar: [
                'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor',
                '| alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist',
                '| link table image media blockquote vvcPicker',
                '| code fullscreen wordcount searchreplace | removeformat subscript superscript charmap emoticons insertdatetime pagebreak preview print template visualblocks visualchars help'
            ].join(' '),

            fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 36pt',
            font_family_formats: 'Arial=arial,helvetica,sans-serif; Helvetica=helvetica; Times New Roman=times new roman,times; Courier New=courier;',

            // Intégration avec les dialogues natifs de TinyMCE
            file_picker_types: 'image media file',
            file_picker_callback: async (cb, value, meta) => {
                const picked = await window.pickMediaForTiny({
                    type: meta.filetype
                });
                if (!picked || !picked.url) return;

                // Laisser Tiny terminer le cycle de rendu du dialogue
                setTimeout(() => {
                    if (meta.filetype === 'image') {
                        cb(picked.url, {
                            title: picked.title || '',
                            alt: picked.alt || ''
                        });
                    } else {
                        cb(picked.url, {
                            text: picked.title || picked.url
                        });
                    }
                }, 0);
            },

            image_caption: true,
            image_title: true,
            image_advtab: true,

            menubar: 'file edit view insert format tools table help',
            editimage_cors_hosts: ['picsum.photos'],

            // Autosave
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',

            // Validation HTML relâchée (côté serveur)
            extended_valid_elements: 'script[src|async|charset],blockquote[class|lang|dir],iframe[src|width|height|frameborder|allowfullscreen]',
            valid_children: '+body[script],+div[script]',
            valid_elements: '*[*]'
        });
    })();
</script>
