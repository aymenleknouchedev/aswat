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
                                <h4 class="nk-block-title" data-en="Add New User" data-ar="إضافة مستخدم">إضافة مستخدم</h4>
                                <p data-en="Fill the form below to create a new user."
                                   data-ar="املأ النموذج أدناه لإضافة مستخدم جديد.">
                                   املأ النموذج أدناه لإضافة مستخدم جديد.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم"></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="surname" data-en="Surname" data-ar="اللقب"></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="surname" class="form-control" id="surname" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email" data-en="Email" data-ar="البريد الإلكتروني"></label>
                                <div class="form-control-wrap">
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="example@email.com" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="password" data-en="Password" data-ar="كلمة المرور"></label>
                                <div class="form-control-wrap">
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="********" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="role" data-en="Role" data-ar="الدور"></label>
                                <div class="form-control-wrap">
                                    <select name="role" class="form-control" id="role" required>
                                        <option value="admin" data-en="Admin" data-ar="مشرف"></option>
                                        <option value="editor" data-en="Editor" data-ar="محرر"></option>
                                        <option value="writer" selected data-en="Writer" data-ar="كاتب"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="customFile" data-en="Image" data-ar="الصورة"></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" name="image[]" multiple class="form-file-input"
                                            id="customFile" accept="image/*">
                                        <label class="form-file-label" for="customFile">
                                            <span data-en="Choose file" data-ar="اختر الملف"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Add User"
                                    data-ar="إضافة مستخدم"></button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
