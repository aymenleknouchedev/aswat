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

                        @if (session('success'))
                            <div class="alert alert-fill alert-success alert-icon">
                                <em class="icon ni ni-check-circle"></em> {{ session('success') }}
                            </div>
                        @endif

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

                        <!-- ✅ إعدادات مشاركة الأخبار العاجلة -->
                        <div class="card">
                            <div class="card-inner">
                                <h5 class="mb-3" data-en="Breaking News Share" data-ar="مشاركة الأخبار العاجلة">
                                    مشاركة الأخبار العاجلة</h5>

                                <form action="{{ route('dashboard.settings.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <!-- الصورة -->
                                    <div class="form-group">
                                        <label class="form-label" for="breaking_share_image"
                                            data-en="Share Image" data-ar="صورة المشاركة">صورة المشاركة</label>
                                        <div class="form-control-wrap">
                                            <input type="file" id="breaking_share_image" name="breaking_share_image"
                                                class="form-control" accept="image/*">
                                        </div>
                                        <div class="mt-2">
                                            @php
                                                $currentBreakingImage = $breakingShareImage ? asset($breakingShareImage) : asset('breaking.jpeg');
                                            @endphp
                                            <img src="{{ $currentBreakingImage }}" alt="Breaking share image"
                                                style="max-width: 320px; border: 1px solid #eee;">
                                            <p class="text-soft small mt-1" data-en="Current image (leave empty to keep it)"
                                                data-ar="الصورة الحالية (اترك الحقل فارغاً للإبقاء عليها)">
                                                الصورة الحالية (اترك الحقل فارغاً للإبقاء عليها)</p>
                                        </div>
                                    </div>

                                    <!-- الوصف -->
                                    <div class="form-group">
                                        <label class="form-label" for="breaking_share_description"
                                            data-en="Share Description" data-ar="وصف المشاركة">وصف المشاركة</label>
                                        <textarea id="breaking_share_description" name="breaking_share_description"
                                            rows="3" class="form-control"
                                            placeholder="الوصف الذي يظهر عند مشاركة رابط الأخبار العاجلة">{{ old('breaking_share_description', $breakingShareDescription) }}</textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary" data-en="Save" data-ar="حفظ">
                                            <em class="icon ni ni-save"></em> <span>حفظ</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
