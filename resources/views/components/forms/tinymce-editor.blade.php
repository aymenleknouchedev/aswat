{{-- resources/views/components/forms/tinymce-editor.blade.php --}}
@props(['id' => 'myeditorinstance', 'name' => 'content', 'value' => ''])

<textarea id="{{ $id }}" name="{{ $name }}" rows="10">{{ old($name, $value) }}</textarea>

@once
    <script src="https://cdn.tiny.cloud/1/qwcigpkrm410kyux7b6j7rhygc758v6hviqqvkgf4878s508/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const id = '{{ $id }}';

            function initTiny() {
                if (!document.querySelector('#' + id)) return;

                // remove existing instance if present (prevents duplication)
                if (window.tinymce && tinymce.get(id)) {
                    tinymce.get(id).remove();
                }

                tinymce.init({
                    selector: '#' + id,
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

                    /* Image upload - change URL to your route */
                    images_upload_url: '/upload/image',
                    automatic_uploads: true,
                    file_picker_types: 'image',
                    file_picker_callback: function(cb, value, meta) {
                        let input = document.createElement('input');
                        input.type = 'file';
                        input.accept = 'image/*';
                        input.onchange = function() {
                            let file = this.files[0];
                            let reader = new FileReader();
                            reader.onload = function() {
                                let idb = 'blobid' + (new Date()).getTime();
                                let blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                let base64 = reader.result.split(',')[1];
                                let blobInfo = blobCache.create(idb, file, base64);
                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), {
                                    title: file.name
                                });
                            };
                            reader.readAsDataURL(file);
                        };
                        input.click();
                    },

                    content_css: ['//www.tiny.cloud/css/codepen.min.css'],
                    export_pdf: true,
                    export_word: true,
                    branding: false,
                    promotion: false,
                    resize: true
                });
            }

            // initial init
            initTiny();

            // re-init after Livewire updates
            if (window.Livewire) {
                Livewire.hook('message.processed', () => {
                    initTiny();
                });
            }
        });
    </script>
@endonce
