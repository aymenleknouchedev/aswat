<!-- ===================== DYNAMIC LIST (PER-MODE STATE, FLAT UI) ===================== -->
<div id="list-items-hidden-inputs"></div>

<div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="template-tab">
    <div class="form-group col-lg-12 mb-2">
        <label class="form-label">القالب</label><span style="color:#c00;"> *</span>

        <!-- Radios natifs -->
        <div id="display-method-group" style="display:flex; gap:1.25rem; align-items:center; flex-wrap:wrap;">
            <label>
                <input type="radio" name="display_method" id="display_method_simple" value="simple">
                <span>أساسي</span>
            </label>
            <label>
                <input type="radio" name="display_method" id="display_method_list" value="list">
                <span>قائمة</span>
            </label>
            <label>
                <input type="radio" name="display_method" id="display_method_file" value="file" checked>
                <span>ملف</span>
            </label>
        </div>
    </div>

    <!-- Section dynamique (affichée pour list/file uniquement) -->
    <div id="dynamic-items-section" class="mt-3" hidden>
        <div class="header-row">
            <h6 class="m-0" id="modeTitle">العناصر (ملف)</h6>
            <button type="button" id="add-item-btn" class="btn-flat btn-primary-flat">+ Add Item</button>
        </div>

        <div class="muted" id="modeHelp" style="margin-bottom:.5rem;">في وضع "ملف": URL غير إلزامي.</div>

        <div id="items-container" class="items-container"></div>
        <small class="muted">اسحب المقبض لترتيب العناصر.</small>
    </div>
</div>

<!-- ===================== Modal (scrollable, radius 0) ===================== -->
<div id="itemModal" class="mmodal" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="mmodal-backdrop" data-close-modal></div>

    <div class="mmodal-dialog" role="document" aria-labelledby="mmodal-title">
        <div class="mmodal-header">
            <h5 id="mmodal-title" class="mmodal-title">Add / Edit Item</h5>
            <button type="button" class="mmodal-close" title="Close" aria-label="Close"
                data-close-modal>&times;</button>
        </div>

        <div class="mmodal-body">
            <input type="hidden" id="editIndex" />

            <div class="flat-field">
                <label class="flat-label" for="itemTitle">Title <span class="req">*</span></label>
                <input id="itemTitle" class="flat-input" autocomplete="off">
            </div>

            <div class="flat-field">
                <label class="flat-label" for="itemDescription">Description <span class="req">*</span></label>
                <textarea id="itemDescription" class="flat-input flat-textarea" rows="3"></textarea>
            </div>

            <div class="flat-field">
                <label class="flat-label" for="itemImage">Image <span class="req">*</span></label>

                <label class="filebox">
                    <input id="itemImage" type="file" accept="image/*">
                    <span class="filebox-label">Choose image…</span>
                    <span class="filebox-hint">PNG/JPG · Max ~10MB</span>
                </label>

                <div id="imagePreview" class="img-preview-thumb" aria-live="polite"></div>
                <div id="imageActions" class="img-actions" hidden>
                    <button type="button" class="btn-flat btn-light-flat" id="viewFullBtn">View full</button>
                    <button type="button" class="btn-flat btn-light-flat" id="clearImgBtn">Remove</button>
                    <span id="keepNote" class="muted" style="margin-inline-start:.5rem;"></span>
                </div>
            </div>

            <div class="flat-field">
                <label class="flat-label" for="itemUrl">URL <span id="urlReqMark" class="req"
                        style="display:none;">*</span></label>
                <input id="itemUrl" type="url" class="flat-input" placeholder="https://example.com">
                <small class="muted" id="urlHelp">URL required only in “List” mode.</small>
            </div>
        </div>

        <div class="mmodal-footer">
            <button id="saveItemBtn" type="button" class="btn-flat btn-primary-flat">Save Item</button>
            <button type="button" class="btn-flat btn-light-flat" data-close-modal>Cancel</button>
        </div>
    </div>
</div>

