/**
 * Breaking News Modal Management
 * Handles displaying, animating, and managing breaking news updates
 */

document.addEventListener('DOMContentLoaded', function() {
    const breakingNewsModal = document.getElementById('breakingNewsModal');
    const breakingNewsContent = document.getElementById('breakingNewsContent');
    const breakingNewsClose = document.getElementById('breakingNewsClose');

    // Check if modal elements exist
    if (!breakingNewsModal || !breakingNewsContent || !breakingNewsClose) {
        console.warn('Breaking news modal elements not found');
        return;
    }

    /**
     * Display breaking news items with staggered animation
     * @param {Array} newsArray - Array of news items to display
     */
    function displayBreakingNews(newsArray) {
        let html = '';
        newsArray.forEach((newsItem, index) => {
            const delay = index * 5; // Each item shows for 5 seconds
            html += `
                <div class="breaking-news-item" style="animation-delay: ${delay}s;">
                    <p class="breaking-news-item-text">
                        ${newsItem}
                    </p>
                </div>
            `;
        });
        breakingNewsContent.innerHTML = html;

        // Hide modal after all items finish
        const totalDuration = newsArray.length * 5000; // 5 seconds per item
        setTimeout(() => {
            if (breakingNewsModal.classList.contains('show')) {
                breakingNewsModal.classList.remove('show');
                breakingNewsModal.classList.add('collapsed');
            }
        }, totalDuration);
    }

    /**
     * Start the breaking news loop with fresh animations
     * @param {Array} newsArray - Array of news items to display
     */
    function startBreakingNewsLoop(newsArray) {
        displayBreakingNews(newsArray);
    }

    // Close button handler
    breakingNewsClose.addEventListener('click', function(e) {
        e.stopPropagation();
        breakingNewsModal.classList.remove('show', 'collapsed');
        breakingNewsModal.style.display = 'none';
    });

    // Reopen on header click when collapsed
    let currentNewsArray = [];
    breakingNewsModal.addEventListener('click', function(e) {
        if (breakingNewsModal.classList.contains('collapsed') && !breakingNewsModal.classList.contains('show')) {
            // Don't reopen if clicking the close button
            if (e.target !== breakingNewsClose) {
                breakingNewsModal.classList.remove('collapsed');
                breakingNewsModal.classList.add('show');
                // Restart the loop with fresh animations
                startBreakingNewsLoop(currentNewsArray);
            }
        }
    });

    /**
     * Load breaking news from API endpoint
     */
    function loadBreakingNews() {
        fetch('/api/breaking-news')
            .then(response => response.json())
            .then(data => {
                if (data && data.data && data.data.length > 0) {
                    currentNewsArray = data.data; // Store for relooping
                    startBreakingNewsLoop(data.data);
                    breakingNewsModal.classList.add('show');
                }
            })
            .catch(error => {
                console.error('Error loading breaking news:', error);
            });
    }

    // Load breaking news on page load
    loadBreakingNews();
});
