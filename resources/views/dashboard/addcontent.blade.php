@extends('layouts.admin')
<!DOCTYPE html>


@section('title', 'أصوات جزائرية | إضافة محتوى')

@section('content')

    <style>
        #contentTabs .nav-link {
            color: #b0b0b0 !important;
            background-color: transparent !important;
            border: none !important;
            border-bottom: 2px solid transparent !important;
            transition: all 0.2s ease;
            margin-right: 10px
        }

        #contentTabs .nav-link:hover {
            border-bottom: 2px solid #ccc !important;
        }

        #contentTabs .nav-link.active {
            color: #0d6efd !important;
            border-bottom: 2px solid #0d6efd !important;
            font-weight: bold;
        }
    </style>

    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <form class="nk-content container row" action="{{ route('dashboard.content.store') }}" method="POST"
                    enctype="multipart/form-data" id="contentForm">

                    <div class="col-md-9">

                        <div class="nk-block-head mb-4">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-ar="إضافة محتوى جديد" data-en="Add New Content">إضافة محتوى
                                    جديد</h4>
                            </div>
                        </div>

                        {{-- validation messages with problem --}}
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- success message --}}
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div>
                            @csrf
                            <!-- Tabs nav -->
                            <ul class="nav mb-4" id="contentTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="add-content-tab" data-bs-target="#add-content"
                                        type="button" role="tab" aria-controls="add-content" aria-selected="true"
                                        data-ar="إضافة محتوى" data-en="Add Content">
                                        إضافة محتوى
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="template-tab" data-bs-target="#template" type="button"
                                        role="tab" aria-controls="template" aria-selected="false" data-ar="اختر القالب"
                                        data-en="Choose Template">
                                        اختر القالب
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="media-tab" data-bs-target="#media" type="button"
                                        role="tab" aria-controls="media" aria-selected="false" data-ar="الوسائط"
                                        data-en="Media">
                                        الوسائط
                                    </button>
                                </li>

                                <!-- NEW Social Media tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="social-media-tab" data-bs-target="#social-media"
                                        type="button" role="tab" aria-controls="social-media" aria-selected="false"
                                        data-ar="وسائل التواصل" data-en="Social Media">
                                        وسائل التواصل
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="message-tab" data-bs-target="#message" type="button"
                                        role="tab" aria-controls="message" aria-selected="false"
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


                                    <div class="row g-3 mt-1 ">
                                        <div class="form-group col-md-6 col-lg-3">
                                            <label class="form-label" data-ar="القسم" data-en="Section">القسم</label>
                                            <span style="color:red;">*</span>
                                            <div class="form-control-wrap">
                                                <select required name="section_id" class="form-select js-select2"
                                                    data-search="on">
                                                    <option value="">اختر القسم</option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}"
                                                            {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                                            {{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-3">
                                            <label class="form-label" data-ar="التصنيف"
                                                data-en="Category">التصنيف</label>
                                            <span style="color:red;">*</span>
                                            <div class="form-control-wrap position-relative">
                                                <input type="text" id="categorySearch" class="form-control pe-5" required autocomplete="off" value="{{ old('category_name') }}">
                                                <input type="hidden" name="category_id" id="categoryHidden" required value="{{ old('category_id') }}">
                                                <div id="categoryResults" class="dropdown-menu w-100 shadow-sm"
                                                    style="max-height:200px; overflow-y:auto; display:none;">
                                                </div>
                                                <button type="button" id="addCategoryButton"
                                                    class="btn btn-link p-0 position-absolute top-50 end-0 translate-middle-y"
                                                    style="height: 100%; z-index: 2; margin-left: 8px; margin-right: 8px;"
                                                    data-bs-toggle="modal" data-bs-target="#addCategoryModal"
                                                    tabindex="-1">
                                                    <em class="icon ni ni-plus"></em>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="addCategoryModal" tabindex="-1"
                                            aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addCategoryModalLabel"
                                                            data-ar="إضافة تصنيف جديد" data-en="Add New Category">إضافة
                                                            تصنيف جديد</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" id="newCategoryInput" class="form-control"
                                                            data-ar="تصنيف جديد" data-en="New Category">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal" data-ar="إلغاء"
                                                            data-en="Cancel">إلغاء</button>
                                                        <button type="button" id="saveCategoryBtn"
                                                            class="btn btn-primary" data-ar="حفظ"
                                                            data-en="Save">حفظ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-3">
                                            <label class="form-label" data-ar="القارة" data-en="Continent">القارة</label>
                                            <div class="form-control-wrap">
                                                <select name="continent_id" class="form-select js-select2"
                                                    data-search="on">
                                                    <option value="">اختر القارة</option>
                                                    @foreach ($continents as $continent)
                                                        <option value="{{ $continent->id }}"
                                                            {{ old('continent_id') == $continent->id ? 'selected' : '' }}>
                                                            {{ $continent->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-3">
                                            <label class="form-label" data-ar="الدولة" data-en="Country">الدولة</label>
                                            <div class="form-control-wrap">
                                                <select name="country_id" class="form-select js-select2"
                                                    data-search="on">
                                                    <option value="">اختر المكان</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                            {{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-3">
                                        <div class="form-group col-md-6 col-lg-6">
                                            <div class="d-flex align-items-end">
                                                <div class="w-100">
                                                    <label class="form-label" data-ar="الاتجاه"
                                                        data-en="Trend">الاتجاه</label>
                                                    <div class="form-control-wrap position-relative">
                                                        <input type="text" id="trendSearch" class="form-control" />
                                                        <input type="hidden" name="trend_id" id="trendHidden" />
                                                        <div id="trendResults" class="dropdown-menu w-100 shadow-sm"
                                                            style="max-height:200px; overflow-y:auto; display:none;">
                                                        </div>
                                                        <button type="button" id="addTrendButton"
                                                            class="btn btn-link p-0 position-absolute top-50 end-0 translate-middle-y"
                                                            style="height: 100%; z-index: 2; margin-left: 8px; margin-right: 8px;"
                                                            data-bs-toggle="modal" data-bs-target="#addTrendModal"
                                                            tabindex="-1">
                                                            <em class="icon ni ni-plus"></em>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="addTrendModal" tabindex="-1"
                                            aria-labelledby="addTrendModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addTrendModalLabel"
                                                            data-ar="إضافة اتجاه جديد" data-en="Add New Trend">إضافة اتجاه
                                                            جديد</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" id="newTrendInput" class="form-control"
                                                            data-ar="اتجاه جديد" data-en="New Trend">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal" data-ar="إلغاء"
                                                            data-en="Cancel">إلغاء</button>
                                                        <button type="button" id="saveTrendBtn" class="btn btn-primary"
                                                            data-ar="حفظ" data-en="Save">حفظ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <div class="d-flex align-items-end">
                                                <div class="w-100">
                                                    <label class="form-label" data-ar="النافذة"
                                                        data-en="Window">النافذة</label>
                                                    <div class="form-control-wrap position-relative">
                                                        <input type="text" id="windowSearch"
                                                            class="form-control pe-5" />
                                                        <input type="hidden" name="window_id" id="windowHidden" />
                                                        <div id="windowResults" class="dropdown-menu w-100 shadow-sm"
                                                            style="max-height:200px; overflow-y:auto; display:none;">
                                                        </div>
                                                        <button type="button" id="addWindowButton"
                                                            class="btn btn-link p-0 position-absolute top-50 end-0 translate-middle-y"
                                                            style="height: 100%; z-index: 2; margin-left: 8px; margin-right: 8px;"
                                                            data-bs-toggle="modal" data-bs-target="#addWindowModal"
                                                            tabindex="-1">
                                                            <em class="icon ni ni-plus"></em>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="addWindowModal" tabindex="-1"
                                            aria-labelledby="addWindowModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addWindowModalLabel"
                                                            data-ar="إضافة نافذة جديدة" data-en="Add New Window">إضافة
                                                            نافذة جديدة</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" id="newWindowInput" class="form-control"
                                                            data-ar="نافذة جديدة" data-en="New Window">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal" data-ar="إلغاء"
                                                            data-en="Cancel">إلغاء</button>
                                                        <button type="button" id="saveWindowBtn" class="btn btn-primary"
                                                            data-ar="حفظ" data-en="Save">حفظ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="form-group col-md-6 col-lg-6">
                                            <div class="d-flex align-items-end">
                                                <div class="w-100">
                                                    <label class="form-label" data-ar="الكاتب"
                                                        data-en="Writer">الكاتب</label>
                                                    <div class="form-control-wrap position-relative">
                                                        <input type="text" id="writerSearch" class="form-control">
                                                        <input type="hidden" name="writer_id" id="writerHidden">
                                                        <div id="writerResults" class="dropdown-menu w-100"
                                                            style="display:none; max-height:200px; overflow-y:auto;"></div>
                                                        <button type="button" id="addWriterButton"
                                                            class="btn btn-link p-0 position-absolute top-50 end-0 translate-middle-y"
                                                            style="height: 100%; z-index: 2; margin-left: 8px; margin-right: 8px;"
                                                            data-bs-toggle="modal" data-bs-target="#addWriterModal"
                                                            tabindex="-1">
                                                            <em class="icon ni ni-plus"></em>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="addWriterModal" tabindex="-1"
                                            aria-labelledby="addWriterModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Header -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addWriterModalLabel"
                                                            data-ar="إضافة كاتب جديد" data-en="Add New Writer">إضافة كاتب
                                                            جديد</h5>
                                                    </div>

                                                    <!-- Body -->
                                                    <div class="modal-body">

                                                        <div id="writerForm">
                                                            @csrf

                                                            <div class="mb-3">
                                                                <label class="form-label" data-ar="الاسم"
                                                                    data-en="Name">الاسم</label>
                                                                <input type="text" id="writerName" name="name"
                                                                    class="form-control" data-ar="الاسم" data-en="Name">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" data-ar="الرابط (Slug)"
                                                                    data-en="Slug">الرابط (Slug)</label>
                                                                <input type="text" id="writerSlug" name="slug"
                                                                    class="form-control" data-ar="الرابط" data-en="Slug">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" data-ar="نبذة"
                                                                    data-en="Bio">نبذة</label>
                                                                <textarea id="writerBio" name="bio" class="form-control" rows="3"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" data-ar="الصورة"
                                                                    data-en="Image">الصورة</label>
                                                                <input type="file" id="writerImage" name="image"
                                                                    class="form-control" accept="image/*"
                                                                    data-ar="الصورة" data-en="Image">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" data-ar="فيسبوك"
                                                                    data-en="Facebook">فيسبوك</label>
                                                                <input type="url" id="writerFacebook" name="facebook"
                                                                    class="form-control"
                                                                    placeholder="https://facebook.com/" data-ar="فيسبوك"
                                                                    data-en="Facebook">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" data-ar="X"
                                                                    data-en="X">X</label>
                                                                <input type="url" id="writerX" name="x"
                                                                    class="form-control" placeholder="https://x.com/"
                                                                    data-ar="X" data-en="X">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" data-ar="إنستغرام"
                                                                    data-en="Instagram">إنستغرام</label>
                                                                <input type="url" id="writerInstagram"
                                                                    name="instagram" class="form-control"
                                                                    placeholder="https://instagram.com/"
                                                                    data-ar="إنستغرام" data-en="Instagram">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" data-ar="لينكدإن"
                                                                    data-en="LinkedIn">لينكدإن</label>
                                                                <input type="url" id="writerLinkedin" name="linkedin"
                                                                    class="form-control"
                                                                    placeholder="https://linkedin.com/" data-ar="لينكدإن"
                                                                    data-en="LinkedIn">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!-- Footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal" data-ar="إلغاء"
                                                            data-en="Cancel">إلغاء</button>
                                                        <button type="button" id="saveWriterBtn" class="btn btn-primary"
                                                            data-ar="حفظ" data-en="Save">حفظ</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-6 col-lg-6">
                                            <label class="form-label" data-ar="موقع الكاتب"
                                                data-en="Writer Location">موقع الكاتب</label>
                                            <div class="form-control-wrap relative w-full">
                                                <input type="text" id="cityInput" name="city_name"
                                                    class="form-control">
                                                <input type="hidden" id="cityId" name="city_id">
                                                <div id="cityDropdown" class="dropdown-menu w-100 shadow-sm"
                                                    style="max-height:200px; overflow-y:auto; display:none;">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-3">
                                        <div class="form-group col-md-12">
                                            <div class="d-flex align-items-end">
                                                <div class="w-100">
                                                    <label class="form-label" data-ar="الوسوم"
                                                        data-en="Tags">الوسوم</label>
                                                    <span style="color:red;">*</span>
                                                    <div class="d-flex flex-wrap align-items-center" id="tagInputBox"
                                                        style="gap:5px; position:relative; cursor:text;">
                                                        @if (old('tags_id'))
                                                            @foreach (old('tags_id') as $id)
                                                                <div class="tag-chip">
                                                                    <span
                                                                        class="chip-name">{{ App\Models\Tag::find(id: $id)->name ?? '' }}</span>
                                                                    <span class="remove-tag" style="cursor:pointer;"
                                                                        data-tag-id="{{ $id }}">&times;</span>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        <div id="tagContainer" class="d-flex flex-wrap align-items-center"
                                                            style="gap:5px; flex:1 ">
                                                            <input type="text" id="tagSearch" class="form-control"
                                                                style="background: transparent; color outline:none; min-width:120px;">
                                                        </div>
                                                        <button type="button" id="addTagButton"
                                                            class="btn btn-link p-0 position-absolute top-50 end-0 translate-middle-y"
                                                            style="height: 100%; z-index: 2; margin-left: 8px; margin-right: 8px;"
                                                            data-bs-toggle="modal" data-bs-target="#addTagModal"
                                                            tabindex="-1">
                                                            <em class="icon ni ni-plus"></em>
                                                        </button>
                                                    </div>

                                                    <div id="tagResults" class="dropdown-menu w-100" style="display:none; max-height:200px; overflow-y:auto; position:absolute; z-index:1000;">
                                                    </div>

                                                    <div id="hiddenTags"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="addTagModal" tabindex="-1"
                                        aria-labelledby="addTagModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addTagModalLabel"
                                                        data-ar="إضافة وسم جديد" data-en="Add New Tag">إضافة وسم جديد</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="إغلاق"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" id="newTagInput" class="form-control"
                                                        data-ar="وسم جديد" data-en="New Tag">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal" data-ar="إلغاء"
                                                        data-en="Cancel">إلغاء</button>
                                                    <button type="button" id="saveTagBtn" class="btn btn-primary"
                                                        data-ar="حفظ" data-en="Save">حفظ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- TAG MODAL --}}


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
                                @include('dashboard.components.template-tab')

                                <!-- Media Tab -->
                                @include('dashboard.components.media-tab', [
                                    'existing_images' => $existing_images,
                                    'existing_videos' => $existing_videos,
                                    'existing_podcasts' => $existing_podcasts,
                                    'existing_albums' => $existing_albums,
                                ])



                                <!-- Message Tab -->
                                <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                                    <div class="mb-3">
                                        <label for="message_text" data-ar="رسالة المراجعة" data-en="Review Message">رسالة
                                            المراجعة</label>
                                        <textarea id="message_text" name="review_description" class="form-control">{{ old('review_description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabs content -->
                            <div class="tab-content">
                                <!-- Add Content Tab -->
                                <div class="tab-pane fade show active" id="add-content" role="tabpanel"
                                    aria-labelledby="add-content-tab">
                                    <!-- Existing content here -->
                                </div>

                                <!-- Media Tab -->
                                <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                                    <!-- Existing content here -->
                                </div>

                                <!-- Social Media Tab Content -->
                                <div class="tab-pane fade" id="social-media" role="tabpanel"
                                    aria-labelledby="social-media-tab">
                                    <div class="row g-3 mt-3">

                                        <!-- Content Image -->
                                        <div class="col-md-6">
                                            <label for="share_image" class="form-label" data-ar="صورة المحتوى"
                                                data-en="Content Image">صورة المحتوى</label>
                                            <input type="file" id="share_image" name="share_image"
                                                class="form-control" accept="image/*">
                                            <div class="mt-2 border rounded p-2 text-center" style="aspect-ratio: 16/9;">
                                                <img id="share_image_preview" src="" alt=""
                                                    style="aspect-ratio: 16/9; display:none;">
                                            </div>
                                        </div>

                                        <!-- Title -->
                                        <div class="col-md-6">
                                            <label for="share_title" class="form-label" data-ar="عنوان المشاركة"
                                                data-en="Share Title">عنوان المشاركة</label>
                                            <input type="text" id="share_title" name="share_title"
                                                class="form-control" value="{{ old('share_title', '') }}">
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label for="share_description" class="form-label" data-ar="وصف المشاركة"
                                                data-en="Share Description">وصف المشاركة</label>
                                            <textarea id="share_description" name="share_description" class="form-control" rows="3">{{ old('share_description', '') }}</textarea>
                                        </div>

                                    </div>
                                </div>

                                <!-- Review Message Tab -->
                                <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                                    <!-- Existing content here -->
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
                                    data-ar="يرجى كتابة المحتوى لتقييم السيو"
                                    data-en="Please write content to evaluate SEO">يرجى كتابة المحتوى
                                    لتقييم السيو</div>
                                <div id="seo-feedback" style="display:none;"></div>
                            </div>

                            <div class="mt-4 d-flex">
                                <button type="submit" class="btn btn-primary btn-lg me-3" data-ar="نشر"
                                    data-en="Publish" id="publishButton">
                                    نشر
                                </button>
                                <button name="status" value="draft" type="submit" class="btn btn-secondary btn-lg"
                                    data-ar="حفظ كمسودة" data-en="Save as Draft">
                                    حفظ كمسودة
                                </button>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-3 mt-4">
                        <div class="card mb-3">
                            <div class="card-body">

                                <!-- Collapsible: Schedule Publish -->
                                <div>
                                    <label class="form-label" for="publish_at">
                                        <span data-ar="جدولة النشر" data-en="Schedule Publish">جدولة النشر</span>
                                    </label>
                                    <div class="input-group mb-2">
                                        {{-- <span class="input-group-text bg-light">
                                            <em class="icon ni ni-calendar"></em>
                                        </span> --}}
                                        <input type="datetime-local" id="publish_at" name="published_at"
                                            class="form-control" value="{{ old('published_at') }}"
                                            onclick="this.showPicker && this.showPicker()"
                                            onfocus="this.showPicker && this.showPicker()">
                                    </div>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_latest" name="is_latest">
                                    <label class="form-check-label" for="is_latest" data-ar="آخر الاخبار" data-en="Latest news">
                                        آخر الاخبار
                                    </label>
                                </div>
                                
                                <div class="mb-2">
                                    <label class="form-label d-block mb-1" for="importance" data-ar="الظهور في الواجهة" data-en="Display on Frontend">الظهور في الواجهة</label>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="importance" id="importance1" value="1"
                                                {{ old('importance', '1') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="importance1" data-ar="صف أول" data-en="First Row">صف أول</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="importance" id="importance2" value="2"
                                                {{ old('importance') == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="importance2" data-ar="صف ثانٍ" data-en="Second Row">صف ثانٍ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            // Duplicate content button
                            document.getElementById('duplicateContentBtn').addEventListener('click', function() {
                                alert('سيتم نسخ بيانات النموذج. (تنفيذ النسخ حسب الحاجة)');
                                // يمكنك هنا تنفيذ منطق النسخ حسب الحاجة
                            });

                            // Preview content button
                            document.getElementById('previewContentBtn').addEventListener('click', function() {
                                alert('معاينة المحتوى غير متوفرة حالياً. (نفذ المعاينة حسب الحاجة)');
                                // يمكنك هنا فتح نافذة معاينة أو تنفيذ منطق المعاينة
                            });
                        </script>
                    </div>
                </form>
                @include('dashboard.components.footer')
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
        document.addEventListener("DOMContentLoaded", function() {
            const fields = [{
                    id: "title",
                    max: 75
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
                } // ✅ Added summary field
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
        });
    </script>


    <script>
        document.getElementById('share_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('share_image_preview');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.js-select2').select2({
                placeholder: "اختر",
                allowClear: true,
                width: '100%'
            });
        });
    </script>


@endsection

<style>
    .tag-chip {
        background: #6576ff;
        color: #fff;
        padding: 3px 8px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
    }

    .tag-chip span {
        cursor: pointer;
        font-weight: bold;
    }

    #tagSearch {
        flex: 1;
        min-width: 100px;
    }
</style>

<script src={{ asset('dashlite/js/apis/search-category-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/add-category-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/search-trend-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/add-trend-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/search-window-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/add-window-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/search-tag-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/add-tag-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/search-writer-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/add-writer-api.js') }}></script>
<script src={{ asset('dashlite/js/apis/search-writer-location-api.js') }}></script>

<script>
    // Share image file preview
    document.getElementById("share_image").addEventListener("change", function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById("preview-share_image").innerHTML =
                    `<img src="${event.target.result}" alt="preview">`;
                document.getElementById("share_image_url").value = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
