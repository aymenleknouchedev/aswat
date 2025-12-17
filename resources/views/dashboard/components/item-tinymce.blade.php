<!-- ======================= TinyMCE 6 Configuration for Item Modal (Advanced with Modals) ======================= -->

<!-- TEXT, READMORE & DEFINITION MODAL HTML -->
<div id="vvcTextModal" class="vvc-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="vvcTextModalTitle" style="position:fixed;inset:0;display:none;z-index:10100;">
    <div class="vvc-backdrop" data-vvc-text-backdrop style="position:absolute;inset:0;background:rgba(0,0,0,.4);z-index:0;"></div>
    <div class="vvc-container" role="document" style="max-width:600px;position:absolute;inset:auto 0;top:5%;margin:0 auto;width:clamp(320px,92vw,1000px);max-height:90%;background:var(--vvc-body-bg,#fff);color:var(--vvc-body-color,#526484);display:flex;flex-direction:column;overflow:hidden;z-index:10001;box-shadow:0 10px 30px rgba(0,0,0,.12);animation:vvcFade .2s ease-out;">
        <div style="display:flex;justify-content:space-between;align-items:center;padding:1.5rem;border-bottom:1px solid var(--vvc-border-color,#dbdfea);">
            <h5 id="vvcTextModalTitle" style="margin:0;font-size:1.1rem;color:var(--vvc-heading-color,#364a63);">إضافة نص قابل للنقر</h5>
            <button class="vvc-close" type="button" data-vvc-text-close aria-label="إغلاق" style="background:none;border:none;font-size:1.5rem;cursor:pointer;color:var(--vvc-body-color);">&times;</button>
        </div>
        <div style="flex:1;overflow-y:auto;padding:1.5rem;">
            <div style="margin-bottom:1rem;">
                <label for="vvc-text-content" style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">النص المعروض:</label>
                <input type="text" id="vvc-text-content" placeholder="أدخل النص الذي سيظهر في المقال" style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);box-sizing:border-box;">
            </div>
            <div style="margin-bottom:1rem;">
                <label for="vvc-text-key" style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">المفتاح:</label>
                <input type="text" id="vvc-text-key" placeholder="سيتم إنشاؤه تلقائياً" style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);box-sizing:border-box;" readonly>
            </div>
            <div style="margin-bottom:1rem;">
                <label for="vvc-text-description" style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">الوصف:</label>
                <textarea id="vvc-text-description" rows="4" placeholder="أدخل الوصف" style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);box-sizing:border-box;"></textarea>
            </div>
        </div>
        <div style="display:flex;gap:0.5rem;padding:1.5rem;border-top:1px solid var(--vvc-border-color);justify-content:flex-end;">
            <button class="vvc-btn vvc-btn-primary" type="button" id="vvc-btn-insert-text" style="padding:0.5rem 1rem;background:#6576ff;color:white;border:none;cursor:pointer;border-radius:4px;">إدراج النص</button>
            <button class="vvc-btn vvc-btn-cancel" type="button" data-vvc-text-close style="padding:0.5rem 1rem;background:#e0e0e0;color:#526484;border:none;cursor:pointer;border-radius:4px;">إلغاء</button>
        </div>
    </div>
</div>

