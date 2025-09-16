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
                    data-bs-target="#normal-mediaModal" data-target="normal_main_image" data-type="image"
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
                    data-bs-target="#normal-mediaModal" data-target="normal_mobile_image" data-type="image"
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
                    data-bs-target="#normal-mediaModal" data-target="normal_content_image" data-type="image"
                    data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

    </div>
</div>


<!-- ========== MODAL GALLERY ========== -->
<div class="modal fade" id="normal-mediaModal" tabindex="-1" aria-hidden="true">
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
                    <input type="text" id="mediaSearch" class="form-control" placeholder="🔍 ابحث عن وسائط..."
                        data-ar="🔍 ابحث عن وسائط..." data-en="🔍 Search media...">
                </div>

                <!-- Media Grid -->
                <div id="mediaLibraryGrid" class="row g-3 text-center">
                    <p class="text-muted text-center">اختر صورة أو فيديو من المكتبة...</p>
                </div>

                <!-- Pagination -->
                <nav>
                    <ul id="mediaPagination" class="pagination justify-content-center mt-3"></ul>
                </nav>

                <input type="hidden" id="mediaTargetInput">
                <input type="hidden" id="selectedAssetId" name="selected_asset_id">
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-light border" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>



<style>
    /* ====== Media Preview (where selected image shows) ====== */
    .media-preview {
        border: 2px dashed #ccc !important;
        border-radius: 12px;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 140px;
        transition: border-color 0.3s ease, background 0.3s ease;

    }

    .media-preview img,
    .media-preview video {
        max-width: 100%;
        max-height: 100%;
        border-radius: 10px;
        object-fit: contain;
    }

    .media-preview:hover {
        border-color: #007bff !important;
        background: #f0f8ff;
    }

    /* ====== Media Thumbnail (inside modal) ====== */
    .media-thumb {
        position: relative;
        width: 180px;
        height: 140px;
        cursor: pointer;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .media-thumb img,
    .media-thumb video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    /* Hover effect */
    .media-thumb:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
    }

    .media-thumb::after {
        content: attr(data-label);
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .media-thumb:hover::after {
        opacity: 1;
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
</script>


<script>
    // ================= MEDIA MODAL =================
    let currentPage = 1;
    let currentSearch = "";

    async function loadMedia(page = 1, search = "") {
        const grid = document.getElementById("mediaLibraryGrid");
        const pagination = document.getElementById("mediaPagination");
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

                    // تمييز صورة أو فيديو
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
                        let previewBox = document.getElementById(
                            "preview-" + document.getElementById("mediaTargetInput").value
                        );

                        if (type.startsWith("image/")) {
                            previewBox.innerHTML = `<img src="${item.path}" alt="preview">`;
                        } else if (type.startsWith("video/")) {
                            previewBox.innerHTML = `<video src="${item.path}" controls></video>`;
                        } else {
                            previewBox.innerHTML =
                                `<div class="p-3 border rounded">📂 ${item.name ?? "ملف"}</div>`;
                        }
                        
                        document.getElementById(
                            document.getElementById("mediaTargetInput").value + "_url"
                        ).value = item.path;

                        alert("الوسيط ID: " + item.id);
                        bootstrap.Modal.getInstance(document.getElementById("normal-mediaModal"))
                            .hide();
                    };

                    grid.appendChild(div);
                });

                // (Optional) Pagination restore here if needed
                // let links = items.links;
                // pagination.innerHTML = links.map(link =>
                //     `<li class="page-item ${link.active ? 'active' : ''} ${!link.url ? 'disabled' : ''}">
                //         <a class="page-link" href="#" onclick="event.preventDefault(); loadMedia(${new URL(link.url || '').searchParams.get('page') || 1}, currentSearch)">
                //             ${link.label.replace('&laquo;', '«').replace('&raquo;', '»')}
                //         </a>
                //     </li>`
                // ).join("");

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
            document.getElementById("mediaTargetInput").value = target;
            currentPage = 1;
            currentSearch = "";
            loadMedia();
        });
    });

    // Search Handler
    document.getElementById("mediaSearch").addEventListener("keyup", (e) => {
        currentSearch = e.target.value;
        currentPage = 1;
        loadMedia(currentPage, currentSearch);
    });
</script>
