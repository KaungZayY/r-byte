<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You're Invited to Join Our Team</title>
    <style>
        /* Basic Email Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            color: #333;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            width: 100%;
        }
        .email-container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .email-header {
            text-align: center;
            background-color: #4CAF50;
            padding: 10px 0;
            color: #ffffff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .email-content {
            padding: 20px;
            font-size: 16px;
            line-height: 1.5;
        }
        .email-footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777777;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>You're Invited!</h1>
        </div>
        <div class="email-content">
            <p>Hello {{ $recipient_name }},</p>
            <p>{{ $sender_name }} has invited you to join the <strong>{{ $team_name }}</strong> team on our platform.</p>
            <p>Click the button below to accept the invitation and join the team:</p>
            <p><a href="{{ $url }}" class="button">Join Team</a></p>
            <p>If you did not expect this invitation, you can ignore this email.</p>
            <p>Thank you</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
