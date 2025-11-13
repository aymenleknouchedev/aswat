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
                    <span data-ar="صورة" data-en="Image">صورة</span>
                </label>
            </div>
            <div class="media-type-card">
                <input type="radio" name="template" id="video-radio" value="video" class="media-type-input">
                <label for="video-radio" class="media-type-label">
                    <i class="fas fa-video"></i>
                    <span data-ar="فيديو" data-en="Video">فيديو</span>
                </label>
            </div>
            <div class="media-type-card">
                <input type="radio" name="template" id="podcast-radio" value="podcast" class="media-type-input">
                <label for="podcast-radio" class="media-type-label">
                    <i class="fas fa-podcast"></i>
                    <span data-ar="بودكاست" data-en="Podcast">بودكاست</span>
                </label>
            </div>
            <div class="media-type-card">
                <input type="radio" name="template" id="album-radio" value="album" class="media-type-input">
                <label for="album-radio" class="media-type-label">
                    <i class="fas fa-images"></i>
                    <span data-ar="ألبوم" data-en="Album">ألبوم</span>
                </label>
            </div>
            <div class="media-type-card">
                <input type="radio" name="template" id="article-radio" value="no_image" class="media-type-input">
                <label for="article-radio" class="media-type-label">
                    <i class="fas fa-file-alt"></i>
                    <span data-ar="مقال" data-en="Article">مقال</span>
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
                <h5 class="mb-0" data-ar="ملخص الوسائط المختارة" data-en="Selected Media Summary">ملخص الوسائط
                    المختارة</h5>
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
                selectedMedia: {},
                currentLanguage: 'ar' // Default language
            };

            // إعدادات اختيارية للوكيل (للتخطّي عبر نفس الأصل)
            this.USE_PROXY = false;
            this.PROXY_URL = '/media/proxy?url=';

            // YouTube helpers
            this.YT_REGEX = /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/i;

            // Complete validation rules for each media type - ALL fields are required
            this.validationRules = {
                normal_image: ['normal_main_image', 'normal_content_image', 'normal_mobile_image'],
                video: ['video_main_image', 'video_content_image', 'video_mobile_image', 'video_file'],
                podcast: ['podcast_main_image', 'podcast_content_image', 'podcast_mobile_image',
                    'podcast_file'
                ],
                album: ['album_main_image', 'album_content_image', 'album_mobile_image', 'album_assets'],
                no_image: ['no_image_main_image', 'no_image_mobile_image']
            };

            // Field labels for validation messages
            this.fieldLabels = {
                normal_main_image: {
                    ar: 'الصورة الرئيسية',
                    en: 'Main Image'
                },
                normal_content_image: {
                    ar: 'صورة المحتوى',
                    en: 'Content Image'
                },
                normal_mobile_image: {
                    ar: 'صورة الموبايل',
                    en: 'Mobile Image'
                },
                video_main_image: {
                    ar: 'صورة الفيديو الرئيسية',
                    en: 'Video Main Image'
                },
                video_content_image: {
                    ar: 'صورة محتوى الفيديو',
                    en: 'Video Content Image'
                },
                video_mobile_image: {
                    ar: 'صورة الفيديو للموبايل',
                    en: 'Video Mobile Image'
                },
                video_file: {
                    ar: 'ملف الفيديو',
                    en: 'Video File'
                },
                podcast_main_image: {
                    ar: 'صورة البودكاست الرئيسية',
                    en: 'Podcast Main Image'
                },
                podcast_content_image: {
                    ar: 'صورة محتوى البودكاست',
                    en: 'Podcast Content Image'
                },
                podcast_mobile_image: {
                    ar: 'صورة البودكاست للموبايل',
                    en: 'Podcast Mobile Image'
                },
                podcast_file: {
                    ar: 'ملف البودكاست',
                    en: 'Podcast File'
                },
                album_main_image: {
                    ar: 'صورة الألبوم الرئيسية',
                    en: 'Album Main Image'
                },
                album_content_image: {
                    ar: 'صورة محتوى الألبوم',
                    en: 'Album Content Image'
                },
                album_mobile_image: {
                    ar: 'صورة الألبوم للموبايل',
                    en: 'Album Mobile Image'
                },
                album_assets: {
                    ar: 'أصول الألبوم',
                    en: 'Album Assets'
                },
                no_image_main_image: {
                    ar: 'الصورة الرئيسية',
                    en: 'Main Image'
                },
                no_image_mobile_image: {
                    ar: 'صورة المقال للموبايل',
                    en: 'Article Mobile Image'
                }
            };

            // Template display names
            this.templateNames = {
                normal_image: {
                    ar: 'الصورة',
                    en: 'Image'
                },
                video: {
                    ar: 'الفيديو',
                    en: 'Video'
                },
                podcast: {
                    ar: 'البودكاست',
                    en: 'Podcast'
                },
                album: {
                    ar: 'الألبوم',
                    en: 'Album'
                },
                no_image: {
                    ar: 'المقال',
                    en: 'Article'
                }
            };

            this.init();
        }

        /* ================== INIT & EVENTS ================== */
        init() {
            this.bindEvents();
            this.restoreState();
            this.loadTemplateContent('normal_image');
            this.updateSummary();

            // جسر التكامل مع MMX Media Modal
            if (window.mmxMediaModalManager) {
                const originalHandler = window.mmxMediaModalManager.onMediaSelected;
                window.mmxMediaModalManager.onMediaSelected = (payload) => {
                    if (Array.isArray(payload)) payload.forEach(item => this.onMediaSelected(item));
                    else this.onMediaSelected(payload);
                    if (typeof originalHandler === 'function') originalHandler(payload);
                };
            }

            // Add form validation
            this.setupFormValidation();

            // Initialize language
            this.detectLanguage();
        }

        detectLanguage() {
            // You can implement language detection logic here
            // For now, we'll use Arabic as default
            this.state.currentLanguage = 'ar';
        }

        setLanguage(lang) {
            this.state.currentLanguage = lang;
            this.updateUITexts();
        }

        updateUITexts() {
            // Update all dynamic texts based on current language
            document.querySelectorAll('[data-ar][data-en]').forEach(element => {
                element.textContent = element.getAttribute(`data-${this.state.currentLanguage}`);
            });

            // Update template content
            this.loadTemplateContent(this.state.currentTemplate);

            // Update summary
            this.updateSummary();
        }

        getText(key) {
            return this[key]?.[this.state.currentLanguage] || key;
        }

        bindEvents() {
            document.querySelectorAll('.media-type-input').forEach(radio => {
                radio.addEventListener('change', e => {
                    this.state.currentTemplate = e.target.value;
                    this.loadTemplateContent(e.target.value);
                    this.clearValidation();
                    this.highlightRequiredFields();
                });
            });
        }

        /* ================== VALIDATION ================== */
        setupFormValidation() {
            // Find the parent form and intercept its submission
            const form = this.findParentForm();
            if (form) {
                form.addEventListener('submit', (e) => {
                    if (!this.validateMediaSelection()) {
                        e.preventDefault();
                        this.showValidationError();
                    }
                });
            }
        }

        findParentForm() {
            let element = this.getContainer();
            while (element && element.tagName !== 'FORM') {
                element = element.parentElement;
            }
            return element;
        }

        getContainer() {
            return document.querySelector('.media-manager');
        }

        validateMediaSelection() {
            const template = this.state.currentTemplate;
            const requiredFields = this.validationRules[template] || [];
            const missingFields = [];

            for (const field of requiredFields) {
                if (field.endsWith('_assets')) {
                    // For asset collections, check if array exists and has items
                    if (!Array.isArray(this.state.selectedMedia[field]) ||
                        this.state.selectedMedia[field].length === 0) {
                        missingFields.push(field);
                    }
                } else {
                    // For single media fields
                    if (!this.state.selectedMedia[field]) {
                        missingFields.push(field);
                    }
                }
            }

            this.missingFields = missingFields; // Store for detailed error message
            return missingFields.length === 0;
        }

        showValidationError() {
            const alert = document.getElementById('media-validation-alert');
            const message = document.getElementById('validation-message');

            if (alert && message) {
                const templateName = this.getTemplateDisplayName(this.state.currentTemplate);
                const missingFieldNames = this.missingFields.map(field =>
                    this.fieldLabels[field][this.state.currentLanguage]
                ).join('، ');

                const errorMessages = {
                    ar: `يجب تعبئة جميع الوسائط المطلوبة لنوع ${templateName}. الحقول المطلوبة: ${missingFieldNames}`,
                    en: `All required media must be filled for ${templateName} type. Required fields: ${missingFieldNames}`
                };

                message.textContent = errorMessages[this.state.currentLanguage];
                alert.classList.remove('d-none');

                // Highlight missing fields
                this.highlightMissingFields();

                // Scroll to alert
                alert.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        highlightMissingFields() {
            // Remove previous highlights
            this.clearFieldHighlights();

            // Highlight missing fields
            this.missingFields.forEach(field => {
                const previewElement = document.getElementById(`${field}_preview`);
                if (previewElement) {
                    previewElement.classList.add('field-missing');
                }

                // For asset fields, highlight the container
                if (field.endsWith('_assets')) {
                    const assetContainer = document.querySelector(`[data-field="${field}"]`);
                    if (assetContainer) {
                        assetContainer.classList.add('field-missing');
                    }
                }
            });
        }

        highlightRequiredFields() {
            // Remove previous highlights
            this.clearFieldHighlights();

            // Highlight all required fields for current template
            const requiredFields = this.validationRules[this.state.currentTemplate] || [];
            requiredFields.forEach(field => {
                const previewElement = document.getElementById(`${field}_preview`);
                if (previewElement) {
                    previewElement.classList.add('field-required');
                }

                // For asset fields, highlight the container
                if (field.endsWith('_assets')) {
                    const assetContainer = document.querySelector(`[data-field="${field}"]`);
                    if (assetContainer) {
                        assetContainer.classList.add('field-required');
                    }
                }
            });
        }

        clearFieldHighlights() {
            // Remove all field highlighting
            document.querySelectorAll('.field-missing, .field-required').forEach(el => {
                el.classList.remove('field-missing', 'field-required');
            });
        }

        clearValidation() {
            const alert = document.getElementById('media-validation-alert');
            if (alert) {
                alert.classList.add('d-none');
            }
            this.clearFieldHighlights();
        }

        getTemplateDisplayName(template) {
            return this.templateNames[template]?.[this.state.currentLanguage] || template;
        }

        /* ================== STATE PERSISTENCE ================== */
        saveState() {
            // State persistence to localStorage is disabled
        }

        restoreState() {
            try {
                // Highlight required fields for initial template
                setTimeout(() => this.highlightRequiredFields(), 100);
            } catch (e) {
                console.warn('Failed to initialize media manager state:', e);
                // Highlight required fields even if initialization fails
                setTimeout(() => this.highlightRequiredFields(), 100);
            }
        }

        clearState() {
            // State cleanup is disabled (no localStorage to clean)
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
            return this.USE_PROXY ? this.PROXY_URL + encodeURIComponent(url) : url;
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

            // Highlight required fields after template load
            setTimeout(() => this.highlightRequiredFields(), 50);
        }

        createField(fieldName, labelAr, labelEn, icon, type = 'image') {
            const label = this.state.currentLanguage === 'ar' ? labelAr : labelEn;
            const media = this.state.selectedMedia[fieldName];
            return `
      <div class="field-card field-card--full">
        <label class="field-label" data-ar="${labelAr}" data-en="${labelEn}">${label}</label>
      </div>
      <div class="field-card">
        <div class="field-preview" id="${fieldName}_preview">
          ${media ? this.getMediaPreview(media, fieldName) : this.getEmptyState(fieldName, icon, type)}
        </div>
      </div>`;
        }

        createCaptionField() {
            const captionText = this.state.currentLanguage === 'ar' ? 'التعليق' : 'Caption';
            const placeholderText = this.state.currentLanguage === 'ar' ? 'أدخل تعليق للصورة الرئيسية' :
                'Enter caption for main image';

            return `
      <div class="field-card field-card--full">
        <label class="field-label" for="caption" data-ar="التعليق" data-en="Caption">${captionText}</label>
        <input type="text" 
               class="form-control caption-input" 
               id="caption" 
               name="caption" 
               placeholder="${placeholderText}"
               value="${this.state.selectedMedia.caption || ''}"
               oninput="mediaTabManager.updateCaption(this.value)">
      </div>`;
        }

        updateCaption(value) {
            this.state.selectedMedia.caption = value;
            this.updateHiddenFields();
            this.saveState();
        }

        /* ============== COLLECTION FIELD ( *_assets ) ============== */
        createAssetsField(fieldName, labelAr, labelEn) {
            const label = this.state.currentLanguage === 'ar' ? labelAr : labelEn;

            // حالة واجهة مخصصة
            this.state._assetsUi = this.state._assetsUi || {};
            this.state._assetsUi[fieldName] = Object.assign({
                page: 1,
                pageSize: 24,
                view: 'grid',
                size: 180,
                query: '',
                selected: new Set()
            }, this.state._assetsUi[fieldName] || {});

            const ui = this.state._assetsUi[fieldName];
            const items = Array.isArray(this.state.selectedMedia[fieldName]) ? this.state.selectedMedia[fieldName] :
                [];

            return `
      <div class="field-card field-card--full" data-field="${fieldName}">
        <div class="field-label assets-label-row">
          <span data-ar="${labelAr}" data-en="${labelEn}">${label}</span>
          <div class="assets-toolbar" data-assets-toolbar="${fieldName}">
            <div class="assets-toolbar-group">
              <label class="assets-size-label" data-ar="حجم" data-en="Size">${this.state.currentLanguage === 'ar' ? 'حجم' : 'Size'}</label>
              <input type="range" min="120" max="260" step="10" value="${ui.size}"
                     oninput="mediaTabManager.onAssetsSize('${fieldName}', this.value)">
              <button type="button" class="btn btn-sm"
                      onclick="mediaTabManager.toggleAssetsView('${fieldName}')" data-ar="تبديل العرض" data-en="Toggle View">${this.state.currentLanguage === 'ar' ? 'تبديل العرض' : 'Toggle View'}</button>
              <button type="button" class="btn btn-sm btn-outline-primary"
                      onclick="mediaTabManager.openAssetsPicker('${fieldName}')" data-ar="إضافة عناصر" data-en="Add Items">${this.state.currentLanguage === 'ar' ? 'إضافة عناصر' : 'Add Items'}</button>
              <button type="button" class="btn btn-sm"
                      onclick="mediaTabManager.selectAllAssets('${fieldName}')" data-ar="تحديد الكل" data-en="Select All">${this.state.currentLanguage === 'ar' ? 'تحديد الكل' : 'Select All'}</button>
              <button type="button" class="btn btn-sm"
                      onclick="mediaTabManager.clearSelection('${fieldName}')" data-ar="إلغاء التحديد" data-en="Clear Selection">${this.state.currentLanguage === 'ar' ? 'إلغاء التحديد' : 'Clear Selection'}</button>
              <button type="button" class="btn btn-sm btn-outline-danger"
                      onclick="mediaTabManager.deleteSelectedAssets('${fieldName}')" data-ar="حذف المحدد" data-en="Delete Selected">${this.state.currentLanguage === 'ar' ? 'حذف المحدد' : 'Delete Selected'}</button>
              <button type="button" class="btn btn-sm btn-outline-danger"
                      onclick="mediaTabManager.clearAllAssets('${fieldName}')" data-ar="تفريغ الألبوم" data-en="Clear All">${this.state.currentLanguage === 'ar' ? 'تفريغ الألبوم' : 'Clear All'}</button>
            </div>
          </div>
        </div>

        <div class="assets-wrapper ${ui.view === 'list' ? 'is-list' : 'is-grid'}" style="--asset-size:${ui.size}px">
          <div class="assets-grid" id="${fieldName}_grid"
               ondragover="mediaTabManager.onAssetDragOver(event)"
               ondrop="mediaTabManager.onAssetDrop(event, '${fieldName}')">
            ${this.renderAssetsGrid(fieldName)}
          </div>
          ${this.renderAssetsPagination(fieldName, items.length)}
        </div>
      </div>`;
        }

        getAssetsEmptyState(fieldName) {
            const text = this.state.currentLanguage === 'ar' ? 'انقر للإضافة' : 'Click to add';
            return `
      <div class="assets-empty" onclick="mediaTabManager.openAssetsPicker('${fieldName}')">
        <span data-ar="انقر للإضافة" data-en="Click to add">${text}</span>
      </div>`;
        }

        // بطاقة عنصر قابلة للتحديد والسحب
        getAssetCardSelectable(media, fieldName, index) {
            const url = this.normalizeUrl(media.url || '');
            const type = this.getFileType(url);
            const thumb = this.maybeProxy(
                type === 'youtube' && this.getYouTubeId(url) ?
                `https://i.ytimg.com/vi/${this.getYouTubeId(url)}/hqdefault.jpg` :
                url
            );
            const ui = this.state._assetsUi[fieldName];
            const selected = ui.selected.has(this._assetKey(media)) ? ' is-selected' : '';
            const title = media.title || (this.state.currentLanguage === 'ar' ? 'بدون عنوان' : 'No title');
            const audioText = this.state.currentLanguage === 'ar' ? 'صوت' : 'Audio';
            const noTitleText = this.state.currentLanguage === 'ar' ? 'بدون عنوان' : 'No title';
            const deleteText = this.state.currentLanguage === 'ar' ? 'حذف' : 'Delete';

            return `
      <div class="asset-item${selected}" data-index="${index}" draggable="true"
           ondragstart="mediaTabManager.onAssetDragStart(event, '${fieldName}', ${index})">
        <label class="asset-check">
          <input type="checkbox" ${selected ? 'checked' : ''}
                 onchange="mediaTabManager.onAssetToggle('${fieldName}', ${index}, this.checked)">
          <span></span>
        </label>
        <div class="asset-thumb">
          ${type === 'audio'
            ? `<div class="asset-audio" title="${media.title || ''}">${media.title || audioText}</div>`
            : `<img src="${thumb}" alt="${media.title || ''}" loading="lazy"
                     onerror="this.onerror=null; this.src='${this.placeholderThumb(url)}';">`}
        </div>
        <div class="asset-meta">
          <div class="asset-title" title="${media.title || ''}">${media.title || noTitleText}</div>
          <div class="asset-type">${this.getFileTypeLabel(type)}</div>
        </div>
        <div class="asset-actions">
          <button type="button" class="btn btn-sm btn-outline-danger"
                  onclick="mediaTabManager.removeAsset('${fieldName}', ${index})" data-ar="حذف" data-en="Delete">${deleteText}</button>
        </div>
      </div>`;
        }

        getAssetCard(media, fieldName, index) {
            return this.getAssetCardSelectable(media, fieldName, index);
        }

        openAssetsPicker(fieldName) {
            this.state.currentField = fieldName; // ينتهي بـ _assets
            if (!Array.isArray(this.state.selectedMedia[fieldName])) {
                this.state.selectedMedia[fieldName] = [];
            }
            if (window.mmxMediaModalManager?.openModal) {
                window.mmxMediaModalManager.openModal(fieldName, {
                    multiple: true
                });
            } else {
                console.warn('MMX Media Modal غير متاح.');
            }
        }

        removeAsset(fieldName, index) {
            const list = this.state.selectedMedia[fieldName];
            if (!Array.isArray(list)) return;
            list.splice(index, 1);
            this.updateAssetsGrid(fieldName);
            this.updateSummary();
            this.updateHiddenFields();
            this.saveState(); // Save state after removal
            this.clearValidation(); // Re-check validation
        }

        updateAssetsGrid(fieldName) {
            const wrap = document.getElementById(`${fieldName}_grid`);
            if (!wrap) return;
            const ui = this.state._assetsUi[fieldName];
            const container = wrap.closest('.assets-wrapper');
            if (container) {
                container.style.setProperty('--asset-size', `${ui.size}px`);
                container.classList.toggle('is-list', ui.view === 'list');
            }
            wrap.innerHTML = this.renderAssetsGrid(fieldName);
            // تحديث الترقيم
            const pagHtml = this.renderAssetsPagination(fieldName);
            const pagEl = container.querySelector('.assets-pagination');
            if (pagEl) pagEl.outerHTML = pagHtml;
            else container.insertAdjacentHTML('beforeend', pagHtml);
        }

        renderAssetsGrid(fieldName) {
            const items = Array.isArray(this.state.selectedMedia[fieldName]) ? this.state.selectedMedia[fieldName] :
                [];
            const ui = this.state._assetsUi[fieldName];
            const q = ui.query.trim().toLowerCase();
            const filtered = q ?
                items.filter(m => (m.title || '').toLowerCase().includes(q) || (m.alt || '').toLowerCase().includes(
                    q) || (m.url || '').toLowerCase().includes(q)) :
                items;
            const start = (ui.page - 1) * ui.pageSize;
            const pageItems = filtered.slice(start, start + ui.pageSize);
            if (!pageItems.length) return this.getAssetsEmptyState(fieldName);
            return pageItems.map((m, i) => this.getAssetCardSelectable(m, fieldName, start + i)).join('');
        }

        renderAssetsPagination(fieldName) {
            const ui = this.state._assetsUi[fieldName];
            const items = Array.isArray(this.state.selectedMedia[fieldName]) ? this.state.selectedMedia[fieldName] :
                [];
            const q = ui.query.trim().toLowerCase();
            const total = q ?
                items.filter(m => (m.title || '').toLowerCase().includes(q) || (m.alt || '').toLowerCase().includes(
                    q) || (m.url || '').toLowerCase().includes(q)).length :
                items.length;
            const pages = Math.max(1, Math.ceil(total / ui.pageSize));
            const page = Math.min(ui.page, pages);

            const itemsText = this.state.currentLanguage === 'ar' ? 'العناصر' : 'Items';
            const pageText = this.state.currentLanguage === 'ar' ? 'الصفحة' : 'Page';
            const ofText = this.state.currentLanguage === 'ar' ? 'من' : 'of';
            const perPageText = this.state.currentLanguage === 'ar' ? 'لكل صفحة' : 'Per page';
            const prevText = this.state.currentLanguage === 'ar' ? 'السابق' : 'Previous';
            const nextText = this.state.currentLanguage === 'ar' ? 'التالي' : 'Next';

            return `
      <div class="assets-pagination">
        <div class="assets-page-info" data-ar="${itemsText}: ${total} | ${pageText} ${page} ${ofText} ${pages}" data-en="${itemsText}: ${total} | ${pageText} ${page} ${ofText} ${pages}">${itemsText}: ${total} | ${pageText} ${page} ${ofText} ${pages}</div>
        <div class="assets-page-actions">
          <label data-ar="${perPageText}" data-en="${perPageText}">${perPageText}</label>
          <select onchange="mediaTabManager.onAssetsPageSize('${fieldName}', this.value)">
            ${[12,24,36,60,96].map(n => `<option value="${n}" ${n==ui.pageSize?'selected':''}>${n}</option>`).join('')}
          </select>
          <button type="button" class="btn btn-sm" ${page<=1?'disabled':''}
                  onclick="mediaTabManager.gotoAssetsPage('${fieldName}', ${page-1})" data-ar="${prevText}" data-en="${prevText}">${prevText}</button>
          <button type="button" class="btn btn-sm" ${page>=pages?'disabled':''}
                  onclick="mediaTabManager.gotoAssetsPage('${fieldName}', ${page+1})" data-ar="${nextText}" data-en="${nextText}">${nextText}</button>
        </div>
      </div>`;
        }

        onAssetsSearch(fieldName, value) {
            const ui = this.state._assetsUi[fieldName];
            ui.query = value;
            ui.page = 1;
            this.updateAssetsGrid(fieldName);
        }
        onAssetsSize(fieldName, value) {
            const ui = this.state._assetsUi[fieldName];
            ui.size = Number(value);
            this.updateAssetsGrid(fieldName);
        }
        toggleAssetsView(fieldName) {
            const ui = this.state._assetsUi[fieldName];
            ui.view = ui.view === 'grid' ? 'list' : 'grid';
            this.updateAssetsGrid(fieldName);
        }
        onAssetsPageSize(fieldName, val) {
            const ui = this.state._assetsUi[fieldName];
            ui.pageSize = Number(val);
            ui.page = 1;
            this.updateAssetsGrid(fieldName);
        }
        gotoAssetsPage(fieldName, page) {
            const ui = this.state._assetsUi[fieldName];
            ui.page = Math.max(1, Number(page));
            this.updateAssetsGrid(fieldName);
        }

        _assetKey(m) {
            return (m.id != null && String(m.id)) || (m.url || '') + '|' + (m.title || '');
        }
        onAssetToggle(fieldName, index, checked) {
            const list = this.state.selectedMedia[fieldName];
            if (!Array.isArray(list)) return;
            const key = this._assetKey(list[index]);
            const ui = this.state._assetsUi[fieldName];
            if (checked) ui.selected.add(key);
            else ui.selected.delete(key);
            this.updateAssetsGrid(fieldName);
        }

        selectAllAssets(fieldName) {
            const ui = this.state._assetsUi[fieldName];
            const items = Array.isArray(this.state.selectedMedia[fieldName]) ? this.state.selectedMedia[fieldName] :
                [];
            const q = ui.query.trim().toLowerCase();
            const filtered = q ?
                items.filter(m => (m.title || '').toLowerCase().includes(q) || (m.alt || '').toLowerCase().includes(
                    q) || (m.url || '').toLowerCase().includes(q)) :
                items;
            const start = (ui.page - 1) * ui.pageSize;
            const pageItems = filtered.slice(start, start + ui.pageSize);
            pageItems.forEach(m => ui.selected.add(this._assetKey(m)));
            this.updateAssetsGrid(fieldName);
        }

        clearSelection(fieldName) {
            const ui = this.state._assetsUi[fieldName];
            ui.selected.clear();
            this.updateAssetsGrid(fieldName);
        }

        deleteSelectedAssets(fieldName) {
            const ui = this.state._assetsUi[fieldName];
            if (!ui.selected.size) return;
            const list = Array.isArray(this.state.selectedMedia[fieldName]) ? this.state.selectedMedia[fieldName] :
                [];
            this.state.selectedMedia[fieldName] = list.filter(m => !ui.selected.has(this._assetKey(m)));
            ui.selected.clear();
            const total = this.state.selectedMedia[fieldName].length;
            const maxPage = Math.max(1, Math.ceil(total / ui.pageSize));
            ui.page = Math.min(ui.page, maxPage);
            this.updateAssetsGrid(fieldName);
            this.updateSummary();
            this.updateHiddenFields();
            this.saveState(); // Save state after deletion
            this.clearValidation(); // Re-check validation
        }

        clearAllAssets(fieldName) {
            this.state.selectedMedia[fieldName] = [];
            this.state._assetsUi[fieldName].selected.clear();
            this.state._assetsUi[fieldName].page = 1;
            this.updateAssetsGrid(fieldName);
            this.updateSummary();
            this.updateHiddenFields();
            this.saveState(); // Save state after clearing
            this.clearValidation(); // Re-check validation
        }

        onAssetDragStart(ev, fieldName, index) {
            ev.dataTransfer.setData('text/plain', JSON.stringify({
                fieldName,
                index
            }));
            ev.dataTransfer.dropEffect = 'move';
        }
        onAssetDragOver(ev) {
            ev.preventDefault();
        }
        onAssetDrop(ev, fieldName) {
            ev.preventDefault();
            const data = ev.dataTransfer.getData('text/plain');
            try {
                const {
                    fieldName: srcField,
                    index
                } = JSON.parse(data);
                if (srcField !== fieldName) return;
                const target = ev.target.closest('.asset-item');
                if (!target) return;
                const toIndex = Number(target.getAttribute('data-index'));
                this.moveAsset(fieldName, Number(index), toIndex);
            } catch {}
        }

        moveAsset(fieldName, from, to) {
            const list = this.state.selectedMedia[fieldName];
            if (!Array.isArray(list)) return;
            if (from === to || from < 0 || to < 0 || from >= list.length || to >= list.length) return;
            const [item] = list.splice(from, 1);
            list.splice(to, 0, item);
            this.updateAssetsGrid(fieldName);
            this.updateSummary();
            this.updateHiddenFields();
            this.saveState(); // Save state after reordering
        }

        /* ================== PREVIEWS (عنصر واحد) ================== */
        getMediaPreview(media, fieldName) {
            if (fieldName.endsWith('_assets')) {
                return `<div class="assets-grid">${ (Array.isArray(media) ? media : []).map((m, i) => this.getAssetCard(m, fieldName, i)).join('') }</div>`;
            }
            const raw = media.url || '';
            const url = this.normalizeUrl(raw);
            const type = this.getFileType(url);

            const changeText = this.state.currentLanguage === 'ar' ? 'تغيير' : 'Change';
            const deleteText = this.state.currentLanguage === 'ar' ? 'حذف' : 'Delete';
            const noTitleText = this.state.currentLanguage === 'ar' ? 'بدون عنوان' : 'No title';
            const youtubeText = this.state.currentLanguage === 'ar' ? 'يوتيوب' : 'YouTube';
            const videoFileText = this.state.currentLanguage === 'ar' ? 'ملف فيديو' : 'Video file';
            const audioFileText = this.state.currentLanguage === 'ar' ? 'ملف صوت' : 'Audio file';

            const wrap = (visualHtml, title, typeLabel, isAudio = false) => `
      <div class="media-preview-selected">
        <div class="media-visual ${isAudio ? 'is-audio' : ''}">${visualHtml}</div>
        <div class="media-info">
          <span class="media-title">${title || noTitleText}</span>
          <span class="media-type">${typeLabel}</span>
        </div>
        <div class="media-actions">
          <button type="button" class="btn btn-sm btn-outline-secondary" onclick="mediaTabManager.changeMedia('${fieldName}')" data-ar="تغيير" data-en="Change">${changeText}</button>
          <button type="button" class="btn btn-sm btn-outline-danger" onclick="mediaTabManager.removeMedia('${fieldName}')" data-ar="حذف" data-en="Delete">${deleteText}</button>
        </div>
      </div>`;

            if (type === 'youtube') {
                const vid = this.getYouTubeId(url);
                if (vid) {
                    const embed = `https://www.youtube.com/embed/${vid}?rel=0&modestbranding=1`;
                    const visual =
                        `<iframe class="mmx-yt-embed" src="${embed}" title="${media.title || youtubeText}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy" referrerpolicy="no-referrer"></iframe>`;
                    return wrap(visual, media.title || youtubeText, youtubeText);
                }
                const fallbackThumb = 'https://i.ytimg.com/vi/dQw4w9WgXcQ/hqdefault.jpg';
                const visual =
                    `<img class="media-thumb" src="${fallbackThumb}" alt="${media.title || ''}" loading="lazy" referrerpolicy="no-referrer" crossorigin="anonymous">`;
                return wrap(visual, media.title || youtubeText, youtubeText);
            }

            if (type === 'video') {
                const safe = this.maybeProxy(url);
                const visual = `<video src="${safe}" controls preload="metadata" crossorigin="anonymous"></video>`;
                return wrap(visual, media.title || videoFileText, this.getFileTypeLabel(type));
            }

            if (type === 'audio') {
                const safe = this.maybeProxy(url);
                const visual =
                    `<audio src="${safe}" controls preload="metadata" crossorigin="anonymous" style="width:100%"></audio>`;
                return wrap(visual, media.title || audioFileText, this.getFileTypeLabel(type), true);
            }

            const safeImg = this.maybeProxy(url);
            const visual =
                `<img class="media-thumb" src="${safeImg}" alt="${media.title || ''}" loading="lazy" referrerpolicy="no-referrer" crossorigin="anonymous" onerror="this.onerror=null; this.src='${this.placeholderThumb(url)}';">`;
            return wrap(visual, media.title || noTitleText, this.getFileTypeLabel(type));
        }

        getEmptyState(fieldName, icon, type) {
            if (fieldName.endsWith('_assets')) return this.getAssetsEmptyState(fieldName);

            const chooseImageText = this.state.currentLanguage === 'ar' ? 'اختر صورة' : 'Choose Image';
            const chooseFileText = this.state.currentLanguage === 'ar' ? 'اختر ملف' : 'Choose File';
            const text = type === 'file' ? chooseFileText : chooseImageText;

            return `
      <div class="field-empty" onclick="mediaTabManager.openMediaModal('${fieldName}')">
        <i class="${icon}"></i>
        <span data-ar="${text}" data-en="${text}">${text}</span>
      </div>`;
        }

        /* ================== PUBLIC API (للتكامل مع المودال) ================== */
        openMediaModal(fieldName) {
            this.state.currentField = fieldName;
            if (window.mmxMediaModalManager?.openModal) {
                window.mmxMediaModalManager.openModal(fieldName, {
                    multiple: false
                });
            } else {
                console.warn('MMX Media Modal غير متاح. تأكد من تضمينه.');
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
            this.saveState(); // Save state after removal
            this.clearValidation(); // Re-check validation
        }

        onMediaSelected(media) {
            const field = this.state.currentField;
            if (!field) return;
            if (field.endsWith('_assets')) {
                if (!Array.isArray(this.state.selectedMedia[field])) this.state.selectedMedia[field] = [];
                const exists = this.state.selectedMedia[field].some(m => m.id == media.id && media.id != null);
                if (!exists) this.state.selectedMedia[field].push(media);
                this.updateAssetsGrid(field);
            } else {
                this.state.selectedMedia[field] = media;
                this.updateFieldPreview(field);
            }
            this.updateSummary();
            this.updateHiddenFields();
            this.saveState(); // Save state after selection
            this.clearValidation(); // Clear any previous validation errors
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

            const flattenItems = Object.values(this.state.selectedMedia).flatMap(v => Array.isArray(v) ? v : (v ? [
                v
            ] : []));
            selectedCount.textContent = flattenItems.length;

            if (!flattenItems.length) {
                const noMediaText = this.state.currentLanguage === 'ar' ? 'لم يتم اختيار أي وسائط بعد' :
                    'No media selected yet';
                summaryBody.innerHTML = `
        <div class="empty-summary">
          <i class="fas fa-images"></i>
          <p data-ar="${noMediaText}" data-en="${noMediaText}">${noMediaText}</p>
        </div>`;
                return;
            }

            summaryBody.innerHTML = flattenItems.map(media => {
                const raw = media.url || '';
                const url = this.normalizeUrl(raw);
                const type = this.getFileType(url);
                let thumb = url;
                if (type === 'youtube') {
                    const vid = this.getYouTubeId(url);
                    if (vid) thumb = `https://i.ytimg.com/vi/${vid}/hqdefault.jpg`;
                }
                thumb = this.maybeProxy(thumb);
                const title = media.title || (this.state.currentLanguage === 'ar' ? 'بدون عنوان' :
                    'No title');

                return `
        <div class="summary-item">
          <img src="${thumb}" alt="${media.title || ''}" loading="lazy"
               referrerpolicy="no-referrer" crossorigin="anonymous"
               onerror="this.onerror=null; this.src='${this.placeholderThumb(url)}';">
          <div class="summary-info">
            <h6>${title}</h6>
            <span>${this.getFileTypeLabel(type)}</span>
          </div>
          <button class="btn btn-sm btn-outline-danger" onclick="mediaTabManager.removeMediaFromSummary('${media.id}')">
            <i class="fas fa-times"></i>
          </button>
        </div>`;
            }).join('');
        }

        removeMediaFromSummary(mediaId) {
            const singleKey = Object.keys(this.state.selectedMedia).find(k => !Array.isArray(this.state
                .selectedMedia[k]) && this.state.selectedMedia[k]?.id == mediaId);
            if (singleKey) return this.removeMedia(singleKey);
            Object.keys(this.state.selectedMedia).forEach(k => {
                const v = this.state.selectedMedia[k];
                if (Array.isArray(v)) {
                    const idx = v.findIndex(it => it?.id == mediaId);
                    if (idx > -1) this.removeAsset(k, idx);
                }
            });
        }

        updateHiddenFields() {
            const container = document.getElementById('media-hidden-fields');
            const parts = [];
            Object.entries(this.state.selectedMedia).forEach(([field, media]) => {
                if (!media) return;
                if (Array.isArray(media)) {
                    media.forEach((m, i) => {
                        parts.push(
                            `<input type="hidden" name="${field}[${i}][id]" value="${m.id ?? ''}">`,
                            `<input type="hidden" name="${field}[${i}][url]" value="${m.url ?? ''}">`,
                            `<input type="hidden" name="${field}[${i}][title]" value="${m.title ?? ''}">`,
                            `<input type="hidden" name="${field}[${i}][alt]" value="${m.alt ?? ''}">`
                        );
                    });
                } else {
                    parts.push(
                        `<input type="hidden" name="${field}_id" value="${media.id ?? ''}">`,
                        `<input type="hidden" name="${field}" value="${media.url ?? ''}">`,
                        `<input type="hidden" name="${field}_title" value="${media.title ?? ''}">`,
                        `<input type="hidden" name="${field}_alt" value="${media.alt ?? ''}">`
                    );
                }
            });

            // Add caption field
            if (this.state.selectedMedia.caption) {
                parts.push(`<input type="hidden" name="caption" value="${this.state.selectedMedia.caption}">`);
            }

            container.innerHTML = parts.join('');
        }

        /* ================== TYPE HELPERS ================== */
        getFileType(url) {
            if (!url) return 'file';
            const u = this.normalizeUrl(url);
            if (this.isYouTubeUrl(u)) return 'youtube';
            if (/(\.jpeg|\.jpg|\.gif|\.png|\.webp|\.bmp|\.svg)(\?|#|$)/i.test(u)) return 'image';
            if (/(\.mp4|\.avi|\.mov|\.wmv|\.webm|\.m4v)(\?|#|$)/i.test(u)) return 'video';
            if (/(\.mp3|\.wav|\.ogg|\.m4a|\.aac|\.flac)(\?|#|$)/i.test(u)) return 'audio';
            return 'file';
        }
        getFileTypeLabel(type) {
            const labels = {
                image: {
                    ar: 'صورة',
                    en: 'Image'
                },
                video: {
                    ar: 'فيديو',
                    en: 'Video'
                },
                audio: {
                    ar: 'صوت',
                    en: 'Audio'
                },
                youtube: {
                    ar: 'يوتيوب',
                    en: 'YouTube'
                },
                file: {
                    ar: 'ملف',
                    en: 'File'
                }
            };
            return labels[type]?.[this.state.currentLanguage] || type;
        }
        placeholderThumb(url = '') {
            return 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
                `<svg xmlns="http://www.w3.org/2000/svg" width="120" height="68"><rect width="100%" height="100%" fill="#f0f0f0"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-size="12" fill="#999">no preview</text></svg>`
            );
        }

        /* ================== FIELD GROUPS ================== */
        getNormalImageTemplate() {
            const title = this.state.currentLanguage === 'ar' ? 'إعدادات الصورة' : 'Image Settings';
            return `
    <div class="template-fields">
      <h6 class="template-title" data-ar="إعدادات الصورة" data-en="Image Settings">${title}</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
        ${this.createField('normal_main_image','الصورة الرئيسية','Main Image','fas fa-image')}
        ${this.createField('normal_content_image','صورة المحتوى','Content Image','fas fa-image')}
        ${this.createField('normal_mobile_image','صورة الموبايل','Mobile Image','fas fa-mobile-alt')}
      </div>
    </div>`;
        }

        getVideoTemplate() {
            const title = this.state.currentLanguage === 'ar' ? 'إعدادات الفيديو' : 'Video Settings';
            return `
    <div class="template-fields">
      <h6 class="template-title" data-ar="إعدادات الفيديو" data-en="Video Settings">${title}</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
        ${this.createField('video_main_image','صورة الفيديو الرئيسية','Video Main Image','fas fa-image')}
        ${this.createField('video_content_image','صورة محتوى الفيديو','Video Content Image','fas fa-image')}
        ${this.createField('video_mobile_image','صورة الفيديو للموبايل','Video Mobile Image','fas fa-mobile-alt')}
        ${this.createField('video_file','ملف الفيديو','Video File','fas fa-video','file')}
      </div>
    </div>`;
        }

        getPodcastTemplate() {
            const title = this.state.currentLanguage === 'ar' ? 'إعدادات البودكاست' : 'Podcast Settings';
            return `
    <div class="template-fields">
      <h6 class="template-title" data-ar="إعدادات البودكاست" data-en="Podcast Settings">${title}</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
        ${this.createField('podcast_main_image','صورة البودكاست الرئيسية','Podcast Main Image','fas fa-image')}
        ${this.createField('podcast_content_image','صورة محتوى البودكاست','Podcast Content Image','fas fa-image')}
        ${this.createField('podcast_mobile_image','صورة البودكاست للموبايل','Podcast Mobile Image','fas fa-mobile-alt')}
        ${this.createField('podcast_file','ملف البودكاست','Podcast File','fas fa-podcast','file')}
      </div>
    </div>`;
        }

        getAlbumTemplate() {
            const title = this.state.currentLanguage === 'ar' ? 'إعدادات الألبوم' : 'Album Settings';
            return `
    <div class="template-fields">
      <h6 class="template-title" data-ar="إعدادات الألبوم" data-en="Album Settings">${title}</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
        ${this.createField('album_main_image','صورة الألبوم الرئيسية','Album Main Image','fas fa-image')}
        ${this.createField('album_content_image','صورة محتوى الألبوم','Album Content Image','fas fa-image')}
        ${this.createField('album_mobile_image','صورة الألبوم للموبايل','Album Mobile Image','fas fa-mobile-alt')}
        ${this.createAssetsField('album_assets','أصول الألبوم','Album Assets')}
      </div>
    </div>`;
        }

        getNoImageTemplate() {
            const title = this.state.currentLanguage === 'ar' ? 'إعدادات المقال' : 'Article Settings';
            return `
    <div class="template-fields">
      <h6 class="template-title" data-ar="إعدادات المقال" data-en="Article Settings">${title}</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
        ${this.createField('no_image_main_image','الصورة الرئيسية','Main Image','fas fa-image')}
        ${this.createField('no_image_mobile_image','صورة المقال للموبايل','Article Mobile Image','fas fa-mobile-alt')}
      </div>
    </div>`;
        }
    }

    window.mediaTabManager = new MediaTabManager();
</script>

<!-- ======================= STYLES ======================= -->
<style>
    .media-manager {
        font-family: var(--bs-font-sans-serif);
        color: var(--bs-body-color);
    }

    /* Validation Alert */
    #media-validation-alert {
        border-radius: var(--bs-border-radius);
        border-left: 4px solid var(--bs-danger);
    }

    /* Field Highlighting */
    .field-missing {
        border: 2px solid var(--bs-danger) !important;
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-danger-rgb), 0.25) !important;
    }

    .field-required {}

    .field-preview.field-missing {
        border: 2px solid var(--bs-danger) !important;
    }

    .field-preview.field-required {}

    .field-card--full.field-missing .assets-wrapper {
        border: 2px solid var(--bs-danger) !important;
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-danger-rgb), 0.25) !important;
    }

    .field-card--full.field-required .assets-wrapper {}

    /* Caption Input */
    .caption-input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        background: var(--bs-white);
        color: var(--bs-body-color);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .caption-input:focus {
        border-color: var(--bs-primary);
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
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
        border: 2px solid var(--bs-border-color);
        cursor: pointer;
        transition: all .3s ease;
        /* background: var(--bs-white); */
        min-width: 110px;
        border-radius: var(--bs-border-radius);
    }

    .media-type-label i {
        font-size: 1.5rem;
        margin-bottom: .5rem;
        color: var(--bs-gray);
    }

    .media-type-label span {
        font-weight: 500;
        color: var(--bs-gray-700);
    }

    .media-type-input:checked+.media-type-label {
        border-color: var(--bs-primary);
        background: var(--bs-primary-bg-subtle);
    }

    .media-type-input:checked+.media-type-label i,
    .media-type-input:checked+.media-type-label span {
        color: var(--bs-primary);
    }

    /* Template Fields */
    .template-fields {
        padding: 1.5rem;
        border: 1px solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
    }

    .template-title {
        color: var(--bs-gray-800);
        margin-bottom: 1rem;
        font-weight: 600;
    }

    /* Changed from CSS Grid to flex column: each field now spans full width */
    .fields-grid {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .field-card {
        padding: 1rem;
        border-radius: var(--bs-border-radius);
    }

    .field-card--full {
        grid-column: 1 / -1;
    }

    .field-label {
        font-weight: 500;
        color: var(--bs-gray);
        margin-bottom: .5rem;
        display: block;
    }

    /* Empty state */
    .field-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        border: 2px solid var(--bs-border-color);
        cursor: pointer;
        transition: all .3s ease;
        background: var(--bs-white);
        min-height: 240px;
        border-radius: var(--bs-border-radius);
    }

    .field-empty:hover {
        border-color: var(--bs-primary);
        background: var(--bs-primary-bg-subtle);
    }

    .field-empty i {
        font-size: 2rem;
        color: var(--bs-gray);
        margin-bottom: .5rem;
    }

    .field-empty span {
        font-size: 1rem;
        color: var(--bs-gray);
        margin-bottom: .5rem;
    }

    /* Preview */
    .media-preview-selected {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 12px;
        background: var(--bs-white);
        border: 1px solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
    }

    .media-visual {
        width: 100%;
        aspect-ratio: 16/9;
        background: var(--bs-dark);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--bs-border-radius-sm);
    }

    .media-visual.is-audio {
        aspect-ratio: auto;
        background: var(--bs-gray-100);
        padding: 8px;
    }

    .media-visual>img,
    .media-visual>video,
    .media-visual>iframe {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 0;
        display: block;
        border-radius: var(--bs-border-radius-sm);
    }

    .media-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mmx-yt-embed {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    .media-info {
        display: flex;
        align-items: baseline;
        gap: 8px;
        margin: 0 2px;
    }

    .media-title {
        font-weight: 600;
        color: var(--bs-gray-800);
    }

    .media-type {
        font-size: .875rem;
        color: var(--bs-gray);
    }

    .media-actions {
        margin-top: 4px;
        padding-top: 8px;
        border-top: 1px solid var(--bs-border-color);
        display: flex;
        justify-content: flex-end;
        gap: 6px;
        width: 100%;
    }

    /* Summary Panel */
    .media-summary-panel .card {
        border: none;
        box-shadow: var(--bs-box-shadow);
        border-radius: var(--bs-border-radius);
    }

    .media-summary-panel .card-header {
        /* background-color: var(--bs-gray-100); */
        border-bottom: 1px solid var(--bs-border-color);
        color: var(--bs-gray-800);
    }

    .media-summary-grid {
        display: flex;
        flex-direction: column;
    }

    .summary-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: var(--bs-gray-100);
        margin-bottom: 6px;
        border-radius: var(--bs-border-radius);
    }

    .summary-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin: 0 10px 0 0;
        border-radius: var(--bs-border-radius-sm);
    }

    .summary-info {
        flex: 1;
        margin: 0 10px;
    }

    .summary-info h6 {
        margin: 0;
        font-size: .9rem;
        color: var(--bs-gray-800);
    }

    .summary-info span {
        color: var(--bs-gray);
        font-size: .8rem;
    }

    .empty-summary {
        text-align: center;
        padding: 2rem;
        color: var(--bs-gray);
    }

    .empty-summary i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: .5;
    }

    /* Buttons */
    .btn {
        border-radius: var(--bs-border-radius);
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    .btn-outline-primary {
        color: var(--bs-primary);
        border-color: var(--bs-primary);
    }

    .btn-outline-primary:hover {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        color: var(--bs-white);
    }

    .btn-outline-secondary {
        color: var(--bs-secondary);
        border-color: var(--bs-secondary);
    }

    .btn-outline-secondary:hover {
        background-color: var(--bs-secondary);
        border-color: var(--bs-secondary);
        color: var(--bs-white);
    }

    .btn-outline-danger {
        color: var(--bs-danger);
        border-color: var(--bs-danger);
    }

    .btn-outline-danger:hover {
        background-color: var(--bs-danger);
        border-color: var(--bs-danger);
        color: var(--bs-white);
    }

    .badge {
        border-radius: var(--bs-border-radius-pill);
        font-weight: 600;
    }

    .bg-primary {
        background-color: var(--bs-primary) !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .fields-grid {
            flex-direction: column;
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

    /* ===== أصول الألبوم (مجموعة) ===== */
    .assets-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* ===== تحسينات عرض الألبوم المتعدد ===== */
    .assets-wrapper {
        --asset-size: 180px;
    }

    .assets-wrapper.is-grid .assets-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(var(--asset-size), 1fr));
        gap: 10px;
    }

    .assets-wrapper.is-list .assets-grid {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .assets-toolbar {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }

    .assets-toolbar .assets-search {
        padding: 6px 8px;
        min-width: 220px;
        border: 1px solid var(--bs-border-color);
        background: var(--bs-white);
        border-radius: var(--bs-border-radius);
        color: var(--bs-body-color);
    }

    .assets-toolbar-group {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .assets-size-label {
        font-size: .9rem;
        color: var(--bs-gray);
    }

    .assets-empty {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 160px;
        border: 2px dashed var(--bs-border-color);
        background: var(--bs-white);
        color: var(--bs-gray);
        cursor: pointer;
        border-radius: var(--bs-border-radius);
    }

    .asset-item {
        position: relative;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--bs-border-color);
        background: var(--bs-white);
        padding: 8px;
        gap: 6px;
        transition: box-shadow .15s ease, border-color .15s ease;
        border-radius: var(--bs-border-radius);
    }

    .assets-wrapper.is-list .asset-item {
        flex-direction: row;
        align-items: center;
    }

    .asset-item.is-selected {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 2px rgba(var(--bs-primary-rgb), .15) inset;
    }

    .asset-check {
        position: absolute;
        top: 6px;
        left: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        z-index: 2;
    }

    .asset-check input {
        display: none;
    }

    .asset-check span {
        width: 18px;
        height: 18px;
        border: 1px solid var(--bs-gray-400);
        background: var(--bs-white);
        display: inline-block;
        border-radius: var(--bs-border-radius-sm);
    }

    .asset-item.is-selected .asset-check span {
        background: var(--bs-primary);
        border-color: var(--bs-primary);
    }

    .asset-thumb {
        width: 100%;
        aspect-ratio: 16/9;
        background: var(--bs-gray-200);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: var(--bs-border-radius-sm);
    }

    .assets-wrapper.is-list .asset-thumb {
        width: 220px;
        aspect-ratio: 16/9;
    }

    .asset-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .asset-audio {
        padding: 12px;
        font-size: .9rem;
        color: var(--bs-gray-700);
    }

    .asset-meta {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .asset-title {
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--bs-gray-800);
    }

    .asset-type {
        font-size: .85rem;
        color: var(--bs-gray);
    }

    .asset-actions {
        display: flex;
        justify-content: flex-end;
    }

    .assets-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid var(--bs-border-color);
    }

    .assets-page-actions {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .assets-page-actions select {
        border: 1px solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        padding: 4px 8px;
        background: var(--bs-white);
        color: var(--bs-body-color);
    }

    .assets-page-info {
        color: var(--bs-gray);
        font-size: 0.85rem;
    }

    @media (max-width: 768px) {
        .assets-wrapper.is-list .asset-thumb {
            width: 40%;
        }
    }

    /* ====== Full-width album assets ====== */
    .field-card--full {
        grid-column: 1 / -1;
        background: transparent;
        padding: 0;
        border: none;
    }

    .field-card--full .assets-label-row {
        margin-bottom: 8px;
    }

    .field-card--full .assets-wrapper {
        background: var(--bs-white);
        border: 1px solid var(--bs-border-color);
        padding: 10px;
        border-radius: var(--bs-border-radius);
    }

    .field-card--full .assets-wrapper.is-list .assets-grid {
        gap: 10px;
    }

    .field-card--full .asset-item {
        border: 1px solid var(--bs-border-color);
        background: var(--bs-white);
    }

    .field-card--full .assets-pagination {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid var(--bs-border-color);
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .media-manager {
            color: var(--bs-body-color);
        }

        .template-fields,
        .field-card,
        .field-empty,
        .media-preview-selected,
        .media-summary-panel .card,
        .summary-item,
        .assets-empty,
        .asset-item,
        .field-card--full .assets-wrapper,
        .caption-input {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        .field-label,
        .template-title,
        .media-title,
        .asset-title,
        .summary-info h6 {
            color: var(--bs-heading-color);
        }

        .caption-input {
            border-color: var(--bs-border-color);
        }
    }
</style>
