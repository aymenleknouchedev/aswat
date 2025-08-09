@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة نافذة')

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
                                <h4 class="nk-block-title" data-en="Add New Window" data-ar="إضافة نافذة">إضافة نافذة</h4>
                                <p data-en="Fill the form below to create a new window."
                                    data-ar="املأ النموذج أدناه لإضافة نافذة جديدة.">
                                    املأ النموذج أدناه لإضافة نافذة جديدة.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.window.store') }}" method="POST">
                            @csrf

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" class="form-control" id="name" placeholder=""
                                        required>
                                </div>
                            </div>

                            <!-- الوصف -->
                            <div class="form-group">
                                <label class="form-label" for="description" data-en="Description"
                                    data-ar="الوصف">الوصف</label>
                                <div class="form-control-wrap">
                                    <textarea name="description" class="form-control" id="description" rows="3" placeholder=""></textarea>
                                </div>
                            </div>

                            <!-- زر الإرسال -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Add Window"
                                    data-ar="إضافة نافذة">إضافة نافذة</button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
