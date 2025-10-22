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
                            {{-- ===================== Header ===================== --}}
                            <div class="card-title mb-5">
                                <h3 class="title" data-en="Welcome to Dashboard" data-ar="مرحبًا بك في لوحة التحكم">
                                    Welcome to Dashboard
                                </h3>
                            </div>

                            {{-- ===================== 3 Lists ===================== --}}
                            <div class="row g-4 mb-5">
                                {{-- List 1 --}}
                                <div class="col-sm-6 col-md-4">
                                    <div class="card card-bordered h-100">
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                    style="width:40px; height:40px;">
                                                    <em class="icon ni ni-file-text fs-4"></em>
                                                </div>
                                                <h5 class="card-title mb-0" data-en="Content Management"
                                                    data-ar="إدارة المحتوى">Content Management</h5>
                                            </div>
                                            <ul class="list-unstyled flex-grow-1">
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.content.create') }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-plus text-primary me-2"></em>
                                                        <span data-en="Add Content" data-ar="إضافة محتوى">Add Content</span>
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.medias.index') }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-upload-cloud text-success me-2"></em>
                                                        <span data-en="Upload Media" data-ar="رفع وسائط">Upload Media</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('dashboard.breakingnew.create') }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-alert-circle-fill text-danger me-2"></em>
                                                        <span data-en="Add Breaking News" data-ar="إضافة خبر عاجل">Add
                                                            Breaking News</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {{-- List 2 --}}
                                <div class="col-sm-6 col-md-4">
                                    <div class="card card-bordered h-100">
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                    style="width:40px; height:40px;">
                                                    <em class="icon ni ni-list-thumb fs-4"></em>
                                                </div>
                                                <h5 class="card-title mb-0" data-en="Structure" data-ar="البنية">Structure
                                                </h5>
                                            </div>
                                            <ul class="list-unstyled flex-grow-1">
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.categorie.create') }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-list-thumb text-success me-2"></em>
                                                        <span data-en="Add Category" data-ar="إضافة تصنيف">Add
                                                            Category</span>
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.trend.create') }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-trend-up text-warning me-2"></em>
                                                        <span data-en="Add Trend" data-ar="إضافة ترند">Add Trend</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('dashboard.window.create') }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-grid-alt text-info me-2"></em>
                                                        <span data-en="Add Window" data-ar="إضافة نافذة">Add Window</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {{-- List 3 --}}
                                <div class="col-sm-6 col-md-4">
                                    <div class="card card-bordered h-100">
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                    style="width:40px; height:40px;">
                                                    <em class="icon ni ni-user-add fs-4"></em>
                                                </div>
                                                <h5 class="card-title mb-0" data-en="More Actions" data-ar="إجراءات أخرى">
                                                    More Actions</h5>
                                            </div>
                                            <ul class="list-unstyled flex-grow-1">
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.user.create') }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-user text-info me-2"></em>
                                                        <span data-en="Add User" data-ar="إضافة مستخدم">Add User</span>
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <a href="{{ route('dashboard.writer.create') }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-user-add text-primary me-2"></em>
                                                        <span data-en="Add Writer" data-ar="إضافة كاتب">Add Writer</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('dashboard.tag.create') }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark hover-bg-light rounded px-2 py-1 transition">
                                                        <em class="icon ni ni-tag-alt text-danger me-2"></em>
                                                        <span data-en="Add Tag" data-ar="إضافة وسم">Add Tag</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ===================== 4 Stats (block 1) ===================== --}}
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
                                            <p class="text-soft" data-en="Number of Writers" data-ar="عدد الكُتاب">Number
                                                of Writers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ===================== 4 Stats (views) ===================== --}}
                            <div class="row g-4 mb-5">
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-eye fs-2 text-primary mb-2"></em>
                                            <h2 class="mb-0">{{ $viewsLastDay ?? 0 }}</h2>
                                            <p class="text-soft" data-en="Views (Last Day)" data-ar="مشاهدات (آخر يوم)">
                                                Views (Last Day)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-eye fs-2 text-success mb-2"></em>
                                            <h2 class="mb-0">{{ $viewsLast3Days ?? 0 }}</h2>
                                            <p class="text-soft" data-en="Views (Last 3 Days)"
                                                data-ar="مشاهدات (آخر 3 أيام)">Views (Last 3 Days)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-eye fs-2 text-warning mb-2"></em>
                                            <h2 class="mb-0">{{ $viewsLast7Days ?? 0 }}</h2>
                                            <p class="text-soft" data-en="Views (Last 7 Days)"
                                                data-ar="مشاهدات (آخر 7 أيام)">Views (Last 7 Days)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card card-bordered text-center h-100">
                                        <div class="card-inner">
                                            <em class="icon ni ni-eye fs-2 text-info mb-2"></em>
                                            <h2 class="mb-0">{{ $viewsLastMonth ?? 0 }}</h2>
                                            <p class="text-soft" data-en="Views (Last Month)"
                                                data-ar="مشاهدات (آخر شهر)">Views (Last Month)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> {{-- .card-inner --}}
                    </div> {{-- .container --}}
                </div> {{-- .nk-content --}}

                @include('dashboard.components.footer')
            </div> {{-- .nk-wrap --}}
        </div> {{-- .nk-main --}}
    </div> {{-- .nk-app-root --}}
@endsection

@push('scripts')
    <script>
        /** تأكيد الحذف + تعطيل الزر مؤقتاً لتفادي النقر المزدوج **/
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.delete-btn');
            if (!btn) return;
            e.preventDefault();
            const form = btn.closest('form');
            if (!form) return;
            btn.disabled = true;
            if (confirm('هل تريد حذف هذا المحتوى نهائياً؟')) {
                form.submit();
            } else {
                btn.disabled = false;
            }
        }, {
            passive: false
        });
    </script>
@endpush
