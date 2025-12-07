    <!-- === Main Navigation === -->
    <nav id="site-main-nav">
        <div class="site-container">
            <div class="site-nav-right">
                <a href="{{ route('index') }}">
                    <img class="site-logo" src="{{ asset('user/assets/images/logo.svg') }}" alt="Logo">
                </a>
                <ul class="site-nav-links">
                    <li class="site-nav-link {{ request()->routeIs('latestNews') ? 'active' : '' }}"
                        id="site-show-subnav"><a href="{{ route('latestNews') }}">أخبار <i
                                class="fa-solid fa-chevron-down nav-arrow"></i>
                        </a></li>
                    <li class="site-nav-link {{ request()->routeIs('reviews') ? 'active' : '' }}"><a
                            href="{{ route('reviews') }}">آراء</a></li>
                    <li class="site-nav-link {{ request()->routeIs('windows') ? 'active' : '' }}"><a
                            href="{{ route('windows') }}">نوافذ</a></li>
                    <li class="site-nav-link {{ request()->routeIs('files') ? 'active' : '' }}"><a
                            href="{{ route('files') }}">ملفات</a></li>
                    <li class="site-nav-link {{ request()->routeIs('investigation') ? 'active' : '' }}"><a
                            href="{{ route('investigation') }}">فحص</a></li>
                    <li class="site-nav-link {{ request()->routeIs('videos') ? 'active' : '' }}"><a
                            href="{{ route('videos') }}">فيديو</a></li>
                    <li class="site-nav-link {{ request()->routeIs('podcasts') ? 'active' : '' }}"><a
                            href="{{ route('podcasts') }}">بودكاست</a></li>
                    <li class="site-nav-link {{ request()->routeIs('photos') ? 'active' : '' }}"><a
                            href="{{ route('photos') }}">صور</a></li>
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
                <span class="site-breaking-label" style="font-family: asswat-bold;">عاجل</span>
                <p class="site-breaking-text" id="site-breaking-text"></p>
            </div> <button class="site-close-breaking" aria-label="إغلاق">✖</button>
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
                    <div class="site-weather-location">{{ $weather['city'] ?? 'الجزائر' }}</div>
                    <div class="site-weather-item">
                        <img src="{{ asset('user/assets/icons/day-mode.png') }}" alt="نهار">
                        <span>{{ isset($weather['day']) ? $weather['day'] . '°' : '26°' }}</span>
                    </div>
                    <div class="site-weather-divider"></div>
                    <div class="site-weather-item">
                        <img src="{{ asset('user/assets/icons/night-mode.png') }}" alt="ليل">
                        <span>{{ isset($weather['night']) ? $weather['night'] . '°' : '15°' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- === Mobile Breaking News === -->
    <div id="mobile-breaking-news" class="mobile-breaking-news">
        <div class="mobile-breaking-content">
            <span class="mobile-breaking-label">عاجل</span>
            <p class="mobile-breaking-text" id="mobile-breaking-text"></p>
        </div>
        <button class="mobile-close-breaking" aria-label="إغلاق">✖</button>
    </div>

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
                <li class="site-subnav-link"><a href="{{ route('newSection', ['section' => 'culture']) }}">ثقافة
                        وفنون</a></li>
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
                <span>
                    <i class="fas fa-user"></i> <!-- Font Awesome user icon -->
                    {{ Auth::user()->name }}
                </span>

                <div class="admin-actions">
                    <a target="_blank" href="{{ route('dashboard.index') }}" title="لوحة التحكم">
                        <i class="fas fa-gauge"></i> <!-- Dashboard icon -->
                    </a>
                    @if (isset($news))
                        <a href="{{ route('dashboard.content.edit', $news->id) }}" class="btn btn-sm btn-warning"
                            title="تعديل">
                            <i class="fas fa-pencil"></i> <!-- Edit icon -->
                        </a>
                    @endif
                    @if (isset($writer))
                        <a href="{{ route('dashboard.writer.edit', $writer->id) }}" class="btn btn-sm btn-warning"
                            title="تعديل">
                            <i class="fas fa-pencil"></i> <!-- Edit icon -->
                        </a>
                    @endif

                    <a href="{{ route('dashboard.content.create') }}" class="btn btn-sm btn-warning"
                        title="إضافة خبر">
                        <i class="fa-solid fa-plus"></i> <!-- Add icon -->
                    </a>

                    <a href="{{ route('dashboard.breakingnew.create') }}" class="admin-action-breaking"
                        title="إضافة عاجل">
                        <i class="fa-solid fa-plus"></i> <!-- Add breaking news icon -->
                    </a>

                    <a href="{{ route('dashboard.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        title="تسجيل الخروج">
                        <i class="fas fa-arrow-right-from-bracket"></i> <!-- Logout icon -->
                    </a>
                    <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST"
                        style="display:none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <!-- Font Awesome CDN (add once in your layout if not already included) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <style>

            .site-search-form{
                margin: 0px;
            }

            .admin-top-bar {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 36px;
                background: #F5F5F5;
                color: #333;
                font-size: 14px;
                z-index: 2000;
                display: flex;
                align-items: center;
            }

            .admin-bar-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .admin-bar-content span {
                font-family: asswat-bold;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .admin-actions a {
                color: #333;
                margin-right: 15px;
                text-decoration: none;
                transition: color 0.2s;
                font-family: asswat-bold;
                font-size: 16px;
            }

            .admin-actions a:hover {
                color: #333;
            }

            .admin-action-breaking i {
                color: #dc3545;
                font-size: 16px;
            }

            .admin-action-breaking:hover i {
                color: #c82333;
            }

            body {
                padding-top: 36px !important;
            }

            #site-main-nav,
            #site-subnav,
            #site-breaking-news {
                margin-top: 36px;
            }

            @media (max-width: 992px) {
            body {
                padding-top: 0px !important;
            }
           
        }
        </style>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize breaking news functionality
            initializeBreakingNews();
        });

        function initializeBreakingNews() {
            // Get breaking news element
            const mobileBreakingNews = document.getElementById('mobile-breaking-news');
            const mobileBreakingText = document.getElementById('mobile-breaking-text');
            const mobileCloseBtn = document.querySelector('.mobile-close-breaking');
            const desktopBreakingNews = document.getElementById('site-breaking-news');
            const desktopBreakingText = document.getElementById('site-breaking-text');

            // Fetch breaking news from API
            fetch('/api/breaking-news')
                .then(response => response.json())
                .then(data => {
                    if (data && data.data && data.data.length > 0) {
                        // Get the first breaking news item
                        const breakingText = data.data[0];
                        
                        // Update desktop breaking news
                        desktopBreakingText.textContent = breakingText;
                        desktopBreakingNews.style.display = 'flex';

                        // Update mobile breaking news
                        mobileBreakingText.textContent = breakingText;
                        mobileBreakingNews.classList.add('show');
                    }
                })
                .catch(error => {
                    console.log('No breaking news available', error);
                });

            // Close button functionality
            if (mobileCloseBtn) {
                mobileCloseBtn.addEventListener('click', function() {
                    mobileBreakingNews.classList.remove('show');
                    desktopBreakingNews.style.display = 'none';
                });
            }
        }
    </script>