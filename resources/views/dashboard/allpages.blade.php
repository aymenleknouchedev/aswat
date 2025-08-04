@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الصفحات')

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
                                    <h4 class="nk-block-title" data-en="All Pages" data-ar="جميع الصفحات">جميع الصفحات</h4>
                                    <p data-en="List of all site pages."
                                       data-ar="قائمة بجميع الصفحات في الموقع.">
                                       قائمة بجميع الصفحات في الموقع.
                                    </p>
                                </div>
                            </div>

                            <div class="card card-bordered card-preview">
                                <table class="table table-orders">
                                    <thead class="tb-odr-head">
                                        <tr class="tb-odr-item">
                                            <th data-en="Title" data-ar="العنوان">العنوان</th>
                                            <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tb-odr-body">

                                        @php
                                            $pages = [
                                                'Privacy Policy',
                                                'Terms and Conditions',
                                                'About Us',
                                                'Contact Us',
                                                'Cookies Policy',
                                            ];
                                        @endphp

                                        @foreach ($pages as $page)
                                            <tr class="tb-odr-item">
                                                <td>{{ $page }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary" data-en="Edit" data-ar="تعديل">تعديل</a>
                                                    <a href="#" class="btn btn-sm btn-danger" data-en="Delete" data-ar="حذف">حذف</a>
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
