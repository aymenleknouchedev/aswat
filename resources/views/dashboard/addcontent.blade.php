@extends('layouts.admin')
<!DOCTYPE html>

@section('title', 'أصوات جزائرية | إضافة محتوى')

@section('content')

    <script>
        window.scrollTo(0, 0);
        window.onload = function() {
            window.scrollTo(0, 0);
            setTimeout(function() {
                window.scrollTo(0, 0);
            }, 1);
        };
    </script>
    <style>
        /* Validation styles */
        .hidden-input:invalid~.selected-item {
            border-color: #dc3545;
        }

        .search-container:has(.hidden-input:invalid) .form-label {
            color: #dc3545;
        }

        .required-field::after {
            content: " *";
            color: red;
        }

        /* Validation Styles */
        /* .alert-danger {
                                margin: 15px 0;
                            } */

        .search-container {
            transition: all 0.2s ease;
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
        }

        .select2-dropdown-rtl {
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

        /* Single select fields (Section, Category, etc.) */
        .selected-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border: 1px solid #929292;
            border-radius: 0px;
            background-color: #f3f3f3;
            margin: 0px;
        }

        .btn-delete {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #f3f3f3;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-delete:hover {
            background-color: #f3f3f3;
            color: rgb(255, 0, 0);
        }

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

        /* Fix for tabs */
        .tab-content {
            min-height: 400px;
        }

        /* Fix for right sidebar */
        .col-md-3 {
            padding-left: 15px;
        }

        .card {
            margin-bottom: 20px;
        }

        /* Better spacing for form elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .search-wrapper {
            margin-bottom: 1rem;
        }

        /* Special styling for TAGS only */
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
            border: 1px solid #ced4da;
            border-radius: 0px;
            background: white;
            align-items: center;
            margin-top: 0;
        }

        .tag-item {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 6px;
            border: 1px solid #929292;
            border-radius: 0px;
            background-color: #f3f3f3;
            font-size: 11px;
            line-height: 1.2;
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tag-delete {
            background: none;
            border: none;
            font-size: 12px;
            cursor: pointer;
            color: #6c757d;
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
            background-color: #ff6b6b;
            color: white;
        }

        /* Make the search input appear inside the selected items container */
        .tags-search-container {
            position: relative;
        }

        .tags-input-wrapper {
            position: relative;
            display: block;
        }

        .tags-input-wrapper.hidden {
            visibility: hidden;
            height: 0;
            overflow: hidden;
        }

        /* Adjust the search input to appear inline with tags */
        #tags_search {
            border: none;
            outline: none;
            background: transparent;
            padding: 0;
            margin: 0;
            min-width: 120px;
            flex: 1;
            color: #000;
        }

        /* Remove input focus styling */
        .tags-selected-container:focus-within {
            border-color: #ced4da;
            outline: 0;
            box-shadow: none;
        }

        /* Remove placeholder color */
        #tags_search::placeholder {
            color: transparent;
        }

        #tags_search::-webkit-input-placeholder {
            color: transparent;
        }

        #tags_search::-moz-placeholder {
            color: transparent;
        }

        #tags_search:-ms-input-placeholder {
            color: transparent;
        }

        #tags_search:-moz-placeholder {
            color: transparent;
        }
    </style>
    <style>
        #contentTabs .nav-link {
            color: #b0b0b0 !important;
            background-color: transparent !important;
            border: none !important;
            border-bottom: 2px solid transparent !important;
            transition: all 0.2s ease;
            margin-right: 10px;
            padding: 10px 15px;
        }

        #contentTabs .nav-link:hover {
            border-bottom: 2px solid #ccc !important;
        }

        #contentTabs .nav-link.active {
            color: #0d6efd !important;
            border-bottom: 2px solid #0d6efd !important;
            font-weight: bold;
        }

        #contentTabs {
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
    </style>
    <style>
        .search-container {
            position: relative;
            width: 100%;
            margin-top: 10px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 0px;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            border: 1px solid #ced4da;
            border-radius: 0px;
            background: white;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 5px;
        }

        .dropdown ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .dropdown li {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f1f1f1;
        }

        .dropdown li:hover {
            background-color: #f8f9fa;
        }

        .dropdown li.selected {
            background-color: #e8f4ff;
            color: #2c5aa0;
            font-weight: 500;
        }

        /* Fix for the positioning issue */
        .input-wrapper {
            position: relative;
            display: block;
        }

        .input-wrapper.hidden {
            visibility: hidden;
            height: 0;
            overflow: hidden;
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
            color: #6c757d;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <style>
        /* Social Media Tab Styles */
        .social-preview {
            border: 1px solid #dddfe2;
            font-family: Helvetica, Arial, sans-serif;
            max-width: 500px;
        }

        .image-preview-container {
            min-height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .image-preview-container:hover {
            background-color: #f8f9fa;
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

        /* Card improvements */
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        /* Form improvements */
        .form-text {
            font-size: 0.75rem;
        }

        /* Preview image styling */
        #preview_image_container {
            max-height: 300px;
            overflow: hidden;
        }

        /* Image preview delete button */
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
    </style>

    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <form class="nk-content container row" action="{{ route('dashboard.content.store') }}" method="POST"
                    enctype="multipart/form-data" id="contentForm">
                    @csrf

                    <div class="col-md-9">

                        <div class="nk-block-head mb-4">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-ar="إضافة محتوى جديد" data-en="Add New Content">إضافة محتوى
                                    جديد</h4>
                            </div>
                        </div>

                        <!-- Import SweetAlert2 -->
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        {{-- SweetAlert for validation errors --}}
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

                        @if (session('clear_local_storage'))
                            <script>
                                (function() {
                                    try {
                                        localStorage.removeItem('az_content_items_v6');
                                        localStorage.removeItem('az_display_method_v6');
                                        console.info('LocalStorage vidé après succès (signal contrôleur).');
                                    } catch (e) {
                                        /* noop */
                                    }
                                })();
                                // Show success message using Bootstrap alert
                                document.addEventListener('DOMContentLoaded', function() {
                                    var alertDiv = document.createElement('div');
                                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                                    alertDiv.role = 'alert';
                                    alertDiv.innerHTML = `
                                        {{ session('success_message', 'تم حفظ المحتوى بنجاح!') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    `;
                                    // Insert after the first heading or at the top of the form
                                    var form = document.getElementById('contentForm');
                                    var firstHeading = form ? form.querySelector('.nk-block-head') : null;
                                    if (form && firstHeading) {
                                        firstHeading.parentNode.insertBefore(alertDiv, firstHeading.nextSibling);
                                    } else if (form) {
                                        form.insertBefore(alertDiv, form.firstChild);
                                    } else {
                                        document.body.prepend(alertDiv);
                                    }
                                });
                            </script>
                        @endif


                        <div>
                            <!-- Template Hidden Field -->
                            <input type="hidden" name="template" id="template_field" value="default">

                            <!-- Tabs nav -->
                            <ul class="nav mb-4" id="contentTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="add-content-tab" data-bs-toggle="tab"
                                        data-bs-target="#add-content" type="button" role="tab"
                                        aria-controls="add-content" aria-selected="true" data-ar="إضافة محتوى"
                                        data-en="Add Content">
                                        إضافة محتوى
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="template-tab" data-bs-toggle="tab"
                                        data-bs-target="#template" type="button" role="tab" aria-controls="template"
                                        aria-selected="false" data-ar="اختر القالب" data-en="Choose Template">
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

                                <!-- NEW Social Media tab -->
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

                            <!-- Tabs content -->
                            <div class="tab-content" id="contentTabsContent">
                                <!-- Add Content Tab -->
                                <div class="tab-pane fade show active" id="add-content" role="tabpanel"
                                    aria-labelledby="add-content-tab">

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label class="form-label" for="title" data-ar="العنوان"
                                                data-en="Title">العنوان</label>
                                            <span style="color:red;">*</span>
                                            <div class="form-control-wrap">
                                                <input required id="title" name="title" type="text"
                                                    class="form-control form-control" maxlength="68" data-ar="العنوان"
                                                    data-en="Title" value="{{ old('title', '') }}">
                                            </div>
                                            <small class="text-muted"><span id="title-count">0</span> / 68</small>
                                        </div>

                                        <div class="form-group col-12">
                                            <label class="form-label" for="long_title" data-ar="العنوان الطويل"
                                                data-en="Long Title">العنوان الطويل</label>
                                            <span style="color:red;">*</span>
                                            <div class="form-control-wrap">
                                                <input required id="long_title" name="long_title" type="text"
                                                    class="form-control form-control" maxlength="210"
                                                    data-ar="العنوان الطويل" data-en="Long Title"
                                                    value="{{ old('long_title', '') }}">
                                            </div>
                                            <small class="text-muted"><span id="long_title-count">0</span> / 210</small>
                                        </div>

                                        <div class="form-group col-12">
                                            <label class="form-label" for="mobile_title" data-ar="عنوان الموبايل"
                                                data-en="Mobile Title">عنوان الموبايل </label>
                                            <span style="color:red;">*</span>
                                            <div class="form-control-wrap">
                                                <input required id="mobile_title" name="mobile_title" type="text"
                                                    class="form-control form-control" maxlength="40"
                                                    data-ar="عنوان الموبايل" data-en="Mobile Title"
                                                    value="{{ old('mobile_title', '') }}">
                                            </div>
                                            <small class="text-muted"><span id="mobile_title-count">0</span> / 40</small>
                                        </div>
                                    </div>

                                    <!-- First Row: Section, Category, Country, Continent -->
                                    <div class="fields-row">
                                        <!-- Section -->
                                        <div class="search-wrapper">
                                            <div class="search-container category-selector">
                                                <label class="form-label required-field" for="section" data-ar="القسم"
                                                    data-en="Section">القسم</label>

                                                <!-- ✅ Hidden Input to actually send in the request -->
                                                <input type="hidden" name="section_id" required class="hidden-input"
                                                    value="{{ old('section_id') }}">

                                                <!-- Selected Item Display -->
                                                <div class="selected-item" style="display: none;">
                                                    <span class="selected-value"></span>
                                                    <button type="button" class="btn-delete"
                                                        onclick="clearSelection(this)">×</button>

                                                </div>

                                                <!-- Search Input -->
                                                <div class="input-wrapper">
                                                    <input id="section_search" type="text"
                                                        class="form-control search-input" oninput="filterList(this)"
                                                        onfocus="showDropdown(this)">
                                                    <button type="button" class="btn-add" data-bs-toggle="modal"
                                                        data-bs-target="#addSectionModal" tabindex="-1">+</button>
                                                </div>

                                                <!-- Dropdown List -->
                                                <div class="dropdown">
                                                    <ul>
                                                        @foreach ($sections as $section)
                                                            <li onclick="selectItem(this, '{{ $section->name }}', '{{ $section->id }}')"
                                                                {{ old('section_id') == $section->id ? 'class="selected"' : '' }}>
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

                                                <!-- ✅ Hidden Input to send with request -->
                                                <input type="hidden" name="category_id" required class="hidden-input"
                                                    value="{{ old('category_id') }}">

                                                <!-- Selected Item Display -->
                                                <div class="selected-item" style="display: none;">
                                                    <span class="selected-value"></span>
                                                    <button type="button" class="btn-delete"
                                                        onclick="clearSelection(this)">×</button>

                                                </div>

                                                <!-- Search Input -->
                                                <div class="input-wrapper">
                                                    <input id="category_search" type="text"
                                                        class="form-control search-input" oninput="filterList(this)"
                                                        onfocus="showDropdown(this)">
                                                    <button type="button" class="btn-add" data-bs-toggle="modal"
                                                        data-bs-target="#addCategoryModal" tabindex="-1">
                                                        +
                                                    </button>
                                                </div>

                                                <!-- Dropdown List -->
                                                <div class="dropdown">
                                                    <ul>
                                                        @foreach ($categories as $category)
                                                            <li onclick="selectItem(this, '{{ $category->name }}', '{{ $category->id }}')"
                                                                {{ old('category_id') == $category->id ? 'class="selected"' : '' }}>
                                                                {{ $category->name }}</li>
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
                                                    value="{{ old('country_id') }}">

                                                <div class="selected-item" style="display: none;">
                                                    <span class="selected-value"></span>
                                                    <button type="button" class="btn-delete"
                                                        onclick="clearSelection(this)">×</button>

                                                </div>

                                                <div class="input-wrapper">
                                                    <input id="country_search" type="text"
                                                        class="form-control search-input" oninput="filterList(this)"
                                                        onfocus="showDropdown(this)">
                                                    <button type="button" class="btn-add" data-bs-toggle="modal"
                                                        data-bs-target="#addCountryModal" tabindex="-1">
                                                        +
                                                    </button>
                                                </div>

                                                <div class="dropdown">
                                                    <ul>
                                                        @foreach ($countries as $country)
                                                            <li onclick="selectItem(this, '{{ $country->name }}', '{{ $country->id }}')"
                                                                {{ old('country_id') == $country->id ? 'class="selected"' : '' }}>
                                                                {{ $country->name }}</li>
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
                                                    value="{{ old('continent_id') }}">

                                                <div class="selected-item" style="display: none;">
                                                    <span class="selected-value"></span>
                                                    <button type="button" class="btn-delete"
                                                        onclick="clearSelection(this)">×</button>
                                                </div>



                                                <div class="input-wrapper">
                                                    <input id="continent_search" type="text"
                                                        class="form-control search-input" oninput="filterList(this)"
                                                        onfocus="showDropdown(this)">
                                                    <button type="button" class="btn-add" data-bs-toggle="modal"
                                                        data-bs-target="#addContinentModal" tabindex="-1">
                                                        +
                                                    </button>
                                                </div>

                                                <div class="dropdown">
                                                    <ul>
                                                        @foreach ($continents as $continent)
                                                            <li onclick="selectItem(this, '{{ $continent->name }}', '{{ $continent->id }}')"
                                                                {{ old('continent_id') == $continent->id ? 'class="selected"' : '' }}>
                                                                {{ $continent->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Second Row: Writer and Writer Location -->
                                    <div class="fields-row">
                                        <!-- Writer -->
                                        <div class="search-wrapper">
                                            <div class="search-container category-selector">
                                                <label class="form-label" for="writer" data-ar="الكاتب"
                                                    data-en="Writer">الكاتب</label>

                                                <input type="hidden" name="writer_id" class="hidden-input"
                                                    value="{{ old('writer_id') }}">

                                                <div class="selected-item" style="display: none;">
                                                    <span class="selected-value"></span>
                                                    <button type="button" class="btn-delete"
                                                        onclick="clearSelection(this)">×</button>

                                                </div>

                                                <div class="input-wrapper">
                                                    <input id="writer_search" type="text"
                                                        class="form-control search-input" oninput="filterList(this)"
                                                        onfocus="showDropdown(this)">
                                                    <button type="button" class="btn-add" data-bs-toggle="modal"
                                                        data-bs-target="#addWriterModal" tabindex="-1">
                                                        +
                                                    </button>
                                                </div>

                                                <div class="dropdown">
                                                    <ul>
                                                        @foreach ($writers as $writer)
                                                            <li onclick="selectItem(this, '{{ $writer->name }}', '{{ $writer->id }}')"
                                                                {{ old('writer_id') == $writer->id ? 'class="selected"' : '' }}>
                                                                {{ $writer->name }}</li>
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
                                                    value="{{ old('city_id') }}">

                                                <div class="selected-item" style="display: none;">
                                                    <span class="selected-value"></span>
                                                    <button type="button" class="btn-delete"
                                                        onclick="clearSelection(this)">×</button>

                                                </div>

                                                <div class="input-wrapper">
                                                    <input id="writer_location_search" type="text"
                                                        class="form-control search-input" oninput="filterList(this)"
                                                        onfocus="showDropdown(this)">
                                                    <button type="button" class="btn-add" data-bs-toggle="modal"
                                                        data-bs-target="#addWriterLocationModal" tabindex="-1">
                                                        +
                                                    </button>
                                                </div>

                                                <div class="dropdown">
                                                    <ul>
                                                        @foreach ($cities as $location)
                                                            <li onclick="selectItem(this, '{{ $location->name }}', '{{ $location->id }}')"
                                                                {{ old('city_id') == $location->id ? 'class="selected"' : '' }}>
                                                                {{ $location->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Third Row: Tags -->
                                    <div class="fields-row">
                                        <div class="search-wrapper" style="flex: 1;">
                                            <!-- Tags (Multi-select) -->
                                            <div class="multi-select-container">
                                                <label class="form-label required-field" for="tags_id" data-ar="الوسوم"
                                                    data-en="Tags">الوسوم</label>
                                                <div class="tags-search-container">
                                                    <!-- Selected tags display and search input in the same container -->
                                                    <div id="tags_id-selected-container" class="tags-selected-container">
                                                        <div class="tags-input-wrapper">
                                                            <input id="tags_id_search" type="text"
                                                                class="form-control search-input"
                                                                oninput="filterMultiList(this)"
                                                                onfocus="showMultiDropdown(this)">
                                                            <button type="button" class="btn-add" data-bs-toggle="modal"
                                                                data-bs-target="#addTagModal" tabindex="-1">+</button>
                                                        </div>
                                                    </div>

                                                    <div class="dropdown">
                                                        <ul>
                                                            @foreach ($tags as $tag)
                                                                <li onclick="selectMultiItem(this, '{{ $tag->name }}', '{{ $tag->id }}', 'tags_id')"
                                                                    {{ in_array($tag->id, old('tags_id', [])) ? 'class="selected"' : '' }}>
                                                                    {{ $tag->name }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- Hidden inputs for selected tags -->
                                                <div id="tags_id-hidden-inputs" required>
                                                    @if (old('tags_id'))
                                                        @foreach (old('tags_id') as $tagId)
                                                            <input type="hidden" name="tags_id[]"
                                                                value="{{ $tagId }}">
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <small class="text-muted">يمكنك اختيار أكثر من وسم</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-12 my-3">
                                        <label class="form-label" for="summary" data-ar="الملخص"
                                            data-en="Summary">الملخص</label>
                                        <span style="color:red;">*</span>
                                        <div class="form-control-wrap">
                                            <textarea required id="summary" name="summary" class="form-control form-control" rows="3"
                                                style="max-height: calc(1.5em * 3 + 1rem);" maxlength="130">{{ old('summary', '') }}</textarea>
                                        </div>
                                        <small class="text-muted"><span id="summary-count">0</span> / 130</small>
                                    </div>

                                    <div class="form-group col-12 mb-3">
                                        <label class="form-label" for="body" data-ar="المتن" data-en="Body">المتن
                                        </label>
                                        <span style="color:red;">*</span>
                                        <div class="form-control-wrap">
                                            <x-forms.tinymce-editor id="myeditorinstance" :value="old('content', $post->content ?? '')"
                                                name="content" />
                                        </div>
                                    </div>

                                    <div class="form-group col-12 mb-3">
                                        <label class="form-label" for="seo_keyword" data-ar="الكلمة الرئيسية"
                                            data-en="SEO Keyword">الكلمة الرئيسية</label>
                                        <span style="color:red;">*</span>
                                        <div class="form-control-wrap">
                                            <input required id="seo_keyword" name="seo_keyword" type="text"
                                                class="form-control form-control" maxlength="50"
                                                value="{{ old('seo_keyword', '') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Template Tab -->
                                <div class="tab-pane fade" id="template" role="tabpanel"
                                    aria-labelledby="template-tab">
                                    <div class="template-tab-content">
                                        @include('dashboard.components.template-tab')
                                    </div>
                                </div>

                                <!-- Media Tab -->
                                <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                                    <div class="media-tab-content">
                                        @include('dashboard.components.media-tab', [
                                            'existing_images' => $existing_images,
                                            'existing_videos' => $existing_videos,
                                            'existing_podcasts' => $existing_podcasts,
                                            'existing_albums' => $existing_albums,
                                        ])
                                    </div>
                                </div>

                                @include('dashboard.components.social-media')

                                <!-- Message Tab -->
                                <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                                    <div class="message-tab-content">
                                        <div class="mb-3">
                                            <label for="message_text" data-ar="رسالة المراجعة"
                                                data-en="Review Message">رسالة
                                                المراجعة</label>
                                            <textarea id="message_text" name="review_description" class="form-control">{{ old('review_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4 p-3 border rounded" id="seo-evaluation" style="">
                            <h5 data-ar="تقييم السيو (SEO)" data-en="SEO Evaluation">تقييم السيو (SEO)</h5>
                            <div class="progress" style="height: 20px; margin-bottom:10px;">
                                <div id="seo-bar" class="progress-bar" role="progressbar"
                                    style="width: 0%; background-color: red;" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                            <div id="seo-text" style="font-weight: bold; margin-bottom: 10px;"
                                data-ar="يرجى كتابة المحتوى لتقييم السيو" data-en="Please write content to evaluate SEO">
                                يرجى كتابة المحتوى
                                لتقييم السيو</div>
                            <div id="seo-feedback" style="display:none;"></div>
                        </div>

                        <div class="mt-4 d-flex">
                            <button type="submit" class="btn btn-primary btn-lg me-3" data-ar="نشر" data-en="Publish"
                                id="publishButton">
                                نشر
                            </button>
                            <button name="status" value="draft" type="submit" class="btn btn-secondary btn-lg"
                                data-ar="حفظ كمسودة" data-en="Save as Draft">
                                حفظ كمسودة
                            </button>
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <div class="col-md-3 mt-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label d-block mb-2" for="created_at_by_admin"
                                        data-ar="تاريخ الإنشاء" data-en="Created At">تاريخ الإنشاء</label>
                                    <input type="datetime-local" id="created_at_by_admin" name="created_at_by_admin"
                                        class="form-control" value="{{ old('created_at_by_admin') }}">
                                </div>

                                <!-- Schedule Publish -->
                                <div class="mb-3">
                                    <label class="form-label d-block mb-2" for="publish_at">
                                        <span data-ar="جدولة النشر" data-en="Schedule Publish">جدولة النشر</span>
                                    </label>
                                    <input type="datetime-local" id="publish_at" name="published_at"
                                        class="form-control" value="{{ old('published_at') }}"
                                        onclick="this.showPicker && this.showPicker()"
                                        onfocus="this.showPicker && this.showPicker()">
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_latest"
                                        name="is_latest" {{ old('is_latest', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_latest" data-ar="آخر الاخبار"
                                        data-en="Latest news">
                                        آخر الاخبار
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-block mb-2" for="importance" data-ar="الظهور في الواجهة"
                                        data-en="Display on Frontend">الظهور في الواجهة</label>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="importance"
                                                id="importance1" value="1"
                                                {{ old('importance', '1') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="importance1" data-ar="صف أول"
                                                data-en="First Row">صف أول</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="importance"
                                                id="importance2" value="2"
                                                {{ old('importance') == '2' ? 'checked' : '' }}>
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

    <!-- Modals for adding new items -->
    <!-- Add Section Modal -->
    <div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSectionModalLabel">إضافة قسم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSectionForm">
                        @csrf
                        <div class="mb-3">
                            <label for="section_name" class="form-label">اسم القسم</label>
                            <input type="text" class="form-control" id="section_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="section_description" class="form-label">الوصف</label>
                            <textarea class="form-control" id="section_description" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewSection()">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">إضافة صنف جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">اسم الصنف</label>
                            <input type="text" class="form-control" id="category_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_description" class="form-label">الوصف</label>
                            <textarea class="form-control" id="category_description" name="description" rows="3"></textarea>
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

    <!-- Add Country Modal -->
    <div class="modal fade" id="addCountryModal" tabindex="-1" aria-labelledby="addCountryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCountryModalLabel">إضافة بلد جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCountryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="country_name" class="form-label">اسم البلد</label>
                            <input type="text" class="form-control" id="country_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="country_code" class="form-label">رمز البلد</label>
                            <input type="text" class="form-control" id="country_code" name="code">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewCountry()">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Continent Modal -->
    <div class="modal fade" id="addContinentModal" tabindex="-1" aria-labelledby="addContinentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContinentModalLabel">إضافة قارة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addContinentForm">
                        @csrf
                        <div class="mb-3">
                            <label for="continent_name" class="form-label">اسم القارة</label>
                            <input type="text" class="form-control" id="continent_name" name="name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewContinent()">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Writer Modal -->
    <div class="modal fade" id="addWriterModal" tabindex="-1" aria-labelledby="addWriterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWriterModalLabel">إضافة كاتب جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addWriterForm">
                        @csrf
                        <div class="mb-3">
                            <label for="writer_name" class="form-label">اسم الكاتب</label>
                            <input type="text" class="form-control" id="writer_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="writer_email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="writer_email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="writer_bio" class="form-label">السيرة الذاتية</label>
                            <textarea class="form-control" id="writer_bio" name="bio" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewWriter()">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Writer Location Modal -->
    <div class="modal fade" id="addWriterLocationModal" tabindex="-1" aria-labelledby="addWriterLocationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWriterLocationModalLabel">إضافة موقع كاتب جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addWriterLocationForm">
                        @csrf
                        <div class="mb-3">
                            <label for="location_name" class="form-label">اسم الموقع</label>
                            <input type="text" class="form-control" id="location_name" name="name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="addNewWriterLocation()">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tag Modal -->
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTagModalLabel">إضافة وسم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTagForm">
                        @csrf
                        <div class="mb-3">
                            <label for="tag_name" class="form-label">اسم الوسم</label>
                            <input type="text" class="form-control" id="tag_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="tag_color" class="form-label">لون الوسم (اختياري)</label>
                            <input type="color" class="form-control" id="tag_color" name="color">
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="/dashlite/js/seo.js"></script>
    <script src="/dashlite/js/tabs.js"></script>
    <script src="/dashlite/js/album.js"></script>
    <script src="/dashlite/js/form-toggle.js"></script>
    <script src="/dashlite/js/media-tab.js"></script>

    <script>
        // Single selection functions
        function showDropdown(input) {
            const container = input.closest('.category-selector');
            const dropdown = container.querySelector('.dropdown');
            dropdown.style.display = 'block';
        }

        function filterList(input) {
            const container = input.closest('.category-selector');
            const dropdown = container.querySelector('.dropdown');
            const filter = input.value.toLowerCase();
            const items = dropdown.querySelectorAll('li');
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

            dropdown.style.display = visible ? 'block' : 'none';
        }

        function selectItem(li, value, id) {
            const container = li.closest('.category-selector');
            const selectedDiv = container.querySelector('.selected-item');
            const selectedValue = container.querySelector('.selected-value');
            const searchInput = container.querySelector('.search-input');
            const inputWrapper = container.querySelector('.input-wrapper');
            const dropdown = container.querySelector('.dropdown');
            const hiddenInput = container.querySelector('.hidden-input');

            selectedValue.textContent = value;
            hiddenInput.value = id;

            selectedDiv.style.display = 'flex';
            inputWrapper.classList.add('hidden');
            dropdown.style.display = 'none';

            // Remove validation styling
            container.style.border = '';
            container.style.padding = '';

            console.log(`Selected: ${value} (ID: ${id})`);
        }

        function clearSelection(button) {
            const container = button.closest('.category-selector');
            const selectedDiv = container.querySelector('.selected-item');
            const inputWrapper = container.querySelector('.input-wrapper');
            const hiddenInput = container.querySelector('.hidden-input');

            selectedDiv.style.display = 'none';
            inputWrapper.classList.remove('hidden');
            hiddenInput.value = '';
        }

        // Multi-select functions for tags
        function showMultiDropdown(input) {
            const container = input.closest('.tags-search-container');
            const dropdown = container.querySelector('.dropdown');
            dropdown.style.display = 'block';
        }

        function filterMultiList(input) {
            const container = input.closest('.tags-search-container');
            const dropdown = container.querySelector('.dropdown');
            const filter = input.value.toLowerCase();
            const items = dropdown.querySelectorAll('li');
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

            dropdown.style.display = visible ? 'block' : 'none';
        }

        function selectMultiItem(li, value, id, fieldName) {
            const container = li.closest('.multi-select-container');
            const selectedContainer = document.getElementById(fieldName + '-selected-container');
            const hiddenInputsContainer = document.getElementById(fieldName + '-hidden-inputs');
            const searchInput = container.querySelector('.search-input');
            const dropdown = container.querySelector('.dropdown');

            // Check if already selected
            const existingInput = hiddenInputsContainer.querySelector(`input[value="${id}"]`);
            if (existingInput) {
                return;
            }

            // Create hidden input
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = fieldName + '[]';
            hiddenInput.value = id;
            hiddenInputsContainer.appendChild(hiddenInput);

            // Create selected item display
            const selectedItem = document.createElement('div');
            selectedItem.className = 'tag-item';
            selectedItem.innerHTML = `
        <span class="selected-value">${value}</span>
        <button type="button" class="tag-delete" onclick="removeMultiItem(this, '${id}', '${fieldName}')">×</button>
    `;

            selectedContainer.insertBefore(selectedItem, selectedContainer.querySelector('.tags-input-wrapper'));

            searchInput.value = '';
            dropdown.style.display = 'none';
            searchInput.focus();

            // Remove validation styling
            container.style.border = '';
            container.style.padding = '';

            console.log(`Selected tag: ${value} (ID: ${id})`);
        }

        function removeMultiItem(button, id, fieldName) {
            const selectedContainer = document.getElementById(fieldName + '-selected-container');
            const hiddenInputsContainer = document.getElementById(fieldName + '-hidden-inputs');

            // Remove hidden input
            const hiddenInput = hiddenInputsContainer.querySelector(`input[value="${id}"]`);
            if (hiddenInput) {
                hiddenInput.remove();
            }

            // Remove selected item display
            const selectedItem = button.closest('.tag-item');
            selectedItem.remove();
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            // Single select dropdowns
            document.querySelectorAll('.category-selector').forEach(container => {
                if (!container.contains(e.target)) {
                    container.querySelector('.dropdown').style.display = 'none';
                }
            });

            // Multi select dropdowns
            document.querySelectorAll('.multi-select-container .tags-search-container').forEach(container => {
                if (!container.contains(e.target)) {
                    container.querySelector('.dropdown').style.display = 'none';
                }
            });
        });

        // Initialize old values on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize single select fields with old values
            initializeSingleSelect('section_id', {{ old('section_id', 0) }});
            initializeSingleSelect('category_id', {{ old('category_id', 0) }});
            initializeSingleSelect('country_id', {{ old('country_id', 0) }});
            initializeSingleSelect('continent_id', {{ old('continent_id', 0) }});
            initializeSingleSelect('writer_id', {{ old('writer_id', 0) }});
            initializeSingleSelect('city_id', {{ old('city_id', 0) }});

            // Initialize multi-select tags with old values
            initializeMultiSelect('tags_id', @json(old('tags_id', [])));

            // Initialize character counters
            initializeCharacterCounters();

            // Initialize Bootstrap tabs
            initializeBootstrapTabs();

            // Initialize preview
            updatePreview();
        });

        function initializeSingleSelect(fieldName, oldValue) {
            if (!oldValue) return;

            const container = document.querySelector(`input[name="${fieldName}"]`).closest('.category-selector');
            if (!container) return;

            const dropdown = container.querySelector('.dropdown');
            const items = dropdown.querySelectorAll('li');

            let found = false;
            items.forEach(li => {
                const onclickAttr = li.getAttribute('onclick');
                if (onclickAttr) {
                    const matches = onclickAttr.match(/'([^']+)',\s*'([^']+)'/);
                    if (matches && matches.length >= 3) {
                        const id = matches[2];
                        if (id == oldValue) {
                            const value = matches[1];
                            selectItem(li, value, id);
                            found = true;
                        }
                    }
                }
            });

            if (!found) {
                console.warn(`Item with ID ${oldValue} not found in ${fieldName} dropdown`);
            }
        }

        function initializeMultiSelect(fieldName, oldValues) {
            if (!oldValues || oldValues.length === 0) return;

            const hiddenInputsContainer = document.getElementById(fieldName + '-hidden-inputs');
            if (!hiddenInputsContainer) return;

            const container = hiddenInputsContainer.closest('.multi-select-container');
            const dropdown = container.querySelector('.dropdown');
            const items = dropdown.querySelectorAll('li');

            items.forEach(li => {
                const onclickAttr = li.getAttribute('onclick');
                if (onclickAttr) {
                    const matches = onclickAttr.match(/'([^']+)',\s*'([^']+)',\s*'([^']+)'/);
                    if (matches && matches.length >= 4) {
                        const id = matches[2];
                        if (oldValues.includes(id)) {
                            const value = matches[1];
                            const fieldName = matches[3];
                            selectMultiItem(li, value, id, fieldName);
                        }
                    }
                }
            });
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
                    // Initial update
                    counter.textContent = el.value.length;

                    // Update on typing
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

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contentForm');

            form.addEventListener('submit', function(e) {

                let isValid = true;
                const errorMessages = [];

                // Check section
                const sectionInput = document.querySelector('input[name="section_id"]');
                if (!sectionInput.value) {
                    isValid = false;
                    errorMessages.push('يرجى اختيار القسم');
                    highlightField(sectionInput);
                }

                // Check category
                const categoryInput = document.querySelector('input[name="category_id"]');
                if (!categoryInput.value) {
                    isValid = false;
                    errorMessages.push('يرجى اختيار الصنف');
                    highlightField(categoryInput);
                }

                // Check tags (at least one tag required)
                const tagsInputs = document.querySelectorAll('input[name="tags_id[]"]');
                if (tagsInputs.length === 0) {
                    isValid = false;
                    errorMessages.push('يرجى اختيار وسم واحد على الأقل');
                    highlightField(document.getElementById('tags_id-hidden-inputs'));
                }

                if (!isValid) {
                    e.preventDefault();

                    // Show error message
                    showValidationError(errorMessages.join('<br>'));

                    // Scroll to first error
                    scrollToFirstError();
                } else {
                    // Debug: Log form data before submission
                    const formData = new FormData(this);
                    console.log('Form data being submitted:');
                    for (let [key, value] of formData.entries()) {
                        console.log(key + ': ' + value);
                    }
                }
            });

            function highlightField(input) {
                const container = input.closest('.search-container') || input.closest('.multi-select-container');
                if (container) {
                    container.style.border = '1px solid #dc3545';
                    container.style.borderRadius = '4px';
                    container.style.padding = '4px';

                    // Remove highlight after 3 seconds
                    setTimeout(() => {
                        container.style.border = '';
                        container.style.padding = '';
                    }, 3000);
                }
            }

            function showValidationError(message) {
                // Remove existing error message if any
                const existingError = document.getElementById('validation-error');
                if (existingError) {
                    existingError.remove();
                }

                // Create error message
                const errorDiv = document.createElement('div');
                errorDiv.id = 'validation-error';
                errorDiv.className = 'alert alert-danger alert-dismissible fade show';
                errorDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

                // Insert after the first heading or at the top of the form
                const firstHeading = form.querySelector('.nk-block-head');
                if (firstHeading) {
                    firstHeading.parentNode.insertBefore(errorDiv, firstHeading.nextSibling);
                } else {
                    form.insertBefore(errorDiv, form.firstChild);
                }
            }

            function scrollToFirstError() {
                // Scroll to top of the page instead of first error field
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                // Optional: Also highlight the first error field (keep this if you want both)
                const firstError = document.querySelector(
                        '.search-container[style*="border: 1px solid #dc3545"]') ||
                    document.querySelector('.multi-select-container[style*="border: 1px solid #dc3545"]');
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }
        });

        // Functions to add new items via AJAX
        function addNewSection() {
            const formData = new FormData(document.getElementById('addSectionForm'));

            fetch('/api/sections', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Add new section to dropdown
                        const dropdown = document.querySelector('#section_search').closest('.search-container')
                            .querySelector('.dropdown ul');
                        const newItem = document.createElement('li');
                        newItem.onclick = function() {
                            selectItem(this, data.section.name, data.section.id);
                        };
                        newItem.textContent = data.section.name;
                        dropdown.appendChild(newItem);

                        // Close modal and reset form
                        $('#addSectionModal').modal('hide');
                        document.getElementById('addSectionForm').reset();

                        // Auto-select the newly created section
                        selectItem(newItem, data.section.name, data.section.id);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function addNewCategory() {
            const formData = new FormData(document.getElementById('addCategoryForm'));

            fetch('/api/categories', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const dropdown = document.querySelector('#category_search').closest('.search-container')
                            .querySelector('.dropdown ul');
                        const newItem = document.createElement('li');
                        newItem.onclick = function() {
                            selectItem(this, data.category.name, data.category.id);
                        };
                        newItem.textContent = data.category.name;
                        dropdown.appendChild(newItem);

                        $('#addCategoryModal').modal('hide');
                        document.getElementById('addCategoryForm').reset();
                        selectItem(newItem, data.category.name, data.category.id);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function addNewTag() {
            const formData = new FormData(document.getElementById('addTagForm'));

            fetch('/api/tags', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const dropdown = document.querySelector('#tags_search').closest('.tags-search-container')
                            .querySelector('.dropdown ul');
                        const newItem = document.createElement('li');
                        newItem.onclick = function() {
                            selectMultiItem(this, data.tag.name, data.tag.id, 'tags_id');
                        };
                        newItem.textContent = data.tag.name;
                        dropdown.appendChild(newItem);

                        $('#addTagModal').modal('hide');
                        document.getElementById('addTagForm').reset();
                        selectMultiItem(newItem, data.tag.name, data.tag.id, 'tags_id');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Template selection function
        function selectTemplate(templateName) {
            document.getElementById('template_field').value = templateName;
            console.log('Selected template:', templateName);

            // You can add visual feedback here
            document.querySelectorAll('.template-option').forEach(option => {
                option.classList.remove('selected');
            });
            event.target.closest('.template-option').classList.add('selected');
        }

        // Share image preview and delete functionality
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

        // Update preview when title or description changes
        function updatePreview() {
            const shareTitle = document.getElementById('share_title');
            const shareDescription = document.getElementById('share_description');
            const previewTitle = document.getElementById('preview_title');
            const previewDescription = document.getElementById('preview_description');

            previewTitle.textContent = shareTitle.value || 'عنوان المشاركة';
            previewDescription.textContent = shareDescription.value || 'وصف المشاركة';
        }

        // Similar functions for other entities...
        function addNewCountry() {
            // Implementation similar to addNewSection
        }

        function addNewContinent() {
            // Implementation similar to addNewSection
        }

        function addNewWriter() {
            // Implementation similar to addNewSection
        }

        function addNewWriterLocation() {
            // Implementation similar to addNewSection
        }
    </script>

@endsection
