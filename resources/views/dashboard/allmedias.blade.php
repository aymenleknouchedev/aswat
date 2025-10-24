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
                                                <h3 class="nk-block-title page-title" data-en="Media" data-ar="الوسائط">
                                                    الوسائط
                                                </h3>
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
                                                            <!-- Upload File Button -->
                                                            <li class="nk-block-tools-opt">
                                                                <button id="openMediaModal" class="btn btn-primary">
                                                                    <em class="icon ni ni-plus"></em>
                                                                    <span data-en="Add Media" data-ar="رفع ملف">رفع
                                                                        ملف</span>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <!-- Media Type Tabs -->
                                        <div class="mb-4">
                                            <ul class="nav nav-tabs media-type-tabs" id="mediaTypeTabs" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                                        data-bs-target="#all" type="button" role="tab"
                                                        aria-controls="all" aria-selected="true">
                                                        <em class="icon ni ni-grid"></em>
                                                        <span data-en="All" data-ar="الكل">الكل</span>
                                                        <span
                                                            class="badge badge-pill badge-dim bg-light">{{ $medias->count() }}</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="images-tab" data-bs-toggle="tab"
                                                        data-bs-target="#images" type="button" role="tab"
                                                        aria-controls="images" aria-selected="false">
                                                        <em class="icon ni ni-image"></em>
                                                        <span data-en="Images" data-ar="الصور">الصور</span>
                                                        <span
                                                            class="badge badge-pill badge-dim bg-light">{{ $images->count() }}</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="videos-tab" data-bs-toggle="tab"
                                                        data-bs-target="#videos" type="button" role="tab"
                                                        aria-controls="videos" aria-selected="false">
                                                        <em class="icon ni ni-play-circle"></em>
                                                        <span data-en="Videos" data-ar="الفيديوهات">الفيديوهات</span>
                                                        <span
                                                            class="badge badge-pill badge-dim bg-light">{{ $videos->count() }}</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="audio-tab" data-bs-toggle="tab"
                                                        data-bs-target="#audio" type="button" role="tab"
                                                        aria-controls="audio" aria-selected="false">
                                                        <em class="icon ni ni-music"></em>
                                                        <span data-en="Audio" data-ar="الصوتيات">الصوتيات</span>
                                                        <span
                                                            class="badge badge-pill badge-dim bg-light">{{ $audio->count() }}</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="documents-tab" data-bs-toggle="tab"
                                                        data-bs-target="#documents" type="button" role="tab"
                                                        aria-controls="documents" aria-selected="false">
                                                        <em class="icon ni ni-file-text"></em>
                                                        <span data-en="Documents" data-ar="المستندات">المستندات</span>
                                                        <span
                                                            class="badge badge-pill badge-dim bg-light">{{ $documents->count() }}</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Tab Content -->
                                        <div class="tab-content" id="mediaTypeTabsContent">
                                            <!-- All Media -->
                                            <div class="tab-pane fade show active" id="all" role="tabpanel"
                                                aria-labelledby="all-tab">
                                                @if ($medias->isEmpty())
                                                    @include('dashboard.media.empty-state')
                                                @else
                                                    <div class="row g-3" id="mediaGrid">
                                                        @foreach ($medias as $media)
                                                            @include('dashboard.media.media-card', [
                                                                'media' => $media,
                                                            ])
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Images -->
                                            <div class="tab-pane fade" id="images" role="tabpanel"
                                                aria-labelledby="images-tab">
                                                @if ($images->isEmpty())
                                                    @include('dashboard.media.empty-state', [
                                                        'type' => 'images',
                                                    ])
                                                @else
                                                    <div class="row g-3" id="imagesGrid">
                                                        @foreach ($images as $media)
                                                            @include('dashboard.media.media-card', [
                                                                'media' => $media,
                                                            ])
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Videos -->
                                            <div class="tab-pane fade" id="videos" role="tabpanel"
                                                aria-labelledby="videos-tab">
                                                @if ($videos->isEmpty())
                                                    @include('dashboard.media.empty-state', [
                                                        'type' => 'videos',
                                                    ])
                                                @else
                                                    <div class="row g-3" id="videosGrid">
                                                        @foreach ($videos as $media)
                                                            @include('dashboard.media.media-card', [
                                                                'media' => $media,
                                                            ])
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Audio -->
                                            <div class="tab-pane fade" id="audio" role="tabpanel"
                                                aria-labelledby="audio-tab">
                                                @if ($audio->isEmpty())
                                                    @include('dashboard.media.empty-state', [
                                                        'type' => 'audio',
                                                    ])
                                                @else
                                                    <div class="row g-3" id="audioGrid">
                                                        @foreach ($audio as $media)
                                                            @include('dashboard.media.media-card', [
                                                                'media' => $media,
                                                            ])
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Documents -->
                                            <div class="tab-pane fade" id="documents" role="tabpanel"
                                                aria-labelledby="documents-tab">
                                                @if ($documents->isEmpty())
                                                    @include('dashboard.media.empty-state', [
                                                        'type' => 'documents',
                                                    ])
                                                @else
                                                    <div class="row g-3" id="documentsGrid">
                                                        @foreach ($documents as $media)
                                                            @include('dashboard.media.media-card', [
                                                                'media' => $media,
                                                            ])
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $medias->links() }}
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
                    <h5 class="modal-title" data-en="Edit Media" data-ar="تعديل الوسائط">تعديل الوسائط</h5>
                    <form id="editMediaForm" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="editName" data-en="Name"
                                        data-ar="الاسم">الاسم</label>
                                    <input required type="text" class="form-control" id="editName" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="editAlt" data-en="Alt Text"
                                        data-ar="النص البديل">النص البديل</label>
                                    <input required type="text" class="form-control" id="editAlt" name="alt">
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-primary" data-en="Update"
                                            data-ar="تحديث">تحديث</button>
                                    </li>
                                    <li>
                                        <a href="#" class="link link-gray" data-bs-dismiss="modal"
                                            data-en="Cancel" data-ar="إلغاء">إلغاء</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include MMX Media Modal -->
    @include('dashboard.components.media-modal')

    <style>
        /* Media Type Tabs */
        .media-type-tabs {
            border-bottom: 1px solid #e5e9f2;
        }

        .media-type-tabs .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            color: #526484;
            border: none;
            border-radius: 4px 4px 0 0;
            margin-bottom: -1px;
            transition: all 0.3s ease;
        }

        .media-type-tabs .nav-link:hover {
            background-color: #f8f9fa;
            color: #364a63;
        }

        .media-type-tabs .nav-link.active {
            background-color: #fff;
            color: #6576ff;
            border-bottom: 2px solid #6576ff;
        }

        .media-type-tabs .badge {
            font-size: 0.7rem;
            margin-left: 4px;
        }

        /* Media Cards */
        .media-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e9f2;
            height: 100%;
        }

        .media-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-inner {
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .media-preview {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
        }

        .media-preview img,
        .media-preview video {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .media-card:hover .media-preview img,
        .media-card:hover .media-preview video {
            transform: scale(1.05);
        }

        .media-preview::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.05), transparent);
            pointer-events: none;
        }

        .file-placeholder {
            text-align: center;
            color: #6c757d;
            padding: 20px;
        }

        .file-placeholder .icon {
            font-size: 3.5rem;
            display: block;
            margin-bottom: 10px;
            color: #6576ff;
        }

        .audio-preview {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6576ff 0%, #8a5ced 100%);
            color: white;
            padding: 20px;
        }

        .audio-preview .icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .audio-preview .audio-title {
            font-size: 0.9rem;
            text-align: center;
            word-break: break-word;
        }

        .document-preview {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            position: relative;
        }

        .document-preview .icon {
            font-size: 3.5rem;
            margin-bottom: 15px;
            color: #526484;
        }

        .document-preview .document-title {
            font-size: 0.9rem;
            text-align: center;
            word-break: break-word;
            color: #364a63;
        }

        .media-info {
            padding: 15px;
            flex-grow: 1;
        }

        .media-name {
            font-weight: 600;
            margin-bottom: 8px;
            word-break: break-word;
            color: #364a63;
            font-size: 1rem;
            line-height: 1.4;
        }

        .media-alt {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 12px;
            word-break: break-word;
            line-height: 1.4;
        }

        .media-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.75rem;
            color: #8f9bba;
        }

        .media-actions {
            display: flex;
            gap: 8px;
            padding: 0 15px 15px;
        }

        .media-actions .btn {
            flex: 1;
            border-radius: 6px;
            font-size: 0.8rem;
            padding: 6px 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.2s ease;
        }

        .btn-delete:hover {
            background-color: #dc3545 !important;
            color: #fff !important;
            border-color: #dc3545 !important;
        }

        .btn-edit:hover {
            background-color: #6576ff !important;
            color: #fff !important;
            border-color: #6576ff !important;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #8f9bba;
        }

        .empty-state .icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #e5e9f2;
        }

        .empty-state h5 {
            margin-bottom: 10px;
            color: #526484;
        }

        .empty-state p {
            max-width: 400px;
            margin: 0 auto;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .media-type-tabs .nav-link {
                padding: 10px 12px;
                font-size: 0.85rem;
            }

            .media-preview {
                height: 180px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Open MMX Media Modal
            document.getElementById('openMediaModal').addEventListener('click', function() {
                window.mmxMediaModalManager.openModal();
            });

            // Edit Media
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-media')) {
                    const button = e.target.closest('.edit-media');
                    const mediaId = button.getAttribute('data-media-id');
                    const mediaName = button.getAttribute('data-media-name');
                    const mediaAlt = button.getAttribute('data-media-alt');

                    document.getElementById('editName').value = mediaName;
                    document.getElementById('editAlt').value = mediaAlt;

                    const form = document.getElementById('editMediaForm');
                    form.action = `/dashboard/media/${mediaId}`;

                    const modal = new bootstrap.Modal(document.getElementById('editMediaModal'));
                    modal.show();
                }
            });

            // Delete Confirmation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-btn')) {
                    const button = e.target.closest('.delete-btn');
                    if (confirm('هل أنت متأكد من حذف هذا الوسائط؟')) {
                        button.closest('form').submit();
                    }
                }
            });

            // Handle media selection from MMX modal
            window.mediaTabManager = {
                onMediaSelected: function(payload) {
                    // Refresh the page to show the newly uploaded media
                    window.location.reload();
                }
            };
        });
    </script>
@endsection
