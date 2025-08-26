@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الصلاحيات')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid">

                        <!-- ✅ العنوان -->
                        <div class="nk-block-head">
                            <div class="nk-block-head-content d-flex justify-content-between align-items-center">
                                <h4 class="nk-block-title">جميع الصلاحيات</h4>
                                <a href="{{ route('dashboard.permission.create') }}" class="btn btn-primary">إضافة
                                    صلاحية</a>
                            </div>
                        </div>

                        <!-- ✅ رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- ✅ الجدول -->
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم الصلاحية</th>
                                            <th>الوصف</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $fakePermissions = [
                                                [
                                                    'id' => 1,
                                                    'name' => 'إدارة المستخدمين',
                                                    'description' => 'إضافة وتعديل وحذف المستخدمين',
                                                ],
                                                [
                                                    'id' => 2,
                                                    'name' => 'إدارة الأدوار',
                                                    'description' => 'إنشاء وتحرير الأدوار',
                                                ],
                                                [
                                                    'id' => 3,
                                                    'name' => 'إدارة الصلاحيات',
                                                    'description' => 'إعطاء وإزالة الصلاحيات',
                                                ],
                                                [
                                                    'id' => 4,
                                                    'name' => 'عرض التقارير',
                                                    'description' => 'الوصول إلى تقارير النظام',
                                                ],
                                                [
                                                    'id' => 5,
                                                    'name' => 'إدارة الإعدادات',
                                                    'description' => 'تحديث إعدادات الموقع',
                                                ],
                                                [
                                                    'id' => 6,
                                                    'name' => 'إدارة المقالات',
                                                    'description' => 'إضافة وتحرير المقالات',
                                                ],
                                                [
                                                    'id' => 7,
                                                    'name' => 'إدارة التعليقات',
                                                    'description' => 'مراجعة وحذف التعليقات',
                                                ],
                                                [
                                                    'id' => 8,
                                                    'name' => 'إدارة الوسائط',
                                                    'description' => 'رفع وحذف الصور والفيديوهات',
                                                ],
                                                [
                                                    'id' => 9,
                                                    'name' => 'إدارة الإعلانات',
                                                    'description' => 'إضافة وتحرير وحذف الإعلانات',
                                                ],
                                                [
                                                    'id' => 10,
                                                    'name' => 'صلاحية مخصصة',
                                                    'description' => 'صلاحية تجريبية لاختبار النظام',
                                                ],
                                            ];
                                        @endphp

                                        @foreach ($fakePermissions as $fake)
                                            <tr>
                                                <td>{{ $fake['id'] }}</td>
                                                <td>{{ $fake['name'] }}</td>
                                                <td>{{ $fake['description'] }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning">تعديل</a>
                                                    <button class="btn btn-sm btn-danger">حذف</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
