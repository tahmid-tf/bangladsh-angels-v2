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

// Create a database connection using PDO
try {
    $conn = new PDO("mysql:host={$db_config['host']};dbname={$db_config['database']};charset={$db_config['charset']}", $db_config['username'], $db_config['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

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
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Update user's account and payment status
                $update_stmt = $conn->prepare("UPDATE users SET account_status = :plan, payment_status = 'paid' WHERE id = :user_id");
                $update_stmt->bindParam(':plan', $subscription_plan, PDO::PARAM_STR);
                $update_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $update_stmt->execute();

                // Record the payment in the database
                $payment_date = now();
                $expiry_date = now_add_year();
                $status = 'completed';
                $customer_ip = $_SERVER['REMOTE_ADDR'] ?? null;

                $payment_stmt = $conn->prepare("INSERT INTO payments (user_id, payment_method, transaction_id, merchant_txnid, pg_txnid, subscription_plan, amount, currency, status, status_code, payment_date, expiry_date, customer_ip) 
                    VALUES (:user_id, 'aamarpay', :pg_txnid, :mer_txnid, :pg_txnid2, :plan, :amount, :currency, :status, :status_code, :payment_date, :expiry_date, :customer_ip)");
                $payment_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $payment_stmt->bindParam(':pg_txnid', $pg_txnid, PDO::PARAM_STR);
                $payment_stmt->bindParam(':mer_txnid', $mer_txnid, PDO::PARAM_STR);
                $payment_stmt->bindParam(':pg_txnid2', $pg_txnid, PDO::PARAM_STR);
                $payment_stmt->bindParam(':plan', $subscription_plan, PDO::PARAM_STR);
                $payment_stmt->bindParam(':amount', $amount);
                $payment_stmt->bindParam(':currency', $currency, PDO::PARAM_STR);
                $payment_stmt->bindParam(':status', $status, PDO::PARAM_STR);
                $payment_stmt->bindParam(':status_code', $status_code, PDO::PARAM_STR);
                $payment_stmt->bindParam(':payment_date', $payment_date, PDO::PARAM_STR);
                $payment_stmt->bindParam(':expiry_date', $expiry_date, PDO::PARAM_STR);
                $payment_stmt->bindParam(':customer_ip', $customer_ip, PDO::PARAM_STR);
                $payment_stmt->execute();

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
    } else {
        // Log any other error responses
        error_log("Payment error with status_code=$status_code: mer_txnid=$mer_txnid, pg_txnid=$pg_txnid");
        error_log("Full response data: " . print_r($data, true));
    }

    // Redirect back to the application with status code
    header("Location: https://bdangels.co?status_code=" . urlencode($status_code));
    exit;
}
?>
