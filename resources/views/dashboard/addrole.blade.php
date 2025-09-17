@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة دور')

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
                                    <h4 class="nk-block-title" data-ar="إضافة دور" data-en="Add Role">إضافة دور</h4>
                                    <div class="nk-block-des text-soft">
                                        <p data-ar="املأ النموذج أدناه لإضافة دور جديد وتحديد صلاحياته."
                                            data-en="Fill the form below to add a new role and assign its permissions.">
                                            املأ النموذج أدناه لإضافة دور جديد وتحديد صلاحياته.
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
                                <form action="{{ route('dashboard.role.store') }}" method="POST">
                                    @csrf

                                    <!-- اسم الدور -->
                                    <div class="form-group">
                                        <label class="form-label" for="name" data-ar="اسم الدور" data-en="Role Name">اسم
                                            الدور</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="name" class="form-control" id="name"
                                                value="{{ old('name') }}" required>
                                        </div>
                                    </div>

                                    <!-- اختيار الصلاحيات -->
                                    <div class="form-group">
                                        <label class="form-label" data-ar="الصلاحيات"
                                            data-en="Permissions">الصلاحيات</label>
                                        <div class="row g-2">

                                            @foreach ($permissions as $permission)
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}" class="custom-control-input"
                                                            id="perm-{{ $permission->id }}">

                                                        <label class="custom-control-label"
                                                            for="perm-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <!-- أزرار -->
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <em class="icon ni ni-save"></em>
                                            <span data-ar="حفظ الدور" data-en="Save Role">حفظ الدور</span>
                                        </button>
                                        <a href="{{ route('dashboard.roles.index') }}" class="btn btn-light">
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
