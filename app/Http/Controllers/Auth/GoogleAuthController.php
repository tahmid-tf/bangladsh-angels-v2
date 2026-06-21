<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(Request $request, string $intent = 'login'): RedirectResponse
    {
        $request->session()->put(
            'google_oauth_intent',
            in_array($intent, ['login', 'signup'], true) ? $intent : 'login'
        );

        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request): RedirectResponse
    {
        $intent = $request->session()->pull('google_oauth_intent', 'login');

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable) {
            return $this->failureRedirect($intent, 'Google sign-in was cancelled or failed. Please try again.');
        }

        if (! filled($googleUser->getEmail())) {
            return $this->failureRedirect($intent, 'Your Google account does not share an email address. Please use email registration instead.');
        }

        $user = User::query()
            ->where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($intent === 'login') {
            if (! $user) {
                return redirect()
                    ->route('investor.signup')
                    ->with('info', 'No account exists for this Google email yet. Complete investor registration below, or use Sign up with Google.');
            }

            $this->linkGoogleAccount($user, $googleUser);
            Auth::login($user, remember: true);

            return redirect()->intended(route('home'));
        }

        if ($user) {
            $this->linkGoogleAccount($user, $googleUser);
            Auth::login($user, remember: true);

            return redirect()->route('approval.success');
        }

        $nameParts = $this->splitName((string) $googleUser->getName());

        $request->session()->put('google_signup', [
            'google_id' => $googleUser->getId(),
            'email' => Str::lower($googleUser->getEmail()),
            'first_name' => $nameParts['first'],
            'last_name' => $nameParts['last'],
        ]);

        return redirect()
            ->route('investor.signup')
            ->with('info', 'Google account connected. Complete the investor application below.');
    }

    private function linkGoogleAccount(User $user, \Laravel\Socialite\Contracts\User $googleUser): void
    {
        $updates = [];

        if ($user->google_id !== $googleUser->getId()) {
            $updates['google_id'] = $googleUser->getId();
        }

        if (! $user->hasVerifiedEmail()) {
            $updates['email_verified_at'] = now();
            $updates['email_verified_by'] = null;
        }

        if ($updates !== []) {
            $user->update($updates);
        }
    }

    /**
     * @return array{first: string, last: string}
     */
    private function splitName(string $fullName): array
    {
        $fullName = trim($fullName);

        if ($fullName === '') {
            return ['first' => '', 'last' => ''];
        }

        $parts = preg_split('/\s+/', $fullName) ?: [];
        $first = array_shift($parts) ?? '';
        $last = trim(implode(' ', $parts));

        return [
            'first' => $first,
            'last' => $last !== '' ? $last : $first,
        ];
    }

    private function failureRedirect(string $intent, string $message): RedirectResponse
    {
        if ($intent === 'signup') {
            return redirect()->route('investor.signup')->withErrors(['google' => $message]);
        }

        return redirect()->route('login')->withErrors(['google' => $message]);
    }
}
