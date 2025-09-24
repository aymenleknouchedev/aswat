@extends('layouts.admin')

@section('title', 'أصوات جزائرية | جميع الصفحات')

@section('content')
    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')

            <div class="nk-wrap">
                @include('dashboard.components.header')

                <div class="nk-content">
                    <div class="container">
                        <div class="nk-block nk-block-lg">

                            <div class="nk-block-head">
                                <div class="nk-block-head-content d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="nk-block-title" data-en="First Management" data-ar="إدارة الأولى">
                                            إدارة الأولى
                                        </h4>
                                        <p data-en="List of all top contents." data-ar="قائمة بجميع المحتويات المميزة.">
                                            قائمة بجميع المحتويات المميزة.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-fill alert-success alert-icon">
                                    <em class="icon ni ni-check-circle"></em>
                                    <span class="translatable" data-ar="تمت العملية بنجاح"
                                        data-en="Operation completed successfully">
                                        {{ session('success') ?? 'تمت العملية بنجاح' }}
                                    </span>
                                </div>
                            @endif

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
                        </div>
                        
                        <div class="mt-4">
                            <form id="topContentSearchForm" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-md-6 col-lg-3">
                                        <input type="text" name="search_all" id="searchAllInput" 
                                            class="form-control"
                                            placeholder="ابحث في جميع المحتويات...">
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <select name="section_filter" id="sectionFilter" class="form-select">
                                            <option value="">{{ __('اختر القسم') }}</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <div class="row g-3">
                                <!-- Left -->
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-body p-0">
                                            <ul id="recentContentsList" class="list-group custom-scroll"
                                                style="direction: rtl; max-height: 500px; overflow-y: auto;">
                                                @foreach ($recentContents as $content)
                                                    <li class="list-group-item d-flex align-items-center justify-content-between">
                                                        <span style="font-size: 12px">{{ $content->title }}</span>
                                                        @if (count($topContents) < 10)
                                                            <a href="#" class="btn btn-link btn-sm add-content-btn p-0" data-id="{{ $content->id }}">
                                                                <em class="icon ni ni-plus text-secondary"></em>
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right -->
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-body p-0">
                                            <ul id="sortable-list" class="list-group">
                                                @foreach ($topContents as $id => $item)
                                                    <li class="list-group-item d-flex align-items-center justify-content-between"
                                                        data-id="{{ $id }}">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-primary d-inline-flex align-items-center justify-content-center"
                                                                style="width: 28px; height: 28px; border-radius: 50%; font-size: 14px;">
                                                                {{ $loop->iteration }}
                                                            </span>
                                                            <span style="font-size: 13px">{{ $item }}</span>
                                                        </div>
                                                        <form method="POST" 
                                                            class="d-inline mb-0 delete-top-content-form" 
                                                            data-id="{{ $id }}" 
                                                            action="{{ route('dashboard.topcontents.destroy', $id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link text-danger p-0">
                                                                <em class="icon ni ni-minus"></em>
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endforeach
                                            </ul>
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

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        function updateBadges() {
            document.querySelectorAll("#sortable-list li").forEach((li, index) => {
                let badge = li.querySelector(".badge");
                if (badge) badge.textContent = index + 1;
            });
        }

        new Sortable(document.getElementById('sortable-list'), {
            animation: 150,
            ghostClass: 'bg-light',
            onEnd: function () {
                let ids = [];
                document.querySelectorAll("#sortable-list li").forEach((li, index) => {
                    ids.push(li.getAttribute("data-id"));
                });

                updateBadges();

                fetch("{{ route('dashboard.topcontents.updateOrder') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(res => res.json())
                .then(response => {
                    if (!response.success) {
                        alert("⚠️ لم يتم حفظ الترتيب!");
                    }
                })
                .catch(err => {
                    alert("⚠️ حدث خطأ أثناء حفظ الترتيب.");
                    console.error(err);
                });
            }
        });

        const form = document.getElementById("topContentSearchForm");
        const resultsDiv = document.getElementById("recentContentsList");
        const originalContents = resultsDiv.innerHTML;

        form.addEventListener("input", function () {
            let formData = new FormData(form);
            let query = new URLSearchParams(formData).toString();

            if (!formData.get("search_all") && !formData.get("section_filter")) {
                resultsDiv.innerHTML = originalContents;
                bindAddButtons();
                return;
            }

            fetch("{{ route('api.search.contents') }}?" + query)
                .then(res => res.json())
                .then(data => {

                    resultsDiv.innerHTML = "";

                    if (data.length === 0) {
                        resultsDiv.innerHTML = `<li class="list-group-item text-muted">❌ لا توجد نتائج.</li>`;
                        return;
                    }

                    data.forEach(item => {
                        let li = document.createElement("li");
                        li.className = "list-group-item d-flex align-items-center justify-content-between";
                        li.innerHTML = `
                            <span>${item.title}</span>
                            <a href="#" class="btn btn-sm btn-link add-content-btn" data-id="${item.id}">
                                <em class="icon ni ni-plus text-secondary"></em>
                            </a>
                        `;
                        resultsDiv.appendChild(li);
                    });

                    bindAddButtons();
                })
                .catch(err => {
                    resultsDiv.innerHTML = `<li class="list-group-item text-danger">⚠️ حدث خطأ أثناء البحث.</li>`;
                    console.error(err);
                });
        });

        function bindAddButtons() {
            document.querySelectorAll(".add-content-btn").forEach(btn => {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();
                    let id = this.dataset.id;

                    fetch("{{ url('/dashboard/top-contents') }}/" + id, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({})
                    })
                        .then(res => res.json().catch(() => ({})))
                        .then(response => {
                            if (response.success) {
                                let id = Object.keys(response.content)[0];
                                let title = response.content[id];

                                let li = document.createElement("li");
                                li.className = "list-group-item d-flex align-items-center justify-content-between";
                                li.setAttribute("data-id", id);
                                li.innerHTML = `
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge badge-primary"></span>
                                        <span>${title}</span>
                                    </div>
                                    <form method="POST" 
                                          action="{{ url('/dashboard/top-contents') }}/${id}" 
                                          class="d-inline mb-0 delete-top-content-form" 
                                          data-id="${id}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0">
                                            <em class="icon ni ni-minus"></em>
                                        </button>
                                    </form>
                                `;

                                this.closest("li").remove();

                                document.getElementById("sortable-list").appendChild(li);

                                updateBadges();
                                bindDeleteButtons();
                            } else {
                                alert(response.error ?? "❌ لم يتمكن من إضافة المحتوى.");
                            }
                        })
                        .catch(err => {
                            alert("⚠️ حدث خطأ أثناء الإضافة.");
                            console.error(err);
                        });
                });
            });
        }

        function bindDeleteButtons() {
            document.querySelectorAll(".delete-top-content-form").forEach(form => {
                form.addEventListener("submit", function (e) {
                    e.preventDefault();

                    let id = this.dataset.id;
                    let url = this.getAttribute("action");
                    let li = this.closest("li");

                    fetch(url, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json",
                        }
                    })
                    .then(res => res.json())
                    .then(response => {
                        if (response.success) {
                            li.style.transition = "opacity 0.3s";
                            li.style.opacity = "0";
                            setTimeout(() => {
                                li.remove();
                                updateBadges();
                            }, 300);
                        } else {
                            alert(response.error ?? "❌ فشل حذف المحتوى.");
                        }
                    })
                    .catch(err => {
                        alert("⚠️ حدث خطأ أثناء الحذف.");
                        console.error(err);
                    });
                });
            });
        }

        bindAddButtons();
        bindDeleteButtons();
        updateBadges();
    });
</script>
