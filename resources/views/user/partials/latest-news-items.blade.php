@foreach ($latestContents as $item)
    <div class="newCategory-all-card">
        <div class="newCategory-all-card-date">
            <h4 style="width: 140px">
                @php
                    \Carbon\Carbon::setLocale('ar');
                    $created = \Carbon\Carbon::parse($item->published_date);
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
        <div class="newCategory-all-card-image">
            <a href="{{ route('news.show', $item->shortlink) }}">
                <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                    alt="{{ $item->title }}">
            </a>
        </div>
        <div class="newCategory-all-card-text">
            <h3><x-category-links :content="$item" /></h3>
            <a href="{{ route('news.show', $item->shortlink) }}" style="text-decoration: none; color: inherit;">
                <h2>{{ $item->title }}</h2>
            </a>
            <p>{{ $item->summary }}</p>
        </div>
    </div>
@endforeach
