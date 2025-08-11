{{-- no_image fields --}}
<div id="media-no_image-field" style="display:none;">
    <label data-ar="اختر مصدر الصورة" data-en="Choose Image Source">اختر مصدر الصورة</label>
    <div>
        @foreach ([
        'local' => ['ar' => 'رفع من الجهاز', 'en' => 'Upload from device'],
        'url' => ['ar' => 'رابط مباشر', 'en' => 'Direct URL'],
        'website' => ['ar' => 'من الموقع', 'en' => 'From Website'],
    ] as $sourceValue => $texts)
            <div class="custom-control custom-radio custom-control-inline custom-control">
                <input type="radio" id="no_image_source_{{ $sourceValue }}" name="no_image_source"
                    value="{{ $sourceValue }}" class="custom-control-input"
                    {{ $sourceValue === 'local' ? 'checked' : '' }}>
                <label class="custom-control-label" for="no_image_source_{{ $sourceValue }}"
                    data-ar="{{ $texts['ar'] }}" data-en="{{ $texts['en'] }}">
                    {{ $texts['ar'] }}
                </label>
            </div>
        @endforeach
    </div>

    {{-- Local Upload --}}
    <div class="source-local-fields mt-2">
        <div class="mb-3">
            <label for="no_main_image" data-ar="صورة الواجهة (رفع من الجهاز)" data-en="Main Image (Upload from device)">
                صورة الواجهة (رفع من الجهاز)
            </label>
            <input id="no_main_image" name="no_main_image_local" type="file" class="form-control form-control-lg"
                accept="image/*">
        </div>
        <div class="mb-3">
            <label for="no_mobile_image" data-ar="صورة الموبايل (رفع من الجهاز)"
                data-en="Mobile Image (Upload from device)">
                صورة الموبايل (رفع من الجهاز)
            </label>
            <input id="no_mobile_image" name="no_mobile_image_local" type="file" class="form-control form-control-lg"
                accept="image/*">
        </div>
    </div>

    {{-- URL Input --}}
    <div class="source-url-fields mt-2" style="display:none;">
        <div class="mb-3">
            <label for="no_main_image_url" data-ar="رابط صورة الواجهة" data-en="Main Image URL">
                رابط صورة الواجهة
            </label>
            <input id="no_main_image_url" name="no_main_image_url" type="url" class="form-control form-control-lg"
                placeholder="https://">
        </div>
        <div class="mb-3">
            <label for="no_mobile_image_url" data-ar="رابط صورة الموبايل" data-en="Mobile Image URL">
                رابط صورة الموبايل
            </label>
            <input id="no_mobile_image_url" name="no_mobile_image_url" type="url"
                class="form-control form-control-lg" placeholder="https://">
        </div>
    </div>

    {{-- Website Select --}}
    <div class="source-website-fields mt-2" style="display:none;">
        <div class="mb-3">
            <label for="no_main_image_website" data-ar="اختر صورة الواجهة من الموقع"
                data-en="Select Main Image from Website">
                اختر صورة الواجهة من الموقع
            </label>
            <select id="no_main_image_website" name="no_main_image_website" class="form-select form-control-lg">
                <option value="" data-ar="اختر صورة" data-en="Choose Image">اختر صورة</option>
                @foreach ($existing_images as $image)
                    <option value="{{ $image }}" data-ar="{{ $image }}" data-en="{{ $image }}">
                        {{ $image }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="no_mobile_image_website" data-ar="اختر صورة الموبايل من الموقع"
                data-en="Select Mobile Image from Website">
                اختر صورة الموبايل من الموقع
            </label>
            <select id="no_mobile_image_website" name="no_mobile_image_website" class="form-select form-control-lg">
                <option value="" data-ar="اختر صورة" data-en="Choose Image">اختر صورة</option>
                @foreach ($existing_images as $image)
                    <option value="{{ $image }}" data-ar="{{ $image }}" data-en="{{ $image }}">
                        {{ $image }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const noImageContainer = document.getElementById('media-no_image-field');
        const radios = noImageContainer.querySelectorAll('input[name="no_image_source"]');

        function toggleFields(source) {
            // Hide all
            noImageContainer.querySelector('.source-local-fields').style.display = 'none';
            noImageContainer.querySelector('.source-url-fields').style.display = 'none';
            noImageContainer.querySelector('.source-website-fields').style.display = 'none';

            // Show the one matching the selected source
            if (source === 'local') {
                noImageContainer.querySelector('.source-local-fields').style.display = 'block';
            } else if (source === 'url') {
                noImageContainer.querySelector('.source-url-fields').style.display = 'block';
            } else if (source === 'website') {
                noImageContainer.querySelector('.source-website-fields').style.display = 'block';
            }
        }

        // Init
        const checked = noImageContainer.querySelector('input[name="no_image_source"]:checked');
        if (checked) {
            toggleFields(checked.value);
        }

        // On change
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                toggleFields(this.value);
            });
        });
    });
</script>
