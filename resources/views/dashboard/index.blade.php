<?php
$fakeContents = [
    [
        'title' => 'تأثير الذكاء الاصطناعي على سوق العمل في 2025',
        'date' => '2025-08-01',
        'author' => 'أحمد العلي',
        'status' => 'Published',
    ],
    [
        'title' => 'أفضل 10 استراتيجيات لتسويق المنتجات عبر الإنترنت',
        'date' => '2025-07-28',
        'author' => 'سارة منصور',
        'status' => 'Draft',
    ],
    [
        'title' => 'دليل شامل لتصميم واجهات المستخدم UI/UX',
        'date' => '2025-07-15',
        'author' => 'ليلى خالد',
        'status' => 'Published',
    ],
    [
        'title' => 'أحدث تقنيات الطاقة المتجددة في الشرق الأوسط',
        'date' => '2025-07-10',
        'author' => 'محمد ناصر',
        'status' => 'Cancelled',
    ],
    [
        'title' => 'كيف تبدأ مشروعك الناشئ برأس مال صغير',
        'date' => '2025-06-30',
        'author' => 'ريم أحمد',
        'status' => 'Published',
    ],
    [
        'title' => 'مستقبل العملات الرقمية بعد تنظيم الأسواق',
        'date' => '2025-06-20',
        'author' => 'عمر ياسين',
        'status' => 'Draft',
    ],
    [
        'title' => 'أسرار كتابة محتوى يجذب العملاء',
        'date' => '2025-06-15',
        'author' => 'نور الهدى',
        'status' => 'Published',
    ],
    [
        'title' => 'تأثير التغير المناخي على الزراعة العربية',
        'date' => '2025-06-05',
        'author' => 'خالد فؤاد',
        'status' => 'Cancelled',
    ],
    [
        'title' => 'أفضل الأدوات لإدارة فريق العمل عن بعد',
        'date' => '2025-05-28',
        'author' => 'هبة حسين',
        'status' => 'Published',
    ],
    [
        'title' => 'كيف تحافظ على أمان بياناتك الشخصية على الإنترنت',
        'date' => '2025-05-15',
        'author' => 'زياد محمود',
        'status' => 'Draft',
    ],
];

?>



@extends('layouts.admin')

