@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل تصنيف')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')

            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">

                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title" data-en="Edit Category" data-ar="تعديل تصنيف">
                                        تعديل تصنيف
                                    </h4>
                                    <p data-en="Update the form below to edit the category"
                                       data-ar="قم بتحديث النموذج أدناه لتعديل التصنيف">
                                        قم بتحديث النموذج أدناه لتعديل التصنيف
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
                            <form action="{{ route('dashboard.categorie.update', $category->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="form-label" for="name" data-en="Name" data-ar="الإسم">الإسم</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="name" id="name"
                                               class="form-control"
                                               value="{{ old('name', $category->name) }}" required>
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
                                    @if ($category->social_image)
                                        <div class="mt-2">
                                            <img src="{{ asset($category->social_image) }}" alt="Social image"
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

                                <!-- الوصف -->
                                <div class="form-group">
                                    <label class="form-label" for="description" data-en="Description"
                                        data-ar="الوصف">الوصف</label>
                                    <div class="form-control-wrap">
                                        <textarea name="description" id="description" rows="3" class="form-control"
                                            placeholder="الوصف (يُستخدم في مشاركة السوشيال ميديا)">{{ old('description', $category->description) }}</textarea>
                                    </div>
                                </div>


                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary"
                                            data-en="Update Category" data-ar="تحديث التصنيف">
                                        تحديث التصنيف
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
