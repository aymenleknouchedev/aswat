<h2>Hello,</h2>

<div style="font-family: Arial, sans-serif; line-height: 1.6; font-size: 15px;">
    {!! $body !!}
</div>
{{-- 
@if(!empty($attachments) && count($attachments) > 0)
    <hr>
    <p><strong>Attached Files:</strong></p>
    <ul>
        @foreach ($attachments as $file)
            <li>{{ $file->file_name }}</li>
        @endforeach
    </ul>
@endif

<p style="margin-top:20px;">
    Thank you,<br>
    <strong>The Team</strong>
</p> --}}