<div id="vvcReadMoreModal" class="vvc-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="vvcReadMoreModalTitle" style="position:fixed;inset:0;display:none;z-index:10100;">
    <div class="vvc-backdrop" data-vvc-readmore-backdrop style="position:absolute;inset:0;background:rgba(0,0,0,.4);z-index:0;"></div>
    <div class="vvc-container" role="document" style="max-width:800px;position:absolute;inset:auto 0;top:5%;margin:0 auto;width:clamp(320px,92vw,1000px);max-height:90%;background:var(--vvc-body-bg,#fff);color:var(--vvc-body-color,#526484);display:flex;flex-direction:column;overflow:hidden;z-index:10001;box-shadow:0 10px 30px rgba(0,0,0,.12);animation:vvcFade .2s ease-out;">
        <div style="display:flex;justify-content:space-between;align-items:center;padding:1.5rem;border-bottom:1px solid var(--vvc-border-color,#dbdfea);">
            <h5 id="vvcReadMoreModalTitle" style="margin:0;font-size:1.1rem;color:var(--vvc-heading-color,#364a63);">إدراج اقرأ المزيد</h5>
            <button class="vvc-close" type="button" data-vvc-readmore-close aria-label="إغلاق" style="background:none;border:none;font-size:1.5rem;cursor:pointer;color:var(--vvc-body-color);">&times;</button>
        </div>
        <div style="flex:1;overflow-y:auto;padding:1.5rem;">
            <div style="margin-bottom:1rem;">
                <label for="vvc-readmore-section" style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">القسم:</label>
                <select id="vvc-readmore-section" style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);box-sizing:border-box;">
                    <option value="">-- كل الأقسام --</option>
                </select>
            </div>
            <div style="margin-bottom:1rem;">
                <label for="vvc-readmore-search" style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">بحث:</label>
                <input type="text" id="vvc-readmore-search" placeholder="ابحث عن محتوى..." style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);box-sizing:border-box;">
            </div>
            <div style="margin-bottom:1rem;">
                <label for="vvc-readmore-content" style="display:block;margin-bottom:0.5rem;font-weight:600;color:var(--vvc-heading-color);">اختر المحتوى:</label>
                <select id="vvc-readmore-content" style="width:100%;padding:.6rem .7rem;border:1px solid var(--vvc-border-color);background:var(--vvc-body-bg);color:var(--vvc-body-color);box-sizing:border-box;">
                    <option value="">-- اختر محتوى --</option>
                </select>
            </div>
            <div id="vvc-readmore-preview" style="padding:1rem;background:var(--vvc-gray-100);border-radius:4px;"><p style="color:var(--vvc-muted);text-align:center;margin:2rem 0;">ستظهر معاينة هنا</p></div>
        </div>
        <div style="display:flex;gap:0.5rem;padding:1.5rem;border-top:1px solid var(--vvc-border-color);justify-content:flex-end;">
            <button class="vvc-btn vvc-btn-primary" type="button" id="vvc-btn-insert-readmore" style="padding:0.5rem 1rem;background:#6576ff;color:white;border:none;cursor:pointer;border-radius:4px;">إدراج</button>
            <button class="vvc-btn vvc-btn-cancel" type="button" data-vvc-readmore-close style="padding:0.5rem 1rem;background:#e0e0e0;color:#526484;border:none;cursor:pointer;border-radius:4px;">إلغاء</button>
        </div>
    </div>
</div>

<style>
    :root {
        --vvc-primary: #6576ff;
        --vvc-body-bg: #fff;
        --vvc-body-color: #526484;
        --vvc-heading-color: #364a63;
        --vvc-border-color: #dbdfea;
        --vvc-muted: #8091a7;
        --vvc-gray-100: #ebeef2;
    }
    [data-bs-theme="dark"] {
        --vvc-body-bg: #0D141D;
        --vvc-body-color: #e5e9f2;
        --vvc-heading-color: #fff;
        --vvc-border-color: #384D69;
        --vvc-muted: #b7c2d0;
        --vvc-gray-100: #2b3748;
    }
    .vvc-modal[aria-hidden="false"] { display: block !important; }
    @keyframes vvcFade { from { opacity:0; transform:translateY(-14px); } to { opacity:1; transform:translateY(0); } }
</style>

