<!DOCTYPE html>
<html lang="ar" lang="zxx" class="js">

<head>
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



    <link id="skin-default" rel="stylesheet" href="./dashlite/assets/css/theme.css?ver=3.3.0">

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

</head>

<body class="nk-body bg-lighter npc-general has-sidebar">


    @yield('content')



    <!-- JavaScript -->
    <script src="./rtl.js"></script>

    <script src="./dashlite/assets/js/bundle.js?ver=3.3.0"></script>
    <script src="./dashlite/assets/js/scripts.js?ver=3.3.0"></script>
    <script src="./dashlite/assets/js/charts/gd-default.js?ver=3.3.0"></script>

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
    @stack('scripts')


</body>

</html>
