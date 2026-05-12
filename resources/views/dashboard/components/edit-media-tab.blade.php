<!-- ======================= HEAD ASSETS (place in <head>) ======================= -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="preconnect" href="https://www.youtube.com">
<link rel="preconnect" href="https://i.ytimg.com">
<link rel="preconnect" href="https://player.vimeo.com">
<link rel="preconnect" href="https://vumbnail.com">
<link rel="preconnect" href="https://www.dailymotion.com">
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

            // إعدادات اختيارية للوكيل (للتخطّي عبر نفس الأصل)
            this.USE_PROXY = false;
            this.PROXY_URL = '/media/proxy?url=';

            // Video platform helpers
            this.YT_REGEX = /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/i;
            this.VIMEO_REGEX = /(?:vimeo\.com\/)([0-9]+)/i;
            this.DAILYMOTION_REGEX = /(?:dailymotion\.com\/video\/|dai\.ly\/)([a-zA-Z0-9]+)/i;

            this.init();
        }

        /* ================== INIT & EVENTS ================== */
        init() {
            this.bindEvents();
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
        }

        bindEvents() {
            document.querySelectorAll('.media-type-input').forEach(radio => {
                radio.addEventListener('change', e => {
                    const prev = this.state.currentTemplate;
                    const next = e.target.value;
                    this.carryOverImages(prev, next);
                    this.state.currentTemplate = next;
                    this.loadTemplateContent(next);
                    // Re-render previews for fields just populated
                    ['main_image','content_image','mobile_image'].forEach(suffix => {
                        const key = this.templatePrefix(next) + '_' + suffix;
                        if (this.state.selectedMedia[key]) {
                            try { this.updateFieldPreview(key); } catch(_) {}
                        }
                    });
                    this.updateSummary();
                    this.updateHiddenFields();
                });
            });
        }

        templatePrefix(template) {
            return template === 'normal_image' ? 'normal' : template;
        }

        carryOverImages(prevTemplate, nextTemplate) {
            if (!prevTemplate || prevTemplate === nextTemplate) return;
            const prev = this.templatePrefix(prevTemplate);
            const next = this.templatePrefix(nextTemplate);
            const suffixes = ['main_image', 'content_image', 'mobile_image'];
            suffixes.forEach(suffix => {
                // no_image template has no content_image
                if (nextTemplate === 'no_image' && suffix === 'content_image') return;
                const fromKey = `${prev}_${suffix}`;
                const toKey = `${next}_${suffix}`;
                const src = this.state.selectedMedia[fromKey];
                const dst = this.state.selectedMedia[toKey];
                if (src && (!dst || !dst.url)) {
                    this.state.selectedMedia[toKey] = {
                        id: src.id ?? null,
                        url: src.url || '',
                        title: src.title || '',
                        alt: src.alt || ''
                    };
                }
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
        isVimeoUrl(url = '') {
            return this.VIMEO_REGEX.test(url);
        }
        getVimeoId(url = '') {
            const m = url.match(this.VIMEO_REGEX);
            return m ? m[1] : null;
        }
        isDailymotionUrl(url = '') {
            return this.DAILYMOTION_REGEX.test(url);
        }
        getDailymotionId(url = '') {
            const m = url.match(this.DAILYMOTION_REGEX);
            return m ? m[1] : null;
        }
        getVideoPlatform(url = '') {
            if (this.isYouTubeUrl(url)) return 'youtube';
            if (this.isVimeoUrl(url)) return 'vimeo';
            if (this.isDailymotionUrl(url)) return 'dailymotion';
            return null;
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

        createCaptionField() {
            return `
    <div class="field-card field-card--full">
      <label class="field-label" for="caption">التعليق</label>
      <input type="text" 
           class="form-control caption-input" 
           id="caption" 
           name="caption" 
           required
           placeholder="أدخل تعليق للصورة الرئيسية"
           value="{{ old('caption', $content->caption ?? '') }}"
           oninput="mediaTabManager.updateCaption(this.value)">
    </div>`;
      }

        updateCaption(value) {
            this.state.selectedMedia.caption = value;
            this.updateHiddenFields();
        }

        /* ============== COLLECTION FIELD ( *_assets ) ============== */
        createAssetsField(fieldName, label) {
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
          <span class="assets-title">
            <i class="fas fa-images"></i>
            <span>${label}</span>
            <span class="assets-count-badge">${items.length}</span>
          </span>
          <div class="assets-toolbar" data-assets-toolbar="${fieldName}">
            <div class="assets-toolbar-group assets-size-control">
              <i class="fas fa-search-minus assets-size-icon"></i>
              <input type="range" min="120" max="260" step="10" value="${ui.size}"
                     oninput="mediaTabManager.onAssetsSize('${fieldName}', this.value)" title="حجم">
              <i class="fas fa-search-plus assets-size-icon"></i>
            </div>
            <div class="assets-toolbar-group assets-toolbar-buttons">
              <button type="button" class="btn btn-sm btn-light assets-btn"
                      onclick="mediaTabManager.toggleAssetsView('${fieldName}')" title="تبديل العرض">
                <i class="fas ${ui.view === 'list' ? 'fa-th' : 'fa-list'}"></i>
              </button>
              <button type="button" class="btn btn-sm btn-primary assets-btn"
                      onclick="mediaTabManager.openAssetsPicker('${fieldName}')">
                <i class="fas fa-plus"></i> <span>إضافة</span>
              </button>
              <button type="button" class="btn btn-sm btn-light assets-btn"
                      onclick="mediaTabManager.selectAllAssets('${fieldName}')" title="تحديد الكل">
                <i class="fas fa-check-double"></i>
              </button>
              <button type="button" class="btn btn-sm btn-light assets-btn"
                      onclick="mediaTabManager.clearSelection('${fieldName}')" title="إلغاء التحديد">
                <i class="far fa-square"></i>
              </button>
              <button type="button" class="btn btn-sm btn-outline-danger assets-btn"
                      onclick="mediaTabManager.deleteSelectedAssets('${fieldName}')" title="حذف المحدد">
                <i class="fas fa-trash"></i>
              </button>
              <button type="button" class="btn btn-sm btn-outline-danger assets-btn"
                      onclick="mediaTabManager.clearAllAssets('${fieldName}')" title="تفريغ الألبوم">
                <i class="fas fa-broom"></i>
              </button>
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
            return `
      <div class="assets-empty" onclick="mediaTabManager.openAssetsPicker('${fieldName}')">
        <div class="assets-empty-icon"><i class="fas fa-cloud-upload-alt"></i></div>
        <div class="assets-empty-title">انقر للإضافة</div>
        <div class="assets-empty-sub">أضف صورًا إلى الألبوم</div>
      </div>`;
        }

        // بطاقة عنصر قابلة للتحديد والسحب
        getAssetCardSelectable(media, fieldName, index) {
            const url = this.normalizeUrl(media.url || '');
            const type = this.getFileType(url);
            let thumb = url;

            // Get thumbnail based on platform
            const platform = this.getVideoPlatform(url);
            if (platform === 'youtube') {
                const vid = this.getYouTubeId(url);
                if (vid) thumb = `https://i.ytimg.com/vi/${vid}/hqdefault.jpg`;
            } else if (platform === 'vimeo') {
                const vid = this.getVimeoId(url);
                if (vid) thumb = `https://vumbnail.com/${vid}.jpg`;
            } else if (platform === 'dailymotion') {
                const vid = this.getDailymotionId(url);
                if (vid) thumb = `https://www.dailymotion.com/thumbnail/video/${vid}`;
            }

            thumb = this.maybeProxy(thumb);
            const ui = this.state._assetsUi[fieldName];
            const selected = ui.selected.has(this._assetKey(media)) ? ' is-selected' : '';

            const typeIcon = type === 'audio' ? 'fa-music'
                : (type === 'youtube' || type === 'vimeo' || type === 'dailymotion' || type === 'video') ? 'fa-play'
                : 'fa-image';

            return `
      <div class="asset-item${selected}" data-index="${index}" draggable="true"
           ondragstart="mediaTabManager.onAssetDragStart(event, '${fieldName}', ${index})">
        <div class="asset-order">${index + 1}</div>
        <label class="asset-check" title="تحديد">
          <input type="checkbox" ${selected ? 'checked' : ''}
                 onchange="mediaTabManager.onAssetToggle('${fieldName}', ${index}, this.checked)">
          <span><i class="fas fa-check"></i></span>
        </label>
        <div class="asset-drag-handle" title="اسحب لإعادة الترتيب">
          <i class="fas fa-grip-vertical"></i>
        </div>
        <div class="asset-thumb">
          ${type === 'audio'
            ? `<div class="asset-audio" title="${media.title || ''}"><i class="fas fa-music"></i><span>${media.title || 'صوت'}</span></div>`
            : `<img src="${thumb}" alt="${media.title || ''}" loading="lazy"
                     onerror="this.onerror=null; this.src='${this.placeholderThumb(url)}';">`}
          <div class="asset-type-badge"><i class="fas ${typeIcon}"></i> ${this.getFileTypeLabel(type)}</div>
          <div class="asset-overlay">
            <button type="button" class="asset-overlay-btn asset-overlay-delete"
                    onclick="mediaTabManager.removeAsset('${fieldName}', ${index})" title="حذف">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
        <div class="asset-meta">
          <div class="asset-title" title="${media.title || ''}">${media.title || 'بدون عنوان'}</div>
          <div class="asset-type">${this.getFileTypeLabel(type)}</div>
        </div>
        <div class="asset-actions">
          <button type="button" class="btn btn-sm btn-outline-danger"
                  onclick="mediaTabManager.removeAsset('${fieldName}', ${index})">
            <i class="fas fa-trash"></i> حذف
          </button>
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
            return `
      <div class="assets-pagination">
        <div class="assets-page-info">العناصر: ${total} | الصفحة ${page} من ${pages}</div>
        <div class="assets-page-actions">
          <label>لكل صفحة</label>
          <select onchange="mediaTabManager.onAssetsPageSize('${fieldName}', this.value)">
            ${[12,24,36,60,96].map(n => `<option value="${n}" ${n==ui.pageSize?'selected':''}>${n}</option>`).join('')}
          </select>
          <button type="button" class="btn btn-sm" ${page<=1?'disabled':''}
                  onclick="mediaTabManager.gotoAssetsPage('${fieldName}', ${page-1})">السابق</button>
          <button type="button" class="btn btn-sm" ${page>=pages?'disabled':''}
                  onclick="mediaTabManager.gotoAssetsPage('${fieldName}', ${page+1})">التالي</button>
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
        }

        clearAllAssets(fieldName) {
            this.state.selectedMedia[fieldName] = [];
            this.state._assetsUi[fieldName].selected.clear();
            this.state._assetsUi[fieldName].page = 1;
            this.updateAssetsGrid(fieldName);
            this.updateSummary();
            this.updateHiddenFields();
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
        }

        /* ================== PREVIEWS (عنصر واحد) ================== */
        getMediaPreview(media, fieldName) {
            if (fieldName.endsWith('_assets')) {
                return `<div class="assets-grid">${ (Array.isArray(media) ? media : []).map((m, i) => this.getAssetCard(m, fieldName, i)).join('') }</div>`;
            }
            const raw = media.url || '';
            const url = this.normalizeUrl(raw);
            const type = this.getFileType(url);

            const wrap = (visualHtml, title, typeLabel, isAudio = false) => `
      <div class="media-preview-selected">
        <div class="media-visual ${isAudio ? 'is-audio' : ''}">${visualHtml}</div>
        <div class="media-info">
          <span class="media-title">${title || 'بدون عنوان'}</span>
          <span class="media-type">${typeLabel}</span>
        </div>
        <div class="media-actions">
          <button type="button" class="btn btn-sm btn-outline-secondary" onclick="mediaTabManager.changeMedia('${fieldName}')">تغيير</button>
          <button type="button" class="btn btn-sm btn-outline-danger" onclick="mediaTabManager.removeMedia('${fieldName}')">حذف</button>
        </div>
      </div>`;

            // Check for video platforms
            const platform = this.getVideoPlatform(url);

            if (platform === 'youtube') {
                const vid = this.getYouTubeId(url);
                if (vid) {
                    const embed = `https://www.youtube.com/embed/${vid}?rel=0&modestbranding=1`;
                    const visual =
                        `<iframe class="mmx-yt-embed" src="${embed}" title="${media.title || 'YouTube'}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy" referrerpolicy="no-referrer"></iframe>`;
                    return wrap(visual, media.title || 'YouTube', 'يوتيوب');
                }
                const fallbackThumb = 'https://i.ytimg.com/vi/dQw4w9WgXcQ/hqdefault.jpg';
                const visual =
                    `<img class="media-thumb" src="${fallbackThumb}" alt="${media.title || ''}" loading="lazy">`;
                return wrap(visual, media.title || 'YouTube', 'يوتيوب');
            }

            if (platform === 'vimeo') {
                const vid = this.getVimeoId(url);
                if (vid) {
                    const embed = `https://player.vimeo.com/video/${vid}?title=0&byline=0&portrait=0`;
                    const visual =
                        `<iframe class="mmx-yt-embed" src="${embed}" title="${media.title || 'Vimeo'}" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy"></iframe>`;
                    return wrap(visual, media.title || 'Vimeo', 'فيميو');
                }
            }

            if (platform === 'dailymotion') {
                const vid = this.getDailymotionId(url);
                if (vid) {
                    const embed = `https://www.dailymotion.com/embed/video/${vid}`;
                    const visual =
                        `<iframe class="mmx-yt-embed" src="${embed}" title="${media.title || 'Dailymotion'}" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy"></iframe>`;
                    return wrap(visual, media.title || 'Dailymotion', 'ديلي موشن');
                }
            }

            if (type === 'video') {
                const safe = this.maybeProxy(url);
                const visual = `<video src="${safe}" controls preload="metadata"></video>`;
                return wrap(visual, media.title || 'ملف فيديو', 'فيديو');
            }

            if (type === 'audio') {
                const safe = this.maybeProxy(url);
                const visual =
                    `<audio src="${safe}" controls preload="metadata" style="width:100%"></audio>`;
                return wrap(visual, media.title || 'ملف صوت', 'صوت', true);
            }

            const safeImg = this.maybeProxy(url);
            const visual =
                `<img class="media-thumb" src="${safeImg}" alt="${media.title || ''}" loading="lazy" onerror="this.onerror=null; this.src='${this.placeholderThumb(url)}';">`;
            return wrap(visual, media.title || 'بدون عنوان', this.getFileTypeLabel(type));
        }

        getEmptyState(fieldName, icon, type) {
            if (fieldName.endsWith('_assets')) return this.getAssetsEmptyState(fieldName);
            return `
      <div class="field-empty" onclick="mediaTabManager.openMediaModal('${fieldName}')">
        <i class="${icon}"></i>
        <span>${type === 'file' ? 'اختر ملف' : 'اختر صورة'}</span>
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
            // Summary panel was removed from the markup — no-op when nodes are gone.
            if (!summaryBody || !selectedCount) return;

            const flattenItems = Object.values(this.state.selectedMedia).flatMap(v => Array.isArray(v) ? v : (v ? [
                v
            ] : []));
            selectedCount.textContent = flattenItems.length;

            if (!flattenItems.length) {
                summaryBody.innerHTML = `
        <div class="empty-summary">
          <i class="fas fa-images"></i>
          <p>لم يتم اختيار أي وسائط بعد</p>
        </div>`;
                return;
            }

            summaryBody.innerHTML = flattenItems.map(media => {
                const raw = media.url || '';
                const url = this.normalizeUrl(raw);
                const type = this.getFileType(url);
                let thumb = url;

                // Get thumbnail based on platform
                const platform = this.getVideoPlatform(url);
                if (platform === 'youtube') {
                    const vid = this.getYouTubeId(url);
                    if (vid) thumb = `https://i.ytimg.com/vi/${vid}/hqdefault.jpg`;
                } else if (platform === 'vimeo') {
                    const vid = this.getVimeoId(url);
                    if (vid) thumb = `https://vumbnail.com/${vid}.jpg`;
                } else if (platform === 'dailymotion') {
                    const vid = this.getDailymotionId(url);
                    if (vid) thumb = `https://www.dailymotion.com/thumbnail/video/${vid}`;
                }

                thumb = this.maybeProxy(thumb);

                return `
        <div class="summary-item">
          <img src="${thumb}" alt="${media.title || ''}" loading="lazy"
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
            const platform = this.getVideoPlatform(u);
            if (platform) return platform;
            if (/(\.jpeg|\.jpg|\.gif|\.png|\.webp|\.bmp|\.svg)(\?|#|$)/i.test(u)) return 'image';
            if (/(\.mp4|\.avi|\.mov|\.wmv|\.webm|\.m4v)(\?|#|$)/i.test(u)) return 'video';
            if (/(\.mp3|\.wav|\.ogg|\.m4a|\.aac|\.flac)(\?|#|$)/i.test(u)) return 'audio';
            return 'file';
        }
        getFileTypeLabel(type) {
            return {
                image: 'صورة',
                video: 'فيديو',
                audio: 'صوت',
                youtube: 'يوتيوب',
                vimeo: 'فيميو',
                dailymotion: 'ديلي موشن'
            } [type] || 'ملف';
        }
        placeholderThumb(url = '') {
            return 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
                `<svg xmlns="http://www.w3.org/2000/svg" width="120" height="68"><rect width="100%" height="100%" fill="#f0f0f0"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-size="12" fill="#999">no preview</text></svg>`
            );
        }

        /* ================== FIELD GROUPS ================== */
        getNormalImageTemplate() {
            return `
    <div class="template-fields">
      <h6 class="template-title">إعدادات الصورة</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
        ${this.createField('normal_main_image','الصورة الرئيسية','fas fa-image')}
        ${this.createField('normal_content_image','صورة المحتوى','fas fa-image')}
        ${this.createField('normal_mobile_image','صورة الموبايل','fas fa-mobile-alt')}
      </div>
    </div>`;
        }

        getVideoTemplate() {
            return `
    <div class="template-fields">
      <h6 class="template-title">إعدادات الفيديو</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
        ${this.createField('video_file','ملف الفيديو','fas fa-video','file')}
        ${this.createField('video_main_image','صورة الفيديو الرئيسية','fas fa-image')}
        ${this.createField('video_content_image','صورة محتوى الفيديو','fas fa-image')}
        ${this.createField('video_mobile_image','صورة الفيديو للموبايل','fas fa-mobile-alt')}
      </div>
    </div>`;
        }

        getPodcastTemplate() {
            return `
    <div class="template-fields">
      <h6 class="template-title">إعدادات البودكاست</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
        ${this.createField('podcast_file','ملف البودكاست','fas fa-podcast','file')}
        ${this.createField('podcast_main_image','صورة البودكاست الرئيسية','fas fa-image')}
        ${this.createField('podcast_content_image','صورة محتوى البودكاست','fas fa-image')}
        ${this.createField('podcast_mobile_image','صورة البودكاست للموبايل','fas fa-mobile-alt')}
      </div>
    </div>`;
        }

        getAlbumTemplate() {
            return `
    <div class="template-fields">
      <h6 class="template-title">إعدادات الألبوم</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
        ${this.createAssetsField('album_assets','أصول الألبوم')}
        ${this.createField('album_main_image','صورة الألبوم الرئيسية','fas fa-image')}
        ${this.createField('album_content_image','صورة محتوى الألبوم','fas fa-image')}
        ${this.createField('album_mobile_image','صورة الألبوم للموبايل','fas fa-mobile-alt')}
      </div>
    </div>`;
        }

        getNoImageTemplate() {
            return `
    <div class="template-fields">
      <h6 class="template-title">إعدادات المقال</h6>
      <div class="fields-grid">
        ${this.createCaptionField()}
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
    :root {
        --az-border: #dbdfea;
        --az-muted: #8091a7;
        --az-soft: #f5f6fa;
        --az-card: #ffffff;
        --az-title: #364a63;
        --az-accent: #6576ff;
        --az-accent-light: #eff6ff;
        --az-danger: #e85347;
        --az-success: #1ee0ac;
        --az-warning: #f4bd0e;
        --az-radius: 0.35rem;
        --az-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --az-shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
        --az-transition: all 0.2s ease-in-out;
    }

    [data-bs-theme="dark"] {
        --az-border: #384D69;
        --az-muted: #b7c2d0;
        --az-soft: #2b3748;
        --az-card: #0D141D;
        --az-title: #e5e9f2;
        --az-accent: #6576ff;
        --az-accent-light: #2b3748;
        --az-danger: #e85347;
        --az-success: #1ee0ac;
        --az-warning: #f4bd0e;
    }

    .media-manager {
        font-family: var(--bs-font-sans-serif);
        color: var(--az-title);
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

    /* Force single-column layout for all media fields */
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
        background: var(--bs-body-bg);
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
        border-radius: var(--az-radius);
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    .btn-outline-primary {
        color: var(--az-accent);
        border-color: var(--az-accent);
    }

    .btn-outline-primary:hover {
        background-color: var(--az-accent);
        border-color: var(--az-accent);
        color: white;
    }

    .btn-outline-secondary {
        color: var(--az-muted);
        border-color: var(--az-border);
    }

    .btn-outline-secondary:hover {
        background-color: var(--az-muted);
        border-color: var(--az-muted);
        color: white;
    }

    .btn-outline-danger {
        color: var(--az-danger);
        border-color: var(--az-danger);
    }

    .btn-outline-danger:hover {
        background-color: var(--az-danger);
        border-color: var(--az-danger);
        color: white;
    }

    .badge {
        border-radius: var(--az-radius);
        font-weight: 600;
    }

    .bg-primary {
        background-color: var(--az-accent) !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .fields-grid {
            grid-template-columns: 1fr;
            gap: 12px;
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
            min-width: 0;
        }

        .field-empty {
            min-height: 160px;
        }

        /* Album asset grid: smaller tiles on mobile */
        .assets-wrapper { --asset-size: 110px !important; }
        .assets-wrapper.is-grid .assets-grid { gap: 6px !important; }

        /* Summary panel + caption inputs: prevent horizontal overflow */
        .media-summary-panel,
        .summary-item,
        .caption-input { max-width: 100%; min-width: 0; box-sizing: border-box; }
        .summary-item { flex-wrap: wrap; }

        /* Media picker modal: full-width on phones */
        .modal-dialog.modal-xl,
        .modal-dialog.modal-lg { max-width: 100%; margin: 0; }
        .modal-content { border-radius: 0; }
        .mmx-modal .modal-body,
        .mmxc-modal .modal-body { padding: 10px !important; }

        /* Picker grids inside the modal */
        .mmx-grid, .mmxc-grid, .gallery-picker-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)) !important;
            gap: 6px !important;
        }
    }

    /* ===== أصول الألبوم (مجموعة) ===== */
    .assets-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .assets-title {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: 1rem;
        color: var(--az-title);
    }

    .assets-title > i { color: var(--az-accent); }

    .assets-count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 24px;
        height: 22px;
        padding: 0 8px;
        font-size: .75rem;
        font-weight: 700;
        color: var(--az-accent);
        background: rgba(101, 118, 255, .12);
        border-radius: 999px;
    }

    /* ===== تحسينات عرض الألبوم المتعدد ===== */
    .assets-wrapper {
        --asset-size: 180px;
        background: linear-gradient(180deg, var(--az-card) 0%, var(--az-soft) 100%);
        border: 1px solid var(--az-border);
        border-radius: 12px;
        padding: 14px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .03);
    }

    .assets-wrapper.is-grid .assets-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(var(--asset-size), 1fr));
        gap: 14px;
    }

    .assets-wrapper.is-list .assets-grid {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .assets-toolbar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    .assets-toolbar-group {
        display: flex;
        gap: 6px;
        align-items: center;
        padding: 4px;
        background: var(--az-card);
        border: 1px solid var(--az-border);
        border-radius: 999px;
    }

    .assets-toolbar-buttons .assets-btn {
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        line-height: 1;
        padding: 6px 10px;
    }

    .assets-size-control { padding: 4px 12px; }

    .assets-size-control input[type="range"] {
        accent-color: var(--az-accent);
        width: 110px;
    }

    .assets-size-icon {
        color: var(--az-muted);
        font-size: .8rem;
    }

    .assets-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 200px;
        border: 2px dashed var(--az-border);
        background: var(--az-card);
        color: var(--az-muted);
        cursor: pointer;
        border-radius: 12px;
        transition: border-color .2s ease, background .2s ease;
        grid-column: 1 / -1;
    }

    .assets-empty:hover {
        border-color: var(--az-accent);
        background: rgba(101, 118, 255, .04);
        color: var(--az-accent);
    }

    .assets-empty-icon {
        font-size: 2.5rem;
        color: var(--az-accent);
        opacity: .7;
    }

    .assets-empty-title {
        font-weight: 700;
        font-size: 1rem;
        color: var(--az-title);
    }

    .assets-empty-sub {
        font-size: .85rem;
        color: var(--az-muted);
        text-align: center;
        max-width: 320px;
    }

    .asset-item {
        position: relative;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--az-border);
        background: var(--az-card);
        padding: 0;
        gap: 0;
        overflow: hidden;
        transition: box-shadow .2s ease, border-color .2s ease, transform .15s ease;
        border-radius: 10px;
        cursor: grab;
    }

    .asset-item:active { cursor: grabbing; }

    .asset-item:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, .08);
        border-color: var(--az-accent);
        transform: translateY(-2px);
    }

    .asset-item:hover .asset-overlay { opacity: 1; }
    .asset-item:hover .asset-drag-handle { opacity: 1; }

    .assets-wrapper.is-list .asset-item {
        flex-direction: row;
        align-items: stretch;
    }

    .asset-item.is-selected {
        border-color: var(--az-accent);
        box-shadow: 0 0 0 2px var(--az-accent), 0 6px 18px rgba(101, 118, 255, .2);
    }

    .asset-order {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 3;
        min-width: 26px;
        height: 26px;
        padding: 0 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        font-size: .75rem;
        font-weight: 700;
        border-radius: 999px;
        backdrop-filter: blur(4px);
    }

    .asset-check {
        position: absolute;
        top: 8px;
        left: 8px;
        display: inline-flex;
        align-items: center;
        z-index: 3;
        cursor: pointer;
    }

    .asset-check input { display: none; }

    .asset-check span {
        width: 22px;
        height: 22px;
        border: 2px solid #fff;
        background: rgba(0, 0, 0, .35);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: transparent;
        border-radius: 6px;
        transition: background .15s ease, color .15s ease, transform .15s ease;
        backdrop-filter: blur(4px);
    }

    .asset-check span i { font-size: .75rem; }

    .asset-item:hover .asset-check span { background: rgba(0, 0, 0, .55); }

    .asset-item.is-selected .asset-check span {
        background: var(--az-accent);
        border-color: #fff;
        color: #fff;
        transform: scale(1.05);
    }

    .asset-drag-handle {
        position: absolute;
        bottom: 8px;
        right: 8px;
        z-index: 3;
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: rgba(0, 0, 0, .5);
        border-radius: 6px;
        opacity: 0;
        transition: opacity .2s ease;
        backdrop-filter: blur(4px);
        cursor: grab;
        font-size: .8rem;
    }

    .asset-thumb {
        position: relative;
        width: 100%;
        aspect-ratio: 1/1;
        background: linear-gradient(135deg, var(--az-soft) 0%, var(--az-border) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .assets-wrapper.is-list .asset-thumb {
        width: 180px;
        flex: 0 0 180px;
        aspect-ratio: 16/9;
    }

    .asset-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .35s ease;
    }

    .asset-item:hover .asset-thumb img { transform: scale(1.06); }

    .asset-audio {
        width: 100%;
        height: 100%;
        padding: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: .85rem;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
        text-align: center;
    }

    .asset-audio i { font-size: 1.6rem; opacity: .9; }

    .asset-audio span {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .asset-type-badge {
        position: absolute;
        bottom: 8px;
        left: 8px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 8px;
        font-size: .7rem;
        font-weight: 600;
        color: #fff;
        background: rgba(0, 0, 0, .6);
        border-radius: 999px;
        backdrop-filter: blur(4px);
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .asset-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, .35) 100%);
        opacity: 0;
        transition: opacity .2s ease;
        pointer-events: none;
    }

    .asset-overlay-btn {
        pointer-events: auto;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, .95);
        color: var(--az-title);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform .15s ease, background .15s ease, color .15s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
    }

    .asset-overlay-btn:hover { transform: scale(1.1); }

    .asset-overlay-delete:hover {
        background: var(--bs-danger, #dc3545);
        color: #fff;
    }

    .asset-meta {
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 10px 12px 6px;
        flex: 1;
        min-width: 0;
    }

    .asset-title {
        font-weight: 600;
        font-size: .9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--az-title);
    }

    .asset-type {
        font-size: .75rem;
        color: var(--az-muted);
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .asset-actions {
        display: flex;
        justify-content: flex-end;
        padding: 0 12px 10px;
    }

    .assets-wrapper.is-grid .asset-actions { display: none; }

    .assets-wrapper.is-list .asset-overlay,
    .assets-wrapper.is-list .asset-order,
    .assets-wrapper.is-list .asset-drag-handle { display: none; }

    .assets-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid var(--az-border);
    }

    .assets-page-actions {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .assets-page-actions select {
        border: 1px solid var(--az-border);
        border-radius: var(--az-radius);
        padding: 4px 8px;
        background: var(--az-card);
        color: var(--az-title);
    }

    .assets-page-info {
        color: var(--az-muted);
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
        background: var(--az-card);
        border: 1px solid var(--az-border);
        padding: 10px;
        border-radius: var(--az-radius);
    }

    .field-card--full .assets-wrapper.is-list .assets-grid {
        gap: 10px;
    }

    .field-card--full .asset-item {
        border: 1px solid var(--az-border);
        background: var(--az-card);
    }

    .field-card--full .assets-pagination {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid var(--az-border);
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

<!-- ======================= HYDRATATION INITIALE (depuis le contrôleur) ======================= -->
@php
    // Contrôleur fournit : $content, $templateFields (cf. méthode edit())
    $initialTemplate = $content->template ?? old('template', 'normal_image');

    // Champs unitaires : on ne passe que les clés présentes et non vides
    $fieldKeys = [
        'normal_main_image',
        'normal_content_image',
        'normal_mobile_image',
        'video_main_image',
        'video_content_image',
        'video_mobile_image',
        'video_file',
        'podcast_main_image',
        'podcast_content_image',
        'podcast_mobile_image',
        'podcast_file',
        'album_main_image',
        'album_content_image',
        'album_mobile_image',
        'no_image_main_image',
        'no_image_mobile_image',
    ];
    $initialFields = [];
    foreach ($fieldKeys as $k) {
        if (!empty($templateFields[$k]) && is_string($templateFields[$k]) && trim($templateFields[$k]) !== '') {
            $initialFields[$k] = $templateFields[$k];
        }
    }

    // Assets d'album : tableau d'objets [{url,title,alt}, ...]
    $initialAssets = [];
    if (!empty($templateFields['album_assets']) && is_array($templateFields['album_assets'])) {
        // Normaliser : ne garder que url/title/alt
        $initialAssets['album_assets'] = array_values(
            array_map(
                function ($m) {
                    return [
                        'url' => is_array($m) ? $m['url'] ?? '' : (is_string($m) ? $m : ''),
                        'title' => is_array($m) ? $m['title'] ?? '' : '',
                        'alt' => is_array($m) ? $m['alt'] ?? '' : '',
                    ];
                },
                array_filter($templateFields['album_assets'], function ($m) {
                    return is_array($m) ? !empty($m['url']) : is_string($m) && trim($m) !== '';
                }),
            ),
        );
    }

    // Caption field
    $initialCaption = $templateFields['caption'] ?? '';
@endphp

<script>
    (function attachEditHydrator() {
        if (!window.mediaTabManager) return;

        function toMediaObject(url, title = '', alt = '') {
            return {
                id: null,
                url: url || '',
                title: title || '',
                alt: alt || ''
            };
        }

        window.mediaTabManager.hydrateInitial = function(payload) {
            if (!payload || typeof payload !== 'object') return;

            // 1) Template courant
            const tpl = (payload.template || '').trim() || 'normal_image';
            this.state.currentTemplate = tpl;
            const radio = document.querySelector(`.media-type-input[value="${tpl}"]`);
            if (radio) radio.checked = true;
            this.loadTemplateContent(tpl);

            // 2) Champs unitaires (URL -> objet media)
            const fields = payload.fields || {};
            Object.keys(fields).forEach(fieldName => {
                const url = fields[fieldName];
                if (!url || typeof url !== 'string') return;
                this.state.selectedMedia[fieldName] = toMediaObject(url);
                this.updateFieldPreview(fieldName);
            });

            // 3) Album assets (objets {url,title,alt})
            const assets = payload.assets || {};
            if (Array.isArray(assets.album_assets) && assets.album_assets.length) {
                const key = 'album_assets';
                this.state.selectedMedia[key] = assets.album_assets.map(m => toMediaObject(m.url || m, m
                    .title || '', m.alt || ''));
                this.state._assetsUi = this.state._assetsUi || {};
                this.state._assetsUi[key] = Object.assign({
                    page: 1,
                    pageSize: 24,
                    view: 'grid',
                    size: 180,
                    query: '',
                    selected: new Set()
                }, this.state._assetsUi[key] || {});
                this.updateAssetsGrid(key);
            }

            // 4) Caption field
            if (payload.caption) {
                this.state.selectedMedia.caption = payload.caption;
                const captionInput = document.getElementById('caption');
                if (captionInput) {
                    captionInput.value = payload.caption;
                }
            }

            // 5) Finalisation
            this.updateSummary();
            this.updateHiddenFields();
        };

        document.addEventListener('DOMContentLoaded', () => {
            const bootstrap = {
                template: @json($initialTemplate),
                fields: @json($initialFields, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                assets: @json($initialAssets, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                caption: @json($initialCaption, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            };
            // Laisser le temps au DOM d'apparaître
            setTimeout(() => {
                window.mediaTabManager.hydrateInitial(bootstrap);
            }, 0);
        });
    })();
</script>
