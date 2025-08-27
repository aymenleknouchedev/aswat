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
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title" data-en="All Permissions" data-ar="جميع الصلاحيات">
                                        جميع الصلاحيات
                                    </h4>
                                    <p data-en="List of all permissions in the system." data-ar="قائمة جميع الصلاحيات في النظام.">
                                        قائمة جميع الصلاحيات في النظام.
                                    </p>
                                </div>
                            </div>

                            <!-- ✅ الصلاحيات -->
                            <div class="card card-bordered card-preview">
                                @if (count($permissions) > 0)
                                    <table class="table table-orders">
                                        <thead class="tb-odr-head">
                                            <tr class="tb-odr-item">
                                                <th>#</th>
                                                <th data-en="Permission Name" data-ar="اسم الصلاحية">اسم الصلاحية</th>
                                                <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tb-odr-body">
                                            @foreach ($permissions as $perm)
                                                <tr class="tb-odr-item">
                                                    <td>{{ $perm->id }}</td>
                                                    <td>
                                                        <span class="badge badge-dim badge-primary">
                                                            {{ $perm->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary"
                                                            data-en="Edit" data-ar="تعديل">
                                                            تعديل
                                                        </a>

                                                        <form action="#" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                data-en="Delete" data-ar="حذف">
                                                                حذف
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <!-- ✅ ويدجت أنيقة عند عدم وجود صلاحيات -->
                                    <div class="text-center p-5">
                                        <h5 class="mt-3 text-muted" data-en="No permissions found yet"
                                            data-ar="لا توجد صلاحيات بعد">
                                            لا توجد صلاحيات بعد
                                        </h5>
                                        <a href="#" class="btn btn-primary mt-3"
                                            data-en="Add New Permission" data-ar="إضافة صلاحية جديدة">
                                            + إضافة صلاحية جديدة
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <!-- ✅ نهاية الصلاحيات -->

                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
