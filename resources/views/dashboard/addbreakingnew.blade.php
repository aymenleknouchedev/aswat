@php
    $breakingNews = [
        (object) ['id' => 1, 'title' => 'انفجار كبير في وسط المدينة', 'created_at' => '23 Jan 2019, 10:45pm'],
        (object) ['id' => 2, 'title' => 'توقف حركة القطارات بسبب الإضراب', 'created_at' => '12 Jan 2020, 10:45pm'],
        (object) [
            'id' => 3,
            'title' => 'اعلان حالة الطوارئ في المنطقة الشمالية',
            'created_at' => '26 Dec 2019, 12:15 pm',
        ],
        (object) ['id' => 4, 'title' => 'تأخير في الرحلات الجوية', 'created_at' => '21 Jan 2019, 6:12 am'],
        (object) ['id' => 5, 'title' => 'احتجاجات في وسط المدينة', 'created_at' => '21 Jan 2019, 6:12 am'],
    ];
@endphp

@extends('layouts.admin')

@section('title', 'أصوات جزائرية | أخبار عاجلة')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid">

                        <div class="nk-block-head mb-4">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-en="Add Breaking News" data-ar="إضافة خبر عاجل">إضافة خبر عاجل
                                </h4>
                            </div>
                        </div>

                        {{-- Form --}}
                        <form action="" method="POST" class="mb-5">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="breaking_title" data-en="Breaking News Title" data-ar="عنوان الخبر العاجل">عنوان
                                    الخبر العاجل</label>
                                <input id="breaking_title" name="title" type="text"
                                    class="form-control form-control-lg" placeholder="أدخل عنوان الخبر العاجل" required>
                            </div>
                            <button type="submit" class="btn btn-primary" data-en="Add Breaking News"
                                data-ar="إضافة الخبر العاجل">
                                إضافة الخبر العاجل
                            </button>
                        </form>

                        {{-- Table with index --}}
                        <div class="card card-bordered card-preview">
                            <table class="table table-orders">
                                <thead class="tb-odr-head">
                                    <tr class="tb-odr-item">
                                        <th class="tb-odr-info text-center" style="width: 5%;">#</th>
                                        <th class="tb-odr-info text-center" style="width: 80%;">العنوان</th>
                                        <th class="tb-odr-action text-center" style="width: 15%;">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="tb-odr-body">
                                    @foreach ($breakingNews as $index => $news)
                                        <tr class="tb-odr-item">
                                            <td class="tb-odr-info text-center">{{ $index + 1 }}</td>
                                            <td class="tb-odr-info text-center">
                                                <span class="tb-odr-total"><span
                                                        class="amount">{{ $news->title }}</span></span>
                                            </td>
                                            <td class="tb-odr-action text-center">
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                                        data-bs-toggle="dropdown" data-offset="-8,0"><em
                                                            class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                        <ul class="link-list-plain">
                                                            <li><a href="#" class="text-primary">تعديل</a></li>
                                                            <li><a href="#" class="text-danger">حذف</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
