{{-- album fields --}}
<div id="media-album-field" style="display:none;">

    <!-- Source Selection -->
    <label data-ar="اختر مصدر الصور" data-en="Choose Image Source">اختر مصدر الصور</label>
    <div>
        @foreach ([
            'local' => ['ar' => 'رفع من الجهاز', 'en' => 'Upload from device'],
            'url' => ['ar' => 'رابط مباشر', 'en' => 'Direct URL'],
            'website' => ['ar' => 'من الموقع', 'en' => 'From Website'],
        ] as $sourceValue => $texts)
            <div class="custom-control custom-radio custom-control-inline custom-control">
                <input type="radio" id="album_source_{{ $sourceValue }}" name="album_source"
                       value="{{ $sourceValue }}"
                       class="custom-control-input"
                       {{ $sourceValue === 'local' ? 'checked' : '' }}>
                <label class="custom-control-label" for="album_source_{{ $sourceValue }}"
                       data-ar="{{ $texts['ar'] }}"
                       data-en="{{ $texts['en'] }}">
                    {{ $texts['ar'] }}
                </label>
            </div>
        @endforeach
    </div>

    <!-- MAIN IMAGE -->
    <div class="image-block mt-3">
        <label data-ar="الصورة الرئيسية" data-en="Main Image">الصورة الرئيسية</label>

        <!-- Local -->
        <div class="source-local-fields mt-2">
            <input id="main_image_local" name="main_image_local" type="file"
                   class="form-control form-control-lg" accept="image/*">
        </div>

        <!-- URL -->
        <div class="source-url-fields mt-2" style="display:none;">
            <input id="main_image_url" name="main_image_url" type="text"
                   placeholder="https://example.com/image.jpg"
                   class="form-control form-control-lg">
        </div>

        <!-- Website -->
        <div class="source-website-fields mt-2" style="display:none;">
            <select id="main_image_website" name="main_image_website"
                    class="form-select form-control-lg">
                @foreach ($existing_albums as $album_image)
                    <option value="{{ $album_image }}">{{ $album_image }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- MOBILE IMAGE -->
    <div class="image-block mt-3">
        <label data-ar="صورة الهاتف" data-en="Mobile Image">صورة الهاتف</label>

        <!-- Local -->
        <div class="source-local-fields mt-2">
            <input id="mobile_image_local" name="mobile_image_local" type="file"
                   class="form-control form-control-lg" accept="image/*">
        </div>

        <!-- URL -->
        <div class="source-url-fields mt-2" style="display:none;">
            <input id="mobile_image_url" name="mobile_image_url" type="text"
                   placeholder="https://example.com/image.jpg"
                   class="form-control form-control-lg">
        </div>

        <!-- Website -->
        <div class="source-website-fields mt-2" style="display:none;">
            <select id="mobile_image_website" name="mobile_image_website"
                    class="form-select form-control-lg">
                @foreach ($existing_albums as $album_image)
                    <option value="{{ $album_image }}">{{ $album_image }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- CONTENT IMAGE -->
    <div class="image-block mt-3">
        <label data-ar="صورة المحتوى" data-en="Content Image">صورة المحتوى</label>

        <!-- Local -->
        <div class="source-local-fields mt-2">
            <input id="content_image_local" name="content_image_local" type="file"
                   class="form-control form-control-lg" accept="image/*">
        </div>

        <!-- URL -->
        <div class="source-url-fields mt-2" style="display:none;">
            <input id="content_image_url" name="content_image_url" type="text"
                   placeholder="https://example.com/image.jpg"
                   class="form-control form-control-lg">
        </div>

        <!-- Website -->
        <div class="source-website-fields mt-2" style="display:none;">
            <select id="content_image_website" name="content_image_website"
                    class="form-select form-control-lg">
                @foreach ($existing_albums as $album_image)
                    <option value="{{ $album_image }}">{{ $album_image }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- ALBUM IMAGES -->
    <div class="image-block mt-3">
        <label data-ar="صور الألبوم" data-en="Album Images">صور الألبوم</label>

        <!-- Local -->
        <div class="source-local-fields mt-2">
            <input id="album_images_local" name="album_images_local[]" type="file"
                   class="form-control form-control-lg" accept="image/*" multiple>
        </div>

        <!-- URL -->
        <div class="source-url-fields mt-2" style="display:none;">
            <textarea id="album_images_url" name="album_images_url"
                      class="form-control form-control-lg"
                      placeholder="https://image1.jpg, https://image2.jpg"></textarea>
        </div>

        <!-- Website -->
        <div class="source-website-fields mt-2" style="display:none;">
            <select id="album_images_website" name="album_images_website[]" class="form-select form-control-lg" multiple>
                @foreach ($existing_albums as $album_image)
                    <option value="{{ $album_image }}">{{ $album_image }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