<script src="https://cdn.tiny.cloud/1/vw6sltzauw9x6b3cl3eby8nj99q4eoavzv581jnnmabxbhq2/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    // Utility function to escape HTML
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    // Fallback pickMediaForTiny if not defined (from tinymce-config.blade.php)
    if (!window.pickMediaForTiny) {
        window.pickMediaForTiny = function(opts = { type: 'media' }) {
            return new Promise((resolve) => {
                resolve(null); // Return null if media modal not available
            });
        };
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Modal element references
        const textModal = document.getElementById('vvcTextModal');
        const textBackdrop = textModal?.querySelector('[data-vvc-text-backdrop]');
        const textCloses = textModal?.querySelectorAll('[data-vvc-text-close]');
        const textContainer = textModal?.querySelector('.vvc-container');

        const readMoreModal = document.getElementById('vvcReadMoreModal');
        const readMoreBackdrop = readMoreModal?.querySelector('[data-vvc-readmore-backdrop]');
        const readMoreCloses = readMoreModal?.querySelectorAll('[data-vvc-readmore-close]');
        const readMoreContainer = readMoreModal?.querySelector('.vvc-container');

        // Form elements
        const textContentInput = document.getElementById('vvc-text-content');
        const textKeyInput = document.getElementById('vvc-text-key');
        const textDescriptionInput = document.getElementById('vvc-text-description');
        const btnInsertText = document.getElementById('vvc-btn-insert-text');

        const readMoreSectionSelect = document.getElementById('vvc-readmore-section');
        const readMoreSearchInput = document.getElementById('vvc-readmore-search');
        const readMoreContentSelect = document.getElementById('vvc-readmore-content');
        const readMorePreview = document.getElementById('vvc-readmore-preview');
        const btnInsertReadMore = document.getElementById('vvc-btn-insert-readmore');

        // Text definitions storage
        window.vvcTextDefinitions = window.vvcTextDefinitions || {};

        // State management
        let textModalState = {
            selectedImage: null,
            selectedImagePath: null,
            editingElement: null,
            isEditMode: false
        };

        // ============================================
        // TEXT MODAL MANAGER (Public API)
        // ============================================
        window.vvcTextModalManager = {
            openModal(elementToEdit = null) {
                textModalState.selectedImage = null;
                textModalState.selectedImagePath = null;
                textModalState.editingElement = elementToEdit;
                textModalState.isEditMode = !!elementToEdit;

                textModal.setAttribute('aria-hidden', 'false');
                document.documentElement.style.overflow = 'hidden';

                if (elementToEdit) {
                    textContentInput.value = elementToEdit.textContent || '';
                    textKeyInput.value = elementToEdit.getAttribute('data-term') || '';
                    textDescriptionInput.value = elementToEdit.getAttribute('data-description') || '';
                    textKeyInput.removeAttribute('readonly');
                    btnInsertText.textContent = 'تحديث النص';
                } else {
                    textContentInput.value = '';
                    textKeyInput.value = '';
                    textDescriptionInput.value = '';
                    textKeyInput.setAttribute('readonly', 'readonly');
                    btnInsertText.textContent = 'إدراج النص';
                    if (window.tinymce && tinymce.activeEditor) {
                        const selectedText = tinymce.activeEditor.selection.getContent({ format: 'text' });
                        if (selectedText) textContentInput.value = selectedText;
                    }
                }

                setTimeout(() => textContentInput.focus(), 0);
            },

            closeModal() {
                textModal.setAttribute('aria-hidden', 'true');
                document.documentElement.style.overflow = '';
                textModalState.selectedImage = null;
                textModalState.selectedImagePath = null;
                textModalState.editingElement = null;
                textModalState.isEditMode = false;
            },

            addTextDefinition(key, content, description, imagePath = null) {
                window.vvcTextDefinitions[key] = { content, description, image: imagePath };
            }
        };

        // ============================================
        // READ MORE MODAL MANAGER (Public API)
        // ============================================
        window.vvcReadMoreModalManager = {
            openModal() {
                readMoreModal.setAttribute('aria-hidden', 'false');
                document.documentElement.style.overflow = 'hidden';

                readMoreSectionSelect.innerHTML = '<option value="">-- كل الأقسام --</option>';
                if (window.SECTIONS_DATA && window.SECTIONS_DATA.length > 0) {
                    window.SECTIONS_DATA.forEach(section => {
                        const option = document.createElement('option');
                        option.value = section.id;
                        option.textContent = section.name;
                        readMoreSectionSelect.appendChild(option);
                    });
                }

                readMoreSectionSelect.value = '';
                readMoreSearchInput.value = '';
                readMoreContentSelect.value = '';
                readMorePreview.innerHTML = '<p style="color:var(--vvc-muted);text-align:center;margin:2rem 0;">ستظهر معاينة المحتوى هنا</p>';
                loadReadMoreContent();
                setTimeout(() => readMoreContentSelect.focus(), 0);
            },

            closeModal() {
                readMoreModal.setAttribute('aria-hidden', 'true');
                document.documentElement.style.overflow = '';
            }
        };

        // Load read more content
        function loadReadMoreContent(searchTerm = '', sectionId = '') {
            try {
                let contentList = window.READ_MORE_DATA || [];
                if (window.CURRENT_CONTENT_ID) {
                    contentList = contentList.filter(item => item.id != window.CURRENT_CONTENT_ID);
                }
                if (sectionId && sectionId.trim()) {
                    contentList = contentList.filter(item => item.section_id == sectionId);
                }
                if (searchTerm && searchTerm.trim()) {
                    const search = searchTerm.trim().toLowerCase();
                    contentList = contentList.filter(item =>
                        (item.title && item.title.toLowerCase().includes(search)) ||
                        (item.summary && item.summary.toLowerCase().includes(search))
                    );
                }

                readMoreContentSelect.innerHTML = '<option value="">-- اختر محتوى --</option>';
                if (contentList.length === 0) {
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = searchTerm ? '-- لا توجد نتائج --' : '-- لا يوجد محتوى --';
                    readMoreContentSelect.appendChild(option);
                    return;
                }

                contentList.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.title;
                    option.dataset.category = item.category || '';
                    option.dataset.image = item.image_url || '';
                    option.dataset.summary = item.summary || '';
                    readMoreContentSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading content:', error);
                readMoreContentSelect.innerHTML = '<option value="">-- خطأ --</option>';
            }
        }

        // Event listeners for read more modal
        readMoreSectionSelect?.addEventListener('change', function(e) {
            const searchTerm = readMoreSearchInput.value || '';
            loadReadMoreContent(searchTerm, e.target.value || '');
        });

        let readMoreSearchTimeout;
        readMoreSearchInput?.addEventListener('input', function(e) {
            clearTimeout(readMoreSearchTimeout);
            readMoreSearchTimeout = setTimeout(() => {
                const sectionId = readMoreSectionSelect.value || '';
                loadReadMoreContent(e.target.value, sectionId);
            }, 300);
        });

        readMoreContentSelect?.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (!this.value) {
                readMorePreview.innerHTML = '<p style="color:var(--vvc-muted);text-align:center;margin:2rem 0;">ستظهر معاينة هنا</p>';
                return;
            }
            let html = '<div class="read-more-block" style="display:flex;border:2px solid #e0e0e0;border-radius:8px;overflow:hidden;background:#fff;">';
            html += '<span class="read-more-label-text" style="position:absolute;top:8px;left:8px;font-size:0.7rem;font-weight:600;color:#fff;background:#6576ff;padding:4px 12px;border-radius:12px;">اقرأ أيضاً</span>';
            if (selectedOption.dataset.image) {
                html += `<img src="${selectedOption.dataset.image}" alt="${selectedOption.textContent}" class="read-more-image" style="width:180px;height:150px;object-fit:cover;">`;
            }
            html += '<div class="read-more-content" style="flex:1;padding:1rem;display:flex;flex-direction:column;justify-content:center;">';
            if (selectedOption.dataset.category) {
                html += `<p class="read-more-category" style="font-size:0.75rem;color:#888;margin:0 0 0.5rem 0;">${selectedOption.dataset.category}</p>`;
            }
            html += `<h3 class="read-more-title" style="font-size:1.1rem;font-weight:700;margin:0 0 0.5rem 0;color:#2c3e50;">${selectedOption.textContent}</h3>`;
            if (selectedOption.dataset.summary) {
                html += `<p class="read-more-summary" style="color:#555;font-size:0.9rem;margin:0;">${selectedOption.dataset.summary}</p>`;
            }
            html += '</div></div>';
            readMorePreview.innerHTML = html;
        });

        // Update key from content
        function updateKeyFromContent() {
            const content = textContentInput.value.trim();
            const key = content.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]/g, '');
            textKeyInput.value = key || 'undefined';
        }

        textContentInput?.addEventListener('input', updateKeyFromContent);

        // Insert read more
        btnInsertReadMore?.addEventListener('click', () => {
            const contentId = readMoreContentSelect.value;
            if (!contentId) {
                alert('⚠️ يرجى اختيار محتوى من القائمة');
                return;
            }

            let html = `<div class="read-more-block mceNonEditable" data-content-id="${contentId}" contenteditable="false" style="border:2px dashed #6576ff;background:#f5f7fb;padding:0.75rem;margin:1rem 0;border-radius:6px;display:block;">`;
            html += '<span style="display:block;text-align:center;color:#6576ff;font-weight:600;">جاري تحميل المحتوى...</span>';
            html += '</div><p>&nbsp;</p>';

            if (window.tinymce && tinymce.activeEditor) {
                tinymce.activeEditor.focus();
                tinymce.activeEditor.execCommand('mceInsertContent', false, html);
            } else {
                alert('⚠️ محرر TinyMCE غير متاح');
                return;
            }
            window.vvcReadMoreModalManager.closeModal();
        });

        // Insert text
        btnInsertText?.addEventListener('click', () => {
            const content = textContentInput.value.trim();
            const key = textKeyInput.value.trim();
            const description = textDescriptionInput.value.trim();

            if (!content) {
                alert('⚠️ يرجى إدخال النص');
                return;
            }
            if (!description) {
                alert('⚠️ يرجى إدخال الوصف');
                return;
            }

            window.vvcTextModalManager.addTextDefinition(key, content, description, textModalState.selectedImagePath);

            if (textModalState.isEditMode && textModalState.editingElement) {
                textModalState.editingElement.textContent = content;
                textModalState.editingElement.setAttribute('data-term', key);
                textModalState.editingElement.setAttribute('data-description', description);
                if (window.tinymce && tinymce.activeEditor) {
                    tinymce.activeEditor.fire('change');
                }
            } else {
                if (window.tinymce && tinymce.activeEditor) {
                    tinymce.activeEditor.focus();
                    const escapedKey = key.replace(/"/g, '&quot;');
                    const escapedDesc = description.replace(/"/g, '&quot;');
                    tinymce.activeEditor.execCommand('mceInsertContent', false,
                        `<span class="clickable-term" data-term="${escapedKey}" data-description="${escapedDesc}">${content}</span>`);
                } else {
                    alert('⚠️ محرر TinyMCE غير متاح');
                    return;
                }
            }
            window.vvcTextModalManager.closeModal();
        });

        // Modal event listeners
        textBackdrop?.addEventListener('click', () => window.vvcTextModalManager.closeModal());
        textCloses?.forEach(b => b.addEventListener('click', () => window.vvcTextModalManager.closeModal()));
        textContainer?.addEventListener('click', e => e.stopPropagation());

        readMoreBackdrop?.addEventListener('click', () => window.vvcReadMoreModalManager.closeModal());
        readMoreCloses?.forEach(b => b.addEventListener('click', () => window.vvcReadMoreModalManager.closeModal()));
        readMoreContainer?.addEventListener('click', e => e.stopPropagation());

        // Keyboard shortcuts
        document.addEventListener('keydown', e => {
            if (textModal?.getAttribute('aria-hidden') === 'false' && e.key === 'Escape') {
                window.vvcTextModalManager.closeModal();
            }
            if (readMoreModal?.getAttribute('aria-hidden') === 'false' && e.key === 'Escape') {
                window.vvcReadMoreModalManager.closeModal();
            }
        });
    });
