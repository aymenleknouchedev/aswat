@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة موقع')

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
                                <h4 class="nk-block-title" data-en="Add Location" data-ar="إضافة موقع">
                                    إضافة موقع
                                </h4>
                                <p data-en="Fill the form below to add a country, region, or city."
                                    data-ar="املأ النموذج أدناه لإضافة دولة أو منطقة أو مدينة.">
                                    املأ النموذج أدناه لإضافة دولة أو منطقة أو مدينة.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.location.store') }}" method="POST">
                            @csrf

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" id="name" class="form-control" required
                                        placeholder="أدخل اسم الدولة أو المدينة أو المنطقة">
                                </div>
                            </div>

                            <!-- نوع الموقع (enum) -->
                            <div class="form-group">
                                <label class="form-label" for="type" data-en="Type" data-ar="النوع">النوع</label>
                                <div class="form-control-wrap">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="continent">قارة</option>
                                        <option value="country">دولة</option>
                                        <option value="city">مدينة</option>
                                    </select>
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
