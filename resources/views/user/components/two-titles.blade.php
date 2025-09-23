<style>
    .two-titles-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 20px;
    }

    .second-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .two-titles-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .two-titles-list-ite {
        margin-top: 12px;
        display: flex;
        align-items: center;
        direction: rtl;
        font-family: asswat-bold;
        border-bottom: 1px solid #ddd;
        /* الخط الرمادي */
        padding-bottom: 10px;
        /* مسافة بين النص والخط */
    }

    .two-titles-list-ite:last-child {
        border-bottom: none;
    }

    .two-titles-list-ite .number {
        font-size: 32px;
        color: #e7e7e7;
        margin-left: 10px;
        font-weight: bold;
    }

    .two-titles-list-ite p {
        font-size: 16px;
        color: #333;
        line-height: 1.4;
    }

    .two-titles-right-card {
        display: flex;
        flex-direction: column;
    }

    .two-titles-right-card img {
        width: 100%;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .two-titles-right-card h3 {
        font-size: 12px;
        margin: 8px 0 4px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .two-titles-right-card h2 {
        font-size: 18px;
        margin: 0;
        font-family: asswat-bold;
        color: #333;
        line-height: 1.4;
    }

    .two-titles-right-card p {
        font-size: 14px;
        margin: 8px 0 0;
        color: #555;
        line-height: 1.5;
    }

    .two-titles-files-card-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .two-titles-files-card {
        display: flex;
        align-items: center;
        gap: 15px;
        direction: rtl;
    }

    .two-titles-files-card-image {
        flex-shrink: 0;
        width: 120px;
    }

    .two-titles-files-card-image img {
        width: 100%;
        height: auto;
        aspect-ratio: 16/9;
        object-fit: cover;
        display: block;
    }

    .two-titles-files-card-text span {
        font-size: 12px;
        color: #74747C;
        font-family: asswat-light;
        font-weight: lighter;
    }

    .two-titles-files-card-text p {
        font-size: 14px;
        margin: 0;
        line-height: 1.4;
        font-family: asswat-bold;
        color: #333;
    }

    /* جعل النصوص قابلة للنقر */
    .two-titles-list-ite p {
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .two-titles-list-ite p:hover {
        color: #000;
        text-decoration: underline;
    }

    /* جعل النصوص قابلة للنقر */
    .two-titles-list-ite p {
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .two-titles-list-ite p:hover {
        color: #000;
        text-decoration: underline;
    }

    /* للعنوان في اليمين */
    .two-titles-right-card h2 {
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .two-titles-right-card h2:hover {
        color: #000;
        text-decoration: underline;
    }

    /* للبطاقات الصغيرة في العمود 2 */
    .two-titles-files-card-text p {
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .two-titles-files-card-text p:hover {
        color: #000;
        text-decoration: underline;
    }

    /* المؤشر والمؤثر للفئات */
    .two-titles-right-card h3,
    .two-titles-files-card-text span,
    .two-titles-list-ite .number {
        cursor: pointer;
    }
</style>

<section class="two-titles-grid">

    <!-- العمود 1 -->
    <div>
        <p class="section-title">الأكثر قراءة</p>
        @include('user.components.ligne')
        <div class="two-titles-list">
            @foreach ($topViewed as $index => $item)
                <div class="two-titles-list-ite">
                    <span class="number">{{ $index + 1 }}</span>
                    <p>{{ $item->title }}</p>
                </div>
            @endforeach
        </div>
    </div>


    <!-- العمود 2 -->
    <div>
        <p class="section-title">منوعات</p>
        @include('user.components.ligne')
        <div style="height: 20px;"></div>
        <div class="two-titles-right-card">
            <div class="second-grid">
                <div class="sport-feature">
                    <img src="{{ $variety[0]->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                        alt="{{ $variety[0]->title ?? '' }}">
                    <h3>
                        @if (isset($variety[0]->country))
                            {{ $variety[0]->category->name ?? '' }} - {{ $variety[0]->country->name ?? '' }}
                        @elseif (isset($variety[0]->continent))
                            {{ $variety[0]->category->name ?? '' }} - {{ $variety[0]->continent->name ?? '' }}
                        @else
                            {{ $variety[0]->category->name ?? '' }}
                        @endif
                    </h3>
                    <h2>{{ $variety[1]->title ?? '' }}</h2>
                    <p>{{ $variety[1]->summary ?? '' }}</p>
                </div>

                <div class="two-titles-files-card-list">
                    @foreach ($variety->slice(1, 4) as $variet)
                        <div class="two-titles-files-card">
                            <div class="two-titles-files-card-image">
                                <img src="{{ $variet->media()->wherePivot('type', 'main')->first()->path ?? '' }}"
                                    alt="{{ $variet->title ?? '' }}">
                            </div>
                            <div class="two-titles-files-card-text">
                                <span>
                                    @if (isset($variet->country))
                                        {{ $variet->category->name ?? '' }} - {{ $variet->country->name ?? '' }}
                                    @elseif (isset($variet->continent))
                                        {{ $variet->category->name ?? '' }} - {{ $variet->continent->name ?? '' }}
                                    @else
                                        {{ $variet->category->name ?? '' }}
                                    @endif
                                </span>
                                <p>{{ $variet->title ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
