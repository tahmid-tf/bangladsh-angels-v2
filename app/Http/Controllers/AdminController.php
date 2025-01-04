<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Deal;
use App\Models\Payment;

use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __invoke()
    {
        $users = User::all(); // Retrieve all users
        $deals = Deal::all(); // Retrieve all deals

        return view('admin.index', compact('users','deals'));
    }

    public function viewMembers()
    {
        $users = User::all(); // Retrieve all users
        return view('admin.members.index', compact('users'));
    }

    public function addMember()
    {
        return view('admin.members.create');
    }

    public function createMember(Request $request, User $user, $approval)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'organization' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'renewed' => 'nullable|string|max:255',
            'country' => 'required|string|max:100',
            'preference_sector' => 'nullable|string|max:255',
            'strategic_analyst' => 'nullable|in:TL,FS,TB',
            'photo' => 'nullable|image|max:3072', // Max size: 3MB
            'profile_photo' => 'nullable|image|max:3072|mimes:jpeg,png,jpg,gif', // Validation for profile_photo
            'company_name.*' => 'nullable|string|max:255',
            'investment_amount.*' => 'nullable|numeric|min:0',
            'password' => 'required|string|min:8|confirmed', // Ensure password and re_password match
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the user as an investor
        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'phone' => $request->phone,
            'gender' => $request->gender,
            'organization' => $request->organization,
            'designation' => $request->designation,
            'joining_date' => $request->joining_date,
            'renewed' => $request->renewed,
            'country' => $request->country,
            'preference_sector' => $request->preference_sector,
            'strategic_analyst' => $request->strategic_analyst,
            'role' => 'investor', // Assign the investor role
            'is_approved' => $approval,
        ]);

        // Handle file upload for the photo using Media Library
        if ($request->hasFile('profile_photo')) {
            $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
        }

        // Add investment portfolio data if provided
        if ($request->has('company_name')) {
            foreach ($request->company_name as $index => $companyName) {
                if (!empty($companyName) && !empty($request->investment_amount[$index])) {
                    $user->portfolio()->create([
                        'company_name' => $companyName,
                        'investment_amount' => $request->investment_amount[$index],
                    ]);
                }
            }
        }

        return redirect()->route('admin.members')->with('success', 'Member created successfully.');
    }


    public function memberApply(Request $request, User $user)
    {
        $approval = false;
        
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'organization' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'renewed' => 'nullable|string|max:255',
            'country' => 'required|string|max:100',
            'preference_sector' => 'nullable|string|max:255',
            'strategic_analyst' => 'nullable|in:TL,FS,TB',
            'photo' => 'nullable|image|max:3072', // Max size: 3MB
            'profile_photo' => 'nullable|image|max:3072|mimes:jpeg,png,jpg,gif', // Validation for profile_photo
            'company_name.*' => 'nullable|string|max:255',
            'investment_amount.*' => 'nullable|numeric|min:0',
            'password' => 'required|string|min:8|confirmed', // Ensure password and re_password match
        ]);

        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Create the user as an investor
        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'phone' => $request->phone,
            'gender' => $request->gender,
            'organization' => $request->organization,
            'designation' => $request->designation,
            'joining_date' => $request->joining_date,
            'renewed' => $request->renewed,
            'country' => $request->country,
            'preference_sector' => $request->preference_sector,
            'strategic_analyst' => $request->strategic_analyst,
            'role' => 'investor', // Assign the investor role
            'is_approved' => $approval,
        ]);

        // Handle file upload for the photo using Media Library
        if ($request->hasFile('profile_photo')) {
           
            $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
        }

        // Add investment portfolio data if provided
        if ($request->has('company_name')) {
            // Ensure company_name and investment_amount are arrays
            $companyNames = is_array($request->company_name) ? $request->company_name : [$request->company_name];
            $investmentAmounts = is_array($request->investment_amount) ? $request->investment_amount : [$request->investment_amount];

            foreach ($companyNames as $index => $companyName) {
                if (!empty($companyName) && !empty($investmentAmounts[$index])) {
                    $user->portfolio()->create([
                        'company_name' => $companyName,
                        'investment_amount' => $investmentAmounts[$index],
                    ]);
                }
            }
        }



        dd($user);

    }

    public function viewDeals()
    {
        $deals = Deal::all(); // Fetch all deals
        return view('admin.deals.index', compact('deals'));
    }

    public function viewDeal()
    {
        return view('deals.single');
    }


    public function addDeal()
    {
        return view('admin.deals.create');
    }

    public function storeDeal(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'type' => 'required|in:commit,invest,review',
            'investment_stage' => 'required|in:Pre Seed,Seed,Series A,Series B',
            'amount_seeking' => 'required|numeric|min:0',
            'description' => 'required|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'company_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'pitch_deck_url' => 'nullable|url|max:255',
            'monthly_revenue' => 'nullable|numeric|min:0',
            'total_addressable_market' => 'nullable|string|max:255',
            'serviceable_addressable_market' => 'nullable|string|max:255',
            'growth_rate' => 'nullable|string|max:255',
            'revenue_model' => 'nullable|string',
            'user_base' => 'nullable|string|max:255',
            'daily_active_users' => 'nullable|string|max:255',
            'market_penetration' => 'nullable|string|max:255',
            'time_saved' => 'nullable|string|max:255',
            'carbon_emission_reduction' => 'nullable|string|max:255',
            'future_plans' => 'nullable|string',
            'partnerships' => 'nullable|string',
            'video_url' => 'nullable|url|max:255',
            'image_gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'nullable|in:active,closed,draft',
        ]);

        // Inside your store method
        $slug = Str::slug($validatedData['title'], '-');

        // Create a new Deal record
        $deal = Deal::create([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'company_name' => $validatedData['company_name'],
            'sector' => $validatedData['sector'],
            'type' => $validatedData['type'],
            'investment_stage' => $validatedData['investment_stage'],
            'amount_seeking' => $validatedData['amount_seeking'],
            'description' => $validatedData['description'],
            'pitch_deck_url' => $validatedData['pitch_deck_url'] ?? null,
            'monthly_revenue' => $validatedData['monthly_revenue'] ?? null,
            'total_addressable_market' => $validatedData['total_addressable_market'] ?? null,
            'serviceable_addressable_market' => $validatedData['serviceable_addressable_market'] ?? null,
            'growth_rate' => $validatedData['growth_rate'] ?? null,
            'revenue_model' => $validatedData['revenue_model'] ?? null,
            'user_base' => $validatedData['user_base'] ?? null,
            'daily_active_users' => $validatedData['daily_active_users'] ?? null,
            'market_penetration' => $validatedData['market_penetration'] ?? null,
            'time_saved' => $validatedData['time_saved'] ?? null,
            'carbon_emission_reduction' => $validatedData['carbon_emission_reduction'] ?? null,
            'future_plans' => $validatedData['future_plans'] ?? null,
            'partnerships' => $validatedData['partnerships'] ?? null,
            'video_url' => $validatedData['video_url'] ?? null,
            'status' => $validatedData['status'] ?? 'draft',
            'created_by' => auth()->id(),
        ]);

        // Handle file uploads using Spatie Media Library
        if ($request->hasFile('logo')) {
            $deal->addMediaFromRequest('logo')->toMediaCollection('company_logo');
        }

        if ($request->hasFile('company_cover')) {
            $deal->addMediaFromRequest('company_cover')->toMediaCollection('company_cover');
        }

        if ($request->hasFile('image_gallery')) {
            foreach ($request->file('image_gallery') as $image) {
                $deal->addMedia($image)->toMediaCollection('image_gallery');
            }
        }

        return redirect()->route('admin.deals')->with('success', 'Deal added successfully!');
    }
}
