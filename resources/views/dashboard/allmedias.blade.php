@extends('layouts.admin')

@section('title', 'أصوات جزائرية | الوسائط')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <!-- Page Header -->
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">الوسائط</h3>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                                        data-target="pageMenu">
                                                        <em class="icon ni ni-more-v"></em>
                                                    </a>
                                                    <div class="toggle-expand-content" data-content="pageMenu"
                                                        style="display: none;">
                                                        <ul class="nk-block-tools g-3">
                                                            <li class="nk-block-tools-opt">
                                                                <button id="openMediaModal" class="btn btn-primary">
                                                                    <em class="icon ni ni-plus"></em>
                                                                    <span>رفع ملف</span>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Search and Filter Section -->
                                    <div class="nk-block">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div id="mediaSearchForm">
                                                    <div class="row g-3 align-items-end">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="searchQuery">
                                                                    <em class="icon ni ni-search me-1"></em>بحث
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-search"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        id="searchQuery" name="search"
                                                                        placeholder="ابحث بالاسم أو النص البديل..."
                                                                        value="{{ request('search') }}"
                                                                        onkeyup="debounceFilter()">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="mediaType">
                                                                    <em class="icon ni ni-filter me-1"></em>نوع الوسائط
                                                                </label>
                                                                <select class="form-select" id="mediaType" name="type"
                                                                    onchange="filterMedia()">
                                                                    <option value="">جميع الأنواع</option>
                                                                    <option value="image"
                                                                        {{ request('type') == 'image' ? 'selected' : '' }}>
                                                                        صور</option>
                                                                    <option value="video"
                                                                        {{ request('type') == 'video' ? 'selected' : '' }}>
                                                                        فيديو</option>
                                                                    <option value="audio"
                                                                        {{ request('type') == 'audio' ? 'selected' : '' }}>
                                                                        صوت</option>
                                                                    <option value="document"
                                                                        {{ request('type') == 'document' ? 'selected' : '' }}>
                                                                        مستندات</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="sortBy">
                                                                    <em class="icon ni ni-sort me-1"></em>ترتيب حسب
                                                                </label>
                                                                <select class="form-select" id="sortBy" name="sort"
                                                                    onchange="filterMedia()">
                                                                    <option value="newest"
                                                                        {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                                                        الأحدث أولاً</option>
                                                                    <option value="oldest"
                                                                        {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                                                        الأقدم أولاً</option>
                                                                    <option value="name_asc"
                                                                        {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                                                        الاسم (أ-ي)</option>
                                                                    <option value="name_desc"
                                                                        {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                                                        الاسم (ي-أ)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-outline-danger w-100"
                                                                    onclick="clearFilters()">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>مسح الكل</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Loading Indicator -->
                                                <div id="loadingIndicator" class="text-center mt-4" style="display: none;">
                                                    <div class="spinner-border spinner-border-sm text-primary"
                                                        role="status">
                                                        <span class="visually-hidden">جاري التحميل...</span>
                                                    </div>
                                                    <p class="mt-2 text-muted">جاري التحميل...</p>
                                                </div>

                                                <!-- Active Filters -->
                                                <div id="activeFilters" class="mt-3">
                                                    @include(
                                                        'dashboard.partials.active-filters',
                                                        compact('getMediaTypeLabel', 'getSortLabel'))
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Media Content Block -->
                                    <div class="nk-block">
                                        <!-- Results Count -->
                                        <div id="resultsCount" class="mb-4">
                                            @include('dashboard.partials.results-count', compact('medias'))
                                        </div>



                                        <!-- Media Grid -->
                                        <div class="row g-gs" id="mediaGrid">
                                            @include(
                                                'dashboard.partials.media-grid',
                                                compact('medias', 'getMediaTypeBadge', 'getMediaTypeLabel'))
                                        </div>

                                        <!-- Pagination -->
                                        <div class="d-flex justify-content-center mt-5" id="paginationContainer">
                                            {{ $medias->appends(request()->query())->links() }}
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

    <!-- Edit Media Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editMediaModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title">تعديل الوسائط</h5>
                </div>
                <div class="modal-body">
                    <form id="editMediaForm" method="POST" class="mt-3">
                        @csrf
                        @method('PUT')
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="editName">الاسم</label>
                                    <input required type="text" class="form-control" id="editName" name="name"
                                        placeholder="أدخل اسم الوسائط">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="editAlt">النص البديل</label>
                                    <input required type="text" class="form-control" id="editAlt" name="alt"
                                        placeholder="أدخل النص البديل">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="editDescription">الوصف</label>
                                    <textarea class="form-control" id="editDescription" name="description" rows="3"
                                        placeholder="أدخل وصف الوسائط (اختياري)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <em class="icon ni ni-check"></em>
                                <span>تحديث</span>
                            </button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                <em class="icon ni ni-cross"></em>
                                <span>إلغاء</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Media Upload Modal -->
    @include('dashboard.components.gallery-model')

    <style>
        /* Spinner Styles */
        .spinner-border-sm {
            width: 1.25rem;
            height: 1.25rem;
            border-width: 0.2em;
        }

        /* Media Grid Styles */
        #mediaGrid {
            transition: opacity 0.3s ease;
        }

        .media-grid-loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Media Item Card */
        .media-item {
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 600px;
            overflow: hidden;
            border-radius: 0.5rem;
            background: #fff;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
        }

        .media-item:hover {
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
            transform: translateY(-4px);
        }

        /* Media Preview Container */
        .media-preview {
            position: relative;
            width: 100%;
            padding-bottom: 100%;
            background: #f5f5f5;
            overflow: hidden;
            border-radius: 0.5rem 0.5rem 0 0;
            flex-shrink: 0;
        }

        .media-preview-inner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .media-preview img,
        .media-preview video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .youtube-player,
        .video-player {
            width: 100%;
            height: 100%;
            cursor: pointer;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .youtube-player:hover {
            background: #1a1a1a;
        }

        /* Media Body */
        .media-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 1rem;
            justify-content: space-between;
        }

        /* Media Title - FULL HEIGHT FLEXIBLE */
        .media-title {
            margin: 0;
            margin-bottom: 0.5rem;
            font-size: 0.9375rem;
            font-weight: 600;
            line-height: 1.5rem;
            color: #1a1a1a;
            word-break: break-word;
            word-wrap: break-word;
            overflow-wrap: break-word;
            height: 90px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        /* Media Info */
        .media-info {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex: 1;
            margin-bottom: 0.75rem;
            font-size: 0.8125rem;
            color: #666;
            height: 60px;
            overflow: hidden;
        }

        .media-info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .media-info-item em {
            flex-shrink: 0;
            color: #999;
        }

        /* Media Badge */
        .media-badge {
            display: inline-block;
            padding: 0.25rem 0.625rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            white-space: nowrap;
            margin-bottom: 0.5rem;
        }

        .media-badge-image {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .media-badge-video {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        .media-badge-audio {
            background-color: #e8f5e9;
            color: #388e3c;
        }

        .media-badge-document {
            background-color: #fff3e0;
            color: #f57c00;
        }

        /* Media Actions */
        .media-actions {
            display: flex;
            gap: 0.5rem;
            padding-top: 0.75rem;
            border-top: 1px solid #e9ecef;
            flex-wrap: wrap;
        }

        .media-actions .btn {
            flex: 1;
            min-width: 60px;
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
        }

        .media-actions .btn em {
            font-size: 0.875rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .media-item {
                min-height: 550px;
            }

            .media-body {
                padding: 0.75rem;
            }

            .media-title {
                font-size: 0.875rem;
            }

            .media-actions .btn {
                padding: 0.4rem 0.5rem;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .media-item {
                min-height: 500px;
            }
        }

        /* Filter Badge Styles */
        .filter-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #e3f2fd;
            border: 1px solid #1976d2;
            border-radius: 20px;
            color: #1976d2;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            margin-left: 0.5rem;
        }

        .filter-badge .remove-filter {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .filter-badge .remove-filter:hover {
            background: rgba(25, 118, 210, 0.2);
        }

        /* Results Count */
        #resultsCount {
            color: #666;
            font-weight: 500;
        }



        /* Loading Indicator */
        #loadingIndicator {
            padding: 2rem;
        }

        /* Card Styles */
        .card-bordered {
            border: 1px solid #e9ecef;
            background: #fff;
        }

        .card-inner {
            padding: 1.5rem;
        }

        /* Form Improvements */
        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #1a1a1a;
        }

        /* Pagination Improvements */
        #paginationContainer {
            margin-top: 2rem;
            padding: 1rem;
            background: #f5f5f5;
            border-radius: 0.5rem;
        }

        /* Animation for grid changes */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .media-item {
            animation: fadeIn 0.3s ease;
        }

        /* Utility Classes */
        .text-muted {
            color: #6c757d;
        }

        .fs-1 {
            font-size: 3rem !important;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .gap-2 {
            gap: 0.5rem !important;
        }

        .d-flex {
            display: flex;
        }

        .gap-gs {
            gap: 1rem;
        }
    </style>

    <script>
        let filterTimeout;
        let currentFilters = {
            search: "{{ request('search') }}",
            type: "{{ request('type') }}",
            sort: "{{ request('sort', 'newest') }}"
        };

        // Debounce search input
        function debounceFilter() {
            clearTimeout(filterTimeout);
            filterTimeout = setTimeout(() => {
                currentFilters.search = document.getElementById('searchQuery').value;
                filterMedia();
            }, 500);
        }

        // Filter media function
        function filterMedia() {
            currentFilters.type = document.getElementById('mediaType').value;
            currentFilters.sort = document.getElementById('sortBy').value;
            loadMediaWithFilters();
        }

        // Remove specific filter
        function removeFilter(filterName) {
            currentFilters[filterName] = '';

            if (filterName === 'search') {
                document.getElementById('searchQuery').value = '';
            } else if (filterName === 'type') {
                document.getElementById('mediaType').value = '';
            } else if (filterName === 'sort') {
                document.getElementById('sortBy').value = 'newest';
            }

            loadMediaWithFilters();
        }

        // Clear all filters
        function clearFilters() {
            currentFilters = {
                search: '',
                type: '',
                sort: 'newest'
            };
            document.getElementById('searchQuery').value = '';
            document.getElementById('mediaType').value = '';
            document.getElementById('sortBy').value = 'newest';
            loadMediaWithFilters();
        }

        // Load media with current filters
        function loadMediaWithFilters() {
            // Show loading
            document.getElementById('loadingIndicator').style.display = 'block';
            document.getElementById('mediaGrid').classList.add('media-grid-loading');

            // Build query string
            const queryParams = new URLSearchParams();
            if (currentFilters.search) queryParams.append('search', currentFilters.search);
            if (currentFilters.type) queryParams.append('type', currentFilters.type);
            if (currentFilters.sort && currentFilters.sort !== 'newest') queryParams.append('sort', currentFilters.sort);

            // Update URL without reloading page
            const newUrl = `${window.location.pathname}${queryParams.toString() ? '?' + queryParams.toString() : ''}`;
            window.history.pushState({}, '', newUrl);

            // AJAX request
            fetch(`{{ route('dashboard.medias.index') }}?${queryParams.toString()}&ajax=1`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Update all sections
                        document.getElementById('mediaGrid').innerHTML = data.mediaGrid;
                        document.getElementById('paginationContainer').innerHTML = data.pagination;
                        document.getElementById('resultsCount').innerHTML = data.resultsCount;
                        document.getElementById('activeFilters').innerHTML = data.activeFilters;

                        // Re-initialize media interactions
                        initializeMediaInteractions();
                    } else {
                        throw new Error(data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء تحميل البيانات. يرجى المحاولة مرة أخرى.');
                })
                .finally(() => {
                    document.getElementById('loadingIndicator').style.display = 'none';
                    document.getElementById('mediaGrid').classList.remove('media-grid-loading');
                });
        }

        // Initialize media interactions
        function initializeMediaInteractions() {
            // YouTube players
            document.querySelectorAll('.youtube-player').forEach(player => {
                const youtubeId = player.getAttribute('data-youtube-id');
                if (youtubeId) {
                    player.addEventListener('click', function() {
                        const iframe = document.createElement('iframe');
                        iframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1`;
                        iframe.allow = 'autoplay; encrypted-media';
                        iframe.allowFullscreen = true;
                        iframe.style.width = '100%';
                        iframe.style.height = '100%';
                        iframe.setAttribute('frameborder', '0');

                        player.innerHTML = '';
                        player.appendChild(iframe);
                        player.classList.add('loaded');
                    });
                }
            });

            // Edit media buttons
            document.querySelectorAll('.edit-media').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const mediaId = this.getAttribute('data-media-id');
                    const mediaName = this.getAttribute('data-media-name');
                    const mediaAlt = this.getAttribute('data-media-alt');
                    const mediaDescription = this.getAttribute('data-media-description') || '';

                    document.getElementById('editName').value = mediaName;
                    document.getElementById('editAlt').value = mediaAlt;
                    document.getElementById('editDescription').value = mediaDescription;

                    const form = document.getElementById('editMediaForm');
                    form.action = "{{ route('dashboard.media.update', ':id') }}".replace(':id', mediaId);

                    const modal = new bootstrap.Modal(document.getElementById('editMediaModal'));
                    modal.show();
                });
            });

            // Delete media buttons
            document.querySelectorAll('.delete-media').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('هل أنت متأكد من حذف هذه الوسائط؟')) {
                        // Add your delete logic here
                        console.log('Delete media:', this.getAttribute('data-media-id'));
                    }
                });
            });
        }

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function() {
            const urlParams = new URLSearchParams(window.location.search);
            currentFilters.search = urlParams.get('search') || '';
            currentFilters.type = urlParams.get('type') || '';
            currentFilters.sort = urlParams.get('sort') || 'newest';

            document.getElementById('searchQuery').value = currentFilters.search;
            document.getElementById('mediaType').value = currentFilters.type;
            document.getElementById('sortBy').value = currentFilters.sort;

            loadMediaWithFilters();
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeMediaInteractions();

            // Open media upload modal
            const openMediaBtn = document.getElementById('openMediaModal');
            if (openMediaBtn) {
                openMediaBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (window.mmmMediaModalManager) {
                        window.mmmMediaModalManager.openModal();
                    }
                });
            }

            // Handle form submission
            const editForm = document.getElementById('editMediaForm');
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    // Add your form submission logic here
                    console.log('Form submitted');
                });
            }
        });
    </script>
@endsection
