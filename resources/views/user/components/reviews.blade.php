<style>
    .review-slider-wrapper {
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .review-grid-container {
        display: flex;
        gap: 20px;
        transition: transform 0.6s ease;
        width: 100%;
    }

    .review-card {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 15px;
        direction: rtl;
        flex: 0 0 calc(33.333% - 14px);
        /* Each card is exactly 1/3 width */
    }

    .review-card .review-card-image {
        flex-shrink: 0;
    }

    .review-card .review-card-image img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        display: block;
    }

    .review-card .review-card-text {
        flex: 1;
        width: 100%;
    }

    .review-card .review-card-text p {
        font-size: 16px;
        margin: 4px 0 4px;
        font-family: asswat-bold;
        color: #333;
        line-height: 1.4;
    }

    .review-card .review-card-text span {
        font-size: 12px;
        color: #74747C;
        margin-bottom: 4px;
        font-family: asswat-regular;
        font-weight: 600;
        display: block;
    }

    .review-card .review-card-text span {
        cursor: pointer;
    }

    .review-card .review-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    #reviewBackArrow,
    #reviewNextArrow {
        height: 32px;
        width: 32px;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }

    #reviewBackArrow.disabled,
    #reviewNextArrow.disabled {
        opacity: 0.4;
        cursor: default;
        pointer-events: none;
    }

    #reviewNextArrow {
        margin-left: 5px;
    }
</style>

<section class="review-feature-grid">
    <div class="review-slider-wrapper">
        <div class="review-grid-container" id="reviewsContainer">
            @foreach ($reviews as $review)
                @php
                    $firstWriter = $review->writers->first();
                @endphp
                <div class="review-card">
                    <div class="review-card-image">
                        @if ($firstWriter && $firstWriter->image)
                            <a href="{{ route('writer.show', $firstWriter->id) }}">
                                <img src="{{ $firstWriter->image }}" alt="{{ $firstWriter->name }}">
                            </a>
                        @else
                            <a href="{{ route('news.show', $review->title) }}">
                                <img src="{{ $review->media()->wherePivot('type', 'main')->first()->path ?? asset('user/assets/images/b2.jpeg') }}"
                                    alt="خبر">
                            </a>
                        @endif
                    </div>
                    <div class="review-card-text">
                        @if ($firstWriter && $firstWriter->name)
                            <a href="{{ route('writer.show', $firstWriter->id) }}" style="text-decoration: none; color: inherit;">
                                <span>{{ $firstWriter->name }}</span>
                            </a>
                        @else
                            <span></span>
                        @endif
                        <a href="{{ route('news.show', $review->title) }}" style="text-decoration: none; color: inherit;">
                            <p>{{ $review->title ?? '' }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentIndex = 0;
        let isAnimating = false;

        const reviewsContainer = document.getElementById('reviewsContainer');
        const reviewBackArrow = document.getElementById('reviewBackArrow');
        const reviewNextArrow = document.getElementById('reviewNextArrow');
        
        // Count actual review cards
        const reviewCards = reviewsContainer.querySelectorAll('.review-card');
        const totalReviews = reviewCards.length;
        const itemsPerView = 3;
        
        // Calculate scroll distance based on total reviews
        const scrollDistance = Math.max(0, totalReviews - itemsPerView);
        
        // Debug log
        console.log('Total Reviews:', totalReviews, 'Items Per View:', itemsPerView, 'Scroll Distance:', scrollDistance);

        if (!reviewsContainer || !reviewBackArrow || !reviewNextArrow) {
            console.error('Review slider elements not found');
            return;
        }

        function updateSliderPosition() {
            // Move by 1 review at a time
            const translateValue = -(currentIndex * (100 / totalReviews));
            reviewsContainer.style.transform = `translateX(${translateValue}%)`;
            updateReviewButtons();
        }

        function updateReviewButtons() {
            // Only enable scrolling if there are more than 3 reviews
            if (scrollDistance <= 0) {
                reviewBackArrow.classList.add('disabled');
                reviewNextArrow.classList.add('disabled');
                return;
            }

            reviewBackArrow.classList.toggle('disabled', currentIndex <= 0);
            reviewNextArrow.classList.toggle('disabled', currentIndex >= scrollDistance);
        }

        reviewBackArrow.addEventListener('click', function() {
            if (currentIndex > 0 && !isAnimating && scrollDistance > 0) {
                isAnimating = true;
                currentIndex--;
                updateSliderPosition();
                setTimeout(() => { isAnimating = false; }, 600);
            }
        });

        reviewNextArrow.addEventListener('click', function() {
            if (currentIndex < scrollDistance && !isAnimating && scrollDistance > 0) {
                isAnimating = true;
                currentIndex++;
                updateSliderPosition();
                setTimeout(() => { isAnimating = false; }, 600);
            }
        });

        // Initialize
        updateReviewButtons();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentReviewIndex = 0;
        let isAnimating = false;

        const reviewsContainer = document.getElementById('reviewsContainer');
        const reviewBackArrow = document.getElementById('reviewBackArrow');
        const reviewNextArrow = document.getElementById('reviewNextArrow');
        const totalReviews = 6;
        const visibleReviews = 3;

        // Make sure elements exist
        if (!reviewsContainer || !reviewBackArrow || !reviewNextArrow) {
            console.error('Review slider elements not found');
            return;
        }

        function updateSliderPosition() {
            // Calculate the translation: each review takes 1/3 of the container width
            const translateValue = -(currentReviewIndex * (100 / visibleReviews));
            reviewsContainer.style.transform = `translateX(${-translateValue}%)`;
            updateReviewButtons();
        }

        function updateReviewButtons() {
            const maxIndex = totalReviews - visibleReviews;

            if (currentReviewIndex <= 0) {
                reviewBackArrow.classList.add('disabled');
            } else {
                reviewBackArrow.classList.remove('disabled');
            }

            if (currentReviewIndex >= maxIndex) {
                reviewNextArrow.classList.add('disabled');
            } else {
                reviewNextArrow.classList.remove('disabled');
            }
        }

        // Button click handlers
        reviewBackArrow.addEventListener('click', function() {
            if (currentReviewIndex > 0 && !isAnimating) {
                isAnimating = true;
                currentReviewIndex--;
                updateSliderPosition();
                setTimeout(() => {
                    isAnimating = false;
                }, 600);
            }
        });

        reviewNextArrow.addEventListener('click', function() {
            const maxIndex = totalReviews - visibleReviews;
            if (currentReviewIndex < maxIndex && !isAnimating) {
                isAnimating = true;
                currentReviewIndex++;
                updateSliderPosition();
                setTimeout(() => {
                    isAnimating = false;
                }, 600);
            }
        });

        // Initialize
        updateReviewButtons();
    });
</script>
