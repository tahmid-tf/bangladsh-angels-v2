<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CheckoutConfirmation;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        if ($request->isMethod('post')) {
            // Store selected plan in session
            $request->session()->put('checkout.plan', [
                'name' => $request->input('plan_name'),
                'price' => $request->input('plan_price')
            ]);
        }
        
        // Retrieve the selected plan from session
        $selectedPlan = $request->session()->get('checkout.plan', [
            'name' => 'Default',
            'price' => 0
        ]);

        return view('payment.checkout', compact('selectedPlan'));
    }

    public function processCheckout(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'country_code' => 'required|string',
            'primary_country' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'investment_expertise' => 'required|in:beginner,intermediate,expert',
            'linkedin' => 'required|url|max:255',
            'password' => (auth()->user()) ? '' : 'required','|confirmed|min:8',
            'profile_photo' => 'nullable',
            'plan' => 'required|string',
            'price' => 'required|numeric|min:0',
            'payment' => 'nullable|string', // Default is "email"
        ]);

        // Check if the user already exists
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'phone' => $validated['country_code'] . $validated['phone'],
                'address' => $validated['address'],
                'primary_country' => $validated['primary_country'],
                'company_name' => $validated['company_name'],
                'designation' => $validated['designation'],
                'gender' => $validated['gender'],
                'investment_expertise' => $validated['investment_expertise'],
                'linkedin' => $validated['linkedin'],
                'password' => ($request->password) ? $validated['password'] : auth()->user()->password,
            ]
        );

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
        }

        // Log in the user if not already logged in
        if (!Auth::check()) {
            Auth::login($user);
        }

        //AamarPay Integration
        // Set gateway mode: 'sandbox' or 'live'
        $gatewayMode = 'sandbox'; // Change to 'live' for production

        // Payment gateway configuration based on mode
        $pg_config = [
            'sandbox' => [
                'url' => 'https://sandbox.aamarpay.com/jsonpost.php',
                'merchant_id' => 'aamarpaytest',
                'store_id' => 'aamarpaytest',
                'signature_key' => 'dbb74894e82415a2f7ff0ec3a97e4183'
            ],
            'live' => [
                'url' => 'https://secure.aamarpay.com/jsonpost.php',
                'merchant_id' => 'bdangels',
                'store_id' => 'bdangels',
                'signature_key' => '84f4fd2f6c4b7c702c9dcbb65a4f6e26'
            ]
        ];

        // Get the active configuration based on the gateway mode
        $active_config = $pg_config[$gatewayMode];

        $tran_id = ($gatewayMode == 'live' ? "bdangels" : "test") . rand(1111111,9999999); // unique transaction id

        $currency = "USD"; // aamarPay support Two type of currency USD & BDT  

        $amount = $validated['price'];
            
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => $active_config['url'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "store_id": "'.$active_config['store_id'].'",
            "tran_id": "'.$tran_id.'",
            "success_url": "https://secure.bdangels.co/callback.php",
            "fail_url": "https://secure.bdangels.co/callback.php",
            "cancel_url": "https://secure.bdangels.co/callback.php",
            "amount": "'.$amount.'",
            "currency": "'.$currency.'",
            "signature_key": "'.$active_config['signature_key'].'",
            "desc": "Merchant Registration Payment",
            "cus_name": "'. $validated['name'] .'",
            "cus_email": "'. $validated['email'] .'",
            "cus_add1": "'. $validated['address'] .'",
            "cus_add2": "Mohakhali DOHS",
            "cus_city": "Dhaka",
            "cus_state": "Dhaka",
            "cus_postcode": "1206",
            "cus_country": "Bangladesh",
            "cus_phone": "'. $validated['phone'] .'",
            "opt_a": "'. $validated['plan'] .'",
            "opt_b": "'. $user->id .'",
            "opt_c": "'. $gatewayMode .'",
            "type": "json"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
        
        \Illuminate\Support\Facades\Log::info("AamarPay response ($gatewayMode mode): " . $response);
        
        $responseObj = json_decode($response);

        

        if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

            $paymentUrl = $responseObj->payment_url;
            // dd($paymentUrl);
            return redirect()->away($paymentUrl);

        }else{
            \Illuminate\Support\Facades\Log::error("AamarPay error ($gatewayMode mode): " . $response);
            return redirect()->route('upgrade.page')->with('error', 'Payment gateway error. Please try again or contact support.');
        }


        // Save subscription details
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan' => $validated['plan'],
            'price' => $validated['price'],
            'status' => 'pending', // Set initial status to pending
        ]);

        // Optionally send a confirmation email (commented out for now)
        Mail::to($user->email)->send(new CheckoutConfirmation($user, $validated['plan'], $validated['price']));

        // Redirect to a success page
        return redirect()->route('checkout.success')->with('success', 'Your subscription is being processed!');
    }

    public function success(Request $request){
        // Get payment parameters from the request
        $amount_original = $request->amount_original ?? null;
        $pay_status = $request->pay_status ?? null;
        $cus_name = $request->cus_name ?? null;
        $mer_txnid = $request->mer_txnid ?? null;
        $pg_txnid = $request->pg_txnid ?? null;
        $subscription_plan = $request->opt_a ?? 'core'; // Plan passed via opt_a
        $user_id = $request->opt_b ?? null; // User ID passed via opt_b
        $currency = $request->currency ?? 'BDT';
        
        // Verify transaction with the payment gateway
        $store_id = "aamarpaytest";
        $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";
        $url = "https://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$mer_txnid&store_id=$store_id&signature_key=$signature_key&type=json";
        
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
        
        // Extract verified transaction details
        $pg_txnid = $data->pg_txnid ?? null;
        $amount = $data->amount ?? null;
        $status_code = $data->status_code ?? null;

        // Process the payment status
        if ($status_code == 2) { // Payment successful
            try {
                // Find the user
                $user = \App\Models\User::find($user_id);
                
                if ($user) {
                    // Update user's account and payment status
                    $user->update([
                        'account_status' => $subscription_plan,
                        'payment_status' => 'paid'
                    ]);

                    // Record the payment in the database
                    \App\Models\Payment::create([
                        'user_id' => $user_id,
                        'payment_method' => 'aamarpay',
                        'transaction_id' => $pg_txnid,
                        'merchant_txnid' => $mer_txnid,
                        'pg_txnid' => $pg_txnid,
                        'subscription_plan' => $subscription_plan,
                        'amount' => $amount,
                        'currency' => $currency,
                        'status' => 'completed',
                        'status_code' => $status_code,
                        'payment_date' => now(),
                        'expiry_date' => now()->addYear(), // 1 year subscription
                        'customer_ip' => $request->ip()
                    ]);

                    // Find the latest payment for showing details on success page
                    $payment = \App\Models\Payment::where('user_id', $user_id)
                        ->latest()
                        ->first();
                    
                    // Log the successful payment
                    \Illuminate\Support\Facades\Log::info("Payment successful for user #$user_id: $amount $currency for $subscription_plan plan");
                    
                    // Return success page with payment details
                    return view('payment.success', compact('payment'));
                } else {
                    \Illuminate\Support\Facades\Log::error("User not found for payment: user_id=$user_id");
                    return redirect()->route('upgrade.page')->with('error', 'User not found. Please contact support.');
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Error processing payment: " . $e->getMessage());
                return redirect()->route('upgrade.page')->with('error', 'An error occurred while processing your payment. Please contact support.');
            }
        } elseif ($status_code == 7) { // Payment failed
            \Illuminate\Support\Facades\Log::warning("Payment failed: mer_txnid=$mer_txnid, pg_txnid=$pg_txnid");
            return redirect()->route('upgrade.page')->with('error', 'Payment failed. Please try again or contact support.');
        } else {
            // Log any other error responses
            \Illuminate\Support\Facades\Log::error("Payment error with status_code=$status_code: mer_txnid=$mer_txnid, pg_txnid=$pg_txnid");
            return redirect()->route('upgrade.page')->with('error', 'Payment could not be processed. Please contact support.');
        }
    }

    /**
     * Legacy method - maintained for backward compatibility
     * Redirects to the new paymentFailed method
     */
    public function fail(Request $request){
        return $this->paymentFailed($request);
    }

    /**
     * Handle failed payment redirect from callback.php
     */
    public function paymentFailed(Request $request)
    {
        $mer_txnid = $request->mer_txnid;
        $error_message = $request->error_message;
        $user_id = $request->user_id;
        $status_code = $request->status_code;
        
        // Log the payment failure
        \Illuminate\Support\Facades\Log::warning("Payment failed: mer_txnid=$mer_txnid, user_id=$user_id, error=$error_message");
        
        // Record the failed payment attempt in database if needed
        if ($user_id) {
            try {
                \App\Models\Payment::create([
                    'user_id' => $user_id,
                    'payment_method' => 'aamarpay',
                    'merchant_txnid' => $mer_txnid,
                    'status' => 'failed',
                    'status_code' => $status_code ?? '7',
                    'payment_date' => now(),
                    'customer_ip' => $request->ip()
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Failed to record failed payment: " . $e->getMessage());
            }
        }
        
        // Show the dedicated payment failure page with error details
        return view('payment.failed', compact('mer_txnid', 'error_message', 'user_id'));
    }

    /**
     * Handle successful payment completion redirect from callback.php
     */
    public function paymentComplete(Request $request)
    {
        $status_code = $request->status_code;
        $user_id = $request->user_id;
        $payment_id = $request->payment_id;
        $plan = $request->plan;
        
        // Find the payment record
        $payment = \App\Models\Payment::find($payment_id);
        
        if (!$payment) {
            // Try to find using user_id as fallback
            $payment = \App\Models\Payment::where('user_id', $user_id)
                ->latest()
                ->first();
        }
        
        // Show payment success page with payment details
        return view('payment.success', compact('payment', 'plan'));
    }
    
    /**
     * Handle payment error redirect from callback.php
     */
    public function paymentError(Request $request)
    {
        $error = $request->error;
        $status_code = $request->status_code;
        
        $message = 'An error occurred with your payment.';
        
        if ($error == 'user_not_found') {
            $message = 'User account not found. Please contact support.';
        } elseif ($error == 'processing_error') {
            $message = 'There was an error processing your payment. Please contact support.';
        }
        
        return redirect()->route('upgrade.page')
            ->with('error', $message);
    }
    
    /**
     * Handle general payment status redirect from callback.php
     */
    public function paymentStatus(Request $request)
    {
        $status_code = $request->status_code;
        
        if ($status_code == 2) {
            return redirect()->route('upgrade.page')
                ->with('success', 'Your payment was successful!');
        } else {
            return redirect()->route('upgrade.page')
                ->with('error', 'Your payment status could not be determined. Please contact support.');
        }
    }
}
