<?php

/**
 * @deprecated AamarPay return URLs must target Laravel:
 *   {APP_URL}/payment/aamarpay/callback
 * (POST/GET from gateway — CSRF-exempt in bootstrap/app.php)
 *
 * Do not use this file as the payment return handler; it responds 410 so stale
 * merchant configuration fails visibly instead of using duplicate PDO logic.
 */
http_response_code(410);
header('Content-Type: text/plain; charset=utf-8');
echo "Deprecated callback. Configure AamarPay success/fail/cancel URLs to your app’s /payment/aamarpay/callback\n";
exit;
