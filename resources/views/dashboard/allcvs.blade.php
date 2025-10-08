@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع السير الذاتية')

@section('content')
<div class="nk-app-root">
    <div class="nk-main">
        @include('dashboard.components.sidebar')

        <div class="nk-wrap">
            @include('dashboard.components.header')

            <div class="nk-content">
                <div class="container">

                    <div class="nk-block nk-block-lg">
                        <!-- Header -->
                        <div class="nk-block-head mb-4">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title fw-bold text-primary" data-en="All CVs" data-ar="جميع السير الذاتية">
                                    <em class="icon ni ni-briefcase me-1"></em> جميع السير الذاتية
                                </h4>
                                <p class="text-muted" data-en="Manage all CVs from here" data-ar="قم بإدارة جميع السير الذاتية من هنا">
                                    قم بإدارة جميع السير الذاتية من هنا
                                </p>
                            </div>
                        </div>

                        <!-- Success / Error Messages -->
                        @if (session('success'))
                            <div class="alert alert-success alert-icon mb-3">
                                <em class="icon ni ni-check-circle"></em>
                                <span>{{ session('success') ?? 'تمت العملية بنجاح' }}</span>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-icon mb-3">
                                <em class="icon ni ni-cross-circle"></em>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error ?? 'حدث خطأ ما' }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="modal fade" id="viewMessageModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" data-ar="الرسالة" data-en="Message">الرسالة</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p id="cvMessageContent" class="text-dark"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" data-ar="إغلاق" data-en="Close">إغلاق</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CVs Table -->
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <form method="GET" action="{{ route('dashboard.join-team') }}" class="row g-2">
                                    <div class="col-md-6 col-12">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            class="form-control"
                                            placeholder="ابحث عن تصنيف..."
                                            data-en="Search for category..."
                                            data-ar="ابحث عن تصنيف...">
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <select name="status" class="form-select">
                                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                            <option value="checked" {{ request('status') === 'checked' ? 'selected' : '' }}>تم التحقق</option>
                                            <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>مقبول</option>
                                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <select name="reason" class="form-select">
                                            <option value="" {{ request('reason') === null ? 'selected' : '' }} data-ar="جميع الوظائف" data-en="All Jobs">جميع الوظائف</option>
                                            <option value="journalist" {{ request('reason') === 'journalist' ? 'selected' : '' }} data-ar="صحفي" data-en="Journalist">صحفي</option>
                                            <option value="infographic" {{ request('reason') === 'infographic' ? 'selected' : '' }} data-ar="أنفوغراف/ مركّب فيديو" data-en="Infographic/ Video Composite">أنفوغراف/ مركّب فيديو</option>
                                            <option value="voiceover" {{ request('reason') === 'voiceover' ? 'selected' : '' }} data-ar="معلّق صوتي" data-en="Voiceover">معلّق صوتي</option>
                                            <option value="audiovisual" {{ request('reason') === 'audiovisual' ? 'selected' : '' }} data-ar="صانع محتوى سمعي بصري" data-en="Audiovisual Content Creator">صانع محتوى سمعي بصري</option>
                                            <option value="translator" {{ request('reason') === 'translator' ? 'selected' : '' }} data-ar="مترجم" data-en="Translator">مترجم</option>
                                            <option value="proofreader" {{ request('reason') === 'proofreader' ? 'selected' : '' }} data-ar="مدقّق لغوي" data-en="Proofreader">مدقّق لغوي</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 col-6">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <em class="icon ni ni-search"></em>
                                        </button>
                                    </div>
                                    <div class="col-md-1 col-6">
                                        <a href="{{ route('dashboard.join-team') }}" class="btn btn-light w-100">
                                            <em class="icon ni ni-undo"></em>
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <div class="card-inner p-0">
                                <table class="table table-orders mb-0">
                                    <thead class="tb-odr-head bg-light">
                                        <tr class="tb-odr-item">
                                            <th data-ar="الاسم الكامل" data-en="full name">الإسم الكامل</th>
                                            <th data-ar="البريد الإلكتروني" data-en="email">البريد الإلكتروني</th>
                                            <th data-ar="الرسالة" data-en="message">الرسالة</th>
                                            <th data-ar="السيرة الذاتية" data-en="CV">السيرة الذاتية</th>
                                            <th data-ar="تاريخ الإرسال" data-en="submission date">تاريخ الإرسال</th>
                                            <th data-ar="الحالة" data-en="status">الحالة</th>
                                            <th data-ar="الوظيفة" data-en="job" class="text-center">الوظيفة</th>
                                            <th data-ar="الإجراءات" data-en="Actions" class="text-center">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tb-odr-body">
                                        @forelse ($cvs as $cv)
                                            <tr class="tb-odr-item">
                                                <td><strong>{{ $cv->fullname }}</strong></td>
                                                <td class="text-muted">{{ $cv->email }}</td>
                                                <td>{{ Str::limit($cv->message, 50) }}</td>
                                                <td>
                                                    <a href="{{ $cv->cv }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <em class="icon ni ni-file"></em>
                                                    </a>
                                                </td>
                                                <td>{{ $cv->created_at->format('Y-m-d H:i') }}</td>
                                                
                                                <td>
                                                    <select class="form-select form-select-sm status-select" data-id="{{ $cv->id }}">
                                                        <option value="pending" {{ $cv->status == 'pending' ? 'selected' : '' }}
                                                            data-ar="قيد الانتظار" data-en="Pending">
                                                            قيد الانتظار
                                                        </option>
                                                        <option value="checked" {{ $cv->status == 'checked' ? 'selected' : '' }}
                                                            data-ar="تم التحقق" data-en="Checked">
                                                            تم التحقق
                                                        </option>
                                                        <option value="accepted" {{ $cv->status == 'accepted' ? 'selected' : '' }}
                                                            data-ar="مقبول" data-en="Accepted">
                                                            مقبول
                                                        </option>
                                                        <option value="rejected" {{ $cv->status == 'rejected' ? 'selected' : '' }}
                                                            data-ar="مرفوض" data-en="Rejected">
                                                            مرفوض
                                                        </option>
                                                    </select>
                                                </td>

                                                <td class="text-center">{{ ucfirst($cv->reason) }}</td>

                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm view-message-btn" data-message="{{ $cv->message }}">
                                                        <em class="icon ni ni-eye"></em>
                                                    </button>
                                                    <a href="{{ route('dashboard.mail.send-mail', ["email" => $cv->email]) }}" class="btn btn-success btn-sm">
                                                        <em class="icon ni ni-mail"></em>
                                                    </a>
                                                    <form action="{{ route('dashboard.join-team.delete', $cv->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <em class="icon ni ni-trash"></em>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-3">
                                                    <em class="icon ni ni-info me-1"></em> لا توجد سير ذاتية
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $cvs->links() }}
                        </div>
                    </div>
                </div>
            </div>

            @include('dashboard.components.footer')
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.view-message-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let message = this.getAttribute('data-message');
                document.getElementById('cvMessageContent').innerText = message;
                let modal = new bootstrap.Modal(document.getElementById('viewMessageModal'));
                modal.show();
            });
        });


        document.querySelectorAll('.status-select').forEach(function(select) {
            select.addEventListener('change', function() {
                let id = this.getAttribute('data-id');
                let status = this.value;

                fetch("{{ url('/dashboard/cv') }}/" + id + "/update-status", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert(data.error || "Something went wrong");
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Failed to update status");
                });
            });
        });
    });
</script>
