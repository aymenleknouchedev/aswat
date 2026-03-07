@extends('layouts.index')

@section('title', 'اتصل بنا | أصوات جزائرية')

@section('content')
    <style>
        .web {
            display: block !important;
        }

        .mobile {
            display: none !important;
        }

        .contact-page .title {
            margin-bottom: 24px;
        }

        .contact-page h1 {
            font-size: 32px;
            font-family: 'asswat-bold';
            margin: 0 0 8px 0;
        }

        .contact-page p.lead {
            margin: 0 0 24px 0;
            color: #555;
            font-size: 16px;
        }

        .contact-form {
            max-width: 640px;
            margin: 0 auto;
            direction: rtl;
        }

        .contact-form .form-group {
            margin-bottom: 16px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-family: 'asswat-medium';
        }

        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 14px;
            font-family: 'asswat-regular';
        }

        .contact-form textarea {
            min-height: 140px;
            resize: vertical;
        }

        .contact-form button[type="submit"] {
            padding: 10px 24px;
            background-color: #252525;
            color: #fff;
            border: none;
            font-family: 'asswat-medium';
            cursor: pointer;
            transition: .2s ease;
        }

        .contact-form button[type="submit"]:hover {
            background-color: #000;
        }

        .contact-form .error {
            color: #c00;
            font-size: 13px;
            margin-top: 4px;
        }

        .contact-form .status {
            margin-bottom: 16px;
            padding: 10px 12px;
            background: #e6f4ea;
            color: #1e7e34;
            font-size: 14px;
        }

        .contact-form .name-row {
            display: flex;
            gap: 12px;
        }

        .contact-form .name-row .form-group {
            flex: 1;
        }

        .file-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 10px 14px;
            border: 1px solid #ddd;
            background: #fafafa;
            cursor: pointer;
            border-radius: 4px;
            transition: background .15s ease, border-color .15s ease;
        }

        .file-input-wrapper:hover {
            background: #f0f0f0;
            border-color: #ccc;
        }

        .file-input-wrapper .primary-text {
            font-size: 14px;
            font-family: 'asswat-medium';
        }

        .file-input-wrapper .secondary-text {
            font-size: 12px;
            color: #777;
        }

        #files {
            display: none;
        }

        .file-hint {
            margin-top: 4px;
            font-size: 12px;
            color: #777;
        }

        .file-list {
            margin-top: 6px;
            font-size: 13px;
            color: #444;
        }

        .file-list span {
            display: block;
            background: #f3f3f3;
            border-radius: 12px;
            padding: 4px 10px;
            margin: 2px 0;
            direction: ltr;
        }

        .btn-sub {
            margin-bottom: 60px;
        }

        .required {
            color: #c00;
            font-weight: bold;
        }

        @media (max-width: 992px) {
            .web {
                display: none !important;
            }

            .mobile {
                display: block !important;
            }

            .mobile-contact-form {
                padding: 16px;
                margin-top: 68px;
                direction: rtl;
            }

            .mobile-contact-form .form-group {
                margin-bottom: 12px;
            }

            .mobile-contact-form label {
                display: block;
                margin-bottom: 4px;
                font-size: 12px;
                font-family: 'asswat-medium';
            }

            .mobile-contact-form input[type="text"],
            .mobile-contact-form input[type="email"],
            .mobile-contact-form textarea {
                width: 100%;
                padding: 8px 10px;
                border: 1px solid #ddd;
                font-size: 13px;
                font-family: 'asswat-regular';
                box-sizing: border-box;
            }

            .mobile-contact-form textarea {
                min-height: 100px;
            }

            .mobile-contact-form button[type="submit"] {
                width: 100%;
                padding: 10px;
                background-color: #252525;
                color: #fff;
                border: none;
                font-family: 'asswat-medium';
                cursor: pointer;
                font-size: 14px;
                margin-bottom: 80px;
            }

            .mobile-contact-header {
                padding: 16px;
                text-align: center;
                direction: rtl;
                border-bottom: 1px solid #ddd;
            }

            .mobile-contact-header h1 {
                font-size: 24px;
                font-family: 'asswat-bold';
                margin: 0 0 8px 0;
            }

            .mobile-contact-header p {
                font-size: 14px;
                color: #666;
                margin: 0;
                font-family: 'asswat-regular';
            }
        }
    </style>

    <style>
        @media (max-width: 992px) {
            .web {
                display: none !important;
            }

            .mobile {
                display: block !important;
            }
        }
    </style>

    <div class="web">
        @include('user.components.fixed-nav')

        <div class="container">
            <div class="title" dir="rtl">
                <h1>اتصل بنا</h1>
                <p class="lead">للتواصل يرجى تعبئة الاستمارة</p>
            </div>

            <div class="contact-form" dir="rtl">
                @if (session('status'))
                    <div class="status">{{ session('status') }}</div>
                @endif

                <form id="contact-form" action="{{ route('contact-us.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="name-row">
                        <div class="form-group">
                            <label for="first_name">الاسم <span class="required">*</span></label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}">
                            @error('first_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">اللقب <span class="required">*</span></label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}">
                            @error('last_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الإلكتروني <span class="required">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject">الموضوع <span class="required">*</span></label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
                        @error('subject')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">الوصف <span class="required">*</span></label>
                        <textarea id="description" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="files">ملفات (اختياري)</label>
                        <label class="file-input-wrapper" for="files">
                            <span class="primary-text" id="files-label">اختيار ملفات</span>
                            <span class="secondary-text">يمكنك اختيار أكثر من ملف</span>
                        </label>
                        <input type="file" id="files" name="files[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <div class="file-hint">يمكنك إرفاق عدة ملفات (حد أقصى 10 ميغابايت لكل ملف).</div>
                        <div id="files-list" class="file-list"></div>
                        @error('files.*')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn-sub" type="submit">إرسال</button>
                </form>
            </div>
        </div>

        @include('user.components.footer')
    </div>

    <div class="mobile">
        @include('user.mobile.mobile-home')

        <!-- Grey navigation bar -->
        <div id="greybar"
            style="background-color: #252525; height: 68px; position: fixed; top: 0; left: 0; right: 0; z-index: 10;">
        </div>

        <!-- Mobile Contact Us Content -->
        <div class="mobile-flow">
            <div class="mobile-container" style="margin-top: 68px;">
                <div class="mobile-contact-header">
                    <h1>اتصل بنا</h1>
                    <p>للتواصل يرجى تعبئة الاستمارة</p>
                </div>

                <div class="mobile-contact-form">
                    @if (session('status'))
                        <div style="background: #e6f4ea; color: #1e7e34; padding: 10px 12px; margin-bottom: 12px; font-size: 12px;">{{ session('status') }}</div>
                    @endif

                    <form id="contact-form-mobile" action="{{ route('contact-us.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="first_name_mobile">الاسم <span class="required">*</span></label>
                            <input type="text" id="first_name_mobile" name="first_name" value="{{ old('first_name') }}">
                            @error('first_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name_mobile">اللقب <span class="required">*</span></label>
                            <input type="text" id="last_name_mobile" name="last_name" value="{{ old('last_name') }}">
                            @error('last_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email_mobile">البريد الإلكتروني <span class="required">*</span></label>
                            <input type="email" id="email_mobile" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subject_mobile">الموضوع <span class="required">*</span></label>
                            <input type="text" id="subject_mobile" name="subject" value="{{ old('subject') }}">
                            @error('subject')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description_mobile">الوصف <span class="required">*</span></label>
                            <textarea id="description_mobile" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="files_mobile">ملفات (اختياري)</label>
                            <label class="file-input-wrapper" for="files_mobile" style="justify-content: center;">
                                <span class="primary-text" id="files-label-mobile">اختيار ملفات</span>
                            </label>
                            <input type="file" id="files_mobile" name="files[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <div class="file-hint">حد أقصى 10 ميغابايت لكل ملف</div>
                            <div id="files-list-mobile" class="file-list"></div>
                            @error('files.*')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn-sub" type="submit">إرسال</button>
                    </form>
                </div>
            </div>

            <!-- Mobile Footer -->
            @include('user.mobile.footer')
        </div>
    </div>

    <style>
        /* Greybar hide on scroll */
        #greybar {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        #greybar.hide {
            transform: translateY(-100%);
            opacity: 0;
        }
    </style>

@endsection

<script>
    // Initialize Greybar Hide on Scroll
    function initializeGreybarScroll() {
        const greybar = document.getElementById('greybar');
        if (!greybar) return;

        const footer = document.querySelector('footer');

        window.addEventListener('scroll', function() {
            const footerRect = footer.getBoundingClientRect();
            const greybarRect = greybar.getBoundingClientRect();

            // Hide greybar only when it's about to overlap with footer
            if (footerRect.top < greybarRect.bottom) {
                greybar.classList.add('hide');
            } else {
                greybar.classList.remove('hide');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth <= 992) {
            initializeGreybarScroll();
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop form handler
        const form = document.getElementById('contact-form');
        if (form) {
            handleContactForm(form, 'files');
        }

        // Mobile form handler
        const formMobile = document.getElementById('contact-form-mobile');
        if (formMobile) {
            handleContactForm(formMobile, 'files_mobile');
        }

        function handleContactForm(form, fileInputId) {
            const input = document.getElementById(fileInputId);
            const labelId = fileInputId === 'files' ? 'files-label' : 'files-label-mobile';
            const label = document.getElementById(labelId);
            const listId = fileInputId === 'files' ? 'files-list' : 'files-list-mobile';
            const list = document.getElementById(listId);

            if (!input || !label || !list) return;

            let selectedFiles = [];

            function renderFileList() {
                list.innerHTML = '';

                if (selectedFiles.length === 0) {
                    label.textContent = 'اختيار ملفات';
                    return;
                }

                if (selectedFiles.length === 1) {
                    label.textContent = selectedFiles[0].name;
                } else {
                    label.textContent = selectedFiles.length + ' ملفات مختارة';
                }

                selectedFiles.forEach(function(file, index) {
                    const chip = document.createElement('span');
                    const sizeKb = Math.round(file.size / 1024);
                    chip.textContent = (index + 1) + '. ' + file.name + ' (' + sizeKb + ' KB)';
                    list.appendChild(chip);
                });
            }

            input.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    selectedFiles = selectedFiles.concat(Array.from(this.files));
                    this.value = '';
                }
                renderFileList();
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                formData.delete('files[]');

                selectedFiles.forEach(function(file) {
                    formData.append('files[]', file);
                });

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    redirect: 'follow'
                })
                .then(function(response) {
                    window.location.reload();
                })
                .catch(function() {
                    form.removeEventListener('submit', arguments.callee);
                    form.submit();
                });
            });
        }
    });
</script>
