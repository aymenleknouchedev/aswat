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
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0" data-en="All Contents" data-ar="جميع المحتوى">جميع المحتوى</h5>
                                    <a href="{{ route('dashboard.content.create') }}" class="btn btn-sm btn-outline-primary"
                                        data-en="Add New Content" data-ar="إضافة محتوى جديد">إضافة محتوى جديد</a>
                                </div>

                                <form action="{{ route('dashboard.contents.index') }}" method="GET" class="my-3">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" value="{{ request('search') }}">
                                        <select name="section" id="sectionFilter" class="form-select">
                                            <option value="" data-en="All Sections" data-ar="جميع الأقسام">جميع الأقسام</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}" {{ request('section') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" id="date_range" name="date_range" value="{{ request('date_range') }}"
                                            class="form-control rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                                        <button class="btn btn-outline-secondary" type="submit" data-en="Filter" data-ar="تصفية">تصفية</button>
                                        <a href="{{ route('dashboard.contents.index') }}" class="btn " data-en="X" data-ar="X">ْX</a>
                                    </div>
                                </form>

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
                                                    <th style="font-weight: bold;" data-en="Reviews" data-ar="المراجعات">المراجعات</th>
                                                    <th style="font-weight: bold;" data-en="Actions" data-ar="الإجراءات">-</th> 
                                                    <th style="font-weight: bold; text-align: right;" data-en="Actions" data-ar="الإجراءات">الإجراءات
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                var lang = localStorage.getItem('siteLang');
                                                                var th = document.querySelector('th[data-en="Actions"]');
                                                                if (th && lang) {
                                                                    th.style.textAlign = (lang === 'ar') ? 'left' : 'right';
                                                                }
                                                            });
                                                        </script>
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
                                                            @elseif($content->status == 'scheduled')
                                                                <span class="badge badge-dot bg-info" data-en="Scheduled"
                                                                    data-ar="مجدول">مجدول</span>
                                                            @else
                                                                <span class="badge badge-dot bg-secondary"
                                                                    data-en="Unknown" data-ar="غير معروف">غير معروف</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $content->created_at->format('Y-m-d') }}</td>
                                                        <td>{{ $content->writer->name ?? '-' }}</td>
                                                        <td>
                                                            <a href="{{ route('content.reviews.index', $content->id) }}" class="badge rounded-pill bg-danger px-3 py-1" style="font-size: 1rem;" title="المراجعات">
                                                                <em class="icon ni ni-chat-fill me-1"></em>
                                                                {{ $content->reviews ? $content->reviews->count() : 0 }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if ($content->contentActions && $content->contentActions->count() > 0)
                                                                <a href="{{ route('dashboard.content.actions', $content->id) }}" title="View Actions" target="_blank">
                                                                    <em class="icon ni ni-eye"></em>
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td style="text-align: right;" id="actionsCell{{ $content->id }}">
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded', function() {
                                                                    var lang = localStorage.getItem('siteLang');
                                                                    var cell = document.getElementById('actionsCell{{ $content->id }}');
                                                                    if (cell && lang) {
                                                                        cell.style.textAlign = (lang === 'ar') ? 'left' : 'right';
                                                                    }
                                                                });
                                                            </script>
                                                            <a href="{{ route('dashboard.content.edit', $content->id) }}" class="btn btn-sm btn-warning" data-en="Edit" data-ar="تعديل">تعديل</a>
                                                            <div class="dropdown d-inline">
                                                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionsDropdown{{ $content->id }}" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="actionsDropdown{{ $content->id }}">
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('dashboard.content.show', $content->id) }}" data-en="View" data-ar="عرض">عرض</a>
                                                                    </li>
                                                                    <li>
                                                                        <form action="{{ route('dashboard.content.destroy', $content->id) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button" class="dropdown-item delete-btn" data-en="Delete" data-ar="حذف">حذف</button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
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

    <!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#date_range", {
            mode: "range",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y", // prettier display
            allowInput: true,
            defaultDate: "{{ request('date_range') }}"
                ? "{{ str_replace(' - ', ' to ', request('date_range')) }}"
                : null,
        });
    });
</script>

