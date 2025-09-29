@extends('layouts.index')

@section('title', 'أصوات جزائرية | صور')

@section('content')

<style>
    @media (max-width: 768px) {
        .web {
            display: none;
        }
    }
    @media (min-width: 768px) {
        .mobile {
            display: none;
        }
    }
    .custom-article-title {
        font-size: 32px;
        font-family: asswat-bold;
        color: #222;
        line-height: 1.3;
        text-align: right;
        margin-bottom: 20px;
    }
    .custom-article-image-wrapper {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .custom-article-image-wrapper img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }
    .custom-article-summary {
        font-size: 18px;
        color: #555;
        font-style: italic;
        font-family: asswat-light;
        margin-bottom: 20px;
        text-align: right;
    }
    .custom-article-content {
        font-size: 17px;
        color: #333;
        line-height: 1.7;
        font-family: asswat-medium;
        text-align: right;
    }
</style>

<div class="web">
    @include('user.components.fixed-nav')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1 class="custom-article-title">
                    يوم حزين لكرة القدم.. دموع وانهيارات في وداع ديوغو جوتا الأخير
                </h1>

                <div class="custom-article-image-wrapper">
                    <img src="./user/assets/images/b1.jpeg" alt="Feature Algeria">
                </div>

                <div class="custom-article-summary">
                    أعلنت الولايات المتحدة، الجمعة، فرض عقوبات غير مسبوقة على الرئيس الكوبي ميغيل دياز-كانيل، بعد أربع سنوات على تظاهرات مناهضة للحكومة.
                </div>

                <div class="custom-article-content">
                    هذا اليوم شهد أحداثاً مؤثرة في عالم كرة القدم، حيث ودع اللاعب ديوغو جوتا الملاعب وسط دموع وانهيارات من زملائه والجماهير. المشهد كان مؤثراً للغاية، إذ عبّر الجميع عن حزنهم لفراق أحد أبرز نجوم الفريق. في سياق آخر، تواصل الولايات المتحدة فرض عقوبات على بعض الدول، مما يثير جدلاً واسعاً في الأوساط السياسية والرياضية على حد سواء.
                </div>

            </div>
        </div>
    </div>

    @include('user.components.footer')
</div>

<div class="mobile">
</div>

@endsection
