<style>
    /* Light grey button style */
    .btn-light-grey {
        background-color: #f8f9fa;
        /* Light grey */
        border: 1px solid #ddd;
        color: #333;
    }

    .btn-light-grey:hover {
        background-color: #e9ecef;
        /* Slightly darker grey on hover */
        color: #000;
    }

    /* Light grey dropdown style */
    .dropdown-menu.custom-dropdown {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 4px 0;
    }

    .dropdown-menu.custom-dropdown .dropdown-item {
        color: #333;
        padding: 6px 14px;
    }

    .dropdown-menu.custom-dropdown .dropdown-item:hover {
        background-color: #e9ecef;
        color: #000;
    }
</style>

@extends('layouts.admin')

@section('title', 'أصوات جزائرية | إضافة تصنيف')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container-fluid">

                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title" data-en="Media" data-ar="الوسائط">
                                                    Media</h3>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                                        data-target="pageMenu">
                                                        <em class="icon ni ni-more-v"></em>
                                                    </a>
                                                    <div class="toggle-expand-content" data-content="pageMenu"
                                                        style="display: none;">
                                                        <div class="toggle-expand-content" data-content="pageMenu"
                                                            style="display: none;">
                                                            <ul class="nk-block-tools g-3">

                                                                <!-- Filter File Type -->
                                                                <li class="nk-block-tools-opt">
                                                                    <div class="form-control-wrap">
                                                                        <select class="form-select js-select2"
                                                                            id="fileTypeFilter" data-search="off">
                                                                            <option value="all" data-en="All Files"
                                                                                data-ar="كل الملفات">All Files</option>
                                                                            <option value="images" data-en="Images"
                                                                                data-ar="صور">Images</option>
                                                                            <option value="videos" data-en="Videos"
                                                                                data-ar="فيديوهات">Videos</option>
                                                                            <option value="documents" data-en="Documents"
                                                                                data-ar="مستندات">Documents</option>
                                                                        </select>
                                                                    </div>
                                                                </li>

                                                                <!-- Upload File Button -->
                                                                <li class="nk-block-tools-opt">
                                                                    <a data-bs-toggle="modal" href="#addMedia"
                                                                        class="btn btn-primary">
                                                                        <em class="icon ni ni-plus"></em>
                                                                        <span data-en="Add Media" data-ar="رفع ملف">Upload
                                                                            File</span>
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>

                                                        <script>
                                                            document.getElementById('fileTypeFilter').addEventListener('change', function() {
                                                                const type = this.value;
                                                                console.log("Filter selected:", type);
                                                                // TODO: Hook into your filtering logic
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="row g-gs">
                                            @for ($i = 0; $i < 8; $i++)
                                                <div class="col-sm-6 col-lg-4 col-xxl-3">
                                                    <div class="gallery gallery-content card card-bordered">
                                                        <div class="gallery-images">
                                                            <img class="w-100 rounded" src="user/assets/images/IMG1.webp"
                                                                alt="">
                                                        </div>
                                                        <div class="image-overlay">
                                                            <ul>
                                                                <li>
                                                                    <a data-bs-toggle="modal" href="#editMedia"
                                                                        aria-label="Edit">
                                                                        <em class="icon ni ni-edit"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="card card-bordered card-stretch">
                                            <div class="card-inner">
                                                <div class="nk-block-between-md g-3">
                                                    <div class="g">
                                                        <ul
                                                            class="pagination justify-content-center justify-content-md-start">
                                                            <li class="page-item"><a class="page-link" href="#"
                                                                    data-en="Prev" data-ar="السابق">Prev</a></li>
                                                            <li class="page-item"><a class="page-link" href="#"
                                                                    data-en="1" data-ar="1">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#"
                                                                    data-en="2" data-ar="2">2</a></li>
                                                            <li class="page-item"><span class="page-link"><em
                                                                        class="icon ni ni-more-h"></em></span></li>
                                                            <li class="page-item"><a class="page-link" href="#"
                                                                    data-en="6" data-ar="6">6</a></li>
                                                            <li class="page-item"><a class="page-link" href="#"
                                                                    data-en="7" data-ar="7">7</a></li>
                                                            <li class="page-item"><a class="page-link" href="#"
                                                                    data-en="Next" data-ar="التالي">Next</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection

<!-- Modal Add Media -->
<div class="modal fade" tabindex="-1" role="dialog" id="addMedia">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                    class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title" data-en="Upload File" data-ar="إضافة ملف">Upload File</h5>
                <form action="#" class="mt-4">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="addName" data-en="Name" data-ar="الاسم">Name</label>
                                <input type="text" class="form-control" id="addName" placeholder="Plant"
                                    value="Plant" data-en-placeholder="Plant" data-ar-placeholder="نبتة">
                            </div>
                        </div><!-- .col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="addAlt" data-en="Alt Text"
                                    data-ar="النص البديل">Alter Text</label>
                                <input type="text" class="form-control" id="addAlt"
                                    placeholder="Feature Image" value="Feature Image"
                                    data-en-placeholder="Feature Image" data-ar-placeholder="صورة مميزة">
                            </div>
                        </div><!-- .col -->
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="category" data-en="Featured Image"
                                    data-ar="الصورة المميزة">Featured Image</label>
                                <div class="upload-zone small bg-lighter my-2">
                                    <div class="dz-message">
                                        <span class="dz-message-text" data-en="Drag and drop file"
                                            data-ar="اسحب وأسقط الملف">Drag and drop file</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary"
                                        data-en="Add" data-ar="إضافة">Add</button>
                                </li>
                                <li>
                                    <a href="#" class="link link-gray" data-bs-dismiss="modal"
                                        data-en="Cancel" data-ar="إلغاء">Cancel</a>
                                </li>
                            </ul>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </form>
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->
