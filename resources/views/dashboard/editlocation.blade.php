@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل موقع')

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
                                <h4 class="nk-block-title" data-en="Edit Location" data-ar="تعديل موقع">
                                    تعديل موقع
                                </h4>
                                <p data-en="Fill the form below to edit a country, region, or city."
                                    data-ar="املأ النموذج أدناه لتعديل دولة أو منطقة أو مدينة.">
                                    املأ النموذج أدناه لتعديل دولة أو منطقة أو مدينة.
                                </p>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em>
                                <span class="translatable" data-ar="تمت العملية بنجاح"
                                    data-en="Operation completed successfully">
                                    {{ session('success') ?? 'تمت العملية بنجاح' }}
                                </span>
                            </div>
                        @endif

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.location.update', $location->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" id="name" value="{{ $location->name }}" class="form-control" required>
                                </div>
                            </div>

                            <!-- نوع الموقع (enum) -->
                            <div class="form-group">
                                <label class="form-label" for="type" data-en="Type" data-ar="النوع">النوع</label>
                                <div class="form-control-wrap">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="continent" data-en="Continent" data-ar="قارة" {{ $location->type == 'continent' ? 'selected' : '' }}>قارة</option>
                                        <option value="country" data-en="Country" data-ar="دولة" {{ $location->type == 'country' ? 'selected' : '' }}>دولة</option>
                                        <option value="city" data-en="City" data-ar="مدينة" {{ $location->type == 'city' ? 'selected' : '' }}>مدينة</option>
                                    </select>
                                </div>
                            </div>


                            <!-- زر الإرسال -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Update" data-ar="تحديث">
                                    تحديث
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
