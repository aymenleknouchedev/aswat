@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع المستخدمين')

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
                                    <h4 class="nk-block-title" data-en="All Users" data-ar="جميع المستخدمين">
                                        جميع المستخدمين
                                    </h4>
                                    <p data-en="List of all registered users." data-ar="قائمة جميع المستخدمين المسجلين.">
                                        قائمة جميع المستخدمين المسجلين.
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


                            <!-- ✅ المستخدمين -->
                            <div class="card card-bordered card-preview">
                                @if ($users->count() > 0)
                                    <table class="table table-orders">
                                        <thead class="tb-odr-head">
                                            <tr class="tb-odr-item">
                                                <th data-en="Image" data-ar="الصورة">الصورة</th>
                                                <th data-en="Name" data-ar="الإسم">الإسم</th>
                                                <th data-en="Email" data-ar="الإيميل">الإيميل</th>
                                                <th data-en="Role" data-ar="الدور">الدور</th>
                                                <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tb-odr-body">
                                            @foreach ($users as $user)
                                                <tr class="tb-odr-item">
                                                    <td>
                                                        <img src="{{ asset('storage/users/' . $user->image) }}"
                                                            alt="user image" width="40" height="40"
                                                            class="rounded-circle">
                                                    </td>
                                                    <td>{{ $user->name }} {{ $user->surname }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    @if ($user->roles->isNotEmpty())
                                                        <td>
                                                            @foreach ($user->roles as $role)
                                                                <span class="badge badge-primary">{{ $role->name }}</span>
                                                            @endforeach
                                                        </td>
                                                    @else
                                                        <td> <span class="text-muted">لا يوجد دور</span>
                                                        </td>
                                                    @endif


                                                    <td>
                                                        <a href="{{ route('dashboard.user.edit', $user->id) }}"
                                                            class="btn btn-sm btn-primary" data-en="Edit"
                                                            data-ar="تعديل">تعديل</a>

                                                        @if ($user->id !== auth()->id())
                                                            <form action="{{ route('dashboard.user.destroy', $user->id) }}"
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
                                                                title="لا يمكنك حذف حسابك">
                                                                لا يمكن الحذف
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <!-- ✅ ويدجت أنيقة عند عدم وجود مستخدمين -->
                                    <div class="text-center p-5">
                                        <h5 class="mt-3 text-muted" data-en="No users found yet"
                                            data-ar="لا يوجد مستخدمون بعد">
                                            لا يوجد مستخدمون بعد
                                        </h5>
                                        <a href="{{ route('dashboard.user.create') }}" class="btn btn-primary mt-3"
                                            data-en="Add New User" data-ar="إضافة مستخدم جديد">
                                            + إضافة مستخدم جديد
                                        </a>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- ✅ نهاية المستخدمين -->

                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
