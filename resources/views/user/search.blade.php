@extends('layouts.index')

@section('title', 'أصوات جزائرية | نتائج البحث')

@section('content')

    <style>
        .newCategory-all-section {
            display: grid;
            grid-template-columns: 8fr 4fr;
            gap: 70px;
        }

        .newCategory-all-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .newCategory-all-card {
            display: flex;
            gap: 20px;
            direction: rtl;
            align-items: center;
            /* vertically center */
        }

        .newCategory-all-card-date {
            color: #333;
            /* dark grey */
            font-size: 14px;
            min-width: 70px;
            text-align: center;
        }

        .newCategory-all-card-image img {
            width: 300px;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .newCategory-all-card-text {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .newCategory-all-card-text h3 {
            font-family: asswat-light;
            font-size: 12px;
            color: #74747C;
            margin: 0 0 4px 0;
        }

        .newCategory-all-card-text h2 {
            font-family: asswat-bold;
            font-size: 18px;
            margin: 0 0 8px 0;
            line-height: 1.4;
        }

        .newCategory-all-card-text p {
            font-size: 15px;
            color: #555;
            line-height: 1.5;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .newCategory-all-section {
                grid-template-columns: 1fr;
            }

            .newCategory-all-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .newCategory-all-card-date {
                margin-bottom: 10px;
            }
        }
    </style>

    <div class="web">
        @include('user.components.fixed-nav')

        <div class="container">
            <div class="title">
                <p class="section-title">نتائج البحث عن: {{ $query }}</p>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
            </div>

            <div class="newCategory-all-section">
                <!-- Left: نتائج البحث -->
                <div class="newCategory-all-list">
                    @forelse ($results as $item)
                        <div class="newCategory-all-card">
                            <!-- Date on the left -->
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

                            <!-- Image -->
                            <div class="newCategory-all-card-image">
                                <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                    alt="{{ $item->title }}">
                            </div>

                            <!-- Text -->
                            <div class="newCategory-all-card-text">
                                <h3><x-category-links :content="$item" /></h3>
                                <a href="{{ route('news.show', $item->title) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <h2>{{ $item->title }}</h2>
                                </a>
                                <h3>{{ $item->summary }}</h3>
                            </div>
                        </div>
                    @empty
                        <p>لا توجد نتائج مطابقة.</p>
                    @endforelse
                </div>

                <!-- Right: الأكثر قراءة -->
                <div class="newCategory-all-side">

                </div>
            </div>

            @include('user.components.sp60')
        </div>
        @include('user.components.footer')
    </div>

    <div class="mobile"></div>
@endsection
