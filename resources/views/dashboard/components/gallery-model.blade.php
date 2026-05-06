<!-- ================== mmm MEDIA MODAL (UPLOAD ONLY) ================== -->
<!-- CSRF -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="mmmMediaModal" class="mmm-modal" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="mmmMediaModalTitle">
    <div class="mmm-backdrop" data-mmm-backdrop></div>
    <div class="mmm-container" role="document">
        <div class="mmm-header">
            <h5 id="mmmMediaModalTitle">رفع وسائط جديدة</h5>
            <button class="mmm-close" type="button" data-mmm-close aria-label="إغلاق">&times;</button>
        </div>

        <!-- Tabs -->
        <div class="mmm-tabs" role="tablist" aria-label="طرق رفع الوسائط">
            <button type="button" class="mmm-tab-btn mmm-is-active" role="tab" aria-selected="true"
                aria-controls="mmm-tab-upload" id="mmm-tabbtn-upload" tabindex="0" data-mmm-tab="upload"
                data-en="Upload from device" data-ar="الرفع من الجهاز">الرفع من
                الجهاز</button>
            <button type="button" class="mmm-tab-btn" role="tab" aria-selected="false"
                aria-controls="mmm-tab-import" id="mmm-tabbtn-import" tabindex="-1" data-mmm-tab="import"
                data-en="Import by URL" data-ar="الاستيراد بالرابط">الاستيراد
                بالرابط</button>
        </div>

        <!-- Upload -->
        <section id="mmm-tab-upload" class="mmm-tab-panel" role="tabpanel" aria-labelledby="mmm-tabbtn-upload">
            <div class="mmm-tab-body">
                <div class="mmm-uploader">
                    <div class="mmm-upload-fields" style="display: flex; flex-wrap: wrap; gap: .6rem; width: 100%;">
                        <div style="flex: 1 1 220px;">
                            <input type="file" id="mmm-upload-input" class="mmm-upload-input"
                                style="display: none;" />
                            <label for="mmm-upload-input" id="mmm-upload-label"
                                style="display: block; width: 100%; cursor: pointer; padding: .6rem .7rem; border: 1px solid var(--mmm-border); border-radius: 0; background: var(--mmm-gray-100); color: var(--mmm-text); text-align: center; transition: all 0.2s;"
                                data-ar="اختر ملف الوسائط" data-en="Select media file">
                                <i class="fa fa-upload" style="margin-right: 6px;"></i> اختر ملف الوسائط
                            </label>
                        </div>
                        <div style="flex: 1 1 200px;">
                            <input type="text" id="mmm-upload-name" class="mmm-upload-name" placeholder="اسم الملف"
                                style="width: 100%; padding: .6rem .7rem; border: 1px solid var(--mmm-border); border-radius: 0; background: var(--mmm-bg); color: var(--mmm-text);" />
                        </div>
                        <div style="flex: 1 1 200px;">
                            <input type="text" id="mmm-upload-alt" class="mmm-upload-alt" placeholder="النص البديل"
                                style="width: 100%; padding: .6rem .7rem; border: 1px solid var(--mmm-border); border-radius: 0; background: var(--mmm-bg); color: var(--mmm-text);" />
                        </div>
                    </div>
                    <!-- Preview Section -->
                    <div id="mmm-preview-container" style="display: none; margin-top: 1rem; padding: 1rem; border: 1px solid var(--mmm-border); background: var(--mmm-gray-100); border-radius: 0;">
                        <div style="display: flex; gap: 1rem; align-items: flex-start;">
                            <div style="flex: 0 0 120px;">
                                <div id="mmm-preview-wrapper" style="width: 120px; height: 120px; background: #f0f0f0; border: 1px solid var(--mmm-border); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    <img id="mmm-preview-image" src="" alt="معاينة" style="max-width: 100%; max-height: 100%; object-fit: contain; display: none;" />
                                    <video id="mmm-preview-video" style="max-width: 100%; max-height: 100%; object-fit: contain; display: none;" controls muted></video>
                                    <audio id="mmm-preview-audio" style="width: 100%; display: none;" controls></audio>
                                    <div id="mmm-preview-icon" style="text-align: center; color: var(--mmm-muted);">
                                        <i class="fa fa-file fa-3x" style="margin-bottom: 0.5rem;"></i>
                                        <p style="margin: 0; font-size: 0.8rem;">معاينة غير متاحة</p>
                                    </div>
                                </div>
                            </div>
                            <div style="flex: 1;">
                                <p style="margin: 0 0 0.5rem 0; font-weight: 600; color: var(--mmm-text);">معلومات الملف:</p>
                                <div style="font-size: 0.9rem; color: var(--mmm-text);">
                                    <p style="margin: 0.25rem 0;"><strong>الاسم:</strong> <span id="mmm-preview-name">-</span></p>
                                    <p style="margin: 0.25rem 0;"><strong>الحجم:</strong> <span id="mmm-preview-size">-</span></p>
                                    <p style="margin: 0.25rem 0;"><strong>النوع:</strong> <span id="mmm-preview-type">-</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mmm-uploader-actions">
                        <button class="mmm-btn mmm-btn-primary" type="button" id="mmm-btn-upload-and-select-close"
                            title="رفع وإدراج" data-en="Upload and insert" data-ar="رفع وإدراج">رفع وإدراج</button>
                    </div>
                </div>
            </div>
            <script>
                // Change button style and label border when file selected
                document.addEventListener('DOMContentLoaded', function() {
                    const fileInput = document.getElementById('mmm-upload-input');
                    const uploadLabel = document.getElementById('mmm-upload-label');
                    const uploadName = document.getElementById('mmm-upload-name');
                    const uploadAlt = document.getElementById('mmm-upload-alt');
                    const btnUploadAndSelectClose = document.getElementById('mmm-btn-upload-and-select-close');
                    
                    // Preview elements
                    const previewContainer = document.getElementById('mmm-preview-container');
                    const previewImage = document.getElementById('mmm-preview-image');
                    const previewVideo = document.getElementById('mmm-preview-video');
                    const previewAudio = document.getElementById('mmm-preview-audio');
                    const previewIcon = document.getElementById('mmm-preview-icon');
                    const previewName = document.getElementById('mmm-preview-name');
                    const previewSize = document.getElementById('mmm-preview-size');
                    const previewType = document.getElementById('mmm-preview-type');

                    fileInput?.addEventListener('change', function() {
                        if (fileInput.files && fileInput.files.length > 0) {
                            const file = fileInput.files[0];
                            const fileName = file.name;
                            const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.')) || fileName;
                            
                            btnUploadAndSelectClose.classList.add('mmm-btn-active');
                            uploadLabel.style.borderColor = 'var(--mmm-primary)';
                            
                            // Auto-fill name and alt fields if empty
                            if (uploadName && !uploadName.value) {
                                uploadName.value = nameWithoutExt;
                            }
                            if (uploadAlt && !uploadAlt.value) {
                                uploadAlt.value = nameWithoutExt;
                            }
                            
                            // Update preview information
                            if (previewName) previewName.textContent = fileName;
                            if (previewSize) previewSize.textContent = formatFileSize(file.size);
                            if (previewType) previewType.textContent = file.type || 'Unknown';
                            
                            // Reset preview elements
                            previewImage.style.display = 'none';
                            previewVideo.style.display = 'none';
                            previewAudio.style.display = 'none';
                            previewIcon.style.display = 'none';
                            
                            // Handle different file types
                            const fileType = file.type;
                            const reader = new FileReader();
                            
                            if (fileType.startsWith('image/')) {
                                // Show image preview
                                reader.onload = function(e) {
                                    previewImage.src = e.target.result;
                                    previewImage.style.display = 'block';
                                };
                                reader.readAsDataURL(file);
                            } else if (fileType.startsWith('video/')) {
                                // Show video preview
                                const videoUrl = URL.createObjectURL(file);
                                previewVideo.src = videoUrl;
                                previewVideo.style.display = 'block';
                            } else if (fileType.startsWith('audio/')) {
                                // Show audio player
                                const audioUrl = URL.createObjectURL(file);
                                previewAudio.src = audioUrl;
                                previewAudio.style.display = 'block';
                            } else {
                                // Show file icon for other types
                                previewIcon.innerHTML = '<i class="fa fa-file fa-3x" style="margin-bottom: 0.5rem;"></i><p style="margin: 0; font-size: 0.8rem;">معاينة غير متاحة</p>';
                                previewIcon.style.display = 'block';
                            }
                            
                            // Show preview container
                            previewContainer.style.display = 'block';
                        } else {
                            btnUploadAndSelectClose.classList.remove('mmm-btn-active');
                            uploadLabel.style.borderColor = 'var(--mmm-border)';
                            previewContainer.style.display = 'none';
                        }
                    });
                    
                    // Helper function to format file size
                    function formatFileSize(bytes) {
                        if (bytes === 0) return '0 Bytes';
                        const k = 1024;
                        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                        const i = Math.floor(Math.log(bytes) / Math.log(k));
                        return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
                    }
                });
            </script>
            <style>
                /* Example: highlight buttons when file selected */
                .mmm-btn-active {
                    background: var(--mmm-success) !important;
                    border-color: var(--mmm-success) !important;
                    color: #fff !important;
                }
            </style>
        </section>

        <!-- Import by URL -->
        <section id="mmm-tab-import" class="mmm-tab-panel" role="tabpanel" aria-labelledby="mmm-tabbtn-import" hidden>
            <div class="mmm-tab-body">
                <div class="mmm-uploader mmm-uploader-url"
                    style="padding:1.2rem; border-radius:8px; border:1px solid var(--mmm-border); box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display:flex; flex-wrap:wrap; gap:.7rem; margin-bottom:.7rem;">
                        <input type="text" id="mmm-upload-url"
                            style="flex:1 1 220px; padding:.7rem 1rem; border:1px solid var(--mmm-border); border-radius:6px; background:var(--mmm-bg); color:var(--mmm-text); font-size:1rem;"
                            placeholder="الرابط" />
                        <input type="text" id="mmm-url-name" placeholder="اسم الملف"
                            style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid var(--mmm-border); border-radius:6px; background:var(--mmm-bg); color:var(--mmm-text); font-size:1rem;" />
                        <input type="text" id="mmm-url-alt" placeholder="النص البديل"
                            style="flex:1 1 180px; padding:.7rem 1rem; border:1px solid var(--mmm-border); border-radius:6px; background:var(--mmm-bg); color:var(--mmm-text); font-size:1rem;" />
                    </div>
                    <fieldset class="mmm-url-type-group" aria-label="نوع الوسائط للرابط"
                        style="margin-bottom:.7rem; border-radius:6px; border:1px solid var(--mmm-border); padding:.7rem 1rem; background:var(--mmm-bg);">
                        <legend style="font-size:.97rem; color:var(--mmm-text); padding:0 .3rem; font-weight:500;">نوع
                            الوسائط
                            (اختياري)</legend>
                        <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
                            <label class="mmm-radio" style="font-size:.97rem; color:var(--mmm-text);"><input
                                    type="radio" name="mmm-url-type" value="auto"
                                    checked /><span>Auto</span></label>
                            <label class="mmm-radio" style="font-size:.97rem; color:var(--mmm-text);"><input
                                    type="radio" name="mmm-url-type" value="image" /><span>Image</span></label>
                            <label class="mmm-radio" style="font-size:.97rem; color:var(--mmm-text);"><input
                                    type="radio" name="mmm-url-type" value="video" /><span>Video</span></label>
                            <label class="mmm-radio" style="font-size:.97rem; color:var(--mmm-text);"><input
                                    type="radio" name="mmm-url-type" value="voice" /><span>Voice</span></label>
                            <label class="mmm-radio" style="font-size:.97rem; color:var(--mmm-text);"><input
                                    type="radio" name="mmm-url-type" value="file" /><span>File</span></label>
                        </div>
                    </fieldset>
                    <div class="mmm-uploader-actions" style="display:flex; gap:.7rem; margin-bottom:.7rem;">
                        <button class="mmm-btn mmm-btn-primary" type="button" id="mmm-btn-import-and-select-close"
                            title="استيراد وإدراج"
                            style="border-radius:6px; font-size:1rem; padding:.7rem 1.2rem;">استيراد وإدراج</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    /* ===== mmm NAMESPACE – Updated for white/dark mode compatibility ===== */
    #mmmMediaModal,
    #mmmMediaModal * {
        box-sizing: border-box;
    }

    #mmmMediaModal * {
        border-radius: 0 !important;
    }

    :root {
        /* Light mode colors */
        --mmm-primary: #6576ff;
        --mmm-secondary: #364a63;
        --mmm-success: #1ee0ac;
        --mmm-danger: #e85347;
        --mmm-warning: #f4bd0e;
        --mmm-info: #09c2de;

        --mmm-bg: #fff;
        --mmm-text: #526484;
        --mmm-border: #dbdfea;
        --mmm-ring: #6576ff;
        --mmm-muted: #8091a7;

        --mmm-gray-100: #ebeef2;
        --mmm-gray-200: #e5e9f2;
        --mmm-gray-300: #dbdfea;
        --mmm-gray-400: #b7c2d0;
        --mmm-gray-500: #8091a7;
        --mmm-gray-600: #3c4d62;
        --mmm-gray-700: #344357;
        --mmm-gray-800: #2b3748;
        --mmm-gray-900: #1f2b3a;
    }

    [data-bs-theme="dark"] {
        /* Dark mode colors */
        --mmm-primary: #6576ff;
        --mmm-secondary: #364a63;
        --mmm-success: #1ee0ac;
        --mmm-danger: #e85347;
        --mmm-warning: #f4bd0e;
        --mmm-info: #09c2de;

        --mmm-bg: #0D141D;
        --mmm-text: #e5e9f2;
        --mmm-border: #384D69;
        --mmm-ring: #6576ff;
        --mmm-muted: #b7c2d0;

        --mmm-gray-100: #2b3748;
        --mmm-gray-200: #344357;
        --mmm-gray-300: #3c4d62;
        --mmm-gray-400: #8091a7;
        --mmm-gray-500: #b7c2d0;
        --mmm-gray-600: #dbdfea;
        --mmm-gray-700: #e5e9f2;
        --mmm-gray-800: #ebeef2;
        --mmm-gray-900: #f5f6fa;
    }

    .mmm-modal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 10000;
    }

    .mmm-modal[aria-hidden="false"] {
        display: block;
    }

    .mmm-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        z-index: 0;
    }

    .mmm-container {
        position: absolute;
        inset: auto 0;
        top: 5%;
        margin: 0 auto;
        width: clamp(320px, 92vw, 1000px);
        max-height: 90%;
        background: var(--mmm-bg);
        color: var(--mmm-text);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        animation: mmmFade .2s ease-out;
    }

    @keyframes mmmFade {
        from {
            opacity: 0;
            transform: translateY(-14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mmm-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--mmm-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--mmm-bg);
    }

    .mmm-header h5 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--mmm-text);
    }

    .mmm-close {
        font-size: 1.4rem;
        line-height: 1;
        border: 0;
        background: transparent;
        color: var(--mmm-muted);
        cursor: pointer;
    }

    .mmm-close:hover {
        color: var(--mmm-text);
    }

    .mmm-tabs {
        display: flex;
        gap: .25rem;
        padding: .5rem;
        border-bottom: 1px solid var(--mmm-border);
        background: var(--mmm-bg);
    }

    .mmm-tab-btn {
        appearance: none;
        background: var(--mmm-bg);
        border: 1px solid var(--mmm-border);
        padding: .55rem .9rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--mmm-text);
    }

    .mmm-tab-btn:focus {
        outline: 2px solid var(--mmm-ring);
        outline-offset: 1px;
    }

    .mmm-tab-btn.mmm-is-active {
        background: var(--mmm-primary);
        border-color: var(--mmm-primary);
        color: white;
    }

    .mmm-tab-panel {
        display: block;
    }

    .mmm-tab-panel[hidden] {
        display: none;
    }

    .mmm-tab-body {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--mmm-border);
        background: var(--mmm-bg);
    }

    .mmm-uploader {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .6rem;
        background: var(--mmm-bg);
        border: 1px solid var(--mmm-border);
        padding: 1rem;
    }

    .mmm-uploader-url {
        border-style: solid;
    }

    #mmm-upload-input {
        flex: 1 1 220px;
    }

    #mmm-upload-name,
    #mmm-upload-alt {
        flex: 1 1 200px;
    }

    #mmm-upload-url,
    #mmm-url-name,
    #mmm-url-alt {
        flex: 1 1 220px;
    }

    /* NEW: URL type radios */
    .mmm-url-type-group {
        width: 100%;
        margin: .2rem 0 .4rem;
        border: 1px solid var(--mmm-border);
        padding: .6rem .8rem;
    }

    .mmm-url-type-group legend {
        font-size: .9rem;
        color: var(--mmm-text);
        padding: 0 .25rem;
    }

    .mmm-radio {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        margin-inline-end: 1rem;
        cursor: pointer;
    }

    .mmm-radio input {
        accent-color: var(--mmm-primary);
    }

    .mmm-uploader-actions {
        display: flex;
        gap: .6rem;
        width: 100%;
        justify-content: flex-end;
    }

    .mmm-btn {
        padding: .6rem 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        border: 1px solid var(--mmm-primary);
        background: var(--mmm-primary);
        color: #fff;
    }

    .mmm-btn:hover {
        background: #465fff;
        border-color: #465fff;
    }

    .mmm-btn-secondary {
        background: var(--mmm-secondary);
        border-color: var(--mmm-secondary);
    }

    .mmm-btn-secondary:hover {
        background: #2b3748;
        border-color: #2b3748;
    }

    .mmm-btn-primary {
        background: var(--mmm-primary);
        border-color: var(--mmm-primary);
    }

    @media (max-width: 768px) {
        .mmm-container {
            top: 2%;
            max-height: 96%;
        }

        .mmm-tabs {
            flex-wrap: wrap;
        }

        .mmm-uploader {
            flex-direction: column;
            align-items: stretch;
        }

        .mmm-uploader-actions {
            width: 100%;
        }

        .mmm-uploader-actions .mmm-btn {
            width: 100%;
        }
    }
