@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الصفحات')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')

            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">
                        <div class="nk-block nk-block-lg">

                            <!-- ✅ رأس الصفحة -->
                            <div class="nk-block-head">
                                <div class="nk-block-head-content d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="nk-block-title" data-en="All Pages" data-ar="جميع الصفحات">جميع الصفحات</h4>
                                        <p data-en="List of all site pages." data-ar="قائمة بجميع الصفحات في الموقع.">
                                            قائمة بجميع الصفحات في الموقع.
                                        </p>
                                    </div>
                                    <a href="{{ route('dashboard.page.create') }}" class="btn btn-primary" data-en="Add Page" data-ar="إضافة صفحة">
                                        إضافة صفحة
                                    </a>
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


                            <!-- ✅ جدول الصفحات -->
                            <div class="card card-bordered card-preview">
                                <table class="table table-orders">
                                    <thead class="tb-odr-head">
                                        <tr class="tb-odr-item">
                                            <th data-en="Title" data-ar="العنوان">العنوان</th>
                                            <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tb-odr-body">
                                        @forelse ($pages as $page)
                                            <tr class="tb-odr-item">
                                                <td>{{ $page->title }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.page.edit', $page->id) }}"
                                                        class="btn btn-sm btn-primary" data-en="Edit" data-ar="تعديل">
                                                        تعديل
                                                    </a>

                                                    <form action="{{ route('dashboard.page.destroy', $page->id) }}"
                                                        method="POST" class="d-inline delete-form">
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
                                                <td colspan="2" class="text-center" data-en="No pages found"
                                                    data-ar="لا توجد صفحات">
                                                    لا توجد صفحات
                                                </td>
                                            </tr>
                                        @endforelse
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
