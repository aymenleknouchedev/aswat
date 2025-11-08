/**
 * ====================================================================
 * COMPREHENSIVE FORM VALIDATION FOR ADD CONTENT
 * Global validation covering all tabs and required fields
 * ====================================================================
 */

class ContentFormValidator {
    constructor() {
        this.form = document.getElementById('contentForm');
        this.errors = {};
        this.init();
    }

    /**
     * Initialize validator
     */
    init() {
        if (!this.form) return;
        this.form.addEventListener('submit', (e) => this.validateForm(e));
    }

    /**
     * Main validation method - Global validation across all tabs
     */
    validateForm(e) {
        e.preventDefault();
        this.errors = {};

        // Validate all tabs
        this.validateAddContentTab();
        this.validateTemplateTab();
        this.validateMediaTab();
        this.validateSocialMediaTab();

        // If there are errors, show them and prevent submission
        if (Object.keys(this.errors).length > 0) {
            this.showErrors();
            return false;
        }

        // All validations passed, submit the form
        this.form.submit();
    }

    /**
     * ====================================================================
     * ADD CONTENT TAB VALIDATION
     * ====================================================================
     */
    validateAddContentTab() {
        // Title (required, max 68)
        const title = document.getElementById('title');
        if (!title?.value || title.value.trim() === '') {
            this.addError('title', 'العنوان مطلوب');
        } else if (title.value.length > 68) {
            this.addError('title', 'العنوان لا يمكن أن يتجاوز 68 حرف');
        }

        // Long Title (required, max 210)
        const longTitle = document.getElementById('long_title');
        if (!longTitle?.value || longTitle.value.trim() === '') {
            this.addError('long_title', 'العنوان الطويل مطلوب');
        } else if (longTitle.value.length > 210) {
            this.addError('long_title', 'العنوان الطويل لا يمكن أن يتجاوز 210 أحرف');
        }

        // Mobile Title (required, max 40)
        const mobileTitle = document.getElementById('mobile_title');
        if (!mobileTitle?.value || mobileTitle.value.trim() === '') {
            this.addError('mobile_title', 'عنوان الموبايل مطلوب');
        } else if (mobileTitle.value.length > 40) {
            this.addError('mobile_title', 'عنوان الموبايل لا يمكن أن يتجاوز 40 حرف');
        }

        // Section (required)
        const sectionId = document.querySelector('input[name="section_id"]');
        if (!sectionId?.value) {
            this.addError('section_id', 'يرجى اختيار القسم');
        }

        // Category (required)
        const categoryId = document.querySelector('input[name="category_id"]');
        if (!categoryId?.value) {
            this.addError('category_id', 'يرجى اختيار الصنف');
        }

        // Tags (required - at least one)
        const tagsInputs = document.querySelectorAll('input[name="tags_id[]"]');
        if (tagsInputs.length === 0) {
            this.addError('tags_id', 'يرجى اختيار وسم واحد على الأقل');
        }

        // Summary (required)
        const summary = document.getElementById('summary');
        if (!summary?.value || summary.value.trim() === '') {
            this.addError('summary', 'الملخص مطلوب');
        }

        // Content/Body (required)
        const contentEditor = tinyMCE?.get('myeditorinstance');
        const contentValue = contentEditor?.getContent() || document.getElementById('content')?.value || '';
        if (!contentValue || contentValue.trim() === '' || contentValue.trim() === '<p><br></p>' || contentValue.trim() === '<p></p>') {
            this.addError('content', 'محتوى المقالة (المتن) مطلوب');
        }

        // SEO Keyword (required)
        const seoKeyword = document.getElementById('seo_keyword');
        if (!seoKeyword?.value || seoKeyword.value.trim() === '') {
            this.addError('seo_keyword', 'الكلمة الرئيسية (SEO) مطلوبة');
        }
    }

    /**
     * ====================================================================
     * TEMPLATE TAB VALIDATION
     * ====================================================================
     */
    validateTemplateTab() {
        // Template (required)
        const templateField = document.getElementById('template_field');
        const template = templateField?.value || 'normal_image';

        if (!template) {
            this.addError('template', 'يرجى اختيار قالب الوسائط');
            return;
        }

        // Validate template-specific required fields
        const templateRequiredFields = {
            'normal_image': ['normal_main_image', 'normal_mobile_image', 'normal_content_image'],
            'video': ['video_main_image', 'video_mobile_image', 'video_content_image', 'video_file'],
            'podcast': ['podcast_main_image', 'podcast_mobile_image', 'podcast_content_image', 'podcast_file'],
            'album': ['album_main_image', 'album_mobile_image', 'album_content_image', 'album_assets'],
            'no_image': ['no_image_main_image', 'no_image_mobile_image']
        };

        const requiredFields = templateRequiredFields[template] || [];

        requiredFields.forEach(fieldName => {
            const input = document.querySelector(`input[name="${fieldName}"]`);
            const textareaInput = document.querySelector(`textarea[name="${fieldName}"]`);
            const value = input?.value || textareaInput?.value || '';

            if (!value || value.trim() === '') {
                const fieldLabel = this.getTemplateFieldLabel(fieldName);
                this.addError(fieldName, `${fieldLabel} مطلوب`);
            }
        });

        // Special validation for album assets
        if (template === 'album') {
            const albumAssetsInputs = document.querySelectorAll('input[name*="album_assets"]');
            if (albumAssetsInputs.length === 0) {
                this.addError('album_assets', 'يرجى إضافة صور الألبوم على الأقل');
            }
        }

        // Display method validation (if applicable)
        const displayMethodInputs = document.querySelector('input[name="display_method"]');
        if (displayMethodInputs) {
            const displayMethod = displayMethodInputs.value;
            this.validateDisplayMethod(displayMethod);
        }
    }

