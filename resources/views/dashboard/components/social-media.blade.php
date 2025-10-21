<!-- ====================== SOCIAL MEDIA TAB (with SMX Picker) ====================== -->
<div class="tab-pane fade" id="social-media" role="tabpanel" aria-labelledby="social-media-tab">
    <div class="social-media-tab-content">
        <div class="row g-3 mt-3">
            <!-- Content Image -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0" data-ar="صورة المحتوى" data-en="Content Image">صورة المحتوى</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="share_image_url" class="form-label small text-muted">اختر صورة للمشاركة على
                                وسائل التواصل</label>
                            <div class="input-group">
                                <input type="text" id="share_image_url" name="share_image_url" class="form-control"
                                    placeholder="لم يتم الاختيار" readonly>
                                <button type="button" class="btn btn-outline-secondary" id="btnPickShareImage"
                                    title="اختيار من المودال">
                                    <i class="fas fa-images"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" id="btnClearShareImage"
                                    title="حذف">
                                    <i class="fas fa-xmark"></i>
                                </button>
                            </div>
                            <!-- حقول إضافية اختيارية -->
                            <input type="hidden" id="share_image_id" name="share_image_id">
                            <input type="hidden" id="share_image_title" name="share_image_title">
                            <input type="hidden" id="share_image_alt" name="share_image_alt">
                        </div>

                        <div class="image-preview-container border rounded p-3 text-center bg-light">
                            <div id="share_image_preview_wrapper" class="d-none">
                                <div class="image-preview-wrapper position-relative d-inline-block">
                                    <img id="share_image_preview" src="" alt="صورة المشاركة"
                                        class="img-fluid rounded shadow-sm" style="max-height:200px;">
                                    <button type="button"
                                        class="delete-image-btn btn btn-sm btn-danger position-absolute top-0 end-0 translate-middle"
                                        onclick="removeShareImage()" title="حذف الصورة"
                                        style="border-radius:999px; line-height:1; width:28px; height:28px;">×</button>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted" id="share_image_name"></small>
                                </div>
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
                        <h6 class="card-title mb-0" data-ar="محتوى المشاركة" data-en="Share Content">محتوى المشاركة</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="share_title" class="form-label" data-ar="عنوان المشاركة"
                                data-en="Share Title">عنوان المشاركة</label>
                            <input type="text" id="share_title" name="share_title" class="form-control"
                                value="{{ old('share_title', '') }}" placeholder="أدخل عنوان المشاركة" maxlength="100"
                                oninput="updatePreview()">
                            <div class="form-text">سيظهر هذا العنوان عند مشاركة المحتوى على وسائل التواصل</div>
                        </div>

                        <div class="mb-0">
                            <label for="share_description" class="form-label" data-ar="وصف المشاركة"
                                data-en="Share Description">وصف المشاركة</label>
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
                        <h6 class="card-title mb-0" data-ar="معاينة المشاركة" data-en="Share Preview">معاينة المشاركة
                        </h6>
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
                        </div>
                    </div>
                </div>
            </div> <!-- /preview -->
        </div>
    </div>
</div>

