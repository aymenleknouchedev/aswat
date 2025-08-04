@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع المستخدمين')

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
                                <h4 class="nk-block-title" data-en="All Users" data-ar="جميع المستخدمين">جميع المستخدمين</h4>
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
                                        <th data-en="Email" data-ar="الإيميل">الإيميل</th>
                                        <th data-en="Role" data-ar="الدور">الدور</th>
                                        <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="tb-odr-body">
                                    @php
                                        $users = [
                                            ['Ahmed Mohamed', 'ahmed@example.com', 'Admin', 'مشرف', 'bg-success'],
                                            ['Layla Ali', 'layla@example.com', 'Editor', 'محرر', 'bg-warning'],
                                            ['Youssef Karim', 'youssef@example.com', 'Writer', 'كاتب', 'bg-info'],
                                            ['Sara Saleh', 'sara@example.com', 'Writer', 'كاتب', 'bg-info'],
                                            ['Mohamed Adel', 'mohamed@example.com', 'Admin', 'مشرف', 'bg-success'],
                                            ['Khaled Nour', 'khaled@example.com', 'Editor', 'محرر', 'bg-warning'],
                                            ['Nourhan Saad', 'nourhan@example.com', 'Writer', 'كاتب', 'bg-info'],
                                            ['Rami Hossam', 'rami@example.com', 'Admin', 'مشرف', 'bg-success'],
                                            ['Omar Fathi', 'omar@example.com', 'Editor', 'محرر', 'bg-warning'],
                                            ['Huda Hassan', 'huda@example.com', 'Writer', 'كاتب', 'bg-info'],
                                        ];
                                    @endphp

                                    @foreach($users as $user)
                                    <tr class="tb-odr-item">
                                        <td>{{ $user[0] }}</td>
                                        <td>{{ $user[1] }}</td>
                                        <td><span class="badge badge-dot {{ $user[4] }}" data-en="{{ $user[2] }}" data-ar="{{ $user[3] }}">{{ $user[3] }}</span></td>
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
