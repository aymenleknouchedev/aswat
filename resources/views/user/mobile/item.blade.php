<style>
    /* Unified mobile list styling — no separator lines, consistent spacing */
    .mobile-simple-ul {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 16px 12px !important;
    }
    .mobile-simple-item,
    .mobile-simple-item + .mobile-simple-item {
        border: 0 !important;
        border-top: 0 !important;
        border-bottom: 0 !important;
        background: transparent !important;
    }
    .mobile-more-link {
        display: flex !important;
        flex-direction: column !important;
        padding: 10px 0 !important;
        text-decoration: none !important;
        color: inherit !important;
    }
    .mobile-more-link .ms-thumb {
        width: 100% !important;
    }
    .mobile-more-link .ms-thumb img {
        width: 100% !important;
        aspect-ratio: 16/9 !important;
        object-fit: cover !important;
        display: block !important;
        border-radius: 4px;
    }
    .mobile-more-link .ms-text {
        display: flex !important;
        flex-direction: column !important;
        padding-top: 8px !important;
        gap: 8px !important;
    }
    .mobile-more-link .ms-text > * { margin: 0 !important; }
    .ms-title {
        margin: 0 !important;
        font-size: 20px !important;
        font-weight: 800 !important;
        line-height: 1.35 !important;
        color: #000 !important;
        font-family: 'asswat-bold' !important;
    }
</style>
<li class="mobile-simple-item">
    <a class="mobile-more-link" href="{{ route('news.show', $item->shortlink) }}" aria-label="{{ $item->title }}">
        <div class="ms-thumb">
            <x-responsive-img
                :src="$item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg'"
                :alt="$item->title"
                sizes="40vw"
                :widths="[200, 400, 600]"
                :default="400"
            />
        </div>

        <div class="ms-text">
            <div
                style="display: flex; flex-wrap: nowrap; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 14px; color: #999; font-family: 'asswat-regular';">
                @if ($item->category && $item->country)
                    <span style="cursor: pointer;" onclick="window.location.href='{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}'; event.stopPropagation();">
                        {{ $item->category->name ?? '' }}
                    </span>
                    <span style="margin-right: 4px; margin-left: 4px;">-</span>
                    <span style="cursor: pointer;" onclick="window.location.href='{{ route('category.show', ['id' => $item->country->id, 'type' => 'Country']) }}'; event.stopPropagation();">
                        {{ $item->country->name ?? '' }}
                    </span>
                @elseif ($item->category && $item->continent)
                    <span style="cursor: pointer;" onclick="window.location.href='{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}'; event.stopPropagation();">
                        {{ $item->category->name ?? '' }}
                    </span>
                    <span style="margin-right: 4px; margin-left: 4px;">-</span>
                    <span style="cursor: pointer;" onclick="window.location.href='{{ route('category.show', ['id' => $item->continent->id, 'type' => 'Continent']) }}'; event.stopPropagation();">
                        {{ $item->continent->name ?? '' }}
                    </span>
                @elseif ($item->category)
                    <span style="cursor: pointer;" onclick="window.location.href='{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}'; event.stopPropagation();">
                        {{ $item->category->name ?? '' }}
                    </span>
                @endif
            </div>

            <p class="ms-title">
                {{ \Illuminate\Support\Str::limit($item->mobile_title ?? $item->title, 90) }}
            </p>

            <p class="ms-summary" style="font-size: 16px; color: #666; line-height: 1.4;">
                {{ \Illuminate\Support\Str::limit($item->summary ?? ($item->description ?? ''), 250) }}
            </p>

            <div class="ms-date" style="display: flex; justify-content: flex-start; font-size: 14px; color: #999;">
                <p style="margin: 0;">
                    {{ $item->created_at->locale('ar')->translatedFormat('d') }}
                    {{ ['جانفي', 'فيفري', 'مارس', 'أفريل', 'ماي', 'جوان', 'جويلية', 'أوت', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'][$item->created_at->month - 1] }}
                    {{ $item->created_at->locale('ar')->translatedFormat('Y') }}
                </p>
            </div>
        </div>
    </a>
</li>
