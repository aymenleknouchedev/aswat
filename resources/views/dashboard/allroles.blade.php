@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الأدوار')

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
                                <h4 class="nk-block-title">جميع الأدوار</h4>
                                <a href="{{ route('dashboard.role.create') }}" class="btn btn-primary">إضافة دور</a>
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
                                            <th>اسم الدور</th>
                                            <th>الصلاحيات</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $fakeRoles = [
                                                [
                                                    'id' => 1,
                                                    'name' => 'مدير النظام',
                                                    'permissions' => [
                                                        'إدارة المستخدمين',
                                                        'إدارة الأدوار',
                                                        'إدارة الصلاحيات',
                                                        'إدارة الإعدادات',
                                                    ],
                                                ],
                                                [
                                                    'id' => 2,
                                                    'name' => 'محرر',
                                                    'permissions' => [
                                                        'إدارة المقالات',
                                                        'إدارة التعليقات',
                                                        'إدارة الوسائط',
                                                    ],
                                                ],
                                                [
                                                    'id' => 3,
                                                    'name' => 'مشرف',
                                                    'permissions' => ['عرض التقارير', 'إدارة التعليقات'],
                                                ],
                                                [
                                                    'id' => 4,
                                                    'name' => 'كاتب',
                                                    'permissions' => ['إدارة المقالات'],
                                                ],
                                                [
                                                    'id' => 5,
                                                    'name' => 'زائر',
                                                    'permissions' => ['عرض التقارير'],
                                                ],
                                            ];
                                        @endphp

                                        @foreach ($fakeRoles as $role)
                                            <tr>
                                                <td>{{ $role['id'] }}</td>
                                                <td>{{ $role['name'] }}</td>
                                                <td>
                                                    @foreach ($role['permissions'] as $perm)
                                                        <span
                                                            class="badge badge-sm badge-outline-primary">{{ $perm }}</span>
                                                    @endforeach
                                                </td>
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
