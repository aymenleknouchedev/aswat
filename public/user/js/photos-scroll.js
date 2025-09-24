const photos = []; // Will be populated from API

// Fetch photos from API and replace initial photos array
fetch('/api/photos')
    .then(response => response.json())
    .then(data => {
        if (Array.isArray(data) && data.length > 0) {
            photos.length = 0;
            photos.push(...data);
        }
    })
    .catch(err => {
        console.error('Failed to fetch photos:', err);
    });


let currentIndex = 0;

// DOM references
const photoImage = document.getElementById('photoImage');
const photoCategory = document.getElementById('photoCategory');
const photoTitle = document.getElementById('photoTitle');
const photoDescription = document.getElementById('photoDescription');
const content = document.querySelector('.photos-feature .content');

const backArrow = document.getElementById('backArrow');
const nextArrow = document.getElementById('nextArrow');

// Preload all at start
photos.forEach(photo => {
    const img = new Image();
    img.src = photo.image;
});

// Update arrows state
function updateArrows() {
    if (currentIndex === 0) {
        backArrow.classList.add('disabled');
    } else {
        backArrow.classList.remove('disabled');
    }

    if (currentIndex === photos.length - 1) {
        nextArrow.classList.add('disabled');
    } else {
        nextArrow.classList.remove('disabled');
    }
}

// Smooth change
function changePhoto(next = true) {
    if (next && currentIndex === photos.length - 1) return;
    if (!next && currentIndex === 0) return;

    // Calculate next index
    const newIndex = next ? currentIndex + 1 : currentIndex - 1;
    const nextPhoto = photos[newIndex];

    // Add fade-out
    photoImage.classList.add('fade-out');
    content.classList.add('fade-out');
      
    // Preload next image
    const tempImg = new Image();
    tempImg.src = nextPhoto.image;

    tempImg.onload = () => {
        setTimeout(() => {
            // When loaded → update content
            photoImage.src = nextPhoto.image;
            photoCategory.textContent = nextPhoto.category;
            photoTitle.textContent = nextPhoto.title;
            photoDescription.textContent = nextPhoto.summary;

            // Fade back in
            photoImage.classList.remove('fade-out');
            content.classList.remove('fade-out');

            // Update index + arrows
            currentIndex = newIndex;
            updateArrows();
        }, 300); // match half fade time
    };
}

// Click events
nextArrow.addEventListener('click', () => changePhoto(true));
backArrow.addEventListener('click', () => changePhoto(false));

// Init
updateArrows();