</style>

<script>
    (() => {
        // ===== Endpoints =====
        const UPLOAD_URL = "{{ route('dashboard.media.store') }}";
        const IMPORT_URL = "{{ route('dashboard.media_url.store') }}"; // عرّفه عند وجود خدمة الاستيراد عبر الرابط

        const modal = document.getElementById("mmmMediaModal");
        const backdrop = modal.querySelector("[data-mmm-backdrop]");
        const closes = modal.querySelectorAll("[data-mmm-close]");
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        // Upload
        const uploadInput = document.getElementById("mmm-upload-input");
        const uploadName = document.getElementById("mmm-upload-name");
        const uploadAlt = document.getElementById("mmm-upload-alt");
        const btnUploadSelectAndClose = document.getElementById("mmm-btn-upload-and-select-close");

        // Import URL
        const uploadUrlInput = document.getElementById("mmm-upload-url");
        const urlNameInput = document.getElementById("mmm-url-name");
        const urlAltInput = document.getElementById("mmm-url-alt");
        const btnImportSelectAndClose = document.getElementById("mmm-btn-import-and-select-close");
        const urlTypeRadios = modal.querySelectorAll("input[name='mmm-url-type']");

        // Tabs
        const tabButtons = Array.from(modal.querySelectorAll('.mmm-tab-btn'));
        const tabPanels = {
            upload: document.getElementById('mmm-tab-upload'),
            import: document.getElementById('mmm-tab-import'),
        };

        const state = {
            isOpen: false,
            currentField: "",
            activeTab: 'upload'
        };

        // ===== Helpers =====
        function getSelectedUrlType() {
            const checked = Array.from(urlTypeRadios).find(r => r.checked);
            return checked ? checked.value : "auto";
        }

        const mapFilterForServer = (t) => (t === "voice" ? "audio" : t);

        // ===== Public API =====
        window.mmmMediaModalManager = {
            openModal(fieldName) {
                openModal(fieldName);
            },
            closeModal() {
                closeModal();
            },
            onMediaSelected(payload) {
                if (window.mediaTabManager && typeof window.mediaTabManager.onMediaSelected === "function") {
                    window.mediaTabManager.onMediaSelected(payload);
                }
                                
            }
        };

        // ===== Reset UI/state =====
        function clearAllInputs() {
            uploadInput && (uploadInput.value = "");
            uploadName && (uploadName.value = "");
            uploadAlt && (uploadAlt.value = "");
            uploadUrlInput && (uploadUrlInput.value = "");
            urlNameInput && (urlNameInput.value = "");
            urlAltInput && (urlAltInput.value = "");
            // reset radios to Auto
            urlTypeRadios.forEach(r => {
                r.checked = (r.value === "auto");
            });
        }

        // ===== Open/close =====
        function openModal(fieldName = "") {
            state.currentField = fieldName;
            state.isOpen = true;
            modal.setAttribute("aria-hidden", "false");
            document.documentElement.style.overflow = "hidden";
            clearAllInputs();
            switchTab('upload');
        }

        function closeModal() {
            state.isOpen = false;
            modal.setAttribute("aria-hidden", "true");
            document.documentElement.style.overflow = "";
            clearAllInputs();
            location.reload();
        }

        backdrop.addEventListener("click", closeModal);
        closes.forEach(b => b.addEventListener("click", closeModal));
        modal.querySelector(".mmm-container").addEventListener("click", e => e.stopPropagation());
        document.addEventListener("keydown", e => {
            if (!state.isOpen) return;
            if (e.key === "Escape") closeModal();
            if (e.key === "ArrowRight" || e.key === "ArrowLeft") {
                const idx = tabButtons.findIndex(b => b.getAttribute('aria-selected') === "true");
                if (idx > -1) {
                    const dir = e.key === "ArrowRight" ? 1 : -1;
                    const next = (idx + dir + tabButtons.length) % tabButtons.length;
                    tabButtons[next].click();
                    tabButtons[next].focus();
                }
            }
        });

        // ===== Tabs =====
        tabButtons.forEach(btn => btn.addEventListener('click', () => switchTab(btn.dataset.mmmTab)));

        function switchTab(tab) {
            if (!tabPanels[tab]) return;
            state.activeTab = tab;
            tabButtons.forEach(b => {
                const active = b.dataset.mmmTab === tab;
                b.classList.toggle('mmm-is-active', active);
                b.setAttribute('aria-selected', String(active));
                b.tabIndex = active ? 0 : -1;
            });
            Object.entries(tabPanels).forEach(([name, panel]) => {
                panel.hidden = (name !== tab);
            });
        }

        // ===== Parsing & matching helpers =====
        function tryParseJsonFromText(text) {
            if (!text) return null;
            const clean = text.replace(/^\uFEFF/, "").trim();
            try {
                return JSON.parse(clean);
            } catch {
                const m = clean.match(/\{[\s\S]*\}/);
                if (m) {
                    try {
                        return JSON.parse(m[0]);
                    } catch {}
                }
                return {
                    __nonJson: true,
                    __raw: clean
                };
            }
        }

        function extractCreatedFromPayload(payload) {
            if (!payload || typeof payload !== "object") return [];
            if (Array.isArray(payload.data)) return payload.data;
            if (Array.isArray(payload.media)) return payload.media;
            if (payload.data) return [payload.data];
            if (payload.media) return [payload.media];
            return [];
        }

        // ===== Upload (select-close) =====
        async function uploadMediaAndHandle() {
            const files = uploadInput.files;
            if (!files || !files.length) {
                alert("⚠️ لم يتم اختيار أي ملف للرفع.");
                return;
            }
            let file0 = files[0];
            if (window.compressImage && /^image\//i.test(file0.type)) {
                try { file0 = await window.compressImage(file0); } catch (_) {}
            }
            const nameVal = (uploadName.value || "").trim();
            const altVal = (uploadAlt.value || "").trim();

            const form = new FormData();
            form.append("media", file0);
            if (nameVal) form.append("name", nameVal);
            if (altVal) form.append("alt", altVal);

            let created = null;
            try {
                btnUploadSelectAndClose.disabled = true;
                btnUploadSelectAndClose.textContent = "جارٍ الرفع...";

                const res = await fetch(UPLOAD_URL, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": CSRF,
                        "Accept": "application/json"
                    },
                    body: form
                });
                const bodyText = await res.text();
                if (!res.ok) {
                    console.error("❌ Upload failed:", res.status, bodyText);
                    alert("فشل رفع الملف.\nStatus: " + res.status);
                    return;
                }

                const parsed = tryParseJsonFromText(bodyText);
                created = parsed && !parsed.__nonJson ? extractCreatedFromPayload(parsed) : null;

                // select-close
                if (created && created.length) {
                    const first = created[0];
                    window.mmmMediaModalManager.onMediaSelected({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || nameVal || "",
                        alt: first.alt || altVal || ""
                    });
                    closeModal();
                } else {
                    console.warn("Upload OK but unable to determine the created media from response.");
                    closeModal();
                }
            } catch (err) {
                console.error("🔥 Exception during upload:", err);
                alert("حدث خطأ أثناء الرفع:\n" + (err && err.message ? err.message : err));
            } finally {
                btnUploadSelectAndClose.disabled = false;
                btnUploadSelectAndClose.textContent = "رفع وإدراج";
            }
        }

        // ===== Import via URL =====
        async function importViaUrl() {
            if (!IMPORT_URL) {
                alert("⚠️ لم يتم ضبط مسار الاستيراد عبر الرابط في الخادم.");
                return;
            }
            const urlVal = (uploadUrlInput.value || "").trim();
            const nameVal = (urlNameInput.value || "").trim();
            const altVal = (urlAltInput.value || "").trim();
            const typeVal = getSelectedUrlType(); // auto | image | video | voice | file
            if (!urlVal) {
                alert("⚠️ يرجى إدخال الرابط أولاً.");
                return;
            }

            // إذا اختار المستخدم voice نمرره كـ audio إلى الخادم
            const payloadType = typeVal === "auto" ? undefined : mapFilterForServer(typeVal);

            let created = null;
            try {
                btnImportSelectAndClose.disabled = true;
                btnImportSelectAndClose.textContent = "جارٍ الاستيراد...";

                const res = await fetch(IMPORT_URL, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": CSRF,
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        url: urlVal,
                        name: nameVal || undefined,
                        alt: altVal || undefined,
                        media_type: payloadType // قد يتجاهله الخادم إن كان Auto/undefined
                    })
                });
                const bodyText = await res.text();
                if (!res.ok) {
                    console.error("❌ Import failed:", res.status, bodyText);
                    alert("فشل الاستيراد.\nStatus: " + res.status);
                    return;
                }

                const parsed = tryParseJsonFromText(bodyText);
                created = parsed && !parsed.__nonJson ? extractCreatedFromPayload(parsed) : null;

                // select-close
                if (created && created.length) {
                    const first = created[0];
                    window.mmmMediaModalManager.onMediaSelected({
                        id: first.id,
                        url: first.url || first.path,
                        title: first.name || nameVal || "",
                        alt: first.alt || altVal || ""
                    });
                    closeModal();
                } else {
                    console.warn("Import OK but unable to determine created media.");
                    closeModal();
                }
            } catch (err) {
                console.error("🔥 Exception during import:", err);
                alert("حدث خطأ أثناء الاستيراد:\n" + (err && err.message ? err.message : err));
            } finally {
                btnImportSelectAndClose.disabled = false;
                btnImportSelectAndClose.textContent = "استيراد وإدراج";
            }
        }

        // ===== Bindings =====
        btnUploadSelectAndClose?.addEventListener("click", uploadMediaAndHandle);
        btnImportSelectAndClose?.addEventListener("click", importViaUrl);

        // ===== Initial setup =====
        (function init() {
            // Nothing to initialize for upload-only version
        })();
    })();
</script>
