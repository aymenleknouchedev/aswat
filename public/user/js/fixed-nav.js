// === Subnav toggle ===
const siteFirstNavLink = document.getElementById('site-show-subnav');
const siteSubnav = document.getElementById('site-subnav');
const siteSecondaryNav = document.getElementById('site-secondary-nav');
const newsFeatureGrid = document.getElementById('news-feature-grid');

let isHoveringLink = false;
let isHoveringSubnav = false;
let hideTimeout = null;

siteFirstNavLink.addEventListener('mouseenter', () => {
    isHoveringLink = true;
    clearTimeout(hideTimeout);
    showSubnav();
});

siteFirstNavLink.addEventListener('mouseleave', () => {
    isHoveringLink = false;
    startHideTimeout();
});

siteSubnav.addEventListener('mouseenter', () => {
    isHoveringSubnav = true;
    clearTimeout(hideTimeout);
});

siteSubnav.addEventListener('mouseleave', () => {
    isHoveringSubnav = false;
    startHideTimeout();
});

function showSubnav() {
    siteSubnav.style.display = 'flex'; // Flex لو التصميم يحتاج ذلك
}

function startHideTimeout() {
    hideTimeout = setTimeout(() => {
        if (!isHoveringLink && !isHoveringSubnav) {
            siteSubnav.style.display = 'none';
        }
    }, 200); // تأخير 200ms لتفادي اختفاء مفاجئ
}

// === Close breaking news ===
const siteCloseBreaking = document.querySelector('.site-close-breaking');
const siteBreakingNews = document.getElementById('site-breaking-news');

siteCloseBreaking.addEventListener('click', () => {
    siteBreakingNews.style.display = 'none';
    document.body.classList.add('site-breaking-closed');
});

// === Scroll behavior ===
let lastScrollY = window.scrollY;

window.addEventListener('scroll', () => {
    const currentScrollY = window.scrollY;

    if (currentScrollY === 0) {
        siteBreakingNews.classList.remove('fixed-bottom');
        triggerFade(siteBreakingNews);
    } else if (currentScrollY > lastScrollY) {
        if (!siteBreakingNews.classList.contains('fixed-bottom')) {
            siteBreakingNews.classList.add('fixed-bottom');
            triggerFade(siteBreakingNews);
        }
    }

    lastScrollY = currentScrollY;
});

function triggerFade(element) {
    element.classList.remove('fade-in');
    void element.offsetWidth;
    element.classList.add('fade-in');
}


const searchInput = document.querySelector('.site-search-input');
const searchButton = document.querySelector('.search-icon');

searchButton.addEventListener('click', (e) => {
    e.stopPropagation(); // يمنع تفعيل document click

    if (searchInput.classList.contains('active')) {
        searchInput.classList.remove('active');
        searchInput.blur();
    } else {
        searchInput.classList.add('active');
        searchInput.focus();
    }
});

document.addEventListener('click', (e) => {
    if (!searchInput.contains(e.target) && !searchButton.contains(e.target)) {
        searchInput.classList.remove('active');
    }
});


siteFirstNavLink.addEventListener('mouseenter', () => {
    isHoveringLink = true;
    clearTimeout(hideTimeout);
    showSubnav();
});

siteFirstNavLink.addEventListener('mouseleave', () => {
    isHoveringLink = false;
    startHideTimeout();
});

siteSubnav.addEventListener('mouseenter', () => {
    isHoveringSubnav = true;
    clearTimeout(hideTimeout);
    siteFirstNavLink.classList.add('active'); // إبقاء الـ link فعالًا بصريًا
});

siteSubnav.addEventListener('mouseleave', () => {
    isHoveringSubnav = false;
    startHideTimeout();
});

function showSubnav() {
    siteSubnav.style.display = 'flex';
    siteFirstNavLink.classList.add('active'); // أضف الكلاس عند الفتح
}

function startHideTimeout() {
    hideTimeout = setTimeout(() => {
        if (!isHoveringLink && !isHoveringSubnav) {
            siteSubnav.style.display = 'none';
            siteFirstNavLink.classList.remove('active'); // أزل الكلاس عند الإخفاء
        }
    }, 200);
}

const element = document.getElementById('site-breaking-text');

const texts = [''];

fetch('/api/breaking-news')
    .then(response => response.json())
    .then(data => {
        if (Array.isArray(data) && data.length > 0) {
            texts.length = 0;
            texts.push(...data);
            siteBreakingNews.style.display = '';
            document.body.classList.remove('site-breaking-closed');
        } else {
            siteBreakingNews.style.display = 'none';
            document.body.classList.add('site-breaking-closed');
        }
    })
    .catch(err => {
        console.error('Failed to fetch texts:', err);
    });

let textIndex = 0;
let charIndex = 0;
const speed = 20;

function typeWriter() {
    if (charIndex < texts[textIndex].length) {
        element.textContent += texts[textIndex].charAt(charIndex);
        charIndex++;
        setTimeout(typeWriter, speed);
    } else {
        textIndex++;
        if (textIndex >= texts.length) {
            textIndex = 0; // إعادة التكرار
        }
        setTimeout(() => {
            element.textContent = ''; // امسح النص القديم
            charIndex = 0;
            typeWriter();
        }, 3000); // انتظر 3 ثوانٍ قبل كتابة النص التالي
    }
}

typeWriter();

const element2 = document.getElementById('site-latest-text');


const texts2 = [''];

fetch('/api/latest-news')
    .then(response => response.json())
    .then(data2 => {
        if (Array.isArray(data2) && data2.length > 0) {
            texts2.length = 0;
            texts2.push(...data2);
        } 
    })
    .catch(err => {
        console.error('Failed to fetch texts:', err);
    });

let textIndex2 = 0;
let charIndex2 = 0;
const speed2 = 20;

function typeWriter2() {
    if (charIndex2 < texts2[textIndex2].length) {
        element2.textContent += texts2[textIndex2].charAt(charIndex2);
        charIndex2++;
        setTimeout(typeWriter2, speed2);
    } else {
        textIndex2++;
        if (textIndex2 >= texts2.length) {
            textIndex2 = 0; // إعادة التكرار
        }
        setTimeout(() => {
            element2.textContent = ''; // امسح النص القديم
            charIndex2 = 0;
            typeWriter2();
        }, 3000); // انتظر 3 ثوانٍ قبل النص التالي
    }
}

typeWriter2();

