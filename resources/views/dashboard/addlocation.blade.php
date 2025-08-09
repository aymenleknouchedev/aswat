@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة دولة أو مدينة')

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
                                <h4 class="nk-block-title" data-en="Add Country or City" data-ar="إضافة دولة أو مدينة">
                                    إضافة دولة أو مدينة
                                </h4>
                                <p data-en="Fill the form below to add a new country with city or add a city to an existing country."
                                    data-ar="املأ النموذج أدناه لإضافة دولة جديدة مع مدينة أو إضافة مدينة لدولة موجودة.">
                                    املأ النموذج أدناه لإضافة دولة جديدة مع مدينة أو إضافة مدينة لدولة موجودة.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ النموذج -->
                        <form action="{{ route('dashboard.location.store') }}" method="POST">
                            @csrf

                            <!-- اختيار دولة موجودة -->
                            <div class="form-group">
                                <label class="form-label" for="existing_country" data-en="Select Existing Country"
                                    data-ar="اختر دولة موجودة">
                                    اختر دولة موجودة
                                </label>
                                <div class="form-control-wrap">
                                    <select name="existing_country" id="existing_country" class="form-control">
                                        <option value="" data-en="-- None --" data-ar="-- لا يوجد --">-- لا يوجد --
                                        </option>
                                        <option value="الجزائر">الجزائر</option>
                                        <option value="المغرب">المغرب</option>
                                        <option value="تونس">تونس</option>
                                        <!-- لاحقاً هذه القائمة ستأتي من قاعدة البيانات -->
                                    </select>
                                </div>
                                <small class="form-text text-muted" data-en="Leave empty if adding a new country"
                                    data-ar="اتركه فارغاً إذا كنت تضيف دولة جديدة">
                                    اتركه فارغاً إذا كنت تضيف دولة جديدة
                                </small>
                            </div>

                            <!-- الدولة الجديدة -->
                            <div class="form-group" id="newCountryField">
                                <label class="form-label" for="country" data-en="New Country"
                                    data-ar="الدولة الجديدة">الدولة الجديدة</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="country" class="form-control" id="country" placeholder="">
                                </div>
                            </div>

                            <!-- المدينة -->
                            <div class="form-group">
                                <label class="form-label" for="city" data-en="City" data-ar="المدينة">المدينة</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="city" class="form-control" id="city" placeholder=""
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

    <!-- ✅ JavaScript to toggle field -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const existingCountrySelect = document.getElementById('existing_country');
            const newCountryField = document.getElementById('newCountryField');

            function toggleNewCountryField() {
                if (existingCountrySelect.value.trim() !== "") {
                    newCountryField.style.display = 'none';
                } else {
                    newCountryField.style.display = 'block';
                }
            }

            // Initial check
            toggleNewCountryField();

            // Listen for changes
            existingCountrySelect.addEventListener('change', toggleNewCountryField);
        });
    </script>
@endsection
