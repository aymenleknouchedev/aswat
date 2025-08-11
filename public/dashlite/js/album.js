document.addEventListener('DOMContentLoaded', function () {
    const albumInput = document.getElementById('album_images');
    const albumPreview = document.getElementById('album-images-preview');

    if (albumInput && albumPreview) {
        albumInput.addEventListener('change', function () {
            const files = Array.from(this.files);

            files.forEach(file => {
                if (!file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    const li = document.createElement('li');
                    li.classList.add('list-group-item', 'd-flex', 'align-items-center');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = file.name;
                    img.style.width = '80px';
                    
                    img.style.height = '60px';
                    img.style.objectFit = 'cover';
                    img.classList.add('me-2', 'rounded');

                    const span = document.createElement('span');
                    span.textContent = file.name;

                    li.appendChild(img);
                    li.appendChild(span);
                    albumPreview.appendChild(li);
                };
                reader.readAsDataURL(file);
            });

            this.value = ''; // allow same files to be selected again
        });
    }
});
