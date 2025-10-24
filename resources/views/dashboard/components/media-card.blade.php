<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
    <div class="card card-bordered media-card">
        <div class="card-inner">
            <div class="media-preview">
                @if ($media->media_type === 'image/jpeg' || $media->media_type === 'image/png' || 
                      $media->media_type === 'image/gif' || $media->media_type === 'image/bmp' || 
                      $media->media_type === 'image/svg+xml' || $media->media_type === 'url')
                    <img class="w-100" src="{{ $media->path }}" alt="{{ $media->alt }}">
                @elseif ($media->media_type === 'video/mp4' || $media->media_type === 'video/quicktime')
                    <video class="w-100" controls>
                        <source src="{{ $media->path }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif ($media->media_type === 'audio/mpeg' || $media->media_type === 'audio/wav')
                    <div class="audio-preview">
                        <em class="icon ni ni-music"></em>
                        <div class="audio-title">{{ $media->name }}</div>
                    </div>
                @else
                    <div class="document-preview">
                        <em class="icon ni ni-file-text"></em>
                        <div class="document-title">{{ $media->name }}</div>
                    </div>
                @endif
            </div>
            <div class="media-info">
                <h6 class="media-name">{{ $media->name }}</h6>
                <p class="media-alt">{{ $media->alt }}</p>
                <div class="media-meta">
                    <small>
                        {{ $media->media_type }}
                    </small>
                    <small>
                        {{ $media->created_at->format('Y-m-d H:i') }}
                    </small>
                </div>
            </div>
            <div class="media-actions">
                <button class="btn btn-sm btn-light edit-media btn-edit"
                    data-media-id="{{ $media->id }}"
                    data-media-name="{{ $media->name }}"
                    data-media-alt="{{ $media->alt }}">
                    <em class="icon ni ni-edit"></em>
                    <span data-en="Edit" data-ar="تعديل">تعديل</span>
                </button>
                @if ($media->contents()->count() > 0)
                    <button class="btn btn-sm btn-light" disabled
                        title="Cannot delete: associated with content">
                        <em class="icon ni ni-cross"></em>
                        <span data-en="Delete" data-ar="حذف">حذف</span>
                    </button>
                @else
                    <form action="{{ route('dashboard.media.destroy', $media->id) }}"
                        method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="btn btn-sm btn-light delete-btn btn-delete"
                            title="Delete">
                            <em class="icon ni ni-cross"></em>
                            <span data-en="Delete" data-ar="حذف">حذف</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>