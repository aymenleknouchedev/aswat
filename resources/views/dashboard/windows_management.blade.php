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
                                                <th>القسم</th>
                                                <th>النافذة</th>
                                                <th>الحالة</th>
                                                <th>تحديث</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sections as $section)
                                                <tr>
                                                    <form
                                                        action="{{ route('dashboard.sections.updateWindow', $section->id) }}"
                                                        method="POST" class="d-flex align-items-center">
                                                        @csrf
                                                        @method('PUT')

                                                        {{-- Section name --}}
                                                        <td><strong>{{ $section->name }}</strong></td>

                                                        {{-- Window selector --}}
                                                        <td style="min-width:200px;">
                                                            <select name="window_id" class="form-select js-select2"
                                                                data-search="on" required>
                                                                <option value="">اختر نافذة</option>
                                                                @foreach ($windows as $window_item)
                                                                    <option value="{{ $window_item->id }}"
                                                                        {{ $section->window }}
                                                                        {{ optional($section->windowManagement)->window_id == $window_item->id ? 'selected' : '' }}>
                                                                        {{ $window_item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        {{-- Status switch --}}
                                                        <td style="min-width:140px;">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="status-{{ $section->id }}" name="status"
                                                                    value="1"
                                                                    {{ optional($section->windowManagement)->status ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="status-{{ $section->id }}"></label>
                                                            </div>
                                                        </td>

                                                        {{-- Update button --}}
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
