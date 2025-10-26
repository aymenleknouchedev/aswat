@extends('layouts.index')

@section('title', 'أصوات جزائرية | آخر الأخبار')

@section('content')

    <style>
        .newCategory-all-section {
            display: grid;
            grid-template-columns: 10fr 2fr;
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
        }

        .newCategory-all-card-image img {
            width: 300px;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .newCategory-all-card-content {
            display: flex;
            justify-content: space-between;
            flex: 1;
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

        .newCategory-all-card-date {
            display: flex;
            align-items: center;
            /* vertically center */
            text-align: center;
            color: #333;
            /* dark grey */
            font-size: 14px;
            min-width: 70px;
            /* adjust as needed */
            order: -1;
            /* move to the left of the image */
        }

        /* Optional: responsive for mobile */
        @media (max-width: 768px) {
            .newCategory-all-section {
                grid-template-columns: 1fr;
            }

            .newCategory-all-card {
                flex-direction: column;
            }

            .newCategory-all-card-content {
                flex-direction: column;
                gap: 10px;
            }

            .newCategory-all-card-date {
                order: 0;
                /* back to normal in mobile */
                min-width: auto;
                align-items: flex-start;
            }
        }
    </style>

    <div class="web">
        @include('user.components.fixed-nav')

        <div class="container">
            <div class="title">
                <p class="section-title">أخبار</p>
                @include('user.components.ligne')
                <div class="under-title-ligne-space"></div>
            </div>

            <div class="newCategory-all-section">
                <!-- Left: آخر الأخبار -->
                <div class="newCategory-all-list">
                    @forelse ($latestContents as $item)
                        <div class="newCategory-all-card">
                            <div class="newCategory-all-card-date">
                                <h4 style="width: 100px">
                                    @php
                                        \Carbon\Carbon::setLocale('ar'); // تفعيل اللغة العربية

                                        $created = \Carbon\Carbon::parse($item->created_at);
                                        $now = \Carbon\Carbon::now();
                                        $diffHours = $created->diffInHours($now);
                                    @endphp

                                    @if ($diffHours < 24)
                                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                            <span>{{ $created->diffForHumans(null, null, false, 1) }}</span>
                                        </div>
                                    @else
                                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                            <span>{{ $created->translatedFormat('d F Y') }}</span>
                                            <span style="color: #74747C;">{{ $created->translatedFormat('H:i') }}</span>
                                        </div>
                                    @endif
                                </h4>


                            </div>
                            <div class="newCategory-all-card-image">
                                <img src="{{ $item->media()->wherePivot('type', 'main')->first()->path ?? './user/assets/images/IMG20.jpg' }}"
                                    alt="{{ $item->title }}">
                            </div>
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
                        <p>لا توجد أخبار حالياً.</p>
                    @endforelse
                </div>

                <!-- Right: الأكثر قراءة -->
                <div class="newCategory-all-side">
                    {{-- هنا تقدر تضيف ويدجت "الأكثر قراءة" --}}
                </div>
            </div>

            @include('user.components.sp60')
        </div>
        @include('user.components.footer')
    </div>

    <div class="mobile"></div>
@endsection
