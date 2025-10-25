<!-- ================== VVC MEDIA MODAL + TinyMCE 8 (Images & Videos Only, Small by default) ================== -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ====== Icons Sprite (Images & Videos only) ====== -->
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

        <!-- Tabs (Gallery / Upload only) -->
        <div class="vvc-tabs" role="tablist" aria-label="أقسام إدارة الوسائط">
            <button type="button" class="vvc-tab-btn vvc-is-active" role="tab" aria-selected="true"
                aria-controls="vvc-tab-gallery" id="vvc-tabbtn-gallery" tabindex="0"
                data-vvc-tab="gallery">المعرض</button>
            <button type="button" class="vvc-tab-btn" role="tab" aria-selected="false"
                aria-controls="vvc-tab-upload" id="vvc-tabbtn-upload" tabindex="-1" data-vvc-tab="upload">الرفع من
                الجهاز</button>
        </div>

        <!-- Gallery -->
        <section id="vvc-tab-gallery" class="vvc-tab-panel" role="tabpanel" aria-labelledby="vvc-tabbtn-gallery">
            <div class="vvc-filters">
                <input type="text" id="vvc-search" placeholder="ابحث عن وسائط..." />
                <select id="vvc-type-filter" aria-label="نوع الوسائط">
                    <option value="all">كل الوسائط</option>
                    <option value="image">صورة</option>
                    <option value="video">فيديو</option>
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
        <section id="vvc-tab-upload" class="vvc-tab-panel" role="tabpanel" aria-labelledby="vvc-tabbtn-upload" hidden>
            <div class="vvc-tab-body">
                <div class="vvc-uploader">
                    <div class="vvc-upload-fields" style="display:flex; flex-wrap:wrap; gap:.6rem; width:100%;">
                        <div style="flex:1 1 260px;">
                            <label for="vvc-upload-input"
                                style="display:block; width:100%; cursor:pointer; padding:.6rem .7rem; border:1px solid var(--vvc-border-color); background:var(--vvc-gray-100); color:var(--vvc-body-color); text-align:center;">
                                <i class="fa fa-upload" style="margin-right:6px;"></i> اختر ملف الوسائط
                                <input type="file" id="vvc-upload-input" class="vvc-upload-input"
                                    accept="image/*,video/*" style="display:none;" />
                            </label>
                        </div>
                        <div style="flex:1 1 220px;">
                            <input type="text" id="vvc-upload-name" class="vvc-upload-name"
                                placeholder="اسم الملف"
                                style="width:100%; padding:.6rem .7rem; border:1px solid var(--vvc-border-color); background:var(--vvc-body-bg); color:var(--vvc-body-color);" />
                        </div>
                        <div style="flex:1 1 220px;">
                            <input type="text" id="vvc-upload-alt" class="vvc-upload-alt"
                                placeholder="النص البديل (للصور)"
                                style="width:100%; padding:.6rem .7rem; border:1px solid var(--vvc-border-color); background:var(--vvc-body-bg); color:var(--vvc-body-color);" />
                        </div>
                    </div>
                    <div class="vvc-uploader-actions">
                        <button class="vvc-btn vvc-btn-primary" type="button" id="vvc-btn-upload-to-gallery"
                            title="رفع ثم عرض في المعرض">
                            إدراج في المعرض </button>
                    </div>
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
        /* Updated color palette */
        --vvc-primary: #6576ff;
        --vvc-secondary: #364a63;
        --vvc-success: #1ee0ac;
        --vvc-info: #09c2de;
        --vvc-warning: #f4bd0e;
        --vvc-danger: #e85347;
        --vvc-light: #e5e9f2;
        --vvc-dark: #1f2b3a;
        --vvc-gray: #8091a7;
        --vvc-lighter: #f5f6fa;

        --vvc-gray-100: #ebeef2;
        --vvc-gray-200: #e5e9f2;
        --vvc-gray-300: #dbdfea;
        --vvc-gray-400: #b7c2d0;
        --vvc-gray-500: #8091a7;
        --vvc-gray-600: #3c4d62;
        --vvc-gray-700: #344357;
        --vvc-gray-800: #2b3748;
        --vvc-gray-900: #1f2b3a;

        --vvc-body-bg: #fff;
        --vvc-body-color: #526484;
        --vvc-heading-color: #364a63;
        --vvc-border-color: #dbdfea;
        --vvc-muted: #8091a7;
    }

    [data-bs-theme="dark"] {
        --vvc-body-bg: #0D141D;
        --vvc-body-color: #e5e9f2;
        --vvc-heading-color: #fff;
        --vvc-border-color: #384D69;
        --vvc-muted: #b7c2d0;
        --vvc-gray-100: #2b3748;
        --vvc-gray-200: #344357;
        --vvc-gray-300: #3c4d62;
    }

    .vvc-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 10000;
    }

    .vvc-modal[aria-hidden="false"] {
        display: block
    }

    .vvc-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        z-index: 0
    }

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
        border-bottom: 1px solid var(--vvc-border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--vvc-body-bg)
    }

    .vvc-header h5 {
        color: var(--vvc-heading-color);
        margin: 0;
    }

    .vvc-close {
        font-size: 1.4rem;
        border: 0;
        background: transparent;
        color: var(--vvc-gray-500);
        cursor: pointer
    }

    .vvc-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg)
    }

    .vvc-tab-btn {
        background: var(--vvc-body-bg);
        border: 1px solid var(--vvc-border-color);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--vvc-body-color)
    }

    .vvc-tab-btn.vvc-is-active {
        background: var(--vvc-primary);
        border-color: var(--vvc-primary);
        color: white;
    }

    .vvc-tab-panel {
        display: block
    }

    .vvc-tab-panel[hidden] {
        display: none
    }

    .vvc-tab-body {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg)
    }

    .vvc-filters {
        padding: 1rem 1.25rem;
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg)
    }

    .vvc-filters input,
    .vvc-filters select {
        padding: .6rem .7rem;
        font-size: .95rem;
        border: 1px solid var(--vvc-border-color);
        background: var(--vvc-body-bg);
        color: var(--vvc-body-color);
        flex: 1 1 180px
    }

    .vvc-body {
        padding: 1rem 1.25rem;
        overflow: auto;
        flex: 1;
        background: var(--vvc-body-bg)
    }

    .vvc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: .9rem
    }

    .vvc-empty {
        text-align: center;
        color: var(--vvc-muted);
        font-size: .95rem;
        margin: 2rem 0
    }

    .vvc-item {
        position: relative;
        background: var(--vvc-body-bg);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: .6rem
    }

    .vvc-item:hover {
        border-color: var(--vvc-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.1)
    }

    .vvc-item.vvc-is-selected {
        border-color: var(--vvc-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.2)
    }

    .vvc-thumb {
        width: 100%;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--vvc-gray-100);
        overflow: hidden;
        position: relative;
        border: 1px solid var(--vvc-gray-200)
    }

    .vvc-thumb img,
    .vvc-thumb video {
        max-width: 100%;
        max-height: 100%
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
        border: 1px solid rgba(255, 255, 255, .2)
    }

    .vvc-title {
        font-size: .9rem;
        color: var(--vvc-heading-color);
        margin-top: .55rem;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis
    }

    .vvc-uploader {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .6rem;
        background: var(--vvc-body-bg);
        border: 1px solid var(--vvc-border-color);
        padding: 1rem
    }

    .vvc-uploader-actions {
        display: flex;
        gap: .6rem
    }

    .vvc-btn {
        padding: .6rem 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        border: 1px solid transparent;
        background: var(--vvc-primary);
        color: #fff
    }

    .vvc-btn:hover {
        background: #465fff;
        border-color: #465fff
    }

    .vvc-btn-secondary {
        background: var(--vvc-secondary);
        border-color: var(--vvc-secondary)
    }

    .vvc-btn-secondary:hover {
        background: #2b3748;
        border-color: #2b3748
    }

    .vvc-btn-primary {
        background: var(--vvc-primary);
        border-color: var(--vvc-primary)
    }

    .vvc-footer {
        padding: 1rem 1.25rem;
        background: var(--vvc-body-bg);
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        border-top: 1px solid var(--vvc-border-color)
    }

    .vvc-btn-select {
        background: var(--vvc-primary);
        color: #fff;
        border-color: var(--vvc-primary)
    }

    .vvc-btn-select:hover {
        background: #465fff;
        border-color: #465fff
    }

    .vvc-btn-cancel {
        background: var(--vvc-secondary);
        border-color: var(--vvc-secondary);
        color: #fff;
    }

    .vvc-btn-cancel:hover {
        background: #2b3748;
        border-color: #2b3748;
    }

    .vvc-loader {
        text-align: center;
        color: var(--vvc-muted);
        padding: .75rem;
        font-size: .95rem
    }

    .vvc-sentinel {
        height: 1px
    }

    @media (max-width:768px) {
        .vvc-container {
            top: 2%;
            max-height: 96%
        }

        .vvc-tabs {
            flex-wrap: wrap
        }

        .vvc-filters {
            flex-direction: column
        }

        .vvc-uploader-actions .vvc-btn {
            width: 100%
        }
    }
