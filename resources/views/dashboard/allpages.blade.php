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
                                    <p data-en="List of all site pages." data-ar="قائمة بجميع الصفحات في الموقع.">
                                        قائمة بجميع الصفحات في الموقع.
                                    </p>
                                </div>
                            </div>

                            {{-- Validation / Success Messages --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="card card-bordered card-preview">
                                <table class="table table-orders">
                                    <thead class="tb-odr-head">
                                        <tr class="tb-odr-item">
                                            <th data-en="Title" data-ar="العنوان">العنوان</th>
                                            <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tb-odr-body">

                                        @foreach ($pages as $page)
                                            <tr class="tb-odr-item">
                                                <td>{{ $page->title }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.page.edit', $page->id) }}"
                                                        class="btn btn-sm btn-primary" data-en="Edit"
                                                        data-ar="تعديل">تعديل</a>
                                                    <form action="{{ route('dashboard.page.destroy', $page->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            data-en="Delete" data-ar="حذف">
                                                            حذف
                                                        </button>
                                                    </form>
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
