@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة تصنيف')

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
                                <h4 class="nk-block-title" data-en="Add New Category" data-ar="إضافة تصنيف">إضافة تصنيف</h4>
                                <p data-en="Fill the form below to create a new category."
                                    data-ar="املأ النموذج أدناه لإضافة تصنيف جديد.">
                                    املأ النموذج أدناه لإضافة تصنيف جديد.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ النموذج -->
                        <form  method="POST">
                            @csrf

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الإسم">الإسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" class="form-control" id="name" placeholder=""
                                        required>
                                </div>
                            </div>

                            <!-- زر الإرسال -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Add Category"
                                    data-ar="إضافة تصنيف">إضافة تصنيف</button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
