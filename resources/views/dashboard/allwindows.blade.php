@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع النوافذ')

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
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title" data-en="All Windows" data-ar="جميع النوافذ">جميع النوافذ</h4>
                                    <p data-en="Manage all windows from here" data-ar="قم بإدارة جميع النوافذ من هنا">
                                        قم بإدارة جميع النوافذ من هنا
                                    </p>
                                </div>
                                <div class="nk-block-head-content">
                                    <a href="{{ route('dashboard.window.create') }}" class="btn btn-primary"
                                        data-en="Add Window" data-ar="إضافة نافذة">إضافة نافذة</a>
                                </div>
                            </div>
                        </div>

                        <!-- ✅ جدول النوافذ -->
                        <div class="card card-bordered card-preview">
                            <table class="table table-orders">
                                <thead class="tb-odr-head">
                                    <tr class="tb-odr-item">
                                        <th data-en="Name" data-ar="الاسم">الاسم</th>
                                        <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($windows as $index => $window)
                                        <tr>
                                            <td>{{ $window->name }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.window.edit', $window->id) }}"
                                                    class="btn btn-sm btn-primary" data-en="Edit" data-ar="تعديل">تعديل</a>

                                                <form action="{{ route('dashboard.window.destroy', $window->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('هل أنت متأكد من الحذف؟');" data-en="Delete"
                                                        data-ar="حذف">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center" data-en="No windows found"
                                                data-ar="لا توجد نوافذ">لا توجد نوافذ</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
