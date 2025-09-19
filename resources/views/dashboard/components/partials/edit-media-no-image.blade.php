<div id="media-no_image-field" class="media-fields-section" style="display: block;">
    <div class="row g-3">

        <!-- ================= MAIN IMAGE ================= -->
        <div class="col-md-6">
            <label class="form-label" data-ar="الصورة الأساسية" data-en="Main Image">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-no_image_main_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>

            <input type="file" name="no_image_main_image" id="no_image_main_image" class="d-none" accept="image/*">
            <input type="hidden" name="no_image_main_image" id="no_image_main_image_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('no_image_main_image').click()" data-ar="رفع صورة من الجهاز"
                    data-en="Upload from device">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="no_image_main_image"
                    data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#no_image-mediaModal" data-target="no_image_main_image" data-type="image"
                    data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= MOBILE IMAGE ================= -->
        <div class="col-md-6">
            <label class="form-label" data-ar="صورة الهاتف المحمول" data-en="Mobile Image">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-no_image_mobile_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>

            <input type="file" name="no_image_mobile_image" id="no_image_mobile_image" class="d-none"
                accept="image/*">
            <input type="hidden" name="no_image_mobile_image" id="no_image_mobile_image_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('no_image_mobile_image').click()" data-ar="رفع صورة من الجهاز"
                    data-en="Upload from device">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="no_image_mobile_image"
                    data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#no_image-mediaModal" data-target="no_image_mobile_image" data-type="image"
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
<div class="modal fade" id="no_image-mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" data-ar="📚 مكتبة الوسائط" data-en="📚 Media Library">
                    📚 مكتبة الوسائط
                </h5>
                <button type="button" class="btn-close shadow-sm" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="no_image_mediaSearch" class="form-control"
                        placeholder="🔍 ابحث عن وسائط..." data-ar="🔍 ابحث عن وسائط..." data-en="🔍 Search media...">
                </div>

                <!-- Media Grid -->
                <div id="no_image_mediaLibraryGrid" class="row g-3 text-center">
                    <p class="text-muted text-center">اختر صورة أو فيديو من المكتبة...</p>
                </div>

                <!-- Pagination -->
                <nav>
                    <ul id="no_image_mediaPagination" class="pagination justify-content-center mt-3"></ul>
                </nav>

                <input type="hidden" id="no_image_mediaTargetInput">
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-light border" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>



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

    
</script>



<script>
    // ================= MEDIA MODAL =================
    let no_image_currentPage = 1;
    let no_image_currentSearch = "";

    async function loadNoImageMedia(page = 1, search = "") {
        const grid = document.getElementById("no_image_mediaLibraryGrid");
        const pagination = document.getElementById("no_image_mediaPagination");
        grid.innerHTML = `<p>⏳ جاري تحميل الوسائط...</p>`;
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
                    div.setAttribute("data-label", "اختر");

                    const type = item.media_type?.toLowerCase() || "";

                    if (type.startsWith("image/")) {
                        div.innerHTML = `<img src="${item.path}" alt="${item.name ?? ''}">`;
                    } else if (type.startsWith("video/")) {
                        div.innerHTML = `<video src="${item.path}" muted></video>`;
                    } else {
                        div.innerHTML = `<div class="d-flex align-items-center justify-content-center bg-light h-100">
                                            <span class="text-muted">📂 ملف</span>
                                         </div>`;
                    }

                    div.onclick = () => {
                        let target = document.getElementById("no_image_mediaTargetInput").value;
                        let previewBox = document.getElementById("preview-" + target);

                        if (type.startsWith("image/")) {
                            previewBox.innerHTML = `<img src="${item.path}" alt="preview">`;
                        } else if (type.startsWith("video/")) {
                            previewBox.innerHTML = `<video src="${item.path}" controls></video>`;
                        } else {
                            previewBox.innerHTML = `<div class="p-3 border rounded">📂 ${item.name ?? "ملف"}</div>`;
                        }

                        document.getElementById(target + "_url").value = item.path;

                        bootstrap.Modal.getInstance(document.getElementById("no_image-mediaModal")).hide();
                    };

                    grid.appendChild(div);
                });

            } else {
                grid.innerHTML = `<p>❌ لا توجد وسائط</p>`;
            }
        } catch (error) {
            grid.innerHTML = `<p>❌ خطأ في تحميل الوسائط</p>`;
            console.error("Error fetching media:", error);
        }
    }

    // Open Modal
    document.querySelectorAll('.open-media').forEach(btn => {
        btn.addEventListener("click", () => {
            const target = btn.dataset.target;
            document.getElementById("no_image_mediaTargetInput").value = target;
            no_image_currentPage = 1;
            no_image_currentSearch = "";
            loadNoImageMedia();
        });
    });

    // Search Handler
    document.getElementById("no_image_mediaSearch").addEventListener("keyup", (e) => {
        no_image_currentSearch = e.target.value;
        no_image_currentPage = 1;
        loadNoImageMedia(no_image_currentPage, no_image_currentSearch);
    });
</script>