<div class="media-template-content">
    <h5>حقول الألبوم</h5>
    
    <!-- الصورة الرئيسية للألبوم -->
    <div class="mb-3">
        <label class="form-label">الصورة الرئيسية للألبوم</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('album', 'album_main_image')">
                <i class="fas fa-image me-1"></i>اختر الصورة الرئيسية
            </button>
            <div id="album_main_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة محتوى الألبوم -->
    <div class="mb-3">
        <label class="form-label">صورة محتوى الألبوم</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('album', 'album_content_image')">
                <i class="fas fa-image me-1"></i>اختر صورة المحتوى
            </button>
            <div id="album_content_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة الألبوم للموبايل -->
    <div class="mb-3">
        <label class="form-label">صورة الألبوم للموبايل</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('album', 'album_mobile_image')">
                <i class="fas fa-mobile-alt me-1"></i>اختر صورة الموبايل
            </button>
            <div id="album_mobile_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- ملاحظة حول الألبوم -->
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        <strong>ملاحظة:</strong> الألبوم يمكن أن يحتوي على مجموعة من الصور. سيتم إدارة الصور الإضافية في قسم خاص بالألبوم.
    </div>
</div>