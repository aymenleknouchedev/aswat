<div id="media-video-field" class="media-fields-section" style="display: none;">
    <div class="row g-3">

        <!-- ================= MAIN IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label" data-en="Main Image" data-ar="الصورة الأساسية">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-video_main_image"
            style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
            <span class="text-muted" data-en="No image selected" data-ar="لا توجد صورة مختارة">لا توجد صورة مختارة</span>
            </div>

            <input type="file" name="video_main_image" id="video_main_image" class="d-none" accept="image/*">
            <input type="hidden" name="video_main_image" id="video_main_image_url">

            <div class="d-flex flex-column gap-2">
            <button type="button" class="btn btn-primary btn-sm w-100"
                onclick="document.getElementById('video_main_image').click()"
                data-en="Upload from device" data-ar="رفع صورة من الجهاز">رفع صورة من الجهاز</button>
            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="video_main_image"
                data-en="Add from URL" data-ar="إضافة من رابط">إضافة من رابط</button>
            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                data-bs-target="#mediaModal" data-target="video_main_image" data-type="image"
                data-en="Choose from gallery" data-ar="اختيار من المعرض">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= MOBILE IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label" data-en="Mobile Image" data-ar="صورة الهاتف المحمول">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-video_mobile_image"
            style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
            <span class="text-muted" data-en="No image selected" data-ar="لا توجد صورة مختارة">لا توجد صورة مختارة</span>
            </div>

            <input type="file" name="video_mobile_image" id="video_mobile_image" class="d-none" accept="image/*">
            <input type="hidden" name="video_mobile_image" id="video_mobile_image_url">

            <div class="d-flex flex-column gap-2">
            <button type="button" class="btn btn-primary btn-sm w-100"
                onclick="document.getElementById('video_mobile_image').click()"
                data-en="Upload from device" data-ar="رفع صورة من الجهاز">رفع صورة من الجهاز</button>
            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="video_mobile_image"
                data-en="Add from URL" data-ar="إضافة من رابط">إضافة من رابط</button>
            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                data-bs-target="#mediaModal" data-target="video_mobile_image" data-type="image"
                data-en="Choose from gallery" data-ar="اختيار من المعرض">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= CONTENT IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label" data-en="Content Image" data-ar="صورة المحتوى التفصيلية">صورة المحتوى التفصيلية</label>
            <div class="media-preview border rounded mb-2" id="preview-video_content_image"
            style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
            <span class="text-muted" data-en="No image selected" data-ar="لا توجد صورة مختارة">لا توجد صورة مختارة</span>
            </div>

            <input type="file" name="video_content_image" id="video_content_image" class="d-none" accept="image/*">
            <input type="hidden" name="video_content_image" id="video_content_image_url">

            <div class="d-flex flex-column gap-2">
            <button type="button" class="btn btn-primary btn-sm w-100"
                onclick="document.getElementById('video_content_image').click()"
                data-en="Upload from device" data-ar="رفع صورة من الجهاز">رفع صورة من الجهاز</button>
            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="video_content_image"
                data-en="Add from URL" data-ar="إضافة من رابط">إضافة من رابط</button>
            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                data-bs-target="#mediaModal" data-target="video_content_image" data-type="image"
                data-en="Choose from gallery" data-ar="اختيار من المعرض">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= VIDEO ================= -->
        <div class="col-md-3">
            <label class="form-label" data-en="Video" data-ar="الفيديو">الفيديو</label>
            <div id="preview-video_file" class="media-preview border rounded mb-2"
            style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
            <span class="text-muted" data-en="No video selected" data-ar="لا يوجد فيديو محدد">لا يوجد فيديو محدد</span>
            </div>

            <input type="file" name="video_file" id="video_file" class="d-none" accept="video/*">
            <input type="hidden" name="video_file" id="video_file_url">

            <div class="d-flex flex-column gap-2">
            <button type="button" class="btn btn-primary btn-sm w-100"
                onclick="document.getElementById('video_file').click()"
                data-en="Upload from device" data-ar="رفع فيديو من الجهاز">رفع فيديو من الجهاز</button>
            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="video_file"
                data-en="Add from URL" data-ar="إضافة من رابط">إضافة من رابط</button>
            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                data-bs-target="#mediaModal" data-target="video_file" data-type="video"
                data-en="Choose from gallery" data-ar="اختيار من المعرض">اختيار من المعرض</button>
            </div>
        </div>

    </div>
</div>

