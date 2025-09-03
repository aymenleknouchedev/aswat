@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الدول والمدن')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid">

                        <!-- ✅ عنوان الصفحة -->
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-en="All Locations" data-ar="جميع الدول والمدن">
                                    جميع الدول والمدن
                                </h4>
                                <p data-en="Here you can manage all countries and cities."
                                    data-ar="هنا يمكنك إدارة جميع الدول والمدن.">
                                    هنا يمكنك إدارة جميع الدول والمدن.
                                </p>
                            </div>
                        </div>

                        <!-- رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em>
                                <span class="translatable" data-ar="تمت العملية بنجاح"
                                    data-en="Operation completed successfully">
                                    {{ session('success') ?? 'تمت العملية بنجاح' }}
                                </span>
                            </div>
                        @endif

                        <!-- رسائل الخطأ -->
                        @if ($errors->any())
                            <div class="alert alert-fill alert-danger alert-icon">
                                <em class="icon ni ni-cross-circle"></em>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li class="translatable" data-ar="حدث خطأ ما" data-en="An error occurred">
                                            {{ $error ?? 'حدث خطأ ما' }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <!-- ✅ جدول المواقع -->
                        <div class="card card-bordered card-preview">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th data-en="ID" data-ar="المعرف">المعرف</th>
                                        <th data-en="Country" data-ar="الدولة">الدولة</th>
                                        <th data-en="City" data-ar="المدينة">المدينة</th>
                                        <th data-en="Description" data-ar="الوصف">الوصف</th>
                                        <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $fakeLocations = [
                                            [
                                                'id' => 1,
                                                'country' => 'Algeria',
                                                'city' => 'Algiers',
                                                'description' => 'Capital city of Algeria',
                                            ],
                                            [
                                                'id' => 2,
                                                'country' => 'Morocco',
                                                'city' => 'Casablanca',
                                                'description' => 'Largest city in Morocco',
                                            ],
                                            [
                                                'id' => 3,
                                                'country' => 'Tunisia',
                                                'city' => 'Tunis',
                                                'description' => 'Capital city of Tunisia',
                                            ],
                                            [
                                                'id' => 4,
                                                'country' => 'Egypt',
                                                'city' => 'Cairo',
                                                'description' => 'Capital city of Egypt',
                                            ],
                                            [
                                                'id' => 5,
                                                'country' => 'Saudi Arabia',
                                                'city' => 'Riyadh',
                                                'description' => 'Capital city of Saudi Arabia',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($fakeLocations as $location)
                                        <tr>
                                            <td>{{ $location['id'] }}</td>
                                            <td>{{ $location['country'] }}</td>
                                            <td>{{ $location['city'] }}</td>
                                            <td>{{ $location['description'] }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary" data-en="Edit"
                                                    data-ar="تعديل">تعديل</a>
                                                <button type="button" class="btn btn-sm btn-danger" data-en="Delete"
                                                    data-ar="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟');">
                                                    حذف
                                                </button>
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
