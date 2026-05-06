@extends('layouts.admin')
@section('title', 'تعديل ترند')

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
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: var(--az-soft);
            border-color: var(--az-muted);
            transform: translateY(-1px);
        }

        .btn-outline-danger {
            color: var(--az-danger);
            border-color: var(--az-danger);
            background: transparent;
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

        .input-group {
            display: flex;
            gap: 0;
        }

        .input-group .form-control {
            border-radius: 0;
            flex: 1;
        }

        .input-group .btn {
            border-radius: 0;
            white-space: nowrap;
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
                                <h4 class="nk-block-title" data-en="Edit Trend" data-ar="تعديل ترند">تعديل ترند</h4>
                                <p data-en="Update the form below to edit the trend."
                                    data-ar="قم بتحديث النموذج أدناه لتعديل الترند.">
                                    قم بتحديث النموذج أدناه لتعديل الترند.
                                </p>
                            </div>
                        </div>

                        <!-- رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em>
                                <span class="translatable" data-ar="تم التعديل بنجاح" data-en="Updated successfully">
                                    {{ session('success') ?? 'تم التعديل بنجاح' }}
                                </span>
                            </div>
                        @endif

                        <!-- رسائل الخطأ -->
                        @if ($errors->any())
                            <div class="alert alert-fill alert-danger alert-icon">
                                <em class="icon ni ni-cross-circle"></em>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li class="translatable" data-ar="حدث خطأ ما" data-en="An error occurred">
                                            {{ $error ?? 'حدث خطأ ما' }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.trend.update', $trend->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- عنوان الترند -->
                            <div class="form-group">
                                <label class="form-label" for="title" data-en="Trend Title" data-ar="عنوان الترند">عنوان
                                    الترند</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ old('title', $trend->title) }}" required>
                                </div>
                                @error('title')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>


                            <!-- صورة الترند - Enhanced with Modal -->
                            <div class="form-group">
                                <label class="form-label" for="image" data-en="Trend Image" data-ar="صورة الترند">صورة
                                    الترند <span class="text-danger">*</span></label>
                                <div class="input-group mb-2">
                                    <input id="trendImageUrl" class="form-control" data-ar="لم يتم الاختيار"
                                        data-en="Not selected" readonly value="{{ $trend->image }}" />
                                    <button type="button" class="btn btn-outline-secondary" id="btnPickTrendImage"
                                        data-ar="اختيار الصورة" data-en="Pick image">
                                        <i class="fa fa-images"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" id="btnClearTrendImage"
                                        title="مسح" data-ar="مسح" data-en="Clear">
                                        <i class="fa fa-xmark"></i>
                                    </button>
                                </div>
                                <input type="hidden" id="image" name="image" value="{{ $trend->image }}">
                                <div id="trendImagePreview" class="mt-2">
                                    @if ($trend->image)
                                        <img src="{{ $trend->image }}" alt="صورة الترند" class="media-preview">
                                    @endif
                                </div>
                                @error('image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- زر -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Edit Trend" data-ar="تعديل ترند">
                                    <i class="fa fa-pencil"></i> تعديل ترند
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>

    <!-- ======================= TREND MEDIA MODAL ======================= -->
    <div id="trendMediaModal" class="mmxx-modal" aria-hidden="true" role="dialog" aria-modal="true"
        aria-labelledby="trendMediaModalTitle">
        <div class="mmxx-backdrop" data-mmxx-backdrop></div>
        <div class="mmxx-container" role="document">
            <div class="mmxx-header">
                <h5 id="trendMediaModalTitle" data-ar="اختر صورة الترند" data-en="Select Trend Image">اختر صورة الترند
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
                    <nav id="mmxx-pagination" class="mmxx-pagination" aria-label="ترقيم الصفحات"></nav>
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
                                <label for="mmxx-upload-input" id="mmxx-upload-label" data-ar="اختر ملف الصورة"
                                    data-en="Select Image File"
                                    style="display: block; width: 100%; cursor: pointer; padding: .6rem .7rem;
                   border-radius: 0; background: var(--az-soft); color: var(--az-title);
                   text-align: center; transition: all 0.2s; border: 1px dashed var(--az-border);">
                                    <i class="fa fa-upload" style="margin-right: 6px;"></i>
                                    <span id="mmxx-upload-label-text">اختر ملف الصورة</span>
                                </label>
                            </div>
                            <div style="flex: 1 1 200px;">
                                <input type="text" id="mmxx-upload-name" class="mmxx-upload-name"
                                    placeholder="اسم الملف"
                                    style="width: 100%; padding: .6rem .7rem; border-radius: 0; background: var(--az-card); color: var(--az-title); font-size: .95rem; border: 1px solid var(--az-border);" />
                            </div>
                            <div style="flex: 1 1 200px;">
                                <input type="text" id="mmxx-upload-alt" class="mmxx-upload-alt"
                                    placeholder="النص البديل"
                                    style="width: 100%; padding: .6rem .7rem; border-radius: 0; background: var(--az-card); color: var(--az-title); font-size: .95rem; border: 1px solid var(--az-border);" />
                            </div>
                        </div>
                        <div class="mmxx-uploader-actions" style="display: flex; gap: .6rem; margin-top: 1rem;">
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
                        style="padding:1.2rem; border-radius:0; background: var(--az-soft);">
                        <div style="display:flex; flex-wrap:wrap; gap:.7rem; margin-bottom:.7rem;">
                            <input type="text" id="mmxx-upload-url"
                                style="flex:1 1 220px; padding:.7rem 1rem; border-radius:0; background:var(--az-card); color:var(--az-title); font-size:.95rem; border:1px solid var(--az-border);"
                                placeholder="الرابط" />
                            <input type="text" id="mmxx-url-name" placeholder="اسم الملف"
                                style="flex:1 1 180px; padding:.7rem 1rem; border-radius:0; background:var(--az-card); color:var(--az-title); font-size:.95rem; border:1px solid var(--az-border);" />
                            <input type="text" id="mmxx-url-alt" placeholder="النص البديل"
                                style="flex:1 1 180px; padding:.7rem 1rem; border-radius:0; background:var(--az-card); color:var(--az-title); font-size:.95rem; border:1px solid var(--az-border);" />
                        </div>
                        <div class="mmxx-uploader-actions" style="display:flex; gap:.7rem;">
                            <button class="mmxx-btn mmxx-btn-secondary" type="button" id="mmxx-btn-import-to-gallery"
                                title="استيراد بالرابط ثم عرض في المعرض"
                                style="border-radius:0; font-size:.95rem; padding:.7rem 1.2rem;" data-ar="إدراج في المعرض"
                                data-en="Insert into Gallery">إدراج في المعرض</button>
                            <button class="mmxx-btn mmxx-btn-primary" type="button"
                                id="mmxx-btn-import-and-select-close" title="استيراد بالرابط ثم حفظ وإغلاق"
                                style="border-radius:0; font-size:.95rem; padding:.7rem 1.2rem;" data-ar="إدراج الصورة"
                                data-en="Insert Image">إدراج الصورة</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- ======================= TREND MODAL STYLES ======================= -->
    <style>
        #trendMediaModal,
        #trendMediaModal * {
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
        min-height: 0;
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
            background: var(--az-soft);
            overflow: hidden;
            position: relative;
            border: 1px solid var(--mmxx-border);
            border-radius: 0;
        }

        .mmxx-thumb img,
        .mmxx-thumb video {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
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
            flex-direction: column;
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
    .mmxx-pagination {
        display: flex;
        flex-wrap: wrap;
        gap: .35rem;
        justify-content: center;
        align-items: center;
        padding: .65rem 1rem;
        border-top: 1px solid var(--mmxx-border, #dbdfea);
        background: var(--mmxx-gray-100, #f3f4f8);
        flex-shrink: 0;
    }
    .mmxx-pagination button {
        min-width: 36px;
        height: 34px;
        padding: 0 .7rem;
        border: 1px solid var(--mmxx-border, #dbdfea) !important;
        background: var(--mmxx-bg, #fff);
        color: var(--mmxx-text, #526484);
        cursor: pointer;
        font-weight: 600;
        font-size: .9rem;
        border-radius: 6px !important;
        transition: background .15s, color .15s, border-color .15s, transform .05s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .mmxx-pagination button:hover:not(:disabled) {
        background: var(--mmxx-primary, #6576ff);
        border-color: var(--mmxx-primary, #6576ff) !important;
        color: #fff;
    }
    .mmxx-pagination button:active:not(:disabled) { transform: scale(.96); }
    .mmxx-pagination button.mmxx-page-active {
        background: var(--mmxx-primary, #6576ff);
        border-color: var(--mmxx-primary, #6576ff) !important;
        color: #fff;
        box-shadow: 0 2px 6px rgba(101, 118, 255, 0.35);
    }
    .mmxx-pagination button:disabled { opacity: .45; cursor: not-allowed; }
    .mmxx-pagination .mmxx-page-ellipsis { padding: 0 .25rem; color: var(--mmxx-muted, #8091a7); font-weight: 700; }
    .mmxx-pagination .mmxx-page-info {
        margin-inline-start: auto;
        font-size: .85rem;
        color: var(--mmxx-muted, #8091a7);
        font-weight: 500;
    }
    @media (max-width: 600px) {
        .mmxx-pagination .mmxx-page-info { width: 100%; text-align: center; margin: .25rem 0 0; }
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
    
/* === MMX-UI-ENHANCE-V2 === */
#trendMediaModal ,
#trendMediaModal  * { border-radius: 0 !important; }
#trendMediaModal .mmxx-container {
    max-height: 90vh !important;
    height: auto !important;
    width: clamp(320px, 94vw, 1080px) !important;
    border-radius: 0 !important;
    box-shadow: 0 12px 32px rgba(15,23,42,.12) !important;
    overflow: hidden !important;
    display: flex !important;
    flex-direction: column !important;
    border: 1px solid rgba(15,23,42,.06);
    background: var(--mmxx-bg, #fff) !important;
}
#trendMediaModal .mmxx-header {
    padding: 1rem 1.25rem !important;
    background: var(--mmxx-bg, #fff) !important;
    border-bottom: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0;
}
#trendMediaModal .mmxx-header h5 { font-size: 1rem !important; font-weight: 600 !important; letter-spacing: -0.01em; }
#trendMediaModal .mmxx-close {
    width: 30px; height: 30px;
    border-radius: 0 !important;
    display: inline-flex; align-items: center; justify-content: center;
    color: var(--mmxx-muted, #94a3b8) !important;
    transition: background .12s, color .12s;
    background: transparent !important;
}
#trendMediaModal .mmxx-close:hover { background: rgba(15,23,42,.05) !important; color: var(--mmxx-text, #1e293b) !important; }

#trendMediaModal .mmxx-tabs {
    padding: .5rem .85rem !important;
    gap: .25rem !important;
    background: var(--mmxx-bg, #fff) !important;
    border-bottom: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0;
    overflow-x: auto;
}
#trendMediaModal .mmxx-tab-btn {
    border-radius: 0 !important;
    padding: .5rem .9rem !important;
    border: 1px solid transparent !important;
    background: transparent !important;
    color: var(--mmxx-muted, #64748b) !important;
    font-weight: 500 !important;
    font-size: .88rem !important;
    transition: background .12s, color .12s;
    white-space: nowrap;
    box-shadow: none !important;
}
#trendMediaModal .mmxx-tab-btn:hover:not(.mmxx-is-active) {
    background: rgba(15,23,42,.04) !important;
    color: var(--mmxx-text, #1e293b) !important;
}
#trendMediaModal .mmxx-tab-btn.mmxx-is-active {
    background: rgba(101,118,255,.10) !important;
    color: var(--mmxx-primary, #6576ff) !important;
    border-color: transparent !important;
    box-shadow: none !important;
}

#trendMediaModal .mmxx-tab-panel { display: flex !important; flex-direction: column; flex: 1 1 auto; min-height: 0; overflow: hidden; }
#trendMediaModal .mmxx-tab-panel[hidden] { display: none !important; }

#trendMediaModal .mmxx-filters {
    padding: .9rem 1.25rem !important;
    background: var(--mmxx-bg, #fff) !important;
    border-bottom: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0;
    gap: .5rem !important;
}

#trendMediaModal .mmxx-body {
    flex: 1 1 auto !important;
    min-height: 200px !important;
    overflow: auto !important;
    padding: 1.25rem !important;
    background: var(--mmxx-bg, #fff) !important;
    scrollbar-width: thin;
}
#trendMediaModal .mmxx-body::-webkit-scrollbar { width: 6px; }
#trendMediaModal .mmxx-body::-webkit-scrollbar-thumb { background: rgba(15,23,42,.15); border-radius: 0; }
#trendMediaModal .mmxx-body::-webkit-scrollbar-thumb:hover { background: rgba(15,23,42,.25); }

#trendMediaModal .mmxx-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)) !important;
    gap: .75rem !important;
}

#trendMediaModal .mmxx-empty {
    grid-column: 1 / -1;
    text-align: center;
    color: var(--mmxx-muted, #94a3b8);
    font-size: .92rem;
    padding: 3rem 1rem !important;
    background: transparent;
    border: 0;
    margin: 0 !important;
}

#trendMediaModal .mmxx-item {
    background: var(--mmxx-bg, #fff) !important;
    border: 1px solid rgba(15,23,42,.08) !important;
    border-radius: 0 !important;
    overflow: hidden;
    padding: 0 !important;
    transition: border-color .12s, box-shadow .12s !important;
    display: flex !important;
    flex-direction: column;
    cursor: pointer;
    position: relative;
}
#trendMediaModal .mmxx-item:hover {
    border-color: rgba(101,118,255,.4) !important;
    box-shadow: 0 2px 8px rgba(15,23,42,.06) !important;
}
#trendMediaModal .mmxx-item.mmxx-is-selected {
    border-color: var(--mmxx-primary, #6576ff) !important;
    box-shadow: 0 0 0 2px rgba(101,118,255,.25) !important;
}
#trendMediaModal .mmxx-item.mmxx-is-selected::before {
    content: '✓';
    position: absolute;
    top: 8px;
    inset-inline-end: 8px;
    width: 22px; height: 22px;
    background: var(--mmxx-primary, #6576ff);
    color: #fff;
    border-radius: 50% !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .75rem;
    font-weight: 700;
    z-index: 2;
}

#trendMediaModal .mmxx-thumb {
    height: 120px !important;
    width: 100% !important;
    border: 0 !important;
    background: rgba(15,23,42,.03) !important;
    border-radius: 0 !important;
}
#trendMediaModal .mmxx-thumb img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    max-width: none !important;
    max-height: none !important;
}

#trendMediaModal .mmxx-title {
    margin: 0 !important;
    padding: .5rem .65rem !important;
    font-size: .82rem !important;
    font-weight: 500 !important;
    color: var(--mmxx-text, #334155) !important;
    background: var(--mmxx-bg, #fff);
    border-top: 1px solid rgba(15,23,42,.05);
}

#trendMediaModal .mmxx-badge {
    border-radius: 0 !important;
    background: rgba(15,23,42,.65) !important;
    backdrop-filter: blur(4px);
    border: 0 !important;
    width: 24px !important;
    height: 24px !important;
    top: 6px;
    inset-inline-start: 6px;
}

#trendMediaModal .mmxx-loader {
    text-align: center;
    color: var(--mmxx-muted, #94a3b8);
    padding: 1rem !important;
    font-size: .88rem;
}
#trendMediaModal .mmxx-loader::before {
    content: '';
    display: inline-block;
    width: 12px; height: 12px;
    margin-inline-end: .5rem;
    border: 2px solid rgba(15,23,42,.1);
    border-top-color: var(--mmxx-primary, #6576ff);
    border-radius: 50% !important;
    animation: mmxx-spin .7s linear infinite;
    vertical-align: -1px;
}
@keyframes mmxx-spin { to { transform: rotate(360deg); } }

#trendMediaModal .mmxx-pagination {
    display: flex !important;
    flex-wrap: wrap;
    gap: .25rem !important;
    align-items: center;
    padding: .6rem 1.25rem !important;
    background: var(--mmxx-bg, #fff) !important;
    border-top: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0 !important;
}
#trendMediaModal .mmxx-pagination button {
    min-width: 32px !important;
    height: 32px !important;
    padding: 0 .55rem !important;
    border: 1px solid transparent !important;
    background: transparent !important;
    color: var(--mmxx-text, #475569) !important;
    border-radius: 0 !important;
    font-weight: 500 !important;
    font-size: .85rem !important;
    cursor: pointer;
    transition: background .12s, color .12s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: none !important;
}
#trendMediaModal .mmxx-pagination button:hover:not(:disabled) {
    background: rgba(15,23,42,.05) !important;
    color: var(--mmxx-text, #1e293b) !important;
    border-color: transparent !important;
}
#trendMediaModal .mmxx-pagination button.mmxx-page-active {
    background: var(--mmxx-primary, #6576ff) !important;
    border-color: var(--mmxx-primary, #6576ff) !important;
    color: #fff !important;
    box-shadow: none !important;
}
#trendMediaModal .mmxx-pagination button:disabled { opacity: .35; cursor: not-allowed; }
#trendMediaModal .mmxx-pagination .mmxx-page-ellipsis { padding: 0 .25rem; color: var(--mmxx-muted, #94a3b8); }
#trendMediaModal .mmxx-pagination .mmxx-page-info {
    margin-inline-start: auto;
    font-size: .8rem;
    color: var(--mmxx-muted, #94a3b8);
    font-weight: 400;
}

#trendMediaModal .mmxx-footer {
    padding: .85rem 1.25rem !important;
    background: var(--mmxx-bg, #fff) !important;
    border-top: 1px solid rgba(15,23,42,.06) !important;
    flex-shrink: 0 !important;
    display: flex;
    gap: .5rem;
    justify-content: flex-end;
}
#trendMediaModal .mmxx-btn {
    border-radius: 0 !important;
    padding: .55rem 1.1rem !important;
    font-weight: 500 !important;
    font-size: .9rem !important;
    transition: background .12s, color .12s, border-color .12s;
    border: 1px solid transparent !important;
    box-shadow: none !important;
}
#trendMediaModal .mmxx-btn-primary { background: var(--mmxx-primary, #6576ff) !important; color: #fff !important; border-color: var(--mmxx-primary, #6576ff) !important; }
#trendMediaModal .mmxx-btn-primary:hover:not(:disabled) { background: #5566ee !important; border-color: #5566ee !important; }
#trendMediaModal .mmxx-btn-secondary { background: rgba(15,23,42,.05) !important; color: var(--mmxx-text, #1e293b) !important; }
#trendMediaModal .mmxx-btn-secondary:hover:not(:disabled) { background: rgba(15,23,42,.09) !important; }
#trendMediaModal .mmxx-btn-cancel { background: transparent !important; color: var(--mmxx-muted, #64748b) !important; border-color: rgba(15,23,42,.12) !important; }
#trendMediaModal .mmxx-btn-cancel:hover { background: rgba(15,23,42,.04) !important; color: var(--mmxx-text, #1e293b) !important; }
#trendMediaModal .mmxx-btn-select:not(:disabled) { background: var(--mmxx-primary, #6576ff) !important; color: #fff !important; border-color: var(--mmxx-primary, #6576ff) !important; }
#trendMediaModal .mmxx-btn-select:not(:disabled):hover { background: #5566ee !important; border-color: #5566ee !important; }
#trendMediaModal .mmxx-btn-select:disabled { background: rgba(15,23,42,.05) !important; color: var(--mmxx-muted, #94a3b8) !important; }

#trendMediaModal .mmxx-tab-body {
    padding: 1.25rem !important;
    background: var(--mmxx-bg, #fff) !important;
    overflow: auto;
    flex: 1 1 auto;
    min-height: 0;
}

#trendMediaModal  input[type="text"],
#trendMediaModal  input[type="search"],
#trendMediaModal  input[type="url"],
#trendMediaModal  input[type="email"],
#trendMediaModal  input[type="number"],
#trendMediaModal  input[type="file"],
#trendMediaModal  textarea,
#trendMediaModal  select {
    border-radius: 0 !important;
    border: 1px solid rgba(15,23,42,.10) !important;
    padding: .55rem .8rem !important;
    background: var(--mmxx-bg, #fff) !important;
    color: var(--mmxx-text, #1e293b) !important;
    font-size: .9rem !important;
    transition: border-color .12s, box-shadow .12s !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
    font-family: inherit !important;
    font-weight: 400 !important;
}
#trendMediaModal  input:focus,
#trendMediaModal  textarea:focus,
#trendMediaModal  select:focus {
    border-color: var(--mmxx-primary, #6576ff) !important;
    box-shadow: 0 0 0 3px rgba(101,118,255,.12) !important;
    outline: none !important;
}
#trendMediaModal  input::placeholder,
#trendMediaModal  textarea::placeholder {
    color: var(--mmxx-muted, #94a3b8) !important;
    opacity: 1;
    font-weight: 400;
}
#trendMediaModal  input[type="file"] { padding: .4rem .55rem !important; cursor: pointer; }
#trendMediaModal  label {
    color: var(--mmxx-text, #334155) !important;
    font-size: .85rem !important;
    font-weight: 500 !important;
    display: inline-block;
    margin-bottom: .25rem;
}
#trendMediaModal  fieldset {
    border-radius: 0 !important;
    border: 1px solid rgba(15,23,42,.08) !important;
    padding: .7rem 1rem !important;
    background: transparent !important;
}
#trendMediaModal  fieldset legend {
    font-size: .78rem !important;
    color: var(--mmxx-muted, #94a3b8) !important;
    font-weight: 500 !important;
    padding: 0 .4rem !important;
}
#trendMediaModal  .mmxx-radio {
    background: transparent;
    border: 1px solid rgba(15,23,42,.10);
    border-radius: 0;
    padding: .3rem .65rem !important;
    transition: border-color .12s;
    font-size: .85rem !important;
}
#trendMediaModal  .mmxx-radio:hover { border-color: rgba(101,118,255,.4); }
#trendMediaModal  .mmxx-radio input[type="radio"] { accent-color: var(--mmxx-primary, #6576ff); margin-inline-end: .25rem; }
#trendMediaModal  .mmxx-uploader,
#trendMediaModal  .mmxx-uploader-url {
    border-radius: 0 !important;
    border: 1px solid rgba(15,23,42,.08) !important;
    background: var(--mmxx-bg, #fff) !important;
    padding: 1rem !important;
    gap: .6rem !important;
    box-shadow: none !important;
}
#trendMediaModal  [id$="-upload-label"] {
    border-radius: 0 !important;
    border: 1px dashed rgba(15,23,42,.18) !important;
    background: rgba(15,23,42,.02) !important;
    padding: 1rem !important;
    transition: border-color .12s, background .12s;
    color: var(--mmxx-muted, #64748b) !important;
}
#trendMediaModal  [id$="-upload-label"]:hover {
    border-color: var(--mmxx-primary, #6576ff) !important;
    background: rgba(101,118,255,.04) !important;
    color: var(--mmxx-text, #1e293b) !important;
}

/* File-selected state: green/success accent */
#trendMediaModal  [id$="-upload-label"][data-file-selected="true"] {
    border: 1px solid #16a34a !important;
    background: rgba(22,163,74,.06) !important;
    color: #15803d !important;
    text-align: start !important;
    padding: .85rem 1rem !important;
    display: flex !important;
    align-items: center !important;
    gap: .75rem !important;
}
#trendMediaModal  [id$="-upload-label"][data-file-selected="true"] i,
#trendMediaModal  [id$="-upload-label"][data-file-selected="true"] em { display: none !important; }
#trendMediaModal  [id$="-upload-label"][data-file-selected="true"]::before {
    content: '✓';
    flex-shrink: 0;
    width: 24px; height: 24px;
    background: #16a34a;
    color: #fff;
    border-radius: 50% !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
    font-weight: 700;
}
#trendMediaModal  [id$="-upload-label"][data-file-selected="true"] span,
#trendMediaModal  [id$="-upload-label"][data-file-selected="true"] [id$="-upload-label-text"] {
    flex: 1 1 auto;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight: 500;
    color: #15803d !important;
}
#trendMediaModal  [id$="-upload-label"][data-file-selected="true"]::after {
    content: 'تغيير';
    flex-shrink: 0;
    font-size: .78rem;
    padding: .25rem .55rem;
    border-radius: 6px;
    background: rgba(22,163,74,.12);
    color: #15803d;
    font-weight: 500;
}

/* === Field layout: clean two-column grid === */
#trendMediaModal  .mmxx-upload-fields {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: .85rem !important;
    width: 100% !important;
}
#trendMediaModal  .mmxx-upload-fields > * {
    flex: unset !important;
    width: 100% !important;
    min-width: 0 !important;
    margin: 0 !important;
}
/* file picker spans full width — it's the prominent field */
#trendMediaModal  .mmxx-upload-fields > *:has(> [id$="-upload-label"]),
#trendMediaModal  .mmxx-upload-fields > *:has([id$="-upload-input"]) {
    grid-column: 1 / -1 !important;
}

/* Import-by-URL row layout: URL on its own row, name+alt side-by-side */
#trendMediaModal  .mmxx-uploader-url > div:first-of-type {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: .75rem !important;
    margin-bottom: .85rem !important;
}
#trendMediaModal  .mmxx-uploader-url > div:first-of-type > *:first-child {
    grid-column: 1 / -1 !important;
}
#trendMediaModal  .mmxx-uploader-url > div:first-of-type > * { flex: unset !important; width: 100% !important; min-width: 0 !important; }

/* Radio group: even spacing */
#trendMediaModal  .mmxx-url-type-group > div {
    display: flex !important;
    flex-wrap: wrap;
    gap: .5rem !important;
}

/* Action button rows */
#trendMediaModal  .mmxx-uploader-actions {
    display: flex !important;
    gap: .5rem !important;
    justify-content: flex-end !important;
    margin-top: .25rem !important;
    width: 100% !important;
    padding-top: .75rem;
    border-top: 1px solid rgba(15,23,42,.06);
}

/* Tab body single column constraint for narrow modals */
@media (max-width: 640px) {
    #trendMediaModal  .mmxx-upload-fields,
    #trendMediaModal  .mmxx-uploader-url > div:first-of-type {
        grid-template-columns: 1fr !important;
    }
    #trendMediaModal  .mmxx-uploader-actions { flex-direction: column; }
    #trendMediaModal  .mmxx-uploader-actions .mmxx-btn { width: 100%; }
}

