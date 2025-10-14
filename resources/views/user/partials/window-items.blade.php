  @foreach ($windows as $item)
      @if ($item->contents->count() > 0)
          <section class="art-section-hero"
              style="background: linear-gradient(rgba(0, 0, 0, 0.0), rgba(0, 0, 0, 0.851)), url('{{ asset($item->image) }}') center/cover no-repeat;">
              <div class="art-section-overlay">
                  <h2 class="art-section-title">{{ $item->name }}</h2>
                  <div class="art-section-grid">
                      @foreach (($item->contents ?? [])->sortByDesc('created_at')->take(4) as $content)
                          <div class="art-section-card">
                              <img src="{{ $content->media()->wherePivot('type', 'main')->first()->path ?? asset($content->image) }}"
                                  alt="{{ $content->title }}">
                              <a href="{{ route('news.show', $content->title) }}"
                                  style="text-decoration: none; color: inherit;">
                                  <h2>{{ $content->title }}</h2>
                              </a>
                          </div>
                      @endforeach
                  </div>
              </div>
          </section>
      @endif
  @endforeach
