@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة دولة ومدينة')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid">

                        <!-- ✅ عنوان الصفحة -->
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title" data-en="Add Country and City" data-ar="إضافة دولة ومدينة">
                                    إضافة دولة ومدينة
                                </h4>
                                <p data-en="Fill the form below to add a new country and its city."
                                    data-ar="املأ النموذج أدناه لإضافة دولة ومدينة جديدة.">
                                    املأ النموذج أدناه لإضافة دولة ومدينة جديدة.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.location.store') }}" method="POST">
                            @csrf

                            <!-- الدولة -->
                            <div class="form-group">
                                <label class="form-label" for="country" data-en="Country" data-ar="الدولة">الدولة</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="country" class="form-control" id="country" placeholder=""
                                        required>
                                </div>
                            </div>

                            <!-- المدينة -->
                            <div class="form-group">
                                <label class="form-label" for="city" data-en="City" data-ar="المدينة">المدينة</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="city" class="form-control" id="city" placeholder=""
                                        required>
                                </div>
                            </div>

                            <!-- الوصف (اختياري) -->
                            <div class="form-group">
                                <label class="form-label" for="description" data-en="Description"
                                    data-ar="الوصف">الوصف</label>
                                <div class="form-control-wrap">
                                    <textarea name="description" class="form-control" id="description" rows="3" placeholder=""></textarea>
                                </div>
                            </div>

                            <!-- زر الإرسال -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Add" data-ar="إضافة">
                                    إضافة
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
