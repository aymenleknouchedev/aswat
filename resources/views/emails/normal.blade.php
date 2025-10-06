<h2>Hello,</h2>

<div style="font-family: Arial, sans-serif; line-height: 1.6; font-size: 15px;">
    {!! $body !!}
</div>

@if(!empty($files) && count($files) > 0)
    <hr>
    <p><strong>Attached Files:</strong></p>
    <ul>
        @foreach ($files as $file)
            <li><a href="{{ $file }}">{{ $file }}</a></li>
        @endforeach
    </ul>
@endif

<p style="margin-top:20px;">
    Thank you,<br>
    <strong>The Team</strong>
</p> --}}
