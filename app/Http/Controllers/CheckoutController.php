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

        // Save subscription details
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan' => $validated['plan'],
            'price' => $validated['price'],
            'status' => 'pending', // Set initial status to pending
        ]);

        // Optionally send a confirmation email (commented out for now)
        // Mail::to($user->email)->send(new CheckoutConfirmation($user, $validated['plan'], $validated['price']));

        // Redirect to a success page
        return redirect()->route('checkout.success')->with('success', 'Your subscription is being processed!');
    }


    

    public function success()
    {
        return view('payment.success');
    }
}
