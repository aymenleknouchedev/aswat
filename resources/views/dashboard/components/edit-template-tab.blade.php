@php
    // Prepare initial items safely on the server side
    $initialItems = $content->contentLists->map(function($item) {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'description' => $item->description,
            'url' => $item->url,
            // use storage path if you store images in storage/app/public
            'image' => $item->image,
        ];
    })->values();
@endphp

<div id="list-items-hidden-inputs"></div>

<div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="template-tab">
    <div class="form-group col-lg-12 mb-2">
        <label class="form-label" data-ar="القالب" data-en="Content Display Method">القالب</label>
        <span style="color:red;">*</span>
        <div class="flex flex-column">
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="display_method" id="display_method_simple"
                    value="simple" {{ $content->display_method == 'simple' ? 'checked' : '' }}>
                <label class="custom-control-label" for="display_method_simple" data-ar="أساسي" data-en="Simple">أساسي</label>
            </div>

            <div class="mt-1"></div>

            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="display_method" id="display_method_list"
                    value="list" {{ $content->display_method == 'list' ? 'checked' : '' }}>
                <label class="custom-control-label" for="display_method_list" data-ar="قائمة" data-en="List">قائمة</label>
            </div>

            <div class="mt-1"></div>

            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="display_method" id="display_method_file"
                    value="file" {{ $content->display_method == 'file' ? 'checked' : '' }}>
                <label class="custom-control-label" for="display_method_file" data-ar="ملف" data-en="File">ملف</label>
            </div>
        </div>
    </div>

    <div id="dynamic-items-section" class="mt-3" style="{{ $content->display_method == 'simple' ? 'display:none;' : '' }}">
        <div id="items-container"></div>
        <button type="button" id="add-item-btn" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#itemModal" data-ar="إضافة عنصر" data-en="Add Item">Add Item</button>
    </div>

    <div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="modalFormId" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" data-ar="إضافة / تعديل عنصر" data-en="Add / Edit Item">Add / Edit Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="editIndex" />
                        <div class="mb-2">
                            <label class="form-label" data-ar="العنوان" data-en="Title">Title <span style="color:red;">*</span></label>
                            <input id="itemTitle" class="form-control" required data-ar="العنوان" data-en="Title" />
                        </div>

                        <div class="mb-2">
                            <label class="form-label" data-ar="الوصف" data-en="Description">Description <span style="color:red;">*</span></label>
                            <textarea id="itemDescription" class="form-control" required data-ar="الوصف" data-en="Description"></textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" data-ar="الصورة" data-en="Image">Image <span style="color:red;">*</span></label>
                            <input id="itemImage" type="file" class="form-control" accept="image/*" data-ar="الصورة" data-en="Image" />
                            <div id="currentImagePreview" class="d-block mt-1 text-muted"></div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" data-ar="الرابط" data-en="URL">URL</label>
                            <input id="itemUrl" type="url" class="form-control" data-ar="الرابط" data-en="URL" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id="saveItemBtn" type="button" class="btn btn-success" data-ar="حفظ العنصر" data-en="Save Item">Save Item</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-ar="إلغاء" data-en="Cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    // initial items from server (safe JSON)
    window.initialItems = {!! json_encode($initialItems, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!};

    function initDynamicItems() {
        const displayMethodRadios = document.querySelectorAll('input[name="display_method"]');
        const dynamicSection = document.getElementById('dynamic-items-section');
        const addBtn = document.getElementById('add-item-btn');
        const container = document.getElementById('items-container');
        const modalEl = document.getElementById('itemModal');
        const editIndex = document.getElementById('editIndex');
        const saveBtn = document.getElementById('saveItemBtn');
        const hiddenInputsContainer = document.getElementById('list-items-hidden-inputs');
        const mainForm = document.getElementById('contentForm'); // make sure your form id is contentForm

        if (!displayMethodRadios.length || !dynamicSection || !addBtn || !container || !modalEl || !editIndex || !saveBtn || !hiddenInputsContainer || !mainForm) {
            console.warn('Missing essential element(s) for dynamic items (check your IDs).');
            // still continue but avoid attaching submit handler if no mainForm
        }

        // clone initial items so we can edit in-memory
        let items = Array.isArray(window.initialItems) ? window.initialItems.slice() : [];
        let isEditing = false;

        function escapeHtml(s) {
            return String(s === null || s === undefined ? '' : s)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#39;');
        }
        function escapeAttr(s) {
            return String(s === null || s === undefined ? '' : s).replaceAll('"', '&quot;');
        }

        function getSelectedMethod() {
            const checked = document.querySelector('input[name="display_method"]:checked');
            return checked ? checked.value : null;
        }

        function toggleSection() {
            const method = getSelectedMethod();
            const show = method === 'list' || method === 'file';
            dynamicSection.style.display = show ? 'block' : 'none';
            renderItems();
        }

        // initial toggle
        toggleSection();
        displayMethodRadios.forEach(radio => radio.addEventListener('change', toggleSection));

        addBtn.addEventListener('click', () => {
            isEditing = false;
            editIndex.value = '';
            document.getElementById('itemTitle').value = '';
            document.getElementById('itemDescription').value = '';
            document.getElementById('itemUrl').value = '';
            document.getElementById('itemImage').value = '';
            document.getElementById('currentImagePreview').innerHTML = '';
        });

        function isValidUrl(string) {
            try {
                if (!string) return true;
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
        }

        saveBtn.addEventListener('click', () => {
            const title = (document.getElementById('itemTitle').value || '').trim();
            const description = (document.getElementById('itemDescription').value || '').trim();
            const imageInput = document.getElementById('itemImage');
            const imageFile = imageInput.files[0];
            const url = (document.getElementById('itemUrl').value || '').trim();

            // validation
            if (!title) {
                alert('Title is required.');
                return;
            }
            if (!description) {
                alert('Description is required.');
                return;
            }
            // If creating NEW item (editIndex empty) require image
            if (editIndex.value === '' && !imageFile) {
                alert('Image is required for new items.');
                return;
            }
            if (!isValidUrl(url)) {
                alert('Invalid URL format.');
                return;
            }

            // base item (if editing)
            const base = editIndex.value !== '' ? (items[Number(editIndex.value)] || {}) : {};
            const newItem = {
                id: base.id || null,
                title,
                description,
                url: url || '',
                // image: keep base.image (URL string) unless a new image is uploaded
                image: base.image || null,
                // we'll store the actual File object if user uploaded a new file
                newImageFile: base.newImageFile || null
            };

            if (imageFile) {
                // preview URL for UI; store file in newImageFile for form submit
                newItem.image = URL.createObjectURL(imageFile);
                newItem.newImageFile = imageFile;
            }

            if (editIndex.value !== '') {
                items[Number(editIndex.value)] = newItem;
            } else {
                items.push(newItem);
            }

            renderItems();
            // hide modal
            if (window.bootstrap) bootstrap.Modal.getOrCreateInstance(modalEl).hide();
        });

        function renderItems() {
            container.innerHTML = '';

            items.forEach((item, i) => {
                item.index = i;

                const card = document.createElement('div');
                card.className = 'card mt-0 mb-2';

                const inner = document.createElement('div');
                inner.className = 'd-flex justify-content-between align-items-center p-2 rounded-2 shadow-sm border-start border-4 border-primary';

                const left = document.createElement('div');
                left.className = 'd-flex align-items-center';

                const spanNum = document.createElement('span');
                spanNum.className = 'circle-number d-flex align-items-center justify-content-center bg-primary text-white fw-bold rounded-circle';
                spanNum.style.width = '28px';
                spanNum.style.height = '28px';
                spanNum.style.fontSize = '14px';
                spanNum.textContent = (i + 1);

                const titleSpan = document.createElement('span');
                titleSpan.className = 'ms-3 fw-medium text-dark';
                titleSpan.innerHTML = escapeHtml(item.title || 'Untitled');

                left.appendChild(spanNum);
                left.appendChild(titleSpan);

                if (item.image) {
                    const img = document.createElement('img');
                    img.src = item.image;
                    img.className = 'ms-2';
                    img.style.width = '40px';
                    img.style.height = '40px';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '5px';
                    left.appendChild(img);
                }

                const right = document.createElement('div');

                const editBtn = document.createElement('button');
                editBtn.type = 'button';
                editBtn.className = 'btn btn-sm btn-outline-primary me-2 edit-btn px-3';
                editBtn.innerHTML = '<i class="bi bi-pencil-square me-1"></i>Edit';

                const delBtn = document.createElement('button');
                delBtn.type = 'button';
                delBtn.className = 'btn btn-sm btn-outline-danger delete-btn px-3';
                delBtn.innerHTML = '<i class="bi bi-trash me-1"></i>Delete';

                right.appendChild(editBtn);
                right.appendChild(delBtn);

                inner.appendChild(left);
                inner.appendChild(right);
                card.appendChild(inner);

                // edit handler
                editBtn.addEventListener('click', () => {
                    isEditing = true;
                    editIndex.value = String(i);
                    document.getElementById('itemTitle').value = item.title || '';
                    document.getElementById('itemDescription').value = item.description || '';
                    document.getElementById('itemUrl').value = item.url || '';
                    document.getElementById('itemImage').value = '';
                    document.getElementById('currentImagePreview').innerHTML = item.image
                        ? ('<small>Current: <img src="' + escapeAttr(item.image) + '" style="max-width:80px;height:40px;object-fit:cover;"></small>')
                        : '';
                    if (window.bootstrap) bootstrap.Modal.getOrCreateInstance(modalEl).show();
                });

                // delete handler
                delBtn.addEventListener('click', () => {
                    if (confirm('Delete this item?')) {
                        items.splice(i, 1);
                        renderItems();
                    }
                });

                container.appendChild(card);
            });
        }

        // prepare hidden inputs and attach new file inputs to the form before submission
        if (mainForm) {
            mainForm.addEventListener('submit', (ev) => {
                // clear any previous hidden inputs we used
                hiddenInputsContainer.innerHTML = '';

                // remove previously appended file inputs if any (we appended them to mainForm earlier)
                Array.from(mainForm.querySelectorAll('input[type="file"][data-generated="true"]')).forEach(el => el.remove());

                items.forEach((item, i) => {
                    const prefix = `items[${i}]`;

                    // helper to create a hidden input
                    function createHidden(name, value) {
                        const inp = document.createElement('input');
                        inp.type = 'hidden';
                        inp.name = name;
                        inp.value = value === null || value === undefined ? '' : String(value);
                        return inp;
                    }

                    hiddenInputsContainer.appendChild(createHidden(prefix + '[title]', item.title));
                    hiddenInputsContainer.appendChild(createHidden(prefix + '[description]', item.description));
                    hiddenInputsContainer.appendChild(createHidden(prefix + '[url]', item.url || ''));
                    hiddenInputsContainer.appendChild(createHidden(prefix + '[index]', item.index));
                    if (item.id) {
                        hiddenInputsContainer.appendChild(createHidden(prefix + '[id]', item.id));
                    }

                    // if user uploaded a new image for this item, attach a generated file input to the form
                    if (item.newImageFile instanceof File) {
                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = prefix + '[image]';
                        fileInput.dataset.generated = 'true';
                        // attach file using DataTransfer so fileInput.files is set
                        const dt = new DataTransfer();
                        dt.items.add(item.newImageFile);
                        fileInput.files = dt.files;
                        fileInput.style.display = 'none';
                        mainForm.appendChild(fileInput);
                    }
                });
                // allow form to submit normally
            });
        }

        // make container sortable
        new Sortable(container, {
            animation: 150,
            onEnd(evt) {
                const moved = items.splice(evt.oldIndex, 1)[0];
                items.splice(evt.newIndex, 0, moved);
                renderItems();
            }
        });
    }

    // init on DOM ready + turbo/livewire/pjax events
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDynamicItems);
    } else {
        initDynamicItems();
    }
    document.addEventListener('turbo:load', initDynamicItems);
    document.addEventListener('livewire:load', initDynamicItems);
    document.addEventListener('pjax:success', initDynamicItems);
</script>
