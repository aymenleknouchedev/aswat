<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

<style>
    :root {
        --az-border: #e5e7eb;
        --az-muted: #6b7280;
        --az-soft: #f8f9fa;
        --az-card: #ffffff;
        --az-title: #111827;
        --az-accent: #0d6efd;
        --az-danger: #dc3545;
        --az-success: #198754;
    }

    .circle-number {
        width: 28px;
        height: 28px;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        background: var(--az-accent);
        color: #fff
    }

    .text-ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis
    }

    .no-select {
        user-select: none
    }

    /* List */
    .az-item-card {
        background: var(--az-card);
        border: 1px solid var(--az-border);
        border-radius: .5rem;
        margin-bottom: 10px;
        padding: 10px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .04)
    }

    .az-item-row {
        display: flex;
        align-items: center;
        justify-content: space-between
    }

    .az-left {
        display: flex;
        align-items: center
    }

    .az-thumb {
        width: 64px;
        height: 48px;
        border: 1px solid var(--az-border);
        border-radius: .35rem;
        overflow: hidden;
        background: #fafafa;
        margin-right: 10px;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .az-thumb img,
    .az-thumb video {
        max-width: 100%;
        max-height: 100%
    }

    .az-meta {
        min-width: 0
    }

    .az-title {
        color: var(--az-title);
        font-weight: 600
    }

    .az-desc {
        color: var(--az-muted);
        font-size: .925rem
    }

    .az-actions .btn {
        margin-left: 6px
    }

    .az-drag {
        width: 38px;
        height: 38px;
        border: 1px dashed var(--az-border);
        border-radius: .35rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--az-muted);
        margin-right: 10px
    }

    /* Modal Add/Edit */
    .modal-footer-sticky {
        position: sticky;
        bottom: 0;
        background: #fff;
        border-top: 1px solid var(--az-border);
        z-index: 2
    }

    #itemModal .form-control {
        min-height: 42px
    }

    #itemModal .input-group .btn {
        min-height: 42px
    }

    #itemMediaPreview img,
    #itemMediaPreview video {
        border: 1px solid #eee;
        padding: 2px;
        max-height: 140px;
        border-radius: .35rem
    }

    .az-modal-header {
        display: flex;
        align-items: center;
        justify-content: flex-start
    }

    .az-modal-icon {
        width: 38px;
        height: 38px;
        border-radius: .5rem;
        background: var(--az-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--az-accent);
        margin-right: 10px
    }

    /* MGX Picker */
    #mgxMediaPicker,
    #mgxMediaPicker * {
        box-sizing: border-box
    }

    .mgx-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 2055
    }

    .mgx-modal[aria-hidden="false"] {
        display: flex
    }

    .mgx-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .5);
        z-index: 2050
    }

    .mgx-box {
        position: relative;
        margin: auto;
        width: min(1000px, 92vw);
        max-height: 90vh;
        background: #fff;
        color: #111;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: .5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        z-index: 2056
    }

    .mgx-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        border-bottom: 1px solid var(--az-border)
    }

    .mgx-x {
        background: transparent;
        border: 0;
        font-size: 1.6rem;
        cursor: pointer;
        color: #666
    }

    .mgx-tabs {
        display: flex;
        padding: 8px 16px;
        border-bottom: 1px solid var(--az-border)
    }

    .mgx-tab {
        border: 1px solid var(--az-border);
        background: #fff;
        padding: .5rem .85rem;
        cursor: pointer;
        font-weight: 600;
        margin-right: 8px
    }

    .mgx-tab.is-active {
        border-color: #cfcfcf
    }

    .mgx-panel {
        display: block
    }

    .mgx-panel[hidden] {
        display: none
    }

    .mgx-filters {
        display: flex;
        padding: 12px 16px;
        border-bottom: 1px solid var(--az-border)
    }

    .mgx-filters input,
    .mgx-filters select {
        border: 1px solid #dcdcdc;
        padding: .55rem .7rem;
        flex: 1 1 200px
    }

    .mgx-filters input {
        margin-right: 8px
    }

    .mgx-body {
        padding: 12px 16px;
        overflow: auto;
        flex: 1
    }

    .mgx-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr))
    }

    .mgx-item {
        border: 1px solid var(--az-border);
        padding: 8px;
        cursor: pointer;
        margin: 6px;
        border-radius: .35rem
    }

    .mgx-item.is-sel {
        box-shadow: 0 0 0 3px #e5e7eb
    }

    .mgx-thumb {
        height: 120px;
        background: #fafafa;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #f0f0f0;
        position: relative;
        border-radius: .35rem
    }

    .mgx-thumb img,
    .mgx-thumb video {
        max-width: 100%;
        max-height: 100%
    }

    .mgx-badge {
        position: absolute;
        top: 6px;
        left: 6px;
        width: 28px;
        height: 28px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        display: grid;
        place-items: center;
        border-radius: .35rem
    }

    .mgx-title {
        margin-top: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis
    }

    .mgx-loader {
        text-align: center;
        color: var(--az-muted);
        padding: .6rem
    }

    .mgx-foot {
        display: flex;
        justify-content: flex-end;
        padding: 12px 16px;
        border-top: 1px solid var(--az-border)
    }

    .mgx-btn {
        border: 1px solid #000;
        background: #000;
        color: #fff;
        padding: .55rem .9rem;
        font-weight: 600;
        cursor: pointer;
        margin-left: 8px;
        border-radius: .35rem
    }

    .mgx-cancel {
        background: #444;
        border-color: #444
    }

    .mgx-up {
        display: flex;
        flex-wrap: wrap;
        padding: 12px 16px;
        border-bottom: 1px solid var(--az-border)
    }

    .mgx-up input[type="file"],
    .mgx-up input[type="text"],
    .mgx-up input[type="url"] {
        border: 1px solid #dcdcdc;
        padding: .5rem .7rem;
        margin-right: 8px;
        margin-bottom: 8px;
        border-radius: .35rem
    }

    .btn-primary {
        background: var(--az-accent);
        border-color: var(--az-accent)
    }

    .btn-success {
        background: var(--az-success);
        border-color: var(--az-success)
    }

    .btn-outline-danger {
        color: var(--az-danger);
        border-color: var(--az-danger)
    }

    .btn-outline-primary {
        color: var(--az-accent);
        border-color: var(--az-accent)
    }
