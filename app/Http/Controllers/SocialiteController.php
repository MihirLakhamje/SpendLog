<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'google_avatar' => $googleUser->avatar,
                ]);
                Auth::login($user);
                return redirect()->route('users.home');
            }
            Auth::login($user);
            return redirect()->route('users.home');
        } catch (Exception $e) {
            dd($e);
        }
    }
}
