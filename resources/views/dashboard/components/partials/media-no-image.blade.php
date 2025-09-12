<div id="media-no_image-field" class="media-fields-section" style="display: block;">
    <div class="row g-3">

        <!-- ================= MAIN IMAGE ================= -->
        <div class="col-md-6">
            <label class="form-label" data-ar="الصورة الأساسية" data-en="Main Image">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-no_image_main_image"
            style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
            <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة مختارة</span>
            </div>

            <input type="file" name="no_image_main_image" id="no_image_main_image" class="d-none" accept="image/*">
            <input type="hidden" name="no_image_main_image" id="no_image_main_image_url">

            <div class="d-flex flex-column gap-2">
            <button type="button" class="btn btn-primary btn-sm w-100"
                onclick="document.getElementById('no_image_main_image').click()"
                data-ar="رفع صورة من الجهاز" data-en="Upload from device">رفع صورة من الجهاز</button>
            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="no_image_main_image"
                data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                data-bs-target="#mediaModal" data-target="no_image_main_image" data-type="image"
                data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= MOBILE IMAGE ================= -->
        <div class="col-md-6">
            <label class="form-label" data-ar="صورة الهاتف المحمول" data-en="Mobile Image">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-no_image_mobile_image"
            style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
            <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة مختارة</span>
            </div>

            <input type="file" name="no_image_mobile_image" id="no_image_mobile_image" class="d-none" accept="image/*">
            <input type="hidden" name="no_image_mobile_image" id="no_image_mobile_image_url">

            <div class="d-flex flex-column gap-2">
            <button type="button" class="btn btn-primary btn-sm w-100"
                onclick="document.getElementById('no_image_mobile_image').click()"
                data-ar="رفع صورة من الجهاز" data-en="Upload from device">رفع صورة من الجهاز</button>
            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="no_image_mobile_image"
                data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                data-bs-target="#mediaModal" data-target="no_image_mobile_image" data-type="image"
                data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

    </div>
</div>

<!-- ========== MODAL URL ========== -->
<div class="modal fade" id="urlModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة صورة من رابط</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="url" id="imageUrlInput" class="form-control"
                    placeholder="https://example.com/image.jpg">
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
                    <p>اختر صورة من المكتبة...</p>
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

    .media-preview img {
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
    // ================= FILE UPLOAD (preview) =================
    ["no_image_main_image", "no_image_mobile_image"].forEach(id => {
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
            document.getElementById("preview-" + target).innerHTML =
                `<img src="${url}" alt="preview">`;
            document.getElementById(target + "_url").value = url;
            bootstrap.Modal.getInstance(document.getElementById("urlModal")).hide();
        }
    });

    // ================= MEDIA MODAL =================
    document.querySelectorAll('.open-media').forEach(btn => {
        btn.addEventListener("click", async () => {
            const target = btn.dataset.target;
            document.getElementById("mediaTargetInput").value = target;

            const grid = document.getElementById("mediaLibraryGrid");
            grid.innerHTML = "<p>⏳ جاري تحميل الصور...</p>";

            try {
                const response = await fetch("/api/media?type=image");
                const items = await response.json();
                grid.innerHTML = "";
                items.forEach(item => {
                    const div = document.createElement("div");
                    div.className = "media-thumb";
                    div.innerHTML = `<img src="${item.src}" alt="">`;
                    div.onclick = () => {
                        document.getElementById("preview-" + target).innerHTML =
                            `<img src="${item.src}" alt="preview">`;
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
</script>
