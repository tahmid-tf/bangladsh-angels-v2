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

        $tran_id = "test".rand(1111111,9999999);//unique transection id for every transection 

        $currency= "USD"; //aamarPay support Two type of currency USD & BDT  

        $amount = $validated['price'];   //10 taka is the minimum amount for show card option in aamarPay payment gateway
        
        //For live Store Id & Signature Key please mail to support@aamarpay.com
        $store_id = "aamarpaytest"; 

        $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183"; 

        $url = "https://​sandbox​.aamarpay.com/jsonpost.php"; // for Live Transection use "https://secure.aamarpay.com/jsonpost.php"

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "store_id": "'.$store_id.'",
            "tran_id": "'.$tran_id.'",
            "success_url": "'.route('checkout.success').'",
            "fail_url": "'.route('checkout.fail').'",
            "cancel_url": "'.route('checkout.cancel').'",
            "amount": "'.$amount.'",
            "currency": "'.$currency.'",
            "signature_key": "'.$signature_key.'",
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
            "type": "json"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $responseObj = json_decode($response);

        

        if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

            $paymentUrl = $responseObj->payment_url;
            // dd($paymentUrl);
            return redirect()->away($paymentUrl);

        }else{
            dd($response);
            // echo $response;
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
     
        $request_id= $request->mer_txnid;

        //verify the transection using Search Transection API 

        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";
        
        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"
        
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
        echo $response;

    }

    public function fail(Request $request){
        return $request;
    }

    public function cancel(){
        return 'Canceled';
    }
}
