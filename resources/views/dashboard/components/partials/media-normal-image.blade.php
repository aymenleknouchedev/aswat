<div class="media-template-content">
    <h5>حقول الصورة العادية</h5>

    <!-- الصورة الرئيسية -->
    <div class="mb-3">
        <label class="form-label">الصورة الرئيسية</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2"
                onclick="openMediaModal('normal_image', 'normal_main_image')">
                <i class="fas fa-image me-1"></i>اختر الصورة الرئيسية
            </button>
            <div id="normal_main_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة المحتوى -->
    <div class="mb-3">
        <label class="form-label">صورة المحتوى</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2"
                onclick="openMediaModal('normal_image', 'normal_content_image')">
                <i class="fas fa-image me-1"></i>اختر صورة المحتوى
            </button>
            <div id="normal_content_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>

    <!-- صورة الموبايل -->
    <div class="mb-3">
        <label class="form-label">صورة الموبايل</label>
        <div class="media-field-container">
            <button type="button" class="btn btn-outline-primary mb-2"
                onclick="openMediaModal('normal_image', 'normal_mobile_image')">
                <i class="fas fa-mobile-alt me-1"></i>اختر صورة الموبايل
            </button>
            <div id="normal_mobile_image_preview" class="media-preview">
                <p class="text-muted">لم يتم اختيار صورة</p>
            </div>
        </div>
    </div>
</div>
