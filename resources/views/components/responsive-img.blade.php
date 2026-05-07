@props([
    'src' => '',
    'alt' => '',
    'sizes' => '(max-width: 600px) 100vw, (max-width: 1024px) 50vw, 800px',
    'widths' => [400, 800, 1200, 1600],
    'default' => 800,
    'eager' => false,
    'priority' => false,
])

@php
    // Convert absolute storage URLs (asset('storage/...')) to a relative path the resize route accepts.
    $rawSrc = $src;
    $appUrl = rtrim(config('app.url', ''), '/');
    $rel = $src;
    if ($appUrl && str_starts_with($rel, $appUrl)) {
        $rel = substr($rel, strlen($appUrl));
    }
    $rel = ltrim((string) $rel, '/');

    $isLocalStorage = str_starts_with($rel, 'storage/');
    $ext = strtolower(pathinfo(parse_url($rel, PHP_URL_PATH) ?? $rel, PATHINFO_EXTENSION));
    $resizable = $isLocalStorage && in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true);

    if ($resizable) {
        $relForRoute = $rel;
        $build = fn ($w) => url("/img/w-{$w}/{$relForRoute}");
        $srcset = collect($widths)->map(fn ($w) => $build($w) . ' ' . $w . 'w')->implode(', ');
        $defaultSrc = $build($default);
        $lqipSrc = $build(20);
    } else {
        $srcset = null;
        $defaultSrc = $rawSrc;
        $lqipSrc = null;
    }
@endphp

<img
    src="{{ $defaultSrc }}"
    @if ($srcset) srcset="{{ $srcset }}" sizes="{{ $sizes }}" @endif
    @if ($lqipSrc) style="background-image:url('{{ $lqipSrc }}');background-size:cover;background-position:center;" @endif
    alt="{{ $alt }}"
    @if ($eager) loading="eager" @else loading="lazy" @endif
    decoding="async"
    @if ($priority) fetchpriority="high" @endif
    onload="this.classList.add('rimg-loaded')"
    {{ $attributes->merge(['class' => 'rimg-blur']) }}
>