<!-- ========== MODAL URL ========== -->
<div class="modal fade" id="urlModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة من رابط</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="url" id="imageUrlInput" class="form-control"
                    placeholder="https://example.com/file">
                <input type="hidden" id="urlTargetInput">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" id="saveUrlBtn">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL GALLERY ========== -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">📚 مكتبة الوسائط</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="mediaLibraryGrid" class="d-flex flex-wrap gap-2">
                    <p>اختر ملف من المكتبة...</p>
                </div>
                <input type="hidden" id="mediaTargetInput">
            </div>
        </div>
    </div>
</div>

<style>
    .media-preview {
        border: 2px dashed #ccc !important;
        transition: 0.3s;
    }

    .media-preview img,
    .media-preview video,
    .media-preview iframe {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .media-preview:hover {
        border-color: #007bff !important;
    }

    .media-thumb {
        width: 100px;
        height: 100px;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 6px;
        overflow: hidden;
    }

    .media-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .media-thumb:hover {
        border-color: #007bff;
    }
</style>

<script>
    // ================= FILE UPLOAD (images) =================
    ["video_main_image", "video_mobile_image", "video_content_image"].forEach(id => {
        document.getElementById(id).addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById("preview-" + id).innerHTML =
                        `<img src="${event.target.result}" alt="preview">`;
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // ================= FILE UPLOAD (video) =================
    document.getElementById("video_file").addEventListener("change", function(e) {
        const file = e.target.files[0];
        if (file) {
            const url = URL.createObjectURL(file);
            document.getElementById("preview-video_file").innerHTML =
                `<video controls style="max-height:140px; max-width:100%;">
                    <source src="${url}" type="${file.type}">
                    متصفحك لا يدعم عرض الفيديو.
                 </video>`;
        }
    });

    // ================= URL MODAL =================
    document.querySelectorAll('.open-url-modal').forEach(btn => {
        btn.addEventListener("click", () => {
            const target = btn.dataset.target;
            document.getElementById("urlTargetInput").value = target;
            document.getElementById("imageUrlInput").value = "";
        });
    });

    document.getElementById("saveUrlBtn").addEventListener("click", function() {
        const url = document.getElementById("imageUrlInput").value;
        const target = document.getElementById("urlTargetInput").value;
        if (url && target) {
            if (target === "video_file") {
                updateVideoPreview(url);
                document.getElementById(target + "_url").value = url;
            } else {
                document.getElementById("preview-" + target).innerHTML =
                    `<img src="${url}" alt="preview">`;
                document.getElementById(target + "_url").value = url;
            }
            bootstrap.Modal.getInstance(document.getElementById("urlModal")).hide();
        }
    });

    // ================= MEDIA MODAL =================
    document.querySelectorAll('.open-media').forEach(btn => {
        btn.addEventListener("click", async () => {
            const target = btn.dataset.target;
            const type = btn.dataset.type;
            document.getElementById("mediaTargetInput").value = target;

            const grid = document.getElementById("mediaLibraryGrid");
            grid.innerHTML = "<p>⏳ جاري تحميل الملفات...</p>";

            try {
                const response = await fetch(`/api/media?type=${type}`);
                const items = await response.json();
                grid.innerHTML = "";
                items.forEach(item => {
                    const div = document.createElement("div");
                    div.className = "media-thumb";
                    div.innerHTML = `<img src="${item.src}" alt="">`;
                    div.onclick = () => {
                        if (type === "video") {
                            updateVideoPreview(item.src);
                        } else {
                            document.getElementById("preview-" + target).innerHTML =
                                `<img src="${item.src}" alt="preview">`;
                        }
                        document.getElementById(target + "_url").value = item.src;
                        bootstrap.Modal.getInstance(document.getElementById(
                            "mediaModal")).hide();
                    };
                    grid.appendChild(div);
                });
            } catch (e) {
                grid.innerHTML = "<p>❌ فشل تحميل الوسائط</p>";
            }
        });
    });

    // ================= VIDEO PREVIEW FUNCTION =================
    function updateVideoPreview(url) {
        const preview = document.getElementById("preview-video_file");
        if (!url) {
            preview.innerHTML = `<span class="text-muted">لا يوجد فيديو محدد</span>`;
            return;
        }

        const youtubeMatch = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/);
        if (youtubeMatch && youtubeMatch[1]) {
            preview.innerHTML = `
                <iframe width="100%" height="140"
                    src="https://www.youtube.com/embed/${youtubeMatch[1]}"
                    frameborder="0" allowfullscreen></iframe>`;
            return;
        }

        preview.innerHTML = `
            <video controls style="max-height:140px; max-width:100%;">
                <source src="${url}">
                متصفحك لا يدعم عرض الفيديو.
            </video>`;
    }
</script>
