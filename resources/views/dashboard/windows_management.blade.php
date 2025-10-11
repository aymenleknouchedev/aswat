@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إدارة النوافذ')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">

                        <!-- ✅ عنوان الصفحة -->
                        <div class="nk-block-head mb-4">
                            <h4 class="nk-block-title mb-2" data-en="Window Management" data-ar="إدارة النوافذ">إدارة النوافذ
                            </h4>
                            <p class="text-muted" data-en="Manage all windows for each dashboard section below."
                                data-ar="قم بإدارة جميع النوافذ لكل قسم من لوحة التحكم أدناه.">
                                قم بإدارة جميع النوافذ لكل قسم من لوحة التحكم أدناه.
                            </p>
                        </div>

                        <!-- ✅ رسائل النجاح -->
                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em>
                                <span class="translatable" data-ar="تم التحديث بنجاح" data-en="Updated successfully">
                                    {{ session('success') ?? 'تم التحديث بنجاح' }}
                                </span>
                            </div>
                        @endif

                        <!-- ✅ رسائل الخطأ -->
                        @if ($errors->any())
                            <div class="alert alert-fill alert-danger alert-icon">
                                <em class="icon ni ni-cross-circle"></em>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- ✅ الجدول -->
                        <div class="card shadow-sm">
                            <div class="card-inner">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="thead-light">
                                            <tr>
                                                <th data-ar="القسم" data-en="Section">القسم</th>
                                                <th data-ar="النافذة" data-en="Window">النافذة</th>
                                                <th data-ar="الحالة" data-en="Status">الحالة</th>
                                                <th data-ar="تحديث" data-en="Update">تحديث</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sections as $section)
                                                <tr>
                                                    <td><strong>{{ $section->name }}</strong></td>

                                                    <form
                                                        action="{{ route('dashboard.sections.updateWindow', $section->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td style="min-width:180px;">
                                                            <div class="form-group mb-0">
                                                                <select name="window_id" class="form-control js-select2"   
                                                                    data-search="on" required>
                                                                    @php
                                                                        $availableWindows =
                                                                            !empty($section->window) &&
                                                                            $section->window->count() > 0
                                                                                ? $section->window
                                                                                : $windows;
                                                                    @endphp
                                                                    @foreach ($availableWindows as $window)
                                                                        <option value="{{ $window->id }}"
                                                                            {{ $section->selected_window_id == $window->id ? 'selected' : '' }}>
                                                                            {{ $window->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td style="min-width:140px;">
                                                            <div class="form-group mb-0">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        name="is_active" id="site-off-{{ $section->id }}"
                                                                        value="1"
                                                                        {{ $section->is_active ? 'checked' : '' }}>
                                                                    <label class="custom-control-label"
                                                                        for="site-off-{{ $section->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <button type="submit" class="btn btn-primary btn-sm px-3">
                                                                تحديث
                                                            </button>
                                                        </td>
                                                    </form>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>

    <!-- ✅ تحسينات شكل الجدول -->
    <style>
        .table th {
            font-weight: 600;
            background: #f9fafb;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f5f6fa;
            transition: background 0.2s ease;
        }

        .card {
            border-radius: 12px;
        }
    </style>
@endsection
