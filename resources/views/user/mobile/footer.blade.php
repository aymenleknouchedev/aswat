<style>
    @media (max-width: 991px) {
        .m-footer {
            background: #252525;
            color: #fff;
            padding: 50px 16px calc(100px + env(safe-area-inset-bottom));
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            height: 100vh;
            /* full screen */
            display: flex;
            z-index: 20000;
        }

        .m-footer .m-wrap {
            max-width: 960px;
            margin: 0 auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .m-footer .m-logo {
            height: 55px;
            display: block;
        }

        .m-footer .m-icons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 24px;
            margin: 6px 0 14px;
        }

        .m-footer .m-icon {
            width: 24px;
            height: 24px;
            opacity: .75;
        }

        /* Removed click effect */

        .m-footer .m-links {
            list-style: none;
            padding: 0;
            margin: 12px 0 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            direction: rtl;
        }

        .m-footer .m-links li {
            text-align: center;
            color: #eaeaea;
            font-size: 17px;
        }

        /* Contact us block (mobile) */
        .m-footer .m-contact {
            direction: rtl;
            text-align: right;
            margin: 8px 0 22px;
        }

        .m-footer .m-contact .m-contact-title {
            font-size: 16px;
            color: #ffffff;
            margin: 0 0 10px;
        }

        .m-footer .m-contact .m-contact-form {
            display: flex;
            gap: 8px;
        }

        .m-footer .m-contact input[type="email"] {
            flex: 1;
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 0px;
            padding: 12px 12px;
            font-size: 14px;
            font-family: 'asswat-medium';
        }

        .m-footer .m-contact input[type="email"]::placeholder {
            color: #cfcfcf;
        }

        .m-footer .m-contact input[type="email"]:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.35);
        }

        .m-footer .m-contact button {
            background: #4a4a4a;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 12px 16px;
            border-radius: 0px;
            font-size: 14px;
            white-space: nowrap;
        }

        /* Removed click effect */

        .m-footer .m-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.12);
            margin: 10px 0 12px;
        }

        .m-footer .m-bottom {
            text-align: center;
            direction: rtl;
        }

        .m-footer .m-copy {
            margin: 0 0 15px;
            color: #cfcfcf;
            font-size: 12px;
        }

        .m-footer .m-brand {
            display: inline-flex;
            align-items: center;
            gap: 16px;
            color: #eaeaea;
            font-size: 16px;
        }

        .m-footer .m-brand img {
            height: 28px;
        }
    }

    @media (min-width: 992px) {
        .m-footer {
            display: none;
        }
    }
</style>

<footer id="mobileFooter" class="m-footer" role="contentinfo">
    <div class="m-wrap">
        <img class="m-logo" src="{{ asset('user/assets/images/white_logo.svg') }}" alt="أصوات جزائرية">
        <div class="m-divider" aria-hidden="true"></div>
        <ul class="m-links" role="list">
            <li>من نحن</li>
            <li>الوظائف</li>
            <li>اتصل بنا</li>
            <li>سياسة الخصوصية</li>
        </ul>
        <div class="m-icons" aria-label="وسائل التواصل الاجتماعي">
            <span class="m-icon">@include('user.icons.facebook')</span>
            <span class="m-icon">@include('user.icons.twitter')</span>
            <span class="m-icon">@include('user.icons.youtube')</span>
            <span class="m-icon">@include('user.icons.instagram')</span>
            <span class="m-icon">@include('user.icons.telegram')</span>
            <span class="m-icon">@include('user.icons.linkedin')</span>
        </div>

        <div class="m-contact">
                <form class="m-contact-form" method="post" action="#" onsubmit="return false;">
                <input type="email" name="email" placeholder="البريد الإلكتروني">
                <button type="submit">إرسال</button>
            </form>
        </div>

        <div class="m-bottom">
            <p class="m-copy">جميع الحقوق محفوظة © مساحات للإعلام والثقافة والفنون 2025</p>
            <span class="m-brand">
                <span>تصميم وتطوير</span>
                <img src="{{ asset('user/assets/images/brand.svg') }}" alt="brand">
            </span>
        </div>
    </div>

</footer>

<style>
    @media (max-width: 991px) {

        /* Hide mobile navbar when footer is in view */
        .mobile-navbar.navbar-hidden {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
            transition: transform 0.3s ease, opacity 0.2s ease;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var footer = document.getElementById('mobileFooter');
        var navbar = document.getElementById('mobileNavbar');
        if (!footer || !navbar) return;

        var obs = new IntersectionObserver(function(entries) {
            entries.forEach(function(e) {
                if (e.isIntersecting && e.intersectionRatio > 0.15) {
                    navbar.classList.add('navbar-hidden');
                } else {
                    navbar.classList.remove('navbar-hidden');
                }
            });
        }, {
            threshold: 0.9
        });

        obs.observe(footer);
    });
</script>
