@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل محتوى')

@section('content')

    <style>
        /* ===== VALIDATION STYLES ===== */
        .hidden-input:invalid~.selected-item {
            border-color: var(--bs-form-invalid-color);
        }

        .search-container:has(.hidden-input:invalid) .form-label {
            color: var(--bs-form-invalid-color);
        }

        .required-field::after {
            content: " *";
            color: var(--bs-danger);
        }

        .search-container {
            transition: all 0.2s ease;
        }

        .required-field::after {
            content: " *";
            color: var(--bs-danger);
        }

        /* ===== SELECT2 RTL SUPPORT ===== */
        .select2-indropdown-rtl {
            direction: rtl !important;
            text-align: right !important;
        }

        .select2-container--default .select2-selection--single {
            direction: rtl;
            text-align: right;
        }

        .select2-container--default .select2-results>.select2-results__options {
            direction: rtl;
            text-align: right;
        }

        /* ===== SINGLE SELECT FIELDS (Section, Category, etc.) ===== */
        .selected-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border: 1px solid var(--bs-border-color);
            border-radius: 0px;
            background-color: var(--bs-secondary-bg);
            margin: 0px;
            color: var(--bs-body-color);
        }

        .btn-delete {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: var(--bs-secondary-color);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-delete:hover {
            background-color: var(--bs-tertiary-bg);
            color: var(--bs-danger);
        }

        /* ===== LAYOUT STYLES ===== */
        .fields-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .fields-row .search-wrapper {
            flex: 1;
        }

        @media (max-width: 768px) {
            .fields-row {
                flex-direction: column;
                gap: 10px;
            }
        }

        /* ===== TAB STYLES ===== */
        .tab-content {
            min-height: 400px;
        }

        #contentTabs .nav-link {
            color: var(--bs-secondary-color) !important;
            background-color: transparent !important;
            border: none !important;
            border-bottom: 2px solid transparent !important;
            transition: all 0.2s ease;
            margin-right: 10px;
            padding: 10px 15px;
        }

        #contentTabs .nav-link:hover {
            border-bottom: 2px solid var(--bs-border-color) !important;
        }

        #contentTabs .nav-link.active {
            color: var(--bs-primary) !important;
            border-bottom: 2px solid var(--bs-primary) !important;
            font-weight: bold;
        }

        #contentTabs {
            border-bottom: 1px solid var(--bs-border-color);
            margin-bottom: 20px;
        }

        /* ===== RIGHT SIDEBAR STYLES ===== */
        .col-md-3 {
            padding-left: 15px;
        }

        .card {
            margin-bottom: 20px;
            box-shadow: var(--bs-box-shadow-sm);
            border: 1px solid var(--bs-border-color);
            background-color: var(--bs-body-bg);
        }

        .card-header {
            background-color: var(--bs-secondary-bg);
            border-bottom: 1px solid var(--bs-border-color);
            color: var(--bs-heading-color);
        }

        /* ===== FORM ELEMENT STYLES ===== */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-text {
            font-size: 0.75rem;
            color: var(--bs-secondary-color);
        }

        /* ===== SEARCH inDROPDOWN STYLES ===== */
        .search-container {
            position: relative;
            width: 100%;
            margin-top: 10px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 0px;
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
            color: var(--bs-body-color);
        }

        .form-control:focus {
            background-color: var(--bs-body-bg);
            border-color: var(--bs-primary);
            color: var(--bs-body-color);
            box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
        }

        .indropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            border-radius: 0px;
            background: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: var(--bs-box-shadow);
            margin-top: 5px;
        }

        .indropdown ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .indropdown li {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid var(--bs-border-color);
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            transition: all 0.2s ease;
        }

        .indropdown li:hover {
            background-color: var(--bs-tertiary-bg);
            color: var(--bs-body-color);
        }

        .indropdown li.selected {
            background-color: var(--bs-primary-bg-subtle);
            color: var(--bs-primary-text-emphasis);
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
            display: block;
        }

        .input-wrapper.hidden {
            display: none !important;
        }

        .btn-add {
            position: absolute;
            top: 50%;
            left: 8px;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            z-index: 2;
            color: var(--bs-secondary-color);
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-add:hover {
            color: var(--bs-primary);
        }

        /* ===== TAGS (MULTI-SELECT) STYLES ===== */
        .multi-select-container {
            margin-bottom: 15px;
            position: relative;
        }

        .tags-selected-container {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            padding: 6px 8px;
            min-height: 42px;
            border: 1px solid var(--bs-border-color);
            border-radius: 0px;
            background: var(--bs-body-bg);
            align-items: center;
            margin-top: 0;
        }

        .tag-item {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 6px;
            border: 1px solid var(--bs-border-color);
            border-radius: 0px;
            background-color: var(--bs-secondary-bg);
            font-size: 11px;
            line-height: 1.2;
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--bs-body-color);
        }

        .tag-delete {
            background: none;
            border: none;
            font-size: 12px;
            cursor: pointer;
            color: var(--bs-secondary-color);
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            flex-shrink: 0;
            line-height: 1;
        }

        .tag-delete:hover {
            background-color: var(--bs-danger);
            color: var(--bs-white);
        }

        .tags-search-container {
            position: relative;
        }

        .tags-input-wrapper {
            position: relative;
            display: block;
        }

        .tags-input-wrapper.hidden {
            display: none !important;
        }

        #tags_id_search {
            border: none;
            outline: none;
            background: transparent;
            padding: 0;
            margin: 0;
            min-width: 120px;
            flex: 1;
            color: var(--bs-body-color);
        }

        .tags-selected-container:focus-within {
            border-color: var(--bs-primary);
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
        }

        #tags_id_search::placeholder,
        #tags_id_search::-webkit-input-placeholder,
        #tags_id_search::-moz-placeholder,
        #tags_id_search:-ms-input-placeholder,
        #tags_id_search:-moz-placeholder {
            color: transparent;
        }

        /* ===== SOCIAL MEDIA PREVIEW STYLES ===== */
        .social-preview {
            border: 1px solid var(--bs-border-color);
            font-family: Helvetica, Arial, sans-serif;
            max-width: 500px;
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        .image-preview-container {
            min-height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            background-color: var(--bs-secondary-bg);
        }

        .image-preview-container:hover {
            background-color: var(--bs-tertiary-bg);
        }

        .btn-danger {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        #preview_image_container {
            max-height: 300px;
            overflow: hidden;
        }

        .image-preview-wrapper {
            position: relative;
            display: inline-block;
        }

        .delete-image-btn {
            position: absolute;
            top: 5px;
            left: 5px;
            background: rgba(220, 53, 69, 0.9);
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .delete-image-btn:hover {
            opacity: 1;
        }

        /* ===== FORM LABELS AND TEXT ===== */
        .form-label {
            color: var(--bs-heading-color);
        }

        .text-muted {
            color: var(--bs-secondary-color) !important;
        }

        /* ===== ALERT STYLES ===== */
        .alert-danger {
            background-color: var(--bs-danger-bg-subtle);
            border-color: var(--bs-danger-border-subtle);
            color: var(--bs-danger-text-emphasis);
        }

        /* ===== MODAL STYLES ===== */
        .modal-content {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        .modal-header {
            border-bottom-color: var(--bs-border-color);
        }

        .modal-footer {
            border-top-color: var(--bs-border-color);
        }

        /* ===== PROGRESS BAR STYLES ===== */
        .progress {
            background-color: var(--bs-secondary-bg);
        }

        .progress-bar {
            background-color: var(--bs-danger);
        }

        .border {
            border-color: var(--bs-border-color) !important;
        }

        .text-muted {
            color: var(--bs-secondary-color) !important;
        }
    </style>

    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                {{-- ============================ CONTENT FORM ============================ --}}
                <form class="nk-content container row" action="{{ route('dashboard.content.update', $content->id) }}"
                    method="POST" enctype="multipart/form-data" id="contentForm">
                    @csrf
                    @method('PUT')

                    {{-- ===== LEFT COLUMN (MAIN CONTENT) ===== --}}
                    <div class="col-md-9">

                        {{-- ===== PAGE HEADER ===== --}}
                        <div class="nk-block-head mb-4">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-ar="تعديل محتوى" data-en="Edit Content">
                                    تعديل محتوى
                                </h4>
                            </div>
                        </div>

                        {{-- ===== SWEETALERT FOR VALIDATION ERRORS ===== --}}
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        @if ($errors->any())
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'حدث خطأ',
                                        html: `{!! implode('<br>', $errors->all()) !!}`,
                                        confirmButtonText: 'حسناً'
                                    });
                                });
                            </script>
                        @endif

                        @if (session('success'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // المفاتيح الخاصة بالعناصر فقط
                                    const itemKeys = [
                                        'az_items_list_v1',
                                        'az_items_file_v1',
                                        'az_display_method_v6',
                                        'mediaManagerState'
                                    ];

                                    itemKeys.forEach(k => localStorage.removeItem(k));
                                });
                            </script>
                        @endif

                        {{-- ===== TEMPLATE HIDDEN FIELD ===== --}}
                        <input type="hidden" name="template" id="template_field"
                            value="{{ old('template', $content->template ?? 'default') }}">

                        {{-- ===== CONTENT TABS NAVIGATION ===== --}}
                        <ul class="nav mb-4" id="contentTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="add-content-tab" data-bs-toggle="tab"
                                    data-bs-target="#add-content" type="button" role="tab" aria-controls="add-content"
                                    aria-selected="true" data-ar="تعديل محتوى" data-en="Edit Content">
                                    تعديل محتوى
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="template-tab" data-bs-toggle="tab" data-bs-target="#template"
                                    type="button" role="tab" aria-controls="template" aria-selected="false"
                                    data-ar="اختر القالب" data-en="Choose Template">
                                    اختر القالب
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media"
                                    type="button" role="tab" aria-controls="media" aria-selected="false"
                                    data-ar="الوسائط" data-en="Media">
                                    الوسائط
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="social-media-tab" data-bs-toggle="tab"
                                    data-bs-target="#social-media" type="button" role="tab"
                                    aria-controls="social-media" aria-selected="false" data-ar="وسائل التواصل"
                                    data-en="Social Media">
                                    وسائل التواصل
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="message-tab" data-bs-toggle="tab" data-bs-target="#message"
                                    type="button" role="tab" aria-controls="message" aria-selected="false"
                                    data-ar="رسالة المراجعة" data-en="Review Message">
                                    رسالة المراجعة
                                </button>
                            </li>
                        </ul>

                        {{-- ===== TAB CONTENT ===== --}}
                        <div class="tab-content" id="contentTabsContent">

                            {{-- ===== ADD CONTENT TAB ===== --}}
                            <div class="tab-pane fade show active" id="add-content" role="tabpanel"
                                aria-labelledby="add-content-tab">

                                {{-- TITLE FIELDS --}}
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label class="form-label" for="title" data-ar="العنوان" data-en="Title">
                                            العنوان
                                        </label>
                                        <span style="color:var(--bs-danger);">*</span>
                                        <div class="form-control-wrap">
                                            <input required id="title" name="title" type="text"
                                                class="form-control form-control" maxlength="68" data-ar="العنوان"
                                                data-en="Title" value="{{ old('title', $content->title) }}">
                                        </div>
                                        <small class="text-muted"><span
                                                id="title-count">{{ strlen(old('title', $content->title)) }}</span> /
                                            68</small>
                                    </div>

                                    <div class="form-group col-12">
                                        <label class="form-label" for="long_title" data-ar="العنوان الطويل"
                                            data-en="Long Title">
                                            العنوان الطويل
                                        </label>
                                        <span style="color:var(--bs-danger);">*</span>
                                        <div class="form-control-wrap">
                                            <input required id="long_title" name="long_title" type="text"
                                                class="form-control form-control" maxlength="210"
                                                data-ar="العنوان الطويل" data-en="Long Title"
                                                value="{{ old('long_title', $content->long_title) }}">
                                        </div>
                                        <small class="text-muted"><span
                                                id="long_title-count">{{ strlen(old('long_title', $content->long_title)) }}</span>
                                            / 210</small>
                                    </div>

                                    <div class="form-group col-12">
                                        <label class="form-label" for="mobile_title" data-ar="عنوان الموبايل"
                                            data-en="Mobile Title">
                                            عنوان الموبايل
                                        </label>
                                        <span style="color:var(--bs-danger);">*</span>
                                        <div class="form-control-wrap">
                                            <input required id="mobile_title" name="mobile_title" type="text"
                                                class="form-control form-control" maxlength="40" data-ar="عنوان الموبايل"
                                                data-en="Mobile Title"
                                                value="{{ old('mobile_title', $content->mobile_title) }}">
                                        </div>
                                        <small class="text-muted"><span
                                                id="mobile_title-count">{{ strlen(old('mobile_title', $content->mobile_title)) }}</span>
                                            / 40</small>
                                    </div>
                                </div>

                                {{-- ===== FIRST ROW: SECTION, CATEGORY, COUNTRY, CONTINENT ===== --}}
                                <div class="fields-row">
                                    <!-- Section -->
                                    <div class="search-wrapper">
                                        <div class="search-container category-selector">
                                            <label class="form-label required-field" for="section" data-ar="القسم"
                                                data-en="Section">القسم</label>
                                            <input type="hidden" name="section_id" required class="hidden-input"
                                                value="{{ old('section_id', $content->section_id) }}">
                                            <div class="selected-item"
                                                style="{{ old('section_id', $content->section_id) ? 'display: flex;' : 'display: none;' }}">
                                                <span class="selected-value">
                                                    @if ($content->section)
                                                        {{ $content->section->name }}
                                                    @endif
                                                </span>
                                                <button type="button" class="btn-delete"
                                                    onclick="clearSelection(this)">×</button>
                                            </div>
                                            <div class="input-wrapper"
                                                style="{{ old('section_id', $content->section_id) ? 'display: none;' : 'display: block;' }}">
                                                <input id="section_search" type="text"
                                                    class="form-control search-input" oninput="filterList(this)"
                                                    onfocus="showinDropdown(this)">
                                            </div>
                                            <div class="indropdown">
                                                <ul>
                                                    @foreach ($sections as $section)
                                                        <li data-id="{{ $section->id }}"
                                                            data-name="{{ $section->name }}"
                                                            onclick="selectItem(this, '{{ $section->name }}', '{{ $section->id }}')"
                                                            {{ old('section_id', $content->section_id) == $section->id ? 'class=selected' : '' }}>
                                                            {{ $section->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Category -->
                                    <div class="search-wrapper">
                                        <div class="search-container category-selector">
                                            <label class="form-label required-field" for="category" data-ar="الصنف"
                                                data-en="category">الصنف</label>
                                            <input type="hidden" name="category_id" required class="hidden-input"
                                                value="{{ old('category_id', $content->category_id) }}">
                                            <div class="selected-item"
                                                style="{{ old('category_id', $content->category_id) ? 'display: flex;' : 'display: none;' }}">
                                                <span class="selected-value">
                                                    @if ($content->category)
                                                        {{ $content->category->name }}
                                                    @endif
                                                </span>
                                                <button type="button" class="btn-delete"
                                                    onclick="clearSelection(this)">×</button>
                                            </div>
                                            <div class="input-wrapper"
                                                style="{{ old('category_id', $content->category_id) ? 'display: none;' : 'display: block;' }}">
                                                <input id="category_search" type="text"
                                                    class="form-control search-input" oninput="filterList(this)"
                                                    onfocus="showinDropdown(this)">
                                                <button type="button" class="btn-add" data-bs-toggle="modal"
                                                    data-bs-target="#addCategoryModal" tabindex="-1">+</button>
                                            </div>
                                            <div class="indropdown">
                                                <ul>
                                                    @foreach ($categories as $category)
                                                        <li data-id="{{ $category->id }}"
                                                            data-name="{{ $category->name }}"
                                                            onclick="selectItem(this, '{{ $category->name }}', '{{ $category->id }}')"
                                                            {{ old('category_id', $content->category_id) == $category->id ? 'class=selected' : '' }}>
                                                            {{ $category->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="search-wrapper">
                                        <div class="search-container category-selector">
                                            <label class="form-label" for="country" data-ar="البلد"
                                                data-en="Country">البلد</label>
                                            <input type="hidden" name="country_id" class="hidden-input"
                                                value="{{ old('country_id', $content->country_id) }}">
                                            <div class="selected-item"
                                                style="{{ old('country_id', $content->country_id) ? 'display: flex;' : 'display: none;' }}">
                                                <span class="selected-value">
                                                    @if ($content->country)
                                                        {{ $content->country->name }}
                                                    @endif
                                                </span>
                                                <button type="button" class="btn-delete"
                                                    onclick="clearSelection(this)">×</button>
                                            </div>
                                            <div class="input-wrapper"
                                                style="{{ old('country_id', $content->country_id) ? 'display: none;' : 'display: block;' }}">
                                                <input id="country_search" type="text"
                                                    class="form-control search-input" oninput="filterList(this)"
                                                    onfocus="showinDropdown(this)">
                                            </div>
                                            <div class="indropdown">
                                                <ul>
                                                    @foreach ($countries as $country)
                                                        <li data-id="{{ $country->id }}"
                                                            data-name="{{ $country->name }}"
                                                            onclick="selectItem(this, '{{ $country->name }}', '{{ $country->id }}')"
                                                            {{ old('country_id', $content->country_id) == $country->id ? 'class=selected' : '' }}>
                                                            {{ $country->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Continent -->
                                    <div class="search-wrapper">
                                        <div class="search-container category-selector">
                                            <label class="form-label" for="continent" data-ar="القارة"
                                                data-en="Continent">القارة</label>
                                            <input type="hidden" name="continent_id" class="hidden-input"
                                                value="{{ old('continent_id', $content->continent_id) }}">
                                            <div class="selected-item"
                                                style="{{ old('continent_id', $content->continent_id) ? 'display: flex;' : 'display: none;' }}">
                                                <span class="selected-value">
                                                    @if ($content->continent)
                                                        {{ $content->continent->name }}
                                                    @endif
                                                </span>
                                                <button type="button" class="btn-delete"
                                                    onclick="clearSelection(this)">×</button>
                                            </div>
                                            <div class="input-wrapper"
                                                style="{{ old('continent_id', $content->continent_id) ? 'display: none;' : 'display: block;' }}">
                                                <input id="continent_search" type="text"
                                                    class="form-control search-input" oninput="filterList(this)"
                                                    onfocus="showinDropdown(this)">
                                            </div>
                                            <div class="indropdown">
                                                <ul>
                                                    @foreach ($continents as $continent)
                                                        <li data-id="{{ $continent->id }}"
                                                            data-name="{{ $continent->name }}"
                                                            onclick="selectItem(this, '{{ $continent->name }}', '{{ $continent->id }}')"
                                                            {{ old('continent_id', $content->continent_id) == $continent->id ? 'class=selected' : '' }}>
                                                            {{ $continent->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===== TREND & WINDOW ROW ===== --}}
                                <div class="fields-row">
                                    <!-- Trend -->
                                    <div class="search-wrapper">
                                        <div class="search-container category-selector">
                                            <label class="form-label" for="trend" data-ar="الترند"
                                                data-en="Trend">الترند</label>
                                            <input type="hidden" name="trend_id" class="hidden-input"
                                                value="{{ old('trend_id', $content->trend_id) }}">
                                            <div class="selected-item"
                                                style="{{ old('trend_id', $content->trend_id) ? 'display: flex;' : 'display: none;' }}">
                                                <span class="selected-value">
                                                    @if ($content->trend)
                                                        {{ $content->trend->title }}
                                                    @endif
                                                </span>
                                                <button type="button" class="btn-delete"
                                                    onclick="clearSelection(this)">×</button>
                                            </div>
                                            <div class="input-wrapper"
                                                style="{{ old('trend_id', $content->trend_id) ? 'display: none;' : 'display: block;' }}">
                                                <input id="trend_search" type="text" class="form-control search-input"
                                                    oninput="filterList(this)" onfocus="showinDropdown(this)">
                                                <button type="button" class="btn-add" data-bs-toggle="modal"
                                                    data-bs-target="#addTrendModal" tabindex="-1">+</button>
                                            </div>
                                            <div class="indropdown">
                                                <ul>
                                                    @foreach ($trends as $trend)
                                                        <li data-id="{{ $trend->id }}"
                                                            data-name="{{ $trend->title }}"
                                                            onclick="selectItem(this, '{{ $trend->title }}', '{{ $trend->id }}')"
                                                            {{ old('trend_id', $content->trend_id) == $trend->id ? 'class=selected' : '' }}>
                                                            {{ $trend->title }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Window -->
                                    <div class="search-wrapper">
                                        <div class="search-container category-selector">
                                            <label class="form-label" for="window" data-ar="النافذة"
                                                data-en="Window">النافذة</label>
                                            <input type="hidden" name="window_id" class="hidden-input"
                                                value="{{ old('window_id', $content->window_id) }}">
                                            <div class="selected-item"
                                                style="{{ old('window_id', $content->window_id) ? 'display: flex;' : 'display: none;' }}">
                                                <span class="selected-value">
                                                    @if ($content->window)
                                                        {{ $content->window->name }}
                                                    @endif
                                                </span>
                                                <button type="button" class="btn-delete"
                                                    onclick="clearSelection(this)">×</button>
                                            </div>
                                            <div class="input-wrapper"
                                                style="{{ old('window_id', $content->window_id) ? 'display: none;' : 'display: block;' }}">
                                                <input id="window_search" type="text"
                                                    class="form-control search-input" oninput="filterList(this)"
                                                    onfocus="showinDropdown(this)">
                                                <button type="button" class="btn-add" data-bs-toggle="modal"
                                                    data-bs-target="#addWindowModal" tabindex="-1">+</button>
                                            </div>
                                            <div class="indropdown">
                                                <ul>
                                                    @foreach ($windows as $window)
                                                        <li data-id="{{ $window->id }}"
                                                            data-name="{{ $window->name }}"
                                                            onclick="selectItem(this, '{{ $window->name }}', '{{ $window->id }}')"
                                                            {{ old('window_id', $content->window_id) == $window->id ? 'class=selected' : '' }}>
                                                            {{ $window->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===== WRITER & WRITER LOCATION ROW ===== --}}
                                <div class="fields-row">
                                    <!-- Writer -->
                                    <div class="search-wrapper">
                                        <div class="search-container category-selector">
                                            <label class="form-label" for="writer" data-ar="الكاتب"
                                                data-en="Writer">الكاتب</label>
                                            <input type="hidden" name="writer_id" class="hidden-input"
                                                value="{{ old('writer_id', $content->writer_id) }}">
                                            <div class="selected-item"
                                                style="{{ old('writer_id', $content->writer_id) ? 'display: flex;' : 'display: none;' }}">
                                                <span class="selected-value">
                                                    @if ($content->writer)
                                                        {{ $content->writer->name }}
                                                    @endif
                                                </span>
                                                <button type="button" class="btn-delete"
                                                    onclick="clearSelection(this)">×</button>
                                            </div>
                                            <div class="input-wrapper"
                                                style="{{ old('writer_id', $content->writer_id) ? 'display: none;' : 'display: block;' }}">
                                                <input id="writer_search" type="text"
                                                    class="form-control search-input" oninput="filterList(this)"
                                                    onfocus="showinDropdown(this)">
                                                <button type="button" class="btn-add" data-bs-toggle="modal"
                                                    data-bs-target="#addWriterModal" tabindex="-1">+</button>
                                            </div>
                                            <div class="indropdown">
                                                <ul>
                                                    @foreach ($writers as $writer)
                                                        <li data-id="{{ $writer->id }}"
                                                            data-name="{{ $writer->name }}"
                                                            onclick="selectItem(this, '{{ $writer->name }}', '{{ $writer->id }}')"
                                                            {{ old('writer_id', $content->writer_id) == $writer->id ? 'class=selected' : '' }}>
                                                            {{ $writer->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Writer Location -->
                                    <div class="search-wrapper">
                                        <div class="search-container category-selector">
                                            <label class="form-label" for="writer_location" data-ar="موقع الكاتب"
                                                data-en="Writer Location">موقع الكاتب</label>
                                            <input type="hidden" name="city_id" class="hidden-input"
                                                value="{{ old('city_id', $content->city_id) }}">
                                            <div class="selected-item"
                                                style="{{ old('city_id', $content->city_id) ? 'display: flex;' : 'display: none;' }}">
                                                <span class="selected-value">
                                                    @if ($content->city)
                                                        {{ $content->city->name }}
                                                    @endif
                                                </span>
                                                <button type="button" class="btn-delete"
                                                    onclick="clearSelection(this)">×</button>
                                            </div>
                                            <div class="input-wrapper"
                                                style="{{ old('city_id', $content->city_id) ? 'display: none;' : 'display: block;' }}">
                                                <input id="writer_location_search" type="text"
                                                    class="form-control search-input" oninput="filterList(this)"
                                                    onfocus="showinDropdown(this)">
                                                <button type="button" class="btn-add" data-bs-toggle="modal"
                                                    data-bs-target="#addWriterLocationModal" tabindex="-1">+</button>
                                            </div>
                                            <div class="indropdown">
                                                <ul>
                                                    @foreach ($cities as $location)
                                                        <li data-id="{{ $location->id }}"
                                                            data-name="{{ $location->name }}"
                                                            onclick="selectItem(this, '{{ $location->name }}', '{{ $location->id }}')"
                                                            {{ old('city_id', $content->city_id) == $location->id ? 'class=selected' : '' }}>
                                                            {{ $location->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===== TAGS ROW (MULTI-SELECT) ===== --}}
                                <div class="fields-row">
                                    <div class="search-wrapper" style="flex: 1;">
                                        <div class="multi-select-container">
                                            <label class="form-label required-field" for="tags_id" data-ar="الوسوم"
                                                data-en="Tags">الوسوم</label>

                                            {{-- SELECTED + SEARCH (SERVER-RENDER OLD TAGS) --}}
                                            @php
                                                $oldTagIds = old('tags_id', $selectedTagIds);
                                                $tagById = $tags->keyBy('id');
                                            @endphp

                                            <div class="tags-search-container">
                                                <div id="tags_id-selected-container" class="tags-selected-container">
                                                    @if (is_array($oldTagIds) && count($oldTagIds))
                                                        @foreach ($oldTagIds as $tid)
                                                            @if (isset($tagById[$tid]))
                                                                <div class="tag-item" data-id="{{ $tid }}">
                                                                    <span
                                                                        class="selected-value">{{ $tagById[$tid]->name }}</span>
                                                                    <button type="button" class="tag-delete"
                                                                        onclick="removeMultiItem(this, '{{ $tid }}', 'tags_id')">×</button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    <div class="tags-input-wrapper">
                                                        <input id="tags_id_search" type="text"
                                                            class="form-control search-input"
                                                            oninput="filterMultiList(this)"
                                                            onfocus="showMultiinDropdown(this)">
                                                        <button type="button" class="btn-add" data-bs-toggle="modal"
                                                            data-bs-target="#addTagModal" tabindex="-1">+</button>
                                                    </div>
                                                </div>

                                                <div class="indropdown">
                                                    <ul id="tags-options-list">
                                                        @foreach ($tags as $tag)
                                                            <li data-id="{{ $tag->id }}"
                                                                data-name="{{ $tag->name }}"
                                                                class="{{ in_array($tag->id, $oldTagIds) ? 'selected' : '' }}"
                                                                onclick="selectMultiItem(this, this.dataset.name, this.dataset.id, 'tags_id')">
                                                                {{ $tag->name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>

                                            {{-- Hidden inputs for selected tags (server-rendered) --}}
                                            <div id="tags_id-hidden-inputs">
                                                @if (is_array($oldTagIds) && count($oldTagIds))
                                                    @foreach ($oldTagIds as $tagId)
                                                        <input type="hidden" name="tags_id[]"
                                                            value="{{ $tagId }}">
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===== SEO KEYWORD FIELD ===== --}}
                                <div class="form-group col-12 mb-3">
                                    <label class="form-label" for="seo_keyword" data-ar="الكلمة الرئيسية"
                                        data-en="SEO Keyword">الكلمة الرئيسية</label>
                                    <span style="color:var(--bs-danger);">*</span>
                                    <div class="form-control-wrap">
                                        <input required id="seo_keyword" name="seo_keyword" type="text"
                                            class="form-control form-control" maxlength="50"
                                            value="{{ old('seo_keyword', $content->seo_keyword) }}">
                                    </div>
                                </div>

                                {{-- ===== SUMMARY FIELD ===== --}}
                                <div class="form-group col-12 my-3">
                                    <label class="form-label" for="summary" data-ar="الملخص"
                                        data-en="Summary">الملخص</label>
                                    <span style="color:var(--bs-danger);">*</span>
                                    <div class="form-control-wrap">
                                        <textarea required id="summary" name="summary" class="form-control form-control" rows="3"
                                            style="max-height: calc(1.5em * 3 + 1rem);" maxlength="130">{{ old('summary', $content->summary) }}</textarea>
                                    </div>
                                    <small class="text-muted"><span
                                            id="summary-count">{{ strlen(old('summary', $content->summary)) }}</span> /
                                        130</small>
                                </div>

                                {{-- ===== BODY CONTENT EDITOR ===== --}}
                                <div class="form-group col-12 mb-3">
                                    <label class="form-label" for="body" data-ar="المتن"
                                        data-en="Body">المتن</label>
                                    <span style="color:var(--bs-danger);">*</span>
                                    <div class="form-control-wrap">
                                        <x-forms.tinymce-editor id="myeditorinstance" :value="old('content', $content->content ?? '')" name="content" />
                                    </div>
                                </div>
                            </div>

                            {{-- ===== TEMPLATE TAB ===== --}}
                            <div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="template-tab">
                                <div class="template-tab-content">
                                    @include('dashboard.components.edit-template-tab')
                                </div>
                            </div>

                            {{-- ===== MEDIA TAB ===== --}}
                            <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                                <div class="media-tab-content">
                                    @include('dashboard.components.edit-media-tab', [
                                        'existing_images' => $existing_images,
                                        'existing_videos' => $existing_videos,
                                        'existing_podcasts' => $existing_podcasts,
                                        'existing_albums' => $existing_albums,
                                    ])
                                </div>
                            </div>

                            {{-- ===== SOCIAL MEDIA TAB ===== --}}
                            @include('dashboard.components.edit-social-media')

                            {{-- ===== MESSAGE TAB ===== --}}
                            <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                                <div class="message-tab-content">
                                    <div class="mb-3">
                                        <label for="message_text" data-ar="رسالة المراجعة" data-en="Review Message">رسالة
                                            المراجعة</label>
                                        <textarea id="message_text" name="review_description" class="form-control">{{ old('review_description', $content->review_description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===== SEO EVALUATION SECTION ===== --}}
                        <div class="mt-4 p-3 border rounded" id="seo-evaluation">
                            <h5 data-ar="تقييم السيو (SEO)" data-en="SEO Evaluation">تقييم السيو (SEO)</h5>
                            <div class="progress" style="height: 20px; margin-bottom:10px;">
                                <div id="seo-bar" class="progress-bar" role="progressbar"
                                    style="width: 0%; background-color: var(--bs-danger);" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div id="seo-text" style="font-weight: bold; margin-bottom: 10px;"
                                data-ar="يرجى كتابة المحتوى لتقييم السيو" data-en="Please write content to evaluate SEO">
                                يرجى كتابة المحتوى لتقييم السيو
                            </div>
                            <div id="seo-feedback" style="display:none;"></div>
                        </div>

                        {{-- ===== SUBMIT BUTTONS ===== --}}
                        <div class="mt-4 d-flex">
                            <button name="status" value="published" type="submit" class="btn btn-primary btn-lg me-3"
                                data-ar="تحديث" data-en="Update" id="publishButton">تحديث</button>
                           
                            <a href="{{ route('news.show', $content->title) }}" target="_blank" class="btn btn-secondary btn-lg"
                                style="margin-left: 10px;">
                                معاينة
                            </a>
                        </div>
                    </div>

                    {{-- ===== RIGHT SIDEBAR ===== --}}
                    <div class="col-md-3 mt-4">
                        <div class="mb-3"
                            style="border: 1px solid var(--bs-border-color); border-radius: 4px; padding: 10px;">
                            <div class="card-body">
                                {{-- CREATION DATE --}}
                                <div class="mb-3">
                                    <label class="form-label d-block mb-2" for="created_at_by_admin"
                                        data-ar="تاريخ الإنشاء" data-en="Created At">تاريخ الإنشاء</label>
                                    <input type="datetime-local" id="created_at_by_admin" name="created_at_by_admin"
                                        class="form-control"
                                        value="{{ old('created_at_by_admin', $content->created_at_by_admin ? \Carbon\Carbon::parse($content->created_at_by_admin)->format('Y-m-d\TH:i') : '') }}">
                                </div>

                                {{-- SCHEDULE PUBLISH --}}
                                <div class="mb-3">
                                    <label class="form-label d-block mb-2" for="publish_at">
                                        <span data-ar="جدولة النشر" data-en="Schedule Publish">جدولة النشر</span>
                                    </label>
                                    <input type="datetime-local" id="publish_at" name="published_at"
                                        class="form-control"
                                        value="{{ old('published_at', $content->published_at ? \Carbon\Carbon::parse($content->published_at)->format('Y-m-d\TH:i') : '') }}"
                                        onclick="this.showPicker && this.showPicker()"
                                        onfocus="this.showPicker && this.showPicker()">
                                </div>

                                {{-- LATEST NEWS CHECKBOX --}}
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_latest"
                                        name="is_latest" {{ old('is_latest', $content->is_latest) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_latest" data-ar="آخر الاخبار"
                                        data-en="Latest news">آخر الاخبار</label>
                                </div>

                                {{-- IMPORTANCE RADIO BUTTONS --}}
                                <div class="mb-3">
                                    <label class="form-label d-block mb-2" for="importance" data-ar="الظهور في الواجهة"
                                        data-en="Display on Frontend">الظهور في الواجهة</label>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="importance"
                                                id="importance1" value="1"
                                                {{ old('importance', $content->importance) == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="importance1" data-ar="صف أول"
                                                data-en="First Row">صف أول</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="importance"
                                                id="importance2" value="2"
                                                {{ old('importance', $content->importance) == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="importance2" data-ar="صف ثانٍ"
                                                data-en="Second Row">صف ثانٍ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>

    {{-- ============================ MODALS ============================ --}}
    {{-- Add Section Modal --}}
    <div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSectionModalLabel">إضافة قسم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSectionForm">@csrf
                        <div class="mb-3"><label for="section_name" class="form-label">اسم القسم</label><input
                                type="text" class="form-control" id="section_name" name="name" required></div>
                        <div class="mb-3"><label for="section_description" class="form-label">الوصف</label>
                            <textarea class="form-control" id="section_description" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">إلغاء</button><button type="button" class="btn btn-primary"
                        onclick="addNewSection()">حفظ</button></div>
            </div>
        </div>
    </div>

    {{-- Add Category Modal --}}
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">إضافة صنف جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">@csrf
                        <div class="mb-3"><label for="category_name" class="form-label">اسم الصنف</label>
                            <input type="text" class="form-control" id="category_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_slug" class="form-label">الرابط المختصر</label>
                            <input type="text" class="form-control" id="category_slug" name="slug"
                                placeholder="مثال: politics" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewCategory()">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Writer Modal --}}
    <div class="modal fade" id="addWriterModal" tabindex="-1" aria-labelledby="addWriterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWriterModalLabel">إضافة كاتب جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addWriterForm" enctype="multipart/form-data">@csrf
                        <div class="mb-3">
                            <label for="writer_name" class="form-label">اسم الكاتب</label>
                            <input type="text" class="form-control" id="writer_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="writer_slug" class="form-label">الرابط المختصر (Slug)</label>
                            <input type="text" class="form-control" id="writer_slug" name="slug"
                                placeholder="مثال: naji-benz" required>
                            <div class="form-text">يُولَّد تلقائيًا من الاسم ويمكن تعديله.</div>
                        </div>
                        <div class="mb-3">
                            <label for="writer_bio" class="form-label">السيرة الذاتية</label>
                            <textarea class="form-control" id="writer_bio" name="bio" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="writer_image" class="form-label">الصورة</label>
                            <input type="file" class="form-control" id="writer_image" name="image"
                                accept=".jpeg,.jpg,.png,.gif,.webp" required>
                            <div class="form-text">الحد الأقصى 2MB. يُقبل: jpeg, png, webp, gif</div>
                        </div>
                        <div class="mb-3">
                            <label for="writer_email" class="form-label">البريد الإلكتروني (اختياري)</label>
                            <input type="email" class="form-control" id="writer_email" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">روابط السوشيال (اختياري)</label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="url" class="form-control" id="writer_facebook" name="facebook"
                                        placeholder="https://facebook.com/username">
                                </div>
                                <div class="col-md-6">
                                    <input type="url" class="form-control" id="writer_x" name="x"
                                        placeholder="https://x.com/username">
                                </div>
                                <div class="col-md-6">
                                    <input type="url" class="form-control" id="writer_instagram" name="instagram"
                                        placeholder="https://instagram.com/username">
                                </div>
                                <div class="col-md-6">
                                    <input type="url" class="form-control" id="writer_linkedin" name="linkedin"
                                        placeholder="https://linkedin.com/in/username">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewWriter(event)">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Writer Location Modal --}}
    <div class="modal fade" id="addWriterLocationModal" tabindex="-1" aria-labelledby="addWriterLocationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWriterLocationModalLabel">إضافة موقع كاتب جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addWriterLocationForm">@csrf
                        <div class="mb-3">
                            <label for="location_name" class="form-label">اسم الموقع</label>
                            <input type="text" class="form-control" id="location_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="location_slug" class="form-label">الرابط المختصر (Slug)</label>
                            <input type="text" class="form-control" id="location_slug" name="slug" required>
                            <div class="form-text">يُولَّد تلقائيًا من الاسم ويمكن تعديله.</div>
                        </div>
                        <input type="hidden" name="type" value="city">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewWriterLocation(event)">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Trend Modal --}}
    <div class="modal fade" id="addTrendModal" tabindex="-1" aria-labelledby="addTrendModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTrendModalLabel">إضافة ترند جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTrendForm" enctype="multipart/form-data">@csrf
                        <div class="mb-3">
                            <label for="trend_title" class="form-label">اسم الترند</label>
                            <input type="text" class="form-control" id="trend_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="trend_slug" class="form-label">الرابط المختصر (Slug)</label>
                            <input type="text" class="form-control" id="trend_slug" name="slug"
                                placeholder="مثال: world-cup-2026" required>
                            <div class="form-text">يُولَّد تلقائيًا من العنوان ويمكن تعديله.</div>
                        </div>
                        <div class="mb-3">
                            <label for="trend_image" class="form-label">الصورة</label>
                            <input type="file" class="form-control" id="trend_image" name="image"
                                accept=".jpeg,.jpg,.png,.webp,.gif" required>
                            <div class="form-text">الحد الأقصى 6MB. يُقبل: jpeg, png, webp, gif</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewTrend(event)">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Window Modal --}}
    <div class="modal fade" id="addWindowModal" tabindex="-1" aria-labelledby="addWindowModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWindowModalLabel">إضافة نافذة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addWindowForm" enctype="multipart/form-data">@csrf
                        <div class="mb-3">
                            <label for="window_name" class="form-label">اسم النافذة</label>
                            <input type="text" class="form-control" id="window_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="window_slug" class="form-label">الرابط المختصر (Slug)</label>
                            <input type="text" class="form-control" id="window_slug" name="slug" required>
                            <div class="form-text">يُولَّد تلقائيًا من الاسم ويمكن تعديله.</div>
                        </div>
                        <div class="mb-3">
                            <label for="window_image" class="form-label">الصورة</label>
                            <input type="file" class="form-control" id="window_image" name="image"
                                accept=".jpeg,.jpg,.png,.webp,.gif" required>
                            <div class="form-text">الحد الأقصى 6MB. يُقبل: jpeg, png, webp, gif</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewWindow(event)">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Tag Modal --}}
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTagModalLabel">إضافة وسم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTagForm">@csrf
                        <div class="mb-3">
                            <label for="tag_name" class="form-label">اسم الوسم</label>
                            <input type="text" class="form-control" id="tag_name" name="name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewTag()">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================ SCRIPTS ============================ --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- External Scripts --}}
    <script src="/dashlite/js/seo.js"></script>
    <script src="/dashlite/js/tabs.js"></script>
    <script src="/dashlite/js/album.js"></script>
    <script src="/dashlite/js/form-toggle.js"></script>
    <script src="/dashlite/js/media-tab.js"></script>

    <script>
        // ========== SINGLE SELECTION FUNCTIONS ==========
        function showinDropdown(input) {
            const container = input.closest('.category-selector');
            const indropdown = container.querySelector('.indropdown');
            indropdown.style.display = 'block';
        }

        function filterList(input) {
            const container = input.closest('.category-selector');
            const indropdown = container.querySelector('.indropdown');
            const filter = input.value.toLowerCase();
            const items = indropdown.querySelectorAll('li');
            let visible = false;

            items.forEach(li => {
                const text = li.textContent.toLowerCase();
                if (text.includes(filter)) {
                    li.style.display = '';
                    visible = true;
                } else {
                    li.style.display = 'none';
                }
            });

            indropdown.style.display = visible ? 'block' : 'none';
        }

        function selectItem(li, value, id) {
            const container = li.closest('.category-selector');
            const selectedDiv = container.querySelector('.selected-item');
            const selectedValue = container.querySelector('.selected-value');
            const inputWrapper = container.querySelector('.input-wrapper');
            const indropdown = container.querySelector('.indropdown');
            const hiddenInput = container.querySelector('.hidden-input');

            selectedValue.textContent = value;
            hiddenInput.value = id;

            selectedDiv.style.display = 'flex';
            inputWrapper.style.display = 'none';
            indropdown.style.display = 'none';

            container.style.border = '';
            container.style.padding = '';
        }

        function clearSelection(button) {
            const container = button.closest('.category-selector');
            const selectedDiv = container.querySelector('.selected-item');
            const inputWrapper = container.querySelector('.input-wrapper');
            const hiddenInput = container.querySelector('.hidden-input');
            const searchInput = container.querySelector('.search-input');

            selectedDiv.style.display = 'none';
            inputWrapper.style.display = 'block';
            hiddenInput.value = '';

            // Clear the search input and focus on it
            if (searchInput) {
                searchInput.value = '';
                searchInput.focus();
            }
        }

        // ========== MULTI-SELECT (TAGS) FUNCTIONS ==========
        function showMultiinDropdown(input) {
            const container = input.closest('.tags-search-container');
            const indropdown = container.querySelector('.indropdown');
            indropdown.style.display = 'block';
        }

        function filterMultiList(input) {
            const container = input.closest('.tags-search-container');
            const indropdown = container.querySelector('.indropdown');
            const filter = input.value.toLowerCase();
            const items = indropdown.querySelectorAll('li');
            let visible = false;

            items.forEach(li => {
                const text = (li.dataset.name || li.textContent).toLowerCase();
                if (text.includes(filter)) {
                    li.style.display = '';
                    visible = true;
                } else {
                    li.style.display = 'none';
                }
            });

            indropdown.style.display = visible ? 'block' : 'none';
        }

        function selectMultiItem(li, value, id, fieldName) {
            const container = li.closest('.multi-select-container');
            const selectedContainer = document.getElementById(fieldName + '-selected-container');
            const hiddenInputsContainer = document.getElementById(fieldName + '-hidden-inputs');
            const searchInput = container.querySelector('.search-input');
            const indropdown = container.querySelector('.indropdown');

            const existingInput = hiddenInputsContainer.querySelector(`input[name="${fieldName}[]"][value="${id}"]`);
            if (existingInput) return;

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = fieldName + '[]';
            hiddenInput.value = id;
            hiddenInputsContainer.appendChild(hiddenInput);

            const selectedItem = document.createElement('div');
            selectedItem.className = 'tag-item';
            selectedItem.setAttribute('data-id', id);
            selectedItem.innerHTML = `
                <span class="selected-value">${value}</span>
                <button type="button" class="tag-delete" onclick="removeMultiItem(this, '${id}', '${fieldName}')">×</button>
            `;
            selectedContainer.insertBefore(selectedItem, selectedContainer.querySelector('.tags-input-wrapper'));

            li.classList.add('selected');

            searchInput.value = '';
            indropdown.style.display = 'none';
            searchInput.focus();

            container.style.border = '';
            container.style.padding = '';
        }

        function removeMultiItem(button, id, fieldName) {
            const selectedContainer = document.getElementById(fieldName + '-selected-container');
            const hiddenInputsContainer = document.getElementById(fieldName + '-hidden-inputs');
            const list = document.getElementById('tags-options-list');

            const hiddenInput = hiddenInputsContainer.querySelector(`input[name="${fieldName}[]"][value="${id}"]`);
            if (hiddenInput) hiddenInput.remove();

            const li = list.querySelector(`li[data-id="${id}"]`);
            if (li) li.classList.remove('selected');

            const selectedItem = button.closest('.tag-item');
            if (selectedItem) selectedItem.remove();
        }

        // ========== UTILITY FUNCTIONS ==========

        // Close indropdowns when clicking outside
        document.addEventListener('click', function(e) {
            document.querySelectorAll('.category-selector').forEach(container => {
                if (!container.contains(e.target)) {
                    const dd = container.querySelector('.indropdown');
                    if (dd) dd.style.display = 'none';
                }
            });
            document.querySelectorAll('.multi-select-container .tags-search-container').forEach(container => {
                if (!container.contains(e.target)) {
                    const dd = container.querySelector('.indropdown');
                    if (dd) dd.style.display = 'none';
                }
            });
        });

        // Initialize from old values
        document.addEventListener('DOMContentLoaded', function() {
            initializeSingleSelect('section_id', {{ (int) old('section_id', $content->section_id) }});
            initializeSingleSelect('category_id', {{ (int) old('category_id', $content->category_id) }});
            initializeSingleSelect('country_id', {{ (int) old('country_id', $content->country_id) }});
            initializeSingleSelect('continent_id', {{ (int) old('continent_id', $content->continent_id) }});
            initializeSingleSelect('writer_id', {{ (int) old('writer_id', $content->writer_id) }});
            initializeSingleSelect('city_id', {{ (int) old('city_id', $content->city_id) }});

            // Trend & Window
            initializeSingleSelect('trend_id', {{ (int) old('trend_id', $content->trend_id) }});
            initializeSingleSelect('window_id', {{ (int) old('window_id', $content->window_id) }});

            // Tags already server-rendered
            initializeCharacterCounters();
            initializeBootstrapTabs();
            updatePreview();
        });

        function initializeSingleSelect(fieldName, oldValue) {
            if (!oldValue) return;
            const hidden = document.querySelector(`input[name="${fieldName}"]`);
            if (!hidden) return;
            const container = hidden.closest('.category-selector');
            if (!container) return;

            const dd = container.querySelector('.indropdown');
            if (!dd) return;
            const li = dd.querySelector(`li[data-id="${oldValue}"]`);
            if (li) {
                selectItem(li, li.dataset.name || li.textContent.trim(), li.dataset.id || String(oldValue));
            }
        }

        function initializeCharacterCounters() {
            const fields = [{
                    id: "title",
                    max: 68
                },
                {
                    id: "long_title",
                    max: 210
                },
                {
                    id: "mobile_title",
                    max: 40
                },
                {
                    id: "summary",
                    max: 130
                }
            ];
            fields.forEach(f => {
                const el = document.getElementById(f.id);
                const counter = document.getElementById(f.id + "-count");
                if (el && counter) {
                    counter.textContent = el.value.length;
                    el.addEventListener("input", function() {
                        counter.textContent = this.value.length;
                    });
                }
            });
        }

        function initializeBootstrapTabs() {
            var triggerTabList = [].slice.call(document.querySelectorAll('#contentTabs button'));
            triggerTabList.forEach(function(triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl);
                triggerEl.addEventListener('click', function(event) {
                    event.preventDefault();
                    tabTrigger.show();
                });
            });
        }

        // ========== FORM VALIDATION ==========
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contentForm');

            form.addEventListener('submit', function(e) {
                let isValid = true;
                const errorMessages = [];

                const sectionInput = document.querySelector('input[name="section_id"]');
                if (!sectionInput.value) {
                    isValid = false;
                    errorMessages.push('يرجى اختيار القسم');
                    highlightField(sectionInput);
                }

                const categoryInput = document.querySelector('input[name="category_id"]');
                if (!categoryInput.value) {
                    isValid = false;
                    errorMessages.push('يرجى اختيار الصنف');
                    highlightField(categoryInput);
                }

                const tagsInputs = document.querySelectorAll('input[name="tags_id[]"]');
                if (tagsInputs.length === 0) {
                    isValid = false;
                    errorMessages.push('يرجى اختيار وسم واحد على الأقل');
                    highlightField(document.getElementById('tags_id-hidden-inputs'));
                }

                if (!isValid) {
                    e.preventDefault();
                    showValidationError(errorMessages.join('<br>'));
                    scrollToFirstError();
                } else {
                    const formData = new FormData(this);
                    for (let [key, value] of formData.entries()) {
                        console.log(key + ': ' + value);
                    }
                }
            });

            function highlightField(input) {
                const container = input.closest('.search-container') || input.closest('.multi-select-container');
                if (container) {
                    container.style.border = '1px solid var(--bs-form-invalid-color)';
                    container.style.borderRadius = '4px';
                    container.style.padding = '4px';
                    setTimeout(() => {
                        container.style.border = '';
                        container.style.padding = '';
                    }, 3000);
                }
            }

            function showValidationError(message) {
                const existingError = document.getElementById('validation-error');
                if (existingError) existingError.remove();

                const errorDiv = document.createElement('div');
                errorDiv.id = 'validation-error';
                errorDiv.className = 'alert alert-danger alert-dismissible fade show';
                errorDiv.innerHTML =
                    `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;

                const firstHeading = form.querySelector('.nk-block-head');
                if (firstHeading) {
                    firstHeading.parentNode.insertBefore(errorDiv, firstHeading.nextSibling);
                } else {
                    form.insertBefore(errorDiv, form.firstChild);
                }
            }

            function scrollToFirstError() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                const firstError = document.querySelector(
                        '.search-container[style*="border: 1px solid"]') ||
                    document.querySelector('.multi-select-container[style*="border: 1px solid"]');
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }
        });

        // ========== TEMPLATE SELECTION ==========
        function selectTemplate(templateName) {
            document.getElementById('template_field').value = templateName;
            document.querySelectorAll('.template-option').forEach(option => option.classList.remove('selected'));
            if (event && event.target) {
                const box = event.target.closest('.template-option');
                if (box) box.classList.add('selected');
            }
        }

        // ========== SHARE IMAGE PREVIEW ==========
        function previewShareImage(input) {
            const file = input.files[0];
            const previewWrapper = document.getElementById('share_image_preview_wrapper');
            const preview = document.getElementById('share_image_preview');
            const placeholder = document.getElementById('share_image_placeholder');
            const fileName = document.getElementById('share_image_name');
            const previewImageContainer = document.getElementById('preview_image_container');
            const previewImage = document.getElementById('preview_image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewImage.src = e.target.result;
                    fileName.textContent = file.name;
                    previewWrapper.classList.remove('d-none');
                    placeholder.classList.add('d-none');
                    previewImageContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                removeShareImage();
            }
        }

        function removeShareImage() {
            const previewWrapper = document.getElementById('share_image_preview_wrapper');
            const placeholder = document.getElementById('share_image_placeholder');
            const fileInput = document.getElementById('share_image');
            const previewImageContainer = document.getElementById('preview_image_container');

            fileInput.value = '';
            previewWrapper.classList.add('d-none');
            placeholder.classList.remove('d-none');
            previewImageContainer.style.display = 'none';
        }

        function updatePreview() {
            const shareTitle = document.getElementById('share_title');
            const shareDescription = document.getElementById('share_description');
            const previewTitle = document.getElementById('preview_title');
            const previewDescription = document.getElementById('preview_description');
            if (shareTitle && previewTitle) previewTitle.textContent = shareTitle.value || 'عنوان المشاركة';
            if (shareDescription && previewDescription) previewDescription.textContent = shareDescription.value ||
                'وصف المشاركة';
        }

        // ========== SLUGIFY HELPER ==========
        function slugify(v) {
            return v.toString().toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '')
                .substring(0, 150);
        }

        // ========== MODAL AJAX FUNCTIONS ==========

        // Add New Writer
        document.addEventListener('DOMContentLoaded', function() {
            const nameI = document.getElementById('writer_name');
            const slugI = document.getElementById('writer_slug');
            if (nameI && slugI) {
                nameI.addEventListener('input', () => {
                    if (!slugI.dataset.touched || slugI.value.trim() === '') {
                        slugI.value = slugify(nameI.value);
                    }
                });
                slugI.addEventListener('input', () => slugI.dataset.touched = '1');
            }
        });

        async function addNewWriter(e) {
            if (e && e.preventDefault) e.preventDefault();

            const form = document.getElementById('addWriterForm');
            const fd = new FormData(form);

            const name = (fd.get('name') || '').trim();
            const slug = (fd.get('slug') || '').trim();
            const bio = (fd.get('bio') || '').trim();
            const file = fd.get('image');

            if (!name) return Swal.fire({
                icon: 'error',
                title: 'تنبيه',
                text: 'يرجى إدخال اسم الكاتب.'
            });
            if (!slug) return Swal.fire({
                icon: 'error',
                title: 'تنبيه',
                text: 'يرجى إدخال الرابط المختصر.'
            });
            if (!bio) return Swal.fire({
                icon: 'error',
                title: 'تنبيه',
                text: 'يرجى إدخال السيرة الذاتية.'
            });
            if (!(file instanceof File) || !file.name) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'يرجى اختيار صورة.'
                });
            }

            const okTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!okTypes.includes(file.type)) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'صيغة الصورة غير مدعومة.'
                });
            }
            if (file.size > 2 * 1024 * 1024) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'حجم الصورة يتجاوز 2MB.'
                });
            }

            try {
                const res = await fetch('/dashboard/api/add-writer', {
                    method: 'POST',
                    body: fd,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json'
                    }
                });

                const ctype = res.headers.get('content-type') || '';
                let data = {};
                if (ctype.includes('application/json')) {
                    data = await res.json();
                } else {
                    const text = await res.text();
                    throw new Error(text || 'استجابة غير صالحة من الخادم');
                }

                if (res.ok && (data.id || (data.writer && data.writer.id))) {
                    const id = data.id || data.writer.id;
                    const name = data.name || (data.writer && data.writer.name);

                    const writerSearch = document.querySelector('#writer_search');
                    if (writerSearch) {
                        const listUl = writerSearch.closest('.search-container')?.querySelector('.indropdown ul');
                        if (listUl) {
                            const li = document.createElement('li');
                            li.dataset.id = String(id);
                            li.dataset.name = name;
                            li.textContent = name;
                            li.onclick = function() {
                                selectItem(li, name, String(id));
                            };
                            listUl.appendChild(li);
                            selectItem(li, name, String(id));
                        }
                    }

                    if (window.$) $('#addWriterModal').modal('hide');
                    form.reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'تمت الإضافة',
                        text: `تم إنشاء الكاتب: ${name}`,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    return;
                }

                if (res.status === 422 && (data.errors || data.messages)) {
                    const all = data.errors || data.messages;
                    const msgs = Object.keys(all).map(k => `• ${k}: ${all[k].join(' / ')}`).join('\n');
                    throw new Error(msgs || 'تحقق من الحقول.');
                }

                throw new Error(data.message || data.error || 'تعذر إضافة الكاتب.');
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: err.message || 'حدث خطأ غير متوقع'
                });
            }
        }

        // Add New Category
        async function addNewCategory(e) {
            if (e && e.preventDefault) e.preventDefault();
            const form = document.getElementById('addCategoryForm');
            const fd = new FormData(form);

            try {
                const res = await fetch('/dashboard/api/add-category', {
                    method: 'POST',
                    body: fd,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json'
                    }
                });

                const contentType = res.headers.get('content-type') || '';
                let data = {};
                if (contentType.includes('application/json')) {
                    data = await res.json();
                } else {
                    const text = await res.text();
                    throw new Error(text || 'استجابة غير صالحة من الخادم');
                }

                if (res.status === 201 && data.id && data.name) {
                    const indropdown = document.querySelector('#category_search')
                        .closest('.search-container')
                        .querySelector('.indropdown ul');

                    const newItem = document.createElement('li');
                    newItem.dataset.id = data.id;
                    newItem.dataset.name = data.name;
                    newItem.textContent = data.name;
                    newItem.onclick = function() {
                        selectItem(this, data.name, data.id);
                    };
                    indropdown.appendChild(newItem);

                    $('#addCategoryModal').modal('hide');
                    form.reset();

                    // Auto select new category
                    selectItem(newItem, data.name, data.id);

                    Swal.fire({
                        icon: 'success',
                        title: 'تم الحفظ',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    return;
                }

                // 422 validation errors
                if (res.status === 422 && data.messages) {
                    const msgs = Object.values(data.messages).flat().join('<br>');
                    return Swal.fire({
                        icon: 'error',
                        title: 'تحقق من الحقول',
                        html: msgs
                    });
                }

                // Other errors (e.g., 500)
                const msg = data.error || data.message || 'تعذر حفظ الصنف';
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: msg
                });
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: err.message || 'حدث خطأ غير متوقع'
                });
            }
        }

        // Add New Tag
        async function addNewTag(e) {
            if (e && e.preventDefault) e.preventDefault();
            const form = document.getElementById('addTagForm');
            const fd = new FormData(form);

            // تأكد أن لدينا قيمة name
            const name = (fd.get('name') || '').trim();
            if (!name) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'يرجى إدخال اسم الوسم.'
                });
            }

            try {
                const res = await fetch('/dashboard/api/add-tag', {
                    method: 'POST',
                    body: fd,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json'
                    }
                });

                const contentType = res.headers.get('content-type') || '';
                let data = {};
                if (contentType.includes('application/json')) {
                    data = await res.json();
                } else {
                    const text = await res.text();
                    throw new Error(text || 'استجابة غير صالحة من الخادم');
                }

                // نجاح متوقع: 201 Created
                if (res.ok && (data.id || (data.tag && data.tag.id))) {
                    const tagId = data.id || data.tag.id;
                    const tagName = data.name || data.tag.name;

                    // أضِف العنصر إلى قائمة الخيارات
                    const list = document.getElementById('tags-options-list');
                    const li = document.createElement('li');
                    li.dataset.id = String(tagId);
                    li.dataset.name = tagName;
                    li.textContent = tagName;
                    li.onclick = function() {
                        selectMultiItem(li, tagName, String(tagId), 'tags_id');
                    };
                    list.appendChild(li);

                    // أغلق المودال وافرغ المدخلات
                    if (window.$) {
                        $('#addTagModal').modal('hide');
                    }
                    form.reset();

                    // اختر الوسم تلقائيًا
                    selectMultiItem(li, tagName, String(tagId), 'tags_id');

                    Swal.fire({
                        icon: 'success',
                        title: 'تمت الإضافة',
                        text: 'تمت إضافة الوسم: ' + tagName,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    return;
                }

                // أخطاء التحقق 422 (Laravel)
                if (res.status === 422 && (data.errors || data.messages)) {
                    const msgs = Object.values(data.errors || data.messages).flat().join('\n');
                    throw new Error(msgs || 'تحقق من الحقول.');
                }

                // أي خطأ آخر من الخادم
                throw new Error(data.message || data.error || 'تعذر إضافة الوسم.');
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: err.message || 'حدث خطأ غير متوقع'
                });
            }
        }

        // Add New Trend
        document.addEventListener('DOMContentLoaded', function() {
            const titleI = document.getElementById('trend_title');
            const slugI = document.getElementById('trend_slug');
            titleI?.addEventListener('input', () => {
                if (!slugI) return;
                if (!slugI.dataset.touched || slugI.value.trim() === '') {
                    slugI.value = slugify(titleI.value);
                }
            });
            slugI?.addEventListener('input', () => slugI.dataset.touched = '1');
        });

        async function addNewTrend(e) {
            if (e && e.preventDefault) e.preventDefault();

            const form = document.getElementById('addTrendForm');
            const fd = new FormData(form);

            const title = (fd.get('title') || '').trim();
            const slug = (fd.get('slug') || '').trim();
            const file = fd.get('image');

            if (!title) return Swal.fire({
                icon: 'error',
                title: 'تنبيه',
                text: 'يرجى إدخال اسم الترند.'
            });
            if (!slug) return Swal.fire({
                icon: 'error',
                title: 'تنبيه',
                text: 'يرجى إدخال الرابط المختصر.'
            });
            if (!(file instanceof File) || !file.name) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'يرجى اختيار صورة.'
                });
            }

            const okTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            if (!okTypes.includes(file.type)) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'صيغة الصورة غير مدعومة.'
                });
            }

            if (file.size > 6 * 1024 * 1024) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'حجم الصورة يتجاوز 6MB.'
                });
            }

            try {
                const res = await fetch('/dashboard/api/add-trend', {
                    method: 'POST',
                    body: fd,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json'
                    }
                });

                const ctype = res.headers.get('content-type') || '';
                let data = {};
                if (ctype.includes('application/json')) {
                    data = await res.json();
                } else {
                    const text = await res.text();
                    throw new Error(text || 'استجابة غير صالحة من الخادم');
                }

                if (res.ok && (data.id || (data.trend && data.trend.id))) {
                    const id = data.id || data.trend.id;
                    const name = data.title || (data.trend && data.trend.title) || title;
                    const slugR = data.slug || (data.trend && data.trend.slug) || slug;

                    const trendSearch = document.querySelector('#trend_search');
                    if (trendSearch) {
                        const listUl = trendSearch.closest('.search-container')?.querySelector('.indropdown ul');
                        if (listUl) {
                            const li = document.createElement('li');
                            li.dataset.id = String(id);
                            li.dataset.name = name;
                            li.textContent = name;
                            li.onclick = function() {
                                selectItem(li, name, String(id));
                            };
                            listUl.appendChild(li);
                            selectItem(li, name, String(id));
                        }
                    }

                    if (window.$) $('#addTrendModal').modal('hide');
                    form.reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'تمت الإضافة',
                        text: `تم إنشاء الترند: ${name} (${slugR})`,
                        timer: 1600,
                        showConfirmButton: false
                    });
                    return;
                }

                if (res.status === 422 && (data.errors || data.messages)) {
                    const all = data.errors || data.messages;
                    const msgs = Object.keys(all).map(k => `• ${k}: ${all[k].join(' / ')}`).join('\n');
                    throw new Error(msgs || 'تحقق من الحقول.');
                }

                throw new Error(data.message || data.error || 'تعذر إضافة الترند.');
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: err.message || 'حدث خطأ غير متوقع'
                });
            }
        }

        // ========== ADD WINDOW MODAL FUNCTION ==========
        async function addNewWindow(e) {
            if (e && e.preventDefault) e.preventDefault();

            const form = document.getElementById('addWindowForm');
            const fd = new FormData(form);

            const name = (fd.get('name') || '').trim();
            const slug = (fd.get('slug') || '').trim();
            const file = fd.get('image');

            // Validation
            if (!name) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'يرجى إدخال اسم النافذة.'
                });
            }
            if (!slug) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'يرجى إدخال الرابط المختصر.'
                });
            }
            if (!(file instanceof File) || !file.name) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'يرجى اختيار صورة.'
                });
            }

            // File type validation
            const okTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            if (!okTypes.includes(file.type)) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'صيغة الصورة غير مدعومة. يُقبل: jpeg, png, webp, gif'
                });
            }

            // File size validation (6MB)
            if (file.size > 6 * 1024 * 1024) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'حجم الصورة يتجاوز 6MB.'
                });
            }

            try {
                const res = await fetch('/dashboard/api/add-window', {
                    method: 'POST',
                    body: fd,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json'
                    }
                });

                const contentType = res.headers.get('content-type') || '';
                let data = {};

                if (contentType.includes('application/json')) {
                    data = await res.json();
                } else {
                    const text = await res.text();
                    throw new Error(text || 'استجابة غير صالحة من الخادم');
                }

                // Success response
                if (res.ok && (data.id || (data.window && data.window.id))) {
                    const id = data.id || data.window.id;
                    const name = data.name || data.window.name;
                    const slug = data.slug || data.window.slug;

                    // Add to indropdown list
                    const windowSearch = document.querySelector('#window_search');
                    if (windowSearch) {
                        const listUl = windowSearch.closest('.search-container')?.querySelector('.indropdown ul');
                        if (listUl) {
                            const li = document.createElement('li');
                            li.dataset.id = String(id);
                            li.dataset.name = name;
                            li.textContent = name;
                            li.onclick = function() {
                                selectItem(li, name, String(id));
                            };
                            listUl.appendChild(li);

                            // Auto-select the new window
                            selectItem(li, name, String(id));
                        }
                    }

                    // Close modal and reset form
                    if (window.$) {
                        $('#addWindowModal').modal('hide');
                    }
                    form.reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'تمت الإضافة',
                        text: `تم إنشاء النافذة: ${name}`,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    return;
                }

                // Validation errors
                if (res.status === 422 && (data.errors || data.messages)) {
                    const all = data.errors || data.messages;
                    const msgs = Object.keys(all).map(k => `• ${k}: ${all[k].join(' / ')}`).join('\n');
                    throw new Error(msgs || 'تحقق من الحقول.');
                }

                // Other server errors
                throw new Error(data.message || data.error || 'تعذر إضافة النافذة.');

            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: err.message || 'حدث خطأ غير متوقع'
                });
            }
        }

        // ========== SLUG GENERATION FOR WINDOW ==========
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('window_name');
            const slugInput = document.getElementById('window_slug');

            if (nameInput && slugInput) {
                nameInput.addEventListener('input', () => {
                    if (!slugInput.dataset.touched || slugInput.value.trim() === '') {
                        slugInput.value = slugify(nameInput.value);
                    }
                });

                slugInput.addEventListener('input', () => {
                    slugInput.dataset.touched = '1';
                });
            }
        });

        // ========== SLUGIFY HELPER FUNCTION ==========
        function slugify(v) {
            return v.toString().toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '')
                .substring(0, 255);
        }

        // Stubs for other modal functions
        function addNewCountry() {
            /* similar to addNewSection */
        }

        function addNewContinent() {
            /* similar to addNewSection */
        }

        // ========== ADD WRITER LOCATION (CITY) FUNCTION ==========
        async function addNewWriterLocation(e) {
            if (e && e.preventDefault) e.preventDefault();

            const form = document.getElementById('addWriterLocationForm');
            const fd = new FormData(form);

            const name = (fd.get('name') || '').trim();
            const slug = (fd.get('slug') || '').trim();
            const type = 'city'; // Hardcoded as per your backend

            // Validation
            if (!name) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'يرجى إدخال اسم الموقع.'
                });
            }
            if (!slug) {
                return Swal.fire({
                    icon: 'error',
                    title: 'تنبيه',
                    text: 'يرجى إدخال الرابط المختصر.'
                });
            }

            try {
                const res = await fetch('/dashboard/api/add-city', {
                    method: 'POST',
                    body: JSON.stringify({
                        name: name,
                        slug: slug,
                        type: type
                    }),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const contentType = res.headers.get('content-type') || '';
                let data = {};

                if (contentType.includes('application/json')) {
                    data = await res.json();
                } else {
                    const text = await res.text();
                    throw new Error(text || 'استجابة غير صالحة من الخادم');
                }

                // Success response
                if (res.ok && (data.id || (data.location && data.location.id))) {
                    const id = data.id || data.location.id;
                    const name = data.name || data.location.name;
                    const slug = data.slug || data.location.slug;

                    // Add to indropdown list
                    const locationSearch = document.querySelector('#writer_location_search');
                    if (locationSearch) {
                        const listUl = locationSearch.closest('.search-container')?.querySelector('.indropdown ul');
                        if (listUl) {
                            const li = document.createElement('li');
                            li.dataset.id = String(id);
                            li.dataset.name = name;
                            li.textContent = name;
                            li.onclick = function() {
                                selectItem(li, name, String(id));
                            };
                            listUl.appendChild(li);

                            // Auto-select the new location
                            selectItem(li, name, String(id));
                        }
                    }

                    // Close modal and reset form
                    if (window.$) {
                        $('#addWriterLocationModal').modal('hide');
                    }
                    form.reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'تمت الإضافة',
                        text: `تم إنشاء الموقع: ${name}`,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    return;
                }

                // Validation errors
                if (res.status === 422 && (data.errors || data.messages)) {
                    const all = data.errors || data.messages;
                    const msgs = Object.keys(all).map(k => `• ${k}: ${all[k].join(' / ')}`).join('\n');
                    throw new Error(msgs || 'تحقق من الحقول.');
                }

                // Other server errors
                throw new Error(data.message || data.error || 'تعذر إضافة الموقع.');

            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: err.message || 'حدث خطأ غير متوقع'
                });
            }
        }

        // ========== SLUG GENERATION FOR WRITER LOCATION ==========
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('location_name');
            const slugInput = document.getElementById('location_slug');

            if (nameInput && slugInput) {
                nameInput.addEventListener('input', () => {
                    if (!slugInput.dataset.touched || slugInput.value.trim() === '') {
                        slugInput.value = slugify(nameInput.value);
                    }
                });

                slugInput.addEventListener('input', () => {
                    slugInput.dataset.touched = '1';
                });
            }
        });
    </script>

@endsection
