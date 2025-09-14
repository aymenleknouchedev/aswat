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
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th data-en="Preview" data-ar="معاينة">Preview</th>
                                                    <th data-en="Type" data-ar="النوع">Type</th>
                                                    <th data-en="Created At" data-ar="تاريخ الإنشاء">Created At</th>
                                                    <th data-en="Actions" data-ar="إجراءات">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($medias as $media)
                                                    <tr>
                                                        <td style="width:150px; height:150px;">
                                                            @if (
                                                                $media->media_type === 'image/jpeg' ||
                                                                    $media->media_type === 'image/png' ||
                                                                    $media->media_type === 'image/gif' ||
                                                                    $media->media_type === 'image/bmp' ||
                                                                    $media->media_type === 'image/svg+xml' ||
                                                                    $media->media_type === 'url')
                                                                <img class="w-100" src="{{ $media->path }}"
                                                                    alt="Media Preview">
                                                            @elseif ($media->media_type === 'video/mp4' || $media->media_type === 'video/quicktime')
                                                                <video class="w-100" controls>
                                                                    <source src="{{ $media->path }}" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            @elseif ($media->media_type === 'audio/mpeg' || $media->media_type === 'audio/wav')
                                                                <audio class="w-100" controls>
                                                                    <source src="{{ $media->path }}" type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            @else
                                                                <span data-en="Unknown" data-ar="غير معروف">Unknown</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $media->media_type }}
                                                        </td>
                                                        <td>
                                                            {{ $media->created_at->format('Y-m-d H:i') }}
                                                        </td>
                                                        <td>
                                                            <a data-bs-toggle="modal" href="#editMedia" aria-label="Edit"
                                                                class="btn btn-sm btn-light-grey">
                                                                <em class="icon ni ni-edit"></em>
                                                                <span data-en="Edit" data-ar="تعديل">Edit</span>
                                                            </a>
                                                            @if ($media->contents()->count() > 0)
                                                                <button class="btn btn-sm btn-light-grey" disabled
                                                                    title="Cannot delete: associated with content">
                                                                    <em class="icon ni ni-cross"></em>
                                                                    <span data-en="Delete" data-ar="حذف">Delete</span>
                                                                </button>
                                                            @else
                                                                <form
                                                                    action="{{ route('dashboard.media.destroy', $media->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-light-grey delete-btn btn-delete"
                                                                        title="Delete">
                                                                        <em class="icon ni ni-cross"></em>
                                                                        <span data-en="Delete" data-ar="حذف">Delete</span>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <style>
                                            .btn-delete:hover {
                                                background-color: #dc3545 !important;
                                                color: #fff !important;
                                                border-color: #dc3545 !important;
                                            }
                                        </style>
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $medias->links() }}
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
