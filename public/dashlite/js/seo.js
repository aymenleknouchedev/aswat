document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('title');
    const summaryInput = document.getElementById('summary');
    const seoKeywordInput = document.getElementById('seo_keyword');
    const seoBar = document.getElementById('seo-bar');
    const seoText = document.getElementById('seo-text');
    const seoFeedback = document.getElementById('seo-feedback');

    function wordCount(str) {
        if (!str) return 0;
        return str.trim().split(/\s+/).filter(w => w.length > 0).length;
    }

    function keywordDensity(text, keyword) {
        if (!keyword) return 0;
        const words = text.toLowerCase().split(/\s+/);
        const keywordLower = keyword.toLowerCase();
        const keywordCount = words.filter(w => w === keywordLower).length;
        return (keywordCount / words.length) * 100;
    }

    function getEditorContent() {
        const editor = tinymce.get('myeditorinstance');
        if (editor) {
            return editor.getContent({
                format: 'text'
            }).trim();
        }
        return '';
        
    }

    function evaluateSEO() {
        const feedbacks = [];
        const title = titleInput.value.trim();
        const summary = summaryInput.value.trim();
        const content = getEditorContent();
        const keyword = seoKeywordInput.value.trim();

        let score = 0;

        // عنوان 30-70 حرف
        if (title.length < 30) {
            feedbacks.push("العنوان قصير جداً (يفضل أن يكون 60-70 حرف).");
            score += 10; // minimum score for too short
        } else if (title.length > 70) {
            feedbacks.push("العنوان طويل جداً (يفضل أن يكون 60-70 حرف).");
            score += 10; // minimum score for too long
        } else {
            // scale score from 10 (length=30) up to 75 (length=70)
            score += Math.round(10 + ((title.length - 30) / (70 - 30)) * (75 - 10));
        }


        // ملخص 125-130 حرف
        if (summary.length < 125) {
            feedbacks.push("الملخص قصير جداً (يفضل أن يكون 125-130 حرف).");
            score += 10;
        } else if (summary.length > 130) {
            feedbacks.push("الملخص طويل جداً (يفضل أن يكون 125-130 حرف).");
            score += 10;
        } else {
            score += 150; // max score in this range
        }



        // عدد كلمات المحتوى >= 300
        const contentWords = wordCount(content);
        if (contentWords < 300) {
            feedbacks.push(
                `المحتوى قصير جداً (${contentWords} كلمة فقط - ينصح بكتابة 300 كلمة على الأقل).`);
        } else {
            score += 30;
        }

        // كثافة الكلمة المفتاحية 1%-5%
        const density = keywordDensity(content, keyword);
        if (!keyword) {
            feedbacks.push("يرجى إدخال الكلمة المفتاحية لتحليل السيو.");
        } else if (density < 1) {
            feedbacks.push(`الكلمة المفتاحية "${keyword}" نادرة جداً في المحتوى (ينصح بنسبة 1-3%).`);
        } else if (density > 5) {
            feedbacks.push(`الكلمة المفتاحية "${keyword}" مكررة بشكل مبالغ فيه (يفضل أقل من 5%).`);
            score += 10;
        } else {
            score += 20;
        }

        // التحقق من وجود صورة رئيسية
        const mainImageInput = document.getElementById('normal_main_image');
        if (!mainImageInput || mainImageInput.files.length === 0) {
            feedbacks.push("يفضل إضافة صورة رئيسية لتحسين السيو.");
        } else {
            score += 10;
        }

        if (score > 100) score = 100;

        return {
            score,
            feedbacks
        };
    }

    function updateSEOBar() {
        const {
            score,
            feedbacks
        } = evaluateSEO();

        let color = 'red';
        if (score >= 75) {
            color = 'green';
        } else if (score >= 40) {
            color = 'yellow';
        }

        seoBar.style.width = score + '%';
        seoBar.style.backgroundColor = color;
        seoBar.setAttribute('aria-valuenow', score);

        if (score === 0) {
            seoText.textContent = "يرجى كتابة المحتوى لتقييم السيو";
            seoFeedback.style.display = 'none';
        } else {
            seoText.textContent = `تقييم السيو: ${score}%`;
            if (feedbacks.length > 0) {
                seoFeedback.style.display = 'block';
                seoFeedback.innerHTML = '<ul style="margin:0; padding-left: 20px; color:' +
                    (color === 'green' ? 'green' : color === 'yellow' ? '#c68600' : 'red') + ';">' +
                    feedbacks.map(fb => `<li>${fb}</li>`).join('') + '</ul>';
            } else {
                seoFeedback.style.display = 'none';
            }
        }
    }

    // حدث عند كتابة النصوص العادية
    [titleInput, summaryInput, seoKeywordInput].forEach(input => {
        input.addEventListener('input', updateSEOBar);
    });

    // حدث على محرر TinyMCE
    function attachEditorListeners() {
        const editor = tinymce.get('myeditorinstance');
        if (editor) {
            editor.on('change input undo redo keyup PastePostProcess', updateSEOBar);
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

    // تحديث دوري كل 500ms لضمان التحديث real-time
    // setInterval(updateSEOBar, 500);

    // تحديث مبدئي
    // updateSEOBar();
});