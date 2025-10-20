<!-- ======================= HEAD ASSETS (place in <head>) ======================= -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="preconnect" href="https://www.youtube.com">
<link rel="preconnect" href="https://i.ytimg.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<!-- ======================= MMX MEDIA MODAL INCLUDE (required) ======================= -->
@include('dashboard.components.media-modal')

<!-- ======================= MEDIA MANAGER UI ======================= -->
<div class="media-manager">
    @csrf

    <!-- Media Type Selection -->
    <div class="media-type-selector mb-4">
        <div class="d-flex flex-wrap">
            <div class="media-type-card">
                <input type="radio" name="template" id="normal-radio" value="normal_image" class="media-type-input"
                    checked>
                <label for="normal-radio" class="media-type-label">
                    <i class="fas fa-image"></i>
                    <span>صورة</span>
                </label>
            </div>
            <div class="media-type-card">
                <input type="radio" name="template" id="video-radio" value="video" class="media-type-input">
                <label for="video-radio" class="media-type-label">
                    <i class="fas fa-video"></i>
                    <span>فيديو</span>
                </label>
            </div>
            <div class="media-type-card">
                <input type="radio" name="template" id="podcast-radio" value="podcast" class="media-type-input">
                <label for="podcast-radio" class="media-type-label">
                    <i class="fas fa-podcast"></i>
                    <span>بودكاست</span>
                </label>
            </div>
            <div class="media-type-card">
                <input type="radio" name="template" id="album-radio" value="album" class="media-type-input">
                <label for="album-radio" class="media-type-label">
                    <i class="fas fa-images"></i>
                    <span>ألبوم</span>
                </label>
            </div>
            <div class="media-type-card">
                <input type="radio" name="template" id="article-radio" value="no_image" class="media-type-input">
                <label for="article-radio" class="media-type-label">
                    <i class="fas fa-file-alt"></i>
                    <span>مقال</span>
                </label>
            </div>
        </div>
    </div>

    <!-- Hidden Fields -->
    <div id="media-hidden-fields"></div>

    <!-- Dynamic Template Content -->
    <div id="mediaTypeContent"></div>

    <!-- Summary Panel -->
    <div class="media-summary-panel mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">ملخص الوسائط المختارة</h5>
                <span class="badge bg-primary" id="selected-count">0</span>
            </div>
            <div class="card-body">
                <div id="summary-table-body" class="media-summary-grid"></div>
            </div>
        </div>
    </div>
</div>

