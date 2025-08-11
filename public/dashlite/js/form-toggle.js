document.addEventListener('DOMContentLoaded', function () {
    // Toggle upload/URL/asset inputs helper
    function setupInputToggle(mediaType) {
        const radios = document.querySelectorAll(`input[name="${mediaType}_input_type"]`);
        const uploadInput = document.getElementById(`${mediaType}_upload_input`) || document.getElementById(
            `${mediaType}_upload_files_input`);
        const urlInput = document.getElementById(`${mediaType}_url_input`);
        const assetInput = document.getElementById(`${mediaType}_asset_input`) || document.getElementById(
            `${mediaType}_select_assets_input`);

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                const selected = document.querySelector(
                    `input[name="${mediaType}_input_type"]:checked`).value;
                if (uploadInput) uploadInput.style.display = selected === 'upload' ?
                    'block' : 'none';
                if (urlInput) urlInput.style.display = selected === 'url' ? 'block' :
                    'none';
                if (assetInput) assetInput.style.display = selected === 'asset' ? 'block' :
                    'none';
            });
        });

        // Set initial state
        const initSelected = document.querySelector(`input[name="${mediaType}_input_type"]:checked`);
        if (initSelected) {
            const selected = initSelected.value;
            if (uploadInput) uploadInput.style.display = selected === 'upload' ? 'block' : 'none';
            if (urlInput) urlInput.style.display = selected === 'url' ? 'block' : 'none';
            if (assetInput) assetInput.style.display = selected === 'asset' ? 'block' : 'none';
        }
    }

    // Setup toggles for all media types
    ['normal_image', 'video', 'podcast', 'album', 'no_image'].forEach(setupInputToggle);

    // Template section toggle
    const templateRadios = document.querySelectorAll('input[name="template"]');
    const sections = {
        normal_image: document.getElementById('media-normal_image-fields'),
        video: document.getElementById('media-video-field'),
        podcast: document.getElementById('media-podcast-field'),
        album: document.getElementById('media-album-field'),
        no_image: document.getElementById('media-no_image-field')
    };

    function updateTemplateFields(selected) {
        Object.entries(sections).forEach(([key, sec]) => {
            if (sec) {
                sec.style.display = (key === selected) ? 'block' : 'none';
                sec.querySelectorAll('input, textarea, select').forEach(el => {
                    el.disabled = (key !== selected);
                });
            }
        });
    }
    const checked = document.querySelector('input[name="template"]:checked').value;
    updateTemplateFields(checked);
    templateRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            updateTemplateFields(this.value);
        });
    });

    // Asset modal buttons (you implement modal and selection)
    const assetButtons = [{
        btnId: 'openNormalImageAssetModal',
        hiddenInputId: 'normal_image_asset_id',
        displayId: 'selectedNormalImageAsset',
        type: 'image'
    },
    {
        btnId: 'openVideoAssetModal',
        hiddenInputId: 'video_asset_id',
        displayId: 'selectedVideoAsset',
        type: 'video'
    },
    {
        btnId: 'openPodcastAssetModal',
        hiddenInputId: 'podcast_asset_id',
        displayId: 'selectedPodcastAsset',
        type: 'audio'
    },
    {
        btnId: 'openAlbumAssetModal',
        hiddenInputId: 'album_asset_ids',
        displayId: 'selectedAlbumAssets',
        type: 'image-multiple'
    },
    {
        btnId: 'openNoImageAssetModal',
        hiddenInputId: 'no_image_asset_id',
        displayId: 'selectedNoImageAsset',
        type: 'image'
    },
    ];

    assetButtons.forEach(({
        btnId,
        hiddenInputId,
        displayId,
        type
    }) => {
        const btn = document.getElementById(btnId);
        if (btn) {
            btn.addEventListener('click', () => {
                alert(
                    `هنا تفتح مكتبة الأصول لاختيار ${type} (تحتاج لبناء مودال اختيار الأصول الخاص بك)`
                );
                // After selecting assets, you can update:
                // document.getElementById(hiddenInputId).value = selectedAssetIdOrIds;
                // document.getElementById(displayId).textContent = 'اسم الأصول المحددة أو معاينة';
            });
        }
    });


});
