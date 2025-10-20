

<!-- MMX ICONS (SVG SPRITE, HIDDEN) -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
    <symbol id="mmx-icon-image" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>
        <circle cx="8" cy="10" r="1.5" fill="currentColor"/>
        <path d="M21 19l-5.5-7-4.5 6-3-4-4 5" fill="none" stroke="currentColor" stroke-width="2"/>
    </symbol>
    <symbol id="mmx-icon-video" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>
        <polygon points="10,9 16,12 10,15" fill="currentColor"/>
    </symbol>
    <symbol id="mmx-icon-voice" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>
        <rect x="9" y="7" width="2" height="10" rx="1" fill="currentColor"/>
        <rect x="13" y="11" width="2" height="6" rx="1" fill="currentColor"/>
    </symbol>
    <symbol id="mmx-icon-file" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor" stroke-width="2"/>
        <path d="M9 7h6M9 11h6M9 15h2" fill="none" stroke="currentColor" stroke-width="2"/>
    </symbol>
    <symbol id="mmx-icon-youtube" viewBox="0 0 24 24">
        <rect x="2" y="6" width="20" height="12" rx="4" fill="none" stroke="currentColor" stroke-width="2"/>
        <polygon points="10,9 16,12 10,15" fill="currentColor"/>
    </symbol>
