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
                    value="{{ $value }}" {{ old('template', $content->template ?? 'normal_image') === $value ? 'checked' : '' }}>
                <label data-en="{{ $texts['en'] }}" data-ar="{{ $texts['ar'] }}" class="custom-control-label"
                    for="template_{{ $value }}">
                    {{ $texts['ar'] }}
                </label>
            </div>
        @endforeach
    </div>

    {{-- Include each template partial --}}
    @include('dashboard.components.partials.edit-media-normal-image')
    @include('dashboard.components.partials.edit-media-video')
    @include('dashboard.components.partials.edit-media-podcast')
    @include('dashboard.components.partials.edit-media-album')
    @include('dashboard.components.partials.edit-media-no-image')


</div>

{{-- استدعاء سكريبت الميديا --}}
<script src="{{ asset('js/media-handler.js') }}"></script>
