<!DOCTYPE html>
<html lang="ar" data-bs-theme="white" lang="zxx" class="js">

<head>
    <link rel="icon" type="image/svg+xml" href="{{ asset('user/assets/images/icon-logo.svg') }}" />
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./dashliteimages/favicon.png">
    <!-- Page Title  -->
    <title> @yield('title')</title>
    <!-- StyleSheets  -->
    <style>
        body {
            display: none;
        }
    </style>
    <link id="rtl-style" rel="stylesheet" href="./dashlite/assets/css/dashlite.rtl.css" media="not all">
    <link id="ltr-style" rel="stylesheet" href="./dashlite/assets/css/dashlite.css" media="all">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link id="skin-default" rel="stylesheet" href="./dashlite/assets/css/skins/theme-egyptian.css?ver=3.3.0">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-91615293-4');
    </script>
    <link rel="stylesheet" href="/dashlite/assets/css/editors/tinymce.css?ver=3.3.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Optional: a nice theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />



</head>

<body class="nk-body bg-lighter npc-general has-sidebar ui-clean">


    @yield('content')



    <!-- JavaScript -->
    <script src="./rtl.js"></script>

    <script src="./dashlite/assets/js/bundle.js?ver=3.3.0"></script>
    <script src="./dashlite/assets/js/scripts.js?ver=3.3.0"></script>
    <script src="./dashlite/assets/js/charts/gd-default.js?ver=3.3.0"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const forms = document.querySelectorAll("validate-form-on-submit");

            // Detect current language
            const currentLang = localStorage.getItem('siteLang') || 'en';

            // Texts for both languages
            const alertTexts = {
                en: {
                    title: "Missing Required Fields",
                    text: "Please fill in all required fields before submitting.",
                    confirmButtonText: "OK"
                },
                ar: {
                    title: "حقول مطلوبة مفقودة",
                    text: "يرجى ملء جميع الحقول المطلوبة قبل الإرسال.",
                    confirmButtonText: "حسناً"
                }
            };

            forms.forEach(form => {
                form.addEventListener("submit", function(e) {
                    const requiredInputs = form.querySelectorAll("[required]");
                    let allFilled = true;
                    requiredInputs.forEach(input => {
                        if (!input.value.trim()) {
                            allFilled = false;
                        }
                    });

                    if (!allFilled) {
                        e.preventDefault();
                        Swal.fire({
                            title: alertTexts[currentLang].title,
                            text: alertTexts[currentLang].text,
                            icon: "warning",
                            confirmButtonText: alertTexts[currentLang].confirmButtonText
                        });
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll(".delete-btn");

            // Detect current language
            const currentLang = localStorage.getItem('siteLang') || 'en';

            // Texts for both languages
            const alertTexts = {
                en: {
                    title: "Are you sure?",
                    text: "You won't be able to undo this!",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                },
                ar: {
                    title: "هل أنت متأكد؟",
                    text: "لن تتمكن من التراجع عن هذا الإجراء!",
                    confirmButtonText: "نعم، احذف!",
                    cancelButtonText: "إلغاء"
                }
            };

            deleteButtons.forEach(button => {
                button.addEventListener("click", function() {
                    let form = this.closest("form");

                    Swal.fire({
                        title: alertTexts[currentLang].title,
                        text: alertTexts[currentLang].text,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: alertTexts[currentLang].confirmButtonText,
                        cancelButtonText: alertTexts[currentLang].cancelButtonText
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>


    {{-- <script src="https://cdn.tiny.cloud/1/qwcigpkrm410kyux7b6j7rhygc758v6hviqqvkgf4878s508/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#editor',
                height: 400,
                plugins: 'code link image table lists exportpdf',
                toolbar: 'undo redo | exportpdf | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',

                // (اختياري) إعدادات إضافية للتصدير
                exportpdf_converter_options: {
                    format: 'A4',
                    margin_top: '1in',
                    margin_right: '1in',
                    margin_bottom: '1in',
                    margin_left: '1in'
                },

                // (اختياري) إذا كان عندك سيرفر JWT
                exportpdf_token_provider: () => {
                    return fetch('http://localhost:3000/jwt', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                    }).then(response => response.json());
                }
            });
        </script>
    --}}

    @include('components.head.tinymce-config')

    {{-- ================= DYNAMIC READMORE LOADER ================= --}}
    @include('components.readmore-loader')

    @stack('scripts')
</body>

</html>
