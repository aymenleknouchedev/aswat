<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Essential for mobile responsiveness -->
  <meta name="color-scheme" content="light dark">
  <meta name="supported-color-schemes" content="light dark">
  <title>Asswat Team</title>
  <style>
    /* Base Reset & Typography */
    body {
      font-family: 'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, 'Helvetica Neue', Arial, sans-serif;
      background-color: #f9fafc;
      color: #1a1a1a; /* Higher contrast for better readability:cite[2] */
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
      mso-line-height-rule: exactly; /* Improves consistency in Outlook */
    }
    .email-container {
      max-width: 600px; /* Standard width for email clients:cite[3] */
      margin: 40px auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.07);
      overflow: hidden;
      border: 1px solid #e6e8ec;
    }

    /* Header with subtle gradient */
    .header {
      background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
      color: #ffffff;
      padding: 40px 30px 35px 30px;
      text-align: center;
    }
    .header h2 {
      margin: 0;
      font-size: 28px;
      font-weight: 600;
      letter-spacing: -0.2px;
    }

    /* Body with improved spacing and hierarchy */
    .body {
      padding: 40px 35px;
      line-height: 1.7;
      font-size: 16px;
      color: #444;
    }
    .body p {
      margin-top: 0;
      margin-bottom: 20px;
    }

    /* Modernized Attachment Section */
    .attachments {
      margin-top: 35px;
      border-top: 1px solid #f0f0f0;
      padding-top: 25px;
    }
    .attachments h4 {
      margin-bottom: 16px;
      color: #1a237e;
      font-size: 17px;
      font-weight: 600;
    }
    .attachment-list {
      list-style: none;
      padding-left: 0;
      margin: 0;
    }
    .attachment-item {
      display: flex;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #f8f8f8;
    }
    .attachment-item:last-child {
      border-bottom: none;
    }
    .attachment-icon {
      margin-right: 12px;
      color: #1a73e8;
      font-weight: bold;
    }
    .attachment-link {
      color: #1a73e8;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s ease;
    }
    .attachment-link:hover {
      color: #0d5bbe;
      text-decoration: underline;
    }

    /* Refined Footer */
    .footer {
      border-top: 1px solid #e6e8ec;
      text-align: center;
      padding: 30px;
      background-color: #f8f9fa; /* Slightly lighter for visual separation */
      color: #666;
      font-size: 14px;
      line-height: 1.6;
    }
    .footer strong {
      color: #1a237e;
      font-weight: 600;
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
      .email-container, .body, .footer {
        background-color: #1a1a1a !important;
        color: #e0e0e0 !important;
        border-color: #333 !important;
      }
      .body, .footer {
        color: #e0e0e0 !important;
      }
      .attachments {
        border-top-color: #333 !important;
      }
      .attachment-item {
        border-bottom-color: #333 !important;
      }
    }

    /* Mobile Responsiveness */
    @media screen and (max-width: 650px) {
      .email-container {
        margin: 20px auto;
        border-radius: 0;
        max-width: 100% !important;
        width: 100% !important;
      }
      .header, .body, .footer {
        padding-left: 25px !important;
        padding-right: 25px !important;
      }
      .header {
        padding-top: 30px !important;
        padding-bottom: 25px !important;
      }
      .header h2 {
        font-size: 24px !important;
      }
      .body {
        font-size: 15px !important;
        padding-top: 30px !important;
        padding-bottom: 30px !important;
      }
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
          <h4>Attachments</h4>
          <ul class="attachment-list">
            @foreach ($files as $index => $file)
              <li class="attachment-item">
                <span class="attachment-icon">📎</span>
                <a href="{{ $file }}" target="_blank" class="attachment-link">
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