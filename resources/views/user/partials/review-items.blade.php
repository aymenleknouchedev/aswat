@foreach ($otherReviews as $review)
    <a href="{{ route('news.show', $review->id) }}" style="text-decoration: none; color: inherit;">
        <div class="custom-card">
            <div class="custom-image">
                <img src="{{ $review->media()->wherePivot('type', 'main')->first()->path ?? asset('user/assets/images/b2.jpeg') }}"
                    alt="خبر">
            </div>
            <div class="custom-texts">
                <span>
                    @if (isset($review->author))
                        بقلم: {{ $review->author->name }}
                    @else
                        بقلم: غير معروف
                    @endif
                </span>
                <h3>{{ $review->title }}</h3>
            </div>
        </div>
    </a>
@endforeach
