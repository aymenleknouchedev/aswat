<script src="https://cdn.tiny.cloud/1/qwcigpkrm410kyux7b6j7rhygc758v6hviqqvkgf4878s508/tinymce/8/tinymce.min.js"
    referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    const theme = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';

    tinymce.init({
        height: 600,
        promotion: false,
        onboarding: false,
        skin: theme === 'dark' ? 'oxide-dark' : 'oxide',
        content_css: theme === 'dark' ? 'dark' : 'default',
        selector: 'textarea#myeditorinstance',
        plugins: 'advlist anchor autolink  autosave charmap code codesample directionality emoticons fullscreen help hr image imagetools importcss insertdatetime link lists media nonbreaking pagebreak preview print quickbars save searchreplace table template visualblocks visualchars wordcount export',
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist checklist | link image media table template charmap emoticons hr pagebreak codesample | forecolor backcolor removeformat | searchreplace | export | wordcount | fullscreen | code | preview print'
    });
</script>
