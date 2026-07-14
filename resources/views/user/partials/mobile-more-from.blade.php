{{-- Mobile "المزيد من {category}" — 4 rich cards (image, category, title, summary,
     date) using the shared mobile item card. Pass ['items' => $collection];
     falls back to $lastNews. Mobile widths only. --}}
@php($moreItems = $items ?? ($lastNews ?? collect()))

@if (is_countable($moreItems) && count($moreItems))
    <style>
        .mmf-section {
            width: 100%;
            margin: 8px 0 32px;
            box-sizing: border-box;
        }

        .mmf-heading {
            font-size: 20px;
            font-family: 'asswat-medium' !important;
            font-weight: 400 !important;
            color: #000;
            line-height: 1;
            text-align: right;
            margin: 0 0 10px 0;
        }

        /* Hide summary + date in the "المزيد من" cards */
        .mmf-section .ms-summary,
        .mmf-section .ms-date {
            display: none !important;
        }

        @media (min-width: 992px) {
            .mmf-section {
                display: none;
            }
        }
    </style>

    <div class="mmf-section" dir="rtl">
        <p class="mmf-heading">المزيد من {{ $category ?? ($news->category?->name ?? '') }}</p>
        @include('user.components.ligne')
        @foreach ($moreItems->take(4) as $content)
            @include('user.mobile.item', ['item' => $content])
        @endforeach
    </div>
@endif
