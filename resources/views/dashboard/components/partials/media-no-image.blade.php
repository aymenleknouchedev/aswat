<div class="media-template-content">
    <h5>حقول المقال (بدون صورة رئيسية)</h5>
    
    <!-- صورة محتوى المقال -->
    <div class="mb-3">
        <label class="form-label">صورة محتوى المقال</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('no_image', 'no_image_content_image')">
                <i class="fas fa-image me-1"></i>اختر صورة المحتوى
            </button>
            <div id="no_image_content_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة المقال للموبايل -->
    <div class="mb-3">
        <label class="form-label">صورة المقال للموبايل</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2" 
                    onclick="openMediaModal('no_image', 'no_image_mobile_image')">
                <i class="fas fa-mobile-alt me-1"></i>اختر صورة الموبايل
            </button>
            <div id="no_image_mobile_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة إضافية للمقال -->
    <div class="mb-3">
        <label class="form-label">صورة إضافية</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-secondary mb-2" 
                    onclick="openMediaModal('no_image', 'no_image_main_image')">
                <i class="fas fa-image me-1"></i>اختر صورة إضافية
            </button>
            <div id="no_image_main_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- ملاحظة حول المقال -->
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>ملاحظة:</strong> هذا القالب مخصص للمقالات التي لا تحتوي على صورة رئيسية بارزة.
    </div>
</div>