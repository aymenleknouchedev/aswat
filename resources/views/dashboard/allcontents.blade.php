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
                            <!-- ================== BULK DELETE SECTION ================== -->
                            <div id="bulkDeleteSection"
                                class="alert alert-warning d-none mb-4 d-flex justify-content-between align-items-center"
                                role="alert">
                                <div class="d-flex align-items-center">
                                    <strong>تم تحديد </strong>
                                    <span id="selectedCount" class="badge bg-primary ms-2">0</span>
                                    <strong class="ms-2"> عنصر</strong>
                                </div>
                                <div class="d-flex gap-2 align-items-center">
                                    <button type="button" class="btn btn-sm btn-danger" id="bulkDeleteBtn"
                                        onclick="confirmBulkDelete()">
                                        <em class="icon ni ni-trash me-1"></em> حذف المحددة
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary" onclick="clearAllSelections()">
                                        <em class="icon ni ni-undo me-1"></em> إلغاء التحديد
                                    </button>
                                </div>
                            </div>
                            <!-- ================== FILTERS ================== -->
                            <form action="{{ route('dashboard.contents.index') }}" method="GET" class="mb-3">
                                <div class="row g-2 align-items-center justify-content-center">
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-muted">
                                                <em class="icon ni ni-search"></em>
                                            </span>
                                            <input type="text" name="search" class="form-control form-control-sm"
                                                value="{{ request('search') }}" placeholder="بحث...">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2">
                                        <select name="section" id="sectionFilter" class="form-select form-select-sm">
                                            <option value="">الأقسام</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}"
                                                    {{ request('section') == $section->id ? 'selected' : '' }}>
                                                    {{ $section->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2">
                                        <select name="status" id="statusFilter" class="form-select form-select-sm">
                                            <option value="">الحالات</option>
                                            <option value="published"
                                                {{ request('status') == 'published' ? 'selected' : '' }}>
                                                منشور
                                            </option>
                                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>
                                                مسودة
                                            </option>
                                            <option value="scheduled"
                                                {{ request('status') == 'scheduled' ? 'selected' : '' }}>
                                                مجدول
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-muted">
                                                <em class="icon ni ni-calendar"></em>
                                            </span>
                                            <input type="text" id="date_range" name="date_range"
                                                value="{{ request('date_range') }}" class="form-control form-control-sm"
                                                placeholder="التاريخ">
                                        </div>
                                    </div>
                                    <!-- Buttons -->
                                    <div
                                        class="col-12 col-md-6 col-lg-3 d-flex gap-2 align-items-center justify-content-center">
                                        <button class="btn btn-sm btn-primary flex-grow-1" type="submit">
                                            <em class="icon ni ni-filter me-1"></em> تصفية
                                        </button>
                                        <a href="{{ route('dashboard.contents.index') }}"
                                            class="btn btn-sm btn-outline-secondary">
                                            <em class="icon ni ni-undo"></em>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <!-- ================== ALERTS ================== -->
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

                            @if (session('success'))
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // المفاتيح الخاصة بالعناصر فقط
                                        const itemKeys = [
                                            'az_items_list_v1',
                                            'az_items_file_v1',
                                            'az_display_method_v6',
                                            'mediaManagerState',
                                        ];

                                        itemKeys.forEach(k => localStorage.removeItem(k));
                                    });
                                </script>
                            @endif

                            <!-- ================== CONTENT TABLE ================== -->
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
                                                <th style="width: 40px;">
                                                    <input type="checkbox" id="selectAllCheckbox" class="form-check-input"
                                                        onchange="toggleSelectAll(this)">
                                                </th>
                                                <th>#</th>
                                                <th>العنوان</th>
                                                <th>القسم</th>
                                                <th>الحالة</th>
                                                <th>تاريخ الإنشاء</th>
                                                <th>تاريخ النشر</th>
                                                <th>آخر تحديث</th>
                                                <th>حُدّث بواسطة</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contents as $content)
                                                <tr class="content-row" data-content-id="{{ $content->id }}">
                                                    <td>
                                                        <input type="checkbox" class="form-check-input content-checkbox"
                                                            data-content-id="{{ $content->id }}"
                                                            onchange="updateBulkDeleteUI()">
                                                    </td>
                                                    <td class="fw-bold">#{{ $content->id }}</td>

                                                    <td class="text-start">
                                                        <div class="fw-bold mb-1">
                                                            <a href="{{ route('news.show', $content->shortlink) }} "
                                                                target="_blank" class="text-dark text-decoration-none">
                                                                {{ Str::limit($content->mobile_title, 60) }}
                                                            </a>
                                                        </div>
                                                        <div class="small text-muted">
                                                            <span>المحرر: {{ $content->user->name }}</span>
                                                            @if (optional($content->writer)->name)
                                                                | <span>الكاتب:
                                                                    {{ optional($content->writer)->name }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="small mt-1">
                                                            @php
                                                                $templateLabels = [
                                                                    'normal_image' => 'صورة',
                                                                    'video' => 'فيديو',
                                                                    'podcast' => 'بودكاست',
                                                                    'album' => 'ألبوم',
                                                                    'without_photo' => 'بدون صورة',
                                                                ];
                                                                $templateLabel =
                                                                    $templateLabels[$content->template] ??
                                                                    $content->template;
                                                            @endphp
                                                            <span class="badge bg-light text-dark border">
                                                                {{ $templateLabel }}</span>
                                                            @if ($content->is_latest)
                                                                <span class="badge bg-secondary text-white mx-1">آخــر
                                                                    الأخبار</span>
                                                            @endif

                                                            @php
                                                                $displayMethodLabels = [
                                                                    'simple' => 'عادي',
                                                                    'file' => 'ملف',
                                                                    'list' => 'قائمة',
                                                                ];
                                                                $displayLabel =
                                                                    $displayMethodLabels[$content->display_method] ??
                                                                    $content->display_method;
                                                            @endphp

                                                            <span class="badge bg-light text-dark border">قالب
                                                                {{ $displayLabel }}</span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="fw-bold mb-1 text-center">
                                                            {{ $content->section->name ?? '-' }}
                                                        </div>
                                                        <small class="text-muted d-block text-center">
                                                            {{ $content->category->name ?? '-' }}
                                                        </small>
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
                                                        @php
                                                            // Normalize created_at to Africa/Algiers timezone for display
                                                            $createdRaw = $content->created_at;
                                                            $createdDate = null;
                                                            $displayTz = 'Africa/Algiers';
                                                            if ($createdRaw instanceof \Carbon\Carbon) {
                                                                // clone to avoid mutating original instance
                                                                $createdDate = $createdRaw
                                                                    ->copy()
                                                                    ->setTimezone($displayTz);
                                                            } elseif (is_string($createdRaw) && !empty($createdRaw)) {
                                                                try {
                                                                    // Explicitly parse as app timezone (UTC) then shift
                                                                    $createdDate = \Carbon\Carbon::parse(
                                                                        $createdRaw,
                                                                        config('app.timezone', 'UTC'),
                                                                    )->setTimezone($displayTz);
                                                                } catch (\Exception $e) {
                                                                    $createdDate = null;
                                                                }
                                                            }
                                                        @endphp
                                                        <div>{{ $createdDate ? $createdDate->format('Y-m-d') : '' }}</div>
                                                        <small class="text-muted"
                                                            title="UTC: {{ $content->created_at }} | TZ: {{ $displayTz }}">
                                                            {{ $createdDate ? $createdDate->format('H:i:s') : '' }}
                                                        </small>
                                                    </td>

                                                    <td>
                                                        @if ($content->published_at)
                                                            @php
                                                                // Normalize published_at to Africa/Algiers timezone for display
                                                                $publishedRaw = $content->published_at;
                                                                $publishedDate = null;
                                                                $displayTz = 'Africa/Algiers';
                                                                if ($publishedRaw instanceof \Carbon\Carbon) {
                                                                    $publishedDate = $publishedRaw
                                                                        ->copy()
                                                                        ->setTimezone($displayTz);
                                                                } elseif (
                                                                    is_string($publishedRaw) &&
                                                                    !empty($publishedRaw)
                                                                ) {
                                                                    try {
                                                                        $publishedDate = \Carbon\Carbon::parse(
                                                                            $publishedRaw,
                                                                            config('app.timezone', 'UTC'),
                                                                        )->setTimezone($displayTz);
                                                                    } catch (\Exception $e) {
                                                                        $publishedDate = null;
                                                                    }
                                                                }
                                                            @endphp
                                                            <div>
                                                                {{ $publishedDate ? $publishedDate->format('Y-m-d') : '' }}
                                                            </div>
                                                            <small class="text-muted"
                                                                title="UTC: {{ $content->published_at }} | TZ: {{ $displayTz }}">
                                                                {{ $publishedDate ? $publishedDate->format('H:i:s') : '' }}
                                                            </small>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $updatedRaw = $content->updated_at;
                                                            $updatedDate = null;
                                                            $displayTz = 'Africa/Algiers';
                                                            if ($updatedRaw instanceof \Carbon\Carbon) {
                                                                $updatedDate = $updatedRaw
                                                                    ->copy()
                                                                    ->setTimezone($displayTz);
                                                            } elseif (is_string($updatedRaw) && !empty($updatedRaw)) {
                                                                try {
                                                                    $updatedDate = \Carbon\Carbon::parse(
                                                                        $updatedRaw,
                                                                        config('app.timezone', 'UTC'),
                                                                    )->setTimezone($displayTz);
                                                                } catch (\Exception $e) {
                                                                    $updatedDate = null;
                                                                }
                                                            }
                                                        @endphp
                                                        <div>{{ $updatedDate ? $updatedDate->format('Y-m-d') : '' }}</div>
                                                        <small
                                                            class="text-muted">{{ $updatedDate ? $updatedDate->format('H:i:s') : '' }}</small>
                                                    </td>
                                                    <td>
                                                        @if ($content->updatedByUser)
                                                            <span
                                                                title="{{ $content->updatedByUser->name }}">{{ Str::limit($content->updatedByUser->name, 12) }}</span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div
                                                            class="d-flex justify-content-center gap-2 align-items-center">
                                                            <!-- Edit Button (Always Visible) -->
                                                            <a href="{{ route('dashboard.content.edit', $content->id) }}"
                                                                class="btn btn-sm btn-primary" title="تعديل">
                                                                <em class="icon ni ni-edit"></em>
                                                            </a>

                                                            <!-- More Actions Dropdown -->
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                    type="button"
                                                                    id="moreActionsMenu{{ $content->id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                                    title="المزيد من الإجراءات">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="moreActionsMenu{{ $content->id }}">
                                                                    <li>
                                                                        <a href="{{ route('news.show', $content->shortlink) }}"
                                                                            class="dropdown-item" target="_blank"
                                                                            title="عرض">
                                                                            <em class="icon ni ni-eye me-2"></em> عرض
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('content.reviews.index', $content->id) }}"
                                                                            class="dropdown-item" title="المراجعات">
                                                                            <em class="icon ni ni-comments me-2"></em>
                                                                            المراجعات
                                                                            @if ($content->reviews && $content->reviews->count() > 0)
                                                                                <span
                                                                                    class="badge bg-danger ms-2">{{ $content->reviews->count() }}</span>
                                                                            @endif
                                                                        </a>
                                                                    </li>
                                                                    @canDo('delete')
                                                                     <li>
                                                                        <hr class="dropdown-divider">
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('dashboard.content.destroy', $content->id) }}"
                                                                            method="POST" class="m-0">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button"
                                                                                class="dropdown-item text-danger delete-btn">
                                                                                <em class="icon ni ni-trash me-2"></em> حذف
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                    @endcanDo
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

    <!-- ================== STYLES ================== -->
    <style>
        .form-control-sm,
        .form-select-sm,
        .input-group-sm .input-group-text,
        .btn-sm {
            height: 32px;
            font-size: 0.85rem;
            padding: 0.375rem 0.75rem;
        }

        .form-select-sm,
        .form-control-sm {
            min-height: 32px;
        }

        .input-group-sm .input-group-text {
            padding: 0.375rem 0.75rem;
        }

        [dir="rtl"] .btn .icon,
        .btn .icon {
            line-height: 1;
            vertical-align: -0.125em;
        }

        @media (max-width: 768px) {

            .form-control-sm,
            .form-select-sm {
                font-size: 0.8rem;
            }
        }
    </style>
