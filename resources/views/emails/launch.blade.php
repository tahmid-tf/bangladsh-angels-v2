<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investor Account Ready</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table align="center" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; background: #fff; border-radius: 8px; overflow: hidden; margin-top: 20px;">
        
        <!-- Header -->
        <tr>
            <td style="background: #00796b; padding: 20px; text-align: center;">
                <h2 style="color: white; margin: 0;">Bangladesh Angels Network</h2>
            </td>
        </tr>
        
        <!-- Body -->
        <tr>
            <td style="padding: 30px;">
                <p style="font-size: 16px; color: #333;">Hello {{ $firstName }},</p>
                
                <p style="font-size: 14px; color: #555;">
                    We’re excited to introduce the <strong>BAN Investor Platform</strong>, designed to make your investing journey smoother, more efficient, and fully integrated.
                    Your account has already been set up, giving you direct access to exclusive startup deals, investor resources, and a growing network of angels across 24+ countries.
                </p>

                <h3 style="color: #00796b;">Your Login Details</h3>
                <p>
                    <strong>Platform Link:</strong> <a href="{{ $platformLink }}" style="color: #00796b;">Login to BAN Platform</a><br>
                    <strong>Username:</strong> {{ $email }}<br>
                    <strong>Temporary Password:</strong> {{ $password }}
                </p>
                <p style="font-size: 14px; color: #555;">
                    <em>For security reasons, we recommend changing your password upon first login.</em>
                </p>

                <h3 style="color: #00796b;">What You Can Do on the BAN Platform</h3>
                <ul style="padding-left: 20px; color: #555;">
                    <li><strong>Discover Startup Deals</strong> – Browse investment opportunities, review pitch decks, and access key insights.</li>
                    <li><strong>Track Your Portfolio</strong> – Stay updated on your investments with founder updates.</li>
                    <li><strong>Join Investor Events</strong> – Get invites to pitch nights, networking sessions, and masterclasses.</li>
                    <li><strong>Request Due Diligence Support</strong> – Access BAN’s research and insights to make informed decisions.</li>
                    <li><strong>Connect with Founders & Investors</strong> – Engage with startup teams and fellow investors globally.</li>
                </ul>

                <p style="font-size: 14px; color: #555;">
                    We built this platform to streamline your investing experience, giving you everything you need in one place.
                </p>

                <p style="font-size: 14px; color: #555;">
                    If you have any questions or need assistance logging in, feel free to reach out. Looking forward to seeing you inside!
                </p>

                <p style="font-size: 14px; font-weight: bold; color: #00796b;">Best regards,</p>
                <p style="font-size: 14px; color: #555;">Bangladesh Angels Network</p>
            </td>
        </tr>
        
        <!-- Footer -->
        <tr>
            <td style="background: #f4f4f4; padding: 20px; text-align: center; font-size: 12px; color: #777;">
                <p style="margin: 0;">© 2025 Bangladesh Angels, all rights reserved</p>
                <p style="margin: 5px 0;">Telephone +8801823998877 | hello@bdangels.co</p>
            </td>
        </tr>
    </table>
</body>
</html>
