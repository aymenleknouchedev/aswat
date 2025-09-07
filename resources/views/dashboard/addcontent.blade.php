@extends('layouts.admin')

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

                <div class="nk-content">
                    <div class="container-fluid">

                        <div class="nk-block-head mb-4">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-ar="إضافة محتوى جديد" data-en="Add New Content">إضافة محتوى
                                    جديد</h4>
                            </div>
                        </div>

                        <form action="{{ route('dashboard.content.store') }}" method="POST" enctype="multipart/form-data">
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

                            {{-- validation errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

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
                                                    class="form-control form-control" maxlength="75" data-ar="العنوان"
                                                    data-en="Title">
                                            </div>
                                            <small class="text-muted"><span id="title-count">0</span> / 75</small>
                                        </div>

                                        <div class="form-group col-12">
                                            <label class="form-label" for="long_title" data-ar="العنوان الطويل"
                                                data-en="Long Title">العنوان الطويل</label>
                                            <span style="color:red;">*</span>
                                            <div class="form-control-wrap">
                                                <input required id="long_title" name="long_title" type="text"
                                                    class="form-control form-control" maxlength="210"
                                                    data-ar="العنوان الطويل" data-en="Long Title">
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
                                                    data-ar="عنوان الموبايل" data-en="Mobile Title">
                                            </div>
                                            <small class="text-muted"><span id="mobile_title-count">0</span> / 40</small>
                                        </div>
                                    </div>


                                    <div class="row g-3 mt-1 ">
                                        <div class="form-group col-lg-12 mb-2">
                                            <label class="form-label" for="display_method" data-ar="القالب"
                                                data-en="Content Display Method">القالب</label>
                                            <span style="color:red;">*</span>
                                            <div class="form-control-wrap">
                                                <select name="display_method" id="display_method"
                                                    class="form-select js-select2" data-search="on">
                                                    <option value="simple">أساسي</option>
                                                    <option value="list">قائمة</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-lg-3">
                                            <label class="form-label" data-ar="القسم" data-en="Section">القسم</label>
                                            <span style="color:red;">*</span>
                                            <div class="form-control-wrap">
                                                <select required name="section_id" class="form-select js-select2"
                                                    data-search="on">
                                                    <option value=" ">اختر القسم</option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-3">
                                            <label class="form-label" data-ar="التصنيف"
                                                data-en="Category">التصنيف</label>
                                            <div class="form-control-wrap">
                                                <select name="category_id" class="form-select js-select2"
                                                    data-search="on">
                                                    <option value=" ">اختر التصنيف</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-3">
                                            <label class="form-label" data-ar="القارة" data-en="Continent">القارة</label>
                                            <div class="form-control-wrap">
                                                <select name="continent_id" class="form-select js-select2"
                                                    data-search="on">
                                                    <option value=" ">اختر القارة</option>
                                                    @foreach ($continents as $continent)
                                                        <option value="{{ $continent->id }}">{{ $continent->name }}
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
                                                    <option value=" ">اختر المكان</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-3">

                                        <div class="form-group col-md-6 col-lg-6">
                                            <label class="form-label" data-ar="الاتجاه" data-en="Trend">الاتجاه</label>
                                            <div class="form-control-wrap">
                                                <select name="trend_id" class="form-select js-select2" data-search="on">
                                                    <option value=" ">اختر الاتجاه</option>
                                                    @foreach ($trends as $trend)
                                                        <option value="{{ $trend->id }}">{{ $trend->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-lg-6">
                                            <label class="form-label" data-ar="النافذة" data-en="Window">النافذة</label>
                                            <div class="form-control-wrap">
                                                <select name="window_id" class="form-select js-select2" data-search="on">
                                                    <option value=" ">اختر النافذة</option>
                                                    @foreach ($windows as $window)
                                                        <option value="{{ $window->id }}">{{ $window->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row g-3">
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label class="form-label" data-ar="الكاتب" data-en="Writer">الكاتب</label>
                                            <div class="form-control-wrap">
                                                <select name="writer_id" class="form-select js-select2" data-search="on">
                                                    <option value=" ">اختر الكاتب</option>
                                                    @foreach ($writers as $writer)
                                                        <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-lg-6">
                                            <label class="form-label" data-ar="موقع الكاتب"
                                                data-en="Writer Location">موقع الكاتب</label>
                                            <div class="form-control-wrap">
                                                <select name="city_id" class="form-select js-select2" data-search="on">
                                                    <option value=" ">اختر الموقع</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-3">
                                        <div class="form-group col-12">
                                            <label class="form-label" data-ar="الوسوم" data-en="Tags">الوسوم</label>
                                            <span style="color:red;">*</span>
                                            <div class="form-control-wrap">
                                                <select name="tags_id[]" multiple class="form-select js-select2"
                                                    data-search="on" style="width: 100%;">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group col-12 my-3">
                                        <label class="form-label" for="summary" data-ar="الملخص"
                                            data-en="Summary">الملخص</label>
                                        <span style="color:red;">*</span>
                                        <div class="form-control-wrap">
                                            <textarea required id="summary" name="summary" class="form-control form-control" rows="3"
                                                style="max-height: calc(1.5em * 3 + 1rem);" maxlength="130"></textarea>
                                        </div>
                                        <small class="text-muted"><span id="summary-count">0</span> / 130</small>
                                    </div>



                                    <div class="form-group col-12 mb-3">
                                        <label class="form-label" for="body" data-ar="المتن" data-en="Body">المتن
                                        </label>
                                        <span style="color:red;">*</span>
                                        <div class="form-control-wrap">
                                            <x-forms.tinymce-editor id="myeditorinstance" name="content" />
                                        </div>
                                    </div>


                                    <div class="form-group col-12 mb-3">
                                        <label class="form-label" for="seo_keyword" data-ar="الكلمة الرئيسية"
                                            data-en="SEO Keyword">الكلمة الرئيسية</label>
                                        <span style="color:red;">*</span>
                                        <div class="form-control-wrap">
                                            <input required id="seo_keyword" name="seo_keyword" type="text"
                                                class="form-control form-control" maxlength="50">
                                        </div>
                                    </div>

                                </div>

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
                                        <textarea id="message_text" name="message_text" class="form-control form-control" rows="4"
                                            data-ar="رسالة المراجعة" data-en="Review Message"></textarea>
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
                                                class="form-control" placeholder="عنوان المشاركة">
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <label for="share_description" class="form-label" data-ar="وصف المشاركة"
                                                data-en="Share Description">وصف المشاركة</label>
                                            <textarea id="share_description" name="share_description" class="form-control" rows="3"
                                                placeholder="أدخل وصفًا للمشاركة"></textarea>
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
                                <button name="status" value="published" type="submit" class="btn btn-primary btn-lg me-3" data-ar="نشر"
                                    data-en="Publish">
                                    نشر
                                </button>
                                <button name="status" value="draft" type="submit" class="btn btn-secondary btn-lg" data-ar="حفظ كمسودة"
                                    data-en="Save as Draft">
                                    حفظ كمسودة
                                </button>
                            </div>


                        </form>
                    </div>
                </div>

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


    <!-- Preview Script -->
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
