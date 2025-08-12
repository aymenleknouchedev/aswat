document.addEventListener('DOMContentLoaded', () => {
    let currentTargetInputId = null;
    let currentMediaType = null;

    const mediaModal = new bootstrap.Modal(document.getElementById('mediaModal'));
    const mediaSourceSelect = document.getElementById('mediaSourceSelect');

    const mediaLibrarySection = document.getElementById('mediaLibrarySection');
    const mediaUploadSection = document.getElementById('mediaUploadSection');
    const mediaLinkSection = document.getElementById('mediaLinkSection');

    const mediaLibraryGrid = document.getElementById('mediaLibraryGrid');
    const mediaUploadFile = document.getElementById('mediaUploadFile');
    const mediaUploadAlt = document.getElementById('mediaUploadAlt');
    const mediaUploadBtn = document.getElementById('mediaUploadBtn');

    const mediaLinkInput = document.getElementById('mediaLinkInput');
    const mediaLinkAlt = document.getElementById('mediaLinkAlt');
    const mediaAddLinkBtn = document.getElementById('mediaAddLinkBtn');

    async function loadMediaLibrary(type) {
        mediaLibraryGrid.innerHTML = '<p>جاري تحميل الوسائط...</p>';
        try {
            // جلب بيانات الوسائط من API خاص بك
            const response = await fetch(`/api/media?type=${type}`);
            if (!response.ok) throw new Error('خطأ في جلب الوسائط');
            const items = await response.json();

            if (!items.length) {
                mediaLibraryGrid.innerHTML = '<p>لا توجد وسائط في المكتبة.</p>';
                return;
            }

            mediaLibraryGrid.innerHTML = '';
            items.forEach(item => {
                const div = document.createElement('div');
                div.className = 'media-thumb';
                div.style.cssText = 'width:100px;height:100px;cursor:pointer;margin:5px;border:2px solid transparent;border-radius:4px;overflow:hidden;';

                if(type === 'image') {
                    div.innerHTML = `<img src="${item.src}" alt="${item.alt}" style="width:100%;height:100%;object-fit:cover;">`;
                } else if(type === 'video') {
                    div.innerHTML = `<video width="100%" height="100%" muted><source src="${item.src}" type="video/mp4"></video>`;
                } else if(type === 'audio') {
                    div.innerHTML = `<audio controls style="width:100%;height:30px;" src="${item.src}"></audio>`;
                }
                div.onclick = () => selectMedia(item.src);
                mediaLibraryGrid.appendChild(div);
            });
        } catch (error) {
            mediaLibraryGrid.innerHTML = `<p>حدث خطأ أثناء تحميل الوسائط.</p>`;
            console.error(error);
        }
    }

    function updateSourceSections() {
        mediaLibrarySection.style.display = mediaSourceSelect.value === 'library' ? 'block' : 'none';
        mediaUploadSection.style.display = mediaSourceSelect.value === 'upload' ? 'block' : 'none';
        mediaLinkSection.style.display = mediaSourceSelect.value === 'link' ? 'block' : 'none';
    }

    function selectMedia(src) {
        if (!currentTargetInputId) return;
        document.getElementById(currentTargetInputId).value = src;
        const preview = document.getElementById('preview-' + currentTargetInputId);
        if (!preview) return;

        if(currentMediaType === 'image') {
            preview.innerHTML = `<img src="${src}" alt="Preview" style="width:100%;height:100%;object-fit:cover;">`;
        } else if(currentMediaType === 'video') {
            preview.innerHTML = `<video controls style="width:100%;height:100%;"><source src="${src}" type="video/mp4"></video>`;
        } else if(currentMediaType === 'audio') {
            preview.innerHTML = `<audio controls style="width:100%;"><source src="${src}"></audio>`;
        } else if(currentMediaType === 'image-multiple') {
            // التعامل مع ألبوم صور (إذا أردت إضافة دعم لاحقًا)
        }
        mediaModal.hide();
        resetInputs();
    }

    function resetInputs() {
        mediaUploadFile.value = '';
        mediaUploadAlt.value = '';
        mediaLinkInput.value = '';
        mediaLinkAlt.value = '';
        mediaSourceSelect.value = 'library';
        updateSourceSections();
    }

    document.querySelectorAll('.open-media').forEach(btn => {
        btn.addEventListener('click', () => {
            currentTargetInputId = btn.dataset.target;
            currentMediaType = btn.dataset.type;
            resetInputs();
            loadMediaLibrary(currentMediaType);
            updateSourceSections();
            mediaModal.show();
        });
    });

    mediaSourceSelect.addEventListener('change', updateSourceSections);

    mediaUploadBtn.addEventListener('click', () => {
        if (!mediaUploadFile.files.length) {
            alert('الرجاء اختيار ملف للرفع');
            return;
        }
        const file = mediaUploadFile.files[0];
        const src = URL.createObjectURL(file);
        selectMedia(src);
    });

    mediaAddLinkBtn.addEventListener('click', () => {
        const url = mediaLinkInput.value.trim();
        if (!url) {
            alert('الرجاء إدخال رابط صالح');
            return;
        }
        selectMedia(url);
    });
});
