@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل نافذة')

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
                                <h4 class="nk-block-title" data-en="Edit Window" data-ar="تعديل نافذة">تعديل نافذة</h4>
                                <p data-en="Update the form below to edit the window."
                                    data-ar="قم بتحديث النموذج أدناه لتعديل النافذة.">
                                    قم بتحديث النموذج أدناه لتعديل النافذة.
                                </p>
                            </div>
                        </div>

                        <!-- رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em>
                                <span class="translatable" data-ar="تم التعديل بنجاح"
                                    data-en="Updated successfully">
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
                        <form action="{{ route('dashboard.window.update', $window->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name', $window->name) }}" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Slug -->
                            <div class="form-group">
                                <label class="form-label" for="slug" data-en="Slug" data-ar="الرابط المختصر">الرابط المختصر</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="slug" class="form-control" id="slug"
                                        value="{{ old('slug', $window->slug) }}" required>
                                </div>
                                @error('slug')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- صورة النافذة -->
                            <div class="form-group">
                                <label class="form-label" for="image" data-en="Image" data-ar="الصورة">الصورة</label>
                                <div class="form-control-wrap">
                                    @if ($window->image)
                                        <div class="mb-2">
                                            <img src="{{ $window->image }}" alt="Window Image"
                                                style="max-width: 200px;">
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                                @error('image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- زر التحديث -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"
                                    data-en="Update Window" data-ar="تحديث نافذة">
                                    تحديث نافذة
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
