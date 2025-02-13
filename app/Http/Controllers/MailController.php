<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;


class MailController extends Controller
{
    public function __invoke()
    {
        // Fetch all users and explode emails if multiple emails exist in one field
        $validEmails = User::all()->map(function ($user) {
            $emails = explode(' ', $user->email); // Splitting emails stored as space-separated
            return (object) [
                'name' => $user->name,
                'emails' => collect($emails)->filter(fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL))->values(),
                'phone' => $user->phone
            ];
        });

        return view('admin.maillist.index', compact('validEmails'));
    }

    public function send(Request $request)
    {
        dd($request);
    }
}
