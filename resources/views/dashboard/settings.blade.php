@extends('layouts.admin')

@section('title', 'أصوات جزائرية | الإعدادات')

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
                                <h4 class="nk-block-title" data-en="Settings" data-ar="الإعدادات">الإعدادات</h4>
                                <p data-en="Manage your site settings below."
                                   data-ar="قم بإدارة إعدادات الموقع أدناه.">
                                   قم بإدارة إعدادات الموقع أدناه.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
