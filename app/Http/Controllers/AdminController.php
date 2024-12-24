<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __invoke()
    {
        return view('admin.index');
    }

    public function viewMembers()
    {
        return view('admin.members.index');
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
            'joining_date' => 'date',
            'renewed' => 'nullable|string|max:255',
            'country' => 'required|string|max:100',
            'preference_sector' => 'nullable|string|max:255',
            'strategic_analyst' => 'nullable|in:TL,FS,TB',
            'photo' => 'nullable|image|max:3072', // Max size: 3MB
            'company_name.*' => 'nullable|string|max:255',
            'investment_amount.*' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload for the photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('investors/photos', 'public');
        }

        // Create the user as an investor
        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make('defaultpassword123'), // Assign a default password (consider sending reset link later)
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
            'photo' => $photoPath,
            'is_approved' => $approval,
        ]);

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


        dd($user);

    }

    public function memberApply(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'organization' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'joining_date' => 'date',
            'renewed' => 'nullable|string|max:255',
            'country' => 'required|string|max:100',
            'preference_sector' => 'nullable|string|max:255',
            'strategic_analyst' => 'nullable|in:TL,FS,TB',
            'photo' => 'nullable|image|max:3072', // Max size: 3MB
            'company_name.*' => 'nullable|string|max:255',
            'investment_amount.*' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload for the photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('investors/photos', 'public');
        }

        // Create the user as an investor
        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make('defaultpassword123'), // Assign a default password (consider sending reset link later)
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
            'photo' => $photoPath,
            'is_approved' => false,
        ]);

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
        return view('admin.deals.index');
    }

    public function viewDeal()
    {
        return view('deals.single');
    }


    public function addDeal()
    {
        
    }
}
