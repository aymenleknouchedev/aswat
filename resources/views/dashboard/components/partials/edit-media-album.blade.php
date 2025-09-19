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
                data-bs-toggle="modal" data-bs-target="#album-mediaModal" data-target="album_images" data-type="image"
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
                data-bs-target="#single-mediaModal" data-target="album_main_image" data-type="image"
                data-ar="اختيار من المعرض" data-en="Choose from Media">اختيار من المعرض</button>
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
                data-bs-toggle="modal" data-bs-target="#single-mediaModal" data-target="album_content_image"
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
                data-bs-toggle="modal" data-bs-target="#single-mediaModal" data-target="album_mobile_image"
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




<!-- ================= ALBUM MEDIA MODAL ================= -->
<div class="modal fade" id="album-mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">📚 مكتبة الوسائط (ألبوم)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Search -->
                <div class="mb-3">
                    <input type="text" id="album_mediaSearch" class="form-control"
                        placeholder="🔍 ابحث عن الصور...">
                </div>

                <!-- Grid -->
                <div id="album_mediaLibraryGrid" class="row g-3 text-center">
                    <p class="text-muted">⏳ جاري تحميل الصور...</p>
                </div>

                <!-- Pagination -->
                <nav>
                    <ul id="album_mediaPagination" class="pagination justify-content-center mt-3"></ul>
                </nav>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-light border" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>



<!-- ================= SINGLE IMAGE MEDIA MODAL ================= -->
<div class="modal fade" id="single-mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">🖼 مكتبة الوسائط (صورة واحدة)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="single_mediaSearch" class="form-control"
                        placeholder="🔍 ابحث عن الصور...">
                </div>
                <div id="single_mediaLibraryGrid" class="row g-3 text-center">
                    <p class="text-muted">⏳ جاري تحميل الصور...</p>
                </div>
                <nav>
                    <ul id="single_mediaPagination" class="pagination justify-content-center mt-3"></ul>
                </nav>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-light border" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>




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
                            "album-mediaModal")).hide();
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


    });
</script>



<script>
    /* ================= MULTIPLE IMAGE MEDIA LIBRARY ================= */
    let album_currentPage = 1;
    let album_currentSearch = "";

    async function loadAlbumMedia(page = 1, search = "") {
        const grid = document.getElementById("album_mediaLibraryGrid");
        const pagination = document.getElementById("album_mediaPagination");

        grid.innerHTML = "<p>⏳ جاري تحميل الصور...</p>";
        pagination.innerHTML = "";

        try {
            const response = await fetch(
                `{{ route('dashboard.media.getAllMediaPaginated') }}?page=${page}&search=${encodeURIComponent(search)}`
            );
            const items = await response.json();

            grid.innerHTML = "";

            if (items.data && items.data.length > 0) {
                items.data.forEach(item => {
                    const div = document.createElement("div");
                    div.className = "media-thumb col-md-3";
                    div.innerHTML = `<img src="${item.path}" alt="">`;

                    div.onclick = () => {
                        albumUrls.push(item.path);
                        renderAlbumImages();
                        bootstrap.Modal.getInstance(document.getElementById("album-mediaModal")).hide();
                    };

                    grid.appendChild(div);
                });

                // TODO: لو حاب نضيف Pagination هنا ممكن أجهزلك الكود
            } else {
                grid.innerHTML = "<p>❌ لا توجد صور</p>";
            }
        } catch (e) {
            grid.innerHTML = "<p>❌ فشل تحميل الوسائط</p>";
            console.error(e);
        }
    }

    // فتح المودال
    document.querySelectorAll('.open-media-multi').forEach(btn => {
        btn.addEventListener("click", () => {
            album_currentPage = 1;
            album_currentSearch = "";
            loadAlbumMedia();
        });
    });

    // البحث داخل المودال
    document.getElementById("album_mediaSearch").addEventListener("keyup", (e) => {
        album_currentSearch = e.target.value;
        album_currentPage = 1;
        loadAlbumMedia(album_currentPage, album_currentSearch);
    });
</script>




<script>
    let single_currentTarget = null;

    async function loadSingleMedia(page = 1, search = "") {
        const grid = document.getElementById("single_mediaLibraryGrid");
        const pagination = document.getElementById("single_mediaPagination");

        grid.innerHTML = "<p>⏳ جاري تحميل الصور...</p>";
        pagination.innerHTML = "";

        try {
            const response = await fetch(
                `{{ route('dashboard.media.getAllMediaPaginated') }}?page=${page}&search=${encodeURIComponent(search)}`
            );
            const items = await response.json();
            grid.innerHTML = "";

            if (items.data && items.data.length > 0) {
                items.data.forEach(item => {
                    const div = document.createElement("div");
                    div.className = "media-thumb col-md-3";
                    div.innerHTML = `<img src="${item.path}" alt="">`;

                    div.onclick = () => {
                        // حدد الهدف (input + preview)
                        const inputUrl = document.getElementById(single_currentTarget + "_url");
                        const preview = document.getElementById("preview-" + single_currentTarget);

                        inputUrl.value = item.path;
                        preview.innerHTML = `<img src="${item.path}" class="w-100 h-100 rounded">`;

                        bootstrap.Modal.getInstance(document.getElementById("single-mediaModal"))
                            .hide();
                    };

                    grid.appendChild(div);
                });
            } else {
                grid.innerHTML = "<p>❌ لا توجد صور</p>";
            }
        } catch (e) {
            grid.innerHTML = "<p>❌ فشل تحميل الوسائط</p>";
            console.error(e);
        }
    }

    // زر فتح المودال
    document.querySelectorAll('.open-media').forEach(btn => {
        btn.addEventListener("click", () => {
            single_currentTarget = btn.getAttribute("data-target"); // مثال: album_main_image
            loadSingleMedia();
        });
    });

    // البحث داخل المودال
    document.getElementById("single_mediaSearch").addEventListener("keyup", (e) => {
        loadSingleMedia(1, e.target.value);
    });
</script>