</svg>
<!-- ================== MEDIA MODAL (MMX NAMESPACE) ================== -->
<!-- CSRF -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="mmxMediaModal" class="mmx-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="mmxMediaModalTitle">
    <div class="mmx-backdrop" data-mmx-backdrop></div>
    <div class="mmx-container" role="document">
        <div class="mmx-header">
            <h5 id="mmxMediaModalTitle">اختر الوسائط</h5>
            <button class="mmx-close" type="button" data-mmx-close aria-label="إغلاق">&times;</button>
        </div>

        <!-- Tabs -->
        <div class="mmx-tabs" role="tablist" aria-label="أقسام إدارة الوسائط">
            <button class="mmx-tab-btn mmx-is-active" role="tab" aria-selected="true"
                aria-controls="mmx-tab-gallery" id="mmx-tabbtn-gallery" tabindex="0" data-mmx-tab="gallery">
                المعرض
            </button>
            <button class="mmx-tab-btn" role="tab" aria-selected="false" aria-controls="mmx-tab-upload"
                id="mmx-tabbtn-upload" tabindex="-1" data-mmx-tab="upload">
                الرفع من الجهاز
            </button>
            <button class="mmx-tab-btn" role="tab" aria-selected="false" aria-controls="mmx-tab-import"
                id="mmx-tabbtn-import" tabindex="-1" data-mmx-tab="import">
                الاستيراد بالرابط
            </button>
        </div>

        <!-- Gallery -->
        <section id="mmx-tab-gallery" class="mmx-tab-panel" role="tabpanel" aria-labelledby="mmx-tabbtn-gallery">
            <!-- Filters -->
            <div class="mmx-filters">
                <input type="text" id="mmx-search" placeholder="ابحث عن وسائط..." />
                <select id="mmx-type-filter" aria-label="نوع الوسائط">
                    <option value="all">كل الوسائط</option>
                    <option value="image">صورة</option>
                    <option value="video">فيديو</option>
                    <option value="voice">صوت</option>
                    <option value="file">ملف</option>
                </select>
            </div>

            <div class="mmx-body">
                <!-- Selected details -->
                <div id="mmx-selection" class="mmx-selection" hidden>
                    <div class="mmx-selection-title">تفاصيل الوسيط المُختار</div>
                    <div class="mmx-selection-grid">
                        <label>
                            <span>الاسم/العنوان</span>
                            <input type="text" id="mmx-selected-name" placeholder="اكتب اسمًا واضحًا" />
                        </label>
                        <label>
                            <span>النص البديل ALT</span>
                            <input type="text" id="mmx-selected-alt" placeholder="وصف موجز للمحتوى من أجل الوصول" />
                        </label>
                    </div>
                    <small class="mmx-selection-hint">لن تُحفظ هذه القيم في قاعدة البيانات إلا إذا وفّرت مسار تحديث.
                        حاليًا ستُعاد فقط مع حدث الاختيار.</small>
                </div>

                <div id="mmx-list" class="mmx-grid"></div>
                <div id="mmx-loader" class="mmx-loader" hidden>جاري التحميل...</div>
                <div id="mmx-sentinel" class="mmx-sentinel"></div>
            </div>

            <div class="mmx-footer">
                <button class="mmx-btn mmx-btn-select" type="button" id="mmx-btn-select">اختر</button>
                <button class="mmx-btn mmx-btn-cancel" type="button" data-mmx-close>إلغاء</button>
            </div>
        </section>

        <!-- Upload -->
        <section id="mmx-tab-upload" class="mmx-tab-panel" role="tabpanel" aria-labelledby="mmx-tabbtn-upload" hidden>
            <div class="mmx-tab-body">
                <div class="mmx-uploader">
                    <input type="file" id="mmx-upload-input" multiple />
                    <input type="text" id="mmx-upload-name" placeholder="اسم/عنوان الوسيط (اختياري)" />
                    <input type="text" id="mmx-upload-alt" placeholder="النص البديل ALT (اختياري)" />
                    <div class="mmx-uploader-actions">
                        <button class="mmx-btn mmx-btn-secondary" type="button" id="mmx-btn-upload-to-gallery"
                            title="رفع ثم عرض في المعرض">
                            رفع & فتح المعرض
                        </button>
                        <button class="mmx-btn mmx-btn-primary" type="button" id="mmx-btn-upload-and-select-close"
                            title="رفع ثم حفظ وإغلاق">
                            رفع & حفظ وإغلاق
                        </button>
                    </div>
                    <small class="mmx-selection-hint">
                        يمكنك اختيار ملف أو أكثر. إذا رفعت عدة ملفات ستُطبَّق قيم الاسم و ALT نفسها على جميعها ما لم
                        يدعم الخادم مصفوفات أسماء.
                    </small>
                </div>
            </div>
        </section>

        <!-- Import by URL -->
        <section id="mmx-tab-import" class="mmx-tab-panel" role="tabpanel" aria-labelledby="mmx-tabbtn-import"
            hidden>
            <div class="mmx-tab-body">
                <div class="mmx-uploader mmx-uploader-url">
                    <input type="url" id="mmx-upload-url"
                        placeholder="ألصق رابط الملف (صورة/فيديو/صوت/ملف أو YouTube)" />
                    <input type="text" id="mmx-url-name" placeholder="اسم/عنوان للوسيط (اختياري)" />
                    <input type="text" id="mmx-url-alt" placeholder="النص البديل ALT (اختياري)" />
                    <div class="mmx-uploader-actions">
                        <button class="mmx-btn mmx-btn-secondary" type="button" id="mmx-btn-import-to-gallery"
                            title="استيراد بالرابط ثم عرض في المعرض">
                            استيراد & فتح المعرض
                        </button>
                        <button class="mmx-btn mmx-btn-primary" type="button" id="mmx-btn-import-and-select-close"
                            title="استيراد بالرابط ثم حفظ وإغلاق">
                            استيراد & حفظ وإغلاق
                        </button>
                    </div>
                    <small class="mmx-selection-hint">
                        يقبل روابط مباشرة للملفات أو روابط YouTube. سيُحفظ <strong>الاسم</strong> و<strong>ALT</strong>
                        إن قدّمتهما.
                    </small>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    /* ===== MMX NAMESPACE – neutral white/grey, no rounded corners ===== */
    #mmxMediaModal,
    #mmxMediaModal * {
        box-sizing: border-box;
    }

    #mmxMediaModal * {
        border-radius: 0 !important;
    }

    :root {
        --mmx-bg: #fff;
        --mmx-text: #111;
        --mmx-border: #e5e7eb;
        --mmx-ring: #d1d5db;
        --mmx-muted: #6b7280;
        --mmx-black: #111;
        --mmx-black-strong: #000;
    }

    .mmx-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 10000;
    }

    .mmx-modal[aria-hidden="false"] {
        display: block;
    }

    .mmx-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        z-index: 0;
    }

    .mmx-container {
        position: absolute;
        inset: auto 0;
        top: 5%;
        margin: 0 auto;
        width: clamp(320px, 92vw, 1000px);
        max-height: 90%;
        background: var(--mmx-bg);
        color: var(--mmx-text);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        animation: mmxFade .2s ease-out;
    }

    @keyframes mmxFade {
        from {
            opacity: 0;
            transform: translateY(-14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mmx-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--mmx-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
    }

    .mmx-header h5 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 600;
    }

    .mmx-close {
        font-size: 1.4rem;
        line-height: 1;
        border: 0;
        background: transparent;
        color: #666;
        cursor: pointer;
    }

    .mmx-close:hover {
        color: #000;
    }

    .mmx-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--mmx-border);
        background: #fff;
    }

    .mmx-tab-btn {
        appearance: none;
        background: #fff;
        border: 1px solid var(--mmx-border);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--mmx-text);
    }

    .mmx-tab-btn:focus {
        outline: 2px solid var(--mmx-ring);
        outline-offset: 1px;
    }

    .mmx-tab-btn.mmx-is-active {
        border-color: #dcdcdc;
    }

    .mmx-tab-panel {
        display: block;
    }

    .mmx-tab-panel[hidden] {
        display: none;
    }

    .mmx-tab-body {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--mmx-border);
        background: #fff;
    }

    .mmx-filters {
        padding: 1rem 1.25rem;
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--mmx-border);
        background: #fff;
    }

    .mmx-filters input,
    .mmx-filters select {
        padding: .6rem .7rem;
        font-size: .95rem;
        border: 1px solid #dcdcdc;
        background: #fff;
        color: var(--mmx-text);
        flex: 1 1 180px;
        transition: box-shadow .15s, border-color .15s;
    }

    .mmx-filters input::placeholder {
        color: var(--mmx-muted);
    }

    .mmx-filters input:focus,
    .mmx-filters select:focus {
        border-color: #cfcfcf;
        box-shadow: 0 0 0 2px var(--mmx-ring);
        outline: none;
    }

    .mmx-body {
        padding: 1rem 1.25rem;
        overflow: auto;
        flex: 1;
        background: #fff;
    }

    .mmx-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: .9rem;
    }

    .mmx-empty {
        text-align: center;
        color: var(--mmx-muted);
        font-size: .95rem;
        margin: 2rem 0;
    }

    .mmx-item {
        position: relative;
        border: 1px solid var(--mmx-border);
        background: #fff;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: .6rem;
        transition: border-color .15s, transform .04s ease, box-shadow .15s;
    }

    .mmx-item:hover {
        border-color: #cfcfcf;
        box-shadow: 0 0 0 3px #f3f4f6;
    }

    .mmx-item:active {
        transform: scale(.995);
    }

    .mmx-item.mmx-is-selected {
        border-color: #cfcfcf;
        box-shadow: 0 0 0 3px #e5e7eb;
    }

    .mmx-thumb {
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

    .mmx-thumb img,
    .mmx-thumb video {
        max-width: 100%;
        max-height: 100%;
    }

    .mmx-thumb audio {
        width: 100%;
    }

    .mmx-title {
        font-size: .9rem;
        color: #374151;
        margin-top: .55rem;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mmx-selection {
        border: 1px solid var(--mmx-border);
        background: #fff;
        padding: .9rem 1rem;
        margin-bottom: .9rem;
    }

    .mmx-selection-title {
        font-weight: 600;
        margin-bottom: .65rem;
        color: #111;
    }

    .mmx-selection-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: .6rem;
    }

    .mmx-selection-grid input {
        padding: .55rem .65rem;
        border: 1px solid #dcdcdc;
        background: #fff;
    }

    .mmx-selection-grid input::placeholder {
        color: #9ca3af;
    }

    .mmx-selection-hint {
        color: var(--mmx-muted);
        display: block;
        margin-top: .35rem;
    }

    .mmx-uploader {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .6rem;
        background: #fff;
        border: 1px solid var(--mmx-border);
        padding: 1rem;
    }

    .mmx-uploader-url {
        border-style: solid;
    }

    #mmx-upload-input {
        flex: 1 1 220px;
    }

    #mmx-upload-name,
    #mmx-upload-alt {
        flex: 1 1 200px;
    }

    #mmx-upload-url,
    #mmx-url-name,
    #mmx-url-alt {
        flex: 1 1 220px;
    }

    .mmx-uploader-actions {
        display: flex;
        gap: .6rem;
    }

    .mmx-btn {
        padding: .6rem 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        border: 1px solid var(--mmx-black);
        background: var(--mmx-black);
        color: #fff;
    }

    .mmx-btn:hover {
        background: var(--mmx-black-strong);
        border-color: var(--mmx-black-strong);
    }

    .mmx-btn-secondary {
        background: #444;
        border-color: #444;
    }

    .mmx-btn-secondary:hover {
        background: #222;
        border-color: #222;
    }

    .mmx-btn-primary {
        background: var(--mmx-black);
        border-color: var(--mmx-black);
    }

    .mmx-footer {
        padding: 1rem 1.25rem;
        background: #fff;
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        border-top: 1px solid var(--mmx-border);
    }

    .mmx-btn-select {
        background: #fff;
        color: var(--mmx-black);
        border-color: var(--mmx-black);
    }

    .mmx-btn-select:hover {
        background: #f5f5f5;
    }

    .mmx-btn-cancel {
        background: #444;
        border-color: #444;
        color: #fff;
    }

    .mmx-btn-cancel:hover {
        background: #222;
        border-color: #222;
    }

    .mmx-loader {
        text-align: center;
        color: var(--mmx-muted);
        padding: .75rem;
        font-size: .95rem;
    }

    .mmx-sentinel {
        height: 1px;
    }

    @media (max-width: 768px) {
        .mmx-container {
            top: 2%;
            max-height: 96%;
        }

        .mmx-tabs {
            flex-wrap: wrap;
        }

        .mmx-filters {
            flex-direction: column;
        }

        .mmx-filters input,
        .mmx-filters select,
        .mmx-uploader {
            width: 100%;
        }

        .mmx-uploader {
            flex-direction: column;
            align-items: stretch;
        }

        .mmx-uploader-actions {
            width: 100%;
        }

        .mmx-uploader-actions .mmx-btn {
            width: 100%;
        }
    }
