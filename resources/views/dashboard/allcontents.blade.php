@extends('layouts.admin')

@section('title', 'أصوات جزائرية | المحتوى')

@section('content')
    <div class="nk-content-body">

        <div class="nk-app-root">
            <div class="nk-main">
                @include('dashboard.components.sidebar')
                <div class="nk-wrap">
                    @include('dashboard.components.header')
                    <div class="nk-content">
                        <div class="container-fluid bg-white">
                            <div class="card-inner">

                                <!-- Table Header with Title & Button -->
                                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                    <h5 class="mb-0" data-en="All Contents" data-ar="جميع المحتوى">جميع المحتوى</h5>
                                    <a href="" class="btn btn-sm btn-outline-primary" data-en="Add New Content"
                                        data-ar="إضافة محتوى جديد">إضافة محتوى جديد</a>
                                </div>

                                <!-- ✅ Alerts -->
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show rounded shadow-sm mt-3"
                                        role="alert">
                                        <strong>✔ تم بنجاح:</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show rounded shadow-sm mt-3"
                                        role="alert">
                                        <strong>⚠ خطأ:</strong> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- Scrollable Table -->
                                <div style="overflow-x:auto;">
                                    <table class="table table-orders">
                                        <thead class="tb-odr-head sticky-top" style="z-index: 10;">
                                            <tr>
                                                <th style="font-weight: bold;" data-en="Id" data-ar="المعرف">المعرف</th>
                                                <th style="font-weight: bold;" data-en="Title" data-ar="العنوان">العنوان
                                                </th>
                                                <th style="font-weight: bold;" data-en="User" data-ar="المستخدم">المستخدم
                                                </th>
                                                <th style="font-weight: bold;" data-en="Section" data-ar="القسم">القسم</th>
                                                <th style="font-weight: bold;" data-en="Display Method"
                                                    data-ar="قالب العرض">قالب العرض
                                                </th>
                                                <th style="font-weight: bold;" data-en="Template" data-ar="القالب">القالب
                                                </th>
                                                <th style="font-weight: bold;" data-en="Status" data-ar="الحالة">الحالة</th>
                                                <th style="font-weight: bold;" data-en="Date" data-ar="التاريخ">التاريخ</th>
                                                <th style="font-weight: bold;" data-en="Author" data-ar="الكاتب">الكاتب</th>
                                                <th style="font-weight: bold;" data-en="Actions" data-ar="إجراءات">إجراءات
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($contents as $content)
                                                <tr>
                                                    <td>{{ $content->id }}</td>
                                                    <td>{{ $content->mobile_title }}</td>
                                                    <td>
                                                        @if ($content->user)
                                                            {{ $content->user->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($content->section)
                                                            {{ $content->section->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($content->template)
                                                            {{ $content->template }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($content->display_method)
                                                            {{ $content->display_method }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($content->status == 'published')
                                                            <span class="badge badge-dot bg-success" data-en="Published"
                                                                data-ar="منشور">منشور</span>
                                                        @elseif($content->status == 'draft')
                                                            <span class="badge badge-dot bg-warning" data-en="Draft"
                                                                data-ar="مسودة">مسودة</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $content->created_at->format('Y-m-d') }}</td>
                                                    <td>
                                                        @if ($content->writer)
                                                            {{ $content->writer->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('dashboard.content.show', $content->id) }}"
                                                            class="btn btn-sm btn-primary" data-en="View"
                                                            data-ar="عرض">عرض</a>
                                                        <a href="{{ route('dashboard.content.edit', $content->id) }}"
                                                            class="btn btn-sm btn-warning" data-en="Edit"
                                                            data-ar="تعديل">تعديل</a>
                                                        <form
                                                            action="{{ route('dashboard.content.destroy', $content->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                data-en="Delete" data-ar="حذف"
                                                                onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $contents->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('dashboard.components.footer')
                </div>
            </div>
        </div>
    @endsection
