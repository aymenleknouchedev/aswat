// // =============================
// // عناصر CSS RTL / LTR
// // =============================
// const ltrStyle = document.getElementById('ltr-style');
// const rtlStyle = document.getElementById('rtl-style');
// const logo = document.getElementById('site-logo');

// // =============================
// // زر اللغة الإنجليزية
// // =============================
// document.getElementById('english').addEventListener('click', function (e) {
//     e.preventDefault();

//     // تغيير الاتجاه واللغة
//     document.documentElement.setAttribute('dir', 'ltr');
//     document.documentElement.setAttribute('lang', 'en');
//     document.body.classList.remove('has-rtl');

//     // تفعيل LTR وإخفاء RTL
//     ltrStyle.media = 'all';
//     rtlStyle.media = 'not all';

//     // ضبط الشعار
//     logo.setAttribute('src', './user/assets/images/white_logo_ltr.png');

//     // حفظ التغييرات
//     localStorage.setItem('siteDirection', 'ltr');
//     localStorage.setItem('siteLang', 'en');

//     // تحديث نصوص السايدبار للإنجليزية
//     document.querySelectorAll('[data-en]').forEach(el => {
//         el.textContent = el.dataset['en'];
//     });
// });

// // =============================
// // زر اللغة العربية
// // =============================
// document.getElementById('arabic').addEventListener('click', function (e) {
//     e.preventDefault();

//     // تغيير الاتجاه واللغة
//     document.documentElement.setAttribute('dir', 'rtl');
//     document.documentElement.setAttribute('lang', 'ar');
//     document.body.classList.add('has-rtl');

//     // تفعيل RTL وإخفاء LTR
//     rtlStyle.media = 'all';
//     ltrStyle.media = 'not all';

//     // ضبط الشعار
//     logo.setAttribute('src', './user/assets/images/white_logo_rtl.png');

//     // حفظ التغييرات
//     localStorage.setItem('siteDirection', 'rtl');
//     localStorage.setItem('siteLang', 'ar');

//     // تحديث نصوص السايدبار للعربية
//     document.querySelectorAll('[data-en]').forEach(el => {
//         el.textContent = el.dataset['ar'];
//     });
// });

// // =============================
// // ضبط الاتجاه والشعار والنصوص عند التحميل
// // =============================
// window.addEventListener('DOMContentLoaded', function () {
//     const savedDir = localStorage.getItem('siteDirection');
//     const savedLang = localStorage.getItem('siteLang');

//     if (savedDir && savedLang) {
//         document.documentElement.setAttribute('dir', savedDir);
//         document.documentElement.setAttribute('lang', savedLang);

//         if (savedDir === 'rtl') {
//             document.body.classList.add('has-rtl');
//             rtlStyle.media = 'all';
//             ltrStyle.media = 'not all';
//             logo.setAttribute('src', './user/assets/images/white_logo_rtl.png');
//         } else {
//             document.body.classList.remove('has-rtl');
//             rtlStyle.media = 'not all';
//             ltrStyle.media = 'all';
//             logo.setAttribute('src', './user/assets/images/white_logo_ltr.png');
//         }

//         // تبديل نصوص السايدبار بناءً على اللغة المحفوظة
//         document.querySelectorAll('[data-en]').forEach(el => {
//             el.textContent = el.dataset[savedLang];
//         });
//     }

//     // إظهار الصفحة بعد الضبط
//     document.body.style.display = 'block';
// });

// // =============================
// // مفتاح الوضع الليلي
// // =============================
// const darkSwitch = document.querySelector('.dark-switch');

// // تفعيل الوضع الداكن إذا كان محفوظ
// if (localStorage.getItem('theme') === 'dark') {
//     document.body.classList.add('dark-mode');
//     document.body.setAttribute('theme', 'dark');
//     darkSwitch.classList.add('active');
// }

