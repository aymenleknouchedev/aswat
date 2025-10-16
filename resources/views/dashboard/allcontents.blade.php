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
                        <div class="container-fluid bg-white p-4 rounded-3 shadow-sm">

                            <!-- Header -->
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-2 mb-sm-0">جميع المحتوى</h5>
                                <a href="{{ route('dashboard.content.create') }}" class="btn btn-primary btn-sm px-3">
                                    <em class="icon ni ni-plus"></em> <span>إضافة محتوى</span>
                                </a>
                            </div>

                            <!-- Filters -->
                            <form action="{{ route('dashboard.contents.index') }}" method="GET" class="mb-4">
                                <div class="row g-2">
                                    <div class="col-md-3 col-sm-6">
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}" placeholder="ابحث عن المحتوى...">
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <select name="section" id="sectionFilter" class="form-select">
                                            <option value="">جميع الأقسام</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}"
                                                    {{ request('section') == $section->id ? 'selected' : '' }}>
                                                    {{ $section->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <input type="text" id="date_range" name="date_range"
                                            value="{{ request('date_range') }}" class="form-control"
                                            placeholder="نطاق التاريخ">
                                    </div>

                                    <div class="col-md-4 col-sm-6 d-flex align-items-center gap-2">
                                        <button class="btn btn-outline-primary flex-fill" type="submit">تصفية</button>
                                        <a href="{{ route('dashboard.contents.index') }}"
                                            class="btn btn-light flex-fill">إعادة ضبط</a>
                                    </div>
                                </div>
                            </form>

                            <!-- Alerts -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                                    <strong>✔ تم بنجاح:</strong> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                                    <strong>⚠ خطأ:</strong> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Content Table -->
                            @if ($contents->isEmpty())
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
                                                <th></th>
                                                <th>القسم</th>
                                                <th>الحالة</th>
                                                <th>التاريخ</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contents as $content)
                                                <tr>
                                                    <td class="fw-bold">#{{ $content->id }}</td>

                                                    <td class="text-start">
                                                        <div class="fw-bold mb-1">
                                                            <a href="{{ route('news.show', $content->title) }}"
                                                                class="text-dark text-decoration-none">
                                                                {{ Str::limit($content->mobile_title, 60) }}
                                                            </a>
                                                        </div>
                                                        <div class="small text-muted">
                                                            <span>المحرر: {{ $content->user->name ?? 'غير معروف' }}</span>
                                                            |
                                                            <span>الكاتب: {{ $content->writer->name ?? '-' }}</span>
                                                        </div>
                                                        <div class="small mt-1">
                                                            <span
                                                                class="badge bg-light text-dark border">{{ $content->template }}</span>
                                                            <span
                                                                class="badge bg-light text-dark border">{{ $content->display_method }}</span>
                                                            @if ($content->is_latest)
                                                                <span class="badge bg-warning text-dark">الأحدث</span>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span class="fw-medium">{{ $content->section->name ?? '-' }}</span>
                                                        @if ($content->category)
                                                            <div class="small text-muted">
                                                                {{ $content->category->name ?? '' }}</div>
                                                        @endif
                                                    </td>

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

                                                    <td>
                                                        <div>{{ $content->created_at->format('Y-m-d') }}</div>
                                                        <small
                                                            class="text-muted">{{ $content->created_at->format('H:i') }}</small>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex justify-content-center flex-wrap gap-1 align-items-center">
                                                            <a href="{{ route('dashboard.content.edit', $content->id) }}" class="btn btn-sm btn-primary">تعديل</a>

                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-inline-flex align-items-center" type="button"
                                                                    id="dropdownMenu{{ $content->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    المزيد
                                                                    @if ($content->reviews && $content->reviews->count() > 0)
                                                                        <span class="wave-badge ms-2" aria-hidden="true">
                                                                            <span class="dot"></span>
                                                                            <span class="ripple"></span>
                                                                        </span>
                                                                    @endif
                                                                </button>

                                                                <style>
                                                                /* small inline styles for the orange wave animation (kept local to this component) */
                                                                .wave-badge{position:relative;display:inline-block;width:18px;height:18px;line-height:0}
                                                                .wave-badge .dot{width:8px;height:8px;background:#ffffff00;border-radius:50%;display:block;position:relative;z-index:2;box-shadow:0 0 0 1px rgba(255,122,0,0.15) inset}
                                                                .wave-badge .ripple{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:8px;height:8px;border-radius:50%;background:#ff7a00;opacity:0.8;z-index:1;animation:wavePulse 1.4s infinite ease-out}
                                                                @keyframes wavePulse{
                                                                  0%{transform:translate(-50%,-50%) scale(1);opacity:0.9}
                                                                  70%{transform:translate(-50%,-50%) scale(2.4);opacity:0.25}
                                                                  100%{transform:translate(-50%,-50%) scale(3);opacity:0}
                                                                }
                                                                </style>
                                                                
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $content->id }}">
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('news.show', $content->title) }}">عرض</a>
                                                                    </li>

                                                                    @if ($content->contentActions && $content->contentActions->count() > 0)
                                                                        <li>
                                                                            <a class="dropdown-item" href="{{ route('dashboard.content.actions', $content->id) }}"
                                                                                target="_blank">سجل الإجراءات</a>
                                                                        </li>
                                                                    @endif

                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('content.reviews.index', $content->id) }}">
                                                                            المراجعات
                                                                            @if ($content->reviews && $content->reviews->count() > 0)
                                                                                ({{ $content->reviews->count() }})
                                                                            @endif
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <form action="{{ route('dashboard.content.destroy', $content->id) }}" method="POST" class="m-0">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="dropdown-item text-danger"
                                                                                onclick="return confirm('هل أنت متأكد من حذف هذا المحتوى؟')">حذف</button>
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

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $contents->links() }}
                                </div>
                            @endif
                        </div>
                    </div>

                    @include('dashboard.components.footer')
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Scripts -->
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            flatpickr("#date_range", {
                mode: "range",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "F j, Y",
                allowInput: true,
                defaultDate: "{{ request('date_range') ? str_replace(' - ', ' to ', request('date_range')) : '' }}"
            });
        });
    </script>
@endpush
