<!DOCTYPE html>
<html lang="ar" dir="rtl" data-bs-theme="white" class="js">

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
    <link id="rtl-style" rel="stylesheet" href="./dashlite/assets/css/dashlite.rtl.css" media="all">
    <link id="ltr-style" rel="stylesheet" href="./dashlite/assets/css/dashlite.css" media="not all">

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
    <script src="{{ asset('js/upload-helper.js') }}?v=1"></script>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Optional: a nice theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    {{-- ===== GLOBAL MOBILE FIXES FOR ALL MEDIA / GALLERY MODALS ===== --}}
    <style>
        /* Full-screen images/media modals on mobile (covers all custom modal wrappers) */
        @media (max-width: 768px) {
            .xmm-modal[aria-hidden="false"],
            .mmm-modal[aria-hidden="false"],
            .mmx-modal[aria-hidden="false"],
            .mmxc-modal[aria-hidden="false"],
            .mmxx-modal[aria-hidden="false"] {
                position: fixed !important;
                inset: 0 !important;
                z-index: 10050 !important;
                background: #fff !important;
            }
            /* Hide the backdrop since the container already fills the screen */
            .xmm-modal .xmm-backdrop,
            .mmm-modal .mmm-backdrop,
            .mmx-modal .mmx-backdrop,
            .mmxc-modal .mmxc-backdrop,
            .mmxx-modal .mmxx-backdrop { display: none !important; }

            /* Force every container variant to fill the viewport, beating the
               doubled-class !important `width: clamp(...)` rules with matching specificity. */
            .xmm-modal.xmm-modal.xmm-modal .xmm-container,
            .mmm-modal.mmm-modal.mmm-modal .mmm-container,
            .mmx-modal.mmx-modal.mmx-modal .mmx-container,
            .mmxc-modal.mmxc-modal.mmxc-modal .mmxc-container,
            .mmxx-modal.mmxx-modal.mmxx-modal .mmxx-container,
            #xmmMediaModal.xmm-modal .xmm-container,
            #mmmMediaModal.mmm-modal .mmm-container,
            #mmxMediaModal.mmx-modal .mmx-container,
            #mmxcMediaModal.mmxc-modal .mmxc-container,
            #mmxxMediaModal.mmxx-modal .mmxx-container {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                margin: 0 !important;
                transform: none !important;
                width: 100vw !important;
                max-width: 100vw !important;
                height: 100vh !important;
                max-height: 100vh !important;
                min-height: 100vh !important;
                border: 0 !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                display: flex !important;
                flex-direction: column !important;
                overflow: hidden !important;
            }

            /* Make the inner scroll area take remaining height */
            .xmm-modal .xmm-body,
            .mmm-modal .mmm-body,
            .mmx-modal .mmx-body,
            .mmxc-modal .mmxc-body,
            .mmxx-modal .mmxx-body { flex: 1 1 auto !important; overflow-y: auto !important; min-height: 0 !important; }

            /* Bootstrap modals → full screen too */
            .modal.show .modal-dialog { margin: 0 !important; max-width: 100% !important; min-height: 100vh !important; }
            .modal.show .modal-content { border-radius: 0 !important; min-height: 100vh !important; border: 0 !important; }
            .modal-backdrop.show { opacity: 1 !important; background: #fff !important; }
        }
    </style>
    <style>
        /* Lock horizontal overflow site-wide on phones — fixes content being pushed off-screen */
        @media (max-width: 768px) {
            html, body { overflow-x: hidden !important; max-width: 100vw !important; }
            /* Neutralize ancestor transforms / filters that hijack position:fixed containing blocks */
            .nk-app-root, .nk-main, .nk-wrap, .nk-content, .nk-content-inner,
            .nk-content-body, .nk-block, body > div, body > main {
                transform: none !important;
                filter: none !important;
                perspective: none !important;
                will-change: auto !important;
                contain: none !important;
            }
            .nk-app-root, .nk-main, .nk-wrap, .nk-content, .nk-content-inner,
            .nk-content-body, .nk-block, .container, .container-fluid {
                max-width: 100vw !important;
                overflow-x: hidden !important;
                box-sizing: border-box !important;
            }
            /* Bootstrap row negative margins blow out small viewports */
            .row { margin-left: 0 !important; margin-right: 0 !important; }
            .row > [class^="col-"], .row > [class*=" col-"] {
                padding-left: 6px !important;
                padding-right: 6px !important;
                max-width: 100% !important;
            }
            /* Tab bars: scrollable instead of overflowing */
            .nav-tabs, .nav.nav-tabs {
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                overflow-y: hidden !important;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }
            .nav-tabs::-webkit-scrollbar { display: none; }
            .nav-tabs .nav-item, .nav-tabs .nav-link { flex-shrink: 0 !important; white-space: nowrap !important; }

            /* Generic input sanity caps for the whole dashboard */
            .form-control, input.form-control, textarea.form-control, select.form-control {
                max-width: 100% !important;
                box-sizing: border-box !important;
            }

            /* ===== TABLES: horizontal scroll on phones ===== */
            .table-responsive,
            .nk-tb-list,
            .card-inner > .table,
            .card-body > .table {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch;
            }
            /* Tables that aren't wrapped in .table-responsive: scroll their parent */
            .card-inner, .card-body, .nk-block { max-width: 100% !important; }
            .card-inner > table, .card-body > table {
                display: block !important;
                overflow-x: auto !important;
                white-space: nowrap !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
            /* Inside .table-responsive don't force nowrap on the table itself */
            .table-responsive .table { white-space: nowrap !important; min-width: 600px; }
            .table th, .table td { font-size: 13px !important; padding: 8px !important; }

            /* ===== PAGINATION: compact + wrap on phones ===== */
            .pagination {
                flex-wrap: wrap !important;
                justify-content: center !important;
                gap: 4px !important;
                row-gap: 6px !important;
                margin: 12px 0 !important;
                padding: 0 !important;
            }
            .pagination .page-item { margin: 0 !important; }
            .pagination .page-link {
                padding: 5px 9px !important;
                font-size: 13px !important;
                min-width: 32px !important;
                line-height: 1.2 !important;
            }
            /* Hide some ellipsis-padding numbers on tiny screens */
            nav[role="navigation"] svg { width: 14px !important; height: 14px !important; }

            /* ===== Generic page wrappers tighter on mobile ===== */
            .nk-block-head .nk-block-head-content,
            .nk-block-head .nk-block-tools { width: 100% !important; }
            .nk-block-head { padding: 12px 0 !important; }
            .nk-block-title, h3.nk-block-title, .page-title { font-size: 18px !important; line-height: 1.3 !important; }
            .nk-block-des, .page-subtitle { font-size: 13px !important; }

            /* Action button rows wrap */
            .nk-block-tools, .btn-group {
                flex-wrap: wrap !important;
                gap: 6px !important;
            }

            /* Breadcrumbs scroll horizontally */
            .breadcrumb {
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                white-space: nowrap !important;
            }
            .breadcrumb::-webkit-scrollbar { display: none; }

            /* Cards: full width without negative margins */
            .card { margin-left: 0 !important; margin-right: 0 !important; width: 100% !important; }

            /* Stats / data tiles: stack instead of overflow */
            .nk-data-list, .data-list { flex-wrap: wrap !important; }

            /* Buttons: make tap targets reasonable but not giant */
            .btn { padding: 8px 12px !important; font-size: 14px !important; }
            .btn-lg { padding: 9px 14px !important; font-size: 15px !important; }
        }

        @media (max-width: 480px) {
            .pagination .page-link { padding: 4px 7px !important; font-size: 12px !important; min-width: 28px !important; }
            .table th, .table td { font-size: 12px !important; padding: 6px !important; }
            .nk-block-title, h3.nk-block-title, .page-title { font-size: 16px !important; }
        }

        @media (max-width: 768px) {
            [id$="MediaModal"] .mmm-modal-dialog,
            [id$="MediaModal"] .mmx-modal-dialog,
            [id$="MediaModal"] .mmxx-modal-dialog,
            [id$="MediaModal"] .mmxc-modal-dialog,
            [id$="MediaModal"] .xmm-modal-dialog,
            [id$="MediaModal"] > div,
            [id$="MediaModal"] .modal-dialog,
            #itemModal .modal-dialog {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                border-radius: 0 !important;
                max-height: 100vh !important;
                height: 100vh !important;
            }
            [id$="MediaModal"] .modal-body,
            #itemModal .modal-body { padding: 10px !important; overflow-y: auto; }

            [id$="MediaModal"] .mmm-grid,
            [id$="MediaModal"] .mmx-grid,
            [id$="MediaModal"] .mmxx-grid,
            [id$="MediaModal"] .mmxc-grid,
            [id$="MediaModal"] .xmm-grid {
                grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)) !important;
                gap: 6px !important;
            }
            [id$="MediaModal"] .mmm-thumb,
            [id$="MediaModal"] .mmx-thumb,
            [id$="MediaModal"] .mmxx-thumb,
            [id$="MediaModal"] .mmxc-thumb,
            [id$="MediaModal"] .xmm-thumb { height: 100px !important; }

            [id$="MediaModal"] .mmm-toolbar,
            [id$="MediaModal"] .mmx-toolbar,
            [id$="MediaModal"] .mmxx-toolbar,
            [id$="MediaModal"] .mmxc-toolbar,
            [id$="MediaModal"] .xmm-toolbar,
            [id$="MediaModal"] .mmm-tabs,
            [id$="MediaModal"] .mmx-tabs,
            [id$="MediaModal"] .mmxx-tabs,
            [id$="MediaModal"] .mmxc-tabs,
            [id$="MediaModal"] .xmm-tabs { flex-wrap: wrap !important; gap: 6px !important; }

            [id$="MediaModal"] input,
            [id$="MediaModal"] select,
            [id$="MediaModal"] textarea { font-size: 14px !important; }
        }
        @media (max-width: 420px) {
            [id$="MediaModal"] .mmm-grid,
            [id$="MediaModal"] .mmx-grid,
            [id$="MediaModal"] .mmxx-grid,
            [id$="MediaModal"] .mmxc-grid,
            [id$="MediaModal"] .xmm-grid {
                grid-template-columns: repeat(auto-fill, minmax(90px, 1fr)) !important;
            }
            [id$="MediaModal"] .mmm-thumb,
            [id$="MediaModal"] .mmx-thumb,
            [id$="MediaModal"] .mmxx-thumb,
            [id$="MediaModal"] .mmxc-thumb,
            [id$="MediaModal"] .xmm-thumb { height: 80px !important; }
        }
    </style>

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
