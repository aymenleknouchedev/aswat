@foreach ($windows as $item)
    @if ($item->contents->count() > 0)
        <article class="cw-list">
            <header class="cw-list-header">
                <a href="{{ route('window.show', $item) }}" class="cw-list-title-link">
                    <h2 class="cw-list-title">{{ $item->name }}</h2>
                </a>
                @if ($item->created_at)
                    <span class="cw-list-meta">{{ $item->created_at->translatedFormat('d F Y') }}</span>
                @endif
            </header>
            <ol class="cw-list-grid">
                @foreach (($item->contents ?? [])->sortByDesc('created_at')->take(10) as $i => $content)
                    <li class="cw-list-item">
                        <a href="{{ route('news.show', $content->shortlink) }}" class="cw-list-card">
                            <span class="cw-list-rank">{{ $i + 1 }}</span>
                            <div class="cw-list-thumb">
                                <img loading="lazy" decoding="async"
                                    src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? asset($content->image) }}"
                                    alt="{{ $content->title }}">
                            </div>
                            <h3 class="cw-list-card-title">{{ $content->title }}</h3>
                        </a>
                    </li>
                @endforeach
            </ol>
        </article>
    @endif
@endforeach
