@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل صفحة')

@section('content')
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
                                <h4 class="nk-block-title" data-en="Edit Page" data-ar="تعديل صفحة">تعديل صفحة</h4>
                                <p data-en="Update the form below to edit the page."
                                    data-ar="قم بتحديث النموذج أدناه لتعديل الصفحة.">
                                    قم بتحديث النموذج أدناه لتعديل الصفحة.
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
                        <form action="{{ route('dashboard.page.update', $page->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- عنوان الصفحة -->
                            <div class="form-group">
                                <label class="form-label" for="title" data-en="Page Title" data-ar="عنوان الصفحة">
                                    عنوان الصفحة
                                </label>
                                <div class="form-control-wrap">
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ old('title', $page->title) }}" required>
                                </div>
                            </div>

                            <!-- رابط الصفحة (Slug) -->
                            <div class="form-group">
                                <label class="form-label" for="slug" data-en="Page Slug" data-ar="رابط الصفحة">
                                    رابط الصفحة
                                </label>
                                <div class="form-control-wrap">
                                    <input type="text" name="slug" class="form-control" id="slug"
                                        value="{{ old('slug', $page->slug) }}" required>
                                </div>
                            </div>

                            <!-- محتوى الصفحة -->
                            <x-forms.tinymce-editor id="myeditorinstance" :value="old('content', $page->content)" />

                            <br>

                            <!-- زر الإرسال -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Update Page" data-ar="تحديث الصفحة">
                                    تحديث الصفحة
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
