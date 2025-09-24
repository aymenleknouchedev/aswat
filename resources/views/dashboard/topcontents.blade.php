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

                            <!-- ✅ رأس الصفحة -->
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

                        <!-- ✅ Search Form -->
                        <div class="mt-4">
                            <form id="topContentSearchForm" class="mb-2">
                                <div class="row">
                                    <div class="col-12 row g-2">
                                        <div class="col-3">
                                            <input type="text" name="search_all" id="searchAllInput" class="form-control"
                                                placeholder="ابحث في جميع المحتويات...">
                                        </div>
                                        <div class="col-3">
                                            <select name="section_filter" id="sectionFilter" class="form-select">
                                                <option value="">{{ __('اختر القسم') }}</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">
                                                        {{ $section->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <!-- ✅ Left: Recent Contents / Search Results -->
                                <div class="col-6">
                                    <ul id="recentContentsList" class="list-group custom-scroll"
                                        style="direction: rtl; max-height: 500px; overflow-y: auto;">
                                        @foreach ($recentContents as $content)
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <span>{{ $content->title }}</span>
                                                @if (count($topContents) < 10)
                                                <a href="#" class="btn btn-link btn-sm add-content-btn"
                                                   data-id="{{ $content->id }}">
                                                    <em class="icon ni ni-plus text-secondary"></em>
                                                </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- ✅ Right: Top Contents -->
                                <div class="col-6">
                                    <ul id="sortable-list" class="list-group">
                                        @foreach ($topContents as $id => $item)
                                            <li class="list-group-item d-flex align-items-center justify-content-between"
                                                data-id="{{ $id }}">
                                                <span>📝 {{ $item }}</span>
                                                <form method="POST" class="d-inline"
                                                    action="{{ route('dashboard.topcontents.destroy', $id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0">
                                                        <em class="icon ni ni-trash"></em>
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

                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        new Sortable(document.getElementById('sortable-list'), {
            animation: 150,
            ghostClass: 'bg-light'
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
                            ${data.length < 10 ? `
                            <a href="#" class="btn btn-sm btn-link add-content-btn" data-id="${item.id}">
                                <em class="icon ni ni-plus text-secondary"></em>
                            </a>
                            ` : ''}
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
                                    <span>📝 ${title}</span>
                                    <form method="POST" action="{{ url('/dashboard/top-contents') }}/${id}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('هل أنت متأكد من حذف هذا المحتوى؟')">
                                            <em class="icon ni ni-trash"></em>
                                        </button>
                                    </form>
                                `;
                                document.getElementById("sortable-list").prepend(li);
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
        
        bindAddButtons();
    });
</script>
