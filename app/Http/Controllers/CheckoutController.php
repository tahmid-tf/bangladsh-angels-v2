<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'plan' => 'required|string',
            'price' => 'required|numeric',
            'payment' => 'string',
        ]);

        // Check if the user exists
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'password' => Hash::make('defaultpassword'), // Set a default password
                'address' => $validated['address'], // Assuming `address` field exists in the `users` table
            ]
        );

        // If the user is not logged in, log them in
        if (!Auth::check()) {
            Auth::login($user);
        }

        // Send the email
        // Mail::to($user->email)->send(new CheckoutConfirmation($user, $validated['plan'], $validated['price']));
        
        // Redirect to a success page
        return redirect()->route('checkout.success');
    }

    

    public function success()
    {
        return view('payment.success');
    }
}
