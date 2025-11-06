@if ($medias->isEmpty())
    <div class="col-12">
        <div class="empty-state">
            <div class="icon">
                <em class="icon ni ni-folder-open"></em>
            </div>
            @if (request()->hasAny(['search', 'type', 'sort']))
                <h5>لا توجد نتائج</h5>
                <p>حاول تعديل معايير البحث أو الفلترة.</p>
            @else
                <h5>لا توجد وسائط</h5>
                <p>لم تقم برفع أي وسائط بعد. انقر على الزر أعلاه لإضافة أول ملف وسائطي لك.</p>
            @endif
        </div>
    </div>
@else
    @foreach ($medias as $media)
        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="card media-card">
                <div class="card-inner">
                    <!-- Media Preview with 16:9 Ratio -->
                    <div class="media-preview-container">
                        @if ($media->media_type === 'image')
                            <div class="media-preview-16-9"
                                style="width: 100%; height: 180px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                <img src="{{ $media->path }}" alt="{{ $media->alt }}" loading="lazy"
                                    style="max-width: 100%; max-height: 100%; object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        @elseif($media->media_type === 'video')
                            @if (str_contains($media->path, 'youtube.com') || str_contains($media->path, 'youtu.be'))
                                <div class="media-preview-16-9" style="width: 100%; height: 180px;">
                                    <div class="youtube-player" data-youtube-id="{{ extractYouTubeId($media->path) }}"
                                        style="width: 100%; height: 100%;">
                                    </div>
                                </div>
                            @else
                                <div class="media-preview-16-9" style="width: 100%; height: 180px;">
                                    <video controls style="width: 100%; height: 100%; object-fit: cover;">
                                        <source src="{{ $media->path }}" type="video/mp4">
                                        <span>متصفحك لا يدعم تشغيل الفيديو</span>
                                    </video>
                                </div>
                            @endif
                        @elseif($media->media_type === 'audio')
                            <div class="media-preview-16-9 audio-preview"
                                style="width: 100%; height: 180px; display: flex; align-items: center; justify-content: center;">
                                <div class="audio-content">
                                    <em class="icon ni ni-audio"></em>
                                    <div class="audio-title">{{ $media->name }}</div>
                                    <audio controls>
                                        <source src="{{ $media->path }}" type="audio/mpeg">
                                        <span>متصفحك لا يدعم تشغيل الصوت</span>
                                    </audio>
                                </div>
                            </div>
                        @else
                            <div class="media-preview-16-9 document-preview"
                                style="width: 100%; height: 180px; display: flex; align-items: center; justify-content: center;">
                                <div class="document-content">
                                    <em class="icon ni ni-file-text"></em>
                                    <div class="document-title">{{ $media->name }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Media Info -->
                    <div class="media-info my-2">
                        <h6 class="media-name">{{ \Illuminate\Support\Str::limit($media->name, 30) }}</h6>
                        <p class="media-alt">{{ $media->alt ?: 'لا يوجد نص بديل' }}</p>
                    </div>

                    <!-- Media Actions -->
                    <div class="media-actions">
                        <button class="btn btn-dim btn-sm btn-outline-info btn-preview preview-media"
                            data-media-id="{{ $media->id }}" data-media-name="{{ $media->name }}"
                            data-media-alt="{{ $media->alt }}" data-media-type="{{ $media->media_type }}"
                            data-path="{{ $media->path }}" title="معاينة الوسائط">
                            <em class="icon ni ni-eye"></em>
                            <span>معاينة</span>
                        </button>
                        <button class="btn btn-dim btn-sm btn-outline-primary btn-edit edit-media"
                            data-media-id="{{ $media->id }}" data-media-name="{{ $media->name }}"
                            data-media-alt="{{ $media->alt }}" data-media-type="{{ $media->type }}"
                            data-path="{{ $media->path }}">
                            <em class="icon ni ni-edit"></em>
                            <span>تعديل</span>
                        </button>
                        <form action="{{ route('dashboard.media.destroy', $media->id) }}" method="POST"
                            class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-dim btn-sm btn-outline-danger delete-btn"
                                @if($media->contents->isNotEmpty()) disabled title="هذه الوسائط مرتبطة بمحتوى ولا يمكن حذفها" @endif
                                data-ar-title="تأكيد الحذف" data-en-title="Confirm Deletion"
                                data-ar-text="هل أنت متأكد من حذف هذه الوسائط؟" data-en-text="Are you sure you want to delete this media?"
                                data-ar-confirm="نعم، احذف" data-en-confirm="Yes, delete"
                                data-ar-cancel="إلغاء" data-en-cancel="Cancel">
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
