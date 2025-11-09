/**
 * ==========================================
 * SEO INTELLIGENT EVALUATION SYSTEM
 * ==========================================
 * Comprehensive SEO analysis for all article form inputs
 * Working with all tabs and form fields
 */

document.addEventListener('DOMContentLoaded', function () {
    // ===== DOM ELEMENTS =====
    const seoBar = document.getElementById('seo-bar');
    const seoText = document.getElementById('seo-text');
    const seoFeedback = document.getElementById('seo-feedback');

    // Form inputs
    const titleInput = document.getElementById('title');
    const longTitleInput = document.getElementById('long_title');
    const mobileTitleInput = document.getElementById('mobile_title');
    const summaryInput = document.getElementById('summary');
    const seoKeywordInput = document.getElementById('seo_keyword');

    // Category fields
    const sectionInput = document.querySelector('input[name="section_id"]');
    const categoryInput = document.querySelector('input[name="category_id"]');
    const trendInput = document.querySelector('input[name="trend_id"]');
    const windowInput = document.querySelector('input[name="window_id"]');
    const tagsInput = document.querySelector('input[name="tags_id[]"]');

    // ===== UTILITY FUNCTIONS =====

    /**
     * Count words in text
     */
    function wordCount(str) {
        if (!str) return 0;
        return str.trim().split(/\s+/).filter(w => w.length > 0).length;
    }

    /**
     * Calculate keyword density in text
     */
    function keywordDensity(text, keyword) {
        if (!keyword || !text) return 0;
        const words = text.toLowerCase().split(/\s+/).filter(w => w.length > 0);
        if (words.length === 0) return 0;
        
        const keywordLower = keyword.toLowerCase();
        const keywordCount = words.filter(w => w === keywordLower).length;
        return (keywordCount / words.length) * 100;
    }

    /**
     * Count keyword occurrences in text
     */
    function countKeywordOccurrences(text, keyword) {
        if (!keyword || !text) return 0;
        const regex = new RegExp(keyword, 'gi');
        const matches = text.match(regex);
        return matches ? matches.length : 0;
    }

    /**
     * Get TinyMCE editor content
     */
    function getEditorContent() {
        const editor = tinymce.get('myeditorinstance');
        if (editor) {
            return editor.getContent({ format: 'text' }).trim();
        }
        return '';
    }

    /**
     * Check if field has a value
     */
    function hasValue(element) {
        if (!element) return false;
        return element.value && element.value.trim() !== '';
    }

    /**
     * Count selected items (tags, writers, etc.)
     */
    function countSelectedItems(fieldName) {
        const container = document.querySelector(`#${fieldName}-selected-container`);
        if (!container) return 0;
        
        if (fieldName === 'tags_id') {
            return container.querySelectorAll('.tag-item').length;
        } else if (fieldName === 'writers-selected') {
            return container.querySelectorAll('.writer-item').length;
        }
        return 0;
    }

    /**
     * Check if image exists in media tab
     * Checks MediaTabManager state and preview containers
     */
    function hasMainImage() {
        // Check if MediaTabManager exists with state
        if (window.mediaTabManager && window.mediaTabManager.state) {
            const selectedMedia = window.mediaTabManager.state.selectedMedia;
            
            // Check for normal_main_image
            if (selectedMedia.normal_main_image) {
                const media = selectedMedia.normal_main_image;
                if (media.url || media.id) {
                    return true;
                }
            }
            
            // Check for video_main_image
            if (selectedMedia.video_main_image) {
                const media = selectedMedia.video_main_image;
                if (media.url || media.id) {
                    return true;
                }
            }
            
            // Check for podcast_main_image
            if (selectedMedia.podcast_main_image) {
                const media = selectedMedia.podcast_main_image;
                if (media.url || media.id) {
                    return true;
                }
            }
            
            // Check for album_main_image
            if (selectedMedia.album_main_image) {
                const media = selectedMedia.album_main_image;
                if (media.url || media.id) {
                    return true;
                }
            }
        }
        
        // Fallback: Check preview containers
        const previewImg = document.getElementById('preview_image');
        if (previewImg && previewImg.src) {
            return true;
        }
        
        // Check for image preview in media tab
        const imageContainer = document.getElementById('preview_image_container');
        if (imageContainer && imageContainer.style.display !== 'none') {
            const img = imageContainer.querySelector('img');
            if (img && img.src) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Count total images in media tab
     */
    function countMediaItems() {
        let count = 0;
        
        if (window.mediaTabManager && window.mediaTabManager.state) {
            const selectedMedia = window.mediaTabManager.state.selectedMedia;
            
            // Count all media items
            Object.keys(selectedMedia).forEach(key => {
                const media = selectedMedia[key];
                if (Array.isArray(media)) {
                    count += media.filter(m => m.url || m.id).length;
                } else if (media && (media.url || media.id)) {
                    count += 1;
                }
            });
        }
        
        // Fallback: Check preview containers
        if (count === 0) {
            const imageContainer = document.getElementById('preview_image_container');
            if (imageContainer && imageContainer.style.display !== 'none') {
                const imgs = imageContainer.querySelectorAll('img');
                count += imgs.length;
            }
            
            const videosContainer = document.getElementById('videos-list');
            if (videosContainer) {
                count += videosContainer.querySelectorAll('[data-video-id]').length;
            }
        }
        
        return count;
    }

    // ===== MAIN SEO EVALUATION FUNCTION =====

    function evaluateSEO() {
        const feedbacks = [];
        let score = 0;
        const maxScore = 100;

        // ============================================
        // 1. TITLE EVALUATION (15 points)
        // ============================================
        const title = titleInput ? titleInput.value.trim() : '';
        let titleScore = 0;

        if (!title) {
            feedbacks.push("❌ العنوان: مفقود - يجب إضافة عنوان للمقالة.");
            titleScore = 0;
        } else if (title.length < 30) {
            feedbacks.push(`⚠️ العنوان قصير جداً (${title.length}/30 حرف) - يفضل أن يكون 60-70 حرف.`);
            titleScore = 5;
        } else if (title.length > 70) {
            feedbacks.push(`⚠️ العنوان طويل جداً (${title.length}/70 حرف) - يفضل أن يكون 60-70 حرف.`);
            titleScore = 8;
        } else if (title.length >= 50 && title.length <= 70) {
            feedbacks.push(`✅ العنوان جيد (${title.length} حرف) - طول مثالي للسيو.`);
            titleScore = 15;
        } else {
            titleScore = 10;
        }
        score += titleScore;

        // ============================================
        // 2. LONG TITLE EVALUATION (5 points)
        // ============================================
        const longTitle = longTitleInput ? longTitleInput.value.trim() : '';
        let longTitleScore = 0;

        if (longTitle && longTitle.length >= 100 && longTitle.length <= 210) {
            feedbacks.push(`✅ العنوان الطويل جيد (${longTitle.length} حرف).`);
            longTitleScore = 5;
        } else if (longTitle && longTitle.length < 100) {
            feedbacks.push(`⚠️ العنوان الطويل قصير (${longTitle.length}/100 حرف).`);
            longTitleScore = 2;
        } else if (!longTitle) {
            feedbacks.push("⚠️ العنوان الطويل: مفقود - يساعد في تحسين الظهور بمحركات البحث.");
            longTitleScore = 0;
        }
        score += longTitleScore;

        // ============================================
        // 3. MOBILE TITLE EVALUATION (5 points)
        // ============================================
        const mobileTitle = mobileTitleInput ? mobileTitleInput.value.trim() : '';
        let mobileTitleScore = 0;

        if (mobileTitle && mobileTitle.length >= 20 && mobileTitle.length <= 40) {
            feedbacks.push(`✅ عنوان الموبايل مثالي (${mobileTitle.length} حرف).`);
            mobileTitleScore = 5;
        } else if (mobileTitle && mobileTitle.length < 20) {
            feedbacks.push(`⚠️ عنوان الموبايل قصير جداً (${mobileTitle.length}/20 حرف).`);
            mobileTitleScore = 2;
        } else if (!mobileTitle) {
            feedbacks.push("⚠️ عنوان الموبايل: مفقود - ضروري للعرض الجيد على الهواتف الذكية.");
            mobileTitleScore = 0;
        }
        score += mobileTitleScore;

        // ============================================
        // 4. SUMMARY/META DESCRIPTION EVALUATION (15 points)
        // ============================================
        const summary = summaryInput ? summaryInput.value.trim() : '';
        let summaryScore = 0;

        if (!summary) {
            feedbacks.push("❌ الملخص: مفقود - يجب إضافة ملخص جذاب للمقالة.");
            summaryScore = 0;
        } else if (summary.length < 100) {
            feedbacks.push(`⚠️ الملخص قصير جداً (${summary.length}/130 حرف) - يفضل 120-130 حرف.`);
            summaryScore = 5;
        } else if (summary.length > 160) {
            feedbacks.push(`⚠️ الملخص طويل جداً (${summary.length}/130 حرف) - يفضل 120-130 حرف.`);
            summaryScore = 8;
        } else if (summary.length >= 120 && summary.length <= 130) {
            feedbacks.push(`✅ الملخص ممتاز (${summary.length} حرف) - طول مثالي.`);
            summaryScore = 15;
        } else {
            summaryScore = 10;
        }
        score += summaryScore;

        // ============================================
        // 5. CONTENT BODY EVALUATION (20 points)
        // ============================================
        const content = getEditorContent();
        const contentWords = wordCount(content);
        let contentScore = 0;

        if (!content) {
            feedbacks.push("❌ المحتوى: مفقود - يجب إضافة محتوى للمقالة.");
            contentScore = 0;
        } else if (contentWords < 100) {
            feedbacks.push(`⚠️ المحتوى قصير جداً (${contentWords} كلمة) - ينصح بـ 300+ كلمة.`);
            contentScore = 3;
        } else if (contentWords < 300) {
            feedbacks.push(`⚠️ المحتوى قصير (${contentWords} كلمة) - الحد الأدنى المفضل 300 كلمة.`);
            contentScore = 8;
        } else if (contentWords >= 300 && contentWords <= 1000) {
            feedbacks.push(`✅ محتوى جيد (${contentWords} كلمة) - طول ممتاز للسيو.`);
            contentScore = 20;
        } else if (contentWords > 1000 && contentWords <= 3000) {
            feedbacks.push(`✅ محتوى شامل (${contentWords} كلمة) - محتوى قوي جداً.`);
            contentScore = 18;
        } else {
            feedbacks.push(`⚠️ المحتوى طويل جداً (${contentWords} كلمة) - قد يؤثر على الظهور.`);
            contentScore = 12;
        }
        score += contentScore;

        // ============================================
        // 6. SEO KEYWORD EVALUATION (15 points)
        // ============================================
        const keyword = seoKeywordInput ? seoKeywordInput.value.trim() : '';
        let keywordScore = 0;

        if (!keyword) {
            feedbacks.push("❌ الكلمة المفتاحية: مفقود - يجب تحديد كلمة مفتاحية رئيسية.");
            keywordScore = 0;
        } else {
            // Check keyword in title
            const keywordInTitle = title.toLowerCase().includes(keyword.toLowerCase());
            const keywordInSummary = summary.toLowerCase().includes(keyword.toLowerCase());
            
            // Calculate keyword density
            const density = keywordDensity(content, keyword);
            const occurrences = countKeywordOccurrences(content, keyword);

            let keywordMessage = `🔍 الكلمة المفتاحية: "${keyword}"`;

            // Title presence
            if (!keywordInTitle) {
                keywordMessage += " - ⚠️ غير موجودة في العنوان";
            } else {
                keywordMessage += " - ✅ موجودة في العنوان";
                keywordScore += 3;
            }

            // Summary presence
            if (!keywordInSummary) {
                keywordMessage += "، ⚠️ غير موجودة في الملخص";
            } else {
                keywordMessage += "، ✅ موجودة في الملخص";
                keywordScore += 2;
            }

            // Keyword density analysis
            if (density === 0) {
                keywordMessage += `، ❌ كثافة: 0% (غير موجودة في المحتوى)`;
            } else if (density < 0.5) {
                keywordMessage += `، ⚠️ كثافة منخفضة: ${density.toFixed(2)}% (يفضل 1-3%)`;
                keywordScore += 3;
            } else if (density >= 0.5 && density <= 3) {
                keywordMessage += `، ✅ كثافة مثالية: ${density.toFixed(2)}% (${occurrences} مرات)`;
                keywordScore += 10;
            } else if (density > 3 && density <= 5) {
                keywordMessage += `، ⚠️ كثافة عالية: ${density.toFixed(2)}% (${occurrences} مرات) - قد تؤثر سلباً`;
                keywordScore += 6;
            } else {
                keywordMessage += `، ❌ كثافة مبالغ فيها: ${density.toFixed(2)}% (${occurrences} مرات) - تجنب الإفراط`;
                keywordScore += 2;
            }

            feedbacks.push(keywordMessage);
        }
        score += keywordScore;

        // ============================================
        // 7. CATEGORY METADATA EVALUATION (10 points)
        // ============================================
        let categoryScore = 0;
        let categoryMessage = "📂 البيانات الوصفية: ";

        const hasSection = hasValue(sectionInput);
        const hasCategory = hasValue(categoryInput);

        if (hasSection && hasCategory) {
            categoryMessage += "✅ القسم والتصنيف محددان.";
            categoryScore = 10;
        } else if (hasSection) {
            categoryMessage += "⚠️ القسم محدد، لكن التصنيف مفقود.";
            categoryScore = 6;
        } else if (hasCategory) {
            categoryMessage += "⚠️ التصنيف محدد، لكن القسم مفقود.";
            categoryScore = 6;
        } else {
            categoryMessage += "❌ القسم والتصنيف مفقودان - ضروريان لتصنيف المقالة.";
            categoryScore = 0;
        }
        feedbacks.push(categoryMessage);
        score += categoryScore;

        // ============================================
        // 8. TAGS EVALUATION (8 points)
        // ============================================
        const tagsCount = countSelectedItems('tags_id');
        let tagsScore = 0;

        if (tagsCount === 0) {
            feedbacks.push("⚠️ الوسوم: لم يتم اختيار أي وسوم - الوسوم تحسن من ظهور المقالة.");
            tagsScore = 0;
        } else if (tagsCount === 1) {
            feedbacks.push(`⚠️ وسم واحد فقط - يفضل اختيار 3-5 وسوم.`);
            tagsScore = 2;
        } else if (tagsCount >= 3 && tagsCount <= 5) {
            feedbacks.push(`✅ عدد الوسوم ممتاز (${tagsCount} وسوم).`);
            tagsScore = 8;
        } else if (tagsCount > 5) {
            feedbacks.push(`⚠️ وسوم كثيرة جداً (${tagsCount} وسوم) - الحد الأمثل 3-5.`);
            tagsScore = 4;
        } else {
            tagsScore = 3;
        }
        score += tagsScore;

        // ============================================
        // 9. MEDIA & IMAGES EVALUATION (7 points)
        // ============================================
        const hasMedia = hasMainImage();
        const mediaCount = countMediaItems();
        let mediaScore = 0;

        if (hasMedia) {
            feedbacks.push(`✅ صورة رئيسية موجودة - ضرورية للسيو والمشاركة الاجتماعية.`);
            mediaScore = 7;
            
            if (mediaCount > 1) {
                feedbacks.push(`💡 محتوى وسائط متنوع (${mediaCount} عنصر) - يحسن من الارتباط والترتيب.`);
            }
        } else {
            feedbacks.push("❌ صورة رئيسية مفقود - أساسي جداً للسيو والمشاركة على وسائل التواصل.");
            mediaScore = 0;
        }
        score += mediaScore;

        // ============================================
        // 10. ADDITIONAL METADATA (5 points)
        // ============================================
        let metaScore = 0;
        let metaMessage = "🏷️ معلومات إضافية: ";

        const hasTrend = hasValue(trendInput);
        const hasWindow = hasValue(windowInput);

        if (hasTrend && hasWindow) {
            metaMessage += "✅ الاتجاه والنافذة محددة.";
            metaScore = 5;
        } else if (hasTrend || hasWindow) {
            metaMessage += "⚠️ بعض المعلومات الإضافية مفقودة.";
            metaScore = 2;
        } else {
            metaMessage += "⚠️ معلومات إضافية غير مكتملة (اختياري لكن يحسن الظهور).";
            metaScore = 0;
        }
        feedbacks.push(metaMessage);
        score += metaScore;

        // ============================================
        // CAP SCORE AT 100
        // ============================================
        score = Math.min(score, maxScore);

        return {
            score: Math.max(0, score),
            feedbacks: feedbacks.length > 0 ? feedbacks : ["ابدأ بملء نموذج المقالة لرؤية نتائج التقييم."]
        };
    }

    /**
     * Update SEO bar and feedback display
     */
    function updateSEOBar() {
        const { score, feedbacks } = evaluateSEO();

        // Determine color based on score
        let color = '#dc3545'; // red (< 40)
        let status = 'ضعيف';
        
        if (score >= 80) {
            color = '#28a745'; // green
            status = 'ممتاز';
        } else if (score >= 60) {
            color = '#ffc107'; // yellow/warning
            status = 'جيد';
        } else if (score >= 40) {
            color = '#fd7e14'; // orange
            status = 'متوسط';
        }

        // Update progress bar
        if (seoBar) {
            seoBar.style.width = score + '%';
            seoBar.style.backgroundColor = color;
            seoBar.setAttribute('aria-valuenow', score);
        }

        // Update text display
        if (seoText) {
            if (score === 0) {
                seoText.textContent = "ابدأ بملء نموذج المقالة لرؤية تقييم السيو";
            } else {
                seoText.textContent = `تقييم السيو: ${score}% - ${status}`;
            }
            seoText.style.color = color;
        }

        // Update feedback list
        if (seoFeedback) {
            if (feedbacks.length > 0 && score > 0) {
                seoFeedback.style.display = 'block';
                seoFeedback.innerHTML = '<ul style="margin: 0; padding-left: 20px; list-style: none;">' +
                    feedbacks.map(fb => `<li style="margin-bottom: 8px; line-height: 1.5;">${fb}</li>`).join('') +
                    '</ul>';
            } else {
                seoFeedback.style.display = 'none';
            }
        }
    }

    // ===== EVENT LISTENERS =====

    // Text inputs
    const textInputs = [titleInput, longTitleInput, mobileTitleInput, summaryInput, seoKeywordInput];
    textInputs.forEach(input => {
        if (input) {
            input.addEventListener('input', updateSEOBar);
            input.addEventListener('change', updateSEOBar);
        }
    });

    // Hidden category inputs
    const categoryInputs = [sectionInput, categoryInput, trendInput, windowInput];
    categoryInputs.forEach(input => {
        if (input) {
            input.addEventListener('change', updateSEOBar);
        }
    });

    // TinyMCE editor
    function attachEditorListeners() {
        const editor = tinymce.get('myeditorinstance');
        if (editor) {
            editor.on('change input undo redo keyup PastePostProcess', () => {
                // Delay to ensure content is updated
                setTimeout(updateSEOBar, 100);
            });
        }
    }

    if (tinymce.get('myeditorinstance')) {
        attachEditorListeners();
    } else {
        tinymce.on('AddEditor', function (e) {
            if (e.editor.id === 'myeditorinstance') {
                attachEditorListeners();
            }
        });
    }

    // Watch for tag changes using MutationObserver
    const tagsContainer = document.getElementById('tags_id-selected-container');
    if (tagsContainer) {
        const observer = new MutationObserver(function() {
            updateSEOBar();
        });
        observer.observe(tagsContainer, { childList: true, subtree: true });
    }

    // Watch for writer changes
    const writersContainer = document.getElementById('writers-selected-container');
    if (writersContainer) {
        const observer = new MutationObserver(function() {
            updateSEOBar();
        });
        observer.observe(writersContainer, { childList: true, subtree: true });
    }

    // Watch for image changes in media tab
    const imageContainer = document.getElementById('preview_image_container');
    if (imageContainer) {
        const observer = new MutationObserver(function() {
            updateSEOBar();
        });
        observer.observe(imageContainer, { childList: true, subtree: true });
    }
    
    // Watch for preview image changes (from social media tab)
    const previewImage = document.getElementById('preview_image');
    if (previewImage) {
        const observer = new MutationObserver(function() {
            updateSEOBar();
        });
        observer.observe(previewImage, { attributes: true, attributeFilter: ['src'] });
    }
    
    // Hook into MediaTabManager to detect image changes
    if (window.mediaTabManager) {
        // Store original updateSummary
        const originalUpdateSummary = window.mediaTabManager.updateSummary.bind(window.mediaTabManager);
        
        // Override updateSummary to also update SEO
        window.mediaTabManager.updateSummary = function() {
            originalUpdateSummary();
            updateSEOBar();
        };
    }
    
    // Watch for MediaTabManager initialization
    const checkForMediaManager = setInterval(function() {
        if (window.mediaTabManager && !window.mediaTabManager.seoHooked) {
            window.mediaTabManager.seoHooked = true;
            
            // Store original onMediaSelected
            const originalOnMediaSelected = window.mediaTabManager.onMediaSelected.bind(window.mediaTabManager);
            
            // Override onMediaSelected to also update SEO
            window.mediaTabManager.onMediaSelected = function(media) {
                originalOnMediaSelected(media);
                setTimeout(updateSEOBar, 100);
            };
            
            clearInterval(checkForMediaManager);
        }
    }, 500);

    // Initial update on page load
    setTimeout(updateSEOBar, 500);
});