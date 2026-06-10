@php
    $months = [
        '01' => 'جانفي',
        '02' => 'فيفري',
        '03' => 'مارس',
        '04' => 'أفريل',
        '05' => 'ماي',
        '06' => 'جوان',
        '07' => 'جويلية',
        '08' => 'أوت',
        '09' => 'سبتمبر',
        '10' => 'أكتوبر',
        '11' => 'نوفمبر',
        '12' => 'ديسمبر',
    ];

    $dateToUse = $content->published_date ?? $content->published_at ?? $content->created_at;
@endphp
@if ($dateToUse)
    <span class="content-card-date" style="font-size: 12px; color: #74747C; font-family: asswat-light;">
        {{ $dateToUse->format('d') }} {{ $months[$dateToUse->format('m')] }} {{ $dateToUse->format('Y') }}
    </span>
@endif