</style>

<!-- ============== ONGLETS CONTENU (SANS <form>) ============== -->
<div id="contentTab" class="container py-3">
    <div id="list-items-hidden-inputs"></div>

    <div id="template" class="tab-pane show active" role="tabpanel" aria-labelledby="template-tab">
        <div class="form-group col-lg-12 mb-3">
            <label class="form-label">القالب</label>
            <span class="text-danger">*</span>
            <div class="d-flex flex-column mt-2">
                <div class="form-check form-check-inline" style="margin-bottom:6px;">
                    <input class="form-check-input" type="radio" name="display_method" id="display_method_simple"
                        value="simple" checked>
                    <label class="form-check-label" for="display_method_simple">أساسي</label>
                </div>
                <div class="form-check form-check-inline" style="margin-bottom:6px;">
                    <input class="form-check-input" type="radio" name="display_method" id="display_method_list"
                        value="list">
                    <label class="form-check-label" for="display_method_list">قائمة</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="display_method" id="display_method_file"
                        value="file">
                    <label class="form-check-label" for="display_method_file">ملف</label>
                </div>
            </div>
        </div>

        <!-- Section dynamique (items) -->
        <div id="dynamic-items-section" class="mt-3" style="display:none;">
            <div class="d-flex" style="margin-bottom:10px;">
                <button type="button" id="add-item-btn" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#itemModal">
                    <i class="fa fa-plus"></i> إضافة عنصر
                </button>
                <button type="button" id="clear-all-btn" class="btn btn-outline-danger mx-1" style="margin-left:8px;">
                    <i class="fa fa-trash"></i> حذف الكل
                </button>
            </div>
            <div id="items-container"></div>
        </div>
    </div>
</div>

