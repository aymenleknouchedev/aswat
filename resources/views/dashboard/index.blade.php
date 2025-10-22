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

                            {{-- ===================== Last 10 Contents (styled like index table) ===================== --}}
                            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                <h5 class="mb-0" data-en="Last 10 Contents" data-ar="آخر المحتوى">آخر 10 المحتوى</h5>
                                <a href="{{ route('dashboard.contents.index') }}" class="btn btn-sm btn-outline-primary"
                                    data-en="View All Content" data-ar="عرض كل المحتوى">عرض كل المحتوى</a>
                            </div>

                            @php
                                $templateLabels = [
                                    'normal_image' => 'صورة',
                                    'video' => 'فيديو',
                                    'podcast' => 'بودكاست',
                                    'album' => 'ألبوم',
                                    'without_photo' => 'بدون صورة',
                                ];
                                $displayMethodLabels = [
                                    'simple' => 'عادي',
                                    'file' => 'ملف',
                                    'list' => 'قائمة',
                                ];
                            @endphp

                            @if ($lastTenContents->isEmpty())
                                <div class="text-center py-5">
                                    <div class="fs-2 mb-2 text-muted"><em class="icon ni ni-file"></em></div>
                                    <h6 class="fw-bold mb-1">لا يوجد محتوى</h6>
                                    <p class="text-muted mb-3">ابدأ بإضافة محتوى جديد ليظهر هنا.</p>
                                    <a href="{{ route('dashboard.content.create') }}"
                                        class="btn btn-outline-primary btn-sm">
                                        <em class="icon ni ni-plus"></em> إضافة أول محتوى
                                    </a>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table align-middle table-hover text-center">
                                        <thead class="bg-light text-dark">
                                            <tr>
                                                <th>#</th>
                                                <th></th> {{-- العنوان + تفاصيل --}}
                                                <th>القسم</th>
                                                <th>الحالة</th>
                                                <th>التاريخ</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lastTenContents as $content)
                                                <tr>
                                                    {{-- رقم --}}
                                                    <td class="fw-bold">#{{ $content->id }}</td>

                                                    {{-- عنوان + محرر/كاتب + شارات --}}
                                                    <td class="text-start">
                                                        <div class="fw-bold mb-1">
                                                            @php
                                                                // بدّل هذا إلى المسار العام إن كان لديك (slug)
                                                                $publicUrl = null;
                                                                try {
                                                                    $publicUrl = route(
                                                                        'dashboard.content.show',
                                                                        $content->id,
                                                                    );
                                                                } catch (\Throwable $e) {
                                                                    $publicUrl = null;
                                                                }
                                                            @endphp
                                                            @if ($publicUrl)
                                                                <a href="{{ $publicUrl }}" target="_blank"
                                                                    class="text-dark text-decoration-none">
                                                                    {{ Str::limit($content->mobile_title, 60) }}
                                                                </a>
                                                            @else
                                                                {{ Str::limit($content->mobile_title, 60) }}
                                                            @endif
                                                        </div>

                                                        <div class="small text-muted">
                                                            <span>المحرر:
                                                                {{ optional($content->user)->name ?? '-' }}</span>
                                                            @if (optional($content->writer)->name)
                                                                | <span>الكاتب:
                                                                    {{ optional($content->writer)->name }}</span>
                                                            @endif
                                                        </div>

                                                        <div class="small mt-1">
                                                            @php
                                                                $templateKey = $content->template ?? '';
                                                                $templateLbl =
                                                                    $templateLabels[$templateKey] ?? $templateKey;
                                                                $displayKey = $content->display_method ?? '';
                                                                $displayLbl =
                                                                    $displayMethodLabels[$displayKey] ?? $displayKey;
                                                            @endphp
                                                            <span
                                                                class="badge bg-light text-dark border">{{ $templateLbl ?: '—' }}</span>
                                                            @if ($content->is_latest)
                                                                <span class="badge bg-secondary text-white mx-1">آخــر
                                                                    الأخبار</span>
                                                            @endif
                                                            <span class="badge bg-light text-dark border">قالب
                                                                {{ $displayLbl ?: '—' }}</span>
                                                        </div>
                                                    </td>

                                                    {{-- القسم / التصنيف --}}
                                                    <td>
                                                        <span
                                                            class="fw-medium">{{ optional($content->section)->name ?? '-' }}</span>
                                                        @if ($content->category)
                                                            <div class="small text-muted">
                                                                {{ optional($content->category)->name ?? '' }}</div>
                                                        @endif
                                                    </td>

                                                    {{-- الحالة بنقطة ملوّنة --}}
                                                    <td>
                                                        @switch($content->status)
                                                            @case('published')
                                                                <span class="d-inline-flex align-items-center gap-2">
                                                                    <span class="d-inline-block rounded-circle"
                                                                        style="width:10px;height:10px;background:#198754;"></span>
                                                                    <span class="fw-medium">منشور</span>
                                                                </span>
                                                            @break

                                                            @case('draft')
                                                                <span class="d-inline-flex align-items-center gap-2">
                                                                    <span class="d-inline-block rounded-circle"
                                                                        style="width:10px;height:10px;background:#ffc107;"></span>
                                                                    <span class="fw-medium">مسودة</span>
                                                                </span>
                                                            @break

                                                            @case('scheduled')
                                                                <span class="d-inline-flex align-items-center gap-2">
                                                                    <span class="d-inline-block rounded-circle"
                                                                        style="width:10px;height:10px;background:#0dcaf0;"></span>
                                                                    <span class="fw-medium">مجدول</span>
                                                                </span>
                                                            @break

                                                            @default
                                                                <span class="d-inline-flex align-items-center gap-2">
                                                                    <span class="d-inline-block rounded-circle"
                                                                        style="width:10px;height:10px;background:#6c757d;"></span>
                                                                    <span class="fw-medium">غير معروف</span>
                                                                </span>
                                                        @endswitch
                                                    </td>

                                                    {{-- التاريخ + الوقت --}}
                                                    <td>
                                                        @php
                                                            $raw = $content->created_at ?? null;
                                                            $dt = null;
                                                            if ($raw instanceof \Carbon\Carbon) {
                                                                $dt = $raw;
                                                            } elseif (is_string($raw) && !empty($raw)) {
                                                                try {
                                                                    $dt = \Carbon\Carbon::parse($raw);
                                                                } catch (\Exception $e) {
                                                                    $dt = null;
                                                                }
                                                            }
                                                        @endphp
                                                        <div>{{ $dt ? $dt->format('Y-m-d') : '' }}</div>
                                                        <small
                                                            class="text-muted">{{ $dt ? $dt->format('H:i') : '' }}</small>
                                                    </td>

                                                    {{-- الإجراءات مع قائمة منسدلة ومؤشّر مراجعات --}}
                                                    <td>
                                                        <div
                                                            class="d-flex justify-content-center flex-wrap gap-1 align-items-center">
                                                            <a href="{{ route('dashboard.content.edit', $content->id) }}"
                                                                class="btn btn-sm btn-primary">تعديل</a>

                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-sm btn-outline-secondary dropdown-toggle d-inline-flex align-items-center"
                                                                    type="button" id="dropdownMenu{{ $content->id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    المزيد
                                                                    @if ($content->reviews && $content->reviews->count() > 0)
                                                                        <span class="wave-badge ms-2" aria-hidden="true">
                                                                            <span class="dot"></span>
                                                                            <span class="ripple"></span>
                                                                        </span>
                                                                    @endif
                                                                </button>

                                                                {{-- مؤشّر المراجعات (تموّج برتقالي) --}}
                                                                <style>
                                                                    .wave-badge {
                                                                        position: relative;
                                                                        display: inline-block;
                                                                        width: 18px;
                                                                        height: 18px;
                                                                        line-height: 0
                                                                    }

                                                                    .wave-badge .dot {
                                                                        width: 8px;
                                                                        height: 8px;
                                                                        background: #ffffff00;
                                                                        border-radius: 50%;
                                                                        display: block;
                                                                        position: relative;
                                                                        z-index: 2
                                                                    }

                                                                    .wave-badge .ripple {
                                                                        position: absolute;
                                                                        top: 50%;
                                                                        left: 50%;
                                                                        transform: translate(-50%, -50%);
                                                                        width: 8px;
                                                                        height: 8px;
                                                                        border-radius: 50%;
                                                                        background: #ff7a00;
                                                                        opacity: .8;
                                                                        z-index: 1;
                                                                        animation: wavePulse 1.4s infinite ease-out
                                                                    }

                                                                    @keyframes wavePulse {
                                                                        0% {
                                                                            transform: translate(-50%, -50%) scale(1);
                                                                            opacity: .9
                                                                        }

                                                                        70% {
                                                                            transform: translate(-50%, -50%) scale(2.4);
                                                                            opacity: .25
                                                                        }

                                                                        100% {
                                                                            transform: translate(-50%, -50%) scale(3);
                                                                            opacity: 0
                                                                        }
                                                                    }
                                                                </style>

                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenu{{ $content->id }}">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('dashboard.content.show', $content->id) }}"
                                                                            target="_blank">عرض</a>
                                                                    </li>

                                                                    @if ($content->contentActions && $content->contentActions->count() > 0)
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('dashboard.content.actions', $content->id) }}">سجل
                                                                                الإجراءات</a>
                                                                        </li>
                                                                    @endif

                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('content.reviews.index', $content->id) }}">
                                                                            المراجعات
                                                                            @if ($content->reviews && $content->reviews->count() > 0)
                                                                                ({{ $content->reviews->count() }})
                                                                            @endif
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <form
                                                                            action="{{ route('dashboard.content.destroy', $content->id) }}"
                                                                            method="POST" class="m-0">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button"
                                                                                class="dropdown-item text-danger delete-btn">حذف</button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
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
