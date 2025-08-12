<div id="media-podcast-field" class="media-fields-section" style="display: none;">

    <div class="row g-3">

        {{-- Main Image --}}
        <div class="col-md-3">
            <label for="podcast_main_image" class="form-label">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-podcast_main_image"
                style="height:150px; background-color: var(--bs-light); display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="podcast_main_image" id="podcast_main_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="podcast_main_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Mobile Image --}}
        <div class="col-md-3">
            <label for="podcast_mobile_image" class="form-label">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-podcast_mobile_image"
                style="height:150px; background-color: var(--bs-light); display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="podcast_mobile_image" id="podcast_mobile_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="podcast_mobile_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Content Image --}}
        <div class="col-md-3">
            <label for="podcast_content_image" class="form-label">صورة المحتوى التفصيلية</label>
            <div class="media-preview border rounded mb-2" id="preview-podcast_content_image"
                style="height:150px; background-color: var(--bs-light); display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="podcast_content_image" id="podcast_content_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="podcast_content_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Podcast Upload and URL --}}
        <div class="col-md-3">
            <label for="podcast_file" class="form-label">بودكاست</label>
            <div id="preview-podcast_file" class="media-preview border rounded mb-2"
                style="height:150px; background-color: var(--bs-light); display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا يوجد بودكاست محدد</span>
            </div>
            <div class="input-group ">
                <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="podcast_file"
                    data-type="audio">
                    رفع / اختيار بودكاست
                </button>
                <input type="hidden" name="podcast_file" id="podcast_file">
                <input type="url" name="podcast_url" id="podcast_url" class="form-control"
                    placeholder="https://example.com/podcast.mp3">
            </div>
        </div>

    </div>

</div>

<style>
    @media (prefers-color-scheme: dark) {
        #media-podcast-field {
            color: #ddd;
        }

        #media-podcast-field .media-preview {
            background-color: #333 !important;
            border-color: #555 !important;
        }

        #media-podcast-field .btn-outline-primary {
            color: #aad4ff;
            border-color: #55aaff;
        }

        #media-podcast-field .btn-outline-primary:hover {
            background-color: #55aaff;
            color: #fff;
        }
    }
</style>
