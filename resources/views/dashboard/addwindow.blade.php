@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة نافذة')

@section('content')
    <!-- ======================= AZ BASE STYLES ======================= -->
    <style>
        :root {
            --az-border: #dbdfea;
            --az-muted: #8091a7;
            --az-soft: #f5f6fa;
            --az-card: #ffffff;
            --az-title: #364a63;
            --az-accent: #6576ff;
            --az-accent-light: #eff6ff;
            --az-danger: #e85347;
            --az-success: #1ee0ac;
            --az-warning: #f4bd0e;
            --az-radius: 0;
            --az-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --az-shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
            --az-transition: all 0.2s ease-in-out;
        }

        [data-bs-theme="dark"] {
            --az-border: #384D69;
            --az-muted: #b7c2d0;
            --az-soft: #2b3748;
            --az-card: #0D141D;
            --az-title: #e5e9f2;
        }

        .text-ellipsis {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--az-title);
        }

        .form-control {
            border: 1px solid var(--az-border);
            border-radius: var(--az-radius);
            padding: 10px 14px;
            transition: var(--az-transition);
            background: var(--az-card);
            color: var(--az-title);
        }

        .form-control:focus {
            border-color: var(--az-accent);
            box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.1);
        }

        .btn {
            border-radius: var(--az-radius);
            padding: 10px 16px;
            font-weight: 500;
            transition: var(--az-transition);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background: var(--az-accent);
            border-color: var(--az-accent);
            color: white;
        }

        .btn-primary:hover {
            background: #465fff;
            border-color: #465fff;
            transform: translateY(-1px);
        }

        .btn-outline-secondary {
            color: var(--az-muted);
            border-color: var(--az-border);
        }

        .btn-outline-secondary:hover {
            background: var(--az-soft);
            border-color: var(--az-muted);
            transform: translateY(-1px);
        }

        .btn-outline-danger {
            color: var(--az-danger);
            border-color: var(--az-danger);
        }

        .btn-outline-danger:hover {
            background: var(--az-danger);
            color: #fff;
            transform: translateY(-1px);
        }

        .media-preview {
            border: 1px solid var(--az-border);
            border-radius: var(--az-radius);
            padding: 4px;
            max-height: 160px;
            background: var(--az-soft);
            width: 100%;
            object-fit: contain;
        }

        .input-group .form-control {
            border-radius: 0;
        }

        .input-group .btn {
            border-radius: 0;
        }
    </style>

    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">

                        <!-- ✅ عنوان الصفحة -->
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-en="Add New Window" data-ar="إضافة نافذة">إضافة نافذة</h4>
                                <p data-en="Fill the form below to create a new window."
                                    data-ar="املأ النموذج أدناه لإضافة نافذة جديدة.">
                                    املأ النموذج أدناه لإضافة نافذة جديدة.
                                </p>
                            </div>
                        </div>

                        <!-- رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em>
                                <span class="translatable" data-ar="تمت العملية بنجاح"
                                    data-en="Operation completed successfully">
                                    {{ session('success') ?? 'تمت العملية بنجاح' }}
                                </span>
                            </div>
                        @endif

                        <!-- رسائل الخطأ -->
                        @if ($errors->any())
                            <div class="alert alert-fill alert-danger alert-icon">
                                <em class="icon ni ni-cross-circle"></em>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.window.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- الرابط المختصر -->
                            <div class="form-group">
                                <label class="form-label" for="slug" data-en="Slug" data-ar="الرابط المختصر">الرابط
                                    المختصر</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="slug" class="form-control" id="slug"
                                        value="{{ old('slug') }}" required>
                                </div>
                                @error('slug')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- صورة النافذة - Enhanced with Modal -->
                            <div class="form-group">
                                <label class="form-label" for="image" data-en="Window Image" data-ar="صورة النافذة">صورة
                                    النافذة <span class="text-danger">*</span></label>
                                <div class="input-group mb-2">
                                    <input id="windowImageUrl" class="form-control" data-ar="لم يتم الاختيار"
                                        data-en="Not selected" readonly />
                                    <button type="button" class="btn btn-outline-secondary" id="btnPickWindowImage"
                                        data-ar="اختيار الصورة" data-en="Pick image">
                                        <i class="fa fa-images"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" id="btnClearWindowImage"
                                        title="مسح" data-ar="مسح" data-en="Clear">
                                        <i class="fa fa-xmark"></i>
                                    </button>
                                </div>
                                <input type="hidden" id="image" name="image">
                                <div id="windowImagePreview" class="mt-2"></div>
                                @error('image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- زر الإرسال -->
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary" data-en="Add Window" data-ar="إضافة نافذة">
                                    <i class="fa fa-plus"></i> إضافة نافذة
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>

    <!-- ======================= WINDOW MEDIA MODAL ======================= -->
    <div id="windowMediaModal" class="mmxx-modal" aria-hidden="true" role="dialog" aria-modal="true"
        aria-labelledby="windowMediaModalTitle">
        <div class="mmxx-backdrop" data-mmxx-backdrop></div>
        <div class="mmxx-container" role="document">
            <div class="mmxx-header">
                <h5 id="windowMediaModalTitle" data-ar="اختر صورة النافذة" data-en="Select Window Image">اختر صورة النافذة
                </h5>
                <button class="mmxx-close" type="button" data-mmxx-close aria-label="إغلاق">&times;</button>
            </div>

            <div class="mmxx-tabs" role="tablist" aria-label="أقسام إدارة الوسائط">
                <button type="button" class="mmxx-tab-btn mmxx-is-active" role="tab" aria-selected="true"
                    aria-controls="mmxx-tab-gallery" id="mmxx-tabbtn-gallery" tabindex="0" data-mmxx-tab="gallery"
                    data-ar="المعرض" data-en="Gallery">المعرض</button>
                <button type="button" class="mmxx-tab-btn" role="tab" aria-selected="false"
                    aria-controls="mmxx-tab-upload" id="mmxx-tabbtn-upload" tabindex="-1" data-mmxx-tab="upload"
                    data-ar="الرفع من الجهاز" data-en="Upload from device">الرفع من الجهاز</button>
                <button type="button" class="mmxx-tab-btn" role="tab" aria-selected="false"
                    aria-controls="mmxx-tab-import" id="mmxx-tabbtn-import" tabindex="-1" data-mmxx-tab="import"
                    data-ar="الاستيراد بالرابط" data-en="Import by URL">الاستيراد بالرابط</button>
            </div>

            <!-- Gallery Tab -->
            <section id="mmxx-tab-gallery" class="mmxx-tab-panel" role="tabpanel" aria-labelledby="mmxx-tabbtn-gallery">
                <div class="mmxx-filters">
                    <input type="text" id="mmxx-search" placeholder="search..." />
                    <select id="mmxx-type-filter" aria-label="نوع الوسائط">
                        <option value="all">كل الوسائط</option>
                        <option value="image">صورة</option>
                    </select>
                </div>

                <div class="mmxx-body">
                    <div id="mmxx-list" class="mmxx-grid"></div>
                    <div id="mmxx-loader" class="mmxx-loader" hidden>جاري التحميل...</div>
                    <div id="mmxx-sentinel" class="mmxx-sentinel"></div>
                </div>

                <div class="mmxx-footer">
                    <button class="mmxx-btn mmxx-btn-select" type="button" id="mmxx-btn-select" data-ar="اختر"
                        data-en="Select">اختر</button>
                    <button class="mmxx-btn mmxx-btn-cancel" type="button" data-mmxx-close aria-label="إلغاء"
                        data-ar="إلغاء" data-en="Cancel">إلغاء</button>
                </div>
            </section>

            <!-- Upload Tab -->
            <section id="mmxx-tab-upload" class="mmxx-tab-panel" role="tabpanel" aria-labelledby="mmxx-tabbtn-upload"
                hidden>
                <div class="mmxx-tab-body">
                    <div class="mmxx-uploader">
                        <div class="mmxx-upload-fields" style="display: flex; flex-wrap: wrap; gap: .6rem; width: 100%;">
                            <div style="flex: 1 1 220px;">
                                <input type="file" id="mmxx-upload-input" class="mmxx-upload-input"
                                    style="display: none;" accept="image/*" />
                                <label for="mmxx-upload-input" id="mmxx-upload-label" data-ar="اختر ملف الصورة" data-en="Select Image File"
                                    style="display: block; width: 100%; cursor: pointer; padding: .6rem .7rem;
                   border-radius: 0; background: var(--az-soft); color: var(--az-title);
                   text-align: center; transition: all 0.2s;">
                                    <i class="fa fa-upload" style="margin-right: 6px;"></i>
                                    <span id="mmxx-upload-label-text">اختر ملف الصورة</span>
                                </label>
                            </div>
                            <div style="flex: 1 1 200px;">
                                <input type="text" id="mmxx-upload-name" class="mmxx-upload-name"
                                    placeholder="اسم الملف"
                                    style="width: 100%; padding: .6rem .7rem; border-radius: 0; background: var(--az-soft);border:none; color: var(--az-title);" />
                            </div>
                            <div style="flex: 1 1 200px;">
                                <input type="text" id="mmxx-upload-alt" class="mmxx-upload-alt"
                                    placeholder="النص البديل"
                                    style="width: 100%; padding: .6rem .7rem; border-radius: 0; background: var(--az-soft);border:none; color: var(--az-title);" />
                            </div>
                        </div>
                        <div class="mmxx-uploader-actions">
                            <button class="mmxx-btn mmxx-btn-secondary" type="button" id="mmxx-btn-upload-to-gallery"
                                title="إدراج في المعرض" data-ar="إدراج في المعرض" data-en="Insert into Gallery">إدراج في
                                المعرض</button>
                            <button class="mmxx-btn mmxx-btn-primary" type="button"
                                id="mmxx-btn-upload-and-select-close" title="رفع ثم حفظ وإغلاق"
                                data-ar="رفع ثم حفظ وإغلاق" data-en="Upload then Save and Close">إدراج الصورة</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Import Tab -->
            <section id="mmxx-tab-import" class="mmxx-tab-panel" role="tabpanel" aria-labelledby="mmxx-tabbtn-import"
                hidden>
                <div class="mmxx-tab-body">
                    <div class="mmxx-uploader mmxx-uploader-url"
                        style="padding:1.2rem; border-radius:0; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                        <div style="display:flex; flex-wrap:wrap; gap:.7rem; margin-bottom:.7rem;">
                            <input type="text" id="mmxx-upload-url"
                                style="flex:1 1 220px; padding:.7rem 1rem; border-radius:0; background:var(--az-card); color:var(--az-title); font-size:1rem; border:1px solid var(--az-border);"
                                placeholder="الرابط" />
                            <input type="text" id="mmxx-url-name" placeholder="اسم الملف"
                                style="flex:1 1 180px; padding:.7rem 1rem; border-radius:0; background:var(--az-card); color:var(--az-title); font-size:1rem; border:1px solid var(--az-border);" />
                            <input type="text" id="mmxx-url-alt" placeholder="النص البديل"
                                style="flex:1 1 180px; padding:.7rem 1rem; border-radius:0; background:var(--az-card); color:var(--az-title); font-size:1rem; border:1px solid var(--az-border);" />
                        </div>
                        <div class="mmxx-uploader-actions" style="display:flex; gap:.7rem; margin-bottom:.7rem;">
                            <button class="mmxx-btn mmxx-btn-secondary" type="button" id="mmxx-btn-import-to-gallery"
                                title="استيراد بالرابط ثم عرض في المعرض"
                                style="border-radius:0; font-size:1rem; padding:.7rem 1.2rem;" data-ar="إدراج في المعرض"
                                data-en="Insert into Gallery">إدراج في المعرض</button>
                            <button class="mmxx-btn mmxx-btn-primary" type="button"
                                id="mmxx-btn-import-and-select-close" title="استيراد بالرابط ثم حفظ وإغلاق"
                                style="border-radius:0; font-size:1rem; padding:.7rem 1.2rem;" data-ar="إدراج الصورة"
                                data-en="Insert Image">إدراج الصورة</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- ======================= WINDOW MODAL STYLES ======================= -->
    <style>
        #windowMediaModal,
        #windowMediaModal * {
            box-sizing: border-box;
        }

        :root {
            --mmxx-bg: #fff;
            --mmxx-text: #526484;
            --mmxx-border: #dbdfea;
            --mmxx-ring: #6576ff;
            --mmxx-muted: #8091a7;
            --mmxx-primary: #6576ff;
            --mmxx-secondary: #364a63;
        }

        [data-bs-theme="dark"] {
            --mmxx-bg: #0D141D;
            --mmxx-text: #e5e9f2;
            --mmxx-border: #384D69;
        }

        .mmxx-modal {
            position: fixed;
            inset: 0;
            display: none;
            z-index: 10000;
        }

        .mmxx-modal[aria-hidden="false"] {
            display: block;
        }

        .mmxx-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .4);
            z-index: 0;
        }

        .mmxx-container {
            position: absolute;
            inset: auto 0;
            top: 5%;
            margin: 0 auto;
            width: clamp(320px, 92vw, 1000px);
            max-height: 90%;
            background: var(--mmxx-bg);
            color: var(--mmxx-text);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            z-index: 1;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
            animation: mmxxFade .2s ease-out;
        }

        @keyframes mmxxFade {
            from {
                opacity: 0;
                transform: translateY(-14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mmxx-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--mmxx-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--mmxx-bg);
        }

        .mmxx-header h5 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--mmxx-text);
        }

        .mmxx-close {
            font-size: 1.4rem;
            line-height: 1;
            border: 0;
            background: transparent;
            color: var(--mmxx-muted);
            cursor: pointer;
        }

        .mmxx-close:hover {
            color: var(--mmxx-text);
        }

        .mmxx-tabs {
            display: flex;
            gap: .25rem;
            padding: .5rem;
            border-bottom: 1px solid var(--mmxx-border);
            background: var(--mmxx-bg);
        }

        .mmxx-tab-btn {
            appearance: none;
            background: var(--mmxx-bg);
            border: 1px solid var(--mmxx-border);
            padding: .55rem .9rem;
            cursor: pointer;
            font-weight: 600;
            color: var(--mmxx-text);
            border-radius: 0;
        }

        .mmxx-tab-btn:focus {
            outline: 2px solid var(--mmxx-ring);
            outline-offset: 1px;
        }

        .mmxx-tab-btn.mmxx-is-active {
            background: var(--mmxx-primary);
            border-color: var(--mmxx-primary);
            color: white;
        }

        .mmxx-tab-panel {
            display: block;
        }

        .mmxx-tab-panel[hidden] {
            display: none;
        }

        .mmxx-tab-body {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--mmxx-border);
            background: var(--mmxx-bg);
        }

        .mmxx-filters {
            padding: 1rem 1.25rem;
            display: flex;
            gap: .65rem;
            flex-wrap: wrap;
            border-bottom: 1px solid var(--mmxx-border);
            background: var(--mmxx-bg);
        }

        .mmxx-filters input,
        .mmxx-filters select {
            padding: .6rem .7rem;
            font-size: .95rem;
            border: 1px solid var(--mmxx-border);
            background: var(--mmxx-bg);
            color: var(--mmxx-text);
            flex: 1 1 180px;
            transition: box-shadow .15s, border-color .15s;
            border-radius: 0;
        }

        .mmxx-filters input::placeholder {
            color: var(--mmxx-muted);
        }

        .mmxx-filters input:focus,
        .mmxx-filters select:focus {
            border-color: var(--mmxx-primary);
            box-shadow: 0 0 0 2px rgba(101, 118, 255, 0.1);
            outline: none;
        }

        .mmxx-body {
            padding: 1rem 1.25rem;
            overflow: auto;
            flex: 1;
            background: var(--mmxx-bg);
        }

        .mmxx-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: .9rem;
        }

        .mmxx-empty {
            text-align: center;
            color: var(--mmxx-muted);
            font-size: .95rem;
            margin: 2rem 0;
        }

        .mmxx-item {
            position: relative;
            background: var(--mmxx-bg);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: .6rem;
            transition: border-color .15s, transform .04s ease, box-shadow .15s;
            border: 1px solid var(--mmxx-border);
            border-radius: 0;
        }

        .mmxx-item:hover {
            border-color: var(--mmxx-primary);
            box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.1);
        }

        .mmxx-item:active {
            transform: scale(.995);
        }

        .mmxx-item.mmxx-is-selected {
            border-color: var(--mmxx-primary);
            box-shadow: 0 0 0 3px rgba(101, 118, 255, 0.2);
        }

        .mmxx-thumb {
            width: 100%;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--mmxx-text, #f5f6fa);
            overflow: hidden;
            position: relative;
            border: 1px solid var(--mmxx-border);
            border-radius: 0;
        }

        .mmxx-thumb img,
        .mmxx-thumb video {
            max-width: 100%;
            max-height: 100%;
        }

        .mmxx-title {
            font-size: .9rem;
            color: var(--mmxx-text);
            margin-top: .55rem;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mmxx-uploader {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: .6rem;
            background: var(--mmxx-bg);
            border: 1px solid var(--mmxx-border);
            padding: 1rem;
            border-radius: 0;
        }

        .mmxx-btn {
            padding: .6rem 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s, color .15s, border-color .15s;
            border: 1px solid var(--mmxx-primary);
            background: var(--mmxx-primary);
            color: #fff;
            border-radius: 0;
        }

        .mmxx-btn:hover {
            background: #465fff;
            border-color: #465fff;
        }

        .mmxx-btn-secondary {
            background: var(--mmxx-secondary);
            border-color: var(--mmxx-secondary);
        }

        .mmxx-btn-secondary:hover {
            background: #2b3748;
            border-color: #2b3748;
        }

        .mmxx-btn-primary {
            background: var(--mmxx-primary);
            border-color: var(--mmxx-primary);
        }

        .mmxx-footer {
            padding: 1rem 1.25rem;
            background: var(--mmxx-bg);
            display: flex;
            justify-content: flex-end;
            gap: .6rem;
            border-top: 1px solid var(--mmxx-border);
        }

        .mmxx-btn-select {
            background: var(--mmxx-primary);
            color: #fff;
            border-color: var(--mmxx-primary);
        }

        .mmxx-btn-select:hover {
            background: #465fff;
            border-color: #465fff;
        }

        .mmxx-btn-cancel {
            background: var(--mmxx-secondary);
            border-color: var(--mmxx-secondary);
            color: #fff;
        }

        .mmxx-btn-cancel:hover {
            background: #2b3748;
            border-color: #2b3748;
        }

        .mmxx-loader {
            text-align: center;
            color: var(--mmxx-muted);
            padding: .75rem;
            font-size: .95rem;
        }

        .mmxx-sentinel {
            height: 1px;
        }

        @media (max-width: 768px) {
            .mmxx-container {
                top: 2%;
                max-height: 96%;
            }

            .mmxx-filters {
                flex-direction: column;
            }

            .mmxx-filters input,
            .mmxx-filters select,
            .mmxx-uploader {
                width: 100%;
            }
        }
    </style>

    <!-- ======================= CSRF & SVG ICONS ======================= -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
        <symbol id="mmxx-icon-image" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor"
                stroke-width="2" />
            <circle cx="8" cy="10" r="1.5" fill="currentColor" />
            <path d="M21 19l-5.5-7-4.5 6-3-4-4 5" fill="none" stroke="currentColor" stroke-width="2" />
        </symbol>
    </svg>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ======================= WINDOW MODAL SCRIPT ======================= -->
    <script>
        (() => {
            const FETCH_URL = "{{ route('dashboard.media.getAllMediaPaginated') }}";
            const UPLOAD_URL = "{{ route('dashboard.media.store') }}";
            const IMPORT_URL = "{{ route('dashboard.media_url.store') }}";

            const modal = document.getElementById("windowMediaModal");
            const backdrop = modal.querySelector("[data-mmxx-backdrop]");
            const closes = modal.querySelectorAll("[data-mmxx-close]");
            const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            const listEl = document.getElementById("mmxx-list");
            const loaderEl = document.getElementById("mmxx-loader");
            const sentinel = document.getElementById("mmxx-sentinel");
            const searchInput = document.getElementById("mmxx-search");
            const typeSelect = document.getElementById("mmxx-type-filter");
            const btnSelect = document.getElementById("mmxx-btn-select");

            const uploadInput = document.getElementById("mmxx-upload-input");
            const uploadName = document.getElementById("mmxx-upload-name");
            const uploadAlt = document.getElementById("mmxx-upload-alt");
            const btnUploadToGallery = document.getElementById("mmxx-btn-upload-to-gallery");
            const btnUploadSelectAndClose = document.getElementById("mmxx-btn-upload-and-select-close");

            const uploadUrlInput = document.getElementById("mmxx-upload-url");
            const urlNameInput = document.getElementById("mmxx-url-name");
            const urlAltInput = document.getElementById("mmxx-url-alt");
            const btnImportToGallery = document.getElementById("mmxx-btn-import-to-gallery");
            const btnImportSelectAndClose = document.getElementById("mmxx-btn-import-and-select-close");

            const tabButtons = Array.from(modal.querySelectorAll('.mmxx-tab-btn'));
            const tabPanels = {
                gallery: document.getElementById('mmxx-tab-gallery'),
                upload: document.getElementById('mmxx-tab-upload'),
                import: document.getElementById('mmxx-tab-import'),
            };

            const state = {
                isOpen: false,
                page: 1,
                perPage: 12,
                hasMore: true,
                isLoading: false,
                search: "",
                list: [],
                selected: null,
                observer: null,
                activeTab: 'gallery'
            };

            function getMediaKind(media) {
                const mt = (media.media_type || "").toLowerCase();
                if (["image", "video", "audio"].includes(mt)) return mt;
                const ext = (media.path || media.url || "").split("?")[0].split(".").pop() || "";
                if (["jpg", "jpeg", "png", "gif", "webp"].includes(ext.toLowerCase())) return "image";
                return "file";
            }

            function openModal() {
                state.isOpen = true;
                modal.setAttribute("aria-hidden", "false");
                document.documentElement.style.overflow = "hidden";
                state.search = "";
                state.selected = null;
                searchInput.value = "";
                typeSelect.value = "all";
                switchTab('gallery');
                resetAndLoad();
                setupObserver();
            }

            function closeModal() {
                state.isOpen = false;
                modal.setAttribute("aria-hidden", "true");
                document.documentElement.style.overflow = "";
            }

            backdrop.addEventListener("click", closeModal);
            closes.forEach(b => b.addEventListener("click", closeModal));
            modal.querySelector(".mmxx-container").addEventListener("click", e => e.stopPropagation());
            document.addEventListener("keydown", e => {
                if (!state.isOpen) return;
                if (e.key === "Escape") closeModal();
            });

            tabButtons.forEach(btn => btn.addEventListener('click', () => switchTab(btn.dataset.mmxxTab)));

            function switchTab(tab) {
                if (!tabPanels[tab]) return;
                state.activeTab = tab;
                tabButtons.forEach(b => {
                    const active = b.dataset.mmxxTab === tab;
                    b.classList.toggle('mmxx-is-active', active);
                    b.setAttribute('aria-selected', String(active));
                });
                Object.entries(tabPanels).forEach(([name, panel]) => panel.hidden = (name !== tab));
            }

            async function resetAndLoad() {
                state.page = 1;
                state.hasMore = true;
                state.list = [];
                renderList();
                await loadMore(true);
            }

            function setupObserver() {
                if (state.observer) state.observer.disconnect();
                const rootEl = tabPanels.gallery.querySelector(".mmxx-body");
                state.observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) loadMore();
                    });
                }, {
                    root: rootEl,
                    threshold: 1
                });
                state.observer.observe(sentinel);
            }

            async function loadMore(reset = false) {
                if (state.isLoading || !state.hasMore) return;
                state.isLoading = true;
                loaderEl.hidden = false;
                try {
                    const url = new URL(FETCH_URL, window.location.origin);
                    url.searchParams.set("page", state.page);
                    url.searchParams.set("search", state.search.trim());
                    url.searchParams.set("type", "image");
                    const res = await fetch(url.toString(), {
                        headers: {
                            Accept: "application/json"
                        }
                    });
                    const data = await res.json();
                    const items = Array.isArray(data.data) ? data.data : [];
                    const hasMore = !!data.next_page_url;
                    state.list = reset ? items : state.list.concat(items);
                    state.hasMore = hasMore;
                    state.page += 1;
                } catch (err) {
                    console.error(err);
                } finally {
                    state.isLoading = false;
                    loaderEl.hidden = true;
                    renderList();
                }
            }

            function renderList() {
                listEl.innerHTML = "";
                if (!state.list.length) {
                    listEl.innerHTML = `<div class="mmxx-empty">لا توجد صور للعرض</div>`;
                    return;
                }
                state.list.forEach(media => {
                    const item = document.createElement("div");
                    item.className = "mmxx-item";
                    if (state.selected && state.selected.id === media.id) item.classList.add(
                    "mmxx-is-selected");
                    item.addEventListener("click", () => toggleSelect(media));

                    const thumb = document.createElement("div");
                    thumb.className = "mmxx-thumb";
                    const img = document.createElement("img");
                    img.src = media.path;
                    img.alt = media.alt || media.name || "";
                    img.loading = "lazy";
                    thumb.appendChild(img);
                    item.appendChild(thumb);

                    const title = document.createElement("div");
                    title.className = "mmxx-title";
                    title.textContent = media.name || "";
                    item.appendChild(title);

                    listEl.appendChild(item);
                });
            }

            function toggleSelect(media) {
                const isSame = state.selected && state.selected.id === media.id;
                state.selected = isSame ? null : media;
                renderList();
            }

            searchInput?.addEventListener("input", async e => {
                state.search = e.target.value;
                await resetAndLoad();
            });

            btnSelect?.addEventListener("click", () => {
                if (!state.selected) {
                    alert('يرجى اختيار صورة.');
                    return;
                }
                selectImage({
                    id: state.selected.id,
                    url: state.selected.path,
                    title: state.selected.name || "",
                    alt: state.selected.alt || ""
                });
                closeModal();
            });

            // Main form image selection
            const imageUrlInput = document.getElementById("windowImageUrl");
            const imagePreview = document.getElementById("windowImagePreview");
            const imageHiddenInput = document.getElementById("image");
            const btnPickImage = document.getElementById("btnPickWindowImage");
            const btnClearImage = document.getElementById("btnClearWindowImage");

            function selectImage(media) {
                imageUrlInput.value = media.url || "";
                imageHiddenInput.value = media.url || "";
                renderImagePreview();
            }

            function renderImagePreview() {
                imagePreview.innerHTML = "";
                const url = imageHiddenInput.value || imageUrlInput.value;
                if (!url) return;
                const img = new Image();
                img.src = url;
                img.alt = "";
                img.className = "media-preview";
                img.loading = "lazy";
                imagePreview.appendChild(img);
            }

            btnPickImage?.addEventListener("click", () => {
                openModal();
            });

            btnClearImage?.addEventListener("click", () => {
                imageUrlInput.value = "";
                imageHiddenInput.value = "";
                imagePreview.innerHTML = "";
            });

            // Upload functionality
            async function uploadImageAndHandle(mode) {
                const files = uploadInput.files;
                if (!files || !files.length) {
                    alert("⚠️ لم يتم اختيار أي ملف للرفع.");
                    return;
                }
                const file0 = files[0];
                const nameVal = (uploadName.value || "").trim();
                const altVal = (uploadAlt.value || "").trim();

                const form = new FormData();
                form.append("media", file0);
                if (nameVal) form.append("name", nameVal);
                if (altVal) form.append("alt", altVal);

                try {
                    btnUploadToGallery.disabled = true;
                    btnUploadSelectAndClose.disabled = true;
                    const res = await fetch(UPLOAD_URL, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": CSRF,
                            "Accept": "application/json"
                        },
                        body: form
                    });
                    const data = await res.json();
                    if (!res.ok) throw new Error(data.message || "Upload failed");

                    const created = data.data || data.media || null;

                    if (mode === "gallery") {
                        await resetAndLoad();
                        switchTab('gallery'); // التبديل إلى tab المعرض

                        // تحديد الصورة المرفوعة تلقائياً
                        if (created) {
                            state.selected = created;
                            renderList();
                        }

                        uploadInput.value = "";
                        uploadName.value = "";
                        uploadAlt.value = "";
                    } else {
                        if (created) {
                            selectImage({
                                id: created.id,
                                url: created.path || created.url,
                                title: created.name || "",
                                alt: created.alt || ""
                            });
                        }
                        closeModal();
                    }
                } catch (err) {
                    alert("خطأ في الرفع: " + err.message);
                } finally {
                    btnUploadToGallery.disabled = false;
                    btnUploadSelectAndClose.disabled = false;
                }
            }

            // Import functionality
            async function importImageViaUrl(mode) {
                const urlVal = (uploadUrlInput.value || "").trim();
                const nameVal = (urlNameInput.value || "").trim();
                const altVal = (urlAltInput.value || "").trim();

                if (!urlVal) {
                    alert("⚠️ يرجى إدخال الرابط أولاً.");
                    return;
                }

                try {
                    btnImportToGallery.disabled = true;
                    btnImportSelectAndClose.disabled = true;
                    const res = await fetch(IMPORT_URL, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": CSRF,
                            "Accept": "application/json",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            url: urlVal,
                            name: nameVal || undefined,
                            alt: altVal || undefined,
                            media_type: "image"
                        })
                    });
                    const data = await res.json();
                    if (!res.ok) throw new Error(data.message || "Import failed");

                    const created = data.data || data.media || null;

                    if (mode === "gallery") {
                        await resetAndLoad();
                        switchTab('gallery'); // التبديل إلى tab المعرض

                        // تحديد الصورة المستوردة تلقائياً
                        if (created) {
                            state.selected = created;
                            renderList();
                        }

                        uploadUrlInput.value = "";
                        urlNameInput.value = "";
                        urlAltInput.value = "";
                    } else {
                        if (created) {
                            selectImage({
                                id: created.id,
                                url: created.path || created.url,
                                title: created.name || "",
                                alt: created.alt || ""
                            });
                        }
                        closeModal();
                    }
                } catch (err) {
                    alert("خطأ في الاستيراد: " + err.message);
                } finally {
                    btnImportToGallery.disabled = false;
                    btnImportSelectAndClose.disabled = false;
                }
            }

            btnUploadToGallery?.addEventListener("click", () => uploadImageAndHandle('gallery'));
            btnUploadSelectAndClose?.addEventListener("click", () => uploadImageAndHandle('select-close'));
            btnImportToGallery?.addEventListener("click", () => importImageViaUrl('gallery'));
            btnImportSelectAndClose?.addEventListener("click", () => importImageViaUrl('select-close'));

            // تحديث label الـ upload عند اختيار ملف
            const uploadLabelText = document.getElementById('mmxx-upload-label-text');
            const uploadLabel = document.getElementById('mmxx-upload-label');
            uploadInput?.addEventListener('change', (e) => {
                const files = e.target.files;
                if (files && files.length > 0) {
                    const fileName = files[0].name;
                    uploadLabelText.textContent = 'تم تحميل الملف';
                    uploadLabel.style.border = '1px solid var(--az-accent)';

                    // تعبئة اسم الملف تلقائياً إذا كان فارغاً
                    if (!uploadName.value) {
                        const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                        uploadName.value = nameWithoutExt;
                        uploadAlt.value = nameWithoutExt;
                    }
                } else {
                    uploadLabelText.textContent = 'اختر ملف الصورة';
                    uploadLabel.style.border = 'none';
                }
            });

            // Initialize
            if (!state.list.length) listEl.innerHTML = `<div class="mmxx-empty">لا توجد صور للعرض</div>`;
        })();
    </script>

@endsection
