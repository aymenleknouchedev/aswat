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
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-en="Update Principal Trend" data-ar="تحديث الترند الرئيسي">
                                    تحديث الترند الرئيسي
                                </h4>
                                <p data-en="Choose a new trend from the list below to make it the principal one."
                                    data-ar="اختر الترند الجديد من القائمة أدناه لتعيينه كترند رئيسي.">
                                    اختر الترند الجديد من القائمة أدناه لتعيينه كترند رئيسي.
                                </p>
                            </div>
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

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.principal_trend.update', $principalTrend->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- حالة الترند الرئيسي -->
                            <div class="form-group mt-3">
                                <label class="form-label" data-ar="حالة الترند الرئيسي" data-en="Principal Trend Status">
                                    حالة الترند الرئيسي
                                </label>
                                <div class="form-control-wrap d-flex align-items-center" style="gap: 10px;">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                            {{ $principalTrend->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active" data-ar="تفعيل"
                                            data-en="Active">تفعيل</label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group d-flex align-items-end flex-wrap" style="gap: 20px;">
                                <!-- الترند الحالي -->
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label" data-en="Current Principal Trend" data-ar="الترند الرئيسي الحالي">
                                        الترند الرئيسي الحالي
                                    </label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" value="{{ $principalTrend->trend->title }}"
                                            disabled>
                                    </div>
                                </div>

                                <!-- اختيار الترند الجديد -->
                                <div class="col-md-6 col-lg-3" style="direction: rtl; text-align: right;">
                                    <label class="form-label" data-ar="الترند الجديد" data-en="New Trend">الترند الجديد</label>
                                    <div class="form-control-wrap">
                                        <select name="trend_id" class="form-select js-select2" data-search="on" required>
                                            <option value="">اختر الترند الجديد</option>
                                            @foreach ($allTrends as $trend)
                                                <option value="{{ $trend->id }}"
                                                    {{ old('trend_id', $principalTrend->trend_id) == $trend->id ? 'selected' : '' }}>
                                                    {{ $trend->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('trend_id')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- زر الإرسال -->
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary" data-en="Update Principal Trend"
                                        data-ar="تحديث الترند الرئيسي">
                                        تحديث الترند الرئيسي
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
