<div class="mobile-container">
    <!-- Combined Mobile Navigation Bar + Sidebar Component -->
    <nav class="mobile-navbar" id="mobileNavbar">
        <!-- Navbar Header (Logo + Menu Icon) -->
        <div class="navbar-content">
            <!-- Logo Section (Always visible) -->
            <div class="navbar-logo">
                <a href="#">
                    <img src="{{ asset('user/assets/images/white_logo.svg') }}" alt="Logo" class="logo-img">
                </a>
            </div>

            <!-- Menu Icon / Close Button -->
            <button class="menu-toggle" id="mobileMenuToggle" aria-label="Toggle Menu">
                <span class="hamburger-icon">
                    <span class="line line-1"></span>
                    <span class="line line-2"></span>
                    <span class="line line-3"></span>
                </span>
            </button>
        </div>
    </nav>

    <!-- Sidebar Menu (Separate fixed overlay) -->
    <div class="mobile-sidebar" id="mobileSidebar">
        <div class="sidebar-content">
            <ul class="menu-list">
                <li><a href="#">أخبار</a></li>
                <li><a href="#">آراء</a></li>
                <li><a href="#">نوافذ</a></li>
                <li><a href="#">ملفات</a></li>
                <li><a href="#">فحص</a></li>
                <li><a href="#">فيديو</a></li>
                <li><a href="#">بودكاست</a></li>
                <li><a href="#">صور</a></li>
            </ul>
        </div>
    </div>

    <!-- Sidebar Overlay Backdrop -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content Area -->
    <div class="mobile-content">
        <!-- Your content goes here -->
    </div>

    <style>
        @media (max-width: 991px) {

            body {
                padding-top: 0;
            }

            /* Mobile Navbar Styles */
            .mobile-navbar {
                background-color: transparent;
                border-bottom: none;
                padding: 0;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1500;
                display: flex;
                flex-direction: column;
                width: 100%;
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
                z-index: 1501;
                position: relative;
                min-width: 44px;
                min-height: 44px;
                -webkit-tap-highlight-color: transparent;
            }

            .menu-toggle:focus {
                outline: none;
            }

            .menu-toggle:active {
                background-color: transparent;
            }

            /* Hamburger Icon */
            .hamburger-icon {
                display: flex;
                flex-direction: column;
                gap: 5px;
                transition: opacity 0.3s ease;
            }

            .line {
                width: 20px;
                height: 2px;
                background-color: #ffffff;
                transition: all 0.3s ease;
                border-radius: 2px;
            }

            /* Show X icon when sidebar is active */
            .menu-toggle::after {
                content: '✕';
                position: absolute;
                font-size: 20px;
                color: #ffffff;
                opacity: 0;
                transition: opacity 0.3s ease;
                pointer-events: none;
            }

            .menu-toggle.active .hamburger-icon {
                opacity: 0;
                visibility: hidden;
            }

            .menu-toggle.active::after {
                opacity: 1;
                visibility: visible;
            }

            /* Full Screen Sidebar */
            .mobile-sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background-color: #252525;
                transition: left 0.5s ease;
                z-index: 1400;
                display: flex;
                flex-direction: column;
                box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
                padding-top: 56px;
            }

            .mobile-sidebar.active {
                left: 0;
            }

            .sidebar-content {
                flex: 1;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                width: 100%;
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
                border-bottom: none;
            }

            .menu-list a {
                display: block;
                padding: 16px 20px;
                color: #ffffff;
                text-decoration: none;
                font-size: 16px;
                font-weight: 500;
                transition: all 0.2s ease;
                opacity: 0;
                animation: slideInText 0.5s ease forwards;
            }

            .mobile-sidebar:not(.active) .menu-list a {
                animation: none;
                opacity: 0;
            }

            .menu-list li:nth-child(1) a { animation-delay: 0.1s; }
            .menu-list li:nth-child(2) a { animation-delay: 0.15s; }
            .menu-list li:nth-child(3) a { animation-delay: 0.2s; }
            .menu-list li:nth-child(4) a { animation-delay: 0.25s; }
            .menu-list li:nth-child(5) a { animation-delay: 0.3s; }
            .menu-list li:nth-child(6) a { animation-delay: 0.35s; }
            .menu-list li:nth-child(7) a { animation-delay: 0.4s; }
            .menu-list li:nth-child(8) a { animation-delay: 0.45s; }
            .menu-list li:nth-child(9) a { animation-delay: 0.5s; }
            .menu-list li:nth-child(10) a { animation-delay: 0.55s; }

            @keyframes slideInText {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
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
                z-index: 1399;
                display: none;
                pointer-events: none;
            }

            .sidebar-overlay.active {
                display: block;
                background-color: rgba(0, 0, 0, 0.5);
                pointer-events: auto;
            }

            /* Mobile Container */
            .mobile-container {
                width: 100%;
                background-color: #fafafa;
            }

        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('mobileMenuToggle');
            const mobileNavbar = document.getElementById('mobileNavbar');
            const mobileSidebar = document.getElementById('mobileSidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Toggle menu open/close
            menuToggle.addEventListener('click', function() {
                const isExpanded = mobileSidebar.classList.contains('active');
                
                if (isExpanded) {
                    // Close sidebar
                    closeSidebar();
                } else {
                    // Open sidebar
                    menuToggle.classList.add('active');
                    mobileNavbar.classList.add('expanded');
                    mobileSidebar.classList.add('active');
                    sidebarOverlay.classList.add('active');
                    document.body.style.overflow = 'hidden'; // Prevent body scroll
                }
            });

            // Close sidebar function
            function closeSidebar() {
                menuToggle.classList.remove('active');
                mobileNavbar.classList.remove('expanded');
                mobileSidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = 'auto'; // Re-enable body scroll
            }

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