<!-- ===================== Styles (blanc/gris, radius 0) ===================== -->
<style>
    :root {
        --bg: #ffffff;
        --bg-soft: #f6f6f7;
        --line: #e2e3e6;
        --ink: #1d1f23;
        --ink-2: #44474d;
        --muted: #8a8f98;
        --blue: #0d6efd;
        --blue-ink: #0a58ca;
    }

    /* Radius=0 */
    .btn-flat,
    .flat-input,
    .mmodal-dialog,
    .item-card,
    .filebox,
    .flat-textarea {
        border-radius: 0 !important;
    }

    .muted {
        color: var(--muted);
    }

    .req {
        color: #c00;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .m-0 {
        margin: 0;
    }

    .header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: .25rem 0;
    }

    .items-container {
        display: grid;
        gap: .5rem;
    }

    .item-card {
        background: var(--bg);
        border: 1px solid var(--line);
    }

    .item-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        padding: .5rem .75rem;
        border-inline-start: 3px solid var(--blue);
    }

    .left {
        display: flex;
        align-items: center;
        gap: .75rem;
        min-width: 0;
    }

    .handle {
        cursor: grab;
        user-select: none;
        opacity: .75;
        font-size: 1.1rem;
    }

    .idx {
        width: 26px;
        height: 26px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eee;
        color: #222;
        font-weight: 700;
        border: 1px solid var(--line);
    }

    .title {
        font-weight: 600;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 42vw;
    }

    .actions .btn-flat {
        margin-inline-start: .35rem;
    }

    .btn-flat {
        appearance: none;
        background: #f3f4f6;
        color: var(--ink);
        border: 1px solid var(--line);
        padding: .4rem .7rem;
        cursor: pointer;
    }

    .btn-flat:focus {
        outline: 2px solid #cdd6f6;
        outline-offset: 2px;
    }

    .btn-primary-flat {
        background: #f0f6ff;
        color: var(--blue-ink);
        border-color: #cfe0ff;
    }

    .btn-primary-flat:hover {
        background: #e6f0ff;
    }

    .btn-light-flat:hover {
        background: #eceef1;
    }

    .flat-field {
        margin-bottom: .9rem;
    }

    .flat-label {
        display: block;
        margin-bottom: .35rem;
        color: var(--ink-2);
        font-weight: 600;
    }

    .flat-input {
        width: 100%;
        background: var(--bg);
        color: var(--ink);
        border: 1px solid var(--line);
        padding: .5rem .6rem;
    }

    .flat-input:focus {
        outline: 2px solid #dfe6ff;
        border-color: #b9c8ff;
    }

    .flat-textarea {
        resize: vertical;
        min-height: 90px;
    }

    .filebox {
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .5rem .6rem;
        border: 1px solid var(--line);
        background: var(--bg-soft);
    }

    .filebox input[type="file"] {
        all: unset;
    }

    .filebox-label {
        font-weight: 600;
        color: var(--blue-ink);
        cursor: pointer;
    }

    .filebox-hint {
        color: var(--muted);
        font-size: .88rem;
    }

    /* Preview réduit */
    .img-preview-thumb {
        margin-top: .5rem;
        width: 160px;
        height: 120px;
        border: 1px solid var(--line);
        background: #fff center center / cover no-repeat;
    }

    .img-actions {
        margin-top: .35rem;
        display: flex;
        align-items: center;
        gap: .35rem;
    }

    /* Modal */
    .mmodal {
        position: fixed;
        inset: 0;
        display: none;
        z-index: 1050;
    }

    .mmodal[aria-hidden="false"] {
        display: block;
    }

    .mmodal-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .35);
    }

    .mmodal-dialog {
        position: relative;
        margin: 6vh auto;
        max-width: 640px;
        background: var(--bg);
        border: 1px solid var(--line);
        max-height: 88vh;
        display: flex;
        flex-direction: column;
    }

    .mmodal-header,
    .mmodal-footer {
        padding: .6rem .9rem;
        border-bottom: 1px solid var(--line);
        background: #fff;
    }

    .mmodal-footer {
        border-top: 1px solid var(--line);
        border-bottom: none;
        display: flex;
        justify-content: flex-end;
        gap: .5rem;
    }

    .mmodal-title {
        margin: 0;
        font-weight: 700;
        color: var(--ink);
    }

    .mmodal-body {
        padding: .9rem;
        overflow: auto;
        background: #fff;
    }

    @media (max-width: 640px) {
        .title {
            max-width: 58vw;
        }

        .mmodal-dialog {
            margin: 4vh 10px;
        }
    }
</style>

<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" defer></script>

