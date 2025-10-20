<div class="media-template-content">
    <h5>حقول الفيديو</h5>
    
    <!-- الصورة الرئيسية للفيديو -->
    <div class="mb-3">
        <label class="form-label">الصورة الرئيسية للفيديو</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('video', 'video_main_image')">
                <i class="fas fa-image me-1"></i>اختر الصورة الرئيسية
            </button>
            <div id="video_main_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة محتوى الفيديو -->
    <div class="mb-3">
        <label class="form-label">صورة محتوى الفيديو</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('video', 'video_content_image')">
                <i class="fas fa-image me-1"></i>اختر صورة المحتوى
            </button>
            <div id="video_content_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة الفيديو للموبايل -->
    <div class="mb-3">
        <label class="form-label">صورة الفيديو للموبايل</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('video', 'video_mobile_image')">
                <i class="fas fa-mobile-alt me-1"></i>اختر صورة الموبايل
            </button>
            <div id="video_mobile_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- ملف الفيديو -->
    <div class="mb-3">
        <label class="form-label">ملف الفيديو</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-success mb-2" 
                    onclick="openMediaModal('video', 'video_file')">
                <i class="fas fa-video me-1"></i>اختر ملف الفيديو
            </button>
            <div id="video_file_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار ملف فيديو</p>
            </div>
        </div>
    </div>
</div>