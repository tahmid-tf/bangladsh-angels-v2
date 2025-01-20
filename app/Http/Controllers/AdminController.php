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
        if(auth()->user()->isAdmin()){
            $users = User::all(); // Retrieve all users
            $deals = Deal::all(); // Retrieve all deals

            return view('admin.index', compact('users','deals'));
        } else {
            return redirect()->route('home');
        }
    }

    public function viewMembers()
    {
        if(auth()->user()->isAdmin()){
            $users = User::with('media')->get(); // Retrieve all users
            return view('admin.members.index', compact('users'));
        } else {
            return redirect()->route('home');
        }
    }

    public function viewActiveMembers()
    {
        if(auth()->user()->isAdmin()){
            $users = User::with('media')->where('account_status','!=','free')->paginate(10); // Retrieve all users
            return view('admin.members.active_index', compact('users'));
        } else {
            return redirect()->route('home');
        }
    }

    public function viewInactiveMembers()
    {
        if(auth()->user()->isAdmin()){
            $users = User::with('media')->where('account_status','free')->paginate(10); // Retrieve all users
            return view('admin.members.inactive_index', compact('users'));
        } else {
            return redirect()->route('home');
        }
    }

    public function addMember()
    {

        if(auth()->user()->isAdmin()){
            return view('admin.members.create');
        } else {
            return redirect()->route('home');
        }
    }

    public function createMember(Request $request, User $user, $approval)
    {
        $approval = true;
        if(auth()->user()->isAdmin()){
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:20',
                'gender' => 'required|in:male,female,other',
                'organization' => 'nullable|string|max:255',
                'designation' => 'nullable|string|max:255',
                'joining_date' => 'nullable|date',
                'renewed' => 'nullable|string|max:255',
                'primary_country' => 'required|string|max:100',
                'country_code' => 'required|string|max:100',
                'preference_sector' => 'nullable|string|max:255',
                'strategic_analyst' => 'nullable|in:TL,FS,TB',
                'photo' => 'nullable|image|max:3072', // Max size: 3MB
                'profile_photo' => 'nullable|image|max:3072|mimes:jpeg,png,jpg,gif', // Validation for profile_photo
                'investment_amount.*' => 'nullable|numeric|min:0',
                'password' => 'required|string|min:8|confirmed', // Ensure password and re_password match
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $fullName = $request->first_name . " " . $request->last_name;
            $phone = $request->country_code .  $request->phone;

            // Create the user as an investor
            $user = User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'address' => $request->address,
                'password' => Hash::make($request->password), // Hash the password
                'phone' => $phone,
                'gender' => $request->gender,
                'designation' => $request->designation,
                'joining_date' => $request->joining_date,
                'renewed' => $request->renewed,
                'primary_country' => $request->primary_country,
                'preference_sector' => $request->preference_sector,
                'strategic_analyst' => $request->strategic_analyst,
                'role' => 'investor', // Assign the investor role
                'is_approved' => $approval,
            ]);

            // Handle file upload for the photo using Media Library
            if ($request->hasFile('profile_photo')) {
                $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
            }

            

            return redirect()->route('admin.members')->with('success', 'Member created successfully.');
        } else {
            return redirect()->route('home');
        }
    }


    public function memberApply(Request $request)
    {
        $approval = false;
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'investment_expertise' => 'nullable|string',
            'gender' => 'required|in:male,female,other',
            'organization' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'renewed' => 'nullable|string|max:255',
            'primary_country' => 'required|string|max:100',
            'country_code' => 'required|string|max:100',
            'preference_sector' => 'nullable|string|max:255',
            'strategic_analyst' => 'nullable|in:TL,FS,TB',
            'photo' => 'nullable|image|max:3072', // Max size: 3MB
            'profile_photo' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif', // Max size: 5MB (5120 KB)
            'company_name.*' => 'nullable|string|max:255',
            'investment_amount.*' => 'nullable|numeric|min:0',
            'password' => 'required|string|min:8|confirmed', // Ensure password and re_password match
        ]);

        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $fullName = $request->first_name . " " . $request->last_name;
        $phone = $request->country_code .  $request->phone;
         
        // Create the user as an investor
        $user = User::create([
            'name' => $fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'phone' => $phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'organization' => $request->organization,
            'designation' => $request->designation,
            'investment_expertise' => $request->investment_expertise,
            'joining_date' => $request->joining_date,
            'renewed' => $request->renewed,
            'linkedin' => $request->linkedin,
            'primary_country' => $request->primary_country,
            'preference_sector' => $request->preference_sector,
            'strategic_investment_analyst' => $request->strategic_analyst,
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

        return redirect()->route('dashboard');

       

    }

    public function viewDeals()
    {
        if(auth()->user()->isAdmin()){
            $deals = Deal::with('media')->get(); // Fetch all deals
            return view('admin.deals.index', compact('deals'));
        } else {
            return redirect()->route('home');
        }
    }

    public function viewDeals_invest()
    {
        if(auth()->user()->isAdmin()){
            $deals = Deal::with('media')->where('type','invest')->get(); // Fetch all deals
            return view('admin.deals.invest_index', compact('deals'));
        } else {
            return redirect()->route('home');
        }
    }

    public function viewDeals_commit()
    {
        if(auth()->user()->isAdmin()){
            $deals = Deal::with('media')->where('type','commit')->get(); // Fetch all deals
            return view('admin.deals.commit_index', compact('deals'));
        } else {
            return redirect()->route('home');
        }
    }

    public function viewDeals_review()
    {
        if(auth()->user()->isAdmin()){
            $deals = Deal::with('media')->where('type','review')->get(); // Fetch all deals
            return view('admin.deals.review_index', compact('deals'));
        } else {
            return redirect()->route('home');
        }
    }
    

    public function addDeal()
    {
        if(auth()->user()->isAdmin()){
            return view('admin.deals.create');
        } else {
            return redirect()->route('home');
        }
    }

    public function storeDeal(Request $request)
    {
        if(auth()->user()->isAdmin()){   
            // Validate incoming request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'sector' => 'required|string|max:255',
                'type' => 'required',
                'investment_stage' => 'required|in:Pre Seed,Seed,Series A,Series B,Series C,Series D',
                'amount_seeking' => 'required|numeric|min:0',
                'description' => 'required|string',
                'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'company_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'pitch_deck_url' => 'nullable|max:255',
                'substack_link' => 'nullable|max:255',
                'action_link' => 'nullable|max:255',
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
                'key_metrics' => 'nullable|array',
                'key_metrics.*.name' => 'required|string|max:255',
                'key_metrics.*.value' => 'required|string|max:255',
            ]);
           
            // Inside your store method
            $slug = Str::slug($validatedData['title'], '-');

            // Create a new Deal record
            $deal = Deal::create([
                'title' => $validatedData['title'],
                'slug' => $slug,
                'sector' => $validatedData['sector'],
                'type' => $validatedData['type'],
                'investment_stage' => $validatedData['investment_stage'],
                'amount_seeking' => $validatedData['amount_seeking'],
                'description' => $validatedData['description'],
                'pitch_deck_url' => $validatedData['pitch_deck_url'] ?? null,
                'substack_link' => $validatedData['substack_link'] ?? null,
                'action_link' => $validatedData['action_link'] ?? null,
                'growth_rate' => $validatedData['growth_rate'] ?? null,
                'revenue_model' => $validatedData['revenue_model'] ?? null, 
                'future_plans' => $validatedData['future_plans'] ?? null,
                'partnerships' => $validatedData['partnerships'] ?? null,
                'video_url' => $validatedData['video_url'] ?? null,
                'status' => $validatedData['status'] ?? 'draft',
                'created_by' => auth()->id(),
                'key_metrics' => json_encode($request->key_metrics), // Store as JSON
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
        } else {
            return redirect()->route('home');
        }
    }

    public function destroyDeal(Deal $deal)
    {
        // Check if the authenticated user is an admin
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('deal.index')->with('error', 'You are not authorized to perform this action.');
        }

        // Delete related investments
        $deal->investments()->delete();

        // Delete associated media files using Spatie Media Library
        $deal->clearMediaCollection('company_logo'); // Deletes all media in the 'company_logo' collection
        $deal->clearMediaCollection('company_cover'); // Deletes all media in the 'company_cover' collection
        $deal->clearMediaCollection('image_gallery'); // Deletes all media in the 'image_gallery' collection

        // Delete the deal record
        $deal->delete();

        // Redirect back with a success message
        return redirect()->route('admin.deals')->with('success', 'Deal deleted successfully.');
    }

    public function editDeal(Deal $deal)
    {
        return view('admin.deals.edit',compact('deal'));
    }

    public function updateDeal(Request $request,Deal $deal)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'sector' => 'required|string',
            'type' => 'required|in:commit,invest,review,portfolio',
            'investment_stage' => 'required|in:Pre Seed,Seed,Series A,Series B,Series C,Series D',
            'amount_seeking' => 'required|numeric|min:0',
            'description' => 'required|string',
            'logo' => 'nullable|image|max:3072',
            'pitch_deck_url' => 'nullable',
            'substack_link' => 'nullable',
            'action_link' => 'nullable',
        ]);

        $deal->update($validatedData);
    
        if ($request->hasFile('logo')) {
            $deal->updateLogo($request->file('logo'));
        }
    
        if ($request->hasFile('company_cover')) {
            $deal->updateCover($request->file('company_cover'));
        }
    
        return redirect()->route('admin.deals')->with('success', 'Deal updated successfully!');
    }

    public function editMember(User $user)
    {
        
        return view('admin.members.edit',compact('user'));
    }

    public function removeMember(User $user)
    {
        // Check if the authenticated user is an admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.members')->with('error', 'You do not have permission to perform this action.');
        }

        // Prevent deleting self (Optional)
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.members')->with('error', 'You cannot delete your own account.');
        }

        try {
            // Check if the user exists
            if (!$user) {
                return redirect()->route('admin.members')->with('error', 'User not found.');
            }

            // Delete related data if necessary (e.g., user media, posts, etc.)
            if ($user->hasMedia('profile_photo')) {
                $user->clearMediaCollection('profile_photo');
            }

            // Delete the user
            $user->delete();

            return redirect()->route('admin.members')->with('success', 'Member successfully removed.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error deleting user: ' . $e->getMessage());

            return redirect()->route('admin.members')->with('error', 'An error occurred while trying to delete the member. Please try again.');
        }
    }

    public function updateMember(Request $request, User $user)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ignore the current user's email
            'phone' => 'required|string|max:20',
            'account_status' => 'required|string',
            'account_level' => 'required|in:emerald,ruby,diamond',
            'gender' => 'required|in:male,female,other',
            'organization' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'primary_contact' => 'nullable|string|max:255',
            'secondary_contact' => 'nullable|string|max:255',
            'primary_country' => 'required|string|max:100',
            'preference_sector' => 'nullable|string|max:255',
            'was_referred' => 'required|boolean',
            'referred_by' => 'nullable|string|max:255|required_if:was_referred,1', // Validate if referred
            'renewed' => 'nullable|string|max:255',
            'last_renewed_at' => 'nullable|date',
            'total_invested' => 'nullable|numeric|min:0',
            'revenue_generated' => 'nullable|numeric|min:0',
            'profile_photo' => 'nullable|image|max:3072', // Max size: 3MB
            'notes' => 'nullable|string|max:5000',
            'status' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the user details
        $user->update([
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'account_status' => $request->account_status,
            'level' => $request->account_level,
            'company_name' => $request->organization,
            'designation' => $request->designation,
            'primary_contact' => $request->primary_contact,
            'secondary_contact' => $request->secondary_contact,
            'primary_country' => $request->primary_country,
            'preference_sector' => $request->preference_sector,
            'was_referred' => $request->was_referred,
            'referred_by' => $request->was_referred ? $request->referred_by : null,
            'renewed' => $request->renewed,
            'last_renewed_at' => $request->last_renewed_at,
            'total_invested' => $request->total_invested,
            'revenue_generated' => $request->revenue_generated,
            'notes' => $request->notes,
        ]);

        // Handle profile photo update
        if ($request->hasFile('profile_photo')) {
            $user->clearMediaCollection('profile_photo'); // Clear old profile photo
            $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo'); // Add new photo
        }

        // Redirect with a success message
        return redirect()->route('admin.members')->with('success', 'Member updated successfully.');
    }


    public function updateAccountStatus(Request $request, User $user)
    {
        dd($request);
        $id = $user->id;
        $validatedData = $request->validate([
            'account_status' => 'required|in:free,Core,Advanced,Institutional',
        ]);
    
        $user->account_status = $validatedData['account_status'];
        $user->save();
    
        // return response()->with('success','Account status updated successfully!',200);
        return redirect()->route('admin.members')->with('success', 'Account Status updated successfully.');
    }

    public function showDeal(Deal $deal)
    {
        $otherDeals = $deal->getOtherDeals(5); // Fetch 5 other deals
        return view('deals.single',compact('deal','otherDeals'));
    }


}
