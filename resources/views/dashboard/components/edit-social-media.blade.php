{{-- ====================== SOCIAL MEDIA (Styles) ====================== --}}
<style>
    :root {
        --nbn-bg: #fff;
        --nbn-text: #1a1a1a;
        --nbn-border: #e0e0e0;
        --nbn-muted: #6b7280;
        --nbn-gray-100: #f5f5f5;
        --nbn-gray-400: #9ca3af;
        --nbn-gray-600: #4b5563;
        --nbn-gray-700: #374151;
        --nbn-ring: rgba(0, 0, 0, 0.1);
    }

    .image-preview-container img {
        max-height: 200px;
    }

    /* nbn Picker */
    #nbnMediaPicker,
    #nbnMediaPicker * {
        box-sizing: border-box;
    }

    .nbn-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 2075;
        align-items: center;
        justify-content: center;
    }

    .nbn-modal[aria-hidden="false"] {
        display: flex;
    }

    .nbn-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .5);
        z-index: 2070;
    }

    .nbn-box {
        position: relative;
        margin: auto;
        width: min(960px, 92vw);
        max-height: 90vh;
        background: var(--nbn-bg);
        color: var(--nbn-text);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 2076;
    }

    .nbn-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
    }

    .nbn-x {
        background: transparent;
        border: 0;
        font-size: 1.8rem;
        cursor: pointer;
        color: var(--nbn-text);
        line-height: 1;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nbn-x:hover {
        opacity: 0.7;
    }

    .nbn-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
    }

    .nbn-tab {
        appearance: none;
        border: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--nbn-text);
        transition: all 0.15s;
    }

    .nbn-tab:hover {
        border-color: var(--nbn-gray-400);
    }

    .nbn-tab:focus {
        outline: 2px solid var(--nbn-ring);
        outline-offset: 1px;
    }

    .nbn-tab.is-active {
        border-color: var(--nbn-gray-400);
        background: var(--nbn-bg);
        color: var(--nbn-text);
    }

    .nbn-panel[hidden] {
        display: none
    }

    .nbn-filters {
        padding: 1rem 1.25rem;
        display: flex;
        gap: .6rem;
        border-bottom: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
    }

    .nbn-filters input::placeholder {
        color: var(--nbn-muted);
    }

    .nbn-filters input:focus,
    .nbn-filters select:focus {
        border-color: var(--nbn-gray-400);
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.05);
        outline: none;
    }

    .nbn-body {
        padding: 1rem 1.25rem;
        overflow: auto;
        flex: 1;
        background: var(--nbn-bg);
    }

    .nbn-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: .8rem;
    }

    .nbn-empty {
        text-align: center;
        color: var(--nbn-muted);
        font-size: .95rem;
        margin: 2rem 0;
    }

    .nbn-item {
        position: relative;
        border: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: .6rem;
        transition: border-color .15s, transform .04s ease, box-shadow .15s;
    }

    .nbn-item:hover {
        border-color: var(--nbn-gray-400);
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.03);
    }

    .nbn-item:active {
        transform: scale(.995);
    }

    .nbn-item.is-sel {
        border-color: var(--nbn-gray-400);
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.06);
    }

    .nbn-thumb {
        width: 100%;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--nbn-gray-100);
        border: 1px solid var(--nbn-border);
        overflow: hidden;
        position: relative;
    }

    .nbn-thumb img,
    .nbn-thumb video {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .nbn-badge {
        position: absolute;
        top: 4px;
        left: 4px;
        background: rgba(0, 0, 0, .7);
        color: #fff;
        padding: 2px 6px;
        font-size: .7rem;
        text-transform: uppercase;
        font-weight: 600;
    }

    .nbn-title {
        margin-top: .4rem;
        font-size: .85rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 100%;
        color: var(--nbn-text);
    }

    .nbn-foot {
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
    }

    .nbn-btn {
        padding: .6rem 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        border: 1px solid var(--nbn-text);
        background: var(--nbn-text);
        color: #fff;
    }

    .nbn-btn:hover {
        background: var(--nbn-gray-700);
        border-color: var(--nbn-gray-700);
    }

    .nbn-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .nbn-btn-secondary {
        background: var(--nbn-gray-600);
        border-color: var(--nbn-gray-600);
    }

    .nbn-btn-secondary:hover {
        background: var(--nbn-gray-700);
        border-color: var(--nbn-gray-700);
    }

    .nbn-btn-primary {
        background: var(--nbn-text);
        border-color: var(--nbn-text);
    }

    .nbn-btn-primary:hover {
        background: var(--nbn-gray-700);
        border-color: var(--nbn-gray-700);
    }

    .nbn-cancel {
        background: var(--nbn-gray-600);
        border-color: var(--nbn-gray-600);
        color: #fff;
    }

    .nbn-cancel:hover {
        background: var(--nbn-gray-700);
        border-color: var(--nbn-gray-700);
    }

    .nbn-up {
        display: flex;
        flex-wrap: wrap;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
    }

    .nbn-upload-fields {
        display: flex;
        flex-wrap: wrap;
        gap: .6rem;
        width: 100%;
    }

    .nbn-uploader-actions {
        display: flex;
        gap: .6rem;
        margin-top: .7rem;
    }

    /* Import section specific styles */
    .nbn-uploader-url {
        padding: 1.2rem;
        border: 1px solid var(--nbn-border);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .nbn-radio {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        margin-inline-end: 1rem;
        cursor: pointer;
        color: var(--nbn-text);
    }

    .nbn-radio input {
        accent-color: var(--nbn-text);
    }

    @media (max-width: 768px) {
        .nbn-box {
            width: 96vw;
            max-height: 94vh;
        }

        .nbn-grid {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }
    }
</style>

{{-- ====================== SOCIAL MEDIA TAB ====================== --}}
<div class="tab-pane" id="social-media" role="tabpanel" aria-labelledby="social-media-tab">
    <div class="social-media-tab-content">
        <div class="row g-3 mt-3">
            {{-- Content Image --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0">الصورة</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" id="share_image_url" name="share_image_url" class="form-control"
                                    placeholder="لم يتم الاختيار" readonly
                                    value="{{ old('share_image_url', $content->share_image ?? '') }}">
                                <button type="button" class="btn btn-outline-secondary" id="btnPickShareImage"
                                    title="اختيار من nbn">
                                    <i class="fas fa-images"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" id="btnClearShareImage"
                                    title="حذف">
                                    <i class="fas fa-xmark"></i>
                                </button>
                            </div>
                            {{-- extra hidden fields (optional if you store them) --}}
                            <input type="hidden" id="share_image_id" name="share_image_id"
                                value="{{ old('share_image_id', $content->share_image_id ?? '') }}">
                            <input type="hidden" id="share_image_title" name="share_image_title"
                                value="{{ old('share_image_title', $content->share_image_title ?? '') }}">
                            <input type="hidden" id="share_image_alt" name="share_image_alt"
                                value="{{ old('share_image_alt', $content->share_image_alt ?? '') }}">
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

            {{-- Share Content --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0">محتوى المشاركة</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="share_title" class="form-label">العنوان</label>
                            <input type="text" id="share_title" name="share_title" class="form-control"
                                value="{{ old('share_title', $content->share_title ?? '') }}"
                                placeholder="أدخل عنوان المشاركة" maxlength="100" oninput="updatePreview()">
                        </div>
                        <div class="mb-0">
                            <label for="share_description" class="form-label">الوصف</label>
                            <textarea id="share_description" name="share_description" class="form-control" rows="4"
                                placeholder="أدخل وصف المشاركة" maxlength="260" oninput="updatePreview()">{{ old('share_description', $content->share_description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Optional live preview block (if you have these elements elsewhere, keep them) --}}
        <div class="row mt-3" style="display:none;">
            <div class="col-12">
                <div class="border rounded p-3">
                    <h5 id="preview_title" class="mb-1">عنوان المشاركة</h5>
                    <p id="preview_description" class="text-muted mb-2">وصف المشاركة</p>
                    <div id="preview_image_container" style="display:none;">
                        <img id="preview_image" src="" alt="" style="max-height:180px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ====================== nbn PICKER (Unique Modal) ====================== --}}
<div id="nbnMediaPicker" class="nbn-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="nbnTitle">
    <div class="nbn-backdrop" data-nbn-backdrop></div>
    <div class="nbn-box" role="document">
        <div class="nbn-head">
            <h5 id="nbnTitle" class="mb-0">اختيار وسائط</h5>
            <button type="button" class="nbn-x" data-nbn-close aria-label="إغلاق">&times;</button>
        </div>

        <div class="nbn-tabs" role="tablist">
            <button type="button" class="nbn-tab is-active" data-nbn-tab="gallery" role="tab"
                aria-selected="true" aria-controls="nbn-panel-gallery" id="nbn-tab-gallery">المعرض</button>
            <button type="button" class="nbn-tab" data-nbn-tab="upload" role="tab" aria-selected="false"
                aria-controls="nbn-panel-upload" id="nbn-tab-upload">رفع</button>
            <button type="button" class="nbn-tab" data-nbn-tab="import" role="tab" aria-selected="false"
                aria-controls="nbn-panel-import" id="nbn-tab-import">استيراد بالرابط</button>
        </div>

        {{-- Gallery --}}
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

        {{-- Upload --}}
        <section id="nbn-panel-upload" class="nbn-panel" role="tabpanel" aria-labelledby="nbn-tab-upload" hidden>
            <div class="nbn-up"
                style="padding:1.2rem; border-radius:8px; background:#fafbfc; border:1px solid var(--az-border); box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                <div class="nbn-upload-fields" style="display:flex; flex-wrap:wrap; gap:.6rem; width:100%;">
                    <div style="flex:1 1 220px;">
                        <label for="nbnUploadFile" id="nbnUploadLabel"
                            style="display:block; width:100%; cursor:pointer; padding:.6rem .7rem; border:1px solid #dcdcdc; background:#fafafa; color:#333; text-align:center; transition: all 0.2s;">
                            <i class="fa fa-upload" style="margin-right:6px;"></i>
                            <span id="nbnUploadLabelText">اختر ملف الوسائط</span>
                            <input type="file" id="nbnUploadFile" accept="image/*,video/*" style="display:none;">
                        </label>
                    </div>
                    <div style="flex:1 1 200px;">
                        <input type="text" id="nbnUploadName" placeholder="اسم الملف"
                            style="width:100%; padding:.6rem .7rem; border:1px solid #dcdcdc; background:#fff;">
                    </div>
                    <div style="flex:1 1 200px;">
                        <input type="text" id="nbnUploadAlt" placeholder="النص البديل"
                            style="width:100%; padding:.6rem .7rem; border:1px solid #dcdcdc; background:#fff;">
                    </div>
                </div>
                <div class="nbn-uploader-actions" style="display:flex; gap:.7rem; margin-bottom:.7rem;">
                    <button type="button" class="nbn-btn nbn-btn-secondary" id="nbnUploadToGallery"
                        style="border-radius:6px; font-size:1rem; padding:.7rem 1.2rem;">إدراج في المعرض</button>
                    <button type="button" class="nbn-btn nbn-btn-primary" id="nbnUploadAndClose"
                        style="border-radius:6px; font-size:1rem; padding:.7rem 1.2rem;">إدراج في المقال</button>
                </div>
            </div>
        </section>

        {{-- Import --}}
        <section id="nbn-panel-import" class="nbn-panel" role="tabpanel" aria-labelledby="nbn-tab-import" hidden>
            <div class="x-tab-body">
                <div class="x-uploader x-uploader-url"
                    style="padding:1.2rem; border-radius:8px; background:#fafbfc; border:1px solid var(--x-border,#e5e7eb); box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display:flex; flex-wrap:wrap; gap:.7rem; margin-bottom:.7rem;">
                        <input type="text" id="nbnUrl"
                            style="flex:1 1 220px; padding:.7rem 1rem; border:1px solid #dcdcdc; border-radius:6px; background:#fff; font-size:1rem;"
                            placeholder="الرابط">
                        <input type="text" id="nbnUrlName" placeholder="اسم الملف"
                            style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid #dcdcdc; border-radius:6px; background:#fff; font-size:1rem;">
                        <input type="text" id="nbnUrlAlt" placeholder="النص البديل"
                            style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid #dcdcdc; border-radius:6px; background:#fff; font-size:1rem;">
                    </div>
                    <div class="x-uploader-actions" style="display:flex; gap:.7rem; margin-bottom:.7rem;">
                        <button class="x-btn x-btn-secondary nbn-btn" type="button" id="nbnImportToGallery"
                            style="border-radius:6px; font-size:1rem; padding:.7rem 1.2rem;">إدراج في المعرض</button>
                        <button class="x-btn x-btn-primary nbn-btn" type="button" id="nbnImportAndClose"
                            style="border-radius:6px; font-size:1rem; padding:.7rem 1.2rem;">إدراج في المقال</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

{{-- ====================== Scripts (picker + bridge + hydration) ====================== --}}
<script>
    (function() {
        // Safe routes
        function azSafeRoute(possibleBladeRoute, fallbackPath) {
            try {
                if (!possibleBladeRoute || /\{\{.+\}\}/.test(possibleBladeRoute)) {
                    return new URL(fallbackPath, window.location.origin).toString();
                }
                return new URL(possibleBladeRoute, window.location.origin).toString();
            } catch {
                return fallbackPath;
            }
        }
        const nbn_FETCH_URL = azSafeRoute("{{ route('dashboard.media.getAllMediaPaginated') }}",
            "/dashboard/media/paginated");
        const nbn_UPLOAD_URL = azSafeRoute("{{ route('dashboard.media.store') }}", "/dashboard/media");
        const nbn_IMPORT_URL = azSafeRoute("{{ route('dashboard.media_url.store') }}", "/dashboard/media-url");
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const CSRF = csrfMeta ? csrfMeta.getAttribute('content') : '';

        // ------------- Picker Core (gallery/upload/import; minimal) -------------
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
            if (['image', 'video', 'audio', 'voice', 'file'].includes(mt)) return mt === 'audio' ? 'voice' : mt;
            const e = ext(p);
            if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].includes(e)) return 'image';
            if (['mp4', 'webm', 'mkv', 'mov', 'avi', 'm4v'].includes(e)) return 'video';
            if (['mp3', 'wav', 'ogg', 'm4a', 'aac', 'flac'].includes(e)) return 'voice';
            return 'file';
        }
        const iconText = m => (kind(m) === 'image' ? 'IMG' : kind(m) === 'video' ? 'VID' : 'FILE');

        function switchTab(t) {
            tabs.forEach(b => {
                const act = b.dataset.nbnTab === t;
                b.classList.toggle('is-active', act);
                b.setAttribute('aria-selected', String(act));
            });
            Object.entries(panels).forEach(([k, el]) => el && (el.hidden = (k !== t)));
        }
        tabs.forEach(b => b.addEventListener('click', () => switchTab(b.dataset.nbnTab)));

        function lock() {
            document.documentElement.style.overflow = 'hidden';
            document.body.classList.add('modal-open');
        }

        function unlock() {
            document.documentElement.style.overflow = '';
            document.body.classList.remove('modal-open');
        }

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
            } catch {
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
            } catch {
                alert('فشل الرفع');
            } finally {
                upToGal && (upToGal.disabled = false, upToGal.textContent = 'إدراج في المعرض');
                upAndClose && (upAndClose.disabled = false, upAndClose.textContent = 'إدراج في المقال');
                if (upFile) upFile.value = '';
                if (upName) upName.value = '';
                if (upAlt) upAlt.value = '';
                // Reset upload label visual feedback
                const uploadLabel = document.getElementById('nbnUploadLabel');
                const uploadLabelText = document.getElementById('nbnUploadLabelText');
                if (uploadLabelText) uploadLabelText.textContent = 'اختر ملف الوسائط';
                if (uploadLabel) uploadLabel.style.border = '1px solid #dcdcdc';
            }
        }
        upToGal && upToGal.addEventListener('click', () => doUpload('gallery'));
        upAndClose && upAndClose.addEventListener('click', () => doUpload('select'));

        // Visual feedback for file selection
        const uploadLabel = document.getElementById('nbnUploadLabel');
        const uploadLabelText = document.getElementById('nbnUploadLabelText');
        upFile && upFile.addEventListener('change', (e) => {
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
            } catch {
                alert('فشل الاستيراد');
            } finally {
                importToGal && (importToGal.disabled = false, importToGal.textContent = 'إدراج في المعرض');
                importAndClose && (importAndClose.disabled = false, importAndClose.textContent =
                    'إدراج في المقال');
                if (urlInput) urlInput.value = '';
                if (urlName) urlName.value = '';
                if (urlAlt) urlAlt.value = '';
            }
        }
        importToGal && importToGal.addEventListener('click', () => doImport('gallery'));
        importAndClose && importAndClose.addEventListener('click', () => doImport('select'));

        // Auto-fill for URL input
        urlInput && urlInput.addEventListener('input', (e) => {
            const url = e.target.value.trim();
            if (url && urlName && !urlName.value) {
                try {
                    const urlPath = new URL(url, window.location.origin).pathname;
                    const fileName = urlPath.split('/').pop();
                    const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                    if (nameWithoutExt && nameWithoutExt !== '') {
                        urlName.value = nameWithoutExt;
                        if (urlAlt) urlAlt.value = nameWithoutExt;
                    }
                } catch (err) {
                    // Invalid URL, ignore
                }
            }
        });

        // Public API
        window.nbnPicker = {
            open(onSelect) {
                state.cb = (typeof onSelect === 'function') ? onSelect : null;
                open();
            },
            close() {
                close();
            }
        };

        // ---------- Social Media form helpers ----------
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

        window.setShareImage = function(payload) {
            shareId.value = payload.id || '';
            shareUrl.value = payload.url || '';
            shareTitle.value = payload.title || '';
            shareAlt.value = payload.alt || '';
            if (payload.url) {
                if (previewImg) {
                    previewImg.src = payload.url;
                    previewImg.alt = payload.alt || payload.title || '';
                }
                if (previewName) {
                    previewName.textContent = payload.title || payload.url;
                }
                previewWrap && previewWrap.classList.remove('d-none');
                placeholder && (placeholder.style.display = 'none');
                if (prevImg) {
                    prevImg.src = payload.url;
                    prevImg.alt = payload.alt || payload.title || '';
                }
                if (prevImgWrap) prevImgWrap.style.display = '';
            } else {
                previewWrap && previewWrap.classList.add('d-none');
                placeholder && (placeholder.style.display = 'block');
                if (prevImg) {
                    prevImg.removeAttribute('src');
                }
                if (prevImgWrap) prevImgWrap.style.display = 'none';
            }
        };
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
            if (prevTitle) prevTitle.textContent = t.trim() || 'عنوان المشاركة';
            if (prevDesc) prevDesc.textContent = d.trim() || 'وصف المشاركة';
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

        // On submit: copy URL into "share_image" if your backend expects that exact name
        document.addEventListener('DOMContentLoaded', function() {
            const tab = document.getElementById('social-media');
            const form = tab ? tab.closest('form') : null;
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

        // ---------------------- HYDRATION FROM $content ----------------------
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure input values reflect old()/DB even if browser delays
            const t = document.getElementById('share_title');
            const d = document.getElementById('share_description');
            if (t) t.value = t.value || @json(old('share_title', $content->share_title ?? ''));
            if (d) d.value = d.value || @json(old('share_description', $content->share_description ?? ''));

            // Build initial image payload from DB (or old())
            const initialShare = {
                id: @json(old('share_image_id', $content->share_image_id ?? '')),
                url: @json(old('share_image_url', $content->share_image ?? '')),
                title: @json(old('share_image_title', $content->share_image_title ?? '')),
                alt: @json(old('share_image_alt', $content->share_image_alt ?? '')),
            };

            // Hydrate UI
            if (initialShare.url && typeof window.setShareImage === 'function') {
                window.setShareImage(initialShare);
            } else {
                // make sure empty state is visible correctly
                window.setShareImage({
                    id: '',
                    url: '',
                    title: '',
                    alt: ''
                });
            }
            if (typeof window.updatePreview === 'function') window.updatePreview();
        });
    })();
</script>
