const photos = [
    {
        image: './user/assets/images/b1.jpeg',
        category: 'البرتغال',
        title: 'يوم حزين لكرة القدم.. دموع وانهيارات في وداع ديوغو جوتا الأخير',
        description:     'أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات على تظاهرات مناهضة للحكومة'

    },

    {
        image: './user/assets/images/b2.jpeg',
        category: 'السعودية',
        title: 'الركن الأعظم في مناسك الحج بالصور.. خشوع وسكينة على جبل عرفة',
        description: 'وثقت عدسات المصورين لحظات الخشوع والسكينة للحجاج أثناء وقوفهم على جبل عرفة لأداء الركن الأعظم من مناسك الحج.'
    },
    {
        image: './user/assets/images/b3.jpeg',
        category: 'فلسطين المحتلة',
        title: 'جراء الصواريخ الإيرانية.. مشاهد موثقة لدمار واسع في تل أبيب',
        description: 'تسببت الصواريخ الإيرانية في دمار كبير بمناطق متعددة من تل أبيب، وأظهرت الصور مشاهد مروعة لآثار الهجمات.'
    }
];





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
            photoDescription.textContent = nextPhoto.description;

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
