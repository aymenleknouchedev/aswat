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
    @php
        $sections = [
            (object) ['id' => 1, 'name' => 'الأخبار المحلية', 'en' => 'Local News'],
            (object) ['id' => 2, 'name' => 'التكنولوجيا', 'en' => 'Technology'],
            (object) ['id' => 3, 'name' => 'الصحة', 'en' => 'Health'],
            (object) ['id' => 4, 'name' => 'الرياضة', 'en' => 'Sports'],
            (object) ['id' => 5, 'name' => 'الثقافة', 'en' => 'Culture'],
        ];
        $categories = [
            (object) ['id' => 1, 'name' => 'تصنيف 1', 'en' => 'Category 1'],
            (object) ['id' => 2, 'name' => 'تصنيف 2', 'en' => 'Category 2'],
        ];
        $writers = [
            (object) ['id' => 1, 'name' => 'أحمد العلي', 'en' => 'Ahmed Ali'],
            (object) ['id' => 2, 'name' => 'سارة منصور', 'en' => 'Sarah Mansour'],
            (object) ['id' => 3, 'name' => 'ليلى خالد', 'en' => 'Laila Khaled'],
            (object) ['id' => 4, 'name' => 'محمد ناصر', 'en' => 'Mohamed Nasser'],
        ];
        $locations = [
            (object) ['id' => 1, 'name' => 'الجزائر العاصمة', 'en' => 'Algiers'],
            (object) ['id' => 2, 'name' => 'وهران', 'en' => 'Oran'],
        ];
        $tags = [
            (object) ['id' => 1, 'name' => 'تقنية', 'en' => 'Tech'],
            (object) ['id' => 2, 'name' => 'رياضة', 'en' => 'Sports'],
            (object) ['id' => 3, 'name' => 'صحة', 'en' => 'Health'],
            (object) ['id' => 4, 'name' => 'ثقافة', 'en' => 'Culture'],
        ];
        $trends = [
            (object) ['id' => 1, 'name' => 'ترند 1', 'en' => 'Trend 1'],
            (object) ['id' => 2, 'name' => 'ترند 2', 'en' => 'Trend 2'],
            (object) ['id' => 3, 'name' => 'ترند 3', 'en' => 'Trend 3'],
        ];
        $windows = [
            (object) ['id' => 1, 'name' => 'نافذة 1', 'en' => 'Window 1'],
            (object) ['id' => 2, 'name' => 'نافذة 2', 'en' => 'Window 2'],
            (object) ['id' => 3, 'name' => 'نافذة 3', 'en' => 'Window 3'],
        ];
        // Example existing media for selection (replace with real backend data)
        $existing_images = ['existing_image_1.jpg', 'existing_image_2.jpg', 'existing_image_3.jpg'];
        $existing_videos = ['existing_video_1.mp4', 'existing_video_2.mp4'];
        $existing_podcasts = ['existing_podcast_1.mp3', 'existing_podcast_2.mp3'];
        $existing_albums = ['album_image_1.jpg', 'album_image_2.jpg', 'album_image_3.jpg'];
    @endphp

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

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="title" data-ar="العنوان" data-en="Title">العنوان</label>
                                            <input id="title" name="title" type="text"
                                                class="form-control form-control-lg" maxlength="75" required
                                                data-ar="العنوان" data-en="Title">
                                            <small class="text-muted">
                                                <span id="title-count">0</span> / 75
                                            </small>
                                        </div>

                                        <div class="col-12">
                                            <label for="long_title" data-ar="العنوان الطويل" data-en="Long Title">العنوان
                                                الطويل</label>
                                            <input id="long_title" name="long_title" type="text"
                                                class="form-control form-control-lg" maxlength="210" required
                                                data-ar="العنوان الطويل" data-en="Long Title">
                                            <small class="text-muted">
                                                <span id="long_title-count">0</span> / 210
                                            </small>
                                        </div>

                                        <div class="col-12">
                                            <label for="mobile_title" data-ar="عنوان الهاتف" data-en="Mobile Title">عنوان
                                                الهاتف</label>
                                            <input id="mobile_title" name="mobile_title" type="text"
                                                class="form-control form-control-lg" maxlength="40" required
                                                data-ar="عنوان الهاتف" data-en="Mobile Title">
                                            <small class="text-muted">
                                                <span id="mobile_title-count">0</span> / 40
                                            </small>
                                        </div>

                                    </div>



                                    <div class="row g-3 mt-3">
                                        <div class="col-lg-12">
                                            <label for="display_method" data-ar="طريقة عرض المحتوى"
                                                data-en="Content Display Method">طريقة عرض المحتوى</label>
                                            <select name="display_method" id="display_method"
                                                class="form-select js-select2 form-control-lg" required
                                                data-ar="طريقة العرض" data-en="Display Method">
                                                <option value="" data-ar="اختر الطريقة" data-en="Choose Method">
                                                    اختر الطريقة</option>
                                                <option value="simple" data-ar="بسيط" data-en="Simple">بسيط</option>
                                                <option value="list" data-ar="قائم" data-en="List">قائم</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 col-lg-4">
                                            <label data-ar="القسم" data-en="Section">القسم</label>
                                            <select name="section_id" class="form-select js-select2 form-control-lg"
                                                required data-ar="القسم" data-en="Section">
                                                <option value="" data-ar="اختر القسم" data-en="Choose Section">اختر
                                                    القسم</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}" data-ar="{{ $section->name }}"
                                                        data-en="{{ $section->en }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <label data-ar="التصنيف" data-en="Category">التصنيف</label>
                                            <select name="category_id" class="form-select js-select2 form-control-lg"
                                                data-ar="التصنيف" data-en="Category">
                                                <option value="" data-ar="اختر التصنيف" data-en="Choose Category">
                                                    اختر التصنيف</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" data-ar="{{ $category->name }}"
                                                        data-en="{{ $category->en }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <label data-ar="المكان" data-en="Location">المكان</label>
                                            <select name="location_id" class="form-select js-select2 form-control-lg"
                                                data-ar="المكان" data-en="Location">
                                                <option value="" data-ar="اختر المكان" data-en="Choose Location">
                                                    اختر المكان</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}" data-ar="{{ $location->name }}"
                                                        data-en="{{ $location->en }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-3 mt-3">

                                        <div class="col-md-6 col-lg-6">
                                            <label data-ar="الترند" data-en="Trend">الترند</label>
                                            <select name="trend_id" class="form-select js-select2 form-control-lg"
                                                data-ar="الترند" data-en="Trend">
                                                <option value="" data-ar="اختر الترند" data-en="Choose Trend">اختر
                                                    الترند</option>
                                                @foreach ($trends as $trend)
                                                    <option value="{{ $trend->id }}" data-ar="{{ $trend->name }}"
                                                        data-en="{{ $trend->en }}">{{ $trend->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label data-ar="النافذة" data-en="Window">النافذة</label>
                                            <select name="window_id" class="form-select js-select2 form-control-lg"
                                                data-ar="النافذة" data-en="Window">
                                                <option value="" data-ar="اختر النافذة" data-en="Choose Window">
                                                    اختر النافذة</option>
                                                @foreach ($windows as $window)
                                                    <option value="{{ $window->id }}" data-ar="{{ $window->name }}"
                                                        data-en="{{ $window->en }}">{{ $window->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-3">
                                        <div class="col-md-6 col-lg-6">
                                            <label data-ar="الكاتب" data-en="Writer">الكاتب</label>
                                            <select name="writer_id" class="form-select js-select2 form-control-lg"
                                                required data-ar="الكاتب" data-en="Writer">
                                                <option value="" data-ar="اختر الكاتب" data-en="Choose Writer">اختر
                                                    الكاتب</option>
                                                @foreach ($writers as $writer)
                                                    <option value="{{ $writer->id }}" data-ar="{{ $writer->name }}"
                                                        data-en="{{ $writer->en }}">{{ $writer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label data-ar="موقع الكاتب" data-en="Writer Location">موقع الكاتب</label>
                                            <select name="writer_location_id"
                                                class="form-select js-select2 form-control-lg" required
                                                data-ar="موقع الكاتب" data-en="Writer Location">
                                                <option value="" data-ar="اختر الموقع" data-en="Choose Location">
                                                    اختر الموقع</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}" data-ar="{{ $location->name }}"
                                                        data-en="{{ $location->en }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row g-3 mt-3">
                                        <div>
                                            <label data-ar="الوسوم" data-en="Tags">الوسوم</label>
                                            <select name="tags_id[]" multiple
                                                class="form-select js-select2 form-control-lg" data-ar="الوسوم"
                                                data-en="Tags">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}" data-ar="{{ $tag->name }}"
                                                        data-en="{{ $tag->en }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group my-3">
                                        <label for="summary" data-ar="ملخص" data-en="Summary"></label>
                                        <textarea id="summary" name="summary" class="form-control form-control-lg" rows="3"></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="body" data-ar="نص المحتوى" data-en="Content Text">نص
                                            المحتوى</label>
                                        <x-forms.tinymce-editor id="myeditorinstance" name="content" :value="$post->content ?? ''" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="seo_keyword" data-ar="الكلمة المفتاحية للسيو"
                                            data-en="SEO Keyword">الكلمة المفتاحية للسيو</label>
                                        <input id="seo_keyword" name="seo_keyword" type="text"
                                            class="form-control form-control-lg" maxlength="50">
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
                                        <textarea id="message_text" name="message_text" class="form-control form-control-lg" rows="4"
                                            data-ar="رسالة المراجعة" data-en="Review Message"></textarea>
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
                                    data-ar="يرجى كتابة المحتوى لتقييم السيو"
                                    data-en="Please write content to evaluate SEO">يرجى كتابة المحتوى
                                    لتقييم السيو</div>
                                <div id="seo-feedback" style="display:none;"></div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-lg" data-ar="حفظ المحتوى"
                                    data-en="Save Content">حفظ المحتوى</button>
                            </div>
                        </form>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>


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
                        counter.textContent = el.value.length;
                    });
                }
            });
        });
    </script>



@endsection
