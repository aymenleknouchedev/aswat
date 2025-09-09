<div id="media-normal_image-fields" class="media-fields-section" style="display: block;">

    <div class="row g-3">

        {{-- Main Image --}}
        <div class="col-md-4">
            <label for="normal_main_image" class="form-label">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-normal_main_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="normal_main_image" id="normal_main_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="normal_main_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Mobile Image --}}
        <div class="col-md-4">
            <label for="normal_mobile_image" class="form-label">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-normal_mobile_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="normal_mobile_image" id="normal_mobile_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="normal_mobile_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Content Image --}}
        <div class="col-md-4">
            <label for="normal_content_image" class="form-label">صورة المحتوى التفصيلية</label>
            <div class="media-preview border rounded mb-2" id="preview-normal_content_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="normal_content_image" id="normal_content_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="normal_content_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

    </div>

</div>

<style>
    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        #media-normal_image-fields {
            color: #ddd;
        }

        #media-normal_image-fields .media-preview {
            background-color: #333 !important;
            border-color: #555 !important;
        }

        #media-normal_image-fields .btn-outline-primary {
            color: #aad4ff;
            border-color: #55aaff;
        }

        #media-normal_image-fields .btn-outline-primary:hover {
            background-color: #55aaff;
            color: #fff;
        }
    }
</style>
