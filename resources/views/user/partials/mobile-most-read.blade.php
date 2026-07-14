{{-- Mobile "الأكثر قراءة" (Most Read) list. Pass ['items' => $collection]; falls
     back to $lastWeekNews. Shown only on mobile widths. --}}
@php($mostReadItems = $items ?? ($lastWeekNews ?? collect()))

@if (is_countable($mostReadItems) && count($mostReadItems))
    <style>
        @media (max-width: 991px) {
            .mmr-section {
                width: 100%;
                background: #ffffff;
                color: #000;
                margin: 24px 0 40px;
                box-sizing: border-box;
            }

            .mmr-inner {
                width: 100%;
            }

            .mmr-heading {
                font-size: 20px;
                font-family: 'asswat-medium' !important;
                font-weight: 400 !important;
                color: #000;
                line-height: 1;
                text-align: right;
                margin: 0 0 10px 0;
            }

            .mmr-list {
                list-style: none;
                margin: 0;
                padding: 0;
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 0;
            }

            .mmr-item {
                display: flex;
                align-items: center;
                gap: 21px;
                padding: 24px 0;
            }

            .mmr-item + .mmr-item {
                border-top: 1px solid rgba(0, 0, 0, 0.12);
            }

            .mmr-index {
                min-width: 28px;
                text-align: center;
                font-weight: 900;
                font-size: 43px;
                line-height: 1;
                color: #e7e7e7;
                font-family: 'asswat-bold';
            }

            .mmr-title {
                display: inline-block;
                color: #000;
                text-decoration: none;
                font-size: 20px;
                font-weight: 800;
                line-height: 1.4;
                font-family: 'asswat-bold';
            }

            .mmr-title:hover {
                text-decoration: underline;
            }
        }
    </style>

    <div class="mmr-section" dir="rtl">
        <div class="mmr-inner">
            <p class="mmr-heading">الأكثر قراءة</p>
            @include('user.components.ligne')
            <ol class="mmr-list" role="list">
                @foreach ($mostReadItems->take(5) as $i => $content)
                    <li class="mmr-item">
                        <span class="mmr-index" aria-hidden="true">{{ $i + 1 }}</span>
                        <a class="mmr-title" href="{{ route('news.show', $content->shortlink) }}">
                            {{ \Illuminate\Support\Str::limit($content->mobile_title ?? $content->title, 50) }}
                        </a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endif
