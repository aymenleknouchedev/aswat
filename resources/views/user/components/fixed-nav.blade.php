    <!-- === Main Navigation === -->
    <nav id="site-main-nav">
        <div class="site-container">
            <div class="site-nav-right">
                <a href="{{ route('index') }}">
                    <img class="site-logo" src="{{ asset('user/assets/images/logo.svg') }}" alt="Logo">
                </a>
                <ul class="site-nav-links">
                    <li class="site-nav-link" id="site-show-subnav"><a href="{{ route('latestNews') }}">أخبار</a></li>
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
                <form action="{{ route('search') }}" method="GET" class="site-search-form">
                    <input name="query" type="text" class="site-search-input" placeholder="ابحث...">
                    <button type="submit" class="search" style="background:none;border:none;padding:0;">
                        <button type="button" class="search-icon" style="background:none;border:none;padding:0;">
                            @include('user.icons.search')
                        </button>
                </form>
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
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'culture']) }}">ثقافة و
                        فنون</a></li>
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



    @if (Auth::check())
        <div class="admin-top-bar">
            <div class="site-container admin-bar-content">
                <span>مرحبًا، {{ Auth::user()->name }}</span>

                <div class="admin-actions">
                    <a target="_blank" href="{{ route('dashboard.index') }}">لوحة التحكم</a>
                    @if (isset($news))
                        <a target="_blank" href="{{ route('dashboard.content.edit', $news->id) }}" class="btn btn-sm btn-warning" data-en="Edit" data-ar="تعديل">تعديل</a>
                    @endif 
                    <a href="{{ route('dashboard.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        تسجيل الخروج
                    </a>
                    <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST"
                        style="display:none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <style>
            .admin-top-bar {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 36px;
                background: #55B68B;
                /* Green */
                color: #fff;
                font-size: 14px;
                z-index: 2000;
                display: flex;
                align-items: center;
                box-shadow: 0 1px 3px rgba(33, 136, 56, 0.2);
            }

            .admin-bar-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .admin-actions a {
                color: #fff;
                margin-right: 15px;
                text-decoration: none;
                transition: color 0.2s;
            }

            .admin-actions a:hover {
                color: #c3e6cb;
                /* Light green */
            }

            body {
                padding-top: 36px;
            }

            #site-main-nav {
                margin-top: 36px;
            }

            #site-subnav {
                margin-top: 36px;
            }


            #site-breaking-news {
                margin-top: 36px;
            }
        </style>
    @endif
