<!-- Media Tab -->
<div  class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
    {{-- Template Type radios --}}
    <div class="form-group mt-3 mb-4">
        @foreach ([
        'normal_image' => ['ar' => 'صورة عادية', 'en' => 'Normal Image'],
        'video' => ['ar' => 'فيديو', 'en' => 'Video'],
        'podcast' => ['ar' => 'بودكاست', 'en' => 'Podcast'],
        'album' => ['ar' => 'ألبوم صور', 'en' => 'Photo Album'],
        'no_image' => ['ar' => 'بدون صورة', 'en' => 'No Image'],
    ] as $value => $texts)
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="template_{{ $value }}" name="template" class="custom-control-input"
                    value="{{ $value }}" {{ $value === 'normal_image' ? 'checked' : '' }}>
                <label data-en="{{ $texts['en'] }}" data-ar="{{ $texts['ar'] }}" class="custom-control-label"
                    for="template_{{ $value }}">
                    {{ $texts['ar'] }}
                </label>
            </div>
        @endforeach
    </div>

    {{-- Include each template partial --}}
    @include('dashboard.components.partials.media-normal-image')
    @include('dashboard.components.partials.media-video')
    @include('dashboard.components.partials.media-podcast')
    @include('dashboard.components.partials.media-album')
    @include('dashboard.components.partials.media-no-image')


</div>

{{-- استدعاء سكريبت الميديا --}}
<script src="{{ asset('js/media-handler.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const rules = {
        normal_image: [
            "normal_main_image",
            "normal_mobile_image",
            "normal_content_image",
        ],
        video: [
            "video_main_image",
            "video_mobile_image",
            "video_content_image",
            "video_file",
        ],
        podcast: [
            "podcast_main_image",
            "podcast_content_image",
            "podcast_mobile_image",
            "podcast_file",
        ],
        album: [
            "album_main_image",
            "album_content_image",
            "album_mobile_image",
        ],
        no_image: [
            "no_image_main_image",
            "no_image_mobile_image",
        ],
    };

    const form = document.getElementById("contentForm");
    const publishButton = document.getElementById("publishButton");

    // Detect current language
    const currentLang = localStorage.getItem('siteLang') || 'en';

    // Texts for both languages
    const alertTexts = {
        en: {
            title: "Validation failed",
            confirmButtonText: "OK"
        },
        ar: {
            title: "فشل التحقق",
            confirmButtonText: "حسناً"
        }
    };

    publishButton.addEventListener("click", function (e) {
        const selectedTemplate = document.querySelector('input[name="template"]:checked').value;
        const requiredFields = rules[selectedTemplate] || [];
        const errors = [];

        requiredFields.forEach(fieldName => {
            const fileInput = document.querySelector(`input[type="file"][name="${fieldName}"]`);
            const urlInput = document.getElementById(fieldName + "_url");

            const hasFile = fileInput && fileInput.files && fileInput.files.length > 0;
            const hasUrl = urlInput && urlInput.value.trim() !== "";

            if (!hasFile && !hasUrl) {
                errors.push(`${fieldName} is required`);
            }
        });

        const tags = document.getElementById("hiddenTags").children;
        if (tags.length === 0) {
            errors.push(currentLang === "ar" ? "يجب إضافة وسم واحد على الأقل" : "At least one tag is required");
        }

        if (errors.length > 0) {
            e.preventDefault();
            Swal.fire({
                title: alertTexts[currentLang].title,
                html: "<ul style='text-align: center;'>" + errors.map(e => "<li class=''>" + e + "</li>").join("") + "</ul>",
                icon: "error",
                confirmButtonText: alertTexts[currentLang].confirmButtonText
            });
        }
    });
});
</script>
