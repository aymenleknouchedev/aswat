<div id="media-video-field" class="media-fields-section" style="display: none;">

    <div class="row g-3">

        {{-- Main Image --}}
        <div class="col-md-3">
            <label for="video_main_image" class="form-label">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-video_main_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="video_main_image" id="video_main_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="video_main_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Mobile Image --}}
        <div class="col-md-3">
            <label for="video_mobile_image" class="form-label">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-video_mobile_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="video_mobile_image" id="video_mobile_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="video_mobile_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Content Image --}}
        <div class="col-md-3">
            <label for="video_content_image" class="form-label">صورة المحتوى التفصيلية</label>
            <div class="media-preview border rounded mb-2" id="preview-video_content_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="video_content_image" id="video_content_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="video_content_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Video Upload and URL --}}
        <div class="col-md-3">
            <label for="video_file" class="form-label">فيديو</label>
            <div id="preview-video_file" class="media-preview border rounded mb-2"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا يوجد فيديو محدد</span>
            </div>
            <div class="input-group ">
                <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="video_file"
                    data-type="video">
                    رفع / اختيار فيديو
                </button>
                <input hidden type="file" name="video_file" id="video_file">

                <input type="url" name="video_url" id="video_url" class="form-control"
                    placeholder="https://example.com/video.mp4">

            </div>

        </div>

    </div>

</div>

<style>
    @media (prefers-color-scheme: dark) {
        #media-video-field {
            color: #ddd;
        }

        #media-video-field .media-preview {
            background-color: #333 !important;
            border-color: #555 !important;
        }

        #media-video-field .btn-outline-primary {
            color: #aad4ff;
            border-color: #55aaff;
        }

        #media-video-field .btn-outline-primary:hover {
            background-color: #55aaff;
            color: #fff;
        }
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const videoUrlInput = document.getElementById('video_url');
        const videoPreview = document.getElementById('preview-video_file');

        function updateVideoPreview(url) {
            if (!url) {
                videoPreview.innerHTML = `<span class="text-muted">لا يوجد فيديو محدد</span>`;
                return;
            }

            // Check if YouTube URL
            const youtubeMatch = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/);
            if (youtubeMatch && youtubeMatch[1]) {
                const videoId = youtubeMatch[1];
                videoPreview.innerHTML = `
            <iframe width="100%" height="140" 
                src="https://www.youtube.com/embed/${videoId}" 
                frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
        `;
                return;
            }

            // Check if URL is direct video file
            const validExtensions = ['mp4', 'webm', 'ogg', 'mov', 'mkv'];
            const urlLower = url.toLowerCase();
            const isValidVideo = validExtensions.some(ext => urlLower.endsWith(ext));

            if (!isValidVideo) {
                videoPreview.innerHTML = `<span class="text-danger">رابط غير صالح لفيديو</span>`;
                return;
            }

            // Show HTML5 video player for direct video files
            videoPreview.innerHTML = `
        <video controls style="max-height: 140px; max-width: 100%;">
            <source src="${url}" type="video/mp4">
            متصفحك لا يدعم عرض الفيديو.
        </video>
    `;
        }


        // Update preview when input changes (on input or on blur)
        videoUrlInput.addEventListener('input', () => {
            updateVideoPreview(videoUrlInput.value.trim());
        });

        // Initialize preview on page load if input has value
        if (videoUrlInput.value.trim()) {
            updateVideoPreview(videoUrlInput.value.trim());
        }
    });
</script>
