@foreach ($otherReviews as $index => $review)
    <a href="{{ route('news.show', $review->id) }}" style="text-decoration: none; color: inherit;">
        <div class="custom-card">
            <div class="custom-image">
                <img src="{{ $review->media()->wherePivot('type', 'main')->first()->path ?? asset('user/assets/images/b2.jpeg') }}"
                    alt="خبر">
            </div>
            <div class="custom-texts">
                <span style="font-size: 1.1em;">
                    @if (isset($review->author))
                        بقلم: {{ $review->author->name }}
                    @else
                        بقلم: غير معروف
                    @endif
                </span>
                <a href="{{ route('news.show', $review->title) }}" style="text-decoration: none; color: inherit;">
                    <h3>{{ $review->title }}</h3>
                </a>
                <p>{{ $review->summary }}</p>
            </div>
        </div>
    </a>
    @if ($index < count($otherReviews) - 1)
        <hr style="margin: 20px 0; border-color: #f4f4f4; border-width: 1px;">
    @endif
@endforeach
