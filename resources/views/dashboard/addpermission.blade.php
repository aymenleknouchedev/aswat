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
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between g-3">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title" data-ar="إضافة صلاحية" data-en="Add Permission">إضافة صلاحية</h4>
                                    <div class="nk-block-des text-soft">
                                        <p data-ar="املأ النموذج أدناه لإضافة صلاحية جديدة يمكن ربطها بالأدوار."
                                           data-en="Fill the form below to add a new permission that can be assigned to roles.">
                                           املأ النموذج أدناه لإضافة صلاحية جديدة يمكن ربطها بالأدوار.
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
                                <form action="{{ route('dashboard.permission.store') }}" method="POST">
                                    @csrf
                                    <!-- اسم الصلاحية -->
                                    <div class="form-group">
                                        <label class="form-label" for="name" data-ar="اسم الصلاحية" data-en="Permission Name">اسم الصلاحية</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="name" class="form-control" id="name"
                                                value="{{ old('name') }}" required
                                                placeholder="مثال: edit-posts">
                                        </div>
                                    </div>

                                    <!-- أزرار -->
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <em class="icon ni ni-save"></em>
                                            <span data-ar="حفظ الصلاحية" data-en="Save Permission">حفظ الصلاحية</span>
                                        </button>
                                        <a href="{{ route('dashboard.permissions.index') }}" class="btn btn-light">
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
