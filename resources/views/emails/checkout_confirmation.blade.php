<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table align="center" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; background: #fff; border-radius: 8px; overflow: hidden; margin-top: 20px;">
        <!-- Header -->
        <tr>
            <td style="background: #00796b; padding: 20px; text-align: center;">
                <img src="{{ asset('logo.webp') }}" alt="BAN Logo" style="height: 50px;">
            </td>
        </tr>
        
        <!-- Body -->
        <tr>
            <td style="padding: 30px;">
                <p style="font-size: 16px; color: #333; margin: 0;">Dear {{ $user->name }},</p>
                <p style="font-size: 14px; color: #555; margin-top: 10px; line-height: 1.6;">
                    You've successfully chosen the <strong>{{ $plan }}</strong> plan on our platform. Here are the details:
                </p>

                <table style="width: 100%; margin: 20px 0; border-collapse: collapse;">
                    <tr>
                        <td style="font-size: 14px; color: #333; font-weight: bold; padding: 8px;">Plan:</td>
                        <td style="font-size: 14px; color: #555; padding: 8px;">{{ $plan }}</td>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <td style="font-size: 14px; color: #333; font-weight: bold; padding: 8px;">Amount:</td>
                        <td style="font-size: 14px; color: #555; padding: 8px;">${{ number_format($price, 2) }}</td>
                    </tr>
                </table>

                <p style="font-size: 14px; color: #555; margin: 0; line-height: 1.6;">
                    We’ve sent this email to confirm your subscription. If you have any questions, feel free to reply to this email.
                </p>

                <p style="font-size: 14px; color: #555; margin-top: 20px; line-height: 1.6;">
                    Best regards,<br>
                    <strong>BAN Team</strong>
                </p>
            </td>
        </tr>
        
        <!-- Footer -->
        <tr>
            <td style="background: #f4f4f4; padding: 20px; text-align: center; font-size: 12px; color: #777;">
                <p style="margin: 0;">© 2024 Bangladesh Angels, all rights reserved</p>
                <p style="margin: 5px 0;">Telephone +8801823998877 | hello@ban.bd</p>
            </td>
        </tr>
    </table>
</body>
</html>