<script>
    (function() {
        "use strict";
        const $ = (s, r = document) => r.querySelector(s);
        const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));
        const escapeHtml = (s) => String(s).replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;');

        // Elements
        const section = $("#dynamic-items-section");
        const container = $("#items-container");
        const addBtn = $("#add-item-btn");
        const modeTitle = $("#modeTitle");
        const modeHelp = $("#modeHelp");

        const modal = $("#itemModal");
        const closeEls = $$("[data-close-modal]", modal);
        const editIndex = $("#editIndex");
        const inputTitle = $("#itemTitle");
        const inputDesc = $("#itemDescription");
        const inputImg = $("#itemImage");
        const inputUrl = $("#itemUrl");
        const urlReqMark = $("#urlReqMark");
        const urlHelp = $("#urlHelp");
        const preview = $("#imagePreview");
        const imgActions = $("#imageActions");
        const viewFull = $("#viewFullBtn");
        const clearImg = $("#clearImgBtn");
        const keepNote = $("#keepNote");
        const saveBtn = $("#saveItemBtn");

        const mainForm = document.getElementById("contentForm") || document.querySelector("form");
        const hiddenBox = document.getElementById("list-items-hidden-inputs");

        // State par mode
        const itemsByMode = {
            list: [],
            file: []
        };
        let blobUrl = null;

        function selectedMethod() {
            const x = document.querySelector('input[name="display_method"]:checked');
            return x ? x.value : null;
        }

        function currentItems() {
            return itemsByMode[selectedMethod()] || [];
        }

        // UI helpers
        function applySectionVisibility() {
            const m = selectedMethod();
            const show = (m === "list" || m === "file");
            section.hidden = !show;

            // Titre/texte d'aide
            if (m === "list") {
                modeTitle.textContent = "العناصر (قائمة)";
                modeHelp.textContent = "في وضع \"قائمة\": URL إلزامي لكل عنصر.";
            } else if (m === "file") {
                modeTitle.textContent = "العناصر (ملف)";
                modeHelp.textContent = "في وضع \"ملف\": URL غير إلزامي.";
            }

            // Indice visuel داخل المودال
            const needUrl = (m === "list");
            urlReqMark.style.display = needUrl ? "" : "none";
            urlHelp.textContent = needUrl ? "URL is required in “List” mode." : "URL required only in “List” mode.";
        }

        function renderItems() {
            const items = currentItems();
            container.innerHTML = "";
            items.forEach((it, i) => {
                const card = document.createElement("div");
                card.className = "item-card";
                card.innerHTML = `
        <div class="item-row">
          <div class="left">
            <span class="handle" title="Drag" aria-label="Drag">&#8942;&#8942;</span>
            <span class="idx">${i+1}</span>
            <span class="title" title="${escapeHtml(it.title)}">${escapeHtml(it.title)}</span>
          </div>
          <div class="actions">
            <button type="button" class="btn-flat btn-light-flat" data-act="edit">Edit</button>
            <button type="button" class="btn-flat btn-light-flat" data-act="del">Delete</button>
          </div>
        </div>
      `;

                card.querySelector('[data-act="edit"]').addEventListener("click", () => {
                    editIndex.value = String(i);
                    inputTitle.value = it.title;
                    inputDesc.value = it.description;
                    inputUrl.value = it.url || "";
                    inputImg.value = ""; // le file input ne peut pas être prérempli
                    showExistingPreview(it.file, it.url);
                    openModal();
                });

                card.querySelector('[data-act="del"]').addEventListener("click", () => {
                    if (confirm("Delete this item?")) {
                        items.splice(i, 1);
                        renderItems();
                    }
                });

                container.appendChild(card);
            });
            initSortable(); // réinitialiser le DnD pour la liste affichée
        }

        function openModal() {
            modal.setAttribute("aria-hidden", "false");
        }

        function closeModal() {
            modal.setAttribute("aria-hidden", "true");
        }
        closeEls.forEach(el => el.addEventListener("click", closeModal));
        modal.addEventListener("click", e => {
            if (e.target.hasAttribute("data-close-modal")) closeModal();
        });
        document.addEventListener("keydown", e => {
            if (e.key === "Escape") closeModal();
        });

        function resetPreview() {
            if (blobUrl) {
                URL.revokeObjectURL(blobUrl);
                blobUrl = null;
            }
            preview.style.backgroundImage = "none";
            imgActions.hidden = true;
            keepNote.textContent = "";
        }

        // Prévisualisation image (nouvelle)
        inputImg.addEventListener("change", () => {
            resetPreview();
            const f = inputImg.files && inputImg.files[0];
            if (f) {
                blobUrl = URL.createObjectURL(f);
                preview.style.backgroundImage = `url("${blobUrl}")`;
                imgActions.hidden = false;
                keepNote.textContent = "";
            }
        });

        viewFull.addEventListener("click", () => {
            if (blobUrl) window.open(blobUrl, "_blank", "noopener");
        });
        clearImg.addEventListener("click", () => {
            inputImg.value = "";
            resetPreview();
        });

        // Aperçu existant في التحرير (ملف أو رابط)
        function showExistingPreview(file, url) {
            resetPreview();
            if (file instanceof File) {
                blobUrl = URL.createObjectURL(file);
                preview.style.backgroundImage = `url("${blobUrl}")`;
                imgActions.hidden = false;
                keepNote.textContent = "Current image will be kept unless you choose a new file.";
                return;
            }
            if (url && /^https?:\/\//i.test(url)) {
                preview.style.backgroundImage = `url("${url}")`;
                imgActions.hidden = false;
                keepNote.textContent = "Current image URL will be kept unless you choose a new file.";
            }
        }

        // Ajouter
        $("#add-item-btn").addEventListener("click", () => {
            editIndex.value = "";
            inputTitle.value = "";
            inputDesc.value = "";
            inputUrl.value = "";
            inputImg.value = "";
            resetPreview();
            openModal();
        });

        function isValidUrl(u) {
            if (!u) return true;
            try {
                new URL(u);
                return true;
            } catch {
                return false;
            }
        }

        // Enregistrer (ajout/édition) — قواعد خاصة لكل وضع
        $("#saveItemBtn").addEventListener("click", () => {
            const m = selectedMethod();
            const arr = currentItems();

            const title = inputTitle.value.trim();
            const description = inputDesc.value.trim();
            const url = inputUrl.value.trim();
            const needUrl = (m === "list");

            const file = (inputImg.files && inputImg.files[0]) ? inputImg.files[0] : null;
            const editing = editIndex.value !== "";
            const idx = editing ? Number(editIndex.value) : -1;

            if (!title) return alert("Title is required.");
            if (!description) return alert("Description is required.");

            if (needUrl) {
                if (!url) return alert("URL is required in List mode.");
                if (url && !isValidUrl(url)) return alert("Invalid URL format.");
                // في list لا نُلزم بملف
            } else { // mode file
                if (!editing && !file) return alert("Image file is required in File mode.");
            }

            const payload = {
                title,
                description,
                url,
                file: (m === "file") ?
                    (file || (editing ? arr[idx].file : null)) :
                    (editing ? arr[idx].file || null : null),
                id: editing ? arr[idx].id : ("itm_" + Math.random().toString(36).slice(2, 9))
            };

            if (editing) arr[idx] = payload;
            else arr.push(payload);
            renderItems();
            closeModal();
        });

        // Drag & drop par mode
        function initSortable() {
            if (!window.Sortable) return;
            new Sortable(container, {
                animation: 150,
                handle: ".handle",
                onEnd(evt) {
                    const arr = currentItems();
                    const moved = arr.splice(evt.oldIndex, 1)[0];
                    arr.splice(evt.newIndex, 0, moved);
                    renderItems();
                }
            });
        }

        // Bascule de mode : لكل وضع قائمته
        $$('input[name="display_method"]').forEach(r => {
            r.addEventListener("change", () => {
                applySectionVisibility();
                const m = selectedMethod();
                if (m === "simple") {
                    section.hidden = true;
                } else {
                    section.hidden = false;
                    renderItems();
                }
            });
        });

        // Soumission : نرسل فقط قائمة الوضع الحالي وبالصيغة التي يتوقعها الخادم
        (function wireSubmit() {
            const form = mainForm || document.querySelector("form");
            if (!form) return;

            form.addEventListener("submit", (e) => {
                hiddenBox.innerHTML = "";
                const m = selectedMethod();

                if (m === "simple") return;

                const arr = currentItems();
                if (arr.length === 0) {
                    e.preventDefault();
                    alert("Please add at least one item.");
                    return;
                }
                if (m === "list") {
                    const missing = arr.findIndex(it => !it.url || !it.url.trim());
                    if (missing !== -1) {
                        e.preventDefault();
                        alert("Each item must have a URL in List mode.");
                        return;
                    }
                }

                arr.forEach((it, i) => {
                    const p = `items[${i}]`;
                    const addHidden = (name, val) => {
                        const input = document.createElement("input");
                        input.type = "hidden";
                        input.name = `${p}[${name}]`;
                        input.value = val ?? "";
                        hiddenBox.appendChild(input);
                    };

                    addHidden("title", it.title);
                    addHidden("description", it.description);
                    addHidden("url", it.url || "");
                    addHidden("index", String(i));

                    if (m === "list") {
                        // الخادم يتوقع items[i][image] كرابط URL صالح
                        addHidden("image", it.url || "");
                    } else {
                        // file mode: نرفق الملف باسم image
                        if (it.file instanceof File) {
                            const fi = document.createElement("input");
                            fi.type = "file";
                            fi.name = `${p}[image]`;
                            fi.style.display = "none";
                            const dt = new DataTransfer();
                            dt.items.add(it.file);
                            fi.files = dt.files;
                            form.appendChild(fi);
                        }
                    }
                });
            }, {
                passive: false
            });
        })();

        // Initial UI
        applySectionVisibility();
        if (selectedMethod() !== "simple") {
            section.hidden = false;
            renderItems();
        }

        if (document.readyState === "complete" || document.readyState === "interactive") {
            initSortable();
        } else {
            document.addEventListener("DOMContentLoaded", initSortable);
        }
    })();
</script>
