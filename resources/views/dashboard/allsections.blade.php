@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الأقسام')

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
                                    <h4 class="nk-block-title" data-en="All Sections" data-ar="جميع الأقسام">جميع الأقسام
                                    </h4>
                                    <p data-en="Manage all sections from here" data-ar="قم بإدارة جميع الأقسام من هنا">
                                        قم بإدارة جميع الأقسام من هنا
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('dashboard.section.create') }}" class="btn btn-primary" data-en="Add Section" data-ar="إضافة قسم">
                                        إضافة قسم
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

                            @if ($sections->isEmpty())
                                <div class="alert alert-info text-center my-4" role="alert">
                                    <div class="mb-2">
                                        <em class="icon ni ni-info fs-2 mb-2"></em>
                                    </div>
                                    <h5 class="mb-2" data-en="No sections found" data-ar="لا توجد أقسام">لا توجد أقسام
                                    </h5>
                                    <p class="mb-0" data-en="Start by adding new sections to see them here."
                                        data-ar="ابدأ بإضافة قسم جديد ليظهر هنا.">
                                        ابدأ بإضافة قسم جديد ليظهر هنا.
                                    </p>
                                </div>
                            @else
                                <table class="table table-orders">
                                    <thead class="tb-odr-head">
                                        <tr class="tb-odr-item">
                                            <th data-en="Name" data-ar="الإسم">الإسم</th>
                                            <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tb-odr-body">
                                        @foreach ($sections as $section)
                                            <tr class="tb-odr-item">
                                                <td>{{ $section->name }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.section.edit', $section->id) }}"
                                                        class="btn btn-sm btn-primary" data-en="Edit"
                                                        data-ar="تعديل">تعديل</a>

                                                    <!-- ✅ زر الحذف -->
                                                    <form action="{{ route('dashboard.section.destroy', $section->id) }}"
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
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif


                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
