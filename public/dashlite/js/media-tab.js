document.addEventListener('DOMContentLoaded', function () {
    const mediaTemplates = {
        'normal_image': 'media-normal_image-fields',
        'video': 'media-video-field',
        'podcast': 'media-podcast-field',
        'album': 'media-album-field',
        'no_image': 'media-no_image-field',
    };

    function toggleSourceFields(container, sourceValue) {
        // Hide/show all source fields inside the container
        container.querySelectorAll('.source-local-fields').forEach(el => {
            el.style.display = sourceValue === 'local' ? 'block' : 'none';
        });
        container.querySelectorAll('.source-url-fields').forEach(el => {
            el.style.display = sourceValue === 'url' ? 'block' : 'none';
        });
        container.querySelectorAll('.source-website-fields').forEach(el => {
            el.style.display = sourceValue === 'website' ? 'block' : 'none';
        });
    }

    function toggleMediaContainers(selectedTemplate) {
        for (const [template, containerId] of Object.entries(mediaTemplates)) {
            const container = document.getElementById(containerId);
            if (!container) continue;

            // Show only the selected template
            container.style.display = (template === selectedTemplate) ? 'block' : 'none';

            if (template === selectedTemplate && template !== 'no_image') {
                // Find the source radios (example: album_source, normal_image_source, etc.)
                const sourceRadios = container.querySelectorAll('input[type=radio][name$="_source"]');

                if (sourceRadios.length) {
                    let checkedSource = null;

                    sourceRadios.forEach(radio => {
                        if (radio.checked) checkedSource = radio.value;
                        radio.addEventListener('change', function () {
                            toggleSourceFields(container, this.value);
                        });
                    });

                    // Apply initial state
                    if (checkedSource) {
                        toggleSourceFields(container, checkedSource);
                    }
                }
            }
        }
    }

    // Listen for template changes
    const templateRadios = document.querySelectorAll('input[name="template"]');
    let selectedTemplate = null;

    templateRadios.forEach(radio => {
        if (radio.checked) selectedTemplate = radio.value;
        radio.addEventListener('change', function () {
            toggleMediaContainers(this.value);
        });
    });

    // Initialize view
    if (selectedTemplate) {
        toggleMediaContainers(selectedTemplate);
    }
});
