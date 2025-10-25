<!-- ====================== SOCIAL MEDIA TAB ====================== -->
<div class="tab-pane" id="social-media" role="tabpanel" aria-labelledby="social-media-tab">
    <div class="social-media-tab-content">
        <div class="row g-3 mt-3">
            <!-- Content Image -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h6 class="card-title mb-0">الصورة</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
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
                                        id="btnRemoveShareImage" title="حذف الصورة"
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
                            <label for="share_title" class="form-label">العنوان</label>
                            <input type="text" id="share_title" name="share_title" class="form-control"
                                value="{{ old('share_title', '') }}" placeholder="أدخل عنوان المشاركة" maxlength="100"
                                oninput="updatePreview()">
                        </div>
                        <div class="mb-0">
                            <label for="share_description" class="form-label">الوصف</label>
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
    :root {
        /* Light mode colors */
        --nbn-primary: #6576ff;
        --nbn-secondary: #364a63;
        --nbn-success: #1ee0ac;
        --nbn-danger: #e85347;
        --nbn-warning: #f4bd0e;
        --nbn-info: #09c2de;

        --nbn-bg: #fff;
        --nbn-text: #526484;
        --nbn-border: #dbdfea;
        --nbn-ring: #6576ff;
        --nbn-muted: #8091a7;

        --nbn-gray-100: #ebeef2;
        --nbn-gray-200: #e5e9f2;
        --nbn-gray-300: #dbdfea;
        --nbn-gray-400: #b7c2d0;
        --nbn-gray-500: #8091a7;
        --nbn-gray-600: #3c4d62;
        --nbn-gray-700: #344357;
        --nbn-gray-800: #2b3748;
        --nbn-gray-900: #1f2b3a;
    }

    [data-bs-theme="dark"] {
        /* Dark mode colors */
        --nbn-primary: #6576ff;
        --nbn-secondary: #364a63;
        --nbn-success: #1ee0ac;
        --nbn-danger: #e85347;
        --nbn-warning: #f4bd0e;
        --nbn-info: #09c2de;

        --nbn-bg: #0D141D;
        --nbn-text: #e5e9f2;
        --nbn-border: #384D69;
        --nbn-ring: #6576ff;
        --nbn-muted: #b7c2d0;

        --nbn-gray-100: #2b3748;
        --nbn-gray-200: #344357;
        --nbn-gray-300: #3c4d62;
        --nbn-gray-400: #8091a7;
        --nbn-gray-500: #b7c2d0;
        --nbn-gray-600: #dbdfea;
        --nbn-gray-700: #e5e9f2;
        --nbn-gray-800: #ebeef2;
        --nbn-gray-900: #f5f6fa;
    }

    /* === Social Media preview helpers === */
    .image-preview-container img {
        max-height: 200px
    }

    /* === nbn Picker (Updated for dark/white mode) === */
    #nbnMediaPicker,
    #nbnMediaPicker * {
        box-sizing: border-box;
        border-radius: 0 !important;
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
        background: var(--nbn-bg);
        color: var(--nbn-text);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        z-index: 2076
    }

    .nbn-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--nbn-border)
    }

    .nbn-head h5 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--nbn-text);
    }

    .nbn-x {
        background: transparent;
        border: 0;
        font-size: 1.6rem;
        cursor: pointer;
        color: var(--nbn-muted)
    }

    .nbn-x:hover {
        color: var(--nbn-text);
    }

    .nbn-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
    }

    .nbn-tab {
        border: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--nbn-text);
    }

    .nbn-tab.is-active {
        background: var(--nbn-primary);
        border-color: var(--nbn-primary);
        color: white;
    }

    .nbn-panel[hidden] {
        display: none
    }

    .nbn-filters {
        padding: 1rem 1.25rem;
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
    }

    .nbn-filters input,
    .nbn-filters select {
        border: 1px solid var(--nbn-border);
        padding: .6rem .7rem;
        background: var(--nbn-bg);
        color: var(--nbn-text);
        flex: 1 1 180px;
        transition: box-shadow .15s, border-color .15s;
    }

    .nbn-filters input::placeholder {
        color: var(--nbn-muted);
    }

    .nbn-filters input:focus,
    .nbn-filters select:focus {
        border-color: var(--nbn-primary);
        box-shadow: 0 0 0 2px rgba(101, 118, 255, 0.1);
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
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: .9rem;
    }

    .nbn-empty {
        text-align: center;
        color: var(--nbn-muted);
        font-size: .95rem;
        margin: 2rem 0;
    }

    .nbn-item {
        position: relative;
        /* border: 1px solid var(--nbn-border); */
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
        border-color: var(--nbn-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.1);
    }

    .nbn-item:active {
        transform: scale(.995);
    }

    .nbn-item.is-sel {
        border-color: var(--nbn-primary);
        box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.2);
    }

    .nbn-thumb {
        width: 100%;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--nbn-gray-100);
        overflow: hidden;
        position: relative;
        border: 1px solid var(--nbn-gray-200);
    }

    .nbn-thumb img,
    .nbn-thumb video {
        max-width: 100%;
        max-height: 100%;
    }

    .nbn-badge {
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

    .nbn-badge svg {
        width: 18px;
        height: 18px;
    }

    .nbn-title {
        font-size: .9rem;
        color: var(--nbn-text);
        margin-top: .55rem;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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
        border: 1px solid var(--nbn-primary);
        background: var(--nbn-primary);
        color: #fff;
    }

    .nbn-btn:hover {
        background: #465fff;
        border-color: #465fff;
    }

    .nbn-btn-secondary {
        background: var(--nbn-secondary);
        border-color: var(--nbn-secondary);
    }

    .nbn-btn-secondary:hover {
        background: #2b3748;
        border-color: #2b3748;
    }

    .nbn-btn-primary {
        background: var(--nbn-primary);
        border-color: var(--nbn-primary);
    }

    .nbn-cancel {
        background: var(--nbn-secondary);
        border-color: var(--nbn-secondary);
        color: #fff;
    }

    .nbn-cancel:hover {
        background: #2b3748;
        border-color: #2b3748;
    }

    .nbn-up {
        display: flex;
        flex-wrap: wrap;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--nbn-border);
        background: var(--nbn-bg);
    }

    .nbn-up input[type="file"],
    .nbn-up input[type="text"],
    .nbn-up input[type="url"] {
        border: 1px solid var(--nbn-border);
        padding: .6rem .7rem;
        background: var(--nbn-bg);
        color: var(--nbn-text);
        margin-right: 8px;
        margin-bottom: 8px;
    }

    .nbn-loader {
        text-align: center;
        color: var(--nbn-muted);
        padding: .75rem;
        font-size: .95rem;
    }

    .nbn-sentinel {
        height: 1px;
    }

    /* Upload section specific styles */
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

    .nbn-btn-active {
        background: var(--nbn-success) !important;
        border-color: var(--nbn-success) !important;
        color: #fff !important;
    }

    /* Import section specific styles */
    .nbn-uploader-url {
        padding: 1.2rem;
        /* background: var(--nbn-gray-100); */
        border: 1px solid var(--nbn-border);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .nbn-url-type-group {
        width: 100%;
        margin: .2rem 0 .4rem;
        border: 1px solid var(--nbn-border);
        padding: .6rem .8rem;
        background: var(--nbn-bg);
    }

    .nbn-url-type-group legend {
        font-size: .9rem;
        color: var(--nbn-text);
        padding: 0 .25rem;
        font-weight: 500;
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
        accent-color: var(--nbn-primary);
    }

    @media (max-width: 768px) {
        .nbn-box {
            width: 96vw;
            max-height: 94vh;
        }

        .nbn-tabs {
            flex-wrap: wrap;
        }

        .nbn-filters {
            flex-direction: column;
        }

        .nbn-filters input,
        .nbn-filters select {
            width: 100%;
        }

        .nbn-upload-fields {
            flex-direction: column;
        }

        .nbn-uploader-actions {
            width: 100%;
            flex-direction: column;
        }

        .nbn-uploader-actions .nbn-btn {
            width: 100%;
        }
    }
</style>

<!-- ====================== nbn PICKER (Updated for Dark/White Mode) ====================== -->
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
                    <option value="voice">صوت</option>
                    <option value="file">ملف</option>
                </select>
            </div>
            <div class="nbn-body">
                <div id="nbnList" class="nbn-grid"></div>
                <div id="nbnLoader" class="nbn-loader" hidden>...تحميل</div>
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
                <div class="nbn-upload-fields">
                    <div style="flex: 1 1 220px;">
                        <label for="nbnUploadFile"
                            style="display: block; width: 100%; cursor: pointer; padding: .6rem .7rem; border: 1px solid var(--nbn-border); background: var(--nbn-gray-100); color: var(--nbn-text); text-align: center;">
                            <i class="fa fa-upload" style="margin-right: 6px;"></i> اختر ملف الوسائط
                            <input type="file" id="nbnUploadFile" accept="image/*,video/*"
                                style="display: none;" />
                        </label>
                    </div>
                    <div style="flex: 1 1 200px;">
                        <input type="text" id="nbnUploadName" placeholder="اسم الملف"
                            style="width: 100%; padding: .6rem .7rem; border: 1px solid var(--nbn-border); background: var(--nbn-bg); color: var(--nbn-text);" />
                    </div>
                    <div style="flex: 1 1 200px;">
                        <input type="text" id="nbnUploadAlt" placeholder="النص البديل"
                            style="width: 100%; padding: .6rem .7rem; border: 1px solid var(--nbn-border); background: var(--nbn-bg); color: var(--nbn-text);" />
                    </div>
                </div>
                <div class="nbn-uploader-actions">
                    <button type="button" class="nbn-btn nbn-btn-secondary" id="nbnUploadToGallery">إدراج في
                        المعرض</button>
                    <button type="button" class="nbn-btn nbn-btn-primary" id="nbnUploadAndClose">إدراج في
                        المقال</button>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const fileInput = document.getElementById('nbnUploadFile');
                    const btnUploadToGallery = document.getElementById('nbnUploadToGallery');
                    const btnUploadAndClose = document.getElementById('nbnUploadAndClose');

                    fileInput?.addEventListener('change', function() {
                        if (fileInput.files && fileInput.files.length > 0) {
                            btnUploadToGallery.classList.add('nbn-btn-active');
                            btnUploadAndClose.classList.add('nbn-btn-active');
                        } else {
                            btnUploadToGallery.classList.remove('nbn-btn-active');
                            btnUploadAndClose.classList.remove('nbn-btn-active');
                        }
                    });
                });
            </script>
        </section>

        <!-- Import -->
        <section id="nbn-panel-import" class="nbn-panel" role="tabpanel" aria-labelledby="nbn-tab-import" hidden>
            <div class="nbn-up nbn-uploader-url">
                <div style="display:flex; flex-wrap:wrap; gap:.7rem; margin-bottom:.7rem;">
                    <input type="text" id="nbnUrl"
                        style="flex:1 1 220px; padding:.7rem 1rem; border:1px solid var(--nbn-border); background:var(--nbn-bg); color:var(--nbn-text); font-size:1rem;"
                        placeholder="الرابط" />
                    <input type="text" id="nbnUrlName" placeholder="اسم الملف"
                        style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid var(--nbn-border); background:var(--nbn-bg); color:var(--nbn-text); font-size:1rem;" />
                    <input type="text" id="nbnUrlAlt" placeholder="النص البديل"
                        style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid var(--nbn-border); background:var(--nbn-bg); color:var(--nbn-text); font-size:1rem;" />
                </div>
                <fieldset class="nbn-url-type-group" aria-label="نوع الوسائط للرابط">
                    <legend>نوع الوسائط (اختياري)</legend>
                    <div style="display: flex; gap: 1.2rem; flex-wrap: wrap;">
                        <label class="nbn-radio">
                            <input type="radio" name="nbn-url-type" value="auto" checked />
                            <span>Auto</span>
                        </label>
                        <label class="nbn-radio">
                            <input type="radio" name="nbn-url-type" value="image" />
                            <span>Image</span>
                        </label>
                        <label class="nbn-radio">
                            <input type="radio" name="nbn-url-type" value="video" />
                            <span>Video</span>
                        </label>
                        <label class="nbn-radio">
                            <input type="radio" name="nbn-url-type" value="voice" />
                            <span>Voice</span>
                        </label>
                        <label class="nbn-radio">
                            <input type="radio" name="nbn-url-type" value="file" />
                            <span>File</span>
                        </label>
                    </div>
                </fieldset>
                <div class="nbn-uploader-actions">
                    <button class="nbn-btn nbn-btn-secondary" type="button" id="nbnImportToGallery">إدراج في
                        المعرض</button>
                    <button class="nbn-btn nbn-btn-primary" type="button" id="nbnImportAndClose">إدراج في
                        المقال</button>
                </div>
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
                empty.className = 'nbn-empty';
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
                upToGal && (upToGal.disabled = false, upToGal.textContent = 'إدراج في المعرض');
                upAndClose && (upAndClose.disabled = false, upAndClose.textContent = 'إدراج في المقال');
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
                placeholder.style.display = 'none';
                if (prevImg) {
                    prevImg.src = payload.url;
                    prevImg.alt = payload.alt || payload.title || '';
                    prevImgWrap && (prevImgWrap.style.display = '');
                }
            } else {
                previewWrap.classList.add('d-none');
                placeholder.style.display = 'block';
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

        // FIXED: Proper event listeners for all delete buttons
        btnPick && btnPick.addEventListener('click', opennbnForSocial);
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
    })();
</script>
