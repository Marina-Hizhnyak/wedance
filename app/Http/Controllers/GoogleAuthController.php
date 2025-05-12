<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirect()
    {
        // Redirect to Google
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function callback()
    {
        // Retrieve user info from Google
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Find or create user
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'email_verified_at' => now(),
                'password' => bcrypt(str()->random(24)), // random password
            ]
        );

        // Login user
        Auth::login($user);

        // Redirect to dashboard or home
        return redirect()->intended('/dashboard');
    }
}
