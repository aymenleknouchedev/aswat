@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة موقع')

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
                                <h4 class="nk-block-title" data-en="Add Location" data-ar="إضافة موقع">
                                    إضافة موقع
                                </h4>
                                <p data-en="Fill the form below to add a country, region, or city."
                                    data-ar="املأ النموذج أدناه لإضافة دولة أو منطقة أو مدينة.">
                                    املأ النموذج أدناه لإضافة دولة أو منطقة أو مدينة.
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

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.location.store') }}" method="POST">
                            @csrf

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="slug" data-en="Slug" data-ar="الرابط المختصر">الرابط المختصر</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="slug" id="slug" class="form-control" required>
                                </div>
                                @error('slug')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- نوع الموقع (enum) -->
                            <div class="form-group">
                                <label class="form-label" for="type" data-en="Type" data-ar="النوع">النوع</label>
                                <div class="form-control-wrap">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="continent" data-en="Continent" data-ar="قارة">قارة</option>
                                        <option value="country" data-en="Country" data-ar="دولة">دولة</option>
                                        <option value="city" data-en="City" data-ar="مدينة">مدينة</option>
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
