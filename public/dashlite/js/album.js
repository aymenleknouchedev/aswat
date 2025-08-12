document.addEventListener('DOMContentLoaded', () => {
    const albumBtn = document.getElementById('album_images_btn');
    const albumInputHidden = document.getElementById('album_images');
    const albumPreview = document.getElementById('album_preview');
    const albumPlaceholder = document.getElementById('album_preview_placeholder');

    albumBtn.addEventListener('click', () => {
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';
        fileInput.multiple = true;
        fileInput.click();

        fileInput.onchange = () => {
            const files = Array.from(fileInput.files);
            if (files.length === 0) return;

            // Parse existing saved images or start empty
            let existingFiles = [];
            try {
                existingFiles = JSON.parse(albumInputHidden.value);
                if (!Array.isArray(existingFiles)) existingFiles = [];
            } catch {
                existingFiles = [];
            }

            // If placeholder visible, hide it now (only once)
            if (albumPlaceholder.style.display !== 'none') {
                albumPlaceholder.style.display = 'none';
            }

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.title = file.name;
                    img.style.marginRight = '8px';
                    albumPreview.appendChild(img);
                };
                reader.readAsDataURL(file);

                // Add new file names to existingFiles
                existingFiles.push(file.name);
            });

            // Save updated list back as JSON string
            albumInputHidden.value = JSON.stringify(existingFiles);
        };
        
    });
});
