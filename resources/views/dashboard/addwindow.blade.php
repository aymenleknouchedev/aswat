@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة نافذة')

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
                                <h4 class="nk-block-title" data-en="Add New Window" data-ar="إضافة نافذة">إضافة نافذة</h4>
                                <p data-en="Fill the form below to create a new window."
                                    data-ar="املأ النموذج أدناه لإضافة نافذة جديدة.">
                                    املأ النموذج أدناه لإضافة نافذة جديدة.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- ✅ رسائل الأخطاء -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.window.store') }}" method="POST">
                            @csrf

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- زر الإرسال -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Add Window"
                                    data-ar="إضافة نافذة">إضافة نافذة</button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
