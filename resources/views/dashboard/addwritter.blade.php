@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة كاتب')

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
                                <h4 class="nk-block-title" data-en="Add New Writer" data-ar="إضافة كاتب">إضافة كاتب</h4>
                                <p data-en="Fill the form below to create a new writer."
                                    data-ar="املأ النموذج أدناه لإضافة كاتب جديد.">
                                    املأ النموذج أدناه لإضافة كاتب جديد.
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
                        <form action="{{ route('dashboard.writer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- سلاق -->
                            <div class="form-group">
                                <label class="form-label" for="slug" data-en="Slug" data-ar="الرابط">الرابط</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="slug" class="form-control" id="slug"
                                        value="{{ old('slug') }}" placeholder="مثال: ahmed-mohamed" required>
                                </div>
                                @error('slug')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- نبذة تعريفية -->
                            <div class="form-group">
                                <label class="form-label" for="bio" data-en="Bio" data-ar="نبذة">نبذة</label>
                                <div class="form-control-wrap">
                                    <textarea name="bio" class="form-control" id="bio" rows="4" required>{{ old('bio') }}</textarea>
                                </div>
                                @error('bio')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- صورة الكاتب -->
                            <div class="form-group">
                                <label class="form-label" for="customFile" data-en="Image" data-ar="الصورة"></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" name="image" class="form-file-input" id="customFile"
                                            accept="image/*">
                                        <label class="form-file-label" for="customFile">
                                            <span data-en="Choose file" data-ar="اختر الملف"></span>
                                        </label>
                                    </div>
                                </div>
                                @error('image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- روابط وسائل التواصل -->
                            <div class="form-group">
                                <label class="form-label" for="facebook" data-en="Facebook" data-ar="فيسبوك">فيسبوك</label>
                                <div class="form-control-wrap">
                                    <input type="url" name="facebook" class="form-control" id="facebook"
                                        value="{{ old('facebook') }}" placeholder="https://facebook.com/">
                                </div>
                                @error('facebook')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="x" data-en="X" data-ar="إكس">X</label>
                                <div class="form-control-wrap">
                                    <input type="url" name="x" class="form-control" id="x"
                                        value="{{ old('x') }}" placeholder="https://x.com/">
                                </div>
                                @error('x')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="instagram" data-en="Instagram"
                                    data-ar="انستغرام">إنستغرام</label>
                                <div class="form-control-wrap">
                                    <input type="url" name="instagram" class="form-control" id="instagram"
                                        value="{{ old('instagram') }}" placeholder="https://instagram.com/">
                                </div>
                                @error('instagram')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="linkedin" data-en="LinkedIn"
                                    data-ar="لينكد إن">لينكدإن</label>
                                <div class="form-control-wrap">
                                    <input type="url" name="linkedin" class="form-control" id="linkedin"
                                        value="{{ old('linkedin') }}" placeholder="https://linkedin.com/">
                                </div>
                                @error('linkedin')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- زر الإرسال -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Add Writer"
                                    data-ar="إضافة كاتب">إضافة كاتب</button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
