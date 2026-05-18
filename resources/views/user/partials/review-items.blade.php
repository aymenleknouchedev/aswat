@foreach ($otherReviews as $index => $review)
    @php
        $reviewWriter = $review->writers()->first();
        $writerImage = $reviewWriter && $reviewWriter->image
            ? $reviewWriter->image
            : asset('user/assets/images/b2.jpeg');
    @endphp
    <div class="custom-card">
        <div class="custom-image">
            <a href="{{ $reviewWriter ? route('writer.show', $reviewWriter->id) : route('news.show', $review->shortlink) }}">
                <img loading="lazy" decoding="async" src="{{ $writerImage }}"
                    alt="{{ $reviewWriter->name ?? 'كاتب' }}">
            </a>
        </div>
        <div class="custom-texts">
                <a href="{{ route('news.show', $review->shortlink) }}" style="text-decoration: none; color: inherit;">
                    <h2>{{ $review->title }}</h2>
                </a>

                <span>{{ $review->summary }}</span>

                @if($reviewWriter)
                    <div style="margin-top: 10px; font-size: 16px; font-family: asswat-medium; color: #555;">
                        <a href="{{ route('writer.show', $reviewWriter->id) }}" style="color: inherit; text-decoration: none;">
                            {{ $reviewWriter->name }}
                        </a>
                    </div>
                @endif
            </div>
    </div>

    @if ($index < count($otherReviews) - 1)
        <hr style="margin: 20px 0; border-color: #f4f4f4; border-width: 1px;">
    @endif
@endforeach
