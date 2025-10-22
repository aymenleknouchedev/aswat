<style>
    :root {
        --az-border: #e5e7eb;
        --az-muted: #6b7280
    }

    /* === Social Media preview helpers === */
    .image-preview-container img {
        max-height: 200px
    }

    /* === nbn Picker (remplace SMX) === */
    #nbnMediaPicker,
    #nbnMediaPicker * {
        box-sizing: border-box
    }

    .nbn-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 2075
    }

    .nbn-modal[aria-hidden="false"] {
        display: flex
    }

    .nbn-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .5);
        z-index: 2070
    }

    .nbn-box {
        position: relative;
        margin: auto;
        width: min(960px, 92vw);
        max-height: 90vh;
        background: #fff;
        color: #111;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: .5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        z-index: 2076
    }

    .nbn-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        border-bottom: 1px solid var(--az-border)
    }

    .nbn-x {
        background: transparent;
        border: 0;
        font-size: 1.6rem;
        cursor: pointer;
        color: #666
    }

    .nbn-tabs {
        display: flex;
        padding: 8px 16px;
        border-bottom: 1px solid var(--az-border)
    }

    .nbn-tab {
        border: 1px solid var(--az-border);
        background: #fff;
        padding: .45rem .8rem;
        cursor: pointer;
        font-weight: 600;
        margin-right: 8px;
        border-radius: .35rem
    }

    .nbn-tab.is-active {
        border-color: #cfcfcf
    }

    .nbn-panel[hidden] {
        display: none
    }

    .nbn-filters {
        display: flex;
        padding: 12px 16px;
        border-bottom: 1px solid var(--az-border)
    }

    .nbn-filters input,
    .nbn-filters select {
        border: 1px solid #dcdcdc;
        padding: .5rem .7rem;
        border-radius: .35rem
    }

    .nbn-filters input {
        margin-right: 8px;
        flex: 1 1 240px
    }

    .nbn-body {
        padding: 12px 16px;
        overflow: auto;
        flex: 1
    }

    .nbn-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr))
    }

    .nbn-item {
        border: 1px solid var(--az-border);
        padding: 8px;
        cursor: pointer;
        margin: 6px;
        border-radius: .35rem
    }

    .nbn-item.is-sel {
        box-shadow: 0 0 0 3px #e5e7eb
    }

    .nbn-thumb {
        height: 120px;
        background: #fafafa;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #f0f0f0;
        position: relative;
        border-radius: .35rem
    }

    .nbn-thumb img,
    .nbn-thumb video {
        max-width: 100%;
        max-height: 100%
    }

    .nbn-badge {
        position: absolute;
        top: 6px;
        left: 6px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        border-radius: .35rem;
        padding: 2px 6px;
        font-size: .75rem
    }

    .nbn-title {
        margin-top: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis
    }

    .nbn-foot {
        display: flex;
        justify-content: flex-end;
        padding: 12px 16px;
        border-top: 1px solid var(--az-border)
    }

    .nbn-btn {
        border: 1px solid #000;
        background: #000;
        color: #fff;
        padding: .5rem .85rem;
        font-weight: 600;
        cursor: pointer;
        margin-left: 8px;
        border-radius: .35rem
    }

    .nbn-cancel {
        background: #444;
        border-color: #444
    }

    .nbn-up {
        display: flex;
        flex-wrap: wrap;
        padding: 12px 16px;
        border-bottom: 1px solid var(--az-border)
    }

    .nbn-up input[type="file"],
    .nbn-up input[type="text"],
    .nbn-up input[type="url"] {
        border: 1px solid #dcdcdc;
        padding: .5rem .7rem;
        margin-right: 8px;
        margin-bottom: 8px;
        border-radius: .35rem
    }
</style>