<!-- ====================== SMX PICKER (Unique Modal) ====================== -->
<style>
    #smxMediaPicker,
    #smxMediaPicker * {
        box-sizing: border-box;
    }

    .smx-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 2075;
    }

    .smx-modal[aria-hidden="false"] {
        display: flex;
    }

    .smx-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .5);
        z-index: 2070;
    }

    .smx-box {
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
        z-index: 2076;
    }

    .smx-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }

    .smx-x {
        background: transparent;
        border: 0;
        font-size: 1.6rem;
        cursor: pointer;
        color: #666;
    }

    .smx-tabs {
        display: flex;
        padding: 8px 16px;
        border-bottom: 1px solid #e5e7eb;
    }

    .smx-tab {
        border: 1px solid #e5e7eb;
        background: #fff;
        padding: .45rem .8rem;
        cursor: pointer;
        font-weight: 600;
        margin-right: 8px;
        border-radius: .35rem;
    }

    .smx-tab.is-active {
        border-color: #cfcfcf;
    }

    .smx-panel {
        display: block;
    }

    .smx-panel[hidden] {
        display: none;
    }

    .smx-filters {
        display: flex;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }

    .smx-filters input,
    .smx-filters select {
        border: 1px solid #dcdcdc;
        padding: .5rem .7rem;
        border-radius: .35rem;
    }

    .smx-filters input {
        margin-right: 8px;
        flex: 1 1 240px;
    }

    .smx-body {
        padding: 12px 16px;
        overflow: auto;
        flex: 1;
    }

    .smx-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    }

    .smx-item {
        border: 1px solid #e5e7eb;
        padding: 8px;
        cursor: pointer;
        margin: 6px;
        border-radius: .35rem;
    }

    .smx-item.is-sel {
        box-shadow: 0 0 0 3px #e5e7eb;
    }

    .smx-thumb {
        height: 120px;
        background: #fafafa;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #f0f0f0;
        position: relative;
        border-radius: .35rem;
    }

    .smx-thumb img {
        max-width: 100%;
        max-height: 100%;
    }

    .smx-badge {
        position: absolute;
        top: 6px;
        left: 6px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        border-radius: .35rem;
        padding: 2px 6px;
        font-size: .75rem;
    }

    .smx-title {
        margin-top: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .smx-foot {
        display: flex;
        justify-content: flex-end;
        padding: 12px 16px;
        border-top: 1px solid #e5e7eb;
    }

    .smx-btn {
        border: 1px solid #000;
        background: #000;
        color: #fff;
        padding: .5rem .85rem;
        font-weight: 600;
        cursor: pointer;
        margin-left: 8px;
        border-radius: .35rem;
    }

    .smx-cancel {
        background: #444;
        border-color: #444;
    }

    .smx-up {
        display: flex;
        flex-wrap: wrap;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }

    .smx-up input[type="file"],
    .smx-up input[type="text"],
    .smx-up input[type="url"] {
        border: 1px solid #dcdcdc;
        padding: .5rem .7rem;
        margin-right: 8px;
        margin-bottom: 8px;
        border-radius: .35rem;
    }
</style>

<div id="smxMediaPicker" class="smx-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="smxTitle">
    <div class="smx-backdrop" data-smx-backdrop></div>
    <div class="smx-box" role="document">
        <div class="smx-head">
            <h5 id="smxTitle" class="mb-0">اختيار صورة المشاركة</h5>
            <button type="button" class="smx-x" data-smx-close aria-label="إغلاق">&times;</button>
        </div>

        <div class="smx-tabs" role="tablist">
            <button class="smx-tab is-active" data-smx-tab="gallery" role="tab" aria-selected="true"
                aria-controls="smx-panel-gallery" id="smx-tab-gallery">المعرض</button>
            <button class="smx-tab" data-smx-tab="upload" role="tab" aria-selected="false"
                aria-controls="smx-panel-upload" id="smx-tab-upload">رفع</button>
            <button class="smx-tab" data-smx-tab="import" role="tab" aria-selected="false"
                aria-controls="smx-panel-import" id="smx-tab-import">استيراد بالرابط</button>
        </div>

        <!-- Gallery -->
        <section id="smx-panel-gallery" class="smx-panel" role="tabpanel" aria-labelledby="smx-tab-gallery">
            <div class="smx-filters">
                <input type="text" id="smxSearch" placeholder="ابحث ...">
                <select id="smxType">
                    <option value="image">صور</option>
                    <option value="all">كل الأنواع</option>
                </select>
            </div>
            <div class="smx-body">
                <div id="smxList" class="smx-grid"></div>
                <div id="smxLoader" class="text-muted text-center py-2" hidden>...تحميل</div>
                <div id="smxSentinel" class="smx-sentinel"></div>
            </div>
            <div class="smx-foot">
                <button type="button" class="smx-btn" id="smxChoose">اختيار</button>
                <button type="button" class="smx-btn smx-cancel" data-smx-close>إلغاء</button>
            </div>
        </section>

        <!-- Upload -->
        <section id="smx-panel-upload" class="smx-panel" role="tabpanel" aria-labelledby="smx-tab-upload" hidden>
            <div class="smx-up">
                <input type="file" id="smxUploadFile" accept="image/*">
                <input type="text" id="smxUploadName" placeholder="اسم (اختياري)">
                <input type="text" id="smxUploadAlt" placeholder="ALT (اختياري)">
                <div style="width:100%;"></div>
                <button type="button" class="smx-btn" id="smxUploadToGallery">رفع & فتح المعرض</button>
                <button type="button" class="smx-btn" id="smxUploadAndClose">رفع & اختيار</button>
            </div>
        </section>

        <!-- Import by URL -->
        <section id="smx-panel-import" class="smx-panel" role="tabpanel" aria-labelledby="smx-tab-import" hidden>
            <div class="smx-up">
                <input type="url" id="smxUrl" placeholder="رابط صورة مباشر (png/jpg/webp)">
                <input type="text" id="smxUrlName" placeholder="اسم (اختياري)">
                <input type="text" id="smxUrlAlt" placeholder="ALT (اختياري)">
                <div style="width:100%;"></div>
                <button type="button" class="smx-btn" id="smxImportToGallery">استيراد & فتح المعرض</button>
                <button type="button" class="smx-btn" id="smxImportAndClose">استيراد & اختيار</button>
            </div>
        </section>
    </div>
</div>

<!-- ====================== SMX PICKER Scripts + bridge ====================== -->
<script>
    (function() {
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

        const SMX_FETCH_URL = azSafeRoute("{{ route('dashboard.media.getAllMediaPaginated') }}",
            "/dashboard/media/paginated");
        const SMX_UPLOAD_URL = azSafeRoute("{{ route('dashboard.media.store') }}", "/dashboard/media");
        const SMX_IMPORT_URL = azSafeRoute("{{ route('dashboard.media_url.store') }}", "/dashboard/media-url");
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const CSRF = csrfMeta ? csrfMeta.getAttribute('content') : '';

        // Social media selectors (one-time)
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

        const previewTitle = document.getElementById('preview_title');
        const previewDesc = document.getElementById('preview_description');
        const prevImgWrap = document.getElementById('preview_image_container');
        const prevImg = document.getElementById('preview_image');

        function setShareImage(payload) {
            shareId.value = payload.id || '';
            shareUrl.value = payload.url || '';
            shareTitle.value = payload.title || '';
            shareAlt.value = payload.alt || '';

            if (payload.url) {
                // bloc gauche
                previewImg.src = payload.url;
                previewImg.alt = payload.alt || payload.title || '';
                previewName.textContent = payload.title || payload.url;
                previewWrap.classList.remove('d-none');
                placeholder.style.display = 'none';
                // carte
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
            previewTitle.textContent = t.trim() || 'عنوان المشاركة';
            previewDesc.textContent = d.trim() || 'وصف المشاركة';
        };

        // ===== SMX modal
        const root = document.getElementById('smxMediaPicker');
        const back = root.querySelector('[data-smx-backdrop]');
        const closeBs = root.querySelectorAll('[data-smx-close]');
        const tabs = Array.from(root.querySelectorAll('.smx-tab'));
        const panels = {
            gallery: document.getElementById('smx-panel-gallery'),
            upload: document.getElementById('smx-panel-upload'),
            import: document.getElementById('smx-panel-import'),
        };
        const listEl = document.getElementById('smxList');
        const loaderEl = document.getElementById('smxLoader');
        const sentinel = document.getElementById('smxSentinel');
        const searchEl = document.getElementById('smxSearch');
        const typeEl = document.getElementById('smxType');

        const chooseBtn = document.getElementById('smxChoose');
        const upFile = document.getElementById('smxUploadFile');
        const upName = document.getElementById('smxUploadName');
        const upAlt = document.getElementById('smxUploadAlt');
        const upToGal = document.getElementById('smxUploadToGallery');
        const upAndClose = document.getElementById('smxUploadAndClose');

        const urlInput = document.getElementById('smxUrl');
        const urlName = document.getElementById('smxUrlName');
        const urlAlt = document.getElementById('smxUrlAlt');
        const importToGal = document.getElementById('smxImportToGallery');
        const importAndClose = document.getElementById('smxImportAndClose');

        const state = {
            open: false,
            page: 1,
            hasMore: true,
            isLoading: false,
            list: [],
            search: '',
            type: 'image',
            selected: null,
            obs: null,
            cb: null
        };

        function lockScroll() {
            document.documentElement.style.overflow = 'hidden';
            document.body.classList.add('modal-open');
        }

        function unlockScroll() {
            document.documentElement.style.overflow = '';
            document.body.classList.remove('modal-open');
        }

        function switchTab(t) {
            tabs.forEach(b => {
                const act = b.dataset.smxTab === t;
                b.classList.toggle('is-active', act);
                b.setAttribute('aria-selected', String(act));
            });
            Object.entries(panels).forEach(([k, el]) => {
                if (el) el.hidden = (k !== t);
            });
        }

        function open(onSelect) {
            state.cb = (typeof onSelect === 'function') ? onSelect : null;
            state.open = true;
            root.setAttribute('aria-hidden', 'false');
            lockScroll();
            switchTab('gallery');
            resetAndLoad();
        }

        function close() {
            state.open = false;
            root.setAttribute('aria-hidden', 'true');
            if (state.obs) {
                state.obs.disconnect();
                state.obs = null;
            }
            state.cb = null;
            state.selected = null;
            unlockScroll();
        }
        window.smxOpen = () => open(res => setShareImage(res)); // helper

        back && back.addEventListener('click', close);
        closeBs.forEach(b => b.addEventListener('click', close));
        tabs.forEach(b => b.addEventListener('click', () => switchTab(b.dataset.smxTab)));

        btnPick && btnPick.addEventListener('click', () => open(res => setShareImage(res)));
        btnClear && btnClear.addEventListener('click', () => removeShareImage());

        function kind(m) {
            const p = m.path || m.url || '';
            const e = (p.split('?')[0].split('.').pop() || '').toLowerCase();
            if (['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'svg'].includes(e)) return 'image';
            if (['mp4', 'webm', 'mkv', 'mov', 'avi', 'm4v'].includes(e)) return 'video';
            if (['mp3', 'wav', 'ogg', 'm4a', 'flac', 'aac'].includes(e)) return 'audio';
            return 'file';
        }

        async function resetAndLoad() {
            state.page = 1;
            state.hasMore = true;
            state.list = [];
            render();
            await load();
            if (state.obs) {
                state.obs.disconnect();
                state.obs = null;
            }
            const rootEl = panels.gallery ? panels.gallery.querySelector('.smx-body') : null;
            const sentinelEl = document.getElementById('smxSentinel');
            if (!rootEl || !sentinelEl) return;
            state.obs = new IntersectionObserver(es => es.forEach(e => {
                if (e.isIntersecting) load();
            }), {
                root: rootEl,
                threshold: 1
            });
            state.obs.observe(sentinelEl);
        }

        async function load() {
            if (state.isLoading || !state.hasMore) return;
            state.isLoading = true;
            loaderEl.hidden = false;
            try {
                const u = new URL(SMX_FETCH_URL);
                u.searchParams.set('page', state.page);
                u.searchParams.set('search', (state.search || '').trim());
                u.searchParams.set('type', state.type === 'all' ? 'all' : 'image');
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
                console.error('SMX fetch error', e);
                state.hasMore = false;
            } finally {
                state.isLoading = false;
                loaderEl.hidden = true;
                render();
            }
        }

        function render() {
            listEl.textContent = '';
            const arr = (state.type === 'all') ? state.list : state.list.filter(m => kind(m) === 'image');
            if (!arr.length) {
                const empty = document.createElement('div');
                empty.className = 'text-center text-muted py-2';
                empty.textContent = 'لا توجد وسائط';
                listEl.appendChild(empty);
                return;
            }
            arr.forEach(m => {
                const it = document.createElement('div');
                it.className = 'smx-item' + (state.selected && state.selected.id === m.id ? ' is-sel' : '');
                it.addEventListener('click', () => {
                    state.selected = (state.selected && state.selected.id === m.id) ? null : m;
                    render();
                });

                const th = document.createElement('div');
                th.className = 'smx-thumb';
                const badge = document.createElement('div');
                badge.className = 'smx-badge';
                badge.textContent = 'IMG';
                th.appendChild(badge);
                const img = new Image();
                img.loading = 'lazy';
                img.alt = m.alt || m.name || '';
                img.src = m.url || m.path || '';
                th.appendChild(img);
                it.appendChild(th);

                const tt = document.createElement('div');
                tt.className = 'smx-title';
                tt.textContent = m.name || '';
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

        chooseBtn && chooseBtn.addEventListener('click', function() {
            if (!state.selected) {
                alert('يرجى اختيار صورة');
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
            if (state.cb) state.cb(payload);
            close();
        });

        // Bridge: copier share_image_url => share_image au submit (nom attendu par le back)
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