    /**
     * Validate display method items
     */
    validateDisplayMethod(displayMethod) {
        if (displayMethod === 'list' || displayMethod === 'file') {
            const items = document.querySelectorAll('[data-item-index]');

            if (items.length === 0) {
                this.addError('items', `يرجى إضافة عنصر واحد على الأقل للنمط ${displayMethod === 'list' ? 'القائمة' : 'الملف'}`);
                return;
            }

            items.forEach((item, index) => {
                const indexValue = item.getAttribute('data-item-index');

                // Title
                const titleInput = item.querySelector('input[name*="items"][name*="title"]');
                if (!titleInput?.value || titleInput.value.trim() === '') {
                    this.addError(`items.${indexValue}.title`, `العنصر ${indexValue + 1}: العنوان مطلوب`);
                }

                // Description
                const descInput = item.querySelector('textarea[name*="items"][name*="description"]');
                if (!descInput?.value || descInput.value.trim() === '') {
                    this.addError(`items.${indexValue}.description`, `العنصر ${indexValue + 1}: الوصف مطلوب`);
                }

                // Image
                const imageInput = item.querySelector('input[name*="items"][name*="image"]');
                if (!imageInput?.value || imageInput.value.trim() === '') {
                    this.addError(`items.${indexValue}.image`, `العنصر ${indexValue + 1}: الصورة مطلوبة`);
                }

                // URL (required for file, optional for list)
                if (displayMethod === 'file') {
                    const urlInput = item.querySelector('input[name*="items"][name*="url"]');
                    if (!urlInput?.value || urlInput.value.trim() === '') {
                        this.addError(`items.${indexValue}.url`, `العنصر ${indexValue + 1}: الرابط مطلوب`);
                    }
                }
            });
        }
    }

    /**
     * ====================================================================
     * MEDIA TAB VALIDATION
     * ====================================================================
     */
    validateMediaTab() {
        // Get the selected template from the media tab
        const mediaTemplate = document.querySelector('input[name="template"]:checked')?.value || 'normal_image';

        const templateRequiredFields = {
            'normal_image': [
                { field: 'normal_main_image', label: 'الصورة الرئيسية' },
                { field: 'normal_mobile_image', label: 'صورة الموبايل' },
                { field: 'normal_content_image', label: 'صورة المحتوى' }
            ],
            'video': [
                { field: 'video_main_image', label: 'صورة الفيديو الرئيسية' },
                { field: 'video_mobile_image', label: 'صورة الفيديو للموبايل' },
                { field: 'video_content_image', label: 'صورة محتوى الفيديو' },
                { field: 'video_file', label: 'ملف الفيديو' }
            ],
            'podcast': [
                { field: 'podcast_main_image', label: 'صورة البودكاست الرئيسية' },
                { field: 'podcast_mobile_image', label: 'صورة البودكاست للموبايل' },
                { field: 'podcast_content_image', label: 'صورة محتوى البودكاست' },
                { field: 'podcast_file', label: 'ملف البودكاست' }
            ],
            'album': [
                { field: 'album_main_image', label: 'صورة الألبوم الرئيسية' },
                { field: 'album_mobile_image', label: 'صورة الألبوم للموبايل' },
                { field: 'album_content_image', label: 'صورة محتوى الألبوم' }
            ],
            'no_image': [
                { field: 'no_image_main_image', label: 'الصورة الرئيسية' },
                { field: 'no_image_mobile_image', label: 'صورة المقال للموبايل' }
            ]
        };

        const requiredFields = templateRequiredFields[mediaTemplate] || [];

        requiredFields.forEach(({ field, label }) => {
            const input = document.querySelector(`input[name="${field}"]`);
            const value = input?.value || '';

            if (!value || value.trim() === '') {
                this.addError(field, `${label} مطلوبة`);
            }
        });

        // Special validation for album assets
        if (mediaTemplate === 'album') {
            const albumAssets = document.querySelectorAll('[data-album-asset]');
            if (albumAssets.length === 0) {
                this.addError('album_assets', 'يرجى إضافة صور الألبوم على الأقل');
            }
        }

        // Caption (required field in media-tab)
        const captionInput = document.getElementById('caption') || document.querySelector('input[name="caption"]');
        if (!captionInput?.value || captionInput.value.trim() === '') {
            this.addError('caption', 'التعليق مطلوب');
        }
    }