<!-- ====================== SOCIAL MEDIA TAB ====================== -->
<div class="tab-pane fade show active" id="social-media" role="tabpanel" aria-labelledby="social-media-tab">
    <div class="social-media-tab-content">
        <div class="row g-3 mt-3">
            <!-- Content Image -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0">صورة المحتوى</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="share_image_url" class="form-label small text-muted">اختر صورة للمشاركة على
                                وسائل التواصل</label>
                            <div class="input-group">
                                <input type="text" id="share_image_url" name="share_image_url" class="form-control"
                                    placeholder="لم يتم الاختيار" readonly>
                                <button type="button" class="btn btn-outline-secondary" id="btnPickShareImage"
                                    title="اختيار من nbn">
                                    <i class="fas fa-images"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" id="btnClearShareImage"
                                    title="حذف">
                                    <i class="fas fa-xmark"></i>
                                </button>
                            </div>
                            <!-- Champs supplémentaires -->
                            <input type="hidden" id="share_image_id" name="share_image_id">
                            <input type="hidden" id="share_image_title" name="share_image_title">
                            <input type="hidden" id="share_image_alt" name="share_image_alt">
                        </div>

                        <div class="image-preview-container border rounded p-3 text-center bg-light">
                            <div id="share_image_preview_wrapper" class="d-none">
                                <div class="image-preview-wrapper position-relative d-inline-block">
                                    <img id="share_image_preview" src="" alt="صورة المشاركة"
                                        class="img-fluid rounded shadow-sm">
                                    <button type="button"
                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 translate-middle"
                                        onclick="removeShareImage()" title="حذف الصورة"
                                        style="border-radius:999px; line-height:1; width:28px; height:28px;">×</button>
                                </div>
                                <div class="mt-2"><small class="text-muted" id="share_image_name"></small></div>
                            </div>
                            <div id="share_image_placeholder" class="py-4">
                                <i class="fas fa-image fa-2x text-muted mb-2"></i>
                                <p class="text-muted small mb-0">لم يتم اختيار صورة بعد</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Share Content -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0">محتوى المشاركة</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="share_title" class="form-label">عنوان المشاركة</label>
                            <input type="text" id="share_title" name="share_title" class="form-control"
                                value="{{ old('share_title', '') }}" placeholder="أدخل عنوان المشاركة" maxlength="100"
                                oninput="updatePreview()">
                            <div class="form-text">سيظهر هذا العنوان عند مشاركة المحتوى على وسائل التواصل</div>
                        </div>
                        <div class="mb-0">
                            <label for="share_description" class="form-label">وصف المشاركة</label>
                            <textarea id="share_description" name="share_description" class="form-control" rows="4"
                                placeholder="أدخل وصف المشاركة" maxlength="260" oninput="updatePreview()">{{ old('share_description', '') }}</textarea>
                            <div class="form-text">سيظهر هذا الوصف عند مشاركة المحتوى على وسائل التواصل</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Preview -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">معاينة المشاركة</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="social-preview bg-white border rounded p-3">
                                    <div class="d-flex align-items-start mb-2">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width:40px;height:40px;">
                                                <i class="fas fa-globe text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <div class="fw-bold" id="preview_site_name">أصوات جزائرية</div>
                                            <div class="text-muted small">الآن</div>
                                        </div>
                                    </div>
                                    <div class="preview-content mt-2">
                                        <p class="mb-1 fw-semibold" id="preview_title">
                                            {{ old('share_title', '') ?: 'عنوان المشاركة' }}</p>
                                        <p class="small text-muted mb-2" id="preview_description">
                                            {{ old('share_description', '') ?: 'وصف المشاركة' }}</p>
                                        <div id="preview_image_container" class="mb-2 rounded overflow-hidden"
                                            style="display:none;">
                                            <img id="preview_image" src="" alt=""
                                                class="img-fluid w-100">
                                        </div>
                                        <div class="text-muted small" id="preview_url">www.algerie-voices.dz</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alert alert-info">
                                    <h6 class="alert-heading">نصائح للمشاركة</h6>
                                    <ul class="small mb-0 ps-3">
                                        <li>استخدم عناوين جذابة وواضحة</li>
                                        <li>أضف وصفاً مختصراً ومفيداً</li>
                                        <li>اختر صورة عالية الجودة</li>
                                        <li>تأكد من ظهور المحتوى بشكل صحيح</li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- /row -->
                    </div>
                </div>
            </div> <!-- /preview -->
        </div>
    </div>
</div>

