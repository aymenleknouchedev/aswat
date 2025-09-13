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
                        
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <form method="GET" action="{{ route('dashboard.locations.index') }}" class="row g-2 align-items-center">
                                    <div class="col-md-8 col-12">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            class="form-control"
                                            placeholder="ابحث عن تصنيف..." 
                                            data-en="Search for category..."
                                            data-ar="ابحث عن تصنيف...">
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <select name="type" class="form-select">
                                            <option value="">جميع الأنواع</option>
                                            <option value="city" {{ request('type') === 'city' ? 'selected' : '' }}>مدينة</option>
                                            <option value="country" {{ request('type') === 'country' ? 'selected' : '' }}>دولة</option>
                                            <option value="continent" {{ request('type') === 'continent' ? 'selected' : '' }}>قارة</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 col-6">
                                        <button type="submit" class="btn btn-primary w-100" data-en="Search" data-ar="بحث">بحث</button>
                                    </div>
                                    <div class="col-md-1 col-6">
                                        <a href="{{ route('dashboard.locations.index') }}" class="btn btn-light w-100"
                                        data-en="Reset" data-ar="إعادة تعيين">إعادة تعيين</a>
                                    </div>
                                </form>
                            </div>
                            <table class="table table-orders">
                                <thead class="tb-odr-head">
                                    <tr class="tb-odr-item">
                                        <th data-en="Name" data-ar="الإسم">الإسم</th>
                                        <th data-en="Type" data-ar="النوع">النوع</th>
                                        <th data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="tb-odr-body">
                                    @forelse ($locations as $location)
                                        <tr class="tb-odr-item">
                                            <td>{{ $location->name }}</td>
                                            <td>
                                                @if ($location->type === 'city')
                                                    <span class="badge bg-info">{{ ucfirst($location->type) }}</span>
                                                @elseif ($location->type === 'country')
                                                    <span class="badge bg-success">{{ ucfirst($location->type) }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($location->type) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboard.location.edit', $location->id) }}"
                                                    class="btn btn-sm btn-primary" data-en="Edit" data-ar="تعديل">
                                                    تعديل
                                                </a>

                                                <!-- ✅ زر الحذف -->
                                                <form action="{{ route('dashboard.location.destroy', $location->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                        data-en="Delete" data-ar="حذف">
                                                        حذف
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center" data-en="No categories found"
                                                data-ar="لا توجد تصنيفات">
                                                لا توجد تصنيفات
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $locations->links() }}
                        </div>
                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
