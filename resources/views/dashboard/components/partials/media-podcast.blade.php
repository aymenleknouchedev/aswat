<div class="media-template-content">
    <h5>حقول البودكاست</h5>
    
    <!-- الصورة الرئيسية للبودكاست -->
    <div class="mb-3">
        <label class="form-label">الصورة الرئيسية للبودكاست</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('podcast', 'podcast_main_image')">
                <i class="fas fa-image me-1"></i>اختر الصورة الرئيسية
            </button>
            <div id="podcast_main_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة محتوى البودكاست -->
    <div class="mb-3">
        <label class="form-label">صورة محتوى البودكاست</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('podcast', 'podcast_content_image')">
                <i class="fas fa-image me-1"></i>اختر صورة المحتوى
            </button>
            <div id="podcast_content_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة البودكاست للموبايل -->
    <div class="mb-3">
        <label class="form-label">صورة البودكاست للموبايل</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('podcast', 'podcast_mobile_image')">
                <i class="fas fa-mobile-alt me-1"></i>اختر صورة الموبايل
            </button>
            <div id="podcast_mobile_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- ملف البودكاست -->
    <div class="mb-3">
        <label class="form-label">ملف البودكاست</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-info mb-2" 
                    onclick="openMediaModal('podcast', 'podcast_file')">
                <i class="fas fa-podcast me-1"></i>اختر ملف البودكاست
            </button>
            <div id="podcast_file_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار ملف بودكاست</p>
            </div>
        </div>
    </div>
</div>