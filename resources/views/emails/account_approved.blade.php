<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Approved - Bangladesh Angels Network</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #1E293B;
            padding: 30px 20px;
            text-align: center;
        }
        .header img {
            max-width: 180px;
            height: auto;
        }
        .content {
            padding: 30px;
        }
        h1 {
            color: #1E293B;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            margin-bottom: 16px;
            color: #4B5563;
        }
        .button {
            display: inline-block;
            background-color: #1E293B;
            color: white !important;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6B7280;
        }
        .highlight {
            font-weight: bold;
            color: #1E293B;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="data:image/png;base64,{{ $logoData }}" alt="Bangladesh Angels Network Logo">
        </div>
        <div class="content">
            <h1>Your Account is Approved!</h1>
            <p>Dear {{ $user->name }},</p>
            <p>Congratulations! Your Bangladesh Angels Network account has been <span class="highlight">reviewed and approved</span>. You now have access to our exclusive network of investors and startups.</p>
            <p>As a valued member of our community, you can now:</p>
            <ul>
                <li>Explore investment opportunities</li>
                <li>Connect with other angel investors</li>
                <li>Access our exclusive resources and events</li>
                <li>Participate in funding rounds</li>
            </ul>
            <p>To get the most out of your membership, please select a plan that fits your investment goals:</p>
            <div style="text-align: center;">
                <a href="{{ route('plans') }}" class="button">View Membership Plans</a>
            </div>
            <p>If you have any questions, please don't hesitate to contact our support team.</p>
            <p>Welcome aboard!</p>
            <p>The Bangladesh Angels Network Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Bangladesh Angels Network. All rights reserved.</p>
        </div>
    </div>
</body>
</html>