<!-- ================================ MODAL ITEM ================================ -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalFormId">
            <div class="modal-header">
                <div class="az-modal-header">
                    <h5 class="modal-title">إضافة / تعديل عنصر</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="editIndex" />
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-2">
                            <label class="form-label">العنوان <span class="text-danger">*</span></label>
                            <input id="itemTitle" class="form-control" placeholder="عنوان واضح ومختصر" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">الوصف <span class="text-danger">*</span></label>
                            <textarea id="itemDescription" class="form-control tinymce-simple" rows="4" placeholder="ملخص قصير"></textarea>
                        </div>

                        <!-- TinyMCE -->
                        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                tinymce.init({
                                    selector: 'textarea.tinymce-simple',
                                    menubar: false,
                                    toolbar: 'bold italic underline | bullist numlist | undo redo | removeformat',
                                    statusbar: false,
                                    height: 350,
                                    directionality: 'rtl',
                                    language: 'ar',
                                    plugins: 'lists directionality',
                                    branding: false,
                                });
                            });
                        </script>

                        <div class="mb-2">
                            <label class="form-label">الرابط <small class="text-muted">(مطلوب في وضع
                                    قائمة)</small></label>
                            <input id="itemLinkUrl" class="form-control" placeholder="https://example.com/article" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">الوسائط <span class="text-danger">*</span></label>
                        <div class="input-group mb-2">
                            <input id="itemMediaUrl" class="form-control" placeholder="لم يتم الاختيار" readonly>
                            <button type="button" class="btn btn-outline-secondary" id="btnPickMedia">
                                <i class="fa fa-images"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger" id="btnClearMedia" title="مسح">
                                <i class="fa fa-xmark"></i>
                            </button>
                        </div>
                        <input type="hidden" id="itemMediaId">
                        <input type="hidden" id="itemMediaTitle">
                        <input type="hidden" id="itemMediaAlt">
                        <div id="itemMediaPreview" class="mt-2"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer modal-footer-sticky">
                <div class="d-flex w-100 justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button id="saveItemBtn" type="button" class="btn btn-success mx-2">
                        <i class="fa fa-floppy-disk me-1"></i> حفظ العنصر
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======================= Sortable ======================= -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<!-- ======================= MGX ICONS ======================= -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
    <symbol id="mgx-i-image" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <circle cx="8" cy="10" r="1.5" fill="currentColor" />
        <path d="M21 19l-5.5-7-4.5 6-3-4-4 5" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="mgx-i-video" viewBox="0 0 24 24">
        <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
    <symbol id="mgx-i-voice" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <rect x="9" y="7" width="2" height="10" rx="1" fill="currentColor" />
        <rect x="13" y="11" width="2" height="6" rx="1" fill="currentColor" />
    </symbol>
    <symbol id="mgx-i-file" viewBox="0 0 24 24">
        <rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor"
            stroke-width="2" />
        <path d="M9 7h6M9 11h6M9 15h2" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="mgx-i-youtube" viewBox="0 0 24 24">
        <rect x="2" y="6" width="20" height="12" rx="4" fill="none" stroke="currentColor"
            stroke-width="2" />
        <polygon points="10,9 16,12 10,15" fill="currentColor" />
    </symbol>
</svg>

<!-- ============== Helpers (routes sûres + backdrops) ============== -->
<script>
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

    function azRemoveLingeringBackdrops() {
        try {
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('padding-right');
            document.documentElement.style.overflow = '';
        } catch (e) {}
    }
</script>

