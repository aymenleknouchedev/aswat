@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل خبر عاجل')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid">

                        <div class="nk-block-head mb-4">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title translatable" data-en="Edit Breaking News" data-ar="تعديل خبر عاجل">تعديل خبر عاجل
                                </h4>
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

                        {{-- Edit Form --}}
                        <form action="{{ route('dashboard.breakingnew.update', $breakingNews->id) }}" method="POST" class="mb-5">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="breaking_title" class="translatable" data-en="Breaking News Title" data-ar="عنوان الخبر العاجل">عنوان الخبر العاجل</label>
                                <input id="breaking_title" name="title" type="text"
                                    class="form-control form-control-lg" required
                                    value="{{ old('title', $breakingNews->text) }}"
                                    data-en="Breaking News Title" data-ar="عنوان الخبر العاجل">
                            </div>
                            <button type="submit" class="btn btn-primary translatable" data-en="Update Breaking News"
                                data-ar="تحديث الخبر العاجل">
                                تحديث الخبر العاجل
                            </button>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
