@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة قسم')

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
                                <h4 class="nk-block-title" data-en="Add New Section" data-ar="إضافة قسم">إضافة قسم</h4>
                                <p data-en="Fill the form below to create a new section."
                                    data-ar="املأ النموذج أدناه لإضافة قسم جديد.">
                                    املأ النموذج أدناه لإضافة قسم جديد.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.section.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="name" data-en="Name" data-ar="الاسم">الاسم</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" class="form-control" id="name" placeholder=""
                                        required>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" data-en="Add Section"
                                    data-ar="إضافة قسم">إضافة قسم</button>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
