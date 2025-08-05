@once
    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/qwcigpkrm410kyux7b6j7rhygc758v6hviqqvkgf4878s508/tinymce/8/tinymce.min.js"
            referrerpolicy="origin" crossorigin="anonymous"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (document.querySelector('#myeditorinstance')) {
                    tinymce.init({
                        selector: '#myeditorinstance',
                        height: 500,
                        plugins: [
                            'print preview paste importcss searchreplace autolink autosave save directionality',
                            'code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak',
                            'nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable',
                            'help charmap emoticons export'
                        ],
                        toolbar: [
                            'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect',
                            'alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat',
                            'pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample',
                            'ltr rtl | searchreplace visualblocks visualchars code | table | export'
                        ].join(' | '),
                        menubar: 'file edit view insert format tools table help',
                        toolbar_sticky: true,

                        /* Image upload */
                        images_upload_url: '/upload/image', // Your Laravel route for uploads
                        automatic_uploads: true,
                        file_picker_types: 'image',
                        file_picker_callback: function(cb, value, meta) {
                            let input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/*');

                            input.onchange = function() {
                                let file = this.files[0];
                                let reader = new FileReader();
                                reader.onload = function() {
                                    let id = 'blobid' + (new Date()).getTime();
                                    let blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                    let base64 = reader.result.split(',')[1];
                                    let blobInfo = blobCache.create(id, file, base64);
                                    blobCache.add(blobInfo);
                                    cb(blobInfo.blobUri(), {
                                        title: file.name
                                    });
                                };
                                reader.readAsDataURL(file);
                            };
                            input.click();
                        },

                        /* Content CSS */
                        content_css: [
                            '//www.tiny.cloud/css/codepen.min.css'
                        ],

                        /* Export options */
                        export_pdf: true,
                        export_word: true,

                        /* Advanced options */
                        branding: false,
                        promotion: false,
                        resize: true
                    });

                }
            });
        </script>
    @endpush
@endonce
