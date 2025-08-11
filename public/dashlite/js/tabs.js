document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('#contentTabs button.nav-link');
    const tabPanes = document.querySelectorAll('.tab-content .tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            // Remove active state from all tabs
            tabs.forEach(t => {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
            });

            // Hide all panes
            tabPanes.forEach(pane => {
                pane.classList.remove('show', 'active');
            });

            // Activate clicked tab
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');

            // Show linked pane
            const targetId = this.getAttribute('data-bs-target');
            if (targetId) {
                const targetPane = document.querySelector(targetId);
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                }
            }
        });
    });
});