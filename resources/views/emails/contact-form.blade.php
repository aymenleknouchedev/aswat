<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>رسالة جديدة من نموذج الاتصال</title>
</head>
<body style="margin:0;padding:24px;background:#f5f6f8;font-family:Arial,Helvetica,sans-serif;color:#1f2a44;direction:rtl;text-align:right;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:640px;margin:0 auto;background:#fff;border-radius:8px;border:1px solid #e5e9f2;overflow:hidden;">
        <tr>
            <td style="background:#6576ff;color:#fff;padding:18px 24px;font-size:18px;font-weight:700;">
                رسالة جديدة من نموذج الاتصال
            </td>
        </tr>
        <tr>
            <td style="padding:24px;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;font-size:14px;">
                    <tr>
                        <td style="padding:8px 0;width:120px;color:#7a8aa3;">الاسم</td>
                        <td style="padding:8px 0;font-weight:600;">{{ $senderName }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0;color:#7a8aa3;">البريد الإلكتروني</td>
                        <td style="padding:8px 0;"><a href="mailto:{{ $senderEmail }}" style="color:#6576ff;text-decoration:none;">{{ $senderEmail }}</a></td>
                    </tr>
                    @if ($senderPhone)
                    <tr>
                        <td style="padding:8px 0;color:#7a8aa3;">الهاتف</td>
                        <td style="padding:8px 0;">{{ $senderPhone }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding:8px 0;color:#7a8aa3;">الموضوع</td>
                        <td style="padding:8px 0;font-weight:600;">{{ $subjectLine }}</td>
                    </tr>
                </table>

                <hr style="margin:18px 0;border:0;border-top:1px solid #eef1f6;">

                <div style="font-size:14px;line-height:1.8;white-space:pre-wrap;">{!! nl2br(e($body)) !!}</div>
            </td>
        </tr>
        <tr>
            <td style="background:#fafbff;padding:12px 24px;font-size:12px;color:#7a8aa3;border-top:1px solid #eef1f6;">
                للرد على المرسل، استخدم زر «رد» في بريدك — سيُرسل مباشرةً إلى <strong>{{ $senderEmail }}</strong>.
            </td>
        </tr>
    </table>
</body>
</html>