</script>
    // Utility function to escape HTML
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced theme detection
        function getPreferredTheme() {
            const stored = localStorage.getItem('theme');
            if (stored) return stored;
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        const theme = getPreferredTheme();

        tinymce.init({
            selector: 'textarea#itemDescription',
            directionality: 'rtl',
            height: 600,
            promotion: false,
            onboarding: false,
            auto_focus: false,
            // Custom CSS for editor content
            content_style: `
            body{font-family:Arial,Helvetica,sans-serif !important;font-size:18pt !important;line-height:1.6 !important;}
            img.tiny-sm,video.tiny-sm{width:280px;height:auto;max-width:100%;}

            /* Facebook embed block placeholder inside editor */
            .fb-embed-block{
                display:block;
                border:2px dashed #1877f2;
                background:#f5f7fb;
                padding:0.75rem 1rem;
                margin:1rem 0;
                border-radius:6px;
                text-align:center;
                font-size:0.9rem;
                color:#41516b;
                cursor:pointer;
            }
            .fb-embed-block .fb-embed-title{
                font-weight:700;
                margin-bottom:0.25rem;
            }
            .fb-embed-block .fb-embed-url{
                font-size:0.8rem;
                direction:ltr;
                unicode-bidi:bidi-override;
                word-break:break-all;
                color:#1877f2;
            }
            /* Hide actual fb-post markup inside editor; only show placeholder */
            .fb-embed-block .fb-post{
                display:none;
            }
            .clickable-term{color:#0066cc;text-decoration:underline;cursor:pointer;padding:2px 4px;border-radius:3px;transition:background-color 0.2s;background-color:transparent;}
            .clickable-term:hover{background-color:#e6f2ff;text-decoration:none;}

            /* ReadMore Block Container */
            .read-more-block{
                border:2px solid #e0e0e0;
                border-radius:8px;
                overflow:hidden;
                margin:1rem 0;
                background:#fff;
                box-shadow:0 2px 8px rgba(0,0,0,0.1);
                display:flex;
                align-items:stretch;
                position:relative;
                user-select:none;
                cursor:pointer;
                transition:all 0.2s ease;
            }
            .read-more-block:hover{
                box-shadow:0 4px 12px rgba(0,0,0,0.15);
                border-color:#6576ff;
            }

            /* ReadMore Label Badge */
            .read-more-block .read-more-label-text{
                position:absolute;
                top:8px;
                left:8px;
                font-size:0.7rem;
                font-weight:600;
                color:#fff;
                background:#6576ff;
                padding:4px 12px;
                border-radius:12px;
                z-index:10;
                box-shadow:0 2px 4px rgba(0,0,0,0.2);
            }

            /* ReadMore Image (Right Side) */
            .read-more-block .read-more-image{
                width:180px;
                min-width:180px;
                max-width:180px;
                height:auto;
                max-height:150px;
                object-fit:cover;
                order:2;
                flex-shrink:0;
            }

            /* ReadMore Content Area (Left Side) */
            .read-more-block .read-more-content{
                flex:1;
                padding:1rem;
                display:flex;
                flex-direction:column;
                justify-content:center;
                order:1;
                min-width:0;
            }

            /* Category Label */
            .read-more-block .read-more-category{
                font-size:0.75rem;
                color:#888;
                text-align:right;
                margin:0 0 0.5rem 0;
                font-weight:500;
            }

            /* Title */
            .read-more-block .read-more-title{
                font-size:1.1rem;
                font-weight:700;
                margin:0 0 0.5rem 0;
                color:#2c3e50;
                line-height:1.4;
                text-align:right;
            }

            /* Summary Text */
            .read-more-block .read-more-summary{
                color:#555;
                line-height:1.5;
                margin:0;
                font-size:0.9rem;
                text-align:right;
                overflow:hidden;
                display:-webkit-box;
                -webkit-line-clamp:2;
                -webkit-box-orient:vertical;
            }

            /* Placeholder (Loading State) */
            .read-more-block .read-more-placeholder{
                display:block;
                text-align:center;
                color:#6576ff;
                font-weight:600;
                font-size:0.95rem;
                padding:2rem;
                width:100%;
            }

            .mceNonEditable{outline:2px solid transparent;transition:outline-color 0.2s;}
            .mceNonEditable:focus,.mceNonEditable.mce-edit-focus{outline-color:#6576ff !important;}
            `,
            setup: (editor) => {
                // ---- READMORE LOADER FOR TINYMCE ----
                // Load and render ReadMore blocks inside TinyMCE editor
                function loadReadMoreBlocksInEditor() {
                    const editorBody = editor.getBody();
                    if (!editorBody) return;

                    const readMoreBlocks = editorBody.querySelectorAll('.read-more-block[data-content-id]:not([data-loaded])');

                    if (readMoreBlocks.length === 0) return;

                    console.log('Found ReadMore blocks in TinyMCE:', readMoreBlocks.length);

                    // Extract all content IDs
                    const contentIds = Array.from(readMoreBlocks).map(block => block.dataset.contentId);

                    // Batch fetch all ReadMore contents
                    fetch('/api/readmore-batch', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ids: contentIds })
                    })
                    .then(response => {
                        if (!response.ok) {
                            console.error('ReadMore API error:', response.status, response.statusText);
                            throw new Error(`Network response was not ok: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(result => {
                        console.log('ReadMore API response:', result);
                        if (result.success && result.data) {
                            // Replace each placeholder with actual content
                            readMoreBlocks.forEach(block => {
                                const contentId = block.dataset.contentId;
                                const contentData = result.data.find(item => item.id == contentId);

                                if (contentData) {
                                    console.log(`Rendering ReadMore card for ID: ${contentId}`, contentData);
                                    renderReadMoreCardInEditor(block, contentData);
                                    block.setAttribute('data-loaded', 'true');
                                } else {
                                    // Content not found
                                    const placeholder = block.querySelector('.read-more-placeholder');
                                    if (placeholder) {
                                        placeholder.textContent = 'محتوى غير موجود';
                                        placeholder.style.color = '#dc3545';
                                    }
                                    console.warn(`ReadMore content not found for ID: ${contentId}`);
                                }
                            });
                        } else {
                            console.error('Failed to load ReadMore content:', result.message || 'Unknown error');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching ReadMore content:', error);
                        readMoreBlocks.forEach(block => {
                            const placeholder = block.querySelector('.read-more-placeholder');
                            if (placeholder) {
                                placeholder.textContent = 'خطأ في تحميل المحتوى';
                                placeholder.style.color = '#dc3545';
                            }
                        });
                    });
                }

                // Render a ReadMore card with fetched data inside TinyMCE
                function renderReadMoreCardInEditor(placeholderBlock, contentData) {
                    // Set the shortlink data attribute for click handler
                    if (contentData.shortlink) {
                        placeholderBlock.setAttribute('data-shortlink', contentData.shortlink);
                    }

                    // Build the HTML for the ReadMore card content
                    let html = '<span class="read-more-label-text">اقرأ أيضاً</span>';

                    if (contentData.image_url) {
                        html += `<img src="${escapeHtml(contentData.image_url)}" alt="${escapeHtml(contentData.title)}" class="read-more-image">`;
                    }

                    html += '<div class="read-more-content">';

                    if (contentData.category) {
                        html += `<p class="read-more-category">${escapeHtml(contentData.category)}</p>`;
                    }

                    html += `<h3 class="read-more-title">${escapeHtml(contentData.title)}</h3>`;

                    if (contentData.summary) {
                        html += `<p class="read-more-summary">${escapeHtml(contentData.summary)}</p>`;
                    }

                    html += '</div>';

                    // Insert the content into the existing block
                    placeholderBlock.innerHTML = html;
                }

                // Load readmore blocks when editor content is set or changed
                editor.on('SetContent', function() {
                    setTimeout(loadReadMoreBlocksInEditor, 100);
                });

                // Load readmore blocks when editor is initialized
                editor.on('init', function() {
                    setTimeout(loadReadMoreBlocksInEditor, 100);
                });

                // ---- CLICKABLE TEXT DOUBLE-CLICK EDIT HANDLER ----
                // Track double-clicks manually since TinyMCE's dblclick event is unreliable with inline elements
                let lastClickTime = 0;
                let lastClickTarget = null;
                const DOUBLE_CLICK_DELAY = 500; // milliseconds

                editor.on('click', function(e) {
                    const target = e.target;
                    const currentTime = Date.now();

                    // Check if the clicked element is a clickable term
                    if (target.classList && target.classList.contains('clickable-term')) {
                        // Check if this is a double-click (same target within delay)
                        if (lastClickTarget === target && (currentTime - lastClickTime) < DOUBLE_CLICK_DELAY) {
                            e.preventDefault();
                            e.stopPropagation();

                            // Open modal in edit mode with the current element
                            if (window.vvcTextModalManager?.openModal) {
                                window.vvcTextModalManager.openModal(target);
                            }

                            // Reset tracking
                            lastClickTime = 0;
                            lastClickTarget = null;
                        } else {
                            // First click - track it
                            lastClickTime = currentTime;
                            lastClickTarget = target;
                        }
                    } else {
                        // Reset tracking if clicking elsewhere
                        lastClickTime = 0;
                        lastClickTarget = null;
                    }
                });

                // ---- MEDIA PICKER BUTTON ----
                editor.ui.registry.addButton('vvcPicker', {
                    text: 'وسائط',
                    tooltip: 'اختيار وسائط من المعرض',
                    onAction: async () => {
                        const picked = await window.pickMediaForTiny({
                            type: 'media'
                        });
                        if (!picked || !picked.url) return;
                        const isImg = /\.(png|jpe?g|webp|gif|bmp|svg)(\?|$)/i.test(picked.url);
                        editor.focus();
                        if (isImg) {
                            editor.execCommand('mceInsertContent', false,
                                `<figure class="image"><img class="tiny-sm" src="${escapeHtml(picked.url)}" alt="${escapeHtml(picked.alt||picked.title)}" title="${escapeHtml(picked.title)}"/><figcaption>${escapeHtml(picked.title)}</figcaption></figure>`
                            );
                        } else {
                            const u = picked.url;
                            const youtubeMatch = u.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/i);
                            const vimeoMatch = u.match(/vimeo\.com\/(\d+)/i);
                            if (youtubeMatch) {
                                const vid = youtubeMatch[1];
                                editor.execCommand('mceInsertContent', false,
                                    `<iframe class="tiny-sm" src="https://www.youtube.com/embed/${escapeHtml(vid)}" frameborder="0" allowfullscreen></iframe>`
                                );
                            } else if (vimeoMatch) {
                                const vid = vimeoMatch[1];
                                editor.execCommand('mceInsertContent', false,
                                    `<iframe class="tiny-sm" src="https://player.vimeo.com/video/${escapeHtml(vid)}" frameborder="0" allowfullscreen></iframe>`
                                );
                            } else {
                                editor.execCommand('mceInsertContent', false,
                                    `<video class="tiny-sm" src="${escapeHtml(picked.url)}" controls preload="metadata"></video>`
                                );
                            }
                        }
                    }
                });

                // ---- CLICKABLE TEXT BUTTON ----
                editor.ui.registry.addButton('vvcClickableText', {
                    text: 'نص تفاعلي',
                    tooltip: 'إضافة نص قابل للنقر',
                    onAction: () => {
                        if (window.vvcTextModalManager?.openModal) {
                            window.vvcTextModalManager.openModal();
                        }
                    }
                });

                // ---- READ MORE BUTTON ----
                editor.ui.registry.addButton('vvcReadMore', {
                    text: 'اقرأ المزيد',
                    tooltip: 'إدراج محتوى اقرأ المزيد',
                    onAction: () => {
                        if (window.vvcReadMoreModalManager?.openModal) {
                            window.vvcReadMoreModalManager.openModal();
                        }
                    }
                });

                // ---- FACEBOOK POST EMBED BUTTON ----
                editor.ui.registry.addButton('vvcFacebookPost', {
                    text: 'فيسبوك',
                    tooltip: 'إدراج منشور فيسبوك',
                    onAction: () => {
                        const url = window.prompt('أدخل رابط منشور فيسبوك');
                        if (!url) return;

                        const trimmedUrl = url.trim();
                        if (!trimmedUrl) return;

                        const safeUrl = escapeHtml(trimmedUrl);
                        const fbPostHtml = `
                            <div class="fb-embed-block mceNonEditable" contenteditable="false" data-fb-url="${safeUrl}" onclick="window.open('${safeUrl}', '_blank')" style="cursor: pointer;">
                                <div class="fb-embed-title">منشور فيسبوك</div>
                                <div class="fb-embed-url">${safeUrl}</div>
                                <div class="fb-post" data-href="${safeUrl}" data-show-text="false">
                                    <blockquote class="fb-xfbml-parse-ignore" cite="${safeUrl}">
                                        <a href="${safeUrl}" target="_blank" rel="noopener noreferrer">${safeUrl}</a>
                                    </blockquote>
                                </div>
                            </div>
                        `;

                        editor.insertContent(fbPostHtml);
                    }
                });

                // ---- CONTEXT MENU (Right-click) ----
                editor.ui.registry.addContextMenu('copy_cut_paste', {
                    predicate: (node) => true,
                    items: 'copy cut paste'
                });

                // ---- CONTEXT MENU ITEM FOR EDITING CLICKABLE TEXT ----
                editor.ui.registry.addMenuItem('editClickableText', {
                    text: 'تعديل النص التفاعلي',
                    icon: 'edit-block',
                    onAction: function() {
                        const selectedNode = editor.selection.getNode();
                        if (selectedNode && selectedNode.classList && selectedNode.classList.contains('clickable-term')) {
                            window.vvcTextModalManager.openModal(selectedNode);
                        }
                    }
                });

                // Add context menu for clickable text elements
                editor.ui.registry.addContextMenu('clickable_text', {
                    predicate: (node) => {
                        return node.classList && node.classList.contains('clickable-term');
                    },
                    items: 'editClickableText | copy cut paste'
                });

                // ---- CUSTOM PASTE BUTTON ----
                editor.ui.registry.addButton('vvcPaste', {
                    text: 'لصق',
                    tooltip: 'لصق من الحافظة (Ctrl+V)',
                    icon: 'paste',
                    onAction: () => {
                        navigator.clipboard.readText().then((text) => {
                            if (text) {
                                editor.execCommand('mceInsertContent', false, escapeHtml(
                                    text));
                            }
                        }).catch((err) => {
                            alert(
                                '⚠️ تعذّر الوصول إلى الحافظة. يرجى استخدام Ctrl+V بدلاً من ذلك.'
                            );
                            console.error('Clipboard access error:', err);
                        });
                    }
                });
            },
            // Theme configuration
            skin: theme === 'dark' ? 'oxide-dark' : 'oxide',
            content_css: theme === 'dark' ? 'dark' : 'default',
            // Plugins
            plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help hr image imagetools importcss insertdatetime link lists media nonbreaking noneditable pagebreak preview print save searchreplace table template visualblocks visualchars wordcount',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'wrap',
            // Toolbar configuration
            toolbar: [
                'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor',
                '| alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist',
                '| link table image media blockquote vvcPicker vvcClickableText vvcReadMore vvcFacebookPost vvcPaste',
                '| code fullscreen wordcount searchreplace | removeformat subscript superscript charmap emoticons insertdatetime pagebreak preview print template visualblocks visualchars help'
            ].join(' '),
            fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 36pt',
            font_family_formats: 'Arial=arial,helvetica,sans-serif; Helvetica=helvetica; Times New Roman=times new roman,times; Courier New=courier;',
            file_picker_types: 'image media',
            /**
             * Custom file picker for images and media
             */
            file_picker_callback: async (cb, value, meta) => {
                const picked = await window.pickMediaForTiny({
                    type: meta.filetype
                });
                if (!picked || !picked.url) return;
                if (meta.filetype === 'image') {
                    cb(picked.url, {
                        title: picked.title || '',
                        alt: picked.alt || '',
                        class: 'tiny-sm'
                    });
                } else {
                    cb(picked.url, {
                        text: picked.title || picked.url
                    });
                }
            },
            image_caption: true,
            image_title: true,
            image_advtab: true,
            menubar: 'file edit view insert format tools table help',
            // Context menu configuration
            contextmenu: 'copy cut vvcPaste | selectall',
            // Auto-save configuration
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            // Extended valid elements for custom HTML
            extended_valid_elements: 'script[src|async|charset],blockquote[class|lang|dir],iframe[src|width|height|frameborder|allowfullscreen|allow|scrolling|style]',
            valid_children: '+body[script],+div[script]',
            valid_elements: '*[*]'
        });
    });
</script>
