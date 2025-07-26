<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Your Property Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3B82F6;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .button {
            display: inline-block;
            background-color: #3B82F6;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #2563EB;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Verify Your Property Application</h1>
    </div>
    
    <div class="content">
        <p>Hello {{ $application->full_name }},</p>
        
        <p>Thank you for submitting your property application to HYSLOP. To complete your application process, please verify your email address by clicking the button below:</p>
        
        <div style="text-align: center;">
            <a href="{{ route('property-applications.verify', $application->verification_token) }}" class="button">
                Verify Application
            </a>
        </div>
        
        <p>If the button above doesn't work, you can copy and paste this link into your browser:</p>
        <p style="word-break: break-all; color: #3B82F6;">
            {{ route('property-applications.verify', $application->verification_token) }}
        </p>
        
        <p>This verification link will expire once used. If you didn't submit a property application, please ignore this email.</p>
        
        <div class="footer">
            <p>Best regards,<br>The HYSLOP Team</p>
            <p>If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>
</html> 