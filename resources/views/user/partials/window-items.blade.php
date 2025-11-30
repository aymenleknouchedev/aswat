  @foreach ($windows as $item)
      @if ($item->contents->count() > 0)
          @foreach (($item->contents ?? [])->sortByDesc('created_at')->take(4) as $content)
              <div class="art-section-card">
                  <a href="{{ route('news.show', $content->title) }}">
                      <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? asset($content->image) }}"
                          alt="{{ $content->title }}">
                  </a>
                  <a href="{{ route('news.show', $content->title) }}"
                      style="text-decoration: none; color: inherit;">
                      <h2>{{ $content->title }}</h2>
                  </a>
              </div>
          @endforeach
      @endif
  @endforeach
