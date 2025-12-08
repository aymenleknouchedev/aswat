/**
 * Breaking News Modal Management
 * Handles displaying, animating, and managing breaking news updates with real-time support
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

    // Configuration
    const CONFIG = {
        POLL_INTERVAL: 5000,           // Poll every 5 seconds for new breaking news
        ITEM_DISPLAY_DURATION: 5000,   // Each news item shows for 5 seconds
        ANIMATION_DELAY: 5,            // Stagger animation delay in seconds
    };

    // State management
    const state = {
        currentNewsArray: [],
        lastUpdatedAt: 0,
        isModalActive: false,
        isDisplaying: false,
        displayTimeoutId: null,
        pollTimeoutId: null,
        isUserClosed: localStorage.getItem('breakingNewsUserClosed') === 'true', // Remember if user closed it
    };

    /**
     * Display breaking news items with staggered animation
     * @param {Array} newsArray - Array of news items to display
     */
    function displayBreakingNews(newsArray) {
        if (!newsArray || newsArray.length === 0) return;

        state.isDisplaying = true;
        let html = '';
        
        newsArray.forEach((newsItem, index) => {
            const delay = index * CONFIG.ANIMATION_DELAY;
            html += `
                <div class="breaking-news-item" style="animation-delay: ${delay}s;">
                    <p class="breaking-news-item-text">
                        ${newsItem}
                    </p>
                </div>
            `;
        });
        
        breakingNewsContent.innerHTML = html;

        // Hide modal after all items finish displaying
        const totalDuration = newsArray.length * CONFIG.ITEM_DISPLAY_DURATION;
        
        clearTimeout(state.displayTimeoutId);
        state.displayTimeoutId = setTimeout(() => {
            if (breakingNewsModal.classList.contains('show')) {
                breakingNewsModal.classList.remove('show');
                breakingNewsModal.classList.add('collapsed');
            }
            state.isDisplaying = false;
        }, totalDuration);
    }

    /**
     * Start the breaking news loop with fresh animations
     * @param {Array} newsArray - Array of news items to display
     */
    function startBreakingNewsLoop(newsArray) {
        displayBreakingNews(newsArray);
    }

    /**
     * Show new breaking news immediately
     * @param {String} newsItem - New news item to display
     */
    function showNewBreakingNews(newsItem) {
        // Show the modal if it's hidden or collapsed
        if (!breakingNewsModal.classList.contains('show')) {
            breakingNewsModal.classList.remove('collapsed', 'hide');
            breakingNewsModal.classList.add('show');
            breakingNewsModal.style.display = 'flex'; // Ensure modal is visible
        }

        // Display the new news item immediately
        displayBreakingNews([newsItem]);
    }

    // Close button handler
    breakingNewsClose.addEventListener('click', function(e) {
        e.stopPropagation();
        breakingNewsModal.classList.remove('show', 'collapsed');
        breakingNewsModal.classList.add('hide');
        breakingNewsModal.style.display = 'none';
        state.isModalActive = false;
        state.isUserClosed = true;
        // Remember that user closed it (persists after refresh)
        localStorage.setItem('breakingNewsUserClosed', 'true');
    }, true);

    // Reopen on header click when collapsed
    breakingNewsModal.addEventListener('click', function(e) {
        const isCollapsed = breakingNewsModal.classList.contains('collapsed');
        const isShown = breakingNewsModal.classList.contains('show');
        const isClickOnHeader = e.target === breakingNewsModal || 
                               e.target.closest('.breaking-news-header') === breakingNewsModal.querySelector('.breaking-news-header');
        
        if ((isCollapsed || !isShown) && isClickOnHeader && e.target !== breakingNewsClose) {
            e.stopPropagation();
            breakingNewsModal.classList.remove('collapsed', 'hide');
            breakingNewsModal.classList.add('show');
            breakingNewsModal.style.display = 'flex';
            state.isModalActive = true;
            
            // Restart the loop with fresh animations
            if (state.currentNewsArray.length > 0) {
                startBreakingNewsLoop(state.currentNewsArray);
            }
        }
    });

    /**
     * Load breaking news from API endpoint
     */
    function loadBreakingNews() {
        fetch('/api/breaking-news')
            .then(response => {
                if (!response.ok) throw new Error('API response error');
                return response.json();
            })
            .then(data => {
                if (data && data.data && data.data.length > 0) {
                    const newItems = data.data.filter(item => !state.currentNewsArray.includes(item));
                    
                    // Update current news array
                    state.currentNewsArray = data.data;
                    state.lastUpdatedAt = data.updated_at || 0;

                    // If new items detected, show them immediately (even if user closed it)
                    if (newItems.length > 0) {
                        console.log(`New breaking news detected: ${newItems.length} item(s)`);
                        // Reset user closed flag when there's new news
                        state.isUserClosed = false;
                        state.isDisplaying = false; // Reset display flag to ensure modal opens
                        localStorage.removeItem('breakingNewsUserClosed');
                        newItems.forEach(newItem => {
                            showNewBreakingNews(newItem);
                        });
                    } else if (state.currentNewsArray.length > 0 && !state.isDisplaying && !state.isUserClosed) {
                        // Initial load: show all breaking news (only if not user-closed)
                        if (!breakingNewsModal.classList.contains('show')) {
                            startBreakingNewsLoop(state.currentNewsArray);
                            breakingNewsModal.classList.add('show');
                            state.isModalActive = true;
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error loading breaking news:', error);
            })
            .finally(() => {
                // Schedule next poll
                scheduleNextPoll();
            });
    }

    /**
     * Schedule the next poll for breaking news
     */
    function scheduleNextPoll() {
        clearTimeout(state.pollTimeoutId);
        state.pollTimeoutId = setTimeout(() => {
            loadBreakingNews();
        }, CONFIG.POLL_INTERVAL);
    }

    /**
     * Stop polling when page is hidden
     */
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            clearTimeout(state.pollTimeoutId);
        } else {
            // Resume polling when page becomes visible
            loadBreakingNews();
        }
    });

    /**
     * Cleanup on page unload
     */
    window.addEventListener('beforeunload', function() {
        clearTimeout(state.pollTimeoutId);
        clearTimeout(state.displayTimeoutId);
    });

    // Load breaking news on page load and start polling
    loadBreakingNews();
});
