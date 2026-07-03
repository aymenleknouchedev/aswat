@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة تصنيف')

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
                                <h4 class="nk-block-title" data-en="Add New Category" data-ar="إضافة تصنيف">إضافة تصنيف</h4>
                                <p data-en="Fill the form below to create a new category."
                                    data-ar="املأ النموذج أدناه لإضافة تصنيف جديد.">
                                    املأ النموذج أدناه لإضافة تصنيف جديد.
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
                        <form action="{{ route('dashboard.categorie.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الإسم">الإسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- صورة السوشيال ميديا -->
                            <div class="form-group">
                                <label class="form-label" for="social_image" data-en="Social Media Image"
                                    data-ar="صورة السوشيال ميديا">صورة السوشيال ميديا</label>
                                <div class="form-control-wrap">
                                    <input type="file" name="social_image" id="social_image" class="form-control"
                                        accept="image/*">
                                </div>
                                @error('social_image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- الوصف -->
                            <div class="form-group">
                                <label class="form-label" for="description" data-en="Description"
                                    data-ar="الوصف">الوصف</label>
                                <div class="form-control-wrap">
                                    <textarea name="description" id="description" rows="3" class="form-control"
                                        placeholder="الوصف (يُستخدم في مشاركة السوشيال ميديا)">{{ old('description') }}</textarea>
                                </div>
                            </div>


                            <!-- زر الإرسال -->
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary" data-en="Add Category" data-ar="إضافة تصنيف">
                                    إضافة تصنيف
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
