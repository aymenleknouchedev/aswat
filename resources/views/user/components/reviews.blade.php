<style>
    .review-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .review-card {
        display: flex;
        flex-direction: row;
        align-items: flex-top;
        gap: 15px;
        direction: rtl;
        /* For Arabic alignment */
    }

    .review-card .review-card-image img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        /* Circle */
        display: block;
    }

    .review-card .review-card-text {
        flex: 1;
        /* margin-top: 8px; */

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
    }

    /* Cursor pointer for review authors */
    .review-card .review-card-text span {
        cursor: pointer;
    }

    /* Cursor pointer + underline on hover for review titles */
    .review-card .review-card-text p:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<section class="review-feature-grid">
    <div class="review-grid-container">
        @foreach($reviews as $review)
            <div class="review-card">
                <div class="review-card-image">
                    <img src="storage/{{ $review->writer->image ?? '' }}" alt="{{ $review->writer->name ?? 'كاتب الخبر' }}">
                </div>
                <div class="review-card-text">
                    <span>{{ $review->writer->name ?? '' }}</span>
                    <p>{{ $review->title ?? '' }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
