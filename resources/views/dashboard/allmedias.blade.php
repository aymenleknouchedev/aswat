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
                                                                    <option value="voice"
                                                                        {{ request('type') == 'voice' ? 'selected' : '' }}>
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
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="editName">الاسم</label>
                                    <input required type="text" class="form-control" id="editName" name="name"
                                        placeholder="أدخل اسم الوسائط">
                                    <div class="form-note">سيتم استخدام هذا الاسم للعرض في لوحة التحكم.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="editAlt">النص البديل (Alt Text)</label>
                                    <input required type="text" class="form-control" id="editAlt" name="alt"
                                        placeholder="أدخل النص البديل">
                                    <div class="form-note">هام لمحركات البحث وإمكانية الوصول.</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-4" style="height:48px;">
                            <button type="submit" class="btn btn-primary h-100" id="editSubmitBtn" style="height:100%;">
                                <em class="icon ni ni-check"></em>
                                <span>تحديث</span>
                            </button>
                            <button type="button" class="btn btn-light h-100" data-bs-dismiss="modal" style="height:100%;">
                                <em class="icon ni ni-cross"></em>
                                <span>إلغاء</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Media Preview Modal - Fullscreen -->
    <div class="modal fade" tabindex="-1" role="dialog" id="previewMediaModal">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content" style="background: #000;">
                <div class="modal-header" style="background: rgba(0,0,0,0.9); border-bottom: 1px solid #333;">
                    <h5 class="modal-title" style="color: #fff;" id="previewMediaTitle">معاينة الوسائط</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 0; background: #000; display: flex; flex-direction: column; height: 100%;">
                    <!-- Preview Container - Takes up most space -->
                    <div id="previewContainer" style="flex: 1; display: flex; align-items: center; justify-content: center; background: #1a1a1a; position: relative; overflow: auto;">
                        <!-- Image Preview -->
                        <img id="previewImage" src="" alt="معاينة" style="max-width: 100%; max-height: 100%; object-fit: contain; display: none;">
                        
                        <!-- Video Preview -->
                        <video id="previewVideo" controls style="max-width: 100%; max-height: 100%; object-fit: contain; display: none;"></video>
                        
                        <!-- Audio Preview -->
                        <div id="previewAudioContainer" style="display: none; width: 100%; text-align: center; padding: 2rem;">
                            <div style="margin-bottom: 2rem;">
                                <em class="icon ni ni-audio" style="font-size: 5rem; color: #fff;"></em>
                            </div>
                            <audio id="previewAudio" controls style="width: 100%; max-width: 600px; margin: 0 auto; display: block;"></audio>
                        </div>
                        
                        <!-- Document / PDF Preview -->
                        <div id="previewDocumentContainer" style="display: none; text-align: center; width: 100%; height: 100%; padding: 2rem; box-sizing: border-box;">
                            <em id="previewDocumentIcon" class="icon ni ni-file-text" style="font-size: 5rem; color: #666; margin-bottom: 2rem; display: block;"></em>
                            <p id="previewDocumentName" style="color: #999; font-size: 1.2rem; margin-bottom: 1.5rem;"></p>
                            <!-- Inline PDF viewer when available -->
                            <iframe id="previewPdf" src="" style="display: none; width: 100%; max-width: 1000px; height: 80vh; border: none; background: #fff; margin: 0 auto;"></iframe>
                        </div>
                        
                        <!-- YouTube Preview -->
                        <iframe id="previewYoutube" style="width: 100%; height: 100%; border: none; display: none;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>

                    <!-- Preview Info Footer -->
                    <div style="background: rgba(0,0,0,0.95); border-top: 1px solid #333; padding: 1.5rem; color: #fff;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; max-width: 1200px;">
                            <div>
                                <p style="margin: 0; font-size: 0.875rem; color: #999; margin-bottom: 0.5rem;"><strong>الاسم:</strong></p>
                                <p id="previewName" style="margin: 0; font-size: 1rem; color: #fff; word-break: break-word;">-</p>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 0.875rem; color: #999; margin-bottom: 0.5rem;"><strong>النوع:</strong></p>
                                <p id="previewType" style="margin: 0; font-size: 1rem; color: #fff;">-</p>
                            </div>
                            <div>
                                <p style="margin: 0; font-size: 0.875rem; color: #999; margin-bottom: 0.5rem;"><strong>النص البديل:</strong></p>
                                <p id="previewAlt" style="margin: 0; font-size: 1rem; color: #fff; word-break: break-word;">-</p>
                            </div>
                        </div>
                    </div>
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

        /* Clickable Media Preview Container */
        .media-preview-container {
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem 0.5rem 0 0;
            transition: all 0.3s ease;
        }

        .media-preview-container:hover {
            opacity: 0.85;
            transform: scale(1.02);
            box-shadow: 0 0 15px rgba(101, 118, 255, 0.3);
        }

        .media-preview-container:focus {
            outline: 2px solid #6576ff;
            outline-offset: 2px;
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

        /* Disabled button styles */
        .media-actions .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: auto;
        }

        .media-actions .btn:disabled:hover {
            transform: none;
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
        // Language helper function
        function getLangText(arText, enText) {
            const currentLang = localStorage.getItem('language') || 'ar';
            return currentLang === 'ar' ? arText : enText;
        }

        // SweetAlert helper with language support
        function showAlert(type, titleAr, titleEn, textAr = '', textEn = '') {
            Swal.fire({
                icon: type,
                title: getLangText(titleAr, titleEn),
                text: textAr || textEn ? getLangText(textAr, textEn) : '',
                timer: type === 'success' ? 2000 : undefined,
                showConfirmButton: type !== 'success',
                confirmButtonText: getLangText('حسناً', 'OK')
            });
        }

        // Extract YouTube ID from URL
        function extractYouTubeIdFromUrl(url) {
            const ytRegex = /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/|youtube\.com\/embed\/)([A-Za-z0-9_-]{6,})/i;
            const match = url.match(ytRegex);
            return match ? match[1] : null;
        }

        // Extract Vimeo ID from URL
        function extractVimeoIdFromUrl(url) {
            const vimeoRegex = /^(?:https?:\/\/)?(?:www\.)?(?:vimeo\.com\/|player\.vimeo\.com\/video\/)(\d+)/i;
            const match = url.match(vimeoRegex);
            return match ? match[1] : null;
        }

        // Extract Dailymotion ID from URL
        function extractDailymotionIdFromUrl(url) {
            const dmRegex = /^(?:https?:\/\/)?(?:www\.)?(?:dailymotion\.com\/video\/|dai\.ly\/)([A-Za-z0-9]+)/i;
            const match = url.match(dmRegex);
            return match ? match[1] : null;
        }

        // Detect video platform type
        function detectVideoPlatform(url) {
            if (url.includes('youtube.com') || url.includes('youtu.be')) return 'youtube';
            if (url.includes('vimeo.com')) return 'vimeo';
            if (url.includes('dailymotion.com') || url.includes('dai.ly')) return 'dailymotion';
            return 'direct'; // Direct video file
        }

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
                    showAlert('error', 'حدث خطأ أثناء تحميل البيانات', 'An error occurred while loading data',
                        'يرجى المحاولة مرة أخرى.', 'Please try again.');
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

            // Preview media buttons
            document.querySelectorAll('.preview-media').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const mediaName = this.getAttribute('data-media-name');
                    const mediaAlt = this.getAttribute('data-media-alt');
                    const mediaType = this.getAttribute('data-media-type');
                    const mediaPath = this.getAttribute('data-path');

                    // Clear previous content
                    document.getElementById('previewImage').style.display = 'none';
                    document.getElementById('previewVideo').style.display = 'none';
                    document.getElementById('previewAudioContainer').style.display = 'none';
                    document.getElementById('previewDocumentContainer').style.display = 'none';
                    document.getElementById('previewYoutube').style.display = 'none';
                    const pdfFrame = document.getElementById('previewPdf');
                    if (pdfFrame) {
                        pdfFrame.style.display = 'none';
                        pdfFrame.src = '';
                    }

                    // Update info
                    document.getElementById('previewName').textContent = mediaName || '-';
                    document.getElementById('previewAlt').textContent = mediaAlt || '-';
                    
                    // Determine type label
                    let typeLabel = '-';
                    if (mediaType === 'image') typeLabel = 'صورة';
                    else if (mediaType === 'video') typeLabel = 'فيديو';
                    else if (mediaType === 'voice' || mediaType === 'audio') typeLabel = 'صوت';
                    else typeLabel = 'مستند';
                    document.getElementById('previewType').textContent = typeLabel;

                    // Show appropriate preview
                    if (mediaType === 'image') {
                        const img = document.getElementById('previewImage');
                        img.src = mediaPath;
                        img.alt = mediaAlt || mediaName;
                        img.style.display = 'block';
                    } else if (mediaType === 'video') {
                        const platform = detectVideoPlatform(mediaPath);

                        if (platform === 'youtube') {
                            const youtubeId = extractYouTubeIdFromUrl(mediaPath);
                            if (youtubeId) {
                                const iframe = document.getElementById('previewYoutube');
                                iframe.src = `https://www.youtube.com/embed/${youtubeId}`;
                                iframe.style.display = 'block';
                            }
                        } else if (platform === 'vimeo') {
                            const vimeoId = extractVimeoIdFromUrl(mediaPath);
                            if (vimeoId) {
                                const iframe = document.getElementById('previewYoutube');
                                iframe.src = `https://player.vimeo.com/video/${vimeoId}`;
                                iframe.style.display = 'block';
                            }
                        } else if (platform === 'dailymotion') {
                            const dmId = extractDailymotionIdFromUrl(mediaPath);
                            if (dmId) {
                                const iframe = document.getElementById('previewYoutube');
                                iframe.src = `https://www.dailymotion.com/embed/video/${dmId}`;
                                iframe.style.display = 'block';
                            }
                        } else {
                            // Direct video file
                            const video = document.getElementById('previewVideo');
                            video.src = mediaPath;
                            video.style.display = 'block';
                        }
                    } else if (mediaType === 'voice' || mediaType === 'audio') {
                        const audio = document.getElementById('previewAudio');
                        audio.src = mediaPath;
                        document.getElementById('previewAudioContainer').style.display = 'block';
                    } else {
                        const docContainer = document.getElementById('previewDocumentContainer');
                        const docNameEl = document.getElementById('previewDocumentName');
                        const docIconEl = document.getElementById('previewDocumentIcon');
                        const pdfFrameEl = document.getElementById('previewPdf');

                        if (docNameEl) docNameEl.textContent = mediaName || 'ملف';

                        // Detect PDF by extension (ignore query string)
                        let isPdf = false;
                        if (typeof mediaPath === 'string') {
                            const cleanPath = mediaPath.split('?')[0].toLowerCase();
                            isPdf = cleanPath.endsWith('.pdf');
                        }

                        if (isPdf && pdfFrameEl) {
                            // Show inline PDF viewer
                            if (docIconEl) docIconEl.style.display = 'none';
                            pdfFrameEl.src = mediaPath;
                            pdfFrameEl.style.display = 'block';
                        } else {
                            // Fallback: just show icon + name
                            if (docIconEl) docIconEl.style.display = 'block';
                            if (pdfFrameEl) pdfFrameEl.style.display = 'none';
                        }

                        if (docContainer) docContainer.style.display = 'block';
                    }

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('previewMediaModal'));
                    modal.show();
                });
            });

            // Edit media buttons - FIXED VERSION
            document.querySelectorAll('.edit-media').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const mediaId = this.getAttribute('data-media-id');
                    const mediaName = this.getAttribute('data-media-name');
                    const mediaAlt = this.getAttribute('data-media-alt');

                    console.log('Editing media:', {
                        mediaId,
                        mediaName,
                        mediaAlt
                    }); // Debug log

                    // Set form values
                    document.getElementById('editName').value = mediaName || '';
                    document.getElementById('editAlt').value = mediaAlt || '';

                    // Update form action
                    const form = document.getElementById('editMediaForm');
                    form.action = "{{ route('dashboard.media.update', ':id') }}".replace(':id', mediaId);

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('editMediaModal'));
                    modal.show();
                });
            });

            // Delete media buttons
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (this.disabled) return;

                    const form = this.closest('.delete-form');
                    const titleAr = this.getAttribute('data-ar-title');
                    const titleEn = this.getAttribute('data-en-title');
                    const textAr = this.getAttribute('data-ar-text');
                    const textEn = this.getAttribute('data-en-text');
                    const confirmAr = this.getAttribute('data-ar-confirm');
                    const confirmEn = this.getAttribute('data-en-confirm');
                    const cancelAr = this.getAttribute('data-ar-cancel');
                    const cancelEn = this.getAttribute('data-en-cancel');

                    Swal.fire({
                        title: getLangText(titleAr, titleEn),
                        text: getLangText(textAr, textEn),
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: getLangText(confirmAr, confirmEn),
                        cancelButtonText: getLangText(cancelAr, cancelEn)
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Copy link buttons (for documents/PDFs)
            document.querySelectorAll('.copy-link-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const path = this.getAttribute('data-path');
                    if (!path) return;

                    const copyText = path;

                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(copyText)
                            .then(() => {
                                showAlert('success', 'تم نسخ رابط الملف', 'File link copied');
                            })
                            .catch(() => {
                                fallbackCopyText(copyText);
                            });
                    } else {
                        fallbackCopyText(copyText);
                    }
                });
            });

            function fallbackCopyText(text) {
                const tempInput = document.createElement('input');
                tempInput.value = text;
                document.body.appendChild(tempInput);
                tempInput.select();
                try {
                    document.execCommand('copy');
                    showAlert('success', 'تم نسخ رابط الملف', 'File link copied');
                } catch (err) {
                    console.error('Copy failed', err);
                    showAlert('error', 'تعذر نسخ الرابط', 'Unable to copy link');
                }
                document.body.removeChild(tempInput);
            }
        }

        // Handle edit form submission - FIXED VERSION
        function initializeEditForm() {
            const editForm = document.getElementById('editMediaForm');
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = document.getElementById('editSubmitBtn');
                    const originalText = submitBtn.innerHTML;

                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<em class="icon ni ni-loader"></em><span>جاري التحديث...</span>';

                    console.log('Submitting form to:', this.action); // Debug log
                    console.log('Form data:', Object.fromEntries(formData)); // Debug log

                    fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Response data:', data); // Debug log
                            if (data.success) {
                                showAlert('success', 'تم تحديث الوسائط بنجاح', 'Media updated successfully');
                                bootstrap.Modal.getInstance(document.getElementById('editMediaModal')).hide();

                                // Reload the media grid to reflect changes
                                setTimeout(() => {
                                    loadMediaWithFilters();
                                }, 1000);
                            } else {
                                const errorMessage = data.message || 'فشل تحديث الوسائط';
                                showAlert('error', errorMessage, errorMessage);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showAlert('error', 'حدث خطأ أثناء التحديث', 'An error occurred during update');
                        })
                        .finally(() => {
                            // Reset button state
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        });
                });
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeMediaInteractions();
            initializeEditForm(); // Initialize the edit form handler

            // Show success/error messages from session
            @if (session('success'))
                showAlert('success', '{{ session('success') }}', 'Operation completed successfully');
            @endif

            @if (session('error') || $errors->any())
                showAlert('error', '{{ session('error') ?? $errors->first() }}', 'An error occurred');
            @endif

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
        });
    </script>
@endsection
