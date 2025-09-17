@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الترندات')

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
                                    <h4 class="nk-block-title" data-en="All Trends" data-ar="جميع الترندات">جميع الترندات
                                    </h4>
                                    <p data-en="Manage all trends from here" data-ar="قم بإدارة جميع الترندات من هنا">
                                        قم بإدارة جميع الترندات من هنا
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

                                <div class="card-inner">
                                    <form method="GET" action="{{ route('dashboard.trends.index') }}" class="row g-2 align-items-center">
                                        <div class="col-md-8 col-12">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control"
                                           >
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <button type="submit" class="btn btn-primary w-100 center"
                                                    data-en="Search" data-ar="بحث">بحث</button>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <a href="{{ route('dashboard.trends.index') }}" class="btn btn-light w-100 center"
                                            data-en="Reset" data-ar="إعادة تعيين">إعادة تعيين</a>
                                        </div>
                                    </form>
                                </div>

                                <table class="table table-orders">
                                    <thead class="tb-odr-head">
                                        <tr class="tb-odr-item">
                                            <th data-en="Title" data-ar="العنوان">العنوان</th>
                                            <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tb-odr-body">
                                        @forelse ($trends as $trend)
                                            <tr class="tb-odr-item">
                                                <td>{{ $trend->title }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.trend.edit', $trend->id) }}"
                                                        class="btn btn-sm btn-primary" data-en="Edit"
                                                        data-ar="تعديل">تعديل</a>

                                                    <!-- ✅ زر الحذف -->
                                                    <form action="{{ route('dashboard.trend.destroy', $trend->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                            data-en="Delete" data-ar="حذف">
                                                            حذف
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center" data-en="No trends found"
                                                    data-ar="لا توجد ترندات">
                                                    لا توجد ترندات
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $trends->links() }}
                            </div>

                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
