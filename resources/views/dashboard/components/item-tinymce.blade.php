<!-- ======================= TinyMCE 6 Configuration for Item Modal (Advanced) ======================= -->
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