<!-- ====================== nbn PICKER (Unique Modal) ====================== -->
<div id="nbnMediaPicker" class="nbn-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="nbnTitle">
    <div class="nbn-backdrop" data-nbn-backdrop></div>
    <div class="nbn-box" role="document">
        <div class="nbn-head">
            <h5 id="nbnTitle" class="mb-0">اختيار وسائط</h5>
            <button type="button" class="nbn-x" data-nbn-close aria-label="إغلاق">&times;</button>
        </div>

        <div class="nbn-tabs" role="tablist">
            <button class="nbn-tab is-active" data-nbn-tab="gallery" role="tab" aria-selected="true"
                aria-controls="nbn-panel-gallery" id="nbn-tab-gallery">المعرض</button>
            <button class="nbn-tab" data-nbn-tab="upload" role="tab" aria-selected="false"
                aria-controls="nbn-panel-upload" id="nbn-tab-upload">رفع</button>
            <button class="nbn-tab" data-nbn-tab="import" role="tab" aria-selected="false"
                aria-controls="nbn-panel-import" id="nbn-tab-import">استيراد بالرابط</button>
        </div>

        <!-- Gallery -->
        <section id="nbn-panel-gallery" class="nbn-panel" role="tabpanel" aria-labelledby="nbn-tab-gallery">
            <div class="nbn-filters">
                <input type="text" id="nbnSearch" placeholder="ابحث ...">
                <select id="nbnType">
                    <option value="all">كل الأنواع</option>
                    <option value="image" selected>صور</option>
                    <option value="video">فيديو</option>
                </select>
            </div>
            <div class="nbn-body">
                <div id="nbnList" class="nbn-grid"></div>
                <div id="nbnLoader" class="text-muted text-center py-2" hidden>...تحميل</div>
                <div id="nbnSentinel" class="nbn-sentinel"></div>
            </div>
            <div class="nbn-foot">
                <button type="button" class="nbn-btn" id="nbnChoose">اختيار</button>
                <button type="button" class="nbn-btn nbn-cancel" data-nbn-close>إلغاء</button>
            </div>
        </section>

        <!-- Upload -->
        <section id="nbn-panel-upload" class="nbn-panel" role="tabpanel" aria-labelledby="nbn-tab-upload" hidden>
            <div class="nbn-up">
                <input type="file" id="nbnUploadFile" accept="image/*,video/*">
                <input type="text" id="nbnUploadName" placeholder="اسم (اختياري)">
                <input type="text" id="nbnUploadAlt" placeholder="ALT (اختياري)">
                <div style="width:100%"></div>
                <button type="button" class="nbn-btn" id="nbnUploadToGallery">رفع & فتح المعرض</button>
                <button type="button" class="nbn-btn" id="nbnUploadAndClose">رفع & اختيار</button>
            </div>
        </section>

        <!-- Import -->
        <section id="nbn-panel-import" class="nbn-panel" role="tabpanel" aria-labelledby="nbn-tab-import" hidden>
            <div class="nbn-up">
                <input type="url" id="nbnUrl" placeholder="رابط مباشر (صورة/فيديو)">
                <input type="text" id="nbnUrlName" placeholder="اسم (اختياري)">
                <input type="text" id="nbnUrlAlt" placeholder="ALT (اختياري)">
                <div style="width:100%"></div>
                <button type="button" class="nbn-btn" id="nbnImportToGallery">استيراد & فتح المعرض</button>
                <button type="button" class="nbn-btn" id="nbnImportAndClose">استيراد & اختيار</button>
            </div>
        </section>
    </div>
</div>

