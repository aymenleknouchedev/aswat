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
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title" data-en="All Roles" data-ar="جميع الأدوار">
                                        جميع الأدوار
                                    </h4>
                                    <p data-en="List of all roles and their permissions."
                                        data-ar="قائمة الأدوار وصلاحياتها.">
                                        قائمة الأدوار وصلاحياتها.
                                    </p>
                                </div>
                            </div>

                            <!-- ✅ الأدوار -->
                            <div class="card card-bordered card-preview">
                                @if (count($roles) > 0)
                                    <table class="table table-orders">
                                        <thead class="tb-odr-head">
                                            <tr class="tb-odr-item">
                                                <th>#</th>
                                                <th data-en="Role Name" data-ar="اسم الدور">اسم الدور</th>
                                                <th data-en="Permissions" data-ar="الصلاحيات">الصلاحيات</th>
                                                <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tb-odr-body">
                                            @foreach ($roles as $role)
                                                <tr class="tb-odr-item">
                                                    <td class="text-center" style="width: 60px;">{{ $role->id }}</td>

                                                    <td style="width: 200px;">
                                                        <strong>{{ $role->name }}</strong>
                                                    </td>

                                                    <!-- Permissions column auto-expands -->
                                                    <td>
                                                        <div class="d-flex flex-wrap gap-1">
                                                            @foreach ($role->permissions->take(6) as $perm)
                                                                <span class="badge badge-dim badge-primary">
                                                                    {{ $perm->name }}
                                                                </span>
                                                            @endforeach

                                                            @if ($role->permissions->count() > 6)
                                                                <span class="badge badge-dim badge-secondary">...</span>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td class="text-center" style="width: 150px;">
                                                        <a href="{{ route('dashboard.role.edit', $role->id) }}"
                                                            class="btn btn-sm btn-primary" data-en="Edit" data-ar="تعديل">
                                                            تعديل
                                                        </a>

                                                        <form action="{{ route('dashboard.role.destroy', $role->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                data-en="Delete" data-ar="حذف">حذف</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <!-- ✅ ويدجت أنيقة عند عدم وجود أدوار -->
                                    <div class="text-center p-5">
                                        <h5 class="mt-3 text-muted" data-en="No roles found yet"
                                            data-ar="لا توجد أدوار بعد">
                                            لا توجد أدوار بعد
                                        </h5>
                                        <a href="{{ route('dashboard.role.create') }}" class="btn btn-primary mt-3"
                                            data-en="Add New Role" data-ar="إضافة دور جديد">
                                            + إضافة دور جديد
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <!-- ✅ نهاية الأدوار -->

                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
