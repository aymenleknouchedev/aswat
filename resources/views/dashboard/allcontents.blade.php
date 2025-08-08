@extends('layouts.admin')

@section('title', 'أصوات جزائرية | المحتوى')

@section('content')
    @php

        $fakeContents = [
            [
                'title' => 'تأثير الذكاء الاصطناعي على سوق العمل في 2025',
                'date' => '2025-08-01',
                'author' => 'أحمد العلي',
                'status' => 'Published',
            ],
            [
                'title' => 'أفضل 10 استراتيجيات لتسويق المنتجات عبر الإنترنت',
                'date' => '2025-07-28',
                'author' => 'سارة منصور',
                'status' => 'Draft',
            ],
            [
                'title' => 'دليل شامل لتصميم واجهات المستخدم UI/UX',
                'date' => '2025-07-15',
                'author' => 'ليلى خالد',
                'status' => 'Published',
            ],
            [
                'title' => 'أحدث تقنيات الطاقة المتجددة في الشرق الأوسط',
                'date' => '2025-07-10',
                'author' => 'محمد ناصر',
                'status' => 'Cancelled',
            ],
            [
                'title' => 'كيف تبدأ مشروعك الناشئ برأس مال صغير',
                'date' => '2025-06-30',
                'author' => 'ريم أحمد',
                'status' => 'Published',
            ],
            [
                'title' => 'مستقبل العملات الرقمية بعد تنظيم الأسواق',
                'date' => '2025-06-20',
                'author' => 'عمر ياسين',
                'status' => 'Draft',
            ],
            [
                'title' => 'أسرار كتابة محتوى يجذب العملاء',
                'date' => '2025-06-15',
                'author' => 'نور الهدى',
                'status' => 'Published',
            ],
            [
                'title' => 'تأثير التغير المناخي على الزراعة العربية',
                'date' => '2025-06-05',
                'author' => 'خالد فؤاد',
                'status' => 'Cancelled',
            ],
            [
                'title' => 'أفضل الأدوات لإدارة فريق العمل عن بعد',
                'date' => '2025-05-28',
                'author' => 'هبة حسين',
                'status' => 'Published',
            ],
            [
                'title' => 'كيف تحافظ على أمان بياناتك الشخصية على الإنترنت',
                'date' => '2025-05-15',
                'author' => 'زياد محمود',
                'status' => 'Draft',
            ],
            [
                'title' => 'الذكاء الاصطناعي وتحديات الخصوصية',
                'date' => '2025-05-10',
                'author' => 'مريم سعيد',
                'status' => 'Published',
            ],
            [
                'title' => 'تحليل سوق السيارات الكهربائية',
                'date' => '2025-04-28',
                'author' => 'طارق حمود',
                'status' => 'Published',
            ],
            [
                'title' => 'كيف تبني علامة تجارية ناجحة',
                'date' => '2025-04-20',
                'author' => 'سعاد علي',
                'status' => 'Draft',
            ],
            [
                'title' => 'الاستثمار في العملات المشفرة',
                'date' => '2025-04-15',
                'author' => 'أحمد سامي',
                'status' => 'Cancelled',
            ],
            [
                'title' => 'أهمية التعليم الإلكتروني',
                'date' => '2025-04-05',
                'author' => 'نوران عبد الله',
                'status' => 'Published',
            ],
            [
                'title' => 'تطوير التطبيقات باستخدام Flutter',
                'date' => '2025-03-28',
                'author' => 'يوسف عبد الرحمن',
                'status' => 'Draft',
            ],
            [
                'title' => 'أفضل الممارسات في الأمن السيبراني',
                'date' => '2025-03-15',
                'author' => 'هشام مصطفى',
                'status' => 'Published',
            ],
            [
                'title' => 'التجارة الإلكترونية في الشرق الأوسط',
                'date' => '2025-03-10',
                'author' => 'سلوى حسن',
                'status' => 'Published',
            ],
            [
                'title' => 'تصميم تجربة المستخدم في التطبيقات',
                'date' => '2025-02-28',
                'author' => 'مها جمال',
                'status' => 'Cancelled',
            ],
            [
                'title' => 'أهمية التحليلات البيانية في الأعمال',
                'date' => '2025-02-20',
                'author' => 'عادل سعيد',
                'status' => 'Published',
            ],
            ['title' => 'كيف تبدأ مدونة ناجحة', 'date' => '2025-02-10', 'author' => 'نادية علي', 'status' => 'Draft'],
            [
                'title' => 'أحدث اتجاهات التصميم الجرافيكي',
                'date' => '2025-02-05',
                'author' => 'سمير فوزي',
                'status' => 'Published',
            ],
            [
                'title' => 'فوائد استخدام الحوسبة السحابية',
                'date' => '2025-01-28',
                'author' => 'ياسمين شريف',
                'status' => 'Published',
            ],
            [
                'title' => 'أدوات تحسين محركات البحث SEO',
                'date' => '2025-01-15',
                'author' => 'عمرو فاروق',
                'status' => 'Draft',
            ],
            [
                'title' => 'كيف تدير مشروعك بكفاءة',
                'date' => '2025-01-10',
                'author' => 'هدى محمود',
                'status' => 'Published',
            ],
            [
                'title' => 'تأثير وسائل التواصل الاجتماعي',
                'date' => '2024-12-28',
                'author' => 'رامي عبد',
                'status' => 'Published',
            ],
            [
                'title' => 'أفضل لغات البرمجة في 2025',
                'date' => '2024-12-15',
                'author' => 'سارة كريم',
                'status' => 'Draft',
            ],
            [
                'title' => 'كيفية تحسين إنتاجية فريق العمل',
                'date' => '2024-12-10',
                'author' => 'بلال يوسف',
                'status' => 'Cancelled',
            ],
            [
                'title' => 'أساسيات التسويق الرقمي',
                'date' => '2024-11-28',
                'author' => 'منى عبد الله',
                'status' => 'Published',
            ],
            [
                'title' => 'أهمية البيانات الكبيرة Big Data',
                'date' => '2024-11-20',
                'author' => 'سامر فهد',
                'status' => 'Published',
            ],
            ['title' => 'كيف تتعامل مع ضغط العمل', 'date' => '2024-11-10', 'author' => 'رنا علي', 'status' => 'Draft'],
            [
                'title' => 'تقنيات الواقع الافتراضي VR',
                'date' => '2024-11-05',
                'author' => 'ياسر أحمد',
                'status' => 'Published',
            ],
            [
                'title' => 'مستقبل التعليم عن بعد',
                'date' => '2024-10-28',
                'author' => 'هالة سعيد',
                'status' => 'Published',
            ],
            [
                'title' => 'أفضل استراتيجيات المحتوى لعام 2025',
                'date' => '2024-10-15',
                'author' => 'عبد الله خالد',
                'status' => 'Draft',
            ],
            [
                'title' => 'أهمية الذكاء الاصطناعي في الصحة',
                'date' => '2024-10-10',
                'author' => 'سمية جمال',
                'status' => 'Published',
            ],
        ];
        // Pagination setup
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $total = count($fakeContents);
        $totalPages = ceil($total / $perPage);

        $start = ($currentPage - 1) * $perPage;
        $pagedContents = array_slice($fakeContents, $start, $perPage);
    @endphp

    <div class="nk-app-root">
        <div class="nk-main">
            @include('dashboard.components.sidebar')
            <div class="nk-wrap">
                @include('dashboard.components.header')
                <div class="nk-content">
                    <div class="container-fluid bg-white">
                        <div class="card-inner">

                            <!-- Table Header with Title & Button -->
                            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                <h5 class="mb-0" data-en="All Contents" data-ar="جميع المحتوى">جميع المحتوى</h5>
                                <a href="" class="btn btn-sm btn-outline-primary" data-en="Add New Content"
                                    data-ar="إضافة محتوى جديد">إضافة محتوى جديد</a>
                            </div>

                            <!-- Scrollable Table -->
                            <div style="overflow-x:auto;">
                                <table class="table table-orders">
                                    <thead class="tb-odr-head sticky-top" style="z-index: 10;">
                                        <tr>
                                            <th style="font-weight: bold;" data-en="Title" data-ar="العنوان">العنوان</th>
                                            <th style="font-weight: bold;" data-en="Date" data-ar="التاريخ">التاريخ</th>
                                            <th style="font-weight: bold;" data-en="Author" data-ar="الكاتب">الكاتب</th>
                                            <th style="font-weight: bold;" data-en="Status" data-ar="الحالة">الحالة</th>
                                            <th style="font-weight: bold;" data-en="Actions" data-ar="إجراءات">إجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pagedContents as $content)
                                            <tr>
                                                <td>{{ $content['title'] }}</td>
                                                <td>{{ $content['date'] }}</td>
                                                <td>{{ $content['author'] }}</td>
                                                <td>
                                                    @if ($content['status'] == 'Published')
                                                        <span class="badge badge-dot bg-success" data-en="Published"
                                                            data-ar="منشور">منشور</span>
                                                    @elseif($content['status'] == 'Draft')
                                                        <span class="badge badge-dot bg-warning" data-en="Draft"
                                                            data-ar="مسودة">مسودة</span>
                                                    @elseif($content['status'] == 'Cancelled')
                                                        <span class="badge badge-dot bg-danger" data-en="Cancelled"
                                                            data-ar="ملغي">ملغي</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="tb-odr-btns d-none d-md-inline">
                                                        <a href="#" class="btn btn-sm btn-primary" data-en="View"
                                                            data-ar="عرض">عرض</a>
                                                    </div>
                                                    <div class="dropdown">
                                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown" data-offset="-8,0">
                                                            <em class="icon ni ni-more-h"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                            <ul class="link-list-plain">
                                                                <li><a href="#" class="text-primary" data-en="Edit"
                                                                        data-ar="تعديل">تعديل</a></li>
                                                                <li><a href="#" class="text-primary" data-en="View"
                                                                        data-ar="عرض">عرض</a></li>
                                                                <li><a href="#" class="text-danger" data-en="Delete"
                                                                        data-ar="حذف">حذف</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination Controls -->
                            <nav aria-label="Page navigation" class="mt-3">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item {{ $currentPage <= 1 ? 'disabled' : '' }}">
                                        <a class="page-link" href="?page={{ $currentPage - 1 }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    @for ($i = 1; $i <= $totalPages; $i++)
                                        <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $currentPage >= $totalPages ? 'disabled' : '' }}">
                                        <a class="page-link" href="?page={{ $currentPage + 1 }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
                @include('dashboard.components.footer')
            </div>
        </div>
    </div>
@endsection
