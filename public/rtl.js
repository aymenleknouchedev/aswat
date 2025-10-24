
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

// =============================
// تحديث أزرار اللغة
// =============================
function updateLanguageButtons() {
    const currentLang = localStorage.getItem('siteLang') || document.documentElement.lang || 'ar';
    const theme = localStorage.getItem('theme') || 'light';

    // تحديد فئة الزر بناءً على السمة
    const btnClass = theme === 'dark' ? 'btn-light' : 'btn-outline-secondary';

    // إعادة تعيين جميع فئات الأزرار قبل التطبيق
    document.querySelectorAll('.language-switcher button').forEach(btn => {
        btn.classList.remove('btn-outline-primary', 'btn-outline-secondary', 'btn-light');
        btn.classList.add(btnClass);
    });

    // إخفاء زر اللغة الحالي
    if (currentLang === 'en') {
        document.getElementById('english').style.display = 'none';
        document.getElementById('arabic').style.display = 'inline-block';
        document.getElementById('arabic').classList.add('btn-outline-primary');
    } else {
        document.getElementById('arabic').style.display = 'none';
        document.getElementById('english').style.display = 'inline-block';
        document.getElementById('english').classList.add('btn-outline-primary');
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
        logo.setAttribute('src', './user/assets/images/dark_logo_ltr.png');
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
        logo.setAttribute('src', './user/assets/images/dark_logo_rtl.png');
    }

    localStorage.setItem('siteDirection', 'rtl');
    localStorage.setItem('siteLang', 'ar');

    document.querySelectorAll('[data-en]').forEach(el => {
        el.textContent = el.dataset['ar'];
    });

    updateLanguageButtons();
    location.reload();
});

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
                logo.setAttribute('src', './user/assets/images/dark_logo_rtl.png');
            }
            if (languageButtonLabel) languageButtonLabel.textContent = 'الوضع الليلي';
        } else {
            document.body.classList.remove('has-rtl');
            rtlStyle.media = 'not all';
            ltrStyle.media = 'all';
            if (localStorage.getItem('theme') === 'dark') {
                logo.setAttribute('src', './user/assets/images/white_logo_ltr.png');
            } else {
                logo.setAttribute('src', './user/assets/images/dark_logo_ltr.png');
            }
            if (languageButtonLabel) languageButtonLabel.textContent = 'Dark Mode';
        }

        document.querySelectorAll('[data-en]').forEach(el => {
            el.textContent = el.dataset[savedLang];
        });
    }

    // تحديث أزرار اللغة
    updateLanguageButtons();

    // إظهار المحتوى بعد تحميل JS
    document.body.classList.remove('js-dependent');
    document.body.style.display = 'block';
});

// =============================
// مفتاح الوضع الليلي
// =============================
const darkSwitch = document.querySelector('.dark-switch');

// تهيئة الوضع الليلي
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
    document.documentElement.setAttribute('data-bs-theme', 'dark');
    darkSwitch.classList.add('active');
    if (languageButtonLabel) {
        if (document.documentElement.lang === 'en') {
            languageButtonLabel.textContent = 'Dark Mode';
        } else {
            languageButtonLabel.textContent = 'الوضع الليلي';
        }
    }
}

// حدث النقر على مفتاح الوضع الليلي
darkSwitch.addEventListener('click', function (e) {
    e.preventDefault();
    this.classList.toggle('active');

    if (this.classList.contains('active')) {
        document.body.classList.add('dark-mode');
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        if (languageButtonLabel) {
            if (document.documentElement.lang === 'en') {
                languageButtonLabel.textContent = 'Dark Mode';
            } else {
                languageButtonLabel.textContent = 'الوضع الليلي';
            }
        }
    } else {
        document.body.classList.remove('dark-mode');
        document.documentElement.setAttribute('data-bs-theme', 'light');
        localStorage.setItem('theme', 'light');
        if (languageButtonLabel) {
            if (document.documentElement.lang === 'en') {
                languageButtonLabel.textContent = 'Light Mode';
            } else {
                languageButtonLabel.textContent = 'الوضع النهاري';
            }
        }
    }

    // تحديث أزرار اللغة لتطبيق التغييرات
    updateLanguageButtons();

    // إعادة تحميل الصفحة
    location.reload();
});
