@extends('layouts.admin')

@section('title', 'أصوات جزائرية | لوحة التحكم')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content container">
                    <div class="container bg-white">
                        <div class="card-inner">
                            <!-- Header Section -->
                            <div class="card-title mb-5">
                                <h3 class="title" data-en="Welcome to Dashboard" data-ar="مرحبًا بك في لوحة التحكم">
                                    Welcome to Dashboard
                                </h3>

                            </div>

                            <!-- 3 Lists Section - Enhanced UI -->
                            <div class="row g-4 mb-5">
                                <!-- List 1 -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="card  card-bordered h-100">
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px; height:40px;">
                                                    <em class="icon ni ni-file-text fs-4"></em>
                                                </div>
                                                <h5 class="card-title mb-0" data-en="Content Management" data-ar="إدارة المحتوى">Content Management</h5>
                                            </div>
                                            <ul class="list-unstyled flex-grow-1">
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.content.create') }}" class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-plus text-primary me-2"></em>
                                                        <span data-en="Add Content" data-ar="إضافة محتوى">Add Content</span>
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.medias.index') }}" class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-upload-cloud text-success me-2"></em>
                                                        <span data-en="Upload Media" data-ar="رفع وسائط">Upload Media</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('dashboard.breakingnew.create') }}" class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-alert-circle-fill text-danger me-2"></em>
                                                        <span data-en="Add Breaking News" data-ar="إضافة خبر عاجل">Add Breaking News</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- List 2 -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="card  card-bordered h-100">
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px; height:40px;">
                                                    <em class="icon ni ni-list-thumb fs-4"></em>
                                                </div>
                                                <h5 class="card-title mb-0" data-en="Structure" data-ar="البنية">Structure</h5>
                                            </div>
                                            <ul class="list-unstyled flex-grow-1">
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.categorie.create') }}" class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-list-thumb text-success me-2"></em>
                                                        <span data-en="Add Category" data-ar="إضافة تصنيف">Add Category</span>
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.trend.create') }}" class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-trend-up text-warning me-2"></em>
                                                        <span data-en="Add Trend" data-ar="إضافة ترند">Add Trend</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('dashboard.window.create') }}" class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-grid-alt text-info me-2"></em>
                                                        <span data-en="Add Window" data-ar="إضافة نافذة">Add Window</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- List 3 -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="card  card-bordered h-100">
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px; height:40px;">
                                                    <em class="icon ni ni-user-add fs-4"></em>
                                                </div>
                                                <h5 class="card-title mb-0" data-en="More Actions" data-ar="إجراءات أخرى">More Actions</h5>
                                            </div>
                                            <ul class="list-unstyled flex-grow-1">
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.user.create') }}" class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-user text-info me-2"></em>
                                                        <span data-en="Add User" data-ar="إضافة مستخدم">Add User</span>
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.writer.create') }}" class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-user-add text-primary me-2"></em>
                                                        <span data-en="Add Writer" data-ar="إضافة كاتب">Add Writer</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('dashboard.tag.create') }}" class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-tag-alt text-danger me-2"></em>
                                                        <span data-en="Add Tag" data-ar="إضافة وسم">Add Tag</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                            <!-- 4 Stats Cards Section -->
                            <div class="row g-4 mb-5">
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-file-text fs-2 text-primary mb-2"></em>
                                            <h2 class="mb-0">{{ $contentCount }}</h2>
                                            <p class="text-soft" data-en="Total Articles" data-ar="إجمالي المقالات">Total
                                                Articles</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-calendar-check fs-2 text-success mb-2"></em>
                                            <h2 class="mb-0">{{ $publishedTodayCount }}</h2>
                                            <p class="text-soft" data-en="Today’s Published Articles"
                                                data-ar="مقالات اليوم المنشورة">Today’s Published Articles</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-check-circle fs-2 text-warning mb-2"></em>
                                            <h2 class="mb-0">{{ $waitingValidationCount }}</h2>
                                            <p class="text-soft" data-en="Articles Pending Approval"
                                                data-ar="مقالات في انتظار الموافقة">Articles Pending Approval</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-user-add fs-2 text-info mb-2"></em>
                                            <h2 class="mb-0">{{ $writersCount }}</h2>
                                            <p class="text-soft" data-en="Number of Writers" data-ar="عدد الكُتاب">Number of
                                                Writers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 mb-5">
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-eye fs-2 text-primary mb-2"></em>
                                            <h2 class="mb-0">{{ $viewsLastDay ?? 0 }}</h2>
                                            <p class="text-soft" data-en="Views (Last Day)" data-ar="مشاهدات (آخر يوم)">Views (Last Day)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-eye fs-2 text-success mb-2"></em>
                                            <h2 class="mb-0">{{ $viewsLast3Days ?? 0 }}</h2>
                                            <p class="text-soft" data-en="Views (Last 3 Days)" data-ar="مشاهدات (آخر 3 أيام)">Views (Last 3 Days)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-eye fs-2 text-warning mb-2"></em>
                                            <h2 class="mb-0">{{ $viewsLast7Days ?? 0 }}</h2>
                                            <p class="text-soft" data-en="Views (Last 7 Days)" data-ar="مشاهدات (آخر 7 أيام)">Views (Last 7 Days)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-eye fs-2 text-info mb-2"></em>
                                            <h2 class="mb-0">{{ $viewsLastMonth ?? 0 }}</h2>
                                            <p class="text-soft" data-en="Views (Last Month)" data-ar="مشاهدات (آخر شهر)">Views (Last Month)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Last 10 Contents Table -->
                            <!-- Table Header with Title & Button -->
                            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                <h5 class="mb-0" data-en="Last 10 Contents" data-ar="آخر المحتوى">آخر 10 المحتوى
                                </h5>
                                <a href="{{ route('dashboard.contents.index') }}" class="btn btn-sm btn-outline-primary"
                                    data-en="View All Content" data-ar="عرض كل المحتوى">
                                    عرض كل المحتوى
                                </a>
                            </div>

                            @if ($lastTenContents->isEmpty())
                                <div class="alert alert-info text-center my-4" role="alert">
                                    <div class="mb-2">
                                        <em class="icon ni ni-info fs-2 mb-2"></em>
                                    </div>
                                    <h5 class="mb-2" data-en="No content found" data-ar="لا يوجد محتوى">لا يوجد محتوى
                                    </h5>
                                    <p class="mb-0" data-en="Start by adding new content to see it here."
                                        data-ar="ابدأ بإضافة محتوى جديد ليظهر هنا.">
                                        ابدأ بإضافة محتوى جديد ليظهر هنا.
                                    </p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-orders">
                                        <thead class="tb-odr-head sticky-top" style="z-index: 10;">
                                            <tr>
                                                <th style="font-weight: bold;" data-en="Id" data-ar="المعرف">المعرف
                                                </th>
                                                <th style="font-weight: bold;" data-en="Title" data-ar="العنوان">العنوان
                                                </th>
                                                <th style="font-weight: bold;" data-en="User" data-ar="المستخدم">المستخدم
                                                </th>
                                                <th style="font-weight: bold;" data-en="Section" data-ar="القسم">القسم
                                                </th>
                                                <th style="font-weight: bold;" data-en="Display Method"
                                                    data-ar="قالب العرض">قالب العرض</th>
                                                <th style="font-weight: bold;" data-en="Template" data-ar="القالب">القالب
                                                </th>
                                                <th style="font-weight: bold;" data-en="Status" data-ar="الحالة">الحالة
                                                </th>
                                                <th style="font-weight: bold;" data-en="Date" data-ar="التاريخ">التاريخ
                                                </th>
                                                <th style="font-weight: bold;" data-en="Author" data-ar="الكاتب">الكاتب
                                                </th>
                                                <th style="font-weight: bold;" data-en="Actions" data-ar="إجراءات">
                                                    إجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lastTenContents as $content)
                                                <tr>
                                                    <td>{{ $content->id }}</td>
                                                    <td>{{ $content->mobile_title }}</td>
                                                    <td>{{ $content->user->name ?? '-' }}</td>
                                                    <td>{{ $content->section->name ?? '-' }}</td>
                                                    <td>{{ $content->display_method ?? '-' }}</td>
                                                    <td>{{ $content->template ?? '-' }}</td>
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
                                                            <button class="btn btn-sm btn-danger delete-btn"
                                                                data-en="Delete" data-ar="حذف">حذف</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>

        @include('dashboard.components.footer')
    </div>
    </div>
    </div>
@endsection
