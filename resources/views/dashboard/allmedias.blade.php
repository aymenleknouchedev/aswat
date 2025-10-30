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
                                                <div class="col-12">
                                                    <div class="empty-state">
                                                        <div class="icon">
                                                            <em class="icon ni ni-folder-open"></em>
                                                        </div>
                                                        <h5 data-en="No Media Found" data-ar="لا توجد وسائط">لا توجد وسائط
                                                        </h5>
                                                        <p data-en="You have not uploaded any media yet. Click the button above to add your first media file."
                                                            data-ar="لم تقم برفع أي وسائط بعد. انقر على الزر أعلاه لإضافة أول ملف وسائطي لك.">
                                                            لم تقم برفع أي وسائط بعد. انقر على الزر أعلاه لإضافة أول ملف
                                                            وسائطي لك.
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                @foreach ($medias as $media)
                                                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                                        <div class="card media-card" data-media-path="{{ $media->path }}">
                                                            <div class="card-inner">
                                                                <!-- Media Preview with 16:9 Ratio -->
                                                                <div class="media-preview-container">
                                                                    @if ($media->media_type === 'image')
                                                                        <div class="media-preview-16-9">
                                                                            <img src="{{ $media->path }}"
                                                                                alt="{{ $media->alt }}" loading="lazy">
                                                                        </div>
                                                                    @elseif($media->media_type === 'video')
                                                                        @if ($media->is_youtube)
                                                                            <div class="media-preview-16-9">
                                                                                <div class="youtube-player"
                                                                                    data-youtube-id="{{ $media->youtube_id }}">
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="media-preview-16-9">
                                                                                <video controls>
                                                                                    <source src="{{ $media->path }}"
                                                                                        type="video/mp4">
                                                                                    <span
                                                                                        data-en="Your browser does not support the video tag"
                                                                                        data-ar="متصفحك لا يدعم تشغيل الفيديو">
                                                                                        متصفحك لا يدعم تشغيل الفيديو
                                                                                    </span>
                                                                                </video>
                                                                            </div>
                                                                        @endif
                                                                    @elseif($media->media_type === 'audio')
                                                                        <div class="media-preview-16-9 audio-preview">
                                                                            <div class="audio-content">
                                                                                <em class="icon ni ni-audio"></em>
                                                                                <div class="audio-title">{{ $media->name }}
                                                                                </div>
                                                                                <audio controls>
                                                                                    <source src="{{ $media->path }}"
                                                                                        type="audio/mpeg">
                                                                                    <span
                                                                                        data-en="Your browser does not support the audio element"
                                                                                        data-ar="متصفحك لا يدعم تشغيل الصوت">
                                                                                        متصفحك لا يدعم تشغيل الصوت
                                                                                    </span>
                                                                                </audio>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="media-preview-16-9 document-preview">
                                                                            <div class="document-content">
                                                                                <em class="icon ni ni-file-text"></em>
                                                                                <div class="document-title">{{ $media->name }}
                                                                                </div>
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
                                                                        data-media-alt="{{ $media->alt }}"
                                                                        data-media-type="{{ $media->media_type }}"
                                                                        data-is-youtube="{{ $media->is_youtube ? 'true' : 'false' }}"
                                                                        data-youtube-id="{{ $media->youtube_id ?? '' }}">
                                                                        <em class="icon ni ni-edit"></em>
                                                                        <span data-en="Edit" data-ar="تعديل">تعديل</span>
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
                                                                            <span data-en="Delete" data-ar="حذف">حذف</span>
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
                            <!-- YouTube ID Field (Conditional) -->
                            <div class="col-12" id="youtubeIdField" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label" for="editYoutubeId" data-en="YouTube ID"
                                        data-ar="معرف يوتيوب">معرف يوتيوب</label>
                                    <input type="text" class="form-control" id="editYoutubeId" name="youtube_id">
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
            transition: transform 0.3s ease;
            overflow: hidden;
            border: 1px solid var(--border-light);
            height: 100%;
            border-radius: 0;
            box-shadow: none;
        }

        .media-card:hover {
            transform: translateY(-2px);
        }

        .card-inner {
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* 16:9 Ratio Container */
        .media-preview-container {
            position: relative;
            width: 100%;
        }

        .media-preview-16-9 {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 9/16 * 100% = 56.25% */
            height: 0;
            overflow: hidden;
            background: var(--bg-light);
        }

        .media-preview-16-9 img,
        .media-preview-16-9 video,
        .media-preview-16-9 .youtube-player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .media-card:hover .media-preview-16-9 img,
        .media-card:hover .media-preview-16-9 video {
            transform: scale(1.02);
        }

        /* Audio Preview in 16:9 */
        .media-preview-16-9.audio-preview {
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-gradient);
            color: white;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .audio-content {
            text-align: center;
            padding: 15px;
            width: 100%;
        }

        .audio-preview .icon {
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .audio-preview .audio-title {
            font-size: 0.8rem;
            text-align: center;
            word-break: break-word;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .audio-preview audio {
            width: 100%;
            height: 30px;
        }

        /* Document Preview in 16:9 */
        .media-preview-16-9.document-preview {
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-light);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .document-content {
            text-align: center;
            padding: 15px;
        }

        .document-preview .icon {
            font-size: 2.5rem;
            margin-bottom: 8px;
            color: var(--color-dark);
        }

        .document-preview .document-title {
            font-size: 0.8rem;
            text-align: center;
            word-break: break-word;
            color: var(--color-dark);
            line-height: 1.3;
        }

        /* YouTube Player */
        .youtube-player {
            position: relative;
            background: #000;
            cursor: pointer;
        }

        .youtube-player::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 68px;
            height: 48px;
            background: #ff0000;
            border-radius: 0;
            z-index: 1;
        }

        .youtube-player::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-35%, -50%);
            border-style: solid;
            border-width: 10px 0 10px 16px;
            border-color: transparent transparent transparent #fff;
            z-index: 2;
        }

        .youtube-player.loaded::before,
        .youtube-player.loaded::after {
            display: none;
        }

        /* Media Info */
        .media-info {
            padding: 15px;
            flex-grow: 1;
        }

        .media-name {
            font-weight: 600;
            margin-bottom: 8px;
            word-break: break-word;
            color: var(--color-dark);
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .media-alt {
            color: var(--color-light);
            font-size: 0.8rem;
            margin-bottom: 12px;
            word-break: break-word;
            line-height: 1.4;
        }

        .media-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.75rem;
            color: var(--color-light);
        }

        /* Media Actions */
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
            border-radius: 0;
        }

        .btn-delete:hover {
            background-color: var(--danger-color) !important;
            color: #fff !important;
            border-color: var(--danger-color) !important;
        }

        .btn-edit:hover {
            background-color: var(--accent-color) !important;
            color: #fff !important;
            border-color: var(--accent-color) !important;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--color-light);
        }

        .empty-state .icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--border-light);
        }

        .empty-state h5 {
            margin-bottom: 10px;
            color: var(--color-dark);
        }

        .empty-state p {
            max-width: 400px;
            margin: 0 auto;
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
        }

        /* Dark mode variables */
        :root {
            --bg-light: #f8f9fa;
            --border-light: #e5e9f2;
            --color-light: #8f9bba;
            --color-dark: #364a63;
            --accent-color: #6576ff;
            --accent-gradient: linear-gradient(135deg, #6576ff 0%, #8a5ced 100%);
            --danger-color: #dc3545;
        }

        [data-theme="dark"] {
            --bg-light: #1e1e2d;
            --border-light: #2d2d43;
            --color-light: #8f9bba;
            --color-dark: #f5f6fa;
            --accent-color: #6576ff;
            --accent-gradient: linear-gradient(135deg, #6576ff 0%, #8a5ced 100%);
            --danger-color: #dc3545;
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
                    const mediaType = button.getAttribute('data-media-type');
                    const isYoutube = button.getAttribute('data-is-youtube') === 'true';
                    const youtubeId = button.getAttribute('data-youtube-id');

                    document.getElementById('editName').value = mediaName;
                    document.getElementById('editAlt').value = mediaAlt;

                    // Show/hide YouTube ID field based on media type
                    const youtubeField = document.getElementById('youtubeIdField');
                    if (mediaType === 'video' && isYoutube) {
                        youtubeField.style.display = 'block';
                        document.getElementById('editYoutubeId').value = youtubeId;
                    } else {
                        youtubeField.style.display = 'none';
                        document.getElementById('editYoutubeId').value = '';
                    }

                    const form = document.getElementById('editMediaForm');
                    form.action = "{{ route('dashboard.media.update', ':id') }}".replace(':id', mediaId);

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

            // Initialize YouTube players
            document.querySelectorAll('.youtube-player').forEach(player => {
                const youtubeId = player.getAttribute('data-youtube-id');
                player.addEventListener('click', function() {
                    const iframe = document.createElement('iframe');
                    iframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1`;
                    iframe.allow = 'autoplay; encrypted-media';
                    iframe.allowFullscreen = true;

                    player.innerHTML = '';
                    player.appendChild(iframe);
                    player.classList.add('loaded');
                });
            });

            // Auto-play videos on hover
            document.querySelectorAll('.media-preview-16-9 video').forEach(video => {
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