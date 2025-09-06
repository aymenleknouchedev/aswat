@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع المواقع')

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
                                <h4 class="nk-block-title" data-en="All Locations" data-ar="جميع المواقع">
                                    جميع المواقع
                                </h4>
                                <p data-en="Here you can manage all continents countries and cities."
                                    data-ar="هنا يمكنك إدارة جميع الدول والمناطق والمدن.">
                                    هنا يمكنك إدارة جميع الدول والمناطق والمدن.
                                </p>
                            </div>
                        </div>

                        <!-- ✅ Accordion Dark Mode -->
                        <div class="accordion" id="locationsAccordion">

                            <!-- المناطق -->
                            <div class="accordion-item bg-dark text-light">
                                <h2 class="accordion-header" id="headingRegions">
                                    <button class="accordion-button collapsed bg-dark text-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseRegions" aria-expanded="false"
                                        aria-controls="collapseRegions">
                                        القارات
                                    </button>
                                </h2>
                                <div id="collapseRegions" class="accordion-collapse collapse"
                                    aria-labelledby="headingRegions" data-bs-parent="#locationsAccordion">
                                    <div class="accordion-body">
                                        <table class="table table-dark table-striped">
                                            <thead>
                                                <tr>
                                                    <th>الاسم</th>
                                                    <th>الإجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($continents as $continent)
                                                    <tr>
                                                        <td>{{ $continent->name }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-primary">تعديل</a>
                                                            <form
                                                                action="{{ route('dashboard.location.destroy', $continent->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger delete-btn">
                                                                    حذف
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted">
                                                            لا توجد مناطق حالياً
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{ $continents->links() }}
                                    </div>
                                </div>
                            </div>

                            <!-- الدول -->
                            <div class="accordion-item bg-dark text-light">
                                <h2 class="accordion-header" id="headingCountries">
                                    <button class="accordion-button collapsed bg-dark text-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseCountries" aria-expanded="true"
                                        aria-controls="collapseCountries">
                                        الدول
                                    </button>
                                </h2>
                                <div id="collapseCountries" class="accordion-collapse collapse"
                                    aria-labelledby="headingCountries" data-bs-parent="#locationsAccordion">
                                    <div class="accordion-body">
                                        <table class="table table-dark table-striped">
                                            <thead>
                                                <tr>
                                                    <th>الاسم</th>
                                                    <th>الإجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($countries as $country)
                                                    <tr>
                                                        <td>{{ $country->name }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-primary">تعديل</a>
                                                            <form
                                                                action="{{ route('dashboard.location.destroy', $country->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger delete-btn">
                                                                    حذف
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted">
                                                            لا توجد دول حالياً
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{ $countries->links() }}
                                    </div>
                                </div>
                            </div>

                            <!-- المدن -->
                            <div class="accordion-item bg-dark text-light">
                                <h2 class="accordion-header" id="headingCities">
                                    <button class="accordion-button collapsed bg-dark text-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseCities" aria-expanded="false"
                                        aria-controls="collapseCities">
                                        المدن
                                    </button>
                                </h2>
                                <div id="collapseCities" class="accordion-collapse collapse" aria-labelledby="headingCities"
                                    data-bs-parent="#locationsAccordion">
                                    <div class="accordion-body">
                                        <table class="table table-dark table-striped">
                                            <thead>
                                                <tr>
                                                    <th>الاسم</th>
                                                    <th>الإجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($cities as $city)
                                                    <tr>
                                                        <td>{{ $city->name }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-primary">تعديل</a>
                                                            <form
                                                                action="{{ route('dashboard.location.destroy', $city->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger delete-btn">
                                                                    حذف
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted">
                                                            لا توجد مدن حالياً
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{ $cities->links() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- End Accordion -->


                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
