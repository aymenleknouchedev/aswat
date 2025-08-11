<!-- Media Tab -->
<div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
    {{-- Template Type radios --}}
    <div class="form-group mt-3 mb-4">
        @foreach ([
        'normal_image' => ['ar' => 'مادة مع صورة عادية', 'en' => 'Content with Normal Image'],
        'video' => ['ar' => 'مادة مع فيديو', 'en' => 'Content with Video'],
        'podcast' => ['ar' => 'مادة مع بودكاست', 'en' => 'Content with Podcast'],
        'album' => ['ar' => 'مادة مع ألبوم صور', 'en' => 'Content with Photo Album'],
        'no_image' => ['ar' => 'مادة بدون صورة', 'en' => 'Content without Image'],
    ] as $value => $texts)
            <div class="custom-control custom-radio custom-control-inline custom-control">
                <input type="radio" id="template_{{ $value }}" name="template"
                    class="custom-control-input" value="{{ $value }}"
                    {{ $value === 'normal_image' ? 'checked' : '' }}>
                <label class="custom-control-label" for="template_{{ $value }}"
                    data-ar="{{ $texts['ar'] }}" data-en="{{ $texts['en'] }}">
                    {{ $texts['ar'] }}
                </label>
            </div>
        @endforeach
    </div>

    @include('./dashboard/components/partials.media-normal-image')
    @include('./dashboard/components/partials.media-video')
    @include('./dashboard/components/partials.media-podcast')
    @include('./dashboard/components/partials.media-album')
    @include('./dashboard/components/partials.media-no-image')



</div>
