@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الوسوم')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')

            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">


                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head d-flex justify-content-between align-items-center">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title" data-en="All CVs" data-ar="جميع السير الذاتية">جميع السير الذاتية
                                    </h4>
                                    <p data-en="Manage all CVs from here" data-ar="قم بإدارة جميع السير الذاتية من هنا">
                                        قم بإدارة جميع السير الذاتية من هنا
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


                            <div class="card card-bordered card-preview">
                                <table class="table table-orders">
                                    <thead class="tb-odr-head">
                                        <tr class="tb-odr-item">
                                            <th data-en="Full Name" data-ar="الإسم الكامل">الإسم الكامل</th>
                                            <th data-en="Email" data-ar="البريد الإلكتروني">البريد الإلكتروني</th>
                                            <th data-en="Message" data-ar="الرسالة">الرسالة</th>
                                            <th data-en="CV" data-ar="السيرة الذاتية">السيرة الذاتية</th>
                                            <th data-en="Submitted At" data-ar="تاريخ الإرسال">تاريخ الإرسال</th>
                                            <th data-en="Status" data-ar="الحالة">الحالة</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tb-odr-body">
                                        @forelse ($cvs as $cv)
                                            <tr class="tb-odr-item">
                                                <td>{{ $cv->fullname }}</td>
                                                <td>{{ $cv->email }}</td>
                                                <td>{{ $cv->message }}</td>
                                                <td>
                                                    <a href="{{ $cv->cv }}" target="_blank">
                                                        <i class="icon ni ni-eye" style="font-size: 1.2em; color: #5A8DEE;"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $cv->created_at }}</td>
                                                <td>
                                                    <select class="form-select form-select-sm">
                                                        <option value="pending" {{ $cv->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                                        <option value="reviewed" {{ $cv->status == 'reviewed' ? 'selected' : '' }}>تمت المراجعة</option>
                                                        <option value="accepted" {{ $cv->status == 'accepted' ? 'selected' : '' }}>مقبول</option>
                                                        <option value="rejected" {{ $cv->status == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center" data-en="No CVs found"
                                                    data-ar="لا توجد سير ذاتية">
                                                    لا توجد سير ذاتية
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class="d-flex justify-content-center mt-4">
                                {{ $tags->links() }}
                            </div> --}}

                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
