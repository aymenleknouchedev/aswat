@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إدارة النوافذ')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">

                        <!-- ✅ عنوان الصفحة -->
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-en="Window Management" data-ar="إدارة النوافذ">
                                    إدارة النوافذ
                                </h4>
                                <p data-en="Manage all windows for each dashboard section below."
                                   data-ar="قم بإدارة جميع النوافذ لكل قسم من لوحة التحكم أدناه.">
                                    قم بإدارة جميع النوافذ لكل قسم من لوحة التحكم أدناه.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em>
                                <span class="translatable" data-ar="تم التحديث بنجاح" data-en="Updated successfully">
                                    {{ session('success') ?? 'تم التحديث بنجاح' }}
                                </span>
                            </div>
                        @endif

                        <!-- ✅ رسائل الخطأ -->
                        @if ($errors->any())
                            <div class="alert alert-fill alert-danger alert-icon">
                                <em class="icon ni ni-cross-circle"></em>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- ✅ قائمة النوافذ لكل قسم -->
                        @foreach ($sections as $section)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title" data-ar="{{ $section->title_ar }}" data-en="{{ $section->title_en }}">
                                        {{ $section->title_ar }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th data-ar="اسم النافذة" data-en="Window Name">اسم النافذة</th>
                                                <th data-ar="الحالة" data-en="Status">الحالة</th>
                                                <th data-ar="إجراءات" data-en="Actions">إجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($section->windows as $window)
                                                <tr>
                                                    <td>{{ $window->name }}</td>
                                                    <td>
                                                        <span class="badge {{ $window->is_active ? 'badge-success' : 'badge-danger' }}">
                                                            {{ $window->is_active ? 'مفعلة' : 'غير مفعلة' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('dashboard.windows.edit', $window->id) }}" class="btn btn-sm btn-primary" data-ar="تعديل" data-en="Edit">تعديل</a>
                                                        <form action="{{ route('dashboard.windows.destroy', $window->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" data-ar="حذف" data-en="Delete" onclick="return confirm('هل أنت متأكد من حذف النافذة؟');">حذف</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <a href="{{ route('dashboard.windows.create', ['section_id' => $section->id]) }}" class="btn btn-success mt-2" data-ar="إضافة نافذة جديدة" data-en="Add New Window">إضافة نافذة جديدة</a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection