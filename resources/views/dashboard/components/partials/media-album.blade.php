<div id="media-album-field" class="media-fields-section">
    <div class="row g-3">

        <!-- ================= ALBUM MULTIPLE IMAGES ================= -->
        <div class="col-12">
            <label class="form-label" data-ar="صور الألبوم (متعددة)" data-en="Album Images (Multiple)">
                صور الألبوم (متعددة)
            </label>

            <!-- Preview container for multiple images -->
            <div class="media-preview border rounded mb-2 p-2" id="preview-album_images"
                style="height:150px; display:flex; flex-wrap:wrap; gap:10px;">
                <span class="text-muted" data-ar="لا توجد صور مختارة" data-en="No images selected">لا توجد صور
                    مختارة</span>
            </div>

            <!-- File input for multiple images (hidden) -->
            <input type="file" name="album_images[]" id="album_images" class="d-none" accept="image/*" multiple>
            <input type="hidden" name="album_images_urls" id="album_images_urls">

            <!-- Buttons to add images -->
            <button type="button" class="mt-1 btn btn-primary btn-sm w-100"
                onclick="document.getElementById('album_images').click()" data-ar="رفع صور من الجهاز"
                data-en="Upload from Device">رفع صور من الجهاز</button>

            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-multi mt-1"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="album_images" data-ar="إضافة من روابط"
                data-en="Add from URLs">إضافة من روابط</button>

            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media-multi mt-1"
                data-bs-toggle="modal" data-bs-target="#mediaModal" data-target="album_images" data-type="image"
                data-ar="اختيار من المعرض" data-en="Choose from Media">اختيار من المعرض</button>
        </div>
        <!-- ================= SINGLE IMAGE FIELDS ================= -->
        <!-- MAIN IMAGE -->
        <div class="col-md-4">
            <label class="form-label" data-ar="الصورة الأساسية" data-en="Main Image">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-album_main_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>
            <input type="file" name="album_main_image" id="album_main_image" class="d-none" accept="image/*">
            <input type="hidden" name="album_main_image" id="album_main_image_url">

            <button type="button" class="mt-1 btn btn-primary btn-sm w-100"
                onclick="document.getElementById('album_main_image').click()" data-ar="رفع صورة من الجهاز"
                data-en="Upload from Device">رفع صورة من الجهاز</button>
            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mt-1"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="album_main_image" data-ar="إضافة من رابط"
                data-en="Add from URL">إضافة من رابط</button>
            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media mt-1" data-bs-toggle="modal"
                data-bs-target="#mediaModal" data-target="album_main_image" data-type="image" data-ar="اختيار من المعرض"
                data-en="Choose from Media">اختيار من المعرض</button>
        </div>

        <!-- MOBILE IMAGE -->
        <div class="col-md-4">
            <label class="form-label" data-ar="صورة الهاتف المحمول" data-en="Mobile Image">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-album_content_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>
            <input type="file" name="album_content_image" id="album_content_image" class="d-none" accept="image/*">
            <input type="hidden" name="album_content_image" id="album_content_image_url">

            <button type="button" class="mt-1 btn btn-primary btn-sm w-100"
                onclick="document.getElementById('album_content_image').click()" data-ar="رفع صورة من الجهاز"
                data-en="Upload from Device">رفع صورة من الجهاز</button>
            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mt-1"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="album_content_image"
                data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media mt-1"
                data-bs-toggle="modal" data-bs-target="#mediaModal" data-target="album_content_image"
                data-type="image" data-ar="اختيار من المعرض" data-en="Choose from Media">اختيار من المعرض</button>
        </div>

        <!-- CONTENT IMAGE -->
        <div class="col-md-4">
            <label class="form-label" data-ar="صورة المحتوى التفصيلية" data-en="Detailed Content Image">صورة المحتوى
                التفصيلية</label>
            <div class="media-preview border rounded mb-2" id="preview-album_mobile_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>
            <input type="file" name="album_mobile_image" id="album_mobile_image" class="d-none"
                accept="image/*">
            <input type="hidden" name="album_mobile_image" id="album_mobile_image_url">

            <button type="button" class="mt-1 btn btn-primary btn-sm w-100"
                onclick="document.getElementById('album_mobile_image').click()" data-ar="رفع صورة من الجهاز"
                data-en="Upload from Device">رفع صورة من الجهاز</button>
            <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mt-1"
                data-bs-toggle="modal" data-bs-target="#urlModal" data-target="album_mobile_image"
                data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
            <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media mt-1"
                data-bs-toggle="modal" data-bs-target="#mediaModal" data-target="album_mobile_image"
                data-type="image" data-ar="اختيار من المعرض" data-en="Choose from Media">اختيار من المعرض</button>
        </div>

    </div>
</div>

<!-- ================= MODAL URL ================= -->
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

<!-- ================= MODAL MEDIA GALLERY ================= -->
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

<!-- ================= STYLES ================= -->
<style>
    .media-preview {
        border: 2px dashed #ccc !important;
        transition: 0.3s;
    }

    .media-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
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
</style>

<!-- ================= SCRIPT ================= -->
<script>
    const form = document.getElementById('contentForm');

    form.addEventListener('submit', function(e) {
        // Create a DataTransfer to add files to the input
        const dataTransfer = new DataTransfer();
        albumFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('album_images').files = dataTransfer.files;
    });

    /* ================= MULTIPLE ALBUM IMAGES ================= */
    let albumFiles = []; // Array to store selected files
    let albumUrls = []; // Array to store added URLs

    const albumInput = document.getElementById("album_images");

    // Event: File selected from device
    albumInput.addEventListener("change", function(e) {
        const files = Array.from(e.target.files);
        albumFiles = albumFiles.concat(files); // Add files to array
        renderAlbumImages();
        this.value = ""; // Reset input
    });

    // Render multiple images (both files & URLs)
    function renderAlbumImages() {
        const container = document.getElementById("preview-album_images");
        container.innerHTML = "";

        if (albumFiles.length === 0 && albumUrls.length === 0) {
            container.innerHTML = '<span class="text-muted">لا توجد صور مختارة</span>';
            return;
        }

        // Render files
        albumFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement("div");
                div.className = "position-relative";
                div.style.width = "120px";
                div.style.height = "120px";
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-100 h-100 rounded border">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                        onclick="deleteAlbumFile(${index})">✖</button>
                `;
                container.appendChild(div);
            };
            reader.readAsDataURL(file);
        });

        // Render URLs
        albumUrls.forEach((url, index) => {
            const div = document.createElement("div");
            div.className = "position-relative";
            div.style.width = "120px";
            div.style.height = "120px";
            div.innerHTML = `
                <img src="${url}" class="w-100 h-100 rounded border">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                    onclick="deleteAlbumUrl(${index})">✖</button>
            `;
            container.appendChild(div);
        });

        // Update hidden input
        document.getElementById("album_images_urls").value = JSON.stringify(albumUrls);
    }

    function deleteAlbumFile(index) {
        albumFiles.splice(index, 1);
        renderAlbumImages();
    }

    function deleteAlbumUrl(index) {
        albumUrls.splice(index, 1);
        renderAlbumImages();
    }

    /* ================= MULTIPLE IMAGE URL BUTTON ================= */
    document.querySelectorAll('.open-url-multi').forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById("urlTargetInput").value = "album_images";
            document.getElementById("imageUrlInput").value = "";
        });
    });

    /* ================= SAVE URL FROM MODAL ================= */
    document.getElementById("saveUrlBtn").addEventListener("click", function() {
        const url = document.getElementById("imageUrlInput").value;
        const target = document.getElementById("urlTargetInput").value;

        if (!url) return;

        if (target === "album_images") {
            albumUrls.push(url);
            renderAlbumImages();
        } else {
            const inputUrl = document.getElementById(target + "_url");
            const preview = document.getElementById("preview-" + target);
            inputUrl.value = url;
            preview.innerHTML = `<img src="${url}" class="w-100 h-100 rounded">`;
        }

        bootstrap.Modal.getInstance(document.getElementById("urlModal")).hide();
    });

    /* ================= MULTIPLE IMAGE MEDIA LIBRARY ================= */
    document.querySelectorAll('.open-media-multi').forEach(btn => {
        btn.addEventListener("click", async () => {
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
                        albumUrls.push(item.src);
                        renderAlbumImages();
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

    /* ================= SINGLE IMAGE FIELDS ================= */
    ["album_main_image", "album_content_image", "album_mobile_image"].forEach(id => {
        const inputFile = document.getElementById(id);
        const inputUrl = document.getElementById(id + "_url");
        const preview = document.getElementById("preview-" + id);

        // File selected from device
        inputFile.addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.innerHTML =
                    `<img src="${event.target.result}" class="w-100 h-100 rounded">`;
            };
            reader.readAsDataURL(file);
        });

        // Open media library modal
        document.querySelectorAll(`.open-media[data-target='${id}']`).forEach(btn => {
            btn.addEventListener("click", async () => {
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
                            inputUrl.value = item.src;
                            preview.innerHTML =
                                `<img src="${item.src}" class="w-100 h-100 rounded">`;
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
    });
</script>
