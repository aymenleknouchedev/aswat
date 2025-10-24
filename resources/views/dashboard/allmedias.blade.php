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
                                        <!-- Media Grid -->
                                        <div class="row g-3" id="mediaGrid">
                                            @if ($medias->isEmpty())
                                                @include('dashboard.media.empty-state')
                                            @else
                                                @foreach ($medias as $media)
                                                    <div class="col-xl-5th col-lg-4 col-md-6 col-12">
                                                        <div class="card media-card" data-media-path="{{ $media->path }}">
                                                            <div class="card-inner">
                                                                <!-- Media Preview -->
                                                                <div class="media-preview">
                                                                    @if ($media->media_type === 'image')
                                                                        <img src="{{ $media->path }}"
                                                                            alt="{{ $media->alt }}" loading="lazy">
                                                                    @elseif($media->media_type === 'video')
                                                                        <video controls>
                                                                            <source src="{{ $media->path }}"
                                                                                type="video/mp4">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    @elseif($media->media_type === 'audio')
                                                                        <div class="audio-preview">
                                                                            <em class="icon ni ni-audio"></em>
                                                                            <div class="audio-title">{{ $media->name }}
                                                                            </div>
                                                                            <audio controls>
                                                                                <source src="{{ $media->path }}"
                                                                                    type="audio/mpeg">
                                                                                Your browser does not support the audio
                                                                                element.
                                                                            </audio>
                                                                        </div>
                                                                    @else
                                                                        <div class="document-preview">
                                                                            <em class="icon ni ni-file-text"></em>
                                                                            <div class="document-title">{{ $media->name }}
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <!-- Media Info -->
                                                                <div class="media-info">
                                                                    <h6 class="media-name">{{ $media->name }}</h6>
                                                                    <p class="media-alt">{{ $media->alt }}</p>
                                                                    <div class="media-meta">
                                                                        <span>{{ $media->extension }}</span>
                                                                        <span>{{ $media->size }}</span>
                                                                    </div>
                                                                </div>

                                                                <!-- Media Actions -->
                                                                <div class="media-actions">
                                                                    <button
                                                                        class="btn btn-dim btn-sm btn-outline-primary btn-edit edit-media"
                                                                        data-media-id="{{ $media->id }}"
                                                                        data-media-name="{{ $media->name }}"
                                                                        data-media-alt="{{ $media->alt }}">
                                                                        <em class="icon ni ni-edit"></em>
                                                                        <span>تعديل</span>
                                                                    </button>
                                                                    <form
                                                                        action="{{ route('dashboard.media.destroy', $media->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-dim btn-sm btn-outline-danger btn-delete"
                                                                            onclick="return confirm('هل أنت متأكد من حذف هذا الملف؟')">
                                                                            <em class="icon ni ni-trash"></em>
                                                                            <span>حذف</span>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
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
                                    <label class="form-label" for="editName" data-en="Name" data-ar="الاسم">الاسم</label>
                                    <input required type="text" class="form-control" id="editName" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="editAlt" data-en="Alt Text"
                                        data-ar="النص البديل">النص
                                        البديل</label>
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
        /* Media Cards */
        .media-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            border: 1px solid #e5e9f2;
            height: 100%;
        }

        .media-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
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
            padding: 10px;
        }

        .media-preview img,
        .media-preview video {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
            border-radius: 4px;
        }

        .media-card:hover .media-preview img,
        .media-card:hover .media-preview video {
            transform: scale(1.02);
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
            padding: 15px;
            border-radius: 4px;
        }

        .audio-preview .icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .audio-preview .audio-title {
            font-size: 0.85rem;
            text-align: center;
            word-break: break-word;
            margin-bottom: 10px;
        }

        .audio-preview audio {
            width: 100%;
            height: 40px;
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
            border-radius: 4px;
        }

        .document-preview .icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #526484;
        }

        .document-preview .document-title {
            font-size: 0.85rem;
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

        /* 5 cards per row */
        @media (min-width: 1200px) {
            .col-xl-5th {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 1199px) and (min-width: 992px) {
            .col-lg-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }

        @media (max-width: 991px) and (min-width: 768px) {
            .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 767px) {
            .col-12 {
                flex: 0 0 100%;
                max-width: 100%;
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

            // Handle media selection from MMX modal
            window.mediaTabManager = {
                onMediaSelected: function(payload) {
                    // Refresh the page to show the newly uploaded media
                    window.location.reload();
                }
            };

            // Auto-play videos on hover
            document.querySelectorAll('.media-preview video').forEach(video => {
                video.addEventListener('mouseenter', function() {
                    this.play();
                });

                video.addEventListener('mouseleave', function() {
                    this.pause();
                    this.currentTime = 0;
                });
            });
        });
    </script>
@endsection
