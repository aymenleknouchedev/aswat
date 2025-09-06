@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل مستخدم')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid">

                        <!-- ✅ عنوان الصفحة -->
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between g-3">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title" data-ar="تعديل مستخدم" data-en="Edit User">تعديل مستخدم</h4>
                                    <div class="nk-block-des text-soft">
                                        <p data-ar="قم بتحديث النموذج أدناه لتعديل المستخدم."
                                            data-en="Update the form below to edit the user.">
                                            قم بتحديث النموذج أدناه لتعديل المستخدم.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em>
                                <span>{{ session('success') ?? 'تم التعديل بنجاح' }}</span>
                            </div>
                        @endif

                        <!-- رسائل الخطأ -->
                        @if ($errors->any())
                            <div class="alert alert-fill alert-danger alert-icon">
                                <em class="icon ni ni-cross-circle"></em>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- ✅ النموذج -->
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="{{ route('dashboard.user.update', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- الاسم -->
                                    <div class="form-group">
                                        <label class="form-label" for="name">الاسم</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="name" class="form-control" id="name"
                                                value="{{ old('name', $user->name) }}" required>
                                        </div>
                                    </div>

                                    <!-- اللقب -->
                                    <div class="form-group">
                                        <label class="form-label" for="surname">اللقب</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="surname" class="form-control" id="surname"
                                                value="{{ old('surname', $user->surname) }}" required>
                                        </div>
                                    </div>

                                    <!-- البريد -->
                                    <div class="form-group">
                                        <label class="form-label" for="email">البريد الإلكتروني</label>
                                        <div class="form-control-wrap">
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ old('email', $user->email) }}" required>
                                        </div>
                                    </div>

                                    <!-- كلمة المرور (اختيارية عند التعديل) -->
                                    <div class="form-group">
                                        <label class="form-label" for="password">كلمة المرور (اختياري)</label>
                                        <div class="form-control-wrap">
                                            <input type="password" name="password" class="form-control" id="password">
                                            <small class="text-soft">اترك الحقل فارغًا إذا لا تريد تغييره</small>
                                        </div>
                                    </div>

                                    <!-- ✅ الأدوار -->
                                    <div class="form-group">
                                        <label class="form-label d-block">الأدوار</label>
                                        <div class="row">
                                            @foreach ($roles as $role)
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                                            id="role_{{ $role->id }}" class="form-check-input"
                                                            {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="role_{{ $role->id }}">
                                                            {{ $role->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                    <!-- صورة -->
                                    <div class="form-group">
                                        <label class="form-label" for="customFile">الصورة</label>
                                        @if ($user->image)
                                            <div class="mb-2">
                                                <img src="{{ asset('uploads/users/' . $user->image) }}" alt="صورة المستخدم"
                                                    class="img-thumbnail" width="100">
                                            </div>
                                        @endif
                                        <div class="form-file">
                                            <input type="file" name="image" class="form-file-input" id="customFile"
                                                accept="image/*">
                                            <label class="form-file-label" for="customFile">اختر صورة...</label>
                                        </div>
                                    </div>

                                    <!-- أزرار -->
                                    <div class="form-group mt-4">
                                        <form action="{{ route('dashboard.user.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary">
                                                <em class="icon ni ni-save"></em>
                                                <span>تحديث مستخدم</span>
                                            </button>
                                        </form>

                                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-light">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>إلغاء</span>
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