@section('title', 'أصوات جزائرية | لوحة التحكم')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid bg-white">
                        <div class="card-inner">
                            <!-- Header Section -->
                            <div class="card-title mb-5">
                                <h3 class="title" data-en="Welcome to Dashboard" data-ar="مرحبًا بك في لوحة التحكم">
                                    Welcome to Dashboard
                                </h3>
                                <p data-en="Access to some features easily using the tools below."
                                    data-ar="أضف محتوى جديد بسهولة باستخدام الأدوات أدناه.">
                                    Access to some features easily using the tools below.
                                </p>
                            </div>

                            <!-- 3 Lists Section -->
                            <div class="row g-gs mb-5">
                                <!-- List 1 -->
                                <div class="col-sm-6 col-md-4 col-xxl-3">
                                    <div class="fake-class">
                                        <h5 class="title" data-en="Content Management" data-ar="إدارة المحتوى">Content
                                            Management</h5>
                                        <ul class="link-list is-compact pb-0">
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-plus"></em>
                                                    <span data-en="Add Content" data-ar="إضافة محتوى">Add Content</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-upload-cloud"></em>
                                                    <span data-en="Upload Media" data-ar="رفع وسائط">Upload Media</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-alert-circle-fill"></em>
                                                    <span data-en="Add Breaking News" data-ar="إضافة خبر عاجل">Add Breaking
                                                        News</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                                <!-- List 2 -->
                                <div class="col-sm-6 col-md-4 col-xxl-3">
                                    <div class="fake-class">
                                        <h5 class="title" data-en="Structure" data-ar="البنية">Structure</h5>
                                        <ul class="link-list is-compact pb-0">
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-list-thumb"></em>
                                                    <span data-en="Add Category" data-ar="إضافة تصنيف">Add Category</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-trend-up"></em>
                                                    <span data-en="Add Trend" data-ar="إضافة ترند">Add Trend</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-grid-alt"></em>
                                                    <span data-en="Add Window" data-ar="إضافة نافذة">Add Window</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                                <!-- List 3 -->
                                <div class="col-sm-6 col-md-4 col-xxl-3">
                                    <div class="fake-class">
                                        <h5 class="title" data-en="More Actions" data-ar="إجراءات أخرى">More Actions</h5>
                                        <ul class="link-list is-compact pb-0">
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-user"></em>
                                                    <span data-en="Add User" data-ar="إضافة مستخدم">Add User</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-user-add"></em>
                                                    <span data-en="Add Writer" data-ar="إضافة كاتب">Add Writer</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-tag-alt"></em>
                                                    <span data-en="Add Tag" data-ar="إضافة وسم">Add Tag</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <!-- 4 Stats Cards Section -->
                            <div class="row g-4 mb-5">
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-file-text fs-2 text-primary mb-2"></em>
                                            <h4 class="mb-0">128</h4>
                                            <p class="text-soft" data-en="Total Articles" data-ar="إجمالي المقالات">Total
                                                Articles</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-calendar-check fs-2 text-success mb-2"></em>
                                            <h4 class="mb-0">24</h4>
                                            <p class="text-soft" data-en="Today’s Published Articles"
                                                data-ar="مقالات اليوم المنشورة">Today’s Published Articles</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-check-circle fs-2 text-warning mb-2"></em>
                                            <h4 class="mb-0">10</h4>
                                            <p class="text-soft" data-en="Articles Pending Approval"
                                                data-ar="مقالات في انتظار الموافقة">Articles Pending Approval</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-upload-cloud fs-2 text-info mb-2"></em>
                                            <h4 class="mb-0">58</h4>
                                            <p class="text-soft" data-en="Total Media Uploads"
                                                data-ar="إجمالي الوسائط المرفوعة">Total Media Uploads</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Last 10 Contents Table -->
                            <!-- Table Header with Title & Button -->
                            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                <h5 class="mb-0" data-en="Last 10 Contents" data-ar="آخر المحتوى">آخر 10 المحتوى
                                </h5>
                                <a href="" class="btn btn-sm btn-outline-primary" data-en="View All Content"
                                    data-ar="عرض كل المحتوى">
                                    عرض كل المحتوى
                                </a>
                            </div>

                            <!-- Scrollable Table -->
                            <div style="">
                                <table class="table table-orders">
                                    <thead class="tb-odr-head sticky-top" style="z-index: 10;">
                                        <tr>
                                            <th style="font-weight: bold;" data-en="Title"
                                                data-ar="العنوان">العنوان</th>
                                            <th style="font-weight: bold;" data-en="Date" data-ar="التاريخ">
                                                التاريخ</th>
                                            <th style="font-weight: bold;" data-en="Author"
                                                data-ar="الكاتب">الكاتب</th>
                                            <th style="font-weight: bold;" data-en="Status"
                                                data-ar="الحالة">الحالة</th>
                                            <th style="font-weight: bold;" data-en="Actions"
                                                data-ar="إجراءات">إجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fakeContents as $content)
                                            <tr>
                                                <td>{{ $content['title'] }}</td>
                                                <td>{{ $content['date'] }}</td>
                                                <td>{{ $content['author'] }}</td>
                                                <td>
                                                    @if ($content['status'] == 'Published')
                                                        <span class="badge badge-dot bg-success" data-en="Published"
                                                            data-ar="منشور">منشور</span>
                                                    @elseif($content['status'] == 'Draft')
                                                        <span class="badge badge-dot bg-warning" data-en="Draft"
                                                            data-ar="مسودة">مسودة</span>
                                                    @elseif($content['status'] == 'Cancelled')
                                                        <span class="badge badge-dot bg-danger" data-en="Cancelled"
                                                            data-ar="ملغي">ملغي</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="tb-odr-btns d-none d-md-inline">
                                                        <a href="#" class="btn btn-sm btn-primary" data-en="View"
                                                            data-ar="عرض">عرض</a>
                                                    </div>
                                                    <div class="dropdown">
                                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown" data-offset="-8,0">
                                                            <em class="icon ni ni-more-h"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                            <ul class="link-list-plain">
                                                                <li><a href="#" class="text-primary" data-en="Edit"
                                                                        data-ar="تعديل">تعديل</a></li>
                                                                <li><a href="#" class="text-primary" data-en="View"
                                                                        data-ar="عرض">عرض</a></li>
                                                                <li><a href="#" class="text-danger"
                                                                        data-en="Delete" data-ar="حذف">حذف</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