</style>

<!-- ====== Modal Logic (Gallery + Upload; small-size insertions) ====== -->
<script>
    (function() {
        // ---------- Endpoints (Laravel) ----------
        const FETCH_URL = "{{ route('dashboard.media.getAllMediaPaginated') }}";
        const UPLOAD_URL = "{{ route('dashboard.media.store') }}";
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content') || '';

        // ---------- Elements ----------
        const modal = document.getElementById("vvcMediaModal");
        const backdrop = modal.querySelector('[data-vvc-backdrop]');
        const closes = modal.querySelectorAll('[data-vvc-close]');
        const container = modal.querySelector('.vvc-container');

        // Gallery
        const listEl = document.getElementById('vvc-list');
        const loaderEl = document.getElementById('vvc-loader');
        const sentinel = document.getElementById('vvc-sentinel');
        const searchInp = document.getElementById('vvc-search');
        const typeSel = document.getElementById('vvc-type-filter');
        const btnSelect = document.getElementById('vvc-btn-select');

        // Upload
        const upInput = document.getElementById('vvc-upload-input');
        const upName = document.getElementById('vvc-upload-name');
        const upAlt = document.getElementById('vvc-upload-alt');
        const btnUpGal = document.getElementById('vvc-btn-upload-to-gallery');

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
        const extFromPath = (p = "") => (p.split('?')[0].split('.').pop() || "").toLowerCase();
        const toAbsoluteUrl = (u) => {
            if (!u) return u;
            if (/^https?:\/\//i.test(u)) return u;
            return `${window.location.origin}${u.startsWith('/')?'':'/'}${u}`;
        };

        function getMediaKind(m) {
            const mt = (m.media_type || '').toLowerCase();
            if (mt === 'image' || mt === 'video') return mt;
            const ext = extFromPath(m.path || m.url || '');
            if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].includes(ext)) return 'image';
            if (['mp4', 'webm', 'mkv', 'mov', 'avi', 'm4v'].includes(ext)) return 'video';
            return 'video';
        }
        const getBadgeIconId = (m) => (getMediaKind(m) === 'image' ? 'vvc-icon-image' : 'vvc-icon-video');

        // ---------- Public API ----------
        window.vvcMediaModalManager = {
            openModal(fieldName = "") {
                openModal(fieldName);
            },
            closeModal() {
                closeModal();
            },
            onMediaSelected(payload) {
                const normalized = {
                    url: payload.url,
                    title: payload.title || "",
                    alt: payload.alt || "",
                    type: (payload.type === 'image' ? 'image' : 'video')
                };

                // A) Bridge TinyMCE (promise)
                if (typeof window._resolveTinyPick === 'function') {
                    const resolver = window._resolveTinyPick;
                    window._resolveTinyPick = null;
                    window._tinyRequestedType = null;
                    resolver(normalized);
                    closeModal();
                    return;
                }

                // B) Insertion directe TinyMCE (avec petite taille par défaut)
                if (window.tinymce && tinymce.activeEditor && normalized.url) {
                    try {
                        tinymce.activeEditor.focus();
                        const isImg = /\.(png|jpe?g|webp|gif|bmp|svg)(\?|$)/i.test(normalized.url);
                        if (isImg) {
                            tinymce.activeEditor.execCommand('mceInsertContent', false,
                                `<img class="tiny-sm" src="${escapeHtml(normalized.url)}" alt="${escapeHtml(normalized.alt||normalized.title)}" title="${escapeHtml(normalized.title)}"/>`
                            );
                        } else {
                            tinymce.activeEditor.execCommand('mceInsertContent', false,
                                `<video class="tiny-sm" src="${escapeHtml(normalized.url)}" controls preload="metadata"></video>`
                            );
                        }
                        closeModal();
                    } catch (e) {
                        console.error('Tiny insert failed:', e);
                    }
                    return;
                }

                // C) Callback externe éventuel
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
            modal.setAttribute('aria-hidden', 'false');
            document.documentElement.style.overflow = 'hidden';
            resetState();
            if (window._tinyRequestedType === 'image') {
                state.type = 'image';
                const sel = document.getElementById('vvc-type-filter');
                if (sel) sel.value = 'image';
            }
            switchTab('gallery');
            resetAndLoad();
            setTimeout(() => document.getElementById('vvc-search')?.focus(), 0);
        }

        function closeModal() {
            state.isOpen = false;
            modal.setAttribute('aria-hidden', 'true');
            document.documentElement.style.overflow = '';
            resetState();
        }
        backdrop.addEventListener('click', closeModal);
        closes.forEach(b => b.addEventListener('click', closeModal));
        container.addEventListener('click', e => e.stopPropagation());
        document.addEventListener('keydown', e => {
            if (!state.isOpen) return;
            if (e.key === 'Escape') closeModal();
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

        // ---------- Tabs ----------
        document.querySelectorAll('.vvc-tab-btn').forEach(btn => btn.addEventListener('click', () => switchTab(btn
            .dataset.vvcTab)));

        function switchTab(tab) {
            const panels = {
                gallery: document.getElementById('vvc-tab-gallery'),
                upload: document.getElementById('vvc-tab-upload')
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

        // ---------- Render ----------
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

                const thumb = document.createElement('div');
                thumb.className = 'vvc-thumb';
                const badge = document.createElement('div');
                badge.className = 'vvc-badge';
                badge.title = kind;
                badge.innerHTML =
                    `<svg aria-hidden="true"><use href="#${getBadgeIconId(media)}"></use></svg>`;
                thumb.appendChild(badge);

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
                    }
                }
                item.appendChild(thumb);
                const title = document.createElement('div');
                title.className = 'vvc-title';
                title.textContent = media.name || '';
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

        // ---------- Confirm Selection ----------
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

        // ---------- Upload (Images & Videos only) ----------
        async function uploadMedia(mode) {
            const files = upInput?.files;
            if (!files || !files.length) {
                alert('⚠️ لم يتم اختيار أي ملف للرفع.');
                return;
            }
            const file0 = files[0];
            const nameVal = (upName.value || '').trim() || file0.name;
            const altVal = (upAlt.value || '').trim();

            const isImg = file0.type.startsWith('image/');
            const isVid = file0.type.startsWith('video/');
            if (!isImg && !isVid) {
                alert('يُسمح فقط بالصور أو الفيديو.');
                return;
            }

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

        function tryParseJson(text) {
            if (!text) return null;
            const clean = text.replace(/^\uFEFF/, '').trim();
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

        // ---------- Bindings ----------
        btnUpGal?.addEventListener('click', () => uploadMedia('gallery'));

        // ---------- Initial ----------
        if (!state.list.length) {
            listEl.innerHTML = '<div class="vvc-empty">لا توجد وسائط للعرض</div>';
        }

        // ---------- Safe HTML escape ----------
        window.escapeHtml = function(str) {
            if (str == null) return '';
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g,
                '&quot;').replace(/'/g, '&#39;');
        };
    })();
</script>

<!-- ====== TinyMCE 8 CDN ====== -->
<script src="https://cdn.tiny.cloud/1/vw6sltzauw9x6b3cl3eby8nj99q4eoavzv581jnnmabxbhq2/tinymce/8/tinymce.min.js"
    referrerpolicy="origin" crossorigin="anonymous"></script>

<!-- ====== TinyMCE Init + Bridge (Images & Videos only, Small by default) ====== -->
<script>
    (function() {
        const theme = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';

        // Bridge TinyMCE <-> VVC (type: 'image' | 'media')
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

        tinymce.init({
            selector: 'textarea#myeditorinstance',
            directionality: 'rtl',
            height: 600,
            promotion: false,
            onboarding: false,
            auto_focus: false,

            /* ===== Style du « petit format » ===== */
            content_style: `
      body{font-family:Arial,Helvetica,sans-serif !important;font-size:18pt !important;line-height:1.6 !important;}
      figure.image{display:inline-block;}
      figcaption{font-size:.9em;color:#666;}
      /* -- Petit format par défaut -- */
      img.tiny-sm, video.tiny-sm{width:280px;height:auto;max-width:100%;}
      figure.image img.tiny-sm{width:280px;height:auto;max-width:100%;}
    `,

            setup: (editor) => {
                // Bouton custom pour ouvrir la galerie
                editor.ui.registry.addButton('vvcPicker', {
                    text: 'وسائط',
                    tooltip: 'اختيار وسائط من المعرض',
                    onAction: async () => {
                        const picked = await window.pickMediaForTiny({
                            type: 'media'
                        });
                        if (!picked || !picked.url) return;
                        const url = picked.url;
                        const title = picked.title || '';
                        const alt = picked.alt || title || '';
                        const isImg = /\.(png|jpe?g|webp|gif|bmp|svg)(\?|$)/i.test(url);
                        editor.focus();
                        if (isImg) {
                            editor.execCommand('mceInsertContent', false,
                                `<figure class="image"><img class="tiny-sm" src="${escapeHtml(url)}" alt="${escapeHtml(alt)}" title="${escapeHtml(title)}"/><figcaption>${escapeHtml(title)}</figcaption></figure>`
                            );
                        } else {
                            editor.execCommand('mceInsertContent', false,
                                `<video class="tiny-sm" src="${escapeHtml(url)}" controls preload="metadata"></video>`
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

            // Limiter aux boîtes image/media
            file_picker_types: 'image media',
            file_picker_callback: async (cb, value, meta) => {
                const picked = await window.pickMediaForTiny({
                    type: meta.filetype
                });
                if (!picked || !picked.url) return;

                // Pour les images, on force la classe tiny-sm au moment du callback
                if (meta.filetype === 'image') {
                    cb(picked.url, {
                        title: picked.title || '',
                        alt: picked.alt || '',
                        class: 'tiny-sm'
                    });
                } else {
                    // TinyMCE peut ignorer 'class' ici; insertion finale via vvcPicker est la plus fiable
                    cb(picked.url, {
                        text: picked.title || picked.url
                    });
                }
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

            // Validation (toujours assainir côté serveur)
            extended_valid_elements: 'script[src|async|charset],blockquote[class|lang|dir],iframe[src|width|height|frameborder|allowfullscreen]',
            valid_children: '+body[script],+div[script]',
            valid_elements: '*[*]'
        });
    })();
</script>
