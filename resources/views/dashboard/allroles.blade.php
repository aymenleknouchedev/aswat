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



                            <!-- ✅ الأدوار -->
                            <div class="card card-bordered card-preview">
                                @if (count($roles) > 0)
                                    <table class="table table-orders text-center align-middle">
                                        <thead class="tb-odr-head">
                                            <tr class="tb-odr-item">
                                                <th data-en="Role Name" data-ar="اسم الدور" class="text-center">
                                                    اسم الدور
                                                </th>
                                                <th data-en="Actions" data-ar="الإجراءات" class="text-center">
                                                    الإجراءات
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="tb-odr-body">
                                            @foreach ($roles as $role)
                                                <tr class="tb-odr-item">
                                                    <td style="width: 200px;" class="text-center">
                                                        <strong>{{ $role->name }}</strong>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('dashboard.role.edit', $role->id) }}"
                                                            class="btn btn-sm btn-primary" data-en="Edit" data-ar="تعديل">
                                                            تعديل
                                                        </a>

                                                        @if (!Auth::user()->roles->contains($role->id))
                                                            <form action="{{ route('dashboard.role.destroy', $role->id) }}"
                                                                method="POST" class="delete-form d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger delete-btn"
                                                                    data-en="Delete" data-ar="حذف">
                                                                    حذف
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-sm btn-secondary" disabled
                                                                title="لا يمكنك حذف دورك">
                                                                لا يمكن الحذف
                                                            </button>
                                                        @endif
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
