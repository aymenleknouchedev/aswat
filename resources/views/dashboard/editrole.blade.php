@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل دور')

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
                                    <h4 class="nk-block-title" data-ar="تعديل دور" data-en="Edit Role">تعديل دور</h4>
                                    <div class="nk-block-des text-soft">
                                        <p data-ar="قم بتحديث النموذج أدناه لتعديل الدور وصلاحياته."
                                            data-en="Update the form below to edit the role and its permissions.">
                                            قم بتحديث النموذج أدناه لتعديل الدور وصلاحياته.
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
                                <form action="{{ route('dashboard.role.update', $role->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- اسم الدور -->
                                    <div class="form-group">
                                        <label class="form-label" for="name">اسم الدور</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="name" class="form-control" id="name"
                                                value="{{ old('name', $role->name) }}" required>
                                        </div>
                                    </div>

                                    <!-- اختيار الصلاحيات -->
                                    <div class="form-group">
                                        <label class="form-label">الصلاحيات</label>
                                        <div class="row g-2">
                                            @foreach ($permissions as $permission)
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}" class="custom-control-input"
                                                            id="perm-{{ $permission->id }}"
                                                            {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                                            <span>تحديث الدور</span>
                                        </button>
                                        <a href="{{ route('dashboard.roles.index') }}" class="btn btn-light">
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
