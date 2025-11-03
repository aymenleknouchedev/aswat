@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إدارة الأولى')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')

            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">
                        <div class="nk-block nk-block-lg">

                            <div class="nk-block-head">
                                <div class="nk-block-head-content d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="nk-block-title fw-bold" data-en="Top Contents Management" data-ar="إدارة الأولى">
                                            إدارة الأولى
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            {{-- Alerts --}}
                            @if (session('success'))
                                <div class="alert alert-fill alert-success alert-icon">
                                    <em class="icon ni ni-check-circle"></em>
                                    <span>{{ session('success') }}</span>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-fill alert-danger alert-icon">
                                    <em class="icon ni ni-cross-circle"></em>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>

                        <div class="mt-4">
                            <div class="mb-4">
                                <form id="topContentSearchForm" class="row align-items-end gy-3 gx-2">
                                    <div class="col-12 col-md-5 col-lg-3">
                                        <input 
                                            type="text" 
                                            name="search_all" 
                                            id="searchAllInput"
                                            class="form-control"
                                            placeholder="ابحث في جميع المحتويات..."
                                        >
                                    </div>

                                    <div class="col-12 col-md-5 col-lg-3">
                                        <select 
                                            name="section_filter" 
                                            id="sectionFilter" 
                                            class="form-select"
                                        >
                                            <option value="">{{ __('اختر القسم') }}</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-2 ms-auto">
                                        <button id="saveChangesBtn" class="btn btn-primary btn-sm px-3">
                                            حفظ
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="row g-3">
                                <!-- Left: Recent -->
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <ul id="recentContentsList" class="list-group custom-scroll"
                                                style="direction: rtl; max-height: 550px; overflow-y: auto;">
                                                @foreach ($recentContents as $content)
                                                    @php
                                                        $isLatestTrend = $latestTrendContents->contains('id', $content->id);
                                                    @endphp
                                                    <li class="list-group-item d-flex align-items-center justify-content-between"
                                                        data-id="{{ $content->id }}"
                                                        data-is-trend="{{ $isLatestTrend ? 'true' : 'false' }}">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="fw-semibold" style="font-size: 13px; color: {{ $isLatestTrend ? '#FFC107' : 'inherit' }};">{{ $content->title }}</span>
                                                            <small class="text-muted">#{{ $content->id }}</small>
                                                        </div>
                                                        <a href="#" class="btn btn-icon btn-sm btn-outline-primary add-content-btn" 
                                                            data-id="{{ $content->id }}"
                                                            data-is-trend="{{ $isLatestTrend ? 'true' : 'false' }}"
                                                            title="Add to top"
                                                            @if($isLatestTrend) disabled @endif>
                                                            <em class="icon ni ni-plus"></em>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right: Top -->
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <ul id="sortable-list" class="list-group">
                                                @foreach ($topContents as $top)
                                                    <li class="list-group-item d-flex align-items-center justify-content-between"
                                                        data-id="{{ $top->content_id }}">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-primary d-inline-flex align-items-center justify-content-center"
                                                                style="width: 28px; height: 28px; border-radius: 50%; font-size: 14px;">
                                                                {{ $loop->iteration }}
                                                            </span>
                                                            <div class="d-flex flex-column">
                                                                <span style="font-size: 13px">{{ $top?->content?->title ?? 'بدون عنوان' }}</span>
                                                                <small class="text-muted">#{{ $top->content_id }}</small>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-icon btn-sm btn-outline-danger delete-top-content-btn"
                                                            title="إزالة">
                                                            <em class="icon ni ni-minus"></em>
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
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

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sortableList = document.getElementById("sortable-list");
        const saveBtn = document.getElementById("saveChangesBtn");
        let topContents = new Map();
        let isProcessing = false; // Prevent infinite loops

        // Initialize existing top contents
        document.querySelectorAll("#sortable-list li").forEach(li => {
            const id = li.dataset.id?.toString();
            if (id) {
                const titleEl = li.querySelector("div > div > span:first-of-type");
                const title = titleEl ? titleEl.textContent.trim() : id;
                topContents.set(id, title);
            }
        });

        function updateBadges() {
            document.querySelectorAll("#sortable-list li").forEach((li, index) => {
                const badge = li.querySelector(".badge");
                if (badge) {
                    badge.textContent = index + 1;
                }
            });
        }

        function refreshDisabledState() {
            if (isProcessing) return; // Prevent infinite loop
            
            const maxReached = topContents.size >= 15;
            const minReached = topContents.size <= 7;

            // Disable/enable add buttons
            document.querySelectorAll("#recentContentsList li").forEach(li => {
                const id = li.dataset.id?.toString();
                const btn = li.querySelector(".add-content-btn");
                const isTrend = li.dataset.isTrend === 'true';
                
                if (!id || !btn) return;

                const shouldDisable = topContents.has(id) || maxReached || isTrend;

                if (shouldDisable) {
                    btn.setAttribute("disabled", "disabled");
                    btn.style.pointerEvents = "none";
                    btn.style.opacity = "0.5";
                    li.classList.add("disabled");
                } else {
                    btn.removeAttribute("disabled");
                    btn.style.pointerEvents = "auto";
                    btn.style.opacity = "1";
                    li.classList.remove("disabled");
                }
            });

            // Disable/enable delete buttons
            document.querySelectorAll(".delete-top-content-btn").forEach(btn => {
                if (minReached) {
                    btn.setAttribute("disabled", "disabled");
                    btn.style.pointerEvents = "none";
                    btn.style.opacity = "0.5";
                } else {
                    btn.removeAttribute("disabled");
                    btn.style.pointerEvents = "auto";
                    btn.style.opacity = "1";
                }
            });
        }

        function bindAddButtons() {
            // Remove old listeners by cloning
            document.querySelectorAll(".add-content-btn").forEach(btn => {
                btn.replaceWith(btn.cloneNode(true));
            });

            document.querySelectorAll(".add-content-btn").forEach(btn => {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();

                    if (isProcessing) return;

                    const id = this.dataset.id?.toString();
                    const isTrend = this.dataset.isTrend === 'true';

                    if (!id) return;

                    // Prevent adding trend contents
                    if (isTrend) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'لا يمكن إضافة هذا المحتوى',
                            text: 'هذا المحتوى من الاتجاهات الحالية ولا يمكن إضافته للمحتويات المميزة.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return;
                    }

                    if (topContents.size >= 15) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'الحد الأقصى 15 محتوى فقط',
                            text: 'لا يمكنك إضافة المزيد من المحتويات المميزة.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return;
                    }

                    if (topContents.has(id)) return;

                    isProcessing = true;

                    const recentLi = this.closest("li");
                    const titleEl = recentLi?.querySelector("span.fw-semibold");
                    const title = titleEl ? titleEl.textContent.trim() : id;

                    topContents.set(id, title);

                    const li = document.createElement("li");
                    li.className = "list-group-item d-flex align-items-center justify-content-between";
                    li.dataset.id = id;
                    li.innerHTML = `
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary d-inline-flex align-items-center justify-content-center"
                                style="width: 28px; height: 28px; border-radius: 50%; font-size: 14px;"></span>
                            <div class="d-flex flex-column">
                                <span style="font-size: 13px">${escapeHtml(title)}</span>
                                <small class="text-muted">#${id}</small>
                            </div>
                        </div>
                        <button type="button" class="btn btn-icon btn-sm btn-outline-danger delete-top-content-btn" title="إزالة">
                            <em class="icon ni ni-minus"></em>
                        </button>
                    `;

                    sortableList.appendChild(li);
                    bindDeleteButtons();
                    updateBadges();
                    refreshDisabledState();

                    isProcessing = false;
                });
            });
        }

        function bindDeleteButtons() {
            // Remove old listeners by cloning
            document.querySelectorAll(".delete-top-content-btn").forEach(btn => {
                btn.replaceWith(btn.cloneNode(true));
            });

            document.querySelectorAll(".delete-top-content-btn").forEach(btn => {
                btn.addEventListener("click", function () {
                    if (isProcessing) return;

                    const li = this.closest("li");
                    if (!li) return;

                    if (topContents.size <= 7) {
                        Swal.fire({
                            icon: 'info',
                            title: 'الحد الأدنى هو 7 محتويات',
                            text: 'لا يمكنك حذف المزيد من المحتويات.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return;
                    }

                    isProcessing = true;

                    const id = li.dataset.id?.toString();
                    if (id) topContents.delete(id);

                    li.remove();
                    updateBadges();
                    refreshDisabledState();

                    isProcessing = false;
                });
            });
        }

        function escapeHtml(text) {
            const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
            return String(text).replace(/[&<>"']/g, m => map[m]);
        }

        // Initialize Sortable
        new Sortable(sortableList, {
            animation: 150,
            ghostClass: 'bg-light',
            onEnd: updateBadges
        });

        // Save button handler
        if (saveBtn) {
            saveBtn.addEventListener("click", function (e) {
                e.preventDefault();
                
                if (isProcessing) return; // Prevent multiple simultaneous saves

                const ids = Array.from(document.querySelectorAll("#sortable-list li"))
                    .map(li => li.dataset.id)
                    .filter(Boolean);

                saveBtn.disabled = true;
                saveBtn.textContent = "حفظ...";
                isProcessing = true;

                fetch("{{ route('dashboard.topcontents.updateOrder') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ ids })
                })
                .then(res => res.json())
                .then(response => {
                    if (response && response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'تم حفظ التغييرات بنجاح',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: response.message || '⚠️ حدث خطأ أثناء حفظ التغييرات.'
                        });
                    }
                })
                .catch((err) => {
                    console.error('Save error:', err);
                    Swal.fire({
                        icon: 'error',
                        title: '⚠️ حدث خطأ أثناء حفظ التغييرات.'
                    });
                })
                .finally(() => {
                    saveBtn.disabled = false;
                    saveBtn.textContent = "حفظ";
                    isProcessing = false;
                });
            });
        }

        // Initialize everything
        bindAddButtons();
        bindDeleteButtons();
        updateBadges();
        refreshDisabledState();
    });
</script>