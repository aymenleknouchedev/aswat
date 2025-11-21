<div class="mobile-container">
    <!-- Mobile Navigation Bar -->
    <nav class="mobile-navbar">
        <div class="navbar-content">
            <!-- Logo Section -->
            <div class="navbar-logo">
                <a href="#">
                    <img src="{{ asset('user/assets/images/logo.svg') }}" alt="Logo" class="logo-img">
                </a>
            </div>

            <!-- Menu Icon -->
            <button class="menu-toggle" id="mobileMenuToggle" aria-label="Toggle Menu">
                <span class="hamburger-icon">
                    <span class="line line-1"></span>
                    <span class="line line-2"></span>
                    <span class="line line-3"></span>
                </span>
            </button>
        </div>

    </nav>

    <!-- Full Screen Sidebar Menu -->
    <div class="mobile-sidebar" id="mobileSidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <h2>Menu</h2>
            <button class="sidebar-close" id="sidebarClose" aria-label="Close Menu">
                <span class="close-icon">&times;</span>
            </button>
        </div>

        <!-- Sidebar Content - Scrollable -->
        <div class="sidebar-content">
            <ul class="menu-list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Trending</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Sidebar Overlay Backdrop -->
    <div class="sidebar-overlay" id="sidebarOverlay">
    </nav>

    <!-- Main Content Area -->
    <div class="mobile-content">
        <!-- Your content goes here -->
    </div>
</div>

<style>
    @media (max-width: 991px) {

        body {
            padding-top: 0;
        }

        /* Mobile Navbar Styles */
        .mobile-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1500;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
        }

        /* Logo Styles */
        .navbar-logo a {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo-img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        /* Menu Toggle Button */
        .menu-toggle {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1001;
        }

        .menu-toggle:focus {
            outline: none;
        }

        /* Hamburger Icon */
        .hamburger-icon {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .line {
            width: 24px;
            height: 3px;
            background-color: #333;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        /* Full Screen Sidebar */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100%;
            background-color: #252525;
            transition: right 0.3s ease;
            z-index: 2000;
            display: flex;
            flex-direction: column;
            box-shadow: -2px 0 8px rgba(0, 0, 0, 0.15);
        }

        .mobile-sidebar.active {
            right: 0;
        }

        /* Sidebar Header */
        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #444;
            background-color: #252525;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 20px;
            color: #ffffff;
            font-weight: 600;
        }

        /* Close Button */
        .sidebar-close {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-icon {
            font-size: 32px;
            color: #ffffff;
            line-height: 1;
        }

        /* Sidebar Content - Scrollable */
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .sidebar-content::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-content::-webkit-scrollbar-track {
            background: #333;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background: #666;
            border-radius: 3px;
        }

        .sidebar-content::-webkit-scrollbar-thumb:hover {
            background: #888;
        }

        /* Menu List */
        .menu-list {
            list-style: none;
            margin: 0;
            padding: 12px 0;
        }

        .menu-list li {
            border-bottom: 1px solid #333;
        }

        .menu-list a {
            display: block;
            padding: 16px 20px;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .menu-list a:active {
            background-color: #333;
            color: #66ccff;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0);
            transition: background-color 0.3s ease;
            z-index: 1999;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Mobile Container */
        .mobile-container {
            width: 100%;
            min-height: 100vh;
            background-color: #fafafa;
        }

        .mobile-content {
            padding: 16px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('mobileMenuToggle');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarClose = document.getElementById('sidebarClose');

        // Open sidebar
        menuToggle.addEventListener('click', function() {
            menuToggle.classList.add('active');
            mobileSidebar.classList.add('active');
            sidebarOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent body scroll
        });

        // Close sidebar function
        function closeSidebar() {
            menuToggle.classList.remove('active');
            mobileSidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = 'auto'; // Re-enable body scroll
        }

        // Close button
        sidebarClose.addEventListener('click', closeSidebar);

        // Close when clicking overlay
        sidebarOverlay.addEventListener('click', closeSidebar);

        // Close when clicking a link
        const menuLinks = mobileSidebar.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', closeSidebar);
        });

        // Close on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && mobileSidebar.classList.contains('active')) {
                closeSidebar();
            }
        });
    });
</script>
