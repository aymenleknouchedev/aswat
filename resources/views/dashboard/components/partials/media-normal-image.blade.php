{{-- normal_image fields --}}
<div id="media-normal_image-fields">
    <label data-ar="اختر مصدر الصورة" data-en="Choose Image Source">اختر مصدر الصورة</label>
    <div>
        @foreach ([
        'local' => ['ar' => 'رفع من الجهاز', 'en' => 'Upload from device'],
        'url' => ['ar' => 'رابط مباشر', 'en' => 'Direct URL'],
        'website' => ['ar' => 'من الموقع', 'en' => 'From Website'],
    ] as $sourceValue => $texts)
            <div class="custom-control custom-radio custom-control-inline custom-control">
                <input type="radio" id="normal_image_source_{{ $sourceValue }}" name="normal_image_source"
                    value="{{ $sourceValue }}" class="custom-control-input"
                    {{ $sourceValue === 'local' ? 'checked' : '' }}>
                <label class="custom-control-label" for="normal_image_source_{{ $sourceValue }}"
                    data-ar="{{ $texts['ar'] }}" data-en="{{ $texts['en'] }}">
                    {{ $texts['ar'] }}
                </label>
            </div>
        @endforeach
    </div>

    <div class="source-local-fields mt-2">
        <div class="mb-3">
            <label for="normal_main_image" data-ar="صورة الواجهة (رفع من الجهاز)"
                data-en="Main Image (Upload from device)">
                صورة الواجهة (رفع من الجهاز)
            </label>
            <input id="normal_main_image" name="normal_image_local" type="file" class="form-control form-control-lg"
                accept="image/*">
        </div>
        <div class="mb-3">
            <label for="normal_mobile_image" data-ar="صورة الموبايل (رفع من الجهاز)"
                data-en="Mobile Image (Upload from device)">
                صورة الموبايل (رفع من الجهاز)
            </label>
            <input id="normal_mobile_image" name="normal_mobile_image_local" type="file"
                class="form-control form-control-lg" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="normal_content_image" data-ar="صورة المحتوى (رفع من الجهاز)"
                data-en="Content Image (Upload from device)">
                صورة المحتوى (رفع من الجهاز)
            </label>
            <input id="normal_content_image" name="normal_content_image_local" type="file"
                class="form-control form-control-lg" accept="image/*">
        </div>
    </div>

    <div class="source-url-fields mt-2" style="display:none;">
        <div class="mb-3">
            <label for="normal_main_image_url" data-ar="رابط صورة الواجهة" data-en="Main Image URL">
                رابط صورة الواجهة
            </label>
            <input id="normal_main_image_url" name="normal_image_url" type="url"
                class="form-control form-control-lg" placeholder="https://">
        </div>
        <div class="mb-3">
            <label for="normal_mobile_image_url" data-ar="رابط صورة الموبايل" data-en="Mobile Image URL">
                رابط صورة الموبايل
            </label>
            <input id="normal_mobile_image_url" name="normal_mobile_image_url" type="url"
                class="form-control form-control-lg" placeholder="https://">
        </div>
        <div class="mb-3">
            <label for="normal_content_image_url" data-ar="رابط صورة المحتوى" data-en="Content Image URL">
                رابط صورة المحتوى
            </label>
            <input id="normal_content_image_url" name="normal_content_image_url" type="url"
                class="form-control form-control-lg" placeholder="https://">
        </div>
    </div>

    <div class="source-website-fields mt-2" style="display:none;">
        <div class="mb-3">
            <label for="normal_main_image_website" data-ar="اختر صورة الواجهة من الموقع"
                data-en="Select Main Image from Website">
                اختر صورة الواجهة من الموقع
            </label>
            <select id="normal_main_image_website" name="normal_image_website" class="form-select form-control-lg">
                <option value="" data-ar="اختر صورة" data-en="Choose Image">اختر صورة</option>
                @foreach ($existing_images as $image)
                    <option value="{{ $image }}" data-ar="{{ $image }}" data-en="{{ $image }}">
                        {{ $image }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="normal_mobile_image_website" data-ar="اختر صورة الموبايل من الموقع"
                data-en="Select Mobile Image from Website">
                اختر صورة الموبايل من الموقع
            </label>
            <select id="normal_mobile_image_website" name="normal_mobile_image_website"
                class="form-select form-control-lg">
                <option value="" data-ar="اختر صورة" data-en="Choose Image">اختر صورة</option>
                @foreach ($existing_images as $image)
                    <option value="{{ $image }}" data-ar="{{ $image }}" data-en="{{ $image }}">
                        {{ $image }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="normal_content_image_website" data-ar="اختر صورة المحتوى من الموقع"
                data-en="Select Content Image from Website">
                اختر صورة المحتوى من الموقع
            </label>
            <select id="normal_content_image_website" name="normal_content_image_website"
                class="form-select form-control-lg">
                <option value="" data-ar="اختر صورة" data-en="Choose Image">اختر صورة</option>
                @foreach ($existing_images as $image)
                    <option value="{{ $image }}" data-ar="{{ $image }}"
                        data-en="{{ $image }}">
                        {{ $image }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
