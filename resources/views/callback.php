<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$db_config = [
    'host' => 'localhost',
    'database' => 'bangladesh_angels', // Replace with your actual database name
    'username' => 'root', // Replace with your actual username
    'password' => '', // Replace with your actual password
    'charset' => 'utf8mb4',
];

// Payment gateway configuration
$pg_config = [
    'sandbox_url' => 'https://sandbox.aamarpay.com/api/v1/trxcheck/request.php',
    'store_id' => 'aamarpaytest',
    'signature_key' => 'dbb74894e82415a2f7ff0ec3a97e4183'
];

// Create a database connection
$conn = mysql_connect($db_config['host'], $db_config['username'], $db_config['password']) or die("Database connection failed");
mysql_select_db($db_config['database'], $conn) or die("Database selection failed");

// Helper functions to replace Laravel functionality
function now() {
    return date('Y-m-d H:i:s');
}

function now_add_year() {
    return date('Y-m-d H:i:s', strtotime('+1 year'));
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $amount_original = $_POST['amount_original'] ?? null;
    $pay_status = $_POST['pay_status'] ?? null;
    $cus_name = $_POST['cus_name'] ?? null;
    $mer_txnid = $_POST['mer_txnid'] ?? null;
    $pg_txnid = $_POST['pg_txnid'] ?? null;
    $subscription_plan = $_POST['opt_a'] ?? 'core';
    $user_id = $_POST['opt_b'] ?? null;
    $currency = $_POST['currency'] ?? 'BDT';

    // Verify transaction with the payment gateway
    $url = $pg_config['sandbox_url'] . "?request_id=$mer_txnid&store_id={$pg_config['store_id']}&signature_key={$pg_config['signature_key']}&type=json";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response);
    $pg_txnid = $data->pg_txnid ?? null;
    $amount = $data->amount ?? null;
    $status_code = $data->status_code ?? null;

    // Process the payment status
    if ($status_code == 2) { // Payment successful
        try {
            // Find the user
            $user_id_escaped = mysql_real_escape_string($user_id);
            $query = "SELECT * FROM users WHERE id = '$user_id_escaped'";
            $result = mysql_query($query);

            if (mysql_num_rows($result) > 0) {
                // Update user's account and payment status
                $subscription_plan_escaped = mysql_real_escape_string($subscription_plan);
                $update_query = "UPDATE users SET account_status = '$subscription_plan_escaped', payment_status = 'paid' WHERE id = '$user_id_escaped'";
                mysql_query($update_query);

                // Record the payment in the database
                $payment_date = now();
                $expiry_date = now_add_year();
                $status = 'completed';
                $customer_ip = $_SERVER['REMOTE_ADDR'] ?? null;

                $pg_txnid_escaped = mysql_real_escape_string($pg_txnid);
                $mer_txnid_escaped = mysql_real_escape_string($mer_txnid);
                $amount_escaped = mysql_real_escape_string($amount);
                $currency_escaped = mysql_real_escape_string($currency);
                $status_code_escaped = mysql_real_escape_string($status_code);
                $payment_date_escaped = mysql_real_escape_string($payment_date);
                $expiry_date_escaped = mysql_real_escape_string($expiry_date);
                $customer_ip_escaped = mysql_real_escape_string($customer_ip);

                $payment_query = sprintf(
                    "INSERT INTO payments (user_id, payment_method, transaction_id, merchant_txnid, pg_txnid, subscription_plan, amount, currency, status, status_code, payment_date, expiry_date, customer_ip) VALUES (%d, 'aamarpay', '%s', '%s', '%s', '%s', %f, '%s', '%s', '%s', '%s', '%s', '%s')",
                    intval($user_id),
                    $pg_txnid_escaped,
                    $mer_txnid_escaped,
                    $pg_txnid_escaped,
                    $subscription_plan_escaped,
                    floatval($amount),
                    $currency_escaped,
                    $status,
                    $status_code_escaped,
                    $payment_date_escaped,
                    $expiry_date_escaped,
                    $customer_ip_escaped
                );
                mysql_query($payment_query);

                // Log the successful payment
                error_log("Payment successful for user #$user_id: $amount $currency for $subscription_plan plan");
            } else {
                error_log("User not found for payment: user_id=$user_id");
            }
        } catch (Exception $e) {
            error_log("Error processing payment: " . $e->getMessage());
        }
    } elseif ($status_code == 7) { // Payment failed
        error_log("Payment failed: mer_txnid=$mer_txnid, pg_txnid=$pg_txnid");
    }

    // Redirect back to the application with status code
    header("Location: https://bdangels.co?status_code=" . urlencode($status_code));
    exit;
}

// Close database connection
mysql_close($conn);
?>