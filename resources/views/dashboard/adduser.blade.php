@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة مستخدم')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">

                        <!-- ✅ عنوان الصفحة -->
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between g-3">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title" data-ar="إضافة مستخدم" data-en="Add User">إضافة مستخدم</h4>
                                    <div class="nk-block-des text-soft">
                                        <p data-ar="املأ النموذج أدناه لإضافة مستخدم جديد."
                                            data-en="Fill out the form below to add a new user.">
                                            املأ النموذج أدناه لإضافة مستخدم جديد.
                                        </p>
                                    </div>
                                </div>
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
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="{{ route('dashboard.user.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <!-- الاسم -->
                                    <div class="form-group">
                                        <label class="form-label" for="name" data-ar="الاسم"
                                            data-en="First Name">الاسم</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="name" class="form-control" id="name"
                                                value="{{ old('name') }}" required>
                                        </div>
                                    </div>

                                    <!-- اللقب -->
                                    <div class="form-group">
                                        <label class="form-label" for="surname" data-ar="اللقب"
                                            data-en="Last Name">اللقب</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="surname" class="form-control" id="surname"
                                                value="{{ old('surname') }}" required>
                                        </div>
                                    </div>

                                    <!-- البريد -->
                                    <div class="form-group">
                                        <label class="form-label" for="email" data-ar="البريد الإلكتروني"
                                            data-en="Email">البريد الإلكتروني</label>
                                        <div class="form-control-wrap">
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ old('email') }}" required>
                                        </div>
                                    </div>

                                    <!-- كلمة المرور -->
                                    <div class="form-group">
                                        <label class="form-label" for="password" data-ar="كلمة المرور"
                                            data-en="Password">كلمة المرور</label>
                                        <div class="form-control-wrap">
                                            <input type="password" name="password" class="form-control" id="password"
                                                required>
                                        </div>
                                    </div>

                                    <!-- الأدوار -->
                                    <div class="form-group">
                                        <label class="form-label" data-ar="الأدوار" data-en="Roles">الأدوار</label>
                                        <div class="row">
                                            @foreach ($roles as $role)
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                                            id="role-{{ $role->id }}" class="custom-control-input"
                                                            {{ collect(old('roles'))->contains($role->id) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="role-{{ $role->id }}">
                                                            {{ $role->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                    <!-- صورة -->
                                    <div class="form-group">
                                        <label class="form-label" for="customFile" data-ar="الصورة"
                                            data-en="Profile Image">الصورة</label>
                                        <div class="form-file">
                                            <input type="file" name="image" class="form-file-input" id="customFile"
                                                accept="image/*">
                                            <label class="form-file-label" for="customFile" data-ar="اختر صورة..."
                                                data-en="Choose an image...">اختر صورة...</label>
                                        </div>
                                    </div>

                                    <!-- أزرار -->
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <em class="icon ni ni-save"></em>
                                            <span data-ar="إضافة مستخدم" data-en="Add User">إضافة مستخدم</span>
                                        </button>
                                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-light">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span data-ar="إلغاء" data-en="Cancel">إلغاء</span>
                                        </a>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
