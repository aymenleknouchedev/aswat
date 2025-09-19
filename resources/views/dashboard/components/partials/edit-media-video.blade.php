<div id="media-video-field" class="media-fields-section" style="display: none;">
    <div class="row g-3">

        <!-- ================= MAIN IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label" data-en="Main Image" data-ar="الصورة الأساسية">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-video_main_image"
                style="aspect-ratio: 16/9;">
                @if (!empty($mainImagePaths[0]) && $content->template === 'video')
                    <img src="{{ $mainImagePaths[0] }}" alt="Main Image" class="img-fluid">
                @else
                    <span class="text-muted" data-en="No image selected" data-ar="لا توجد صورة مختارة">لا توجد صورة مختارة</span>
                @endif
            </div>

            <input type="file" name="video_main_image" id="video_main_image" class="d-none" accept="image/*">
            <input type="hidden" name="video_main_image" id="video_main_image_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('video_main_image').click()" data-en="Upload from device"
                    data-ar="رفع صورة من الجهاز">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="video_main_image"
                    data-en="Add from URL" data-ar="إضافة من رابط">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#video-mediaModal" data-target="video_main_image" data-type="image"
                    data-en="Choose from gallery" data-ar="اختيار من المعرض">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= MOBILE IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label" data-en="Mobile Image" data-ar="صورة الهاتف المحمول">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-video_mobile_image"
                style="aspect-ratio: 16/9;">
                @if (!empty($mobileImagePaths[0]) && $content->template === 'video')
                    <img src="{{ $mobileImagePaths[0] }}" alt="Mobile Image" class="img-fluid">
                @else
                    <span class="text-muted" data-en="No image selected" data-ar="لا توجد صورة مختارة">لا توجد صورة مختارة</span>
                @endif
            </div>

            <input type="file" name="video_mobile_image" id="video_mobile_image" class="d-none" accept="image/*">
            <input type="hidden" name="video_mobile_image" id="video_mobile_image_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('video_mobile_image').click()" data-en="Upload from device"
                    data-ar="رفع صورة من الجهاز">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="video_mobile_image"
                    data-en="Add from URL" data-ar="إضافة من رابط">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#video-mediaModal" data-target="video_mobile_image" data-type="image"
                    data-en="Choose from gallery" data-ar="اختيار من المعرض">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= CONTENT IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label" data-en="Content Image" data-ar="صورة المحتوى التفصيلية">صورة المحتوى
                التفصيلية</label>
            <div class="media-preview border rounded mb-2" id="preview-video_content_image"
                style="aspect-ratio: 16/9;">
                @if (!empty($contentImagePaths[0]) && $content->template === 'video')
                    <img src="{{ $contentImagePaths[0] }}" alt="Content Image" class="img-fluid">
                @else
                    <span class="text-muted" data-en="No image selected" data-ar="لا توجد صورة مختارة">لا توجد صورة مختارة</span>
                @endif
            </div>

            <input type="file" name="video_content_image" id="video_content_image" class="d-none" accept="image/*">
            <input type="hidden" name="video_content_image" id="video_content_image_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('video_content_image').click()" data-en="Upload from device"
                    data-ar="رفع صورة من الجهاز">رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="video_content_image"
                    data-en="Add from URL" data-ar="إضافة من رابط">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#video-mediaModal" data-target="video_content_image" data-type="image"
                    data-en="Choose from gallery" data-ar="اختيار من المعرض">اختيار من المعرض</button>
            </div>
        </div>

        <!-- ================= VIDEO ================= -->
        <div class="col-md-3">
            <label class="form-label" data-en="Video" data-ar="الفيديو">الفيديو</label>
            <div id="preview-video_file" class="media-preview border rounded mb-2"
                style="aspect-ratio: 16/9;">
                @if (!empty($videoPaths[0]) && $content->template === 'video')
                    @php
                        $videoUrl = $videoPaths[0];
                        $youtubeMatch = preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/', $videoUrl, $matches);
                    @endphp
                    @if ($youtubeMatch && isset($matches[1]))
                        <iframe width="100%" height="140"
                            src="https://www.youtube.com/embed/{{ $matches[1] }}"
                            frameborder="0" allowfullscreen></iframe>
                    @else
                        <video controls style="max-height:140px; max-width:100%;">
                            <source src="{{ $videoUrl }}">
                            متصفحك لا يدعم عرض الفيديو.
                        </video>
                    @endif
                @else
                    <span class="text-muted" data-en="No video selected" data-ar="لا يوجد فيديو محدد">لا يوجد فيديو محدد</span>
                @endif
            </div>

            <input type="file" name="video_file" id="video_file" class="d-none" accept="video/*">
            <input type="hidden" name="video_file" id="video_file_url">

            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary btn-sm w-100 mb-1"
                    onclick="document.getElementById('video_file').click()" data-en="Upload from device"
                    data-ar="رفع فيديو من الجهاز">رفع فيديو من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal mb-1"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="video_file"
                    data-en="Add from URL" data-ar="إضافة من رابط">إضافة من رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#video-mediaModal" data-target="video_file" data-type="video"
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
<div class="modal fade" id="video-mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">📚 مكتبة الوسائط</h5>
                <button type="button" class="btn-close shadow-sm" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="mediaSearchVideo" class="form-control"
                        placeholder="🔍 ابحث عن وسائط...">
                </div>

                <!-- Media Grid -->
                <div id="mediaLibraryGridVideo" class="row g-3 text-center">
                    <p class="text-muted text-center">اختر صورة أو فيديو من المكتبة...</p>
                </div>

                <!-- Pagination -->
                <nav>
                    <ul id="mediaPaginationVideo" class="pagination justify-content-center mt-3"></ul>
                </nav>

                <input type="hidden" id="mediaTargetInputVideo">
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




<script>
    let currentPageVideo = 1;
    let currentSearchVideo = "";

    async function loadMediaVideo(page = 1, search = "") {
        const grid = document.getElementById("mediaLibraryGridVideo");
        const pagination = document.getElementById("mediaPaginationVideo");
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
                        const target = document.getElementById("mediaTargetInputVideo").value;
                        const previewBox = document.getElementById("preview-" + target);

                        if (type.startsWith("image/")) {
                            previewBox.innerHTML = `<img src="${item.path}" alt="preview">`;
                        } else if (type.startsWith("video/")) {
                            previewBox.innerHTML = `<video src="${item.path}" controls></video>`;
                        } else {
                            previewBox.innerHTML =
                                `<div class="p-3 border rounded">📂 ${item.name ?? "ملف"}</div>`;
                        }

                        document.getElementById(target + "_url").value = item.path;
                        bootstrap.Modal.getInstance(document.getElementById("video-mediaModal")).hide();
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
            if (btn.dataset.bsTarget === "#video-mediaModal") {
                const target = btn.dataset.target;
                document.getElementById("mediaTargetInputVideo").value = target;
                currentPageVideo = 1;
                currentSearchVideo = "";
                loadMediaVideo();
            }
        });
    });

    document.getElementById("mediaSearchVideo").addEventListener("keyup", (e) => {
        currentSearchVideo = e.target.value;
        currentPageVideo = 1;
        loadMediaVideo(currentPageVideo, currentSearchVideo);
    });
</script>