<!-- ============== MGX PICKER (Gallery/Upload/Import) ============== -->
<div id="mgxMediaPicker" class="mgx-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="mgxTitle">
    <div class="mgx-backdrop" data-mgx-backdrop></div>
    <div class="mgx-box" role="document">
        <div class="mgx-head">
            <h5 id="mgxTitle">اختيار وسائط</h5>
            <button type="button" class="mgx-x" data-mgx-close aria-label="إغلاق">&times;</button>
        </div>

        <div class="mgx-tabs" role="tablist">
            <button class="mgx-tab is-active" data-mgx-tab="gallery" role="tab" aria-selected="true"
                aria-controls="mgx-panel-gallery" id="mgx-tab-gallery">المعرض</button>
            <button class="mgx-tab" data-mgx-tab="upload" role="tab" aria-selected="false"
                aria-controls="mgx-panel-upload" id="mgx-tab-upload">رفع</button>
            <button class="mgx-tab" data-mgx-tab="import" role="tab" aria-selected="false"
                aria-controls="mgx-panel-import" id="mgx-tab-import">استيراد بالرابط</button>
        </div>

        <!-- Gallery -->
        <section id="mgx-panel-gallery" class="mgx-panel" role="tabpanel" aria-labelledby="mgx-tab-gallery">
            <div class="mgx-filters">
                <input type="text" id="mgxSearch" placeholder="ابحث..." />
                <select id="mgxType">
                    <option value="all">كل الأنواع</option>
                    <option value="image">صور</option>
                    <option value="video">فيديو</option>
                    <option value="voice">صوت</option>
                    <option value="file">ملف</option>
                </select>
            </div>
            <div class="mgx-body">
                <div id="mgxList" class="mgx-grid"></div>
                <div id="mgxLoader" class="mgx-loader" hidden>...تحميل</div>
                <div id="mgxSentinel" class="mgx-sentinel"></div>
            </div>
            <div class="mgx-foot">
                <button type="button" class="mgx-btn mgx-choose" id="mgxChoose">اختيار</button>
                <button type="button" class="mgx-btn mgx-cancel" data-mgx-close>إلغاء</button>
            </div>
        </section>

        <!-- Upload -->
        <section id="mgx-panel-upload" class="mgx-panel" role="tabpanel" aria-labelledby="mgx-tab-upload" hidden>
            <div class="mgx-up">
                <input type="file" id="mgxUploadFile" />
                <input type="text" id="mgxUploadName" placeholder="اسم (اختياري)" />
                <input type="text" id="mgxUploadAlt" placeholder="ALT (اختياري)" />
                <div style="width:100%;"></div>
                <button type="button" class="mgx-btn" id="mgxUploadToGallery">رفع & فتح المعرض</button>
                <button type="button" class="mgx-btn" id="mgxUploadAndClose">رفع & اختيار</button>
            </div>
        </section>

        <!-- Import -->
        <section id="mgx-panel-import" class="mgx-panel" role="tabpanel" aria-labelledby="mgx-tab-import" hidden>
            <div class="mgx-up">
                <input type="url" id="mgxUrl" placeholder="رابط مباشر أو YouTube" />
                <input type="text" id="mgxUrlName" placeholder="اسم (اختياري)" />
                <input type="text" id="mgxUrlAlt" placeholder="ALT (اختياري)" />
                <fieldset class="mgx-radio-group">
                    <legend>النوع</legend>
                    <label style="margin-right:12px;"><input type="radio" name="mgx-url-type" value="auto"
                            checked> Auto</label>
                    <label style="margin-right:12px;"><input type="radio" name="mgx-url-type" value="image">
                        Image</label>
                    <label style="margin-right:12px;"><input type="radio" name="mgx-url-type" value="video">
                        Video</label>
                    <label style="margin-right:12px;"><input type="radio" name="mgx-url-type" value="voice">
                        Voice</label>
                    <label><input type="radio" name="mgx-url-type" value="file"> File</label>
                </fieldset>
                <div style="width:100%;"></div>
                <button type="button" class="mgx-btn" id="mgxImportToGallery">استيراد & فتح المعرض</button>
                <button type="button" class="mgx-btn" id="mgxImportAndClose">استيراد & اختيار</button>
            </div>
        </section>
    </div>
</div>

