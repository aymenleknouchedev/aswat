@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة ترند')

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
                                <h4 class="nk-block-title" data-en="Add New Trend" data-ar="إضافة ترند">إضافة ترند</h4>
                                <p data-en="Fill the form below to create a new trend."
                                    data-ar="املأ النموذج أدناه لإضافة ترند جديد.">
                                    املأ النموذج أدناه لإضافة ترند جديد.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ رسالة النجاح -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- ✅ عرض الأخطاء -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.trend.store') }}" method="POST">
                            @csrf

                            <!-- اسم الترند -->
                            <div class="form-group">
                                <label class="form-label" for="title" data-en="Trend Title" data-ar="عنوان الترند">عنوان
                                    الترند</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ old('title') }}" required>
                                </div>
                                @error('title')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- زر الإرسال -->
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary" data-en="Add Trend" data-ar="إضافة ترند">
                                    إضافة ترند
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