    /**
     * ====================================================================
     * SOCIAL MEDIA TAB VALIDATION
     * ====================================================================
     */
    validateSocialMediaTab() {
        // Social media fields are optional but if filled, validate format
        const shareTitle = document.getElementById('share_title');
        const shareDescription = document.getElementById('share_description');

        // These are optional, so no required validation
        // But we can add format validation if needed
    }

    /**
     * ====================================================================
     * HELPER METHODS
     * ====================================================================
     */

    /**
     * Get template field label
     */
    getTemplateFieldLabel(fieldName) {
        const labels = {
            'normal_main_image': 'الصورة الرئيسية',
            'normal_mobile_image': 'صورة الموبايل',
            'normal_content_image': 'صورة المحتوى',
            'video_main_image': 'صورة الفيديو الرئيسية',
            'video_mobile_image': 'صورة الفيديو للموبايل',
            'video_content_image': 'صورة محتوى الفيديو',
            'video_file': 'ملف الفيديو',
            'podcast_main_image': 'صورة البودكاست الرئيسية',
            'podcast_mobile_image': 'صورة البودكاست للموبايل',
            'podcast_content_image': 'صورة محتوى البودكاست',
            'podcast_file': 'ملف البودكاست',
            'album_main_image': 'صورة الألبوم الرئيسية',
            'album_mobile_image': 'صورة الألبوم للموبايل',
            'album_content_image': 'صورة محتوى الألبوم',
            'no_image_main_image': 'الصورة الرئيسية',
            'no_image_mobile_image': 'صورة المقال للموبايل'
        };
        return labels[fieldName] || fieldName;
    }

    /**
     * Add error message
     */
    addError(field, message) {
        if (!this.errors[field]) {
            this.errors[field] = [];
        }
        this.errors[field].push(message);
    }

    /**
     * Display all errors in a sweet alert
     */
    showErrors() {
        const errorMessages = [];
        const errorCount = Object.keys(this.errors).length;

        for (const [field, messages] of Object.entries(this.errors)) {
            errorMessages.push(...messages);
        }

        // Show SweetAlert with all errors
        Swal.fire({
            icon: 'error',
            title: 'خطأ في التحقق من البيانات',
            html: `<div style="text-align: right; direction: rtl;">
                <p><strong>تم العثور على ${errorCount} خطأ:</strong></p>
                <ul style="text-align: right; list-style: none; padding: 0;">
                    ${errorMessages.map(msg => `<li style="margin: 8px 0; color: #dc3545;">• ${msg}</li>`).join('')}
                </ul>
            </div>`,
            confirmButtonText: 'حسناً',
            allowOutsideClick: false,
            allowEscapeKey: false
        });

        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Highlight error fields
        this.highlightErrorFields();
    }

    /**
     * Highlight error fields
     */
    highlightErrorFields() {
        const fields = Object.keys(this.errors);

        fields.forEach(fieldName => {
            let element = null;

            // Try to find the element
            if (fieldName === 'section_id' || fieldName === 'category_id' || fieldName === 'tags_id') {
                element = document.querySelector(`input[name="${fieldName}"]`)?.closest('.search-container') ||
                    document.querySelector(`input[name="${fieldName}[]"]`)?.closest('.multi-select-container');
            } else {
                element = document.getElementById(fieldName) ||
                    document.querySelector(`input[name="${fieldName}"]`) ||
                    document.querySelector(`textarea[name="${fieldName}"]`);
            }

            if (element) {
                element.classList.add('is-invalid');
                element.style.borderColor = '#dc3545';
                setTimeout(() => {
                    element.classList.remove('is-invalid');
                    element.style.borderColor = '';
                }, 4000);
            }
        });
    }
}

/**
 * Initialize validator when DOM is ready
 */
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the validator
    new ContentFormValidator();

    // Optional: Add real-time validation for critical fields
    const criticalFields = [
        'title',
        'long_title',
        'mobile_title',
        'summary',
        'seo_keyword'
    ];

    criticalFields.forEach(fieldId => {
        const element = document.getElementById(fieldId);
        if (element) {
            element.addEventListener('blur', function() {
                if (!this.value || this.value.trim() === '') {
                    this.style.borderColor = '#ffc107';
                } else {
                    this.style.borderColor = '';
                }
            });
        }
    });

    // Real-time counter for title fields
    const counterFields = [
        { id: 'title', max: 68 },
        { id: 'long_title', max: 210 },
        { id: 'mobile_title', max: 40 },
        { id: 'summary', max: 130 },
        { id: 'caption', max: 255 }
    ];

    counterFields.forEach(({ id, max }) => {
        const element = document.getElementById(id);
        const counter = document.getElementById(id + '-count');
        if (element && counter) {
            element.addEventListener('input', function() {
                counter.textContent = this.value.length;
                if (this.value.length > max) {
                    this.style.borderColor = '#dc3545';
                } else {
                    this.style.borderColor = '';
                }
            });
        }
    });
});

/**
 * Export for use in other scripts
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ContentFormValidator;
}