@media (max-width: 600px) {
    #trendMediaModal .mmxx-pagination .mmxx-page-info { width: 100%; text-align: center; margin-top: .25rem; }
    #trendMediaModal .mmxx-grid { grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)) !important; }
    #trendMediaModal .mmxx-thumb { height: 110px !important; }
}
/* === END MMX-UI-ENHANCE-V2 === */
</style>
<script>
(function() {
    if (window.__mxxFileSelectedHook) return;
    window.__mxxFileSelectedHook = true;
    document.addEventListener('change', function(e) {
        const input = e.target;
        if (!input || input.type !== 'file' || !input.id || !input.id.endsWith('-upload-input')) return;
        const labelId = input.id.replace('-upload-input', '-upload-label');
        const label = document.getElementById(labelId);
        if (!label) return;
        const file = input.files && input.files[0];
        if (file) {
            label.setAttribute('data-file-selected', 'true');
            const txtId = labelId + '-text';
            const txtEl = document.getElementById(txtId) || label.querySelector('span');
            if (txtEl) txtEl.textContent = file.name;
            else {
                const span = document.createElement('span');
                span.textContent = file.name;
                label.appendChild(span);
            }
        } else {
            label.removeAttribute('data-file-selected');
        }
    }, true);
})();
</script>
<style>
</style>
<script>
(function() {
    if (window.__mxxFileSelectedHook) return;
    window.__mxxFileSelectedHook = true;
    document.addEventListener('change', function(e) {
        const input = e.target;
        if (!input || input.type !== 'file' || !input.id || !input.id.endsWith('-upload-input')) return;
        const labelId = input.id.replace('-upload-input', '-upload-label');
        const label = document.getElementById(labelId);
        if (!label) return;
        const file = input.files && input.files[0];
        if (file) {
            label.setAttribute('data-file-selected', 'true');
            const txtId = labelId + '-text';
            const txtEl = document.getElementById(txtId) || label.querySelector('span');
            if (txtEl) txtEl.textContent = file.name;
            else {
                const span = document.createElement('span');
                span.textContent = file.name;
                label.appendChild(span);
            }
        } else {
            label.removeAttribute('data-file-selected');
        }
    }, true);
})();
</script>
<style>
</style>
<script>
(function() {
    if (window.__mxxFileSelectedHook) return;
    window.__mxxFileSelectedHook = true;
    document.addEventListener('change', function(e) {
        const input = e.target;
        if (!input || input.type !== 'file' || !input.id || !input.id.endsWith('-upload-input')) return;
        const labelId = input.id.replace('-upload-input', '-upload-label');
        const label = document.getElementById(labelId);
        if (!label) return;
        const file = input.files && input.files[0];
        if (file) {
            label.setAttribute('data-file-selected', 'true');
            const txtId = labelId + '-text';
            const txtEl = document.getElementById(txtId) || label.querySelector('span');
            if (txtEl) txtEl.textContent = file.name;
            else {
                const span = document.createElement('span');
                span.textContent = file.name;
                label.appendChild(span);
            }
        } else {
            label.removeAttribute('data-file-selected');
        }
    }, true);
})();
</script>
<style>
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

    <!-- ======================= TREND MODAL SCRIPT ======================= -->
    <script>
        (() => {
            const FETCH_URL = "{{ route('dashboard.media.getAllMediaPaginated') }}";
            const UPLOAD_URL = "{{ route('dashboard.media.store') }}";
            const IMPORT_URL = "{{ route('dashboard.media_url.store') }}";

            const modal = document.getElementById("trendMediaModal");
            const backdrop = modal.querySelector("[data-mmxx-backdrop]");
            const closes = modal.querySelectorAll("[data-mmxx-close]");
            const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            const listEl = document.getElementById("mmxx-list");
            const loaderEl = document.getElementById("mmxx-loader");
            const paginationEl = document.getElementById("mmxx-pagination");
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
                lastPage: 1,
                total: 0,
                isLoading: false,
                search: "",
                list: [],
                selected: null,
                activeTab: 'gallery'
            };

            // Initialize image preview for existing image
            function initializeImagePreview() {
                const imageUrl = document.getElementById("image").value;
                if (imageUrl) {
                    renderImagePreview();
                }
            }

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
                await loadPage(1);
            }

            async function loadPage(pageNum) {
                if (state.isLoading) return;
                state.isLoading = true;
                loaderEl.hidden = false;
                try {
                    const url = new URL(FETCH_URL, window.location.origin);
                    url.searchParams.set("page", pageNum);
                    url.searchParams.set("search", state.search.trim());
                    if (state.type) url.searchParams.set("type", state.type);
                    const res = await fetch(url.toString(), { headers: { Accept: "application/json" } });
                    const data = await res.json();
                    state.list = Array.isArray(data.data) ? data.data : [];
                    state.page = data.current_page || pageNum;
                    state.lastPage = data.last_page || 1;
                    state.total = data.total || 0;
                } catch (err) {
                    console.error(err);
                    state.list = [];
                } finally {
                    state.isLoading = false;
                    loaderEl.hidden = true;
                    renderList();
                    renderPagination();
                }
            }

            function renderPagination() {
                if (!paginationEl) return;
                paginationEl.innerHTML = "";
                if (state.lastPage <= 1) return;
                const cur = state.page, last = state.lastPage;
                const mkBtn = (label, page, opts = {}) => {
                    const b = document.createElement("button");
                    b.type = "button";
                    b.textContent = label;
                    if (opts.active) b.classList.add("mmxx-page-active");
                    if (opts.disabled) b.disabled = true;
                    else b.addEventListener("click", () => loadPage(page));
                    return b;
                };
                paginationEl.appendChild(mkBtn("«", cur - 1, { disabled: cur <= 1 }));
                const pages = new Set([1, last, cur, cur - 1, cur + 1]);
                const sorted = [...pages].filter(x => x >= 1 && x <= last).sort((a, b) => a - b);
                let prev = 0;
                for (const pg of sorted) {
                    if (pg - prev > 1) {
                        const span = document.createElement("span");
                        span.className = "mmxx-page-ellipsis";
                        span.textContent = "…";
                        paginationEl.appendChild(span);
                    }
                    paginationEl.appendChild(mkBtn(String(pg), pg, { active: pg === cur }));
                    prev = pg;
                }
                paginationEl.appendChild(mkBtn("»", cur + 1, { disabled: cur >= last }));
                const info = document.createElement("span");
                info.className = "mmxx-page-info";
                info.textContent = `صفحة ${cur} من ${last} — ${state.total} عنصر`;
                paginationEl.appendChild(info);
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
            const imageUrlInput = document.getElementById("trendImageUrl");
            const imagePreview = document.getElementById("trendImagePreview");
            const imageHiddenInput = document.getElementById("image");
            const btnPickImage = document.getElementById("btnPickTrendImage");
            const btnClearImage = document.getElementById("btnClearTrendImage");

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
                let file0 = files[0];
            if (window.compressImage && /^image\//i.test(file0.type)) {
                try { file0 = await window.compressImage(file0); } catch (_) {}
            }
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
                        switchTab('gallery');

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
                        switchTab('gallery');

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

                    if (!uploadName.value) {
                        const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                        uploadName.value = nameWithoutExt;
                        uploadAlt.value = nameWithoutExt;
                    }
                } else {
                    uploadLabelText.textContent = 'اختر ملف الصورة';
                    uploadLabel.style.border = '1px dashed var(--az-border)';
                }
            });

            // Initialize
            document.addEventListener('DOMContentLoaded', function() {
                initializeImagePreview();
                if (!state.list.length) listEl.innerHTML = `<div class="mmxx-empty">لا توجد صور للعرض</div>`;
            });
        })();
    </script>

@endsection