<!-- ====================== Scripts ====================== -->
<script>
    (function() {
        // Routes sûres (Blade fallback)
        function azSafeRoute(possibleBladeRoute, fallbackPath) {
            try {
                if (!possibleBladeRoute || /\{\{.+\}\}/.test(possibleBladeRoute)) {
                    return new URL(fallbackPath, window.location.origin).toString();
                }
                return new URL(possibleBladeRoute, window.location.origin).toString();
            } catch (e) {
                return fallbackPath;
            }
        }
        const nbn_FETCH_URL = azSafeRoute("{{ route('dashboard.media.getAllMediaPaginated') }}",
            "/dashboard/media/paginated");
        const nbn_UPLOAD_URL = azSafeRoute("{{ route('dashboard.media.store') }}", "/dashboard/media");
        const nbn_IMPORT_URL = azSafeRoute("{{ route('dashboard.media_url.store') }}", "/dashboard/media-url");
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const CSRF = csrfMeta ? csrfMeta.getAttribute('content') : '';

        // --------- nbn core ----------
        const root = document.getElementById('nbnMediaPicker');
        if (!root) return;
        const back = root.querySelector('[data-nbn-backdrop]');
        const closes = root.querySelectorAll('[data-nbn-close]');
        const tabs = Array.from(root.querySelectorAll('.nbn-tab'));
        const panels = {
            gallery: document.getElementById('nbn-panel-gallery'),
            upload: document.getElementById('nbn-panel-upload'),
            import: document.getElementById('nbn-panel-import')
        };
        const listEl = document.getElementById('nbnList');
        const loaderEl = document.getElementById('nbnLoader');
        const sentinel = document.getElementById('nbnSentinel');
        const searchEl = document.getElementById('nbnSearch');
        const typeEl = document.getElementById('nbnType');
        const chooseBtn = document.getElementById('nbnChoose');
        const upFile = document.getElementById('nbnUploadFile');
        const upName = document.getElementById('nbnUploadName');
        const upAlt = document.getElementById('nbnUploadAlt');
        const upToGal = document.getElementById('nbnUploadToGallery');
        const upAndClose = document.getElementById('nbnUploadAndClose');
        const urlInput = document.getElementById('nbnUrl');
        const urlName = document.getElementById('nbnUrlName');
        const urlAlt = document.getElementById('nbnUrlAlt');
        const importToGal = document.getElementById('nbnImportToGallery');
        const importAndClose = document.getElementById('nbnImportAndClose');

        const state = {
            open: false,
            page: 1,
            hasMore: true,
            isLoading: false,
            list: [],
            search: '',
            type: 'all',
            selected: null,
            obs: null,
            cb: null
        };

        const YT =
            /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/i;
        const isYT = u => YT.test(u || "");
        const youId = u => u && u.match(YT) ? u.match(YT)[1] : null;
        const ext = p => (p || '').split('?')[0].split('.').pop()?.toLowerCase() || '';
        const mapType = t => t === 'voice' ? 'audio' : t;

        function kind(m) {
            const p = m.path || m.url || '';
            if (isYT(p)) return 'video';
            const mt = (m.media_type || '').toLowerCase();
            if (['image', 'video', 'audio', 'voice', 'file'].includes(mt)) return (mt === 'audio' ? 'voice' : mt);
            const e = ext(p);
            if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].includes(e)) return 'image';
            if (['mp4', 'webm', 'mkv', 'mov', 'avi', 'm4v'].includes(e)) return 'video';
            if (['mp3', 'wav', 'ogg', 'm4a', 'aac', 'flac'].includes(e)) return 'voice';
            return 'file';
        }
        const iconText = (m) => (kind(m) === 'image' ? 'IMG' : kind(m) === 'video' ? 'VID' : 'FILE');

        // Gestion onglets
        function switchTab(t) {
            tabs.forEach(b => {
                const act = b.dataset.nbnTab === t;
                b.classList.toggle('is-active', act);
                b.setAttribute('aria-selected', String(act));
            });
            Object.entries(panels).forEach(([k, el]) => el && (el.hidden = (k !== t)));
        }
        tabs.forEach(b => b.addEventListener('click', () => switchTab(b.dataset.nbnTab)));

        // Verrouillage scroll
        function lock() {
            document.documentElement.style.overflow = 'hidden';
            document.body.classList.add('modal-open');
        }

        function unlock() {
            document.documentElement.style.overflow = '';
            document.body.classList.remove('modal-open');
        }

        // Masquer/Restaurer modal Bootstrap parent (si présent)
        let prevModal = null,
            restore = false;

        function hideParent() {
            try {
                const shown = document.querySelector('.modal.show');
                if (shown && window.bootstrap?.Modal) {
                    window.bootstrap.Modal.getOrCreateInstance(shown).hide();
                    prevModal = shown;
                    restore = true;
                    setTimeout(() => {
                        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                        document.body.classList.remove('modal-open');
                        document.documentElement.style.overflow = '';
                    }, 150);
                }
            } catch (e) {}
        }

        function showParent() {
            try {
                if (restore && prevModal && window.bootstrap?.Modal) {
                    window.bootstrap.Modal.getOrCreateInstance(prevModal).show();
                }
            } catch (e) {} finally {
                prevModal = null;
                restore = false;
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.documentElement.style.overflow = '';
            }
        }

        function open() {
            state.open = true;
            hideParent();
            root.setAttribute('aria-hidden', 'false');
            lock();
            switchTab('gallery');
            resetAndLoad();
            document.addEventListener('keydown', onEsc, {
                passive: true
            });
        }

        function close() {
            state.open = false;
            root.setAttribute('aria-hidden', 'true');
            state.obs?.disconnect();
            state.obs = null;
            state.cb = null;
            state.selected = null;
            unlock();
            showParent();
            document.removeEventListener('keydown', onEsc);
        }

        function onEsc(e) {
            if (e.key === 'Escape' && root.getAttribute('aria-hidden') === 'false') {
                e.preventDefault();
                close();
            }
        }

        back && back.addEventListener('click', close);
        closes.forEach(b => b.addEventListener('click', close));

        async function resetAndLoad() {
            state.page = 1;
            state.hasMore = true;
            state.list = [];
            render();
            await load();
            state.obs?.disconnect();
            state.obs = null;
            const body = panels.gallery?.querySelector('.nbn-body');
            if (!body || !sentinel) return;
            state.obs = new IntersectionObserver(es => es.forEach(e => {
                if (e.isIntersecting) load();
            }), {
                root: body,
                threshold: 1
            });
            state.obs.observe(sentinel);
        }
        async function load() {
            if (state.isLoading || !state.hasMore) return;
            state.isLoading = true;
            loaderEl.hidden = false;
            try {
                const u = new URL(nbn_FETCH_URL);
                u.searchParams.set('page', state.page);
                u.searchParams.set('search', (state.search || '').trim());
                u.searchParams.set('type', state.type === 'all' ? 'all' : mapType(state.type));
                const r = await fetch(u.toString(), {
                    headers: {
                        Accept: 'application/json'
                    }
                });
                const j = await r.json().catch(() => ({}));
                const items = Array.isArray(j.data) ? j.data : [];
                state.list = state.list.concat(items);
                state.hasMore = !!j.next_page_url;
                state.page += 1;
            } catch (e) {
                state.hasMore = false;
            } finally {
                state.isLoading = false;
                loaderEl.hidden = true;
                render();
            }
        }

        function render() {
            listEl.textContent = '';
            const arr = state.type === 'all' ? state.list : state.list.filter(m => (state.type === 'image' ? kind(
                m) === 'image' : true));
            if (!arr.length) {
                const empty = document.createElement('div');
                empty.className = 'text-center text-muted py-2';
                empty.textContent = 'لا توجد وسائط';
                listEl.appendChild(empty);
                return;
            }
            arr.forEach(m => {
                const it = document.createElement('div');
                it.className = 'nbn-item' + (state.selected && state.selected.id === m.id ? ' is-sel' : '');
                it.addEventListener('click', () => {
                    state.selected = (state.selected && state.selected.id === m.id) ? null : m;
                    render();
                });
                const th = document.createElement('div');
                th.className = 'nbn-thumb';
                const badge = document.createElement('div');
                badge.className = 'nbn-badge';
                badge.textContent = iconText(m);
                th.appendChild(badge);
                const p = m.path || m.url || '';
                if (isYT(p)) {
                    const id = youId(p);
                    const img = new Image();
                    img.loading = 'lazy';
                    img.alt = m.name || 'YouTube';
                    img.src = `https://img.youtube.com/vi/${id}/hqdefault.jpg`;
                    th.appendChild(img);
                } else {
                    const k = kind(m);
                    if (k === 'image') {
                        const img = new Image();
                        img.loading = 'lazy';
                        img.alt = m.alt || m.name || '';
                        img.src = p;
                        th.appendChild(img);
                    } else if (k === 'video' && /(\.|\/)(mp4|webm|mkv|mov|avi|m4v)(\?|$)/i.test(p)) {
                        const v = document.createElement('video');
                        v.src = p;
                        v.muted = true;
                        v.preload = 'metadata';
                        th.appendChild(v);
                    }
                }
                const tt = document.createElement('div');
                tt.className = 'nbn-title';
                tt.textContent = m.name || '';
                it.appendChild(th);
                it.appendChild(tt);
                listEl.appendChild(it);
            });
        }
        searchEl && searchEl.addEventListener('input', () => {
            state.search = searchEl.value;
            resetAndLoad();
        });
        typeEl && typeEl.addEventListener('change', () => {
            state.type = typeEl.value;
            resetAndLoad();
        });

        function choose() {
            if (!state.selected) {
                alert('يرجى اختيار وسيط');
                return;
            }
            const m = state.selected;
            const payload = {
                id: m.id,
                url: m.url || m.path || '',
                title: m.name || '',
                alt: m.alt || ''
            };
            if (!payload.url) {
                alert('الرابط غير متاح');
                return;
            }
            state.cb && state.cb(payload);
            close();
        }
        chooseBtn && chooseBtn.addEventListener('click', choose);

        async function doUpload(mode) {
            const f = upFile?.files?.[0] || null;
            if (!f) return alert('اختر ملفاً');
            const form = new FormData();
            form.append('media', f);
            if (upName?.value) form.append('name', upName.value);
            if (upAlt?.value) form.append('alt', upAlt.value);
            try {
                upToGal && (upToGal.disabled = true, upToGal.textContent = '...');
                upAndClose && (upAndClose.disabled = true, upAndClose.textContent = '...');
                const r = await fetch(nbn_UPLOAD_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        Accept: 'application/json'
                    },
                    body: form
                });
                if (!r.ok) return alert('فشل الرفع');
                await resetAndLoad();
                if (mode === 'gallery') {
                    switchTab('gallery');
                } else {
                    const first = state.list[0] || null;
                    if (first && state.cb) state.cb({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || '',
                        alt: first.alt || ''
                    });
                    close();
                }
            } catch (e) {
                alert('فشل الرفع');
            } finally {
                upToGal && (upToGal.disabled = false, upToGal.textContent = 'رفع & فتح المعرض');
                upAndClose && (upAndClose.disabled = false, upAndClose.textContent = 'رفع & اختيار');
                if (upFile) upFile.value = '';
                if (upName) upName.value = '';
                if (upAlt) upAlt.value = '';
            }
        }
        upToGal && upToGal.addEventListener('click', () => doUpload('gallery'));
        upAndClose && upAndClose.addEventListener('click', () => doUpload('select'));

        function selTypeFromName(v) {
            return v;
        } // ici: auto
        async function doImport(mode) {
            const u = (urlInput?.value || '').trim();
            if (!u) return alert('أدخل الرابط');
            const body = {
                url: u
            };
            if (urlName?.value) body.name = urlName.value;
            if (urlAlt?.value) body.alt = urlAlt.value;
            try {
                importToGal && (importToGal.disabled = true, importToGal.textContent = '...');
                importAndClose && (importAndClose.disabled = true, importAndClose.textContent = '...');
                const r = await fetch(nbn_IMPORT_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        Accept: 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                });
                if (!r.ok) return alert('فشل الاستيراد');
                await resetAndLoad();
                if (mode === 'gallery') {
                    switchTab('gallery');
                } else {
                    const first = state.list[0] || null;
                    if (first && state.cb) state.cb({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || '',
                        alt: first.alt || ''
                    });
                    close();
                }
            } catch (e) {
                alert('فشل الاستيراد');
            } finally {
                importToGal && (importToGal.disabled = false, importToGal.textContent = 'استيراد & فتح المعرض');
                importAndClose && (importAndClose.disabled = false, importAndClose.textContent =
                    'استيراد & اختيار');
                if (urlInput) urlInput.value = '';
                if (urlName) urlName.value = '';
                if (urlAlt) urlAlt.value = '';
            }
        }
        importToGal && importToGal.addEventListener('click', () => doImport('gallery'));
        importAndClose && importAndClose.addEventListener('click', () => doImport('select'));

        // API publique pour ouvrir nbn depuis ailleurs
        window.nbnPicker = {
            open(onSelect) {
                state.cb = (typeof onSelect === 'function') ? onSelect : null;
                open();
            },
            close() {
                close();
            }
        };

        // --------- BRIDGE Social Media ↔ nbn ----------
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
                placeholder.style.display = 'none';
                prevImg.src = payload.url;
                prevImg.alt = payload.alt || payload.title || '';
                prevImgWrap.style.display = '';
            } else {
                previewWrap.classList.add('d-none');
                placeholder.style.display = 'block';
                prevImg.removeAttribute('src');
                prevImgWrap.style.display = 'none';
            }
        }
        window.removeShareImage = function() {
            setShareImage({
                id: '',
                url: '',
                title: '',
                alt: ''
            });
        };
        window.updatePreview = function() {
            const t = document.getElementById('share_title')?.value || '';
            const d = document.getElementById('share_description')?.value || '';
            prevTitle.textContent = t.trim() || 'عنوان المشاركة';
            prevDesc.textContent = d.trim() || 'وصف المشاركة';
        };

        function opennbnForSocial() {
            window.nbnPicker.open(function(media) {
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
            });
        }
        btnPick && btnPick.addEventListener('click', opennbnForSocial);
        btnClear && btnClear.addEventListener('click', () => removeShareImage());

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
    })();
</script>
