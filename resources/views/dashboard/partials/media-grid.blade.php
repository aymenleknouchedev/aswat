<style>
    /* Ensure taller cards without changing preview image height */
    .media-card.media-card--tall {
        display: flex;
    }
    .media-card .card-inner {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .media-card .media-actions {
        margin-top: auto;
    }
</style>

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
            <div class="card media-card media-card--tall">
                <div class="card-inner">
                    <!-- Media Preview with 16:9 Ratio (Clickable) -->
                    <div class="media-preview-container preview-media" role="button" tabindex="0" style="cursor: pointer;"
                        data-media-id="{{ $media->id }}" data-media-name="{{ $media->name }}"
                        data-media-alt="{{ $media->alt }}" data-media-type="{{ $media->media_type }}"
                        data-path="{{ $media->path }}">
                        @if ($media->media_type === 'image')
                            <div class="media-preview-16-9"
                                style="width: 100%; height: 180px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                <img src="{{ $media->path }}" alt="{{ $media->alt }}" loading="lazy"
                                    style="max-width: 100%; max-height: 100%; object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        @elseif($media->media_type === 'video')
                            <div class="media-preview-16-9"
                                style="width: 100%; height: 180px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <div style="text-align: center; color: white;">
                                    <em class="icon ni ni-play-circle" style="font-size: 4rem; margin-bottom: 0.5rem;"></em>
                                    <div style="font-size: 0.875rem; font-weight: 500;">انقر للتشغيل</div>
                                </div>
                            </div>
                        @elseif($media->media_type === 'voice')
                            <div class="media-preview-16-9"
                                style="width: 100%; height: 180px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <div style="text-align: center; color: white;">
                                    <em class="icon ni ni-volume" style="font-size: 4rem; margin-bottom: 0.5rem;"></em>
                                    <div style="font-size: 0.875rem; font-weight: 500;">انقر للاستماع</div>
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
                        <h6 class="media-name" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 0.5rem;">{{ $media->name }}</h6>
                        <div class="media-date text-muted" style="font-size: 0.8rem; display:flex; align-items:center; gap:.35rem;">
                            <em class="icon ni ni-calendar"></em>
                            <span>تاريخ الإضافة: {{ optional($media->created_at)->format('Y-m-d H:i') }}</span>
                        </div>
                        @if($media->user)
                            <div class="media-user text-muted" style="font-size: 0.8rem; display:flex; align-items:center; gap:.35rem;">
                                <em class="icon ni ni-user"></em>
                                <span>أضيف بواسطة: {{ $media->user->name }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Media Actions -->
                    <div class="media-actions">
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
                                @if($media->contents->isNotEmpty() || $media->writer->isNotEmpty() || $media->window->isNotEmpty() || $media->user->isNotEmpty() || $media->trend->isNotEmpty() ) disabled title="هذه الوسائط مرتبطة بمحتوى ولا يمكن حذفها" @endif
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
