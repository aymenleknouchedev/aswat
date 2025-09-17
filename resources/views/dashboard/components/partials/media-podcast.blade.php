<div id="media-podcast-field" class="media-fields-section" style="display: none;">
    <div class="row g-3">

        <!-- ================= MAIN IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label" data-ar="الصورة الأساسية" data-en="Main Image">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-podcast_main_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>

            <input type="file" name="podcast_main_image" id="podcast_main_image" class="d-none" accept="image/*">
            <input type="hidden" name="podcast_main_image" id="podcast_main_image_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('podcast_main_image').click()" data-ar="رفع صورة من الجهاز"
                    data-en="Upload from device">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="podcast_main_image"
                    data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#podcast-mediaModal" data-target="podcast_main_image" data-type="image"
                    data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= MOBILE IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label" data-ar="صورة الهاتف المحمول" data-en="Mobile Image">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-podcast_mobile_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>

            <input type="file" name="podcast_mobile_image" id="podcast_mobile_image" class="d-none" accept="image/*">
            <input type="hidden" name="podcast_mobile_image" id="podcast_mobile_image_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('podcast_mobile_image').click()" data-ar="رفع صورة من الجهاز"
                    data-en="Upload from device">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="podcast_mobile_image"
                    data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#podcast-mediaModal" data-target="podcast_mobile_image" data-type="image"
                    data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= CONTENT IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label" data-ar="صورة المحتوى التفصيلية" data-en="Content Image">صورة المحتوى
                التفصيلية</label>
            <div class="media-preview border rounded mb-2" id="preview-podcast_content_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا توجد صورة مختارة" data-en="No image selected">لا توجد صورة
                    مختارة</span>
            </div>

            <input type="file" name="podcast_content_image" id="podcast_content_image" class="d-none"
                accept="image/*">
            <input type="hidden" name="podcast_content_image" id="podcast_content_image_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('podcast_content_image').click()" data-ar="رفع صورة من الجهاز"
                    data-en="Upload from device">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="podcast_content_image"
                    data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#podcast-mediaModal" data-target="podcast_content_image" data-type="image"
                    data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= PODCAST ================= -->
        <div class="col-md-3">
            <label class="form-label" data-ar="البودكاست" data-en="Podcast">البودكاست</label>
            <div id="preview-podcast_file" class="media-preview border rounded mb-2"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted" data-ar="لا يوجد بودكاست محدد" data-en="No podcast selected">لا يوجد بودكاست
                    محدد</span>
            </div>

            <input type="file" name="podcast_file" id="podcast_file" class="d-none" accept="audio/*">
            <input type="hidden" name="podcast_file" id="podcast_file_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('podcast_file').click()" data-ar="رفع بودكاست من الجهاز"
                    data-en="Upload podcast from device">رفع بودكاست من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="podcast_file"
                    data-ar="إضافة من رابط" data-en="Add from URL">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#podcast-mediaModal" data-target="podcast_file" data-type="audio"
                    data-ar="اختيار من المعرض" data-en="Choose from gallery">اختيار من المعرض</button>
            </div>
        </div>

    </div>
</div>

<!-- ========== MODAL GALLERY (Podcast) ========== -->
<div class="modal fade" id="podcast-mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">📚 مكتبة الوسائط</h5>
                <button type="button" class="btn-close shadow-sm" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="mediaSearchPodcast" class="form-control"
                        placeholder="🔍 ابحث عن وسائط...">
                </div>
                <!-- Media Grid -->
                <div id="mediaLibraryGridPodcast" class="row g-3 text-center">
                    <p class="text-muted text-center">اختر صورة أو بودكاست من المكتبة...</p>
                </div>
                <!-- Pagination -->
                <nav>
                    <ul id="mediaPaginationPodcast" class="pagination justify-content-center mt-3"></ul>
                </nav>
                <input type="hidden" id="mediaTargetInputPodcast">
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
    // ================= FILE UPLOAD (images) =================
    ["podcast_main_image", "podcast_mobile_image", "podcast_content_image"].forEach(id => {
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

    // ================= FILE UPLOAD (podcast audio) =================
    document.getElementById("podcast_file").addEventListener("change", function(e) {
        const file = e.target.files[0];
        if (file) {
            const url = URL.createObjectURL(file);
            document.getElementById("preview-podcast_file").innerHTML =
                `<audio controls style="max-width:100%;">
                    <source src="${url}" type="${file.type}">
                    متصفحك لا يدعم تشغيل الصوت.
                 </audio>`;
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
            if (target === "podcast_file") {
                updatePodcastPreview(url);
                document.getElementById(target + "_url").value = url;
            } else {
                document.getElementById("preview-" + target).innerHTML =
                    `<img src="${url}" alt="preview">`;
                document.getElementById(target + "_url").value = url;
            }
            bootstrap.Modal.getInstance(document.getElementById("urlModal")).hide();
        }
    });


    // ================= PODCAST PREVIEW FUNCTION =================
    function updatePodcastPreview(url) {
        const preview = document.getElementById("preview-podcast_file");
        if (!url) {
            preview.innerHTML =
                `<span class="text-muted" data-ar="لا يوجد بودكاست محدد" data-en="No podcast selected">لا يوجد بودكاست محدد</span>`;
            return;
        }
        preview.innerHTML = `
            <audio controls style="max-width:100%;">
                <source src="${url}">
                متصفحك لا يدعم تشغيل الصوت.
            </audio>`;
    }
</script>





<script>
    let currentPagePodcast = 1;
    let currentSearchPodcast = "";

    async function loadMediaPodcast(page = 1, search = "") {
        const grid = document.getElementById("mediaLibraryGridPodcast");
        grid.innerHTML = `<p>⏳ جاري تحميل الوسائط...</p>`;

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
                    } else if (type.startsWith("audio/")) {
                        div.innerHTML =
                            `<div class="p-3 border rounded bg-light">🎵 ${item.name ?? 'ملف صوت'}</div>`;
                    } else {
                        div.innerHTML =
                            `<div class="p-3 border rounded bg-light">📂 ${item.name ?? 'ملف'}</div>`;
                    }

                    div.onclick = () => {
                        const target = document.getElementById("mediaTargetInputPodcast").value;
                        const previewBox = document.getElementById("preview-" + target);

                        if (type.startsWith("image/")) {
                            previewBox.innerHTML = `<img src="${item.path}" alt="preview">`;
                        } else if (type.startsWith("audio/")) {
                            previewBox.innerHTML =
                                `<audio controls style="max-width:100%;"><source src="${item.path}"></audio>`;
                        } else {
                            previewBox.innerHTML =
                                `<div class="p-3 border rounded">📂 ${item.name ?? "ملف"}</div>`;
                        }

                        document.getElementById(target + "_url").value = item.path;
                        bootstrap.Modal.getInstance(document.getElementById("podcast-mediaModal"))
                        .hide();
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

    document.querySelectorAll('.open-media').forEach(btn => {
        btn.addEventListener("click", () => {
            if (btn.dataset.bsTarget === "#podcast-mediaModal") {
                const target = btn.dataset.target;
                document.getElementById("mediaTargetInputPodcast").value = target;
                currentPagePodcast = 1;
                currentSearchPodcast = "";
                loadMediaPodcast();
            }
        });
    });

    document.getElementById("mediaSearchPodcast").addEventListener("keyup", (e) => {
        currentSearchPodcast = e.target.value;
        currentPagePodcast = 1;
        loadMediaPodcast(currentPagePodcast, currentSearchPodcast);
    });
</script>


