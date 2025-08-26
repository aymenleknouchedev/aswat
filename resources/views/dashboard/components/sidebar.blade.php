<!-- sidebar @s -->
<div class="nk-sidebar nk-sidebar-fixed" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="/dashboard/home" class="logo-link nk-sidebar-logo">
                <img id="site-logo" class="logo-img" src="" alt="logo">
            </a>
        </div>
    </div>
    <!-- .nk-sidebar-element -->

    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">

                    <!-- Dashboard -->
                    <li class="nk-menu-item">
                        <a href="/dashboard/home" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-dashboard"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Dashboard" data-ar="لوحة التحكم">Dashboard</span>
                        </a>
                    </li>

                    <!-- Content -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-file-docs"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Content" data-ar="المحتوى">Content</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="dashboard/contents" class="nk-menu-link">
                                    <span class="nk-menu-text" data-en="All Contents" data-ar="كل المحتوى">كل
                                        المحتوى</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="dashboard/content-create" class="nk-menu-link">
                                    <span class="nk-menu-text" data-en="Add Content" data-ar="إضافة محتوى">إضافة
                                        محتوى</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="dashboard/breakingnew-create" class="nk-menu-link">
                                    <span class="nk-menu-text" data-en="Add Breaking News" data-ar="إضافة عاجل">إضافة
                                        عاجل</span>
                                </a>
                            </li>
                        </ul>

                    </li>

                    <!-- Media Library -->
                    <li class="nk-menu-item">
                        <a href="dashboard/medias" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-img"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Media Library" data-ar="مكتبة الوسائط">Media
                                Library</span>
                        </a>
                    </li>


                    <!-- Content Management -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-setting"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Content Management" data-ar="إدارة المحتوى">Content
                                Management</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="/featured/manage" class="nk-menu-link">
                                    <span class="nk-menu-text" data-en="Manage Featured" data-ar="إدارة الأولى">
                                        Manage Featured
                                    </span>
                                </a>
                            </li>


                            <li class="nk-menu-item"><a href="/sections/manage" class="nk-menu-link"><span
                                        class="nk-menu-text" data-en="Manage Sections" data-ar="إدارة الأقسام">Manage
                                        Sections</span></a></li>
                        </ul>
                    </li>
                    <!-- Backup: Sections -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-menu-circled"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Sections" data-ar="الأقسام">Sections</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="{{ route('dashboard.sections.index') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="All Sections"
                                        data-ar="كل الأقسام">All
                                        Sections</span></a></li>
                            <li class="nk-menu-item"><a href="{{ route('dashboard.section.create') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="Add Section"
                                        data-ar="إضافة قسم">Add
                                        Section</span></a></li>
                        </ul>
                    </li>

                    <!-- Backup: Categories -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-tag"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Categories" data-ar="التصنيفات">Categories</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="{{ route('dashboard.categories.index') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="All Categories"
                                        data-ar="كل التصنيفات">All
                                        Categories</span></a></li>
                            <li class="nk-menu-item"><a href="{{ route('dashboard.categorie.create') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="Add Category"
                                        data-ar="إضافة تصنيف">Add
                                        Category</span></a></li>
                        </ul>
                    </li>

                    <!-- Trends -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-trend-up"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Trends" data-ar="الاتجاهات">Trends</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="./dashboard/trends" class="nk-menu-link"><span
                                        class="nk-menu-text" data-en="All Trends" data-ar="كل الاتجاهات">All
                                        Trends</span></a></li>
                            <li class="nk-menu-item"><a href="./dashboard/trend-create" class="nk-menu-link"><span
                                        class="nk-menu-text" data-en="Add Trend" data-ar="إضافة اتجاه">Add
                                        Trend</span></a></li>
                        </ul>
                    </li>

                    <!-- Windows -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-view-list"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Windows" data-ar="النوافذ">Windows</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="./dashboard/windows" class="nk-menu-link"><span
                                        class="nk-menu-text" data-en="All Windows" data-ar="كل النوافذ">All
                                        Windows</span></a></li>
                            <li class="nk-menu-item"><a href="./dashboard/window-create" class="nk-menu-link"><span
                                        class="nk-menu-text" data-en="Add Window" data-ar="إضافة نافذة">Add
                                        Window</span></a></li>
                        </ul>
                    </li>

                    <!-- Tags -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-hash"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Tags" data-ar="الوسوم">Tags</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="{{ route('dashboard.tags.index') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="All Tags"
                                        data-ar="كل الوسوم">All
                                        Tags</span></a></li>
                            <li class="nk-menu-item"><a href="{{ route('dashboard.tag.create') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="Add Tag"
                                        data-ar="إضافة وسم">Add Tag</span></a>
                            </li>
                        </ul>
                    </li>

                    <!-- Locations -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-map"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Locations" data-ar="المواقع">Locations</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="./dashboard/locations" class="nk-menu-link"><span
                                        class="nk-menu-text" data-en="All Locations" data-ar="كل المواقع">All
                                        Locations</span></a></li>
                            <li class="nk-menu-item"><a href="./dashboard/location-create" class="nk-menu-link"><span
                                        class="nk-menu-text" data-en="Add Location" data-ar="إضافة موقع">Add
                                        Location</span></a></li>
                        </ul>
                    </li>

                    <!-- Users -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-users"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Users" data-ar="المستخدمون">Users</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="{{ route('dashboard.users.index') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="All Users"
                                        data-ar="كل المستخدمين">All
                                        Users</span></a></li>
                            <li class="nk-menu-item"><a href="{{ route('dashboard.user.create') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="Add User"
                                        data-ar="إضافة مستخدم">Add
                                        User</span></a></li>
                        </ul>
                    </li>

                    

                    <!-- Roles & Permissions -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-shield"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Roles & Permissions"
                                data-ar="الأدوار والصلاحيات">Roles & Permissions</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <!-- Roles -->
                            <li class="nk-menu-item">
                                <a href="{{ route('dashboard.roles.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text" data-en="All Roles" data-ar="كل الأدوار">All
                                        Roles</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('dashboard.role.create') }}" class="nk-menu-link">
                                    <span class="nk-menu-text" data-en="Add Role" data-ar="إضافة دور">Add Role</span>
                                </a>
                            </li>

                            <!-- Permissions -->
                            <li class="nk-menu-item">
                                <a href="{{ route('dashboard.permissions.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text" data-en="All Permissions" data-ar="كل الصلاحيات">All
                                        Permissions</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('dashboard.permission.create') }}" class="nk-menu-link">
                                    <span class="nk-menu-text" data-en="Add Permission" data-ar="إضافة صلاحية">Add
                                        Permission</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- Authors -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-user"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Writers" data-ar="الكتّاب">Writers</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="{{ route('dashboard.writers.index') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="All Writers"
                                        data-ar="كل الكتّاب">All
                                        Authors</span></a></li>
                            <li class="nk-menu-item"><a href="{{ route('dashboard.writer.create') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="Add Writer"
                                        data-ar="إضافة كاتب">Add
                                        Writer</span></a></li>
                        </ul>
                    </li>


                    <!-- Pages -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-layers"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Pages" data-ar="الصفحات">Pages</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="{{ route('dashboard.pages.index') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="All Pages"
                                        data-ar="كل الصفحات">All
                                        Pages</span></a></li>
                            <li class="nk-menu-item"><a href="{{ route('dashboard.page.create') }}"
                                    class="nk-menu-link"><span class="nk-menu-text" data-en="Add Page"
                                        data-ar="إضافة صفحة">Add
                                        Page</span></a></li>
                        </ul>
                    </li>

                    <!-- Settings -->
                    <li class="nk-menu-item">
                        <a href="{{ route('dashboard.settings') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-setting-alt"></em>
                            </span>
                            <span class="nk-menu-text" data-en="Settings" data-ar="الإعدادات">Settings</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- sidebar @e -->
