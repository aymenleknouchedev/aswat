<div id="media-normal_image-fields" class="media-fields-section" style="display: block;">
    <div class="row g-3">

        <!-- ================= MAIN IMAGE ================= -->
        <div class="col-md-4">
            <label class="form-label" data-ar="الصورة الأساسية" data-en="Main Image">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-normal_main_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>

            <input type="file" name="normal_main_image" id="normal_main_image" class="d-none" accept="image/*">
            <input type="hidden" name="normal_main_image" id="normal_main_image_url">

            <div class="d-flex flex-column gap-2">
                <button type="button" class="btn btn-primary btn-sm w-100"
                    onclick="document.getElementById('normal_main_image').click()" data-ar="رفع صورة من الجهاز"
                    data-en="Upload from device">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="normal_main_image"
                    data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#mediaModal" data-target="normal_main_image" data-type="image"
                    data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= MOBILE IMAGE ================= -->
        <div class="col-md-4">
            <label class="form-label" data-ar="صورة الهاتف المحمول" data-en="Mobile Image">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-normal_mobile_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>

            <input type="file" name="normal_mobile_image" id="normal_mobile_image" class="d-none" accept="image/*">
            <input type="hidden" name="normal_mobile_image" id="normal_mobile_image_url">

            <div class="d-flex flex-column gap-2">
                <button type="button" class="btn btn-primary btn-sm w-100"
                    onclick="document.getElementById('normal_mobile_image').click()" data-ar="رفع صورة من الجهاز"
                    data-en="Upload from device">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="normal_mobile_image"
                    data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#mediaModal" data-target="normal_mobile_image" data-type="image"
                    data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= CONTENT IMAGE ================= -->
        <div class="col-md-4">
            <label class="form-label" data-ar="صورة المحتوى التفصيلية" data-en="Content Image">صورة المحتوى
                التفصيلية</label>
            <div class="media-preview border rounded mb-2" id="preview-normal_content_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>

            <input type="file" name="normal_content_image" id="normal_content_image" class="d-none" accept="image/*">
            <input type="hidden" name="normal_content_image" id="normal_content_image_url">

            <div class="d-flex flex-column gap-2">
                <button type="button" class="btn btn-primary btn-sm w-100"
                    onclick="document.getElementById('normal_content_image').click()" data-ar="رفع صورة من الجهاز"
                    data-en="Upload from device">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="normal_content_image"
                    data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#mediaModal" data-target="normal_content_image" data-type="image"
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
                <h5 class="modal-title" data-ar="إضافة صورة من رابط" data-en="Add image from URL">إضافة صورة من رابط
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="url" id="imageUrlInput" class="form-control"
                    placeholder="https://example.com/image.jpg">
                <input type="hidden" id="urlTargetInput">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-ar="إلغاء"
                    data-en="Cancel">إلغاء</button>
                <button type="button" class="btn btn-primary" id="saveUrlBtn" data-ar="حفظ"
                    data-en="Save">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL GALLERY ========== -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" data-ar="📚 مكتبة الوسائط" data-en="📚 Media Library">📚 مكتبة الوسائط</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="mediaLibraryGrid" class="d-flex flex-wrap gap-2">
                    <p data-ar="اختر صورة من المكتبة..." data-en="Choose an image from the library...">اختر صورة من
                        المكتبة...</p>
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
    ["normal_main_image", "normal_mobile_image", "normal_content_image"].forEach(id => {
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
            grid.innerHTML =
                `<p data-ar="⏳ جاري تحميل الصور..." data-en="⏳ Loading images...">⏳ جاري تحميل الصور...</p>`;

            
            try {
                const response = await fetch("{{ route('dashboard.media.getAllMediaPaginated') }}");
                const items = await response.json();

                grid.innerHTML = "";

                // نتأكد أن فيه بيانات
                if (items.data && items.data.length > 0) {
                    items.data.forEach(item => {
                        const div = document.createElement("div");
                        div.className = "media-thumb";
                        div.innerHTML = `<img src="${item.path}" alt="${item.name ?? ''}">`;

                        div.onclick = () => {
                            document.getElementById("preview-" + target).innerHTML =
                                `<img src="${item.path}" alt="preview">`;
                            document.getElementById(target + "_url").value = item.path;
                            bootstrap.Modal.getInstance(document.getElementById(
                                "mediaModal")).hide();
                        };
                        grid.appendChild(div);

                    });
                } else {
                    grid.innerHTML =
                        `<p data-ar="❌ لا توجد وسائط" data-en="❌ No media found">❌ لا توجد وسائط</p>`;
                }
            } catch (error) {
                grid.innerHTML =
                    `<p data-ar="❌ حدث خطأ أثناء تحميل الوسائط" data-en="❌ Error loading media">❌ حدث خطأ أثناء تحميل الوسائط</p>`;
                console.error("Error fetching media:", error);
            }
        });
    });
</script>
