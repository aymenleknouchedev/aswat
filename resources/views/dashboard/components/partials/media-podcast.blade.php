<div id="media-podcast-field" class="media-fields-section" style="display: none;">
    <div class="row g-3">

        <!-- ================= MAIN IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label">الصورة الأساسية</label>
            <div class="media-preview border rounded mb-2" id="preview-podcast_main_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>

            <input type="file" name="podcast_main_image" id="podcast_main_image" class="d-none" accept="image/*">
            <input type="hidden" name="podcast_main_image" id="podcast_main_image_url">

            <div class="d-flex flex-column gap-2">
                <button type="button" class="btn btn-primary btn-sm w-100"
                    onclick="document.getElementById('podcast_main_image').click()">📤 رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="podcast_main_image">🔗 إضافة من
                    رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#mediaModal" data-target="podcast_main_image" data-type="image">🖼️ اختيار من
                    المعرض</button>
            </div>
        </div>

        <!-- ================= MOBILE IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label">صورة الهاتف المحمول</label>
            <div class="media-preview border rounded mb-2" id="preview-podcast_mobile_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>

            <input type="file" name="podcast_mobile_image" id="podcast_mobile_image" class="d-none" accept="image/*">
            <input type="hidden" name="podcast_mobile_image" id="podcast_mobile_image_url">

            <div class="d-flex flex-column gap-2">
                <button type="button" class="btn btn-primary btn-sm w-100"
                    onclick="document.getElementById('podcast_mobile_image').click()">📤 رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="podcast_mobile_image">🔗 إضافة من
                    رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#mediaModal" data-target="podcast_mobile_image" data-type="image">🖼️ اختيار من
                    المعرض</button>
            </div>
        </div>

        <!-- ================= CONTENT IMAGE ================= -->
        <div class="col-md-3">
            <label class="form-label">صورة المحتوى التفصيلية</label>
            <div class="media-preview border rounded mb-2" id="preview-podcast_content_image"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا توجد صورة مختارة</span>
            </div>

            <input type="file" name="podcast_content_image" id="podcast_content_image" class="d-none"
                accept="image/*">
            <input type="hidden" name="podcast_content_image" id="podcast_content_image_url">

            <div class="d-flex flex-column gap-2">
                <button type="button" class="btn btn-primary btn-sm w-100"
                    onclick="document.getElementById('podcast_content_image').click()">📤 رفع صورة من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="podcast_content_image">🔗 إضافة من
                    رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#mediaModal" data-target="podcast_content_image" data-type="image">🖼️ اختيار من
                    المعرض</button>
            </div>
        </div>

        <!-- ================= PODCAST ================= -->
        <div class="col-md-3">
            <label class="form-label">البودكاست</label>
            <div id="preview-podcast_file" class="media-preview border rounded mb-2"
                style="aspect-ratio: 16/9; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">لا يوجد بودكاست محدد</span>
            </div>

            <input type="file" name="podcast_file" id="podcast_file" class="d-none" accept="audio/*">
            <input type="hidden" name="podcast_file" id="podcast_file_url">

            <div class="d-flex flex-column gap-2">
                <button type="button" class="btn btn-primary btn-sm w-100"
                    onclick="document.getElementById('podcast_file').click()">📤 رفع بودكاست من الجهاز</button>
                <button type="button" class="btn btn-outline-secondary btn-sm w-100 open-url-modal"
                    data-bs-toggle="modal" data-bs-target="#urlModal" data-target="podcast_file">🔗 إضافة من
                    رابط</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-100 open-media" data-bs-toggle="modal"
                    data-bs-target="#mediaModal" data-target="podcast_file" data-type="audio">🎧 اختيار من
                    المعرض</button>
            </div>
        </div>

    </div>
</div>

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
                        if (type === "audio") {
                            updatePodcastPreview(item.src);
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

    // ================= PODCAST PREVIEW FUNCTION =================
    function updatePodcastPreview(url) {
        const preview = document.getElementById("preview-podcast_file");
        if (!url) {
            preview.innerHTML = `<span class="text-muted">لا يوجد بودكاست محدد</span>`;
            return;
        }
        preview.innerHTML = `
            <audio controls style="max-width:100%;">
                <source src="${url}">
                متصفحك لا يدعم تشغيل الصوت.
            </audio>`;
    }
</script>
