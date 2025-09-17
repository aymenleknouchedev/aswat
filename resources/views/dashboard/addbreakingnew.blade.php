@extends('layouts.admin')

@section('title', 'أصوات جزائرية | أخبار عاجلة')

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
                                <h4 class="nk-block-title translatable" data-en="Add Breaking News" data-ar="إضافة خبر عاجل">
                                    إضافة خبر عاجل
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

                        {{-- Form --}}
                        <form action="{{ route('dashboard.breakingnew.store') }}" method="POST" class="mb-5">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="breaking_title" class="translatable" data-en="Breaking News Title"
                                    data-ar="عنوان الخبر العاجل">عنوان الخبر العاجل</label>
                                <input id="breaking_title" name="title" type="text"
                                    class="form-control form-control-lg" required data-en="Breaking News Title"
                                    data-ar="عنوان الخبر العاجل">
                            </div>
                            <button type="submit" class="btn btn-primary translatable" data-en="Add Breaking News"
                                data-ar="إضافة الخبر العاجل">
                                إضافة الخبر العاجل
                            </button>
                        </form>

                        {{-- Table with index --}}
                        @if ($breakingNews->isEmpty())
                            <div class="alert alert-info text-center my-4" role="alert">
                                <div class="mb-2">
                                    <em class="icon ni ni-info fs-2 "></em>
                                </div>
                                <h5 class="mb-2" data-en="No content found" data-ar="لا يوجد محتوى">لا يوجد محتوى
                                </h5>
                                <p class="mb-0" data-en="Start by adding new content to see it here."
                                    data-ar="ابدأ بإضافة محتوى جديد ليظهر هنا.">
                                    ابدأ بإضافة محتوى جديد ليظهر هنا.
                                </p>
                            </div>
                        @else
                            <table class="table table-orders">
                                <thead class="tb-odr-head">
                                    <tr class="tb-odr-item">
                                        <th class="tb-odr-info text-center translatable" style="width: 5%;" data-en="#"
                                            data-ar="#">#</th>
                                        <th class="tb-odr-info text-center translatable" style="width: 20%;"
                                            data-en="Breaking News Text" data-ar="نص الخبر العاجل">نص الخبر العاجل</th>
                                        <th class="tb-odr-action text-center translatable" style="width: 15%;"
                                            data-en="Actions" data-ar="الإجراءات">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="tb-odr-body">
                                    @foreach ($breakingNews as $index => $news)
                                        <tr class="tb-odr-item">
                                            <td class="tb-odr-info text-center">{{ $index + 1 }}</td>
                                            <td class="tb-odr-info text-center">
                                                <span class="tb-odr-total"><span
                                                        class="amount">{{ $news->text }}</span></span>
                                            </td>
                                            <td class="tb-odr-action text-center">
                                                <a href="{{ route('dashboard.breakingnew.edit', $news->id) }}"
                                                    class="btn btn-sm btn-primary mx-1 translatable" data-en="Edit"
                                                    data-ar="تعديل">تعديل</a>
                                                <form action="{{ route('dashboard.breakingnew.destroy', $news->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger mx-1 translatable delete-btn"
                                                        data-en="Delete" data-ar="حذف">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
