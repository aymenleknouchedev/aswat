@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل قسم')

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
                                <h4 class="nk-block-title" data-en="Edit Section" data-ar="تعديل قسم">تعديل قسم</h4>
                                <p data-en="Update the form below to edit the section."
                                    data-ar="قم بتحديث النموذج أدناه لتعديل القسم.">
                                    قم بتحديث النموذج أدناه لتعديل القسم.
                                </p>
                            </div>
                        </div>

                        <!-- رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em>
                                <span class="translatable" data-ar="تم التعديل بنجاح" data-en="Updated successfully">
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
                        <form action="{{ route('dashboard.section.update', $section->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ old('name', $section->name) }}" required>
                                </div>
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label" for="social_image" data-en="Social Media Image"
                                    data-ar="صورة السوشيال ميديا">صورة السوشيال ميديا</label>
                                <div class="form-control-wrap">
                                    <input type="file" name="social_image" id="social_image" class="form-control"
                                        accept="image/*">
                                </div>
                                @if ($section->social_image)
                                    <div class="mt-2">
                                        <img src="{{ asset($section->social_image) }}" alt="Social image"
                                            style="max-width: 240px; border: 1px solid #eee;">
                                        <p class="text-soft small mt-1" data-en="Current image (leave empty to keep it)"
                                            data-ar="الصورة الحالية (اترك الحقل فارغاً للإبقاء عليها)">
                                            الصورة الحالية (اترك الحقل فارغاً للإبقاء عليها)</p>
                                    </div>
                                @endif
                                @error('social_image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label" for="description" data-en="Description" data-ar="الوصف">الوصف</label>
                                <div class="form-control-wrap">
                                    <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $section->description) }}</textarea>
                                </div>
                                @error('description')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary" data-en="Update Section"
                                    data-ar="تحديث القسم">تحديث القسم</button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection

