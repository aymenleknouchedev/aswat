@extends('layouts.admin')

@section('title', 'أصوات جزائرية | لوحة التحكم')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <!-- Language Switcher -->
                <div class="language-switcher p-3 text-end">
                    <button id="arabic" class="btn btn-outline-primary btn-sm me-2">عربي</button>
                    <button id="english" class="btn btn-outline-secondary btn-sm">English</button>
                    <span id="language-button-label" class="ms-2">English</span>
                </div>

                <div class="nk-content">
                    <div class="container-fluid bg-white">
                        <div class="card-inner">
                            <!-- Header Section -->
                            <div class="card-title mb-5">
                                <h3 class="title" data-en="Welcome to Dashboard" data-ar="مرحبًا بك في لوحة التحكم">Welcome
                                    to Dashboard</h3>
                                <p data-en="Add new content easily using the tools below."
                                    data-ar="أضف محتوى جديد بسهولة باستخدام الأدوات أدناه.">Add new content easily using the
                                    tools below.</p>
                            </div>

                            <!-- 3 Lists Section -->
                            <div class="row g-gs mb-5">
                                <!-- List 1 -->
                                <div class="col-sm-6 col-md-4 col-xxl-3">
                                    <div class="fake-class">
                                        <h5 class="title" data-en="Add Content" data-ar="إضافة محتوى">Add Content</h5>
                                        <ul class="link-list is-compact pb-0">
                                            <li><a href="#"><em class="icon ni ni-edit-fill"></em><span
                                                        data-en="Add New Content" data-ar="إضافة محتوى جديد">Add New
                                                        Content</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-alert-circle"></em><span
                                                        data-en="Add Breaking News" data-ar="إضافة خبر عاجل">Add Breaking
                                                        News</span></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- List 2 -->
                                <div class="col-sm-6 col-md-4 col-xxl-3">
                                    <div class="fake-class">
                                        <h5 class="title" data-en="Structure" data-ar="البنية">Structure</h5>
                                        <ul class="link-list is-compact pb-0">
                                            <li><a href="#"><em class="icon ni ni-trend-up"></em><span
                                                        data-en="Add Trend" data-ar="إضافة ترند">Add Trend</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-grid-alt"></em><span
                                                        data-en="Add Window" data-ar="إضافة نافذة">Add Window</span></a>
                                            </li>
                                            <li><a href="#"><em class="icon ni ni-list-thumb"></em><span
                                                        data-en="Add Category" data-ar="إضافة تصنيف">Add Category</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- List 3 -->
                                <div class="col-sm-6 col-md-4 col-xxl-3">
                                    <div class="fake-class">
                                        <h5 class="title" data-en="More Actions" data-ar="إجراءات أخرى">More Actions</h5>
                                        <ul class="link-list is-compact pb-0">
                                            <li><a href="#"><em class="icon ni ni-tag-alt"></em><span
                                                        data-en="Add Tag" data-ar="إضافة وسم">Add Tag</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-img"></em><span data-en="Add Media"
                                                        data-ar="إضافة وسائط">Add Media</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-user-add"></em><span
                                                        data-en="Add Writer" data-ar="إضافة كاتب">Add Writer</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 4 Stats Cards Section -->
                            <div class="row g-4 mb-5">
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-edit fs-2 text-primary mb-2"></em>
                                            <h4 class="mb-0">128</h4>
                                            <p class="text-soft" data-en="Total Articles" data-ar="إجمالي المقالات">Total
                                                Articles</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-users fs-2 text-success mb-2"></em>
                                            <h4 class="mb-0">24</h4>
                                            <p class="text-soft" data-en="Writers" data-ar="الكتّاب">Writers</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-comments fs-2 text-info mb-2"></em>
                                            <h4 class="mb-0">314</h4>
                                            <p class="text-soft" data-en="Comments" data-ar="التعليقات">Comments</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-eye fs-2 text-warning mb-2"></em>
                                            <h4 class="mb-0">5.4K</h4>
                                            <p class="text-soft" data-en="Total Views" data-ar="إجمالي المشاهدات">Total
                                                Views</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Last 3 Cards Section -->
                            <div class="row g-gs">
                                <!-- Monthly Goals Tracker -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="card card-bordered h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-3">
                                                <div class="card-title">
                                                    <h6 class="title" data-en="🎯 Monthly Goals"
                                                        data-ar="🎯 إنجازات هذا الشهر">🎯 إنجازات هذا الشهر</h6>
                                                    <p class="text-soft" data-en="Target articles vs published"
                                                        data-ar="عدد المقالات المستهدفة مقابل المنشور">عدد المقالات
                                                        المستهدفة مقابل المنشور</p>
                                                </div>
                                            </div>
                                            <div class="progress progress-md mb-3">
                                                <div class="progress-bar bg-primary" data-progress="60"
                                                    style="width: 60%;"></div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <span class="text-soft" data-en="Target:"
                                                        data-ar="المستهدف:">المستهدف:</span>
                                                    <span class="fw-bold">30 مقال</span>
                                                </div>
                                                <div>
                                                    <span class="text-soft" data-en="Published:"
                                                        data-ar="المنشور:">المنشور:</span>
                                                    <span class="fw-bold">18 مقال</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Team Notes -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="card card-bordered h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-3">
                                                <div class="card-title">
                                                    <h6 class="title" data-en="📝 Team Notes"
                                                        data-ar="📝 ملاحظات الفريق">📝 ملاحظات الفريق</h6>
                                                    <p class="text-soft" data-en="Message visible to all editorial team"
                                                        data-ar="رسالة تظهر لجميع أعضاء فريق التحرير">رسالة تظهر لجميع
                                                        أعضاء فريق التحرير</p>
                                                </div>
                                            </div>
                                            <div class="alert alert-primary alert-icon">
                                                <em class="icon ni ni-info"></em>
                                                <strong data-en="Reminder:" data-ar="تذكير:">تذكير:</strong>
                                                <span
                                                    data-en="Make sure to review articles before publishing at the end of the week."
                                                    data-ar="تأكد من مراجعة المقالات قبل نشرها نهاية الأسبوع.">
                                                    تأكد من مراجعة المقالات قبل نشرها نهاية الأسبوع.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add Note Section -->
                                <div class="col-md-12 col-lg-4">
                                    <div class="card card-bordered h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group mb-3">
                                                <div class="card-title">
                                                    <h6 class="title" data-en="🗒️ Add New Note"
                                                        data-ar="🗒️ إضافة ملاحظة جديدة">🗒️ إضافة ملاحظة جديدة</h6>
                                                    <p class="text-soft" data-en="Write a note visible to team members"
                                                        data-ar="اكتب ملاحظة تظهر لأعضاء الفريق">اكتب ملاحظة تظهر لأعضاء
                                                        الفريق</p>
                                                </div>
                                            </div>

                                            <form method="POST">
                                                @csrf
                                                <div class="row gy-3">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea name="note" class="form-control no-resize" rows="4" placeholder="أدخل الملاحظة هنا..."
                                                                data-en-placeholder="Enter your note here..." data-ar-placeholder="أدخل الملاحظة هنا..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">
                                                            <em class="icon ni ni-save"></em>
                                                            <span data-en="Save" data-ar="حفظ">حفظ</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
