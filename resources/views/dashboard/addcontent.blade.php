@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة محتوى')

@section('content')
    @php
        // Fake Data for Selects
        $sections = [
            (object) ['id' => 1, 'name' => 'الأخبار المحلية'],
            (object) ['id' => 2, 'name' => 'التكنولوجيا'],
            (object) ['id' => 3, 'name' => 'الصحة'],
            (object) ['id' => 4, 'name' => 'الرياضة'],
            (object) ['id' => 5, 'name' => 'الثقافة'],
        ];
        $writers = [
            (object) ['id' => 1, 'name' => 'أحمد العلي'],
            (object) ['id' => 2, 'name' => 'سارة منصور'],
            (object) ['id' => 3, 'name' => 'ليلى خالد'],
            (object) ['id' => 4, 'name' => 'محمد ناصر'],
        ];
        $locations = [(object) ['id' => 1, 'name' => 'الجزائر العاصمة'], (object) ['id' => 2, 'name' => 'وهران']];
        $media = [(object) ['id' => 1, 'title' => 'صورة 1'], (object) ['id' => 2, 'title' => 'فيديو تعريفي']];
        $tags = [
            (object) ['id' => 1, 'name' => 'تقنية'],
            (object) ['id' => 2, 'name' => 'رياضة'],
            (object) ['id' => 3, 'name' => 'صحة'],
            (object) ['id' => 4, 'name' => 'ثقافة'],
        ];
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
                                <h4 class="nk-block-title" data-en="Add New Content" data-ar="إضافة محتوى جديد">إضافة محتوى
                                    جديد</h4>
                            </div>
                        </div>

                        <form action="{{ route('dashboard.content.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="slug" data-en="Slug" data-ar="الرابط المختصر">الرابط المختصر</label>
                                        <input id="slug" name="slug" type="text"
                                            class="form-control form-control-lg" placeholder="example-slug" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="title" data-en="Title" data-ar="العنوان">العنوان</label>
                                        <input id="title" name="title" type="text"
                                            class="form-control form-control-outlined form-control-lg" maxlength="68"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="long_title" data-en="Long Title" data-ar="العنوان الطويل">العنوان
                                            الطويل</label>
                                        <input id="long_title" name="long_title" type="text"
                                            class="form-control form-control-outlined form-control-lg" maxlength="210"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="mobile_title" data-en="Mobile Title" data-ar="عنوان الهاتف">عنوان
                                            الهاتف</label>
                                        <input id="mobile_title" name="mobile_title" type="text"
                                            class="form-control form-control-outlined form-control-lg" maxlength="50"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="summary" data-en="Summary" data-ar="ملخص">ملخص</label>
                                <textarea id="summary" name="summary" class="form-control form-control-lg" rows="3"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="body" data-en="Content Body" data-ar="نص المحتوى">نص المحتوى</label>
                                <x-forms.tinymce-editor id="myeditorinstance" name="content" :value="$post->content ?? ''" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="status" data-en="Status" data-ar="الحالة">الحالة</label>
                                <select id="status" name="status" class="form-select form-control-lg" required>
                                    <option value="draft" data-en="Draft" data-ar="مسودة">مسودة</option>
                                    <option value="published" data-en="Published" data-ar="منشور">منشور</option>
                                    <option value="archived" data-en="Archived" data-ar="مؤرشف">مؤرشف</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="author_notes" data-en="Author Notes" data-ar="ملاحظات الكاتب">ملاحظات
                                    الكاتب</label>
                                <textarea id="author_notes" name="author_notes" class="form-control form-control-lg" rows="2"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="language" data-en="Language" data-ar="اللغة">اللغة</label>
                                <input id="language" name="language" type="text" class="form-control form-control-lg"
                                    maxlength="5" value="en" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="priority" data-en="Priority" data-ar="الأولوية">الأولوية</label>
                                <input id="priority" name="priority" type="number"
                                    class="form-control form-control-lg" min="0" value="0" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image" data-en="Image" data-ar="الصورة">الصورة</label>
                                <input id="image" name="image" type="file" class="form-control form-control-lg"
                                    accept="image/*">
                            </div>

                            <div class="form-group mb-3">
                                <label for="image_alt_text" data-en="Image Alt Text" data-ar="النص البديل للصورة">النص
                                    البديل للصورة</label>
                                <input id="image_alt_text" name="image_alt_text" type="text"
                                    class="form-control form-control-lg">
                            </div>

                            <div class="form-group mb-3">
                                <label for="type_of_content" data-en="Type of Content" data-ar="نوع المحتوى">نوع
                                    المحتوى</label>
                                <select id="type_of_content" name="type_of_content" class="form-select form-control-lg"
                                    required>
                                    <option value="normal_news" selected data-en="Normal News" data-ar="خبر عادي">خبر
                                        عادي</option>
                                    <option value="secondary_news" data-en="Secondary News" data-ar="خبر ثانوي">خبر ثانوي
                                    </option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="published_at" data-en="Publish Date & Time" data-ar="تاريخ ووقت النشر">تاريخ
                                    ووقت النشر</label>
                                <input id="published_at" name="published_at" type="datetime-local"
                                    class="form-control form-control-lg">
                            </div>

                            {{-- Grid for last selectors --}}
                            <div class="row g-3">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="section_id" data-en="Section" data-ar="القسم">القسم</label>
                                        <select id="section_id" name="section_id"
                                            class="form-select js-select2 form-control-lg" data-search="on" required>
                                            <option value="" disabled selected data-en="Select Section"
                                                data-ar="اختر القسم">اختر القسم</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="writer_id" data-en="Writer" data-ar="الكاتب">الكاتب</label>
                                        <select id="writer_id" name="writer_id"
                                            class="form-select js-select2 form-control-lg" data-search="on" required>
                                            <option value="" disabled selected data-en="Select Writer"
                                                data-ar="اختر الكاتب">اختر الكاتب</option>
                                            @foreach ($writers as $writer)
                                                <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="writer_location_id" data-en="Writer Location"
                                            data-ar="موقع الكاتب">موقع الكاتب</label>
                                        <select id="writer_location_id" name="writer_location_id"
                                            class="form-select js-select2 form-control-lg" data-search="on" required>
                                            <option value="" disabled selected data-en="Select Location"
                                                data-ar="اختر الموقع">اختر الموقع</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="media_id" data-en="Media" data-ar="الوسائط">الوسائط</label>
                                        <select id="media_id" name="media_id"
                                            class="form-select js-select2 form-control-lg" data-search="on" required>
                                            <option value="" disabled selected data-en="Select Media"
                                                data-ar="اختر الوسائط">اختر الوسائط</option>
                                            @foreach ($media as $mediaItem)
                                                <option value="{{ $mediaItem->id }}">{{ $mediaItem->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="tags_id" data-en="Tags" data-ar="الوسوم">الوسوم</label>
                                        <select id="tags_id" name="tags_id[]"
                                            class="form-select js-select2 form-control-lg" multiple data-search="on">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted" data-en="Hold Ctrl (Cmd) to select multiple"
                                            data-ar="اضغط Ctrl (Cmd) لاختيار عدة"></small>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="status" value="published" class="btn btn-primary"
                                data-en="Add Content" data-ar="إضافة محتوى">
                                إضافة محتوى
                            </button>

                            <button type="submit" name="status" value="draft" class="btn btn-secondary ms-2"
                                data-en="Save as Draft" data-ar="حفظ كمسودة">
                                حفظ كمسودة
                            </button>

                        </form>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
