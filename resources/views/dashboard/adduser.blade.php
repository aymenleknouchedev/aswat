@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة مستخدم')

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
                                <h4 class="nk-block-title">إضافة مستخدم</h4>
                                <p>املأ النموذج أدناه لإضافة مستخدم جديد.</p>
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
                        <form action="{{ route('dashboard.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="surname">اللقب</label>
                                <input type="text" name="surname" class="form-control" id="surname"
                                    value="{{ old('surname') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">كلمة المرور</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>

                            <div class="form-group">
                                <label for="role">الدور</label>
                                <select name="role" class="form-control" id="role" required>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>مشرف</option>
                                    <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>محرر</option>
                                    <option value="writer" {{ old('role', 'writer') == 'writer' ? 'selected' : '' }}>كاتب
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="customFile">الصورة</label>
                                <div class="form-file">
                                    <input type="file" name="image" class="form-file-input" id="customFile"
                                        accept="image/*">
                                    <label class="form-file-label" for="customFile">اختر صورة...</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">إضافة مستخدم</button>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
