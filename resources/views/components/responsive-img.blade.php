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
    } else {
        $srcset = null;
        $defaultSrc = $rawSrc;
    }
@endphp

<img
    src="{{ $defaultSrc }}"
    @if ($srcset) srcset="{{ $srcset }}" sizes="{{ $sizes }}" @endif
    alt="{{ $alt }}"
    @if ($eager) loading="eager" @else loading="lazy" @endif
    decoding="async"
    @if ($priority) fetchpriority="high" @endif
    {{ $attributes }}
>
