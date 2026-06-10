@foreach ($breakingContents as $item)
    <div class="newCategory-all-card">
        <div class="newCategory-all-card-date">
            <h4 style="width: 140px">
                @php
                    \Carbon\Carbon::setLocale('ar');
                    $created = \Carbon\Carbon::parse($item->created_at);
                    $now = \Carbon\Carbon::now();
                    $diffHours = $created->diffInHours($now);
                @endphp

                @if ($diffHours < 24)
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <span>{{ $created->diffForHumans(null, null, false, 1) }}</span>
                    </div>
                @else
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <span>{{ $created->translatedFormat('d F Y') }}</span>
                        <span style="color: #74747C;">{{ $created->translatedFormat('H:i') }}</span>
                    </div>
                @endif
            </h4>
        </div>
        <div class="newCategory-all-card-text">
            <p style="font-family: asswat-bold; font-weight: 800; font-size: 18px; line-height: 1.5; color: #333333; margin: 0;">{{ $item->text }}</p>
        </div>
        @php
            $itemUrl = route('breakingNews');
            $shareText = $item->text;
        @endphp
        <div class="bn-share-container">
            <div class="bn-share-icons">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($itemUrl) }}"
                    target="_blank" title="مشاركة على فيسبوك" rel="noopener" class="bn-share-icon">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="https://x.com/intent/tweet?url={{ urlencode($itemUrl) }}&text={{ urlencode($shareText) }}"
                    target="_blank" title="مشاركة على X" rel="noopener" class="bn-share-icon">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $itemUrl) }}"
                    target="_blank" title="مشاركة على واتساب" rel="noopener" class="bn-share-icon">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="#" title="نسخ الرابط" rel="noopener" class="bn-share-icon bn-copy-link"
                    data-url="{{ $itemUrl }}">
                    <i class="fa-solid fa-link"></i>
                </a>
            </div>
            <button class="bn-share-btn" type="button" title="مشاركة" aria-label="زر المشاركة">
                <img loading="lazy" decoding="async" src="{{ asset('user/assets/icons/send.png') }}" alt="Share" style="width:18px;">
            </button>
        </div>
    </div>
@endforeach
