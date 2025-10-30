@if (request()->hasAny(['search', 'type', 'sort']))
    <div class="d-flex flex-wrap gap-2 align-items-center">
        <span class="text-soft small">الفلاتر النشطة:</span>

        @if (request('search'))
            <span class="badge badge-dim bg-outline-primary">
                بحث: "{{ request('search') }}"
                <a href="javascript:void(0)" onclick="removeFilter('search')" class="ms-1 text-danger">
                    <em class="icon ni ni-cross"></em>
                </a>
            </span>
        @endif

        @if (request('type'))
            <span class="badge badge-dim bg-outline-primary">
                نوع: {{ $getMediaTypeLabel(request('type')) }}
                <a href="javascript:void(0)" onclick="removeFilter('type')" class="ms-1 text-danger">
                    <em class="icon ni ni-cross"></em>
                </a>
            </span>
        @endif

        @if (request('sort') && request('sort') != 'newest')
            <span class="badge badge-dim bg-outline-primary">
                ترتيب: {{ $getSortLabel(request('sort')) }}
                <a href="javascript:void(0)" onclick="removeFilter('sort')" class="ms-1 text-danger">
                    <em class="icon ni ni-cross"></em>
                </a>
            </span>
        @endif

        <a href="javascript:void(0)" onclick="clearFilters()" class="badge badge-dim bg-outline-danger">
            مسح الكل
        </a>
    </div>
@endif
