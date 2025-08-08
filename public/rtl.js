// =============================
// عناصر CSS RTL / LTR
// =============================
const ltrStyle = document.getElementById('ltr-style');
const rtlStyle = document.getElementById('rtl-style');
const logo = document.getElementById('site-logo');

// =============================
// عنصر زر عرض اللغة
// =============================
const languageButtonLabel = document.getElementById('language-button-label');

// // =============================
// // زر اللغة الإنجليزية
// // =============================
// document.getElementById('english').addEventListener('click', function (e) {
//     e.preventDefault();

//     document.documentElement.setAttribute('dir', 'ltr');
//     document.documentElement.setAttribute('lang', 'en');
//     document.body.classList.remove('has-rtl');

//     ltrStyle.media = 'all';
//     rtlStyle.media = 'not all';

//     if (localStorage.getItem('theme') === 'dark') {
//         logo.setAttribute('src', './user/assets/images/white_logo_ltr.png');
//     } else {
//         logo.setAttribute('src', './user/assets/images/xxxx_ltr.png');
//     }

//     localStorage.setItem('siteDirection', 'ltr');
//     localStorage.setItem('siteLang', 'en');

//     document.querySelectorAll('[data-en]').forEach(el => {
//         el.textContent = el.dataset['en'];
//     });

//     if (languageButtonLabel) {
//         languageButtonLabel.textContent = 'English';
//     }

//     // إعادة تحميل الصفحة
//     location.reload();
// });

// // =============================
// // زر اللغة العربية
// // =============================
// document.getElementById('arabic').addEventListener('click', function (e) {
//     e.preventDefault();

//     document.documentElement.setAttribute('dir', 'rtl');
//     document.documentElement.setAttribute('lang', 'ar');
//     document.body.classList.add('has-rtl');

//     rtlStyle.media = 'all';
//     ltrStyle.media = 'not all';

//     if (localStorage.getItem('theme') === 'dark') {
//         logo.setAttribute('src', './user/assets/images/white_logo_rtl.png');
//     } else {
//         logo.setAttribute('src', './user/assets/images/xxxx_rtl.png');
//     }

//     localStorage.setItem('siteDirection', 'rtl');
//     localStorage.setItem('siteLang', 'ar');

//     document.querySelectorAll('[data-en]').forEach(el => {
//         el.textContent = el.dataset['ar'];
//     });

//     if (languageButtonLabel) {
//         languageButtonLabel.textContent = 'عربي';
//     }

//     // إعادة تحميل الصفحة
//     location.reload();
// });


function updateLanguageButtons() {
    const currentLang = localStorage.getItem('siteLang') || document.documentElement.lang || 'en';
    const theme = localStorage.getItem('theme') || 'light';

    // Decide button class based on theme
    const btnClass = theme === 'dark' ? 'btn-light' : 'btn-outline-secondary';

    // Reset all button classes before applying
    document.querySelectorAll('.language-switcher button').forEach(btn => {
        btn.classList.remove('btn-outline-primary', 'btn-outline-secondary', 'btn-light');
        btn.classList.add(btnClass);
    });

    // Hide the current language button
    if (currentLang === 'en') {
        document.getElementById('english').style.display = 'none';
        document.getElementById('arabic').style.display = 'inline-block';
    } else {
        document.getElementById('arabic').style.display = 'none';
        document.getElementById('english').style.display = 'inline-block';
    }
}

// =============================
// زر اللغة الإنجليزية
// =============================
document.getElementById('english').addEventListener('click', function (e) {
    e.preventDefault();

    document.documentElement.setAttribute('dir', 'ltr');
    document.documentElement.setAttribute('lang', 'en');
    document.body.classList.remove('has-rtl');

    ltrStyle.media = 'all';
    rtlStyle.media = 'not all';

    if (localStorage.getItem('theme') === 'dark') {
        logo.setAttribute('src', './user/assets/images/white_logo_ltr.png');
    } else {
        logo.setAttribute('src', './user/assets/images/xxxx_ltr.png');
    }

    localStorage.setItem('siteDirection', 'ltr');
    localStorage.setItem('siteLang', 'en');

    document.querySelectorAll('[data-en]').forEach(el => {
        el.textContent = el.dataset['en'];
    });

    updateLanguageButtons();
    location.reload();
});

// =============================
// زر اللغة العربية
// =============================
document.getElementById('arabic').addEventListener('click', function (e) {
    e.preventDefault();

    document.documentElement.setAttribute('dir', 'rtl');
    document.documentElement.setAttribute('lang', 'ar');
    document.body.classList.add('has-rtl');

    rtlStyle.media = 'all';
    ltrStyle.media = 'not all';

    if (localStorage.getItem('theme') === 'dark') {
        logo.setAttribute('src', './user/assets/images/white_logo_rtl.png');
    } else {
        logo.setAttribute('src', './user/assets/images/xxxx_rtl.png');
    }

    localStorage.setItem('siteDirection', 'rtl');
    localStorage.setItem('siteLang', 'ar');

    document.querySelectorAll('[data-en]').forEach(el => {
        el.textContent = el.dataset['ar'];
    });

    updateLanguageButtons();
    location.reload();
});

// Run on page load
updateLanguageButtons();


// =============================
// ضبط الاتجاه والشعار والنصوص عند التحميل
// =============================
window.addEventListener('DOMContentLoaded', function () {
    const savedDir = localStorage.getItem('siteDirection');
    const savedLang = localStorage.getItem('siteLang');

    if (savedDir && savedLang) {
        document.documentElement.setAttribute('dir', savedDir);
        document.documentElement.setAttribute('lang', savedLang);

        if (savedDir === 'rtl') {
            document.body.classList.add('has-rtl');
            rtlStyle.media = 'all';
            ltrStyle.media = 'not all';
            if (localStorage.getItem('theme') === 'dark') {
                logo.setAttribute('src', './user/assets/images/white_logo_rtl.png');
            } else {
                logo.setAttribute('src', './user/assets/images/dark_logo_ltr.png');
            }
            if (languageButtonLabel) languageButtonLabel.textContent = 'English';
        } else {
            document.body.classList.remove('has-rtl');
            rtlStyle.media = 'not all';
            ltrStyle.media = 'all';
            if (localStorage.getItem('theme') === 'dark') {
                logo.setAttribute('src', './user/assets/images/white_logo_ltr.png');
            } else {
                logo.setAttribute('src', './user/assets/images/dark_logo_ltr.png');
            }
            if (languageButtonLabel) languageButtonLabel.textContent = 'English';
        }

        document.querySelectorAll('[data-en]').forEach(el => {
            el.textContent = el.dataset[savedLang];
        });
    }

    document.body.style.display = 'block';
});

// =============================
// مفتاح الوضع الليلي
// =============================
const darkSwitch = document.querySelector('.dark-switch');

if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
    document.body.setAttribute('theme', 'dark');
    darkSwitch.classList.add('active');
}

darkSwitch.addEventListener('click', function (e) {
    e.preventDefault();
    this.classList.toggle('active');

    if (this.classList.contains('active')) {
        document.body.classList.add('dark-mode');
        document.body.setAttribute('theme', 'dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.body.classList.remove('dark-mode');
        document.body.removeAttribute('theme');
        localStorage.setItem('theme', 'light');
    }

    // إعادة تحميل الصفحة
    location.reload();
});
