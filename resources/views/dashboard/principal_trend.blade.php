@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تحديث الترند الرئيسي')

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
                            <h4 class="nk-block-title mb-2" data-en="Update Principal Trend" data-ar="تحديث الترند الرئيسي">
                                تحديث الترند الرئيسي
                            </h4>
                            <p class="text-muted" data-en="Choose a new trend and status below."
                                data-ar="اختر الترند الجديد وحالته من السطر أدناه.">
                                اختر الترند الجديد وحالته من السطر أدناه.
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

                        <!-- ✅ الجدول بنفس تصميم إدارة النوافذ -->
                        <div class="card shadow-sm">
                            <div class="card-inner">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="thead-light">
                                            <tr>
                                                <th data-ar="الترند الحالي" data-en="Current Trend">الترند الحالي</th>
                                                <th data-ar="الترند الجديد" data-en="New Trend">الترند الجديد</th>
                                                <th data-ar="الحالة" data-en="Status">الحالة</th>
                                                <th data-ar="تحديث" data-en="Update">تحديث</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>{{ $principalTrend->trend->title ?? 'غير محدد' }}</strong></td>

                                                <form
                                                    action="{{ route('dashboard.principal_trend.update', $principalTrend->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- 🟢 الترند الجديد -->
                                                    <td style="min-width:180px;">
                                                        <div class="form-group mb-0">
                                                            <select name="trend_id" class="form-control js-select2"
                                                                data-search="on" required>
                                                                @foreach ($allTrends as $trend)
                                                                    <option value="{{ $trend->id }}"
                                                                        {{ $principalTrend->trend_id == $trend->id ? 'selected' : '' }}>
                                                                        {{ $trend->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>

                                                    <!-- 🔘 الحالة -->
                                                    <td style="min-width:160px;">
                                                        <select name="is_active" class="form-control" required>
                                                            <option value="1"
                                                                {{ $principalTrend->is_active ? 'selected' : '' }}>مفعّل
                                                            </option>
                                                            <option value="0"
                                                                {{ !$principalTrend->is_active ? 'selected' : '' }}>غير
                                                                مفعّل</option>
                                                        </select>
                                                    </td>

                                                    <!-- 🔘 زر التحديث -->
                                                    <td>
                                                        <button type="submit" class="btn btn-primary btn-sm px-3">
                                                            تحديث
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>
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

        .form-control,
        .btn {
            border-radius: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }
    </style>
@endsection
