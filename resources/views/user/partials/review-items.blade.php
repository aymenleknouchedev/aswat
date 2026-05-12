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
                    <div class="review-writer" style="margin-top: 10px;">
                        <a href="{{ route('writer.show', $writer->id) }}" class="review-writer-link">
                            <span class="review-writer-avatar">
                                @if($writer->image)
                                    <img src="{{ $writer->image }}" alt="{{ $writer->name }}" loading="lazy">
                                @else
                                    <i class="fas fa-user"></i>
                                @endif
                            </span>
                            <span class="review-writer-name">{{ $writer->name }}</span>
                        </a>
                        @if($writer->location)
                            <span class="review-writer-dot">•</span>
                            <span class="review-writer-location">{{ $writer->location }}</span>
                        @endif
                    </div>
                @endif
            </div>
    </div>

    @if ($index < count($otherReviews) - 1)
        <hr style="margin: 20px 0; border-color: #f4f4f4; border-width: 1px;">
    @endif
@endforeach