<!-- ======================= SCRIPT ======================= -->
<script>
    class MediaTabManager {
        constructor() {
            this.state = {
                currentTemplate: 'normal_image',
                currentField: '',
                selectedMedia: {}
            };

            /* ===== OPTIONAL PROXY =====
               فعّل البروكسي إذا كان هناك حظر Hotlinking في بعض الهوستات. */
            this.USE_PROXY = false;
            this.PROXY_URL = '/media/proxy?url=';

            this.YT_REGEX = /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/i;

            this.init();
        }

        /* ================== INIT & EVENTS ================== */
        init() {
            this.bindEvents();
            this.loadTemplateContent('normal_image');
            this.updateSummary();

            // Bridge MMX selection -> this manager
            if (window.mmxMediaModalManager) {
                const originalHandler = window.mmxMediaModalManager.onMediaSelected;
                window.mmxMediaModalManager.onMediaSelected = (payload) => {
                    if (typeof this.onMediaSelected === 'function') this.onMediaSelected(payload);
                    if (typeof originalHandler === 'function') originalHandler(payload);
                };
            }
        }

        bindEvents() {
            document.querySelectorAll('.media-type-input').forEach(radio => {
                radio.addEventListener('change', e => {
                    this.state.currentTemplate = e.target.value;
                    this.loadTemplateContent(e.target.value);
                });
            });
        }

        /* ================== URL HELPERS ================== */
        isYouTubeUrl(url = '') {
            return this.YT_REGEX.test(url);
        }
        getYouTubeId(url = '') {
            const m = url.match(this.YT_REGEX);
            return m ? m[1] : null;
        }

        normalizeUrl(url = '') {
            if (!url) return '';
            if (/^(data:|blob:)/i.test(url)) return url;

            if (url.startsWith('/')) {
                try {
                    return new URL(url, window.location.origin).toString();
                } catch {
                    return url;
                }
            }
            if (url.startsWith('//')) return 'https:' + url;
            if (!/^https?:\/\//i.test(url)) return 'https://' + url.replace(/^\/+/, '');
            return url;
        }

        maybeProxy(url) {
            if (!this.USE_PROXY) return url;
            try {
                return this.PROXY_URL + encodeURIComponent(url);
            } catch {
                return url;
            }
        }

        /* ================== DYNAMIC TEMPLATES ================== */
        loadTemplateContent(template) {
            const templates = {
                normal_image: this.getNormalImageTemplate(),
                video: this.getVideoTemplate(),
                podcast: this.getPodcastTemplate(),
                album: this.getAlbumTemplate(),
                no_image: this.getNoImageTemplate()
            };
            document.getElementById('mediaTypeContent').innerHTML = templates[template] || '';
        }

        createField(fieldName, label, icon, type = 'image') {
            const media = this.state.selectedMedia[fieldName];
            return `
      <div class="field-card">
        <label class="field-label">${label}</label>
        <div class="field-preview" id="${fieldName}_preview">
          ${media ? this.getMediaPreview(media, fieldName) : this.getEmptyState(fieldName, icon, type)}
        </div>
      </div>`;
        }

        /* ================== PREVIEWS (BIGGER + ACTIONS AT BOTTOM) ================== */
        getMediaPreview(media, fieldName) {
            const raw = media.url || '';
            const url = this.normalizeUrl(raw);
            const type = this.getFileType(url);

            const wrap = (visualHtml, title, typeLabel, isAudio = false) => `
      <div class="media-preview-selected">
        <div class="media-visual ${isAudio ? 'is-audio' : ''}">
          ${visualHtml}
        </div>
        <div class="media-info">
          <span class="media-title">${title || 'بدون عنوان'}</span>
          <span class="media-type">${typeLabel}</span>
        </div>
        <div class="media-actions">
          <button class="btn btn-sm btn-outline-secondary" onclick="mediaTabManager.changeMedia('${fieldName}')">تغيير</button>
          <button class="btn btn-sm btn-outline-danger" onclick="mediaTabManager.removeMedia('${fieldName}')">حذف</button>
        </div>
      </div>`;

            // YouTube
            if (type === 'youtube') {
                const vid = this.getYouTubeId(url);
                if (vid) {
                    const embed = `https://www.youtube.com/embed/${vid}?rel=0&modestbranding=1`;
                    const visual = `<iframe class="mmx-yt-embed" src="${embed}" title="${media.title || 'YouTube'}"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                          allowfullscreen loading="lazy" referrerpolicy="no-referrer"></iframe>`;
                    return wrap(visual, media.title || 'YouTube', 'يوتيوب');
                }
                const fallbackThumb = 'https://i.ytimg.com/vi/dQw4w9WgXcQ/hqdefault.jpg';
                const visual = `<img class="media-thumb" src="${fallbackThumb}" alt="${media.title || ''}"
                        loading="lazy" referrerpolicy="no-referrer" crossorigin="anonymous">`;
                return wrap(visual, media.title || 'YouTube', 'يوتيوب');
            }

            // Video file
            if (type === 'video') {
                const safe = this.maybeProxy(url);
                const visual = `<video src="${safe}" controls preload="metadata" crossorigin="anonymous"></video>`;
                return wrap(visual, media.title || 'ملف فيديو', 'فيديو');
            }

            // Audio
            if (type === 'audio') {
                const safe = this.maybeProxy(url);
                const visual =
                    `<audio src="${safe}" controls preload="metadata" crossorigin="anonymous" style="width:100%"></audio>`;
                return wrap(visual, media.title || 'ملف صوت', 'صوت', true);
            }

            // Image/Other
            const safeImg = this.maybeProxy(url);
            const visual = `<img class="media-thumb" src="${safeImg}" alt="${media.title || ''}" loading="lazy"
                      referrerpolicy="no-referrer" crossorigin="anonymous"
                      onerror="this.onerror=null; this.src='${this.placeholderThumb(url)}';">`;
            return wrap(visual, media.title || 'بدون عنوان', this.getFileTypeLabel(type));
        }

        getEmptyState(fieldName, icon, type) {
            return `
      <div class="field-empty" onclick="mediaTabManager.openMediaModal('${fieldName}')">
        <i class="${icon}"></i>
        <span>${type === 'file' ? 'اختر ملف' : 'اختر صورة'}</span>
      </div>`;
        }

        /* ================== PUBLIC API ================== */
        openMediaModal(fieldName) {
            this.state.currentField = fieldName;
            if (window.mmxMediaModalManager?.openModal) {
                window.mmxMediaModalManager.openModal(fieldName);
            } else {
                console.warn('MMX Media Modal غير متاح. تأكد من تضمين.');
            }
        }
        changeMedia(fieldName) {
            this.openMediaModal(fieldName);
        }
        removeMedia(fieldName) {
            delete this.state.selectedMedia[fieldName];
            this.updateFieldPreview(fieldName);
            this.updateSummary();
            this.updateHiddenFields();
        }
        onMediaSelected(media) {
            if (!this.state.currentField) return;
            this.state.selectedMedia[this.state.currentField] = media; // {id,url,title,alt}
            this.updateFieldPreview(this.state.currentField);
            this.updateSummary();
            this.updateHiddenFields();
        }

        updateFieldPreview(fieldName) {
            const el = document.getElementById(`${fieldName}_preview`);
            if (!el) return;
            const media = this.state.selectedMedia[fieldName];
            const icon = this.getFieldIcon(fieldName);
            const type = fieldName.includes('_file') ? 'file' : 'image';
            el.innerHTML = media ? this.getMediaPreview(media, fieldName) : this.getEmptyState(fieldName, icon,
                type);
        }

        getFieldIcon(fieldName) {
            if (fieldName.includes('video_file')) return 'fas fa-video';
            if (fieldName.includes('podcast_file')) return 'fas fa-podcast';
            if (fieldName.includes('mobile')) return 'fas fa-mobile-alt';
            return 'fas fa-image';
        }

        /* ================== SUMMARY ================== */
        updateSummary() {
            const summaryBody = document.getElementById('summary-table-body');
            const selectedCount = document.getElementById('selected-count');
            const items = Object.values(this.state.selectedMedia).filter(Boolean);
            selectedCount.textContent = items.length;

            if (!items.length) {
                summaryBody.innerHTML = `
        <div class="empty-summary">
          <i class="fas fa-images"></i>
          <p>لم يتم اختيار أي وسائط بعد</p>
        </div>`;
                return;
            }

            summaryBody.innerHTML = items.map(media => {
                const raw = media.url || '';
                const url = this.normalizeUrl(raw);
                const type = this.getFileType(url);

                // prefer small image in summary (YouTube -> thumbnail)
                let thumb = url;
                if (type === 'youtube') {
                    const vid = this.getYouTubeId(url);
                    if (vid) thumb = `https://i.ytimg.com/vi/${vid}/hqdefault.jpg`;
                }
                thumb = this.maybeProxy(thumb);

                return `
        <div class="summary-item">
          <img src="${thumb}" alt="${media.title || ''}" loading="lazy"
               referrerpolicy="no-referrer" crossorigin="anonymous"
               onerror="this.onerror=null; this.src='${this.placeholderThumb(url)}';">
          <div class="summary-info">
            <h6>${media.title || 'بدون عنوان'}</h6>
            <span>${this.getFileTypeLabel(type)}</span>
          </div>
          <button class="btn btn-sm btn-outline-danger" onclick="mediaTabManager.removeMediaFromSummary('${media.id}')">
            <i class="fas fa-times"></i>
          </button>
        </div>`;
            }).join('');
        }

        removeMediaFromSummary(mediaId) {
            const field = Object.keys(this.state.selectedMedia).find(k => this.state.selectedMedia[k]?.id ==
                mediaId);
            if (field) this.removeMedia(field);
        }

        updateHiddenFields() {
            const container = document.getElementById('media-hidden-fields');
            container.innerHTML = Object.entries(this.state.selectedMedia).map(([field, media]) => media ? `
      <input type="hidden" name="${field}_id" value="${media.id}">
      <input type="hidden" name="${field}" value="${media.url}">
      <input type="hidden" name="${field}_title" value="${media.title || ''}">
      <input type="hidden" name="${field}_alt" value="${media.alt || ''}">
    ` : '').join('');
        }

        /* ================== TYPE HELPERS ================== */
        getFileType(url) {
            if (!url) return 'file';
            const u = this.normalizeUrl(url);
            if (this.isYouTubeUrl(u)) return 'youtube';
            if (/\.(jpeg|jpg|gif|png|webp|bmp|svg)(\?|#|$)/i.test(u)) return 'image';
            if (/\.(mp4|avi|mov|wmv|webm|m4v)(\?|#|$)/i.test(u)) return 'video';
            if (/\.(mp3|wav|ogg|m4a|aac|flac)(\?|#|$)/i.test(u)) return 'audio';
            return 'file';
        }
        getFileTypeLabel(type) {
            switch (type) {
                case 'image':
                    return 'صورة';
                case 'video':
                    return 'فيديو';
                case 'audio':
                    return 'صوت';
                case 'youtube':
                    return 'يوتيوب';
                default:
                    return 'ملف';
            }
        }
        placeholderThumb(url = '') {
            return 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
                `<svg xmlns="http://www.w3.org/2000/svg" width="120" height="68">
        <rect width="100%" height="100%" fill="#f0f0f0"/>
        <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle"
              font-size="12" fill="#999">no preview</text>
       </svg>`
            );
        }

        /* ================== FIELD GROUPS ================== */
        getNormalImageTemplate() {
            return `<div class="template-fields">
      <h6 class="template-title">إعدادات الصورة</h6>
      <div class="fields-grid">
        ${this.createField('normal_main_image','الصورة الرئيسية','fas fa-image')}
        ${this.createField('normal_content_image','صورة المحتوى','fas fa-image')}
        ${this.createField('normal_mobile_image','صورة الموبايل','fas fa-mobile-alt')}
      </div>
    </div>`;
        }
        getVideoTemplate() {
            return `<div class="template-fields">
      <h6 class="template-title">إعدادات الفيديو</h6>
      <div class="fields-grid">
        ${this.createField('video_main_image','صورة الفيديو الرئيسية','fas fa-image')}
        ${this.createField('video_content_image','صورة محتوى الفيديو','fas fa-image')}
        ${this.createField('video_mobile_image','صورة الفيديو للموبايل','fas fa-mobile-alt')}
        ${this.createField('video_file','ملف الفيديو','fas fa-video','file')}
      </div>
    </div>`;
        }
        getPodcastTemplate() {
            return `<div class="template-fields">
      <h6 class="template-title">إعدادات البودكاست</h6>
      <div class="fields-grid">
        ${this.createField('podcast_main_image','صورة البودكاست الرئيسية','fas fa-image')}
        ${this.createField('podcast_content_image','صورة محتوى البودكاست','fas fa-image')}
        ${this.createField('podcast_mobile_image','صورة البودكاست للموبايل','fas fa-mobile-alt')}
        ${this.createField('podcast_file','ملف البودكاست','fas fa-podcast','file')}
      </div>
    </div>`;
        }
        getAlbumTemplate() {
            return `<div class="template-fields">
      <h6 class="template-title">إعدادات الألبوم</h6>
      <div class="fields-grid">
        ${this.createField('album_main_image','صورة الألبوم الرئيسية','fas fa-image')}
        ${this.createField('album_content_image','صورة محتوى الألبوم','fas fa-image')}
        ${this.createField('album_mobile_image','صورة الألبوم للموبايل','fas fa-mobile-alt')}
      </div>
    </div>`;
        }
        getNoImageTemplate() {
            return `<div class="template-fields">
      <h6 class="template-title">إعدادات المقال</h6>
      <div class="fields-grid">
        ${this.createField('no_image_main_image','الصورة الرئيسية','fas fa-image')}
        ${this.createField('no_image_mobile_image','صورة المقال للموبايل','fas fa-mobile-alt')}
      </div>
    </div>`;
        }
    }
    window.mediaTabManager = new MediaTabManager();
</script>

<!-- ======================= STYLES ======================= -->
<style>
    .media-manager {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Media Type Selector */
    .media-type-selector .media-type-card {
        position: relative;
        margin: 0 5px 5px 0;
    }

    .media-type-input {
        position: absolute;
        opacity: 0;
    }

    .media-type-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem 1.5rem;
        border: 2px solid #e9ecef;
        cursor: pointer;
        transition: all .3s ease;
        background: #fff;
        min-width: 110px;
    }

    .media-type-label i {
        font-size: 1.5rem;
        margin-bottom: .5rem;
        color: #6c757d;
    }

    .media-type-label span {
        font-weight: 500;
        color: #495057;
    }

    .media-type-input:checked+.media-type-label {
        border-color: #007bff;
        background: #f8f9ff;
    }

    .media-type-input:checked+.media-type-label i,
    .media-type-input:checked+.media-type-label span {
        color: #007bff;
    }

    /* Template Fields */
    .template-fields {
        background: #fff;
        padding: 1.5rem;
        border: 1px solid #e9ecef;
    }

    .template-title {
        color: #495057;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .fields-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
        gap: 10px;
    }

    .field-card {
        background: #f8f9fa;
        padding: 1rem;
    }

    .field-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: .5rem;
        display: block;
    }

    /* Empty state (click to choose) */
    .field-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        border: 2px solid #dee2e6;
        cursor: pointer;
        transition: all .3s ease;
        background: #fff;
        min-height: 240px;
    }

    .field-empty:hover {
        border-color: #007bff;
        background: #f8f9ff;
    }

    .field-empty i {
        font-size: 2rem;
        color: #6c757d;
        margin-bottom: .5rem;
    }

    /* ====== BIGGER PREVIEW + BOTTOM ACTION BAR ====== */
    .media-preview-selected {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 12px;
        background: #fff;
        border: 1px solid #e9ecef;
    }

    /* 16:9 visual area by default */
    .media-visual {
        width: 100%;
        aspect-ratio: 16 / 9;
        background: #000;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Audio doesn't need tall box */
    .media-visual.is-audio {
        aspect-ratio: auto;
        background: #f8f9fa;
        padding: 8px;
    }

    /* Fill container */
    .media-visual>img,
    .media-visual>video,
    .media-visual>iframe {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 0;
        display: block;
    }

    /* Image thumb helper */
    .media-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* YouTube embed respects container */
    .mmx-yt-embed {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    /* Info row */
    .media-info {
        display: flex;
        align-items: baseline;
        gap: 8px;
        margin: 0 2px;
    }

    .media-title {
        font-weight: 600;
    }

    .media-type {
        font-size: .875rem;
        color: #6c757d;
    }

    /* Bottom actions bar */
    .media-actions {
        margin-top: 4px;
        padding-top: 8px;
        border-top: 1px solid #e9ecef;
        display: flex;
        justify-content: flex-end;
        gap: 6px;
        width: 100%;
    }

    /* Summary Panel */
    .media-summary-panel .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
    }

    .media-summary-grid {
        display: flex;
        flex-direction: column;
    }

    .summary-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: #f8f9fa;
        margin-bottom: 6px;
    }

    .summary-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin: 0 10px 0 0;
    }

    .summary-info {
        flex: 1;
        margin: 0 10px;
    }

    .summary-info h6 {
        margin: 0;
        font-size: .9rem;
    }

    .empty-summary {
        text-align: center;
        padding: 2rem;
        color: #6c757d;
    }

    .empty-summary i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: .5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .fields-grid {
            grid-template-columns: 1fr;
        }

        .media-type-selector .d-flex {
            flex-direction: column;
        }

        .media-type-label {
            min-width: auto;
        }

        .media-type-card,
        .field-card {
            margin: 0 0 5px 0;
        }

        .field-empty {
            min-height: 200px;
        }
    }
</style>
