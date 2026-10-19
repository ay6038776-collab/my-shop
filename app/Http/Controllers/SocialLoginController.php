<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use App\Models\User;

class SocialLoginController extends Controller
{
    /**
     * Redirect to Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = $this->findOrCreateUser($googleUser, 'google');

            Auth::guard('customer')->login($user);

            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح!');
        } catch (\Exception $e) {
            return redirect()->route('customer.login')->with('error', 'حدث خطأ أثناء تسجيل الدخول');
        }
    }

    /**
     * Redirect to Facebook
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Facebook callback
     */
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            $user = $this->findOrCreateUser($facebookUser, 'facebook');

            Auth::guard('customer')->login($user);

            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح!');
        } catch (\Exception $e) {
            return redirect()->route('customer.login')->with('error', 'حدث خطأ أثناء تسجيل الدخول');
        }
    }

    /**
     * Redirect to Twitter/X
     */
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Handle Twitter/X callback
     */
    public function handleTwitterCallback()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->stateless()->user();

            $user = $this->findOrCreateUser($twitterUser, 'twitter');

            Auth::guard('customer')->login($user);

            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح!');
        } catch (\Exception $e) {
            return redirect()->route('customer.login')->with('error', 'حدث خطأ أثناء تسجيل الدخول');
        }
    }

    /**
     * Redirect to Apple
     */
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    /**
     * Handle Apple callback
     */
    public function handleAppleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->stateless()->user();

            $user = $this->findOrCreateUser($appleUser, 'apple');

            Auth::guard('customer')->login($user);

            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح!');
        } catch (\Exception $e) {
            return redirect()->route('customer.login')->with('error', 'حدث خطأ أثناء تسجيل الدخول');
        }
    }

    /**
     * Find or create user
     */
    private function findOrCreateUser($socialUser, $provider)
    {
        $email = $socialUser->getEmail();

        // Find existing user by email
        $user = Customer::where('email', $email)->first();

        if ($user) {
            // Update provider if needed
            return $user;
        }

        // Create new user
        return Customer::create([
            'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
            'email' => $email,
            'password' => bcrypt(str_random(24)), // Random password
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
        ]);
    }
}
