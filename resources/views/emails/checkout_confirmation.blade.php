<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Membership Purchase | Bangladesh Angels Network</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table align="center" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; background: #fff; border-radius: 8px; overflow: hidden; margin-top: 20px;">
        <!-- Header -->
        <tr>
            <td style="background: #00796b; padding: 20px; text-align: center;">
                {{-- <img src="{{ asset('logo.webp') }}" alt="BAN Logo" style="height: 50px;"> --}}
            </td>
        </tr>
        
        <!-- Body -->
        <tr>
            <td style="padding: 30px;">
                <p style="font-size: 16px; color: #333; margin: 0;">Hi {{ $user->name }},</p>
                <p style="font-size: 14px; color: #555; margin-top: 10px; line-height: 1.6;">
                    Thank you for expressing interest in joining the Bangladesh Angels Network Platform. We’re excited to welcome you to a global network of investors, founders, and startup opportunities designed to help you invest smarter and connect meaningfully. <br>
                    <br>
                    <strong>
                        Your Membership Benefits
                    </strong><br><br>
                    <ul>
                        <li>
                            <strong>Startup Access –</strong> View pitch decks, join founder calls, and request data room access.
                        </li>
                        <li>
                            <strong>Portfolio Monitoring –</strong> Get quarterly updates on up to five portfolio startups.
                        </li>
                        <li>
                            <strong>Investment Support –</strong> Receive portfolio recommendations and expert insights.
                        </li>
                        <li>
                            <strong>Global Network –</strong>Connect with investors and founders across 24+ countries.
                        </li>
                        <li>
                            <strong>Efficient Investing –</strong> BAN handles due diligence, saving you time and resources.
                        </li>
                    </ul> <br><br>
                    <strong>
                        Platform Access
                    </strong><br><br>
                    <ul>
                        <li>
                            <strong>Curated Startup Deals –</strong> Browse live investment opportunities with access to key insights and deal materials.
                        </li>
                        <li>
                            <strong>Webinar Library –</strong> Learn from past and live sessions featuring venture capitalists, founders, and industry leaders.
                        </li>
                        <li>
                            <strong>Event Invitations –</strong> Join monthly showcases, networking sessions, and masterclasses.
                        </li>
                    </ul><br><br>
                    <strong>
                        Additional Benefits for BWIN Members
                    </strong><br>
                    <p>
                        If you are part of <strong>Bangladesh Women Investors Network (BWIN)</strong>, your membership also includes:
                    </p><br><br>
                    <ul>
                        <li>
                            Access to <strong>women-led startups and gender-focused investment opportunities.</strong>
                        </li>
                        <li>
                            A network of <strong>experienced women investors and business leaders.</strong>
                        </li>
                        <li>
                            Opportunities to <strong>support and mentor emerging female entrepreneurs.</strong>
                        </li>
                    </ul>
                    <br><br>
                    <strong>
                        Next Steps – Complete Your Membership
                    </strong><br>
                    You've selected the <strong>{{ $plan }}</strong> plan on our platform. Here are the details:
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
                    To activate your membership, please complete your payment using one of the options below:
                </p>

                <table style="width: 100%; margin: 20px 0; border-collapse: collapse;">
                    <tr>
                        <td style="font-size: 14px; color: #333; font-weight: bold; padding: 8px;">Account Name:</td>
                        <td style="font-size: 14px; color: #555; padding: 8px;">BANGLADESH ANGELS NETWORK LIMITED</td>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <td style="font-size: 14px; color: #333; font-weight: bold; padding: 8px;">Account Number:</td>
                        <td style="font-size: 14px; color: #555; padding: 8px;">0011-1050004409</td>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <td style="font-size: 14px; color: #333; font-weight: bold; padding: 8px;">Bank Name:</td>
                        <td style="font-size: 14px; color: #555; padding: 8px;">Midland Bank Limited</td>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <td style="font-size: 14px; color: #333; font-weight: bold; padding: 8px;">Branch Name:</td>
                        <td style="font-size: 14px; color: #555; padding: 8px;">Gulshan Branch</td>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <td style="font-size: 14px; color: #333; font-weight: bold; padding: 8px;">SWIFT Code:</td>
                        <td style="font-size: 14px; color: #555; padding: 8px;">MDBLBDDH</td>
                    </tr>
                </table>
                <strong>Other Payment Options</strong>
                <ul style="margin-top:3px;">
                    <li>
                        <strong>PayPal:</strong> ivy.h.russell@gmail.com
                    </li>
                    <li>
                        <strong>bKash:</strong> +8801720010999
                    </li>
                </ul>
                <p style="font-size: 14px; color: #555; margin: 0; line-height: 1.6;">
                    If you have any questions, feel free to reply to this email.
                </p>

                <strong>
                    Additional Resources
                </strong>
                <ul style="margin-top:3px;">
                    <li>[Overview Deck]</li>
                    <li>[Portfolio Companies]</li>
                    <li>[Spotify & YouTube]</li>
                    <li>[One-Month Platform Trial Details]</li>
                </ul>

                <p style="font-size: 14px; color: #555; margin-top: 20px; line-height: 1.6;">
                    Best regards,<br>
                    <strong>Bangladesh Angels Network Team</strong>
                </p>
            </td>
        </tr>
        
        <!-- Footer -->
        <tr>
            <td style="background: #f4f4f4; padding: 20px; text-align: center; font-size: 12px; color: #777;">
                <p style="margin: 0;"><a href="https://www.linkedin.com/company/bangladesh-angels/" style="color: #16a34a; text-decoration: none;">LinkedIn</a> | <a href="https://bdangels.co" style="color: #16a34a; text-decoration: none;">Our Website</a></p>
                <p style="margin: 5px 0;">Telephone +8801823998877 | hello@bdangels.co</p>
            </td>
        </tr>
    </table>
</body>
</html>
