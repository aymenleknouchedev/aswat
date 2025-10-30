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
                                        <div class="card">
                                            <div class="card-inner">
                                                <div id="mediaSearchForm">
                                                    <div class="row g-3 align-items-end">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="searchQuery">بحث</label>
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
                                                                <label class="form-label" for="mediaType">نوع
                                                                    الوسائط</label>
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
                                                                <label class="form-label" for="sortBy">ترتيب حسب</label>
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
                                                <div id="loadingIndicator" class="text-center mt-3" style="display: none;">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">جاري التحميل...</span>
                                                    </div>
                                                    <span class="ms-2">جاري التحميل...</span>
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

                                    <div class="nk-block">
                                        <!-- Results Count -->
                                        <div id="resultsCount" class="mb-3">
                                            @include('dashboard.partials.results-count', compact('medias'))
                                        </div>

                                        <!-- Media Grid -->
                                        <div class="row g-3" id="mediaGrid">
                                            @include(
                                                'dashboard.partials.media-grid',
                                                compact('medias', 'getMediaTypeBadge', 'getMediaTypeLabel'))
                                        </div>

                                        <!-- Pagination -->
                                        <div class="d-flex justify-content-center mt-4" id="paginationContainer">
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
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">تعديل الوسائط</h5>
                    <form id="editMediaForm" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="editName">الاسم</label>
                                    <input required type="text" class="form-control" id="editName" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="editAlt">النص البديل</label>
                                    <input required type="text" class="form-control" id="editAlt" name="alt">
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-primary">تحديث</button>
                                    </li>
                                    <li>
                                        <a href="#" class="link link-gray" data-bs-dismiss="modal">إلغاء</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include mmm Media Modal -->
    @include('dashboard.components.gallery-model')

    <style>
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }

        #mediaGrid {
            transition: opacity 0.3s ease;
        }

        .media-grid-loading {
            opacity: 0.6;
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

                        player.innerHTML = '';
                        player.appendChild(iframe);
                        player.classList.add('loaded');
                    });
                }
            });

            // Edit media buttons
            document.querySelectorAll('.edit-media').forEach(button => {
                button.addEventListener('click', function() {
                    const mediaId = this.getAttribute('data-media-id');
                    const mediaName = this.getAttribute('data-media-name');
                    const mediaAlt = this.getAttribute('data-media-alt');

                    document.getElementById('editName').value = mediaName;
                    document.getElementById('editAlt').value = mediaAlt;

                    const form = document.getElementById('editMediaForm');
                    form.action = "{{ route('dashboard.media.update', ':id') }}".replace(':id', mediaId);

                    const modal = new bootstrap.Modal(document.getElementById('editMediaModal'));
                    modal.show();
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

            // Open mmm Media Modal
            document.getElementById('openMediaModal').addEventListener('click', function() {
                if (window.mmmMediaModalManager) {
                    window.mmmMediaModalManager.openModal();
                }
            });
        });
    </script>
@endsection
