@foreach ($otherReviews as $index => $review)
    <div class="custom-card">
        <div class="custom-image">
            <a href="{{ route('news.show', $review->shortlink) }}">
                <img loading="lazy" decoding="async" src="{{ $review->media()->wherePivot('type', 'main')->first()->path ?? asset('user/assets/images/b2.jpeg') }}"
                    alt="خبر">
            </a>
        </div>
        <div class="custom-texts">
                <a href="{{ route('news.show', $review->shortlink) }}" style="text-decoration: none; color: inherit;">
                    <h2>{{ $review->title }}</h2>
                </a>

                <span>{{ $review->summary }}</span>

                @php
                    $writer = $review->writers()->first();
                @endphp
                @if($writer)
                    <div style="margin-top: 10px; font-size: 16px; font-family: asswat-medium; color: #555;">
                        <a href="{{ route('writer.show', $writer->id) }}" style="color: inherit; text-decoration: none;">
                            {{ $writer->name }}
                        </a>
                    </div>
                @endif
            </div>
    </div>

    @if ($index < count($otherReviews) - 1)
        <hr style="margin: 20px 0; border-color: #f4f4f4; border-width: 1px;">
    @endif
@endforeach
