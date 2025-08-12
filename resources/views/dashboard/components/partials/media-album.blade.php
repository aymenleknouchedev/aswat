<div id="media-album-field" class="media-fields-section" style="display: none;">

    <div class="row g-3">

        {{-- Album Images (multiple) --}}
        <div class="col-12">
            <label for="album_images" class="form-label">صور الألبوم</label>

            <input type="hidden" name="album_images" id="album_images" value="[]">

            <div id="album_preview" class="d-flex flex-wrap gap-2 mb-2"
                style="min-height: 150px; border: 1px solid var(--bs-gray-300); border-radius: 6px; background-color: var(--bs-light); padding: 10px; align-items: center; justify-content: flex-start;">
                <p class="text-muted m-0" id="album_preview_placeholder">لا توجد صور مختارة</p>
            </div>

            <button type="button" class="btn btn-outline-primary btn-sm" id="album_images_btn"
                data-target="album_images" data-type="image-multiple">
                اختيار / رفع صور
            </button>
        </div>

        {{-- Principal Image (was first Mobile Image) --}}
        <div class="col-md-4">
            <label for="album_principal_image" class="form-label">الصورة الرئيسية للألبوم</label>
            <div class="media-preview border rounded mb-2" id="preview-album_principal_image"
                style="height:150px; background-color: var(--bs-light); display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="album_principal_image" id="album_principal_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="album_principal_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Mobile Image (second block, unchanged) --}}
        <div class="col-md-4">
            <label for="album_mobile_image" class="form-label">صورة الجوال للألبوم</label>
            <div class="media-preview border rounded mb-2" id="preview-album_mobile_image"
                style="height:150px; background-color: var(--bs-light); display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="album_mobile_image" id="album_mobile_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="album_mobile_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

        {{-- Content Image --}}
        <div class="col-md-4">
            <label for="album_content_image" class="form-label">صورة محتوى الألبوم</label>
            <div class="media-preview border rounded mb-2" id="preview-album_content_image"
                style="height:150px; background-color: var(--bs-light); display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>
            <input type="hidden" name="album_content_image" id="album_content_image">
            <button type="button" class="btn btn-outline-primary btn-sm open-media" data-target="album_content_image"
                data-type="image">
                اختيار صورة
            </button>
        </div>

    </div>

</div>


<style>
    @media (prefers-color-scheme: dark) {
        #media-album-field {
            color: #ddd;
        }

        #media-album-field .media-preview {
            background-color: #333 !important;
            border-color: #555 !important;
        }

        #media-album-field .btn-outline-primary {
            color: #aad4ff;
            border-color: #55aaff;
        }

        #media-album-field .btn-outline-primary:hover {
            background-color: #55aaff;
            color: #fff;
        }
    }

    /* Album preview thumbnails */
    #album_preview img {
        max-height: 120px;
        border-radius: 4px;
        object-fit: cover;
        cursor: pointer;
        border: 1px solid #ccc;
    }
</style>

