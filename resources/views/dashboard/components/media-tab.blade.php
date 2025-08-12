<!-- Media Tab -->
<div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
    {{-- Template Type radios --}}
    <div class="form-group mt-3 mb-4">
        @foreach ([
        'normal_image' => ['ar' => 'مادة مع صورة عادية'],
        'video' => ['ar' => 'مادة مع فيديو'],
        'podcast' => ['ar' => 'مادة مع بودكاست'],
        'album' => ['ar' => 'مادة مع ألبوم صور'],
        'no_image' => ['ar' => 'مادة بدون صورة'],
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

    {{-- Media Modal (مشترك لكل الأنواع) --}}
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">مكتبة الوسائط</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="mediaSourceSelect">اختر مصدر الوسائط</label>
                        <select id="mediaSourceSelect" class="form-select">
                            <option value="library">من المكتبة</option>
                            <option value="upload">رفع من الجهاز</option>
                            <option value="link">رابط مباشر</option>
                        </select>
                    </div>

                    <div id="mediaLibrarySection" style="display: block;">
                        <div id="mediaLibraryGrid" class="d-flex flex-wrap"></div>
                    </div>

                    <div id="mediaUploadSection" style="display: none;">
                        <input type="file" id="mediaUploadFile" class="form-control mb-2"
                            accept="image/*,video/*,audio/*">
                        <input type="text" id="mediaUploadAlt" class="form-control" placeholder="نص بديل (Alt Text)">
                        <button id="mediaUploadBtn" class="btn btn-success mt-2">رفع وإختيار</button>
                    </div>

                    <div id="mediaLinkSection" style="display: none;">
                        <input type="url" id="mediaLinkInput" class="form-control mb-2"
                            placeholder="https://example.com/media.jpg">
                        <input type="text" id="mediaLinkAlt" class="form-control" placeholder="نص بديل (Alt Text)">
                        <button id="mediaAddLinkBtn" class="btn btn-primary mt-2">إضافة وإختيار</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- استدعاء سكريبت الميديا --}}
<script src="{{ asset('js/media-handler.js') }}"></script>
