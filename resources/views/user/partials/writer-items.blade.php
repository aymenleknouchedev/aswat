@foreach ($articles as $item)
    <div class="newCategory-all-card">
        <div class="newCategory-all-card-date">
            @php
                $months = [
                    '01' => 'يناير',
                    '02' => 'فبراير',
                    '03' => 'مارس',
                    '04' => 'أبريل',
                    '05' => 'مايو',
                    '06' => 'يونيو',
                    '07' => 'يوليو',
                    '08' => 'أغسطس',
                    '09' => 'سبتمبر',
                    '10' => 'أكتوبر',
                    '11' => 'نوفمبر',
                    '12' => 'ديسمبر',
                ];
                $date = $item->created_at;
                $day = $date->format('d');
                $month = $months[$date->format('m')];
                $year = $date->format('Y');
            @endphp
            <h4>{{ $day }} {{ $month }} {{ $year }}</h4>
        </div>

        <div class="newCategory-all-card-image">
            <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? asset('user/assets/images/IMG20.jpg') }}"
                alt="{{ $item->title }}">
        </div>

        <div class="newCategory-all-card-text">
            <h3><x-category-links :content="$item" /></h3>
            <a href="{{ route('news.show', $item->title ?? Str::slug($item->title)) }}"
                style="text-decoration: none; color: inherit;">
                <h2>{{ $item->title }}</h2>
            </a>
            <p>{{ $item->summary }}</p>
        </div>
    </div>
@endforeach
