@once
    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/qwcigpkrm410kyux7b6j7rhygc758v6hviqqvkgf4878s508/tinymce/8/tinymce.min.js"
            referrerpolicy="origin" crossorigin="anonymous"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (document.querySelector('#myeditorinstance')) {
                    tinymce.init({
                        selector: '#myeditorinstance',
                        plugins: 'code table lists',
                        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
                    });
                }
            });
        </script>
    @endpush
@endonce
