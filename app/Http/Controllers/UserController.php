<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        return view('users.home');
    }

    public function profile()
    {
        return view('users.profile');
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email'],
            ]);

            $user = User::find(Auth::user()->id);
            $userEmail = User::where('email', $request->email)->first();
            if($userEmail){
                if($userEmail->id != Auth::user()->id){
                    return redirect()->route('users.profile')->with('error', 'Email already exists.');
                }
            }
            if($user->google_id){
                $user->name = $request->name;
                $user->save();
                return redirect()->route('users.profile')->with('success', 'You have successfully updated your profile.');
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return redirect()->route('users.profile')->with('success', 'You have successfully updated your profile.');
            
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => ['required', 'min:6', 'confirmed'],
            ]);

            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('users.profile')->with('success', 'You have successfully updated your password.');
        } catch (Exception $e) {
            return redirect()->route('users.profile')->with('error', 'Something went wrong.');
        }
    }

    public function destroyUser()
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Something went wrong.');
        }
    }
}
