<script src="https://cdn.tiny.cloud/1/2ybotr2gj2jba7rs525xlvymht3kg2qv4833vglziifs7kj8/tinymce/8/tinymce.min.js"
    referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    const theme = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';

    tinymce.init({
        directionality: 'rtl',
        height: 600,
        promotion: false,
        onboarding: false,
        skin: theme === 'dark' ? 'oxide-dark' : 'oxide',
        content_css: theme === 'dark' ? 'dark' : 'default',
        selector: 'textarea#myeditorinstance',
        plugins: 'advlist anchor autolink  autosave charmap code codesample directionality emoticons fullscreen help hr image imagetools importcss insertdatetime link lists media nonbreaking pagebreak preview print quickbars save searchreplace table template visualblocks visualchars wordcount ',
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist checklist | link image media table template charmap emoticons hr pagebreak codesample | forecolor backcolor removeformat | searchreplace | wordcount | fullscreen | code | preview print'
    });
</script>
