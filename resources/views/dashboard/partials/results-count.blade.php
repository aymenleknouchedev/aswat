@if (!$medias->isEmpty())
    <p class="text-soft">
        <span>عرض</span>
        <strong>{{ $medias->firstItem() }} - {{ $medias->lastItem() }}</strong>
        <span>من</span>
        <strong>{{ $medias->total() }}</strong>
        <span>نتيجة</span>
    </p>
@endif