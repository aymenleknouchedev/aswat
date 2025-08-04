@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الأقسام')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')

            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid">
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title" data-en="All Sections" data-ar="جميع الأقسام">جميع الأقسام</h4>
                                    <p data-en="Static fake data for testing purpose."
                                        data-ar="بيانات وهمية لأغراض الاختبار فقط.">
                                        بيانات وهمية لأغراض الاختبار فقط.
                                    </p>
                                </div>
                            </div>

                            <div class="card card-bordered card-preview">
                                <table class="table table-orders">
                                    <thead class="tb-odr-head">
                                        <tr class="tb-odr-item">
                                            <th data-en="Name" data-ar="الإسم">الإسم</th>
                                            <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tb-odr-body">
                                        @php
                                            $sections = [
                                                'Technology',
                                                'Culture',
                                                'Politics',
                                                'Environment',
                                                'Health',
                                                'Sports',
                                                'Education',
                                                'Art',
                                                'Science',
                                                'History',
                                            ];
                                        @endphp

                                        @foreach ($sections as $section)
                                            <tr class="tb-odr-item">
                                                <td>{{ $section }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary" data-en="Edit"
                                                        data-ar="تعديل">تعديل</a>
                                                    <a href="#" class="btn btn-sm btn-danger" data-en="Delete"
                                                        data-ar="حذف">حذف</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
