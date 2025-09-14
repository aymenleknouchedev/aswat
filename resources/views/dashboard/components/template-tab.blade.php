<div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="template-tab">
    <div class="form-group col-lg-12 mb-2">
        <label class="form-label" for="display_method_id" data-ar="القالب"
            data-en="Content Display Method">القالب</label>
        <span style="color:red;">*</span>
        <div class="form-control-wrap">
            <select name="display_method" id="display_method_id" class="form-select" data-search="on">
                <option value="simple" data-ar="أساسي" data-en="Simple"
                    {{ old('display_method', 'simple') == 'simple' ? 'selected' : '' }}>
                    أساسي</option>
                <option value="list" data-ar="قائمة" data-en="List"
                    {{ old('display_method') == 'list' ? 'selected' : '' }}>قائمة
                </option>
                <option value="file" data-ar="ملف" data-en="File"
                    {{ old('display_method') == 'file' ? 'selected' : '' }}>ملف
                </option>
            </select>
        </div>
    </div>

    <div id="dynamic-items-section" class="mt-3" style="display:none;">
        <button type="button" id="add-item-btn" class="btn btn-primary mb-2"
                data-bs-toggle="modal" data-bs-target="#itemModal">Add Item</button>

        <div id="items-container" class="d-flex flex-column gap-2"></div>
    </div>

    <div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="modalFormId" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Add / Edit Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editIndex" />
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input id="itemTitle" class="form-control" required />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Description</label>
                            <textarea id="itemDescription" class="form-control"></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Image</label>
                            <input id="itemImage" type="file" class="form-control" accept="image/*" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">URL</label>
                            <input id="itemUrl" type="url" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Item</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    
    function initDynamicItems() {
        const displayMethod = document.getElementById('display_method_id');
        const dynamicSection = document.getElementById('dynamic-items-section');
        const addBtn = document.getElementById('add-item-btn');
        const container = document.getElementById('items-container');
        const modalForm = document.getElementById('modalFormId');
        const modalEl = document.getElementById('itemModal');
        const editIndex = document.getElementById('editIndex');

        if (!displayMethod || !dynamicSection || !addBtn || !container || !modalForm || !modalEl || !editIndex) {
            console.warn('Missing essential element(s) for dynamic items:', {
                displayMethod: !!displayMethod,
                dynamicSection: !!dynamicSection,
                addBtn: !!addBtn,
                container: !!container,
                modalForm: !!modalForm,
                modalEl: !!modalEl,
                editIndex: !!editIndex,
            }); 
            return;
        }

        let items = [];
        let isEditing = false;

        function toggleSection() {
            const show = displayMethod.value === 'list' || displayMethod.value === 'file';
            dynamicSection.style.display = show ? 'block' : 'none';

            // disable hidden required fields to avoid "invalid form control not focusable"
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
        displayMethod.addEventListener('change', toggleSection);

        addBtn.addEventListener('click', () => {
            // FIX: Changed 'form' to 'modalForm' to reference the correct variable
            if (!isEditing && modalForm) { 
                modalForm.reset();
                editIndex.value = '';
            }
            isEditing = false;
        });

        modalForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const newItem = {
                title: (document.getElementById('itemTitle').value || '').trim(),
                description: (document.getElementById('itemDescription').value || '').trim(),
                image: document.getElementById('itemImage').files[0]?.name || '',
                url: (document.getElementById('itemUrl').value || '').trim()
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
                const div = document.createElement('div');
                div.className = 'card p-2 d-flex flex-row justify-content-between align-items-center';
                div.innerHTML = `
                    <div><strong>${escapeHtml(item.title || 'Untitled')}</strong></div>
                    <div>
                        <button type="button" class="btn btn-sm btn-warning me-1 edit-btn">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
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
                    } else {
                        addBtn.click();
                    }
                });

                div.querySelector('.delete-btn').addEventListener('click', () => {
                    items.splice(i, 1);
                    renderItems();
                });

                container.appendChild(div);
            });
        }

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

    // run after DOM loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDynamicItems);
    } else {
        initDynamicItems();
    }

    // support turbo/livewire/pjax reloads
    document.addEventListener('turbo:load', initDynamicItems);
    document.addEventListener('livewire:load', initDynamicItems);
    document.addEventListener('pjax:success', initDynamicItems);
</script>