@extends('layouts.admin')

@section('title', 'أصوات جزائرية | المحتوى')

@section('content')
    <div class="nk-content-body">

        <div class="nk-app-root">
            <div class="nk-main">
                @include('dashboard.components.sidebar')
                <div class="nk-wrap">
                    @include('dashboard.components.header')
                    <div class="nk-content container">
                        <div class="container-fluid bg-white">
                            <div class="card-inner">

                                <!-- Table Header with Title & Button -->
                                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                    <h5 class="mb-0" data-en="All Contents" data-ar="جميع المحتوى">جميع المحتوى</h5>
                                    <a href="{{ route('dashboard.content.create') }}" class="btn btn-sm btn-outline-primary"
                                        data-en="Add New Content" data-ar="إضافة محتوى جديد">إضافة محتوى جديد</a>
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

                                @if ($contents->isEmpty())
                                    <div class="alert alert-info text-center my-4" role="alert">
                                        <div class="mb-2">
                                            <em class="icon ni ni-info fs-2 "></em>
                                        </div>
                                        <h5 class="mb-2" data-en="No content found" data-ar="لا يوجد محتوى">لا يوجد محتوى
                                        </h5>
                                        <p class="mb-0" data-en="Start by adding new content to see it here."
                                            data-ar="ابدأ بإضافة محتوى جديد ليظهر هنا.">
                                            ابدأ بإضافة محتوى جديد ليظهر هنا.
                                        </p>
                                    </div>
                                @else
                                    <!-- Scrollable Table -->
                                    <div class="table-responsive">
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
                                                        data-ar="قالب العرض">قالب العرض</th>
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
                                                        <td>{{ $content->user->name ?? '-' }}</td>
                                                        <td>{{ $content->section->name ?? '-' }}</td>
                                                        <td>{{ $content->template ?? '-' }}</td>
                                                        <td>{{ $content->display_method ?? '-' }}</td>
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
                                                        <td>{{ $content->writer->name ?? '-' }}</td>
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
                                                                <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                                    data-en="Delete" data-ar="حذف">حذف</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                @endif

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
