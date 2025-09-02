@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الترندات')

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
                                    <h4 class="nk-block-title" data-en="All Trends" data-ar="جميع الترندات">جميع الترندات</h4>
                                    <p data-en="Manage all trends from here" data-ar="قم بإدارة جميع الترندات من هنا">
                                        قم بإدارة جميع الترندات من هنا
                                    </p>
                                </div>
                                <div class="nk-block-head-content">
                                    <a href="{{ route('dashboard.trend.create') }}" class="btn btn-primary"
                                        data-en="Add Trend" data-ar="إضافة ترند">إضافة ترند</a>
                                </div>
                            </div>
                        </div>

                        <!-- ✅ جدول الترندات -->
                        <div class="card card-bordered card-preview">
                            <table class="table table-orders">
                                <thead class="tb-odr-head">
                                    <tr class="tb-odr-item">
                                        <th data-en="Name" data-ar="الاسم">الاسم</th>
                                        <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($trends as $trend)
                                        <tr>
                                            <td>{{ $trend->title }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.trend.edit', $trend->id) }}"
                                                    class="btn btn-sm btn-primary" data-en="Edit" data-ar="تعديل">تعديل</a>

                                                <form action="{{ route('dashboard.trend.destroy', $trend->id) }}"
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
                                            <td colspan="2" class="text-center" data-en="No trends found"
                                                data-ar="لا توجد ترندات">لا توجد ترندات</td>
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