// // تبديل الوضع الداكن
// darkSwitch.addEventListener('click', function (e) {
//     e.preventDefault();
//     this.classList.toggle('active');

//     if (this.classList.contains('active')) {
//         document.body.classList.add('dark-mode');
//         document.body.setAttribute('theme', 'dark');
//         localStorage.setItem('theme', 'dark');
//     } else {
//         document.body.classList.remove('dark-mode');
//         document.body.removeAttribute('theme');
//         localStorage.setItem('theme', 'light');
//     }

//     location.reload(); // إعادة تحميل لتطبيق التغيير
// });


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
// زر اللغة الإنجليزية
// =============================
document.getElementById('english').addEventListener('click', function (e) {
    e.preventDefault();

    // تغيير الاتجاه واللغة
    document.documentElement.setAttribute('dir', 'ltr');
    document.documentElement.setAttribute('lang', 'en');
    document.body.classList.remove('has-rtl');

    // تفعيل LTR وإخفاء RTL
    ltrStyle.media = 'all';
    rtlStyle.media = 'not all';

    // ضبط الشعار
    logo.setAttribute('src', './user/assets/images/white_logo_ltr.png');

    // حفظ التغييرات
    localStorage.setItem('siteDirection', 'ltr');
    localStorage.setItem('siteLang', 'en');

    // تحديث نصوص السايدبار للإنجليزية
    document.querySelectorAll('[data-en]').forEach(el => {
        el.textContent = el.dataset['en'];
    });

    // تحديث زر اللغة ليعرض العربية
    if (languageButtonLabel) {
        languageButtonLabel.textContent = 'English';
    }
});

// =============================
// زر اللغة العربية
// =============================
document.getElementById('arabic').addEventListener('click', function (e) {
    e.preventDefault();

    // تغيير الاتجاه واللغة
    document.documentElement.setAttribute('dir', 'rtl');
    document.documentElement.setAttribute('lang', 'ar');
    document.body.classList.add('has-rtl');

    // تفعيل RTL وإخفاء LTR
    rtlStyle.media = 'all';
    ltrStyle.media = 'not all';

    // ضبط الشعار
    logo.setAttribute('src', './user/assets/images/white_logo_rtl.png');

    // حفظ التغييرات
    localStorage.setItem('siteDirection', 'rtl');
    localStorage.setItem('siteLang', 'ar');

    // تحديث نصوص السايدبار للعربية
    document.querySelectorAll('[data-en]').forEach(el => {
        el.textContent = el.dataset['ar'];
    });

    // تحديث زر اللغة ليعرض English
    if (languageButtonLabel) {
        languageButtonLabel.textContent = 'عربي';
    }
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
            logo.setAttribute('src', './user/assets/images/white_logo_rtl.png');

            // عند RTL: نعرض English
            if (languageButtonLabel) {
                languageButtonLabel.textContent = 'English';
            }
        } else {
            document.body.classList.remove('has-rtl');
            rtlStyle.media = 'not all';
            ltrStyle.media = 'all';
            logo.setAttribute('src', './user/assets/images/white_logo_ltr.png');

            // عند LTR: نعرض عربي
            if (languageButtonLabel) {
                languageButtonLabel.textContent = 'English';
            }
        }

        // تبديل نصوص السايدبار بناءً على اللغة المحفوظة
        document.querySelectorAll('[data-en]').forEach(el => {
            el.textContent = el.dataset[savedLang];

        });
    }

    // إظهار الصفحة بعد الضبط
    document.body.style.display = 'block';
});

// =============================
// مفتاح الوضع الليلي
// =============================
const darkSwitch = document.querySelector('.dark-switch');

// تفعيل الوضع الداكن إذا كان محفوظ
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
    document.body.setAttribute('theme', 'dark');
    darkSwitch.classList.add('active');
}

// تبديل الوضع الداكن
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

    location.reload(); // إعادة تحميل لتطبيق التغيير
});
