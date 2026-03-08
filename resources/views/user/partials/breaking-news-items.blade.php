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
            <p style="font-size: 16px; line-height: 1.5; color: #555; margin: 0;">{{ $item->text }}</p>
        </div>
    </div>
@endforeach
