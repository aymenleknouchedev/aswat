
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
// اللغة مثبتة على العربية — لا تبديل من الواجهة
// =============================
// (Language switcher removed; dashboard is locked to Arabic.)
// Force-clear any stale stored direction/language so users that toggled to
// English in the past come back to Arabic on next load.
localStorage.setItem('siteDirection', 'rtl');
localStorage.setItem('siteLang', 'ar');

function updateLanguageButtons() { /* no-op — buttons removed */ }

// =============================
// ضبط الاتجاه والشعار والنصوص عند التحميل
// =============================
window.addEventListener('DOMContentLoaded', function () {
    // Locked to Arabic / RTL.
    const dir = 'rtl';
    const lang = 'ar';

    document.documentElement.setAttribute('dir', dir);
    document.documentElement.setAttribute('lang', lang);

    if (dir === 'rtl') {
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
        el.textContent = el.dataset[lang];
    });

    // تحديث أزرار اللغة
    updateLanguageButtons();

    // إظهار المحتوى بعد تحميل JS
    document.body.classList.remove('js-dependent');
    document.body.style.display = 'block';
});

// =============================
// الوضع مثبت على النهاري — زر الوضع الليلي مخفي
// =============================
localStorage.setItem('theme', 'light');
document.body.classList.remove('dark-mode');
document.documentElement.setAttribute('data-bs-theme', 'light');
