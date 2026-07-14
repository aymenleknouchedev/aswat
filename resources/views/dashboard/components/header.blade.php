<!-- main header @s -->
<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">

            <!-- Quick add buttons (Left Side) -->
            <div class="nk-header-tools-left d-flex align-items-center" style="gap:8px;">
                <a href="{{ url('dashboard/content-create') }}"
                   class="btn btn-primary btn-sm d-inline-flex align-items-center"
                   style="gap:6px;" title="إضافة محتوى" aria-label="إضافة محتوى">
                    <em class="icon ni ni-plus"></em>
                    <span class="d-none d-md-inline" data-ar="إضافة محتوى" data-en="Add Content">إضافة محتوى</span>
                </a>
                <a href="{{ url('dashboard/breakingnew-create') }}"
                   class="btn btn-danger btn-sm d-inline-flex align-items-center"
                   style="gap:6px;" title="إضافة عاجل" aria-label="إضافة عاجل">
                    <em class="icon ni ni-plus"></em>
                    <span class="d-none d-md-inline" data-ar="إضافة عاجل" data-en="Add Breaking News">إضافة عاجل</span>
                </a>
            </div>

            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
                    <em class="icon ni ni-menu"></em>
                </a>
            </div>

            <div class="nk-header-tools">
                <ul class="nk-quick-nav">

                    <!-- User Dropdown -->
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                @if (Auth::user()->image === 'user.png')
                                    <img src="{{ asset('user.png') }}" alt="default user image" width="30"
                                        height="30" class="rounded-circle">
                                @else
                                    <img src="{{ Auth::user()->image }}" alt="user image" width="30" height="30"
                                        class="rounded-circle">
                                @endif
                                <div class="user-info d-none d-md-block ms-2">
                                    <div class="user-status">
                                        {{ Auth::user()->roles[0]->name }}
                                    </div>
                                    <div class="user-name dropdown-indicator">
                                        {{ Auth::user()->name }} {{ Auth::user()->surname }}
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->surname, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">
                                            {{ Auth::user()->name }} {{ Auth::user()->surname }}
                                        </span>
                                        <span class="sub-text">
                                            {{ Auth::user()->email }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a>
                                            <em class="icon ni ni-user-alt"></em>
                                            <span class="trans" data-en="View Profile" data-ar="عرض الملف الشخصي">View
                                                Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <em class="icon ni ni-setting-alt"></em>
                                            <span class="trans" data-en="Account Setting"
                                                data-ar="إعدادات الحساب">Account Setting</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <em class="icon ni ni-signout"></em>
                                            <span class="trans" data-en="Sign out" data-ar="تسجيل الخروج">Sign
                                                out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</div>
<!-- main header @e -->