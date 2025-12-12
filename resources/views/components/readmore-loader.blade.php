<script>
    // Dynamic ReadMore Content Loader
    (function() {
        'use strict';

        /**
         * Load and render ReadMore blocks dynamically
         */
        function loadReadMoreBlocks() {
            const readMoreBlocks = document.querySelectorAll('.read-more-block[data-content-id]');

            if (readMoreBlocks.length === 0) {
                return;
            }

            // Extract all content IDs
            const contentIds = Array.from(readMoreBlocks).map(block => block.dataset.contentId);

            // Batch fetch all ReadMore contents
            fetch('/api/readmore-batch', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ ids: contentIds })
            })
            .then(response => {
                if (!response.ok) {
                    console.error('ReadMore API error:', response.status, response.statusText);
                    throw new Error(`Network response was not ok: ${response.status}`);
                }
                return response.json();
            })
            .then(result => {
                console.log('ReadMore API response:', result);
                if (result.success && result.data) {
                    // Replace each placeholder with actual content
                    readMoreBlocks.forEach(block => {
                        const contentId = block.dataset.contentId;
                        const contentData = result.data.find(item => item.id == contentId);

                        if (contentData) {
                            console.log(`Rendering ReadMore card for ID: ${contentId}`, contentData);
                            renderReadMoreCard(block, contentData);
                        } else {
                            // Content not found - hide the placeholder
                            block.style.display = 'none';
                            console.warn(`ReadMore content not found for ID: ${contentId}`);
                        }
                    });
                } else {
                    console.error('Failed to load ReadMore content:', result.message || 'Unknown error');
                }
            })
            .catch(error => {
                console.error('Error fetching ReadMore content:', error);
                // Optionally hide placeholders on error
                readMoreBlocks.forEach(block => {
                    const placeholder = block.querySelector('.read-more-placeholder');
                    if (placeholder) {
                        placeholder.textContent = 'خطأ في تحميل المحتوى';
                        placeholder.style.color = '#dc3545';
                    }
                });
            });
        }

        /**
         * Render a ReadMore card with fetched data
         */
        function renderReadMoreCard(placeholderBlock, contentData) {
            // Remove the placeholder text
            const placeholder = placeholderBlock.querySelector('.read-more-placeholder');
            if (placeholder) {
                placeholder.remove();
            }

            // Set the shortlink data attribute for click handler
            if (contentData.shortlink) {
                placeholderBlock.setAttribute('data-shortlink', contentData.shortlink);
            }

            // Build the HTML for the ReadMore card content
            let html = '<span class="read-more-label-text">اقرأ أيضاً</span>';

            if (contentData.image_url) {
                html += `<img src="${escapeHtml(contentData.image_url)}" alt="${escapeHtml(contentData.title)}" class="read-more-image">`;
            }

            html += '<div class="read-more-content">';

            if (contentData.category) {
                html += `<p class="read-more-category">${escapeHtml(contentData.category)}</p>`;
            }

            html += `<h3 class="read-more-title">${escapeHtml(contentData.title)}</h3>`;

            if (contentData.summary) {
                html += `<p class="read-more-summary">${escapeHtml(contentData.summary)}</p>`;
            }

            html += '</div>';

            // Insert the content into the existing block instead of replacing it
            placeholderBlock.innerHTML = html;
        }

        /**
         * Escape HTML to prevent XSS
         */
        function escapeHtml(text) {
            if (!text) return '';
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return String(text).replace(/[&<>"']/g, m => map[m]);
        }

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadReadMoreBlocks);
        } else {
            loadReadMoreBlocks();
        }

        // Expose global refresh function for external use
        window.refreshReadMoreCards = function() {
            console.log('Refreshing ReadMore cards...');

            // Refresh cards in the main document
            loadReadMoreBlocks();

            // Also refresh cards inside TinyMCE editor if it exists
            if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
                const editor = tinymce.activeEditor;
                const editorBody = editor.getBody();
                const editorBlocks = editorBody.querySelectorAll('.read-more-block[data-content-id]');

                if (editorBlocks.length > 0) {
                    console.log(`Found ${editorBlocks.length} readmore cards in TinyMCE editor`);

                    // Extract content IDs from editor
                    const contentIds = Array.from(editorBlocks).map(block => block.dataset.contentId);

                    // Batch fetch all ReadMore contents
                    fetch('/api/readmore-batch', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify({ ids: contentIds })
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success && result.data) {
                            // Replace each placeholder with updated content in editor
                            editorBlocks.forEach(block => {
                                const contentId = block.dataset.contentId;
                                const contentData = result.data.find(item => item.id == contentId);

                                if (contentData) {
                                    console.log(`Updating TinyMCE ReadMore card for ID: ${contentId}`);
                                    renderReadMoreCard(block, contentData);
                                }
                            });

                            // Mark editor as dirty so changes are detected
                            editor.setDirty(true);
                        }
                    })
                    .catch(error => {
                        console.error('Error refreshing ReadMore cards in TinyMCE:', error);
                    });
                }
            }
        };
    })();
</script>
