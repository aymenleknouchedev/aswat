<!-- ======================= TinyMCE 6 Configuration for Item Modal ======================= -->
<script src="https://cdn.tiny.cloud/1/vw6sltzauw9x6b3cl3eby8nj99q4eoavzv581jnnmabxbhq2/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
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

            // 🚫 Disable auto focus
            auto_focus: '',

            // Dark/light mode
            skin: theme === 'dark' ? 'oxide-dark' : 'oxide',
            content_css: theme === 'dark' ? 'dark' : 'default',

            // Plugins
            plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print save searchreplace table visualblocks visualchars wordcount',

            // Show all tools without collapsing
            toolbar_mode: 'expand',

            // Toolbar (added twitterEmbed button)
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | code fullscreen wordcount searchreplace | link table image media blockquote twitterEmbed | bullist numlist | copy cut paste selectall pastetext | removeformat subscript superscript charmap emoticons insertdatetime pagebreak preview print visualblocks visualchars help',

            // Font families & sizes (pt based)
            fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 36pt',
            font_family_formats: 'Arial=arial,helvetica,sans-serif; Helvetica=helvetica; Times New Roman=times new roman,times; Courier New=courier new,courier;',

            // Default style applied to content
            content_style: 'body { font-family: Arial, Helvetica, sans-serif; font-size:18pt; line-height:1.6; }',

            // Setup - FIXED with skip_focus
            setup: (editor) => {
                // Default font on init - USING skip_focus: true
                editor.on('init', () => {
                    editor.execCommand('FontName', false, 'Arial', {
                        skip_focus: true
                    });
                    editor.execCommand('FontSize', false, '18pt', {
                        skip_focus: true
                    });
                });

                // ✅ Enhanced Twitter Embed button with validation
                editor.ui.registry.addButton('twitterEmbed', {
                    text: 'Twitter',
                    tooltip: 'Embed Twitter Post',
                    onAction: () => {
                        editor.windowManager.open({
                            title: 'Embed Twitter Post',
                            body: {
                                type: 'panel',
                                items: [{
                                    type: 'textarea',
                                    name: 'embed',
                                    label: 'Paste Twitter embed code here',
                                    placeholder: '<blockquote class="twitter-tweet">...</blockquote>'
                                }]
                            },
                            buttons: [{
                                    type: 'cancel',
                                    text: 'Cancel'
                                },
                                {
                                    type: 'submit',
                                    text: 'Insert',
                                    primary: true,
                                    enabled: false
                                }
                            ],
                            onChange: (api) => {
                                const data = api.getData();
                                const isValid = data.embed.includes(
                                    'twitter-tweet');
                                api.blocking.set('submit', !isValid);
                            },
                            onSubmit: (api) => {
                                const data = api.getData();
                                const embedCode = data.embed.trim();

                                // Enhanced validation for Twitter embed
                                if (!embedCode.includes('twitter-tweet')) {
                                    editor.windowManager.alert(
                                        'Please enter a valid Twitter embed code containing "twitter-tweet"'
                                    );
                                    return;
                                }

                                editor.insertContent(embedCode, {
                                    skip_focus: true
                                });
                                api.close();
                            }
                        });
                    }
                });
            },

            // Security enhancement
            paste_preprocess: (plugin, args) => {
                // Clean pasted content from potential XSS
                args.content = args.content.replace(
                    /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
            },

            // Enhanced file upload with size validation
            file_picker_types: 'image',
            file_picker_callback: (cb, value, meta) => {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    const file = this.files[0];

                    // File size validation (5MB limit)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('File size too large. Please select a file smaller than 5MB.');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function() {
                        const id = 'blobid' + (new Date()).getTime();
                        const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        const base64 = reader.result.split(',')[1];
                        const blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },

            // Menubar
            menubar: 'file edit view insert format tools table help',

            // Other settings
            editimage_cors_hosts: ['picsum.photos'],
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            image_caption: true,
            noneditable_class: 'mceNonEditable',
            contextmenu: 'link image table',

            // 🚀 Allow Twitter / embed tags
            extended_valid_elements: 'script[src|async|charset],blockquote[class|lang|dir],iframe[src|width|height|frameborder|allowfullscreen]',
            valid_children: '+body[script],+div[script]',
            valid_elements: '*[*]',

            // Remove branding for better UX
            branding: false
        }).catch(error => {
            console.error('TinyMCE initialization error:', error);
        });
    });

    // Theme toggle function (if needed elsewhere)
    function toggleTheme() {
        const currentTheme = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', newTheme);
        location.reload();
    }
</script>
