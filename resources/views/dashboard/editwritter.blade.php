@extends('layouts.admin')

@section('title', 'أصوات جزائرية | تعديل كاتب')

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
                                <h4 class="nk-block-title" data-en="Edit Writer" data-ar="تعديل كاتب">تعديل كاتب</h4>
                                <p data-en="Update the information below." data-ar="قم بتحديث المعلومات أدناه.">
                                    قم بتحديث المعلومات أدناه.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.writer.update', $writer->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- الاسم -->
                            <div class="form-group">
                                <label class="form-label" for="name">الاسم</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $writer->name) }}" required>
                            </div>

                            <!-- السلاق -->
                            <div class="form-group">
                                <label class="form-label" for="slug">الرابط</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ old('slug', $writer->slug) }}" required>
                            </div>

                            <!-- نبذة -->
                            <div class="form-group">
                                <label class="form-label" for="bio" data-en="Bio" data-ar="نبذة">نبذة</label>
                                <div class="form-control-wrap">
                                    <textarea name="bio" class="form-control" id="bio" rows="4" maxlength="210" required>{{ old('bio', isset($writer) ? $writer->bio : '') }}</textarea>
                                    <small class="text-muted">
                                        <span id="bio-count">0</span> / 210
                                    </small>
                                </div>
                                @error('bio')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    var bio = document.getElementById('bio');
                                    var count = document.getElementById('bio-count');
                                    function updateCount() {
                                        count.textContent = bio.value.length;
                                    }
                                    updateCount();
                                    bio.addEventListener('input', updateCount);
                                });
                            </script>

                            <!-- الصورة -->
                            <div class="form-group">
                                <label class="form-label" for="image">الصورة</label>
                                <div class="form-control-wrap">
                                    @if ($writer->image)
                                        <div class="mb-2">
                                            <img src="{{ $writer->image }}" alt="Writer Image"
                                                style="max-width: 200px;">
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                                @error('image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- روابط -->
                            <div class="form-group">
                                <label for="facebook">فيسبوك</label>
                                <input type="url" name="facebook" class="form-control"
                                    value="{{ old('facebook', $writer->facebook) }}">
                            </div>

                            <div class="form-group">
                                <label for="x">X</label>
                                <input type="url" name="x" class="form-control"
                                    value="{{ old('x', $writer->x) }}">
                            </div>

                            <div class="form-group">
                                <label for="instagram">إنستغرام</label>
                                <input type="url" name="instagram" class="form-control"
                                    value="{{ old('instagram', $writer->instagram) }}">
                            </div>

                            <div class="form-group">
                                <label for="linkedin">لينكدإن</label>
                                <input type="url" name="linkedin" class="form-control"
                                    value="{{ old('linkedin', $writer->linkedin) }}">
                            </div>

                            <!-- زر -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">تحديث كاتب</button>
                                <a href="{{ route('writer.show' , $writer->id) }}" target="_blank" class="btn btn-light ml-2" data-ar="عرض" data-en="Preview">عرض</a>
                            </div>
                        </form>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
