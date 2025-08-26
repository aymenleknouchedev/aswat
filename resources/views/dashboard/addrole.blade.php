@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة دور')

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
                                <h4 class="nk-block-title">إضافة دور</h4>
                                <p>املأ النموذج أدناه لإضافة دور جديد وتحديد صلاحياته.</p>
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
                        <form action="{{ route('dashboard.role.store') }}" method="POST">
                            @csrf

                            <!-- اسم الدور -->
                            <div class="form-group">
                                <label for="name">اسم الدور</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name') }}" required>
                            </div>

                            <!-- اختيار الصلاحيات -->
                            <!-- اختيار الصلاحيات -->
                            <div class="form-group">
                                <label for="permissions">الصلاحيات</label>
                                <div class="row">
                                    @php
                                        $fakePermissions = [
                                            ['id' => 1, 'name' => 'إدارة المستخدمين'],
                                            ['id' => 2, 'name' => 'إدارة الأدوار'],
                                            ['id' => 3, 'name' => 'إدارة الصلاحيات'],
                                            ['id' => 4, 'name' => 'عرض التقارير'],
                                            ['id' => 5, 'name' => 'إدارة الإعدادات'],
                                            ['id' => 6, 'name' => 'إدارة المقالات'],
                                            ['id' => 7, 'name' => 'إدارة التعليقات'],
                                            ['id' => 8, 'name' => 'إدارة الوسائط'],
                                            ['id' => 9, 'name' => 'إدارة الإعلانات'],
                                            ['id' => 10, 'name' => 'صلاحية مخصصة'],
                                        ];
                                    @endphp

                                    @foreach ($fakePermissions as $permission)
                                        <div class="col-md-3 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}"
                                                    class="custom-control-input" id="perm-{{ $permission['id'] }}">
                                                <label class="custom-control-label" for="perm-{{ $permission['id'] }}">
                                                    {{ $permission['name'] }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">إضافة دور</button>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
