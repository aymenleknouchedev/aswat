@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة صلاحية')

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
                                <h4 class="nk-block-title">إضافة صلاحية</h4>
                                <p>املأ النموذج أدناه لإضافة صلاحية جديدة يمكن ربطها بالأدوار.</p>
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
                        <form action="{{ route('dashboard.permission.store') }}" method="POST">
                            @csrf

                            <!-- اسم الصلاحية -->
                            <div class="form-group">
                                <label for="name">اسم الصلاحية</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{ old('name') }}" required>
                            </div>

                            <!-- الوصف (اختياري) -->
                            <div class="form-group">
                                <label for="description">الوصف (اختياري)</label>
                                <textarea name="description" id="description" class="form-control"
                                          rows="3">{{ old('description') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">إضافة صلاحية</button>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
