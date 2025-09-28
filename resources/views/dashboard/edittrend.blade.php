@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل ترند')

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
                                <h4 class="nk-block-title" data-en="Edit Trend" data-ar="تعديل ترند">تعديل ترند</h4>
                                <p data-en="Update the form below to edit the trend."
                                   data-ar="قم بتحديث النموذج أدناه لتعديل الترند.">
                                    قم بتحديث النموذج أدناه لتعديل الترند.
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
                        <form action="{{ route('dashboard.trend.update', $trend->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- عنوان الترند -->
                            <div class="form-group">
                                <label class="form-label" for="title" data-en="Trend Title" data-ar="عنوان الترند">
                                    عنوان الترند
                                </label>
                                <div class="form-control-wrap">
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{ old('title', $trend->title) }}" required>
                                </div>
                                @error('title')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="form-group">
                                <label class="form-label" for="slug" data-en="Slug" data-ar="الرابط المختصر">الرابط المختصر</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="slug" class="form-control" id="slug"
                                           value="{{ old('slug', $trend->slug) }}" required>
                                </div>
                                @error('slug')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- زر التحديث -->
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary"
                                        data-en="Update Trend" data-ar="تحديث الترند">
                                    تحديث الترند
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
