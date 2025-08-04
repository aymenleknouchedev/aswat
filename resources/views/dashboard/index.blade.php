@extends('layouts.admin')

@section('title', 'أصوات جزائرية | لوحة التحكم')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')
                <div class="nk-content">
                    <div class="container-fluid">
                        
                    </div>
                </div>
                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
