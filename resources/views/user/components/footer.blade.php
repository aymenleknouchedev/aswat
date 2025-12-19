<style>
    .footer {
        background-color: #252525;
        padding: 60px 0px;
    }

    .footer-logo {
        height: 50px;
        margin-bottom: 30px;
    }

    .footer .ligne {
        margin-bottom: 30px;
        border-bottom: 1px solid #D1D1D3;
    }

    .footer .links {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .footer .links ul {
        list-style: none;
        padding: 0;
    }

    .footer .links .col {
        display: flex;
        gap: 40px;
    }

    .footer .links li {
        margin-bottom: 8px;
    }

    .footer .links li a {
        cursor: pointer;
        transition: 0.2s ease;
        color: white;
        text-decoration: none;
    }

    .footer .links li a:hover {
        color: rgb(169, 169, 169);
    }

    .footer .ligne-s {
        margin-bottom: 10px;
        border-bottom: 1px solid #D1D1D3;
    }

    .footer .contact-us {
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
    }

    .footer .contact-us .right-side ul {
        display: flex;
    }

    .footer .contact-us .right-side ul li {
        margin-left: 20px;
    }

    .footer .contact-us .right-side ul li a {
        cursor: pointer;
        transition: .1s ease;
        color: white;
        text-decoration: none;
    }

    .footer .contact-us .right-side ul li a:hover {
        color: rgb(169, 169, 169);
    }

    .footer .contact-us .left-side {
        display: flex;
        align-items: flex-end;
        flex-direction: column;
    }


    .footer .contact-us .left-side .form button {
        background-color: #4a4a4a;
        color: white;
        padding: 10px 20px;
        transition: .3s ease;
        border: 1px solid rgba(255, 255, 255, 0.151);
    }

    .footer .contact-us .left-side .form button:hover {
        background-color: #ffffff;
        color: #252525;
        border: 1px solid rgba(255, 255, 255, 0);
    }

    .footer .contact-us .left-side .form input {
        background-color: rgba(255, 255, 255, 0);
        color: white;
        padding: 13px 20px;
        border: 1px solid rgba(255, 255, 255, 0.151);
        font-family: 'asswat-medium';
    }

    .footer .contact-us .left-side .form input:focus {
        outline: none;
    }

    .footer .contact-us .left-side .icons {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .footer .contact-us .left-side .icons .footer-icon {
        height: 20px;
        width: 20px;
        transition: .3s ease;
        margin-right: 17px;
        cursor: pointer;
        opacity: 0.5;
    }

    .footer .contact-us .left-side .icons .footer-icon:hover {
        opacity: 1;
    }

    .footer .who {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .footer .who .right-side {
        display: flex;
        align-items: center;
    }

    .footer .who .left-side p {
        color: white;
        font-size: 14px;
    }

    .footer .who .right-side p {
        margin-left: 10px;
        color: white;
        font-size: 14px;
    }

    .footer .who .right-side img {
        height: 35px;
    }
</style>



<div class="footer">
    <div class="container">
        <a href="#gototop">
            <img class="footer-logo" src="{{ asset('user/assets/images/white_logo.svg') }}" alt="logo">
        </a>
        <div class="ligne"></div>
        <div class="links">
            <div class="links">
                <div class="col">
                    <ul>
                        <li><a href="{{ route('latestNews') }}">أخبار</a></li>
                        <li><a href="{{ route('reviews') }}">آراء</a></li>
                        <li><a href="{{ route('files') }}">ملفات</a></li>
                        <li><a href="{{ route('investigation') }}">فحص</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('videos') }}">صوت وصورة</a></li>
                        <li><a href="{{ route('podcasts') }}">بودكاست</a></li>
                        <li><a href="{{ route('photos') }}">صور</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <li><a href="{{ route('newSection', ['section' => 'algeria']) }}">الجزائر</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'world']) }}">عالم</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'economy']) }}">اقتصاد</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'sports']) }}">رياضة</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('newSection', ['section' => 'people']) }}">ناس</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'culture']) }}">ثقافة وفنون</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'technology']) }}">تكنولوجيا</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'health']) }}">صحة</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('newSection', ['section' => 'environment']) }}">بيئة</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'media']) }}">ميديا</a></li>
                        <li><a href="{{ route('newSection', ['section' => 'variety']) }}">منوعات</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="contact-us">
            <div class="right-side">
                <ul>
                    <li><a href="{{ route('about-us') }}">من نحن</a></li>
                    <li>الوظائف</li>
                    <li>اتصل بنا</li>
                    <li><a href="{{ route('privacy-and-statements') }}">سياسة الخصوصية</a></li>
                </ul>
            </div>
            <div class="left-side">
                <div class="icons">
                    <a href="https://www.facebook.com" target="_blank" class="footer-icon" aria-label="Facebook">
                        @include('user.icons.facebook')
                    </a>
                    <a href="https://www.twitter.com" target="_blank" class="footer-icon" aria-label="Twitter">
                        @include('user.icons.twitter')
                    </a>
                    <a href="https://www.youtube.com" target="_blank" class="footer-icon" aria-label="YouTube">
                        @include('user.icons.youtube')
                    </a>
                    <a href="https://www.instagram.com" target="_blank" class="footer-icon" aria-label="Instagram">
                        @include('user.icons.instagram')
                    </a>
                    <a href="https://t.me" target="_blank" class="footer-icon" aria-label="Telegram">
                        @include('user.icons.telegram')
                    </a>
                    <a href="https://www.linkedin.com" target="_blank" class="footer-icon" aria-label="LinkedIn">
                        @include('user.icons.linkedin')
                    </a>
                    <a href="https://www.spotify.com" target="_blank" class="footer-icon" aria-label="Spotify">
                        @include('user.icons.spotify')
                    </a>
                    <a href="#" target="_blank" class="footer-icon" aria-label="Podcast">
                        @include('user.icons.podcast')
                    </a>
                    <a href="https://linktr.ee" target="_blank" class="footer-icon" aria-label="Linktree">
                        @include('user.icons.linktree')
                    </a>
                </div>
                <div class="form">
                    <input placeholder="البريد الإلكتروني" type="text">
                    <button>اشترك الآن</button>
                </div>
            </div>
        </div>
        <div class="ligne-s"></div>
        <div class="who">
            <div class="left-side">
                <p>جميع الحقوق محفوظة © مساحات للإعلام والثقافة والفنون 2025</p>
            </div>
            <div class="right-side">
                <p>تصميم وتطوير</p>
                <img src="{{ asset('user/assets/images/brand.svg') }}" alt="">
            </div>
        </div>
    </div>
</div>
