<script src="https://cdn.tiny.cloud/1/vw6sltzauw9x6b3cl3eby8nj99q4eoavzv581jnnmabxbhq2/tinymce/8/tinymce.min.js"
    referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    const theme = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';

    tinymce.init({
        selector: 'textarea#myeditorinstance',
        directionality: 'rtl',
        height: 600,
        promotion: false,
        onboarding: false,


        // 🚫 Disable automatic focus
        auto_focus: '',

        // Dark/light mode
        skin: theme === 'dark' ? 'oxide-dark' : 'oxide',
        content_css: theme === 'dark' ? 'dark' : 'default',

        // Plugins
        plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help hr image imagetools importcss insertdatetime link lists media nonbreaking pagebreak preview print quickbars save searchreplace table template visualblocks visualchars wordcount',

        // Show all tools without collapsing
        toolbar_mode: 'expand',

        // Toolbar (added twitterEmbed button)
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | code fullscreen wordcount searchreplace | link table image media blockquote twitterEmbed | bullist numlist | copy cut paste selectall pastetext | removeformat subscript superscript charmap emoticons insertdatetime pagebreak preview print template visualblocks visualchars help',

        // Font families & sizes (pt based)
        fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 36pt',
        font_family_formats: 'Arial=arial,helvetica,sans-serif; Helvetica=helvetica; Times New Roman=times new roman,times; Courier New=courier new,courier;',

        // Default style applied to content
        content_style: 'body { font-family: Arial, Helvetica, sans-serif; font-size:18pt; }',

        // Setup
        setup: (editor) => {
            // Default font on init
            editor.on('init', () => {
                editor.execCommand('FontName', false, 'Arial');
                editor.execCommand('FontSize', false, '18pt');
            });

            // ✅ Custom Twitter Embed button
            editor.ui.registry.addButton('twitterEmbed', {
                text: 'Twitter',
                tooltip: 'Embed Post',
                onAction: () => {
                    editor.windowManager.open({
                        title: 'Embed Post',
                        body: {
                            type: 'panel',
                            items: [{
                                type: 'textarea',
                                name: 'embed',
                                label: 'Paste Twitter embed code here'
                            }]
                        },
                        buttons: [{
                                type: 'cancel',
                                text: 'Cancel'
                            },
                            {
                                type: 'submit',
                                text: 'Insert',
                                primary: true
                            }
                        ],
                        onSubmit: (api) => {
                            const data = api.getData();
                            editor.insertContent(data
                                .embed); // Insert raw HTML at cursor
                            api.close();
                        }
                    });
                }
            });
        },

        // Allow image upload from device (base64 inline)
        file_picker_types: 'image',
        file_picker_callback: (cb, value, meta) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function() {
                const file = this.files[0];
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
        importcss_append: true,
        image_caption: true,
        noneditable_class: 'mceNonEditable',
        contextmenu: 'link image table',

        // 🚀 Allow Twitter / embed tags
        extended_valid_elements: 'script[src|async|charset],blockquote[class|lang|dir],iframe[src|width|height|frameborder|allowfullscreen]',
        valid_children: '+body[script],+div[script]',
        valid_elements: '*[*]'
    });
</script>
