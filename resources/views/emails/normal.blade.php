<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #f9fafc;
      color: #333;
      margin: 0;
      padding: 0;
    }
    .email-container {
      max-width: 650px;
      margin: 40px auto;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 3px 12px rgba(0,0,0,0.08);
      overflow: hidden;
      border: 1px solid #e6e8ec;
    }
    .header {
      background-color: #1a237e;
      color: #ffffff;
      padding: 20px 30px;
      text-align: center;
    }
    .header h2 {
      margin: 0;
      font-size: 24px;
      letter-spacing: 0.5px;
    }
    .body {
      padding: 30px;
      line-height: 1.7;
      font-size: 15px;
      color: #444;
    }
    .attachments {
      margin-top: 30px;
      border-top: 1px solid #eee;
      padding-top: 20px;
    }
    .attachments ul {
      padding-left: 20px;
      margin: 10px 0 0;
    }
    .attachments a {
      color: #1a73e8;
      text-decoration: none;
      font-weight: 500;
    }
    .attachments a:hover {
      text-decoration: underline;
    }
    .footer {
      border-top: 1px solid #e6e8ec;
      text-align: center;
      padding: 20px 30px;
      background-color: #f4f6fa;
      color: #666;
      font-size: 14px;
    }
    .footer strong {
      color: #1a237e;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <h2>Hello,</h2>
    </div>

    <div class="body">
      {!! $body !!}

      @if(!empty($files) && count($files) > 0)
        <div class="attachments">
          <h4 style="margin-bottom: 8px; color: #1a237e;">Attachments</h4>
          <ul>
            @foreach ($files as $index => $file)
              <li>
                <a href="{{ $file }}" target="_blank">
                  Attachment {{ $index + 1 }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>

    <div class="footer">
      <p>
        Thank you,<br>
        <strong>Asswat Team</strong>
      </p>
    </div>
  </div>
</body>
</html>
