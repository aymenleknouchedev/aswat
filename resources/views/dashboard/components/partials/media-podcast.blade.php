{{-- podcast fields --}}
<div id="media-podcast-field" style="display:none;">
    <label data-ar="اختر مصدر البودكاست" data-en="Choose Podcast Source">اختر مصدر البودكاست</label>
    <div>
        @foreach ([
            'local' => ['ar' => 'رفع من الجهاز', 'en' => 'Upload from device'],
            'url' => ['ar' => 'رابط مباشر', 'en' => 'Direct URL'],
            'website' => ['ar' => 'من الموقع', 'en' => 'From Website'],
        ] as $sourceValue => $texts)
            <div class="custom-control custom-radio custom-control-inline custom-control">
                <input type="radio" id="podcast_source_{{ $sourceValue }}" name="podcast_source" 
                       value="{{ $sourceValue }}" class="custom-control-input" 
                       {{ $sourceValue === 'local' ? 'checked' : '' }}>
                <label class="custom-control-label" for="podcast_source_{{ $sourceValue }}"
                       data-ar="{{ $texts['ar'] }}" data-en="{{ $texts['en'] }}">
                    {{ $texts['ar'] }}
                </label>
            </div>
        @endforeach
    </div>

    <div class="source-local-fields mt-2">
        <div class="mb-3">
            <label for="podcast_file" data-ar="ملف البودكاست (رفع من الجهاز)" data-en="Podcast File (Upload from device)">
                ملف البودكاست (رفع من الجهاز)
            </label>
            <input id="podcast_file" name="podcast_local" type="file"
                class="form-control form-control-lg" accept="audio/*">
        </div>
        <div class="mb-3">
            <label for="podcast_main_image" data-ar="صورة الواجهة (رفع من الجهاز)" data-en="Main Image (Upload from device)">
                صورة الواجهة (رفع من الجهاز)
            </label>
            <input id="podcast_main_image" name="podcast_main_image_local" type="file"
                class="form-control form-control-lg" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="podcast_mobile_image" data-ar="صورة الموبايل (رفع من الجهاز)" data-en="Mobile Image (Upload from device)">
                صورة الموبايل (رفع من الجهاز)
            </label>
            <input id="podcast_mobile_image" name="podcast_mobile_image_local" type="file"
                class="form-control form-control-lg" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="podcast_content_image" data-ar="صورة المحتوى (رفع من الجهاز)" data-en="Content Image (Upload from device)">
                صورة المحتوى (رفع من الجهاز)
            </label>
            <input id="podcast_content_image" name="podcast_content_image_local" type="file"
                class="form-control form-control-lg" accept="image/*">
        </div>
    </div>

    <div class="source-url-fields mt-2" style="display:none;">
        <div class="mb-3">
            <label for="podcast_link" data-ar="رابط البودكاست" data-en="Podcast URL">رابط البودكاست</label>
            <input id="podcast_link" name="podcast_url" type="url" class="form-control form-control-lg" placeholder="https://">
        </div>
        <div class="mb-3">
            <label for="podcast_main_image_url" data-ar="رابط صورة الواجهة" data-en="Main Image URL">
                رابط صورة الواجهة
            </label>
            <input id="podcast_main_image_url" name="podcast_main_image_url" type="url" class="form-control form-control-lg" placeholder="https://">
        </div>
        <div class="mb-3">
            <label for="podcast_mobile_image_url" data-ar="رابط صورة الموبايل" data-en="Mobile Image URL">
                رابط صورة الموبايل
            </label>
            <input id="podcast_mobile_image_url" name="podcast_mobile_image_url" type="url" class="form-control form-control-lg" placeholder="https://">
        </div>
        <div class="mb-3">
            <label for="podcast_content_image_url" data-ar="رابط صورة المحتوى" data-en="Content Image URL">
                رابط صورة المحتوى
            </label>
            <input id="podcast_content_image_url" name="podcast_content_image_url" type="url" class="form-control form-control-lg" placeholder="https://">
        </div>
    </div>

    <div class="source-website-fields mt-2" style="display:none;">
        <div class="mb-3">
            <label for="podcast_website" data-ar="اختر بودكاست من الموقع" data-en="Select Podcast from Website">اختر بودكاست من الموقع</label>
            <select id="podcast_website" name="podcast_website" class="form-select form-control-lg">
                <option value="" data-ar="اختر بودكاست" data-en="Choose Podcast">اختر بودكاست</option>
                @foreach ($existing_podcasts as $podcast)
                    <option value="{{ $podcast }}" data-ar="{{ $podcast }}" data-en="{{ $podcast }}">{{ $podcast }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="podcast_main_image_website" data-ar="اختر صورة الواجهة من الموقع" data-en="Select Main Image from Website">
                اختر صورة الواجهة من الموقع
            </label>
            <select id="podcast_main_image_website" name="podcast_main_image_website" class="form-select form-control-lg">
                <option value="" data-ar="اختر صورة" data-en="Choose Image">اختر صورة</option>
                @foreach ($existing_images as $image)
                    <option value="{{ $image }}" data-ar="{{ $image }}" data-en="{{ $image }}">{{ $image }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="podcast_mobile_image_website" data-ar="اختر صورة الموبايل من الموقع" data-en="Select Mobile Image from Website">
                اختر صورة الموبايل من الموقع
            </label>
            <select id="podcast_mobile_image_website" name="podcast_mobile_image_website" class="form-select form-control-lg">
                <option value="" data-ar="اختر صورة" data-en="Choose Image">اختر صورة</option>
                @foreach ($existing_images as $image)
                    <option value="{{ $image }}" data-ar="{{ $image }}" data-en="{{ $image }}">{{ $image }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="podcast_content_image_website" data-ar="اختر صورة المحتوى من الموقع" data-en="Select Content Image from Website">
                اختر صورة المحتوى من الموقع
            </label>
            <select id="podcast_content_image_website" name="podcast_content_image_website" class="form-select form-control-lg">
                <option value="" data-ar="اختر صورة" data-en="Choose Image">اختر صورة</option>
                @foreach ($existing_images as $image)
                    <option value="{{ $image }}" data-ar="{{ $image }}" data-en="{{ $image }}">{{ $image }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>