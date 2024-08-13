<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-container">
        @if ($messageType === 'successful')
            <h1>Success</h1>
            <p>You have joined the team: <strong>{{ $teamName }}</strong>.</p>
            <a href="{{ url('/dashboard') }}" class="btn">Go to Dashboard</a>
        @elseif ($messageType === 'invalid')
            <h1>Invalid Link</h1>
            <p>Sorry, this invitation link is invalid or has expired.</p>
            <a href="{{ url('/') }}" class="btn">Go to Homepage</a>
        @elseif ($messageType === 'already_member')
            <h1>Already a Member</h1>
            <p>You are already a member of the team: <strong>{{ $teamName }}</strong>.</p>
            <a href="{{ url('/dashboard') }}" class="btn">Go to Dashboard</a>
        @else
            <h1>Unknown Status</h1>
            <p>We could not process your request. Please try again later.</p>
        @endif
    </div>
</body>
</html>