<script>
    (() => {
        const MGX_FETCH_URL = azSafeRoute("{{ route('dashboard.media.getAllMediaPaginated') }}",
            "/dashboard/media/paginated");
        const MGX_UPLOAD_URL = azSafeRoute("{{ route('dashboard.media.store') }}", "/dashboard/media");
        const MGX_IMPORT_URL = azSafeRoute("{{ route('dashboard.media_url.store') }}", "/dashboard/media-url");
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const CSRF = csrfMeta ? csrfMeta.getAttribute('content') : '';

        const root = document.getElementById('mgxMediaPicker');
        if (!root) return;
        const backdrop = root.querySelector('[data-mgx-backdrop]');
        const closeBtns = root.querySelectorAll('[data-mgx-close]');
        const tabs = Array.from(root.querySelectorAll('.mgx-tab'));
        const panels = {
            gallery: document.getElementById('mgx-panel-gallery'),
            upload: document.getElementById('mgx-panel-upload'),
            import: document.getElementById('mgx-panel-import')
        };
        const listEl = document.getElementById('mgxList');
        const loaderEl = document.getElementById('mgxLoader');
        const sentinel = document.getElementById('mgxSentinel');
        const searchEl = document.getElementById('mgxSearch');
        const typeEl = document.getElementById('mgxType');
        const chooseBtn = document.getElementById('mgxChoose');
        const upFile = document.getElementById('mgxUploadFile');
        const upName = document.getElementById('mgxUploadName');
        const upAlt = document.getElementById('mgxUploadAlt');
        const upToGal = document.getElementById('mgxUploadToGallery');
        const upAndClose = document.getElementById('mgxUploadAndClose');
        const urlInput = document.getElementById('mgxUrl');
        const urlName = document.getElementById('mgxUrlName');
        const urlAlt = document.getElementById('mgxUrlAlt');
        const urlTypeRadios = root.querySelectorAll('input[name="mgx-url-type"]');
        const importToGal = document.getElementById('mgxImportToGallery');
        const importAndClose = document.getElementById('mgxImportAndClose');

        const state = {
            open: false,
            page: 1,
            hasMore: true,
            isLoading: false,
            list: [],
            search: "",
            type: 'all',
            selected: null,
            obs: null,
            cb: null
        };

        const YT =
            /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/i;
        const isYT = u => YT.test(u || "");
        const youId = u => (u && u.match(YT) ? u.match(YT)[1] : null);
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
        const iconId = m => isYT(m.path) ? 'mgx-i-youtube' : ({
            image: 'mgx-i-image',
            video: 'mgx-i-video',
            voice: 'mgx-i-voice'
        } [kind(m)] || 'mgx-i-file');

        window.mgxPicker = {
            open(onSelect) {
                state.cb = (typeof onSelect === 'function') ? onSelect : null;
                open();
            },
            close() {
                close();
            }
        };

        function switchTab(t) {
            tabs.forEach(b => {
                const act = b.dataset.mgxTab === t;
                b.classList.toggle('is-active', act);
                b.setAttribute('aria-selected', String(act));
            });
            Object.entries(panels).forEach(([k, el]) => {
                if (el) el.hidden = (k !== t);
            });
        }
        tabs.forEach(b => b.addEventListener('click', () => switchTab(b.dataset.mgxTab)));

        function lockScroll() {
            document.documentElement.style.overflow = 'hidden';
            document.body.classList.add('modal-open');
        }

        function unlockScroll() {
            document.documentElement.style.overflow = '';
            document.body.classList.remove('modal-open');
        }

        function open() {
            state.open = true;
            root.setAttribute('aria-hidden', 'false');
            lockScroll();
            switchTab('gallery');
            resetAndLoad();
            try {
                searchEl && searchEl.focus({
                    preventScroll: true
                });
            } catch (e) {}
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
            azRemoveLingeringBackdrops();
        }
        backdrop && backdrop.addEventListener('click', close);
        closeBtns.forEach(b => b.addEventListener('click', close));

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
            const rootEl = panels.gallery ? panels.gallery.querySelector('.mgx-body') : null;
            const sentinelEl = document.getElementById('mgxSentinel');
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
            loaderEl && (loaderEl.hidden = false);
            try {
                const u = new URL(MGX_FETCH_URL);
                u.searchParams.set('page', state.page);
                u.searchParams.set('search', (state.search || '').trim());
                u.searchParams.set('type', mapType(state.type));
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
                console.error('MGX fetch error', e);
                state.hasMore = false;
            } finally {
                state.isLoading = false;
                loaderEl && (loaderEl.hidden = true);
                render();
            }
        }

        function render() {
            if (!listEl) return;
            listEl.textContent = '';
            const arr = state.type === 'all' ? state.list : state.list.filter(m => kind(m) === state.type);
            if (!arr.length) {
                const empty = document.createElement('div');
                empty.style.textAlign = 'center';
                empty.style.color = '#666';
                empty.textContent = 'لا توجد وسائط';
                listEl.appendChild(empty);
                return;
            }
            arr.forEach(m => {
                const it = document.createElement('div');
                it.className = 'mgx-item' + (state.selected && state.selected.id === m.id ? ' is-sel' : '');
                it.addEventListener('click', () => {
                    state.selected = (state.selected && state.selected.id === m.id) ? null : m;
                    render();
                });
                const th = document.createElement('div');
                th.className = 'mgx-thumb';
                const badge = document.createElement('div');
                badge.className = 'mgx-badge';
                badge.innerHTML = `<svg><use href="#${iconId(m)}"></use></svg>`;
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
                    } else if (k === 'video' && /\.(mp4|webm|mkv|mov|avi|m4v)(\?|$)/i.test(p)) {
                        const v = document.createElement('video');
                        v.src = p;
                        v.muted = true;
                        v.preload = 'metadata';
                        th.appendChild(v);
                    }
                }
                it.appendChild(th);
                const tt = document.createElement('div');
                tt.className = 'mgx-title';
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

        const choose = () => {
            if (!state.selected) {
                alert('يرجى اختيار وسيط');
                return;
            }
            const m = state.selected;
            const payload = {
                id: m.id,
                url: m.url || m.path || '',
                title: m.name || '',
                alt: m.alt || '',
                type: kind(m)
            };
            if (!payload.url) {
                alert('الرابط غير متاح لهذا الوسيط');
                return;
            }
            if (state.cb) state.cb(payload);
            close();
        };
        chooseBtn && chooseBtn.addEventListener('click', choose);

        async function doUpload(mode) {
            const f = upFile && upFile.files ? upFile.files[0] : null;
            if (!f) {
                alert('اختر ملفاً');
                return;
            }
            const form = new FormData();
            form.append('media', f);
            if (upName && upName.value) form.append('name', upName.value);
            if (upAlt && upAlt.value) form.append('alt', upAlt.value);
            try {
                upToGal && (upToGal.disabled = true, upToGal.textContent = '...');
                upAndClose && (upAndClose.disabled = true, upAndClose.textContent = '...');
                const r = await fetch(MGX_UPLOAD_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        Accept: 'application/json'
                    },
                    body: form
                });
                if (!r.ok) {
                    alert('فشل الرفع');
                    return;
                }
                await resetAndLoad();
                if (mode === 'gallery') {
                    switchTab('gallery');
                } else {
                    const first = state.list[0] || null;
                    if (first && state.cb) state.cb({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || '',
                        alt: first.alt || '',
                        type: kind(first)
                    });
                    close();
                }
            } catch (e) {
                console.error(e);
                alert('فشل الرفع');
            } finally {
                upToGal && (upToGal.disabled = false, upToGal.textContent = 'رفع & فتح المعرض');
                upAndClose && (upAndClose.disabled = false, upAndClose.textContent = 'رفع & اختيار');
                upFile && (upFile.value = '');
                upName && (upName.value = '');
                upAlt && (upAlt.value = '');
            }
        }
        upToGal && upToGal.addEventListener('click', () => doUpload('gallery'));
        upAndClose && upAndClose.addEventListener('click', () => doUpload('select'));

        function selectedUrlType() {
            const r = [...urlTypeRadios].find(x => x.checked);
            return r ? r.value : 'auto';
        }
        async function doImport(mode) {
            const u = (urlInput && urlInput.value || '').trim();
            if (!u) {
                alert('أدخل الرابط');
                return;
            }
            const body = {
                url: u
            };
            if (urlName && urlName.value) body.name = urlName.value;
            if (urlAlt && urlAlt.value) body.alt = urlAlt.value;
            const t = selectedUrlType();
            if (t !== 'auto') body.media_type = (t === 'voice' ? 'audio' : t);
            try {
                importToGal && (importToGal.disabled = true, importToGal.textContent = '...');
                importAndClose && (importAndClose.disabled = true, importAndClose.textContent = '...');
                const r = await fetch(MGX_IMPORT_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        Accept: 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(body)
                });
                if (!r.ok) {
                    alert('فشل الاستيراد');
                    return;
                }
                await resetAndLoad();
                if (mode === 'gallery') {
                    switchTab('gallery');
                } else {
                    const first = state.list[0] || null;
                    if (first && state.cb) state.cb({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || '',
                        alt: first.alt || '',
                        type: kind(first)
                    });
                    close();
                }
            } catch (e) {
                console.error(e);
                alert('فشل الاستيراد');
            } finally {
                importToGal && (importToGal.disabled = false, importToGal.textContent = 'استيراد & فتح المعرض');
                importAndClose && (importAndClose.disabled = false, importAndClose.textContent =
                    'استيراد & اختيار');
                urlInput && (urlInput.value = '');
                urlName && (urlName.value = '');
                urlAlt && (urlAlt.value = '');
                urlTypeRadios.forEach(r => r.checked = (r.value === 'auto'));
            }
        }
        importToGal && importToGal.addEventListener('click', () => doImport('gallery'));
        importAndClose && importAndClose.addEventListener('click', () => doImport('select'));
    })();
