@foreach ($otherReviews as $index => $review)
    <a href="{{ route('news.show', $review->id) }}" style="text-decoration: none; color: inherit;">
        <div class="custom-card">
            <div class="custom-image">
                <img src="{{ $review->media()->wherePivot('type', 'main')->first()->path ?? asset('user/assets/images/b2.jpeg') }}"
                    alt="خبر">
            </div>
            <div class="custom-texts">
                <a href="{{ route('news.show', $review->title) }}" style="text-decoration: none; color: inherit;">
                    <h2>{{ $review->title }}</h2>
                </a>

                <span>{{ $review->summary }}</span>

                @if ($review->writer && $review->writer->name)
                    <a href="{{ route('writer.show', $review->writer->id) }}">
                        <p>{{ $review->writer->name }}</p>
                    </a>
                @else
                    <p>بدون كاتب</p>
                @endif
            </div>
        </div>
    </a>

    @if ($index < count($otherReviews) - 1)
        <hr style="margin: 20px 0; border-color: #f4f4f4; border-width: 1px;">
    @endif
@endforeach
