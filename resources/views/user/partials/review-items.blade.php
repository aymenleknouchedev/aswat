@foreach ($otherReviews as $index => $review)
    <div class="custom-card">
        <div class="custom-image">
            <a href="{{ route('news.show', $review->shortlink) }}">
                <img src="{{ $review->media()->wherePivot('type', 'main')->first()->path ?? asset('user/assets/images/b2.jpeg') }}"
                    alt="خبر">
            </a>
        </div>
        <div class="custom-texts">
                <a href="{{ route('news.show', $review->shortlink) }}" style="text-decoration: none; color: inherit;">
                    <h2>{{ $review->title }}</h2>
                </a>

                <span>{{ $review->summary }}</span>

                <div style="display: flex; margin-right: 4px; flex-wrap: nowrap; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 14px; color: #999; font-family: 'asswat-regular';">
                    @php
                        $writer = $review->writers()->first();
                    @endphp
                    @if($writer)
                        <a href="{{ route('writer.show', $writer->id) }}">
                            {{ $writer->name ?? '' }}
                        </a>
                        @if($writer->location)
                            <span style="margin-right: 4px;">-</span>
                            <span>{{ $writer->location }}</span>
                        @endif
                    @else
                        <p>بدون كاتب</p>
                    @endif
                </div>
            </div>
    </div>

    @if ($index < count($otherReviews) - 1)
        <hr style="margin: 20px 0; border-color: #f4f4f4; border-width: 1px;">
    @endif
@endforeach
