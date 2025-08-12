<div id="media-no_image-field" class="media-fields-section" style="display: none;">

    <div class="row g-3">

        {{-- Mobile Image --}}
        <div class="col-md-6">
            <label for="no_image_mobile_image" class="form-label">صورة الجوال</label>
            <div class="media-preview border rounded mb-2" id="preview-no_image_mobile_image"
                style="height:150px; background-color: var(--bs-light); display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="no_image_mobile_image" id="no_image_mobile_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="no_image_mobile_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Principal Image (was Content Image) --}}
        <div class="col-md-6">
            <label for="no_image_content_image" class="form-label">الصورة الرئيسية</label>
            <div class="media-preview border rounded mb-2" id="preview-no_image_content_image"
                style="height:150px; background-color: var(--bs-light); display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="no_image_content_image" id="no_image_content_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media"
                data-target="no_image_content_image" data-type="image">
                اختيار صورة
            </button>
        </div>

    </div>

</div>


<style>
    @media (prefers-color-scheme: dark) {
        #media-no_image-field {
            color: #ddd;
        }

        #media-no_image-field .media-preview {
            background-color: #333 !important;
            border-color: #555 !important;
        }

        #media-no_image-field .btn-outline-primary {
            color: #aad4ff;
            border-color: #55aaff;
        }

        #media-no_image-field .btn-outline-primary:hover {
            background-color: #55aaff;
            color: #fff;
        }
    }
</style>
