<style>
    .mobile-more-link {
        display: flex;
        flex-direction: column;
        padding: 24px 0 8px 0;
        text-decoration: none;
        color: inherit;
    }

    .mobile-more-link .ms-thumb {
        width: 100%;
    }

    .mobile-more-link .ms-thumb img {
        width: 100%;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .mobile-more-link .ms-text {
        display: flex;
        flex-direction: column;
        padding-top: 8px;
    }

    .ms-title {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        line-height: 1.35;
        color: #000;
        font-family: 'asswat-bold';
    }
</style>
<li class="mobile-simple-item">
    <a class="mobile-more-link" href="{{ route('news.show', $item->shortlink) }}" aria-label="{{ $item->title }}">
        <div class="ms-thumb">
            <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                alt="{{ $item->title }}">
        </div>

        <div
            style="display: flex; margin-right: 4px; flex-wrap: nowrap; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 14px; color: #999; font-family: 'asswat-regular';">
            @if (isset($item->country))
                <a href="{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}">
                    {{ $item->category->name ?? '' }}
                </a>
                <span style="margin-right: 4px;">- </span>
                <a href="{{ route('category.show', ['id' => $item->country->id, 'type' => 'Country']) }}">
                    {{ $item->country->name ?? '' }}
                </a>
            @elseif (isset($item->continent))
                <a href="{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}">
                    {{ $item->category->name ?? '' }}
                </a>
                <span style="margin-right: 4px;">- </span>
                <a href="{{ route('category.show', ['id' => $item->continent->id, 'type' => 'Continent']) }}">
                    {{ $item->continent->name ?? '' }}
                </a>
            @else
                <a href="{{ route('category.show', ['id' => $item->category->id, 'type' => 'Category']) }}">
                    {{ $item->category->name ?? '' }}
                </a>
            @endif
        </div>

        <div class="ms-text">
            <p class="ms-title">
                {{ \Illuminate\Support\Str::limit($item->mobile_title ?? $item->title, 90) }}
            </p>

            <p style="font-size: 16px; color: #666; margin: 4px 0 8px 0; line-height: 1.4;">
                {{ \Illuminate\Support\Str::limit($item->summary ?? ($item->description ?? ''), 250) }}
            </p>

            <div style="display: flex; justify-content: flex-start; font-size: 14px; color: #999; margin: 0;">
                <p style="margin: 0;">
                    {{ $item->created_at->locale('ar')->translatedFormat('d') }}
                    {{ ['جانفي', 'فيفري', 'مارس', 'أفريل', 'ماي', 'جوان', 'جويلية', 'أوت', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'][$item->created_at->month - 1] }}
                    {{ $item->created_at->locale('ar')->translatedFormat('Y') }}
                </p>
            </div>
        </div>
    </a>
</li>
