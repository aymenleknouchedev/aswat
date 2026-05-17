<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $body ? '' : 'رسالة' }}</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; direction: rtl; text-align: right; color:#222; line-height:1.7;">
    <div style="white-space: pre-wrap;">{!! nl2br(e($body)) !!}</div>

    @if (!empty($files))
        <hr style="margin: 24px 0; border:0; border-top:1px solid #ddd;">
        <h4 style="margin:0 0 12px;">المرفقات</h4>
        <ul style="padding-inline-start: 18px;">
            @foreach ($files as $file)
                <li><a href="{{ $file }}" target="_blank" rel="noopener">{{ $file }}</a></li>
            @endforeach
        </ul>
    @endif
</body>
</html>
