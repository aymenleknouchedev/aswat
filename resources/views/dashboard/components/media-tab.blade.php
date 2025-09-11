<!-- Media Tab -->
<div style="height: 800px;" class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
    {{-- Template Type radios --}}
    <div class="form-group mt-3 mb-4">
        @foreach ([
        'normal_image' => ['ar' => 'صورة عادية'],
        'video' => ['ar' => 'فيديو'],
        'podcast' => ['ar' => 'بودكاست'],
        'album' => ['ar' => 'ألبوم صور'],
        'no_image' => ['ar' => 'بدون صورة'],
    ] as $value => $texts)
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="template_{{ $value }}" name="template" class="custom-control-input"
                    value="{{ $value }}" {{ $value === 'normal_image' ? 'checked' : '' }}>
                <label class="custom-control-label" for="template_{{ $value }}">
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