</style>

<script>
    (() => {
        // ===== Configure your endpoints =====
        const FETCH_URL = "{{ route('dashboard.media.getAllMediaPaginated') }}";
        const UPLOAD_URL = ""; // définissez l’URL de l’upload
        const IMPORT_URL = ""; // définissez l’URL d’import par lien

        const modal = document.getElementById("mmxMediaModal");
        const backdrop = modal.querySelector("[data-mmx-backdrop]");
        const closes = modal.querySelectorAll("[data-mmx-close]");
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        // Elements — gallery
        const listEl = document.getElementById("mmx-list");
        const loaderEl = document.getElementById("mmx-loader");
        const sentinel = document.getElementById("mmx-sentinel");
        const searchInput = document.getElementById("mmx-search");
        const typeSelect = document.getElementById("mmx-type-filter");
        const btnSelect = document.getElementById("mmx-btn-select");
        const selectionPanel = document.getElementById("mmx-selection");
        const selectedNameEl = document.getElementById("mmx-selected-name");
        const selectedAltEl = document.getElementById("mmx-selected-alt");

        // Elements — upload
        const uploadInput = document.getElementById("mmx-upload-input");
        const uploadName = document.getElementById("mmx-upload-name");
        const uploadAlt = document.getElementById("mmx-upload-alt");
        const btnUploadToGallery = document.getElementById("mmx-btn-upload-to-gallery");
        const btnUploadSelectAndClose = document.getElementById("mmx-btn-upload-and-select-close");

        // Elements — import by URL
        const uploadUrlInput = document.getElementById("mmx-upload-url");
        const urlNameInput = document.getElementById("mmx-url-name");
        const urlAltInput = document.getElementById("mmx-url-alt");
        const btnImportToGallery = document.getElementById("mmx-btn-import-to-gallery");
        const btnImportSelectAndClose = document.getElementById("mmx-btn-import-and-select-close");

        // Tabs
        const tabButtons = Array.from(modal.querySelectorAll('.mmx-tab-btn'));
        const tabPanels = {
            gallery: document.getElementById('mmx-tab-gallery'),
            upload: document.getElementById('mmx-tab-upload'),
            import: document.getElementById('mmx-tab-import'),
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
            currentField: "",
            observer: null,
            activeTab: 'gallery',
            selectedMeta: {
                name: "",
                alt: ""
            }
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
        const mapFilterForServer = (t) => (t === "voice" ? "audio" : t);

        // Public API (namespaced)
        window.mmxMediaModalManager = {
            openModal(fieldName) {
                openModal(fieldName);
            },
            closeModal() {
                closeModal();
            },
            onMediaSelected(payload) {
                // Override this in your page if needed:
                // window.mmxMediaModalManager.onMediaSelected = ({id,url,title,alt}) => { ... }
                // Default: no-op
                if (window.mediaTabManager && typeof window.mediaTabManager.onMediaSelected === "function") {
                    // Compat: call legacy handler if present
                    window.mediaTabManager.onMediaSelected(payload);
                }
            }
        };

        // Open/Close
        function openModal(fieldName = "") {
            state.currentField = fieldName;
            state.isOpen = true;
            modal.setAttribute("aria-hidden", "false");
            document.documentElement.style.overflow = "hidden";
            switchTab('gallery');
            resetAndLoad();
            setTimeout(() => {
                document.getElementById("mmx-search")?.focus();
            }, 0);
        }

        function closeModal() {
            state.isOpen = false;
            modal.setAttribute("aria-hidden", "true");
            document.documentElement.style.overflow = "";
            state.selected = null;
            state.selectedMeta = {
                name: "",
                alt: ""
            };
            selectionPanel.hidden = true;
        }
        backdrop.addEventListener("click", closeModal);
        closes.forEach(b => b.addEventListener("click", closeModal));
        modal.querySelector(".mmx-container").addEventListener("click", e => e.stopPropagation());
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
        tabButtons.forEach(btn => btn.addEventListener('click', () => switchTab(btn.dataset.mmxTab)));

        function switchTab(tab) {
            if (!tabPanels[tab]) return;
            state.activeTab = tab;
            tabButtons.forEach(b => {
                const active = b.dataset.mmxTab === tab;
                b.classList.toggle('mmx-is-active', active);
                b.setAttribute('aria-selected', String(active));
                b.tabIndex = active ? 0 : -1;
            });
            Object.entries(tabPanels).forEach(([name, panel]) => {
                panel.hidden = (name !== tab);
            });
        }

        // Fetch/paginate
        function resetAndLoad() {
            state.page = 1;
            state.hasMore = true;
            state.list = [];
            renderList();
            loadMore(true);
            setupObserver();
        }

        function setupObserver() {
            if (state.observer) state.observer.disconnect();
            state.observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) loadMore();
                });
            }, {
                root: tabPanels.gallery.querySelector(".mmx-body"),
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
                listEl.innerHTML = `<div class="mmx-empty">لا توجد وسائط للعرض</div>`;
                return;
            }
            filtered.forEach(media => {
                const kind = getMediaKind(media);
                const item = document.createElement("div");
                item.className = "mmx-item";
                if (state.selected && state.selected.id === media.id) item.classList.add("mmx-is-selected");
                item.addEventListener("click", () => toggleSelect(media));

                const thumb = document.createElement("div");
                thumb.className = "mmx-thumb";

                if (media.path && isYouTubeUrl(media.path)) {
                    const vid = getYouTubeId(media.path);
                    const img = document.createElement("img");
                    img.src = `https://img.youtube.com/vi/${vid}/hqdefault.jpg`;
                    img.alt = media.name || "YouTube";
                    img.loading = "lazy";
                    thumb.appendChild(img);
                } else if (kind === "image") {
                    thumb.innerHTML =
                        `<img src="${media.path}" alt="${media.alt || media.name || ""}" loading="lazy">`;
                } else if (kind === "video") {
                    if (/\.(mp4|webm|mkv|mov|avi|m4v)(\?|$)/i.test(media.path || "")) {
                        thumb.innerHTML = `<video src="${media.path}" muted preload="metadata"></video>`;
                    } else {
                        thumb.innerHTML = ``;
                    }
                } else if (kind === "voice") {
                    thumb.innerHTML = `<audio src="${media.path}" preload="metadata" controls></audio>`;
                } else {
                    thumb.innerHTML = ``;
                }
                item.appendChild(thumb);

                const title = document.createElement("div");
                title.className = "mmx-title";
                title.textContent = media.name || "";
                item.appendChild(title);

                listEl.appendChild(item);
            });
        }

        function toggleSelect(media) {
            const isSame = state.selected && state.selected.id === media.id;
            state.selected = isSame ? null : media;

            if (state.selected) {
                state.selectedMeta.name = state.selected.name || "";
                state.selectedMeta.alt = state.selected.alt || "";
                selectedNameEl.value = state.selectedMeta.name;
                selectedAltEl.value = state.selectedMeta.alt;
                selectionPanel.hidden = false;
            } else {
                selectionPanel.hidden = true;
                state.selectedMeta = {
                    name: "",
                    alt: ""
                };
            }
            renderList();
        }

        // Sync detail panel
        selectedNameEl?.addEventListener("input", e => {
            state.selectedMeta.name = e.target.value;
        });
        selectedAltEl?.addEventListener("input", e => {
            state.selectedMeta.alt = e.target.value;
        });

        // Search/filter (gallery)
        searchInput?.addEventListener("input", e => {
            state.search = e.target.value;
            state.page = 1;
            state.hasMore = true;
            loadMore(true);
        });
        typeSelect?.addEventListener("change", e => {
            state.type = e.target.value;
            state.page = 1;
            state.hasMore = true;
            loadMore(true);
        });

        // Final select
        btnSelect?.addEventListener("click", () => {
            if (!state.selected) {
                alert("يرجى اختيار وسيط واحد على الأقل.");
                return;
            }
            const title = state.selectedMeta.name?.trim() || state.selected.name || "";
            const alt = state.selectedMeta.alt?.trim() || state.selected.alt || "";
            window.mmxMediaModalManager.onMediaSelected({
                id: state.selected.id,
                url: state.selected.path,
                title,
                alt
            });
            closeModal();
        });

        // Upload
        async function uploadMediaAndHandle(mode) {
            const files = uploadInput.files;
            if (!files || !files.length) {
                alert("يرجى اختيار ملف واحد على الأقل قبل الرفع.");
                return;
            }
            const form = new FormData();
            for (const f of files) form.append("files[]", f);
            const nameVal = uploadName.value.trim();
            const altVal = uploadAlt.value.trim();
            if (nameVal) form.append("name", nameVal);
            if (altVal) form.append("alt", altVal);

            try {
                btnUploadToGallery.disabled = true;
                btnUploadSelectAndClose.disabled = true;
                btnUploadToGallery.textContent = "جارٍ الرفع...";
                btnUploadSelectAndClose.textContent = "جارٍ الرفع...";
                const res = await fetch(UPLOAD_URL, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": CSRF
                    },
                    body: form
                });
                if (!res.ok) {
                    console.error("Upload failed:", await res.text());
                    alert("فشل رفع الملف.");
                    return;
                }
                const payload = await res.json();
                let created = Array.isArray(payload?.data) ? payload.data :
                    Array.isArray(payload?.media) ? payload.media :
                    payload?.data ? [payload.data] :
                    payload?.media ? [payload.media] : [];
                if (!created.length) {
                    console.warn("Unexpected upload response:", payload);
                    alert("تم الرفع لكن لم أتعرف على الاستجابة.");
                    return;
                }
                created = created.map(m => ({
                    ...m,
                    name: nameVal || m.name,
                    alt: altVal || m.alt
                }));

                if (mode === 'gallery') {
                    state.list = created.concat(state.list);
                    switchTab('gallery');
                    renderList();
                    uploadInput.value = "";
                    uploadName.value = "";
                    uploadAlt.value = "";
                    alert("تم الرفع بنجاح. تم تحديث المعرض.");
                } else {
                    const first = created[0];
                    if (first) {
                        window.mmxMediaModalManager.onMediaSelected({
                            id: first.id,
                            url: first.path,
                            title: first.name || nameVal || "",
                            alt: first.alt || altVal || ""
                        });
                        closeModal();
                    } else {
                        alert("تم الرفع، لكن لم أستطع تحديد العنصر.");
                    }
                }
            } catch (err) {
                console.error(err);
                alert("حدث خطأ أثناء الرفع.");
            } finally {
                btnUploadToGallery.disabled = false;
                btnUploadSelectAndClose.disabled = false;
                btnUploadToGallery.textContent = "رفع & فتح المعرض";
                btnUploadSelectAndClose.textContent = "رفع & حفظ وإغلاق";
            }
        }

        // Import via URL
        async function importViaUrl(mode) {
            const urlVal = (uploadUrlInput.value || "").trim();
            if (!urlVal) {
                alert("يرجى إدخال رابط صالح أولًا.");
                return;
            }
            const nameVal = (urlNameInput.value || "").trim();
            const altVal = (urlAltInput.value || "").trim();

            try {
                btnImportToGallery.disabled = true;
                btnImportSelectAndClose.disabled = true;
                btnImportToGallery.textContent = "جارٍ الاستيراد...";
                btnImportSelectAndClose.textContent = "جارٍ الاستيراد...";
                const res = await fetch(IMPORT_URL, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": CSRF,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        url: urlVal,
                        name: nameVal || undefined,
                        alt: altVal || undefined
                    })
                });
                if (!res.ok) {
                    console.error("Import failed:", await res.text());
                    alert("فشل استيراد الرابط.");
                    return;
                }
                const payload = await res.json();
                let created = Array.isArray(payload?.data) ? payload.data :
                    Array.isArray(payload?.media) ? payload.media :
                    payload?.data ? [payload.data] :
                    payload?.media ? [payload.media] : [];
                if (!created.length) {
                    console.warn("Unexpected import response:", payload);
                    alert("تم الاستيراد لكن لم أتعرف على الاستجابة.");
                    return;
                }
                created = created.map(m => ({
                    ...m,
                    name: nameVal || m.name,
                    alt: altVal || m.alt
                }));

                if (mode === 'gallery') {
                    state.list = created.concat(state.list);
                    switchTab('gallery');
                    renderList();
                    uploadUrlInput.value = "";
                    urlNameInput.value = "";
                    urlAltInput.value = "";
                    alert("تم الاستيراد بنجاح. تم تحديث المعرض.");
                } else {
                    const first = created[0];
                    if (first) {
                        window.mmxMediaModalManager.onMediaSelected({
                            id: first.id,
                            url: first.path,
                            title: first.name || nameVal || "",
                            alt: first.alt || altVal || ""
                        });
                        closeModal();
                    } else {
                        alert("تم الاستيراد، لكن لم أستطع تحديد العنصر.");
                    }
                }
            } catch (err) {
                console.error(err);
                alert("حدث خطأ أثناء الاستيراد.");
            } finally {
                btnImportToGallery.disabled = false;
                btnImportSelectAndClose.disabled = false;
                btnImportToGallery.textContent = "استيراد & فتح المعرض";
                btnImportSelectAndClose.textContent = "استيراد & حفظ وإغلاق";
            }
        }

        // Bind actions
        btnUploadToGallery?.addEventListener("click", () => uploadMediaAndHandle('gallery'));
        btnUploadSelectAndClose?.addEventListener("click", () => uploadMediaAndHandle('select-close'));
        btnImportToGallery?.addEventListener("click", () => importViaUrl('gallery'));
        btnImportSelectAndClose?.addEventListener("click", () => importViaUrl('select-close'));

        // Initial empty render
        function renderListEmpty() {
            listEl.innerHTML = `<div class="mmx-empty">لا توجد وسائط للعرض</div>`;
        }

        function renderListIfEmpty() {
            if (!state.list.length) renderListEmpty();
        }
        (function init() {
            renderListIfEmpty();
        })();
    })();
</script>
