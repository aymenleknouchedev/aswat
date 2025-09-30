    <!-- === Main Navigation === -->
    <nav id="site-main-nav">
        <div class="site-container">
            <div class="site-nav-right">
                <a href="{{ route('index') }}">
                    <img class="site-logo" src="{{ asset('user/assets/images/logo.svg') }}" alt="Logo">
                </a>
                <ul class="site-nav-links">
                    <li class="site-nav-link" id="site-show-subnav"><a href="{{ route('index') }}">أخبار</a></li>
                    <li class="site-nav-link"> <a href="{{ route('reviews') }}">آراء</a></li>
                    <li class="site-nav-link"> <a href="{{ route('windows') }}">نوافذ</a></li>
                    <li class="site-nav-link"> <a href="{{ route('files') }}">ملفات</a></li>
                    <li class="site-nav-link"> <a href="{{ route('investigation') }}">فحص</a></li>
                    <li class="site-nav-link"> <a href="{{ route('videos') }}">فيديو</a></li>
                    <li class="site-nav-link"> <a href="{{ route('podcasts') }}">بودكاست</a></li>
                    <li class="site-nav-link"> <a href="{{ route('photos') }}">صور</a></li>
                </ul>
            </div>
            <div class="site-nav-left">
                <input type="text" class="site-search-input" placeholder="ابحث...">
                <div class="search-icon">
                    @include('user.icons.search')
                </div>

            </div>
        </div>
    </nav>

    <!-- === Breaking News === -->
    <nav id="site-breaking-news">
        <div class="site-container site-breaking-news-container">
            <div class="site-breaking-news-content">
                <span class="site-breaking-label">عاجل</span>
                <p class="site-breaking-text" id="site-breaking-text"></p>
            </div>
            <button class="site-close-breaking" aria-label="إغلاق">✖</button>
        </div>
    </nav>

    <!-- === Secondary Navigation === -->
    <nav id="site-secondary-nav">
        <div class="site-container site-secondary-container">
            <div class="site-secondary-content">
                <div class="site-latest-news">
                    <span class="site-latest-label">آخر الأخبار</span>
                    <p class="site-latest-text" id="site-latest-text"></p>
                </div>
                <div class="site-weather-widget">
                    <div class="site-weather-location">الجزائر</div>
                    <div class="site-weather-item">
                        <img src="{{ asset('user/assets/icons/day-mode.png') }}" alt="نهار">
                        <span>25°</span>
                    </div>
                    <div class="site-weather-divider"></div>
                    <div class="site-weather-item">
                        <img src="{{ asset('user/assets/icons/night-mode.png') }}" alt="ليل">
                        <span>15°</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- === Subnav === -->
    <nav id="site-subnav">
        <div class="site-container">
            <ul class="site-subnav-links">
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'algeria']) }}">الجزائر</a>
                </li>
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'world']) }}">عالم</a></li>
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'economy']) }}">اقتصاد</a>
                </li>
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'sports']) }}">رياضة</a>
                </li>
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'people']) }}">ناس</a></li>
                <li class="site-subnav-link"><a href="{{ route('arts') }}">ثقافة وفنون</a></li>
                <li class="site-subnav-link"><a
                        href="{{ route('newSection', ['section' => 'technology']) }}">تكنولوجيا</a></li>
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'health']) }}">صحة</a></li>
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'environment']) }}">بيئة</a>
                </li>
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'media']) }}">ميديا</a></li>
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'variety']) }}">منوعات</a>
                </li>
            </ul>
        </div>
    </nav>
