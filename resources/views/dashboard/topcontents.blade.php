@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إدارة الأولى')

@section('content')
<style>
    #recentContentsList::-webkit-scrollbar {
        display: none;
    }
</style>
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
                                            data-ar="ابحث في جميع المحتويات..."
                                            data-en="Search all contents..."
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
                                        <button id="saveChangesBtn" class="btn btn-primary btn-sm px-3" data-ar="حفظ" data-en="Save">
                                            حفظ
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="row g-3 pt-0 pb-2 px-2 rounded-5 mt-3">
                                <!-- Left: Recent -->
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <ul id="recentContentsList" class="list-group custom-scroll"
                                                style="direction: rtl; max-height: 825px; overflow-y: auto; scrollbar-width: none; -ms-overflow-style: none;">
                                                <li id="loadingMessage" class="list-group-item text-center text-muted" style="display: none;">
                                                    <span data-ar="جاري التحميل..." data-en="Loading...">جاري التحميل...</span>
                                                </li>
                                                <li id="noResultsMessage" class="list-group-item text-center text-muted" style="display: none;">
                                                    <span data-ar="لا توجد نتائج" data-en="No results found">لا توجد نتائج</span>
                                                </li>
                                                @foreach ($recentContents as $content)
                                                    <li class="list-group-item d-flex align-items-center justify-content-between content-item"
                                                        data-id="{{ $content->id }}"
                                                        data-title="{{ $content->title }}"
                                                        data-section-id="{{ $content->section_id ?? '' }}"
                                                        data-section-name="{{ $content->section->name ?? '' }}">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="fw-semibold" style="font-size: 13px">{{ $content->title }}</span>
                                                            <small class="text-muted">#{{ $content->id }}</small>
                                                        </div>
                                                        <a href="#" class="btn btn-icon btn-sm btn-outline-primary add-content-btn" data-id="{{ $content->id }}"
                                                            title="Add to top">
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

        // Get current language from HTML lang attribute or default to 'ar'
        const currentLang = document.documentElement.lang || 'ar';

        // Translations object
        const translations = {
            maxLimit: {
                ar: 'الحد الأقصى 15 محتوى فقط',
                en: 'Maximum 15 contents only'
            },
            maxLimitText: {
                ar: 'لا يمكنك إضافة المزيد من المحتويات المميزة.',
                en: 'You cannot add more featured contents.'
            },
            minLimit: {
                ar: 'الحد الأدنى 7 محتويات',
                en: 'Minimum 7 contents required'
            },
            minLimitText: {
                ar: 'يجب أن يكون لديك 7 محتويات على الأقل.',
                en: 'You must have at least 7 top contents.'
            },
            saveSuccess: {
                ar: 'تم حفظ التغييرات بنجاح',
                en: 'Changes saved successfully'
            },
            saveError: {
                ar: '⚠️ حدث خطأ أثناء حفظ التغييرات.',
                en: '⚠️ An error occurred while saving changes.'
            },
            saving: {
                ar: 'حفظ...',
                en: 'Saving...'
            },
            save: {
                ar: 'حفظ',
                en: 'Save'
            }
        };

        // Helper function to get translation
        function t(key) {
            return translations[key][currentLang] || translations[key]['ar'];
        }

        let topContents = new Map();

        // Initialize existing top contents
        document.querySelectorAll("#sortable-list li").forEach(li => {
            const id = li.dataset.id?.toString();
            if (id) {
                const titleEl = li.querySelector("div > div > span") || li.querySelector("span:nth-child(2)");
                const title = titleEl ? titleEl.textContent.trim() : id;
                topContents.set(id, title);
            }
        });

        function updateBadges() {
            document.querySelectorAll("#sortable-list li").forEach((li, index) => {
                const badge = li.querySelector(".badge");
                if (badge) badge.textContent = index + 1;
            });
        }

        // ✅ Disable Add when >=15, Disable Delete when <=7
        function refreshDisabledState() {
            const maxReached = topContents.size >= 15;
            // const minReached = topContents.size <= 7;

            // Add buttons (left)
            document.querySelectorAll("#recentContentsList li.content-item").forEach(li => {
                const id = li.dataset.id?.toString();
                const btn = li.querySelector(".add-content-btn");
                if (!id || !btn) return;

                if (topContents.has(id) || maxReached) {
                    li.classList.add("disabled");
                    btn.classList.add("disabled");
                    btn.style.pointerEvents = "none";
                    btn.style.opacity = "0.5";
                } else {
                    li.classList.remove("disabled");
                    btn.classList.remove("disabled");
                    btn.style.pointerEvents = "auto";
                    btn.style.opacity = "1";
                }
            });

            // Delete buttons (right)
            document.querySelectorAll(".delete-top-content-btn").forEach(btn => {
                if (minReached) {
                    btn.classList.add("disabled");
                    btn.style.pointerEvents = "none";
                    btn.style.opacity = "0.5";
                } else {
                    btn.classList.remove("disabled");
                    btn.style.pointerEvents = "auto";
                    btn.style.opacity = "1";
                }
            });
        }

        function bindAddButtons() {
            document.querySelectorAll(".add-content-btn").forEach(btn => {
                btn.replaceWith(btn.cloneNode(true));
            });

            document.querySelectorAll(".add-content-btn").forEach(btn => {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();

                    const id = this.dataset.id?.toString();
                    if (!id) return;

                    if (topContents.size >= 15) {
                        Swal.fire({
                            icon: 'warning',
                            title: t('maxLimit'),
                            text: t('maxLimitText'),
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return;
                    }

                    if (topContents.has(id)) return;

                    const recentLi = this.closest("li");
                    const titleEl = recentLi?.querySelector("span.fw-semibold, span") || recentLi?.querySelector("span");
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

                    // sortableList.appendChild(li);
                    sortableList.insertBefore(li, sortableList.firstChild);
                    bindDeleteButtons();
                    updateBadges();
                    refreshDisabledState();
                });
            });
        }

        function bindDeleteButtons() {
            document.querySelectorAll(".delete-top-content-btn").forEach(btn => {
                btn.replaceWith(btn.cloneNode(true));
            });

            document.querySelectorAll(".delete-top-content-btn").forEach(btn => {
                btn.addEventListener("click", function () {
                    const li = this.closest("li");
                    if (!li) return;

                    const id = li.dataset.id?.toString();
                    if (id) topContents.delete(id);

                    li.remove();
                    updateBadges();
                    refreshDisabledState();
                });
            });
        }

        function escapeHtml(text) {
            const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
            return String(text).replace(/[&<>"']/g, m => map[m]);
        }

        new Sortable(sortableList, { animation: 150, ghostClass: 'bg-light', onEnd: updateBadges });

        if (saveBtn) {
            saveBtn.addEventListener("click", function (e) {
                e.preventDefault();
                const ids = Array.from(document.querySelectorAll("#sortable-list li"))
                    .map(li => li.dataset.id)
                    .filter(Boolean);

                saveBtn.disabled = true;
                saveBtn.textContent = t('saving');

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
                        Swal.fire({ icon: 'success', title: t('saveSuccess'), timer: 2000, showConfirmButton: false });
                    } else {
                        // Use language-specific message from backend if available
                        const errorMessage = currentLang === 'en'
                            ? (response.message_en || response.message || t('saveError'))
                            : (response.message_ar || response.message || t('saveError'));
                        Swal.fire({ icon: 'error', title: errorMessage });
                    }
                })
                .catch(() => {
                    Swal.fire({ icon: 'error', title: t('saveError') });
                })
                .finally(() => {
                    saveBtn.disabled = false;
                    saveBtn.textContent = t('save');
                });
            });
        }

        // Filter functionality with AJAX
        const searchInput = document.getElementById('searchAllInput');
        const sectionFilter = document.getElementById('sectionFilter');
        const noResultsMessage = document.getElementById('noResultsMessage');
        const loadingMessage = document.getElementById('loadingMessage');
        const recentContentsList = document.getElementById('recentContentsList');
        let filterTimeout = null;

        function renderContentItem(content) {
            const isInTop = topContents.has(content.id.toString());
            const maxReached = topContents.size >= 15;
            const disabled = isInTop || maxReached;

            return `
                <li class="list-group-item d-flex align-items-center justify-content-between content-item ${disabled ? 'disabled' : ''}"
                    data-id="${content.id}"
                    data-title="${escapeHtml(content.title)}"
                    data-section-id="${content.section_id || ''}"
                    data-section-name="${escapeHtml(content.section_name || '')}">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-semibold" style="font-size: 13px">${escapeHtml(content.title)}</span>
                        <small class="text-muted">#${content.id}</small>
                    </div>
                    <a href="#" class="btn btn-icon btn-sm btn-outline-primary add-content-btn ${disabled ? 'disabled' : ''}"
                       data-id="${content.id}"
                       title="Add to top"
                       style="pointer-events: ${disabled ? 'none' : 'auto'}; opacity: ${disabled ? '0.5' : '1'}">
                        <em class="icon ni ni-plus"></em>
                    </a>
                </li>
            `;
        }

        function loadFilteredContents() {
            const searchTerm = searchInput.value.trim();
            const selectedSection = sectionFilter.value;

            // Show loading indicator
            if (loadingMessage) loadingMessage.style.display = '';
            if (noResultsMessage) noResultsMessage.style.display = 'none';

            // Build query parameters
            const params = new URLSearchParams();
            if (searchTerm) params.append('search', searchTerm);
            if (selectedSection) params.append('section_id', selectedSection);

            // Fetch filtered results from server
            fetch("{{ route('dashboard.topcontents.search') }}?" + params.toString(), {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(response => {
                // Hide loading indicator
                if (loadingMessage) loadingMessage.style.display = 'none';

                if (response.success && response.contents) {
                    // Clear existing content items
                    const contentItems = recentContentsList.querySelectorAll('.content-item');
                    contentItems.forEach(item => item.remove());

                    if (response.contents.length === 0) {
                        // Show no results message
                        if (noResultsMessage) {
                            noResultsMessage.style.display = '';
                        }
                    } else {
                        // Hide no results message
                        if (noResultsMessage) {
                            noResultsMessage.style.display = 'none';
                        }

                        // Add filtered content items
                        response.contents.forEach(content => {
                            const itemHTML = renderContentItem(content);
                            recentContentsList.insertAdjacentHTML('beforeend', itemHTML);
                        });

                        // Re-bind add buttons
                        bindAddButtons();
                    }
                }
            })
            .catch(error => {
                console.error('Filter error:', error);
                // Hide loading indicator on error
                if (loadingMessage) loadingMessage.style.display = 'none';
                if (noResultsMessage) {
                    noResultsMessage.style.display = '';
                }
            });
        }

        // Debounced search input
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(filterTimeout);
                filterTimeout = setTimeout(loadFilteredContents, 300);
            });
        }

        // Immediate filter on section change
        if (sectionFilter) {
            sectionFilter.addEventListener('change', loadFilteredContents);
        }

        bindAddButtons();
        bindDeleteButtons();
        updateBadges();
        refreshDisabledState();
    });
</script>