@endsection

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

        // ========== BULK DELETE FUNCTIONALITY ==========
        function getSelectedIds() {
            const checkboxes = document.querySelectorAll('.content-checkbox:checked');
            return Array.from(checkboxes).map(cb => cb.getAttribute('data-content-id'));
        }

        function updateBulkDeleteUI() {
            const selectedIds = getSelectedIds();
            const bulkSection = document.getElementById('bulkDeleteSection');
            const selectedCount = document.getElementById('selectedCount');

            if (selectedIds.length > 0) {
                bulkSection.classList.remove('d-none');
                selectedCount.textContent = selectedIds.length;
            } else {
                bulkSection.classList.add('d-none');
            }

            // Update select all checkbox state
            const allCheckboxes = document.querySelectorAll('.content-checkbox');
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const allChecked = allCheckboxes.length > 0 && Array.from(allCheckboxes).every(cb => cb.checked);
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = selectedIds.length > 0 && !allChecked;
        }

        function toggleSelectAll(checkbox) {
            const contentCheckboxes = document.querySelectorAll('.content-checkbox');
            contentCheckboxes.forEach(cb => {
                cb.checked = checkbox.checked;
            });
            updateBulkDeleteUI();
        }

        function clearAllSelections() {
            const allCheckboxes = document.querySelectorAll('.content-checkbox');
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');

            allCheckboxes.forEach(cb => cb.checked = false);
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;

            updateBulkDeleteUI();
        }

        function confirmBulkDelete() {
            const selectedIds = getSelectedIds();

            if (selectedIds.length === 0) {
                alert('يرجى تحديد عناصر للحذف');
                return;
            }

            const message = `هل أنت متأكد من رغبتك في حذف ${selectedIds.length} محتوى? هذا الإجراء لا يمكن التراجع عنه.`;

            if (!confirm(message)) {
                return;
            }

            bulkDeleteContents(selectedIds);
        }

        function bulkDeleteContents(ids) {
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const originalText = bulkDeleteBtn.innerHTML;

            // Show loading state
            bulkDeleteBtn.disabled = true;
            bulkDeleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>جاري الحذف...';

            fetch('{{ route('dashboard.contents.bulkDestroy') }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        ids: ids
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        alert(`✓ ${data.message}`);

                        // Reload the page after a short delay
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        alert(`⚠ ${data.message}`);
                        bulkDeleteBtn.disabled = false;
                        bulkDeleteBtn.innerHTML = originalText;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء حذف المحتوى');
                    bulkDeleteBtn.disabled = false;
                    bulkDeleteBtn.innerHTML = originalText;
                });
        }

        // Add delete confirmation to individual delete buttons
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('هل أنت متأكد من رغبتك في حذف هذا المحتوى?')) {
                        this.closest('form').submit();
                    }
                });
            });

            // Copy shortlink functionality removed as requested
        });
    </script>
@endpush
