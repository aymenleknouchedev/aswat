<div class="photos-feature">
    <a href="{{ route('news.show', $photos[0]->shortlink) }}">
        <div class="image-wrapper">
            <img id="photoImage" src="{{ $photos[0]->media()->wherePivot('type', 'main')->first()->path }}"
                alt="Feature Algeria" loading="lazy">
            <div class="corner-icon">
                @include('user.icons.image')
            </div>
        </div>
    </a>

    <div class="content">
        <h3 id="photoCategory">
            <x-category-links :content="$photos[0]" />
        </h3>
        <a href="{{ route('news.show', $photos[0]->shortlink) }}" style="text-decoration: none; color: inherit;">
            <h2 id="photoTitle">{{ $photos[0]->title }}</h2>
        </a>
        <p id="photoDescription">{{ $photos[0]->summary }}</p>
    </div>
</div>

<style>
    .photos-feature img,
    .photos-feature .content {
        transition: opacity 0.5s ease;
    }

    .fade-out {
        opacity: 0;
    }

    .photos-feature {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 60px;
    }

    .photos-feature .image-wrapper {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
    }

    .photos-feature img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        aspect-ratio: 16 / 9;
    }

    .photos-feature .corner-icon {
        position: absolute;
        bottom: 15px;
        left: 20px;
        width: 45px;
        height: 45px;
        color: white;
    }

    .photos-feature .corner-icon img {
        width: 100%;
        height: 100%;
    }

    .photos-feature .content {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding: 20px;
    }

    .photos-feature .content h3 {
        margin: 0;
        color: #999;
        font-size: 12px;
        font-family: asswat-light;
        font-weight: lighter;
        cursor: pointer;
    }

    .photos-feature .content h2 {
        margin: 10px 0 10px;
        font-size: 24px;
        line-height: 1.3;
        font-family: asswat-bold;
        cursor: pointer;
        transition: .2s;
    }

    .photos-feature .content p {
        margin: 0;
        font-size: 17px;
        line-height: 1.6;
        color: #555;
    }

    .photos-feature .content h2:hover {
        text-decoration: underline;
    }

    .fade-out {
        opacity: 0;
    }

    .fade-in {
        opacity: 1;
    }

    #backArrow.disabled,
    #nextArrow.disabled {
        opacity: 0.4;
        cursor: default;
        pointer-events: none;
    }
</style>
