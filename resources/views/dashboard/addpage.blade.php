@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة صفحة')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')

            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid">

                        <!-- ✅ عنوان الصفحة -->
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-en="Add New Page" data-ar="إضافة صفحة">إضافة صفحة</h4>
                                <p data-en="Fill the form below to create a new page."
                                    data-ar="املأ النموذج أدناه لإضافة صفحة جديدة.">
                                    املأ النموذج أدناه لإضافة صفحة جديدة.
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
                                        <li class="translatable" data-ar="حدث خطأ ما" data-en="An error occurred">
                                            {{ $error ?? 'حدث خطأ ما' }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.page.store') }}" method="POST">
                            @csrf

                            <!-- عنوان الصفحة -->
                            <div class="form-group">
                                <label class="form-label" for="title" data-en="Page Title" data-ar="عنوان الصفحة">
                                    عنوان الصفحة
                                </label>
                                <div class="form-control-wrap">
                                    <input type="text" name="title" class="form-control" id="title" required>
                                </div>
                            </div>

                            <!-- رابط الصفحة (Slug) -->
                            <div class="form-group">
                                <label class="form-label" for="slug" data-en="Page Slug" data-ar="رابط الصفحة">
                                    رابط الصفحة
                                </label>
                                <div class="form-control-wrap">
                                    <input type="text" name="slug" class="form-control" id="slug" required
                                        placeholder="example-page-slug">
                                </div>
                            </div>


                            <!-- وصف الصفحة -->
                            <x-forms.tinymce-editor id="myeditorinstance" :value="$post->content ?? ''" />

                            <!-- محتوى الصفحة باستخدام TinyMCE (معلق) -->
                            {{--
                        <div class="form-group">
                            <label class="form-label" for="content" data-en="Content" data-ar="المحتوى">المحتوى</label>
                            <div class="form-control-wrap">
                                <div class="inner-card">
                                    <textarea id="editor">مرحبا بك في TinyMCE</textarea>
                                </div>
                            </div>
                        </div>
                        --}}
                            <br>
                            <!-- زر الإرسال -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Add Page" data-ar="إضافة صفحة">
                                    إضافة صفحة
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
