<div id="list-items-hidden-inputs"></div>
<div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="template-tab">
    <div class="form-group col-lg-12 mb-2">
        <label class="form-label" data-ar="القالب" data-en="Content Display Method">القالب</label>
        <span style="color:red;">*</span>
        <div class="flex flex-column">
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="display_method" id="display_method_simple" value="simple"
                    {{ old('display_method', 'simple') == 'simple' ? 'checked' : '' }}>
                <label class="custom-control-label" for="display_method_simple" data-ar="أساسي" data-en="Simple">أساسي</label>
            </div>
            <div class="mt-1"></div>
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="display_method" id="display_method_list" value="list"
                    {{ old('display_method') == 'list' ? 'checked' : '' }}>
                <label class="custom-control-label" for="display_method_list" data-ar="قائمة" data-en="List">قائمة</label>
            </div>
            <div class="mt-1"></div>
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="display_method" id="display_method_file" value="file"
                    {{ old('display_method') == 'file' ? 'checked' : '' }}>
                <label class="custom-control-label" for="display_method_file" data-ar="ملف" data-en="File">ملف</label>
            </div>
        </div>
    </div>

    <div id="dynamic-items-section" class="mt-3" style="display:none;">
        <div id="items-container"></div>
        <button type="button" id="add-item-btn" class="btn btn-primary mb-2"
                data-bs-toggle="modal" data-bs-target="#itemModal">Add Item</button>
    </div>

    <div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="modalFormId" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Add / Edit Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editIndex" />
                        <div class="mb-2">
                            <label class="form-label">Title <span style="color:red;">*</span></label>
                            <input id="itemTitle" class="form-control" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Description <span style="color:red;">*</span></label>
                            <textarea id="itemDescription" class="form-control"></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Image <span style="color:red;">*</span></label>
                            <input id="itemImage" type="file" class="form-control" accept="image/*" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">URL</label>
                            <input id="itemUrl" type="url" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="saveItemBtn" type="button" class="btn btn-success">Save Item</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    function initDynamicItems() {
        const displayMethodRadios = document.querySelectorAll('input[name="display_method"]');
        const dynamicSection = document.getElementById('dynamic-items-section');
        const addBtn = document.getElementById('add-item-btn');
        const container = document.getElementById('items-container');
        const modalEl = document.getElementById('itemModal');
        const editIndex = document.getElementById('editIndex');
        const saveBtn = document.getElementById('saveItemBtn');

        const hiddenInputsContainer = document.getElementById('list-items-hidden-inputs');
        const mainForm = document.getElementById('contentForm');

        if (!displayMethodRadios.length || !dynamicSection || !addBtn || !container || !modalEl || !editIndex || !saveBtn || !hiddenInputsContainer || !mainForm) {
            console.warn('Missing essential element(s) for dynamic items');
            return;
        }

        let items = [];
        let isEditing = false;

        function getSelectedMethod() {
            const checked = document.querySelector('input[name="display_method"]:checked');
            return checked ? checked.value : null;
        }

        function toggleSection() {
            const method = getSelectedMethod();
            const show = method === 'list' || method === 'file';
            dynamicSection.style.display = show ? 'block' : 'none';

            items = [];
            renderItems();
        
            document.querySelectorAll('#template [required]').forEach(el => {
                if (el.offsetParent === null) {
                    el.dataset.wasRequired = "true";
                    el.removeAttribute('required');
                } else if (el.dataset.wasRequired) {
                    el.setAttribute('required', 'required');
                    delete el.dataset.wasRequired;
                }
            });
        }

        toggleSection();
        displayMethodRadios.forEach(radio => radio.addEventListener('change', toggleSection));

        addBtn.addEventListener('click', () => {
            isEditing = false;
            editIndex.value = '';
            document.getElementById('itemTitle').value = '';
            document.getElementById('itemDescription').value = '';
            document.getElementById('itemUrl').value = '';
            document.getElementById('itemImage').value = '';
        });

        saveBtn.addEventListener('click', () => {
            const title = (document.getElementById('itemTitle').value || '').trim();
            const description = (document.getElementById('itemDescription').value || '').trim();
            const imageInput = document.getElementById('itemImage');
            const imageFile = imageInput.files[0];

            if (!title) { alert('Title is required.'); return; }
            if (!description) { alert('Description is required.'); return; }
            if (!imageFile) { alert('Image is required.'); return; }

            const newItem = {
                title,
                description,
                imageFileInput: imageInput,
                url: (document.getElementById('itemUrl').value || '').trim(),
            };

            if (editIndex.value !== '') {
                items[Number(editIndex.value)] = newItem;
            } else {
                items.push(newItem);
            }

            renderItems();

            if (window.bootstrap) {
                bootstrap.Modal.getOrCreateInstance(modalEl).hide();
            }
        });

        function renderItems() {
            container.innerHTML = '';

            items.forEach((item, i) => {
                item.index = i;

                const div = document.createElement('div');
                div.className = 'card mt-0 mb-2';
                div.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center p-2 rounded-2 shadow-sm border-start border-4 border-primary">
                        <div class="d-flex align-items-center">
                            <span class="circle-number d-flex align-items-center justify-content-center bg-primary text-white fw-bold rounded-circle" style="width: 28px; height: 28px; font-size: 14px;">
                                ${item.index + 1}
                            </span>
                            <span class="ms-3 fw-medium text-dark">${escapeHtml(item.title || 'Untitled')}</span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-primary me-2 edit-btn px-3">
                                <i class="bi bi-pencil-square me-1"></i>Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn px-3">
                                <i class="bi bi-trash me-1"></i>Delete
                            </button>
                        </div>
                    </div>
                `;


                div.querySelector('.edit-btn').addEventListener('click', () => {
                    isEditing = true;
                    editIndex.value = i;
                    document.getElementById('itemTitle').value = item.title;
                    document.getElementById('itemDescription').value = item.description;
                    document.getElementById('itemUrl').value = item.url;

                    if (window.bootstrap) {
                        bootstrap.Modal.getOrCreateInstance(modalEl).show();
                    }
                });

                div.querySelector('.delete-btn').addEventListener('click', () => {
                    items.splice(i, 1);
                    renderItems();
                });

                container.appendChild(div);
            });
        }

        mainForm.addEventListener('submit', () => {
            hiddenInputsContainer.innerHTML = '';

            items.forEach((item, i) => {
                const prefix = `items[${i}]`;

                hiddenInputsContainer.innerHTML += `
                    <input type="hidden" name="${prefix}[title]" value="${item.title}">
                    <input type="hidden" name="${prefix}[description]" value="${item.description}">
                    <input type="hidden" name="${prefix}[url]" value="${item.url}">
                    <input type="hidden" name="${prefix}[index]" value="${item.index}">
                `;

                const clonedInput = item.imageFileInput.cloneNode();
                clonedInput.name = `${prefix}[image]`;
                clonedInput.style.display = 'none';
                mainForm.appendChild(clonedInput);
            });
        });

        new Sortable(container, {
            animation: 150,
            onEnd(evt) {
                const moved = items.splice(evt.oldIndex, 1)[0];
                items.splice(evt.newIndex, 0, moved);
                renderItems();
            }
        });

        function escapeHtml(s) {
            return String(s).replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;');
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDynamicItems);
    } else {
        initDynamicItems();
    }

    document.addEventListener('turbo:load', initDynamicItems);
    document.addEventListener('livewire:load', initDynamicItems);
    document.addEventListener('pjax:success', initDynamicItems);
</script>