</script>

<!-- ======================== Onglet & Persistance (sans créer de <form>) ======================== -->
<script>
    (function() {
        const STORAGE_KEY_ITEMS = 'az_content_items_v6';
        const STORAGE_KEY_MODE = 'az_display_method_v6';

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
        const inpUrl = document.getElementById('itemMediaUrl');
        const inpId = document.getElementById('itemMediaId');
        const inpTitle = document.getElementById('itemMediaTitle');
        const inpAlt = document.getElementById('itemMediaAlt');
        const prev = document.getElementById('itemMediaPreview');
        const btnPick = document.getElementById('btnPickMedia');
        const btnClear = document.getElementById('btnClearMedia');

        if (window.bootstrap && modalEl) {
            modalEl.addEventListener('hidden.bs.modal', azRemoveLingeringBackdrops);
            modalEl.addEventListener('hide.bs.modal', azRemoveLingeringBackdrops);
        }

        let items = [];

        function saveItems() {
            try {
                localStorage.setItem(STORAGE_KEY_ITEMS, JSON.stringify(items));
            } catch {}
        }

        function loadItems() {
            try {
                const raw = localStorage.getItem(STORAGE_KEY_ITEMS);
                if (raw) {
                    const p = JSON.parse(raw);
                    if (Array.isArray(p)) items = p;
                }
            } catch {}
        }

        function saveMode() {
            const c = document.querySelector('input[name="display_method"]:checked');
            if (c) try {
                localStorage.setItem(STORAGE_KEY_MODE, c.value);
            } catch {}
        }

        function loadMode() {
            try {
                const m = localStorage.getItem(STORAGE_KEY_MODE);
                if (m) {
                    const r = document.querySelector(`input[name="display_method"][value="${m}"]`);
                    if (r) r.checked = true;
                }
            } catch {}
        }

        function currentMode() {
            const r = document.querySelector('input[name="display_method"]:checked');
            return r ? r.value : 'simple';
        }

        function toggleSection() {
            const val = currentMode();
            const show = (val === 'list' || val === 'file');
            dynamicSection.style.display = show ? 'block' : 'none';
        }
        displayMethodRadios.forEach(r => r.addEventListener('change', () => {
            toggleSection();
            saveMode();
        }));

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

        btnPick && btnPick.addEventListener('click', () => {
            if (!window.mgxPicker) {
                alert('MGX Picker غير محمّل');
                return;
            }
            window.mgxPicker.open(media => {
                if (!media || !media.url) {
                    alert('لا يمكن استخدام هذا الوسيط');
                    return;
                }
                inpId.value = media.id || '';
                inpUrl.value = media.url || '';
                inpTitle.value = media.title || '';
                inpAlt.value = media.alt || '';
                renderPreview();
            });
        });
        btnClear && btnClear.addEventListener('click', () => {
            inpId.value = '';
            inpUrl.value = '';
            inpTitle.value = '';
            inpAlt.value = '';
            prev.textContent = '';
        });

        addBtn && addBtn.addEventListener('click', () => {
            editIndexInput.value = '';
            titleEl.value = '';
            descEl.value = '';
            linkEl.value = '';
            if (window.tinymce && tinymce.get('itemDescription')) tinymce.get('itemDescription').setContent(
                '');
            inpId.value = '';
            inpUrl.value = '';
            inpTitle.value = '';
            inpAlt.value = '';
            prev.textContent = '';
        });

        function textFromHtml(html) {
            const tmp = document.createElement('div');
            tmp.innerHTML = html || '';
            return (tmp.textContent || '').replace(/\s+/g, ' ').trim();
        }

        function renderItems() {
            container.textContent = '';
            if (!items.length) {
                const emp = document.createElement('div');
                emp.style.color = 'var(--az-muted)';
                emp.style.border = '1px dashed var(--az-border)';
                emp.style.borderRadius = '.5rem';
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
                const d = document.createElement('div');
                d.className = 'az-desc text-ellipsis';
                d.textContent = textFromHtml(it.description || '');
                meta.appendChild(t);
                meta.appendChild(d);
                left.appendChild(meta);

                const right = document.createElement('div');
                right.className = 'az-actions';
                const badge = document.createElement('span');
                badge.className = 'circle-number';
                badge.textContent = String(i + 1);

                const editBtn = document.createElement('button');
                editBtn.type = 'button';
                editBtn.className = 'btn btn-sm btn-outline-primary';
                editBtn.style.marginLeft = '6px';
                editBtn.innerHTML = '<i class="fa fa-pen"></i> تعديل';
                editBtn.addEventListener('click', () => {
                    editIndexInput.value = String(i);
                    titleEl.value = it.title || '';
                    descEl.value = it.description || '';
                    if (window.tinymce && tinymce.get('itemDescription')) tinymce.get(
                        'itemDescription').setContent(it.description || '');
                    linkEl.value = it.url || '';
                    inpId.value = it.media_id || '';
                    inpUrl.value = it.image || '';
                    inpTitle.value = it.media_title || '';
                    inpAlt.value = it.media_alt || '';
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
                delBtn.className = 'btn btn-sm btn-outline-danger';
                delBtn.style.marginLeft = '6px';
                delBtn.innerHTML = '<i class="fa fa-trash"></i> حذف';
                delBtn.addEventListener('click', () => {
                    items.splice(i, 1);
                    saveItems();
                    renderItems();
                });

                right.appendChild(badge);
                right.appendChild(editBtn);
                right.appendChild(delBtn);
                row.appendChild(left);
                row.appendChild(right);
                card.appendChild(row);
                container.appendChild(card);
            });
        }

        /* === TinyMCE-safe getters === */
        function getTinyHtml(id) {
            if (window.tinymce && tinymce.get(id)) {
                return tinymce.get(id).getContent();
            }
            return (document.getElementById(id)?.value || '').trim();
        }

        function getTinyText(id) {
            if (window.tinymce && tinymce.get(id)) {
                return tinymce.get(id).getContent({
                    format: 'text'
                }).replace(/\s+/g, ' ').trim();
            }
            return (document.getElementById(id)?.value || '').replace(/\s+/g, ' ').trim();
        }

        /* === SAVE BTN (fixed validation for description) === */
        saveBtn && saveBtn.addEventListener('click', () => {
            const mode = currentMode();
            const title = (titleEl.value || '').trim();
            const descriptionText = getTinyText('itemDescription'); // for validation
            const descriptionHTML = getTinyHtml('itemDescription'); // stored content
            const imageUrl = (inpUrl.value || '').trim();
            const linkUrl = (linkEl.value || '').trim();

            if (!title) {
                alert('العنوان مطلوب');
                return;
            }
            if (!descriptionText) {
                alert('الوصف مطلوب');
                return;
            }
            if (!imageUrl) {
                alert('الصورة مطلوبة');
                return;
            }
            if (mode === 'list' && !linkUrl) {
                alert('الرابط مطلوب في وضع قائمة');
                return;
            }

            const payload = {
                title,
                description: descriptionHTML,
                image: imageUrl,
                url: linkUrl || null,
                media_id: inpId.value || null,
                media_title: inpTitle.value || '',
                media_alt: inpAlt.value || '',
            };

            if (editIndexInput.value !== '') {
                const idx = parseInt(editIndexInput.value, 10);
                if (Number.isFinite(idx) && idx >= 0 && idx < items.length) items[idx] = payload;
            } else {
                items.push(payload);
            }

            saveItems();
            renderItems();

            if (window.bootstrap && bootstrap.Modal) {
                bootstrap.Modal.getOrCreateInstance(modalEl).hide();
            } else {
                modalEl.style.display = 'none';
                modalEl.setAttribute('aria-hidden', 'true');
            }
            azRemoveLingeringBackdrops();
        });

        clearAllBtn && clearAllBtn.addEventListener('click', () => {
            if (confirm('حذف جميع العناصر؟ لا يمكن التراجع.')) {
                items = [];
                saveItems();
                renderItems();
            }
        });

        // Sérialisation vers formulaire parent
        if (mainForm) {
            mainForm.addEventListener('submit', () => {
                hiddenInputsContainer.textContent = '';
                items.forEach((it, i) => {
                    addHidden(`items[${i}][title]`, it.title || '');
                    addHidden(`items[${i}][description]`, it.description || ''); // HTML
                    addHidden(`items[${i}][image]`, it.image || '');
                    addHidden(`items[${i}][url]`, it.url || '');
                    addHidden(`items[${i}][index]`, String(i));
                    addHidden(`items[${i}][media_title]`, it.media_title || '');
                    addHidden(`items[${i}][media_alt]`, it.media_alt || '');
                });
            });
        } else {
            console.warn('[contentTab] Aucun formulaire parent trouvé.');
        }

        function addHidden(name, val) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = String(val).replace(/"/g, '&quot;');
            hiddenInputsContainer.appendChild(input);
        }

        new Sortable(container, {
            animation: 150,
            handle: '.az-drag',
            onEnd(evt) {
                const oldIndex = evt.oldIndex,
                    newIndex = evt.newIndex;
                if (!Number.isFinite(oldIndex) || !Number.isFinite(newIndex)) return;
                const m = items.splice(oldIndex, 1)[0];
                items.splice(newIndex, 0, m);
                saveItems();
                renderItems();
            }
        });

        // Init
        (function init() {
            loadMode();
            toggleSection();
            loadItems();
            // Migration champs anciens
            items = items.map(it => {
                if (!it.image && it.media_url) {
                    it.image = it.media_url;
                }
                return it;
            });
            saveItems();
            renderItems();
        })();

        // Purge localStorage après succès (si الصفحة تعرض .alert-success)
        window.addEventListener('DOMContentLoaded', function() {
            const ok = document.querySelector('.alert.alert-success, .alert-success');
            if (ok) {
                try {
                    localStorage.removeItem(STORAGE_KEY_ITEMS); /* garder/حذف الوضع حسب رغبتك */
                } catch {}
            }
        });
    })();
</script>
